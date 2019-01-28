<footer id="footer" class="b80 cwhite pr z2 cle">
	<div class="n9">
		

			<div class="footer footer1">
			<div class="minus10">

				<div class="col col1 fl n33 plr10">

					<h3 class="mb40 pb40 ttn fblack">KiMitTud</h3>
					<?php // https://blog.atlatszo.hu/kimittud.xml // 5 db ?>
					<p class="mb40">Legutóbb teljesült adatigénylések:</p>

					<ul>
						<?php dynamic_sidebar('sidebar-footer-2'); ?>
					</ul>

				</div>

				<div class="col col2 fl n33 plr10">

					<h3 class="mb40 pb40 ttn fblack">Üvegzseb figyelő</h3>
					<p class="mb40">Legutóbb megváltozott üvegzsebek:</p>
					<ul>

						<?php echo bag_tracker(5); ?>

					</ul>
				</div>
				
				<div class="col col3 fl n33 plr10">

					<h3 class="mb40 pb40 ttn fblack"><?php _e('Archívum', 'atlatszo'); ?></h3>
						<ul class="the_archive archive_by_month mb30">
						<?php
						$the_current_month=date('n');
						$args_archive_by_month=array(
							'limit' => $the_current_month
						);
						wp_get_archives($args_archive_by_month); ?>
						</ul>

						<ul class="the_archive archive_by_year">
						<?php
						$args_archive_by_year=array(
							'type' => 'yearly'
						);
						wp_get_archives($args_archive_by_year); ?>
					</ul>

				</div>

				<div class="cl"></div>

			</div>
			</div>

			<div class="footer footer2 pt25 mt50">

				<div class="shell">
				<div class="ib n30 copyright vm"><img src="<?php bloginfo('template_url')?>/i/atlatszo-logo-footer.svg" width="116" height="47" alt="<?php bloginfo('name')?>" /></a></div><div class="footermenu ib n70 vm">
					<ul class="footermenu ar">
						<?php wp_nav_menu( array('container' => '', 'items_wrap' => '%3$s', 'theme_location' => 'footermenu', 'item_spacing' => 'discard')); ?>
					</ul>
				</div>
				</div>

			</div>

		</div>

</footer>

<?php wp_footer(); ?>

	<script src="<?php bloginfo('template_url')?>/j/swp/js/jquery.swipebox.js"></script>
	<link href="<?php bloginfo('template_url')?>/j/owl/owl.carousel.min.css" rel="stylesheet">
    <link href="<?php bloginfo('template_url')?>/j/owl/owl.theme.default.min.css" rel="stylesheet">
	<script src="<?php bloginfo('template_url')?>/j/owl/owl.carousel.min.js"></script>

	<script type="text/javascript">
	jQuery(document).ready(function($){
		
		// Tovabbi sztorik slider on mobile

		$('#tovabbi_sztorik_slider').owlCarousel({
			items: 1
		});

		//Swipebox

		//$("a[rel='swipebox'], a.swipebox, .wp-caption a").swipebox({useCSS:true, useSVG:false});

		$(".accmenu a").click(function(e) {
			e.preventDefault();
		});

		$(".accmenu").click(function(e) {
			e.preventDefault();	
			$('.downmenu').hide();
			$('.accmenu').removeClass('active');
			$(this).addClass('active');
			$(this).next().slideToggle('medium', function() {
			});
		});

		// 18 warning

		$("#was18").click(function(e) {
			e.preventDefault();
			$('#okm18').remove();
		});

		// Main menu opener

		$("#menuopener").click(function(e) {
			e.preventDefault();
			$('#hungry').toggle();
			$('#satiated').toggle();
			$('#the_red_heart').toggle();
			$('#the_mobile_menu').slideToggle('medium', function() {
			});
		});

		// Search box opener

		$("#close_the_search, .submenu li.search a, .socialmenu li.search a").click(function(e) {
			e.preventDefault();
			/*$('#hungry').toggle();
			$('#satiated').toggle();
			$('#the_red_heart').toggle();*/
			$('#the_searchform').slideToggle('medium', function() {
			});
		});
		
		//scroll to anchor from sidebar

		$(".alink").click(function() {
			$('#side .alink').removeClass('active');
			$(this).addClass('active');
			var aid=$(this).attr('itemprop');
			var aTag = $("h2[id='"+aid+"']");
			$("html, body").animate({ scrollTop: aTag.offset().top }, 'slow');
		});

		// Submenu

		$("#mainmenu li:not(.lastmenu) a").click(function(e) {
			e.preventDefault();
			$('div.submenus').slideToggle('medium', function() {
			});

			/*$('#side .alink').removeClass('active');
			$(this).addClass('active');
			var aid=$(this).attr('itemprop');
			var aTag = $("h2[id='"+aid+"']");
			$("html, body").animate({ scrollTop: aTag.offset().top }, 'slow');*/

		});

		window.onscroll = function(){
			  if (window.pageYOffset<190) {
				//stick on
				if (jQuery("body").hasClass("sticky")) {jQuery("body").removeClass("sticky");}
			  } else {
				  //sticky off
				  if (jQuery("body").hasClass("sticky")) {} else {jQuery("body").addClass("sticky");}
			  }
		};

	});
	</script>
</body>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-24025028-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'UA-24025028-1', { 'anonymize_ip': true });
</script>
</html>