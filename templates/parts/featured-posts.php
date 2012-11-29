<div id="featured-posts">

	<ul id="featured-posts-list">

		<?php
		$args = array(
			'tag'				=> 'featured',
			'posts_per_page'	=> 3,
		);

		$featured_query = new WP_Query( $args ); 
		
		$i = 0;
		while ( $featured_query->have_posts() ) : $featured_query->the_post();
		$i++;
		?>

		<li class="featured-post num-<?php echo $i; if ( $i == 1 ) { echo ' first'; } if ( $i == 3 ) { echo ' last'; } ?>">
			<div class="image">
				<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'wpcandy_theme' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_post_thumbnail( 'post-banner' ); ?></a>
			</div><!-- .image -->
			<div class="title">
				<div class="title-wrap">
					<p>
						<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'wpcandy_theme' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
							<?php if ( strlen( $post->post_title ) > 45 ) {
								echo substr( the_title( $before = '', $after = '', FALSE), 0, 45 ) . '&hellip;'; 
							} else {
								the_title();
							} ?>
						</a>
					</p>
					<p class="comments">
						<a href="<?php the_permalink(); ?>" class="comments" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'wpcandy_theme' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php comments_number( 'Leave a comment', '1 Comment', '% Comments' ); ?></a>
					</p><!-- .comments -->
				</div><!-- .title-wrap -->
			</div><!-- .title -->
		</li><!-- .featured-post -->
		
		<?php
		endwhile;
		wp_reset_postdata(); ?>

	</ul>
	<div class="clear"></div>
</div><!-- #featured-posts -->