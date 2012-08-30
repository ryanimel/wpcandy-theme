<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if ( $wp_query->max_num_pages > 1 ) : ?>
	<div id="nav-above" class="navigation">
	<?php if(in_category( 'Videos' ) && is_archive() ) { ?>
		<div class="nav-previous"><?php next_posts_link( __( 'Older videos', 'twentyten' ) ); ?></div>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer videos', 'twentyten' ) ); ?></div>
	<?php } else { ?>
		<div class="nav-previous"><?php next_posts_link( __( 'Older posts', 'twentyten' ) ); ?></div>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts', 'twentyten' ) ); ?></div>
	<?php } ?>
	</div><!-- #nav-above -->
<?php endif; ?>