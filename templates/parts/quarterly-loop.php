<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<div class="entry-content">
	
		<div id="issue-desc">
		
			<h2 class="entry-title"><?php the_title(); ?></h2>
			
			<div class="meta">
				<p>Published <?php the_time( 'F, Y' ); ?></p>
			</div>
			
			<?php the_content(); ?>
			
		</div>
	
		<div id="issue-cover">
		
			<?php the_post_thumbnail( 'issue-big' ); ?>
		
		</div>
		
	</div><!-- .entry-content -->
	
	<footer class="entry-utility">
		
		<div class="wrap">
	
			<h3>Authors <span>&amp;</span> Contributors In This Issue</h3>
		
			<ul>
			<?php $issue_terms = get_the_terms( $post->ID , 'post_tag' );
			
			if ( $issue_terms != '' ) {
		
			foreach ( $issue_terms as $issue_term ) {
				
				$issue_slug = $issue_term->slug;
														
				$issue_query = new WP_Query( 'post_type=post&showposts=-1&post_status=any&orderby=rand&tag=' . $issue_slug );
				
				$num = 0;
				while ( $issue_query->have_posts() ) : $issue_query->the_post(); ?>
					<?php $num++; ?>
					<li class="contributor num-<?php echo $num; ?>">
						
						<div class="avatar">
							<?php echo get_avatar( get_the_author_meta( 'user_email' ), 60 ); ?>
						</div>
						
						<div class="title">
							<p><?php the_title(); ?></p>
							<p class="author"><span>by</span> <?php the_author(); ?></p>
						</div>
						
					</li>
			
				<?php endwhile;
				wp_reset_postdata();
			
			}
		
		} ?>
		</ul>
		
		<div class="clear"></div>
		
		</div><!-- .wrap -->
	</footer><!-- .entry-utility -->
	
</article><!-- #post-<?php the_ID(); ?> -->