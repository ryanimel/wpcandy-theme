<?php
/**
 * WordPress Template: Attachment
 *
 * The attachment template is the general template used when a single 
 * attachment is queried.
 *
 * To use a custom template for a specfic attachment, create  
 * attachment-{mime_type}.php file in the parent/child theme's root directory, 
 * where {mime_type} can be the first part, second part, or both parts of the 
 * mime type seperated by an underscore.
 * 
 * Template Hierarchy
 * - attachment-{mime_type_1}.php (i.e. attachment-image.php)
 * - attachment-{mime_type_2}.php (i.e. attachment-png.php)
 * - attachment-{mime_type_1}_{mime_type_2}.php (i.e. attachment-image_png.php)
 * - attachment.php
 * - single.php
 * - index.php
 *
 * For more information on how WordPress handles attachments:
 * @link http://devpress.com/codex/theme-development/attachments/
 *
 * @package WP Framework
 * @subpackage Template
 */

get_template_part( 'header' ); ?>
				
				<div id="content" class="column-8">

					<?php do_action( 'content_open' ); ?>

					<?php get_template_part( 'media', 'image' ); ?>

					<?php do_action( 'content_close' ); ?>

				</div><!-- #content -->
				
				<?php get_template_part( 'sidebar' ); ?>
		
<?php get_template_part( 'footer' ); ?>