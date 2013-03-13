<?php
/**
 * The template for displaying Quarterly Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WPCandy Theme
 * @since WPCandy Theme 1.0
 */
get_template_part( 'templates/parts/quarterly', 'header' ); ?>

		<section id="primary" class="content-area">
			<div id="content" class="site-content" role="main">

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					
					<div class="entry-content">
						
						<div id="quarterly-intro">
							<h2>The best parts of the WordPress community, in print.</h2>
							<p>The WPCandy Quarterly intentionally shirks the often fast-paced nature of open source tech news and instead focuses on quality essays and beautiful print design.</p>
							<p>Each issue brings together a handful of essays from prominent members of the WordPress community.</p>
						</div><!-- #quarterly-intro -->

						<div id="issues">
							<ul>

							<?php if ( have_posts() ) : ?>

								<?php /* Start the Loop */
								
								while ( have_posts() ) : the_post();
							
									if ( has_tag( 'not-issue' ) ) {
										
									} else { ?>
										
										<li>
											<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'issue-big' ); ?></a>
											<p><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
										</li>
										
									<?php } 
									
									endwhile;
									else :
									endif; ?>

							</ul>
						</div><!-- #issues -->
						
						<div class="clear"></div>
					
					</div><!-- .entry-content -->

				</article>

			</div><!-- #content .site-content -->
		</section><!-- #primary .content-area -->

<?php get_template_part( 'templates/parts/quarterly', 'footer' ); ?>