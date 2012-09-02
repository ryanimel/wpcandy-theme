<?php
/**
 * Custom functions and definitions
 *
 * The goal of custom-functions.php is to consolidate all of the
 * functionality for your theme into a class. This allows child themes
 * to extend or completely override functionality for your theme with ease.
 * It's the functional equivalent of being able to override template files
 * from your child themes just by using a file with the same name!
 *
 * If this sounds like crazy-talk, then chances are you probably need a
 * primer on PHP object inheritance. Check out the following link to learn more:
 * @see http://php.net/manual/en/language.oop5.inheritance.php
 *
 * For more information on hooks, actions, and filters, see:
 * http://codex.wordpress.org/Plugin_API.
 *
 * @package WP Framework
 * @subpackage Functions
 */

/**
 * STEP 1: Register your class as the theme class.
 *
 * Registers the "theme" API to the Parent_Theme class.
 * This overrides the base functionality provided by the framework.
 * 
 * The first step to creating your own custom parent theme is to register your
 * class to the WP Framework class API. This involves hooking into 'wpf_init'
 * and calling wpf_register_class(), passing the API you want to
 * override (in this case, 'theme') and the name of your class. Were going to
 * call it Parent_Theme but it could be called anything really.
 */
add_action( 'wpf_init', 'register_parent_theme_classes', 5 );
function register_parent_theme_classes() {
	wpf_register_class( 'wpcandy-theme', 'WPCandy_Theme' );
}

/**
 * STEP 2: Define your theme class and extend the parent class.
 *
 * By extending the WPF class and calling it's constructor method, your class
 * will be provided with several "magic" methods that are automagically called
 * on their respective hook name (i.e. init, after_setup_theme, wp_head).
 * For example, after_setup_theme() sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus
 * custom background, and the like.
 *
 * List of all magic methods provided by WPF:
 * - after_setup_theme
 * - init
 * - wp_loaded
 * - template_redirect
 * - widgets_init
 * - wpf_head
 * - wp_head
 * - admin
 *
 * That's it! You're ready to start to building out your custom theme :D
 *
 * For more information about classes in WP Framework:
 * @link http://devpress.com/codex/wp-framework/classes/
 */
class Parent_Theme extends WPF {
	/**
	 * The constructor method. This method calls the parent WPF
	 * construct method and fires off all the internal hooks needed
	 * for the theme to work.
	 *
	 * FYI: This function fires after the 'setup_theme' action.
	 *
	 * You can pass the following parameters to the WPF() method:
	 * - content_width  : Pass a integer value for the global $content_width
	 *                    used to set the width of images and content.
	 * - textdomain     : Pass a string value for the textdomain used for your theme. @see t()
	 * - excerpt_length : Pass an integer value for the lenth used in
	 *                    the_excerpt() function.
	 * - strings        : Pass an array of strings for use throughout your theme. @see wpf_default_strings().
	 */
	function Parent_Theme() {
		parent::WPF( array(
			// Set the content width based on the theme's design and stylesheet.
			'content_width' => 600,
			// Sets the text domain for your theme. Use the t() in your template files.
			'textdomain' => get_stylesheet(),
		) );
	}

