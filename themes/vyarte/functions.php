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
/*require_once( 'inc/taxonomies.php' );*/

/*------------------------------------*\
	#GENERAL FUNCTIONS
\*------------------------------------*/

/**
* Enqueue frontend scripts and styles
**/
add_action( 'wp_enqueue_scripts', function(){
 
	wp_enqueue_script( 'jquery', 'https://code.jquery.com/jquery-3.2.1.min.js', array(''), '2.1.1', true );
	wp_enqueue_script( 'cycle_js', JSPATH.'jquery.cicle2.min.js', array(), '', true );
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

//Delimitar número palabras excerpt
function custom_excerpt_length( $length ) {
	return 30;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


/**
* Optimización
*/

// REMOVE WP EMOJI
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );


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

//Cambiar texto btn´s
add_filter( 'woocommerce_product_single_add_to_cart_text', 'woo_custom_cart_button_text' );
add_filter( 'woocommerce_product_add_to_cart_text', 'woo_custom_cart_button_text' );
 
function woo_custom_cart_button_text() {
	return __( 'Comprar', 'woocommerce' );
}

//Hook orden
/* Products */
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
/*Single*/
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
add_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 5 );
/*Shop - Archive*/
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );


/**
* CUSTOM FUNCTIONS
*/