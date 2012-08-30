<?php if ( is_single() || is_page() || bbp_is_single_user() || is_archive() ) { 
	// If it's a page or a single permalink page, show breacrumbs
	?>

	<div id="breadcrumbs">
		
		<div id="breadcrumbs-wrap">
		
			<?php if ( is_page( 'discussions' ) || is_singular( 'topic' ) || is_singular( 'forum ') ) { 
			// A special breadcrumb for single forum topics (temporary)
			?>
			
			<p><strong>You are here:</strong> <a href="<?php bloginfo( 'url' ); ?>">Home</a> &gt; <a href="<?php bloginfo( 'url' ); ?>/discussions">Forums</a> &gt; <?php the_title(); ?></p>
			
			<?php } else if ( is_author() ) { ?>
			
			<?php
			global $wp_query;
			$curauth = $wp_query->get_queried_object();
			?>
			
			<p><strong>You are here:</strong> <a href="<?php bloginfo( 'url' ); ?>">Home</a> &gt; <a href="<?php bloginfo( 'url' ); ?>/is">About WPCandy</a> &gt; <?php echo $curauth->display_name; ?>&rsquo;s posts</p>
			
			<?php } elseif ( is_date() ) { ?>
			
			<p><strong>You are here:</strong> <a href="http://wpcandy.com/<?php the_time( 'Y' ); ?>" title="Posts from <?php the_time( 'Y' ); ?>">Posts from <?php the_time( 'Y' ); ?><?php if ( is_day() || is_month() ) { ?> &gt; <a href="http://wpcandy.com/<?php the_time( 'Y'); ?>/<?php the_time( 'm' ); ?>" title="Posts from <?php the_time( 'F, Y'); ?>">Posts from <?php the_time( 'F, Y'); } ?></a><?php if ( is_day() ) { ?> &gt; Posts from the <?php the_time( 'jS' ); ?> of <?php the_time( 'F, Y' ); } ?></p>
			
			<?php } else if ( bp_is_profile_component() || bp_is_activity_component() || bp_is_blogs_component() || bp_is_messages_component() || bp_is_friends_component() || bp_is_groups_component() || bp_is_settings_component() ) { ?>
			
				<p><strong>You are here:</strong> <a href="<?php bloginfo( 'url' ); ?>">Home</a> &gt; <a href="<?php bloginfo( 'url' ); ?>/members/">Members</a></p>
			
			<?php } else if ( is_tax( 'companies' ) || is_tax( 'people' ) || is_tax( 'events' ) ) { ?>
			
			<p><strong>You are here:</strong> <a href="<?php bloginfo( 'url' ); ?>">Home</a> &gt; <a href="<?php bloginfo( 'url' ); ?>/coverage">People, Companies, and Events Covered</a> &gt; <?php single_cat_title(); ?></p>
						
			<?php } else if ( is_category( '1971' ) || is_category( '1825' ) || is_category( '1940' ) || is_category( '1383' ) || is_category( '1924' ) || is_category( '1975' ) || is_category( '261' ) || is_category( '1976' ) ) { ?>
			
			<p><strong>You are here:</strong>  <a href="<?php bloginfo( 'url' ); ?>">Home</a> &gt; <a href="http://wpcandy.com/shows">Shows</a> &gt; <?php single_cat_title(); ?></p>
			
			<?php } 
			// Checks to see if it's in a podcast/show category
			else if (has_category( '1971' ) || has_category( '1825' ) || has_category( '1940' ) || has_category( '1383' ) || has_category( '1924' ) || has_category( '1975' ) || has_category( '261' ) || has_category( '1976' ) ) { ?>
			
			<p><strong>You are here:</strong>  <a href="<?php bloginfo( 'url' ); ?>">Home</a> &gt; <a href="http://wpcandy.com/shows">Shows</a> &gt; <?php the_title(); ?></p>
			
			<?php } else { ?>
			
			<p><strong>You are here:</strong> <?php if(function_exists('bcn_display')) { bcn_display(); } ?></p>
						
			<?php } ?>
					
		</div><!-- #breadcrumbs-wrap -->
	
	</div><!-- #breadcrumbs -->

<?php } ?>