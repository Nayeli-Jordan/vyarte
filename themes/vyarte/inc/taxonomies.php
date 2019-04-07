<?php


// TAXONOMIES ////////////////////////////////////////////////////////////////////////
add_action( 'init', 'custom_taxonomies_callback', 0 );
function custom_taxonomies_callback(){

	// Categoría pregunta
	if( ! taxonomy_exists('cat_faq')){

		$labels = array(
			'name'              => 'Categoría faq',
			'singular_name'     => 'Categoría faq',
			'search_items'      => 'Buscar',
			'all_items'         => 'Todos',
			'edit_item'         => 'Editar Categoría',
			'update_item'       => 'Actualizar Categoría',
			'add_new_item'      => 'Nueva Categoría',
			'menu_name'         => 'Categoría faq'
		);
		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'cat_faq' ),
		);

		register_taxonomy( 'cat_faq', 'vy_faqs', $args );
	}	

	wp_insert_term( 'Serigrafía y sublimación', 'cat_faq' );
	wp_insert_term( 'Diseño gráfico', 'cat_faq' );

}