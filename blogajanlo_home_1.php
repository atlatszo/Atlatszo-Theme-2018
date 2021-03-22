<?php
$top_sztori_alatti_tipus=get_field('top_sztori_alatti_tipus');
if ($top_sztori_alatti_tipus=="blogajánló") {
	$blogposts_no=36;
	$section_class="has_first_blogajanlo";
} else {
	$blogposts_no=32;
	$section_class="";
}
?>
<section class="n100 section-blogajanlo section-blogajanlo-1 <?php echo $section_class; ?>">
	<div class="blogajanlo">

		<h4 class="title fs16px cgrey ttn fmedium ls2 pt10"><div class="shell"><span class="n9 bl pt5">Átlátszó Blogok</span></div></h4>

		<div class="shell shell-1">
			<div class="n9">
				<?php trans_list_with_ro('https://dummy.atlatszo.hu/multifeed', $blogposts_no); ?>
			</div>
		</div>
	</div>
</section>
