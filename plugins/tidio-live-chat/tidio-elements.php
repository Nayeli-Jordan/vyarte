<?php

/**
 * Plugin Name: Tidio Chat
 * Plugin URI: http://www.tidiochat.com
 * Description: Tidio Live Chat - Integrate live chat with your page in just a few seconds - just click, install and use!
 * Version: 3.4.0
 * Author: Tidio Ltd.
 * Author URI: http://www.tidiochat.com
 * License: GPL2
 */
define('TIDIOCHAT_VERSION', '3.4.0');

class TidioLiveChat
{
    const SCRIPT_URL = '//code.tidio.co/';
    const API_URL = 'https://api-v2.tidio.co';
    const CHAT_URL = 'https://www.tidiochat.com';
    const PUBLIC_KEY_OPTION = 'tidio-one-public-key';
    const PRIVATE_KEY_OPTION = 'tidio-one-private-key';
    const ASYNC_LOAD_OPTION = 'tidio-async-load';
    const CLEAR_ACCOUNT_DATA_ACTION = 'tidio-chat-reset';
    const TIDIO_PLUGIN_NAME = 'tidio-live-chat';
    const TOGGLE_ASYNC_ACTION = 'tidio-chat-toggle-async';

    public function __construct()
    {
        if (!empty($_GET['tidio_chat_version'])) {
            echo TIDIOCHAT_VERSION;
            exit;
        }

        /* Before add link to menu - check is user trying to unninstal */
        if (is_admin() && current_user_can('activate_plugins') && !empty($_GET['tidio_one_clear_cache'])) {
            delete_option(TidioLiveChat::PUBLIC_KEY_OPTION);
            delete_option(TidioLiveChat::PRIVATE_KEY_OPTION);
        }

        if (get_option(TidioLiveChat::PUBLIC_KEY_OPTION)) {
            add_action('admin_footer', array($this, 'adminJS'));
        }

        if (!is_admin()) {
            if (get_option(TidioLiveChat::ASYNC_LOAD_OPTION)) {
                add_action('wp_footer', array($this, 'enqueueScriptsAsync'), PHP_INT_MAX);
            } else {
                add_action('wp_enqueue_scripts', array($this, 'enqueueScriptsSync'), 1000);
            }
        } else if (current_user_can('activate_plugins')) {
            add_action('admin_menu', array($this, 'addAdminMenuLink'));
            add_action('admin_enqueue_scripts', array($this, 'enqueueAdminScripts'));

            add_action('wp_ajax_tidio_chat_save_keys', array($this, 'ajaxTidioChatSaveKeys'));
            add_action('wp_ajax_get_project_keys', array($this, 'ajaxGetProjectKeys'));
            add_action('wp_ajax_get_private_key', array($this, 'ajaxGetPrivateKey'));

            add_action('admin_post_' . TidioLiveChat::CLEAR_ACCOUNT_DATA_ACTION . '', array($this, 'uninstall'));
            add_action('admin_post_' . TidioLiveChat::TOGGLE_ASYNC_ACTION . '', array($this, 'toggleAsync'));

            add_filter('plugin_action_links', array($this, 'pluginActionLinks'), 10, 2);
        }
    }

    public static function activate()
    {
        update_option(TidioLiveChat::ASYNC_LOAD_OPTION, true);
    }

    public static function ajaxGetPrivateKey()
    {
        $privateKey = TidioLiveChat::getPrivateKey();
        if (!$privateKey || $privateKey == 'false') {
            echo 'error';
            exit();
        }
        echo TidioLiveChat::getRedirectUrl($privateKey);
        exit();
    }

