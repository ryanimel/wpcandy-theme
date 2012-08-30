<?php

class WPF_Admin_Metabox extends WPF_Admin {
	function WPF_Admin_Metabox( $args = array() ) {
		$default_args = array( 'default_screen_columns' => 3, 'max_screen_columns' => 4 );
		$args = wp_parse_args( $args, $default_args );		
		$this->WPF_Admin( $args );
	}
	
	function admin_init() {
		add_action( 'load-' . $this->page_hook, array( &$this, 'set_screen_layout_columns' ) );
		add_filter( 'screen_layout_columns', array( &$this, 'set_max_screen_columns' ), 10, 2 );

		add_action( 'load-' . $this->page_hook, array( &$this, 'metabox_scripts' ) );
		add_action( 'load-' . $this->page_hook, array( &$this, 'metaboxes_hook' ) );
		add_action( 'load-' . $this->page_hook, array( &$this, 'register_metaboxes' ) );

		add_action( 'admin_head-' . $this->page_hook, array( &$this, 'inject_css_in_head' ) );
		add_action( 'admin_head-' . $this->page_hook, array( &$this, 'inject_javascript_in_head' ) );

		add_action( "wpf_before_form_{$this->page_slug}", array( &$this, 'register_form_globals' ) );
		add_action( "wpf_display_notices_{$this->page_slug}", array( &$this, 'no_options_notice' ) );
	}
	
	/**
	 * Update options.
	 *
	 * @param array $new_options New options
	 * @param array $old_options Old options
	 * @return array Options to save or bool false to cancel saving
	 */
	function update( $new_options, $old_options ) {
		global $wpf_admin;
		
		foreach ( $wpf_admin->fields as $option_id => $args ) {
			// Set all defaults
			if ( $args['default'] && !isset($old_options[$option_id]) ) {
				$old_options[$option_id] = $args['default'];
			}
			
			// fix checboxes
			if ( 'checkbox' == $args['type'] ) {
				if ( isset($new_options[$option_id]) ) {
					$new_options[$option_id] = $args['multiple'] ? $new_options[$option_id] : (bool) $new_options[$option_id];
				} else {
					$new_options[$option_id] = false;
				}
			}
		}
		
		$instance = wp_parse_args( $new_options, $old_options );

		return $instance;
	}

	function form() {
		global $screen_layout_columns, $width, $hide2, $hide3, $hide4; ?>
		
		<?php do_action( "wpf_before_form_{$this->page_slug}" ); ?>
		<div class="metabox-holder">
			<?php			
			echo "\t<div class='postbox-container' style='$width'>\n";
			do_meta_boxes( $this->page_hook, 1, '' );

			echo "\t</div><div class='postbox-container' style='{$hide2}$width'>\n";
			do_meta_boxes( $this->page_hook, 2, '' );

			echo "\t</div><div class='postbox-container' style='{$hide3}$width'>\n";
			do_meta_boxes( $this->page_hook, 3, '' );

			echo "\t</div><div class='postbox-container' style='{$hide4}$width'>\n";
			do_meta_boxes( $this->page_hook, 4, '' );
			echo '</div>';
			?>
		</div><!--.metabox-holder-->
		<br class="clear" />
		<?php if ( $this->has_fields() ) { 
			echo '<input type="submit" class="button-primary" value="Save Changes" />';
		} ?>
		<input type="hidden" name="page" value="<?php echo esc_attr( $_GET['page'] ); ?>" id="page" />
		<?php do_action( "wpf_after_metabox_form_{$this->page_slug}" ); ?>
		
		<?php
	}

	function page_footer() {
		?>
		<form method="get" action="">
			<?php wp_nonce_field( 'closedpostboxes', 'closedpostboxesnonce', false ); ?>
			<?php wp_nonce_field( 'meta-box-order', 'meta-box-order-nonce', false ); ?>
		</form><!--END form-->
		<?php
	}
	
	/**
	 * Displays and error when their are no options registered.
	 *
	 * @since 1.0
	 **/
	function no_options_notice() {
		global $wp_meta_boxes;

		if ( !isset($wp_meta_boxes[$this->page_hook]) ) {
			$message = __( 'There are no registered options on this page.', t() );
			$this->display_notice( apply_filters( "admin_no_options_notice_{$this->page_slug}", $message ), 'error' );
		}
	}
	
	/**
	 * Presets the user's screen layout to 3 columns if it isn't already set.
	 *
	 * @since 1.0
	 **/
	function set_screen_layout_columns() {
		$user = wp_get_current_user();

		if ( !get_user_meta( $user->data->ID, "screen_layout_{$this->page_hook}" ) )
			update_user_meta( $user->data->ID, "screen_layout_{$this->page_hook}", apply_filters( "{$this->page_hook}_screen_layout_columns", (int) $this->args->default_screen_columns ) );
	}

	/**
	 * Registers a maximum of 4 screen columns for the theme options page.
	 *
	 * @since 1.0
	 **/
	function set_max_screen_columns( $columns, $screen ) {
		if ( $screen == $this->page_hook )
			$columns[$this->page_hook] = apply_filters( "{$this->page_hook}_max_screen_columns", (int) $this->args->max_screen_columns );

		return $columns;
	}

	/**
	 * Loads the nessecary javaScript for the metabox functionality.
	 *
	 * @since 1.0
	 **/
	function metabox_scripts() {
		wp_enqueue_script( 'common' );
		wp_enqueue_script( 'wp-lists' );
		wp_enqueue_script( 'postbox' );
	}

	/**
	 * API Hook for adding metaboxes and settings into the options page.
	 *
	 * @since 1.0
	 **/
	function metaboxes_hook() {
		global $wpf_theme;
		
		if ( method_exists( $wpf_theme, 'theme_options' ) ) {
			$wpf_theme->callback( 'theme_options' );
		}
		
		do_action( "wpf_admin_page_{$this->page_slug}" );
	}
	
