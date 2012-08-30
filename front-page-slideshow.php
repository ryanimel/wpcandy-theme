<?php if(is_front_page()) { ?>
<div id="slideshow">
	<div class="wrap">
		<div id="slide-wrap">
		
			<ul id="slide-list">
			
				<?php query_posts('post_type=wpcandy_slides&showposts=5&orderby=date&order=ASC');
				while ( have_posts() ) : the_post(); ?>
				
				<li class="slide">
				
				
					<a href="<?php echo get_the_excerpt(); ?>"><?php the_post_thumbnail( 'slide' ); ?></a>
			
					
					<div class="slide-desc">
					
						<div class="text">
						
							<h3><a href="<?php echo get_the_excerpt(); ?>"><?php the_title(); ?></a></h3>
						
						
							<?php the_content(); ?>

						</div>
						
					</div>
				</li>
				
				<?php endwhile; wp_reset_query(); ?>
							
			</ul><!-- #slide-list -->
			
			<div id="slideshow-pager">
			
			</div><!-- #slideshow-pager -->
		
		</div><!-- #slide-wrap -->
	</div><!-- .wrap -->
</div><!-- #slideshow -->
<?php } ?>