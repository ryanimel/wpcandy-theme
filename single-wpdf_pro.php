<?php
/**
 * WordPress Template: Single
 *
 * The single template is the general template used when a singular 'post',
 * or custom post type is requested.
 * 
 * If the attachments.php or more specific attachment-based template is not 
 * found, attachments also make use of this template.
 * 
 * To use a custom template for a specfic post type,
 * create a single-{post_type}.php file in the your theme's root directory.
 *
 * Template Hierarchy
 * - single-{post_type}.php
 * - single.php
 * - index.php
 *
 * @package WP Framework
 * @subpackage Template
 */

 ?>
 
<?php get_template_part( 'parts/header', 'pros' ); ?>

				<div id="content" class="column-8 ">

					<?php do_action( 'content_open' ); ?>

					<?php get_template_part( 'parts/loop', 'pro' ); ?>

					<?php do_action( 'content_close' ); ?>

				</div><!-- #content -->

<?php get_template_part( 'parts/footer', 'pros' ); ?>