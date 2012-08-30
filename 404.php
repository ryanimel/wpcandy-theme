<?php
/**
 * WordPress Template: 404
 *
 * The 404 template is used when a user visits an invalid URI on your site,
 * or if WordPress can't find anything that matches the requested query.
 *
 * Template Hierarchy
 * - 404.php
 * - index.php
 *
 * For more information on how WordPress handles 404 errors:
 * @link http://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WP Framework
 * @subpackage Template
 */

@header( 'HTTP/1.1 404 Not found', true, 404 );

get_template_part( 'header' ); ?>

				<div id="content" class="column-8">

					<?php do_action( 'content_open' ); ?>

					<div id="hfeed" class="entry-content">

						<?php do_action( 'hfeed_open' ); ?>

						<h1 class="entry-title">Page not found</h1>
						
						<?php
						/* When we call the dynamic_sidebar() function, it'll spit out
						 * the widgets for that widget area. If it instead returns false,
						 * then the sidebar simply doesn't exist, so we'll hard-code in
						 * some default sidebar stuff just in case.
						 */
						if ( ! dynamic_sidebar( '404-widget-area' ) ) : ?>
						<?php endif; ?>

						<?php do_action( 'hfeed_close' ); ?>

					</div><!-- #hfeed -->

					<?php do_action( 'content_close' ); ?>

				</div><!-- #content -->

				<?php get_template_part( 'sidebar' ); ?>

<?php get_template_part( 'footer' ); ?>