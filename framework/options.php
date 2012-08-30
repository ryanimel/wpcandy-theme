<?php
/**
 * Theme Options API
 *
 * {File Description}
 *
 * @link http://devpress.com/codex/wp-framework/theme-options-api
 *
 * @package WP Framework
 * @subpackage Functions
 */

/**
 * Returns the value of an option from the db if it exists.
 *
 * @since 1.0
 *
 * @param string $key Option Name.
 * @return mixed Returns the option's value if it exists, false if it doesn't.
 **/
function get_theme_option( $key ) {
	$options = get_option( THEME_ID );

	if ( isset($options[$key]) )
		return $options[$key];

	return false;
}

/**
 * Updates an option to the options db.
 *
 * @since 1.0
 *
 * @param string $key Option Name. Must be unique.
 * @param mixed $value Option Value.
 * @return bool true|false
 **/
function update_theme_option( $key, $value ) {
	$options = get_option( THEME_ID );
	
	$options[$key] = $value;
	
	return update_option( THEME_ID, $options );
}

/**
 * Adds an option to the options db.
 *
 * @since 1.0
 *
 * @param string $key Option Name. Must be unique.
 * @param mixed $value Option Value.
 * @return bool true|false
 **/
function add_theme_option( $key, $value ) {
	return update_theme_option( $key, $value );
}

/**
 * Deletes an option from the options db.
 *
 * @since 1.0
 * @param string $key Option Name. Must be unique.
 * @return bool true|false
 **/
function delete_theme_option( $key ) {
	$options = get_option( THEME_ID );
	
	if ( !isset( $options[$key] ) )
		return false;
	
	unset( $options[$key] );
	
	return update_option( THEME_ID, $options );
}

/***^!&@;'1!@1]***/

/**
 * Adds a metabox to the page.
 *
 * @since 1.0
 *
 * @param string $page_slug Page where the metabox is registered to.
 * @param string $id Identifier of the metabox.
 * @param string $title Title of the meta box.
 * @param int $column Registers the metabox to a specific column (1, 2, 3, or 4).
 * @param string $priority Optional. The priority within the column the metabox should be shown ( 'high', 'core', 'default', 'low' ).
 */
function wpf_register_metabox( $page_slug, $id, $title = '', $column = 1, $priority = 'default' ) {
	global $wpf_admin;
	
	$title = ( !isset($title) ) ? $id : $title;

	$wpf_admin->metaboxes[$page_slug][$id] = array( 'id' => $id, 'title' => $title, 'column' => $column, 'priority' => $priority );

	return $wpf_admin->metaboxes[$page_slug][$id];
}

/**
 * Remove a metabox from a page.
 *
 * @since 1.0
 *
 * @param string $page_slug Page where the metabox is registered to.
 * @param string $id Id of the metabox.
 * @return bool True if the metabox was removed, else false.
 */
function wpf_unregister_metabox( $page_slug, $id ) {
	global $wpf_admin;

	if ( isset($wpf_admin->metaboxes[$page_slug][$id]) ) {
		unset( $wpf_admin->metaboxes[$page_slug][$id] );
		return true;
	}

	return false;
}

/**
 * Adds an option to a metabox.
 *
 * @param string $field_id Name of the option.
 * @param string $field_label Label for the option.
 * @param bool $is_required True if the option is required, else false.
 * @param string $field_type textbox|textarea|radio|dropdown|multi-select|checkboxes
 * @param array $args Optional.
 * @return void
 * @author Ptah Dunbar
 */
function wpf_register_option( $metabox_id, $option_id, $field_type, $args = array(), $data = array() ) {
	global $wpf_admin;
	
	$wpf_admin->options[$metabox_id][$option_id] = array(
		'field_type' => $field_type,
		'id' => $option_id,
		'args' => $args,
		'data' => $data,
	);
	
	$default = ( is_array($args) && isset( $args['default'] ) ) ? $args['default'] : false;	
	$multiple = ( !empty($data) ) ? true : false;
	
	$wpf_admin->fields[$option_id] = array( 'default' => $default, 'type' => $field_type, 'multiple' => $multiple, 'data' => $data );
	
	return $wpf_admin->options[$metabox_id][$option_id];
}

/**
 * Removes an option from a metabox.
 *
 * @since 1.0
 *
 * @param string $metabox_id Id of the metabox.
 * @param string $options_id Id of the option.
 */
function wpf_unregister_option( $metabox_id, $option_id ) {
	global $wpf_admin;

	if ( $wpf_admin->options[$metabox_id][$option_id] ) {
		unset( $wpf_admin->options[$metabox_id][$option_id] );
		
		// Remove the option from the required array if it's there.
		if ( isset( $wpf_admin->required_options[$option_id] ) )
			unset( $wpf_admin->required_options[$option_id] );

		return true;
	}

	return false;
}