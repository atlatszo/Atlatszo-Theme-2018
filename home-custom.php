<?php
/*
Template Name: Home customized
*/
get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post();?>

<main class="main home">
	<?php if ( is_active_sidebar( 'main-banner-desktop' ) ) : ?>
		<?php dynamic_sidebar( 'main-banner-desktop' ); ?>
	<?php endif; ?>

        <?php if ( is_active_sidebar( 'main-banner-mobile' ) ) : ?>
                <?php dynamic_sidebar( 'main-banner-mobile' ); ?>
        <?php endif; ?>

	<?php
	$top_sztori_tipusa=get_field('top_sztori_tipusa');
	$top_sztori_cikk=get_field('top_sztori_cikk');

	if ($top_sztori_tipusa=="Szöveges" || !$top_sztori_tipusa) { ?>
		<section class="n9 section-top section-top-kep-nelkul"><?php include_once('top_kep_nelkul.php') ?></section>
	<?php } elseif ($top_sztori_tipusa=="Kis képpel") { ?>
		<section class="n9 section-top section-top-keppel"><?php include_once('top_keppel.php') ?></section>
	<?php } elseif ($top_sztori_tipusa=="Nagy képpel") { ?>
		<section class="n100 section-top section-top-keppel-fs"><?php include_once('top_keppel_fs.php') ?></section>
	<?php } ?>

	<section class="n9 section-cikkek-4"><?php include_once('masodik_4_cikk.php') ?></section>

        <?php /* if ( is_active_sidebar( 'korona-widget-mobile' ) ) : */ ?>
                <?php /* dynamic_sidebar( 'korona-widget-mobile' ); */ ?>
        <?php /* endif; */ ?>

	<?php

		$dosszie_1_pozicio=get_field('dosszie_1_pozicio');
		$dosszie_2_pozicio=get_field('dosszie_2_pozicio');
		$tamogatoi_blokk_1_pozicio=get_field('tamogatoi_blokk_1_pozicio');
		$tamogatoi_blokk_2_pozicio=get_field('tamogatoi_blokk_2_pozicio');
		$videos_tartalom_pozicio=get_field('videos_tartalom_pozicio');
		$blogajanlo_1_pozicio=get_field('blogajanlo_1_pozicio');
		$blogajanlo_1=get_field('blogajanlo_1');
		$blogajanlo_2_pozicio=get_field('blogajanlo_2_pozicio');
		$blogajanlo_2=get_field('blogajanlo_2');
		$blogajanlo_3_pozicio=get_field('blogajanlo_3_pozicio');
		$blogajanlo_3=get_field('blogajanlo_3');
		$blogajanlo_4_pozicio=get_field('blogajanlo_4_pozicio');
		$blogajanlo_4=get_field('blogajanlo_4');
		$instagram_feedek_pozicio=get_field('instagram_feedek_pozicio');

		$tovabbi_sztorik_szama=get_field('tovabbi_sztorik_szama');
		$start=1;

	?>

				<?php
				include('tovabbi_sztorik_before.php');

				$excluded_posts=[];

				// Get top sztori post

				$exclude_topsztori=get_field('top_sztori_cikk');
				array_push($excluded_posts, $exclude_topsztori[0]);

				// Get dosszie posts

				$dosszie_cikkek=get_field('dosszie_cikkek');
				foreach ($dosszie_cikkek as $dosszie_cikk_id) {
					//echo "dosszie_cikk_id: ".$dosszie_cikk_id."<br>";
					array_push($excluded_posts, $dosszie_cikk_id);
				}

				$dosszie_cikkek_2=get_field('dosszie_2_cikkek');
				foreach ($dosszie_cikkek_2 as $dosszie_cikk_id_2) {
					array_push($excluded_posts, $dosszie_cikk_id_2);
				}

				// Exclude all, previously collected posts from tovabbi cikkek

				$args_tovabbi_sztorik=array(
					'posts_per_page' => $tovabbi_sztorik_szama,
					'post__not_in' => $excluded_posts,
					'fields' => 'ids'
				);
				$the_query_tovabbi_sztorik = new WP_Query($args_tovabbi_sztorik);
				$all_post_ids=$the_query_tovabbi_sztorik->posts;
				$all_post_ids_from_1 = array_combine(range(1, count($all_post_ids)), array_values($all_post_ids));
				//var_dump($all_post_ids_from_1);
				//echo "<hr>";
				//exit;
				?>
				<?php /*while ($the_query_tovabbi_sztorik->have_posts() ) : $the_query_tovabbi_sztorik->the_post();*/ foreach ($all_post_ids_from_1 as $key_post => $value_postid) {

					//echo "key: ".$key_post."for this post id: ".$value_postid."<br>";

		if ($key_post==$dosszie_1_pozicio) {

			$dosszie=get_field('dosszie');
			include('tovabbi_sztorik_after.php');
			if ($dosszie=="igen") {include('dosszie_1.php');}
			include('tovabbi_sztorik_before.php');
		} elseif ($key_post==$dosszie_2_pozicio) {
			
			$dosszie_2=get_field('dosszie_2');
			include('tovabbi_sztorik_after.php');
			if ($dosszie_2=="igen") {include('dosszie_2.php');}
			include('tovabbi_sztorik_before.php');

		} elseif ($key_post==$tamogatoi_blokk_1_pozicio) {
			
			include('tovabbi_sztorik_after.php');
			include('tamogatoi_home_1.php');
			include('tovabbi_sztorik_before.php');

		} elseif ($key_post==$tamogatoi_blokk_2_pozicio) {

			include('tovabbi_sztorik_after.php');
			include('tamogatoi_home_2.php');
			include('tovabbi_sztorik_before.php');

		} elseif ($key_post==$videos_tartalom_pozicio) {

			include('tovabbi_sztorik_after.php');
			$videos_tartalom=get_field('videos_tartalom');
			if ($videos_tartalom) {include('video_home.php');}
			include('tovabbi_sztorik_before.php');

		} elseif ($key_post==$blogajanlo_1_pozicio && $blogajanlo_1=="igen") {
			include('tovabbi_sztorik_after.php');
			include('blogajanlo_home_1.php');
			include('tovabbi_sztorik_before.php');

		} elseif ($key_post==$blogajanlo_2_pozicio && $blogajanlo_2=="igen") {
			include('tovabbi_sztorik_after.php');
			include('blogajanlo_home_2.php');
			//echo "blogajanlo 2";
			include('tovabbi_sztorik_before.php');

		} elseif ($key_post==$blogajanlo_3_pozicio && $blogajanlo_3=="igen") {
			include('tovabbi_sztorik_after.php');
			include('blogajanlo_home_3.php');
			include('tovabbi_sztorik_before.php');

		} elseif ($key_post==$blogajanlo_4_pozicio && $blogajanlo_4=="igen") {
			include('tovabbi_sztorik_after.php');
			include('blogajanlo_home_4.php');
			include('tovabbi_sztorik_before.php');

		} elseif ($key_post==$instagram_feedek_pozicio) {

			include('tovabbi_sztorik_after.php');
			$instagram_feedek_szama=get_field('instagram_feedek_szama');
			if ($instagram_feedek_szama) {include('instagram_home.php');}
			include('tovabbi_sztorik_before.php');

		}

		$the_cat=get_the_category($value_postid);
		$the_cat_name=$the_cat[0]->name;
		$the_cat_id=$the_cat[0]->cat_ID;

					?><article class="n100 pt50 bl item-<?php echo $key_post;?>">
					<div class="inner n9">
					<div class="shell">
						<a href="<?php echo get_category_link($the_cat_id); ?>" class="the_category mb20 bl"><?php echo $the_cat_name;?></a>
						<h3 class="the_title ttn mb40"><a href="<?php echo get_permalink($value_postid);?>" class="cdarkgrey fs48px"><?php echo get_the_title($value_postid);?></a></h3>
						
							<?php
							$post_author_id=get_post_field( 'post_author', $value_postid);
							$the_post_date=get_the_date('Y. M. j.', $value_postid);
							//$the_post_author_name=nl2br(get_the_author_meta('nickname', $post_author_id)); // ORIGINAL
							$the_post_author_name=nl2br(get_the_author_meta('last_name', $post_author_id)." ".get_the_author_meta('first_name', $post_author_id));

							//$excerpt = apply_filters('the_excerpt', get_post_field('post_excerpt', $value_postid));
							$excerpt=km_get_the_excerpt($value_postid);
							if (has_post_thumbnail($value_postid)) {
							?>

							<div class="img100 the_featimage n33 ib"><a href="<?php echo get_permalink($value_postid); ?>" class="bl fade"><?php echo get_the_post_thumbnail($value_postid, 'small_169', array('class' => 'pr30')); ?></a></div><div class="n66 the_text ib vt mb30">
								<div class="the_excerpt kszoveg cdarkgrey lh140 fs20px ls05 mb30"><?php echo $excerpt; ?></div>
								<div class="author_box cgrey fs12px">
									<div class="the_author ib"><?php echo $the_post_author_name; ?></div>
									<time class="the_post_date"> — <?php echo $the_post_date; ?></time>
								</div>
							</div>
						
						<?php } else { ?>

							<div class="the_excerpt kszoveg cdarkgrey lh140 fs20px ls05 mb30"><?php echo $excerpt; ?></div>
							<div class="author_box cgrey fs12px">
								<div class="the_author ib"><?php echo $the_post_author_name; ?></div>
								<time class="the_post_date"> — <?php echo $the_post_date; ?></time>
							</div>

						<?php } ?>

					</div>
					</div>
				</article><?php $start++; } // $i++; $start++; endwhile; wp_reset_postdata(); ?>

<?php include('tovabbi_sztorik_after.php'); ?>
	
	<section class="n100 section-tamogatoi section-tamogatoi-hirlevel tamogatoi-last"><?php include('tamogatoi-hirlevel.php') ?></section>	

</main>
<?php endwhile; endif; ?>
<?php get_footer(); ?>
