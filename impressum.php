<?php
/*
Template name: Impresszum
*/
get_header();
if (have_posts()) : while (have_posts()) : the_post();
$intro=get_field('bemutatkozo_szoveg');
?>

<main class="page support">
<div class="shell">

	<div class="the_intro n100">
		<div class="inner n9 mt40 mb40 bbsgrey3">
			<strong class="ib bred cwhite p10 ttu fs15px mb40 mt40"><?php echo bloginfo('name'); ?></strong>
			<h1 class="the_title post_title fs48px ttn cwhite mb60 ls1 pr40"><?php the_title(); ?></h1>
			<aside class="share n25 ib vt"><div class="inner pr30"><?php include('share.php'); ?></div></aside><div class="the_excerpt n75 ib vt fs18px kszoveg lh200"><?php echo apply_filters('the_content', $intro); ?></div>
		</div>
	</div>


	<div class="the_authors n9 bbsgrey3 pb20 mb40">
		<div class="inner fr">
			<?php
			$i=1;
			$args=array('orderby' => 'menu_order');
			$atlatszo_users=get_users($args);
			$aboutus_users=[];

			// Get users
			//$u=1;
			foreach ($atlatszo_users as $user) {
				$user_id=$user->ID;			
				//$szerepeljen=get_field('szerepeljen', 'user_'.$user_id); // TEMP OFF ACF PRO
				//$user_sequence=get_field('felhasznalo_sorrend', 'user_'.$user_id);
				
				//$szerepeljen=get_user_meta($user_id, 'szerepeljen', true);
				//$user_sequence=get_user_meta($user_id, 'felhasznalo_sorrend', true);
				
				$szerepeljen=get_field('szerepeljen_az_impresszumban', 'user_'.$user_id);
				$user_sequence=get_field('impresszum_sorrend', 'user_'.$user_id);

				if ($szerepeljen=="igen") {
					$aboutus_users[$user_sequence]=$user_id;

					if (is_super_admin()) {
						//echo "user id (".$user_id.") szerepeljen: ".$szerepeljen.", sorrend: ".$user_sequence.", username: ".get_the_author_meta('nickname', $user_id)."<br>";
					}

				}

			}

			// Display users
			ksort($aboutus_users);


			$i=1;
			global $wp_roles;
			foreach ($aboutus_users as $key => $user_id) {

				$fname = get_the_author_meta('first_name', $user_id);
				$lname = get_the_author_meta('last_name', $user_id);
				$email = get_the_author_meta('user_email', $user_id);
				$user_custom_photo=get_field('impresszum_kep', 'user_'.$user_id);

				//$userphoto=get_field('felhasznalo_foto', 'user_'.$user_id);
				//$userphoto_url=$userphoto['sizes']['square_medium'];

				//$userphoto_url=get_the_author_meta('felhasznalo_foto', $user_id);
				$titulus=get_the_author_meta('description', $user_id);
				
				
				//if (@getimagesize($userphoto_url)) {
    				$u = get_userdata($user_id);
    				$role = array_shift($u->roles);
    				$user->role = $wp_roles->roles[$role]['name'];
    				
    				if ($user_custom_photo) {
    					//var_dump($user_custom_photo);
    					$userphoto_url=$user_custom_photo['sizes']['square_medium'];
    				} else {
						$userphoto_url=get_avatar_url($user_id, array( 'size'=> 300, 'default'=>'404' ));
						if (@getimagesize($userphoto_url)) {
						} else {
    						$userphoto_url=get_bloginfo('template_url')."/i/mystery_man_420.png"; // no photo
						}
    				}
				?>
					<figure class="the_user n25 pr20 kszoveg bl fl mb30 vt user-<?php echo $user_id; ?>">

						<a href="<?php echo get_author_posts_url($user_id); ?>" class="author_url mb20 ib vm img100 fade">
							<img src="<?php echo $userphoto_url; ?>" class="authorimage bl" />
						</a>

						<div class="usermeta">
							<div class="the_left_side fl">
								<h4 class="fs18px mb10 ttn"><a href="<?php echo get_author_posts_url($user_id); ?>" class="user_url fs18px cwhite kszoveg"><?php echo $lname." ".$fname; ?></a></h4>
								<div class="titulus fs18px cwhite"><p><?php echo $titulus; //echo _e($user->role); ?></p></div>
							</div>
							<div class="the_right_side fr">
								<a href="mailto:<?php echo $email; ?>"><img src="<?php echo get_bloginfo('template_url');?>/i/email.svg" width="26" height="20" alt="email"/></a>
							</div>
						</div>

					</figure>
					<?php //} ?>

				<?php } ?>
		</div>
		<div class="cl"></div>
	</div>

	<div class="the_content n9">
		<div class="inner fr kszoveg">
			<?php the_content(); ?>
		</div>
	</div>



</div>
</main>

<?php endwhile; endif; ?>
<?php get_footer(); ?>