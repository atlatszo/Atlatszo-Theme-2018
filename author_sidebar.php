<?php
$szerzo_tipusa=get_field('szerzo_tipus');

if (!$szerzo_tipusa || $szerzo_tipusa=="alapértelmezett") {

	// Internal or admin user

	$author_id=$post->post_author;
	$user_custom_photo=get_field('impresszum_kep', 'user_'.$author_id);
	$fullname=nl2br(get_the_author_meta('last_name')." ".get_the_author_meta('first_name'));
	if ($fullname==" ") {$fullname=get_the_author_meta('nickname');}
	?>

	<div class="author_box cgrey fs12px mb20 pb20 bbsgrey3">
		<div class="text mb20 fmedium">Szerző</div>
		<?php include('author-avatar.php'); ?>
		<div class="the_author ib"><a href="<?php echo get_author_posts_url($author_id); ?>" class="author_url cgrey"><?php echo $fullname; ?></a></div>
	</div>

<?php

} else {
	
	// External or subscriber author

	$author_id=get_field('szerzo_kivalasztasa');
	$avatar_url=get_avatar_url($author_id, array( 'size'=> 80, 'default'=>'404' ));
	$user_custom_photo=get_field('impresszum_kep', 'user_'.$author_id);
	$fullname=get_user_meta($author_id, 'last_name', true)." ".get_user_meta($author_id, 'first_name', true);
	if ($fullname==" ") {$fullname=get_user_meta($author_id, 'nickname', true);}

	// Multiple authors
	
	if (have_rows('szerzok_kivalasztasa')) {
	?>
<div class="author_box cgrey fs12px mb20 pb20 bbsgrey3">
	
	<div class="text mb20 fmedium">Szerző</div>
	
	<?php while (have_rows('szerzok_kivalasztasa') ) : the_row(); ?>

		<div class="multiple_author pb20">

	<?php
			$author_id=get_sub_field('cikk_szerzoi');
			$avatar_url=get_avatar_url($author_id, array( 'size'=> 80, 'default'=>'404' ));
			$user_custom_photo=get_field('impresszum_kep', 'user_'.$author_id);
			$fullname=get_user_meta($author_id, 'last_name', true)." ".get_user_meta($author_id, 'first_name', true);
			if ($fullname==" ") {$fullname=get_user_meta($author_id, 'nickname', true);}
	?>

		<?php if ($user_custom_photo) { ?>
			<img src="<?php echo $user_custom_photo['sizes']['thumbnail']; ?>" width="80" height="80" class="authorimage bl mb20" />
		<?php } elseif (@getimagesize($avatar_url)) { ?>
			<img src="<?php echo $avatar_url; ?>" class="authorimage bl mb20" />
		<?php } else { ?>
			<img src="<?php echo get_bloginfo('template_url') ?>/i/user_icon.jpg" width="80" height="80" class="authorimage bl mb20" />
		<?php } ?>
		<div class="the_author ib "><a href="<?php echo get_author_posts_url($author_id); ?>" class="author_url cgrey"><?php echo $fullname; ?></a></div>

	</div>
	
	<?php endwhile; ?>


</div>

<?php
	} else {
	$fullname=get_user_meta($author_id, 'last_name', true)." ".get_user_meta($author_id, 'first_name', true);
	if ($fullname==" ") {$fullname=get_user_meta($author_id, 'nickname', true);}
?>

	<div class="author_box cgrey fs12px mb20 pb20 bbsgrey3">
		<div class="text mb20 fmedium">Szerző</div>
		<?php if ($user_custom_photo) { ?>
			<img src="<?php echo $user_custom_photo['sizes']['thumbnail']; ?>" width="80" height="80" class="authorimage bl mb20" />
		<?php } elseif (@getimagesize($avatar_url)) { ?>
			<img src="<?php echo $avatar_url; ?>" class="authorimage bl mb20" />
		<?php } else { ?>
			<img src="<?php echo get_bloginfo('template_url') ?>/i/user_icon.jpg" width="80" height="80" class="authorimage bl mb20" />
		<?php } ?>
		<div class="the_author ib"><a href="<?php echo get_author_posts_url($author_id); ?>" class="author_url cgrey"><?php echo $fullname; ?></a></div>
	</div>

	<?php } ?>

<?php } ?>