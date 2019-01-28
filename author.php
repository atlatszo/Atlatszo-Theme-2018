<?php get_header(); ?>

<main class="cat">
<div class="shell">
	
	<?php
	$userdata = get_userdatabylogin(get_query_var('author_name'));
	$user_id=$userdata->ID;
	$user_email=$userdata->user_email;

	/*$fname = get_the_author_meta('first_name', $user_id);
	$lname = get_the_author_meta('last_name', $user_id);
	$fullname=$lname." ".$fname;
	if (!$lname && !$fname) {$fullname=get_query_var('author_name');}*/
	//$fullname=nl2br(get_the_author_meta('nickname'), $user_id);

	$fullname=nl2br(get_the_author_meta('last_name', $user_id)." ".get_the_author_meta('first_name', $user_id));
	$user_custom_photo=get_field('impresszum_kep', 'user_'.$user_id);

	if ($user_custom_photo) {
		$userphoto_url=$user_custom_photo['sizes']['square_medium'];
	} else {
		$userphoto_url=get_avatar_url($user_id, array( 'size'=> 300, 'default'=>'404' ));
		if (@getimagesize($userphoto_url)) {
		} else {
			$userphoto_url=get_bloginfo('template_url')."/i/mystery_man_420.png"; // no photo
		}
	}

	$szerzoi_doboz_szovege=get_field('szerzoi_doboz_szovege', 'user_'.$user_id);
	
	?>

	<div class="the_author_box intro pt20 bbsgrey3 mb40">
		<div class="inner n9">
		<div class="the_author_box plr50">
			<div class="author_head mb20">
				<div class="author_name ib mr20 vm"><h1 class="author_title mb10"><a href="<?php echo get_permalink(28); ?>" class="the_category cat_linkbox"><?php echo $fullname; ?></a></h1></div><a href="mailto:<?php echo $user_email;?>" class="author_email ib vm"><img src="<?php echo get_bloginfo('template_url');?>/i/email.svg" alt="<?php echo $fullname; ?>" width="25" height="20" /></a>
			</div>
			<div class="author_foot">
				<div class="author_image ib vt n33 img100 pr30"><img src="<?php echo $userphoto_url; ?>" alt="<?php echo $fullname; ?>" /></div><div class="author_description ib n66 fs18px fbold kszoveg lh200"><?php echo $szerzoi_doboz_szovege; ?></div>
			</div>
		</div>
		</div>
	</div>

	<?php if ( have_posts() ) { ?>

	<div class="cat_posts">

		<?php while ( have_posts() ) : the_post();
			$excerpt=get_the_excerpt();
			$excerpt=str_replace('&nbsp;', '', $excerpt);

			//echo "megadott szerző: ".$megadott_szerzo."<br>";
			//echo "aktuális szerző: ".$user_id."<br>";

		?><article class="the_post n100 bbsgrey3 pt50 bl item-<?php echo $i;?>">
			<div class="inner n9">
				<a href="<?php echo get_category_link(get_first_cat_id()); ?>" class="the_category mb20 bl"><?php echo get_first_cat_name();?></a>
				<h3 class="the_title ttn mb40"><a href="<?php echo get_permalink();?>" class="cdarkgrey fs48px"><?php the_title();?></a></h3>
				
				<?php if (has_post_thumbnail()) { ?>
					<div class="img100 the_featimage n33 ib"><a href="<?php echo get_permalink();?>" class="fade bl"><?php the_post_thumbnail('small_169', array('class' => 'pr30')); ?></a></div><div class="the_text mb30 n66 ib vt">
						<div class="the_excerpt kszoveg cdarkgrey lh140 fs20px ls05 mb30"><?php echo $excerpt; ?></div>
						<?php include('author_box.php');?>
					</div>
				<?php } else { ?>
					<div class="the_excerpt kszoveg cdarkgrey lh140 fs20px ls05 mb30"><?php echo $excerpt; ?></div>
					<?php include('author_box.php');?>
				<?php } ?>

			</div>
		</article><?php endwhile; ?>

	</div>

	
	<?php if (function_exists("pagination")) {pagination($wp_query->max_num_pages);} ?>
	

	<?php } else { ?>

		<h1 class="ac pt40 mb40"><?php _e('Elnézést, de ettől a szerzőtől nem találtunk cikket.', 'atlatszo'); ?></h1>

	<?php } ?>

</div>
</main>
<?php get_footer();?>