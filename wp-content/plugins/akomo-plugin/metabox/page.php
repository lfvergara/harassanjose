<?php
return array(
	'title'      => 'Akomo Setting',
	'id'         => 'akomo_meta',
	'icon'       => 'el el-cogs',
	'position'   => 'normal',
	'priority'   => 'core',
	'post_types' => array( 'page', 'post', 'akomo_team', 'hb_room', 'tribe_events' ),
	'sections'   => array(
		require_once AKOMOPLUGIN_PLUGIN_PATH . '/metabox/header.php',
		require_once AKOMOPLUGIN_PLUGIN_PATH . '/metabox/banner.php',
		require_once AKOMOPLUGIN_PLUGIN_PATH . '/metabox/sidebar.php',
		require_once AKOMOPLUGIN_PLUGIN_PATH . '/metabox/footer.php',
	),
);