	function register_metaboxes() {
		if ( !$this->has_metaboxes() )
			return false;
		
		$metaboxes = $this->get_metaboxes();

		foreach ( $metaboxes as $metabox ) {			
			add_meta_box( $metabox['id'], $metabox['title'], array( &$this, 'do_metabox_options' ), $this->page_hook, $metabox['column'], $metabox['priority'] );
		}
	}

	/**
	 * CSS needed for metabox styling.
	 *
	 * @since 1.0
	 **/
	function inject_css_in_head() {
		?>
		<style type="text/css">
			.wpf-wrap hr { background: #ccc; height: 1px; border: none; margin: 10px 0; }
			.wpf-wrap .metabox-holder { clear: both; }
			.wpf-wrap .meta-box-sortables { padding-right: 10px; }
			.wpf-wrap .inside { padding: 0 10px; overflow: hidden; }
			.wpf-wrap .inside select[multiple="multiple"] { height: auto !important; }
		</style>
		<?php
	}

	/**
	 * JavaScript needed for metabox functionality.
	 *
	 * @since 1.0
	 **/
	function inject_javascript_in_head() {
		?>
		<script type="text/javascript">
			//<![CDATA[
			jQuery(document).ready( function($) {
				// close postboxes that should be closed
				$('.if-js-closed').removeClass('if-js-closed').addClass('closed');
				// postboxes setup
				postboxes.add_postbox_toggles('<?php echo $this->page_hook; ?>');
			});
			//]]>
		</script>
		<?php
	}
	
	/**
	 * Internal function called by each metabox in the admin page to loop
	 * through and display any options registered to that metabox.
	 *
	 * @param string $column Data passed as the third parameter in do_meta_boxes().
	 * @param array $args Data passed as the forth parameter in wpf_register_option()
	 * @return void
	 */
	function do_metabox_options( $column, $metabox ) {
		global $wpf_theme;
		if ( !$this->has_fields( $metabox['id'] ) )
			return $this->no_options( $metabox['id'] );

		$options = $this->get_fields( $metabox['id'] );
		
		do_action( "metabox_before_{$metabox['id']}", $column );
		foreach ( $options as $option_id => $option ) {
			if ( $metabox['id'] == $option['metabox'] ) {
				switch ( $option['field_type'] ) {
					case 'custom':
						call_user_func( '__wpf_echo_value', $option['args'] );
						break;
					
					case 'callback':
						if ( function_exists($option['args']) )
							call_user_func( $option['args'], $metabox['id'] );
						break;
					
					case 'radio':
					case 'checkbox':
					case 'text':
					case 'textarea':
					case 'select':
						call_user_func_array( array( $wpf_theme, $option['field_type'] ), array( $option_id, $option['args'], $option['data'] ) );
						break;
						
					default:
						do_action( "wpf_form_callback_{$option['field_type']}", $metabox['id'], $option, $this->page_slug );
						break;
				}
			}
		}
		do_action( "metabox_after_{$metabox['id']}", $column );
	}
	
	function has_metaboxes() {
		global $wpf_admin;
		
		if ( isset( $wpf_admin->metaboxes ) AND isset( $wpf_admin->metaboxes[$this->page_slug] ) )
			return true;
		
		return false;
	}
	
	function get_metaboxes() {
		global $wpf_admin;

		if ( !isset( $wpf_admin->metaboxes ) OR !isset( $wpf_admin->metaboxes[$this->page_slug] ) )
			return false;

		return $wpf_admin->metaboxes[$this->page_slug];
	}
	
	function has_fields( $metabox_id = '' ) {
		$options = $this->get_registered_fields();
		
		if ( $metabox_id )
			return (bool) isset( $options[$metabox_id] );
		else
			return (bool) $options;
		
		return false;
	}
	
	function get_fields( $metabox_id = null ) {
		$options = $this->get_registered_fields();
		
		if ( $metabox_id AND isset($options[$metabox_id]) )
			return $options[$metabox_id];
		elseif ( $options )
			return $options;
	}
	
	function get_registered_fields() {
		global $wpf_admin;

		if ( !isset($wpf_admin->options) OR empty($wpf_admin->options) OR !$this->has_metaboxes() )
			return false;

		$metaboxes = $this->get_metaboxes();
		$metaboxes = array_keys( $metaboxes );
		$registered_options = array();
		
		foreach ( $metaboxes as $metabox ) {
			if ( isset($wpf_admin->options[$metabox]) ) {
				foreach ( $wpf_admin->options[$metabox] as $option_id => $option ) {
					$registered_options[$metabox][$option_id] = array_merge( $option, array( 'metabox' => $metabox) );
				}
			}
		}	
		return $registered_options;
	}
	
	function no_options( $metabox_id ) {
		$message = apply_filters( 'wpf_metabox_no_options', __( 'There are no options for this metabox.', t() ), $metabox_id );
		echo $this->html_wrap( $message, 'p', array( 'class' => 'no-metabox-options' ) );
	}

	function register_form_globals() {
		global $screen_layout_columns, $width, $hide2, $hide3, $hide4;
		
		$hide2 = $hide3 = $hide4 = '';
		switch ( $screen_layout_columns ) {
			case 4:
				$width = 'width: 24.5%;';
				break;
			case 3:
				$width = 'width: 32.67%;';
				$hide4 = 'display: none;';
				break;
			case 2:
				$width = 'width: 49%;';
				$hide3 = $hide4 = 'display: none;';
				break;
			default:
				$width = 'width: 98%;';
				$hide2 = $hide3 = $hide4 = 'display: none;';
		}
	}
}