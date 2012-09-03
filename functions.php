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

	/**
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );

	// Make theme translatable.
	// load_theme_textdomain( 'wpcandy_theme', get_template_directory() . '/languages' );

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
		'knapsack' => __( 'Knapsack Navigation' )
	) );

	// Editor Styles support.
	add_editor_style( '/css/editor-style.01.css' );

	/**
	 * Add support for the Aside Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', ) );
	
}
endif; // wpcandy_theme_setup
add_action( 'after_setup_theme', 'wpcandy_theme_setup' );

/**
 * Register widgetized area and update sidebar with default widgets.
 *
 * @since wpcandy_theme 1.0
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


/**
 * Enqueue scripts and styles
 */ 
function wpcandy_theme_scripts() {
	wp_dequeue_style( 'admin-bar' );
	wp_dequeue_style( 'bp-admin-bar' );
	wp_dequeue_style( 'bbpress-style' );
	wp_dequeue_script('cfq');

	wp_enqueue_style( 'master', get_template_directory_uri() . '/css/master.css', null, '1.3.6.9.9.9.2' );

	if ( is_page( 'coverage' ) ) {
			wp_enqueue_script( 'listnav', get_template_directory_uri() . '/js/listnav.js', array('jquery'), '1.0', true );
	}

	wp_enqueue_script( 'small-menu', get_template_directory_uri() . '/js/small-menu.js', array( 'jquery' ), '20120206', true );

	wp_dequeue_script( 'comment-reply' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
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

	wp_enqueue_script( 'scripts', get_template_directory_uri() . '/js/script.js', array('jquery'), '1.1.4', true );
}
add_action( 'wp_enqueue_scripts', 'wpcandy_theme_scripts' );


/**
 * Tweaks the version of jQuery loaded up on the front end of the site.
 *
 */
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
	wp_enqueue_style( 'master', get_template_directory_uri() . '/css/master.css', null, '1.0' );

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


// Loads admin tweaks for non-admin users.
function rwi_admin_loading() {

	if ( !( current_user_can( 'manage-options' ) ) && is_admin() ) { 

		wp_enqueue_style( 'admin', get_template_directory_uri() . '/admin.css', null, '1.0' );

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