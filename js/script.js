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
		// Adds the grid background to your layout
		// $('.wrap').addClass( 'showgrid' );
		
		$('body').addClass('js-on');
		
		$('#wp-admin-bar-site-name a.ab-item:eq(0)').addClass('first');
		
		$('div.entry-meta span.date-nice, div.entry-meta span.date-long').click(function() {
	  		$('div.entry-meta span.date-nice').toggle();
	  		$('div.entry-meta span.date-long').toggle();
	  	});
	  	
	  	$("div.post-revisions li:first").addClass("first").next("li").addClass("second").next("li").addClass("third");

	  	$("div.post-revisions h4").append(" (<span>show</span>)");
	
  		$('div.post-revisions h4 span').click(function() {
  			$("div.post-revisions li, div.post-revisions p").toggleClass("show");
  		});
  		
  		$('h3#copy-hide-trigger').click(function() {
  			$('div#copy-hide').slideToggle();
  		});
  		
  		$('div#wpcandy-interviews h2.section-header').click(function() {
  			$(this).toggleClass('clicked');
  			$('h2#community-videos').toggleClass('clicked');
  			$('article.category-watches').toggle();
  			$('div#wpcandy-interviews article').toggle();
  			$('div#nav-above').toggle();
  		});
  		
  		$('h2#community-videos').click(function() {
  			$(this).toggleClass('clicked');
  			$('div#wpcandy-interviews h2.section-header').toggleClass('clicked');
  			$('article.category-watches').toggle();
  			$('div#wpcandy-interviews article').toggle();
  			$('div#nav-above').toggle();
  		});
  		
  		// Fix Twitter oEmbed inline styles
  		setInterval( function() {
  			$( '.twitter-tweet-rendered' ).removeAttr( 'style' );
  		}, 100 );
  		
  		$("#nav-prevpost, #nav-nextpost, #featured li").click(function(){
  			window.location=$(this).find("a").attr("href");
  			return false;
  		});
  		
  		// Cheating a class in bbPress forms
  		$( '#bbp_topic_subscription' ).parent( 'p' ).addClass( 'bbp-topic-subs' );
  		
  		$( '#the-show-player' ).appendTo( '#show-presenter' );
  		
  		
  		(function() {
  		
  			var intentRegex = /twitter\.com(\:\d{2,4})?\/intent\/(\w+)/,
  			shortIntents = { tweet: true, retweet:true, favorite:true },
  			windowOptions = 'scrollbars=yes,resizable=yes,toolbar=no,location=yes',
  			winHeight = screen.height,
  			winWidth = screen.width;
  			
  			function handleIntent(e) {
  			
  				e = e || window.event;
  				var target = e.target || e.srcElement,
  				m, width, height, left, top;
  			
  				while (target && target.nodeName.toLowerCase() !== 'a') {
  					
  					target = target.parentNode;
  					
  				}
  				
  				if (target && target.nodeName.toLowerCase() === 'a' && target.href) {
  				
  					m = target.href.match(intentRegex);
  					
  					if (m) {
  					
  						width = 550;
  						height = (m[2] in shortIntents) ? 420 : 560;
  						left = Math.round((winWidth / 2) - (width / 2));
  						top = 0;
  						
  						if (winHeight > height) {
  						
  							top = Math.round((winHeight / 2) - (height / 2));
  							
  						}
  						
  						window.open(target.href, 'intent', windowOptions + ',width=' + width + ',height=' + height + ',left=' + left + ',top=' + top);
  						e.returnValue = false;
  						e.preventDefault && e.preventDefault();
  						
  					}
  					
  				}
  				
  			}
  			
  			if (document.addEventListener) {
  			
  				document.addEventListener('click', handleIntent, false);
  				
  			} else if (document.attachEvent) {
  			
  				document.attachEvent('onclick', handleIntent);
  				
  			}
  			
  		}());
  		

/* 		
  		$("#featured li").hover(
  			function () {
  				$(this).children('.featured-overlay').fadeIn('fast');
  			}, function () {
  				$(this).children('.featured-overlay').fadeOut('fast');
  			}
  		);
*/
/*  		
  		$('#slide-list').cycle({ 
  			delay:  10000, 
  			timeout: 20000,
  			pager: '#slideshow-pager',
  			speed:  500 
  		});

  		$('body.single-wpdfpro div.gallery').cycle({
  			speed: 500
  		});
 
*/
		
		/* Popular This Month */
		$('section#query-posts-17 li:eq(0)').addClass('popular-one');
		$('section#query-posts-17 li:eq(1)').addClass('popular-two');
		$('section#query-posts-17 li:eq(2)').addClass('popular-three');
		$('section#query-posts-17 li:eq(3)').addClass('popular-four');
		$('section#query-posts-17 li:eq(4)').addClass('popular-five');
		
		/* Tag Coverage */
		
		$('#coverage-people ul').attr( 'id', 'coverage-people-list' );
		$('#coverage-companies ul').attr( 'id', 'coverage-companies-list' );
		$('#coverage-events ul').attr( 'id', 'coverage-events-list' );
		
		
		if ( $( '.page-id-23812' ).length > 0 ) { 
			
			$( '#coverage-people-list, #coverage-companies-list, #coverage-events-list' ).listnav({
			
				showCounts: false,
				noMatchText: 'None found.' 
			
			});
			
		}
		

		$.fn.cleardefault = function() {
		
			return this.focus(function() {
			
				if( this.value == this.defaultValue ) {
					this.value = "";
				}
				
			}).blur(function() {
			
				if( !this.value.length ) {
				
					this.value = this.defaultValue;
				
				}
			
			});
		
		};
		
		$("#gform_fields_15 input.medium").cleardefault();
		
		
		$.each( $( '#coverage-people-list li a, #coverage-companies-list li a, #coverage-events-list li a' ), function( i,v ) {
		
			var postCount = $(this).attr( 'title' );
			$(this).after( '<span>' ).after( postCount ).after( '</span>' );
			
		});
		
		$( '#companies-trigger' ).click( function(){
			
			$( '#coverage-switcher .selected' ).removeClass( 'selected' );
			$( this ).addClass( 'selected' );
  			$( '.coverage-selected' ).removeClass( 'coverage-selected' );
  			$( '#coverage-companies-wrap' ).addClass( 'coverage-selected');

  		});
  		$( '#people-trigger' ).click( function(){
			
			$( '#coverage-switcher .selected' ).removeClass( 'selected' );
			$( this ).addClass( 'selected' );
  			$( '.coverage-selected' ).removeClass( 'coverage-selected' );
  			$( '#coverage-people-wrap' ).addClass( 'coverage-selected');

  		});
  		$( '#events-trigger' ).click( function(){
			
			$( '#coverage-switcher .selected' ).removeClass( 'selected' );
			$( this ).addClass( 'selected' );
			$( '.coverage-selected' ).removeClass( 'coverage-selected' );
  			$( '#coverage-events-wrap' ).addClass( 'coverage-selected');

  		});
  		

		// Pros sorter
		$('#sorter-link-city').click(function(){
		
			$('#sorter-cities').toggle();
			return false;
			
		});
		$('#sorter-link-price').click(function(){
		
			$('#sorter-prices').toggle();
			return false;
			
		});
		$('#sorter-link-skill').click(function(){
		
			$('#sorter-skills').toggle();
			return false;
			
		});
		
		$('a.sorter-clear').click(function() {
  			$(this).prev().addClass('fake-cleared');
  		});
  		
  		$.fn.limit = function(n) {
  			
  			var self = this;
  			this.click(function(){ return (self.filter(":checked").length<=n); });
  		
  		}
  		
  		$("ul#input_12_11 li input:checkbox,ul#input_11_11 li input:checkbox").limit(2);
  		$("ul#input_11_11 li input:checkbox,ul#input_11_11 li input:checkbox").limit(2);
		
		
		// Bunch of reordering for the Create Pro forms
		
		// Moves Official Family to top, with group
		$("#field_12_17 li.gchoice_17_25").insertBefore("#field_12_17 li.gchoice_17_1"); // Official Family, 25
		$("#field_11_17 li.gchoice_17_25").insertBefore("#field_11_17 li.gchoice_17_1");
		$("#field_12_17 li.gchoice_17_4").insertAfter("#field_12_17 li.gchoice_17_25"); // bbPress, 4
		$("#field_11_17 li.gchoice_17_4").insertAfter("#field_11_17 li.gchoice_17_25");
		$("#field_12_17 li.gchoice_17_5").insertAfter("#field_12_17 li.gchoice_17_4"); // BuddyPress, 5
		$("#field_11_17 li.gchoice_17_5").insertAfter("#field_11_17 li.gchoice_17_4");
		$("#field_12_17 li.gchoice_17_41").insertAfter("#field_12_17 li.gchoice_17_23"); // WordPress, 41
		$("#field_11_17 li.gchoice_17_41").insertAfter("#field_11_17 li.gchoice_17_23");
		$("#field_12_17 li.gchoice_17_23").insertAfter("#field_12_17 li.gchoice_17_5"); // Multisite, 23
		$("#field_11_17 li.gchoice_17_23").insertAfter("#field_11_17 li.gchoice_17_5");

		// Themes group
		$("#field_12_17 li.gchoice_17_36").insertAfter("#field_12_17 li.gchoice_17_40"); // Themes, 35
		$("#field_11_17 li.gchoice_17_36").insertAfter("#field_11_17 li.gchoice_17_40");
		$("#field_12_17 li.gchoice_17_2").insertAfter("#field_12_17 li.gchoice_17_36"); // AppThemes, 2
		$("#field_11_17 li.gchoice_17_2").insertAfter("#field_11_17 li.gchoice_17_36");
		$("#field_12_17 li.gchoice_17_6").insertAfter("#field_12_17 li.gchoice_17_2"); // Builder, 6
		$("#field_11_17 li.gchoice_17_6").insertAfter("#field_11_17 li.gchoice_17_2");
		$("#field_12_17 li.gchoice_17_7").insertAfter("#field_12_17 li.gchoice_17_6"); // Canvas, 7
		$("#field_11_17 li.gchoice_17_7").insertAfter("#field_11_17 li.gchoice_17_6");
		$("#field_12_17 li.gchoice_17_8").insertAfter("#field_12_17 li.gchoice_17_7"); // Carrington, 8
		$("#field_11_17 li.gchoice_17_8").insertAfter("#field_11_17 li.gchoice_17_7");
		$("#field_12_17 li.gchoice_17_11").insertAfter("#field_12_17 li.gchoice_17_8"); // Catalyst, 11
		$("#field_11_17 li.gchoice_17_11").insertAfter("#field_11_17 li.gchoice_17_8");
		$("#field_12_17 li.gchoice_17_13").insertAfter("#field_12_17 li.gchoice_17_11"); // Elemental, 13
		$("#field_11_17 li.gchoice_17_13").insertAfter("#field_11_17 li.gchoice_17_11");
		$("#field_12_17 li.gchoice_17_15").insertAfter("#field_12_17 li.gchoice_17_13"); // Genesis, 15
		$("#field_11_17 li.gchoice_17_15").insertAfter("#field_11_17 li.gchoice_17_13");
		$("#field_12_17 li.gchoice_17_17").insertAfter("#field_12_17 li.gchoice_17_15"); // Headway, 17
		$("#field_11_17 li.gchoice_17_17").insertAfter("#field_11_17 li.gchoice_17_15");
		$("#field_12_17 li.gchoice_17_19").insertAfter("#field_12_17 li.gchoice_17_17"); // Hybrid, 19
		$("#field_11_17 li.gchoice_17_19").insertAfter("#field_11_17 li.gchoice_17_17");
		$("#field_12_17 li.gchoice_17_27").insertAfter("#field_12_17 li.gchoice_17_19"); // Platform Pro, 27
		$("#field_11_17 li.gchoice_17_27").insertAfter("#field_11_17 li.gchoice_17_19");
		$("#field_12_17 li.gchoice_17_31").insertAfter("#field_12_17 li.gchoice_17_27"); // Sandbox, 31
		$("#field_11_17 li.gchoice_17_31").insertAfter("#field_11_17 li.gchoice_17_27");
		$("#field_12_17 li.gchoice_17_33").insertAfter("#field_12_17 li.gchoice_17_31"); // Standard Theme, 33
		$("#field_11_17 li.gchoice_17_33").insertAfter("#field_11_17 li.gchoice_17_31");
		$("#field_12_17 li.gchoice_17_34").insertAfter("#field_12_17 li.gchoice_17_33"); // Startbox, 34
		$("#field_11_17 li.gchoice_17_34").insertAfter("#field_11_17 li.gchoice_17_33");
		$("#field_12_17 li.gchoice_17_35").insertAfter("#field_12_17 li.gchoice_17_34"); // Thematic, 35
		$("#field_11_17 li.gchoice_17_35").insertAfter("#field_11_17 li.gchoice_17_34");
		$("#field_12_17 li.gchoice_17_37").insertAfter("#field_12_17 li.gchoice_17_35"); // Thesis, 37
		$("#field_11_17 li.gchoice_17_37").insertAfter("#field_11_17 li.gchoice_17_35");
		$("#field_12_17 li.gchoice_17_42").insertAfter("#field_12_17 li.gchoice_17_36"); // WP Framework, 42
		$("#field_11_17 li.gchoice_17_42").insertAfter("#field_11_17 li.gchoice_17_36");

		
		// Plugin group
