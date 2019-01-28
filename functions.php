<?php
add_filter( 'wpcf7_validate_configuration', '__return_false' );


add_post_type_support( 'page', 'excerpt' );

if (function_exists( 'register_nav_menu')) {
  register_nav_menu( 'headermenu', 'Menu in the header.' );
  register_nav_menu( 'headermenu_1', 'Header submenu - 1st column' );
  register_nav_menu( 'headermenu_2', 'Header submenu - 2nd column' );
  register_nav_menu( 'headermenu_3', 'Header submenu - 3rd column' );
  register_nav_menu( 'headermenu_4', 'Header submenu - 4th column' );
  register_nav_menu( 'headermenu_5', 'Header submenu - 5th column' );
  register_nav_menu( 'headermenu_6', 'Header submenu - 6th column' );
  register_nav_menu( 'headermenu_7', 'Header submenu - 7th column' );
  register_nav_menu( 'mobilmenu_1', 'Mobil 1st accordion main menu item' );
  register_nav_menu( 'mobilmenu_2', 'Mobil 2nd accordion main menu item' );
  register_nav_menu( 'mobilmenu_3', 'Mobil 3rd accordion main menu item' );
  register_nav_menu( 'mobilmenu_4', 'Mobil 4th accordion main menu item' );
  register_nav_menu( 'mobilmenu_5', 'Mobil 5th accordion main menu item' );
  register_nav_menu( 'mobilmenu_6', 'Mobil 6th accordion main menu item' );
	register_nav_menu( 'mobilmenu_7', 'Mobil 7th accordion main menu item' );
	register_nav_menu( 'headermenu_right', 'Submenu on the header right side & first red mobilmenu.' );
	register_nav_menu( 'footermenu', 'Menu in the footer.' );
}

// Custom posts

include_once('cpp.php');
include_once('custom.php');
include_once('widgets_old.php');

// excerpt length

function new_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'new_excerpt_length');

// excerpt dots

function new_excerpt_more($more) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

//footer text change on backend

function remove_footer_admin () {
  echo 'atlatszo.hu version 2.0<br/> <a href="https://exibio.hu" target="_blank" style="background:#f58220; color:#fff; padding:3px 5px; display:inline-block; margin:10px 0 0;">exibio wordpress development</a>';
}
add_filter('admin_footer_text', 'remove_footer_admin');

//wp editor custom css

add_action( 'admin_init', 'exibio_styles' );
function exibio_styles() {
    add_editor_style( 'style-editor.css' );
}

function exibio_theme_style() {
	wp_enqueue_style( 'exibio_style', get_template_directory_uri() . '/style-admin.css');

}
add_action('admin_enqueue_scripts', 'exibio_theme_style');
add_action('login_enqueue_scripts', 'exibio_theme_style');

// Custom wp-login logo

function custom_login_logo() {
    echo '<style type="text/css">
        h1 a{background:url(' . get_bloginfo(template_url) . '/i/atlatszo-logo.svg) no-repeat center center !important; margin:0 0 10px 0;width:300px !important;height:123px !important;}
    </style>';
}
add_action('login_head', 'custom_login_logo');

//kikapcsolja a widgeteket
/*add_filter( 'sidebars_widgets', 'disable_all_widgets');

function disable_all_widgets( $sidebars_widgets ) {
	if ( is_home() )
		$sidebars_widgets = array( false );
	return $sidebars_widgets;
}*/

// Thumbnail support

if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
}

// Custom thumbnail sizes

if ( function_exists( 'add_image_size' ) ) { 
  add_image_size('small_169', 300, 180, true);
  add_image_size('square_medium', 300, 300, true);
  /*add_image_size('square', 600, 600, true);
  add_image_size('letterbox_single', 600, 450, true);
  add_image_size('letterbox_medium', 400, 300, true);
  add_image_size('masonry', 9999, 400, false);*/
}

// Remove whitespace from wp_list_pages

function remove_whitespace($wp_list_pages) {
	return str_replace(array("\n", "\r", "\t"), "", $wp_list_pages);	
}
add_filter('wp_list_pages', 'remove_whitespace');

add_theme_support('automatic-feed-links'); // RSS
add_theme_support( 'nav-menus' );

// Browser detect and add to body class

