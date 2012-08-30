<?php

class WPF_Template_Tags {
	function WPF_Template_Tags() {
		add_action( 'wp_title', array(&$this, 'filter_wp_title'), 9, 3 );

		add_action( 'loop_404_content', array(&$this, 'loop_404_content') );
		
		// add_action( 'loop_has_posts_before', array( &$this, 'add_post_pagination' ) );
		add_action( 'loop_has_posts_after', array( &$this, 'add_post_pagination' ) );

		add_action( 'comments_list_before', 'wpf_comments_pagination' );
		add_action( 'comments_list_after', 'wpf_comments_pagination' );
		
		add_action( 'site_title', array( &$this, 'site_title' ) );
		add_action( 'site_description', array( &$this, 'site_description' ) );
		add_action( 'site_navigation', array( &$this, 'site_navigation' ) );
		
		add_action( 'site_info', array( &$this, 'site_info' ) );
		add_action( 'site_credits', array( &$this, 'site_credits' ) );
	}

	function callback( $method, $args = array() ) {
		if ( method_exists( &$this, $method ) ) {
			return call_user_func_array( array( &$this, $method ), $args );
		}
	}

	function get_method( $method ) {
		if ( method_exists( &$this, $method ) )
			return $method;

		return false;
	}
	
	function add_post_pagination() {
		get_template_part( 'pagination' );
	}

	function site_title() {
		$tag = ( is_home() || is_front_page() ) ? 'h1' : 'div';
		printf( '<%s><span><a href="%s" title="%s" rel="home">%3$s</a></span></%1$s>', $tag, site_url('/'), esc_attr( get_bloginfo('name') ) );
	}
	
	function site_description() {
		bloginfo( 'description' );
	}
	