/*
		$("#field_12_17 li.gchoice_17_22").insertAfter("#field_12_17 li.gchoice_17_36"); // Plugins, 28
		$("#field_11_17 li.gchoice_17_22").insertAfter("#field_11_17 li.gchoice_17_36");
*/
		$("#field_12_17 li.gchoice_17_1").insertAfter("#field_12_17 li.gchoice_17_28"); // AIOSEO, 1
		$("#field_11_17 li.gchoice_17_1").insertAfter("#field_11_17 li.gchoice_17_28");
		$("#field_12_17 li.gchoice_17_3").insertAfter("#field_12_17 li.gchoice_17_1"); // BackupBuddy, 3
		$("#field_11_17 li.gchoice_17_3").insertAfter("#field_11_17 li.gchoice_17_1");
		$("#field_12_17 li.gchoice_17_9").insertAfter("#field_12_17 li.gchoice_17_3"); // Cart66, 9
		$("#field_11_17 li.gchoice_17_9").insertAfter("#field_11_17 li.gchoice_17_3");
		$("#field_12_17 li.gchoice_17_14").insertAfter("#field_12_17 li.gchoice_17_9"); // Event Espresso, 14
		$("#field_11_17 li.gchoice_17_14").insertAfter("#field_11_17 li.gchoice_17_9");
		$("#field_12_17 li.gchoice_17_16").insertAfter("#field_12_17 li.gchoice_17_14"); // Gravity Forms, 16
		$("#field_11_17 li.gchoice_17_16").insertAfter("#field_11_17 li.gchoice_17_14");
		$("#field_12_17 li.gchoice_17_29").insertAfter("#field_12_17 li.gchoice_17_16"); // PollDaddy, 29
		$("#field_11_17 li.gchoice_17_29").insertAfter("#field_11_17 li.gchoice_17_16");
		$("#field_12_17 li.gchoice_17_32").insertAfter("#field_12_17 li.gchoice_17_29"); // Shopp, 32
		$("#field_11_17 li.gchoice_17_32").insertAfter("#field_11_17 li.gchoice_17_29");
		$("#field_12_17 li.gchoice_17_38").insertAfter("#field_12_17 li.gchoice_17_32"); // VaultPress, 38
		$("#field_11_17 li.gchoice_17_38").insertAfter("#field_11_17 li.gchoice_17_32");
		$("#field_12_17 li.gchoice_17_39").insertAfter("#field_12_17 li.gchoice_17_32"); // W3 Total Cache, 39
		$("#field_11_17 li.gchoice_17_39").insertAfter("#field_11_17 li.gchoice_17_32");
		$("#field_12_17 li.gchoice_17_42").insertAfter("#field_12_17 li.gchoice_17_32"); // WP e-Commerce, 41
		$("#field_11_17 li.gchoice_17_42").insertAfter("#field_11_17 li.gchoice_17_32");
		
		
		// Languages group
		$("#field_12_17 li.gchoice_17_22").insertAfter("#field_12_17 li.gchoice_17_41"); // Languages, 22
		$("#field_11_17 li.gchoice_17_22").insertAfter("#field_11_17 li.gchoice_17_41");
		$("#field_12_17 li.gchoice_17_12").insertAfter("#field_12_17 li.gchoice_17_22"); // CSS, 12
		$("#field_11_17 li.gchoice_17_12").insertAfter("#field_11_17 li.gchoice_17_22");
		$("#field_12_17 li.gchoice_17_18").insertAfter("#field_12_17 li.gchoice_17_12"); // HTML, 18
		$("#field_11_17 li.gchoice_17_18").insertAfter("#field_11_17 li.gchoice_17_12");
		$("#field_12_17 li.gchoice_17_21").insertAfter("#field_12_17 li.gchoice_17_18"); // Javascript, 21
		$("#field_11_17 li.gchoice_17_21").insertAfter("#field_11_17 li.gchoice_17_18");
		$("#field_12_17 li.gchoice_17_24").insertAfter("#field_12_17 li.gchoice_17_21"); // MySQL, 24
		$("#field_11_17 li.gchoice_17_24").insertAfter("#field_11_17 li.gchoice_17_21");
		$("#field_12_17 li.gchoice_17_26").insertAfter("#field_12_17 li.gchoice_17_24"); // PHP, 26
		$("#field_11_17 li.gchoice_17_26").insertAfter("#field_11_17 li.gchoice_17_24");
			
			
		// Shopping/shipping settings
		$( '.wpsc_product_quantity form.adjustform, .wpsc_product_remove form.adjustform, form.wpsc_checkout_forms' ).attr( 'action', 'http://wpcandy.com/shoppe/checkout' );
		
		$( '.wpsc_product_price p:last-child' ).addClass( 'last' );
		
		$( '.wpsc_product_name a' ).replaceWith(function() { return $(this).contents(); });
		
		
		
		
		// Drafts Dropdown
		
		$('#wp-admin-bar-cfdd_drafts_menu').click(function(e) {
		e.preventDefault();
// slide up
		$wrap = $('#cfdd_drafts_wrap');
		if ($wrap.size() && $wrap.is(':visible')) {
			$wrap.slideUp(function() {
				$(this).remove();
			});
			return;
		}
// slide down
		$('body').append('<div id="cfdd_drafts_wrap"><div class="cfdd_content"></div></div>');
// show spinner
		$wrap = $('#cfdd_drafts_wrap');
		$wrap.css({'height': '400px'}).slideDown().addClass('loading');
// load drafts
		$.post(
			'http://wpcandy.com/wp-admin/admin-ajax.php',
			{
				action: 'cfdd_drafts_list'
			},
			function(response) {
				$content = $wrap.find('.cfdd_content');
				$content.html(response.html);
// format cols
				var drafts = $('#cfdd_drafts li');
				var drafts_count = drafts.size();
				var i = 0;
				if (drafts_count <= 10) {
// set to 2 columns
					$content.append('<div class="cfdd_col" id="cfdd_col_1"><ul></ul></div><div class="cfdd_col" id="cfdd_col_2"><ul></ul></div><div class="cfdd_clear"></div>');
					var col_count = Math.ceil(drafts_count / 2);
					drafts.each(function() {
						i < col_count ? target = '#cfdd_col_1 ul' : target = '#cfdd_col_2 ul';
						$(this).appendTo(target);
						i++;
					});
				}
				else {
// 3 columns
					$content.append('<div class="cfdd_col" id="cfdd_col_1"><ul></ul></div><div class="cfdd_col" id="cfdd_col_2"><ul></ul></div><div class="cfdd_col" id="cfdd_col_3"><ul></ul></div><div class="cfdd_clear"></div>');
					var col_count = Math.ceil(drafts_count / 3);
					drafts.each(function() {
						if (i < col_count) {
							target = '#cfdd_col_1 ul';
						}
						else if (i >= col_count * 2) {
							target = '#cfdd_col_3 ul';
						}
						else {
							target = '#cfdd_col_2 ul';
						}
						$(this).appendTo(target);
						i++;
					});
				}
				$('#cfdd_drafts').remove();
			// set size of cfdd_col
				$('.cfdd_col').width(Math.floor($('body').width() - 120) / 3);
				$('.cfdd_col:last').css('border-right', 0);

				var height = 0;
				$wrap.find('.cfdd_col').each(function() {
					if ($(this).height() > height) {
						height = $(this).height();
					}
				});
				if (height < 400) {
					$wrap.animate({ 'height': height + 'px' }, 'fast');
				}

// remove spinner, make visible
				$wrap.removeClass('loading');
				$content.hide().css({ 'visibility': 'visible' }).fadeIn();
			},
			'json'
		);
	});
		
		
		
		
		
	});
	
	
	
})(jQuery);

/**
 * Cookie plugin
 *
 * Copyright (c) 2006 Klaus Hartl (stilbuero.de)
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 *
 */
jQuery.cookie=function(name,value,options){if(typeof value!='undefined'){options=options||{};if(value===null){value='';options.expires=-1;}
var expires='';if(options.expires&&(typeof options.expires=='number'||options.expires.toUTCString)){var date;if(typeof options.expires=='number'){date=new Date();date.setTime(date.getTime()+(options.expires*24*60*60*1000));}else{date=options.expires;}
expires='; expires='+date.toUTCString();}
var path=options.path?'; path='+(options.path):'';var domain=options.domain?'; domain='+(options.domain):'';var secure=options.secure?'; secure':'';document.cookie=[name,'=',encodeURIComponent(value),expires,path,domain,secure].join('');}else{var cookieValue=null;if(document.cookie&&document.cookie!=''){var cookies=document.cookie.split(';');for(var i=0;i<cookies.length;i++){var cookie=jQuery.trim(cookies[i]);if(cookie.substring(0,name.length+1)==(name+'=')){cookieValue=decodeURIComponent(cookie.substring(name.length+1));break;}}}
return cookieValue;}};

/* Modernizr 2.0.6 (Custom Build) | MIT & BSD
 * Contains: applicationcache | canvas | canvastext | draganddrop | hashchange | history | audio | video | indexeddb | input | inputtypes | localstorage | postmessage | sessionstorage | websockets | websqldatabase | webworkers | iepp | cssclasses | teststyles | testprop | testallprops | hasevent | prefixes | domprefixes | load
 */
;window.Modernizr=function(a,b,c){function F(){e.input=function(a){for(var b=0,c=a.length;b<c;b++)s[a[b]]=a[b]in l;return s}("autocomplete autofocus list placeholder max min multiple pattern required step".split(" ")),e.inputtypes=function(a){for(var d=0,e,f,h,i=a.length;d<i;d++)l.setAttribute("type",f=a[d]),e=l.type!=="text",e&&(l.value=m,l.style.cssText="position:absolute;visibility:hidden;",/^range$/.test(f)&&l.style.WebkitAppearance!==c?(g.appendChild(l),h=b.defaultView,e=h.getComputedStyle&&h.getComputedStyle(l,null).WebkitAppearance!=="textfield"&&l.offsetHeight!==0,g.removeChild(l)):/^(search|tel)$/.test(f)||(/^(url|email)$/.test(f)?e=l.checkValidity&&l.checkValidity()===!1:/^color$/.test(f)?(g.appendChild(l),g.offsetWidth,e=l.value!=m,g.removeChild(l)):e=l.value!=m)),r[a[d]]=!!e;return r}("search tel url email datetime date month week time datetime-local number range color".split(" "))}function E(a,b){var c=a.charAt(0).toUpperCase()+a.substr(1),d=(a+" "+p.join(c+" ")+c).split(" ");return D(d,b)}function D(a,b){for(var d in a)if(k[a[d]]!==c)return b=="pfx"?a[d]:!0;return!1}function C(a,b){return!!~(""+a).indexOf(b)}function B(a,b){return typeof a===b}function A(a,b){return z(o.join(a+";")+(b||""))}function z(a){k.cssText=a}var d="2.0.6",e={},f=!0,g=b.documentElement,h=b.head||b.getElementsByTagName("head")[0],i="modernizr",j=b.createElement(i),k=j.style,l=b.createElement("input"),m=":)",n=Object.prototype.toString,o=" -webkit- -moz- -o- -ms- -khtml- ".split(" "),p="Webkit Moz O ms Khtml".split(" "),q={},r={},s={},t=[],u=function(a,c,d,e){var f,h,j,k=b.createElement("div");if(parseInt(d,10))while(d--)j=b.createElement("div"),j.id=e?e[d]:i+(d+1),k.appendChild(j);f=["&shy;","<style>",a,"</style>"].join(""),k.id=i,k.innerHTML+=f,g.appendChild(k),h=c(k,a),k.parentNode.removeChild(k);return!!h},v=function(){function d(d,e){e=e||b.createElement(a[d]||"div"),d="on"+d;var f=d in e;f||(e.setAttribute||(e=b.createElement("div")),e.setAttribute&&e.removeAttribute&&(e.setAttribute(d,""),f=B(e[d],"function"),B(e[d],c)||(e[d]=c),e.removeAttribute(d))),e=null;return f}var a={select:"input",change:"input",submit:"form",reset:"form",error:"img",load:"img",abort:"img"};return d}(),w,x={}.hasOwnProperty,y;!B(x,c)&&!B(x.call,c)?y=function(a,b){return x.call(a,b)}:y=function(a,b){return b in a&&B(a.constructor.prototype[b],c)},q.canvas=function(){var a=b.createElement("canvas");return!!a.getContext&&!!a.getContext("2d")},q.canvastext=function(){return!!e.canvas&&!!B(b.createElement("canvas").getContext("2d").fillText,"function")},q.postmessage=function(){return!!a.postMessage},q.websqldatabase=function(){var b=!!a.openDatabase;return b},q.indexedDB=function(){for(var b=-1,c=p.length;++b<c;)if(a[p[b].toLowerCase()+"IndexedDB"])return!0;return!!a.indexedDB},q.hashchange=function(){return v("hashchange",a)&&(b.documentMode===c||b.documentMode>7)},q.history=function(){return!!a.history&&!!history.pushState},q.draganddrop=function(){return v("dragstart")&&v("drop")},q.websockets=function(){for(var b=-1,c=p.length;++b<c;)if(a[p[b]+"WebSocket"])return!0;return"WebSocket"in a},q.video=function(){var a=b.createElement("video"),c=!1;try{if(c=!!a.canPlayType){c=new Boolean(c),c.ogg=a.canPlayType('video/ogg; codecs="theora"');var d='video/mp4; codecs="avc1.42E01E';c.h264=a.canPlayType(d+'"')||a.canPlayType(d+', mp4a.40.2"'),c.webm=a.canPlayType('video/webm; codecs="vp8, vorbis"')}}catch(e){}return c},q.audio=function(){var a=b.createElement("audio"),c=!1;try{if(c=!!a.canPlayType)c=new Boolean(c),c.ogg=a.canPlayType('audio/ogg; codecs="vorbis"'),c.mp3=a.canPlayType("audio/mpeg;"),c.wav=a.canPlayType('audio/wav; codecs="1"'),c.m4a=a.canPlayType("audio/x-m4a;")||a.canPlayType("audio/aac;")}catch(d){}return c},q.localstorage=function(){try{return!!localStorage.getItem}catch(a){return!1}},q.sessionstorage=function(){try{return!!sessionStorage.getItem}catch(a){return!1}},q.webworkers=function(){return!!a.Worker},q.applicationcache=function(){return!!a.applicationCache};for(var G in q)y(q,G)&&(w=G.toLowerCase(),e[w]=q[G](),t.push((e[w]?"":"no-")+w));e.input||F(),z(""),j=l=null,a.attachEvent&&function(){var a=b.createElement("div");a.innerHTML="<elem></elem>";return a.childNodes.length!==1}()&&function(a,b){function s(a){var b=-1;while(++b<g)a.createElement(f[b])}a.iepp=a.iepp||{};var d=a.iepp,e=d.html5elements||"abbr|article|aside|audio|canvas|datalist|details|figcaption|figure|footer|header|hgroup|mark|meter|nav|output|progress|section|summary|time|video",f=e.split("|"),g=f.length,h=new RegExp("(^|\\s)("+e+")","gi"),i=new RegExp("<(/*)("+e+")","gi"),j=/^\s*[\{\}]\s*$/,k=new RegExp("(^|[^\\n]*?\\s)("+e+")([^\\n]*)({[\\n\\w\\W]*?})","gi"),l=b.createDocumentFragment(),m=b.documentElement,n=m.firstChild,o=b.createElement("body"),p=b.createElement("style"),q=/print|all/,r;d.getCSS=function(a,b){if(a+""===c)return"";var e=-1,f=a.length,g,h=[];while(++e<f){g=a[e];if(g.disabled)continue;b=g.media||b,q.test(b)&&h.push(d.getCSS(g.imports,b),g.cssText),b="all"}return h.join("")},d.parseCSS=function(a){var b=[],c;while((c=k.exec(a))!=null)b.push(((j.exec(c[1])?"\n":c[1])+c[2]+c[3]).replace(h,"$1.iepp_$2")+c[4]);return b.join("\n")},d.writeHTML=function(){var a=-1;r=r||b.body;while(++a<g){var c=b.getElementsByTagName(f[a]),d=c.length,e=-1;while(++e<d)c[e].className.indexOf("iepp_")<0&&(c[e].className+=" iepp_"+f[a])}l.appendChild(r),m.appendChild(o),o.className=r.className,o.id=r.id,o.innerHTML=r.innerHTML.replace(i,"<$1font")},d._beforePrint=function(){p.styleSheet.cssText=d.parseCSS(d.getCSS(b.styleSheets,"all")),d.writeHTML()},d.restoreHTML=function(){o.innerHTML="",m.removeChild(o),m.appendChild(r)},d._afterPrint=function(){d.restoreHTML(),p.styleSheet.cssText=""},s(b),s(l);d.disablePP||(n.insertBefore(p,n.firstChild),p.media="print",p.className="iepp-printshim",a.attachEvent("onbeforeprint",d._beforePrint),a.attachEvent("onafterprint",d._afterPrint))}(a,b),e._version=d,e._prefixes=o,e._domPrefixes=p,e.hasEvent=v,e.testProp=function(a){return D([a])},e.testAllProps=E,e.testStyles=u,g.className=g.className.replace(/\bno-js\b/,"")+(f?" js "+t.join(" "):"");return e}(this,this.document),function(a,b,c){function k(a){return!a||a=="loaded"||a=="complete"}function j(){var a=1,b=-1;while(p.length- ++b)if(p[b].s&&!(a=p[b].r))break;a&&g()}function i(a){var c=b.createElement("script"),d;c.src=a.s,c.onreadystatechange=c.onload=function(){!d&&k(c.readyState)&&(d=1,j(),c.onload=c.onreadystatechange=null)},m(function(){d||(d=1,j())},H.errorTimeout),a.e?c.onload():n.parentNode.insertBefore(c,n)}function h(a){var c=b.createElement("link"),d;c.href=a.s,c.rel="stylesheet",c.type="text/css";if(!a.e&&(w||r)){var e=function(a){m(function(){if(!d)try{a.sheet.cssRules.length?(d=1,j()):e(a)}catch(b){b.code==1e3||b.message=="security"||b.message=="denied"?(d=1,m(function(){j()},0)):e(a)}},0)};e(c)}else c.onload=function(){d||(d=1,m(function(){j()},0))},a.e&&c.onload();m(function(){d||(d=1,j())},H.errorTimeout),!a.e&&n.parentNode.insertBefore(c,n)}function g(){var a=p.shift();q=1,a?a.t?m(function(){a.t=="c"?h(a):i(a)},0):(a(),j()):q=0}function f(a,c,d,e,f,h){function i(){!o&&k(l.readyState)&&(r.r=o=1,!q&&j(),l.onload=l.onreadystatechange=null,m(function(){u.removeChild(l)},0))}var l=b.createElement(a),o=0,r={t:d,s:c,e:h};l.src=l.data=c,!s&&(l.style.display="none"),l.width=l.height="0",a!="object"&&(l.type=d),l.onload=l.onreadystatechange=i,a=="img"?l.onerror=i:a=="script"&&(l.onerror=function(){r.e=r.r=1,g()}),p.splice(e,0,r),u.insertBefore(l,s?null:n),m(function(){o||(u.removeChild(l),r.r=r.e=o=1,j())},H.errorTimeout)}function e(a,b,c){var d=b=="c"?z:y;q=0,b=b||"j",C(a)?f(d,a,b,this.i++,l,c):(p.splice(this.i++,0,a),p.length==1&&g());return this}function d(){var a=H;a.loader={load:e,i:0};return a}var l=b.documentElement,m=a.setTimeout,n=b.getElementsByTagName("script")[0],o={}.toString,p=[],q=0,r="MozAppearance"in l.style,s=r&&!!b.createRange().compareNode,t=r&&!s,u=s?l:n.parentNode,v=a.opera&&o.call(a.opera)=="[object Opera]",w="webkitAppearance"in l.style,x=w&&"async"in b.createElement("script"),y=r?"object":v||x?"img":"script",z=w?"img":y,A=Array.isArray||function(a){return o.call(a)=="[object Array]"},B=function(a){return Object(a)===a},C=function(a){return typeof a=="string"},D=function(a){return o.call(a)=="[object Function]"},E=[],F={},G,H;H=function(a){function f(a){var b=a.split("!"),c=E.length,d=b.pop(),e=b.length,f={url:d,origUrl:d,prefixes:b},g,h;for(h=0;h<e;h++)g=F[b[h]],g&&(f=g(f));for(h=0;h<c;h++)f=E[h](f);return f}function e(a,b,e,g,h){var i=f(a),j=i.autoCallback;if(!i.bypass){b&&(b=D(b)?b:b[a]||b[g]||b[a.split("/").pop().split("?")[0]]);if(i.instead)return i.instead(a,b,e,g,h);e.load(i.url,i.forceCSS||!i.forceJS&&/css$/.test(i.url)?"c":c,i.noexec),(D(b)||D(j))&&e.load(function(){d(),b&&b(i.origUrl,h,g),j&&j(i.origUrl,h,g)})}}function b(a,b){function c(a){if(C(a))e(a,h,b,0,d);else if(B(a))for(i in a)a.hasOwnProperty(i)&&e(a[i],h,b,i,d)}var d=!!a.test,f=d?a.yep:a.nope,g=a.load||a.both,h=a.callback,i;c(f),c(g),a.complete&&b.load(a.complete)}var g,h,i=this.yepnope.loader;if(C(a))e(a,0,i,0);else if(A(a))for(g=0;g<a.length;g++)h=a[g],C(h)?e(h,0,i,0):A(h)?H(h):B(h)&&b(h,i);else B(a)&&b(a,i)},H.addPrefix=function(a,b){F[a]=b},H.addFilter=function(a){E.push(a)},H.errorTimeout=1e4,b.readyState==null&&b.addEventListener&&(b.readyState="loading",b.addEventListener("DOMContentLoaded",G=function(){b.removeEventListener("DOMContentLoaded",G,0),b.readyState="complete"},0)),a.yepnope=d()}(this,this.document),Modernizr.load=function(){yepnope.apply(window,[].slice.call(arguments,0))};