add_filter('body_class','browser_body_class');
function browser_body_class($classes) {
	global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;

	if($is_lynx) $classes[] = 'lynx';
	elseif($is_gecko) $classes[] = 'gecko';
	elseif($is_opera) $classes[] = 'opera';
	elseif($is_NS4) $classes[] = 'ns4';
	elseif($is_safari) $classes[] = 'safari';
	elseif($is_chrome) $classes[] = 'chrome';
	elseif($is_IE) $classes[] = 'ie';
	else $classes[] = 'unknown';

	if($is_iphone) $classes[] = 'iphone';

  if (is_single() && get_post_type()=="post") {
    $classes[]="single_post";
    if (in_category(302)) {$classes[]="single-format-video";}
  }
  if (is_page_template('support.php')) {$classes[]="support_page";}
	if (is_page_template('impressum.php')) {$classes[]="impressum";}

	return $classes;
}

// Some category functions

function get_first_cat_name() {
	$pcat=get_the_category();
  if ($pcat) {return $pcat[0]->name;} else {return;}
}

function get_first_cat_id() {
	$pcat=get_the_category();
  if ($pcat) {return $pcat[0]->cat_ID;} else {return;}
}

function get_first_cat() {
	return get_the_category();
}

/* CUSTOM WP TINYMCE BUTTONS */

// Adsense shortcode Function

//[sharedcontent]


add_shortcode('sharedcontent', 'sharedcontent_link_shortcode');
function sharedcontent_link_shortcode($atts = [], $content = null, $tag = '') {
  
  $wporg_atts = shortcode_atts(['slug' => '',], $atts, $tag);
  $tamogatoi_slug=esc_html__($wporg_atts['slug'], 'sharedcontent'); // Get tamogatoi slug from old shortcode [sharedcontent slug="cikk-vegi-hirdetes"]

  // [sharedcontent slug="cikk-kozepi-hirdetes"]
  // [sharedcontent slug="cikk-vegi-hirdetes"]

  if ($tamogatoi_slug=="cikk-kozepi-hirdetes") {
    
    /*ob_start();
    include('tamogatoi.php');
    $content=ob_get_clean();*/

$args=array(
  'post_type' => 'tamogatoi',
  'posts_per_page' => 1,
  'tax_query' => array(
    array(
      'taxonomy' => 'tamogatoi-kategoria',
      'field'    => 'slug',
      'terms'    => 'szoveges'
    )
  ),
  'meta_query' => array(
    array(
      'key'     => 'blokk_hivatkozasi_nev',
      'value'   => 'nemingyenkeszul'
    ),
  )
);
$the_query_tamogatoi = new WP_Query($args);
while ($the_query_tamogatoi->have_posts()) : $the_query_tamogatoi->the_post();
$gomb_url=get_post_meta(get_the_ID(), 'gomb_url', true);
$gomb_felirat=get_post_meta(get_the_ID(), 'gomb_felirat', true);

    /*$content="</section>";
    $content="</div>";
    $content.="<div class='cl'></div>";*/
    $content="<div class='featured_box cikk-kozepi-hirdetes'>";
    $content.="<div class='inner'>";
    $content.="<div class='feat_text kszoveg ib'>".get_the_title()."</div>";
    $content.="<a class='btn narrow bred cwhite ib ac vm' href='".$gomb_url."'>".$gomb_felirat."</a>";
    $content.="</div>";
    $content.="</div>";
    /*$content.="<div class='n9 outer pr'>";
    $content.="<section class='the_content fr n100 pr'>";*/

endwhile; wp_reset_postdata();

  $content=""; // Disable [sharedcontent "cikk-kozepi-hirdetes"]

  } elseif ($tamogatoi_slug=="cikk-vegi-hirdetes") {

    /*ob_start();
    $content="</section></div>";
    include('tamogatoi-hirlevel.php');
    $content.=ob_get_clean();
    $content.="<section class='the_content fr n100'><div class='n9 outer pr'>";*/

  } else {
    $content="";
  }

  return $content;
}

add_shortcode('aboutblock', 'aboutblock_link_shortcode');
function aboutblock_link_shortcode() {

  //$content="<div class='aboutblock'>";
  ob_start();
  include('aboutblock.php');
  $content=ob_get_clean();
  //$content.="</div>";

  return $content;
}

