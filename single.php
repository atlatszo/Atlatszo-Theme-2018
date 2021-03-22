<?php get_header(); ?>
<main class="single">

	<?php if (have_posts()) while ( have_posts() ) : the_post();

	$cikk_18_ev=get_field('cikk_18_even_felulieknek');
	if ($cikk_18_ev && $cikk_18_ev=="igen") {
		$figyelmezteto_szoveg_18 = get_field('figyelmezteto_szoveg_18', 'option');
	?>

	<div id="okm18" class="h100 n100 z9 pf t0 b0 l0 r0 bdgrey">
		<div class="vam ac n33 ma">
			<strong class="fs67px mb50 cwhite title18 ib">18</strong>
			<p class="fs18px cwhite lh200 ac mb50"><?php echo $figyelmezteto_szoveg_18; ?></p>
			<a href="#" id="was18" class="bred btn cwhite bl n100 mb20">ELMÚLTAM 18</a>
			<a href="<?php echo get_bloginfo('home');?>" id="not18" class="bgrey btn cwhite bl n100">MÉG NEM VAGYOK 18</a>
		</div>
	</div>

	<?php }
	$content=get_the_content();

	// Video category only

	if (in_category(302)) {

		// Search iframe code and extract to $video_iframe variable
		
		preg_match('/<iframe.*src=\"(.*)\".*><\/iframe>/isU', $content, $video_iframe);
		$video_iframe[0]=str_replace('http:', 'https:', $video_iframe[0]);
		//echo $video_iframe[0]; //only the <iframe ...></iframe> part
		//echo $video_iframe[1]; //the src part. (http://www.youtube.com/embed/IIYeKGNNNf4?rel=0)

	}

	// Get manually inserted related posts from content by last blockquote HTML tag

	$dom = new DomDocument();
	$dom->loadHTML('<?xml encoding="UTF-8">'.$content);
	$dom->preserveWhiteSpace = false;
	$blockquotes = $dom->getElementsByTagName('blockquote');

	// If found the blockquote element in the old the_content

	if ($blockquotes) {

		$related_posts_manually=[];
		foreach($blockquotes as $blockquote) {
		    array_push($related_posts_manually, $dom->saveHTML($blockquote));
		}

		$related_posts_manually = array_values(array_slice($related_posts_manually, -1))[0];

		if (strpos($related_posts_manually, 'Kapcsol')!==FALSE) {
		
			//echo $related_posts_manually;
			//echo "<hr>";

		    //$element = $dom->getElementById('some_id');
    		//$element = $dom->getElementsByTagName('blockquote')->item(0);
    		//$element = $dom->getElementsByTagName('blockquote');

    		// Remove the last Related posts list from the_content (and move to sidebar in related_single.php)

			$blockquote_count = $dom->getElementsByTagName('blockquote')->length;
			//echo "blockquote_count: ".$blockquote_count;
			$remove_this=$blockquote_count-1;
			//echo "remove this: ".$remove_this;
			$element=$dom->getElementsByTagName('blockquote')->item($remove_this);
			$element->parentNode->removeChild($element);

			//echo "delete this blockquote element: ";
			//var_dump($element);

			// Remove <?xml encoding="UTF-8"> and fix UTF-8 encoding

			foreach ($dom->childNodes as $item) {
			    if ($item->nodeType == XML_PI_NODE) {
			        $dom->removeChild($item); // remove hack
					$dom->encoding = 'UTF-8'; // insert proper
			    }
			}

			$content=$dom->saveHTML();

			// Extract <a> lists only

			$dom_related = new DomDocument();
			$dom_related->loadHTML('<?xml encoding="UTF-8">'.$related_posts_manually);


			//$dom_related->preserveWhiteSpace = false;
			$rel_posts = $dom_related->getElementsByTagName('a');
			$related_posts_list=[];
			foreach($rel_posts as $atag) {
			    array_push($related_posts_list, $dom_related->saveHTML($atag));
			}
			//var_dump($related_posts_list);

		} else {

			// The last blockquote element is not a related posts list, so nothing to do

		}

	}


	?>
		
		<div class="post_content">

			<?php if (get_post_format()=="image" && has_post_thumbnail()) { ?>

				<section class="heading n9">		
					<a href="<?php echo get_category_link(get_first_cat_id()); ?>" class="the_category cat_linkbox mt40"><?php echo get_first_cat_name();?></a>
					<h1 class="the_title post_title fs48px ttn cdarkgrey mb40 mt30"><?php the_title(); ?></h1>
				</section>
				<section class="featimage img100 mb40"><?php the_post_thumbnail('full'); ?></section>
			
			<?php } elseif (get_post_format()=="video" || in_category(302)) { ?>

				<section class="heading n9">		
					<a href="<?php echo get_category_link(get_first_cat_id()); ?>" class="the_category cat_linkbox mt40"><?php echo get_first_cat_name();?></a>
					<h1 class="the_title post_title fs48px ttn cdarkgrey mb40 mt30"><?php the_title(); ?></h1>
				</section>

				<?php if ($video_iframe) { ?>

				<div class="videoWrapper mb30">
					<?php echo $video_iframe[0]; ?>
				</div>

				<?php } else { ?>

					<section class="featimage img100 mb40"><?php the_post_thumbnail('full'); ?></section>

				<?php } ?>

			<?php } else { ?>

				<section class="heading n9">
					<a href="<?php echo get_category_link(get_first_cat_id()); ?>" class="the_category cat_linkbox mt40"><?php echo get_first_cat_name();?></a>
					<h1 class="the_title post_title fs48px ttn cdarkgrey mb60 mt30"><?php the_title(); ?></h1>
				</section>

			<?php } ?>

			<div class="n9 outer pr">

				<?php get_sidebar(); ?>

				<section class="the_content first-section fr n75 pr">
					<?php

					// Clean the_content code because of php domelement
					
					$content_with_filters=apply_filters('the_content', $content);
					$content_with_filters=str_replace('<p>&nbsp;
</p>', '', $content_with_filters);
					$content_with_filters=str_replace('<p>&nbsp;</p>', '', $content_with_filters);
					$content_with_filters=str_replace('</body></html></p>', '', $content_with_filters);
					$content_with_filters=str_replace('<p><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd"><br />
<html><body>', '', $content_with_filters);
					$content_with_filters=str_replace('http://player.vimeo.com', 'https://player.vimeo.com', $content_with_filters);

					//display modified the_content();

					echo $content_with_filters;
					//the_content();
					if (has_tag()) {
					?>
					
						<div id="the_tags" class="ttu cgrey ls1 pt40"><?php the_tags( '', ' <strong class="separator plr10 cgrey">/</strong> ', '' ); ?></div>

					<?php } ?>

					<div id="the_share_under" class="ttu cgrey ls1"><?php include('share.php'); ?></div>

					<?php
					$facebook_hozzaszolasok=get_field('facebook_hozzaszolasok');
					// original if statement was the one commented below, but they asked to disable fb comments. uncomment to restore original state
					// if ($facebook_hozzaszolasok && $facebook_hozzaszolasok=="igen") {
					if (false) {
						// https://www.facebook.com/atlatszo.hu/posts/1796099610459547
					?>
					<div class="facebook_comments_trigger">
						<span class="trigger_title p10 cwhite fblack fs12px vm ib n80 bgrey">Szólj hozzá a cikkünkhöz!</span><a href="#" id="go_comment" class="bred fs12px cwhite p10 vm ib n20 ac"><img src="<?php bloginfo('template_url')?>/i/comment.svg" width="11" height="15" class="vm mr10" alt="<?php _e('Szólj hozzá a cikkünkhöz!', 'atlatszo');?>" /><span class="vm ttu fblack fs12px cwhite">HOZZÁSZÓLOK</span></a>
					</div>

					<div id="the_facebook_comments" class="dn mt20">

						<div id="fb-root"></div> 
						<script>

						  window.fbAsyncInit = function() {
						    FB.init({
						      appId      : '985094288330865',
						      cookie     : true,
						      xfbml      : true,
						      version    : 'v3.0'
						    });
						      
						    FB.AppEvents.logPageView();   
						      
						  };

							(function(d, s, id) { 
						var js, fjs = d.getElementsByTagName(s)[0]; 
						if (d.getElementById(id)) return; 
						js = d.createElement(s); js.id = id; 
						//js.src = 'https://connect.facebook.net/hu_HU/sdk.js#xfbml=1&version=v3.0'; 
						js.src = 'https://connect.facebook.net/hu_HU/sdk.js#xfbml=1&version=v3.0&appId=985094288330865'; // For moderation app secret= 35501b05b17bbe7e3f807ad5d1a59266
						fjs.parentNode.insertBefore(js, fjs); 
						}(document, 'script', 'facebook-jssdk'));</script>

						<!--<span class="fb-comments-count" data-href="<?php //the_permalink(); ?>"></span> hozzászólás-->
						<div class="fb-comments" data-href="<?php the_permalink(); ?>" data-width="100%" data-numposts="10" data-include-parent="true" data-order-by="social" data-colorscheme="light"></div>

					</div>

					<?php } else { ?>

						<div class="pt40"></div>

					<?php } ?>

                                        <?php /* if ( is_active_sidebar( 'korona-widget-mobile' ) ) : */ ?>
                                          <?php /* dynamic_sidebar( 'korona-widget-mobile' ); */ ?>
                                        <?php /* endif; */ ?>

                                        <div id="korona-widget-mobile" class="n100 pt40"><iframe src="https://cdn.atlatszo.hu/korona-portrait.html?a=<?php echo date('d'); ?>" style="width: 100%; height: 604px; border: 0;"></iframe></div>

				</section>

			</div>

			<?php include('tovabbi_sztorik_single.php'); ?>

			<div class="cl"></div>
		</div>

	<?php endwhile; ?>



	<div class="cl"></div>

	<div class="tamogatoi-single-last-item"><?php include('tamogatoi.php'); ?></div>
	
</main>
<script type="text/javascript">
	
	jQuery(document).ready(function($){
		$("#go_comment").click(function(e) {
			e.preventDefault();
			$('.facebook_comments_trigger').addClass('active');
			$('#the_facebook_comments').show();
		});
	});

</script>
<?php get_footer(); ?>
