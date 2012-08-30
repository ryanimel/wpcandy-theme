						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							
							<div class="entry-content">
							
								<div id="knapsack-desc">
								
									<h2 class="entry-title"><?php the_title(); ?></h2>
									
									<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', t() ) ); ?>
								
									<?php wp_link_pages( array( 'before' => '<div class="page-link"><span class="page-link-meta">' . __( 'Pages:', t() ) . '</span>', 'after' => '</div>', 'next_or_number' => 'number' ) ); ?>
									
									<?php if ( is_single( '35268' ) ) { // Knapsack/all
									
										get_template_part( 'parts/knapsack', 'all' );
									
									} else if ( is_single( '35263' ) ) { // Knapsack/me
									
										get_template_part( 'parts/knapsack', 'me' );
																					
									} ?>
								
								</div>
							
								<div id="knapsack-image">
								
									<?php the_post_thumbnail( 'issue-big' ); ?>
								
								</div>
								
							</div><!-- .entry-content -->
														
						</article><!-- #post-<?php the_ID(); ?> -->