<?php
/**
 * The template for displaying Quarterly Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WPCandy Theme
 * @since WPCandy Theme 1.0
 */
get_template_part( 'templates/parts/quarterly', 'header' ); ?>

		<section id="primary" class="content-area">
			<div id="content" class="site-content" role="main">

				<?php if ( have_posts() ) : ?>

					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>
							
						<?php get_template_part( 'templates/parts/quarterly', 'loop' ); ?>
								
					<?php endwhile; ?>
							
					<?php else : ?>

				<?php endif; ?>

			</div><!-- #content .site-content -->
		</section><!-- #primary .content-area -->

<?php get_template_part( 'templates/parts/quarterly', 'footer' ); ?>