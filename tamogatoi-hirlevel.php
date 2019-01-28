<?php
$args_tamogatoi_2=array(
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
			'value'   => 'iratkozz_fel'
		)
	)
);
$the_query_tamogatoi_2=new WP_Query($args_tamogatoi_2);
while ($the_query_tamogatoi_2->have_posts()) : $the_query_tamogatoi_2->the_post();

	$gomb_felirat=get_post_meta(get_the_ID(), 'gomb_felirat', true);
	$gomb_url=get_post_meta(get_the_ID(), 'gomb_url', true);
	$kep_atlatszosag=get_post_meta(get_the_ID(), 'kep_atlatszosag', true);
	$kep_url=get_the_post_thumbnail_url(get_the_ID(), 'full');
?>

<style>
	.tamogatoi.tamogatoi-hirlevel.box:before {background:rgba(255, 255, 255, <?php echo $kep_atlatszosag; ?>);}
</style>

<div class="n100 tamogatoi tamogatoi-hirlevel box pt150 pr" style="background-image:url('<?php echo $kep_url; ?>');">
	<div class="n9 pr">
		<div class="shell">
			<div class="n50 pl50">
				<strong class="fblack cdgrey fs15px ls1 ttu"><?php the_title();?></strong>
				<div class="lead fs32px cdarkgrey lh160 fbold pt40 kszoveg"><?php the_content(); ?></div>
				<?php //echo do_shortcode('[mc4wp_form id="24563"]'); ?>
				<a href="<?php echo $gomb_url; ?>" class="btn bred cwhite"><?php echo $gomb_felirat; ?></a>
			</div>
		</div>
	</div>
</div>
<?php endwhile; wp_reset_postdata(); ?>