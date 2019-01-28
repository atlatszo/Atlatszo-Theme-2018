<?php
/*
Template name: Tamogatoi oldal
*/
get_header();
if (have_posts()) : while (have_posts()) : the_post(); ?>

<main class="page support">
<div class="shell">

	<div class="the_intro n100 mt40 mb40">
		<div class="n9">
			<img src="<?php bloginfo('template_url'); ?>/i/heart-red.svg" width="27" height="24" class="bl mb30 love" alt="heart" />
			<h1 class="the_title post_title fs48px ttn cwhite mb60 ls1 pr40"><?php the_title(); ?></h1>
			<aside class="share n25 ib vt"><div class="inner pr30"><?php include('share.php'); ?></div></aside><div class="the_excerpt n75 ib vt fs18px kszoveg lh200"><?php the_excerpt(); ?></div>
		</div>
	</div>

	<?php
	$tamogatoi_blokk_beszurasa=get_field('tamogatoi_blokk_beszurasa');
	if ($tamogatoi_blokk_beszurasa) {

		$tam_id=$tamogatoi_blokk_beszurasa;
		$tamogatoi_object = get_post($tamogatoi_blokk_beszurasa);
		$tamogatoi_blokk_nev=get_the_title($tam_id);
		$tamogatoi_blokk_content=$tamogatoi_object->post_content;
		$gomb_felirat=get_field('gomb_felirat', $tam_id);
		$gomb_url=get_field('gomb_url', $tam_id);
		$blokk_hivatkozasi_nev=get_field('blokk_hivatkozasi_nev', $tam_id);
		$kep_atlatszosag=get_field('kep_atlatszosag', $tam_id);
		$tamogatoi_blokk_content=apply_filters('the_content', $tamogatoi_blokk_content);
		$tamogatoi_kep=get_the_post_thumbnail_url($tam_id,'full');

	?>

	<style>
		.tamogatoi.in_content .tamogatoi.box:before {background:rgba(75, 75, 75, <?php echo $kep_atlatszosag; ?>);}
	</style>

	<div class="tamogatoi in_content bdgrey bbsgrey3 mb40">
		<div class="n100 tamogatoi box pt100 pr" style="background-image:url('<?php echo $tamogatoi_kep; ?>');">
			<div class="n9 pr">
				<div class="n50 pl50">
					<h4 class="fblack clgreylead fs15px ls1 ttu"><?php echo $tamogatoi_blokk_nev; ?></h4>
					<div class="lead fs32px cwhite lh160 fbold pt40 kszoveg"><?php echo $tamogatoi_blokk_content; ?></div>
					<a href="<?php echo $gomb_url; ?>" class="btn bred cwhite"><?php echo $gomb_felirat; ?></a>
				</div>
			</div>
		</div>
		<?php //include('tamogatoi-2.php'); ?>
	</div>

	<?php } ?>

	<div class="tamogatoi tamogatoi-lista bbsgrey3 mb40">
		<?php
		//include('tamogatoi-lista.php');
		?>
		<div class="n100 tamogatoi lista pt30 pr">
			<div class="n9">

				<ul class="tamogatoi_opciok minus0 n100 bl">

		<?php
		$b=1;
		//include('tamogatoi-lista.php');
				
		$tamogatas_utolso_blokk=get_field('tamogatas_utolso_blokk');
		$utolso_blokk_cime=get_field('utolso_blokk_cime');
		$utolso_blokk_leirasa=get_field('utolso_blokk_leirasa');
		$blokk_mailchimp_shortcode=get_field('blokk_mailchimp_shortcode');

		if (have_rows('tamogatas_tipusa')) {
			while (have_rows('tamogatas_tipusa') ) : the_row();

				$tamogatas_neve=get_sub_field('tamogatas_neve');
				$tamogatas_url=get_sub_field('tamogatas_url');
				$tamogatas_url_cel=get_sub_field('tamogatas_url_cel');
				$tamogatas_leirasa=get_sub_field('tamogatas_leirasa');
				if (!$tamogatas_url || $tamogatas_url=="") {$tamogatas_class="nolink";} else {$tamogatas_class="";}

		?><li class="cwhite col ib vt n25 plr10 mb40">
			<?php if ($tamogatas_class!="nolink") { ?>
						<h4 class="mb20"><a href="<?php echo $tamogatas_url; ?>" class="ac bred cwhite fblack p20 bl fs15px ls1 <?php echo $tamogatas_class;?>" target="<?php echo $tamogatas_url_cel; ?>"><?php echo $tamogatas_neve; ?></a></h4>
			<?php } else { ?>
						<h4 class="mb20"><span class="ac bred cwhite fblack p20 bl fs15px ls1 nolink"><?php echo $tamogatas_neve; ?></span></h4>			
			<?php } ?>
						<div class="fs18px kszoveg lh200"><p><?php echo $tamogatas_leirasa; ?></p></div>
					</li><?php $b++; ?><?php endwhile; ?>
			<?php }
			if ($tamogatas_utolso_blokk=="igen") {
			?>

					<li class="cwhite col fr n40 plr10 mb40">
						<h4 class="mb20 fs15px ac blred p20"><span class="o70 cwhite ls0"><?php echo $utolso_blokk_cime; ?></span></h4>
						<?php echo do_shortcode($blokk_mailchimp_shortcode); ?>
						<div class="fs18px kszoveg newsletter-description"><p><?php echo $utolso_blokk_leirasa; ?></p></div>
					</li>

					<li class="cl"></li>

				</ul>

				<div class="cl"></div>
			
			<?php } ?>

			</div>
		</div>
	</div>

	<div class="the_content n9">
		<div class="inner n75 fr kszoveg">
			<?php the_content(); ?>
		</div>
	</div>



</div>
</main>

<?php endwhile; endif; ?>
<?php get_footer(); ?>