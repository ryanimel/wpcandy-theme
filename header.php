<?php
/**
 * WordPress Template: Header
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
	<meta name="viewport" content="initial-scale=1, maximum-scale=1" />
	
	<?php do_action( 'wpf_head' ); ?>
	<link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/library/images/wpcandy-favicon.ico" />

	<title><?php wp_title( '|', true, 'right' ); ?></title>

	<?php do_action( 'wp_head' ); ?>
	
	<!-- start Mixpanel --><script type="text/javascript">(function(d,c){var a,b,g,e;a=d.createElement("script");a.type="text/javascript";a.async=!0;a.src=("https:"===d.location.protocol?"https:":"http:")+'//api.mixpanel.com/site_media/js/api/mixpanel.2.js';b=d.getElementsByTagName("script")[0];b.parentNode.insertBefore(a,b);c._i=[];c.init=function(a,d,f){var b=c;"undefined"!==typeof f?b=c[f]=[]:f="mixpanel";g="disable track track_pageview track_links track_forms register register_once unregister identify name_tag set_config".split(" ");
for(e=0;e<g.length;e++)(function(a){b[a]=function(){b.push([a].concat(Array.prototype.slice.call(arguments,0)))}})(g[e]);c._i.push([a,d,f])};window.mixpanel=c})(document,[]);
mixpanel.init("fdefa18823470a43730d4eabac2df23a");</script><!-- end Mixpanel -->

<!-- adzerk -->
<script type="text/javascript">var p="http",d="static";if(document.location.protocol=="https:"){p+="s";d="engine";}var z=document.createElement("script");z.type="text/javascript";z.async=true;z.src=p+"://"+d+".adzerk.net/ados.js";var s=document.getElementsByTagName("script")[0];s.parentNode.insertBefore(z,s);</script>
<script type="text/javascript">
var ados = ados || {};
ados.run = ados.run || [];
ados.run.push(function() {
/* load placement for account: Pressed Ads, site: WPCandy, size: 120x90 - Button 1 and Text*/
ados_add_placement(640, 14163, "azk41122", 1);
ados_load();
});</script>


</head>
<body <?php body_class(); ?>>

	<?php do_action( 'body_open' ); ?>

	<div id="container" class="wrap showgrid<?php if( in_category('the-wpcandy-show') && is_single() ) { ?> broadcast-ready<?php } ?>">

		<?php do_action( 'container_open' ); ?>

		<header id="top" role="banner">

			<?php do_action( 'header_open' ); ?>
			
			<div id="branding" class="wrap">

				<?php do_action( 'branding_open' ); ?>

				<div id="site-title" class="column-3">
					<?php do_action( 'site_title' ); ?>
				</div><!--#site-title-->
				
				<div id="site-topics" class="column-5">
					<?php echo wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'nav-menu', 'menu_class' => 'menu wrap', 'theme_location' => 'secondary', 'show_home' => true ) ); ?>
				</div><!-- #site-topics -->
				
				<?php get_template_part( 'parts/account', 'quicklinks' ); ?>

				<?php do_action( 'branding_close' ); ?>

			</div><!--#branding-->
			
			<?php 
			// This checks to see if it's a WP Late Night archive page. If  it is, load that mother up.
			if ( is_category( '1924' ) ) { 
		
				get_template_part( 'parts/header', 'wplatenight' );

			} ?>

			<div id="site-navigation" role="navigation">
				<?php do_action( 'site_navigation' ); ?>
			</div><!--#site-navigation-->

			<?php do_action( 'header_close' ); ?>

		</header><!--header-->
		
		<?php if ( is_page( 16742 ) || bbp_is_forum() || bbp_is_reply() || bbp_is_topic() || bbp_is_single_user() ) {
		
			// get_template_part( 'discussions-header' );
		
		} ?> 
		
		<?php get_template_part( 'library/templates/breadcrumbs' ); ?>

		<?php do_action( 'between_header_main' ); ?>

		<div id="main" role="main"<?php if(in_category('Videos') && is_single()) { ?> class="category-videos clearfix"<?php } else { ?> class="clearfix"<?php } ?>>
			
			<?php do_action( 'main_open' ); ?>

			<div class="wrap clearfix">
				
				<?php do_action( 'main_wrap_open' ); ?>