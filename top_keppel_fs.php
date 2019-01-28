<?php
if ($top_sztori_cikk) {
	$args_top3=array('p' => $top_sztori_cikk[0]);
} else {
	$args_top3=array('posts_per_page' => 1);
}

$the_query_top3 = new WP_Query($args_top3);
while ($the_query_top3->have_posts() ) : $the_query_top3->the_post();
	$feat_image_url=get_the_post_thumbnail_url(get_the_ID(), 'full');
?>

<div class="top_keppel_fs mb80 pr">

	<div class="headline pa n100 h100 z2">
		<div class="inner n9">
			<div class="mt100">
				<div class="shell">
					<a href="<?php echo get_category_link(get_first_cat_id()); ?>" class="the_category cat_linkbox"><?php echo get_first_cat_name();?></a>
					<h2 class="the_title pt30 ttn fs67px"><a href="<?php echo get_permalink();?>" class="cwhite"><?php the_title();?></a></h2>
					<?php include('author_box.php');?>
				</div>
			</div>
		</div>
	</div>
	<div class="img100 the_featimage h100" style="background:url(<?php echo $feat_image_url; ?>) no-repeat;background-size:cover;"><?php //the_post_thumbnail('full', array('class' => 'p0')); ?></div>
</div>

<?php endwhile; wp_reset_postdata(); ?>