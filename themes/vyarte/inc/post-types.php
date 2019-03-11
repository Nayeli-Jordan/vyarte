<?php

// CUSTOM POST TYPES /////////////////////////////////////////////////////////////////


add_action('init', function(){

	// 
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
		'rewrite'            => array( 'slug' => 'preguntas-frecuentes' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 6,
		'supports'           => array( 'title', 'editor' ),
		'menu_icon' 		 => 'dashicons-admin-users'
	);
	register_post_type( 'preguntas-frecuentes', $args );	

});