<?php
/**
 * WPCandy Theme functions and definitions
 *
 * @package WPCandy Theme
 * @since WPCandy Theme 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since WPCandy Theme 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 600; /* pixels */


if ( ! function_exists( 'wpcandy_theme_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since WPCandy Theme 1.0
 */
function wpcandy_theme_setup() {

	// Custom template tags for this theme.
	require( get_template_directory() . '/inc/template-tags.php' );

	// Enqueues of styles and scripts are elsewhere. They are many.
	require( get_template_directory() . '/inc/enqueue.php' );

	// Add default post and comment RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Support for post thumbnails
	add_theme_support( 'post_thumbnails' );

	// This theme uses many navigation menus.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation' ),
		'secondary' => __( 'Secondary Navigation' ),
		'tertiary' => __( 'Tertiary Navigation' ),
		'pros' => __( 'Pros Navigation' ),
		'quarterly' => __( 'Quarterly Navigation' ),
		'knapsack' => __( 'Knapsack Navigation' ),
		'footer_column_one'	=> __( 'Footer Column #1' ),
		'footer_column_two'	=> __( 'Footer Column #2' ),
		'footer_column_three'	=> __( 'Footer Column #3' ),
		'footer_column_four'	=> __( 'Footer Column #4' )
	) );

	// Editor Styles support.
	add_editor_style( '/css/editor-style.01.css' );

	// Add support for the Aside Post Formats
	add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' ) );
	
	// Remove extra styles added by Jetpack
	remove_action( 'wp_enqueue_scripts', 'jetpack_widgets_styles' );
		
}
endif; // wpcandy_theme_setup
add_action( 'after_setup_theme', 'wpcandy_theme_setup' );


/**
 * Register widgetized area and update sidebar with default widgets.
 *
 * @since WPCandy Theme 1.0
 */
function wpcandy_theme_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Asides' ),
		'id' => 'aside-widget-area',
		'description' => __( 'Asides widget area' ),
		'before_widget' => '<section id="%1$s" class="widget-container %2$s"><div class="widget-in">',
		'after_widget' => '</div><!-- .widget-in --></section>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Video asides' ),
		'id' => 'video-widget-area',
		'description' => __( 'Video widget area' ),
		'before_widget' => '<section id="%1$s" class="widget-container %2$s"><div class="widget-in">',
		'after_widget' => '</div><!-- .widget-in --></section>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( '404 asides' ),
		'id' => '404-widget-area',
		'description' => __( '404 widget area' ),
		'before_widget' => '<section id="%1$s" class="widget-container %2$s"><div class="widget-in">',
		'after_widget' => '</div><!-- .widget-in --></section>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Stream asides' ),
		'id' => 'stream-widget-area',
		'description' => __( 'Stream widget area' ),
		'before_widget' => '<section id="%1$s" class="widget-container %2$s"><div class="widget-in">',
		'after_widget' => '</div><!-- .widget-in --></section>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer widgets column 01' ),
		'id' => 'footer-widget-area-01',
		'description' => __( 'Footer widget area' ),
		'before_widget' => '<section id="%1$s" class="widget-container %2$s"><div class="widget-in">',
		'after_widget' => '</div><!-- .widget-in --></section>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer widgets column 02' ),
		'id' => 'footer-widget-area-02',
		'description' => __( 'Footer widget area' ),
		'before_widget' => '<section id="%1$s" class="widget-container %2$s"><div class="widget-in">',
		'after_widget' => '</div><!-- .widget-in --></section>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer widgets column 03' ),
		'id' => 'footer-widget-area-03',
		'description' => __( 'Footer widget area' ),
		'before_widget' => '<section id="%1$s" class="widget-container %2$s"><div class="widget-in">',
		'after_widget' => '</div><!-- .widget-in --></section>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Knapsack Widgets' ),
		'id' => 'knapsack-widget-area',
		'description' => __( 'Knapsack widget area' ),
		'before_widget' => '<section id="%1$s" class="widget-container %2$s"><div class="widget-in">',
		'after_widget' => '</div><!-- .widget-in --></section>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'wpcandy_theme_widgets_init' );


// Remove inline styles/scripts for Drafts Dropdown plugin
remove_action( 'init', 'cfdd_init' );


// Remove PowerPress -- not even sure what this does?
remove_action( 'wp_head', 'powerpress_header' );


// Remove BuddyPress styles
remove_action( 'wp_print_styles', 'bp_tpack_enqueue_styles' );
remove_action( 'wp_enqueue_scripts', 'bp_tpack_enqueue_styles' );


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

// Adding date and time to the body classes
// Generates time- and date-based classes for BODY, post DIVs, and comment LIs; relative to GMT (UTC)
function sandbox_date_classes( $t, &$c, $p = '' ) {
	$t = $t + ( get_option('gmt_offset') * 3600 );
	$c[] = $p . 'y' . gmdate( 'Y', $t ); // Year
	$c[] = $p . 'm' . gmdate( 'm', $t ); // Month
	$c[] = $p . 'd' . gmdate( 'd', $t ); // Day
	$c[] = $p . 'h' . gmdate( 'H', $t ); // Hour
}

// Add specific CSS class by filter
add_filter( 'body_class', 'sandbox_classes' );

function sandbox_classes( $classes ) {
	
	$c = array('wordpress');
	sandbox_date_classes( time(), $c );
	
	foreach( $c as $single ) {
		$classes[] = $single;
	}
	
	return $classes;

}
