<?php
/**
 * Custom Template: Pros Loop
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

			<div id="hfeed" class="wpc-pros-archive">
			
			<?php 
			
			// $pro_args = array( 'post_type' => 'wpdf_pro', 'orderby' => 'meta_value,rand', 'meta_key' => 'wpdf_listingtype-select', 'order' => 'ASC', 'posts_per_page' => '-1', 'suppress_filters' => true );
			// $pro_args = array( 'post_type' => 'wpdf_pro', 'orderby' => 'meta_value', 'meta_key' => 'wpdf_listingtype-select', 'order' => 'ASC', 'suppress_filters' => true, 'nopaging' => true );
			
			//$wpdf_pros_query = new WP_Query( 'post_type=post&orderby=date&nopaging=true' ); 
			//$wpdf_pros_query = new WP_Query( $pro_args ); ?>

			<?php //while ( $wpdf_pros_query->have_posts() ) : $wpdf_pros_query->the_post(); ?>
			
			<?php while ( have_posts() ) : the_post();
			
			// global $post;
			
			// $pro_args = array( 'numberposts' => -1, 'post_type' => 'wpdf_pro', 'meta_key' => 'wpdf_listingtype-select', 'orderby' => 'meta_value,rand', 'order' => 'ASC' );
			// $myposts = get_posts( $pro_args );
			// foreach( $myposts as $post ) :	setup_postdata($post); ?>
			
			<?php 
			// Pulls in the Pro listing type from custom field
			$wpdf_key = 'wpdf_listingtype-select';
			$wpdflistkey = get_post_meta($post->ID, $wpdf_key, TRUE); ?>
			
				<?php do_action( 'loop_while_before' ); ?>
				
				<article id="post-<?php the_ID(); ?>" class="<?php if($wpdflistkey != '') { $wpdflistkey = strtolower($wpdflistkey); echo $wpdflistkey; } ?> test-003c">

					<div class="pro-logo">
					
						<?php if(has_post_thumbnail()) {
							
								echo '<a href="' . get_permalink() . '" title="Visit the professional listing of ' . get_the_title() . '">';

								the_post_thumbnail( 'pro-logo-thumbnail' ); 
						
								echo '</a>';
						
						} else { // If there isn't a thumbnail for this
						
							echo '<a href="' . get_permalink() . '" title="Visit the professional listing of ' . get_the_title() . '"><img src="'.get_bloginfo("stylesheet_directory").'/library/images/wpcandy-pro-standin.png" /></a>';
						
						} ?>
					
						<?php ?>
						
					</div><!-- .pro-logo -->
					
					<header class="entry-header">
					
						<?php if ( $wpdflistkey == 'Sweet' ) { ?>
						
							<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', t() ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
						
						<?php  } else { ?>
						
							<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', t() ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php if (strlen($post->post_title) > 18) {
							
							echo substr(get_the_title($before = '', $after = '', FALSE), 0, 18) . '...'; 
							
						} else { 
							
							the_title();
						
						} ?></a></h2>
						<?php } ?>
						
						<div class="entry-meta">
												
							<?php 
						
							echo "<p>";
						
							$pricingterms = get_the_terms( $post->ID, 'wpdf_price' );
						
							if ( !(empty($pricingterms)) ) {
																														
								foreach ($pricingterms as $pricingterm) {
								
									echo "<span> <span class='pro-pricing-info'>for <span class='pro-price'> <a href='" . get_bloginfo('url') . "/pros/that-cost/" . $pricingterm->slug . "'>".$pricingterm->name."</a></span>";							
								
							
								}
							}
												
							echo "</p>"; ?>

						</div><!-- .entry-meta -->
						
					</header><!-- .entry-header -->
					
					<div class="entry-content">
						
						<?php $wpdflistkey = get_post_meta($post->ID, 'wpdf_listingtype-select', TRUE); 
						
						if($wpdflistkey == 'Sweet') { 
						
							if ( $post->post_excerpt ) { 
						
								the_excerpt(); 
								
							} else { ?>
						
								<p><?php echo limit_words(get_the_content(), '30'); ?>&hellip;</p>	
						
							<?php }
						
						} else { } 
						
						if($wpdflistkey == 'Sweet') {
						
							$wpc_pro_thumbnail_id = get_post_thumbnail_id(get_the_ID());
							if ( $images = get_children(array(
								'post_parent' => get_the_ID(),
								'post_type' => 'attachment',
								'post_mime_type' => 'image',
								'orderby' => 'rand'
							))) : ?>
						
							<ul class="gallery">
						
							<?php $thumbi = '0'; foreach( $images as $image ) :
							
							if ($wpc_pro_thumbnail_id != $image->ID) { 
							
								if ( $thumbi == '0' ) { // We only want to show three portfolio images, no matter the number available ?>
						
								<li class="gallery-item"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', t() ), the_title_attribute( 'echo=0' ) ); ?>"><?php echo wp_get_attachment_image( $image->ID, array(420,600) ); ?></a></li>
							
								<?php }
							
								$thumbi++;
							
							} endforeach; ?>
						
						</ul>
						
						<?php else: // No images ?>
						<?php endif;
						
						}
						
						// The publish date in Unix Epoch terms
						$postedTime = get_the_time('U');
						
						// The current date in Unix Epoch terms
						$todayTime = date('U');
						
						// Getting the difference tells us how long since
						$timeDiff = ( $todayTime - $postedTime); 
						
						// If it happened today, tell people
						if ( $timeDiff < '172800' ) { ?>
						
						<p class="pro-new">This is a new listing.</p>
						
						<?php } ?>
						
					</div><!-- .entry-content -->

					<footer class="entry-meta">
					
						<?php 
						$skillterms = get_the_terms( $post->ID, 'wpdf_skill' );
						$count = count($skillterms);
						
						if ( $wpdflistkey == 'Sweet') { $skilllimit = '2'; } else { $skilllimit = '1'; }
						
						$i = '0';
						
						if($count > 0){
						
							echo "<div class='pro-skilled-in'>";
							foreach ($skillterms as $skillterm) {
							
								if ( $i < $skilllimit )  {
								
									echo "<p><a href='" . get_bloginfo('url') . "/pros/who-can/" . $skillterm->slug . "'>".$skillterm->name."</a></p>";
								}
								
								$i++;
							
							}
							
							echo "</div>";
							
						}
						
						 ?>
						
					</footer><!-- .entry-meta -->

				</article><!-- #post-<?php the_ID(); ?> -->

				<?php do_action( 'loop_while_after' ); ?>

			<?php endwhile; ?>


			<div class="pro-add-callout">
				<p>You should add yourself as a WPCandy Pro. <a href="http://wpcandy.com/pros/begin-here" title="Become a WPCandy Pro">Start here</a></p>
			</div>

			<?php do_action( 'loop_has_posts_after' ); ?>
			<?php do_action( 'hfeed_close' ); ?>

			</div><!-- #hfeed -->

	<?php do_action( 'loop_close' ); ?>

<?php else : ?>

	<?php get_template_part( 'loop-404' ); ?>

<?php endif; ?>