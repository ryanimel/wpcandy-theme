<?php
/**
 * WordPress Template: Index
 *
 * The index template is used as a fallback template when no other alternative 
 * template is found.
 *
 * @package WP Framework
 * @subpackage Template
 */

?>

<?php get_template_part( 'parts/header', 'knapsack' ); ?>

		<div id="main" role="main">
			
			<?php do_action( 'main_open' ); ?>

			<div class="wrap">
				
				<?php do_action( 'main_wrap_open' ); ?>

				<div id="content" class="column-8">

					<?php do_action( 'content_open' ); ?>
					
					<?php if ( have_posts() ) : ?>
					
					<?php do_action( 'loop_open' ); ?>
					
					<div id="hfeed">
					
						<?php do_action( 'loop_has_posts_before' ); ?>
					
						<?php while ( have_posts() ) : the_post(); ?>

						<?php do_action( 'loop_while_before' ); ?>
						
						<?php get_template_part( 'parts/loop', 'knapsack' ); ?>
						
					<?php do_action( 'loop_while_after' ); ?>
					
					<?php endwhile; ?>
					
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