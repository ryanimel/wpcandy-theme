<?php
/**
 * Template Name: My Pro Listings
 * 
 * The page template is the general template used when a singular 'page'
 * post type is queried.
 * 
 * This template can be overriden if the page is set to use a custom page 
 * template or if WordPress can match that page's slug or id with a 
 * page-{slug}.php or page-{id}.php file in the parent/child theme's directory.
 *
 * Template Hierarchy
 * - custom template
 * - page-{slug}.php
 * - page-{id}.php
 * - page.php
 * - index.php
 *
 * @package WP Framework
 * @subpackage Template
 */

get_template_part( 'parts/header', 'pros' ); ?>

				<div id="content" class="column-8">

					<?php do_action( 'content_open' ); ?>

					<?php if ( have_posts() ) : ?>

						<?php do_action( 'loop_open' ); ?>

						<div class="hfeed">

							<?php do_action( 'hfeed_open' ); ?>

								<?php while ( have_posts() ) : the_post(); ?>

									<?php do_action( 'loop_while_before' ); ?>

									<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
										<header class="entry-header">
										
											<?php
											if ( is_user_logged_in() ) {
											  $user_id = get_current_user_id();
											  $user_info = get_userdata($user_id);
											  echo get_avatar( $user_info->user_email, '40' );
											 } ?>		
											
											<h1 class="entry-title"><?php the_title(); ?></h1>

										</header><!-- .entry-header -->

										<div class="entry-content">
											<?php the_content(); ?>
											<?php wp_link_pages( array( 'before' => '<div class="page-link"><span class="page-link-meta">' . __( 'Pages:', t() ) . '</span>', 'after' => '</div>', 'next_or_number' => 'number' ) ); ?>
											
											
											
											<?php
											if ( is_user_logged_in() ) {
											  $user_id = get_current_user_id();
											  query_posts( "author=$user_id&post_type=wpdf_pro&showposts=-1" ); ?>
											 
											 <table id="wpcandy-pro-myprofiles-table">
											 	<tr>
											 		<th></th>
											  		<th id="wpcandy-pro-myprofiles-table-pro-column">Pro</th>
											  		<th>Actions</th>
											  	</tr>
											  	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
											  	<?php // Pulls in the Pro listing type from custom field
											  	$wpdflistkey = get_post_meta($post->ID, 'wpdf_listingtype-select', TRUE); ?>
											    <tr>
											    	<td><?php edit_post_link( 'Edit', '<span class="wpcandy-pro-myprofiles-edit">', '</span>' ); ?></td>
											    	<td>
											    		
											    		<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link: <?php the_title(); ?>"><?php the_title(); ?></a><br />Last updated: <?php the_modified_time( 'm/j/Y' ); ?></td>
											    	<td class="wpcandy-pro-myprofiles-table-type"><span class="myprofiles-readout"><?php if ( $wpdflistkey == 'wBasic' ) { ?>Basic<?php } else { ?>Sweet<?php } ?></span><span class="myprofiles-actions"><?php if ( $wpdflistkey == 'wBasic' ) { ?><a href="http://wpcandy.com/pros/change" class="up">Upgrade</a><?php } else { ?><a class="down" href="http://wpcandy.com/pros/change">Downgrade</a><?php } ?></span></td>
											    </tr>

											    <?php endwhile; else: ?>

											    <?php endif; ?>
											</table>
											<?php
											  wp_reset_query();
											} else {

											}
											?>
											  
												
										</div><!-- .entry-content -->

										<footer class="entry-meta">
											<?php // edit_post_link( __( 'Edit', t() ), '<span class="edit-link">', '</span>' ); ?></span>
										</footer><!-- .entry-meta -->

										<?php comments_template( '', true ); ?>

									</article><!-- #post-<?php the_ID(); ?> -->

									<?php do_action( 'loop_while_after' ); ?>

								<?php endwhile; ?>

							<?php do_action( 'hfeed_close' ); ?>

						</div><!-- .hfeed -->

						<?php do_action( 'loop_close' ); ?>

					<?php else : ?>

						<?php get_template_part( 'loop-404' ); ?>

					<?php endif; ?>

					<?php do_action( 'content_close' ); ?>

				</div><!-- #content -->

<?php get_template_part( 'parts/footer', 'pros' ); ?>