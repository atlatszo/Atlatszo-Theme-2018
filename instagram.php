<?php
$instagram_feedek_szama=get_field('instagram_feedek_szama');
if ($instagram_feedek_szama) {
	$instagram_feeds=$instagram_feedek_szama;
} else {
	$instagram_feeds=8;
}
?>
<div class="instagram bblack">
	
	<h4 class="title fs16px bdgrey cwhite ttn fmedium ls2 pt10"><div class="shell"><span class="n9 bl pt5"><span class="the_text fl">Átlátszó INSTAGRAM</span><span class="fr ttu"><a href="https://www.instagram.com/atlatszo/" target="_blank" class="peach fblack vm"><img src="<?php echo get_bloginfo('template_url'); ?>/i/instagram-peach.svg" width="18" height="18" class="vm mr10" alt="instagram" /><span class="innertext vm">KÖVETÉS</span></a></span><span class="bl cl"></span></div></h4>
	
	<?php echo do_shortcode('[instagram-feed num='.$instagram_feeds.' cols=4 imagepadding=0 showbutton=false showfollow=false]'); ?>

</div>