add_shortcode('adsense', 'adsense_link_shortcode');
function adsense_link_shortcode() {

  $content="<section class='google_adsense'>";
  ob_start();
  include('adsense.php');
  $content.= ob_get_clean();
  $content.="</section>";

  return $content;
}

// Quote box shortcode function

add_shortcode('quotebox', 'quotebox_content_shortcode');
function quotebox_content_shortcode($atts = [], $content = null, $tag = '') {
  
  $content="";
  $wporg_atts = shortcode_atts(['text' => '','author' => '','title' => '','date' => '',], $atts, $tag);

  // Get all parameters from shortcode [quotebox text="123" author="Minta Peter" title="ügyvezető" date="2018.01.01"]
  
  $quote_text=esc_html__($wporg_atts['text'], 'quotebox'); 
  $quote_author=esc_html__($wporg_atts['author'], 'quotebox'); 
  $quote_title=esc_html__($wporg_atts['title'], 'quotebox'); 
  $quote_date=esc_html__($wporg_atts['date'], 'quotebox');
  
  if (!$quote_text && !$quote_author && !$quote_title && !$quote_date) {
    
    return $content;
  
  } else {

    $content="<div class='quote_box pr mt40 mb40'>";
    $content.="<blockquote><p>".$quote_text."</p></blockquote>";
    $content.="<span class='quote-caption'>";
    if ($quote_author) {$content.="<strong class='quote_author'>".$quote_author."</strong>";}
    if ($quote_title) {$content.="<span class='quote_title'>".$quote_title."</span>";}
    if ($quote_date) {$content.="<span class='quote_date'><span class='plr10'>—</span>".$quote_date."</span>";}
    $content.="</span'>";
    $content.="</div>";

  }
  
  return $content;
}
// Related single post shortcode Function

add_shortcode('related_content', 'related_content_shortcode');
function related_content_shortcode($atts = [], $content = null, $tag = '') {
  
  $content="";
  $wporg_atts = shortcode_atts(['id' => '',], $atts, $tag);
  $post_id=esc_html__($wporg_atts['id'], 'related_content'); // Get post_id from shortcode [related_content id="123"]
  if (!$post_id) {return $content;} else {
    $content="<section class='the_related_content pt15'>";
    $content.="<div class='n100 p10 bred cwhite ttu'>Kapcsolódó</div>";
    $content.="<div class='inner p20'>";
    $content.="<div class='n30 img100 ib vm'><a href='".get_permalink($post_id)."' class='bl'>";
    $content.=get_the_post_thumbnail($post_id, 'medium', array('class' => 'pr20'));
    $content.="</a></div><div class='n70 ib vm'>";
    $content.="<h3><a href='".get_permalink($post_id)."' class='bl'>".get_the_title($post_id)."</a></h3>";
    $content.="<div class='the_content'>".get_the_excerpt($post_id)."</div>";
    $content.="</div>";
    $content.="</div>";
    $content.="</section>";
  }
  
  return $content;
}

// Featured box shortcode Function

add_shortcode('featuredbox', 'featuredbox_shortcode');
function featuredbox_shortcode($atts = [], $content = null, $tag = '') {
  
  $content="";
  $wporg_atts = shortcode_atts(['text' => '', 'button_text' => '','link' => ''], $atts, $tag);
  $text=esc_html__($wporg_atts['text'], 'featuredbox');
  $button_text=esc_html__($wporg_atts['button_text'], 'featuredbox');
  $link=esc_html__($wporg_atts['link'], 'featuredbox');


    /*$content="</section>";
    $content="</div>";
    $content.="<div class='cl'></div>";*/
    $content.="<cite class='featured_box'>";
    $content.="<div class='inner'>";
    $content.="<div class='feat_text kszoveg ib n60 vm pr40 fs16px'>".$text."</div><a class='btn narrow bred cwhite ib n40 vm ac' href='".$link."'>".$button_text."</a>";
    $content.="</div>";
    $content.="</cite>";
    /*$content.="<div class='n9 outer pr'>";
    $content.="<section class='the_content fr n100 pr'>";*/


  return $content;
}

// Tamogatoi box shortcode Function

