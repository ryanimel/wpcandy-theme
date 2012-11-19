<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package WPCandy Theme
 * @since WPCandy Theme 1.0
 */

if ( ! function_exists( 'wpcandy_theme_content_nav' ) ):
/**
 * Display navigation to next/previous pages when applicable
 *
 * @since WPCandy Theme 1.0
 */
function wpcandy_theme_content_nav( $nav_id ) {
	global $wp_query;

	$nav_class = 'site-navigation paging-navigation';
	if ( is_single() )
		$nav_class = 'site-navigation post-navigation';

	?>
	<nav role="navigation" id="<?php echo $nav_id; ?>" class="<?php echo $nav_class; ?>">
		<h1 class="assistive-text"><?php _e( 'Post navigation', 'wpcandy_theme' ); ?></h1>

	<?php if ( is_single() ) : // navigation links for single posts ?>

		<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'wpcandy_theme' ) . '</span> %title' ); ?>
		<?php next_post_link( '<div class="nav-next">%link</div>', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'wpcandy_theme' ) . '</span>' ); ?>

	<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

		<?php if ( get_next_posts_link() ) : ?>
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'wpcandy_theme' ) ); ?></div>
		<?php endif; ?>

		<?php if ( get_previous_posts_link() ) : ?>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'wpcandy_theme' ) ); ?></div>
		<?php endif; ?>

	<?php endif; ?>

	</nav><!-- #<?php echo $nav_id; ?> -->
	<?php
}
endif; // wpcandy_theme_content_nav

