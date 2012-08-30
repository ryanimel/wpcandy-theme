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
					
					<div id="archive-info">
					
					<?php 
					wp_reset_postdata();
					$thetax = get_the_terms( $post->ID , 'companies' );
					$thetax_id = $thetax[0]->slug;
										
					$args = array(
						'post_type' => 'wpcandy_wiki',
						'showposts' => 1,
						'tax_query' => array(
							'relation' => 'AND',
							array(
								'taxonomy' => 'companies',
								'field' => 'slug',
								'terms' => $thetax_id
							),
							array(
								'taxonomy' => 'wiki_type',
								'field' => 'slug',
								'terms' => 'company'
							)
						)
					);
					
					$tax_query = new WP_Query( $args );
									
					while ( $tax_query->have_posts() ) : $tax_query->the_post(); ?>
					
						<h1><?php the_title(); ?></h1>
					
						<?php the_post_thumbnail( array(100,100) ); ?>
						
						<div class="archive-info-desc">
						
							<?php the_content(); ?>
							
							<?php if ( has_tag( 'pressedadsadvertiser' ) ) { ?>
							
								<p>Disclaimer: <?php the_title(); ?> has advertised with Pressed Ads.</p>
							
							<?php } ?>
							
							<?php echo get_the_term_list( $post->ID, 'people', '<p class="archive-meta"><strong>Related</strong>: ', ', ', '</p>' ); ?>
												
						</div>
						
						<div class="clear"></div>
						
						<hr />
					
					<?php endwhile;
					wp_reset_postdata(); ?>
						
						<h2>Latest about <?php single_cat_title(); ?></h2>
						
						<?php /*
						<p id="archive-rss-link"><a href="<?php echo get_term_link( $thetax[0]->slug, 'companies' ); ?>/feed"><?php single_cat_title(); ?>&rsquo;s post feed</a></p>
						*/ ?>
				
					</div>
					</div><!-- #page-title-header -->

					<?php do_action( 'content_open' ); ?>
					
					<?php get_template_part( 'parts/loop', 'archive' ); ?>
					
					<?php do_action( 'content_close' ); ?>

				</div><!-- #content -->

				<?php get_template_part( 'sidebar' ); ?>

<?php get_template_part( 'footer' ); ?>