<?php
/**
 * Template Name: Shows Template
 *
 * @package WPCandy Theme
 * @since WPCandy Theme 1.0
 */

get_header(); ?>

		<div id="primary" class="content-area">
			<div id="content" class="site-content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>
					
					<?php get_template_part( 'content', 'page' ); ?>

					<ul id="shows-list">

					<?php 
					
					$shownum == 0;
					$shows_query = new WP_Query( 'post_type=wpcandy_show&showposts=-1&order=ASC&post_status=any' );

					while ( $shows_query->have_posts() ) : $shows_query->the_post(); ?>

						<li class="shownum-<?php echo $shownum; ?>">

							<?php $show_id = $post->ID;
							$category = get_the_category();
							$category_id = $category[0]->cat_ID;
							$category_link = get_category_link( $category_id );
							
							if ( !( get_post_status( $post_ID ) == 'draft' ) ) { ?>

								<a href="<?php echo esc_url( $category_link ); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail(); ?></a>
								<p class="show-title"><a href="<?php echo esc_url( $category_link ); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a> <a class="feed-link" href="<?php echo get_category_feed_link( $category_id, ''); ?>">Subscribe</a></p>

							<?php } else { ?>

							<?php the_post_thumbnail(); ?>
							<p class="show-title"><?php the_title(); ?> &mdash; Coming soon!</p>

							<?php } ?>

							<div class="show-desc">
								<?php the_excerpt(); ?>
							</div>

							<?php
							$taxonomy = 'people';
							$terms = get_the_terms( $show_id , $taxonomy );

							echo '<p class="show-hosts"><strong>Hosted by:</strong>&nbsp;';
							$showhostnum = 0;

							if ( !empty( $terms ) ) :
								foreach ( $terms as $term ) {
									
									if ( !( $showhostnum == '0' ) ) {
										echo ',&nbsp;';
										echo $term->name;
									} else {
										echo $term->name;
									}
									
									$showhostnum++;
									
								}
								
							endif;

							echo '</p>'; ?>
							
						</li>

						<?php 
						$shownum++;
						endwhile;
						wp_reset_postdata(); ?>

					</ul>

				<?php endwhile; // end of the loop. ?>

			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>