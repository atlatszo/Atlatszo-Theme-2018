<aside class="fl n25 pr30">
	<div class="desktoponly share_box"><?php include('share.php') ?></div>
	<?php include('author_sidebar.php') ?>
	<?php include('post_date_sidebar.php') ?>

        <?php /* if ( is_active_sidebar( 'korona-widget-desktop' ) ) : */ ?>
                <?php /* dynamic_sidebar( 'korona-widget-desktop' ); */ ?>
        <?php /* endif; */ ?>

        <div id="korona-widget-desktop" class="pb20 bbsgrey3 mb20"><iframe src="https://cdn.atlatszo.hu/korona-portrait.html?a=<?php echo date('d'); ?>" style="width: 100%; height: 579px; border: 0;"></iframe></div>

	<div class="mobileonly share_box"><?php include('share.php') ?></div>
	<?php include('related_single.php') ?>
	<?php include('social.php') ?>
</aside>
