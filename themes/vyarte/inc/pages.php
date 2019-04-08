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
	
	// Clientes comerciales
	if( ! get_page_by_path('clientes-comerciales') ){
		$page = array(
			'post_author' => 1,
			'post_status' => 'publish',
			'post_title'  => 'Clientes comerciales',
			'post_name'   => 'clientes-comerciales',
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

	// Contacto
	if( ! get_page_by_path('contactanos') ){
		$page = array(
			'post_author' => 1,
			'post_status' => 'publish',
			'post_title'  => 'Contacto',
			'post_name'   => 'contactanos',
			'post_type'   => 'page'
		);
		wp_insert_post( $page, true );
	}
	// Contacto diseño gráfico
	if( ! get_page_by_path('contacto-diseno') ){
		$page = array(
			'post_author' => 1,
			'post_status' => 'publish',
			'post_title'  => 'Contacto diseño gráfico',
			'post_name'   => 'contacto-diseno',
			'post_type'   => 'page'
		);
		wp_insert_post( $page, true );
	}
	// Contacto cliente comercial
	if( ! get_page_by_path('contacto-cliente') ){
		$page = array(
			'post_author' => 1,
			'post_status' => 'publish',
			'post_title'  => 'Contacto cliente comercial',
			'post_name'   => 'contacto-cliente',
			'post_type'   => 'page'
		);
		wp_insert_post( $page, true );
	}
	
	// Sublimacion y serigrafía
	if( ! get_page_by_path('sublimacion-y-serigrafia') ){
		$page = array(
			'post_author' => 1,
			'post_status' => 'publish',
			'post_title'  => 'Sublimacion y serigrafía',
			'post_name'   => 'sublimacion-y-serigrafia',
			'post_type'   => 'page'
		);
		wp_insert_post( $page, true );
	}	
	// Diseño gráfico
	if( ! get_page_by_path('diseno-grafico') ){
		$page = array(
			'post_author' => 1,
			'post_status' => 'publish',
			'post_title'  => 'Diseño gráfico',
			'post_name'   => 'diseno-grafico',
			'post_type'   => 'page'
		);
		wp_insert_post( $page, true );
	}

	// Personalizar producto
	if( ! get_page_by_path('personalizar-producto') ){
		$page = array(
			'post_author' => 1,
			'post_status' => 'publish',
			'post_title'  => 'Personalizar producto',
			'post_name'   => 'personalizar-producto',
			'post_type'   => 'page'
		);
		wp_insert_post( $page, true );
	}

});