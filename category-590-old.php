<?php
/**
 * Video archive page
 * @package WP Framework
 * @subpackage Template
 */

get_template_part( 'header' ); ?>

				<div id="page-title-header">
				<h1 class="page-title">Videos</h1>
				<?php echo category_description(); ?>
				<div class="section-rss">
					<p><a href="http://feeds.feedburner.com/wpcandyvideos" title="Subscribe to new WordPress videos by RSS">Subscribe to new videos by RSS</a></p>
				</div><!-- .section-rss -->
				<?php do_action( 'loop_has_posts_before' ); ?>
				</div><!-- #page-title-header -->

				<div id="content" class="column-8">

					<?php do_action( 'content_open' ); ?>

					<?php get_template_part( 'parts/loop', 'video' ); ?>

					<?php do_action( 'content_close' ); ?>

				</div><!-- #content -->

				<?php get_template_part( 'sidebar', 'video' ); ?>

<?php get_template_part( 'footer' ); ?>