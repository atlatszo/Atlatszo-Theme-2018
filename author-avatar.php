<?php
$user_id=get_the_author_meta('ID');
$avatar_url=get_avatar_url($user_id, array( 'size'=> 80, 'default'=>'404' ));
$user_custom_photo=get_field('impresszum_kep', 'user_'.$user_id);
?>

<?php if ($user_custom_photo) { ?>
	<img src="<?php echo $user_custom_photo['sizes']['thumbnail']; ?>" width="80" height="80" class="authorimage bl mb20" />
<?php } elseif (@getimagesize($avatar_url)) { ?>
	<img src="<?php echo $avatar_url; ?>" class="authorimage bl mb20" />
<?php } else { ?>
	<img src="<?php echo get_bloginfo('template_url') ?>/i/user_icon.jpg" width="80" height="80" class="authorimage bl mb20" />
<?php } ?>