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
	
			<div id="hfeed" class="blah">
			
				<?php if (is_date()) { ?>
					
					<?php /* If this is a daily archive */ if ( is_day() ) { ?>
					
					<h1 class="page-title archive-title">You&rsquo;re browsing posts from <?php the_time( 'F jS, Y' ); ?></h1>
					
					<?php /* If this is a monthly archive */ } elseif ( is_month() ) { ?>
					
					<h1 class="page-title archive-title">You&rsquo;re browsing posts from <?php the_time( 'F, Y' ); ?></h1>
					
					<?php /* If this is a yearly archive */ } elseif ( is_year() ) { ?>
					
					<h1 class="archive-title">You&rsquo;re browsing posts from <?php the_time( 'Y' ); ?></h1>
					
					<?php } ?>
					
					<div class="browse-yearly browsing-<?php the_time( 'Y' ); ?>">
										
						<ul id="coverage-switcher">
							<li class="browse-2007"><a href="http://wpcandy.com/2007" title="Browse posts from 2007 on WPCandy">2007</a></li>
							<li class="browse-2008"><a href="http://wpcandy.com/2008" title="Browse posts from 2008 on WPCandy">2008</a></li>
							<li class="browse-2009"><a href="http://wpcandy.com/2009" title="Browse posts from 2009 on WPCandy">2009</a></li>
							<li class="browse-2010"><a href="http://wpcandy.com/2010" title="Browse posts from 2010 on WPCandy">2010</a></li>
							<li class="browse-2011"><a href="http://wpcandy.com/2011" title="Browse posts from 2011 on WPCandy">2011</a></li>
							<li class="browse-2012"><a href="http://wpcandy.com/2012" title="Browse posts from 2012 on WPCandy">2012</a></li>
						</ul>
					
					</div>
					
					<div class="browse-monthly browsing-<?php the_time( 'F' ); ?>">
										
						<ul>
							<li class="browse-january"><a href="http://wpcandy.com/<?php the_time( 'Y' ); ?>/01" title="Browse posts from January <?php the_time( 'Y' ); ?> on WPCandy">Jan</a></li>
							<li class="browse-february"><a href="http://wpcandy.com/<?php the_time( 'Y' ); ?>/02" title="Browse posts from February <?php the_time( 'Y' ); ?> on WPCandy">Feb</a></li>
							<li class="browse-march"><a href="http://wpcandy.com/<?php the_time( 'Y' ); ?>/03" title="Browse posts from March <?php the_time( 'Y' ); ?> on WPCandy">Mar</a></li>
							<li class="browse-april"><a href="http://wpcandy.com/<?php the_time( 'Y' ); ?>/04" title="Browse posts from April <?php the_time( 'Y' ); ?> on WPCandy">Apr</a></li>
							<li class="browse-may"><a href="http://wpcandy.com/<?php the_time( 'Y' ); ?>/05" title="Browse posts from May <?php the_time( 'Y' ); ?> on WPCandy">May</a></li>
							<li class="browse-june"><a href="http://wpcandy.com/<?php the_time( 'Y' ); ?>/06" title="Browse posts from June <?php the_time( 'Y' ); ?> on WPCandy">Jun</a></li>
							<li class="browse-july"><a href="http://wpcandy.com/<?php the_time( 'Y' ); ?>/07" title="Browse posts from July <?php the_time( 'Y' ); ?> on WPCandy">Jul</a></li>
							<li class="browse-august"><a href="http://wpcandy.com/<?php the_time( 'Y' ); ?>/08" title="Browse posts from August <?php the_time( 'Y' ); ?> on WPCandy">Aug</a></li>
							<li class="browse-september"><a href="http://wpcandy.com/<?php the_time( 'Y' ); ?>/09" title="Browse posts from September <?php the_time( 'Y' ); ?> on WPCandy">Sep</a></li>
							<li class="browse-october"><a href="http://wpcandy.com/<?php the_time( 'Y' ); ?>/10" title="Browse posts from October <?php the_time( 'Y' ); ?> on WPCandy">Oct</a></li>
							<li class="browse-november"><a href="http://wpcandy.com/<?php the_time( 'Y' ); ?>/11" title="Browse posts from November <?php the_time( 'Y' ); ?> on WPCandy">Nov</a></li>
							<li class="browse-december"><a href="http://wpcandy.com/<?php the_time( 'Y' ); ?>/12" title="Browse posts from December <?php the_time( 'Y' ); ?> on WPCandy">Dec</a></li>
						</ul>
					
					</div>
										
				<?php } ?>
				
				<?php while ( have_posts() ) : the_post(); ?>
				
					<?php if ( has_post_format( 'link' ) ) { ?>
					
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
							
						</footer><!-- .entry-utility -->

					</article><!-- #post-<?php the_ID(); ?> -->

					<?php do_action( 'loop_while_after' ); ?>
					
					<?php } else { ?>

					<?php do_action( 'loop_while_before' ); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

						<header>
							
							<?php get_template_part( 'parts/content', 'cats' ); ?>
							
							<div class="main">
								<?php if ( !( has_post_format( 'image' ) ) && !( has_post_format( 'gallery' ) ) ) { ?>

								<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', t() ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
								
								<div class="entry-meta">
									<p>By <?php the_author_posts_link(); ?> <em><span class="date-nice"><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?></span><span class="date-long"><?php the_time('F j, Y'); ?></span></em> <?php edit_post_link( 'Edit this post', '| ', '', '' ); ?></p>
									<p class="count"><a href="<?php comments_link(); ?>" title="Comments on <?php the_title(); ?>"><?php comments_number('0', '1', '%'); ?></a></p>
								</div><!-- .entry-meta -->

								<?php } ?>
							</div><!-- .main -->
						</header>

						<div class="entry-content">
							
							<?php if ( has_post_format( 'link' ) || has_post_format( 'image' ) || has_post_format( 'gallery' ) ) { ?>
							
							<?php if ( has_post_format( 'link' ) ) { ?>
							<p class="post-permalink"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', t() ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">Permalink</a></p>
							<?php } ?>
							
							<?php $wpcandy_link = get_post_custom_values('linkformaturl'); ?>
							<?php if (isset($wpcandy_link[0])) { ?>
							
							<h2 class="entry-title"><a href="<?php echo $wpcandy_link[0]; ?>" title="<?php printf( esc_attr__( 'Permalink to %s', t() ), the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a></h2>
							
							<?php } else { ?>

							<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', t() ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
							
							<?php } ?>
								
							<?php if ( has_post_format( 'image') || has_post_format( 'gallery' ) ) { ?>					
							<div class="entry-meta">
								<p>By <?php if(function_exists('coauthors_posts_links')) coauthors_posts_links(); else the_author_posts_link(); ?> <em><span class="date-nice"><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?></span><span class="date-long"><?php the_time('F j, Y'); ?></span></em> <?php edit_post_link( 'Edit this post', '| ', '', '' ); ?></p>
								<p class="count"><a href="<?php comments_link(); ?>" title="Comments on <?php the_title(); ?>"><?php comments_number('0', '1', '%'); ?></a></p>
							</div><!-- .entry-meta -->
							<?php } ?>
							
							<?php } ?>
						
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