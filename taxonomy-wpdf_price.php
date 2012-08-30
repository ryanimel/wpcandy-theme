<?php
/**
 * WordPress Template: Taxonomy
 *
 * The taxonomy template is the general template used when a taxonomy is 
 * queried. The category.php and tag.php default to this taxonomy template
 * for better semantics.
 * 
 * To use a custom template for a specfic taxonomy or taxonomy term, create a
 * taxonomy-{taxonomy}.php or taxonomy-{taxonomy}-{term}.php file in the your 
 * theme's root directory.
 *
 * Template Hierarchy
 * - taxonomy-{taxonomy}-{term}.php (i.e. taxonomy-category-uncategorized.php)
 * - taxonomy-{taxonomy}.php (i.e. taxonomy-category.php)
 * - taxonomy.php
 * - archive.php
 * - index.php
 *
 * @package WP Framework
 * @subpackage Template
 */

 ?>

<?php get_template_part( 'parts/header', 'pros'); ?>
									
				<div id="content" class="column-8">

					<?php do_action( 'content_open' ); ?>
					
					<?php get_template_part( 'parts/loop', 'pros-sorted' ); ?>
					
					<?php do_action( 'content_close' ); ?>

				</div><!-- #content -->

<?php get_template_part( 'parts/footer', 'pros' ); ?>