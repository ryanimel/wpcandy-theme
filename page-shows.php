<?php
/**
 * WordPress Template: Shows Page
 * 
 * The page template is the general template used when a singular 'page'
 * post type is queried.
 * 
 * This template can be overriden if the page is set to use a custom page 
 * template or if WordPress can match that page's slug or id with a 
 * page-{slug}.php or page-{id}.php file in the parent/child theme's directory.
 *
 * Template Hierarchy
 * - custom template
 * - page-{slug}.php
 * - page-{id}.php
 * - page.php
 * - index.php
 *
 * @package WP Framework
 * @subpackage Template
 */

get_template_part( 'header' ); ?>

				<div id="content" class="column-8">

					<?php do_action( 'content_open' ); ?>
					
					<div id="hfeed">
					
						<article>
						
							<h1 class="entry-title">WPCandy Shows</h1>
						
							<div class="entry-content">
							
								<?php the_content(); ?>
							
								<ul id="shows-list">
								
									<?php 
									
									$shownum == 0;
									$shows_query = new WP_Query( 'post_type=wpcandy_show&showposts=-1&order=ASC&orderby=menu_order&post_status=any' );
									
									while ( $shows_query->have_posts() ) : $shows_query->the_post();
									
									?>
									
									<li class="shownum-<?php echo $shownum; ?>">
									
										<?php $show_id = $post->ID;
										$category = get_the_category();
										$category_id = $category[0]->cat_ID;
										$category_link = get_category_link( $category_id ); ?>
										
										<?php if ( !( get_post_status( $post_ID ) == 'draft' ) ) { ?>
											
											<a href="<?php echo esc_url( $category_link ); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail(); ?></a>
											<p class="show-title"><a href="<?php echo esc_url( $category_link ); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></p>
										
										<?php } else { ?>
											
											<?php the_post_thumbnail(); ?>
											<p class="show-title"><?php the_title(); ?> &mdash; Coming soon!</p>
											
										<?php } ?>
										
										<div class="show-desc">
											<?php the_content(); ?>
											
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
										
										echo '</p>';
					
										?>
										
									</li>
									
									<?php $shownum++;
									endwhile;
									wp_reset_postdata(); ?>
									
								</ul>
							
							</div><!-- .entry-content -->
						
						</article>
					
					</div>
					
					<?php do_action( 'content_close' ); ?>

				</div><!-- #content -->

				<?php get_template_part( 'sidebar' ); ?>

<?php get_template_part( 'footer' ); ?>