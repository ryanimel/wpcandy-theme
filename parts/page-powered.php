<?php
/**
 * WordPress Template: Page
 * 
 * The page template is the general template used when a singular 'page'
 * post type is queried.
 * 
 * This template can be overriden if the page is set to use a custom page 
 * template or if WordPress can match that page's slug or id with a 
 * page-{slug}.php or page-{id}.php file in the parent/child theme's directory.
 *
 * Template Hierarchy
 * - custom template
 * - page-{slug}.php
 * - page-{id}.php
 * - page.php
 * - index.php
 *
 * @package WP Framework
 * @subpackage Template
 */

get_template_part( 'header' ); ?>

				<div id="content" class="column-8">

					<?php do_action( 'content_open' ); ?>

					<?php // get_template_part( 'loop', 'page' ); ?>

					<?php do_action( 'content_close' ); ?>

				</div><!-- #content -->
				
				<aside id="power-methods">
				
					<h3 id="power-methods-header">Love WPCandy? Right this way.</h3>
					<p class="subhead">You too can support WPCandy to make all of this possible. Whether you have a little to give or a lot, every bit helps!</p>
					<img src="<?php bloginfo('stylesheet_directory'); ?>/library/images/wpcandy-power-methods.png" />
					
					<div class="first option">
						<div class="option-wrap">
							<h4>Send a Bowl of Mints</h4>
							<p>For sending in a Bowl of Mints, or $50, you will be:</p>
							<ul>
								<li>Thanked on the weekly podcast and blog.</li>
								<li>Credited in a post on the blog.</li>
								<li>Clothed in a WPCandy shirt of your very own.</li>
							</ul>
						</div><!-- .option-wrap -->
						<p><a class="button" title="Send a Bowl of Mints to WPCandy for $50" href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=LQW2RJDBEEPNN">Send $50</a></p>
					</div>
					
					<div class="second option">
						<div class="option-wrap">
						
							<h4>Send a Wheelbarrow</h4>
							<p>Love the <a href="http://wpcandy.com/category/podcasts" title="The WPCandy Podcast">WPCandy Podcast</a> or <a href="http://wpcandy.com/category/the-daily-plugin" title="The Daily Plugin">The Daily Plugin</a>? This one&rsquo;s for you. For $250 you will be:</p>
							<ul>
								<li>Credited as producer of a podcast or a week of The Daily Plugin (7 episodes!).</li>
								<li>Everything from a Bowl of Mints.</li>
							</ul>
						</div><!-- .option-wrap -->
						<p><a class="button" title="Send a Wheelbarrow of Mints to WPCandy for $250" href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=N3BJEAF4QARUW">Send $250</a></p>
					</div>
					
					<div class="third option">
						<div class="option-wrap">
							<h4>Send a Truck of Mints</h4>
							<p>If you really, <em>seriously</em> love WPCandy, you can send a Truck of Mints for $2500. If you do, you will be:</p>
							<ul>
								<li>Thanked site-wide for a month.</li>
								<li>Enjoy a truck of our gratitude.</li>
								<li>Everything from a Bowl and Wheelbarrow of Mints.</li>
							</ul>
						</div><!-- .option-wrap -->
						<p><a class="button" title="Send a Truck of Mints to WPCandy for $2,500" href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=7RFN4Q64LJYW2">Send $2,500</a></p>
					</div>

					<div class="last fourth option">
						<div class="option-wrap">
							<h4>Contribute to the Factory</h4>
							<p>For subscribing to keep the WPCandy Factory running, you will be:</p>
							<ul>
								<li>Thanked on the blog.</li>
								<li>Enjoying the knowledge of making WPCandy possible.</li>
								<li>Awesome. Just straight up awesome, forever.</li>
							</ul>
						</div><!-- .option-wrap -->
						<p><a class="button" title="Subscribe at $5/month" href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&amp;hosted_button_id=3F3ZL9KN72NTU">$5/month</a> <a class="button" title="Subscribe at $10/month" href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&amp;hosted_button_id=HX7CMDTJFH53G" style="clear: none;">or $10</a> <a style="clear: none;" class="button" title="Subscribe at $20/month" href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&amp;hosted_button_id=REJW8TPU5CQSS">or $20</a></p>
					</div>
					
					<p class="clear">Don&rsquo;t like these options? You can send in <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=7SLJLZSARS6WL" title="Send in any amount you wish">any amount you wish</a>.</p>
					
					<div id="power-social-proof">
						<h3>All the cool kids power WPCandy. Do you?</h3>
					</div><!-- #power-social-proof -->
					
					<div id="power-map">
						<h3>Currently Powering WPCandy</h3>
						<iframe width="500" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps/ms?ie=UTF8&amp;hl=en&amp;t=h&amp;msa=0&amp;msid=209722576694966576389.00049aa0c0eb16efc31a3&amp;ll=23.241346,9.84375&amp;spn=140.183592,26.71875&amp;z=1&amp;output=embed"></iframe>
						<p>Don't see yourself on the map? Get in touch, we&rsquo;ll get you added!</p>
					</div>
					
					<div id="power-explained">
					
						<blockquote class="jump">
							<p><span>&ldquo;</span>We have chosen not to be supported via traditional advertising. Instead, we have adopted a truly community-driven donation model. Without the community, this site wouldn&rsquo;t be here.</p>
							<p>And I wouldn't have it any other way.</p>
							<p><cite>Ryan Imel<br />Editor-in-Chief, WPCandy</cite></p>
						</blockquote>
					
					</div><!-- #power-explained -->
					
					<p class="clear"><em>All of the money sent to WPCandy goes directly to powering the site and making it possible for the team (and eventually others) to spend a serious amount of time on WPCandy and growing it. See our most recent <a href="http://wpcandy.com/announces/wpcandy-in-review-thru-april-2011">stats and traffic post</a> for information success that WPCandy has seen so far this year.</em></p>
					<p><em>All payments are handled through Paypal, and the charge will show up as from GooRoo, LLC.</em></p>
				
				</aside><!-- #power-methods -->

<?php get_template_part( 'footer' ); ?>