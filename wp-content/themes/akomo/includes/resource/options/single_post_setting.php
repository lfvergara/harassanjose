<?php

return array(
	'title'      => esc_html__( 'Single Post Settings', 'akomo' ),
	'id'         => 'single_post_setting',
	'desc'       => '',
	'subsection' => true,
	'fields'     => array(
		array(
			'id'      => 'single_source_type',
			'type'    => 'button_set',
			'title'   => esc_html__( 'Single Post Source Type', 'akomo' ),
			'options' => array(
				'd' => esc_html__( 'Default', 'akomo' ),
				'e' => esc_html__( 'Elementor', 'akomo' ),
			),
			'default' => 'd',
		),

		array(
			'id'       => 'single_default_st',
			'type'     => 'section',
			'title'    => esc_html__( 'Post Default', 'akomo' ),
			'indent'   => true,
			'required' => [ 'single_source_type', '=', 'd' ],
		),
		array(
			'id'      => 'single_post_date',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Date', 'akomo' ),
			'desc'    => esc_html__( 'Enable to show post publish date on posts detail page', 'akomo' ),
			'default' => true,
		),
		array(
			'id'      => 'single_post_author',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Author', 'akomo' ),
			'desc'    => esc_html__( 'Enable to show author on posts detail page', 'akomo' ),
			'default' => true,
		),

		array(
			'id'      => 'single_post_comments',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Comments', 'akomo' ),
			'desc'    => esc_html__( 'Enable to show number of comments on posts single page', 'akomo' ),
			'default' => true,
		),
		array(
			'id'      => 'single_post_tag',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Tags', 'akomo' ),
			'desc'    => esc_html__( 'Enable to show number of Tags on posts single page', 'akomo' ),
			'default' => false,
		),
		array(
			'id'      => 'single_post_author_box',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Author Box', 'akomo' ),
			'desc'    => esc_html__( 'Enable to show author box on post detail page.', 'akomo' ),
			'default' => false,
		),
		array(
			'id'      => 'facebook_sharing',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Facebook Post Share', 'sproperty' ),
			'desc'    => esc_html__( 'Enable to show Post Share to Facebook', 'sproperty' ),
			'default' => false,
		),
		array(
			'id'      => 'twitter_sharing',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Twitter Post Share', 'sproperty' ),
			'desc'    => esc_html__( 'Enable to show Post Share to Twitter', 'sproperty' ),
			'default' => false,
		),
		array(
			'id'      => 'linkedin_sharing',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Linkedin Post Share', 'sproperty' ),
			'desc'    => esc_html__( 'Enable to show Post Share to Linkedin', 'sproperty' ),
			'default' => false,
		),
		array(
			'id'      => 'pinterest_sharing',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Pinterest Post Share', 'sproperty' ),
			'desc'    => esc_html__( 'Enable to show Post Share to Pinterest', 'sproperty' ),
			'default' => false,
		),
		array(
			'id'      => 'reddit_sharing',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Reddit Post Share', 'sproperty' ),
			'desc'    => esc_html__( 'Enable to show Post Share to Reddit', 'sproperty' ),
			'default' => false,
		),
		array(
			'id'      => 'tumblr_sharing',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Tumblr Post Share', 'sproperty' ),
			'desc'    => esc_html__( 'Enable to show Post Share to Tumblr', 'sproperty' ),
			'default' => false,
		),
		array(
			'id'      => 'digg_sharing',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Digg Post Share', 'sproperty' ),
			'desc'    => esc_html__( 'Enable to show Post Share to Digg', 'sproperty' ),
			'default' => false,
		),
		array(
			'id'       => 'single_section_default_ed',
			'type'     => 'section',
			'indent'   => false,
			'required' => [ 'single_source_type', '=', 'd' ],
		),
	),
);





