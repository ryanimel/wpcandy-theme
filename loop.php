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

if ( have_posts() ) : ?>

	<?php do_action( 'loop_open' ); ?>

			<div id="hfeed">

				<?php do_action( 'hfeed_open' ); ?>
				<?php do_action( 'loop_has_posts_before' ); ?>

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
							
							<div class="entry-meta">
									<p>By <?php if(function_exists('coauthors_posts_links')) coauthors_posts_links(); else the_author_posts_link(); ?> <em><span class="date-nice"><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?></span><span class="date-long"><?php the_time('F j, Y'); ?></span></em> <?php edit_post_link( 'Edit this post', '| ', '', '' ); ?></p>
									<p class="count"><a href="<?php comments_link(); ?>" title="Comments on <?php the_title(); ?>"><?php comments_number('0', '1', '%'); ?></a></p>
							</div><!-- .entry-meta -->
							
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
							
								<?php if ( !( has_post_format( 'image' ) ) && !( has_post_format( 'gallery' ) ) ) { ?>

								<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', t() ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
								
								<div class="entry-meta">
									<p>By <?php if(function_exists('coauthors_posts_links')) coauthors_posts_links(); else the_author_posts_link(); ?> <em><span class="date-nice"><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?></span><span class="date-long"><?php the_time('F j, Y'); ?></span></em> <?php edit_post_link( 'Edit this post', '| ', '', '' ); ?></p>
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
								
							<?php if ( has_post_format( 'image') || has_post_format( 'gallery' ) || has_post_format( 'link' ) ) { ?>					
							<div class="entry-meta">
								<p>By <?php the_author_posts_link(); ?> <em><span class="date-nice"><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?></span><span class="date-long"><?php the_time('F j, Y'); ?></span></em> <?php edit_post_link( 'Edit this post', '| ', '', '' ); ?></p>
								<p class="count"><a href="<?php comments_link(); ?>" title="Comments on <?php the_title(); ?>"><?php comments_number('0', '1', '%'); ?></a></p>
							</div><!-- .entry-meta -->
							<?php } ?>
							
							<?php } ?>
						
							<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', t() ) ); ?>
							<?php wp_link_pages( array( 'before' => '<div class="page-link"><span class="page-link-meta">' . __( 'Pages:', t() ) . '</span>', 'after' => '</div>', 'next_or_number' => 'number' ) ); ?>
						</div><!-- .entry-content -->
						
						<?php $wpcandy_source = get_post_custom_values('Source'); ?>
						<?php if (isset($wpcandy_source[0])) { ?>
								
						<footer class="entry-utility">
						
							<div class="meta">
								
								<p class="post-source">Source: <?php echo $wpcandy_source[0]; ?></p>
								
								<?php echo get_the_term_list( $post->ID, 'poweredby', 'Powered by: ', ', ', '' ); ?>
								
							</div><!-- .meta -->

						</footer><!-- .entry-utility -->
						
						<?php } ?>

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