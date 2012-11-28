<?php
/**
 * @package WPCandy Theme
 * @since WPCandy Theme 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<?php 
	// If this is a link formatted post.
	if ( has_post_format( 'link', get_the_ID() ) ) { ?>
		
		<header class="entry-header">
			
			<p class="post-permalink"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark">Permalink</a></p>
			
			<?php $wpcandy_link = get_post_custom_values( 'linkformaturl', get_the_ID() ); ?>
			<?php if (isset($wpcandy_link[0])) { ?>
				<h2 class="entry-title"><a href="<?php echo $wpcandy_link[0]; ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
			<?php } else { ?>
				<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			<?php } ?>
			
			<p class="post-comment-count"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'wpcandy_theme' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php comments_number( '0', '1', '%' ); ?></a></p>

			<?php if ( 'post' == get_post_type( get_the_ID() ) ) : ?>
				<div class="entry-meta">
					<?php wpcandy_theme_posted_on(); ?>
				</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->
		
	<?php } else { ?>	
		<?php get_template_part( 'templates/blog', 'taxonomies' ); ?>
	
		<header class="entry-header">
		
			<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'wpcandy_theme' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
			
			<p class="post-comment-count"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'wpcandy_theme' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php comments_number( '0', '1', '%' ); ?></a></p>

			<?php if ( 'post' == get_post_type() ) : ?>
				<div class="entry-meta">
					<?php wpcandy_theme_posted_on(); ?>
				</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->
	<?php } ?>

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'wpcandy_theme' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'wpcandy_theme' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<footer class="entry-meta">
	</footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->
