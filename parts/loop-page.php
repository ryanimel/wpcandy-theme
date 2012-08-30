<?php
/**
 * Custom Template: Loop
 * 
 * The loop template is the general template used to display the WordPress
 * loop.
 * 
 * To use a custom loop for a specfic query type, create a loop-{query}.php 
 * file in your parent/child theme's root directory.
 *
 * @package WP Framework
 * @subpackage Template
 */

if ( have_posts() ) : the_post(); ?>

	<?php do_action( 'loop_open' ); ?>

			<div id="hfeed">

				<?php do_action( 'hfeed_open' ); ?>
				<?php do_action( 'loop_has_posts_before' ); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

						<?php if ( is_front_page() ) { ?>
							<h2 class="entry-title"><?php the_title(); ?></h2>
						<?php } else { ?>
							<h1 class="entry-title"><?php the_title(); ?></h1>
						<?php } ?>

						<div class="entry-content">
						
							<?php if ( is_page('stream') ) { ?>
							
							<script src="http://player.radiocdn.com/iframe.js?hash=1344d3d8cf81cafe05ffd923d713430ad3fb193c-315-135"></script>
							
							
							<p id="streamplaying">Currently playing: <span data-shoutcast-value="songtitle"></span></p>

							<h3>Join the WPCandy Stream chat room</h3>
							<iframe src="http://webchat.freenode.net/?channels=wpcandy" width="600" height="360"></iframe>
					
					<?php } ?>
						
							<?php the_content( ); ?>
							<?php wp_link_pages( array( 'before' => '<div class="page-link"><span class="page-link-meta">' . __( 'Pages:', t() ) . '</span>', 'after' => '</div>', 'next_or_number' => 'number' ) ); ?>

							<?php if ( is_page('coverage') ) { ?>
							
							<?php if ( function_exists('wp_tag_cloud') ) : ?>
							
							<ul id="coverage-switcher">
								<li id="people-trigger" class="selected">People</li>
								<li id="companies-trigger">Companies</li>
								<li id="events-trigger">Events</li>
							</ul>
							
							<div id="coverage-people-wrap" class="coverage-selected">
							
								<div id="coverage-people-list-nav"></div>
							
								<div id="coverage-people">
									<?php 
								
									$people_args = array(
										
										'taxonomy'  => array( 'people' ), 
										'format' => 'list',
										'smallest' => 11,
										'largest' => 11,
										'number' => 0
										
									); 
								
									wp_tag_cloud( $people_args );
								
									?>
								</div><!-- #coverage-people -->
							
							</div><!-- #coverage-people-wrap -->
							
							<div id="coverage-companies-wrap">
							
								<div id="coverage-companies-list-nav"></div>
							
								<div id="coverage-companies">
									<?php 
									
									$company_args = array(
										
										'taxonomy'  => array( 'companies' ), 
										'format' => 'list',
										'smallest' => 11,
										'largest' => 11,
										'number' => 0
										
									); 
								
									wp_tag_cloud( $company_args );
								
									?>
								</div><!-- #coverage-companies -->
							
							</div><!-- #coverage-companies-wrap -->
							
							<div id="coverage-events-wrap">
							
								<div id="coverage-events-list-nav"></div>
							
								<div id="coverage-events">
									<?php 
									
									$event_args = array(
										
										'taxonomy'  => array( 'events' ), 
										'format' => 'list',
										'smallest' => 11,
										'largest' => 11,
										'number' => 0
										
									); 
								
									wp_tag_cloud( $event_args );
								
									?>
								</div><!-- #coverage-events -->
							
							</div><!-- #coverage-companies-wrap -->
							
							<?php endif; ?>
							<?php } ?>

							<div class="clear"></div>
						</div><!-- .entry-content -->

					</article><!-- #post-<?php the_ID(); ?> -->
				
				<?php do_action( 'loop_has_posts_after' ); ?>
				<?php do_action( 'hfeed_close' ); ?>

			</div><!-- #hfeed -->

	<?php do_action( 'loop_close' ); ?>

<?php else : ?>

	<?php get_template_part( 'loop-404' ); ?>

<?php endif; ?>