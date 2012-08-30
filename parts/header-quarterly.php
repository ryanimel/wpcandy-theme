<!DOCTYPE HTML>
<html <?php language_attributes(); ?>>
<head>

	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>"; charset="<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
	<?php do_action( 'wpf_head' ); ?>
	<link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/library/images/wpcandy-favicon.ico" />

	<title>The WPCandy Quarterly | A WPCandy Project</title>

	<?php do_action( 'wp_head' ); ?>
	
	<script type="text/javascript">
	
	 var _gaq = _gaq || [];
	 _gaq.push(['_setAccount', 'UA-15406058-1']);
	 _gaq.push(['_trackPageview']);
	
	 (function() {
	   var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	   ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	   var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	 })();

	</script>

</head>
<body <?php body_class(); ?>>

	<?php do_action( 'body_open' ); ?>
	
	<div id="site-topics" class="column-5">
		<?php echo wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'nav-menu', 'menu_class' => 'menu wrap', 'theme_location' => 'secondary', 'show_home' => true ) ); ?>
	</div><!-- #site-topics -->

	<div id="container" class="wrap showgrid<?php if( in_category('the-wpcandy-show') && is_single() ) { ?> broadcast-ready<?php } ?>">

		<?php do_action( 'container_open' ); ?>

		<header id="top" role="banner">

			<?php do_action( 'header_open' ); ?>

			<div id="branding" class="wrap">

				<?php do_action( 'branding_open' ); ?>

				<div id="site-title" class="column-3">
					<p><a href="http://wpcandy.com/quarterly" title="The WPCandy Quarterly">The WPCandy Quarterly</a></p>
				</div><!--#site-title-->
				
				<?php // get_template_part( 'parts/account', 'quicklinks' ); ?>
				
				<?php do_action( 'branding_close' ); ?>

			</div><!--#branding-->
			
			<div id="site-navigation" role="navigation">
				<?php wp_nav_menu( array( 'theme_location' => 'quarterly' ) ); ?>
			</div><!--#site-navigation-->

			<?php do_action( 'header_close' ); ?>

		</header><!--header-->
		
		<div id="slides">
							
		</div>