<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns#" lang="es">
	<head>
		<meta charset="utf-8">
		<title><?php bloginfo('name'); ?></title>
		<!-- Sets initial viewport load and disables zooming -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- SEO -->
		<meta name="keywords" content="">
		<meta name="description" content="<?php bloginfo('description'); ?>">
		<!-- Meta robots -->
		<meta name="robots" content="index, follow" />
		<meta name="googlebot" content="index, follow" />
		<!-- Favicon -->
		<link rel="icon" type="image/png" href="<?php echo THEMEPATH; ?>favicon/favicon-32x32.png" sizes="32x32" />
		<link rel="icon" type="image/png" href="<?php echo THEMEPATH; ?>favicon/favicon-16x16.png" sizes="16x16" />
		<!-- Facebook, Twitter metas -->
		<meta property="og:title" content="<?php bloginfo('name'); ?>" />
		<meta property="og:type" content="website" />
		<meta property="og:url" content="<?php echo site_url(); ?>" />
		<meta property="og:image" content="<?php echo THEMEPATH; ?>images/share.png">
		<meta property="og:description" content="<?php bloginfo('description'); ?>" />
		<meta name="twitter:description" content="<?php bloginfo('description'); ?>" />
		<meta name="twitter:image" content="<?php echo THEMEPATH; ?>images/share.png" />
		<meta name="twitter:title" content="<?php bloginfo('name'); ?>" />
		<meta property="og:image:width" content="210" />
		<meta property="og:image:height" content="110" />
		<meta property="fb:app_id" content="" />
		<meta name="twitter:card" content="summary" />
		<meta name="twitter:site" content="@" />

		<!-- Google+ -->
		<link rel="publisher" href="https://plus.google.com/+">

		<!-- Compatibility -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta http-equiv="cleartype" content="on">

		<!-- Google font(s) -->
		<link href="https://fonts.googleapis.com/css?family=Karla:400,700" rel="stylesheet">

		<!--Style-->
		<link type="text/css" rel="stylesheet" href="<?php echo THEMEPATH; ?>stylesheets/styles.css" media="screen,projection, print" />

		<!-- Canonical URL -->
		<link rel="canonical" href="<?php echo site_url(); ?>" />

		<!-- Sitemap Google Verify -->
		<meta name="google-site-verification" content="Eysra-tg4-RcHttf6fx1cXPy2TolrSOr6awUAv36bdc" />

		<!-- Noscript -->
		<noscript>Tu navegador no soporta JavaScript!</noscript>
		<?php wp_head(); ?>

		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-139661150-1"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());

		  gtag('config', 'UA-139661150-1');
		</script>
	</head>
	<body class="<?php if (is_page('cuenta')): echo 'vyarte_cuenta'; elseif (is_shop()): echo 'vyarte_tienda'; endif ?>">
		<?php if (is_page('contactanos')) {
			/* Modal Contacto enviado */
			include (TEMPLATEPATH . '/template/notice/contacto-enviado.php');
		} ?>
		<header class="js-header row">
			<nav class="container">
				<h1 class="hide"><?php bloginfo('name'); ?></h1>
				<a href="<?php echo SITEURL; ?>"><img src="<?php echo THEMEPATH; ?>images/identidad/logo.png"></a>
				<em id="btn-open-nav" class="icon-menu hide-on-med-and-up"></em>
				<ul itemscope>
					<em id="btn-close-nav" class="icon-close hide-on-med-and-up"></em>
					<?php
						$menu_name = 'top_menu';

						if (( $locations = get_nav_menu_locations()) && isset( $locations[ $menu_name ])) {
							$menu = wp_get_nav_menu_object( $locations[ $menu_name ]);
							$menu_items = wp_get_nav_menu_items( $menu->term_id );
							$menu_list = '';
							foreach ( (array) $menu_items as $key => $menu_item) {

								$url 				= $menu_item->url;
								$title 				= $menu_item->title;
								$class 				= esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $menu_item->classes ), $menu_item) ) );
								$description		= $menu_item->description;

								$currentPage 		= '';
								if ($description != '') {
									if ($description === 'inicio' && is_front_page()) {
										$currentPage	='active';
									}
									if (is_page($description)) {
										$currentPage	='active';
									}
									if ($description === 'tienda' && is_shop()) {
										$currentPage	='active';
									}							
								}

								if (is_product_category('sublimacion-y-serigrafia')) {
									$isCatSublimacion 	= 'active';
									$isCatDiseno 	= '';
								} else if (is_product_category('diseno-grafico')) {
									$isCatDiseno 	= 'active';
									$isCatSublimacion 	= '';
								} else {
									$isCatSublimacion 	= '';
									$isCatDiseno 	= '';
								}

								/*Eliminar link servicios*/
								if ($title === 'Servicios') { 
									if (is_product_category('sublimacion-y-serigrafia') || is_product_category('diseno-grafico')){
										$currentPage	 	= 'active';
									}
									$menu_list .='<li itemprop="actionOption" class="' . $class . '"><p class="customLink ' . $currentPage . '">' . $title . '</p>';
									$menu_list .='<ul><li itemprop="actionOption"><a href="' . SITEURL . 'sublimacion-y-serigrafia/" class="' . $isCatSublimacion . '">Sublimacion y serigrafía</a></li>';
									$menu_list .='<li itemprop="actionOption"><a href="' . SITEURL . 'diseno-grafico/" class="' . $isCatDiseno . '">Diseño gráfico</a></li>';
									$menu_list .='</ul></li>';									
								} else {
									$menu_list .='<li itemprop="actionOption" class="' . $class . '"><a href="' . $url . '" class="' . $currentPage . '">' . $title . '</a></li>';	
								}

							}
						}
						echo $menu_list;
					?>
					<div class="icons-nav">
						<a href="https://www.instagram.com/vyarte_publicidad/?hl=es-la" target="_blank"><em class="icon-instagram-filled margin-left-10"></em></a>			
						<a href="https://www.facebook.com/vyartepublicidad/" target="_blank"><em class="icon-facebook-rect"></em></a>			
						<a href="https://www.youtube.com/channel/UCz9YPAPLrs51s74ZkaS48Nw" target="_blank"><em class="icon-youtube"></em></a>			
						<a href="https://wa.me/5215518339080" target="_blank" class="margin-right-10"><em class="icon-whatsapp"></em></a>			
						<a href="<?php echo SITEURL; ?>carrito"><em class="icon-basket"><span><?php echo WC()->cart->get_cart_contents_count(); ?></span></a></em>
						<a href="<?php echo SITEURL; ?>cuenta"><em class="icon-user"></em></a>
						<p id="linkSearchProduct" class="customLink"><em class="icon-search"></em></p>
					</div>
					<div class="searchProduct">
						<?php echo do_shortcode( '[aws_search_form]' ); ?>
					</div>
				</ul>
			</nav>
		</header>
		<div class="[ main-body ]">