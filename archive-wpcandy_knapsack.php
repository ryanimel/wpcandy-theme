<?php
/**
 * WordPress Template: Page
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

get_template_part( 'parts/header', 'knapsack' ); ?>

	<div id="main" role="main">
			
			<?php do_action( 'main_open' ); ?>

			<div class="wrap">
				
				<?php do_action( 'main_wrap_open' ); ?>

				<div id="content" class="column-8">

					<?php do_action( 'content_open' ); ?>
					
<?php if ( have_posts() ) : the_post(); ?>					
	<?php do_action( 'loop_open' ); ?>

			<div id="hfeed">

					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

						<div class="entry-content">
														
							<?php
							
							// The Query
							$knapsack_query = new WP_Query( 'page_id=35253' );
							
							// The Loop
							while ( $knapsack_query->have_posts() ) : $knapsack_query->the_post();
								
								the_content();
								
							endwhile;
							
							// Reset Post Data
							wp_reset_postdata();
							
							?>

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
										

					<?php do_action( 'content_close' ); ?>

				</div><!-- #content -->

				<?php get_template_part( 'sidebar', 'knapsack' ); ?>
				
				<?php do_action( 'main_wrap_close' ); ?>
				
			</div><!--#main.wrap-->

			<?php do_action( 'main_close' ); ?>

		</div><!--#main-->

<?php get_template_part( 'parts/footer', 'knapsack' ); ?>