    public static function getPrivateKey()
    {
        TidioLiveChat::syncPrivateKey();

        $privateKey = get_option(TidioLiveChat::PRIVATE_KEY_OPTION);

        if ($privateKey) {
            return $privateKey;
        }

        try {
            $data = TidioLiveChat::getContent(TidioLiveChat::getAccessUrl());
        } catch (Exception $e) {
            $data = null;
        }
        //
        if (!$data) {
            update_option(TidioLiveChat::PRIVATE_KEY_OPTION, 'false');
            return false;
        }

        @$data = json_decode($data, true);
        if (!$data || !$data['status']) {
            update_option(TidioLiveChat::PRIVATE_KEY_OPTION, 'false');
            return false;
        }

        update_option(TidioLiveChat::PRIVATE_KEY_OPTION, $data['value']['private_key']);
        update_option(TidioLiveChat::PUBLIC_KEY_OPTION, $data['value']['public_key']);
        update_option(TidioLiveChat::ASYNC_LOAD_OPTION, true);

        return $data['value']['private_key'];
    }

    public static function syncPrivateKey()
    {
        if (get_option(TidioLiveChat::PUBLIC_KEY_OPTION)) {
            return false;
        }

        $publicKey = get_option('tidio-chat-external-public-key');
        $privateKey = get_option('tidio-chat-external-private-key');

        if (!$publicKey || !$privateKey) {
            return false;
        }

        // sync old variables with new one

        update_option(TidioLiveChat::PUBLIC_KEY_OPTION, $publicKey);
        update_option(TidioLiveChat::PRIVATE_KEY_OPTION, $privateKey);

        return true;
    }

