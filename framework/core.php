<?php
/**
 * WP Framework core functions
 *
 * {File Description}
 *
 * @link http://devpress.com/codex/wpframework/
 *
 * @package WP Framework
 * @subpackage Core
 */

/**
 * Default constants available throughout WP Framework.
 *
 * @since 1.0
 *
 * @return void
 **/
function wpf_initial_constants() {	
	// Sets the File path to the current parent theme's directory.
	define( 'THEME_DIR', TEMPLATEPATH );

	// Sets the URI path to the current parent theme's directory.
	define( 'THEME_URI', get_template_directory_uri() );
	
	// Sets the File path to the current child theme's directory.
	define( 'CHILD_THEME_DIR', STYLESHEETPATH );

	// Sets the URI path to the current child theme's directory.
	define( 'CHILD_THEME_URI', get_stylesheet_directory_uri() );
	
	// Sets the file path to WP Framework
	define( 'WPF_DIR', THEME_DIR . '/framework' );
	
	// Sets the URI path to WP Framework
	define( 'WPF_URI', THEME_URI . '/framework' );
	
	// Sets the file path to extensions
	define( 'WPF_EXT_DIR', WPF_DIR . '/extensions' );
	
	// Sets the URI path to extensions
	define( 'WPF_EXT_URI', WPF_URI . '/extensions' );
}

/**
 * Templaing constants that you can override in your custom-functions.php.
 *
 * @since 1.0
 *
 * @return void
 **/
function wpf_templating_constants() {
	// Sets a unique ID for the theme.
	if ( !defined( 'THEME_ID' ) )
		define( 'THEME_ID', 'wpf_' . get_template() );
	
	// Sets paths for the default directories/paths
	if ( !defined( 'THEME_LIBRARY' ) )
		define( 'THEME_LIBRARY', '/library' );
	
	if ( !defined( 'THEME_I18N' ) )
		define( 'THEME_I18N', THEME_LIBRARY . '/languages' );
	
	if ( !defined( 'THEME_FUNC' ) )
		define( 'THEME_FUNC', THEME_LIBRARY . '/functions' );
	
	if ( !defined( 'THEME_IMG' ) )
		define( 'THEME_IMG', THEME_LIBRARY . '/images' );
	
	if ( !defined( 'THEME_CSS' ) )
		define( 'THEME_CSS', THEME_LIBRARY . '/css' );
	
	if ( !defined( 'THEME_JS' ) )
		define( 'THEME_JS', THEME_LIBRARY . '/js' );

	$constants = apply_filters( 'wpf_templating_constants', array(
		'THEME_LIBRARY', 'THEME_I18N', 'THEME_FUNC', 'THEME_IMG', 'THEME_CSS', 'THEME_JS',
	));

	wpf_setup_templating_paths( $constants );
}

function wpf_setup_templating_paths( $paths ) {
	if ( empty($paths) )
		return;

	foreach ( (array) $paths as $path ) {
		define( "{$path}_URI", THEME_URI . constant( $path ) );
		define( "{$path}_DIR", THEME_DIR . constant( $path ) );
		
		define( "CHILD_{$path}_URI", CHILD_THEME_URI . constant( $path ) );
		define( "CHILD_{$path}_DIR", CHILD_THEME_DIR . constant( $path ) );
	}
}

/**
 * Retrieves the theme framework class and initalises it.
 *
 * @since 1.0
 *
 * @return Object $wpf_theme class
 **/
function WPF() {
	$theme_class = wpf_get_class( 'theme' );

	return new $theme_class();
}

/***?!2[];'1@1`***/

/**
 * Registers a WP Framework class.
 *
 * @since 1.0
 *
 * @param string $handle Name of the api.
 * @param string $class Name of the class to register.
 * @return string The name of the class registered to the handle.
 **/
function wpf_register_class( $handle, $class, $autoload = false ) {
	global $wpf_classes;

	$type = $autoload ? 'autoload' : 'static';

	$wpf_classes[$type][$handle] = $class;

	return $wpf_classes[$type][$handle];
}

/**
 * Registers a contextual WP Framework class.
 *
 * @since 1.0
 *
 * @param string $handle Name of the api.
 * @param string $class Name of the class to register.
 * @return string The name of the class registered to the handle.
 **/