	function site_navigation() {
		echo wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'nav-menu', 'menu_class' => 'menu wrap', 'theme_location' => 'primary', 'show_home' => true ) );
	}
	
	function site_info() {
		echo '<a href="'. site_url( '/' ) .'">'. get_bloginfo( 'name' ) .'</a>';
	}
	
	function site_credits() {
		echo '<span id="site-generator">'. __( '<a href="http://wordpress.org">Powered by WordPress</a> &', t() ) .'</span>' . PHP_EOL;
		echo '<span id="site-framework">'. __( '<a href="http://devpress.com/themes/wp-framwork/">Built on WP Framework</a>', t() ) .'</span>' . PHP_EOL;
	}

	function loop_404_content() {
		wpautop( __( 'Sorry, but you are looking for something that isn\'t here.' ) );
	}

	function filter_wp_title( $old_title, $sep, $seplocation ) {
		global $wp_query;
		
		$title = '';
		$queried_object = $wp_query->get_queried_object() ? $wp_query->get_queried_object() : false;
		$tagline = apply_filters( 'wpf_document_title_show_site_description', true ) ? " {$sep} " . get_bloginfo( 'description' ) : '';
		$branding_sep = apply_filters( 'wpf_document_title_branding_sep', ' &#8212; ' );

		if ( is_singular() AND !is_front_page() )
			$title = $queried_object->post_title;

		elseif ( is_archive() OR is_search() )
			$title = str_replace( ':', __( ' for ', t() ), strip_tags( $this->archive_title(), 'span' ) );

		elseif ( is_404() )
			$title = __( '404 Not Found', t() );

		/* If paged. */
		if ( ( ( $page = $wp_query->get( 'paged' ) ) || ( $page = $wp_query->get( 'page' ) ) ) && $page > 1 )
			$title = sprintf( __( '%1$s Page %2$s', t() ), $title . " {$sep} ", $page );
		
		if ( $title )
			$title = ( 'right' == $seplocation ) ? "{$title} {$sep} " : " {$sep} {$title}";

		$branding = get_bloginfo( 'name' );
		$branding = ( is_front_page() OR is_home() ) ? $branding . " {$branding_sep} " . get_bloginfo( 'description' ) : $branding;

		$title = ( 'right' == $seplocation ) ? $title . $branding : $branding . $title;

		return apply_filters( 'wpf_document_title', esc_attr( $title ) );
		// return $old_title;
	}
	
	function archive_title() {
		global $wp_query;

		if ( !is_archive() )
			return;

		if ( have_posts() )
			the_post();

		$queried_object = $wp_query->get_queried_object();
				
		if ( is_category() || is_tag() || is_tax() ) {
			$tax_object = get_taxonomy( $queried_object->taxonomy );
			$archive_title = sprintf( __( '%s Archives<span class="meta-sep">:</span> <span>%s</span>', t() ), $tax_object->label, $queried_object->name );
		}

		elseif ( is_author() )
			$archive_title = sprintf( __( 'Author Archives<span class="meta-sep">:</span> <span>%s</span>', t() ), get_the_author_meta( 'display_name', get_query_var( 'author' ) ) );

		elseif ( is_date() ) {
			if ( is_day() )
				$archive_title = sprintf( __( 'Daily Archives<span class="meta-sep">:</span> <span>%s</span>', t() ), get_the_time( __( 'F jS, Y', t() ) ) );

			elseif ( get_query_var( 'w' ) )
				$archive_title = sprintf( __( 'Weekly Archives<span class="meta-sep">:</span> <span>%s</span> of <span>%1$s</span>', t() ), get_the_time( __( 'W', t() ) ) );

			elseif ( is_month() )
				$archive_title = sprintf( __( 'Monthly Archives<span class="meta-sep">:</span> <span>%s</span>', t() ), get_the_date( __( 'F Y', t() ) ) );

			elseif ( is_year() )
				$archive_title = sprintf( __( 'Yearly Archives<span class="meta-sep">:</span> <span>%s</span>', t() ), get_the_time( __( 'Y', t() ) ) );
		}

		elseif ( is_search() )
			$archive_title = sprintf( __( 'Search results for <span>&quot;%s&quot;</span>', t() ), esc_attr( get_search_query() ) );
		
		else
			$archive_title = __( 'Archives', t() );

		rewind_posts();

		return apply_filters( 'wpf_archive_title', $archive_title );
	}
	
	/**
	 * Prints HTML with meta information for the current post—date/time and author.
	 *
	 * @since Twenty Ten 1.0
	 */
	function posted_on() {
		printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', t() ),
			'meta-prep meta-prep-author',
			sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
				get_permalink(),
				esc_attr( get_the_time() ),
				get_the_date()
			),
			sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
				get_author_posts_url( get_the_author_meta( 'ID' ) ),
				sprintf( esc_attr__( 'View all posts by %s', t() ), get_the_author() ),
				get_the_author()
			)
		);
	}
	
	function posted_in() {
		?>
		<?php wpf_the_taxonomies( array('before' => '<span class="taxonomy-links">', 'after' => '</span>' ) ); ?>
		<?php if ( is_single() ) : ?>
			<span class="bookmark-link"><?php printf( __( 'Bookmark the <a href="%s" title="Permalink to %s" rel="bookmark">permalink</a>.', t() ), get_permalink(), the_title_attribute( 'echo=0' ) ); ?></span>
		<?php endif; ?>
		<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', t() ), __( '1 Comment', t() ), __( '% Comments', t() ) ); ?>
		<?php edit_post_link( __( 'Edit', t() ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?></span>
		<?php
	}

	function the_taxonomies( $args = array() ) {
		$defaults = array(
			'post' => 0,
			'before' => '',
			'sep' => ' ',
			'after' => '',
		);

		$args = wp_parse_args( $args, $defaults );
		extract( $args, EXTR_SKIP );

		$taxonomies = get_the_taxonomies();
		$tax_links = '';
		foreach ( $taxonomies as $tax_id => $taxonomy_link ) {
			$tax_links .= "<span class=\"{$tax_id}-links\">{$taxonomy_link}</span>{$sep}";
		}

		echo $before . $tax_links . $after;	
	}
	
	/**
	 * Uses the $comment_type to determine which comment template should be used. Once the 
	 * template is located, it is loaded for use. Child themes can create custom templates based off
	 * the $comment_type. The comment template hierarchy is comment-$comment_type.php, 
	 * comment.php.
	 *
	 * The templates are saved in $hybrid->templates[comment_template], so each comment template
	 * is only located once if it is needed. Following comments will use the saved template.
	 *
	 * @since 0.2.3
	 * @param $comment The comment variable
	 * @param $args Array of arguments passed from wp_list_comments()
	 * @param $depth What level the particular comment is
	 */
	function comments_callback( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		$GLOBALS['comment_depth'] = $depth;

		$comment_type = get_comment_type( $comment->comment_ID );

		$cache = wp_cache_get( 'comment_template' );

		if ( !is_array( $cache ) )
			$cache = array();

		if ( !isset( $cache[$comment_type] ) ) {
			$template = locate_template( array( "comment-{$comment_type}.php", 'comment.php' ) );

			$cache[$comment_type] = $template;
			wp_cache_set( 'comment_template', $cache );
		}

		if ( !empty( $cache[$comment_type] ) )
			require( $cache[$comment_type] );
	}
	
	/**
	 * Ends the display of individual comments. Uses the callback parameter for wp_list_comments(). 
	 * Needs to be used in conjunction with $wpf_theme->comments_callback().
	 *
	 * @since 0.2.3
	 */
	function comments_end_callback() {
		do_action( 'li_comment_close' );

		echo '</li><!-- .comment -->';
	}

	/**
	 * Displays a notice.
	 *
	 * @since 1.0
	 *
	 * @param string $message The message to display.
	 * @param string $status Use 'updated' for successful messages, or 'error' for errors.
	 **/
	function display_notice( $message, $status = 'updated' ) { ?>
		<div id="message" class="<?php echo esc_attr($status); ?>">
			<p><?php echo wp_kses_post( $message ); ?></p>
		</div><!--#message-->
		<?php
	}
	
	function html_wrap( $tag, $content = '', $attrs = array(), $echo = true ) {
		$attrs = $this->parse_attrs( $attrs );
		$tag = esc_attr( $tag );

		$output = "<{$tag}{$attrs}>{$content}</{$tag}>";
		
		if ( !$echo )
			return $output;

		echo $output;
	}
	
	function parse_attrs( $args = array() ) {
		if ( empty($args) )
			return '';
		
		$attrs = '';
		foreach ( (array) $args as $key => $value ) {
			if ( $value ) {
				$attrs .= ' '. $key .'="'. esc_attr($value) .'"';
			}
		}

		return $attrs;
	}
	
	function text( $id, $args ) {
		$value = get_theme_option( $id );
		$value = isset( $args['default'] ) ? $args['default'] : $value;
		$name = THEME_ID .'['. esc_attr($id) .']';
		$attrs = isset( $args['attr'] ) ? $this->parse_attrs( $args['attr'] ) : '';
		?>
		<p>
			<input type="text" id="wpf-form-<?php echo esc_attr($id); ?>" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr($value); ?>"<?php echo $attrs; ?> />
		</p>
		<?php
	}
	
	function textarea( $id, $args ) {
		$value = get_theme_option( $id );
		$value = isset( $args['default'] ) ? $args['default'] : $value;
		$name = THEME_ID .'['. esc_attr($id) .']';
		$attrs = $this->parse_attrs( $args['attr'] );
		$label = isset($args['label']) ? $args['label'] . '<br />' : '';
		?>
		<p>
			<?php echo wp_kses_post( $label ); ?>
			<textarea id="wpf-form-<?php echo esc_attr($id); ?>" name="<?php echo esc_attr($name); ?>"<?php echo $attrs; ?> /><?php echo esc_attr($value); ?></textarea>
		</p>
		<?php
	}
	
	function checkbox( $id, $args, $data ) {
		$value = get_theme_option( $id );
		$name = THEME_ID .'['. esc_attr($id) .']';
		$label = isset($args['label']) ? $args['label'] : '';
		if ( !empty( $data ) ) {
			$name .= '[]';
			foreach ( $data as $option_key => $option_label ) {
				if ( !isset($args['numeric_keys']) )
					$option_key = is_numeric( $option_key ) ? $option_label : $option_key;
				
				$checked = $value ? checked( in_array( $option_key, $value ), true, false ) : null;
				$attrs = isset( $args['attr'] ) ? $this->parse_attrs( $args['attr'] ) : '';
				?>
				<p>
					<label for="wpf-form-<?php echo esc_attr($option_key); ?>">
						<input type="checkbox" id="wpf-form-<?php echo esc_attr($option_key); ?>" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr($option_key); ?>"<?php echo $attrs . $checked; ?> />
						<?php echo wp_kses_post( $option_label ); ?>
					</label>
				</p>
				<?php
			}
		} else {
			$checked = checked( $value, true, false );
			$attrs = isset( $args['attr'] ) ? $this->parse_attrs( $args['attr'] ) : '';
			?>
			<p>
				<label for="wpf-form-<?php echo esc_attr($id); ?>">
					<input type="checkbox" id="wpf-form-<?php echo esc_attr($id); ?>" name="<?php echo esc_attr($name); ?>" value="1"<?php echo $attrs . $checked; ?> />
					<?php echo wp_kses_post( $label ); ?>
				</label>
			</p>
			<?php
		}
	}
	
	function radio( $id, $args, $data ) {
		$value = get_theme_option( $id );
		$name = THEME_ID .'['. esc_attr($id) .']';
		foreach ( $data as $option_key => $option_label ) {
			if ( !isset($args['numeric_keys']) )
				$option_key = is_numeric( $option_key ) ? $option_label : $option_key;
			
			$checked = $value ? checked( $value, $option_key, false ) : null;
			$attrs = isset( $args['attr'] ) ? $this->parse_attrs( $args['attr'] ) : '';
			?>
			<p>
				<label for="wpf-form-<?php echo esc_attr($option_key); ?>">
					<input type="radio" id="wpf-form-<?php echo esc_attr($option_key); ?>" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr($option_key); ?>"<?php echo $attrs . $checked; ?> />
					<?php echo wp_kses_post( $option_label ); ?>
				</label>
			</p>
			<?php
		}
	}
	
	function select( $id, $args, $data ) {
		if ( empty($data) )
			return false;
		
		$value = get_theme_option( $id );
		$name = THEME_ID .'['. esc_attr($id) .']';
		
		if ( isset($args['multiple']) && $args['multiple'] ) {
			$args['attr']['multiple'] = 'multiple';
			$name .= '[]';
		}
		
		$attrs = isset( $args['attr'] ) ? $this->parse_attrs( $args['attr'] ) : '';
		$label = isset($args['label']) ? $args['label'] : '';
		?>
		<p>
			<label for="wpf-form-<?php echo esc_attr($id); ?>">
				<?php
				
				echo wp_kses_post( $label );
				
				if ( isset($args['multiple']) && $args['multiple'] )
					echo '<br />';
				
				?>
				<select id="wpf-form-<?php echo esc_attr($id); ?>" name="<?php echo esc_attr($name); ?>"<?php echo $attrs; ?>>
				<?php
					foreach ( $data as $option_key => $option_label ) {
						if ( !isset($args['numeric_keys']) )
							$option_key = is_numeric( $option_key ) ? $option_label : $option_key;
						
						if ( isset($args['multiple']) && $args['multiple'] ) {
							$selected = $value ? selected( in_array( $option_key, $value ), true, false ) : null;
						} else {
							$selected = selected( $value, $option_key, false );
							$selected = $selected ? $selected : '';
						}
						?>
						<option value="<?php echo esc_attr( $option_key ); ?>"<?php echo esc_attr($selected); ?>><?php echo wp_kses_post($option_label); ?></option>
						<?php
					}
				?>
				</select>
			</label>
		</p>
		<?php
	}
}