add_shortcode('tamogatoibox', 'tamogatoibox_shortcode');
function tamogatoibox_shortcode($atts = [], $content = null, $tag = '') {

  
  $content="";
  $wporg_atts = shortcode_atts(['blokk_hivatkozasi_nev' => ''], $atts, $tag);
  $blokk_hivatkozasi_nev=esc_html__($wporg_atts['blokk_hivatkozasi_nev'], 'tamogatoibox');
  //return $blokk_hivatkozasi_nev;

    //$content="</section></div>";

if (in_category(302) || get_post_format()=="video") {
  $video_format=true;
} else {
  $video_format=false;
}

$args_tamogatoi_1=array(
  'post_type' => 'tamogatoi',
  'posts_per_page' => 1,
  'meta_query' => array(
    array(
      'key'     => 'blokk_hivatkozasi_nev',
      'value'   => $blokk_hivatkozasi_nev
    )
  )
);

$the_query_tamogatoi_1 = new WP_Query($args_tamogatoi_1);
while ($the_query_tamogatoi_1->have_posts()) : $the_query_tamogatoi_1->the_post();
$gomb_felirat=get_post_meta(get_the_ID(), 'gomb_felirat', true);
$gomb_url=get_post_meta(get_the_ID(), 'gomb_url', true);
$kep_atlatszosag=get_post_meta(get_the_ID(), 'kep_atlatszosag', true);
$kep_url=get_the_post_thumbnail_url(get_the_ID(), 'full');

if ($video_format) {
  $content.='<style>.tamogatoi.box.tamogatoibox_shortcode:before {background:rgba(75, 75, 75, '.$kep_atlatszosag.');}</style>';
  $content.='<div class="n100 tamogatoi box pt40 pr tamogatoibox_shortcode tamogatoibox_shortcode_video" style="background-image:url('.$kep_url.');">';
} else {
  $content.='<style>.tamogatoi.box.tamogatoibox_shortcode:before {background:rgba(255, 255, 255, '.$kep_atlatszosag.');}</style>';
  $content.='<div class="n100 tamogatoi box pt40 pr tamogatoibox_shortcode" style="background-image:url('.$kep_url.');">';
}

$content.='<div class="shell pr">
      <div class="n50">
        <h4 class="fblack cdgrey fs15px ls1 ttu">'.get_the_title().'</h4>
        <div class="lead fs32px cdarkgrey lh160 fbold pt40 kszoveg">'.get_the_content().'</div>
        <a href="'.$gomb_url.'" class="btn bred cwhite">'.$gomb_felirat.'</a>
      </div>
  </div>
</div>';

endwhile; wp_reset_postdata();

    //$content.="<div class='n9 outer pr'><section class='the_content fr n100'>";

  return $content;
}

// DataViz shortcode Function

add_shortcode('dataviz', 'dataviz_shortcode');
function dataviz_shortcode($atts = [], $content = null) {
  
  $returned_content="";

  /*
  $wporg_atts = shortcode_atts(['text' => '', 'button_text' => '','link' => ''], $atts, $tag);
  $text=esc_html__($wporg_atts['text'], 'dataviz');
  $button_text=esc_html__($wporg_atts['button_text'], 'dataviz');
  $link=esc_html__($wporg_atts['link'], 'dataviz');
  */

    $returned_content.="</section>";
    $returned_content.="<section class='dataviz'>";
    $returned_content.=$content;
    $returned_content.="</section>";
    $returned_content.="<section class='the_content fr n100 pr'>";

  return $returned_content;
}

// Init custom buttons to TinyMCE

add_filter("mce_external_plugins", "enqueue_plugin_scripts");
function enqueue_plugin_scripts($plugin_array) {

    //enqueue TinyMCE plugin script with its ID.

    $plugin_array["adsense_button_plugin"] =  get_template_directory_uri() . '/j/adsense.js';
    //$plugin_array["related_button_plugin"] =  get_template_directory_uri() . '/j/related_single.js';
    $plugin_array["featuredbox_button_plugin"] =  get_template_directory_uri() . '/j/featuredbox.js';
    $plugin_array["aboutblock_button_plugin"] =  get_template_directory_uri() . '/j/aboutblock.js';
    $plugin_array["quotebox_button_plugin"] =  get_template_directory_uri() . '/j/quotebox.js';
    $plugin_array["tamogatoibox_button_plugin"] =  get_template_directory_uri() . '/j/tamogatoibox.js';
    return $plugin_array;
}

