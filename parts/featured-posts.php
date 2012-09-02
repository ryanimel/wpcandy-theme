<div id="featured">
	<h2 class="entry-title content-header">Featured</h2>
	<ul><?php $i = 0 ?>
		<?php query_posts('showposts=4&tag=featured');
		if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<?php $i ++ ?>
		<li class="featured-item<?php if ($i == 4) { ?> last<?php } ?>">
			<div class="thumb">
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail(); ?></a>
			</div><!-- .thumb -->
			<h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
			<div class="featured-overlay">
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
					<p><?php comments_number( 'No comments yet!', '1 Comment', '% Comments' ); ?></p>
				</a>
			</div>
		</li><!-- .featured -->
		<?php endwhile; else: endif; wp_reset_query(); ?>
	</ul>
</div><!-- #featured -->