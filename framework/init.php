<?php
/**
 * Loads WP Framework and initialises the framework.
 *
 * {File Description}
 *
 * @link http://devpress.com/codex/wpframework/
 *
 * @package WP Framework
 * @subpackage Core
 */

define( 'WPF_VERSION', '0.5' );

// Load WPF files
require_once( TEMPLATEPATH . '/framework/core.php' );
require_once( TEMPLATEPATH . '/framework/functions.php' );
require_once( TEMPLATEPATH . '/framework/classes.php' );
require_once( TEMPLATEPATH . '/framework/options.php' );
require_once( TEMPLATEPATH . '/framework/template-tags.php' );

require_once( TEMPLATEPATH . '/framework/class.wpf-template-tags.php' );
require_once( TEMPLATEPATH . '/framework/class.wpf.php' );
require_once( TEMPLATEPATH . '/framework/class.wpf-admin.php' );
require_once( TEMPLATEPATH . '/framework/class.wpf-admin-metabox.php' );
require_once( TEMPLATEPATH . '/framework/class.wpf-theme-options.php' );
require_once( TEMPLATEPATH . '/framework/semantic-markup.php' );
require_once( TEMPLATEPATH . '/framework/media.php' );

// Default constants
wpf_initial_constants();

// Overridable templating constants
wpf_templating_constants();

// Place your custom code (actions/filters/classes) in custom-functions.php and it will be loaded before anything else.
get_template_part( 'custom-functions' );

// Registers the theme backbone class.
wpf_register_class( 'theme', 'WPF' );
wpf_register_admin_page( 'options', 'WPF_Theme_Options' );

/**
 * WP Framework is fully loaded and is ready to start initalizing
 * various APIs. This is a good time to hook into WPF to override registered classes.
 */
do_action( 'wpf_init' );

// Load all autoload classes
add_action( 'after_setup_theme', 'wpf_autoload_classes' );

// Load all contextual classes
add_action( 'wp', 'wpf_load_contextual_classes' );

// Load admin pages
add_action( 'admin_menu', 'wpf_load_admin_pages', 100 );

/**
 * WP Framework theme object
 * @global object $wpf_theme
 * @since 1.0
 */
$wpf_theme =& WPF();

/**
 * This hook is fired once WP Framework is fully loaded and instantiated.
 */
do_action( 'wpf_loaded' );