if ( ! function_exists( 'wpcandy_theme_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since WPCandy Theme 1.0
 */
function wpcandy_theme_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'wpcandy_theme' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'wpcandy_theme' ), ' ' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer>
				<div class="comment-author vcard">
					<?php echo get_avatar( $comment, 40 ); ?>
					<?php printf( __( '%s <span class="says">says:</span>', 'wpcandy_theme' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
				</div><!-- .comment-author .vcard -->
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em><?php _e( 'Your comment is awaiting moderation.', 'wpcandy_theme' ); ?></em>
					<br />
				<?php endif; ?>

				<div class="comment-meta commentmetadata">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time pubdate datetime="<?php comment_time( 'c' ); ?>">
					<?php
						/* translators: 1: date, 2: time */
						printf( __( '%1$s at %2$s', 'wpcandy_theme' ), get_comment_date(), get_comment_time() ); ?>
					</time></a>
					<?php edit_comment_link( __( '(Edit)', 'wpcandy_theme' ), ' ' );
					?>
				</div><!-- .comment-meta .commentmetadata -->
			</footer>

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for wpcandy_theme_comment()

if ( ! function_exists( 'wpcandy_theme_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @since WPCandy Theme 1.0
 */
function wpcandy_theme_posted_on() {
	printf( __( 'Posted on <a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="byline"> by <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'wpcandy_theme' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'wpcandy_theme' ), get_the_author() ) ),
		esc_html( get_the_author() )
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category
 *
 * @since WPCandy Theme 1.0
 */
function wpcandy_theme_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so wpcandy_theme_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so wpcandy_theme_categorized_blog should return false
		return false;
	}
}

/**
 * Flush out the transients used in wpcandy_theme_categorized_blog
 *
 * @since WPCandy Theme 1.0
 */
function wpcandy_theme_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'wpcandy_theme_category_transient_flusher' );
add_action( 'save_post', 'wpcandy_theme_category_transient_flusher' );


/**
 * Conditional to test if a post is in a target category.
 *
 * @param int|array $cats The target categories. Integer ID or array of integer IDs
 * @param int|object $_post The post. Omit to test the current post in the Loop or main query
 * @return bool True if at least 1 of the post's categories is a descendant of any of the target categories
 * @see get_term_by() You can get a category by name or slug, then pass ID to this function
 * @uses get_term_children() Passes $cats
 * @uses in_category() Passes $_post (can be empty)
 * @version 2.7
 * @link http://codex.wordpress.org/Function_Reference/in_category#Testing_if_a_post_is_in_a_descendant_category
 * @since WPCandy Theme 1.0
 */
function post_is_in_descendant_category( $cats, $_post = null ) {
	foreach ( (array) $cats as $cat ) {
		// get_term_children() accepts integer ID only
		$descendants = get_term_children( (int) $cat, 'category');
		if ( $descendants && in_category( $descendants, $_post ) )
			return true;
	}
	return false;
}


/**
 * WPCandy comment policy link
 */
function wpcandy_theme_comment_policy_notification() {

	printf( __( '<p class="comment-notes">Please note that WPCandy is a <a href="%1$s" title="%2$s">moderated community</a>.', 'wpcandy-theme' ),
		esc_url( get_permalink( 4900 ) ),
		get_the_title( 4900 )
	);

}
add_action( 'comment_form_top','wpcandy_theme_comment_policy_notification' );


/**
 * WPCandy Current User Registration Date
 */
function wpcandy_user_registration_date( $user_id ) {
	$user = get_userdata( $user_id );
	$reg_date = date( 'l, F jS Y', strtotime( $user->user_registered ) );
	
	echo $reg_date;
}


/**
 * Get user email.
 */
function wpcandy_get_user_email( $user_id ) {
	$user = get_userdata( $user_id );
	$email = $user->user_email;
	
	return $email;
}


/**
 * WPCandy User Email
 */
function wpcandy_user_email( $user_id ) {
	$email = wpcandy_get_user_email( $user_id );
	
	echo $email;
}


/**
 * WPCandy User Role
 */
function wpcandy_user_role( $user_id ) {
	$user = new WP_User( $user_id );

	if ( !empty( $user->roles ) && is_array( $user->roles ) ) {
		foreach ( $user->roles as $role )
			echo ucfirst( $role );
	}
}


/**
 * WPCandy User Name
 */
function wpcandy_user_name( $user_id ) {
	$user = get_userdata( $user_id );
	$name = $user->display_name;
	
	echo $name;
}


/**
 * WPCandy Current User Pros
 */
function wpcandy_user_pros( $user_id ) {

	$args = array(
		'author'			=> $user_id,
		'posts_per_page'	=> '1',
		'post_type'			=> 'wpdf_pro'
	);
	
	// The Query
	$the_query = new WP_Query( $args );

	// The Loop
	while ( $the_query->have_posts() ) : $the_query->the_post();
		$return = '<a href="' . get_permalink() . '">' . get_the_title() . '</a>';
	endwhile;

	// Reset Post Data
	wp_reset_postdata();
	
	if ( ! $return ) {
		$return = 'None!';
	}
	
	echo $return;
}


/**
 * WPCandy Current User Posts
 */
function wpcandy_user_posts( $user_id ) {
	
	$args = array(
		'author'			=> $user_id,
		'posts_per_page'	=> '5'
	);
	
	// The Query
	$the_query = new WP_Query( $args );
	$return = '<ul>';

	// The Loop
	while ( $the_query->have_posts() ) : $the_query->the_post();
		$return .= '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
	endwhile;
	
	$return .= '</ul>';

	// Reset Post Data
	wp_reset_postdata();
	
	echo $return;
}


/**
 * WPCandy Current User Discussions
 */
function wpcandy_user_discussions( $user_id ) {
	
	$user_id = get_current_user_id();
	$args = array(
		'status' 	=> 'approve',
		'order' 	=>  'DESC',
		'user_id' 	=> $user_id,
		'number'	=> '5'
	);
	
	$comments = get_comments($args);
	
	$return = '<ul>';
	
	foreach($comments as $comment) :
		$return .= '<li>' . $comment->comment_content . '</li>';
	endforeach;
	
	$return .= '</ul>';

	echo $return;
}


/**
 * Get a user's comments in an array.
 */
function wpcandy_get_comments( $user_id ) {
	$args = array(
		'order'		=> 'DESC',
		'status'	=> 'approve',
		'author_email'	=> wpcandy_get_user_email( $user_id ),
	);
	$comments = get_comments( $args );
	
	return $comments;
}


/**
 * Get a user's comment IDs in an array.
 */
function wpcandy_get_comments_ids( $user_id ) {
	$comments = wpcandy_get_comments( $user_id );
	
	foreach( $comments as $comment ) :
		$array[] = $comment->comment_ID;
	endforeach;
	
	return $array;
}


/**
 * Get commented posts based on user id.
 */
function wpcandy_get_commented_posts( $user_id ) {
	$comments = wpcandy_get_comments( $user_id );
	
	foreach( $comments as $comment ) :
		$array[] = $comment->comment_post_ID;
	endforeach;
	
	$unique = array_unique( $array );
	
	return $unique;
}


/**
 * Return commented posts count.
 */
function wpcandy_get_commented_posts_count( $user_id ) {
	$array = wpcandy_get_commented_posts( $user_id );
	$count = count( $array );
	
	return $count;
}


/**
 * Echo the commented posts count.
 */
function wpcandy_commented_posts_count( $user_id ) {
	$count = wpcandy_get_commented_posts_count( $user_id );
	
	echo $count;
}


/**
 * Get specific comment number (first, last, or a specific number).
 */
function wpcandy_get_specific_comment( $user_id, $num ) {
	$array = wpcandy_get_comments_ids( $user_id );
	sort( $array );
	
	if ( is_numeric( $num ) ) {
		$target = $array[$num];
	} else if ( $num == 'last' ) {
		$target = end( $array );
	}
	
	return $target;
}


/**
 * Conditional: User has made comments.
 */
function wpcandy_user_has_commented( $user_id ) {
	$comments = wpcandy_get_comments( $user_id );
	
	if( $comments ) {
		$status = true;
	} else {
		$status = false;
	}
	
	return $status;
}


/**
 * Display target comment.
 */
function wpcandy_specific_comment( $user_id, $num ) {
	$target = wpcandy_get_specific_comment( $user_id, $num );
	$the_comment = get_comment( $target );
	
	echo '<p>Your <a href="' . get_permalink( $the_comment->comment_post_ID ) . '#comment-' . $the_comment->comment_ID . '">first ever comment</a> was on the post <a href="' . get_permalink( $the_comment->comment_post_ID ) . '">' . get_the_title( $the_comment->comment_post_ID ) . '</a>:</p>';
	echo '<blockquote>';
	echo $the_comment->comment_content;
	echo '</blockquote>';
}


/**
 * WPCandy Display Purchase Log
 * Modified from http://wordpress.org/extend/plugins/wp-e-commerce-user-roles-and-purchase-history/
 */
function wpcandy_show_purchase_history() {
	global $current_user, $wpdb, $table_prefix;
	get_currentuserinfo();
	$grand_total = 0;
	
	// Make sure the user is logged in and valid.
	if( is_numeric( $current_user->ID ) && ( $current_user->ID > 0 ) ) {		
		
		$sql = "SELECT p.`id`, c.`name`, p.`date`, p.`totalprice`, p.`processed`, p.`sessionid` FROM `".WPSC_TABLE_PURCHASE_LOGS."` AS p, `".WPSC_TABLE_CART_CONTENTS."` AS c WHERE p.`id`=c.`purchaseid` AND `user_ID` IN ('".$current_user->ID."') ORDER BY `date` DESC";
		
		// Get purchases
		$purchase_log = $wpdb->get_results( $sql,ARRAY_A );	

		if($purchase_log != null) {	// this user has made some purchase 

			echo "<table>";			
			foreach( (array)$purchase_log as $purchase ) {	

				$sql = "SELECT * FROM `".WPSC_TABLE_DOWNLOAD_STATUS."` WHERE `purchid`=".$purchase['id']." AND `active` IN ('1') ORDER BY `datetime` DESC";
				
				// Get the products purchased
				$products = $wpdb->get_results($sql,ARRAY_A) ;			
				$isOrderAccepted = $purchase['processed'];

				foreach ((array)$products as $product){					
					if($isOrderAccepted > 1){
						if($product['uniqueid'] == null) {  
							$links = get_option('siteurl')."?downloadid=".$product['id'];
						} else {
							$links = get_option('siteurl')."?downloadid=".$product['uniqueid'];
						}																				
						$download_count = $product['downloads'];
					}
				}
				echo '<tr>';
				echo '<th>Item</th>';
				echo '<th>Date</th>';
				echo '<th>Price</th>';
				echo '</tr>';								
				echo '<tr>';
				echo '<td>'.$purchase['name'].'</td>';
				
				echo '<td>'.date("d/m/Y",$purchase['date']).'</td>';
				echo '<td>'.nzshpcrt_currency_display( $purchase['totalprice'], 1, false, false, false ).'</td>';		        
				$grand_total += $purchase['totalprice'];
				echo '</tr>';							
			}
			echo '<tr>';
			echo "<td colspan='2'><strong>Total Spent</strong></td>";
			echo '<td><strong>' . nzshpcrt_currency_display( $grand_total, 1, false, false, false ) . '</strong></td>';
			echo '</tr>';
			echo '</table>';	
		} else
		{			
			echo 'No transactions found.';			
		}        
	} else {		
		echo 'You must be logged in to use this page.';
	}
}


/**
 * Conditional: WPCandy User Has Pros
 */
function wpcandy_user_has_pros( $user_id ) {
	$args = array(
		'author'			=> $user_id,
		'post_type'			=> 'wpdf_pro',
		'posts_per_page'	=> -1
	);
	$pros_query = new WP_Query( $args );
	$count = $pros_query->post_count;

	if ( $count > 0 ) {
		$status = true;
	} else {
		$status = false;
	}
	
	return $status;
}