add_filter("mce_buttons", "register_buttons_editor");
function register_buttons_editor($buttons) {

    //register buttons with their id.

    array_push($buttons, "adsense");
    //array_push($buttons, "related");
    array_push($buttons, "featuredbox");
    array_push($buttons, "aboutblock");
    array_push($buttons, "quotebox");
    array_push($buttons, "tamogatoibox");
    return $buttons;
}

// Custom style dropdown to TinyMCE

add_filter('mce_buttons_2', 'wpb_mce_buttons_2');
function wpb_mce_buttons_2($buttons) {
  array_unshift($buttons, 'styleselect');
  return $buttons;
}

add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' );
function my_mce_before_init_insert_formats( $init_array ) {  

// Define the style_formats array

  $style_formats = array(  

    array(  
      'title' => 'Credit section',  
      'block' => 'span',
      'classes' => 'credit-section',
      'wrapper' => true,
      
    ),
    array(
        'title' => 'Bullett Design',
        'selector' => 'ul',
        'classes' => 'bullett-design'
    ),
    array(  
      'title' => 'Highlight',  
      'block' => 'span',
      'classes' => 'highlight-section',
      'wrapper' => true,
      
    ),
  );  
  // Insert the array, JSON ENCODED, into 'style_formats'
  $init_array['style_formats'] = json_encode( $style_formats );  
  
  return $init_array;  
  
} 

// Insert Tovabbi sztorik after given (n)th paragraph of single post content.

function requireToVar($file){
    ob_start();
    require($file);
    return ob_get_clean();
}

//add_filter('the_content', 'prefix_insert_post_ads');
function prefix_insert_post_ads( $content ) {

  $ad_code="</section></div>";
  $ad_code.="<div class='cl'></div>";
  $ad_code.=requireToVar('tovabbi_sztorik_single.php');
  $ad_code.="<div class='n9 outer pr'><section class='the_content fr n100'>";

  $where_to=get_field('tovabbi_sztorik_helyzete');

  //Get where_to insert banner

  if (is_single() && !is_admin() && $where_to && $where_to!="0") {
    return prefix_insert_after_paragraph( $ad_code, $where_to, $content);
  }
  
  return $content;
}
 
// Parent function that makes the insert AD

function prefix_insert_after_paragraph( $insertion, $paragraph_id, $content ) {
  $closing_p = '</p>';
  $paragraphs = explode( $closing_p, $content );
  foreach ($paragraphs as $index => $paragraph) {

    if ( trim( $paragraph ) ) {
      $paragraphs[$index] .= $closing_p;
    }

    if ( $paragraph_id == $index + 1 ) {
      $paragraphs[$index] .= $insertion;
    }
  }
  
  return implode( '', $paragraphs );
}
 
// Set post formats

add_theme_support( 'post-formats', array('image', 'gallery', 'video' ) );

// Add post-formats to post_type 'page'

add_action('init', 'exibio_slug_add_post_formats_to_page', 11);

function exibio_slug_add_post_formats_to_page(){
    add_post_type_support( 'page', 'post-formats' );
    register_taxonomy_for_object_type( 'post_format', 'page' );
}

