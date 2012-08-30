							<?php 
							$path = $_SERVER['REQUEST_URI'];							
							$url = get_permalink() . $path;							
							$str = parse_url( $url, PHP_URL_QUERY );
									
							parse_str( $str );
							
							// Feeds a status when a Knapsack is deleted
							if ( $deleted == '1' ) { echo '<p class="status"><strong>Knapsack deleted.</strong></p>'; } 
							
							// Make sure a Knapsack was just made
							if ( $kname != '' ) { ?>
							
							<?php 
							
							$idsubmitted = esc_html( $submitted );
														
							edit_post_link( 'edit the name and description', '<p>Your Knapsack "' . $kname . '" is under review. Feel free to ', '.</p>', esc_html( $submitted ) );
							
							$queried_post = get_post( $idsubmitted );							
							$modTime = strtotime( $queried_post->post_modified );
							$curTime = current_time( "timestamp" );							
							$timeDiff = ( $curTime - $modTime  );
														
							
							?> 
							
							<?php if ( $queried_post->post_status == 'pending' ) { ?>
							
							<div class="sack">
																					
							<?php
							
							$pluginlist = explode( ",", $plugins );
														
							foreach( $pluginlist as $pluginitem ) {
								
								$tokens = explode( '/', $pluginitem );
								$pluginslug = $tokens[5];
								$pluginspaced = str_replace ( '-' , ' ' , $pluginslug );
								$pluginname = ucwords( $pluginspaced );
								
								if ( $pluginname == 'Buddypress' ) 
									$pluginname = 'BuddyPress';
								if ( $pluginname == 'Ui Labs' )
									$pluginname = 'UI Labs';
								
								$plugin_variables .= "
		// This is an example of how to include a plugin from the WordPress Plugin Repository
        array(
            'name'      => '" . $pluginname . "',
            'slug'      => '" . $pluginslug . "',
            'required'  => true,
        ),	
								";
							
							}
							
							if ( $timeDiff <= '10' ) {
								// Before ten seconds
							
							if (!defined('awsAccessKey')) define('awsAccessKey', 'AKIAJMXYLLMY532JPCZA');
							if (!defined('awsSecretKey')) define('awsSecretKey', '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');
							
							// Instantiate the class
							$s3 = new S3( awsAccessKey, awsSecretKey, false );
							
							$kname = str_replace( '"','',$kname );
							$kname = str_replace( "'",'',$kname );
							
							$uploadFile = slugify( $kname ) . '-' . current_time( "timestamp" ) . '.php'; 
							// File to upload
							$bucketName = 'wpknapsack';
							
							$template01 = TEMPLATEPATH . '/parts/knapsack-tgm01.txt';
							$fd01 = fopen( $template01,"r" );
							$message01 = fread( $fd01, filesize( $template01 ) );
							
							$template02 = TEMPLATEPATH . '/parts/knapsack-tgm02.txt';
							$fd02 = fopen( $template02,"r" );
							$message02 = fread( $fd02, filesize( $template02 ) );
							
							$fileText = "<?php

/*
Plugin Name: " . $kname . "
Plugin URI: http://wpcandy.com/labs/knapsack
Description: Nothing yet
Version: 1.0
Author: 
Author URI: 
License: GPLv2 or later
*/

							
" . $message01 . $plugin_variables . $message02;
							
							//Testing a put
							if ( $s3->putObject( $fileText, $bucketName, $uploadFile, S3::ACL_PUBLIC_READ) ) {
							
								$uploadURL = "http://{$bucketName}.s3.amazonaws.com/".baseName( $uploadFile ).PHP_EOL;
								echo "<p class='download'><a href='" . $uploadURL . "' title='Your new Knapsack plugin'>Download</a>.</p>";
								
								update_post_meta( $idsubmitted, 'knapsackurl', esc_html( $uploadURL ) );
							
							} // put
							
							} else { // timeDiff check
								// Past ten seconds
								$knapsackDownload = get_post_meta( $idsubmitted, 'knapsackurl', true);
								
								echo '<p class="download"><a href="' . esc_html( $knapsackDownload ) . '" title="Your new Knapsack plugin">Download</a></p>';
							}
							
							?>
							</div><!-- .sack -->
							
							<?php } } ?>
							
							<?php
							if ( is_user_logged_in() ) {
								
								$user_id = get_current_user_id();
								$myargs = array(
									
									'post_type' => 'wpcandy_knapsack',
									'author' 	=> $user_id,
									'showposts' => -1,
									'post_status' => 'any',
									'tax_query' => array(
										array(
											'taxonomy' => 'post_tag',
											'field' => 'slug',
											'terms' => array( 'noshow' ),
											'operator' => 'NOT IN'
										)
									),
								
								);
								
								// The Query
								$myknapsack_query = new WP_Query( $myargs );
											 
								if ( $myknapsack_query->have_posts() ) : while ( $myknapsack_query->have_posts() ) : $myknapsack_query->the_post(); ?>
								
								<div class="sack">
									
									<?php if ( $post->post_status == 'pending' ) { ?>
									<h3>Pending: <?php the_title(); ?></h3>
									<?php } else { ?>
									<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
									<?php } ?>
																		
									<div class="sackwrap">
										<?php the_content(); ?>
									</div>
									
									<div class="sackperiph">
									
										<div class="sackimage">
										<?php if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
											the_post_thumbnail( 'knapsack-thumb' );
										} else { ?>
											<img src="http://cdn.wpcandy.com/wp-content/themes/wpcandynew/library/images/knapsack-standin.gif" alt="<?php the_title(); ?>" />
										<?php } ?>
										</div><!-- .sackimage -->
										
										<?php $knapsackDownload = get_post_meta( $post->ID, 'knapsackurl', true); ?>
										<p class="download"><a href="<?php echo esc_html( $knapsackDownload ); ?>">Download</a></p>
										
									</div><!-- .sackperiph -->
									
									<div class="sack-controls">
										<ul>
											<?php edit_post_link('Edit', '<li>', '</li>'); ?>
											<?php 
											$post_type = get_post_type($post);
											$delLink = wp_nonce_url( admin_url() . "post.php?post=" . $post->ID . "&action=delete", 'delete-' . $post_type . '_' . $post->ID);
											echo '<li><a href="' . $delLink . '">Delete</a></li>';
											?>
										</ul>
									</div><!-- .sack-controls -->
									
									<div class="clear"></div>
								</div><!-- .sack -->

								<?php endwhile; else: ?>
								
									<p class="status">Dang, you don&rsquo;t have any Knapsacks. Go <a href="http://wpcandy.com/labs/knapsack" title="Create a WordPress plugin Knapsack">put one together</a>.</p>

							    <?php endif; ?>
								
								<?php wp_reset_query();
							
							} else {
							
							echo '<p>If you log in you can save your Knapsacks.</p>';
							
							} ?>