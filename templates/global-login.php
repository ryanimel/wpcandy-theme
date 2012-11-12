<div id="global-login-wrap">	
	<div id="global-login">
		<?php if ( is_user_logged_in() ) { ?>
			<?php 
			global $userdata; 
			get_currentuserinfo(); ?>
			
			<div class="login-avatar">
				<a href="http://wpcandy.com/wp-admin/profile.php" title="Edit your WPCandy Profile"><?php echo get_avatar( $userdata->ID, 22 ); ?></a>
			</div><!-- .login-avatar -->
			
			<div id="global-login-actions">
				<ul>
					<li><a href="http://wpcandy.com/my-account" title="Your WPCandy Account">Your Account</a></li>
				</ul>
			</div><!-- #global-login-actions -->					
		
			<?php } else { ?>
			
			<div class="login-avatar">
				<img class="standin" src="http://wpcandy.com/wp-content/themes/wpcandynew/library/images/wpcandy-avatar-standin.png" alt="Join WPCandy today!" width="22" height="22" />
			</div><!-- .login-avatar -->
				
			<div id="global-login-actions">
				<ul>
					<li class="first clickable"><a href="<?php echo wp_login_url( get_permalink() ); ?>" title="Log in to WPCandy">Log in</a> or <a href="http://wpcandy.com/is/you" title="Join WPCandy">join</a></li>
				</ul>
			</div><!-- #global-login-actions -->					
		
	<?php } ?>
	</div>
</div>