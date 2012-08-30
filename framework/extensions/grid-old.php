<?php
/**
 * Roll your own Grid System - Personalized CSS Framework
 *
 * @version 0.2
 * @author Ptah Dunbar <http://ptahdunbar.com>
 * @license GPL v2 <http://www.gnu.org/licenses/old-licenses/gpl-2.0.html>
 */
if ( !$_GET ) die();

define( 'SHORTINT', 1 );
if ( file_exists('../../../../../wp-load.php') ) {
	@include( '../../../../../wp-load.php' );
}

$options = stripslashes( $_GET['ver'] );
$options = explode( '-', $options );

$columns = intval( $options[0] ); // number of columns
$width = intval( $options[1] ); // column widths
$gutter = intval( $options[2] ); // width of gutters
$baseline = isset( $options[3] ) ? intval( $options[3] ) : 1; // baseline

if ( !wpf_sanitize( $columns, 'int', 4 ) or !wpf_sanitize( $width, 'int', 4 ) or !wpf_sanitize( $gutter, 'int', 4 ) or !wpf_sanitize( $baseline, 'int', 4 ) ) {
	die( "Whoa now! Only numbers man.. and they can't be super loooong! like, more than 4 integers long. shesh.<br />This is a solid CSS grid system generator script, not some lame, \"I'm going to let you hack my script kinda thing.\"<br />We don't roll like that 'round here, <em>chump.</em><br /> <a href=\"http://rollyourown.gs\">Try again</a> :)" );
}

$wrap = $columns * $width + ($columns - 1) * $gutter; // wrap width;

$css_div_widths = '';
$css_column_widths = '';
$css_append = '';
$css_prepend = '';
$css_push = '';
$css_pull = '';

// beast mode.
if ( $columns == 1 ) {
	$css_column_widths = '.column-1 { width: ' . $width . 'px; }';
} else {
	for ( $i = 1; $i <= $columns; $i++ ) {
		$i_width = $i * $width + ($i - 1) * $gutter;
		$ap_width = $i_width + $gutter;
		
		if ( $i == $columns )
			$div_widths[] = '.column-' . $i . '';
		else
			$div_widths[] = '.column-' . $i . ',';
		
		$widths[] = '.column-' . $i . ' { width: ' . $i_width . 'px; }';
		
		$append[] = '.after-' . $i . ' { padding-right: ' . $ap_width . 'px; }';
		$prepend[] = '.before-' . $i . ' { padding-left: ' . $ap_width . 'px; }';
		
		$push[] = '.push-' . $i . ' { left: ' . $ap_width . 'px; }';
		$pull[] = '.pull-' . $i . ' { left: -' . $ap_width . 'px; }';
	}
	$css_div_widths = join( " \n", $div_widths );
	$css_column_widths = join( " \n", $widths );
	$css_append = join( " \n", $append );
	$css_prepend = join( " \n", $prepend );
	$css_push = join( " \n", $push );
	$css_pull = join( " \n", $pull );
}

//
$site_url = WPF_EXT_URI . "/grid.png.php?c={$width}&g={$gutter}&b={$baseline}";
header( 'Content-type: text/css' );
echo <<<CSS
/**
 * Roll your own Grid System - Personalized CSS Framework.
 *
 * @version 0.2
 *
 * CSS Framework:
 * - columns {$columns}
 * - width {$width}
 * - gutter {$gutter}
 * - baseline {$baseline}
 */

/* FYI: This grid has {$columns} column(s), each spanning {$width}px wide, with {$gutter}px gutters. */

/* The wrap element should group all your columns */
.wrap { width: {$wrap}px; margin-left: auto; margin-right: auto; }

/* Use this class on any .column/wrap to see the grid. */
.showgrid { background: url( '{$site_url}' ); }

/* Columns
-------------------------------------------------------------- */

/* Sets up basic grid floating and margin. */
$css_div_widths { position: relative; float: left; margin-right: {$gutter}px; }

/* The last column in a row needs this class. */
.last { margin-right: 0; }

/* Use these classes to set the width of a column. */
$css_column_widths

/* Add these to a column to append empty cols. */
$css_append

/* Add these to a column to prepend empty cols. */
$css_prepend

/* Use these classes on an element to push it into the next column */
$css_push

/* Use these classes on an element to pull it into the previous column. */
$css_pull

/* Clearing the .wrap */
.wrap:after { content: "."; display: block; height: 0; clear: both; visibility: hidden; }
.wrap { display: block; }
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
?>