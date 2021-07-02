<?php
return array(
	'title'      => 'Akomo Project Setting',
	'id'         => 'akomo_meta_projects',
	'icon'       => 'el el-cogs',
	'position'   => 'normal',
	'priority'   => 'core',
	'post_types' => array( 'project' ),
	'sections'   => array(
		array(
			'id'     => 'akomo_projects_meta_setting',
			'fields' => array(
				array(
					'id'    => 'dimension',
					'type'  => 'select',
					'title' => esc_html__( 'Choose the Extra height', 'akomo' ),
					'options'  => array(
						'extra_height' => esc_html__( 'Extra Height', 'akomo' ),
						'normal_height' => esc_html__( 'Normal Height', 'akomo' ),
					),
					'default'  => 'normal_height',
				),
			),
		),
	),
);