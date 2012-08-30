<?php
/**
 * WordPress Template: Pros Page
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

 ?>
 
<?php get_template_part( 'parts/header', 'pros' ); ?>

				<div id="content" class="column-8">

					<?php do_action( 'content_open' ); ?>

					<?php get_template_part( 'parts/loop', 'pros' ); ?>

					<?php do_action( 'content_close' ); ?>

				</div><!-- #content -->

<?php get_template_part( 'parts/footer', 'pros' ); ?>