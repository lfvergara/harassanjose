<?php
/**
 * Theme functions and definitions.
 */
function akomo_child_enqueue_styles() {

    if ( SCRIPT_DEBUG ) {
        wp_enqueue_style( 'akomo-style' , get_template_directory_uri() . '/style.css' );
    } else {
        wp_enqueue_style( 'akomo-minified-style' , get_template_directory_uri() . '/style.min.css' );
    }

    wp_enqueue_style( 'akomo-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( 'akomo-style' ),
        wp_get_theme()->get('Version')
    );
}

add_action(  'wp_enqueue_scripts', 'akomo_child_enqueue_styles' );