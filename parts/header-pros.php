<?php
/**
 * WordPress Template: Pros Header
 *
 * The header template is used as the primary header for your website.
 * Generally, all other WordPress templates rely on this file as it
 * contains all the opening HTML tags closed in the footer.php file.
 * It also executes key functions needed by WordPress,
 * the parent/child theme, and/or plugins.
 *
 * @package WP Framework
 * @subpackage Template
 */
?>
<!DOCTYPE HTML>
<html <?php language_attributes(); ?>>
<head>

	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>"; charset="<?php bloginfo('charset'); ?>" />
	<?php do_action( 'wpf_head' ); ?>
	<link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/library/images/wpcandy-favicon.ico" />

	<title>WPCandy Pros</title>

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

	<div id="container" class="wrap showgrid">

		<?php do_action( 'container_open' ); ?>

		<header id="top" role="banner">

			<?php do_action( 'header_open' ); ?>

			<div id="branding" class="wrap">

				<?php do_action( 'branding_open' ); ?>

				<div id="site-title" class="column-3">
					<div>
						<span>
							<a href="http://wpcandy.com/pros" title="WPCandy's WordPress Professionals">WPCandy Pros</a>
						</span>
					</div>
				</div><!--#site-title-->
				
				<?php do_action( 'branding_close' ); ?>

			</div><!--#branding-->
			
			<div id="site-navigation" role="navigation">
				<?php echo wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'nav-menu', 'menu_class' => 'menu wrap wtf', 'theme_location' => 'pros', 'show_home' => true ) ); ?>
			</div><!--#site-navigation-->

			<?php do_action( 'header_close' ); ?>

		</header><!--header-->
		
		<?php if( is_single() ) { ?>
		<div id="breadcrumbs">
			<div id="breadcrumbs-wrap">
				<p><strong>You are here:</strong> <a href="http://wpcandy.com" title="WPCandy WordPress news">WPCandy</a> &gt; <a href="http://wpcandy.com/pros" title="WordPress Professionals">Pros</a> &gt; <?php echo get_the_term_list( $post->ID, 'wpdf_location', 'Near ', ' or ', ' &gt;' ); ?> <?php echo get_the_term_list( $post->ID, 'wpdf_skill', 'Skilled in ', ' or ', ' &gt;' ); ?> <?php echo get_the_term_list( $post->ID, 'wpdf_price', 'For ', ' or ', ' &gt;' ); ?> <?php the_title(); ?></p>
			</div><!-- #breadcrumbs-wrap -->
		</div><!-- #breadcrumbs -->
		<?php } ?>

		<?php do_action( 'between_header_main' ); ?>
		
		<?php if ( !( '18050' == $post->post_parent ) && !( 'wpdf_pro' == get_post_type() && is_single() ) ) { get_template_part( 'parts/sorter' ); } ?>
		
		<div id="main" role="main">
			
			<?php do_action( 'main_open' ); ?>

			<div class="wrap">
				
				<?php do_action( 'main_wrap_open' ); ?>