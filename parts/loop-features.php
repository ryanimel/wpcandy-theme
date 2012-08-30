<?php
/**
 * Custom Template: Archive for News
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

				<div id="page-title-header">
				<h1 class="page-title">Features</h1>
				<?php echo category_description(); ?>
				<div class="section-rss">
					<p><a href="http://feeds.feedburner.com/wpcandyfeatures" title="Subscribe to WordPress features by RSS">Subscribe to features by RSS</a></p>
				</div><!-- .section-rss -->
				<?php do_action( 'loop_has_posts_before' ); ?>
				</div><!-- #page-title-header -->

				<?php while ( have_posts() ) : the_post(); ?>
				
					<?php if(in_category('watches')) { ?>
					
					<?php do_action( 'loop_while_before' ); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

						<header>
							
							<?php get_template_part( 'parts/content', 'cats' ); ?>
							
							<div class="main">
								
								<?php if(has_post_thumbnail()) { ?>
								<div class="thumb">
								<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', t() ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_post_thumbnail( 'video-post-thumbnail' ); ?></a>
								</div>
								<?php } ?>
							
								<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', t() ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
								
								<?php the_excerpt(); ?>

							</div><!-- .main -->
						</header>

						<footer class="entry-utility">
							
						</footer><!-- .entry-utility -->

					</article><!-- #post-<?php the_ID(); ?> -->

					<?php do_action( 'loop_while_after' ); ?>
					
					<?php } else { ?>

					<?php do_action( 'loop_while_before' ); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

						<header>
							
							<?php get_template_part( 'parts/content', 'cats' ); ?>
														
							<div class="main">
								<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', t() ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

								<div class="entry-meta">
									<p>By <?php the_author_posts_link(); ?> <em><span class="date-nice"><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?></span><span class="date-long"><?php the_time('F j, Y'); ?></span></em> <?php edit_post_link( 'Edit this post', '| ', '', '' ); ?></p>
									<p class="count"><a href="<?php comments_link(); ?>" title="Comments on <?php the_title(); ?>"><?php comments_number('0', '1', '%'); ?></a></p>
								</div><!-- .entry-meta -->
							</div><!-- .main -->
						</header>

						<div class="entry-content">
							<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', t() ) ); ?>
							<?php wp_link_pages( array( 'before' => '<div class="page-link"><span class="page-link-meta">' . __( 'Pages:', t() ) . '</span>', 'after' => '</div>', 'next_or_number' => 'number' ) ); ?>
						</div><!-- .entry-content -->

						<footer class="entry-utility">
							
						</footer><!-- .entry-utility -->

					</article><!-- #post-<?php the_ID(); ?> -->

					<?php do_action( 'loop_while_after' ); ?>
					
					<?php } ?>

				<?php endwhile; ?>

				<?php do_action( 'loop_has_posts_after' ); ?>
				<?php do_action( 'hfeed_close' ); ?>

			</div><!-- #hfeed -->

	<?php do_action( 'loop_close' ); ?>

<?php else : ?>

	<?php get_template_part( 'loop-404' ); ?>

<?php endif; ?>