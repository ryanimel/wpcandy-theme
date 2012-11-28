<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WPCandy Theme
 * @since WPCandy Theme 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title(); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<nav role="navigation" class="site-navigation brand-navigation">
	<div class="wrap">
		<?php wp_nav_menu( array( 'theme_location' => 'secondary' ) ); ?>
	</div><!-- .wrap -->
</nav><!-- .site-navigation .main-navigation -->

<div id="page" class="hfeed site">
	<?php do_action( 'before' ); ?>
	<header id="masthead" class="site-header" role="banner">
		<hgroup>
			<h1 class="site-title"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<div id="description-swap">
				<p>A blog all about WordPress.<br /><span>Yes, we're a bit meta.</span></p>
			</div><!-- #description -->
		</hgroup>
		
		<?php get_template_part( 'templates/global', 'login' ); ?>

		<nav role="navigation" class="site-navigation main-navigation">
			<h1 class="assistive-text"><?php _e( 'Menu', 'wpcandy_theme' ); ?></h1>
			<div class="assistive-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'wpcandy_theme' ); ?>"><?php _e( 'Skip to content', 'wpcandy_theme' ); ?></a></div>

			<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
			<div class="clear"></div>
		</nav><!-- .site-navigation .main-navigation -->
	</header><!-- #masthead .site-header -->

	<?php if ( !is_home() && function_exists( 'bcn_display' ) ) { ?>
	<div id="breadcrumbs">
		<?php if ( is_post_type_archive( 'wpsc-product' ) || is_singular( 'wpsc-product' ) ) {
			$options = array(
					'before-breadcrumbs'	=> '<div class="wpsc-breadcrumbs"><strong>You are here:</strong> ',
					'crumb-separator'		=> ' &gt; ',
				);
				wpsc_output_breadcrumbs( $options );
			} else {
				bcn_display(); 
			} ?>			
	</div><!-- #breadcrumbs -->
	<?php } ?>
	

	<div id="main" class="site-main">
		
		<?php get_template_part( 'templates/parts/featured', 'posts' ); ?>