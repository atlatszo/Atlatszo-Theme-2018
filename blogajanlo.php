<?php if (have_rows('blogajanlo')) {
$i=1;
?>

<div class="blogajanlo">

	<h4 class="title fs16px cgrey ttn fmedium ls2 pt10"><div class="shell"><span class="n9 bl pt5">Átlátszó Blogok</span></div></h4>

	<div class="shell shell-2">
		<div class="n9">
		<?php
		while (have_rows('blogajanlo') ) : the_row();

			$blog_neve=get_sub_field('blog_neve');
			$blog_url=get_sub_field('blog_url');
			$blog_url_szin=get_sub_field('blog_url_szin');
			$blogpost_cim=get_sub_field('blogpost_cim');
			$blogpost_url=get_sub_field('blogpost_url');

		?><article class="n25 ib vt pt50 item-<?php echo $i;?>">
				<div class="inner pr50">
					<a href="<?php echo $blog_url; ?>" class="the_category fs15px p10 bred cwhite ib mb20 ls1 <?php echo $blog_url_szin; ?>"><?php echo $blog_neve; ?></a>
					<h2 class="the_title ttn fs18px lh180"><a href="<?php echo $blogpost_url; ?>" class="kszoveg cdarkgrey"><?php echo $blogpost_cim; ?></a></h2>
				</div>
			</article><?php $i++; endwhile; ?>
		</div>
	</div>

</div>

<?php } ?>