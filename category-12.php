<?php
/**
 * News archive page
 * @package WP Framework
 * @subpackage Template
 */

get_template_part( 'header' ); ?>

				<div id="content" class="column-8">

					<?php do_action( 'content_open' ); ?>

					<?php get_template_part( 'parts/loop', 'news' ); ?>

					<?php do_action( 'content_close' ); ?>

				</div><!-- #content -->

				<?php get_template_part( 'sidebar' ); ?>

<?php get_template_part( 'footer' ); ?>