<?php
/**
 * Custom Template: Archive
 * 
 * The archive template is the general template used to display the WordPress 
 * loop on archive-base queries.
 *
 * @package WP Framework
 * @subpackage Template
 */

if ( have_posts() ) : ?>

	<?php do_action( 'loop_open' ); ?>

			<div id="hfeed">


				<?php do_action( 'hfeed_open' ); ?>
				<?php do_action( 'loop_has_posts_before' ); ?>
				
				<h3><?php $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); echo $term->name; ?> Powers WPCandy</h3>
				
				<?php echo category_description(); ?>
				
				<div class="entry-content">
				
				<p>The entire WPCandy team wholeheartedly thanks <?php echo $term->name; ?> for the continued support of WPCandy. We literally couldn't do it without you!</p>
				
				<p>If you would like to support WPCandy the way <?php echo $term->name; ?> did, you too can <a href="http://wpcandy.com/is/powered" title="Power WPCandy">power WPCandy</a>.</p>
				
				<div class="power-callout">
					<h4>Recent posts about <?php $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); echo $term->name; ?> on WPCandy:</h4>
					<?php $queryme = $term->name; ?>
				
					<?php if ( term_exists( $queryme, 'companies' ) !== '0' ) { ?>
					<?php $queryme = $term->name; ?>
					<ul>
						<?php $second_query = new WP_Query('companies=' . $queryme . '&showposts=5'); ?>
						<?php while( $second_query->have_posts() ) : $second_query->the_post(); ?>
						<li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>	
						<?php endwhile;
						wp_reset_postdata();?>
					</ul>
					
					<?php } ?>
					
					<?php if ( term_exists( $queryme, 'people' ) !== '0' ) { ?>
					<?php $queryme = $term->name; ?>
					<ul>
						<?php $second_query = new WP_Query('people=' . $queryme . '&showposts=5'); ?>
						<?php while( $second_query->have_posts() ) : $second_query->the_post(); ?>
						<li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>	
						<?php endwhile;
						wp_reset_postdata();?>
					</ul>
					
					<?php } ?>
					</div><!-- .power-callout -->
				
				<h4>Posts powered by <?php $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); echo $term->name; ?>:</h4>
				
				<ul>
				
				<?php global $query_string;
				query_posts( $query_string . "&posts_per_page=500" ); ?>
				<?php while ( have_posts() ) : the_post(); ?>
				
					<?php if(in_category('watches')) { ?>
					
					<?php do_action( 'loop_while_before' ); ?>

					<li id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

								Watch: <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', t() ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>

					</li><!-- #post-<?php the_ID(); ?> -->

					<?php do_action( 'loop_while_after' ); ?>
					
					<?php } else { ?>

					<?php do_action( 'loop_while_before' ); ?>

					<li id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

								<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', t() ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
						
					</li><!-- #post-<?php the_ID(); ?> -->

					<?php do_action( 'loop_while_after' ); ?>
					
					<?php } ?>

				<?php endwhile; ?>
				
				</ul>
				</div>

				<?php do_action( 'loop_has_posts_after' ); ?>
				<?php do_action( 'hfeed_close' ); ?>

			</div><!-- #hfeed -->

	<?php do_action( 'loop_close' ); ?>

<?php else : ?>

	<?php get_template_part( 'loop-404' ); ?>

<?php endif; ?>