<?php
/**
 * Custom Template: Archive for Podcasts
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
				<h1 class="page-title">WordPress Interviewss</h1>
				<?php echo category_description(); ?>
				<div class="section-rss">
					<p><a href="http://feeds.feedburner.com/wpcandyinterviews" title="Subscribe to the WPCandy WordPress interviews by RSS">Subscribe to our interviews by RSS</a></p>
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
					
					<?php } else if ( has_post_format( 'link' ) ) { ?>
					
					<?php do_action( 'loop_while_before' ); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

						<div class="entry-content">
							<p class="post-permalink"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', t() ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">Permalink</a></p>
						
							<?php $wpcandy_link = get_post_custom_values('linkformaturl'); ?>
							<?php if (isset($wpcandy_link[0])) { ?>
							
							<h2 class="entry-title"><a href="<?php echo $wpcandy_link[0]; ?>" title="<?php printf( esc_attr__( 'Permalink to %s', t() ), the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a></h2>
							
							<?php } else { ?>

							<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', t() ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
							
							<?php } ?>
							<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', t() ) ); ?>
							<?php wp_link_pages( array( 'before' => '<div class="page-link"><span class="page-link-meta">' . __( 'Pages:', t() ) . '</span>', 'after' => '</div>', 'next_or_number' => 'number' ) ); ?>
						</div><!-- .entry-content -->

						<footer class="entry-utility">
						
							<div class="meta">
								<?php $wpcandy_source = get_post_custom_values('Source'); ?>
								<?php if (isset($wpcandy_source[0])) { ?>
								<p class="post-source">Source: <?php echo $wpcandy_source[0]; ?></p>
								<?php } ?>
								<?php echo get_the_term_list( $post->ID, 'poweredby', 'Powered by: ', ', ', '' ); ?>
							</div><!-- .meta -->
							
							<ul>
								<li class="first"><a href="<?php comments_link(); ?>" title="Comment on <?php the_title(); ?>">Leave a comment</a></li>
								<li><a href="http://twitter.com/share" class="twitter-share-button" data-url="<?php the_permalink(); ?>" data-text="<?php the_title(); ?>" data-count="none" data-via="wpcandy" data-related="ryanimel">Tweet this post</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></li>
								<li><iframe src="http://www.facebook.com/plugins/like.php?href=<?php the_permalink(); ?>&amp;layout=standard&amp;show_faces=true&amp;width=350&amp;action=like&amp;font=arial&amp;colorscheme=light&amp;height=30" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:350px; height:30px; margin-top: -2px; margin-bottom: -10px;" allowTransparency="true"></iframe></li>
							</ul>
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