// AJAX Functions
var jq = jQuery;

// Global variable to prevent multiple AJAX requests
var bp_ajax_request = null;

jq(document).ready( function() {
	/**** Page Load Actions *******************************************************/

	/* Hide Forums Post Form */
	if ( '-1' == window.location.search.indexOf('new') && jq('div.forums').length )
		jq('div#new-topic-post').hide();
	else
		jq('div#new-topic-post').show();

	/* Activity filter and scope set */
	bp_init_activity();

	/* Object filter and scope set. */
	var objects = [ 'members', 'groups', 'blogs', 'forums' ];
	bp_init_objects( objects );

	/* @mention Compose Scrolling */
	if ( jq.query.get('r') && jq('textarea#whats-new').length ) {
		jq('#whats-new-options').animate({height:'40px'});
		jq("form#whats-new-form textarea").animate({height:'50px'});
		jq.scrollTo( jq('textarea#whats-new'), 500, { offset:-125, easing:'easeOutQuad' } );
		jq('textarea#whats-new').focus();
	}

	/**** Activity Posting ********************************************************/

	/* Textarea focus */
	jq('#whats-new').focus( function(){
		jq("#whats-new-options").animate({height:'40px'});
		jq("form#whats-new-form textarea").animate({height:'50px'});
		jq("#aw-whats-new-submit").prop("disabled", false);
	});

	/* New posts */
	jq("input#aw-whats-new-submit").click( function() {
		var button = jq(this);
		var form = button.parent().parent().parent().parent();

		form.children().each( function() {
			if ( jq.nodeName(this, "textarea") || jq.nodeName(this, "input") )
				jq(this).prop( 'disabled', true );
		});

		/* Remove any errors */
		jq('div.error').remove();
		button.addClass('loading');
		button.prop('disabled', true);

		/* Default POST values */
		var object = '';
		var item_id = jq("#whats-new-post-in").val();
		var content = jq("textarea#whats-new").val();

		/* Set object for non-profile posts */
		if ( item_id > 0 ) {
			object = jq("#whats-new-post-object").val();
		}

		jq.post( ajaxurl, {
			action: 'post_update',
			'cookie': encodeURIComponent(document.cookie),
			'_wpnonce_post_update': jq("input#_wpnonce_post_update").val(),
			'content': content,
			'object': object,
			'item_id': item_id
		},
		function(response) {

			form.children().each( function() {
				if ( jq.nodeName(this, "textarea") || jq.nodeName(this, "input") ) {
					jq(this).prop( 'disabled', false );
				}
			});

			/* Check for errors and append if found. */
			if ( response[0] + response[1] == '-1' ) {
				form.prepend( response.substr( 2, response.length ) );
				jq( 'form#' + form.attr('id') + ' div.error').hide().fadeIn( 200 );
			} else {
				if ( 0 == jq("ul.activity-list").length ) {
					jq("div.error").slideUp(100).remove();
					jq("div#message").slideUp(100).remove();
					jq("div.activity").append( '<ul id="activity-stream" class="activity-list item-list">' );
				}

				jq("ul#activity-stream").prepend(response);
				jq("ul#activity-stream li:first").addClass('new-update');

				if ( 0 != jq("div#latest-update").length ) {
					var l = jq("ul#activity-stream li.new-update .activity-content .activity-inner p").html();
					var v = jq("ul#activity-stream li.new-update .activity-content .activity-header p a.view").attr('href');

					var ltext = jq("ul#activity-stream li.new-update .activity-content .activity-inner p").text();

					var u = '';
					if ( ltext != '' )
						u = '&quot;' + l + '&quot; ';

					u += '<a href="' + v + '" rel="nofollow">' + BP_DTheme.view + '</a>';

					jq("div#latest-update").slideUp(300,function(){
						jq("div#latest-update").html( u );
						jq("div#latest-update").slideDown(300);
					});
				}

				jq("li.new-update").hide().slideDown( 300 );
				jq("li.new-update").removeClass( 'new-update' );
				jq("textarea#whats-new").val('');
			}

			jq("#whats-new-options").animate({height:'0px'});
			jq("form#whats-new-form textarea").animate({height:'20px'});
			jq("#aw-whats-new-submit").prop("disabled", true).removeClass('loading');
		});

		return false;
	});

	/* List tabs event delegation */
	jq('div.activity-type-tabs').click( function(event) {
		var target = jq(event.target).parent();

		if ( event.target.nodeName == 'STRONG' || event.target.nodeName == 'SPAN' )
			target = target.parent();
		else if ( event.target.nodeName != 'A' )
			return false;

		/* Reset the page */
		jq.cookie( 'bp-activity-oldestpage', 1, {path: '/'} );

		/* Activity Stream Tabs */
		var scope = target.attr('id').substr( 9, target.attr('id').length );
		var filter = jq("#activity-filter-select select").val();

		if ( scope == 'mentions' )
			jq( 'li#' + target.attr('id') + ' a strong' ).remove();

		bp_activity_request(scope, filter);

		return false;
	});

	/* Activity filter select */
	jq('#activity-filter-select select').change( function() {
		var selected_tab = jq( 'div.activity-type-tabs li.selected' );

		if ( !selected_tab.length )
			var scope = null;
		else
			var scope = selected_tab.attr('id').substr( 9, selected_tab.attr('id').length );

		var filter = jq(this).val();

		bp_activity_request(scope, filter);

		return false;
	});

	/* Stream event delegation */
	jq('div.activity').click( function(event) {
		var target = jq(event.target);

		/* Favoriting activity stream items */
		if ( target.hasClass('fav') || target.hasClass('unfav') ) {
			var type = target.hasClass('fav') ? 'fav' : 'unfav';
			var parent = target.parent().parent().parent();
			var parent_id = parent.attr('id').substr( 9, parent.attr('id').length );

			target.addClass('loading');

			jq.post( ajaxurl, {
				action: 'activity_mark_' + type,
				'cookie': encodeURIComponent(document.cookie),
				'id': parent_id
			},
			function(response) {
				target.removeClass('loading');

				target.fadeOut( 100, function() {
					jq(this).html(response);
					jq(this).fadeIn(100);
				});

				if ( 'fav' == type ) {
					if ( !jq('div.item-list-tabs li#activity-favorites').length )
						jq('div.item-list-tabs ul li#activity-mentions').before( '<li id="activity-favorites"><a href="#">' + BP_DTheme.my_favs + ' <span>0</span></a></li>');

					target.removeClass('fav');
					target.addClass('unfav');

					jq('div.item-list-tabs ul li#activity-favorites span').html( Number( jq('div.item-list-tabs ul li#activity-favorites span').html() ) + 1 );
				} else {
					target.removeClass('unfav');
					target.addClass('fav');

					jq('div.item-list-tabs ul li#activity-favorites span').html( Number( jq('div.item-list-tabs ul li#activity-favorites span').html() ) - 1 );

					if ( !Number( jq('div.item-list-tabs ul li#activity-favorites span').html() ) ) {
						if ( jq('div.item-list-tabs ul li#activity-favorites').hasClass('selected') )
							bp_activity_request( null, null );

						jq('div.item-list-tabs ul li#activity-favorites').remove();
					}
				}

				if ( 'activity-favorites' == jq( 'div.item-list-tabs li.selected').attr('id') )
					target.parent().parent().parent().slideUp(100);
			});

			return false;
		}

		/* Delete activity stream items */
		if ( target.hasClass('delete-activity') ) {
			var li        = target.parents('div.activity ul li');
			var id        = li.attr('id').substr( 9, li.attr('id').length );
			var link_href = target.attr('href');
			var nonce     = link_href.split('_wpnonce=');

			nonce = nonce[1];

			target.addClass('loading');

			jq.post( ajaxurl, {
				action: 'delete_activity',
				'cookie': encodeURIComponent(document.cookie),
				'id': id,
				'_wpnonce': nonce
			},
			function(response) {

				if ( response[0] + response[1] == '-1' ) {
					li.prepend( response.substr( 2, response.length ) );
					li.children('div#message').hide().fadeIn(300);
				} else {
					li.slideUp(300);
				}
			});

			return false;
		}

		/* Load more updates at the end of the page */
		if ( target.parent().hasClass('load-more') ) {
			jq("#content li.load-more").addClass('loading');

			if ( null == jq.cookie('bp-activity-oldestpage') )
				jq.cookie('bp-activity-oldestpage', 1, {path: '/'} );

			var oldest_page = ( jq.cookie('bp-activity-oldestpage') * 1 ) + 1;

			jq.post( ajaxurl, {
				action: 'activity_get_older_updates',
				'cookie': encodeURIComponent(document.cookie),
				'page': oldest_page
			},
			function(response)
			{
				jq("#content li.load-more").removeClass('loading');
				jq.cookie( 'bp-activity-oldestpage', oldest_page, {path: '/'} );
				jq("#content ul.activity-list").append(response.contents);

				target.parent().hide();
			}, 'json' );

			return false;
		}
	});

	// Activity "Read More" links
	jq('.activity-read-more a').live('click', function(event) {
		var target = jq(event.target);
		var link_id = target.parent().attr('id').split('-');
		var a_id = link_id[3];
		var type = link_id[0]; /* activity or acomment */

		var inner_class = type == 'acomment' ? 'acomment-content' : 'activity-inner';
		var a_inner = jq('li#' + type + '-' + a_id + ' .' + inner_class + ':first' );
		jq(target).addClass('loading');

		jq.post( ajaxurl, {
			action: 'get_single_activity_content',
			'activity_id': a_id
		},
		function(response) {
			jq(a_inner).slideUp(300).html(response).slideDown(300);
		});

		return false;
	});

	/**** Activity Comments *******************************************************/

	/* Hide all activity comment forms */
	jq('form.ac-form').hide();

	/* Hide excess comments */
	if ( jq('div.activity-comments').length )
		bp_dtheme_hide_comments();

	/* Activity list event delegation */
	jq('div.activity').click( function(event) {
		var target = jq(event.target);

		/* Comment / comment reply links */
		if ( target.hasClass('acomment-reply') || target.parent().hasClass('acomment-reply') ) {
			if ( target.parent().hasClass('acomment-reply') )
				target = target.parent();

			var id = target.attr('id');
			ids = id.split('-');

			var a_id = ids[2]
			var c_id = target.attr('href').substr( 10, target.attr('href').length );
			var form = jq( '#ac-form-' + a_id );

			form.css( 'display', 'none' );
			form.removeClass('root');
			jq('.ac-form').hide();

			/* Hide any error messages */
			form.children('div').each( function() {
				if ( jq(this).hasClass( 'error' ) )
					jq(this).hide();
			});

			if ( ids[1] != 'comment' ) {
				jq('div.activity-comments li#acomment-' + c_id).append( form );
			} else {
				jq('li#activity-' + a_id + ' div.activity-comments').append( form );
			}

	 		if ( form.parent().hasClass( 'activity-comments' ) )
				form.addClass('root');

			form.slideDown( 200 );
			jq.scrollTo( form, 500, { offset:-100, easing:'easeOutQuad' } );
			jq('#ac-form-' + ids[2] + ' textarea').focus();

			return false;
		}

		/* Activity comment posting */
		if ( target.attr('name') == 'ac_form_submit' ) {
			var form = target.parent().parent();
			var form_parent = form.parent();
			var form_id = form.attr('id').split('-');

			if ( !form_parent.hasClass('activity-comments') ) {
				var tmp_id = form_parent.attr('id').split('-');
				var comment_id = tmp_id[1];
			} else {
				var comment_id = form_id[2];
			}

			/* Hide any error messages */
			jq( 'form#' + form + ' div.error').hide();
			target.addClass('loading').prop('disabled', true);

			jq.post( ajaxurl, {
				action: 'new_activity_comment',
				'cookie': encodeURIComponent(document.cookie),
				'_wpnonce_new_activity_comment': jq("input#_wpnonce_new_activity_comment").val(),
				'comment_id': comment_id,
				'form_id': form_id[2],
				'content': jq('form#' + form.attr('id') + ' textarea').val()
			},
			function(response)
			{
				target.removeClass('loading');

				/* Check for errors and append if found. */
				if ( response[0] + response[1] == '-1' ) {
					form.append( response.substr( 2, response.length ) ).hide().fadeIn( 200 );
				} else {
					form.fadeOut( 200,
						function() {
							if ( 0 == form.parent().children('ul').length ) {
								if ( form.parent().hasClass('activity-comments') )
									form.parent().prepend('<ul></ul>');
								else
									form.parent().append('<ul></ul>');
							}

							form.parent().children('ul').append(response).hide().fadeIn( 200 );
							form.children('textarea').val('');
							form.parent().parent().addClass('has-comments');
						}
					);
					jq( 'form#' + form + ' textarea').val('');

					/* Increase the "Reply (X)" button count */
					jq('li#activity-' + form_id[2] + ' a.acomment-reply span').html( Number( jq('li#activity-' + form_id[2] + ' a.acomment-reply span').html() ) + 1 );
				}

				jq(target).prop("disabled", false);
			});

			return false;
		}

		/* Deleting an activity comment */
		if ( target.hasClass('acomment-delete') ) {
			var link_href = target.attr('href');
			var comment_li = target.parent().parent();
			var form = comment_li.parents('div.activity-comments').children('form');

			var nonce = link_href.split('_wpnonce=');
				nonce = nonce[1];

			var comment_id = link_href.split('cid=');
				comment_id = comment_id[1].split('&');
				comment_id = comment_id[0];

			target.addClass('loading');

			/* Remove any error messages */
			jq('div.activity-comments ul div.error').remove();

			/* Reset the form position */
			comment_li.parents('div.activity-comments').append(form);

			jq.post( ajaxurl, {
				action: 'delete_activity_comment',
				'cookie': encodeURIComponent(document.cookie),
				'_wpnonce': nonce,
				'id': comment_id
			},
			function(response)
			{
				/* Check for errors and append if found. */
				if ( response[0] + response[1] == '-1' ) {
					comment_li.prepend( response.substr( 2, response.length ) ).hide().fadeIn( 200 );
				} else {
					var children = jq( 'li#' + comment_li.attr('id') + ' ul' ).children('li');
					var child_count = 0;
					jq(children).each( function() {
						if ( !jq(this).is(':hidden') )
							child_count++;
					});
					comment_li.fadeOut(200);

					/* Decrease the "Reply (X)" button count */
					var parent_li = comment_li.parents('ul#activity-stream > li');
					jq('li#' + parent_li.attr('id') + ' a.acomment-reply span').html( jq('li#' + parent_li.attr('id') + ' a.acomment-reply span').html() - ( 1 + child_count ) );
				}
			});

			return false;
		}

		/* Showing hidden comments - pause for half a second */
		if ( target.parent().hasClass('show-all') ) {
			target.parent().addClass('loading');

			setTimeout( function() {
				target.parent().parent().children('li').fadeIn(200, function() {
					target.parent().remove();
				});
			}, 600 );

			return false;
		}
	});

	/* Escape Key Press for cancelling comment forms */
	jq(document).keydown( function(e) {
		e = e || window.event;
		if (e.target)
			element = e.target;
		else if (e.srcElement)
			element = e.srcElement;

		if( element.nodeType == 3)
			element = element.parentNode;

		if( e.ctrlKey == true || e.altKey == true || e.metaKey == true )
			return;

		var keyCode = (e.keyCode) ? e.keyCode : e.which;

		if ( keyCode == 27 ) {
			if (element.tagName == 'TEXTAREA') {
				if ( jq(element).hasClass('ac-input') )
					jq(element).parent().parent().parent().slideUp( 200 );
			}
		}
	});

	/**** Directory Search ****************************************************/

	/* The search form on all directory pages */
	jq('div.dir-search').click( function(event) {
		if ( jq(this).hasClass('no-ajax') )
			return;

		var target = jq(event.target);

		if ( target.attr('type') == 'submit' ) {
			var css_id = jq('div.item-list-tabs li.selected').attr('id').split( '-' );
			var object = css_id[0];

			bp_filter_request( object, jq.cookie('bp-' + object + '-filter'), jq.cookie('bp-' + object + '-scope') , 'div.' + object, target.parent().children('label').children('input').val(), 1, jq.cookie('bp-' + object + '-extras') );

			return false;
		}
	});

	/**** Tabs and Filters ****************************************************/

	/* When a navigation tab is clicked - e.g. | All Groups | My Groups | */
	jq('div.item-list-tabs').click( function(event) {
		if ( jq(this).hasClass('no-ajax') )
			return;

		var target = jq(event.target).parent();

		if ( 'LI' == event.target.parentNode.nodeName && !target.hasClass('last') ) {
			var css_id = target.attr('id').split( '-' );
			var object = css_id[0];

			if ( 'activity' == object )
				return false;

			var scope = css_id[1];
			var filter = jq("#" + object + "-order-select select").val();
			var search_terms = jq("#" + object + "_search").val();

			bp_filter_request( object, filter, scope, 'div.' + object, search_terms, 1, jq.cookie('bp-' + object + '-extras') );

			return false;
		}
	});

	/* When the filter select box is changed re-query */
	jq('li.filter select').change( function() {
		if ( jq('div.item-list-tabs li.selected').length )
			var el = jq('div.item-list-tabs li.selected');
		else
			var el = jq(this);

		var css_id = el.attr('id').split('-');
		var object = css_id[0];
		var scope = css_id[1];
		var filter = jq(this).val();
		var search_terms = false;

		if ( jq('div.dir-search input').length )
			search_terms = jq('div.dir-search input').val();

		if ( 'friends' == object )
			object = 'members';

		bp_filter_request( object, filter, scope, 'div.' + object, search_terms, 1, jq.cookie('bp-' + object + '-extras') );

		return false;
	});

	/* All pagination links run through this function */
	jq('div#content').click( function(event) {
		var target = jq(event.target);

		if ( target.hasClass('button') )
			return true;

		if ( target.parent().parent().hasClass('pagination') && !target.parent().parent().hasClass('no-ajax') ) {
			if ( target.hasClass('dots') || target.hasClass('current') )
				return false;

			if ( jq('div.item-list-tabs li.selected').length )
				var el = jq('div.item-list-tabs li.selected');
			else
				var el = jq('li.filter select');

			var page_number = 1;
			var css_id = el.attr('id').split( '-' );
			var object = css_id[0];
			var search_terms = false;

			if ( jq('div.dir-search input').length )
				search_terms = jq('div.dir-search input').val();

			if ( jq(target).hasClass('next') )
				var page_number = Number( jq('div.pagination span.current').html() ) + 1;
			else if ( jq(target).hasClass('prev') )
				var page_number = Number( jq('div.pagination span.current').html() ) - 1;
			else
				var page_number = Number( jq(target).html() );

			bp_filter_request( object, jq.cookie('bp-' + object + '-filter'), jq.cookie('bp-' + object + '-scope'), 'div.' + object, search_terms, page_number, jq.cookie('bp-' + object + '-extras') );

			return false;
		}

	});

	/**** New Forum Directory Post **************************************/

	/* Hit the "New Topic" button on the forums directory page */
	jq('a.show-hide-new').click( function() {
		if ( !jq('div#new-topic-post').length )
			return false;

		if ( jq('div#new-topic-post').is(":visible") )
			jq('div#new-topic-post').slideUp(200);
		else
			jq('div#new-topic-post').slideDown(200, function() { jq('#topic_title').focus(); } );

		return false;
	});

	/* Cancel the posting of a new forum topic */
	jq('input#submit_topic_cancel').click( function() {
		if ( !jq('div#new-topic-post').length )
			return false;

		jq('div#new-topic-post').slideUp(200);
		return false;
	});

	/* Clicking a forum tag */
	jq('div#forum-directory-tags a').click( function() {
		bp_filter_request( 'forums', 'tags', jq.cookie('bp-forums-scope'), 'div.forums', jq(this).html().replace( /&nbsp;/g, '-' ), 1, jq.cookie('bp-forums-extras') );
		return false;
	});

	/** Invite Friends Interface ****************************************/

	/* Select a user from the list of friends and add them to the invite list */
	jq("div#invite-list input").click( function() {
		jq('.ajax-loader').toggle();

		var friend_id = jq(this).val();

		if ( jq(this).prop('checked') == true )
			var friend_action = 'invite';
		else
			var friend_action = 'uninvite';

		jq('div.item-list-tabs li.selected').addClass('loading');

		jq.post( ajaxurl, {
			action: 'groups_invite_user',
			'friend_action': friend_action,
			'cookie': encodeURIComponent(document.cookie),
			'_wpnonce': jq("input#_wpnonce_invite_uninvite_user").val(),
			'friend_id': friend_id,
			'group_id': jq("input#group_id").val()
		},
		function(response)
		{
			if ( jq("#message") )
				jq("#message").hide();

			jq('.ajax-loader').toggle();

			if ( friend_action == 'invite' ) {
				jq('#friend-list').append(response);
			} else if ( friend_action == 'uninvite' ) {
				jq('#friend-list li#uid-' + friend_id).remove();
			}

			jq('div.item-list-tabs li.selected').removeClass('loading');
		});
	});

	/* Remove a user from the list of users to invite to a group */
	jq("#friend-list li a.remove").live('click', function() {
		jq('.ajax-loader').toggle();

		var friend_id = jq(this).attr('id');
		friend_id = friend_id.split('-');
		friend_id = friend_id[1];

		jq.post( ajaxurl, {
			action: 'groups_invite_user',
			'friend_action': 'uninvite',
			'cookie': encodeURIComponent(document.cookie),
			'_wpnonce': jq("input#_wpnonce_invite_uninvite_user").val(),
			'friend_id': friend_id,
			'group_id': jq("input#group_id").val()
		},
		function(response)
		{
			jq('.ajax-loader').toggle();
			jq('#friend-list li#uid-' + friend_id).remove();
			jq('#invite-list input#f-' + friend_id).prop('checked', false);
		});

		return false;
	});

	/** Friendship Requests **************************************/

	/* Accept and Reject friendship request buttons */
	jq("ul#friend-list a.accept, ul#friend-list a.reject").click( function() {
		var button = jq(this);
		var li = jq(this).parents('ul#friend-list li');
		var action_div = jq(this).parents('li div.action');

		var id = li.attr('id').substr( 11, li.attr('id').length );
		var link_href = button.attr('href');

		var nonce = link_href.split('_wpnonce=');
			nonce = nonce[1];

		if ( jq(this).hasClass('accepted') || jq(this).hasClass('rejected') )
			return false;

		if ( jq(this).hasClass('accept') ) {
			var action = 'accept_friendship';
			action_div.children('a.reject').css( 'visibility', 'hidden' );
		} else {
			var action = 'reject_friendship';
			action_div.children('a.accept').css( 'visibility', 'hidden' );
		}

		button.addClass('loading');

		jq.post( ajaxurl, {
			action: action,
			'cookie': encodeURIComponent(document.cookie),
			'id': id,
			'_wpnonce': nonce
		},
		function(response) {
			button.removeClass('loading');

			if ( response[0] + response[1] == '-1' ) {
				li.prepend( response.substr( 2, response.length ) );
				li.children('div#message').hide().fadeIn(200);
			} else {
				button.fadeOut( 100, function() {
					if ( jq(this).hasClass('accept') ) {
						action_div.children('a.reject').hide();
						jq(this).html( BP_DTheme.accepted ).fadeIn(50);
						jq(this).addClass('accepted');
					} else {
						action_div.children('a.accept').hide();
						jq(this).html( BP_DTheme.rejected ).fadeIn(50);
						jq(this).addClass('rejected');
					}
				});
			}
		});

		return false;
	});

	/* Add / Remove friendship buttons */
	jq("div.friendship-button a").live('click', function() {
		jq(this).parent().addClass('loading');
		var fid = jq(this).attr('id');
		fid = fid.split('-');
		fid = fid[1];

		var nonce = jq(this).attr('href');
		nonce = nonce.split('?_wpnonce=');
		nonce = nonce[1].split('&');
		nonce = nonce[0];

		var thelink = jq(this);

		jq.post( ajaxurl, {
			action: 'addremove_friend',
			'cookie': encodeURIComponent(document.cookie),
			'fid': fid,
			'_wpnonce': nonce
		},
		function(response)
		{
			var action = thelink.attr('rel');
			var parentdiv = thelink.parent();

			if ( action == 'add' ) {
				jq(parentdiv).fadeOut(200,
					function() {
						parentdiv.removeClass('add_friend');
						parentdiv.removeClass('loading');
						parentdiv.addClass('pending');
						parentdiv.fadeIn(200).html(response);
					}
				);

			} else if ( action == 'remove' ) {
				jq(parentdiv).fadeOut(200,
					function() {
						parentdiv.removeClass('remove_friend');
						parentdiv.removeClass('loading');
						parentdiv.addClass('add');
						parentdiv.fadeIn(200).html(response);
					}
				);
			}
		});
		return false;
	} );

	/** Group Join / Leave Buttons **************************************/

	jq("div.group-button a").live('click', function() {
		var gid = jq(this).parent().attr('id');
		gid = gid.split('-');
		gid = gid[1];

		var nonce = jq(this).attr('href');
		nonce = nonce.split('?_wpnonce=');
		nonce = nonce[1].split('&');
		nonce = nonce[0];

		var thelink = jq(this);

		jq.post( ajaxurl, {
			action: 'joinleave_group',
			'cookie': encodeURIComponent(document.cookie),
			'gid': gid,
			'_wpnonce': nonce
		},
		function(response)
		{
			var parentdiv = thelink.parent();

			if ( !jq('body.directory').length )
				location.href = location.href;
			else {
				jq(parentdiv).fadeOut(200,
					function() {
						parentdiv.fadeIn(200).html(response);
					}
				);
			}
		});
		return false;
	} );

	/** Button disabling ************************************************/

	jq('div.pending').click(function() {
		return false;
	});

	/** Private Messaging ******************************************/

	/* AJAX send reply functionality */
	jq("input#send_reply_button").click(
		function() {
			var order = jq('#messages_order').val() || 'ASC',
				offset = jq('#message-recipients').offset();

			var button = jq("input#send_reply_button");
			jq(button).addClass('loading');

			jq.post( ajaxurl, {
				action: 'messages_send_reply',
				'cookie': encodeURIComponent(document.cookie),
				'_wpnonce': jq("input#send_message_nonce").val(),

				'content': jq("#message_content").val(),
				'send_to': jq("input#send_to").val(),
				'subject': jq("input#subject").val(),
				'thread_id': jq("input#thread_id").val()
			},
			function(response)
			{
				if ( response[0] + response[1] == "-1" ) {
					jq('form#send-reply').prepend( response.substr( 2, response.length ) );
				} else {
					jq('form#send-reply div#message').remove();
					jq("#message_content").val('');

					if ( 'ASC' == order ) {
						jq('form#send-reply').before( response );
					} else {
						jq('#message-recipients').after( response );
						jq(window).scrollTop(offset.top);
					}

					jq("div.new-message").hide().slideDown( 200, function() {
						jq('div.new-message').removeClass('new-message');
					});
				}
				jq(button).removeClass('loading');
			});

			return false;
		}
	);

	/* Marking private messages as read and unread */
	jq("a#mark_as_read, a#mark_as_unread").click(function() {
		var checkboxes_tosend = '';
		var checkboxes = jq("#message-threads tr td input[type='checkbox']");

		if ( 'mark_as_unread' == jq(this).attr('id') ) {
			var currentClass = 'read'
			var newClass = 'unread'
			var unreadCount = 1;
			var inboxCount = 0;
			var unreadCountDisplay = 'inline';
			var action = 'messages_markunread';
		} else {
			var currentClass = 'unread'
			var newClass = 'read'
			var unreadCount = 0;
			var inboxCount = 1;
			var unreadCountDisplay = 'none';
			var action = 'messages_markread';
		}

		checkboxes.each( function(i) {
			if(jq(this).is(':checked')) {
				if ( jq('tr#m-' + jq(this).attr('value')).hasClass(currentClass) ) {
					checkboxes_tosend += jq(this).attr('value');
					jq('tr#m-' + jq(this).attr('value')).removeClass(currentClass);
					jq('tr#m-' + jq(this).attr('value')).addClass(newClass);
					var thread_count = jq('tr#m-' + jq(this).attr('value') + ' td span.unread-count').html();

					jq('tr#m-' + jq(this).attr('value') + ' td span.unread-count').html(unreadCount);
					jq('tr#m-' + jq(this).attr('value') + ' td span.unread-count').css('display', unreadCountDisplay);

					var inboxcount = jq('tr.unread').length;

					jq('a#user-messages span').html( inboxcount );

					if ( i != checkboxes.length - 1 ) {
						checkboxes_tosend += ','
					}
				}
			}
		});
		jq.post( ajaxurl, {
			action: action,
			'thread_ids': checkboxes_tosend
		});
		return false;
	});

	/* Selecting unread and read messages in inbox */
	jq("select#message-type-select").change(
		function() {
			var selection = jq("select#message-type-select").val();
			var checkboxes = jq("td input[type='checkbox']");
			checkboxes.each( function(i) {
				checkboxes[i].checked = "";
			});

			switch(selection) {
				case 'unread':
					var checkboxes = jq("tr.unread td input[type='checkbox']");
				break;
				case 'read':
					var checkboxes = jq("tr.read td input[type='checkbox']");
				break;
			}
			if ( selection != '' ) {
				checkboxes.each( function(i) {
					checkboxes[i].checked = "checked";
				});
			} else {
				checkboxes.each( function(i) {
					checkboxes[i].checked = "";
				});
			}
		}
	);

	/* Bulk delete messages */
	jq("a#delete_inbox_messages, a#delete_sentbox_messages").click( function() {
		checkboxes_tosend = '';
		checkboxes = jq("#message-threads tr td input[type='checkbox']");

		jq('div#message').remove();
		jq(this).addClass('loading');

		jq(checkboxes).each( function(i) {
			if( jq(this).is(':checked') )
				checkboxes_tosend += jq(this).attr('value') + ',';
		});

		if ( '' == checkboxes_tosend ) {
			jq(this).removeClass('loading');
			return false;
		}

		jq.post( ajaxurl, {
			action: 'messages_delete',
			'thread_ids': checkboxes_tosend
		}, function(response) {
			if ( response[0] + response[1] == "-1" ) {
				jq('#message-threads').prepend( response.substr( 2, response.length ) );
			} else {
				jq('#message-threads').before( '<div id="message" class="updated"><p>' + response + '</p></div>' );

				jq(checkboxes).each( function(i) {
					if( jq(this).is(':checked') )
						jq(this).parent().parent().fadeOut(150);
				});
			}

			jq('div#message').hide().slideDown(150);
			jq("a#delete_inbox_messages, a#delete_sentbox_messages").removeClass('loading');
		});
		return false;
	});

	/* Close site wide notices in the sidebar */
	jq("a#close-notice").click( function() {
		jq(this).addClass('loading');
		jq('div#sidebar div.error').remove();

		jq.post( ajaxurl, {
			action: 'messages_close_notice',
			'notice_id': jq('.notice').attr('rel').substr( 2, jq('.notice').attr('rel').length )
		},
		function(response) {
			jq("a#close-notice").removeClass('loading');

			if ( response[0] + response[1] == '-1' ) {
				jq('.notice').prepend( response.substr( 2, response.length ) );
				jq( 'div#sidebar div.error').hide().fadeIn( 200 );
			} else {
				jq('.notice').slideUp( 100 );
			}
		});
		return false;
	});

	/* Admin Bar & wp_list_pages Javascript IE6 hover class */
	jq("#wp-admin-bar ul.main-nav li, #nav li").mouseover( function() {
		jq(this).addClass('sfhover');
	});

	jq("#wp-admin-bar ul.main-nav li, #nav li").mouseout( function() {
		jq(this).removeClass('sfhover');
	});

	/* Clear BP cookies on logout */
	jq('a.logout').click( function() {
		jq.cookie('bp-activity-scope', null, {path: '/'});
		jq.cookie('bp-activity-filter', null, {path: '/'});
		jq.cookie('bp-activity-oldestpage', null, {path: '/'});

		var objects = [ 'members', 'groups', 'blogs', 'forums' ];
		jq(objects).each( function(i) {
			jq.cookie('bp-' + objects[i] + '-scope', null, {path: '/'} );
			jq.cookie('bp-' + objects[i] + '-filter', null, {path: '/'} );
			jq.cookie('bp-' + objects[i] + '-extras', null, {path: '/'} );
		});
	});
});

