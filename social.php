<?php
$oldalsavban_megjeleno_nev = get_field('oldalsavban_megjeleno_nev', 'option');
$oldalsav_szoveg = get_field('oldalsav_szoveg', 'option');
$facebook_url = get_field('facebook_url', 'option');
$instagram_url = get_field('instagram_url', 'option');
$twitter_url = get_field('twitter_url', 'option');
$tumblr_url = get_field('tumblr_url', 'option');
$email_cim = get_field('email_cim', 'option');
$kozossegi_url_cel = get_field('kozossegi_url_cel', 'option');

if (!$oldalsav_szoveg) {
	$oldalsav_szoveg="Kövess minket, vagy lépj velünk kapcsolatba itt!";
}

if (!$oldalsavban_megjeleno_nev) {
	$oldalsavban_megjeleno_nev=get_bloginfo('name');
}

$site_without_http = trim( str_replace( array( 'http://', 'https://' ), '', get_bloginfo('url')), '/' );

if (in_category(302) || get_post_format()=="video") { ?>

	<div class="social ac bdgrey2 p20 clgreylead video_social">
		
		<?php if ($site_without_http=="atlatszo.hu" || $site_without_http=="back.atlatszo.hu") {?>
			<img src="<?php bloginfo('template_url')?>/i/atlatszo-logo-footer.svg" width="75" height="30" alt="<?php echo $oldalsavban_megjeleno_nev; ?>" class="bl ma" alt="<?php bloginfo('name')?>" />
		<?php } else { ?>
			<strong class="clgreylead ttu fs12px fblack"><?php echo $oldalsavban_megjeleno_nev; ?></strong>
		<?php } ?>

		<p class="ls05 lh160 pt20 fs12px fmedium"><?php echo $oldalsav_szoveg; ?></p>
		<?php if ($facebook_url) { ?><a href="<?php echo $facebook_url; ?>" class="fade social-link facebook-link mr10" target="<?php echo $kozossegi_url_cel; ?>"></a><?php } ?>
		<?php if ($tumblr_url) { ?><a href="<?php echo $tumblr_url; ?>" class="fade social-link tumblr-link mr10" target="<?php echo $kozossegi_url_cel; ?>"></a><?php } ?>
		<?php if ($twitter_url) { ?><a href="<?php echo $twitter_url; ?>" class="fade social-link twitter-link mr10" target="<?php echo $kozossegi_url_cel; ?>"></a><?php } ?>
		<?php if ($instagram_url) { ?><a href="<?php echo $instagram_url; ?>/" class="fade social-link instagram-link mr10" target="<?php echo $kozossegi_url_cel; ?>"></a><?php } ?>
		<?php if ($email_cim) { ?><a href="mailto:<?php echo $email_cim; ?>" class="fade social-link email-link"></a><?php } ?>

	</div>

<?php } else { ?>

	<div class="social ac blgrey p20 cgrey">
		
		<?php if ($site_without_http=="atlatszo.hu" || $site_without_http=="back.atlatszo.hu") {?>
			<img src="<?php bloginfo('template_url')?>/i/atlatszo-logo.svg" width="75" height="30" alt="<?php echo $oldalsavban_megjeleno_nev; ?>" class="bl ma" alt="<?php bloginfo('name')?>" />
		<?php } else { ?>
			<strong class="clgreylead ttu fs12px fblack"><?php echo $oldalsavban_megjeleno_nev; ?></strong>
		<?php } ?>

		<p class="ls05 lh160 pt20 fs12px fmedium"><?php echo $oldalsav_szoveg; ?></p>
		<?php if ($facebook_url) { ?><a href="<?php echo $facebook_url; ?>" class="fade social-link facebook-link mr10" target="<?php echo $kozossegi_url_cel; ?>"></a><?php } ?>
		<?php if ($tumblr_url) { ?><a href="<?php echo $tumblr_url; ?>" class="fade social-link tumblr-link mr10" target="<?php echo $kozossegi_url_cel; ?>"></a><?php } ?>
		<?php if ($twitter_url) { ?><a href="<?php echo $twitter_url; ?>" class="fade social-link twitter-link mr10" target="<?php echo $kozossegi_url_cel; ?>"></a><?php } ?>
		<?php if ($instagram_url) { ?><a href="<?php echo $instagram_url; ?>/" class="fade social-link instagram-link mr10" target="<?php echo $kozossegi_url_cel; ?>"></a><?php } ?>
		<?php if ($email_cim) { ?><a href="mailto:<?php echo $email_cim; ?>" class="fade social-link email-link"></a><?php } ?>

	</div>

<?php } ?>