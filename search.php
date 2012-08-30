<?php
/**
 * WordPress Template: Search
 *
 * The search template is used when a search term is queried.
 *
 * Template Hierarchy
 * - search.php
 * - archive.php
 * - index.php
 *
 * @package WP Framework
 * @subpackage Template
 */

get_template_part( 'header' ); ?>

				<div id="content" class="column-8">

					<?php do_action( 'content_open' ); ?>
					
					<h3>Search Results for &ldquo;<em><?php the_search_query() ?></em>&rdquo;</h3>
					
					<?php get_search_form(); ?>
					
					<p><a href="http://wpcandy.com/discussion" title="The WPCandy Discussion Board">Post to the forums</a> if you can&rsquo;t find what you&rsquo;re looking for.</p>
					
					<hr />
					
					<?php get_template_part( 'loop', 'search' ); ?>

					<?php do_action( 'content_close' ); ?>

				</div><!-- #content -->

				<?php get_template_part( 'sidebar' ); ?>

<?php get_template_part( 'footer' ); ?>