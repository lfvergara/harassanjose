<?php

namespace AKOMOPLUGIN\Element;


class Elementor {
	static $widgets = array(
		//Home Page One
		'banner_v1',
		'search_form_v1',
		'about_us',
		'our_rooms_v1',
		'our_packages_v1',
		'our_service_v1',
		'testimonials_v1',
		'video_and_funfacts',
		'latest_news',
		'subscribe_form',
		//Home Page Two
		'banner_v2',
		'our_room_v2',
		'funfacts',
		'our_packages_v2',
		'video_section',
		'testimonials_v2',
		'latest_news_v2',
		'our_project_v1',
		'subscribe_form_v2',
		//Home Page Three
		'banner_v3',
		'about_us_v2',
		'our_room_v3',
		'our_packages_v3',
		'testimonials_v3',
		'our_project_v2',
		'latest_news_v3',
		//Home Page Four
		'banner_v4',
		'about_us_v3',
		'our_room_v4',
		'our_packages_v4',
		'testimonials_v4',
		'latest_news_v4',
		//Inner Pages
		'room_list_view',
		'room_grid_view',
		'blog_grid_view',
		'contact_us'
		
	);

	static function init() {
		add_action( 'elementor/init', array( __CLASS__, 'loader' ) );
		add_action( 'elementor/elements/categories_registered', array( __CLASS__, 'register_cats' ) );
	}

	static function loader() {

		foreach ( self::$widgets as $widget ) {

			$file = AKOMOPLUGIN_PLUGIN_PATH . '/elementor/' . $widget . '.php';
			if ( file_exists( $file ) ) {
				require_once $file;
			}

			add_action( 'elementor/widgets/widgets_registered', array( __CLASS__, 'register' ) );
		}
	}

	static function register( $elemntor ) {
		foreach ( self::$widgets as $widget ) {
			$class = '\\AKOMOPLUGIN\\Element\\' . ucwords( $widget );

			if ( class_exists( $class ) ) {
				$elemntor->register_widget_type( new $class );
			}
		}
	}

	static function register_cats( $elements_manager ) {

		$elements_manager->add_category(
			'akomo',
			[
				'title' => esc_html__( 'Akomo', 'akomo' ),
				'icon'  => 'fa fa-plug',
			]
		);
		$elements_manager->add_category(
			'templatepath',
			[
				'title' => esc_html__( 'Template Path', 'akomo' ),
				'icon'  => 'fa fa-plug',
			]
		);

	}
}

Elementor::init();