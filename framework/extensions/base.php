<?php
/**
 * Baseline typography & Vertical Rhythm generator.
 *
 * @version 0.2
 * @author Ptah Dunbar <http://ptahdunbar.com>
 * @license GPL v2 <http://www.gnu.org/licenses/old-licenses/gpl-2.0.html>
 */

/*
Formula for PX to EM:
[desired pixel size] ÷ [default pixel size of the element’s containing block] = [size in ems]

Formula for EM to PX:
[em unit] × [default pixel size of the element’s containing block] = [size in pixels]
*/

// if ( !$_GET ) die();

$args = stripslashes( $_GET['ver'] );
$args = explode( '-', $args );

$base_font_size = intval( $args[0] );
$base_line_height = intval( $args[1] );

$base_font_size = 16;
$base_line_height = 22;

$default_font_sizes = array( '10', '12', '13', '14', '16', '18', '20', '24', '26', '28', '30', '32', '34' );

$font_sizes = ( isset($args[2]) AND ( '0' != $args[2]) ) ? explode( ',', $args[2] ) : $default_font_sizes;
$font_sizes = array_map( 'intval', $font_sizes );
$font_sizes = ( '' == $args[2] ) ? array() : $font_sizes;

$default_hgroup_sizes = array( '.site-title, h1=30', 'h2=22', 'h3=20', 'h4=18', 'h5=16', 'h6=16', 'p=16', '#sidebar, #site-description, .menu, .entry-utility, .entry-meta, footer=13' );
$hgroup_sizes = isset($args[3]) ? explode( ',', $args[3] ) : $default_hgroup_sizes;

if ( !wpf_sanitize( $base_font_size, 'int', 4 ) or !wpf_sanitize( $base_line_height, 'int', 4 ) OR !is_array( $font_sizes ) OR !is_array( $hgroup_sizes ) ) {
	die( "Whoa now! Only numbers man.. and they can't be super loooong! like, more than 4 integers long. shesh.<br />This is a solid CSS grid system generator script, not some lame, \"I'm going to let you hack my script kinda thing.\"<br />We don't roll like that 'round here, <em>chump.</em><br /> <a href=\"http://rollyourown.gs\">Try again</a> :)" );
}

$base_font_size_em = wpf_px_to_em( $base_font_size, $base_font_size );
$base_line_height_em = wpf_px_to_em( $base_line_height, $base_font_size );

$hgroups = array();
foreach ( $hgroup_sizes as $hgroup ) {
	$hgroup = explode( '=', $hgroup );
	$hgroups[ $hgroup[1] ][] = $hgroup[0];
}

$font_sizes = array_merge( $font_sizes, array_keys($hgroups) );
$font_sizes = array_unique( $font_sizes );

sort( $font_sizes );

$sizes = array();
$extra = '';
foreach ( $font_sizes as $font_size ) {
	if ( isset( $hgroups[ $font_size ] ) ) {
		foreach ( $hgroups[ $font_size ] as $heading ) {
			$extra .= $heading . ", \n";
		}
	}
	
	$fs = wpf_px_to_em( $font_size, $base_font_size );
	$lh = wpf_px_to_em( $base_line_height, $font_size );

$sizes[] = <<<HTML

$extra.fs-{$font_size} {
	font-size: {$fs}em; /* {$font_size}px */
	line-height: {$lh}em; /* {$base_line_height}px */
	margin-top: {$lh}em;
}

HTML;

$extra = '';
}

$sizes = join( "\n", $sizes );

header( 'Content-type: text/css' );
echo <<<CSS
/**
 * Baseline typography & Vertical Rhythm generator.
 *
 * @version 0.2
 *
 * CSS Basline:
 * Base font size: {$base_font_size}px = {$base_font_size_em}em
 * Base line height: {$base_line_height}px = {$base_line_height_em}em
 */

body, p,
ol, ul, dt, dd,
table, tr, address,
pre, tt, code, kbd, samp, var,
input, button, select, textarea {
	font-size: {$base_font_size_em}em;
	line-height: {$base_line_height_em}em;
}

$sizes

CSS;

/**
 * wpf_sanitize() - Cleans user inputs
 *
 */
function wpf_sanitize( $var, $type, $length ){
	$type = 'is_'. $type; // assign the type
	if ( !$type( $var ) ) return false;
	elseif ( empty( $var ) ) return false; // now we see if there is anything in the string
	elseif ( strlen( $var ) > $length ) return false; // then we check how long the string is
	else return true; // if all is well, we return TRUE
}

function wpf_px_to_em( $px, $em ) {
	return round( $px / $em, 4 );
}

function wpf_em_to_px( $em, $px ) {
	return round( $em * $px, 4 );
}
?>