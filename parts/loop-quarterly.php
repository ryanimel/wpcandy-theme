						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							
							<div class="entry-content">
							
								<div id="issue-desc">
								
									<h2 class="entry-title"><?php the_title(); ?></h2>
									
									<div class="meta">
										<p>Published <?php the_time( 'F, Y' ); ?></p>
									</div>
									
									<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', t() ) ); ?>
								
									<?php wp_link_pages( array( 'before' => '<div class="page-link"><span class="page-link-meta">' . __( 'Pages:', t() ) . '</span>', 'after' => '</div>', 'next_or_number' => 'number' ) ); ?>
								
								</div>
							
								<div id="issue-cover">
								
									<?php the_post_thumbnail( 'issue-big' ); ?>
								
								</div>
								
							</div><!-- .entry-content -->
							
							<footer class="entry-utility">
							
								<h3>In this issue</h3>
								
								<ul>
								<?php $issue_terms = get_the_terms( $post->ID , 'post_tag' );
								
								if ( $issue_terms != '' ) {
								
									foreach ( $issue_terms as $issue_term ) {
								
										$issue_slug = $issue_term->slug;
																				
										$issue_query = new WP_Query( 'post_type=post&showposts=-1&post_status=any&orderby=rand&tag=' . $issue_slug );
										
										while ( $issue_query->have_posts() ) : $issue_query->the_post(); ?>
									
											<li class="contributor">
												
												<div class="avatar">
													<?php echo get_avatar( get_the_author_meta( 'user_email' ), 60 ); ?>
												</div>
												
												<div class="title">
													<p><?php the_title(); ?></p>
													<p class="author"><span>by</span> <?php the_author(); ?></p>
												</div>
												
											</li>
									
										<?php endwhile;
										wp_reset_postdata();
									
									}
								
								} ?>
								</ul>
								
								<div class="clear"></div>
								
							</footer><!-- .entry-utility -->
							
							<div id="mailing-list">
							
								<div class="callout">
									<p>Join our mailing list to get notified when new issues are available.</p>
								</div>
							
								<form action="http://gooroohq.createsend.com/t/r/s/vtupy/" method="post" id="subForm">
								
									<div>
										
										<div class="email">
											<label for="vtupy-vtupy">Email:</label>
											<input type="text" name="cm-vtupy-vtupy" id="vtupy-vtupy" />
										</div>
										
										<div class="also">
											<input type="checkbox" name="cm-ol-bhykyy" id="WPCandy" />
											<label for="WPCandy">Please add me to the WPCandy mailing list too!</label>
										</div>
									
										<input type="submit" value="Submit" class="submit" />
									
									</div>
								</form>
								
								<div class="clear"></div>
							
							</div>
							
						</article><!-- #post-<?php the_ID(); ?> -->