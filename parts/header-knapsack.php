<!DOCTYPE HTML>
<html <?php language_attributes(); ?>>
<head>

	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>"; charset="<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
	<?php do_action( 'wpf_head' ); ?>
	<link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/library/images/wpcandy-favicon.ico" />

	<title>Knapsack | A WPCandy Labs Project</title>

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

	<div id="container" class="wrap showgrid">

		<?php do_action( 'container_open' ); ?>

		<header id="top" role="banner">

			<?php do_action( 'header_open' ); ?>

			<div id="branding" class="wrap">

				<?php do_action( 'branding_open' ); ?>

				<div id="site-title" class="column-3">
					<p><a href="http://wpcandy.com/labs/knapsack" title="Knapsack, a WPCandy Labs Project">Knapsack</a></p>
					<p class="description">A WPCandy Labs Project</p>
					<div class="intro">
						<ol>
							<li><strong>Pick</strong> your favorite WordPress plugins.</li>
							<li><strong>Add</strong> them to a Knapsack.</li>
							<li><strong>Activate</strong> your Knapsack plugin to unpack it.</li>
							<li><strong>Share</strong> your favorite plugins with others.</li>
						</ol>
					</div>
				</div><!--#site-title-->
				
				<?php // get_template_part( 'parts/account', 'quicklinks' ); ?>
				
				<?php do_action( 'branding_close' ); ?>

			</div><!--#branding-->
			
			<div id="site-navigation" role="navigation">
				<?php wp_nav_menu( array( 'theme_location' => 'knapsack' ) ); ?>
			</div><!--#site-navigation-->

			<?php do_action( 'header_close' ); ?>

		</header><!--header-->