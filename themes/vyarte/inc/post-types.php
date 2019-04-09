<?php

// CUSTOM POST TYPES /////////////////////////////////////////////////////////////////


add_action('init', function(){

	// Slider
	$labels = array(
		'name'          => 'Slider',
		'singular_name' => 'Slider',
		'add_new'       => 'Nuevo slider',
		'add_new_item'  => 'Nuevo slider',
		'edit_item'     => 'Editar slider',
		'new_item'      => 'Nuevo slider',
		'all_items'     => 'Slider',
		'view_item'     => 'Ver slider',
		'search_items'  => 'Buscar slider',
		'not_found'     => 'No hay slider',
		'menu_name'     => 'Slider'
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => 'edit.php?post_type=page',
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'slider' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 6,
		'supports'           => array( 'title', 'thumbnail' ),
		'menu_icon' 		 => 'dashicons-admin-users'
	);
	register_post_type( 'slider', $args );	

	// Servicios
	$labels = array(
		'name'          => 'Servicios',
		'singular_name' => 'Servicios',
		'add_new'       => 'Nuevo servicio',
		'add_new_item'  => 'Nuevo servicio',
		'edit_item'     => 'Editar servicio',
		'new_item'      => 'Nuevo servicio',
		'all_items'     => 'Servicios',
		'view_item'     => 'Ver servicio',
		'search_items'  => 'Buscar servicio',
		'not_found'     => 'No hay servicios',
		'menu_name'     => 'Servicios'
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => 'edit.php?post_type=page',
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'servicios' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 6,
		'supports'           => array( 'title', 'thumbnail' ),
		'menu_icon' 		 => 'dashicons-admin-users'
	);
	register_post_type( 'servicios', $args );	

	// Preguntas frecuentes
	$labels = array(
		'name'          => 'Preguntas frecuentes',
		'singular_name' => 'Preguntas frecuentes',
		'add_new'       => 'Nueva pregunta frecuente',
		'add_new_item'  => 'Nueva pregunta frecuente',
		'edit_item'     => 'Editar pregunta frecuente',
		'new_item'      => 'Nueva pregunta frecuente',
		'all_items'     => 'Preguntas frecuentes',
		'view_item'     => 'Ver pregunta frecuente',
		'search_items'  => 'Buscar pregunta frecuente',
		'not_found'     => 'No hay preguntas frecuentes.',
		'menu_name'     => 'Preguntas frecuentes'
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => 'edit.php?post_type=page',
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'vy_faqs' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 6,
		'supports'           => array( 'title', 'editor' ),
		'menu_icon' 		 => 'dashicons-admin-users'
	);
	register_post_type( 'vy_faqs', $args );	

	// Slider
	$labels = array(
		'name'          => 'Banner Blog',
		'singular_name' => 'Banner Blog',
		'add_new'       => 'Nuevo Banner',
		'add_new_item'  => 'Nuevo Banner',
		'edit_item'     => 'Editar Banner',
		'new_item'      => 'Nuevo Banner',
		'all_items'     => 'Banner Blog',
		'view_item'     => 'Ver Banner',
		'search_items'  => 'Buscar Banner',
		'not_found'     => 'No hay Banner',
		'menu_name'     => 'Banner Blog'
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => 'edit.php?post_type=page',
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'banner' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 6,
		'supports'           => array( 'title', 'thumbnail' ),
		'menu_icon' 		 => 'dashicons-admin-users'
	);
	register_post_type( 'banner', $args );

	// Contacto
	$labels = array(
		'name'          => 'Contacto',
		'singular_name' => 'Contacto',
		'add_new'       => 'Nuevo Contacto',
		'add_new_item'  => 'Nuevo Contacto',
		'edit_item'     => 'Editar Contacto',
		'new_item'      => 'Nuevo Contacto',
		'all_items'     => 'Contacto',
		'view_item'     => 'Ver Contacto',
		'search_items'  => 'Buscar Contacto',
		'not_found'     => 'No hay Contacto',
		'menu_name'     => 'Contacto'
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => 'edit.php?post_type=page',
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'vy_contacto' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 6,
		'supports'           => array( 'title', 'editor' ),
		'menu_icon' 		 => 'dashicons-admin-users'
	);
	register_post_type( 'vy_contacto', $args );

	// Trabajo Diseños
	$labels = array(
		'name'          => 'Trabajo Diseño',
		'singular_name' => 'Trabajo Diseño',
		'add_new'       => 'Nuevo Trabajo Diseño',
		'add_new_item'  => 'Nuevo Trabajo Diseño',
		'edit_item'     => 'Editar Trabajo Diseño',
		'new_item'      => 'Nuevo Trabajo Diseño',
		'all_items'     => 'Trabajo Diseño',
		'view_item'     => 'Ver Trabajo Diseño',
		'search_items'  => 'Buscar Trabajo Diseño',
		'not_found'     => 'No hay Trabajo Diseño',
		'menu_name'     => 'Trabajo Diseños'
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => 'edit.php?post_type=page',
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'dg_trabajos' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 6,
		'supports'           => array( 'title', 'thumbnail' ),
		'menu_icon' 		 => 'dashicons-admin-users'
	);
	register_post_type( 'dg_trabajos', $args );

	// Productos personalizados
	$labels = array(
		'name'          => 'Producto',
		'singular_name' => 'Producto',
		'add_new'       => 'Nuevo Producto',
		'add_new_item'  => 'Nuevo Producto',
		'edit_item'     => 'Editar Producto',
		'new_item'      => 'Nuevo Producto',
		'all_items'     => 'Producto',
		'view_item'     => 'Ver Producto',
		'search_items'  => 'Buscar Producto',
		'not_found'     => 'No hay Producto',
		'menu_name'     => 'Productos personalizados'
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'vy_personalizado' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 6,
		'supports'           => array( 'title', 'editor', 'thumbnail' ),
		'menu_icon' 		 => 'dashicons-admin-users'
	);
	register_post_type( 'vy_personalizado', $args );

});