function wpf_register_contextual_class( $handle, $class ) {
	global $wpf_classes;

	$wpf_classes['contextual'][$handle] = $class;
	
	return $wpf_classes['contextual'][$handle];
}

function wpf_register_admin_page( $menu_slug, $class ) {
	global $wpf_classes;

	$wpf_classes['admin'][$menu_slug] = $class;
	
	return $wpf_classes['admin'][$menu_slug];
}

/**
 * Retrieves a registered WP Framework class.
 *
 * @since 1.0
 *
 * @param string $class The class handler
 * @return string The name of the class registered to the handler.
 **/
function wpf_get_class( $class ) {
	global $wpf_classes;
	
	if ( isset($wpf_classes[$class]) )
		return $wpf_classes[$class];
	
	if ( isset($wpf_classes['admin'][$class]) )
		return $wpf_classes['admin'][$class];
	
	if ( isset($wpf_classes['static'][$class]) )
		return $wpf_classes['static'][$class];
	
	if ( isset($wpf_classes['autoload'][$class]) )
		return $wpf_classes['autoload'][$class];
	
	if ( isset($wpf_classes['contextual'][$class]) )
		return $wpf_classes['contextual'][$class];
	
	return false;
}

/**
 * Loops through all the registered autoloaded classes and instantance them.
 *
 * @since 1.0
 * 
 * @return void
 **/
function wpf_autoload_classes() {
	global $wpf_classes;

	if ( isset( $wpf_classes['autoload'] ) ) {
		foreach ( (array) $wpf_classes['autoload'] as $handle => $class ) {
			if ( !isset($wpf_classes[$handle]) ) {
				$wpf_classes[$handle] = new $class;
			}
		}
	}
}

/**
 * Loops through all the registered contextual classes and attempts to call 
 * classs methods based on the template hierarchy.
 *
 * @since 1.0
 * @todo use callback() method.
 * 
 * @return void
 **/
function wpf_load_contextual_classes() {
	global $wpf_classes, $wpf_theme;

	if ( !empty( $wpf_classes['contextual'] ) ) {
		$methods = array();

		// Get the context, but not in the admin.
		if ( !is_admin() ) {
			$context = array_reverse( (array) wpf_template_hierarchy() );

			if ( !empty($context) ) {
				foreach ( $context as $method ) {
					$methods[] = str_replace( '-', '_', $method );
				}
			}
		}

		foreach ( (array) $wpf_classes['contextual'] as $handle => $class ) {
			// Call the admin method if we're in the admin area
			if ( is_admin() ) {
				if ( method_exists( $wpf_classes[$handle], 'admin' ) ) {
					call_user_func( array( $wpf_classes[$handle], 'admin' ) );
				}
			} else {
				// Call the constructor method if we're not in the admin
				$wpf_classes[$handle] = new $class( $methods );
			}

			// Call all the contextual methods
			if ( !empty( $methods ) ) {
				foreach( $methods as $method ) {
					if ( method_exists( $wpf_classes[$handle], $method ) ) {
						call_user_func( array( $wpf_classes[$handle], $method ) );
					}
				}
			}
		}
	}
}

/**
 * Loops through all the registered admin pages and attempts to call 
 * classs methods based on the template hierarchy.
 *
 * @since 1.0
 * 
 * @return void
 **/
function wpf_load_admin_pages() {
	global $wpf_classes;

	if ( isset($wpf_classes['admin']) && !empty($wpf_classes['admin']) ) {
		foreach ( $wpf_classes['admin'] as $handle => $class ) {
			$wpf_classes[$handle] = new $class;
		}
	}
}

function wpf_get_string( $id ) {
	global $wpf_theme;

	if ( isset($wpf_theme->strings[$id]) )
		return $wpf_theme->strings[$id];

	return false;
}

function wpf_register_string( $id, $string ) {
	global $wpf_theme;

	$wpf_theme->strings[$id] = $string;

	return esc_html( $wpf_theme->strings[$id] );
}

function wpf_get_strings() {
	global $wpf_theme;

	if ( !empty( $wpf_theme->strings ) )
		return $wpf_theme->strings;

	return wpf_get_default_strings();
}

function wpf_string( $id ) {
	echo wpf_get_string( $id );
}

