<?php
$args_ajanlo=array(
	'post_type' => 'tamogatoi',
	'posts_per_page' => 1,
	'tax_query' => array(
		array(
			'taxonomy' => 'tamogatoi-kategoria',
			'field'    => 'slug',
			'terms'    => 'leaks'
		)
	),
	'meta_query' => array(
		array(
			'key'     => 'blokk_hivatkozasi_nev',
			'value'   => 'magyarleaks'
		)
	)
);
$the_query = new WP_Query($args_ajanlo);
?>

<?php while ($the_query->have_posts() ) : $the_query->the_post();

	$gomb_felirat=get_post_meta(get_the_ID(), 'gomb_felirat', true);
	$gomb_url=get_post_meta(get_the_ID(), 'gomb_url', true);
	$kep_atlatszosag=get_post_meta(get_the_ID(), 'kep_atlatszosag', true);
	$kep_url=get_the_post_thumbnail_url(get_the_ID(), 'full');
?>

<style>
	.ajanlo.box:before {background:rgba(255, 255, 255, <?php echo $kep_atlatszosag; ?>);}
</style>

<div class="n9">
<div class="ajanlo mt30 pt150 box pr" style="background-image:url('<?php echo $kep_url; ?>');">
		<div class="n50 fr pr">
			<h4 class="lead cdgrey ls1 fs15px mb40 fblack"><?php the_title(); ?></h4>
			<div class="the_content fs32px kszoveg fbold mb50"><?php the_content(); ?></div>
			<a href="<?php echo $gomb_url; ?>" class="btn bred cwhite"><?php echo $gomb_felirat; ?></a>
		</div>
	<div class="cl"></div>
</div>
</div>

<?php endwhile; wp_reset_postdata(); ?>