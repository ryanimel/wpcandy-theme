<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package WPCandy Theme
 * @since WPCandy Theme 1.0
 */
?>

	</div><!-- #main .site-main -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<?php do_action( 'wpcandy_theme_credits' ); ?>
			<a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'wpcandy_theme' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'wpcandy_theme' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( __( '%1$s by %2$s with %3$s.', 'wpcandy_theme' ), 'WPCandy Theme', '<a href="http://ryanimel.com/" rel="designer">Ryan Imel</a>', 'many kudos' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon .site-footer -->
</div><!-- #page .hfeed .site -->

<?php wp_footer(); ?>

</body>
</html>