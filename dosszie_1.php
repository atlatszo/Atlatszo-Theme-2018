<section class="n100 section-cikkek-3 dosszie_1">
	<?php
	$dosszie_kategoria=get_field('dosszie_kategoria');
	if (!$dosszie_kategoria) {$dosszie_kategoria=1;}
	$dosszie_cikkek=get_field('dosszie_cikkek');
	$i=1;
	$dosszie_obj=get_term($dosszie_kategoria);
	$dosszie_nev=$dosszie_obj->name;
	?>
	<div class="harmadik_3_cikk pt60 n9">
		<div class="shell">

			<a href="<?php echo get_term_link($dosszie_kategoria); ?>" class="the_category mb30 bl fs20px cwhite bred p10 ib"><?php echo $dosszie_nev; ?></a>

			<?php foreach ($dosszie_cikkek as $dosszie_cikk_id) { ?><article class="n50 ib vt mb30 pb30 item-<?php echo $i; ?>">
				<div class="inner pr50">
					<div class="img100 the_featimage n33 ib"><a href="<?php echo get_permalink($dosszie_cikk_id);?>" class="bl fade"><?php echo get_the_post_thumbnail($dosszie_cikk_id, 'small_169', array('class' => 'pr20 desktoponly')); ?><?php echo get_the_post_thumbnail($dosszie_cikk_id, 'square_medium', array('class' => 'pr10 mobileonly')); ?></a></div><h3 class="the_title ttn n66 ib vt fs24px lh140 fblack"><a href="<?php echo get_permalink($dosszie_cikk_id);?>" class="cdarkgrey"><?php echo get_the_title($dosszie_cikk_id);?></a></h3>
				</div>
			</article><?php $i++; } // END FOREACH ?>

		</div>
	</div>

</section>