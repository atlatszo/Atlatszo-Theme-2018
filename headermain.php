<header id="header" class="header n100 bl pr z2">
	
	<nav id="desktop_menu" class="col-1 desktoponly">

		<ul id="mainmenu" class="mainmenu p10"><?php wp_nav_menu( array('container' => '', 'items_wrap' => '%3$s', 'theme_location' => 'headermenu', 'item_spacing' => 'discard')); ?></ul>

		<div class="submenus p10 pr dn">

			<div class="submenu sub-1 pt10">
				<ul class="the_menu sub-1">
					<?php wp_nav_menu( array('container' => '', 'items_wrap' => '%3$s', 'theme_location' => 'headermenu_1', 'item_spacing' => 'discard')); ?>
				</ul>
			</div><div class="submenu sub-2">
				<ul class="the_menu pt10">
					<?php wp_nav_menu( array('container' => '', 'items_wrap' => '%3$s', 'theme_location' => 'headermenu_2', 'item_spacing' => 'discard')); ?>
				</ul>
			</div><div class="submenu sub-3">
				<ul class="the_menu pt10">
					<?php wp_nav_menu( array('container' => '', 'items_wrap' => '%3$s', 'theme_location' => 'headermenu_3', 'item_spacing' => 'discard')); ?>
				</ul>
			</div><div class="submenu sub-4">
				<ul class="the_menu pt10">
					<?php wp_nav_menu( array('container' => '', 'items_wrap' => '%3$s', 'theme_location' => 'headermenu_4', 'item_spacing' => 'discard')); ?>
				</ul>
			</div><div class="submenu sub-5">
				<ul class="the_menu pt10">
					<?php wp_nav_menu( array('container' => '', 'items_wrap' => '%3$s', 'theme_location' => 'headermenu_5', 'item_spacing' => 'discard')); ?>
				</ul>
			</div><div class="submenu sub-6">
				<ul class="the_menu pt10">
					<?php wp_nav_menu( array('container' => '', 'items_wrap' => '%3$s', 'theme_location' => 'headermenu_6', 'item_spacing' => 'discard')); ?>
				</ul>
			</div><div class="submenu sub-7">
				<ul class="the_menu pt10">
					<?php wp_nav_menu( array('container' => '', 'items_wrap' => '%3$s', 'theme_location' => 'headermenu_7', 'item_spacing' => 'discard')); ?>
				</ul>
			</div><div class="submenu sub-8">
				<ul class="the_menu socialmenu pt10">
					<?php wp_nav_menu( array('container' => '', 'items_wrap' => '%3$s', 'theme_location' => 'headermenu_right', 'item_spacing' => 'discard')); ?>
				</ul>
			</div>

		</div>


	</nav>

	<nav id="mobile_menu" class="col-2 mobileonly">
		<a href="<?php echo get_bloginfo('url');?>" id="mobile_logo"><img src="<?php echo get_bloginfo('template_url');?>/i/atlatszo-logo.svg" width="83" height="33" alt="<?php echo get_bloginfo('name'); ?>" /></a><div id="mobile_right_side" class="ib"><a href="https://atlatszo.hu/tamogatom" id="support_link"><img id="the_red_heart" src="<?php echo get_bloginfo('template_url');?>/i/heart-red.svg" width="30" height="26" alt="Menu" /></a><a href="#" id="menuopener" class="pl15"><img id="hungry" src="<?php echo get_bloginfo('template_url');?>/i/big_kahuna_burger.svg" width="28" height="21" alt="Kinyitás" /><img id="satiated" src="<?php echo get_bloginfo('template_url');?>/i/close-grey.svg" width="22" height="22" alt="Bezárás" class="dn" /></a></div>

		<div id="the_mobile_menu" class="dn pa l0 r0 bwhite">
			<ul class="socialmenu the_menu p10"><?php wp_nav_menu( array('container' => '', 'items_wrap' => '%3$s', 'theme_location' => 'headermenu_right', 'item_spacing' => 'discard')); ?></ul>
			<ul class="mainmenu_mobil mainmenu mobilmenu-first p10"><?php wp_nav_menu( array('container' => '', 'items_wrap' => '%3$s', 'theme_location' => 'headermenu_1', 'item_spacing' => 'discard')); ?></ul>
			<ul class="accmenu mobil-1"><?php wp_nav_menu( array('container' => '', 'items_wrap' => '%3$s', 'theme_location' => 'mobilmenu_1', 'item_spacing' => 'discard')); ?></ul>
			<ul class="downmenu mobil-1"><?php wp_nav_menu( array('container' => '', 'items_wrap' => '%3$s', 'theme_location' => 'headermenu_2', 'item_spacing' => 'discard')); ?></ul>

			<ul class="accmenu mobil-2"><?php wp_nav_menu( array('container' => '', 'items_wrap' => '%3$s', 'theme_location' => 'mobilmenu_2', 'item_spacing' => 'discard')); ?></ul>
			<ul class="downmenu mobil-2"><?php wp_nav_menu( array('container' => '', 'items_wrap' => '%3$s', 'theme_location' => 'headermenu_3', 'item_spacing' => 'discard')); ?></ul>
			
			<ul class="accmenu mobil-3"><?php wp_nav_menu( array('container' => '', 'items_wrap' => '%3$s', 'theme_location' => 'mobilmenu_3', 'item_spacing' => 'discard')); ?></ul>
			<ul class="downmenu mobil-3"><?php wp_nav_menu( array('container' => '', 'items_wrap' => '%3$s', 'theme_location' => 'headermenu_4', 'item_spacing' => 'discard')); ?></ul>
			
			<ul class="accmenu mobil-4"><?php wp_nav_menu( array('container' => '', 'items_wrap' => '%3$s', 'theme_location' => 'mobilmenu_4', 'item_spacing' => 'discard')); ?></ul>
			<ul class="downmenu mobil-4"><?php wp_nav_menu( array('container' => '', 'items_wrap' => '%3$s', 'theme_location' => 'headermenu_5', 'item_spacing' => 'discard')); ?></ul>
			
			<ul class="accmenu mobil-5"><?php wp_nav_menu( array('container' => '', 'items_wrap' => '%3$s', 'theme_location' => 'mobilmenu_5', 'item_spacing' => 'discard')); ?></ul>
			<ul class="downmenu mobil-5"><?php wp_nav_menu( array('container' => '', 'items_wrap' => '%3$s', 'theme_location' => 'headermenu_6', 'item_spacing' => 'discard')); ?></ul>

			<ul class="accmenu mobil-6"><?php wp_nav_menu( array('container' => '', 'items_wrap' => '%3$s', 'theme_location' => 'mobilmenu_6', 'item_spacing' => 'discard')); ?></ul>
			<ul class="downmenu mobil-6"><?php wp_nav_menu( array('container' => '', 'items_wrap' => '%3$s', 'theme_location' => 'headermenu_7', 'item_spacing' => 'discard')); ?></ul>
		</div>

	</nav>


	<div class="cl"></div>
</header>