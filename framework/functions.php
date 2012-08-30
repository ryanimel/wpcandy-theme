<?php
/**
 * General WP Framework functions.
 *
 * @package WP Framework
 * @subpackage Core
 */

/**
 * Contextual function that powers the atomic API. This allows code to be used more than once without running
 * hundreds of conditional checks within your theme. It returns an array of contexts based on what
 * page a visitor is currently viewing on the site. This function is useful for making dynamic/contextual
 * classes, action and filter hooks, and handling the templating system.
 *
 * @since 1.0.0
 * @global $wp_query The current page's query object.
 * @global $wpf_template_hierarchy The global Theme object.
 * @return Array $wpf_template_hierarchy Returns an array of contexts based on the query.
 */
function wpf_template_hierarchy() {
	// The query isn't parsed until wp, so bail if called before.
	if ( !did_action( 'wp' ) )
		return false;

	global $wp_query, $wpf_template_hierarchy;

	static $wpf_template_hierarchy;
	
	if ( !empty($wpf_template_hierarchy) )
		return $wpf_template_hierarchy;

	/* Front page of the site. */
	if ( is_front_page() )
		$wpf_template_hierarchy[] = 'front-page';

	/* Blog page. */
	if ( is_home() )
		$wpf_template_hierarchy[] = 'home';

	/* Singular views. */
	elseif ( is_singular() ) {
		$wpf_template_hierarchy[] = 'single';
		$wpf_template_hierarchy[] = "single-{$wp_query->post->post_type}";
		$wpf_template_hierarchy[] = "single-{$wp_query->post->post_type}-{$wp_query->post->ID}";
	}

	/* Archive views. */
	elseif ( is_archive() ) {
		$wpf_template_hierarchy[] = 'archive';

		/* Taxonomy archives. */
		if ( is_tax() || is_category() || is_tag() ) {
			$term = $wp_query->get_queried_object();
			$wpf_template_hierarchy[] = 'taxonomy';
			$wpf_template_hierarchy[] = $term->taxonomy;
			$wpf_template_hierarchy[] = "{$term->taxonomy}-" . sanitize_html_class( $term->slug, $term->term_id );
		}

		/* User/author archives. */
		elseif ( is_author() ) {
			$wpf_template_hierarchy[] = 'user';
			$wpf_template_hierarchy[] = 'user-' . sanitize_html_class( get_the_author_meta( 'user_nicename', get_query_var( 'author' ) ), $wp_query->get_queried_object_id() );
		}

		/* Date archives. */
		else {
			if ( is_date() ) {
				$wpf_template_hierarchy[] = 'date';
				if ( is_year() )
					$wpf_template_hierarchy[] = 'year';
				if ( is_month() )
					$wpf_template_hierarchy[] = 'month';
				if ( get_query_var( 'w' ) )
					$wpf_template_hierarchy[] = 'week';
				if ( is_day() )
					$wpf_template_hierarchy[] = 'day';
			}
		}
	}

	/* Search results. */
	elseif ( is_search() )
		$wpf_template_hierarchy[] = 'search';

	/* Error 404 pages. */
	elseif ( is_404() )
		$wpf_template_hierarchy[] = 'error404';

	$wpf_template_hierarchy = apply_filters( 'wpf_template_hierarchy', $wpf_template_hierarchy );

	return $wpf_template_hierarchy;
}

add_action( 'template_include', 'wpf_catch_requested_template' );
function wpf_catch_requested_template( $template ) {
	global $requested_template;
	
	$requested_template = $template;
	
	return $template;
}

/**
 * Returns the template used to display the requested uri.
 *
 * @return string path to the requested template.
 **/
function wpf_get_requested_template() {
	global $requested_template;
	
	return $requested_template;
}

/**
 * Defines the theme's textdomain for translating your theme into multiple langauges.
 * It defaults to the value of get_template().
 *
 * @link http://devpress.com/codex/wpframework/t/
 * @since 1.0.0
 * @global object $wp_theme The global WP Framework object.
 * @return string $wp_theme->textdomain The textdomain of the theme.
 */
function t() {
	global $wpf_theme;

	/* If the global textdomain isn't set, define it. Plugin/theme authors may also define a custom textdomain. */
	if ( isset($wpf_theme->textdomain) ) {
		return $wpf_theme->textdomain;
	}
	
	return $wpf_theme->textdomain = apply_filters( 'wpf_textdomain', get_template() );
}

/**
 * undocumented function
 *
 * @since 0.1
 **/
function wpf_get_content_width() {
	global $wpf_theme, $content_width;
	
	if ( $content_width )
		return $content_width;
	
	$content_width = apply_filters( 'wpf_content_width', (int) $wpf_theme->content_width );

	return $content_width;
}

/**
 * Helper function that outputs the first parameter.
 *
 * @return scalar $custom
 **/
function __wpf_echo_value( $custom ) {
	echo $custom;
}

/**
 * Arguments for the wp_list_comments() function used in comments.php. Users can set up a 
 * custom comments callback function by changing $callback to the custom function.  Note that 
 * $style should remain 'ol' since this is hardcoded into the theme and is the semantically correct
 * element to use for listing comments.
 *
 * @since 0.7
 * @return array $args Arguments for listing comments.
 */
function wpf_list_comment_args( $args = array() ) {
	global $wpf_theme;

	$defaults = array( 'style' => 'ol', 'avatar_size' => 40, 'callback' => array( $wpf_theme, 'comments_callback' ), 'end-callback' => array( $wpf_theme, 'comments_end_callback' ) );

	$args = wp_parse_args( $args, $defaults );
	
	return apply_filters( 'wpf_list_comments_args', $args );
}

function wpf_comments_pagination() {
	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) )
		get_template_part( 'pagination', 'comments' );
}

add_action( 'hfeed_open', 'wpf_hook_archive_title' );

function wpf_hook_archive_title() {
	if ( is_archive() ) {
		wpf_html_wrap( 'h1', wpf_archive_title(), array( 'class' => 'page-title' ) );
	}
}

/**
 * Display or retrieve page title for tag post archive.
 *
 * Useful for tag template files for displaying the tag page title. It has less
 * overhead than {@link wp_title()}, because of its limited implementation.
 *
 * It does not support placing the separator after the title, but by leaving the
 * prefix parameter empty, you can set the title separator manually. The prefix
 * does not automatically place a space between the prefix, so if there should
 * be a space, the parameter value will need to have it at the end.
 *
 * @since 2.3.0
 *
 * @param string $prefix Optional. What to display before the title.
 * @param bool $display Optional, default is true. Whether to display or retrieve title.
 * @return string|null Title when retrieving, null when displaying or failure.
 */
function wpf_single_tax_title( $prefix = '', $display = true ) {
	global $wp_query;

	$queried_object = $wp_query->get_queried_object();

	if ( ! $queried_object OR ! is_tax() OR ! is_category() OR ! is_tag() )
		return;

	$title = apply_filters( "single_{$queried_object->taxonomy}_title", $queried_object->name );

	if ( !empty($title) ) {
		if ( $display )
			echo $prefix . $title;
		else
			return $title;
	}
}

add_filter( 'wp_page_menu_args', 'wpf_filter_wp_page_menu_args' );
function wpf_filter_wp_page_menu_args( $args ) {
	$args['menu_class'] = 'nav-menu';
	return $args;
}