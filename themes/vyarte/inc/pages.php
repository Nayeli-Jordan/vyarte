<?php


// CUSTOM PAGES //////////////////////////////////////////////////////////////////////

add_action('init', function(){

	// Nosotros
	if( ! get_page_by_path('nosotros') ){
		$page = array(
			'post_author' => 1,
			'post_status' => 'publish',
			'post_title'  => 'Nosotros',
			'post_name'   => 'nosotros',
			'post_type'   => 'page'
		);
		wp_insert_post( $page, true );
	}

	// Servicios
	if( ! get_page_by_path('servicios') ){
		$page = array(
			'post_author' => 1,
			'post_status' => 'publish',
			'post_title'  => 'Servicios',
			'post_name'   => 'servicios',
			'post_type'   => 'page'
		);
		wp_insert_post( $page, true );
	}	

	// Blog
	if( ! get_page_by_path('blog') ){
		$page = array(
			'post_author' => 1,
			'post_status' => 'publish',
			'post_title'  => 'Blog',
			'post_name'   => 'blog',
			'post_type'   => 'page'
		);
		wp_insert_post( $page, true );
	}


});