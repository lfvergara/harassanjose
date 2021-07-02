<?php
/**
 * Theme config file.
 *
 * @package AKOMO
 * @author  YogsThemes
 * @version 1.0
 * changed
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Restricted' );
}

$config = array();

$config['default']['akomo_main_header'][] 	= array( 'akomo_preloader', 98 );
$config['default']['akomo_main_header'][] 	= array( 'akomo_main_header_area', 99 );

$config['default']['akomo_main_footer'][] 	= array( 'akomo_preloader', 98 );
$config['default']['akomo_main_footer'][] 	= array( 'akomo_main_footer_area', 99 );

$config['default']['akomo_sidebar'][] 	    = array( 'akomo_sidebar', 99 );

$config['default']['akomo_banner'][] 	    = array( 'akomo_banner', 99 );


return $config;
