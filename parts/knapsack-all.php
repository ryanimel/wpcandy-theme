<h4>Editor&rsquo;s Choice</h4>

<p>These Knapsacks have been selected by WPCandy editors, and are particularly useful.</p>

<?php 							
$editorargs = array(
	'tax_query' => array(
		array(
			'taxonomy'	=> 'post_tag',
			'field'		=> 'slug',
			'terms'		=> array( 'editorschoice' ),
			'operator'	=> 'IN'
		)
	),
	'post_type'	=> 'wpcandy_knapsack',
	'orderby'	=> 'rand',
	'showposts'	=> 4
);
							
// The Query
$editor_query = new WP_Query( $editorargs );
							
// The Loop
if ( $editor_query->have_posts() ) : while ( $editor_query->have_posts() ) : $editor_query->the_post(); ?>

<div class="tinysack">
	
	<div class="sackwrap">
		<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	
		<?php $knapsackDownload = get_post_meta( $post->ID, 'knapsackurl', true); ?>
		
		<div class="sackimage">
			<?php if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
				the_post_thumbnail( 'knapsack-thumb' );
			} else { ?>
				<img src="http://cdn.wpcandy.com/wp-content/themes/wpcandynew/library/images/knapsack-standin.gif" alt="<?php the_title(); ?>" />
			<?php } ?>
		</div><!-- .sackimage -->
		
		<p class="download"><a href="<?php echo esc_html( $knapsackDownload ); ?>">Download</a></p>
	</div>
	
	<div class="clear"></div>
</div><!-- .tinysack -->

<?php endwhile; else: ?>

<p class="status">Looks like we need a few more of these.</p>

<?php endif;
							
// Reset Post Data
wp_reset_postdata();
							
?>

<div class="clear"></div>

<hr />

<h4>Popular Knapsacks</h4>

<p>Our community seems to favor these plugins.</p>

<?php 							
$popularargs = array(
	'tax_query' => array(
		array(
			'taxonomy'	=> 'post_tag',
			'field'		=> 'slug',
			'terms'		=> array( 'top' ),
			'operator'	=> 'IN'
		)
	),
	'post_type'	=> 'wpcandy_knapsack',
	'orderby'	=> 'random',
	'showposts'	=> 4
);
							
// The Query
$popular_query = new WP_Query( $popularargs );
							
// The Loop
if ( $popular_query->have_posts() ) : while ( $popular_query->have_posts() ) : $popular_query->the_post(); ?>

<div class="tinysack">
	
	<div class="sackwrap">
		<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	
		<?php $knapsackDownload = get_post_meta( $post->ID, 'knapsackurl', true); ?>
		
		<div class="sackimage">
			<?php if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
				the_post_thumbnail( 'knapsack-thumb' );
			} else { ?>
				<img src="http://cdn.wpcandy.com/wp-content/themes/wpcandynew/library/images/knapsack-standin.gif" alt="<?php the_title(); ?>" />
			<?php } ?>
		</div><!-- .sackimage -->
		
		<p class="download"><a href="<?php echo esc_html( $knapsackDownload ); ?>">Download</a></p>
	</div>

	<div class="clear"></div>
</div><!-- .tinysack -->

<?php endwhile; else: ?>

<p class="status">Knapsacks are still fresh &ndash; this will update soon.</p>

<?php endif;
							
// Reset Post Data
wp_reset_postdata();
							
?>

<div class="clear"></div>

<hr />

<h4>Community Knapsacks</h4>

<p>The most recent Knapsacks shared by our community:</p>

<?php 							
$args = array(
	'tax_query' => array(
		array(
			'taxonomy' => 'post_tag',
			'field' => 'slug',
			'terms' => array( 'noshow' ),
			'operator' => 'NOT IN'
		),
		array(
			'taxonomy' => 'post_tag',
			'field' => 'slug',
			'terms' => array( 'editorschoice' ),
			'operator' => 'NOT IN'
		),
		array(
			'taxonomy' => 'post_tag',
			'field' => 'slug',
			'terms' => array( 'top' ),
			'operator' => 'NOT IN'
		),
	),
	'post_type' => 'wpcandy_knapsack'
);
							
// The Query
$knapsack_query = new WP_Query( $args );
							
// The Loop
while ( $knapsack_query->have_posts() ) : $knapsack_query->the_post(); ?>

<div class="sack">
	<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	
	<div class="sackwrap">
		<?php the_content(); ?>
	</div>
	
	<div class="sackperiph">
		<div class="sackimage">
			<?php if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
				the_post_thumbnail( 'knapsack-thumb' );
			} else { ?>
				<img src="http://cdn.wpcandy.com/wp-content/themes/wpcandynew/library/images/knapsack-standin.gif" alt="<?php the_title(); ?>" />
			<?php } ?>
		</div><!-- .sackimage -->
										
		<?php $knapsackDownload = get_post_meta( $post->ID, 'knapsackurl', true); ?>
		<p class="download"><a href="<?php echo esc_html( $knapsackDownload ); ?>">Download</a></p>
										
	</div><!-- .sackperiph -->
	
	<div class="clear"></div>
</div>								
								
<?php endwhile;
							
// Reset Post Data
wp_reset_postdata();
							
?>