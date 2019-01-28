<?php get_header();?>

<main class="cat">
	
	<?php
	$post = $posts[0]; // date hack

	if (is_day()) {
		$prefix=get_the_time(__('F jS, Y'));
	} elseif (is_month()) {
		$prefix=get_the_time(__('F, Y'));
	} elseif (is_year()) {
		$prefix=get_the_time(__('Y'));
	}
	?>

	<div class="the_archive_box intro pt20 bbsgrey3 mb40">
		<div class="inner n9">
			<div class="shell">
				<h1 class="archive_title mb10"><div class="the_category cat_linkbox"><?php echo $prefix; ?></div></h1>
			</div>
		</div>
	</div>

	<?php if ( have_posts() ) : ?>

	<div class="cat_posts">
		<div class="shell">

		<?php while ( have_posts() ) : the_post(); ?><article class="the_post n100 bbsgrey3 pt50 bl item-<?php echo $i;?>">
			<div class="inner n9">
				<a href="<?php echo get_category_link(get_first_cat_id()); ?>" class="the_category mb20 bl"><?php echo get_first_cat_name();?></a>
				<h3 class="the_title ttn mb40"><a href="<?php echo get_permalink();?>" class="cdarkgrey fs48px"><?php the_title();?></a></h3>
				
				<?php if (has_post_thumbnail()) { ?>
					<div class="img100 the_featimage n33 ib"><a href="<?php echo get_permalink();?>" class="fade bl"><?php the_post_thumbnail('small_169', array('class' => 'pr30')); ?></a></div><div class="the_text mb30 n66 ib vt">
						<div class="the_excerpt kszoveg cdarkgrey lh140 fs20px ls05 mb30"><?php echo get_the_excerpt(); ?></div>
						<?php include('author_box.php');?>
					</div>
				<?php } else { ?>
					<div class="the_excerpt kszoveg cdarkgrey lh140 fs20px ls05 mb30"><?php echo get_the_excerpt(); ?></div>
					<?php include('author_box.php');?>
				<?php } ?>

			</div>
		</article><?php endwhile; ?>

		</div>
	</div>

	<?php if (function_exists("pagination")) {pagination($wp_query->max_num_pages);} ?>

	<?php else: ?>

		<p><?php _e('Elnézést, de nincs találat.'); ?></p>

	<?php endif; ?>

</main>
<?php get_footer();?>