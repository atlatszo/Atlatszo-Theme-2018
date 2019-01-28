<?php get_header();?>

<main class="cat">
<div class="shell">
	
	<?php
	$tax=get_tag(get_queried_object()->term_id);
	$tax_name=$tax->name;
	$cat_image=get_field('fokep', "tag_".get_queried_object()->term_id);
	if ($cat_image) {
		$cat_image_class="cat_image_true";
	?>

	<style>
		body.archive .the_category_box {position:relative;display:block;}
		body.archive .the_category_box:before {content:"";opacity: 0.5;background-image:url('<?php echo $cat_image['url']; ?>');background-size:contain;background-repeat:no-repeat;background-position:110% 0;
	  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  position: absolute;
  z-index:0;}
	</style>

	<?php } else {$cat_image_class="cat_image_false";} ?>

	<div class="the_category_box <?php echo $cat_image_class; ?> intro pt100 bbsgrey3 mb40">
		<div class="inner n9">
			<h1 class="cat_title tax_title mb30"><a href="<?php echo get_tag_link($tax); ?>" class="the_category cat_linkbox"><?php echo $tax_name; ?></a></h1>
			<h2 class="category-description fs32px cdarkgrey kszoveg ttn lh160"><?php echo tag_description(); ?></h2>
		</div>
	</div>

	<?php if ( have_posts() ) : ?>

	<div class="cat_posts">

		<?php while ( have_posts() ) : the_post();
		$excerpt=get_the_excerpt();
		$excerpt=str_replace('&nbsp; ', '', $excerpt);	
		?><article class="the_post n100 bbsgrey3 pt50 bl item-<?php echo $i;?>">
			<div class="inner n9">
				<a href="<?php echo get_category_link(get_first_cat_id()); ?>" class="the_category mb20 bl"><?php echo get_first_cat_name();?></a>
				<h3 class="the_title ttn mb40"><a href="<?php echo get_permalink();?>" class="cdarkgrey fs48px"><?php the_title();?></a></h3>
				
				<?php if (has_post_thumbnail()) { ?>
					<div class="img100 the_featimage n33 ib"><a href="<?php echo get_permalink();?>" class="fade bl"><?php the_post_thumbnail('small_169', array('class' => 'pr30')); ?></a></div><div class="mb30 n66 ib vt">
						<div class="the_excerpt kszoveg cdarkgrey lh140 fs20px ls05 mb30"><?php echo $excerpt; ?></div>
						<?php include('author_box.php');?>
					</div>
				<?php } else { ?>
					<div class="the_excerpt kszoveg cdarkgrey lh140 fs20px ls05 mb30"><?php echo $excerpt; ?></div>
					<?php include('author_box.php');?>
				<?php } ?>

			</div>
		</article><?php endwhile; ?>

	</div>

	<?php if (function_exists("pagination")) {pagination($wp_query->max_num_pages);} ?>

	<?php else: ?>

		<p><?php _e('Elnézést, de nincs találat.'); ?></p>

	<?php endif; ?>

</div>
</main>
<?php get_footer();?>