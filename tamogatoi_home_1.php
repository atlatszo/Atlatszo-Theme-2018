<section class="n100 section-tamogatoi">
	<?php
	$tamogatoi_post=get_field('tamogatoi_blokk_1');

	$args_tamogatoi_1=array(
		'post_type' => 'tamogatoi',
		'posts_per_page' => 1,
		'p' => $tamogatoi_post[0]
	);
	$the_query_tamogatoi_1 = new WP_Query($args_tamogatoi_1);
	while ($the_query_tamogatoi_1->have_posts()) : $the_query_tamogatoi_1->the_post();

		$gomb_felirat=get_post_meta(get_the_ID(), 'gomb_felirat', true);
		$gomb_url=get_post_meta(get_the_ID(), 'gomb_url', true);
		$kep_atlatszosag=get_post_meta(get_the_ID(), 'kep_atlatszosag', true);
		$kep_url=get_the_post_thumbnail_url(get_the_ID(), 'full');

	?>

	<style>
		.tamogatoi.box:before {background:rgba(255, 255, 255, <?php echo $kep_atlatszosag; ?>);}
	</style>

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
</section>