<section class="n100 section-video">
	<?php
	$args_video=array('p' => $videos_tartalom[0]);
	$the_query_video = new WP_Query($args_video);
	?>
	<div class="video">
		
		<h4 class="title fs16px bdgrey cwhite ttn fmedium ls2 pt10"><div class="shell"><span class="n9 bl pt5">Átlátszó VIDEO</span></div></h4>
		
		<?php while ($the_query_video->have_posts()) : $the_query_video->the_post(); ?>
			<article class="pr ac item-<?php echo $i;?>">
				<div class="over_featimage the_content pa n100 h100 z4">
					<div class="vam">
						<div class="shell">
							<div class="the_image mb60"><a href="<?php echo get_permalink();?>"><img src="<?php bloginfo('template_url');?>/i/arrow-circle-right-white.svg" class="ma bl" width="155" height="155" alt="" /></a></div>
							<a href="<?php echo get_category_link(get_first_cat_id()); ?>" class="the_category mb20 bred cwhite ib p10 ac"><?php echo get_first_cat_name();?></a>
							<h3 class="the_title ttn n30 ma ac"><a href="<?php echo get_permalink();?>" class="cwhite fs24px"><?php the_title();?></a></h3>
						</div>
					</div>
				</div>
				<div class="img100 the_featimage"><?php the_post_thumbnail('full', array('class' => 'p0')); ?></div>
			</article>
		<?php endwhile; wp_reset_postdata(); ?>

	</div>
</section>