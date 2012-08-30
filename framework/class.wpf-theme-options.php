<?php

class WPF_Theme_Options extends WPF_Admin_Metabox {
	function WPF_Theme_Options() {
		$this->WPF_Admin_Metabox( array(
			'default_screen_columns' => apply_filters( 'wpf_default_screen_columns', (int) 3 ),
			'max_screen_columns' => apply_filters( 'wpf_max_screen_columns', (int) 4 ),
		) );
	}

	function admin_menu() {
		if ( current_theme_supports('theme-options') )
			add_theme_page( __( 'Theme Options', t() ), __( 'Theme Options', t() ), 'edit_theme_options', 'options', array( $this, 'init' ) );
	}

	function page_header() {
		screen_icon( 'themes' );
		echo $this->html_wrap( __( 'Theme Options', t() ), 'h2' );
	}
}