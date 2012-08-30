<?php

/**
 * Base class for registering an admin page in WordPress.
 *
 * @since 1.0.0
 */
class WPF_Admin extends WPF {
	var $args;
	var $messages;
	var $page_slug;
	var $page_hook;
	var $page_parent;
	
	function WPF_Admin( $args = array() ) {
		$this->setup_globals();

		$this->args = (object) $args;

		$this->callback( 'admin_menu' );

		$hooks = array( 'admin_init', 'admin_head' );
		foreach ( $hooks as $hook ) {		
			if ( method_exists( $this, $hook ) ) {
				add_action( $hook, array( &$this, $hook ) );
			}
		}
		
		add_action( 'load-' . $this->page_hook, array( &$this, 'contextual_help' ) );
		add_action( "wpf_display_notices_{$this->page_slug}", array( &$this, 'display_notices' ) );
		add_action( "admin_head-{$this->page_hook}", array(&$this, 'inject_css' ) );
	}
	
	function setup_globals() {
		global $pagenow;
			
		if ( isset($_GET['page']) ) {
			$plugin_page = stripslashes( $_GET['page'] );
			$plugin_page = plugin_basename( $plugin_page );
		}
		
		$the_parent = '';
		if ( isset($plugin_page) ) {
			$the_parent = $pagenow;

			if ( ! $page_hook = get_plugin_page_hookname( $plugin_page, $the_parent ) )
				$page_hook = get_plugin_page_hookname( $plugin_page, $plugin_page );
		} else {
			$plugin_page = $page_hook = null;
		}

		$this->page_slug = $plugin_page;
		$this->page_hook = $page_hook;
		$this->page_parent = $the_parent;
		
		$this->callback( 'setup' );
	}
	
	function init() {
		$this->process_form_data();
		$this->page();
	}
	
	function process_form_data() {
		$new_options = isset($_POST[THEME_ID]) ? $_POST[THEME_ID] : array();
		if ( $new_options ) {
			$options = $this->update( $new_options, $this->get_options() );

			if ( $options ) {
				return update_option( THEME_ID, $options );
			}
		}
	}
	
	/**
	 * Update options.
	 *
	 * This function should check that $new_instance is set correctly.
	 * The newly calculated value of $instance should be returned.
	 * If "false" is returned, the options won't be saved/updated.
	 *
	 * @param array $new_options New options
	 * @param array $old_options Old options
	 * @return array Options to save or bool false to cancel saving
	 */
	function update( $new_options, $old_options ) {
		$instance = wp_parse_args( $new_options, $old_options );
		
		return $instance;
	}

	/**
	 * Adds information to the help panel on the theme options page.
	 * 
	 * @since 1.0
	 * @uses add_contextual_help();
	 */
	function contextual_help() {
		$this->callback( 'set_contextual_help' );
	}
	
	/**
	 * Registers a message that gets displayed on the page.
	 *
	 * @since 1.0
	 *
	 * @param string $message The message to display.
	 * @param string $status Use 'updated' for successful messages, or 'error' for errors.
	 **/
	function register_notice( $message, $status = 'updated' ) {
		$this->messages[] = array( $message, $status );
	}
	
	/**
	 * Loops through all the registered notices and displays them.
	 *
	 * @since 1.0
	 **/
	function display_notices() {
		if ( !empty($this->messages) ) {
			foreach ( $this->messages as $message ) {
				$this->display_notice( $message[0], $message[1] );
			}
		}
	}
	
	/**[7878787]]s*/
		
	function page() {
		?>
		<div id="wpf-form-<?php echo esc_attr( $this->page_slug ); ?>" class="wpf-wrap wrap">
			<?php

			// Available action hook before the page title and form is displayed.
			do_action( "wpf_admin_page_open_{$this->page_slug}" );

			// Insert screen_icon and page title
			$this->callback( 'page_header' );

			// Available action hook WPF uses to output any notices to the user.
			do_action( "wpf_display_notices_{$this->page_slug}" ); ?>
			<form<?php echo $this->form_attrs(); ?>>
				<?php $this->callback( 'form', $this->get_options() ); ?>
			</form><!--form-->
			<?php
			
			$this->callback( 'page_footer' );

			// Available action hook after the page  and form is displayed.
			do_action( "wpf_admin_page_close_{$this->page_slug}" );
			?>
		</div><!--#<?php echo esc_attr( $this->page_slug ); ?>-->
		<?php
	}
	
	function get_options() {
		$options = get_option( THEME_ID );
		$options = $options ? $options : array();
		
		return $options;
	}
	
	function get_form_attrs() {
		return apply_filters( "wpf_admin_form_attrs_{$this->page_slug}", array( 'action' => '', 'method' => 'post', 'enctype' => 'multipart/form-data' ) );
	}
	
	function form_attrs() {
		$form_attrs = $this->get_form_attrs();
		$the_form_attrs = '';
		if ( empty($form_attrs) )
			return;
		
		foreach ( $form_attrs as $key => $value ) {
			$the_form_attrs .= ' ' . esc_attr($key) . '="'. esc_attr( $value ) .'"';
		}
		
		return $the_form_attrs;
	}
	
	function html_wrap( $content, $tag ) {
		return sprintf( "<{$tag}>%s</{$tag}>", $content );
	}
	
	/**
	 * CSS needed for message styling.
	 *
	 * @since 1.0
	 **/
	function inject_css() {
		?>
		<style type="text/css">
			#message ul { list-style: disc; }
			#message ul li { margin-left: 25px; }
		</style>
		<?php
	}

	function callback( $method, $args = array() ) {
		if ( method_exists( &$this, $method ) ) {
			return call_user_func_array( array( &$this, $method ), $args );
		}
	}

	function get_method( $method ) {
		$this->maybe_debug( $method );

		if ( method_exists( &$this, $method ) ) {
			return $method;
		} else {
			return false;
		}
	}

	function format_method( $prefix, $context ) {
		return "{$prefix}_" . str_replace( '-', '_', sanitize_title_with_dashes($context) );
	}
	
	function maybe_debug( $var ) {
		if ( isset($this->debug) && $this->debug ) {
			echo '<pre>';
			var_dump( $var );
			echo '</pre>';
		}
	}
}

