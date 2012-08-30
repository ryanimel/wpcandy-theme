<?php
/**
 * WordPress Template: User
 *
 * The user template is the general template used when a user's archive is
 * queried. The user template replaces author-type templates for better
 * semantics.
 * 
 * To use a custom template for a specfic user, create a user-{nicename}.php
 * file, user-{id}.php file, or user-role-{role}.php file in the your theme's 
 * root directory and replace the keywords in brackets with that user's nice 
 * name, id, or role.
 *
 * Template Hierarchy
 * - user-{nicename}.php (i.e. user-ptahdunbar.php)
 * - user-{id}.php (i.e. user-1.php)
 * - user-role-{role}.php (i.e. user-role-subscriber.php)
 * - user.php
 * - archive.php
 * - index.php
 *
 * @package WP Framework
 * @subpackage Template
 */

get_template_part( 'header' ); ?>

				<div id="content" class="column-8">

					<?php do_action( 'content_open' ); ?>
					
					<div id="author-info">
					
						<?php
						global $wp_query;
						$curauth = $wp_query->get_queried_object();
						$authorid = $curauth->ID;
					
						$author_query = new WP_Query( 'author=' . $authorid . '&post_type=wpcandy_team&showposts=1' );
					
						while ( $author_query->have_posts() ) : $author_query->the_post(); ?>
					
						<h1><?php the_title(); ?></h1>
					
						<?php
					
						$taxonomy = 'contributor-role';
						$terms = get_the_terms( $post->ID , $taxonomy );
					
						if ( !empty( $terms ) ) :
						
							foreach ( $terms as $term ) {
						
								$link = get_term_link( $term, $taxonomy );
									
								if ( !is_wp_error( $link ) )
							
									echo '<p class="contributor-role ' . $term->slug. '">' . $term->name . '</p>';
								}
						endif;
					
						?>
					
						<?php the_post_thumbnail( array( 175, 9999 ) ); ?>
						
						<div class="author-info-content">
							<?php the_content(); ?>
						</div>							
						
						<hr />
						
						<?php $post_count = get_usernumposts( $authorid ); ?>
						
						<h2><?php echo $curauth->first_name; ?>&rsquo;s Latest Posts <span>(<?php echo number_format( $post_count ); ?> total)</span></h2>
						
						<p id="author-rss-link"><a href="http://wpcandy.com/author/<?php echo $curauth->user_login; ?>/feed"><?php the_title(); ?>&rsquo;s post feed</a></p>
						
						<?php endwhile;
					
						wp_reset_postdata();
					
						?>
					
					</div><!-- #author-info -->
					
					<?php get_template_part( 'parts/loop', 'archive' ); ?>

					<?php do_action( 'content_close' ); ?>

				</div><!-- #content -->

				<?php get_template_part( 'sidebar' ); ?>

<?php get_template_part( 'footer' ); ?>