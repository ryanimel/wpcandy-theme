<?php
/**
 * WordPress Template: Sidebar
 *
 * The sidebar template is used as the primary sidebar for your website.
 * This template is optional and may or may not be called from your other
 * theme's template files.
 *
 * @package WP Framework
 * @subpackage Template
 */


do_action( 'sidebar_before' ); ?>

				<div id="sidebar" class="four columns column-4 last">

					<?php do_action( 'sidebar_open' ); ?>

					<aside role="complementary">

						<?php do_action( 'aside_open' ); ?>
						<?php
						/* When we call the dynamic_sidebar() function, it'll spit out
						 * the widgets for that widget area. If it instead returns false,
						 * then the sidebar simply doesn't exist, so we'll hard-code in
						 * some default sidebar stuff just in case.
						 */
						if ( ! dynamic_sidebar( 'aside-widget-area' ) ) : ?>
						<section id="search" class="widget-container widget_search">
							<?php get_search_form(); ?>
						</section>
						
						<section id="pages" class="widget-container">
							<h3 class="widget-title"><?php _e( 'Pages', t() ); ?></h3>
							<?php wp_page_menu(); ?>
						</section>

						<section id="archives" class="widget-container">
							<h3 class="widget-title"><?php _e( 'Archives', t() ); ?></h3>
							<ul>
								<?php wp_get_archives( 'type=monthly' ); ?>
							</ul>
						</section>

						<section id="meta" class="widget-container">
							<h3 class="widget-title"><?php _e( 'Meta', t() ); ?></h3>
							<ul>
								<?php wp_register(); ?>
								<li><?php wp_loginout(); ?></li>
								<?php wp_meta(); ?>
							</ul>
						</section>
						<?php endif; ?>

						<?php do_action( 'aside_close' ); ?>

					</aside><!--aside-->

					<?php do_action( 'sidebar_close' ); ?>

				</div><!--#sidebar-->

<?php do_action( 'sidebar_after' ); ?>