<?php
/**
 * Template Name: My Account Template
 *
 * @package WPCandy Theme
 * @since WPCandy Theme 1.0
 */

// If not logged in, send to the login screen.
if ( ! is_user_logged_in() ) {
	wp_redirect( wp_login_url() );
	exit;
}

get_header(); ?>

		<div id="primary" class="content-area">
			<div id="content" class="site-content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<header class="entry-header">
							<h1 class="entry-title"><?php the_title(); ?></h1>
						</header><!-- .entry-header -->

						<div class="entry-content">
							
							<?php 
							$user_id = get_current_user_id(); 
							?>
							
							<div class="account-card odd">
								<div class="heading">
									<h3>Account Information</h3>
								</div><!-- .heading -->
								<div class="content">
									<?php echo get_avatar( $user_id, 150 ); ?>
									<dl>
										<dt>Account Name</dt>
										<dd><?php wpcandy_user_name( $user_id ); ?></dd>
										<dt>Email:</dt>
										<dd><?php wpcandy_user_email( $user_id ); ?></dd>
										<dt>Account Type:</dt>
										<dd><?php wpcandy_user_role( $user_id ); ?></dd>
										<dt>Registered:</dt>
										<dd><?php wpcandy_user_registration_date( $user_id );  ?></dd>
									</dl>
								</div><!-- .content -->
							</div><!-- .account-card -->
							
							<div class="account-card">
								<div class="heading">
									<h3>My Purchases</h3>
								</div><!-- .heading -->
								<div class="content">
										
										<?php wpcandy_show_purchase_history(); ?>
										
								</div><!-- .content -->
							</div><!-- .account-card -->
							
							<div class="account-card odd">
								<div class="heading">
									<h3>My Pros</h3>
								</div><!-- .heading -->
								<div class="content">
									<?php if ( wpcandy_user_has_pros( $user_id ) ) { ?>
									
									<?php $args = array(
										'author'			=> $user_id,
										'order'				=> 'ASC',
										'post_type'			=> 'wpdf_pro',
										'posts_per_page'	=> -1,
									);
									$pros_query = new WP_Query( $args );
									
									while ( $pros_query->have_posts() ) : $pros_query->the_post(); ?>
										
										<div class="pro-card">
											
											<div class="pro-image">
												<a href="<?php the_permalink(); ?>"><?php echo get_the_post_thumbnail( get_the_ID(), 'pro-logo-thumbnail' ); ?></a>
											</div><!-- .pro-image -->
											
											<div class="pro-info">
												
												<div class="pro-title">
													<p><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
												</div><!-- .pro-title -->
											
												<div class="pro-links">
													<ul>
														<?php $type = get_post_meta( get_the_ID(), 'wpdf_listingtype-select', true );
														if ( $type == 'wBasic' ) {
															echo '<li>Basic Pro</li>';
														} else {
															echo '<li>Sweet Pro</li>';
														} ?>
														<li>Created: <?php echo get_the_date(); ?></li>
														<li><?php edit_post_link( __( 'Edit Pro' ), '', '', get_the_ID() ); ?></li>	
													</ul>
												</div><!-- .pro-links -->

											</div><!-- .pro-info -->
										
										</div><!-- .pro-card -->

									<?php endwhile; 
									
									} else { ?>
										<p>You don't have any Pros!</p>
									<?php } ?>
								</div><!-- .content -->
							</div><!-- .account-card -->
							
							<div class="account-card">
								<div class="heading">
									<h3>My Discussions</h3>
								</div><!-- .heading -->
								<div class="content">
									<p>You have commented on <?php wpcandy_commented_posts_count( $user_id ); ?> blog posts on WPCandy.com.</p>
									<?php if ( wpcandy_user_has_commented( $user_id ) ) {
										wpcandy_specific_comment( $user_id, '0' );
									} ?>
								</div><!-- .content -->
							</div><!-- .account-card -->

						</div><!-- .entry-content -->
					</article><!-- #post-<?php the_ID(); ?> -->

				<?php endwhile; // end of the loop. ?>

			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->

<?php get_footer(); ?>