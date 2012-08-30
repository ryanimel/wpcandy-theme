<?php
/**
 * Custom Template: Loop 404
 *
 * The loop 404 template is used when an no results where returned by the loop.
 *
 * @package WP Framework
 * @subpackage Template
 */
?>

			<?php do_action( 'loop_404_before' ); ?>

			<article id="post-0" class="post error404 not-found">
			
						<?php
						/* When we call the dynamic_sidebar() function, it'll spit out
						 * the widgets for that widget area. If it instead returns false,
						 * then the sidebar simply doesn't exist, so we'll hard-code in
						 * some default sidebar stuff just in case.
						 */
						if ( ! dynamic_sidebar( '404-widget-area' ) ) : ?>
						<?php endif; ?>

				<?php do_action( 'loop_404_content' ); ?>

			</article><!--#post-0-->

			<?php do_action( 'loop_404_after' ); ?>