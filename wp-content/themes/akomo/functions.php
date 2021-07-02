<?php

require_once get_template_directory() . '/includes/loader.php';

add_action( 'after_setup_theme', 'akomo_setup_theme' );
add_action( 'after_setup_theme', 'akomo_load_default_hooks' );


function akomo_setup_theme() {

	load_theme_textdomain( 'akomo', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-header' );
	add_theme_support( 'custom-background' );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-lightbox' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'editor-styles' );
    
	// Set the default content width.
	$GLOBALS['content_width'] = 525;
	
	/*---------- Register image sizes ----------*/
	
	//Register image sizes
	add_image_size( 'akomo_250x350', 250, 350, true ); //'akomo_250x350 Testimonials V1'
	add_image_size( 'akomo_450x559', 450, 559, true ); //'akomo_450x559 Testimonials V2'
	add_image_size( 'akomo_384x450', 384, 450, true ); //'akomo_384x450 Our Projects V1'
	add_image_size( 'akomo_500x500', 500,500, true ); //'akomo_500x500 Testimonials V3'
	add_image_size( 'akomo_100x100', 100, 100, true ); //'akomo_100x100 Testimonials V3'
	add_image_size( 'akomo_450x600', 450, 600, true ); //'akomo_450x600 Our Projects V3'
	add_image_size( 'akomo_370x250', 370, 250, true ); //'akomo_370x250 Latest News V3'
	add_image_size( 'akomo_80x80', 80,80, true ); //'akomo_80x80 Testimonials V4'
	add_image_size( 'akomo_370x300', 370,300, true ); //'akomo_370x300 Latest News V4'
	add_image_size( 'akomo_400x600', 400,600, true ); //'akomo_400x600 Our Room V2'
	add_image_size( 'akomo_400x285', 400,285, true ); //'akomo_400x285 Our Room V2'
	add_image_size( 'akomo_371x300', 371,300, true ); //'akomo_371x300 Blog Grid View'
	add_image_size( 'akomo_1170x420', 1170,420, true ); //'akomo_1170x420 Our Blog'
	
	
	
	/*---------- Register image sizes ends ----------*/
	
	
	
	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'main_menu' => esc_html__( 'Main Menu', 'akomo' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'      => 250,
		'height'     => 250,
		'flex-width' => true,
	) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, and column width.
 	 */
	add_editor_style();
	add_action( 'admin_init', 'akomo_admin_init', 2000000 );
}

/**
 * [akomo_admin_init]
 *
 * @param  array $data [description]
 *
 * @return [type]       [description]
 */


function akomo_admin_init() {
	remove_action( 'admin_notices', array( 'ReduxFramework', '_admin_notices' ), 99 );
}

/*---------- Sidebar settings ----------*/

/**
 * [akomo_widgets_init]
 *
 * @param  array $data [description]
 *
 * @return [type]       [description]
 */
function akomo_widgets_init() {

	global $wp_registered_sidebars;

	$theme_options = get_theme_mod( 'akomo' . '_options-mods' );

	register_sidebar( array(
		'name'          => esc_html__( 'Default Sidebar', 'akomo' ),
		'id'            => 'default-sidebar',
		'description'   => esc_html__( 'Widgets in this area will be shown on the right-hand side.', 'akomo' ),
		'before_widget' => '<div id="%1$s" class="widget sidebar-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="sidebar-title"><h3>',
		'after_title'   => '</h3></div>',
	) );
	register_sidebar(array(
		'name' => esc_html__('Footer Widget', 'akomo'),
		'id' => 'footer-sidebar',
		'description' => esc_html__('Widgets in this area will be shown in Footer Area.', 'akomo'),
		'before_widget'=>'<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 footer-column"><div id="%1$s" class="footer-widget %2$s">',
		'after_widget'=>'</div></div>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>'
	));
	register_sidebar(array(
	  'name' => esc_html__( 'Blog Listing', 'akomo' ),
	  'id' => 'blog-sidebar',
	  'description' => esc_html__( 'Widgets in this area will be shown on the right-hand side.', 'akomo' ),
	  'before_widget'=>'<div id="%1$s" class="widget sidebar-widget %2$s">',
	  'after_widget'=>'</div>',
	  'before_title' => '<div class="sidebar-title"><h3>',
	  'after_title' => '</h3></div>'
	));
	if ( ! is_object( akomo_WSH() ) ) {
		return;
	}

	$sidebars = akomo_set( $theme_options, 'custom_sidebar_name' );

	foreach ( array_filter( (array) $sidebars ) as $sidebar ) {

		if ( akomo_set( $sidebar, 'topcopy' ) ) {
			continue;
		}

		$name = $sidebar;
		if ( ! $name ) {
			continue;
		}
		$slug = str_replace( ' ', '_', $name );

		register_sidebar( array(
			'name'          => $name,
			'id'            => sanitize_title( $slug ),
			'before_widget' => '<div id="%1$s" class="%2$s widget sidebar-widget">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="sidebar-title"><h3>',
			'after_title'   => '</h3></div>',
		) );
	}

	update_option( 'wp_registered_sidebars', $wp_registered_sidebars );
}

add_action( 'widgets_init', 'akomo_widgets_init' );

/*---------- Sidebar settings ends ----------*/

/*---------- Enqueue Styles and Scripts ----------*/

function akomo_enqueue_scripts() {
	$options = akomo_WSH()->option();
	$header_meta = get_post_meta( get_the_ID(), 'header_style_settings');
		$header_option = $options->get( 'header_style_settings' );
		$header = ( $header_meta ) ? $header_meta['0'] : $header_option;
	
	
    //styles
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.css' );
	wp_enqueue_style( 'flaticon', get_template_directory_uri() . '/assets/css/flaticon.css' );
	wp_enqueue_style( 'fontawesome-all', get_template_directory_uri() . '/assets/css/fontawesome-all.css' );
	wp_enqueue_style( 'animate', get_template_directory_uri() . '/assets/css/animate.css' );
	wp_enqueue_style( 'jquery-ui', get_template_directory_uri() . '/assets/css/jquery-ui.css' );
	wp_enqueue_style( 'swiper', get_template_directory_uri() . '/assets/css/swiper.min.css' );
	wp_enqueue_style( 'owl', get_template_directory_uri() . '/assets/css/owl.css' );
	wp_enqueue_style( 'jquery-fancybox', get_template_directory_uri() . '/assets/css/jquery.fancybox.min.css' );
	wp_enqueue_style( 'akomo-main', get_stylesheet_uri() );
	wp_enqueue_style( 'akomo-main-style', get_template_directory_uri() . '/assets/css/style.css' );
	wp_enqueue_style( 'akomo-custom', get_template_directory_uri() . '/assets/css/custom.css' );
	wp_enqueue_style( 'akomo-responsive', get_template_directory_uri() . '/assets/css/responsive.css' );
	
	
    //scripts
	wp_enqueue_script( 'jquery-ui-core');
	wp_enqueue_script( 'popper', get_template_directory_uri().'/assets/js/popper.min.js', array( 'jquery' ), '2.1.2', true );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri().'/assets/js/bootstrap.min.js', array( 'jquery' ), '2.1.2', true );
	wp_enqueue_script( 'jquery-fancybox', get_template_directory_uri().'/assets/js/jquery.fancybox.js', array( 'jquery' ), '2.1.2', true );
	wp_enqueue_script( 'jquery-ui', get_template_directory_uri().'/assets/js/jquery-ui.js', array( 'jquery' ), '2.1.2', true );
	wp_enqueue_script( 'owl', get_template_directory_uri().'/assets/js/owl.js', array( 'jquery' ), '2.1.2', true );
	wp_enqueue_script( 'appear', get_template_directory_uri().'/assets/js/appear.js', array( 'jquery' ), '2.1.2', true );
	wp_enqueue_script( 'wow', get_template_directory_uri().'/assets/js/wow.js', array( 'jquery' ), '2.1.2', true );
	wp_enqueue_script( 'swiper', get_template_directory_uri().'/assets/js/swiper.min.js', array( 'jquery' ), '2.1.2', true );
	wp_enqueue_script( 'isotope', get_template_directory_uri().'/assets/js/isotope.js', array( 'jquery' ), '2.1.2', true );
	wp_enqueue_script( 'mixitup', get_template_directory_uri().'/assets/js/mixitup.js', array( 'jquery' ), '2.1.2', true );
	wp_enqueue_script( 'akomo-main-script', get_template_directory_uri().'/assets/js/script.js', array(), false, true );
	if( is_singular() ) wp_enqueue_script('comment-reply');
}
add_action( 'wp_enqueue_scripts', 'akomo_enqueue_scripts' );

