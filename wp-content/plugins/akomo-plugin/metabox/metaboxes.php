<?php
if ( ! function_exists( "akomo_add_metaboxes" ) ) {
	function akomo_add_metaboxes( $metaboxes ) {
		$directories_array = array(
			'page.php',
			'projects.php',
			'service.php',
			'testimonials.php',
			'event.php',
			'hb_rooms.php',
		);
		foreach ( $directories_array as $dir ) {
			$metaboxes[] = require_once( AKOMOPLUGIN_PLUGIN_PATH . '/metabox/' . $dir );
		}

		return $metaboxes;
	}

	add_action( "redux/metaboxes/akomo_options/boxes", "akomo_add_metaboxes" );
}

