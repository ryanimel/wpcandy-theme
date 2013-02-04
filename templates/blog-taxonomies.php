<div class="content-cats">
	<ul>
		<?php if ( has_post_format( 'image' ) || has_post_format( 'gallery' ) ) { ?>
		<li class="photos">Photos</li>	
		<?php } ?>
		<?php if(in_category('reports')) { ?>
		<li class="news"><a href="<?php bloginfo('url'); ?>/category/reports/" title="More WPCandy WordPress news">News</a></li>	
		<?php } elseif(in_category('announces')) { ?>
		<li class="announcements"><a href="<?php bloginfo('url'); ?>/category/announces/" title="More WPCandy announcements">Network</a></li>
		<?php } elseif(in_category('thinks')) { ?>
		<li class="opinion"><a href="<?php bloginfo('url'); ?>/category/thinks/" title="More WPCandy opinions">Opinion</a></li>
		<?php } elseif(in_category('teaches')) { ?>
		<li class="tutorials"><a href="<?php bloginfo('url'); ?>/category/teaches/" title="More WPCandy tutorials">Tuts</a></li>
		<?php } elseif(in_category('interviewed')) { ?>										
		<li class="interviews"><a href="<?php bloginfo('url'); ?>/category/interviewed/" title="More WPCandy interviews">Interview</a></li>
		<?php } elseif(in_category('reviewed')) { ?>
		<li class="reviews"><a href="<?php bloginfo('url'); ?>/category/reviewed/" title="More WPCandy reviews">Reviews</a></li>
		<?php } elseif(in_category('podcasts')) { ?>
		<li class="podcasts"><a href="<?php bloginfo('url'); ?>/category/podcasts/" title="More WPCandy podcasts">Podcast</a></li>
		<?php } elseif(in_category('presents')) { ?>
		<li class="features"><a href="<?php bloginfo('url'); ?>/category/presents/" title="More WPCandy features">Feature</a></li>
		<?php } elseif(in_category('linked')) { ?>
		<li class="links"><a href="<?php bloginfo('url'); ?>/category/linked/" title="More WPCandy WordPress links">Links</a></li>
		<?php } elseif(in_category('gives-away')) { ?>
		<li class="giveaways"><a href="<?php bloginfo('url'); ?>/category/gives-away/" title="More WPCandy WordPress giveaways">Gifts</a></li>
		<?php } elseif(in_category('made')) { ?>
		<li class="downloads"><a href="<?php bloginfo('url'); ?>/category/made/" title="More WPCandy WordPress downloads">Downld</a></li>
		<?php } elseif(in_category('watches')) { ?>
		<li class="videos"><a href="<?php bloginfo('url'); ?>/category/watches/" title="More WPCandy WordPress videos">Video</a></li>
		<?php } elseif(in_category('sites')) { ?>
		<li class="sites"><a href="<?php bloginfo('url'); ?>/category/sites/" title="More WPCandy WordPress sites">Sites</a></li>
		<?php } elseif(in_category('recommends')) { ?>
		<li class="bestof"><a href="<?php bloginfo('url'); ?>/category/recommends/" title="More WPCandy recommendations">Best of</a></li>
		<?php } elseif(in_category('previewed')) { ?>
		<li class="preview"><a href="<?php bloginfo('url'); ?>/category/previewed/" title="More WPCandy previews">Preview</a></li>
		<?php } elseif(in_category('liveblogged')) { ?>
		<li class="liveblogged"><a href="<?php bloginfo('url'); ?>/category/liveblogged/" title="More WPCandy Liveblogs">Liveblog</a></li>
									
		<?php } elseif( in_category( 'wp-late-night' ) || in_category( 'theme-show' ) || in_category( 'the-wpcandy-show' ) || in_category( 'the-sweet-plugin' ) || in_category( 'first-taste' ) ) { ?>
		<li class="broadcasts"><a href="<?php bloginfo('url'); ?>/shows" title="More WPCandy Shows">Show</a></li>
		<?php } ?>
									
		<?php if(has_tag('wordpress')) { ?>
		<li class="tag"><a href="<?php bloginfo('url'); ?>/on/wordpress" title="More posts on WordPress">WP</a></li>
		<?php } ?>
		<?php if(has_tag('themes')) { ?>
		<li class="tag"><a href="<?php bloginfo('url'); ?>/on/themes" title="More posts on WordPress themes">Themes</a></li>
		<?php } ?>
		<?php if(has_tag('plugins')) { ?>
		<li class="tag"><a href="<?php bloginfo('url'); ?>/on/plugins" title="More posts on WordPress plugins">Plugins</a></li>
		<?php } ?>
		<?php if(has_tag('multisite')) { ?>
		<li class="tag"><a href="<?php bloginfo('url'); ?>/on/multisite" title="More posts on WordPress Multisite">Multisite</a></li>
		<?php } ?>
		<?php if(has_tag('buddypress')) { ?>
		<li class="tag"><a href="<?php bloginfo('url'); ?>/on/buddypress" title="More posts on WordPress BuddyPress">Buddy</a></li>
		<?php } ?>
		<?php if(has_tag('bbpress')) { ?>
		<li class="tag"><a href="<?php bloginfo('url'); ?>/on/bbpress" title="More posts on bbPress">bbPress</a></li>
		<?php } ?>
		<?php if(has_tag('wordcamp')) { ?>
		<li class="tag"><a href="<?php bloginfo('url'); ?>/on/wordcamp" title="More posts on WordCamp">Camp</a></li>
		<?php } ?>
	</ul>
</div><!-- .content-cats -->