<?php
/**
 * Displays query count and load time if the current user can edit themes.
 *
 * @since 1.0
 * @uses current_user_can() Checks if the current user can edit themes.
 */
function wpf_query_counter() {
	$out = sprintf( __( 'This page loaded in %1$s seconds with %2$s database queries.', t() ), timer_stop( 0, 3 ), get_num_queries() );
	
	echo wpautop( $out );
}

function __wpf_return_custom( $custom ) {
	return esc_attr( $custom );
}

function wpf_display_notice( $message, $status = 'updated' ) {
	global $wpf_theme;
	
	$wpf_theme->display_notice( $message, $status );
}

function wpf_site_title() {
	global $wpf_theme;

	$wpf_theme->site_title();
}

function wpf_site_description() {
	global $wpf_theme;

	$wpf_theme->site_description();
}

function wpf_site_info() {
	global $wpf_theme;
	
	$wpf_theme->site_info();
}

function wpf_posted_on() {
	global $wpf_theme;

	$wpf_theme->posted_on();
}

function wpf_posted_in() {
	global $wpf_theme;

	$wpf_theme->posted_in();
}

function wpf_html_wrap( $tag, $content = '', $attrs = array(), $echo = true ) {
	global $wpf_theme;
	
	if ( $echo )
		$wpf_theme->html_wrap( $tag, $content, $attrs, $echo );
	else
		return $wpf_theme->html_wrap( $tag, $content, $attrs, $echo );
}

function wpf_the_taxonomies( $args = array() ) {
	global $wpf_theme;
	return $wpf_theme->the_taxonomies( $args );
}

function wpf_archive_title( $page_title = '' ) {
	global $wpf_theme;
	return $wpf_theme->archive_title( $page_title );
}

// paginate_links();