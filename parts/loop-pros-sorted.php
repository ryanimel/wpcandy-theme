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

			<?php while ( have_posts() ) : the_post(); ?>
			
			<?php 
			// Pulls in the Pro listing type from custom field
			$key = 'wpdf_listingtype-select';
			$wpdflistkey = get_post_meta($post->ID, $key, TRUE); ?>
			
				<?php do_action( 'loop_while_before' ); ?>

				<article id="post-<?php the_ID(); ?>" class="<?php if($wpdflistkey != '') { $wpdflistkey = strtolower($wpdflistkey); echo $wpdflistkey; } ?>">

					<div class="pro-logo">
					
						<?php if(has_post_thumbnail()) {
							
							// The check for sweet/basic
							$wpdflistkey = get_post_meta($post->ID, 'wpdf_listingtype-select', TRUE); if($wpdflistkey == 'Sweet') {
								
								echo '<a href="';
								
								echo get_permalink();
								
								echo '" title="Visit the professional listing of ';
								
								echo get_the_title();
								
								echo '">';

								the_post_thumbnail( 'pro-logo-thumbnail' ); 
						
								echo '</a>';
						
							} else {
							
								echo '<a href="';
								
								echo get_permalink();
								
								echo '" title="Visit the professional listing of ';
								
								echo get_the_title();
								
								echo '">';
								
								the_post_thumbnail( 'pro-logo-thumbnail' ); 
								
								echo '</a>';
							
							} // End check for sweet/basic
						
						} else { // If there isn't a thumbnail for this
						
							echo '<a href="';
								
							echo get_permalink();
								
							echo '" title="Visit the professional listing of ';
								
							echo get_the_title();
								
							echo '">';
							
							echo '<img src="'.get_bloginfo("stylesheet_directory").'/library/images/wpcandy-pro-standin.png" />';
							
							echo '</a>';
						
						} ?>
					
						<?php  ?>
						
					</div><!-- .pro-logo -->

					<header class="entry-header">
					
						<?php /*
if (function_exists('wpfp_link')) { 
						
							echo '<p class="pro-favorite-link pro-mini-fav">';
							wpfp_link(); 
							echo '</p>';
									
						} 
*/?>
						
						<?php $wpdflistkey = get_post_meta($post->ID, 'wpdf_listingtype-select', TRUE); 
						
						if($wpdflistkey == 'Sweet') { ?>
						<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', t() ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
						<?php } else { ?>
						<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', t() ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php if (strlen($post->post_title) > 18) {
echo substr(the_title($before = '', $after = '', FALSE), 0, 18) . '...'; } else {
the_title();
} ?></a></h2>
						<?php } ?>

						<div class="entry-meta">
							<?php echo get_the_term_list( $post->ID, 'wpdf_location', ' near ', ', ', '' ); ?>
							<?php echo get_the_term_list( $post->ID, 'wpdf_price', '<span class="pro-pricing-info">for <span class="pro-price">', ', ', '</span></span>' ); ?>
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
						
						} else { } ?>

						<?php $wpdflistkey = get_post_meta($post->ID, 'wpdf_listingtype-select', TRUE); 
						
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
						
								<li class="gallery-item"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', t() ), the_title_attribute( 'echo=0' ) ); ?>"><?php echo wp_get_attachment_image( $image->ID, array(420,9999) ); ?></a></li>
							
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
					
						<?php $skillterms = get_the_terms( $post->ID, 'wpdf_skill' );
						$count = count($skillterms);
						
						$wpdflistkey = get_post_meta($post->ID, 'wpdf_listingtype-select', TRUE);
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
							
						} ?>
						
					</footer><!-- .entry-meta -->

				</article><!-- #post-<?php the_ID(); ?> -->

				<?php do_action( 'loop_while_after' ); ?>

			<?php endwhile; ?>
	
			<div class="pro-add-callout">
				<p>You should add yourself as a WPCandy Pro. <a href="http://wpcandy.com/pros/begin-here" title="Become a WPCandy Pro">Start here</a></p>
			</div>

			<?php get_template_part( 'pagination' ); ?>

			<?php do_action( 'loop_has_posts_after' ); ?>
			<?php do_action( 'hfeed_close' ); ?>

			</div><!-- #hfeed -->

	<?php do_action( 'loop_close' ); ?>

<?php else : ?>

	<div class="hfeed" id="pro-404">
		<div class="entry-content">
		
			<?php 
			$locationPage = (get_query_var('wpdf_location'));
			$pricePage = (get_query_var('wpdf_price'));
			$skillPage = (get_query_var('wpdf_skill')); 
			$destname = get_term_by( 'slug' , $locationPage , 'wpdf_location' );
			$skillPageName = get_term_by( 'slug' , $skillPage , 'wpdf_skill' );
			$pricePageName = get_term_by( 'slug' , $pricePage , 'wpdf_price' );
			?>
		
			<h1>Bummer, no Pros found..</h1>
			
			<p>Your search resulted in no results. Fear not, all is not lost!</p>
		
			<h2>Simplify your search</h2>
		
			<p>By simplifying your search you will find more results. Try removing your location or price requirement.</p>
		
			<h2>Add yourself to Pros!</h2>
		
			<p>Clearly we don't have everyone that we should yet. <a href="http://wpcandy.com/pros/begin-here" title="Become a WPCandy Pro">Are you a Pro yet?</a></p>
			
			<h2>Tell others they should be Pros</h2>
			
			<p>Do you know someone who should be listed here? Tweet out a message calling for more qualified Pros:</p>
			
			<blockquote>
				<p>Are you a WordPress Pro? You should be listed here: http://wpcandy.com/pros @wpcandy</p>
			</blockquote>
			
		</div>
	</div>

<?php endif; ?>