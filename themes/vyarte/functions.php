<?php 

/**
* Define paths to javascript, styles, theme and site.
**/
define( 'JSPATH', get_stylesheet_directory_uri() . '/js/' );
define( 'THEMEPATH', get_stylesheet_directory_uri() . '/' );
define( 'SITEURL', get_site_url() . '/' );


/*------------------------------------*\
	#SNIPPETS
\*------------------------------------*/
require_once( 'inc/pages.php' );
require_once( 'inc/post-types.php' );
require_once( 'inc/taxonomies.php' );

/*------------------------------------*\
	#GENERAL FUNCTIONS
\*------------------------------------*/

/**
* Enqueue frontend scripts and styles
**/
add_action( 'wp_enqueue_scripts', function(){
 
	wp_enqueue_script( 'jquery', 'https://code.jquery.com/jquery-3.2.1.min.js', array(''), '2.1.1', true );
    wp_enqueue_script( 'vy_parsley', JSPATH.'parsley.min.js', array(), '1.0', true );
	wp_enqueue_script( 'cycle_js', JSPATH.'jquery.cycle2.min.js', array(), '', true );
    //wp_enqueue_script( 'carousel_js', JSPATH.'jquery.cycle2.carousel.min.js', array(), '', true );
	wp_enqueue_script( 'vy_functions', JSPATH.'functions.js', array(), '1.0', true );
 
	wp_localize_script( 'vy_functions', 'siteUrl', SITEURL );
	wp_localize_script( 'vy_functions', 'theme_path', THEMEPATH );
	
	// $is_home = is_front_page() ? "1" : "0";
	// wp_localize_script( 'vy_functions', 'isHome', $is_home );
 
});

/**
* Configuraciones WP
*/

// Agregar css y js al administrador
function load_custom_files_wp_admin() {
        wp_register_style( 'vy_wp_admin_css', THEMEPATH . '/admin/admin-style.css', false, '1.0.0' );
        wp_enqueue_style( 'vy_wp_admin_css' );

        wp_register_script( 'vy_wp_admin_js', THEMEPATH . 'admin/admin-script.js', false, '1.0.0' );
        wp_enqueue_script( 'vy_wp_admin_js' );        
}
add_action( 'admin_enqueue_scripts', 'load_custom_files_wp_admin' );

//Habilitar thumbnail en post
add_theme_support( 'post-thumbnails' ); 

//Habilitar menú (aparece en personalizar)
add_action('after_setup_theme', 'add_top_menu');
function add_top_menu(){
	register_nav_menu('top_menu',__('Top menu'));
	register_nav_menu('footer_menu',__('Footer menu'));
	register_nav_menu('vyarte_menu',__('Vyarte menu'));
}
/*Add class active*/
add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);
function special_nav_class($classes, $item){
     if( in_array('current-menu-item', $classes) ){
             $classes[] = 'active ';
     }
     return $classes;
}


//Delimitar número palabras excerpt
function custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

/*
** Correo SMTP
*/
/* Send mail by SMTP */
add_action( 'phpmailer_init', 'send_smtp_email' );
function send_smtp_email( $phpmailer ) {
    $phpmailer->isSMTP();
    $phpmailer->Host       = SMTP_HOST;
    $phpmailer->SMTPAuth   = SMTP_AUTH;
    $phpmailer->Port       = SMTP_PORT;
    $phpmailer->SMTPSecure = SMTP_SECURE;
    $phpmailer->Username   = SMTP_USERNAME;
    $phpmailer->Password   = SMTP_PASSWORD;
    $phpmailer->From       = SMTP_FROM;
    $phpmailer->FromName   = SMTP_FROMNAME;
}

if ( $GLOBALS['pagenow'] != 'wp-login.php' ) { /* Evitar errores con email recuperar contraseña */
    /* $message wp_mail in html (not text/plain) */
    function transforme_content_type(){
        return "text/html";
    }
    add_filter( 'wp_mail_content_type','transforme_content_type' );    
}


/**
* Optimización
*/

// REMOVE WP EMOJI
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

