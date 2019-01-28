<?php
if ($top_sztori_cikk) {
	$args_top_kep_nelkul=array('p' => $top_sztori_cikk[0]);
} else {
	$args_top_kep_nelkul=array('posts_per_page' => 1);
}

$the_query_top_kep_nelkul = new WP_Query($args_top_kep_nelkul);
while ($the_query_top_kep_nelkul->have_posts()) : $the_query_top_kep_nelkul->the_post();
?>

<div class="top_kep_nelkul pb80">
	<div class="shell">
		<a href="<?php echo get_category_link(get_first_cat_id()); ?>" class="the_category cat_linkbox"><?php echo get_first_cat_name();?></a>
		<h2 class="the_title pt30 ttn fs67px"><a href="<?php echo get_permalink();?>" class="cdarkgrey"><?php the_title();?></a></h2>
		<?php include('author_box.php');?>
	</div>
</div>

<?php endwhile; wp_reset_postdata(); ?>