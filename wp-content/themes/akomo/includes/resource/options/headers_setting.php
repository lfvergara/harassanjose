<?php
return array(
	'title'      => esc_html__( 'Header Setting', 'akomo' ),
	'id'         => 'headers_setting',
	'desc'       => '',
	'subsection' => false,
	'fields'     => array(
		array(
			'id'      => 'header_source_type',
			'type'    => 'button_set',
			'title'   => esc_html__( 'Header Source Type', 'akomo' ),
			'options' => array(
				'd' => esc_html__( 'Default', 'akomo' ),
				'e' => esc_html__( 'Elementor', 'akomo' ),
			),
			'default' => 'd',
		),
		array(
			'id'       => 'header_elementor_template',
			'type'     => 'select',
			'title'    => __( 'Template', 'akomo' ),
			'data'     => 'posts',
			'args'     => [
				'post_type' => [ 'elementor_library' ],
				'posts_per_page'	=> -1
			],
			'required' => [ 'header_source_type', '=', 'e' ],
		),
		array(
			'id'       => 'header_style_section_start',
			'type'     => 'section',
			'indent'      => true,
			'title'    => esc_html__( 'Header Settings', 'akomo' ),
			'required' => array( 'header_source_type', '=', 'd' ),
		),
		array(
		    'id'       => 'header_style_settings',
		    'type'     => 'image_select',
		    'title'    => esc_html__( 'Choose Header Styles', 'akomo' ),
		    'subtitle' => esc_html__( 'Choose Header Styles', 'akomo' ),
		    'options'  => array(

			    'header_v1'  => array(
				    'alt' => esc_html__( 'Header Style 1', 'akomo' ),
				    'img' => get_template_directory_uri() . '/assets/images/redux/header/header1.png',
			    ),
			    'header_v2'  => array(
				    'alt' => esc_html__( 'Header Style 2', 'akomo' ),
				    'img' => get_template_directory_uri() . '/assets/images/redux/header/header2.png',
			    ),
				'header_v3'  => array(
				    'alt' => esc_html__( 'Header Style 3', 'akomo' ),
				    'img' => get_template_directory_uri() . '/assets/images/redux/header/header3.png',
			    ),
				'header_v4'  => array(
				    'alt' => esc_html__( 'Header Style 4', 'akomo' ),
				    'img' => get_template_directory_uri() . '/assets/images/redux/header/header4.png',
			    ),
			),
			'required' => array( 'header_source_type', '=', 'd' ),
			'default' => 'header_v1',
	    ),
		array(
			'id'       => 'header_v1_settings_section_start',
			'type'     => 'section',
			'indent'      => true,
			'title'    => esc_html__( 'Header Style One Settings', 'akomo' ),
			'required' => array( 'header_style_settings', '=', 'header_v1' ),
		),
		array(
            'id' => 'header_topbar_v1',
            'type' => 'switch',
            'title' => esc_html__('Enable Topbar', 'akomo'),
            'default' => true,
			'required' => array( 'header_style_settings', '=', 'header_v1' ),
        ),
		array(
		    'id'       => 'phone_no_v1',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Phone Number', 'akomo' ),
		    'desc'     => esc_html__( 'Enter The Phone Number', 'akomo' ),
		    'required' => array( 'header_topbar_v1', '=', true ),
	    ),
		array(
		    'id'       => 'email_address_v1',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Email', 'akomo' ),
		    'desc'     => esc_html__( 'Enter The Email', 'akomo' ),
		    'required' => array( 'header_topbar_v1', '=', true ),
	    ),
		array(
		    'id'       => 'menu_list_v1',
		    'type'     => 'textarea',
		    'title'    => esc_html__( 'Header Topbar Menu List', 'akomo' ),
		    'desc'     => esc_html__( 'Enter The Menu List', 'akomo' ),
		    'required' => array( 'header_topbar_v1', '=', true ),
	    ),
		array(
			'id'    => 'header_v1_social_share',
			'type'  => 'social_media',
			'title' => esc_html__( 'Social Profiles', 'akomo' ),
		    'required' => array( 'header_topbar_v1', '=', true ),
		),
		
		array(
            'id' => 'show_btn_v1',
            'type' => 'switch',
            'title' => esc_html__('Enable Book Now Button', 'akomo'),
            'default' => true,
			'required' => array( 'header_style_settings', '=', 'header_v1' ),
        ),
		array(
		    'id'       => 'btn_title_v1',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Button Title', 'akomo' ),
		    'desc'     => esc_html__( 'Enter The Button Title', 'akomo' ),
		    'required' => array( 'show_btn_v1', '=', true ),
	    ),
		array(
		    'id'       => 'btn_link_v1',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Button Link', 'akomo' ),
		    'desc'     => esc_html__( 'Enter The Button Link', 'akomo' ),
		    'required' => array( 'show_btn_v1', '=', true ),
	    ),
		
		/***********************************************************************
								Header Version 2 Start
		************************************************************************/
		array(
			'id'       => 'header_v2_settings_section_start',
			'type'     => 'section',
			'indent'      => true,
			'title'    => esc_html__( 'Header Style Two Settings', 'akomo' ),
			'required' => array( 'header_style_settings', '=', 'header_v2' ),
		),
		array(
            'id' => 'show_btn_v2',
            'type' => 'switch',
            'title' => esc_html__('Enable Book Now Button', 'akomo'),
            'default' => true,
			'required' => array( 'header_style_settings', '=', 'header_v2' ),
        ),
		array(
		    'id'       => 'btn_title_v2',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Button Title', 'akomo' ),
		    'desc'     => esc_html__( 'Enter The Button Title', 'akomo' ),
		    'required' => array( 'show_btn_v2', '=', true ),
	    ),
		array(
		    'id'       => 'btn_link_v2',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Button Link', 'akomo' ),
		    'desc'     => esc_html__( 'Enter The Button Link', 'akomo' ),
		    'required' => array( 'show_btn_v2', '=', true ),
	    ),
		
		/***********************************************************************
								Header Version 3 Start
		************************************************************************/
		array(
			'id'       => 'header_v3_settings_section_start',
			'type'     => 'section',
			'indent'      => true,
			'title'    => esc_html__( 'Header Style Three Settings', 'akomo' ),
			'required' => array( 'header_style_settings', '=', 'header_v3' ),
		),
		array(
            'id' => 'show_btn_v3',
            'type' => 'switch',
            'title' => esc_html__('Enable Book Now Button', 'akomo'),
            'default' => true,
			'required' => array( 'header_style_settings', '=', 'header_v3' ),
        ),
		array(
		    'id'       => 'btn_title_v3',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Button Title', 'akomo' ),
		    'desc'     => esc_html__( 'Enter The Button Title', 'akomo' ),
		    'required' => array( 'show_btn_v3', '=', true ),
	    ),
		array(
		    'id'       => 'btn_link_v3',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Button Link', 'akomo' ),
		    'desc'     => esc_html__( 'Enter The Button Link', 'akomo' ),
		    'required' => array( 'show_btn_v3', '=', true ),
	    ),
		
		/***********************************************************************
								Header Version 4 Start
		************************************************************************/
		array(
			'id'       => 'header_v4_settings_section_start',
			'type'     => 'section',
			'indent'      => true,
			'title'    => esc_html__( 'Header Style Four Settings', 'akomo' ),
			'required' => array( 'header_style_settings', '=', 'header_v4' ),
		),
		array(
            'id' => 'show_btn_v4',
            'type' => 'switch',
            'title' => esc_html__('Enable Book Now Button', 'akomo'),
            'default' => true,
			'required' => array( 'header_style_settings', '=', 'header_v4' ),
        ),
		array(
		    'id'       => 'btn_title_v4',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Button Title', 'akomo' ),
		    'desc'     => esc_html__( 'Enter The Button Title', 'akomo' ),
		    'required' => array( 'show_btn_v4', '=', true ),
	    ),
		array(
		    'id'       => 'btn_link_v4',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Button Link', 'akomo' ),
		    'desc'     => esc_html__( 'Enter The Button Link', 'akomo' ),
		    'required' => array( 'show_btn_v4', '=', true ),
	    ),
		array(
			'id'       => 'header_style_section_end',
			'type'     => 'section',
			'indent'      => false,
			'required' => [ 'header_source_type', '=', 'd' ],
		),
	),
);
