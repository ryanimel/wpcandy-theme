<?php
/**
 * Custom Template: Loop Single
 * 
 * The loop single template is used to display the WordPress loop for
 * singular posts.
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
						
						<?php if ( !( has_post_format( 'link' ) ) ) { ?>
						
						<header>
							
							<?php get_template_part( 'parts/content', 'cats' ); ?>
							
							<div class="main">
								
								<div class="in-series">
									<?php echo get_the_term_list( $post->ID, 'series', '<p><em>From the ', ', ', ' series:</em></p>' ); ?>
								</div><!-- .in-series -->
								
								<?php if ( !( has_post_format( 'image' ) ) && !( has_post_format( 'gallery' ) ) ) { ?>

								<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', t() ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
								
								<div class="entry-meta">
									<p>By <?php if(function_exists('coauthors_posts_links')) coauthors_posts_links(); else the_author_posts_link(); ?> <em><span class="date-nice"><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?></span><span class="date-long"><?php the_time('F j, Y'); ?></span></em> <?php edit_post_link( 'Edit this post', '| ', '', '' ); ?></p>
									<p class="count"><a href="<?php comments_link(); ?>" title="Comments on <?php the_title(); ?>"><?php comments_number('0', '1', '%'); ?></a></p>
								</div><!-- .entry-meta -->

								<?php } ?>
								
							</div><!-- .main -->
						</header>
						<?php } ?>
						
						<div class="entry-content">
							
							<?php if ( has_post_format( 'link' ) || has_post_format( 'image' ) || has_post_format( 'gallery' ) ) { ?>
							
							<?php if ( has_post_format( 'link' ) ) { ?>
							<p class="post-permalink"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', t() ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">Permalink</a></p>
							
							<?php $wpcandy_link = get_post_custom_values('linkformaturl'); ?>
							<?php if (isset($wpcandy_link[0])) { ?>
							
							<h2 class="entry-title"><a href="<?php echo $wpcandy_link[0]; ?>" title="<?php printf( esc_attr__( 'Permalink to %s', t() ), the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a></h2>
							
							<?php } else { ?>

							<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', t() ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
							
							<?php } ?>
							
							<?php } ?>
							
							<?php if ( !has_post_format( 'link' ) ) { ?>
							<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', t() ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
							<?php } ?>
								
							<div class="entry-meta">
								<p>By <?php the_author_posts_link(); ?> <em><span class="date-nice"><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?></span><span class="date-long"><?php the_time('F j, Y'); ?></span></em> <?php edit_post_link( 'Edit this post', '| ', '', '' ); ?></p>
								<p class="count"><a href="<?php comments_link(); ?>" title="Comments on <?php the_title(); ?>"><?php comments_number('0', '1', '%'); ?></a></p>
							</div><!-- .entry-meta -->
							
							<?php } ?>
							
							<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', t() ) ); ?>
							<?php wp_link_pages( array( 'before' => '<div class="page-link"><span class="page-link-meta">' . __( 'Pages:', t() ) . '</span>', 'after' => '</div>', 'next_or_number' => 'number' ) ); ?>
							
							<?php the_revision_note_prd() ?>
							<?php the_revision_list_prd() ?>
							<?php the_revision_diffs_prd() ?>
							
						</div><!-- .entry-content -->

						<footer class="entry-utility">
							
							<div class="meta">
							
								<?php $wpcandy_source = get_post_custom_values('Source'); ?>
								<?php if (isset($wpcandy_source[0])) { ?>
								<p class="post-source">Source: <?php echo $wpcandy_source[0]; ?></p>
								<?php } ?>
								<?php echo get_the_term_list( $post->ID, 'poweredby', 'Powered by: ', ', ', '' ); ?>
								
								<?php 
								$company_terms = get_the_terms( $post->ID , 'companies' );
								
								if ( $company_terms != '' ) { 																									
									foreach ( $company_terms as $company_term ) {
								
										$company_slug = $company_term->slug;
									
										$company_query = new WP_Query( 'post_type=wpcandy_wiki&showposts=1&companies=' . $company_slug );
									
										while ( $company_query->have_posts() ) : $company_query->the_post();
									
											if ( has_tag( 'pressedadsadvertiser' )) { echo '<p>Disclaimer: ' . $company_term->name . ' has advertised on Pressed Ads.</p>'; }
											
											if ( has_tag( 'pressedadspublisher' )) { echo '<p>Disclaimer: ' . $company_term->name . ' is a publisher on Pressed Ads.</p>'; }
									
										endwhile;
										wp_reset_postdata();
									}
								
								} ?>
								
							</div><!-- .meta -->
							
							<p>Tagged with: <?php echo get_the_term_list( $post->ID, 'people', '', ', ', '<br />' ); ?><?php echo get_the_term_list( $post->ID, 'companies', '', ', ', '<br />' ); ?><?php echo get_the_term_list( $post->ID, 'events', '', ', ', '' ); ?></p>
							
						</footer><!-- .entry-utility -->						
						
						<?php if( !in_category('watches') ) { /* ?>
						<div id="nav-prevnext">
							<div id="nav-prevpost">
								<?php previous_post_link('%link','%title', FALSE); ?>
								<?php $prevPost = get_previous_post(false); $prevthumbnail = get_the_post_thumbnail($prevPost->ID, array(75,75) ); if ($prevPost) { echo $prevthumbnail; } ?>
							</div><!-- #nav-prevpost -->
								
							<div id="nav-nextpost">
								<?php next_post_link('%link','%title', FALSE); ?>
								<?php $nextPost = get_next_post(false); $nextthumbnail = get_the_post_thumbnail($nextPost->ID, array(75,75) ); if ($nextPost) { echo $nextthumbnail; } ?>
							</div><!-- #nav-prevpost -->
								
							<div class="clear"></div>
						</div><!-- #nav-prevnext -->
						
						
						
						<div id="post-social">
							<p>Stay up to date on WordPress news: </p>
							<ul>
								<li class="social-twitter"><a href="http://twitter.com/wpcandy" title="WPCandy on Twitter">Follow @wpcandy on Twitter</a></li>
								<li class="social-facebook second"><a href="http://facebook.com/wpcandy" title="WPCandy on Facebook">Like our page on Facebook</a></li>
								<li class="social-rss third last"><a href="http://wpcandy.com/is/syndicated" title="Subscribe to WPCandy via RSS">Subscribe to our RSS Feeds</a></li>
							</ul>
							<div class="clear"></div>
						</div><!-- #post-social -->
						
						<?php */ ?>
						
						<?php } ?>

						
						<div id="author-bio">
							<?php echo get_avatar( get_the_author_email(), '80' ); ?>
							<div class="bio">
								<h5>About the author: <?php the_author_posts_link(); ?> </h5>
							<?php the_author_meta('user_description'); ?>
							</div>
							<div class="clear"></div>
						</div>
						
						<?php /* ?>
						
						<div id="callout-quarterly">
							<a href="http://wpcandy.com/quarterly"><img src="http://wpcandy.com/files/2011/11/quarterly-logo.png" width="150" /></a>
							<div class="text">
								<h4>Do you have your copy of The WPCandy Quarterly?</h4>
								<p>The Quarterly is our print magazine all about WordPress. It is released four times yearly (hence the name) and is filled to the brim with exclusive articles about WordPress, written by some of the brightest minds in the community.</p>
								<p><a href="http://wpcandy.com/quarterly">Pre-order your issue today!</a></p>
							</div><!-- .text -->
							<div class="clear"></div>
						</div>
						
						<?php */ ?>

					</article><!-- #post-<?php the_ID(); ?> -->
					
					<?php comments_template( '/comments.php', true ); 
					//get_template_part( 'comments' ); ?>

				<?php do_action( 'loop_has_posts_after' ); ?>
				<?php do_action( 'hfeed_close' ); ?>

			</div><!-- #hfeed -->

	<?php do_action( 'loop_close' ); ?>

<?php else : ?>

	<?php get_template_part( 'loop-404' ); ?>

<?php endif; ?>