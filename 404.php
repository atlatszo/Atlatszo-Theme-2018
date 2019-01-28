<?php get_header(); ?>
<main class="s404">
	<div class="n100 box_404 box pr">
		<div class="inner n9 pt150 pr">
			<div class="shell">
				<div class="n50 pl50">
					<h4 class="fblack cdgrey fs15px ls1">404 404 404</h4>
					<div class="lead fs32px cdarkgrey lh160 fbold pt40 kszoveg">Sajnos valami hiba történt, kérjük térj vissza a főoldalra.</div>
					<a href="<?php echo bloginfo('url'); ?>" class="btn bred cwhite backtohome"><img src="<?php echo get_bloginfo('template_url'); ?>/i/arrow-right-white.svg" width="30" height="16" class="mr10" alt="Bezárás"/>Címlap</a>
				</div>
			</div>
		</div>
	</div>
</main>
<?php get_footer(); ?>