=== WP Framework ===
Contributors: ptahdunbar
Requires at least: 3.0.0
Tested up to: 3.x.x
Stable tag: 0.1

{Short Template Description}

== Description ==

{Long Template Description}

FEATURES:

- mobile
	- automatically switch themes to a specified child theme for mobile devices.

Appearance: Templates

	* Listing of all the templates available to the active theme. Templates are grayed out when file is not found.
		* Types of templates supported:
			* Default WordPress templates
			* WordPress page templates
			* Default BuddyPress template


* register feature support

* baseline\line-height generator: http://drewish.com/tools/vertical-rhythm

* need to be able to see all files in the theme editor

* remove wpautop for total Markup control.
	remove_filter('the_excerpt', 'wpautop');
	remove_filter('the_content', 'wpautop');
	(option to remove globally or one-by-one basis)

<meta charset="utf-8">

<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">


<!--  Mobile Viewport Fix
      j.mp/mobileviewport & davidbcalhoun.com/2010/viewport-metatag 
device-width : Occupy full width of the screen in its current orientation
initial-scale = 1.0 retains dimensions instead of zooming out if page height > device height
maximum-scale = 1.0 retains dimensions instead of zooming in if page width < device width
-->
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">

<!-- Place favicon.ico and apple-touch-icon.png in the root of your domain and delete these references -->
<link rel="shortcut icon" href="/favicon.ico">
<link rel="apple-touch-icon" href="/apple-touch-icon.png">

<!-- asynchronous google analytics: change the UA-XXXXX-X to be your site's ID -->
<script>
var _gaq = [['_setAccount', 'UA-XXXXX-X'], ['_trackPageview']];
(function(d, t) {
var g = d.createElement(t),
s = d.getElementsByTagName(t)[0];
g.async = true;
g.src = '//www.google-analytics.com/ga.js';
s.parentNode.insertBefore(g, s);
})(document, 'script');
</script>