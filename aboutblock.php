<?php
$szerzoi_doboz=get_field('szerzoi_doboz', get_the_ID());

if ($szerzoi_doboz && $szerzoi_doboz=="igen") {
	$szerzo_tipus=get_field('szerzo_tipus', get_the_ID());
}

if ($szerzoi_doboz && $szerzoi_doboz=="igen" && $szerzo_tipus=="megadott szerző") {

	$user_id=get_field('szerzo_kivalasztasa', get_the_ID());
	$szerzoi_doboz_helyzete=get_field('szerzoi_doboz_helyzete', get_the_ID());

	if ($szerzoi_doboz_helyzete && $szerzoi_doboz_helyzete=="cikk alján") {
		$szerzoi_doboz_class="about_block_bottom";
	} else {
		$szerzoi_doboz_class="";
	}

	$fullname=get_user_meta($user_id, 'last_name', true)." ".get_user_meta($user_id, 'first_name', true);
	if ($fullname==" ") {$fullname=get_user_meta($user_id, 'nickname', true);}

}

if ($szerzoi_doboz && $szerzoi_doboz=="igen" && $szerzo_tipus=="alapértelmezett") {

	$user_id=get_the_author_meta('ID');
	$szerzoi_doboz_class="";

}

$szerzoi_doboz_szovege=get_field('szerzoi_doboz_szovege', 'user_'.$user_id);
$user_custom_photo=get_field('impresszum_kep', 'user_'.$user_id);

if ($user_custom_photo) {
	$szerzo_foto=$user_custom_photo['sizes']['thumbnail'];
} elseif (@getimagesize($avatar_url)) {
	$szerzo_foto=get_avatar_url($user_id, array( 'size'=> 270, 'default'=>'404' ));
} else {
	$szerzo_foto=get_bloginfo('template_url')."/i/user_icon.jpg";
}

$szerzo_neve=nl2br(get_user_meta($user_id, 'last_name', true)." ".get_user_meta($user_id, 'first_name', true));
if ($szerzo_neve==" ") {
	$szerzo_neve=get_user_meta($user_id, 'nickname', true);
}

if ($szerzoi_doboz && $szerzoi_doboz=="igen" && !have_rows('szerzok_kivalasztasa')) {
?>

	<div class="aboutblock blgrey img100 mb40 <?php echo $szerzoi_doboz_class; ?>">
		<div class="n50 ib vm the_photo"><img src="<?php echo $szerzo_foto; ?>" class="bl" alt="<?php echo $szerzo_neve; ?>" /></div><div class="n50 ib vm the_text">
			<div class="description p20 cdarkgrey">
				<h5 class="cred fs15px ls05 pt15"><?php echo $szerzo_neve; ?></h5>
				<p><?php echo $szerzoi_doboz_szovege; ?></p>
			</div>
		</div>
	</div>

<?php } ?>