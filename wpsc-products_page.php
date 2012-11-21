<h1>The WPCandy Shoppe</h1>

<p>Your one-stop <em>shoppe</em> for WPCandy products and merchandise!</p>

<hr />

<?php
global $wp_query;	
$image_width = get_option('product_image_width');
/*
 * Most functions called in this page can be found in the wpsc_query.php file
 */
?>
<div id="default_products_page_container" class="wrap wpsc_container">

	<?php do_action('wpsc_top_of_products_page'); // Plugin hook for adding things to the top of the products page, like the live search ?>
	<?php if(wpsc_display_categories()): ?>
	  <?php if(wpsc_category_grid_view()) :?>
			<div class="wpsc_categories wpsc_category_grid group">
				<?php wpsc_start_category_query(array('category_group'=> get_option('wpsc_default_category'), 'show_thumbnails'=> 1)); ?>
					<a href="<?php wpsc_print_category_url();?>" class="wpsc_category_grid_item  <?php wpsc_print_category_classes_section(); ?>" title="<?php wpsc_print_category_name(); ?>">
						<?php wpsc_print_category_image(get_option('category_image_width'),get_option('category_image_height')); ?>
					</a>
					<?php wpsc_print_subcategory("", ""); ?>
				<?php wpsc_end_category_query(); ?>
				
			</div><!--close wpsc_categories-->
	  <?php else:?>
			<ul class="wpsc_categories">
			
				<?php wpsc_start_category_query(array('category_group'=>get_option('wpsc_default_category'), 'show_thumbnails'=> get_option('show_category_thumbnails'))); ?>
						<li>
							<?php wpsc_print_category_image(get_option('category_image_width'), get_option('category_image_height')); ?>
							
							<a href="<?php wpsc_print_category_url();?>" class="wpsc_category_link <?php wpsc_print_category_classes_section(); ?>" title="<?php wpsc_print_category_name(); ?>"><?php wpsc_print_category_name(); ?></a>
							<?php if(wpsc_show_category_description()) :?>
								<?php wpsc_print_category_description("<div class='wpsc_subcategory'>", "</div>"); ?>				
							<?php endif;?>
							
							<?php wpsc_print_subcategory("<ul>", "</ul>"); ?>
						</li>
				<?php wpsc_end_category_query(); ?>
			</ul>
		<?php endif; ?>
	<?php endif; ?>
<?php // */ ?>
	
	<?php if(wpsc_display_products()): ?>	


<!-- ######################################################################### -->
<!-- ######################## Working Below This Line ######################## -->
<!-- ######################################################################### -->
	
		<ul id="shoppe-menu">
			<li><a href="/shoppe/checkout">Your Cart: <?php echo wpsc_cart_total_widget( false, false ,false ); ?></a></li>
		</ul><!-- #shoppe-menu -->
		
		<ul id="shoppe-list">
		<?php 
		$num = 0;
		while (wpsc_have_products()) :  wpsc_the_product();
		$num++; ?>
			
			<li class="shoppe-item num-<?php echo $num; ?> product_view_<?php echo wpsc_the_product_id(); ?> <?php echo wpsc_category_class(); ?> group">

				<div class="shoppe-item-title">
					<h3><a class="wpsc_product_title" href="<?php echo wpsc_the_product_permalink(); ?>" title="<?php wpsc_the_product_title(); ?>"><?php echo wpsc_the_product_title(); ?></a></h3>
					<div class="shoppe-details">
						<p class="pricedisplay product_<?php echo wpsc_the_product_id(); ?>"><span id='product_price_<?php echo wpsc_the_product_id(); ?>' class="currentprice pricedisplay"><?php echo wpcandy_wpsc_the_product_price(); ?></span></p>
					</div><!-- .shoppe-details -->
					<div class="clear"></div>
				</div><!-- .shoppe-item-title -->
				<div class="shoppe-item-image">
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail( 'full' ); ?></a>
				</div><!-- .shoppe-item-image -->
				<div class="shoppe-item-info">
					
					<?php if(wpsc_product_has_stock()) : ?>
						<div id="stock_display_<?php echo wpsc_the_product_id(); ?>" class="in_stock stock-message">
							<p>Good news: This product is in stock!</p>
						</div>
					<?php else: ?>
						<div id="stock_display_<?php echo wpsc_the_product_id(); ?>" class="out_of_stock stock-message">
							<p>Oh noes! This product is out of stock.</p>
						</div>
					<?php endif; ?>
					
					<form class="product_form"  enctype="multipart/form-data" action="<?php echo $action; ?>" method="post" name="product_<?php echo wpsc_the_product_id(); ?>" id="product_<?php echo wpsc_the_product_id(); ?>" >
						
						<input type="hidden" value="add_to_cart" name="wpsc_ajax_action"/>
						<input type="hidden" value="<?php echo wpsc_the_product_id(); ?>" name="product_id"/>
				
							<?php if(wpsc_product_has_stock()) : ?>
								<div class="wpsc_buy_button_container">
									<div class="wpsc_loading_animation">
										<img title="Loading" alt="Loading" src="<?php echo wpsc_loading_animation_url(); ?>" />
										<?php _e('Updating cart...', 'wpsc'); ?>
									</div><!--close wpsc_loading_animation-->
										<?php if(wpsc_product_external_link(wpsc_the_product_id()) != '') : ?>
										<?php $action = wpsc_product_external_link( wpsc_the_product_id() ); ?>
										<input class="wpsc_buy_button" type="submit" value="<?php echo wpsc_product_external_link_text( wpsc_the_product_id(), __( 'Buy Now', 'wpsc' ) ); ?>" onclick="return gotoexternallink('<?php echo $action; ?>', '<?php echo wpsc_product_external_link_target( wpsc_the_product_id() ); ?>')">
										<?php else: ?>
									<input type="submit" value="<?php _e('Add To Cart', 'wpsc'); ?>" name="Buy" class="wpsc_buy_button" id="product_<?php echo wpsc_the_product_id(); ?>_submit_button"/>
										<?php endif; ?>
								</div><!--close wpsc_buy_button_container-->
							<?php endif ; ?>

						<div class="entry-utility wpsc_product_utility">
							<?php edit_post_link( __( 'Edit', 'wpsc' ), '<span class="edit-link">', '</span>' ); ?>
						</div>
						<?php do_action ( 'wpsc_product_form_fields_end' ); ?>
					</form><!--close product_form-->
					<div class="clear"></div>
				</div><!-- .shoppe-item-info -->

			</li><!-- .shoppe-item -->

		<?php endwhile; ?>
		<?php /** end the product loop here */?>
		</ul><!-- #shoppe-list -->

		<?php if(wpsc_product_count() == 0):?>
			<h3><?php  _e('There are no products in this group.', 'wpsc'); ?></h3>
		<?php endif ; ?>
	    <?php do_action( 'wpsc_theme_footer' ); ?> 	

		<?php if(wpsc_has_pages_bottom()) : ?>
			<div class="wpsc_page_numbers_bottom">
				<?php wpsc_pagination(); ?>
			</div><!--close wpsc_page_numbers_bottom-->
		<?php endif; ?>
	<?php endif; ?>
</div><!--close default_products_page_container-->