    public static function getContent($url)
    {

        if (function_exists('curl_version')) { // load trought curl
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $url);

            $data = curl_exec($ch);
            curl_close($ch);

            return $data;
        } else { // load trought file get contents
            return file_get_contents($url);
        }
    }

    public static function getAccessUrl()
    {
        return TidioLiveChat::API_URL . '/access/external/create?url=' . urlencode(site_url()) . '&platform=wordpress&email=' . urlencode(get_option('admin_email')) . '&_ip=' . $_SERVER['REMOTE_ADDR'];
    }

    public static function getRedirectUrl($privateKey)
    {
        return TidioLiveChat::CHAT_URL . '/access?' . http_build_query(
                array(
                    'privateKey' => $privateKey,
                    'utm_source' => 'platform',
                    'utm_medium' => 'wordpress',
                    'tour_default_email' => get_option('admin_email'),
                )
            );
    }

    public function pluginActionLinks($links, $file)
    {
        if (strpos($file, basename(__FILE__)) !== false) {
            if (get_option(TidioLiveChat::PRIVATE_KEY_OPTION)) {
                $links[] = '<a href="' . admin_url('admin-post.php') . '?action=' . TidioLiveChat::CLEAR_ACCOUNT_DATA_ACTION . '">' . esc_html__('Clear Account Data',
                        TidioLiveChat::TIDIO_PLUGIN_NAME) . '</a>';
                if (get_option(TidioLiveChat::ASYNC_LOAD_OPTION)) {
                    $toggleAsyncLabel = '✓';
                    $onclickPart = 'onclick="return confirm(\'Disabling asynchronous loading of the chat widget may affect the page loading time of your website. Are you sure you want to disable the asynchronous loading?\');"';
                } else {
                    $toggleAsyncLabel = '✘';
                    $onclickPart = '';
                }
                $links[] = '<a href="' . admin_url('admin-post.php') . '?action=' . TidioLiveChat::TOGGLE_ASYNC_ACTION . '" ' . $onclickPart . '>' . esc_html__($toggleAsyncLabel . ' Asynchronous loading',
                        TidioLiveChat::TIDIO_PLUGIN_NAME) . '</a>';
            }
        }

        return $links;
    }

    public function toggleAsync()
    {
        update_option(TidioLiveChat::ASYNC_LOAD_OPTION, !get_option(TidioLiveChat::ASYNC_LOAD_OPTION));
        wp_redirect(admin_url('plugins.php'));
        die();
    }

    public function ajaxGetProjectKeys()
    {
        update_option(TidioLiveChat::PUBLIC_KEY_OPTION, $_POST['public_key']);
        update_option(TidioLiveChat::PRIVATE_KEY_OPTION, $_POST['private_key']);
        echo TidioLiveChat::getRedirectUrl($_POST['private_key']);
        exit();
    }

    public function ajaxTidioChatSaveKeys()
    {
        if (!is_admin()) {
            exit;
        }

        if (empty($_POST['private_key']) || empty($_POST['public_key'])) {
            exit;
        }

        update_option(TidioLiveChat::PUBLIC_KEY_OPTION, $_POST['public_key']);
        update_option(TidioLiveChat::PRIVATE_KEY_OPTION, $_POST['private_key']);

        echo '1';
        exit;
    }

    public function enqueueScriptsAsync()
    {
        $publicKey = TidioLiveChat::getPublicKey();
        $widgetUrl = TidioLiveChat::SCRIPT_URL . $publicKey . '.js';
        $asyncScript = <<<SRC
<script type='text/javascript'>
document.tidioChatCode = "$publicKey";
(function() {
  function asyncLoad() {
    var tidioScript = document.createElement("script");
    tidioScript.type = "text/javascript";
    tidioScript.async = true;
    tidioScript.src = "{$widgetUrl}";
    document.body.appendChild(tidioScript);
  }
  if (window.attachEvent) {
    window.attachEvent("onload", asyncLoad);
  } else {
    window.addEventListener("load", asyncLoad, false);
  }
})();
</script>
SRC;
        echo $asyncScript;
    }

    public static function getPublicKey()
    {
        $publicKey = get_option(TidioLiveChat::PUBLIC_KEY_OPTION);

        if ($publicKey) {
            return $publicKey;
        }

        TidioLiveChat::getPrivateKey();

        return get_option(TidioLiveChat::PUBLIC_KEY_OPTION);
    }

    public function enqueueScriptsSync()
    {
        wp_enqueue_script('tidio-chat', TidioLiveChat::SCRIPT_URL . TidioLiveChat::getPublicKey() . '.js', array(),
            TIDIOCHAT_VERSION,
            true);
        wp_add_inline_script('tidio-chat', 'document.tidioChatCode = "' . TidioLiveChat::getPublicKey() . '";',
            'before');
    }

    public function enqueueAdminScripts()
    {
        wp_enqueue_script('tidio-chat-admin', plugins_url('media/js/options.js', __FILE__), array(), TIDIOCHAT_VERSION,
            true);
        wp_enqueue_style('tidio-chat-admin-style', plugins_url('media/css/options.css', __FILE__), array(),
            TIDIOCHAT_VERSION);
    }

    public function adminJS()
    {
        $privateKey = TidioLiveChat::getPrivateKey();
        $redirectUrl = '';

        if ($privateKey && $privateKey != 'false') {
            $redirectUrl = TidioLiveChat::getRedirectUrl($privateKey);
        } else {
            $redirectUrl = admin_url('admin-ajax.php?action=tidio_chat_redirect');
        }

        echo "<script>jQuery('a[href=\"admin.php?page=tidio-chat\"]').attr('href', '" . $redirectUrl . "').attr('target', '_blank') </script>";
    }

    public function addAdminMenuLink()
    {
        add_menu_page(
            'Tidio Chat', 'Tidio Chat', 'manage_options', 'tidio-chat', array($this, 'addAdminPage'),
            content_url() . '/plugins/' . TidioLiveChat::TIDIO_PLUGIN_NAME . '/media/img/icon.png'
        );
    }

    public function addAdminPage()
    {
        // Set class property
        $dir = plugin_dir_path(__FILE__);
        include $dir . 'options.php';
    }

    public function uninstall()
    {
        delete_option(TidioLiveChat::PUBLIC_KEY_OPTION);
        delete_option(TidioLiveChat::PRIVATE_KEY_OPTION);
        delete_option(TidioLiveChat::ASYNC_LOAD_OPTION);
        wp_redirect(admin_url('plugins.php'));
        die();
    }
}

add_action('init', 'initialize_tidio');

function initialize_tidio()
{
    $tidioLiveChat = new TidioLiveChat();
}

register_activation_hook(__FILE__, array('TidioLiveChat', 'activate'));
