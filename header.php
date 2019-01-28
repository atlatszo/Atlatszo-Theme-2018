<!DOCTYPE html>
<html dir="ltr" <?php language_attributes(); ?>>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

	<title><?php wp_title(); ?></title>
	
	<?php wp_head(); ?>

	<link rel="apple-touch-icon" sizes="180x180" href="<?php bloginfo('template_url')?>/i/favicon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php bloginfo('template_url')?>/i/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php bloginfo('template_url')?>/i/favicon/favicon-16x16.png">
	<link rel="manifest" href="<?php bloginfo('template_url')?>/i/favicon/site.webmanifest">
	<link rel="mask-icon" href="<?php bloginfo('template_url')?>/i/favicon/safari-pinned-tab.svg" color="#ff0000">
	<link rel="icon" type="image/png" href="<?php bloginfo('template_url')?>/i/favicon/favicon-32x32.png">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="theme-color" content="#ffffff">
	<meta property="fb:app_id" content="985094288330865" />

	<meta content="yes" name="apple-mobile-web-app-capable">

	<link type="text/css" rel="stylesheet" href="//fast.fonts.net/cssapi/fa08d7fc-a105-4d0b-9bf9-31208bc42ecc.css"/>
	<link href="https://fonts.googleapis.com/css?family=PT+Serif:400,700&amp;subset=latin-ext" rel="stylesheet">
	<link href="<?php bloginfo('stylesheet_url'); ?>?v=<?php echo mt_rand() / mt_getrandmax(); ?>" rel="stylesheet" type="text/css" media="screen, projection" />
	
	<link rel="stylesheet" href="<?php bloginfo('template_url')?>/j/swp/css/swipebox.css">
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/j/fa/css/fa-svg-with-js.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/responsive.css?v=<?php echo mt_rand() / mt_getrandmax(); ?>" type="text/css" media="screen" />

	<script src="<?php bloginfo('template_url'); ?>/j/jquery.1.12.4.min.js"></script>
	<script defer src="<?php bloginfo('template_url'); ?>/j/fa/js/fontawesome-all.min.js"></script>


	<?php if (is_front_page() || is_home()) { ?>

		<meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>" />
		<meta property="og:url" content="<?php echo esc_url(get_permalink()); ?>" />
		<meta property="og:title" content="<?php echo get_bloginfo('name'); ?>" />
		<meta property="og:description" content="<?php echo get_bloginfo('description'); ?>" />
		<meta name="description" content="<?php echo $returned_excerpt; ?>" />
		<meta property="og:image" content="<?php echo get_bloginfo('template_url')?>/i/atlatszo-logo-900x360.jpg" />
		<meta property="og:image:width" content="900" />
		<meta property="og:image:height" content="360" />
		<meta property="og:type" content="website" />

		<meta name="twitter:card" content="summary_large_image">
		<meta name="twitter:site" content="@atlatszo">
		<meta name="twitter:title" content="<?php echo get_bloginfo('name'); ?>">
		<meta name="twitter:description" content="<?php echo get_bloginfo('description'); ?>" >
		<meta name="i:image16_9" content="<?php echo get_bloginfo('template_url')?>/i/atlatszo-logo-900x360.jpg" />
		<meta name="twitter:image" content="<?php echo get_bloginfo('template_url')?>/i/atlatszo-logo-900x360.jpg">
		<meta name="twitter:image:src" content="<?php echo get_bloginfo('template_url')?>/i/atlatszo-logo-900x360.jpg">

	<?php } else {
		//var_dump($post);
		$this_post=get_post();
		$text = get_post_field( 'post_content', $this_post);
  		$generated_excerpt = wp_trim_words( $text, 55 );
  		$returned_excerpt=apply_filters( 'get_the_excerpt', $generated_excerpt, $post );
  		$returned_excerpt=str_replace('&nbsp;', '', $returned_excerpt);
  		$returned_excerpt=str_replace('&hellip;', '', $returned_excerpt);
  		

        if (has_post_thumbnail()) {
        	$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
        	$featured_img_url_169 = get_the_post_thumbnail_url(get_the_ID(),'small_169');
		} else {
			$featured_img_url=get_bloginfo('template_url')."/i/atlatszo-logo-900x360.jpg";
		}
		$photo_size = getimagesize($featured_img_url);
		$feat_image_width=$photo_size[0];
		$feat_image_height=$photo_size[1];

		?>

		<meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>" />
		<meta property="og:url" content="<?php echo esc_url(get_permalink()); ?>" />
		<meta property="og:title" content="<?php echo get_the_title(); ?>" />
		<meta property="og:description" content="<?php echo $returned_excerpt; ?>" />
		<meta name="description" content="<?php echo $returned_excerpt; ?>" />
		<meta property="og:image" content="<?php echo $featured_img_url; ?>" />
		<meta property="og:image:url" content="<?php echo $featured_img_url; ?>" />
		<meta property="og:image:width" content="<?php echo $feat_image_width; ?>" />
		<meta property="og:image:height" content="<?php echo $feat_image_height; ?>" />
		<meta property="og:type" content="article" />

		<meta name="twitter:card" content="summary_large_image" />
		<meta name="twitter:site" content="@atlatszo" />
		<meta name="twitter:title" content="<?php echo get_the_title(); ?>" />
		<meta name="twitter:description" content="<?php echo $returned_excerpt; ?>" />
		<meta name="i:image16_9" content="<?php echo $featured_img_url_169; ?>" />
		<meta name="twitter:image" content="<?php echo $featured_img_url; ?>?s=3" />
		<meta name="twitter:image:src" content="<?php echo $featured_img_url; ?>?s=5" />

	<?php } ?>

</head>

<body <?php body_class(); ?>>
	
<?php include('headermain.php'); ?>

<form method="get" id="the_searchform" class="dn pf r0 t0 z9 h100 n100" action="<?php bloginfo('home'); ?>/">

	<div class="n9 vam">
		<a href="#" id="close_the_search" class="searchingclose ma ac n50 bl cle pb40"><img src="<?php echo get_bloginfo('template_url'); ?>/i/close-white.svg" width="30" height="30" class="bl ac ma" alt="Bezárás"/></a>

		<div class="n50 ma p15 search_fields">
			<input type="text" value="Keresés..." onblur="if(this.value=='') this.value='Keresés...';" onfocus="if(this.value=='Keresés...') this.value='';" name="s" id="sd" class="search_keyword bl p20 n100 mb15"/>
			<input type="submit" class="gosearch fblack button p20 ac bl vm cwhite bred ttu n100" id="ssubd" value="Keresés" />
		</div>

	</div>
</form>