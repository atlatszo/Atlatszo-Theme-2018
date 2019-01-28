<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<main class="page n9 single_post">
	<div class="shell">
	<div class="inner pt60 post_content">

		<h1 class="the_title post_title fs48px ttn mb60 ls1 pr40"><?php the_title(); ?></h1>

		<section class="the_content text">
			<?php the_content(); ?>
		</section>

	</div>
	</div>
</main>

<?php endwhile; endif; ?>
<?php get_footer(); ?>