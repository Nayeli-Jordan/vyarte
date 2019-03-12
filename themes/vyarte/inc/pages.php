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

	// Aviso de privacidad
	if( ! get_page_by_path('aviso-de-privacidad') ){
		$page = array(
			'post_author' => 1,
			'post_status' => 'publish',
			'post_title'  => 'Aviso de privacidad',
			'post_name'   => 'aviso-de-privacidad',
			'post_type'   => 'page'
		);
		wp_insert_post( $page, true );
	}
	
	// Términos y condiciones
	if( ! get_page_by_path('terminos-y-condiciones') ){
		$page = array(
			'post_author' => 1,
			'post_status' => 'publish',
			'post_title'  => 'Términos y condiciones',
			'post_name'   => 'terminos-y-condiciones',
			'post_type'   => 'page'
		);
		wp_insert_post( $page, true );
	}
	
	// Pregunta frecuentes
	if( ! get_page_by_path('preguntas-frecuentes') ){
		$page = array(
			'post_author' => 1,
			'post_status' => 'publish',
			'post_title'  => 'Pregunta frecuentes',
			'post_name'   => 'preguntas-frecuentes',
			'post_type'   => 'page'
		);
		wp_insert_post( $page, true );
	}
	
	// Alianzas
	if( ! get_page_by_path('alianzas') ){
		$page = array(
			'post_author' => 1,
			'post_status' => 'publish',
			'post_title'  => 'Alianzas',
			'post_name'   => 'alianzas',
			'post_type'   => 'page'
		);
		wp_insert_post( $page, true );
	}
	
	// Envíos y pagos
	if( ! get_page_by_path('envios-y-pagos') ){
		$page = array(
			'post_author' => 1,
			'post_status' => 'publish',
			'post_title'  => 'Envíos y pagos',
			'post_name'   => 'envios-y-pagos',
			'post_type'   => 'page'
		);
		wp_insert_post( $page, true );
	}
	
	// Productos personalizados
	if( ! get_page_by_path('productos-personalizados') ){
		$page = array(
			'post_author' => 1,
			'post_status' => 'publish',
			'post_title'  => 'Productos personalizados',
			'post_name'   => 'productos-personalizados',
			'post_type'   => 'page'
		);
		wp_insert_post( $page, true );
	}

	// Identidad corporativa
	if( ! get_page_by_path('identidad-corporativa') ){
		$page = array(
			'post_author' => 1,
			'post_status' => 'publish',
			'post_title'  => 'Identidad corporativa',
			'post_name'   => 'identidad-corporativa',
			'post_type'   => 'page'
		);
		wp_insert_post( $page, true );
	}	

});