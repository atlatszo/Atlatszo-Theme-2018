<?php
$related_posts_acf=get_field('kapcsolodo_cikkek');
$related_posts_acf_external=get_field('kapcsolodo_kulso_cikkek');

if ($related_posts_acf) {

	// Delete current post ID from related posts array

	$this_id=get_the_ID();
	$delete_this=array_search($this_id, $related_posts_acf);
	if ($delete_this) {unset($related_posts_acf[$delete_this]);}

?>

	<div class="related_posts_single box bbsgrey3 mb20 pb20">
		<h4 class="fs12px fmedium ls05 cgrey mb20 ttu">Kapcsolódó</h4>

			<?php
			$p=1;
			foreach ($related_posts_acf as $the_acf_post) {
			?>

			<h5 class="fs15px mb40 ttn kszoveg item-<?php echo $p; ?>"><a href="<?php echo get_permalink($the_acf_post); ?>"><?php echo get_the_title($the_acf_post); ?></a></h5>

	<?php $p++; } ?>

	<?php if ($related_posts_acf_external) { ?>

			<?php
			if (have_rows('kapcsolodo_kulso_cikkek')) {
				$p=1;
				while (have_rows('kapcsolodo_kulso_cikkek') ) : the_row();
					$kulso_cikk_cime=get_sub_field('kulso_cikk_cime');
					$kulso_cikk_url=get_sub_field('kulso_cikk_url');
			?>

			<h5 class="fs15px mb40 ttn kszoveg item-<?php echo $p; ?>"><a href="<?php echo $kulso_cikk_url; ?>"><?php echo $kulso_cikk_cime; ?></a></h5>

	
		<?php $p++; endwhile; ?>
		<?php } ?>

	<?php } ?>

	</div>

	<?php
	} else {

	// Get manually inserted related posts from content by last blockquote HTML tag
	
	$content=get_the_content();
	$dom = new DomDocument();
	$dom->loadHTML('<?xml encoding="utf-8" ?>' . $content);
	$dom->preserveWhiteSpace = false;
	$blockquotes = $dom->getElementsByTagName('blockquote');

	// If found the blockquote element in the old the_content

	if ($blockquotes) {
		$related_posts_manually=[];
		foreach($blockquotes as $blockquote) {
		    array_push($related_posts_manually, $dom->saveHTML($blockquote));
		}

		$related_posts_manually = array_values(array_slice($related_posts_manually, -1))[0];
		//echo $related_posts_manually;
		//echo "<hr>";

		if (strpos($related_posts_manually, 'Kapcsol')!==FALSE) {
			//echo strip_tags($related_posts_manually);

			$dom_related = new DomDocument();
			$dom_related->loadHTML('<?xml encoding="utf-8" ?>' . $related_posts_manually);
			//$dom_related->preserveWhiteSpace = false;
			$rel_posts = $dom_related->getElementsByTagName('a');
			$related_posts_list=[];
			foreach($rel_posts as $atag) {
			    array_push($related_posts_list, $dom_related->saveHTML($atag));
			}
			//var_dump($related_posts_list);

		} else {

			// The last blockquote element is not related posts list

		}

	}

	if ($related_posts_list && count($related_posts_list)>0) { ?>

		<div class="related_posts_single box bbsgrey3 mb20 pb20">
			<h4 class="fs12px fmedium ls05 cgrey mb20 ttu">Kapcsolódó</h4>

				<?php
				$p=1;
				//echo "has related posts";

				foreach ($related_posts_list as $the_related_post_link) {

				?>

				<h5 class="fs15px mb40 ttn kszoveg item-<?php echo $p; ?>"><?php echo $the_related_post_link; ?></h5>

		<?php $p++; } ?>

		<?php if ($related_posts_acf_external) { ?>

				<?php
				if (have_rows('kapcsolodo_kulso_cikkek')) {
					$p=1;
					while (have_rows('kapcsolodo_kulso_cikkek') ) : the_row();
						$kulso_cikk_cime=get_sub_field('kulso_cikk_cime');
						$kulso_cikk_url=get_sub_field('kulso_cikk_url');
				?>

				<h5 class="fs15px mb40 ttn kszoveg item-<?php echo $p; ?>"><a href="<?php echo $kulso_cikk_url; ?>"><?php echo $kulso_cikk_cime; ?></a></h5>

		
			<?php $p++; endwhile; ?>
			<?php } ?>

		<?php } ?>

		</div>

	<?php } ?>

<?php } ?>

<?php if ($related_posts_acf_external && !$related_posts_acf && !$related_posts_list) { ?>

	<div class="related_posts_single box bbsgrey3 mb20 pb20">
		<h4 class="fs12px fmedium ls05 cgrey mb20 ttu">Kapcsolódó</h4>

			<?php
			if (have_rows('kapcsolodo_kulso_cikkek')) {
				$p=1;
				while (have_rows('kapcsolodo_kulso_cikkek') ) : the_row();
					$kulso_cikk_cime=get_sub_field('kulso_cikk_cime');
					$kulso_cikk_url=get_sub_field('kulso_cikk_url');
			?>

			<h5 class="fs15px mb40 ttn kszoveg item-<?php echo $p; ?>"><a href="<?php echo $kulso_cikk_url; ?>"><?php echo $kulso_cikk_cime; ?></a></h5>

	
		<?php $p++; endwhile; ?>
		<?php } ?>

	</div>

<?php } ?>