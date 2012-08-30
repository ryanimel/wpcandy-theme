<div id="sorter">

	<?php 
	$locationPage = (get_query_var('wpdf_location'));
	$pricePage = (get_query_var('wpdf_price'));
	$skillPage = (get_query_var('wpdf_skill')); ?>

	<div id="sorter-commands">
		
		<div class="first">
			<p>Pros near </p>
		</div><div class="sorter-div">
		
			<?php 
			
			// Pulling the current location for the sorter
			if ($locationPage != null) { 
			
				$destname = get_term_by( 'slug' , $locationPage , 'wpdf_location' );
			
				echo '<p><em id="sorter-link-city">' . $destname->name . '</em>';
				
				echo '<a class="sorter-clear" href="';
				
				echo get_bloginfo(url) . '/pros/';
				
				if ($pricePage != null) { 
					echo 'that-cost/'; echo $pricePage;
					echo '/'; 
				}
							
				if ($skillPage != null) { 
					echo 'who-can/'; echo $skillPage;
					echo '/'; 
				}
				
				echo '">a</a>';
				
				echo '</p>'; 
			
			} else {
			
			?>
			<p><a id="sorter-link-city" href="<?php bloginfo('url'); ?>/pros/anywhere" title="WordPress Professionals everywhere">any cities</a></p>
			<?php } ?>
			
			<div id="sorter-cities">
				
				<ul>
					<?php
					$args=array(
						'orderby' => 'name',
						'order' => 'ASC',
						'taxonomy' => 'wpdf_location',
						'include' => array( 1313, 1185, 1306, 1292, 1174, 1186, 1182, 264, 1358, 1312, 1222, 1187, 1311 ),
						// Array is Asia, Atlanta, Australia, Houston, Los Angeles, Miami, New York City, San Francisco, Tampa, United Kingdom, Vancouver, Washington DC, Western Europe 
						'hide_empty' => 0,
						);
					
					$categories=get_categories($args);
						
					foreach($categories as $category) { 
					
							echo '<li><a href="';
							
							echo get_bloginfo(url) . '/pros/near/';
							
							echo $category->slug;
							
							if ($pricePage != null) { 
								echo '/that-cost/'; echo $pricePage;
								echo '/'; 
							}
							
							if ($skillPage != null) { 
								echo '/who-can/'; echo $skillPage;
								echo '/'; 
							}
							
							echo '" title="' . sprintf( __( "View all Pros in %s" ), $category->name ) . '" ' . '>' . $category->name.'</a> </li> ';
					
						} 
					?>
					<li class="last"><a href="http://wpcandy.com/pros/everywhere" title="WPCandy Pros all over the world">Show all cities</a></li>
				</ul>
				
			</div><!-- #sorter-cities -->
			
		</div><div>
			<p> who specialize in </p>
		</div><div class="sorter-div">
			
			<?php
			// Pulling the current skill for the sorter
			if ($skillPage != null) { 
			
				$skillPageName = get_term_by( 'slug' , $skillPage , 'wpdf_skill' );
			
				echo '<p><em id="sorter-link-skill">' . $skillPageName->name . '</em>'; 
				
				echo '<a class="sorter-clear" href="';
				
				echo get_bloginfo(url) . '/pros/';
				
				if ($locationPage != null) { 
					echo 'near/'; echo $locationPage;
					echo '/'; 
				}
				
				if ($pricePage != null) { 
					echo 'that-cost/'; echo $pricePage;
					echo '/'; 
				}
				
				echo '">a</a>';
				
				echo '</p>'; 
			
			} else {
			
			?>
			<p><a id="sorter-link-skill" href="<?php bloginfo('url'); ?>/pros/with-any-skill" title="WordPress Professionals with any skill">anything</a></p>
			<?php } ?>
			
			<div id="sorter-skills">
				
				<ul>
					<?php
					
					$args=array(
						'orderby' => 'name',
						'order' => 'ASC',
						'taxonomy' => 'wpdf_skill',
						'hide_empty' => 0
						);
					
					
					$categories=get_categories($args);
	
					foreach($categories as $category) { 
					
							echo '<li><a href="';
							
							echo get_bloginfo(url);
							
							if ($locationPage != null) { 
								echo '/pros/near/'; echo $locationPage;
								echo '/'; 
							} else {
								echo '/pros/';
							}
							
							if ($pricePage != null) { 
								echo '/that-cost/'; echo $pricePage;
								echo '/'; 
							}
							
							echo 'who-can/';
							
							echo $category->slug;
							
							echo '" title="' . sprintf( __( "View all Pros in %s" ), $category->name ) . '" ' . '>' . $category->name.'</a> </li> ';
					
						} 
					?>
				</ul>
				
			</div><!-- #sorter-skills -->
			
		</div><div>
			<p> for an average of </p>
		</div><div class="sorter-div">
			
			<?php
			// Pulling the current price for the sorter
			if ($pricePage != null) { 
			
				$pricePageName = get_term_by( 'slug' , $pricePage , 'wpdf_price' );
			
				echo '<p><em id="sorter-link-price">' . $pricePageName->name . '</em>'; 
				
				echo '<a class="sorter-clear" href="';
				
				echo get_bloginfo(url) . '/pros/';
				
				if ($locationPage != null) { 
					echo 'near/'; echo $skillPage;
					echo '/'; 
				}
				
				if ($skillPage != null) { 
					echo 'who-can/'; echo $skillPage;
					echo '/'; 
				}
				
				echo '">a</a>';
				
				echo '</p>'; 
			
			} else {
			
			?>
			<p><a id="sorter-link-price" href="<?php bloginfo('url'); ?>/at-any-price" title="WordPress Professionals at any price">any amount</a></p>
			<?php } ?>
			
			<div id="sorter-prices">
				
				<ul>
					<?php
					$args=array(
						'orderby' => 'id',
						'order' => 'ASC',
						'taxonomy' => 'wpdf_price',
						'hide_empty' => 0
						);
					
					$categories=get_categories($args);
						
					foreach($categories as $category) { 
					
							echo '<li><a href="';
							
							echo get_bloginfo(url);
							
							if ($locationPage != null) { 
								echo '/pros/near/'; echo $locationPage;
								echo '/'; 
							} else {
								echo '/pros/';
							}
							
							echo 'that-cost/' . $category->slug;
							
							if ($skillPage != null) { 
								echo '/who-can/'; echo $skillPage;
								echo '/'; 
							}
							
							echo '" title="' . sprintf( __( "View all Pros in %s" ), $category->name ) . '" ' . '>' . $category->name . '</a> </li> ';
					
						} 
					?>
				</ul>
				
			</div><!-- #sorter-prices -->
			
		</div><div>
			<p>per project</p>
		</div><div class="last">
			<p>:</p>
		</div>
		
		<div class="clear"></div>
	</div><!-- #sorter-commands -->
	
	<?php if ( current_user_can( 'administrator' ) && ( ( $skillPage == 'design-themes') || ( $skillPage == 'develop-themes') || ( $skillPage == 'develop-plugins' ) ) ) { ?>
	
	<div id="sorter-specific">
	
		<p>Want more specific results?</p>
		
		<?php // Where we decide what to show
		
		if ( ( $skillPage == 'design-themes') || ( $skillPage == 'develop-themes') ) { 
			
			$getSpecific = 1259; // Grab all themes
		
		} else if ( ( $skillPage == 'develop-plugins' ) ) {
		
			$getSpecific = 1261; // Grab all plugins
		
		} ?>
		
		<ul class="<?php echo $getSpecific; ?>">
		<?php
		$args=array(
			'orderby' => 'count',
			'order' => 'ASC',
			'taxonomy' => 'wpdf_experience',
			'hide_empty' => 0,
			'child_of' => $getSpecific,
			'number' => 5
		);
					
		$categories=get_categories($args);
						
		foreach($categories as $category) { 
		
			echo '<li><a href="';
							
			echo get_bloginfo(url);
							
			if ($locationPage != null) { 
				echo '/pros/near/'; echo $locationPage;
				echo '/'; 
			} else {
				echo '/pros/';
			}
			
			if ($pricePage != null) { 
				echo 'that-cost/'; echo $pricePage;
				echo '/';
			}
							
			echo 'experienced/' . $category->slug;
							
			if ($skillPage != null) { 
				echo '/who-can/'; echo $skillPage;
				echo '/'; 
			}
							
			echo '" title="' . sprintf( __( "View all Pros in %s" ), $category->name ) . '" ' . '>' . $category->name . '</a> </li> ';
							
			} ?>
			<li class="last"><a href="http://wpcandy.com/pros/have-experience" title="WPCandy Pros have Experience">All</a></li>
		</ul>
	
	</div><!-- #sorter-specific -->
	<?php } ?>

</div><!-- #sorter -->