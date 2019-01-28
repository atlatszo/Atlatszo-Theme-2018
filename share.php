<div class="share bbsgrey3 mb20 pb20">
	
	<h5 class="cgrey ls1 fmedium fs12px mb20 ttu">Megosztás</h5>
	
	<a href="http://www.tumblr.com/share?u=<?php echo get_permalink();?>" class="social ib tumblr pr10" title="Megosztom ezt a bejegyzést a Tumblren!" target="_blank">
		<img src="<?php echo get_bloginfo('template_url'); ?>/i/tumblr.svg" width="20" height="20" alt="Tumblr">
	</a>

	<a href="https://twitter.com/share?url=<?php echo get_permalink();?>&amp;text=<?php echo get_the_title(); ?>&amp;via=atlatszo" class="social ib twitter pr10" title="Megosztom ezt a bejegyzést a követőimmel a Twitteren!" target="_blank">
		<img src="<?php echo get_bloginfo('template_url'); ?>/i/twitter.svg" width="20" height="20" alt="Twitter">
	</a>


	<a href="mailto:?subject=<?php echo get_the_title(); ?>&amp;body=<?php echo esc_url(get_permalink()); ?>" class="social emailshare ib email pr10" title="Elküldöm e-mailen ezt a bejegyzést!">
		<img src="<?php echo get_bloginfo('template_url'); ?>/i/email.svg" width="26" height="20" alt="Email">
	</a>

	<div class="ib facebook-share">
		<iframe src="https://www.facebook.com/plugins/share_button.php?href=<?php echo esc_url(get_permalink()); ?>&layout=button_count&size=small&mobile_iframe=true&appId=210975892275652&width=88&height=20" width="110" height="20" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
	</div>

</div>