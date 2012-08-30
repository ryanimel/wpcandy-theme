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

						<div class="entry-content">
						
							<h1 class="entry-title"><?php the_title(); ?></h1>
						
							<?php the_content( ); ?>
							<?php wp_link_pages( array( 'before' => '<div class="page-link"><span class="page-link-meta">' . __( 'Pages:', t() ) . '</span>', 'after' => '</div>', 'next_or_number' => 'number' ) ); ?>
						</div><!-- .entry-content -->

					</article><!-- #post-<?php the_ID(); ?> -->
				
				<?php do_action( 'loop_has_posts_after' ); ?>
				<?php do_action( 'hfeed_close' ); ?>

			</div><!-- #hfeed -->

	<?php do_action( 'loop_close' ); ?>

<?php else : ?>

	<?php get_template_part( 'loop-404' ); ?>

<?php endif; ?>