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
		<?php get_template_part( 'templates/global', 'login' ); ?>
	</div><!-- .wrap -->
</nav><!-- .site-navigation .main-navigation -->

<div id="page" class="hfeed site">
	<?php do_action( 'before' ); ?>
	<header id="masthead" class="site-header" role="banner">
		<div class="wrap">
			<hgroup>
				<h1 class="site-title"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">The WPCandy Quarterly | A WPCandy Project</a></h1>
			</hgroup>
		
			<nav role="navigation" class="site-navigation main-navigation">
				<?php wp_nav_menu( array( 'theme_location' => 'quarterly' ) ); ?>
				<div class="clear"></div>
			</nav><!-- .site-navigation .main-navigation -->
		</div><!-- .wrap -->
	</header><!-- #masthead .site-header -->

	<div id="main" class="site-main">