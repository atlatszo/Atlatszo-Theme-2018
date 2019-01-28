<?php
$tovabbi_sztorik_blokk=get_field('tovabbi_sztorik');
$tovabbi_sztorik_szama=count($tovabbi_sztorik_blokk);

if ($tovabbi_sztorik_blokk) {
?>


<div class="tovabbi_sztorik_single">
<div class="inside n9">
	<h4 class="title fs16px cgrey ttn fmedium ls2 pt10 mb40"><div class="shell"><span class="n9 bl pt5">További sztorik</span></div></h4>

	<div class="n9">
		<div class="shell">

			<?php
			//echo "ennyi tovabbi sztori van beallitva: ".$tovabbi_sztorik_szama."<br>";
			if ($tovabbi_sztorik_szama==4) { ?>
				<div class="desktoponly">
					<?php foreach ($tovabbi_sztorik_blokk as $sztori) {
						$category_detail=get_the_category($sztori);
						$category_id=$category_detail[0]->term_id;
					?><article class="n25 ib vt">

							<div class="inner pr50">
								<a href="<?php echo get_category_link($category_id); ?>" class="the_category mb30 bl fs15px"><?php echo get_cat_name($category_id);?></a>
								<h3 class="the_title ttn"><a href="<?php echo get_permalink($sztori);?>" class="kszoveg cdarkgrey lh200 fs18px"><?php echo get_the_title($sztori);?></a></h3>
							</div>

					</article><?php } // foreach end ?>
				</div>
				<div class="mobileonly">
					<div id="tovabbi_sztorik_slider" class="owl-carousel">
						<?php foreach ($tovabbi_sztorik_blokk as $sztori) {
							$category_detail=get_the_category($sztori);
							$category_id=$category_detail[0]->term_id;
						?><article class="n25 ib vt">

								<div class="inner pr50">
									<a href="<?php echo get_category_link($category_id); ?>" class="the_category mb30 bl fs15px"><?php echo get_cat_name($category_id);?></a>
									<h3 class="the_title ttn"><a href="<?php echo get_permalink($sztori);?>" class="kszoveg cdarkgrey lh200 fs18px"><?php echo get_the_title($sztori);?></a></h3>
								</div>

						</article><?php } // foreach end ?>
					</div>
				</div>

			<?php } else { // END 4 stories ?>
			
				<?php

				// Fill remaining posts

				$maradek_sztori=4-$tovabbi_sztorik_szama;
				//echo "maradek sztori: ".$maradek_sztori."<br>";

				$this_cat=get_the_category();
				if (count($this_cat)>1) {
					$selected_cat_id=$this_cat[1]->term_id;
				} else {
					$selected_cat_id=$this_cat[0]->term_id;
				}

				$excluded_post_ids=$tovabbi_sztorik_blokk;
				array_push($excluded_post_ids, get_the_ID());
				$plus_posts=$tovabbi_sztorik_blokk;
				$args_maradek=array(
					'posts_per_page' => $maradek_sztori,
					'cat' => $selected_cat_id,
					'post__not_in' => $excluded_post_ids
				);
				$the_query_maradek = new WP_Query($args_maradek);
				while ($the_query_maradek->have_posts()) : $the_query_maradek->the_post();
					array_push($plus_posts, get_the_ID());
				endwhile; wp_reset_postdata();
				
				?>

				<div class="desktoponly">
					<?php foreach ($plus_posts as $sztori) {
						$category_detail=get_the_category($sztori);
						$category_id=$category_detail[0]->term_id;
					?><article class="n25 ib vt">

							<div class="inner pr50">
								<a href="<?php echo get_category_link($category_id); ?>" class="the_category mb30 bl"><?php echo get_cat_name($category_id);?></a>
								<h3 class="the_title ttn"><a href="<?php echo get_permalink($sztori);?>" class="kszoveg cdarkgrey lh200"><?php echo get_the_title($sztori);?></a></h3>
							</div>

					</article><?php } ?>					
				</div>

				<div class="mobileonly">
					<div id="tovabbi_sztorik_slider" class="owl-carousel">
						<?php foreach ($plus_posts as $sztori) {
							$category_detail=get_the_category($sztori);
							$category_id=$category_detail[0]->term_id;
						?><article class="n25 ib vt">

								<div class="inner pr50">
									<a href="<?php echo get_category_link($category_id); ?>" class="the_category mb30 bl"><?php echo get_cat_name($category_id);?></a>
									<h3 class="the_title ttn"><a href="<?php echo get_permalink($sztori);?>" class="kszoveg cdarkgrey lh200"><?php echo get_the_title($sztori);?></a></h3>
								</div>

						</article><?php } ?>
					</div>
				</div>

			<?php } ?>
		</div>
	</div>

</div>
</div>

<?php
} else {

	//echo "nincs beállítva tovabbi sztorik a rendszer válogat";

	$this_cat=get_the_category();
	//var_dump($this_cat);

	if (count($this_cat)>1) {
		$selected_cat_id=$this_cat[1]->term_id;
	} else {
		$selected_cat_id=$this_cat[0]->term_id;
	}

$args_tovabbi_single=array(
	'posts_per_page' => 4,
	'cat' => $selected_cat_id,
	'post__not_in' => array(get_the_ID())
);
$the_query_tovabbi_single = new WP_Query($args_tovabbi_single);
?>

<div class="tovabbi_sztorik_single">
<div class="inside n9">

	<h4 class="title fs16px cgrey ttn fmedium ls2 pt10 mb40"><span class="n9 bl pt5">További sztorik</span></h4>

	<div class="n9">
		<div class="shell">

			<div class="desktoponly">
				<?php while ($the_query_tovabbi_single->have_posts()) : $the_query_tovabbi_single->the_post(); ?><article class="n25 ib vt">

					<div class="inner pr50">
						<a href="<?php echo get_category_link($selected_cat_id); ?>" class="the_category mb30 bl"><?php echo get_cat_name($selected_cat_id);?></a>
						<h3 class="the_title ttn"><a href="<?php echo get_permalink();?>" class="kszoveg cdarkgrey lh200"><?php the_title();?></a></h3>
					</div>
				</article><?php endwhile; wp_reset_postdata(); ?>
			</div>

			<div class="mobileonly">
			<div id="tovabbi_sztorik_slider" class="owl-carousel">
				<?php while ($the_query_tovabbi_single->have_posts()) : $the_query_tovabbi_single->the_post(); ?><article class="n25 ib vt">

					<div class="inner pr50">
						<a href="<?php echo get_category_link($selected_cat_id); ?>" class="the_category mb30 bl"><?php echo get_cat_name($selected_cat_id);?></a>
						<h3 class="the_title ttn"><a href="<?php echo get_permalink();?>" class="kszoveg cdarkgrey lh200"><?php the_title();?></a></h3>
					</div>
				</article><?php endwhile; wp_reset_postdata(); ?>
			</div>
			</div>

		</div>
	</div>

</div>
</div>
<?php } ?>