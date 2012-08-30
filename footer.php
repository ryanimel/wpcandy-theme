<?php
/**
 * WordPress Template: Footer
 * 
 * The footer template is used as the primary footer for your website.
 * Generally, all other WordPress templates rely on this file as it
 * contains all the closing HTML tags opened in the header.php file.
 * It also executes key functions needed by WordPress,
 * the parent/child theme, and/or plugins.
 *
 * @package WP Framework
 * @subpackage Template
 */
?>
				<?php do_action( 'main_wrap_close' ); ?>
				
			</div><!--#main.wrap-->

			<?php do_action( 'main_close' ); ?>

		</div><!--#main-->

		<?php do_action( 'between_main_footer' ); ?>

		<footer id="bottom" role="contentinfo">

			<?php do_action( 'footer_open' ); ?>
			
			<div id="footer-widgets">
				
				<div id="footer-widgets-01">
				
					<?php				
					if ( ! dynamic_sidebar( 'footer-widget-area-01' ) ) : ?>
						
					<?php endif; ?>
				
				</div><!-- #footer-widgets-01 -->
				
				<div id="footer-widgets-02">
				
					<?php				
					if ( ! dynamic_sidebar( 'footer-widget-area-02' ) ) : ?>
						
					<?php endif; ?>
				
				</div><!-- #footer-widgets-02 -->
				
				<div id="footer-widgets-03">
				
					<?php				
					if ( ! dynamic_sidebar( 'footer-widget-area-03' ) ) : ?>
						
					<?php endif; ?>
				
				</div><!-- #footer-widgets-03 -->
				
			</div><!-- #footer-widgets -->

			<div id="colophon" class="wrap">
				<?php do_action( 'colophon_open' ); ?>

				<div id="site-info" class="column-5">
					
					<?php echo wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'nav-menu', 'menu_class' => 'menu wrap', 'theme_location' => 'tertiary', 'show_home' => true ) ); ?>

				</div><!--#site-info-->

				<div id="site-credits" class="before-2 column-4 last">
					<p>Copyright &copy; 2012 WPCandy<br />
						Icons courtesy of <a href="http://helveticons.ch/" title="Icons by Helveticons">Helveticons</a> and <a href="http://www.komodomedia.com/blog/2008/12/social-media-mini-iconpack/" title="Komodo Media icons">Komodo Media</a>.</p>
				</div><!--#site-credits-->

				<?php do_action( 'colophon_close' ); ?>
			</div><!--#colophon-->

			<?php do_action( 'footer_close' ); ?>

		</footer><!--footer-->

		<?php do_action( 'container_close' ); ?>

	</div><!--#container-->

	<?php do_action( 'body_close' ); ?>
	<?php do_action( 'wp_footer' ); ?>
	
	<div class="clear"></div>
	
	<!-- Quantcast Tag -->
	<script type="text/javascript">
	var _qevents = _qevents || [];

	(function() {
	var elem = document.createElement('script');
	elem.src = (document.location.protocol == "https:" ? "https://secure" : "http://edge") + ".quantserve.com/quant.js";
	elem.async = true;
	elem.type = "text/javascript";
	var scpt = document.getElementsByTagName('script')[0];
	scpt.parentNode.insertBefore(elem, scpt);
	})();

	_qevents.push({
	qacct:"p-c18X1g7DkKOWY"
	});
	</script>

	<noscript>
	<div style="display:none;">
	<img src="//pixel.quantserve.com/pixel/p-c18X1g7DkKOWY.gif" border="0" height="1" width="1" alt="Quantcast"/>
	</div>
	</noscript>
	<!-- End Quantcast tag -->
	
</body>
</html>