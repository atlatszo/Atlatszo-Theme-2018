<?php
if (in_category(302) || get_post_format()=="video") {
	$video_format=true;
} else {
	$video_format=false;
}

$args_tamogatoi_1=array(
	'post_type' => 'tamogatoi',
	'posts_per_page' => 1,
	'tax_query' => array(
		array(
			'taxonomy' => 'tamogatoi-kategoria',
			'field'    => 'slug',
			'terms'    => 'kepes'
		)
	),
	'meta_query' => array(
		array(
			'key'     => 'blokk_hivatkozasi_nev',
			'value'   => 'tamogatoi-1'
		),
	)
);
$the_query_tamogatoi_1 = new WP_Query($args_tamogatoi_1);
while ($the_query_tamogatoi_1->have_posts()) : $the_query_tamogatoi_1->the_post();

	$gomb_felirat=get_post_meta(get_the_ID(), 'gomb_felirat', true);
	$gomb_url=get_post_meta(get_the_ID(), 'gomb_url', true);
	$kep_atlatszosag=get_post_meta(get_the_ID(), 'kep_atlatszosag', true);
	$kep_url=get_the_post_thumbnail_url(get_the_ID(), 'full');
	//get_the_post_thumbnail_url( null, 'post-thumbnail' );

if ($video_format) {
?>

<style>
	.tamogatoi.box:before {background:rgba(75, 75, 75, <?php echo $kep_atlatszosag; ?>);}
</style>

<?php } else { ?>

<style>
	.tamogatoi.box:before {background:rgba(255, 255, 255, <?php echo $kep_atlatszosag; ?>);}
</style>

<?php } ?>

<div class="n100 tamogatoi box pt150 pr" style="background-image:url('<?php echo $kep_url; ?>');">
	<div class="n9 pr">
		<div class="shell">
			<div class="n50 pl50">
				<h4 class="fblack cdgrey fs15px ls1 ttu"><?php the_title();?></h4>
				<div class="lead fs32px cdarkgrey lh160 fbold pt40 kszoveg"><?php the_content(); ?></div>
				<a href="<?php echo $gomb_url; ?>" class="btn bred cwhite"><?php echo $gomb_felirat; ?></a>
			</div>
		</div>
	</div>
</div>

<?php endwhile; wp_reset_postdata(); ?>