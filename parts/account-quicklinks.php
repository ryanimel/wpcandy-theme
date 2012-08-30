				<div id="global-login">
				
					<div id="global-login-wrap">
					
					<?php if ( is_user_logged_in() ) { ?>
						<?php 
						global $userdata; 
						get_currentuserinfo(); ?>
						
							<div id="actions-logged-in">
							
								<div id="logged-in-main">
								
									<ul>
										<li>Logged in as <a href="http://wpcandy.com/wp-admin/profile.php" title="Edit your WPCandy Profile"><?php echo $userdata->display_name; ?></a>. (<a href="<?php echo wp_logout_url( get_permalink() ); ?>" title="Log out of WPCandy.com">Log out</a>)</li>
										<li class="pill"><a href="http://wpcandy.com/shoppe/checkout" title="Your WPCandy Cart">Your Cart</a> /</li>
										<li class="pill"><a href="http://wpcandy.com/shoppe/your-account" title="Your WPCandy Account">Account</a> /</li>
										<li class="pill last"><a href="http://wpcandy.com/pros/that-are-mine" title="Manage your WPCandy Pros">Manage Your Pros</a></li>

									</ul>
									
									<div id="profile-img">
										<a href="http://wpcandy.com/wp-admin/profile.php" title="Edit your WPCandy Profile"><?php echo get_avatar( $userdata->ID, 50 ); ?></a>
									</div>
									
									<div class="clear"></div>
									
								</div>
								
							</div>				
						
						<?php } else { ?>
					
							<div id="actions-logged-out">
						
							<ul>
								<li class="first clickable"><a href="<?php echo wp_login_url( get_permalink() ); ?>" title="Log in to WPCandy">Log in</a></li>
								<li>or</li>
								<li class="last clickable"><a href="http://wpcandy.com/is/you" id="joinwpcandy" class="button" title="Join WPCandy">join WPCandy</a></li>
							</ul>
							
							<p><a href="#" title="Why join the WPCandy Community?">Why join?</a></p>
							
						</div><!-- #global-login-actions -->					
											
					<?php } ?>
					
					</div>
					
				</div>