/*---------- Enqueue styles and scripts ends ----------*/

/*---------- Google fonts ----------*/

function akomo_fonts_url() {
	
	$fonts_url = '';

		$font_families['Lato']      = 'Lato:300,400,700,900';
		$font_families['Dancing-Script']      = 'Dancing Script:400,500,600,700';
		$font_families['Playfair-Display']      = 'Playfair Display:400,500,600,700,800,900';

		$font_families = apply_filters( 'REXAR/includes/classes/header_enqueue/font_families', $font_families );

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$protocol  = is_ssl() ? 'https' : 'http';
		$fonts_url = add_query_arg( $query_args, $protocol . '://fonts.googleapis.com/css' );

		return esc_url_raw($fonts_url);

}

function akomo_theme_styles() {
    wp_enqueue_style( 'akomo-theme-fonts', akomo_fonts_url(), array(), null );
}

add_action( 'wp_enqueue_scripts', 'akomo_theme_styles' );
add_action( 'admin_enqueue_scripts', 'akomo_theme_styles' );

/*---------- Google fonts ends ----------*/

/*---------- More functions ----------*/

// 1) akomo_set function

/**
 * [akomo_set description]
 *
 * @param  array $data [description]
 *
 * @return [type]       [description]
 */
if ( ! function_exists( 'akomo_set' ) ) {
	function akomo_set( $var, $key, $def = '' ) {
		//if( ! $var ) return false;

		if ( is_object( $var ) && isset( $var->$key ) ) {
			return $var->$key;
		} elseif ( is_array( $var ) && isset( $var[ $key ] ) ) {
			return $var[ $key ];
		} elseif ( $def ) {
			return $def;
		} else {
			return false;
		}
	}
}

// 2) akomo_add_editor_styles function

function akomo_add_editor_styles() {
    add_editor_style( 'editor-style.css' );
}
add_action( 'admin_init', 'akomo_add_editor_styles' );

// 3) Add specific CSS class by filter body class.

$options = akomo_WSH()->option(); 
if( akomo_set($options, 'boxed_wrapper') ){

add_filter( 'body_class', function( $classes ) {
    $classes[] = 'boxed_wrapper';
    return $classes;
} );
}
