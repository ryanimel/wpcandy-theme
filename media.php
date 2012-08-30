<?php
/**
 * Custom Template: Media
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
					
						<div class="navigation navigation-top">
								
							<div class="nav-previous"><?php previous_image_link( false, 'Previous Image' ); ?></div>
								
							<div class="nav-next"><?php next_image_link( false, 'Next Image' ); ?></div>
							
							<?php if ( ! empty( $post->post_parent ) ) : ?>
							<div class="parent-post"><a href="<?php echo get_permalink( $post->post_parent ); ?>" title="<?php esc_attr( printf( __( 'Return to %s', 'twentyten' ), get_the_title( $post->post_parent ) ) ); ?>" rel="gallery">Return to post</a></div>
							<?php endif; ?>
							
						</div><!-- .navigation -->

						<h1 class="entry-title"><?php the_title(); ?></h1>

						<div class="entry-meta">
							<?php wpf_posted_on(); ?>
						</div><!-- .entry-meta -->

						<div class="entry-content">
												
						<?php if ( wp_attachment_is_image( get_the_ID() ) ) : 
						
						$attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
						
						foreach ( $attachments as $k => $attachment ) {
							
							if ( $attachment->ID == $post->ID )
							break;
						}
						
						$k++;
						
						// If there is more than 1 image attachment in a gallery
						if ( count( $attachments ) > 1 ) {
						
							if ( isset( $attachments[ $k ] ) )
							
								// get the URL of the next image attachment
								$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
							
							else
								
								// or get the URL of the first image attachment
								$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
	
						} else {
							
							// or, if there's only 1 image attachment, get the URL of the image
							$next_attachment_url = wp_get_attachment_url();
						
						}
						?>

								<p class="attachment-image">
									<a href="<?php echo $next_attachment_url; ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><img class="aligncenter" src="<?php echo wp_get_attachment_url(); ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>" /></a>
								</p><!-- .attachment-image -->

							<?php else : ?>

								<?php wpf_display_attachment(); ?>

								<p class="download">
									<a href="<?php echo wp_get_attachment_url(); ?>" title="<?php the_title_attribute(); ?>" rel="enclosure" type="<?php echo get_post_mime_type(); ?>"><?php printf( __( 'Download &quot;%1$s&quot;', hybrid_get_textdomain() ), the_title( '<span class="fn">', '</span>', false) ); ?></a>
								</p><!-- .download -->

							<?php endif; ?>

							<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', t() ) ); ?>
							<?php wp_link_pages( array( 'before' => '<div class="page-link"><span class="page-link-meta">' . __( 'Pages:', t() ) . '</span>', 'after' => '</div>', 'next_or_number' => 'number' ) ); ?>
						</div><!-- .entry-content -->

					</article><!-- #post-<?php the_ID(); ?> -->
					
					<?php comments_template( '', true ); ?>

				<?php do_action( 'loop_has_posts_after' ); ?>
				<?php do_action( 'hfeed_close' ); ?>

			</div><!-- #hfeed -->

	<?php do_action( 'loop_close' ); ?>

<?php else : ?>

	<?php get_template_part( 'loop-404' ); ?>

<?php endif; ?>