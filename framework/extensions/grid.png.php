<?php
/**
 * Creates a .png for RYO
 *
 * @package WPFramework
 * @subpackage RYO.gs
 */

if ( !isset( $_GET['c'] ) and !isset( $_GET['g'] ) ) die( 'You need to set your column width and gutter width. (e.g. grid.php?c=20&g=10)' );

$column = intval( $_GET['c'] ); // column width
$gutter = intval( $_GET['g'] ); // gutter width

// $baseline
isset( $_GET['b'] ) ? $baseline = intval( $_GET['b'] ) : $baseline = 1; // typo baseline

if ( !wpf_sanitize( $baseline, 'int', 3 ) or !wpf_sanitize( $column, 'int', 3 ) or !wpf_sanitize( $gutter, 'int', 3 ) ) die();

// Set the values for grig.png's demensions.
$width = $column + $gutter;
$height = $baseline;

// Set the values for the baseline.
$bl_width = $width - 1;
$bl_height = $height - 1;

// Create the image and define colors
$png = imagecreatetruecolor( $width, $height );

if ( !$png ) die(); // If the iamge wasn't create, die.

$column_color	 = imagecolorallocatealpha( $png, 232, 239, 251, 0 ); // Defines the column color and alpha transparency
$gutter_color 	 = imagecolorallocatealpha( $png, 255, 255, 255, 0 ); // Defines the gutter color and alpha transparency
// $baseline_color	 = imagecolorallocatealpha( $png, 233, 233, 233, 0 ); // Defines the baseline color and alpha transparency
$baseline_color	 = imagecolorallocatealpha( $png, 255, 172, 172, 0 ); // Defines the baseline color and alpha transparency (red)
$baseline_color	 = imagecolorallocatealpha( $png, 194, 208, 201, 0 ); // Defines the baseline color and alpha transparency (gray)

imagefilledrectangle( $png, 0, 0, $column, $height, $column_color ); // Column Color
imagefilledrectangle( $png, $column, 0, $width, $height, $gutter_color ); // Gutter Color

// Draw baseline color
// x1 = 0, y1 = height -1, x2 = height -1, y2 = width -1
if ( $height > 1 ) imageline ( $png, 0, $bl_height, $bl_width, $bl_height, $baseline_color );

// Display the image
header( 'Content-type: image/png' );
imagepng( $png );
imagedestroy( $png );

function wpf_sanitize( $var, $type, $length ){
	$type = 'is_'. $type; // assign the type
	if ( !$type( $var ) ) return false;
	elseif ( empty( $var ) ) return false; // now we see if there is anything in the string
	elseif ( strlen( $var ) > $length ) return false; // then we check how long the string is
	else return true; // if all is well, we return TRUE
}