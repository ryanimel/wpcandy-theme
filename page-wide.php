<?php
/**
 * Template Name: Wide Template
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

get_template_part( 'header' ); ?>

				<div id="content" class="column-16">

					<?php do_action( 'content_open' ); ?>

					<?php get_template_part( 'parts/loop', 'page-wide' ); ?>

					<?php do_action( 'content_close' ); ?>

				</div><!-- #content -->
				
				<?php if ( is_page('stream') ) { 
					
					get_template_part( 'sidebar', 'stream' );
									
				} ?>

<?php get_template_part( 'footer' ); ?>