/* Setup activity scope and filter based on the current cookie settings. */
function bp_init_activity() {
	/* Reset the page */
	jq.cookie( 'bp-activity-oldestpage', 1, {path: '/'} );

	if ( null != jq.cookie('bp-activity-filter') && jq('#activity-filter-select').length )
		jq('#activity-filter-select select option[value="' + jq.cookie('bp-activity-filter') + '"]').prop( 'selected', true );

	/* Activity Tab Set */
	if ( null != jq.cookie('bp-activity-scope') && jq('div.activity-type-tabs').length ) {
		jq('div.activity-type-tabs li').each( function() {
			jq(this).removeClass('selected');
		});
		jq('li#activity-' + jq.cookie('bp-activity-scope') + ', div.item-list-tabs li.current').addClass('selected');
	}
}

/* Setup object scope and filter based on the current cookie settings for the object. */
function bp_init_objects(objects) {
	jq(objects).each( function(i) {
		if ( null != jq.cookie('bp-' + objects[i] + '-filter') && jq('li#' + objects[i] + '-order-select select').length )
			jq('li#' + objects[i] + '-order-select select option[value="' + jq.cookie('bp-' + objects[i] + '-filter') + '"]').prop( 'selected', true );

		if ( null != jq.cookie('bp-' + objects[i] + '-scope') && jq('div.' + objects[i]).length ) {
			jq('div.item-list-tabs li').each( function() {
				jq(this).removeClass('selected');
			});
			jq('div.item-list-tabs li#' + objects[i] + '-' + jq.cookie('bp-' + objects[i] + '-scope') + ', div.item-list-tabs#object-nav li.current').addClass('selected');
		}
	});
}