	/**
	 * This is a magic method that WPF calls on the 'after_setup_theme' action.
	 *
	 * This is where you would probably want to start doing theme stuff,
	 * adding actions/filters and the like.
	 *
	 * Theme Features is a set of features defined by theme authors that
	 * allows a theme to register support of a certain feature. By default
	 * WordPress comes bundled with the following features:
	 * - Post Thumbnails		: A featured image used to represent a post type.
	 * - Navigation Menus		: Enable support for the WordPress Menus system in your theme.
	 * - Widgets				: Drag and droppable sections for widgetized areas in your theme.
	 * - Post Formats			: Differentiate the presentation of your post types.
	 * - Custom Backgrounds		: Manage your theme's background from the WordPress admin.
	 * - Custom Headers			: Manage your theme's header display from the WordPress admin.
	 * - Editor Style			: Add custom css to the WordPress text editor to simulate
	 *				   			  how it looks like in your theme.
	 * - Automatic Feed Links	: Automatically inject post type and comment feed
	 *							  links onto the page.
	 *
	 * To learn more about theme features in WordPress:
	 * @see http://codex.wordpress.org/Theme_Features
	 */
	function after_setup_theme() {
		/**
		 * Make theme available for translation
		 * Translations can be filed in the /library/languages/ directory.
		 */
		wpf_load_theme_translations();

		// Navigation Menu support.
		register_nav_menus( array(
			'primary' => __( 'Primary Navigation', t() ),
			'secondary' => __( 'Secondary Navigation', t() ),
			'tertiary' => __( 'Tertiary Navigation', t() ),
			'pros' => __( 'Pros Navigation', t() ),
			'quarterly' => __( 'Quarterly Navigation', t() ),
			'knapsack' => __( 'Knapsack Navigation', t() )
		) );

		// Enable dynamically generated css classes to your markup
		add_theme_support( 'semantic-markup' );

		// Enable the Roll Your Own Grid System - CSS Framework
		//add_theme_support( 'css-grid-framework' );

		// Post thumbnails support.
		add_theme_support( 'post-thumbnails' );
		
		// Post Format support.
		//add_theme_support( 'post-formats', array( 'aside', 'chat', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio' ) );

		// Automatic Feed Links support.
		add_theme_support( 'automatic-feed-links' );
		
		// Uncomment the following line to enable the Theme Options page within the WordPress admin.
		// add_theme_support( 'theme-options' );

		// Editor Styles support.
		add_editor_style( '/library/css/editor-style.01.css' );

		// Custom Background support.
		add_custom_background();

		/**
		 * Custom Header business
		 */
		if ( ! defined( 'HEADER_TEXTCOLOR' ) )
			define( 'HEADER_TEXTCOLOR', '' );

		// No CSS, just IMG call. The %s is a placeholder for the theme template directory URI.
		if ( ! defined( 'HEADER_IMAGE' ) )
			define( 'HEADER_IMAGE', DEFAULT_HEADER_IMAGE );

		// Don't support text inside the header image.
		if ( ! defined( 'NO_HEADER_TEXT' ) )
			define( 'NO_HEADER_TEXT', true );

		// The height and width of your custom header. You can hook into the theme's own filters to change these values.
		// Add a filter to twentyten_header_image_width and twentyten_header_image_height to change these values.
		define( 'HEADER_IMAGE_WIDTH', apply_filters( 'header_image_width', 978 ) );
		define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'header_image_height', 198 ) );

		// We'll be using post thumbnails for custom header images on posts and pages.
		// We want them to be HEADER_IMAGE_WIDTH pixels wide by HEADER_IMAGE_HEIGHT pixels tall.
		// Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
		set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );

		// Custom Header support.
		add_custom_image_header( array( $this, 'custom_header_frontend_callback' ), array( $this, 'custom_header_admin_callback' ) );

		// ... and thus ends the changeable header business.
	}

	/**
	 * Register widgetized areas.
	 *
	 * This is a magic method which is automatically called
	 * on the 'widgets_init' action hook.
	 */
	function widgets_init() {
		register_sidebar( array(
			'name' => __( 'Asides', t() ),
			'id' => 'aside-widget-area',
			'description' => __( 'Asides widget area', t() ),
			'before_widget' => '<section id="%1$s" class="widget-container %2$s"><div class="widget-in">',
			'after_widget' => '</div><!-- .widget-in --></section>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
		
		register_sidebar( array(
			'name' => __( 'Video asides', t() ),
			'id' => 'video-widget-area',
			'description' => __( 'Video widget area', t() ),
			'before_widget' => '<section id="%1$s" class="widget-container %2$s"><div class="widget-in">',
			'after_widget' => '</div><!-- .widget-in --></section>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
		
		register_sidebar( array(
			'name' => __( '404 asides', t() ),
			'id' => '404-widget-area',
			'description' => __( '404 widget area', t() ),
			'before_widget' => '<section id="%1$s" class="widget-container %2$s"><div class="widget-in">',
			'after_widget' => '</div><!-- .widget-in --></section>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
		
		register_sidebar( array(
			'name' => __( 'Stream asides', t() ),
			'id' => 'stream-widget-area',
			'description' => __( 'Stream widget area', t() ),
			'before_widget' => '<section id="%1$s" class="widget-container %2$s"><div class="widget-in">',
			'after_widget' => '</div><!-- .widget-in --></section>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
		
		register_sidebar( array(
			'name' => __( 'Footer widgets column 01', t() ),
			'id' => 'footer-widget-area-01',
			'description' => __( 'Footer widget area', t() ),
			'before_widget' => '<section id="%1$s" class="widget-container %2$s"><div class="widget-in">',
			'after_widget' => '</div><!-- .widget-in --></section>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
		
		register_sidebar( array(
			'name' => __( 'Footer widgets column 02', t() ),
			'id' => 'footer-widget-area-02',
			'description' => __( 'Footer widget area', t() ),
			'before_widget' => '<section id="%1$s" class="widget-container %2$s"><div class="widget-in">',
			'after_widget' => '</div><!-- .widget-in --></section>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
		
		register_sidebar( array(
			'name' => __( 'Footer widgets column 03', t() ),
			'id' => 'footer-widget-area-03',
			'description' => __( 'Footer widget area', t() ),
			'before_widget' => '<section id="%1$s" class="widget-container %2$s"><div class="widget-in">',
			'after_widget' => '</div><!-- .widget-in --></section>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
		
		register_sidebar( array(
			'name' => __( 'Knapsack Widgets', t() ),
			'id' => 'knapsack-widget-area',
			'description' => __( 'Knapsack widget area', t() ),
			'before_widget' => '<section id="%1$s" class="widget-container %2$s"><div class="widget-in">',
			'after_widget' => '</div><!-- .widget-in --></section>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
	}

	/**
	 * Enqueue Assets.
	 *
	 * Stylesheets:
	 * - reset.css		: resets default browser styling.
	 * - master.css		: blank css file, ready for you to edit.
	 * - default.css	: default styles for this theme.
	 * - grid.css		: custom css grid generator.
	 *
	 * Scripts:
	 * - html5shiv.js	: Adds support for HTML5 elements.
	 * - scripts.js		: Sample js script for rapid theme development.
	 * - hoverIntent/superfish/sf-options: Adds nice transitions to your menus.
	 *
	 * BuddyPress:
	 * - wpf-bp-admin-bar: Styles the BuddyPress admin bar.
	 * - wpf-bp			: Styles BuddyPress component pages.
	 * - wpf-bp-ajax-js	: Adds AJAX support to BuddyPress pages.
	 */
	function enqueue_assets() {
		
		wp_dequeue_style( 'admin-bar' );
		wp_dequeue_style( 'bp-admin-bar' );
		wp_dequeue_style( 'bbpress-style' );
		wp_dequeue_script('cfq');

		wp_enqueue_style( 'master', THEME_CSS_URI . '/master.css', null, '1.3.6.9.9.9.2' );

		if ( is_page( 'coverage' ) ) {
				wp_enqueue_script( 'listnav', THEME_JS_URI . '/listnav.js', array('jquery'), '1.0', true );
		}

		wp_dequeue_script( 'comment-reply' );

		if ( is_singular() && comments_open() ) {
			wp_enqueue_script( 'comment-reply' );
		}

		if ( !in_category( '995' ) ) {

			 wp_dequeue_script( 'live-blogging' );

		}


		// Kill WPEC, except on store pages
		if ( !is_page( 'shoppe' ) && !is_page( 'checkout' ) && !is_page( 'transaction-results' ) && !is_page( 'your-account' ) && !is_post_type_archive( 'wpcandy_issue' ) && !is_singular( 'wpcandy_issue' ) ) {

			wp_dequeue_script( 'wp-e-commerce' );
			wp_dequeue_script( 'livequery' );
			wp_dequeue_script( 'infieldlabel' );
			wp_dequeue_script( 'wp-e-commerce-ajax-legacy' );
			wp_dequeue_script( 'wp-e-commerce-legacy' );
			wp_dequeue_script( 'wpsc-thickbox' );
			wp_dequeue_script( 'wp-e-commerce-dynamic', site_url( '/index.php?wpsc_user_dynamic_js=true' ) );

			wp_dequeue_style( 'wpsc-thickbox' );
			wp_dequeue_style( 'wpsc-theme-css' );
			wp_dequeue_style( 'wpsc-theme-css-compatibility' );
			wp_dequeue_style( 'wp-e-commerce-dynamic', site_url( "/index.php?wpsc_user_dynamic_css=true" ) );

			remove_action( "init", 'wpsc_user_dynamic_css' );

		}

		wp_dequeue_script( 'dtheme-ajax-js' );

		wp_enqueue_script( 'scripts', THEME_JS_URI . '/script.js', array('jquery'), '1.1.4', true );
		
	}

	/**
	 * This is the callback method for registering metaboxes and options
	 * in the Theme Options page.
	 *
	 * Note: You must enable add_theme_support( 'theme-options' );
	 * for this method to be called. @see after_setup_theme() above.
	 *
	 * Register a metabox:
	 * In order to register options, you'll need to create a metabox where the
	 * option(s) will be contained.
	 *
	 * wpf_add_setting( 'options', 'general', __( 'General Settings', t() ) );
	 *
	 * Register an option:
	 * Options get registered to a metabox. Once you've registered a metabox, you can now register an option under that metabox.
	 *
	 * wpf_add_option( 'general', 'option_id', array( 'type' => 'textbox', 'label' => __( 'This is a sample textbox', t() ) ) );
	 *
	 * Supported types of options you can register:
	 * textbox, textarea, checkbox, radio, select, upload, color, custom, callback
	 *
	 * Theme Options API:
	 * Now that you have options registered to your theme, you can now
	 * build functionality based on those options you've created by making
	 * use of the following functions throughout your template files:
	 *
	 * 	- get_theme_option( $option_id ) // Returns the value of a theme option.
	 *	- delete_theme_option( $option_id ) // Deletes a theme option.
	 * 	- add_theme_option( $option_id, $value ) // Adds a theme option.
	 * 	- update_theme_option( $option_id, $value ) // Updates a theme option.
	 *
	 * For more information on the Theme Options API, see the following article
	 * in the codex:
	 * @link http://devpress.com/codex/wp-framework/theme-options-api/
	 */
	function theme_options() {
		//
	}
}

function modify_jquery() {

	if (!is_admin()) {
	
		// comment out the next two lines to load the local copy of jQuery
		wp_deregister_script('jquery');
		wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js', false );
		wp_enqueue_script('jquery');
		
	}
	
}
add_action( 'wp_enqueue_scripts', 'modify_jquery' );

// Enqueues CSS for BuddyPress pages
add_action( 'wp_enqueue_scripts', 'bp_dtheme_enqueue_styles' );

function bp_dtheme_enqueue_styles() {

	// Default CSS
	wp_enqueue_style( 'master', get_theme_part( THEME_CSS . '/master.css' ), null, '1.0' );
 
}

// Remove inline styles/scripts for Drafts Dropdown plugin
remove_action( 'init', 'cfdd_init' );

// Remove PowerPress -- not even sure what this does?
remove_action( 'wp_head', 'powerpress_header' );

// Remove BuddyPress styles
remove_action( 'wp_print_styles', 'bp_tpack_enqueue_styles' );
remove_action( 'wp_enqueue_scripts', 'bp_tpack_enqueue_styles' );

/**
 * Tests if any of a post's assigned categories are descendants of target categories
 *
 * @param int|array $cats The target categories. Integer ID or array of integer IDs
 * @param int|object $_post The post. Omit to test the current post in the Loop or main query
 * @return bool True if at least 1 of the post's categories is a descendant of any of the target categories
 * @see get_term_by() You can get a category by name or slug, then pass ID to this function
 * @uses get_term_children() Passes $cats
 * @uses in_category() Passes $_post (can be empty)
 * @version 2.7
 * @link http://codex.wordpress.org/Function_Reference/in_category#Testing_if_a_post_is_in_a_descendant_category
 */
function post_is_in_descendant_category( $cats, $_post = null )
{
	foreach ( (array) $cats as $cat ) {
		// get_term_children() accepts integer ID only
		$descendants = get_term_children( (int) $cat, 'category');
		if ( $descendants && in_category( $descendants, $_post ) )
			return true;
	}
	return false;
}

function wpcandy_comment_policy_notification() {
	echo '<p class="comment-notes">Please note that WPCandy is a <a href="http://wpcandy.com/is/a-moderated-community" title="WPCandy is a moderated community">moderated community</a>.</p>&nbsp;';
}
add_action('comment_form_top','wpcandy_comment_policy_notification');


// Remove admin menu items
add_action( 'admin_menu', 'wpcandy_remove_menu_pages' );

function wpcandy_remove_menu_pages() {

	remove_menu_page('link-manager.php');
	//remove_menu_page('edit.php?post_type=forum');
	//remove_menu_page('edit.php?post_type=topic');
	//remove_menu_page('edit.php?post_type=reply');
	remove_menu_page('admin.php?page=polls');
	remove_menu_page('admin.php?page=ratings');
	remove_menu_page('index.php?page=akismet-stats-display');
	
	remove_menu_page('edit.php?post_type=wpcandy_status');
	remove_menu_page('edit.php?post_type=wpcandy_slides');	
	remove_menu_page('admin.php?page=ratings');	
	remove_menu_page('admin.php?page=polls');
	
	remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=locations' );
	
	if ( !( current_user_can( 'manage-options' ) ) ) { 
	
		remove_menu_page('edit-comments.php');
		remove_menu_page( 'edit.php?post_type=wpsc-product' );
	
	}
	
}

// Function that loads everything up
function rwi_admin_loading() {
	
	if ( !( current_user_can( 'manage-options' ) ) && is_admin() ) { 

		wp_enqueue_style( 'admin', THEME_CSS_URI . '/admin.css', null, '1.0' );

	}

}
add_action( 'init', 'rwi_admin_loading' );


add_action('admin_init', 'rwi_wpcandy_remove_dashboard_widgets');
function rwi_wpcandy_remove_dashboard_widgets() {

	if ( !( current_user_can( 'manage_options' ) ) ) {
	
		// UnRegister the new dashboard widget into the 'wp_dashboard_setup' action
		remove_action('wp_dashboard_setup', 'wpcandy_add_dashboard_widgets' );
		
		remove_meta_box('dashboard_primary', 'dashboard', 'normal');   // wordpress blog
		remove_meta_box('dashboard_secondary', 'dashboard', 'normal');   // other wordpress news
		
		unset($wp_meta_boxes['dashboard']['normal']['core']['bbp_dashboard_widget_right_now']);

	}
	
}


//add_action( 'wp_print_styles', 'rwi_admin_blinders' );

function rwi_admin_blinders() {

	// Dequeu the main stylesheet and reque the development version
	if ( current_user_can( 'manage_options' ) ) {
		wp_dequeue_style( 'master' );
		wp_enqueue_style( 'responsive', THEME_CSS_URI . '/master.css', null, '1.0.3' );
	}

}


// Just for Pros

add_action( 'wp_print_styles', 'pros_styles' );

function pros_styles() {
	
	if ( is_post_type_archive( 'wpdf_pro' ) || is_tax( 'wpdf_location' ) || is_tax( 'wpdf_skill' ) || is_tax( 'wpdf_price' ) || is_tax( 'wpdf_experience' ) || is_singular( 'wpdf_pro' ) || is_page( 'have-experience' ) || is_page( 'change' ) || is_page( 'that-are-mine' ) || is_page( 'everywhere' ) || is_page( 'to-watch' ) ) {
		wp_dequeue_style( 'master' );
		wp_dequeue_style( 'responsive' );
		wp_enqueue_style( 'pros', THEME_CSS_URI . '/pros.min.css', null, '1.2' );
	}

}


// Just for the Stream

add_action( 'wp_print_styles', 'stream_styles' );
add_action( 'wp_enqueue_scripts', 'stream_scripts' );

function stream_styles() {
	
	if ( is_page( 'stream' ) ) {
		wp_dequeue_style( 'master' );
		wp_dequeue_style( 'responsive' );
		wp_enqueue_style( 'stream', THEME_CSS_URI . '/stream.min.css', null, '1.4.1' );
	}

}

function stream_scripts() {
	
	if ( is_page( 'stream' ) ) {
		wp_dequeue_script( 'scripts' );
		wp_dequeue_script( 'live-blogging' );
		wp_dequeue_script( 'jquery-ui-accordion' );
		wp_enqueue_script( 'wavestream', 'http://240891823.r.professionalcdn.com/jquery.shoutcast.easy.min.js?host=moon.wavestreamer.com&port=6652&stream=1', array( 'jquery' ), '1.2', true );

	}
	
}



// Just for the Quarterly

add_action( 'wp_print_styles', 'quarterly_styles' );
add_action( 'wp_enqueue_scripts', 'quarterly_scripts' );

function quarterly_styles() {
	
	if ( is_post_type_archive( 'wpcandy_issue' ) || is_singular( 'wpcandy_issue' ) ) {
		wp_dequeue_style( 'master' );
		wp_dequeue_style( 'responsive' );
		wp_enqueue_style( 'quarterly', THEME_CSS_URI . '/quarterly.min.css', null, '1.2' );
	}
	
	if ( is_page( 'shoppe') || is_page( 'your-account' ) || is_page( 'checkout' ) || is_page( 'transaction-results' ) || ( 'wpsc-product' == get_post_type() ) ) {
		wp_enqueue_style( 'shoppe', THEME_CSS_URI . '/shoppe.css', null, '1.0' );
	}

}

function quarterly_scripts() {
	
	if ( is_post_type_archive( 'wpcandy_issue' ) || is_singular( 'wpcandy_issue' ) ) {
		wp_dequeue_script( 'scripts' );
		wp_dequeue_script( 'live-blogging' );
		wp_dequeue_script( 'jquery-ui-accordion' );
		wp_enqueue_script( 'quarterly', THEME_JS_URI . '/quarterly.js', array('jquery'), '1.0.0.9', true );
	}
	
	if ( is_page( 'shoppe' ) || is_page( 'your-account' ) || is_page( 'checkout' ) || is_page( 'transaction-results' ) || ( 'wpsc-product' == get_post_type() ) ) {
		wp_enqueue_script( 'quarterly', THEME_JS_URI . '/quarterly.js', array( 'jquery' ), '1.0', true );
	}
	
}


// Just for Knapsack

add_action( 'wp_print_styles', 'knapsack_styles' );
add_action( 'wp_enqueue_scripts', 'knapsack_scripts' );

function knapsack_styles() {
	
	if ( is_post_type_archive( 'wpcandy_knapsack' ) || is_singular( 'wpcandy_knapsack' ) ) {
		wp_dequeue_style( 'master' );
		wp_enqueue_style( 'knapsack', THEME_CSS_URI . '/knapsack.css', null, '1.0.0.9.9.9.5' );
	}
	
}

function knapsack_scripts() {

	if ( is_post_type_archive( 'wpcandy_knapsack' ) || is_singular( 'wpcandy_knapsack' ) ) {
		wp_dequeue_script( 'scripts' );
		wp_dequeue_script( 'live-blogging' );
		wp_dequeue_script( 'jquery-ui-accordion' );
		wp_enqueue_script( 'knapsack', THEME_JS_URI . '/knapsack.js', array('jquery'), '1.0.0.6', true );
	}

}


// Just for Plugin Header Creator, Theme CSS Header Creator, Comparison tables

add_action( 'wp_print_styles', 'wpclabs_pluginheader_styles' );
add_action( 'wp_enqueue_scripts', 'wpclabs_pluginheader_scripts' );

function wpclabs_pluginheader_styles() {
	
	if ( is_page( 'plugin-header-creator' ) || is_page( 'theme-css-header-creator' ) || is_page( 'events-management-comparison' ) ) {
		wp_dequeue_style( 'master' );
		wp_enqueue_style( 'wpcandy-labs', THEME_CSS_URI . '/labs.css', null, '0.1.6' );
	}
	
}

function wpclabs_pluginheader_scripts() {

	if ( is_page( 'plugin-header-creator' ) || is_page( 'theme-css-header-creator' ) || is_page( 'events-management-comparison' ) ) {
		wp_dequeue_script( 'scripts' );
		wp_dequeue_script( 'live-blogging' );
		wp_dequeue_script( 'jquery-ui-accordion' );
	}

}


// Remove admin bar on frontend
remove_action( 'wp_footer', 'wp_admin_bar_render', 1000 ); 

function remove_admin_bar_style_frontend() { // css override for the frontend  
	echo '<style type="text/css" media="screen"> 
	html { margin-top: 0px !important; } 
	* html body { margin-top: 0px !important; } 
	</style>';  
}  

add_filter('wp_head','remove_admin_bar_style_frontend', 99);  


/* Styled login screen */
add_action( 'login_head', 'wpcandy_login_css', 99999 );

function wpcandy_login_css() { 
	?>
	
	<style type="text/css">
	body {
		background: #e6e6e6 url('http://wpcandy.s3.amazonaws.com/resources/site/loginbg.jpg') no-repeat top center !important;
	}
	
	#login {
		padding-top: 60px !important;
	}
	
	html {
		background: #e6e6e6;
	}
	
	#loginform {
		margin-bottom: 21px;
	}
	
	p#nav,
	p#backtoblog { 
		background: #fff;
		border: 1px solid #eee;
		margin-left: 8px !important;
		padding: 15px !important;
	}
	
	p#nav { 
		border-bottom: 0 !important;
		margin-bottom: -2px !important;
		padding-bottom: 2px !important;
		-moz-box-shadow: rgba(200, 200, 200, 0.7) 0px 4px 10px -1px;
		-webkit-box-shadow: rgba(200, 200, 200, 0.7) 0px 4px 10px -1px;
		box-shadow: rgba(200, 200, 200, 0.7) 0px 4px 10px -1px;
	}
	
	.login p#backtoblog {
		border-top: 0 !important;
		margin-bottom: 21px !important;
		padding-top: 5px !important;
	}
	
	.login p#backtoblog a {
		color: #999 !important;
		font-size: 9px !important;
	}
	
	#login {
		padding-bottom: 42px;
	}
	</style>
	
	<?php
}
