<?php

return array(
	'title'      => esc_html__( 'Footer Setting', 'akomo' ),
	'id'         => 'footer_setting',
	'desc'       => '',
	'subsection' => false,
	'fields'     => array(
		array(
			'id'      => 'footer_source_type',
			'type'    => 'button_set',
			'title'   => esc_html__( 'Footer Source Type', 'akomo' ),
			'options' => array(
				'd' => esc_html__( 'Default', 'akomo' ),
				'e' => esc_html__( 'Elementor', 'akomo' ),
			),
			'default' => 'd',
		),
		array(
			'id'       => 'footer_elementor_template',
			'type'     => 'select',
			'title'    => __( 'Template', 'akomo' ),
			'data'     => 'posts',
			'args'     => [
				'post_type' => [ 'elementor_library' ],
				'posts_per_page'	=> -1
			],
			'required' => [ 'footer_source_type', '=', 'e' ],
		),
		array(
			'id'       => 'footer_style_section_start',
			'type'     => 'section',
			'indent'      => true,
			'title'    => esc_html__( 'Footer Settings', 'akomo' ),
			'required' => array( 'footer_source_type', '=', 'd' ),
		),
		array(
		    'id'       => 'footer_style_settings',
		    'type'     => 'image_select',
		    'title'    => esc_html__( 'Choose Footer Styles', 'akomo' ),
		    'subtitle' => esc_html__( 'Choose Footer Styles', 'akomo' ),
		    'options'  => array(

			    'footer_v1'  => array(
				    'alt' => esc_html__( 'Footer Style 1', 'akomo' ),
				    'img' => get_template_directory_uri() . '/assets/images/redux/footer/footer1.png',
			    ),
				'footer_v2'  => array(
				    'alt' => esc_html__( 'Footer Style 2', 'akomo' ),
				    'img' => get_template_directory_uri() . '/assets/images/redux/footer/footer2.png',
			    ),
			),
			'required' => array( 'footer_source_type', '=', 'd' ),
			'default' => 'footer_v1',
	    ),
		
		
		/***********************************************************************
								Footer Version 1 Start
		************************************************************************/
		array(
			'id'       => 'footer_v1_settings_section_start',
			'type'     => 'section',
			'indent'      => true,
			'title'    => esc_html__( 'Footer Style One Settings', 'akomo' ),
			'required' => array( 'footer_style_settings', '=', 'footer_v1' ),
		),
		array(
			'id'      => 'copyright_text',
			'type'    => 'textarea',
			'title'   => __( 'Copyright Text', 'akomo' ),
			'desc'    => esc_html__( 'Enter the Copyright Text', 'akomo' ),
			'required' => array( 'footer_style_settings', '=', 'footer_v1' ),
		),
		array(
			'id'      => 'footer_menu',
			'type'    => 'textarea',
			'title'   => __( 'Footer Menu html', 'akomo' ),
			'desc'    => esc_html__( 'Enter the raw html', 'akomo' ),
			'default' => '',
			'required' => array( 'footer_style_settings', '=', 'footer_v1' ),
		),
		/***********************************************************************
								Footer Version 2 Start
		************************************************************************/
		array(
			'id'       => 'footer_v2_settings_section_start',
			'type'     => 'section',
			'indent'      => true,
			'title'    => esc_html__( 'Footer Style Two Settings', 'akomo' ),
			'required' => array( 'footer_style_settings', '=', 'footer_v2' ),
		),
		array(
			'id'       => 'footer_bg_image2',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Footer BG Image', 'akomo' ),
			'required' => array( 'footer_style_settings', '=', 'footer_v2' ),
		),
		array(
			'id'      => 'copyright_text2',
			'type'    => 'textarea',
			'title'   => __( 'Copyright Text', 'akomo' ),
			'desc'    => esc_html__( 'Enter the Copyright Text', 'akomo' ),
			'required' => array( 'footer_style_settings', '=', 'footer_v2' ),
		),
		array(
			'id'      => 'footer_menu2',
			'type'    => 'textarea',
			'title'   => __( 'Footer Menu html', 'akomo' ),
			'desc'    => esc_html__( 'Enter the raw html', 'akomo' ),
			'default' => '',
			'required' => array( 'footer_style_settings', '=', 'footer_v2' ),
		),
		array(
			'id'       => 'footer_default_ed',
			'type'     => 'section',
			'indent'   => false,
			'required' => [ 'footer_source_type', '=', 'd' ],
		),
	),
);
