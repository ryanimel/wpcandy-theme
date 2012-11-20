<?php
/**
 * WPCandy Theme script enqueues
 *
 * @package WPCandy Theme
 * @since WPCandy Theme 1.0
 */


/**
 * Enqueue scripts and styles
 */ 
function wpcandy_theme_scripts() {
	wp_dequeue_style( 'admin-bar' );
	wp_dequeue_script('cfq');

	wp_enqueue_style( 'master', get_template_directory_uri() . '/css/master-beta-0003.css', null, '' );

	if ( is_page( 'coverage' ) ) {
			wp_enqueue_script( 'listnav', get_template_directory_uri() . '/js/listnav.js', array('jquery'), '1.0', true );
	}

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


// Enqueues CSS for BuddyPress pages
add_action( 'wp_enqueue_scripts', 'bp_dtheme_enqueue_styles' );
function bp_dtheme_enqueue_styles() {

	// Default CSS
	//wp_enqueue_style( 'master', get_template_directory_uri() . '/css/master.css', null, '1.0' );

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
//add_action( 'wp_print_styles', 'pros_styles' );
function pros_styles() {

	if ( is_post_type_archive( 'wpdf_pro' ) || is_tax( 'wpdf_location' ) || is_tax( 'wpdf_skill' ) || is_tax( 'wpdf_price' ) || is_tax( 'wpdf_experience' ) || is_singular( 'wpdf_pro' ) || is_page( 'have-experience' ) || is_page( 'change' ) || is_page( 'that-are-mine' ) || is_page( 'everywhere' ) || is_page( 'to-watch' ) ) {
		wp_dequeue_style( 'master' );
		wp_dequeue_style( 'responsive' );
		wp_enqueue_style( 'pros', get_template_directory_uri() . '/css/pros.css', null, '1.2' );
	}

}


// Just for the Stream
//add_action( 'wp_print_styles', 'stream_styles' );
//add_action( 'wp_enqueue_scripts', 'stream_scripts' );
function stream_styles() {

	if ( is_page( 'stream' ) ) {
		wp_dequeue_style( 'master' );
		wp_dequeue_style( 'responsive' );
		wp_enqueue_style( 'stream', get_template_directory_uri() . '/css/stream.css', null, '1.4.1' );
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
		wp_enqueue_style( 'quarterly', get_template_directory_uri() . '/css/quarterly.css', null, '1.2' );
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


// Loads admin tweaks for non-admin users.
function rwi_admin_loading() {

	if ( !( current_user_can( 'manage-options' ) ) && is_admin() ) { 

		wp_enqueue_style( 'admin', get_template_directory_uri() . '/admin.css', null, '1.0' );

	}

}
add_action( 'init', 'rwi_admin_loading' );


// Remove admin bar on frontend
remove_action( 'wp_footer', 'wp_admin_bar_render', 1000 ); 
function remove_admin_bar_style_frontend() { // css override for the frontend  
	echo '<style type="text/css" media="screen"> 
	html { margin-top: 0px !important; } 
	* html body { margin-top: 0px !important; } 
	</style>';  
}  
add_filter('wp_head','remove_admin_bar_style_frontend', 99);  



