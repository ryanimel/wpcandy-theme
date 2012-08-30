<?php
/**
 * Custom Template: Loop
 * 
 * The loop template is the general template used to display the WordPress
 * loop.
 * 
 * To use a custom loop for a specfic query type, create a loop-{query}.php 
 * file in your parent/child theme's root directory.
 *
 * @package WP Framework
 * @subpackage Template
 */

if ( have_posts() ) : the_post(); ?>

	<?php do_action( 'loop_open' ); ?>

			<div id="hfeed">

				<?php do_action( 'hfeed_open' ); ?>
				<?php do_action( 'loop_has_posts_before' ); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

						<h1 class="entry-title"><?php the_title(); ?></h1>
					
						<div class="entry-content">
							<?php the_content( ); ?>
							
							<?php
							//for a given post type, return all
							$post_type = 'post';
							$tax = 'series';
							$tax_terms = get_terms($tax);
							
							if ($tax_terms) {
							
								foreach ($tax_terms  as $tax_term) {
								
									$args=array(
								
										'post_type' => $post_type,
										"$tax" => $tax_term->slug,
										'post_status' => 'publish',
										'posts_per_page' => 5,
										'caller_get_posts'=> 1,
										'order' => 'DESC'
								
									);
								
									$my_query = null;
									$my_query = new WP_Query($args);
									
									if( $my_query->have_posts() ) {
										
										echo '<h2 class="series-header">'. $tax_term->name . '</h2>';
										
										echo '<div class="series-group">';
										
										while ($my_query->have_posts()) : $my_query->the_post(); ?>
										
										<?php $i++; ?>
										
										<?php if ( $i == '1' ) { 
											the_post_thumbnail( 'thumbnail' );
											echo '<ul>';
										} ?>
										
										<li><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
																				
									<?php endwhile;
								
									} 
									
									$i = '0'; 
									
									echo '</ul>'; 
									
									echo '<p><a href="' . esc_attr( get_term_link( $tax_term, $tax )) . '">More in this series &rarr;</a></p>';
									
									echo '</div>';
									
								wp_reset_query();
								
								}
								
							} ?>
							
							<?php wp_link_pages( array( 'before' => '<div class="page-link"><span class="page-link-meta">' . __( 'Pages:', t() ) . '</span>', 'after' => '</div>', 'next_or_number' => 'number' ) ); ?>

							<div class="clear"></div>
						</div><!-- .entry-content -->

					</article><!-- #post-<?php the_ID(); ?> -->
				
				<?php do_action( 'loop_has_posts_after' ); ?>
				<?php do_action( 'hfeed_close' ); ?>

			</div><!-- #hfeed -->

	<?php do_action( 'loop_close' ); ?>

<?php else : ?>

	<?php get_template_part( 'loop-404' ); ?>

<?php endif; ?>