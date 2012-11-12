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
					
					<?php get_template_part( 'content', 'page' ); ?>
					
					<?php 
					$user_id = get_current_user_id(); 
					?>
					
					<dl class="sidebyside">
						<dt>Registered:</dt>
						<dd><?php wpcandy_user_registration_date( $user_id );  ?></dd>
						<dt>My Pros:</dt>
						<dd><?php wpcandy_user_pros( $user_id ); ?></dd>
						<dt>My Purchases:</dt>
						<dd>ma</dd>
						<dt>My Discussions:</dt>
						<dd><?php wpcandy_user_discussions( $user_id ); ?></dd>
						<dt>My Posts:</dt>
						<dd><?php wpcandy_user_posts( $user_id ); ?></dd>
					</dl><!-- .sidebyside -->

				<?php endwhile; // end of the loop. ?>

			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>