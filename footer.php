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
		<div class="clear"></div>
	</div><!-- #main .site-main -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		
		<div id="footer-navigation">

			<div class="first">
				<?php wp_nav_menu( array( 'theme_location' => 'footer_column_one' ) ); ?>
			</div><!-- .first -->
			
			<div class="second">
				<?php wp_nav_menu( array( 'theme_location' => 'footer_column_two' ) ); ?>	
			</div><!-- .second -->
			
			<div class="third">
				<?php wp_nav_menu( array( 'theme_location' => 'footer_column_three' ) ); ?>
			</div><!-- .third -->
			
			<div class="fourth">
				<?php wp_nav_menu( array( 'theme_location' => 'footer_column_four' ) ); ?>
			</div><!-- .fourth -->

		</div><!-- #footer-navigation -->
		
		<div class="site-info">
			<?php do_action( 'wpcandy_theme_credits' ); ?>
			<p id="proudly"><a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'wpcandy_theme' ); ?>" rel="generator"><?php printf( __( 'Proudly powered, of course, by %s', 'wpcandy_theme' ), 'WordPress' ); ?></a></p>
			<p id="credits"><?php printf( __( '%1$s by %2$s with %3$s.', 'wpcandy_theme' ), 'WPCandy Theme', '<a href="http://ryanimel.com/" rel="designer">Ryan Imel</a>', 'many kudos' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon .site-footer -->
</div><!-- #page .hfeed .site -->

<?php wp_footer(); ?>

</body>
</html>