<?php
/**
 * Custom Template: Video
 * 
 * The archive template is the general template used to display the WordPress 
 * loop on archive-base queries.
 *
 * @package WP Framework
 * @subpackage Template
 */

if ( have_posts() ) : ?>

	<?php do_action( 'loop_open' ); ?>

			<div id="hfeed">	
				
				<h2 class="section-header clicked" id="community-videos">Community Videos</h2>
				
				<hr id="topper" />

				<?php while ( have_posts() ) : the_post(); ?>
									
					<?php do_action( 'loop_while_before' ); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

						<header>
							
							<div class="main">
								
								<div class="thumb">
								<?php if(has_post_thumbnail()) { ?>
									<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', t() ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_post_thumbnail( 'video-post-thumbnail' ); ?><img src="<?php bloginfo('stylesheet_directory'); ?>/library/images/video-playbutton.png" class="overlay" /></a>
								<?php } else { ?>
									<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', t() ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><img src="<?php bloginfo('stylesheet_directory'); ?>/library/images/video-standin.jpg" alt="" /><img src="<?php bloginfo('stylesheet_directory'); ?>/library/images/video-playbutton.png" class="overlay" /></a>
								<?php } ?>
								</div>
							
								<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', t() ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a> <em><?php wp_date_in_a_nice_tone(); ?></em></h2>
								
							</div><!-- .main -->
						</header>

					</article><!-- #post-<?php the_ID(); ?> -->

					<?php do_action( 'loop_while_after' ); ?>
					
				<?php endwhile; ?>

				<?php do_action( 'loop_has_posts_after' ); ?>
				<?php do_action( 'hfeed_close' ); ?>
				
				<div class="section" id="wpcandy-interviews">
				
					<h2 class="section-header">WPCandy Interviews</h2>
				
					<?php query_posts('showposts=20&category_name=interviewed');
					if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					
						<header>
						
							<div class="main">
						
								<div class="thumb">
								<?php if(has_post_thumbnail()) { ?>
									<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', t() ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_post_thumbnail('video-post-thumbnail'); ?><img src="<?php bloginfo('stylesheet_directory'); ?>/library/images/video-playbutton.png" class="overlay" /></a>
								<?php } else { ?>
									<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', t() ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><img src="<?php bloginfo('stylesheet_directory'); ?>/library/images/video-standin.jpg" alt="" /><img src="<?php bloginfo('stylesheet_directory'); ?>/library/images/video-playbutton.png" class="overlay" /></a>
								<?php } ?>
								</div><!-- .thumb -->
							
								<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', t() ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a> <em><?php wp_date_in_a_nice_tone(); ?></em></h2>
						
							</div><!-- .main -->
						
						</header>
						
					</article>
					
					<?php endwhile; else:
					endif; wp_reset_query(); ?>
					
				</div><!-- .section -->
				
			</div><!-- #hfeed -->

	<?php do_action( 'loop_close' ); ?>

<?php else : ?>

	<?php get_template_part( 'loop-404' ); ?>

<?php endif; ?>