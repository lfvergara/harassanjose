<?php

namespace AKOMOPLUGIN\Inc;


use AKOMOPLUGIN\Inc\Abstracts\Taxonomy;


class Taxonomies extends Taxonomy {


	public static function init() {

		$labels = array(
			'name'              => _x( 'Project Category', 'wpakomo' ),
			'singular_name'     => _x( 'Project Category', 'wpakomo' ),
			'search_items'      => __( 'Search Category', 'wpakomo' ),
			'all_items'         => __( 'All Categories', 'wpakomo' ),
			'parent_item'       => __( 'Parent Category', 'wpakomo' ),
			'parent_item_colon' => __( 'Parent Category:', 'wpakomo' ),
			'edit_item'         => __( 'Edit Category', 'wpakomo' ),
			'update_item'       => __( 'Update Category', 'wpakomo' ),
			'add_new_item'      => __( 'Add New Category', 'wpakomo' ),
			'new_item_name'     => __( 'New Category Name', 'wpakomo' ),
			'menu_name'         => __( 'Project Category', 'wpakomo' ),
		);
		$args   = array(
			'hierarchical'       => true,
			'labels'             => $labels,
			'show_ui'            => true,
			'show_admin_column'  => true,
			'query_var'          => true,
			'public'             => true,
			'publicly_queryable' => true,
			'rewrite'            => array( 'slug' => 'project_cat' ),
		);

		register_taxonomy( 'project_cat', 'project', $args );
		
		//Services Taxonomy Start
		$labels = array(
			'name'              => _x( 'Service Category', 'wpakomo' ),
			'singular_name'     => _x( 'Service Category', 'wpakomo' ),
			'search_items'      => __( 'Search Category', 'wpakomo' ),
			'all_items'         => __( 'All Categories', 'wpakomo' ),
			'parent_item'       => __( 'Parent Category', 'wpakomo' ),
			'parent_item_colon' => __( 'Parent Category:', 'wpakomo' ),
			'edit_item'         => __( 'Edit Category', 'wpakomo' ),
			'update_item'       => __( 'Update Category', 'wpakomo' ),
			'add_new_item'      => __( 'Add New Category', 'wpakomo' ),
			'new_item_name'     => __( 'New Category Name', 'wpakomo' ),
			'menu_name'         => __( 'Service Category', 'wpakomo' ),
		);
		$args   = array(
			'hierarchical'       => true,
			'labels'             => $labels,
			'show_ui'            => true,
			'show_admin_column'  => true,
			'query_var'          => true,
			'public'             => true,
			'publicly_queryable' => true,
			'rewrite'            => array( 'slug' => 'service_cat' ),
		);


		register_taxonomy( 'service_cat', 'service', $args );
		
		//Testimonials Taxonomy Start
		$labels = array(
			'name'              => _x( 'Testimonials Category', 'wpakomo' ),
			'singular_name'     => _x( 'Testimonials Category', 'wpakomo' ),
			'search_items'      => __( 'Search Category', 'wpakomo' ),
			'all_items'         => __( 'All Categories', 'wpakomo' ),
			'parent_item'       => __( 'Parent Category', 'wpakomo' ),
			'parent_item_colon' => __( 'Parent Category:', 'wpakomo' ),
			'edit_item'         => __( 'Edit Category', 'wpakomo' ),
			'update_item'       => __( 'Update Category', 'wpakomo' ),
			'add_new_item'      => __( 'Add New Category', 'wpakomo' ),
			'new_item_name'     => __( 'New Category Name', 'wpakomo' ),
			'menu_name'         => __( 'Testimonials Category', 'wpakomo' ),
		);
		$args   = array(
			'hierarchical'       => true,
			'labels'             => $labels,
			'show_ui'            => true,
			'show_admin_column'  => true,
			'query_var'          => true,
			'public'             => true,
			'publicly_queryable' => true,
			'rewrite'            => array( 'slug' => 'testimonials_cat' ),
		);


		register_taxonomy( 'testimonials_cat', 'testimonials', $args );
		
		
	}
	
}
