<?php get_header();?>

<main class="cat">
<div class="shell">
	
	<div class="the_search_box intro pt10 bbsgrey3">
		<div class="inner n9">
			<h1 class="search_title mb5"><form method="get" class="ib vm n100" action="<?php bloginfo('home'); ?>/"><input class="submit_again vm mr20" type="submit" value="" /><input type="text" class="vm the_keyword n80" name="s" value="<?php echo $_GET['s']; ?>" /></form></h1>
		</div>
	</div>

	<div class="result_posts">

	<?php if ( have_posts() ) : ?>


		<?php while ( have_posts() ) : the_post(); 

		$title  = get_the_title();
		$keys= explode(" ",$s);
		$title  = preg_replace('/('.implode('|', $keys) .')/iu', '<span class="highlight">\0</span>',  $title);

		$excerpt  = get_the_excerpt();
		$excerpt=str_replace('&nbsp; ', '', $excerpt);
		$keys_excerpt= explode(" ",$s);
		$excerpt=preg_replace('/('.implode('|', $keys_excerpt) .')/iu', '<span class="highlight">\0</span>',  $excerpt);

		?><article class="the_post n100 bbsgrey3 pt50 bl item-<?php echo $i;?>">
			<div class="inner n9">
				<a href="<?php echo get_category_link(get_first_cat_id()); ?>" class="the_category mb20 bl"><?php echo get_first_cat_name();?></a>
				<h3 class="the_title ttn mb40"><a href="<?php echo get_permalink();?>" class="cdarkgrey fs48px"><?php echo $title; ?></a></h3>
				
				<?php if (has_post_thumbnail()) { ?>
					<div class="img100 the_featimage n33 ib"><a href="<?php echo get_permalink();?>" class="bl fade"><?php the_post_thumbnail('small_169', array('class' => 'pr30')); ?></a></div><div class="mb30 n66 ib vt">
						<div class="the_excerpt kszoveg cdarkgrey lh140 fs20px ls05 mb30"><?php echo $excerpt; ?></div>
						<?php include('author_box.php');?>
					</div>
				<?php } else { ?>
					<div class="the_excerpt kszoveg cdarkgrey lh140 fs20px ls05 mb30"><?php echo $excerpt; ?></div>
					<?php include('author_box.php');?>
				<?php } ?>

			</div>
		</article><?php endwhile; ?>

	

	<?php if (function_exists("pagination")) {pagination($wp_query->max_num_pages);} ?>

	<?php else: ?>
		
		<div class="noresults pt100">
			<div class="inner n9">

				<h1><?php _e('Elnézést, de nincs találat, próbálkozz egy másik kulcsszóval.'); ?></h1>

			</div>
		</div>

	<?php endif; ?>

	</div>

</div>
</main>
<?php get_footer();?>