<?php
/**
 * WordPress Template: Show Schedule Page
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

				<div id="content" class="column-8">

					<?php do_action( 'content_open' ); ?>
					
					<?php get_template_part( 'parts/loop', 'page' ); ?>
					
					<div class="clear"></div>
					
					<div id="show-schedule">
					
						<iframe src="https://www.google.com/calendar/embed?height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=0lgo1sb9bdh4j9u5aobqdn9vok%40group.calendar.google.com&amp;color=%23182C57&amp;ctz=America%2FNew_York" style=" border-width:0 " width="970" height="600" frameborder="0" scrolling="no"></iframe>
						
						<br />
					
					</div><!-- #show-schedule -->
					
					<?php do_action( 'content_close' ); ?>

				</div><!-- #content -->

				<?php get_template_part( 'sidebar' ); ?>

<?php get_template_part( 'footer' ); ?>