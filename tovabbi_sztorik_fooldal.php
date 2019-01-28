<?php
$excluded_posts=[];

// Get top sztori post

$exclude_topsztori=get_field('top_sztori_cikk');
array_push($excluded_posts, $exclude_topsztori[0]);

// Get dosszie posts

$exclude_dosszie=get_field('dosszie_cikkek');
foreach ($dosszie_cikkek as $dosszie_cikk_id) {
	array_push($excluded_posts, $dosszie_cikk_id);
}

$args_tovabbi_sztorik=array(
	'posts_per_page' => $tovabbi_sztorik_szama,
	'post__not_in' => $excluded_posts
);


$the_query_tovabbi_sztorik = new WP_Query($args_tovabbi_sztorik);
//var_dump($the_query_tovabbi_sztorik);
?>
<section class="n100 section-tovabbi-sztorik section-tovabbi-sztorik-1">

	<div class="tovabbi_sztorik cle">

		<h4 class="title fs16px cgrey ttn fmedium ls2 pt10"><div class="shell"><span class="n9 bl pt5">További sztorik</span></div></h4>
		
		<div class="n100 blgrey">
			<?php while ($the_query_tovabbi_sztorik->have_posts() ) : $the_query_tovabbi_sztorik->the_post(); ?><article class="n100 pt50 bl item-<?php echo $i;?>">
				<div class="inner n9">
				<div class="shell">
					<a href="<?php echo get_category_link(get_first_cat_id()); ?>" class="the_category mb20 bl"><?php echo get_first_cat_name();?></a>
					<h3 class="the_title ttn mb40"><a href="<?php echo get_permalink();?>" class="cdarkgrey fs48px"><?php the_title();?></a></h3>
					
						<?php
						$post_author_id=get_post_field( 'post_author', get_the_ID());
						$the_post_date=get_the_date('Y. M. j.');
						$the_post_author_name=nl2br(get_the_author_meta('last_name', $post_author_id)." ".get_the_author_meta('first_name', $post_author_id));
						if (has_post_thumbnail()) {
						?>

						<div class="img100 the_featimage n33 ib"><a href="<?php echo get_permalink(); ?>" class="bl fade"><?php the_post_thumbnail('small_169', array('class' => 'pr30')); ?></a></div><div class="n66 the_text ib vt mb30">
							<div class="the_excerpt kszoveg cdarkgrey lh140 fs20px ls05 mb30"><?php echo get_the_excerpt(); ?></div>
							<div class="author_box cgrey fs12px">
								<div class="the_author ib"><?php echo $the_post_author_name; ?></div>
								<time class="the_post_date"> — <?php echo $the_post_date; ?></time>
							</div>
						</div>
					
					<?php } else { ?>

						<div class="the_excerpt kszoveg cdarkgrey lh140 fs20px ls05 mb30"><?php echo get_the_excerpt(); ?></div>
						<div class="author_box cgrey fs12px">
							<div class="the_author ib"><?php echo $the_post_author_name; ?></div>
							<time class="the_post_date"> — <?php echo $the_post_date; ?></time>
						</div>

					<?php } ?>

				</div>
				</div>
			</article><?php $i++; $start++; endwhile; wp_reset_postdata(); ?>
		</div>

	</div>

</section>