add_filter('the_content', 'filter_ptags_on_images');
function filter_ptags_on_images($content) {
  //return preg_replace('​/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
  return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

// Rewrite author slug

add_action('init','change_author_permalinks');
function change_author_permalinks() {
    global $wp_rewrite;
    $wp_rewrite->author_base = 'szerzo';
    $wp_rewrite->flush_rules();
}

add_filter( 'oembed_result', 'exibio_yt_js_api', 10, 3 );
function exibio_yt_js_api( $html, $url, $args ) {
 
  /* Modify video parameters. */

  if ( strstr( $html,'youtube.com/embed/' ) ) {
    $html = str_replace( '?feature=oembed', '?feature=oembed&enablejsapi=1&rel=0&showinfo=0', $html );
  }
  
    return $html;
}

// ACF set default relationship field orderby parameter

function my_relationship_query( $args, $field, $post_id ) {
  
  $args['orderby'] = 'date';
  $args['order'] = 'DESC';
  $args['post_status'] = 'publish';
  return $args;
    
}
add_filter('acf/fields/relationship/query', 'my_relationship_query', 10, 3);


// Custom, numbered pagination

function pagination($pages = '', $range = 2) {
     $showitems = ($range * 2)+1;
 
     global $paged;

     if(empty($paged)) $paged = 1;
 
     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages) {$pages = 1;}
     }   
 
     if(1 != $pages) {
         //echo "<div class=\"pagination\"><span>Page ".$paged." of ".$pages."</span>";
      echo '<div class="pagin cle fl n100 ac m30 plr30">';

         //enable step back button
         //if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."' class='backone ttu fl'>Előző</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."' class='backone ttu fl'><img src='".get_bloginfo('template_url')."/i/arrow-left-peach.svg' width='40' height='40' alt='Előző' /></a>";

         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."' class='inactive prev1 mr10'>...</a>"; //first


         for ($i=1; $i <= $pages; $i++) {

             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) {
                 echo ($paged == $i)? "<span class=\"current cred ac mr10\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive ac blue mr10\">".$i."</a>";
             }
         } 
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."' class='inactive next1 ml10'>...</a>"; //Last
         
         //enable step next button
         if ($paged < $pages && $showitems < $pages) echo "<a class='nextone ttu fr' href=\"".get_pagenum_link($paged + 1)."\"><img src='".get_bloginfo('template_url')."/i/arrow-right-peach.svg' width='40' height='40' alt='Előző' /></a>"; 

         echo "</div>";
     }
}

// Add custom class over every link before <img>

add_filter('the_content','give_linked_images_class');
function give_linked_images_class($content) {

  $classes = 'swipebox'; // separate classes by spaces - 'img image-link'

  // check if there are already a class property assigned to the anchor
  if ( preg_match('/<a.*? class=".*?"><img/', $content) ) {
    // If there is, simply add the class
    $content = preg_replace('/(<a.*? class=".*?)(".*?><img)/', '$1 ' . $classes . '$2', $content);
  } else {
    // If there is not an existing class, create a class property
    $content = preg_replace('/(<a.*?)><img/', '$1 class="' . $classes . '" ><img', $content);
  }
  return $content;
}


// Allow customize post left sidebar items

if( function_exists('acf_add_options_page') ) {
 
  $option_page = acf_add_options_page(array(
    'page_title'  => 'Központi beállítások',
    'menu_title'  => 'Központi beállítások',
    'menu_slug'   => 'kozponti-beallitasok',
    'capability'  => 'edit_posts',
    'updated_message' => __("Beállítások elmentve.", 'atlatszo'),
    'redirect'  => false
  ));
 
}

function km_get_the_excerpt( $post_id = null, $num_words = 55 ) {
  $post = $post_id ? get_post( $post_id ) : get_post( get_the_ID() );
  $text = get_the_excerpt( $post );
  if ( ! $text ) {
    $text = get_post_field( 'post_content', $post );
  }
  $generated_excerpt = wp_trim_words( $text, $num_words );
  $returned_excerpt=apply_filters( 'get_the_excerpt', $generated_excerpt, $post );
  $returned_excerpt=str_replace('&nbsp;', '', $returned_excerpt);
  $returned_excerpt=str_replace('[sharedcontent slug="cikk-kozepi-hirdetes"]', '', $returned_excerpt);
  return $returned_excerpt;
}

// Add iframe/embed video outer div

//add_filter('the_content', 'div_wrapper'); // TEMP OFF
function div_wrapper($content) {
    // match any iframes
    $pattern = '~<iframe.*</iframe>|<embed.*</embed>~';
    preg_match_all($pattern, $content, $matches);

    foreach ($matches[0] as $match) {
        // wrap matched iframe with div
        $wrappedframe = '<div class="videoWrapper mb30">' . $match . '</div>';

        //replace original iframe with new in content
        $content = str_replace($match, $wrappedframe, $content);
    }

    return $content;    
}


do_action( 'wp_update_nav_menu', $menu_id, $menu_data );
add_action('wp_update_nav_menu', 'after_save_menu');

function after_save_menu($menu_id, $menu_data) {

  $file=get_home_path()."mainmenu.html";
  $menu_contents = file_get_contents(get_bloginfo("url").'/menu-generator/');
  file_put_contents($file, $menu_contents);
  ?>
  <script type="text/javascript">
    //console.log('<?php //echo $file; ?>');
  </script>
<?php
}
?>