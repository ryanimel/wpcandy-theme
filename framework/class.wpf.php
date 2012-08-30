<?php

/**
 * Base class for making the site display.
 *
 * @since 1.0.0
 */
class WPF extends WPF_Template_Tags {
	/**
	 * Stores the text domain for the active theme.
	 *
	 * @access public
	 * @since 1.0
	 * @see t()
	 * @var string
	 */
	var $textdomain;

	/**
	 * Sets the global $content_width variable.
	 *
	 * @access public
	 * @since 1.0
	 * @see wpf_get_content_width();
	 * @var int
	 */
	var $content_width;

	var $strings = array();

	/**
	 * Front controller that hooks into the template files and bootstraps all
	 * the functionality.
	 *
	 * @since 1.0
	 */
	function WPF( $args = array() ) {
		global $content_width;
		$args = (object) $args;

		$this->content_width = isset($args->content_width) ? $args->content_width : $content_width;
		$this->textdomain = isset($args->textdomain) ? $args->textdomain : t();
		$this->excerpt_length = isset($args->excerpt_length) ? $args->excerpt_length : 15;
		
		$this->strings = ( isset($args->strings) ) ? wp_parse_args( wpf_get_strings(), $args->strings ) : wpf_get_strings();

		// hooks
		add_action( 'init', array( &$this, 'init' ) );
		add_action( 'wp_loaded', array( &$this, 'wp_loaded' ) );
		add_action( 'template_redirect', array( &$this, 'template_redirect' ) );
		add_action( 'widgets_init', array( &$this, 'widgets_init' ) );

		if ( is_admin() )
			$this->callback( 'admin' );
		else
			$this->front();
	}

	function front() {
		// Load translation files
		add_action( 'init', array( &$this, 'load_theme_translations' ) );

		// Remove recent comments style
		add_action( 'widgets_init', array( &$this, 'remove_recent_comments_style' ) );

		// Add BuddyPress integration
		add_action( 'init', array($this, 'bp_integration') );

		// add support for modenizr
		add_filter( 'language_attributes', array( &$this, 'html_attrs' ) );

		// enqeue comment js
		add_action( 'template_redirect', array( &$this, 'enqueue_comment_reply_js' ) );
		
		add_filter( 'excerpt_length', array( &$this, 'excerpt_length' ) );
		add_filter( 'excerpt_more', array( &$this, 'excerpt_more' ) );

		// Improve the template heirarchy
		add_filter( 'author_template', array( &$this, 'filter_author_template' ) );
		add_filter( 'tag_template', array( &$this, 'filter_taxonomy_template' ) );
		add_filter( 'category_template', array( &$this, 'filter_taxonomy_template' ) );
		
		add_post_type_support( 'attachment', 'comments' );

		$this->callback( 'WPF_Template_Tags' );
	}

	function init() {}
	function wp_loaded() {}
	function template_redirect() {}
	function widgets_init() {}
	
	function bp_integration() {
		if ( !defined( 'BP_VERSION' ) )
			return;
	}
	
	function excerpt_length() {
		return $this->excerpt_length;
	}
	
	function excerpt_more() {
		return ' &hellip; ' . $this->more_link();
	}
	
	function more_link() {
		return ' <a href="'. get_permalink() . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentyten' ) . '</a>';
	}
	
	/**
	 * Searchs for the registered locale .mo language files and loads them up for translation.
	 *
	 * @since 1.0
	 * @uses get_locale();
	 * @uses load_textdomain();
	 **/
	function load_theme_translations() {
		$textdomain = t();
		$locale = get_locale();

		$files[] = array( THEME_I18N . "/{$textdomain}-{$locale}.mo", "{$textdomain}-{$locale}.mo" );

		$translations = locate_template( $files );
		if ( $translations ) {
			load_textdomain( $textdomain, $translations );
		}
	}
	
	/**
	 * Overrides WP's default template for author-based archives. Better abstraction 
	 * of templates than is_author() allows by allowing themes to specify templates for 
	 * a specific author. The hierarchy is author-$author.php, author.php.
	 *
	 * @since 1.0
	 * @uses locate_template() Checks for template in child and parent theme.
	 * @param string $template
	 * @return string Full path to file.
	 */
	function filter_author_template( $template ) {
		$templates = array();
		$user_id = absint( get_query_var( 'author' ) );
		$name = get_the_author_meta( 'user_nicename', $user_id );
		$user = new WP_User( $user_id );

		$templates = array( "user-{$name}.php", "user-{$user_id}.php", "author-{$name}.php", "author-{$user_id}.php" );

		if ( !empty( $user->roles ) ) {
			foreach ( $user->roles as $role )
				$templates[] = "user-role-{$role}.php";
		}

		$templates[] = 'user.php';
		$templates[] = 'author.php';
		$templates[] = 'archive.php';

		return locate_template( $templates );
	}

	/**
	 * Overrides WP's default template for category- and tag-based archives. This allows 
	 * better organization of taxonomy template files by making categories and post tags 
	 * work the same way as other taxonomies. The hierarchy is taxonomy-$taxonomy-$term.php,
	 * taxonomy-$taxonomy.php, taxonomy.php, archive.php.
	 *
	 * @since 1.0
	 * @uses locate_template() Checks for template in child and parent theme.
	 * @param string $template
	 * @return string Full path to file.
	 */
	function filter_taxonomy_template( $template ) {
		global $wp_query;

		$term = $wp_query->get_queried_object();

		$templates = array( "taxonomy-{$term->taxonomy}-{$term->slug}.php", "taxonomy-{$term->taxonomy}.php" );

		// Backwards Compat.
		if ( is_category() ) {
			$templates[] = "category-{$term->taxonomy}.php";
			$templates[] = "category-{$term->term_id}.php";
			$templates[] = 'category.php';
		}

		if ( is_tag() ) {
			$templates[] = "tag-{$term->taxonomy}.php";
			$templates[] = "tag-{$term->term_id}.php";
			$templates[] = 'tag.php';
		}

		$templates[] = 'taxonomy.php';
		$templates[] = 'archive.php';

		return locate_template( $templates );
	}
	
	function html_attrs( $attrs ) {
		return $attrs .= ' class="no-js"';
	}
	
	/**
	 * Enqueue the comment reply js
	 *
	 * @since 1.0
	 **/
	function enqueue_comment_reply_js() {
		if ( is_singular() && get_option( 'thread_comments' ) )
			wp_enqueue_script( 'comment-reply' );
	}

	/**
	 * Removes the default styles that are packaged with the Recent Comments widget.
	 *
	 * To override this in a child theme, remove the filter and optionally add your own
	 * function tied to the widgets_init action hook.
	 *
	 * @since 1.0
	 */
	function remove_recent_comments_style() {
		global $wp_widget_factory;

		if ( isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments']) ) {
			remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
		}
	}
}