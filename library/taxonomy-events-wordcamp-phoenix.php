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

get_template_part( 'header' ); ?>

				<div id="page-title-header">
				<h1 class="page-title">WordCamp Phoenix</h1>
				<?php echo category_description(); ?>
				<div class="section-rss">
					<p><a href="http://feeds.feedburner.com/wpcandywcphoenix" title="Subscribe to coverage of WordCamp Phoenix">Subscribe to coverage of WordCamp Phoenix by RSS</a></p>
				</div><!-- .section-rss -->
				<?php do_action( 'loop_has_posts_before' ); ?>
				</div><!-- #page-title-header -->

				<div id="content" class="column-8">

					<?php do_action( 'content_open' ); ?>
					
					<?php get_template_part( 'parts/loop', 'wordcamp-phoenix' ); ?>

					<?php do_action( 'content_close' ); ?>

				</div><!-- #content -->

				<?php get_template_part( 'sidebar', 'phx' ); ?>

<?php get_template_part( 'footer' ); ?>