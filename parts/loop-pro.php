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

						<header>
							
							<div class="main">
								
								<h2 class="entry-title"><?php the_title(); ?></h2>
								
								<ul class="pro-actions">
									<?php $wpdflistkey = get_post_meta($post->ID, 'wpdf_listingtype-select', TRUE); if($wpdflistkey == 'Sweet') { ?>
									<li class="pro-sweet">Sweet</li>
									<?php } ?>
									<?php edit_post_link( 'Edit Pro', '<li class="pro-edit-link">', '</li>' ); ?>	
									<?php /*
if (function_exists('wpfp_link')) { 
										
										echo '<li class="pro-favorite-link">';
										wpfp_link(); 
										echo '</li>';
									
									} 
*/?>
								</ul><!-- .pro-actions -->
								
								<div class="entry-meta">
									<p><?php echo get_the_term_list( $post->ID, 'wpdf_location', '<span class="pro-location">near ', ', ', '</span>' ); ?> <?php echo get_the_term_list( $post->ID, 'wpdf_price', 'for <span class="pro-price">', ', ', '</span> per project.' ); ?></p>
								</div><!-- .entry-meta -->
							</div><!-- .main -->
						</header>

						<div class="entry-content">
						
							<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', t() ) ); ?>
							 
							<?php wp_link_pages( array( 'before' => '<div class="page-link"><span class="page-link-meta">' . __( 'Pages:', t() ) . '</span>', 'after' => '</div>', 'next_or_number' => 'number' ) ); ?>
						</div><!-- .entry-content -->
						
						<div id="pro-full">
							
							<?php $wpc_pro_thumbnail_id = get_post_thumbnail_id(get_the_ID()); ?>
							
							<?php $attachments = get_children(array('post_parent'=>$post->ID));
							$wpcandy_pro_portfoliocount = count($attachments);
							
							if ( $wpcandy_pro_portfoliocount > 1 ) { ?>
							
							<h3>Portfolio</h3>
					
							<?php 
							 echo do_shortcode('[gallery exclude=' . $wpc_pro_thumbnail_id . '} size="full" link="file"]'); ?>
							 
							 <?php } else { ?>
							 
							 <?php edit_post_link( 'upload portfolio images from the visual editor', '<div class="note"><h4>Portfolio images missing. What a shame!</h4><p>You can ', '.</p></div>' ); ?>
							 							 
							 <?php } ?>
												
						</div><!-- #pro-full -->

					</article><!-- #post-<?php the_ID(); ?> -->
					
					<div id="pro-secondary">
						
						<div class="pro-logo">
					
						<?php if(has_post_thumbnail()) {
							
							// The check for sweet/basic
							$wpdflistkey = get_post_meta($post->ID, 'wpdf_listingtype-select', TRUE); if($wpdflistkey == 'Sweet') {
								
								the_post_thumbnail( array(205,999) ); 
												
							} else {
															
								the_post_thumbnail( array(205,999) ); 
															
							} // End check for sweet/basic
						
						} else { // If there isn't a thumbnail for this
													
							echo '<img src="'.get_bloginfo("stylesheet_directory").'/library/images/wpcandy-pro-standin.png" />';
													
						} ?>
					
						<?php  ?>
						
					</div><!-- .pro-logo -->
						
						<div id="pro-secondary-meta">
						
							<h3>Skills and Experience</h3>
						
							<?php echo get_the_term_list( $post->ID, 'wpdf_skill', '<p>Skilled in:</p><ul><li> ', '</li><li>', '</li></ul>' ); ?>
							
							<?php echo get_the_term_list( $post->ID, 'wpdf_experience', '<p>Experienced with:</p><ul id="pro-experience-list"><li>', '</li><li>', '</li></ul>' ); ?>
							
							<?php if ( get_post_meta($post->ID, 'wpdf_procontactdetails-website', true) || get_post_meta($post->ID, 'wpdf_procontactdetails-email', true) || get_post_meta($post->ID, 'wpdf_procontactdetails-address', true) || get_post_meta($post->ID, 'wpdf_procontactdetails-phonenumber', true) ) { ?>
							
							<hr />
							
							<h3>Contact Info</h3>
							
							<dl>
								
								<?php if ( get_post_meta($post->ID, 'wpdf_procontactdetails-website', true) ) { ?>
								<dt id="pro-contact-website">Website</dt>
								<dd><a rel="nofollow" href="<?php echo get_post_meta($post->ID, 'wpdf_procontactdetails-website', true); ?>" title="Website"><?php echo get_post_meta($post->ID, 'wpdf_procontactdetails-website', true); ?></a></dd>
								<?php } ?>
								
								<?php if ( get_post_meta($post->ID, 'wpdf_procontactdetails-wporgprofile', true) ) { ?>
								<dt id="pro-contact-wporg">WordPress.org Profile</dt>
								<dd><a rel="nofollow" href="<?php echo get_post_meta($post->ID, 'wpdf_procontactdetails-wporgprofile', true); ?>" title="WordPress.org Profile">WordPress.org Profile</a></dd>
								<?php } ?>
								
								<?php if ( get_post_meta($post->ID, 'wpdf_procontactdetails-twitter', true) ) { ?>
								<dt id="pro-contact-twitter">Twitter</dt>
								<dd><a rel="nofollow" href="http://twitter.com/<?php echo get_post_meta($post->ID, 'wpdf_procontactdetails-twitter', true); ?>" title="Twitter">@<?php echo get_post_meta($post->ID, 'wpdf_procontactdetails-twitter', true); ?></a></dd>
								<?php } ?>
								
								<?php if ( get_post_meta($post->ID, 'wpdf_procontactdetails-facebook', true) ) { ?>
								<dt id="pro-contact-facebook">Facebook</dt>
								<dd><a rel="nofollow" href="<?php echo get_post_meta($post->ID, 'wpdf_procontactdetails-facebook', true); ?>" title="Facebook">Facebook Profile</a></dd>
								<?php } ?>
								
								<?php if ( get_post_meta($post->ID, 'wpdf_procontactdetails-email', true) ) { ?>
								<dt id="pro-contact-email">Email</dt>
								<dd><?php echo get_post_meta($post->ID, 'wpdf_procontactdetails-email', true); ?></dd>
								<?php } ?>
								
								<?php if ( get_post_meta($post->ID, 'wpdf_procontactdetails-address', true) ) { ?>
								<dt id="pro-contact-address">Address</dt>
								<dd><?php echo get_post_meta($post->ID, 'wpdf_procontactdetails-address', true); ?></dd>
								<?php } ?>
								
								<?php if ( get_post_meta($post->ID, 'wpdf_procontactdetails-phonenumber', true) ) { ?>
								<dt id="pro-contact-phonenumber">Phone Number</dt>
								<dd><?php echo get_post_meta($post->ID, 'wpdf_procontactdetails-phonenumber', true); ?></dd>
								<?php } ?>
								
							</dl>
							
							<?php } ?>
							
							
						</div><!-- #pro-secondary-meta -->
						
					</div><!-- #pro-secondary -->
					
					<?php comments_template( '', true ); ?>
					
					<?php if ( ! ( is_user_logged_in() ) ) { ?>
					
					<div class="pro-add-callout">
						<p>You should add yourself as a WPCandy Pro. <a href="http://wpcandy.com/pros/begin-here" title="Become a WPCandy Pro">Start here</a></p>
					</div>
					
					<?php } ?>

				<?php do_action( 'loop_has_posts_after' ); ?>
				<?php do_action( 'hfeed_close' ); ?>

			</div><!-- #hfeed -->

	<?php do_action( 'loop_close' ); ?>

<?php else : ?>

	<?php get_template_part( 'loop-404' ); ?>

<?php endif; ?>