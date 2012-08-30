<?php
/**
 * WordPress Template: Comments
 *
 * The comments template is used when a template needs to display comments 
 * on that page.
 *
 * Individual comments have their own templates. The hierarchy for these 
 * templates are {comment_type}.php, comment.php.
 *
 * Template Hierarchy
 * - comment.php
 * - ./wp-includes/theme-compat/comments.php
 *
 * @package WP Framework
 * @subpackage Template
 */

if ( !post_type_supports( get_post_type(), 'comments' ) )
	return;
?>

<div id="comments">
	<?php do_action( 'commentsdiv_open' ); ?>

	<?php
	// Make sure comments.php doesn't get loaded directly
	if ( post_password_required() ) {
		do_action( 'post_password_required' ); ?>
		<p class="password-required alert"><?php echo wpf_get_string( 'password-required' ); ?></p>
		</div><!-- #comments -->
	<?php return; } ?>

	<?php if ( have_comments() ) : ?>

		<?php do_action( 'have_comments_before' ); ?>

		<h3 id="comments-title"><?php printf( _n( 'One Response to %2$s', '%1$s Responses to %2$s', get_comments_number(), t() ), number_format_i18n( get_comments_number() ), '<em>' . get_the_title() . '</em>' ); ?></h3>
		
		<?php do_action( 'comments_list_before' ); ?>

		<!-- comments title -->
		<ol class="comment-list">
			<?php
			/** talk about wpf_list_comment_args();
			 **/
			wp_list_comments( wpf_list_comment_args() );
			?>
		</ol><!-- .comment-list -->

		<?php do_action( 'comments_list_after' ); ?>
		<?php do_action( 'have_comments_after' ); ?>

	<?php else : ?>

		<?php if ( pings_open() && !comments_open() ) : ?>

			<p class="comments-closed pings-open">
				<?php printf( wpf_string( 'comments-closed-pings-open' ), trackback_url( '0' ) ); ?>
			</p><!-- .comments-closed .pings-open -->

			<?php do_action( 'comments_closed_pings_open' ); ?>

		<?php elseif ( !comments_open() ) : ?>
			
			<p class="comments-closed">
				<?php wpf_string( 'comments-closed' ); ?>
			</p><!-- .comments-closed -->

			<?php do_action( 'comments_closed' ); ?>

		<?php elseif ( comments_open() ) : ?>

			<p class="no-comments">
				<?php wpf_string( 'no-comments' ); ?>
			</p><!-- .no-comments -->

			<?php do_action( 'no_comments' ); ?>

		<?php endif; ?>
	
	<?php endif; ?>

	<?php comment_form( ); ?>

	<?php do_action( 'commentsdiv_close' ); ?>
		
</div><!-- #comments -->