/* Remove default image sizes here.  */
add_filter( 'intermediate_image_sizes_advanced', 'prefix_remove_default_images' );
function prefix_remove_default_images( $sizes ) {
	unset( $sizes['medium_large']); // 768px
	return $sizes;
}


/**
* SEO y Analitics
**/

//Código Analitics
// function add_google_analytics() {
//     echo '<script src="https://www.google-analytics.com/ga.js" type="text/javascript"></script>';
//     echo '<script type="text/javascript">';
//     echo 'var pageTracker = _gat._getTracker("UA-117075138-1");';
//     echo 'pageTracker._trackPageview();';
//     echo '</script>';
// }
// add_action('wp_footer', 'add_google_analytics');

/* Aplaza el análisis de JavaScript para una carga más rápida */
if(!is_admin()) {
    // Move all JS from header to footer
    remove_action('wp_head', 'wp_print_scripts');
    remove_action('wp_head', 'wp_print_head_scripts', 9);
    remove_action('wp_head', 'wp_enqueue_scripts', 1);
    add_action('wp_footer', 'wp_print_scripts', 5);
    add_action('wp_footer', 'wp_enqueue_scripts', 5);
    add_action('wp_footer', 'wp_print_head_scripts', 5);
}

/**
* SUPPORT WOOCOMMERCE
*/
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
	add_theme_support( 'woocommerce' );
}

/**
 * Modify image width theme support.
 */
function iconic_modify_theme_support() {
    $theme_support = get_theme_support( 'woocommerce' );
    $theme_support = is_array( $theme_support ) ? $theme_support[0] : array();

    $theme_support['thumbnail_image_width'] = 500; 
    $theme_support['single_image_width'] = 500;
    $theme_support['gallery_thumbnail_image_width'] = 500;
    $theme_support['shop_thumbnail_image_width'] = 500;
 
    remove_theme_support( 'woocommerce' );
    add_theme_support( 'woocommerce', $theme_support );
} 
add_action( 'after_setup_theme', 'iconic_modify_theme_support', 10 );


/**
 * Change number of products that are displayed per page (shop page)
 */
add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', 20 );
function new_loop_shop_per_page( $cols ) {
  $cols = 32;
  return $cols;
}

//Cambiar texto btn´s
add_filter( 'woocommerce_product_single_add_to_cart_text', 'woo_custom_cart_button_text' );
add_filter( 'woocommerce_product_add_to_cart_text', 'woo_custom_cart_button_text' );
 
function woo_custom_cart_button_text() {
	return __( 'Comprar', 'woocommerce' );
}


add_filter('gettext',  'translate_text');
add_filter('ngettext',  'translate_text');
 
function translate_text($translated) {
     $translated = str_ireplace('Escritorio',  'Cuenta',  $translated);
     return $translated;
}

//Hook orden
/* Products */
//remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
/*Single*/
//remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
//add_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 5 );
/*Shop - Archive*/
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );




/**
* CUSTOM FUNCTIONS
*/
/*
** Banner Blog
*/
add_action( 'add_meta_boxes', 'banner_custom_metabox' );
function banner_custom_metabox(){
    add_meta_box( 'banner_meta', 'Enlace Banner', 'display_banner_atributos', 'banner', 'advanced', 'default');
}

function display_banner_atributos( $banner ){
    $enlace         = esc_html( get_post_meta( $banner->ID, 'banner_enlace', true ) );
?>
    <table class="vy-custum-fields">
        <tr>
            <th>
                <input type="text" id="banner_enlace" name="banner_enlace" placeholder="URL" value="<?php echo $enlace; ?>" required>
            </th>
        </tr>
    </table>
<?php }

add_action( 'save_post', 'banner_save_metas', 10, 2 );
function banner_save_metas( $idbanner, $banner ){
    if ( $banner->post_type == 'banner' ){
        if ( isset( $_POST['banner_enlace'] ) ){
            update_post_meta( $idbanner, 'banner_enlace', $_POST['banner_enlace'] );
        }
    }
}

/* Redirección formularios */
add_action ('template_redirect', 'custom_redirect_contacto');
function custom_redirect_contacto() {
    if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['btnSubmitContact'] ) ) {
        wp_redirect(site_url('contactanos#contacto-enviado'));
    }
}