<div id="wplatenight-header">
	<div id="wplatenight-header-inside">

		<div id="wpln-show">
		
			<h1><span class="one">WP</span> <span class="two">Late</span> <span class="three">Night</span></h1>
			
			<?php 
			$category_id = get_query_var('cat');
															
			$shows_query = new WP_Query( 'showposts=1&cat=1924' );
									
			while ( $shows_query->have_posts() ) : $shows_query->the_post(); ?>
	
			<div id="show-downloads">
				<ul>
					<li class="one"><a href="http://itunes.apple.com/us/podcast/wp-late-night/id496147707" title="Subscribe to WP Late Night on iTunes">Subscribe on iTunes</a></li>
					<?php if( function_exists('powerpress_get_enclosure') && powerpress_get_enclosure( get_the_ID() ) ) { ?><li class="two"><a href="<?php echo powerpress_get_enclosure( get_the_ID() ); ?>" title="Download the latest episode of WP Late Night in MP3 format">Download MP3</a></li><?php } ?>
					<li class="three"><a href="http://feeds.feedburner.com/wplatenight" title="WP Late Night audio RSS feed">RSS Feed</a></li>
				</ul>
			</div>
		
			<div id="latest-episode">
			
				<h2><?php the_title(); ?></h2>
				
				<?php the_excerpt(); ?>
					
			</div><!-- #latest-episode -->
			
			<?php endwhile;
			wp_reset_postdata(); ?>
		
		</div><!-- #wpln-show -->
		
		<div id="wpln-sponsor">
			
			<h3>Sponsored by:</h3>
			
			<a href="http://eventespresso.com" title="Event Espresso WordPress plugin for event registation and ticketing management"><img src="http://ee-updates.s3.amazonaws.com/images/event-espresso-banner-250x250.jpg" /></a>
			
		</div><!-- #wpln-sponsor -->
		
		<div class="clear"></div>
		
	</div><!--  #wplatenight-header-inside -->
</div><!-- #wplatenight-header -->