/* Filter the current content list (groups/members/blogs/topics) */
function bp_filter_request( object, filter, scope, target, search_terms, page, extras ) {
	if ( 'activity' == object )
		return false;

	if ( jq.query.get('s') && !search_terms )
		search_terms = jq.query.get('s');

	if ( null == scope )
		scope = 'all';

	/* Save the settings we want to remain persistent to a cookie */
	jq.cookie( 'bp-' + object + '-scope', scope, {path: '/'} );
	jq.cookie( 'bp-' + object + '-filter', filter, {path: '/'} );
	jq.cookie( 'bp-' + object + '-extras', extras, {path: '/'} );

	/* Set the correct selected nav and filter */
	jq('div.item-list-tabs li').each( function() {
		jq(this).removeClass('selected');
	});
	jq('div.item-list-tabs li#' + object + '-' + scope + ', div.item-list-tabs#object-nav li.current').addClass('selected');
	jq('div.item-list-tabs li.selected').addClass('loading');
	jq('div.item-list-tabs select option[value="' + filter + '"]').prop( 'selected', true );

	if ( 'friends' == object )
		object = 'members';

	if ( bp_ajax_request )
		bp_ajax_request.abort();

	bp_ajax_request = jq.post( ajaxurl, {
		action: object + '_filter',
		'cookie': encodeURIComponent(document.cookie),
		'object': object,
		'filter': filter,
		'search_terms': search_terms,
		'scope': scope,
		'page': page,
		'extras': extras
	},
	function(response)
	{
		jq(target).fadeOut( 100, function() {
			jq(this).html(response);
			jq(this).fadeIn(100);
	 	});
		jq('div.item-list-tabs li.selected').removeClass('loading');
	});
}

/* Activity Loop Requesting */
function bp_activity_request(scope, filter) {
	/* Save the type and filter to a session cookie */
	jq.cookie( 'bp-activity-scope', scope, {path: '/'} );
	jq.cookie( 'bp-activity-filter', filter, {path: '/'} );
	jq.cookie( 'bp-activity-oldestpage', 1, {path: '/'} );

	/* Remove selected and loading classes from tabs */
	jq('div.item-list-tabs li').each( function() {
		jq(this).removeClass('selected loading');
	});
	/* Set the correct selected nav and filter */
	jq('li#activity-' + scope + ', div.item-list-tabs li.current').addClass('selected');
	jq('div#object-nav.item-list-tabs li.selected, div.activity-type-tabs li.selected').addClass('loading');
	jq('#activity-filter-select select option[value="' + filter + '"]').prop( 'selected', true );

	/* Reload the activity stream based on the selection */
	jq('.widget_bp_activity_widget h2 span.ajax-loader').show();

	if ( bp_ajax_request )
		bp_ajax_request.abort();

	bp_ajax_request = jq.post( ajaxurl, {
		action: 'activity_widget_filter',
		'cookie': encodeURIComponent(document.cookie),
		'_wpnonce_activity_filter': jq("input#_wpnonce_activity_filter").val(),
		'scope': scope,
		'filter': filter
	},
	function(response)
	{
		jq('.widget_bp_activity_widget h2 span.ajax-loader').hide();

		jq('div.activity').fadeOut( 100, function() {
			jq(this).html(response.contents);
			jq(this).fadeIn(100);

			/* Selectively hide comments */
			bp_dtheme_hide_comments();
		});

		/* Update the feed link */
		if ( null != response.feed_url )
			jq('.directory div#subnav li.feed a, .home-page div#subnav li.feed a').attr('href', response.feed_url);

		jq('div.item-list-tabs li.selected').removeClass('loading');

	}, 'json' );
}

/* Hide long lists of activity comments, only show the latest five root comments. */
function bp_dtheme_hide_comments() {
	var comments_divs = jq('div.activity-comments');

	if ( !comments_divs.length )
		return false;

	comments_divs.each( function() {
		if ( jq(this).children('ul').children('li').length < 5 ) return;

		var comments_div = jq(this);
		var parent_li = comments_div.parents('ul#activity-stream > li');
		var comment_lis = jq(this).children('ul').children('li');
		var comment_count = ' ';

		if ( jq('li#' + parent_li.attr('id') + ' a.acomment-reply span').length )
			var comment_count = jq('li#' + parent_li.attr('id') + ' a.acomment-reply span').html();

		comment_lis.each( function(i) {
			/* Show the latest 5 root comments */
			if ( i < comment_lis.length - 5 ) {
				jq(this).addClass('hidden');
				jq(this).toggle();

				if ( !i )
					jq(this).before( '<li class="show-all"><a href="#' + parent_li.attr('id') + '/show-all/" title="' + BP_DTheme.show_all_comments + '">' + BP_DTheme.show_all + ' ' + comment_count + ' ' + BP_DTheme.comments + '</a></li>' );
			}
		});

	});
}

