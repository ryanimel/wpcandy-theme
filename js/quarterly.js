/**
 * Javascript: Custom
 * 
 * This javascript file is automatically included (along with the jQuery library)
 * in the footer of your website to help you start adding custom javascript
 * functionality to your website.
 * 
 * @package WP Framework
 * @subpackage JS
 */

(function($){

	$(document).ready(function(){
	
		$('#wp-admin-bar-site-name a.ab-item:eq(0)').addClass('first');
		
		$( '#product_31459_submit_button' ).val( 'Order Issue #1' );
		$( '#product_31460_submit_button' ).val( 'Subscribe Yearly' );
//		$( '.go_to_checkout', '#site-title a' ).attr( 'href', 'http://wpcandy.com/shoppe/checkout' );
//		$( ".go_to_checkout a" ).attr("href", "http://www.google.com/");
					
	});
	
})(jQuery);