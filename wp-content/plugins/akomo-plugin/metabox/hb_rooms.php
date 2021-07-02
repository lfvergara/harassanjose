<?php
return array(
	'title'      => 'Akomo HB Room Setting',
	'id'         => 'akomo_room_testimonials',
	'icon'       => 'el el-cogs',
	'position'   => 'normal',
	'priority'   => 'core',
	'post_types' => array( 'hb_room' ),
	'sections'   => array(
		array(
			'id'     => 'akomo_room_meta_setting',
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
				array(
					'id'    => 'room_rating',
					'type'  => 'select',
					'title' => esc_html__( 'Choose the Rating', 'akomo' ),
					'options'  => array(
						'1' => '1',
						'2' => '2',
						'3' => '3',
						'4' => '4',
						'5' => '5',
					),
					'default'  => '5',
				),
			),
		),
	),
);