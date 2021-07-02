<?php
/**
 * Merlin WP configuration file.
 *
 * @package   Merlin WP
 * @version   @@pkg.version
 * @link      https://merlinwp.com/
 * @author    Rich Tabor, from ThemeBeans.com & the team at ProteusThemes.com
 * @copyright Copyright (c) 2018, Merlin WP of Inventionn LLC
 * @license   Licensed GPLv3 for Open Source Use
 */

if ( ! class_exists( 'Merlin' ) ) {
	return;
}

defined('THEMEKALIA_IMPORT_VENDOR_PATH') || define('THEMEKALIA_IMPORT_VENDOR_PATH', get_template_directory() . '/demo-import/vendor/');

require_once THEMEKALIA_IMPORT_VENDOR_PATH . 'autoload.php';

if ( ! class_exists( '\WP_Importer' ) ) {
	require ABSPATH . '/wp-admin/includes/class-wp-importer.php';
}
require_once get_template_directory() . '/demo-import/importer/WPImporterLogger.php';
require_once get_template_directory() . '/demo-import/importer/WPImporterLoggerCLI.php';
require_once get_template_directory() . '/demo-import/importer/WXRImportInfo.php';
require_once get_template_directory() . '/demo-import/importer/WXRImporter.php';
require_once get_template_directory() . '/demo-import/importer/Importer.php';
/**
 * Set directory locations, text strings, and settings.
 */
$wizard = new Merlin(

	$config = array(
		'directory'            => 'demo-import',
		// Location / directory where Merlin WP is placed in your theme.
		'merlin_url'           => 'demo-import',
		// The wp-admin page slug where Merlin WP loads.
		'parent_slug'          => 'themes.php',
		// The wp-admin parent page slug for the admin menu item.
		'capability'           => 'manage_options',
		// The capability required for this menu to be displayed to the user.
		'child_action_btn_url' => 'https://codex.wordpress.org/child_themes',
		// URL for the 'child-action-link'.
		'dev_mode'             => true,
		// Enable development mode for testing.
		'license_step'         => false,
		// EDD license activation step.
		'license_required'     => false,
		// Require the license activation step.
		'license_help_url'     => '',
		// URL for the 'license-tooltip'.
		'edd_remote_api_url'   => '',
		// EDD_Theme_Updater_Admin remote_api_url.
		'edd_item_name'        => 'Akomo',
		// EDD_Theme_Updater_Admin item_name.
		'edd_theme_slug'       => 'akomo',
		// EDD_Theme_Updater_Admin item_slug.
		'ready_big_button_url' => home_url( '/' ),
		// Link for the big button on the ready step.
	),
	$strings = array(
		'admin-menu'          => esc_html__( 'YogsThemes Import', 'akomo' ),

		/* translators: 1: Title Tag 2: Theme Name 3: Closing Title Tag */
		'title%s%s%s%s'       => esc_html__( '%1$s%2$s Themes &lsaquo; Theme Setup: %3$s%4$s', 'akomo' ),
		'return-to-dashboard' => esc_html__( 'Return to the dashboard', 'akomo' ),
		'ignore'              => esc_html__( 'Disable this wizard', 'akomo' ),

		'btn-skip'                 => esc_html__( 'Skip', 'akomo' ),
		'btn-next'                 => esc_html__( 'Next', 'akomo' ),
		'btn-start'                => esc_html__( 'Start', 'akomo' ),
		'btn-no'                   => esc_html__( 'Cancel', 'akomo' ),
		'btn-plugins-install'      => esc_html__( 'Install', 'akomo' ),
		'btn-child-install'        => esc_html__( 'Install', 'akomo' ),
		'btn-content-install'      => esc_html__( 'Install', 'akomo' ),
		'btn-import'               => esc_html__( 'Import', 'akomo' ),
		'btn-license-activate'     => esc_html__( 'Activate', 'akomo' ),
		'btn-license-skip'         => esc_html__( 'Later', 'akomo' ),

		/* translators: Theme Name */
		'license-header%s'         => esc_html__( 'Activate %s', 'akomo' ),
		/* translators: Theme Name */
		'license-header-success%s' => esc_html__( '%s is Activated', 'akomo' ),
		/* translators: Theme Name */
		'license%s'                => esc_html__( 'Enter your license key to enable remote updates and theme support.', 'akomo' ),
		'license-label'            => esc_html__( 'License key', 'akomo' ),
		'license-success%s'        => esc_html__( 'The theme is already registered, so you can go to the next step!', 'akomo' ),
		'license-json-success%s'   => esc_html__( 'Your theme is activated! Remote updates and theme support are enabled.', 'akomo' ),
		'license-tooltip'          => esc_html__( 'Need help?', 'akomo' ),

		/* translators: Theme Name */
		'welcome-header%s'         => esc_html__( 'Welcome to %s', 'akomo' ),
		'welcome-header-success%s' => esc_html__( 'Hi. Welcome back', 'akomo' ),
		'welcome%s'                => esc_html__( 'This wizard will set up your theme, install plugins, and import content. It is optional & should take only a few minutes.', 'akomo' ),
		'welcome-success%s'        => esc_html__( 'You may have already run this theme setup wizard. If you would like to proceed anyway, click on the "Start" button below.', 'akomo' ),

		'child-header'         => esc_html__( 'Install Child Theme', 'akomo' ),
		'child-header-success' => esc_html__( 'You\'re good to go!', 'akomo' ),
		'child'                => esc_html__( 'Let\'s build & activate a child theme so you may easily make theme changes.', 'akomo' ),
		'child-success%s'      => esc_html__( 'Your child theme has already been installed and is now activated, if it wasn\'t already.', 'akomo' ),
		'child-action-link'    => esc_html__( 'Learn about child themes', 'akomo' ),
		'child-json-success%s' => esc_html__( 'Awesome. Your child theme has already been installed and is now activated.', 'akomo' ),
		'child-json-already%s' => esc_html__( 'Awesome. Your child theme has been created and is now activated.', 'akomo' ),

		'plugins-header'         => esc_html__( 'Install Plugins', 'akomo' ),
		'plugins-header-success' => esc_html__( 'You\'re up to speed!', 'akomo' ),
		'plugins'                => esc_html__( 'Let\'s install some essential WordPress plugins to get your site up to speed.', 'akomo' ),
		'plugins-success%s'      => esc_html__( 'The required WordPress plugins are all installed and up to date. Press "Next" to continue the setup wizard.', 'akomo' ),
		'plugins-action-link'    => esc_html__( 'Advanced', 'akomo' ),

		'import-header'      => esc_html__( 'Import Content', 'akomo' ),
		'import'             => esc_html__( 'Let\'s import content to your website, to help you get familiar with the theme.', 'akomo' ),
		'import-action-link' => esc_html__( 'Advanced', 'akomo' ),

		'ready-header'      => esc_html__( 'All done. Have fun!', 'akomo' ),

		/* translators: Theme Author */
		'ready%s'           => esc_html__( 'Your theme has been all set up. Enjoy your new theme by %s.', 'akomo' ),
		'ready-action-link' => esc_html__( 'Extras', 'akomo' ),
		'ready-big-button'  => esc_html__( 'View your website', 'akomo' ),
		'ready-link-1'      => sprintf( '<a href="%1$s" target="_blank">%2$s</a>', 'https://themeforest.net/user/tonatheme/', esc_html__( '5 Star For Project Akomo', 'akomo' ) ),
		'ready-link-2'      => sprintf( '<a href="%1$s" target="_blank">%2$s</a>', 'https://tonatheme.com/support', esc_html__( 'Get Akomo Theme Support', 'akomo' ) ),
	)
);
