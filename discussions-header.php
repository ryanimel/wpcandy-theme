<div id="slideshow" class="forum-slide">
	<div class="wrap">
		<div id="slide-wrap">
		
			<ul id="slide-list">
							
				<li class="slide">
				
					<img src="<?php bloginfo( 'stylesheet_directory' ); ?>/library/images/forum-header.png" />
			
					<div class="slide-desc">
					
						<div class="description">
							<h3><a href="http://wpcandy.com/discussions" title="WPCandy Discussions">WPCandy Discussions</a></h3>
							<p>Enjoy casual WordPress conversation!</p>
						</div>
						
						<?php if ( is_user_logged_in() ) { ?>
						<div class="actions user-actions">
							<?php 
							global $userdata; 
							get_currentuserinfo(); 
							echo get_avatar( $userdata->ID, 60 ); ?>
							<ul>
								<li>Welcome, <a href="<?php bloginfo( 'url' ); ?>/discussion/by/<?php echo $userdata->user_login; ?>"><?php echo $userdata->display_name; ?></a>!</li>
								<li class="stack"><a href="<?php echo admin_url( 'profile.php' ); ?>">Edit Profile</a></li>
								<li class="stack"><a href="<?php echo wp_logout_url( get_permalink() ); ?>">Log Out</a></li>
							</ul>
						</div>
						<?php } else { ?>
						<div class="actions">
							<p class="button"><a href="http://wpcandy.com/is/you" title="Join WPCandy">Create an account</a></p>
							<p><a title="Login to WPCandy" href="<?php echo wp_login_url( get_permalink() ); ?>">Or log in now</a>.</p>
						</div>
						<?php } ?>
						
					</div>
				</li>
							
			</ul><!-- #slide-list -->
			
			<div id="slideshow-pager">
			
			</div><!-- #slideshow-pager -->
		
		</div><!-- #slide-wrap -->
	</div><!-- .wrap -->
</div><!-- #slideshow -->