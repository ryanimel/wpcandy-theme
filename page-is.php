<?php
/**
 * WordPress Template: About Page
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
					
					<div id="team-list">
						
						<hr />
						
						<h3>The WPCandy Team</h3>
						
						<ul>
						
						<?php
						
						$authornum == 0;
						$author_query = new WP_Query( 'post_type=wpcandy_team&showposts=-1&order=ASC&orderby=menu_order' );
					
						while ( $author_query->have_posts() ) : $author_query->the_post();
						
						$authornum++;
						
						?>
						
							<li class="teamnum-<?php echo $authornum; ?>">
					
								<a href="http://wpcandy.com/author/<?php the_author_meta( 'user_login' ); ?>"><?php the_post_thumbnail( array( 175, 9999 ) ); ?></a>
						
								<p><a href="http://wpcandy.com/author/<?php the_author_meta( 'user_login' ); ?>"><?php the_title(); ?></a></p>
						
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
			
							</li>
			
						<?php endwhile;
					
						wp_reset_postdata();
					
						?>
						
						<div class="clear"></div>
						
						<p>Would you like to join the WPCandy team? You should <a href="http://wpcandy.com/is/looking-for-authors">get in touch with us</a>.</p>
						
					</div><!-- #team-list -->
					
					<?php do_action( 'content_close' ); ?>

				</div><!-- #content -->

				<?php get_template_part( 'sidebar' ); ?>

<?php get_template_part( 'footer' ); ?>