function wpf_get_default_strings() {
	$strings = array(		
		'comment-form-must_log_in' => __( 'You must be <a href="%s">logged in</a> to post a comment.', t() ),
		'comment-form-logged_in_as' => __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', t() ),
		'comment-form-comment_notes_before' => __( 'Your email address will not be published.', t() ),
		'comment-form-comment_notes_after' => __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s', t() ),
		'comment-form-required_text' => __( 'Required fields are marked %s', t() ),

		'comment_form-title_reply' => __( 'Leave a Reply', t() ),
		'comment_form-title_reply_to' => __( 'Leave a Reply to %s', t() ),
		'comment_form-cancel_reply_link' => __( 'Cancel reply', t() ),
		'comment_form-label_submit' => __( 'Post Comment', t() ),
		
		'comment-reply' => __( 'Reply', t() ),
		'comment-login' => __( 'Log in to leave a Comment', t() ),
		'comments-closed-pings-open' => __( 'Comments are closed, but <a href="%1$s" title="Trackback URL for this post">trackbacks</a> and pingbacks are open.', t() ),
		'no-comments' => __( 'No Comments.', t() ),
		'comments-closed' => __( 'Comments are closed.', t() ),
		'comment-moderation' => __( 'Your comment is awaiting moderation.', t() ),
		'password-required' => __( 'This post is password protected. Enter the password to view comments.', t() ),
	);
	
//	'' => __( '', t() ),
	
	return apply_filters( 'wpf_default_strings', $strings );
}

function wpf_comment_reply_strings() {
	$strings = array();

	$strings['reply_text'] = wpf_get_string( 'comment-reply' );
	$strings['login_text'] = wpf_get_string( 'comment-login' );

	return $strings;
}

add_action( 'comment_form_defaults', 'wpf_filter_comment_form_strings' );

function wpf_filter_comment_form_strings( $args ) {
	global $user_identity;
	
	$req = get_option( 'require_name_email' );
	
	$required_text = sprintf( ' ' . wpf_get_string( 'comment-form-required_text' ), '<span class="required">*</span>' );
	
	$args['must_log_in'] = '<p class="must-log-in">' . sprintf( wpf_get_string( 'comment-form-must_log_in' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( get_the_ID() ) ) ) ) . '</p>';
	$args['logged_in_as'] = '<p class="logged-in-as">' . sprintf( wpf_get_string( 'comment-form-logged_in_as' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( get_the_ID() ) ) ) ) . '</p>';
	$args['comment_notes_before'] = '<p class="comment-notes">' . wpf_get_string( 'comment_form-comment_notes_before' ) . ( $req ? $required_text : '' ) . '</p>';
	$args['comment_notes_after'] = '<p class="form-allowed-tags">' . sprintf( wpf_get_string( 'comment-form-comment_notes_after' ), ' <code>' . allowed_tags() . '</code>' ) . '</p>';

	$args['title_reply'] = wpf_get_string( 'comment_form-title_reply' );
	$args['title_reply_to'] = wpf_get_string( 'comment_form-title_reply_to' );
	$args['cancel_reply_link'] = wpf_get_string( 'comment_form-cancel_reply_link' );
	$args['label_submit'] = wpf_get_string( 'comment_form-label_submit' );
	
	return $args;
}

add_filter( 'wp_sprintf_l', 'wpf_filter_sprintf_l' );
function wpf_filter_sprintf_l() {
	return array(
		/* translators: used between list items, there is a space after the coma */
		'between'          => '<span class="meta-sep-between">' . __( ', ', t() ) . '</span>',
		/* translators: used between list items, there is a space after the and */
		'between_last_two' => '<span class="meta-sep-between_last_two">' . __( ', and ', t() ) . '</span>',
		/* translators: used between only two list items, there is a space after the and */
		'between_only_two' => '<span class="meta-sep-between_only_two">' . __( ' and ', t() ) . '</span>',
	);
}
/*

add_filter( 'taxonomy_template', 'wpf_filter_taxonomy_template' );
function wpf_filter_taxonomy_template() {
	return '<span class="tax-label">%s</span><span class="tax-meta-sep">:</span> <span class="tax-link">%l</span><span class="tax-meta-end">.</span>';
}
*/