<?php
/**
 * WordPress Template: Taxonomy
 *
 * The taxonomy template is the general template used when a taxonomy is 
 * queried. The category.php and tag.php default to this taxonomy template
 * for better semantics.
 * 
 * To use a custom template for a specfic taxonomy or taxonomy term, create a
 * taxonomy-{taxonomy}.php or taxonomy-{taxonomy}-{term}.php file in the your 
 * theme's root directory.
 *
 * Template Hierarchy
 * - taxonomy-{taxonomy}-{term}.php (i.e. taxonomy-category-uncategorized.php)
 * - taxonomy-{taxonomy}.php (i.e. taxonomy-category.php)
 * - taxonomy.php
 * - archive.php
 * - index.php
 *
 * @package WP Framework
 * @subpackage Template
 */

get_template_part( 'header' ); ?>

				<div id="content" class="column-8">
				
					<div id="page-title-header">
						
					<?php 
					
					// Checks to see if it's in a podcast/show category
					if ( is_category( '1971' ) || is_category( '1825' ) || is_category( '1940' ) || is_category( '1383' ) || is_category( '1924' ) || is_category( '1975' ) || is_category( '261' ) || is_category( '1976' ) ) {
					
					$category_id = get_query_var('cat');
															
					$shows_query = new WP_Query( 'post_type=wpcandy_show&showposts=1&cat=' . $category_id );
									
					while ( $shows_query->have_posts() ) : $shows_query->the_post(); ?>
					
					<div id="shows-info">
					
						<h1><?php the_title(); ?>.</h1>
					
						<?php the_post_thumbnail(); ?>
						
						<div class="shows-info-desc">
						
							<?php the_content(); ?>
					
							<?php
							$taxonomy = 'people';
							$terms = get_the_terms( $post_ID , $taxonomy );
										
							echo '<p class="show-hosts"><strong>Hosted by:</strong>';
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
						
						</div>
						
						<div class="clear"></div>
						
						<hr />
						
						<h2>Latest in <?php the_title(); ?></h2>
						
						<p id="shows-rss-link"><a href="<?php echo get_category_link( $category_id ); ?>/feed">RSS feed</a></p>
						
					</div>
					
					<?php endwhile;
					wp_reset_postdata();
					
					} ?>
				
					</div><!-- #page-title-header -->

					<?php do_action( 'content_open' ); ?>
					
					<?php get_template_part( 'parts/loop', 'archive' ); ?>
					
					<?php do_action( 'content_close' ); ?>

				</div><!-- #content -->

				<?php get_template_part( 'sidebar' ); ?>

<?php get_template_part( 'footer' ); ?>