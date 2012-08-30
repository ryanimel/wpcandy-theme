<?php
/**
 * Custom Template: Archive
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
				

				<?php while ( have_posts() ) : the_post(); ?>
				
					<?php if(in_category('watches')) { ?>
					
					<?php do_action( 'loop_while_before' ); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

						<header>
							
							<div class="content-cats">
								<ul>
									<?php if(in_category('reports')) { ?>
									<li class="news"><a href="<?php bloginfo('url'); ?>/reports/" title="More WPCandy WordPress news">News</a></li>	
									<?php } elseif(in_category('announces')) { ?>
									<li class="announcements"><a href="<?php bloginfo('url'); ?>/announces/" title="More WPCandy announcements">Network</a></li>
									<?php } elseif(in_category('thinks')) { ?>
									<li class="opinion"><a href="<?php bloginfo('url'); ?>/thinks/" title="More WPCandy opinions">Opinion</a></li>
									<?php } elseif(in_category('teaches')) { ?>
									<li class="tutorials"><a href="<?php bloginfo('url'); ?>/teaches/" title="More WPCandy tutorials">Tuts</a></li>
									<?php } elseif(in_category('interviewed')) { ?>										
									<li class="interviews"><a href="<?php bloginfo('url'); ?>/interviewed/" title="More WPCandy interviews">Interview</a></li>
									<?php } elseif(in_category('reviewed')) { ?>
									<li class="reviews"><a href="<?php bloginfo('url'); ?>/reviewed/" title="More WPCandy reviews">Reviews</a></li>
									<?php } elseif(in_category('podcasts')) { ?>
									<li class="podcasts"><a href="<?php bloginfo('url'); ?>/podcasts/" title="More WPCandy podcasts">Podcast</a></li>
									<?php } elseif(in_category('presents')) { ?>
									<li class="features"><a href="<?php bloginfo('url'); ?>/presents/" title="More WPCandy features">Feature</a></li>
									<?php } elseif(in_category('linked')) { ?>
									<li class="links"><a href="<?php bloginfo('url'); ?>/linked/" title="More WPCandy WordPress links">Links</a></li>
									<?php } elseif(in_category('gives-away')) { ?>
									<li class="giveaways"><a href="<?php bloginfo('url'); ?>/gives-away/" title="More WPCandy WordPress giveaways">Gifts</a></li>
									<?php } elseif(in_category('made')) { ?>
									<li class="downloads"><a href="<?php bloginfo('url'); ?>/made/" title="More WPCandy WordPress downloads">Downld</a></li>
									<?php } elseif(in_category('watches')) { ?>
									<li class="videos"><a href="<?php bloginfo('url'); ?>/watches/" title="More WPCandy WordPress videos">Video</a></li>
									<?php } elseif(in_category('sites')) { ?>
									<li class="sites"><a href="<?php bloginfo('url'); ?>/sites/" title="More WPCandy WordPress sites">Sites</a></li>
									<?php } elseif(in_category('recommends')) { ?>
									<li class="bestof"><a href="<?php bloginfo('url'); ?>/recommends/" title="More WPCandy recommendations">Best of</a></li>
									<?php } elseif(in_category('previewed')) { ?>
									<li class="preview"><a href="<?php bloginfo('url'); ?>/previewed/" title="More WPCandy previews">Preview</a></li>
									<?php } elseif(in_category('liveblogged')) { ?>
									<li class="liveblogged"><a href="<?php bloginfo('url'); ?>/liveblogged/" title="More WPCandy Liveblogs">Liveblog</a></li>
									<?php } elseif( in_category( 'the-wpcandy-show' ) ) { ?>
									<li class="broadcasts"><a href="<?php bloginfo('url'); ?>/broadcasts/the-wpcandy-show" title="More WPCandy Liveblogs">Show</a></li>
									<?php } ?>
									
									<?php if(has_tag('wordpress')) { ?>
									<li class="tag"><a href="<?php bloginfo('url'); ?>/on/wordpress" title="More posts on WordPress">WP</a></li>
									<?php } ?>
									<?php if(has_tag('themes')) { ?>
									<li class="tag"><a href="<?php bloginfo('url'); ?>/on/themes" title="More posts on WordPress themes">Themes</a></li>
									<?php } ?>
									<?php if(has_tag('plugins')) { ?>
									<li class="tag"><a href="<?php bloginfo('url'); ?>/on/plugins" title="More posts on WordPress plugins">Plugins</a></li>
									<?php } ?>
									<?php if(has_tag('multisite')) { ?>
									<li class="tag"><a href="<?php bloginfo('url'); ?>/on/multisite" title="More posts on WordPress Multisite">Multisite</a></li>
									<?php } ?>
									<?php if(has_tag('buddypress')) { ?>
									<li class="tag"><a href="<?php bloginfo('url'); ?>/on/buddypress" title="More posts on WordPress BuddyPress">Buddy</a></li>
									<?php } ?>
									<?php if(has_tag('bbpress')) { ?>
									<li class="tag"><a href="<?php bloginfo('url'); ?>/on/bbpress" title="More posts on bbPress">bbPress</a></li>
									<?php } ?>
									<?php if(has_tag('wordcamp')) { ?>
									<li class="tag"><a href="<?php bloginfo('url'); ?>/on/wordcamp" title="More posts on WordCamp">Camp</a></li>
									<?php } ?>
								</ul>
							</div><!-- .content-cats -->
							
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
							<ul>
								<li class="first"><a href="<?php comments_link(); ?>" title="Comment on <?php the_title(); ?>">Leave a comment</a></li>
								<li><a href="http://twitter.com/share" class="twitter-share-button" data-url="<?php the_permalink(); ?>" data-text="<?php the_title(); ?>" data-count="none" data-via="wpcandy" data-related="ryanimel">Tweet this post</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></li>
								<li><iframe src="http://www.facebook.com/plugins/like.php?href=<?php the_permalink(); ?>&amp;layout=standard&amp;show_faces=true&amp;width=290&amp;action=like&amp;font=arial&amp;colorscheme=light&amp;height=30" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:290px; height:30px; margin-top: -2px; margin-bottom: -10px;" allowTransparency="true"></iframe></li>
							</ul>
						</footer><!-- .entry-utility -->

					</article><!-- #post-<?php the_ID(); ?> -->

					<?php do_action( 'loop_while_after' ); ?>
					
					<?php } else { ?>

					<?php do_action( 'loop_while_before' ); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

						<header>
							
							<div class="content-cats">
								<ul>
									<?php if(in_category('reports')) { ?>
									<li class="news"><a href="<?php bloginfo('url'); ?>/reports/" title="More WPCandy WordPress news">News</a></li>	
									<?php } elseif(in_category('announces')) { ?>
									<li class="announcements"><a href="<?php bloginfo('url'); ?>/announces/" title="More WPCandy announcements">Network</a></li>
									<?php } elseif(in_category('thinks')) { ?>
									<li class="opinion"><a href="<?php bloginfo('url'); ?>/thinks/" title="More WPCandy opinions">Opinion</a></li>
									<?php } elseif(in_category('teaches')) { ?>
									<li class="tutorials"><a href="<?php bloginfo('url'); ?>/teaches/" title="More WPCandy tutorials">Tuts</a></li>
									<?php } elseif(in_category('interviewed')) { ?>										
									<li class="interviews"><a href="<?php bloginfo('url'); ?>/interviewed/" title="More WPCandy interviews">Interview</a></li>
									<?php } elseif(in_category('reviewed')) { ?>
									<li class="reviews"><a href="<?php bloginfo('url'); ?>/reviewed/" title="More WPCandy reviews">Reviews</a></li>
									<?php } elseif(in_category('podcasts')) { ?>
									<li class="podcasts"><a href="<?php bloginfo('url'); ?>/podcasts/" title="More WPCandy podcasts">Podcast</a></li>
									<?php } elseif(in_category('presents')) { ?>
									<li class="features"><a href="<?php bloginfo('url'); ?>/presents/" title="More WPCandy features">Feature</a></li>
									<?php } elseif(in_category('linked')) { ?>
									<li class="links"><a href="<?php bloginfo('url'); ?>/linked/" title="More WPCandy WordPress links">Links</a></li>
									<?php } elseif(in_category('gives-away')) { ?>
									<li class="giveaways"><a href="<?php bloginfo('url'); ?>/gives-away/" title="More WPCandy WordPress giveaways">Gifts</a></li>
									<?php } elseif(in_category('made')) { ?>
									<li class="downloads"><a href="<?php bloginfo('url'); ?>/made/" title="More WPCandy WordPress downloads">Downld</a></li>
									<?php } elseif(in_category('watches')) { ?>
									<li class="videos"><a href="<?php bloginfo('url'); ?>/watches/" title="More WPCandy WordPress videos">Video</a></li>
									<?php } elseif(in_category('sites')) { ?>
									<li class="sites"><a href="<?php bloginfo('url'); ?>/sites/" title="More WPCandy WordPress sites">Sites</a></li>
									<?php } elseif(in_category('recommends')) { ?>
									<li class="bestof"><a href="<?php bloginfo('url'); ?>/recommends/" title="More WPCandy recommendations">Best of</a></li>
									<?php } elseif(in_category('previewed')) { ?>
									<li class="preview"><a href="<?php bloginfo('url'); ?>/previewed/" title="More WPCandy previews">Preview</a></li>
									<?php } elseif( in_category( 'the-wpcandy-show' ) ) { ?>
									<li class="broadcasts"><a href="<?php bloginfo('url'); ?>/broadcasts/the-wpcandy-show" title="More WPCandy Liveblogs">Show</a></li>
									<?php } ?>
									
									<?php if(has_tag('wordpress')) { ?>
									<li class="tag"><a href="<?php bloginfo('url'); ?>/on/wordpress" title="More posts on WordPress">WP</a></li>
									<?php } ?>
									<?php if(has_tag('themes')) { ?>
									<li class="tag"><a href="<?php bloginfo('url'); ?>/on/themes" title="More posts on WordPress themes">Themes</a></li>
									<?php } ?>
									<?php if(has_tag('plugins')) { ?>
									<li class="tag"><a href="<?php bloginfo('url'); ?>/on/plugins" title="More posts on WordPress plugins">Plugins</a></li>
									<?php } ?>
									<?php if(has_tag('multisite')) { ?>
									<li class="tag"><a href="<?php bloginfo('url'); ?>/on/multisite" title="More posts on WordPress Multisite">Multisite</a></li>
									<?php } ?>
									<?php if(has_tag('buddypress')) { ?>
									<li class="tag"><a href="<?php bloginfo('url'); ?>/on/buddypress" title="More posts on WordPress BuddyPress">Buddy</a></li>
									<?php } ?>
									<?php if(has_tag('bbpress')) { ?>
									<li class="tag"><a href="<?php bloginfo('url'); ?>/on/bbpress" title="More posts on bbPress">bbPress</a></li>
									<?php } ?>
									<?php if(has_tag('wordcamp')) { ?>
									<li class="tag"><a href="<?php bloginfo('url'); ?>/on/wordcamp" title="More posts on WordCamp">Camp</a></li>
									<?php } ?>
								</ul>
							</div><!-- .content-cats -->
							
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
							<ul>
								<li class="first"><a href="<?php comments_link(); ?>" title="Comment on <?php the_title(); ?>">Leave a comment</a></li>
								<li><a href="http://twitter.com/share" class="twitter-share-button" data-url="<?php the_permalink(); ?>" data-text="<?php the_title(); ?>" data-count="none" data-via="wpcandy" data-related="ryanimel">Tweet this post</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></li>
								<li><iframe src="http://www.facebook.com/plugins/like.php?href=<?php the_permalink(); ?>&amp;layout=standard&amp;show_faces=true&amp;width=350&amp;action=like&amp;font=arial&amp;colorscheme=light&amp;height=30" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:350px; height:30px; margin-top: -2px; margin-bottom: -10px;" allowTransparency="true"></iframe></li>
							</ul>
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