/* Helper Functions */

function checkAll() {
	var checkboxes = document.getElementsByTagName("input");
	for(var i=0; i<checkboxes.length; i++) {
		if(checkboxes[i].type == "checkbox") {
			if($("check_all").checked == "") {
				checkboxes[i].checked = "";
			}
			else {
				checkboxes[i].checked = "checked";
			}
		}
	}
}

function clear(container) {
	if( !document.getElementById(container) ) return;

	var container = document.getElementById(container);

	if ( radioButtons = container.getElementsByTagName('INPUT') ) {
		for(var i=0; i<radioButtons.length; i++) {
			radioButtons[i].checked = '';
		}
	}

	if ( options = container.getElementsByTagName('OPTION') ) {
		for(var i=0; i<options.length; i++) {
			options[i].selected = false;
		}
	}

	return;
}

/* ScrollTo plugin - just inline and minified */
;(function(d){var k=d.scrollTo=function(a,i,e){d(window).scrollTo(a,i,e)};k.defaults={axis:'xy',duration:parseFloat(d.fn.jquery)>=1.3?0:1};k.window=function(a){return d(window)._scrollable()};d.fn._scrollable=function(){return this.map(function(){var a=this,i=!a.nodeName||d.inArray(a.nodeName.toLowerCase(),['iframe','#document','html','body'])!=-1;if(!i)return a;var e=(a.contentWindow||a).document||a.ownerDocument||a;return d.browser.safari||e.compatMode=='BackCompat'?e.body:e.documentElement})};d.fn.scrollTo=function(n,j,b){if(typeof j=='object'){b=j;j=0}if(typeof b=='function')b={onAfter:b};if(n=='max')n=9e9;b=d.extend({},k.defaults,b);j=j||b.speed||b.duration;b.queue=b.queue&&b.axis.length>1;if(b.queue)j/=2;b.offset=p(b.offset);b.over=p(b.over);return this._scrollable().each(function(){var q=this,r=d(q),f=n,s,g={},u=r.is('html,body');switch(typeof f){case'number':case'string':if(/^([+-]=)?\d+(\.\d+)?(px|%)?$/.test(f)){f=p(f);break}f=d(f,this);case'object':if(f.is||f.style)s=(f=d(f)).offset()}d.each(b.axis.split(''),function(a,i){var e=i=='x'?'Left':'Top',h=e.toLowerCase(),c='scroll'+e,l=q[c],m=k.max(q,i);if(s){g[c]=s[h]+(u?0:l-r.offset()[h]);if(b.margin){g[c]-=parseInt(f.css('margin'+e))||0;g[c]-=parseInt(f.css('border'+e+'Width'))||0}g[c]+=b.offset[h]||0;if(b.over[h])g[c]+=f[i=='x'?'width':'height']()*b.over[h]}else{var o=f[h];g[c]=o.slice&&o.slice(-1)=='%'?parseFloat(o)/100*m:o}if(/^\d+$/.test(g[c]))g[c]=g[c]<=0?0:Math.min(g[c],m);if(!a&&b.queue){if(l!=g[c])t(b.onAfterFirst);delete g[c]}});t(b.onAfter);function t(a){r.animate(g,j,b.easing,a&&function(){a.call(this,n,b)})}}).end()};k.max=function(a,i){var e=i=='x'?'Width':'Height',h='scroll'+e;if(!d(a).is('html,body'))return a[h]-d(a)[e.toLowerCase()]();var c='client'+e,l=a.ownerDocument.documentElement,m=a.ownerDocument.body;return Math.max(l[h],m[h])-Math.min(l[c],m[c])};function p(a){return typeof a=='object'?a:{top:a,left:a}}})(jQuery);

/* jQuery Easing Plugin, v1.3 - http://gsgd.co.uk/sandbox/jquery/easing/ */
jQuery.easing.jswing=jQuery.easing.swing;jQuery.extend(jQuery.easing,{def:"easeOutQuad",swing:function(e,f,a,h,g){return jQuery.easing[jQuery.easing.def](e,f,a,h,g)},easeInQuad:function(e,f,a,h,g){return h*(f/=g)*f+a},easeOutQuad:function(e,f,a,h,g){return -h*(f/=g)*(f-2)+a},easeInOutQuad:function(e,f,a,h,g){if((f/=g/2)<1){return h/2*f*f+a}return -h/2*((--f)*(f-2)-1)+a},easeInCubic:function(e,f,a,h,g){return h*(f/=g)*f*f+a},easeOutCubic:function(e,f,a,h,g){return h*((f=f/g-1)*f*f+1)+a},easeInOutCubic:function(e,f,a,h,g){if((f/=g/2)<1){return h/2*f*f*f+a}return h/2*((f-=2)*f*f+2)+a},easeInQuart:function(e,f,a,h,g){return h*(f/=g)*f*f*f+a},easeOutQuart:function(e,f,a,h,g){return -h*((f=f/g-1)*f*f*f-1)+a},easeInOutQuart:function(e,f,a,h,g){if((f/=g/2)<1){return h/2*f*f*f*f+a}return -h/2*((f-=2)*f*f*f-2)+a},easeInQuint:function(e,f,a,h,g){return h*(f/=g)*f*f*f*f+a},easeOutQuint:function(e,f,a,h,g){return h*((f=f/g-1)*f*f*f*f+1)+a},easeInOutQuint:function(e,f,a,h,g){if((f/=g/2)<1){return h/2*f*f*f*f*f+a}return h/2*((f-=2)*f*f*f*f+2)+a},easeInSine:function(e,f,a,h,g){return -h*Math.cos(f/g*(Math.PI/2))+h+a},easeOutSine:function(e,f,a,h,g){return h*Math.sin(f/g*(Math.PI/2))+a},easeInOutSine:function(e,f,a,h,g){return -h/2*(Math.cos(Math.PI*f/g)-1)+a},easeInExpo:function(e,f,a,h,g){return(f==0)?a:h*Math.pow(2,10*(f/g-1))+a},easeOutExpo:function(e,f,a,h,g){return(f==g)?a+h:h*(-Math.pow(2,-10*f/g)+1)+a},easeInOutExpo:function(e,f,a,h,g){if(f==0){return a}if(f==g){return a+h}if((f/=g/2)<1){return h/2*Math.pow(2,10*(f-1))+a}return h/2*(-Math.pow(2,-10*--f)+2)+a},easeInCirc:function(e,f,a,h,g){return -h*(Math.sqrt(1-(f/=g)*f)-1)+a},easeOutCirc:function(e,f,a,h,g){return h*Math.sqrt(1-(f=f/g-1)*f)+a},easeInOutCirc:function(e,f,a,h,g){if((f/=g/2)<1){return -h/2*(Math.sqrt(1-f*f)-1)+a}return h/2*(Math.sqrt(1-(f-=2)*f)+1)+a},easeInElastic:function(f,h,e,l,k){var i=1.70158;var j=0;var g=l;if(h==0){return e}if((h/=k)==1){return e+l}if(!j){j=k*0.3}if(g<Math.abs(l)){g=l;var i=j/4}else{var i=j/(2*Math.PI)*Math.asin(l/g)}return -(g*Math.pow(2,10*(h-=1))*Math.sin((h*k-i)*(2*Math.PI)/j))+e},easeOutElastic:function(f,h,e,l,k){var i=1.70158;var j=0;var g=l;if(h==0){return e}if((h/=k)==1){return e+l}if(!j){j=k*0.3}if(g<Math.abs(l)){g=l;var i=j/4}else{var i=j/(2*Math.PI)*Math.asin(l/g)}return g*Math.pow(2,-10*h)*Math.sin((h*k-i)*(2*Math.PI)/j)+l+e},easeInOutElastic:function(f,h,e,l,k){var i=1.70158;var j=0;var g=l;if(h==0){return e}if((h/=k/2)==2){return e+l}if(!j){j=k*(0.3*1.5)}if(g<Math.abs(l)){g=l;var i=j/4}else{var i=j/(2*Math.PI)*Math.asin(l/g)}if(h<1){return -0.5*(g*Math.pow(2,10*(h-=1))*Math.sin((h*k-i)*(2*Math.PI)/j))+e}return g*Math.pow(2,-10*(h-=1))*Math.sin((h*k-i)*(2*Math.PI)/j)*0.5+l+e},easeInBack:function(e,f,a,i,h,g){if(g==undefined){g=1.70158}return i*(f/=h)*f*((g+1)*f-g)+a},easeOutBack:function(e,f,a,i,h,g){if(g==undefined){g=1.70158}return i*((f=f/h-1)*f*((g+1)*f+g)+1)+a},easeInOutBack:function(e,f,a,i,h,g){if(g==undefined){g=1.70158}if((f/=h/2)<1){return i/2*(f*f*(((g*=(1.525))+1)*f-g))+a}return i/2*((f-=2)*f*(((g*=(1.525))+1)*f+g)+2)+a},easeInBounce:function(e,f,a,h,g){return h-jQuery.easing.easeOutBounce(e,g-f,0,h,g)+a},easeOutBounce:function(e,f,a,h,g){if((f/=g)<(1/2.75)){return h*(7.5625*f*f)+a}else{if(f<(2/2.75)){return h*(7.5625*(f-=(1.5/2.75))*f+0.75)+a}else{if(f<(2.5/2.75)){return h*(7.5625*(f-=(2.25/2.75))*f+0.9375)+a}else{return h*(7.5625*(f-=(2.625/2.75))*f+0.984375)+a}}}},easeInOutBounce:function(e,f,a,h,g){if(f<g/2){return jQuery.easing.easeInBounce(e,f*2,0,h,g)*0.5+a}return jQuery.easing.easeOutBounce(e,f*2-g,0,h,g)*0.5+h*0.5+a}});

/* jQuery Cookie plugin */
jQuery.cookie=function(name,value,options){if(typeof value!='undefined'){options=options||{};if(value===null){value='';options.expires=-1;}var expires='';if(options.expires&&(typeof options.expires=='number'||options.expires.toUTCString)){var date;if(typeof options.expires=='number'){date=new Date();date.setTime(date.getTime()+(options.expires*24*60*60*1000));}else{date=options.expires;}expires='; expires='+date.toUTCString();}var path=options.path?'; path='+(options.path):'';var domain=options.domain?'; domain='+(options.domain):'';var secure=options.secure?'; secure':'';document.cookie=[name,'=',encodeURIComponent(value),expires,path,domain,secure].join('');}else{var cookieValue=null;if(document.cookie&&document.cookie!=''){var cookies=document.cookie.split(';');for(var i=0;i<cookies.length;i++){var cookie=jQuery.trim(cookies[i]);if(cookie.substring(0,name.length+1)==(name+'=')){cookieValue=decodeURIComponent(cookie.substring(name.length+1));break;}}}return cookieValue;}};

