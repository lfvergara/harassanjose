<?php

return array(
	'title'      => esc_html__( '404 Page Settings', 'akomo' ),
	'id'         => '404_setting',
	'desc'       => '',
	'subsection' => true,
	'fields'     => array(
		array(
			'id'      => '404_source_type',
			'type'    => 'button_set',
			'title'   => esc_html__( '404 Source Type', 'akomo' ),
			'options' => array(
				'd' => esc_html__( 'Default', 'akomo' ),
				'e' => esc_html__( 'Elementor', 'akomo' ),
			),
			'default' => 'd',
		),
		array(
			'id'       => '404_elementor_template',
			'type'     => 'select',
			'title'    => __( 'Template', 'akomo' ),
			'data'     => 'posts',
			'args'     => [
				'post_type' => [ 'elementor_library' ],
			],
			'required' => [ '404_source_type', '=', 'e' ],
		),
		array(
			'id'       => '404_default_st',
			'type'     => 'section',
			'title'    => esc_html__( '404 Default', 'akomo' ),
			'indent'   => true,
			'required' => [ '404_source_type', '=', 'd' ],
		),
		array(
			'id'      => '404_page_banner',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Banner', 'akomo' ),
			'desc'    => esc_html__( 'Enable to show banner on blog', 'akomo' ),
			'default' => true,
		),
		array(
			'id'       => '404_banner_title',
			'type'     => 'text',
			'title'    => esc_html__( 'Banner Section Title', 'akomo' ),
			'desc'     => esc_html__( 'Enter the title to show in banner section', 'akomo' ),
			'required' => array( '404_page_banner', '=', true ),
		),
		array(
			'id'       => '404_page_background',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Background Image', 'akomo' ),
			'desc'     => esc_html__( 'Insert background image for banner', 'akomo' ),
			'default'  => '',
			'required' => array( '404_page_banner', '=', true ),
		),
		array(
			'id'    => '404-page_heading',
			'type'  => 'text',
			'title' => esc_html__( '404 Page Heading', 'akomo' ),
			'desc'  => esc_html__( 'Enter 404 section Page Heading that you want to show', 'akomo' ),
		),
		array(
			'id'    => '404-page_title',
			'type'  => 'text',
			'title' => esc_html__( '404 Title', 'akomo' ),
			'desc'  => esc_html__( 'Enter 404 section title that you want to show', 'akomo' ),
		),
		array(
			'id'    => '404-page-text',
			'type'  => 'textarea',
			'title' => esc_html__( '404 Page Description', 'akomo' ),
			'desc'  => esc_html__( 'Enter 404 page description that you want to show.', 'akomo' ),
		),
		array(
			'id'    => 'back_home_btn',
			'type'  => 'switch',
			'title' => esc_html__( 'Show Button', 'akomo' ),
			'desc'  => esc_html__( 'Enable to show back to home button.', 'akomo' ),
			'default'  => true,
		),
		array(
			'id'       => 'back_home_btn_label',
			'type'     => 'text',
			'title'    => esc_html__( 'Button Label', 'akomo' ),
			'desc'     => esc_html__( 'Enter back to home button label that you want to show.', 'akomo' ),
			'default'  => esc_html__( 'Back To Home', 'akomo' ),
			'required' => array( 'back_home_btn', '=', true ),
		),
		array(
			'id'     => '404_post_settings_end',
			'type'   => 'section',
			'indent' => false,
		),
	),
);