/* jQuery querystring plugin */
eval(function(p,a,c,k,e,d){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--){d[e(c)]=k[c]||e(c)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('M 6(A){4 $11=A.11||\'&\';4 $V=A.V===r?r:j;4 $1p=A.1p===r?\'\':\'[]\';4 $13=A.13===r?r:j;4 $D=$13?A.D===j?"#":"?":"";4 $15=A.15===r?r:j;v.1o=M 6(){4 f=6(o,t){8 o!=1v&&o!==x&&(!!t?o.1t==t:j)};4 14=6(1m){4 m,1l=/\\[([^[]*)\\]/g,T=/^([^[]+)(\\[.*\\])?$/.1r(1m),k=T[1],e=[];19(m=1l.1r(T[2]))e.u(m[1]);8[k,e]};4 w=6(3,e,7){4 o,y=e.1b();b(I 3!=\'X\')3=x;b(y===""){b(!3)3=[];b(f(3,L)){3.u(e.h==0?7:w(x,e.z(0),7))}n b(f(3,1a)){4 i=0;19(3[i++]!=x);3[--i]=e.h==0?7:w(3[i],e.z(0),7)}n{3=[];3.u(e.h==0?7:w(x,e.z(0),7))}}n b(y&&y.T(/^\\s*[0-9]+\\s*$/)){4 H=1c(y,10);b(!3)3=[];3[H]=e.h==0?7:w(3[H],e.z(0),7)}n b(y){4 H=y.B(/^\\s*|\\s*$/g,"");b(!3)3={};b(f(3,L)){4 18={};1w(4 i=0;i<3.h;++i){18[i]=3[i]}3=18}3[H]=e.h==0?7:w(3[H],e.z(0),7)}n{8 7}8 3};4 C=6(a){4 p=d;p.l={};b(a.C){v.J(a.Z(),6(5,c){p.O(5,c)})}n{v.J(1u,6(){4 q=""+d;q=q.B(/^[?#]/,\'\');q=q.B(/[;&]$/,\'\');b($V)q=q.B(/[+]/g,\' \');v.J(q.Y(/[&;]/),6(){4 5=1e(d.Y(\'=\')[0]||"");4 c=1e(d.Y(\'=\')[1]||"");b(!5)8;b($15){b(/^[+-]?[0-9]+\\.[0-9]*$/.1d(c))c=1A(c);n b(/^[+-]?[0-9]+$/.1d(c))c=1c(c,10)}c=(!c&&c!==0)?j:c;b(c!==r&&c!==j&&I c!=\'1g\')c=c;p.O(5,c)})})}8 p};C.1H={C:j,1G:6(5,1f){4 7=d.Z(5);8 f(7,1f)},1h:6(5){b(!f(5))8 d.l;4 K=14(5),k=K[0],e=K[1];4 3=d.l[k];19(3!=x&&e.h!=0){3=3[e.1b()]}8 I 3==\'1g\'?3:3||""},Z:6(5){4 3=d.1h(5);b(f(3,1a))8 v.1E(j,{},3);n b(f(3,L))8 3.z(0);8 3},O:6(5,c){4 7=!f(c)?x:c;4 K=14(5),k=K[0],e=K[1];4 3=d.l[k];d.l[k]=w(3,e.z(0),7);8 d},w:6(5,c){8 d.N().O(5,c)},1s:6(5){8 d.O(5,x).17()},1z:6(5){8 d.N().1s(5)},1j:6(){4 p=d;v.J(p.l,6(5,7){1y p.l[5]});8 p},1F:6(Q){4 D=Q.B(/^.*?[#](.+?)(?:\\?.+)?$/,"$1");4 S=Q.B(/^.*?[?](.+?)(?:#.+)?$/,"$1");8 M C(Q.h==S.h?\'\':S,Q.h==D.h?\'\':D)},1x:6(){8 d.N().1j()},N:6(){8 M C(d)},17:6(){6 F(G){4 R=I G=="X"?f(G,L)?[]:{}:G;b(I G==\'X\'){6 1k(o,5,7){b(f(o,L))o.u(7);n o[5]=7}v.J(G,6(5,7){b(!f(7))8 j;1k(R,5,F(7))})}8 R}d.l=F(d.l);8 d},1B:6(){8 d.N().17()},1D:6(){4 i=0,U=[],W=[],p=d;4 16=6(E){E=E+"";b($V)E=E.B(/ /g,"+");8 1C(E)};4 1n=6(1i,5,7){b(!f(7)||7===r)8;4 o=[16(5)];b(7!==j){o.u("=");o.u(16(7))}1i.u(o.P(""))};4 F=6(R,k){4 12=6(5){8!k||k==""?[5].P(""):[k,"[",5,"]"].P("")};v.J(R,6(5,7){b(I 7==\'X\')F(7,12(5));n 1n(W,12(5),7)})};F(d.l);b(W.h>0)U.u($D);U.u(W.P($11));8 U.P("")}};8 M C(1q.S,1q.D)}}(v.1o||{});',62,106,'|||target|var|key|function|value|return|||if|val|this|tokens|is||length||true|base|keys||else||self||false|||push|jQuery|set|null|token|slice|settings|replace|queryObject|hash|str|build|orig|index|typeof|each|parsed|Array|new|copy|SET|join|url|obj|search|match|queryString|spaces|chunks|object|split|get||separator|newKey|prefix|parse|numbers|encode|COMPACT|temp|while|Object|shift|parseInt|test|decodeURIComponent|type|number|GET|arr|EMPTY|add|rx|path|addFields|query|suffix|location|exec|REMOVE|constructor|arguments|undefined|for|empty|delete|remove|parseFloat|compact|encodeURIComponent|toString|extend|load|has|prototype'.split('|'),0,{}))


/*	SWFObject v2.2 <http://code.google.com/p/swfobject/> 
	is released under the MIT License <http://www.opensource.org/licenses/mit-license.php> 
*/
var audioplayer_swfobject=function(){var d="undefined",R="object",s="Shockwave Flash",w="ShockwaveFlash.ShockwaveFlash",Q="application/x-shockwave-flash",r="SWFObjectExprInst",X="onreadystatechange",o=window,J=document,T=navigator,t=false,u=[H],O=[],n=[],i=[],L,q,e,b,j=false,A=false,N,g,M=true,m=function(){var AA=typeof J.getElementById!=d&&typeof J.getElementsByTagName!=d&&typeof J.createElement!=d,AH=T.userAgent.toLowerCase(),y=T.platform.toLowerCase(),AE=y?/win/.test(y):/win/.test(AH),AC=y?/mac/.test(y):/mac/.test(AH),AF=/webkit/.test(AH)?parseFloat(AH.replace(/^.*webkit\/(\d+(\.\d+)?).*$/,"$1")):false,x=!+"\v1",AG=[0,0,0],AB=null;if(typeof T.plugins!=d&&typeof T.plugins[s]==R){AB=T.plugins[s].description;if(AB&&!(typeof T.mimeTypes!=d&&T.mimeTypes[Q]&&!T.mimeTypes[Q].enabledPlugin)){t=true;x=false;AB=AB.replace(/^.*\s+(\S+\s+\S+$)/,"$1");AG[0]=parseInt(AB.replace(/^(.*)\..*$/,"$1"),10);AG[1]=parseInt(AB.replace(/^.*\.(.*)\s.*$/,"$1"),10);AG[2]=/[a-zA-Z]/.test(AB)?parseInt(AB.replace(/^.*[a-zA-Z]+(.*)$/,"$1"),10):0}}else{if(typeof o.ActiveXObject!=d){try{var AD=new ActiveXObject(w);if(AD){AB=AD.GetVariable("$version");if(AB){x=true;AB=AB.split(" ")[1].split(",");AG=[parseInt(AB[0],10),parseInt(AB[1],10),parseInt(AB[2],10)]}}}catch(z){}}}return{w3:AA,pv:AG,wk:AF,ie:x,win:AE,mac:AC}}(),K=function(){if(!m.w3){return }if((typeof J.readyState!=d&&J.readyState=="complete")||(typeof J.readyState==d&&(J.getElementsByTagName("body")[0]||J.body))){F()}if(!j){if(typeof J.addEventListener!=d){J.addEventListener("DOMContentLoaded",F,false)}if(m.ie&&m.win){J.attachEvent(X,function(){if(J.readyState=="complete"){J.detachEvent(X,arguments.callee);F()}});if(o==top){(function(){if(j){return }try{J.documentElement.doScroll("left")}catch(x){setTimeout(arguments.callee,0);return }F()})()}}if(m.wk){(function(){if(j){return }if(!/loaded|complete/.test(J.readyState)){setTimeout(arguments.callee,0);return }F()})()}S(F)}}();function F(){if(j){return }try{var z=J.getElementsByTagName("body")[0].appendChild(c("span"));z.parentNode.removeChild(z)}catch(AA){return }j=true;var x=u.length;for(var y=0;y<x;y++){u[y]()}}function k(x){if(j){x()}else{u[u.length]=x}}function S(y){if(typeof o.addEventListener!=d){o.addEventListener("load",y,false)}else{if(typeof J.addEventListener!=d){J.addEventListener("load",y,false)}else{if(typeof o.attachEvent!=d){I(o,"onload",y)}else{if(typeof o.onload=="function"){var x=o.onload;o.onload=function(){x();y()}}else{o.onload=y}}}}}function H(){if(t){v()}else{h()}}function v(){var x=J.getElementsByTagName("body")[0];var AA=c(R);AA.setAttribute("type",Q);var z=x.appendChild(AA);if(z){var y=0;(function(){if(typeof z.GetVariable!=d){var AB=z.GetVariable("$version");if(AB){AB=AB.split(" ")[1].split(",");m.pv=[parseInt(AB[0],10),parseInt(AB[1],10),parseInt(AB[2],10)]}}else{if(y<10){y++;setTimeout(arguments.callee,10);return }}x.removeChild(AA);z=null;h()})()}else{h()}}function h(){var AG=O.length;if(AG>0){for(var AF=0;AF<AG;AF++){var y=O[AF].id;var AB=O[AF].callbackFn;var AA={success:false,id:y};if(m.pv[0]>0){var AE=C(y);if(AE){if(f(O[AF].swfVersion)&&!(m.wk&&m.wk<312)){W(y,true);if(AB){AA.success=true;AA.ref=Z(y);AB(AA)}}else{if(O[AF].expressInstall&&a()){var AI={};AI.data=O[AF].expressInstall;AI.width=AE.getAttribute("width")||"0";AI.height=AE.getAttribute("height")||"0";if(AE.getAttribute("class")){AI.styleclass=AE.getAttribute("class")}if(AE.getAttribute("align")){AI.align=AE.getAttribute("align")}var AH={};var x=AE.getElementsByTagName("param");var AC=x.length;for(var AD=0;AD<AC;AD++){if(x[AD].getAttribute("name").toLowerCase()!="movie"){AH[x[AD].getAttribute("name")]=x[AD].getAttribute("value")}}p(AI,AH,y,AB)}else{P(AE);if(AB){AB(AA)}}}}}else{W(y,true);if(AB){var z=Z(y);if(z&&typeof z.SetVariable!=d){AA.success=true;AA.ref=z}AB(AA)}}}}}function Z(AA){var x=null;var y=C(AA);if(y&&y.nodeName=="OBJECT"){if(typeof y.SetVariable!=d){x=y}else{var z=y.getElementsByTagName(R)[0];if(z){x=z}}}return x}function a(){return !A&&f("6.0.65")&&(m.win||m.mac)&&!(m.wk&&m.wk<312)}function p(AA,AB,x,z){A=true;e=z||null;b={success:false,id:x};var AE=C(x);if(AE){if(AE.nodeName=="OBJECT"){L=G(AE);q=null}else{L=AE;q=x}AA.id=r;if(typeof AA.width==d||(!/%$/.test(AA.width)&&parseInt(AA.width,10)<310)){AA.width="310"}if(typeof AA.height==d||(!/%$/.test(AA.height)&&parseInt(AA.height,10)<137)){AA.height="137"}J.title=J.title.slice(0,47)+" - Flash Player Installation";var AD=m.ie&&m.win?"ActiveX":"PlugIn",AC="MMredirectURL="+o.location.toString().replace(/&/g,"%26")+"&MMplayerType="+AD+"&MMdoctitle="+J.title;if(typeof AB.flashvars!=d){AB.flashvars+="&"+AC}else{AB.flashvars=AC}if(m.ie&&m.win&&AE.readyState!=4){var y=c("div");x+="SWFObjectNew";y.setAttribute("id",x);AE.parentNode.insertBefore(y,AE);AE.style.display="none";(function(){if(AE.readyState==4){AE.parentNode.removeChild(AE)}else{setTimeout(arguments.callee,10)}})()}U(AA,AB,x)}}function P(y){if(m.ie&&m.win&&y.readyState!=4){var x=c("div");y.parentNode.insertBefore(x,y);x.parentNode.replaceChild(G(y),x);y.style.display="none";(function(){if(y.readyState==4){y.parentNode.removeChild(y)}else{setTimeout(arguments.callee,10)}})()}else{y.parentNode.replaceChild(G(y),y)}}function G(AB){var AA=c("div");if(m.win&&m.ie){AA.innerHTML=AB.innerHTML}else{var y=AB.getElementsByTagName(R)[0];if(y){var AC=y.childNodes;if(AC){var x=AC.length;for(var z=0;z<x;z++){if(!(AC[z].nodeType==1&&AC[z].nodeName=="PARAM")&&!(AC[z].nodeType==8)){AA.appendChild(AC[z].cloneNode(true))}}}}}return AA}function U(AI,AG,y){var x,AA=C(y);if(m.wk&&m.wk<312){return x}if(AA){if(typeof AI.id==d){AI.id=y}if(m.ie&&m.win){var AH="";for(var AE in AI){if(AI[AE]!=Object.prototype[AE]){if(AE.toLowerCase()=="data"){AG.movie=AI[AE]}else{if(AE.toLowerCase()=="styleclass"){AH+=' class="'+AI[AE]+'"'}else{if(AE.toLowerCase()!="classid"){AH+=" "+AE+'="'+AI[AE]+'"'}}}}}var AF="";for(var AD in AG){if(AG[AD]!=Object.prototype[AD]){AF+='<param name="'+AD+'" value="'+AG[AD]+'" />'}}AA.outerHTML='<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"'+AH+">"+AF+"</object>";n[n.length]=AI.id;x=C(AI.id)}else{var z=c(R);z.setAttribute("type",Q);for(var AC in AI){if(AI[AC]!=Object.prototype[AC]){if(AC.toLowerCase()=="styleclass"){z.setAttribute("class",AI[AC])}else{if(AC.toLowerCase()!="classid"){z.setAttribute(AC,AI[AC])}}}}for(var AB in AG){if(AG[AB]!=Object.prototype[AB]&&AB.toLowerCase()!="movie"){E(z,AB,AG[AB])}}AA.parentNode.replaceChild(z,AA);x=z}}return x}function E(z,x,y){var AA=c("param");AA.setAttribute("name",x);AA.setAttribute("value",y);z.appendChild(AA)}function Y(y){var x=C(y);if(x&&x.nodeName=="OBJECT"){if(m.ie&&m.win){x.style.display="none";(function(){if(x.readyState==4){B(y)}else{setTimeout(arguments.callee,10)}})()}else{x.parentNode.removeChild(x)}}}function B(z){var y=C(z);if(y){for(var x in y){if(typeof y[x]=="function"){y[x]=null}}y.parentNode.removeChild(y)}}function C(z){var x=null;try{x=J.getElementById(z)}catch(y){}return x}function c(x){return J.createElement(x)}function I(z,x,y){z.attachEvent(x,y);i[i.length]=[z,x,y]}function f(z){var y=m.pv,x=z.split(".");x[0]=parseInt(x[0],10);x[1]=parseInt(x[1],10)||0;x[2]=parseInt(x[2],10)||0;return(y[0]>x[0]||(y[0]==x[0]&&y[1]>x[1])||(y[0]==x[0]&&y[1]==x[1]&&y[2]>=x[2]))?true:false}function V(AC,y,AD,AB){if(m.ie&&m.mac){return }var AA=J.getElementsByTagName("head")[0];if(!AA){return }var x=(AD&&typeof AD=="string")?AD:"screen";if(AB){N=null;g=null}if(!N||g!=x){var z=c("style");z.setAttribute("type","text/css");z.setAttribute("media",x);N=AA.appendChild(z);if(m.ie&&m.win&&typeof J.styleSheets!=d&&J.styleSheets.length>0){N=J.styleSheets[J.styleSheets.length-1]}g=x}if(m.ie&&m.win){if(N&&typeof N.addRule==R){N.addRule(AC,y)}}else{if(N&&typeof J.createTextNode!=d){N.appendChild(J.createTextNode(AC+" {"+y+"}"))}}}function W(z,x){if(!M){return }var y=x?"visible":"hidden";if(j&&C(z)){C(z).style.visibility=y}else{V("#"+z,"visibility:"+y)}}function l(y){var z=/[\\\"<>\.;]/;var x=z.exec(y)!=null;return x&&typeof encodeURIComponent!=d?encodeURIComponent(y):y}var D=function(){if(m.ie&&m.win){window.attachEvent("onunload",function(){var AC=i.length;for(var AB=0;AB<AC;AB++){i[AB][0].detachEvent(i[AB][1],i[AB][2])}var z=n.length;for(var AA=0;AA<z;AA++){Y(n[AA])}for(var y in m){m[y]=null}m=null;for(var x in audioplayer_swfobject){audioplayer_swfobject[x]=null}audioplayer_swfobject=null})}}();return{registerObject:function(AB,x,AA,z){if(m.w3&&AB&&x){var y={};y.id=AB;y.swfVersion=x;y.expressInstall=AA;y.callbackFn=z;O[O.length]=y;W(AB,false)}else{if(z){z({success:false,id:AB})}}},getObjectById:function(x){if(m.w3){return Z(x)}},embedSWF:function(AB,AH,AE,AG,y,AA,z,AD,AF,AC){var x={success:false,id:AH};if(m.w3&&!(m.wk&&m.wk<312)&&AB&&AH&&AE&&AG&&y){W(AH,false);k(function(){AE+="";AG+="";var AJ={};if(AF&&typeof AF===R){for(var AL in AF){AJ[AL]=AF[AL]}}AJ.data=AB;AJ.width=AE;AJ.height=AG;var AM={};if(AD&&typeof AD===R){for(var AK in AD){AM[AK]=AD[AK]}}if(z&&typeof z===R){for(var AI in z){if(typeof AM.flashvars!=d){AM.flashvars+="&"+AI+"="+z[AI]}else{AM.flashvars=AI+"="+z[AI]}}}if(f(y)){var AN=U(AJ,AM,AH);if(AJ.id==AH){W(AH,true)}x.success=true;x.ref=AN}else{if(AA&&a()){AJ.data=AA;p(AJ,AM,AH,AC);return }else{W(AH,true)}}if(AC){AC(x)}})}else{if(AC){AC(x)}}},switchOffAutoHideShow:function(){M=false},ua:m,getFlashPlayerVersion:function(){return{major:m.pv[0],minor:m.pv[1],release:m.pv[2]}},hasFlashPlayerVersion:f,createSWF:function(z,y,x){if(m.w3){return U(z,y,x)}else{return undefined}},showExpressInstall:function(z,AA,x,y){if(m.w3&&a()){p(z,AA,x,y)}},removeSWF:function(x){if(m.w3){Y(x)}},createCSS:function(AA,z,y,x){if(m.w3){V(AA,z,y,x)}},addDomLoadEvent:k,addLoadEvent:S,getQueryParamValue:function(AA){var z=J.location.search||J.location.hash;if(z){if(/\?/.test(z)){z=z.split("?")[1]}if(AA==null){return l(z)}var y=z.split("&");for(var x=0;x<y.length;x++){if(y[x].substring(0,y[x].indexOf("="))==AA){return l(y[x].substring((y[x].indexOf("=")+1)))}}}return""},expressInstallCallback:function(){if(A){var x=C(r);if(x&&L){x.parentNode.replaceChild(L,x);if(q){W(q,true);if(m.ie&&m.win){L.style.display="block"}}if(e){e(b)}}A=false}}}}();var AudioPlayer=function(){var H=[];var D;var F="";var A={};var E=-1;var G="9";function B(I){if(document.all&&!window[I]){for(var J=0;J<document.forms.length;J++){if(document.forms[J][I]){return document.forms[J][I];break}}}return document.all?window[I]:document[I]}function C(I,J,K){B(I).addListener(J,K)}return{setup:function(J,I){F=J;A=I;if(audioplayer_swfobject.hasFlashPlayerVersion(G)){audioplayer_swfobject.switchOffAutoHideShow();audioplayer_swfobject.createCSS("p.audioplayer_container span","visibility:hidden;height:24px;overflow:hidden;padding:0;border:none;")}},getPlayer:function(I){return B(I)},addListener:function(I,J,K){C(I,J,K)},embed:function(I,K){var N={};var L;var J={};var O={};var M={};for(L in A){N[L]=A[L]}for(L in K){N[L]=K[L]}if(N.transparentpagebg=="yes"){J.bgcolor="#FFFFFF";J.wmode="transparent"}else{if(N.pagebg){J.bgcolor="#"+N.pagebg}J.wmode="opaque"}J.menu="false";for(L in N){if(L=="pagebg"||L=="width"||L=="transparentpagebg"){continue}O[L]=N[L]}M.name=I;M.style="outline: none";O.playerID=I;audioplayer_swfobject.embedSWF(F,I,N.width.toString(),"24",G,false,O,J,M);H.push(I)},syncVolumes:function(I,K){E=K;for(var J=0;J<H.length;J++){if(H[J]!=I){B(H[J]).setVolume(E)}}},activate:function(I,J){if(D&&D!=I){B(D).close()}D=I},load:function(K,I,L,J){B(K).load(I,L,J)},close:function(I){B(I).close();if(I==D){D=null}},open:function(I,J){if(J==undefined){J=1}B(I).open(J==undefined?0:J-1)},getVolume:function(I){return E}}}();

/*
  Emphasis
  by Michael Donohoe (@donohoe)
  https://github.com/NYTimes/Emphasis
  http://open.blogs.nytimes.com/2011/01/10/emphasis-update-and-source/
  
  jQueryized by Rob Flaherty (@ravelrumba)
  https://github.com/robflaherty/Emphasis
      
  Adapted for WordPres by Benjamin J. Balter (@BenBalter)
  http://wordpress.org/extend/plugins/wp-emphasis/
*/
jQuery(function(h){var k={init:function(){this.config();this.vu=this.s=this.h=this.p=this.pl=!1;this.kh="|";this.addCSS();this.readHash();h(document).bind("keydown",this.keydown)},config:function(){this.paraSelctors=h(".entry p:not(:empty), .post p:not(:empty), .page p:not(:empty), article p:not(:empty)");this.classReady="emReady";this.classActive="emActive";this.classHighlight="emHighlight";this.classInfo="emInfo";this.classAnchor="emAnchor";this.classActiveAnchor="emActiveAnchor"},addCSS:function(){var a=document.createElement("style");
a.setAttribute("type","text/css");var b="p."+this.classActive+" span { background-color:#f2f4f5; } p span."+this.classHighlight+" { background-color:#fff0b3; } span."+this.classInfo+" { position:absolute; margin:-1px 0px 0px -8px; padding:0; font-size:10px; background-color: transparent !important} span."+this.classInfo+" a { text-decoration: none; } a."+this.classActiveAnchor+" { color: #000; font-size: 11px; }";try{a.innerHTML=b}catch(c){a.styleSheet.cssText=b}document.getElementsByTagName("head")[0].appendChild(a)},
readHash:function(){var a=decodeURI(location.hash),b=!1,c=[],e={},d,f,g;if(0>a.indexOf("[")&&0>a.indexOf("]")){if(f=/[ph][0-9]+|s[0-9,]+|[0-9]/g,a)for(;null!==(d=f.exec(a));)if(g=d[0].substring(0,1),d=d[0].substring(1),"p"===g)b=parseInt(d,10);else if("h"===g)c.push(parseInt(d,10));else{d=d.split(",");for(g=0;g<d.length;g++)d[g]=parseInt(d[g],10);e[c[c.length-1]]=d}}else if(b=a.match(/p\[([^[\]]*)\]/),g=a.match(/h\[([^[\]]*)\]/),b=b&&0<b.length?b[1]:!1,a=g&&0<g.length?g[1]:!1){a=a.match(/[a-zA-Z]+(,[0-9]+)*/g);
for(g=0;g<a.length;g++)if(d=a[g].split(","),f=d[0],f=this.findKey(f).index,void 0!==f){c.push(parseInt(f,10)+1);d.shift();if(0<d.length)for(f=1;f<d.length;f++)d[f]=parseInt(d[f],10);e[c[c.length-1]]=d}}this.p=b;this.h=c;this.s=e;this.goAnchor(b);this.goHighlight(c,e)},keydown:function(a){var b=k;b.kh=b.kh+a.keyCode+"|";if(-1<b.kh.indexOf("|16|16|"))b.vu=b.vu?!1:!0,b.paragraphInfo(b.vu);setTimeout(function(){b.kh="|"},500)},paragraphList:function(){if(this.pl&&0<this.pl.list.length)return this.pl;
var a=this,b=[],c=[],e=0,d=this.paraSelctors.length,f,g,i;for(f=0;f<d;f++)if(g=this.paraSelctors[f],0<(g.innerText||g.textContent||"").length)i=a.createKey(g),b.push(g),c.push(i),g.setAttribute("data-key",i),g.setAttribute("data-num",e),h(g).bind("click",function(b){a.paragraphClick(b)}),e++;return this.pl={list:b,keys:c}},paragraphClick:function(a){if(this.vu){var b=!1,c="P"===a.currentTarget.nodeName?a.currentTarget:!1,e=h(c),d="SPAN"===a.target.nodeName?a.target:!1,f="A"===a.target.nodeName?a.target:
!1;f&&!h(f).hasClass(this.classActiveAnchor)&&(this.updateAnchor(f),b=!0,a.preventDefault());if(!c&&!d)this.removeClass(this.classActive);else{if(e.hasClass(this.classReady))!e.hasClass(this.classActive)&&d&&!h(d).hasClass(this.classHighlight)?(h(this).removeClass(this.classActive),e.addClass(this.classActive)):(e.hasClass(this.classActive)||(h(this).removeClass(this.classActive),e.addClass(this.classActive)),d&&(h(d).toggleClass(this.classHighlight),b=!0));else{b=this.getSentences(c);a=b.length;
for(d=0;d<a;d++)b[d]="<span data-num='"+(d+1)+"'>"+this.rtrim(b[d])+"</span>";b=b.join(". ").replace(/__DOT__/g,".").replace(/<\/span>\./g,".</span>");d=b.substring(b.length-8).charCodeAt(0);-1==="|8221|63|46|41|39|37|34|33|".indexOf(d)&&(b+=".");c.innerHTML=b;c.setAttribute("data-sentences",a);h(this).removeClass(this.classActive);e.addClass(this.classActive);e.addClass(this.classReady);b=!0}b&&this.updateURLHash()}}},paragraphInfo:function(a){var b,c,e,d,f;if(a){if(a=h("span."+this.classInfo),0===
a.length){b=this.paragraphList();a=b.list.length;for(c=0;c<a;c++)if(e=b.list[c]||!1)d=b.keys[c],f=d===this.p?" "+this.classActiveAnchor:"",e.innerHTML="<span class='"+this.classInfo+"'><a class='"+this.classAnchor+f+"' href='#p["+d+"]' data-key='"+d+"' title='Link to "+this.ordinal(c+1)+" paragraph'>&para;</a></span>"+e.innerHTML}}else{b=h("span."+this.classInfo);a=b.length;for(c=0;c<a;c++)h(b[c]).remove();h(this).removeClass(this.classActive)}},updateAnchor:function(a){this.p=a.getAttribute("data-key");
h(this).removeClass(this.classActiveAnchor);h(a).addClass(this.classActiveAnchor)},updateURLHash:function(){var a="h[",b=h("p.emReady"),c=b.length,e,d,f,g,i;for(e=0;e<c;e++)if(d=b[e].getAttribute("data-key"),h(b[e]).hasClass(this.classHighlight))a+=","+d;else if(f=h("span."+this.classHighlight,b[e]),g=f.length,i=b[e].getAttribute("data-sentences"),0<g&&(a+=","+d),i!==g)for(d=0;d<g;d++)a+=","+f[d].getAttribute("data-num");a=((this.p?"p["+this.p+"],":"")+(a.replace("h[,","h[")+"]")).replace(",h[]",
"");location.hash=a},createKey:function(a){var b="",a=(a.innerText||a.textContent||"").replace(/[^a-z\. ]+/gi,""),c,e;if(a&&1<a.length&&(c=this.getSentences(a),0<c.length)){a=this.cleanArray(c[0].replace(/[\s\s]+/gi," ").split(" ")).slice(0,3);c=this.cleanArray(c[c.length-1].replace(/[\s\s]+/gi," ").split(" ")).slice(0,3);a=a.concat(c);c=6<a.length?6:a.length;for(e=0;e<c;e++)b+=a[e].substring(0,1)}return b},findKey:function(a){var b=this.paragraphList(),c=b.keys.length,e=!1,d=!1,f,g,h;for(f=0;f<c;f++){if(a===
b.keys[f])return{index:f,elm:b.list[f]};e||(g=this.lev(a.slice(0,3),b.keys[f].slice(0,3)),h=this.lev(a.slice(-3),b.keys[f].slice(-3)),3>g+h&&(e=f,d=b.list[f]))}return{index:e,elm:d}},goAnchor:function(a){if(a){var b=isNaN(a)?this.findKey(a).elm:this.paragraphList().list[a-1]||!1;b&&setTimeout(function(){h(window).scrollTop(h(b).offset().top)},500)}},goHighlight:function(a,b){if(a){var c=a.length,e,d,f,g,i,l,j,m,k;for(e=0;e<c;e++)if(d=this.paragraphList().list[a[e]-1]||!1){f=b[a[e].toString()]||!1;
g=!f||0===f.length;i=this.getSentences(d);l=i.length;for(j=0;j<l;j++)i[j]="<span data-num='"+(j+1)+"'>"+i[j]+"</span>";for(j=0;j<l;j++)m=g?j:f[j]-1,(k=i[m]||!1)&&(i[m]=i[m].replace("<span","<span class='"+this.classHighlight+"'"));d.setAttribute("data-sentences",l);d.innerHTML=i.join(". ").replace(/__DOT__/g,".").replace(/<\/span>\./g,".</span>");h(d).addClass("emReady")}}},getSentences:function(a){var a="string"===typeof a?a:a.innerHTML,b="A,B,C,D,E,F,G,H,I,J,K,L,M,m,N,O,P,Q,R,S,T,U,V,W,X,Y,Z,etc,oz,cf,viz,sc,ca,Ave,St,Calif,Mass,Penn,AK,AL,AR,AS,AZ,CA,CO,CT,DC,DE,FL,FM,GA,GU,HI,IA,ID,IL,IN,KS,KY,LA,MA,MD,ME,MH,MI,MN,MO,MP,MS,MT,NC,ND,NE,NH,NJ,NM,NV,NY,OH,OK,OR,PA,PR,PW,RI,SC,SD,TN,TX,UT,VA,VI,VT,WA,WI,WV,WY,AE,AA,AP,NYC,GB,IRL,IE,UK,GB,FR,0,1,2,3,4,5,6,7,8,9,www".split(","),
c=b.length,e;for(e=0;e<c;e++)a=a.replace(RegExp(" "+b[e]+"\\.","g")," "+b[e]+"__DOT__");b="Mr,Ms,Mrs,Miss,Msr,Dr,Gov,Pres,Sen,Prof,Gen,Rep,St,Messrs,Col,Sr,Jf,Ph,Sgt,Mgr,Fr,Rev,No,Jr,Snr,0,1,2,3,4,5,6,7,8,9".split(",");c=b.length;for(e=0;e<c;e++)a=a.replace(RegExp(b[e]+"\\.","g"),b[e]+"__DOT__");b="aero,asia,biz,cat,com,coop,edu,gov,info,int,jobs,mil,mobi,museum,name,net,org,pro,tel,travel,xxx".split(",");c=b.length;for(e=0;e<c;e++)a=a.replace(RegExp("\\."+b[e],"g"),"__DOT__"+b[e]);return this.cleanArray(a.split(". "))},
ordinal:function(a){var b=["th","st","nd","rd"],c=a%100;return a+(b[(c-20)%10]||b[c]||b[0])},lev:function(a,b){var c=a.length,e=b.length,d=[],f,g;d[0]=[];c<e&&(f=a,a=b,b=f,f=c,c=e,e=f);for(f=0;f<e+1;f++)d[0][f]=f;for(f=1;f<c+1;f++){d[f]=[];d[f][0]=f;for(g=1;g<e+1;g++)d[f][g]=this.smallest(d[f-1][g]+1,d[f][g-1]+1,d[f-1][g-1]+(a.charAt(f-1)===b.charAt(g-1)?0:1))}return d[c][e]},smallest:function(a,b,c){return a<b&&a<c?a:b<a&&b<c?b:c},rtrim:function(a){return a.replace(/\s+$/,"")},cleanArray:function(a){var b=
[],c;for(c=0;c<a.length;c++)a[c]&&0<a[c].replace(/ /g,"").length&&b.push(a[c]);return b}};h(window).bind("load",function(){k.init()})});

