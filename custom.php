<?php
/**
 * Custom functions
 */

 
 //------------- CUSTOM POST TYPES -------------//
//* Custom Post Types létrehozása *//
add_action( 'init', 'my_register_post_types' );
function my_register_post_types() {
	register_post_type(
		'video',
		array(
			'public' => true,
			'labels' => array(  'name' => 'Videók',
								'singular_name' => 'Videó',
								'all_items' => 'Összes videó',
								'add_new' => 'Új videó',
								'add_new_item' => 'Új videó létrehozása',
								'new_item' => 'Új videó',
								'edit' => 'Videó szerkesztése',
								'edit_item' => 'Videó szerkesztése',
								'view_item' => 'Videó megtekintése'
								),
			'description' => 'Videók megjelenítése',
			'menu_position' => 5,
			'supports' => array( 'title', 'excerpt', 'editor', 'thumbnail', /*'revisions'*/ ),
			'rewrite' => array( 'slug' => 'video', 'with_front' => false ),
			'has_archive' => 'Videó',
			'can_export' => true
		)
	);
	
}

function has_post_thumbnail_caption() {
  global $post;

  $thumbnail_id    = get_post_thumbnail_id($post->ID);
  $thumbnail_image = get_posts(array('p' => $thumbnail_id, 'post_type' => 'attachment'));

  if ($thumbnail_image && isset($thumbnail_image[0]) && strlen(trim($thumbnail_image[0]->post_excerpt)) > 0) {
    return true;
  }
  return false;
}

/*function the_post_thumbnail_caption() {
  global $post;

  $thumbnail_id    = get_post_thumbnail_id($post->ID);
  $thumbnail_image = get_posts(array('p' => $thumbnail_id, 'post_type' => 'attachment'));

  if ($thumbnail_image && isset($thumbnail_image[0])) {
    echo '<span>'.$thumbnail_image[0]->post_excerpt.'</span>';
  }
}*/


/*----- Copied from the old theme ----------------*/


function http_opts(){
/*
  if($_SERVER['HTTP_HOST'] == 'atlatszo.hu' || $_SERVER['HTTP_HOST'] == 'stage.atlatszo.hu' || $_SERVER['HTTP_HOST'] == 'atlatszo.vpn' || $_SERVER['HTTP_HOST'] == 'www.atlatszo.hu' || $_SERVER['HTTP_HOST'] == 'origin.atlatszo.hu'){
    $opts = array('http' =>
      array(
        'proxy' => '127.0.0.1:8080'
      )
    );
  }
  else{
    $opts = array();
  }*/
$opts = array();
  return $opts;
}

function getVideos($url) {
  $opts = http_opts();

  $context = stream_context_create($opts);
  $source = file_get_contents('http://blog.atlatszo.hu/wp-content/uploads/vimeo.json', false, $context);
  
  $videos = json_decode($source);
  return $videos;

}
//====================================================================================7

function multipleExplode($delimiters = array(), $string = ''){

    $mainDelim=$delimiters[count($delimiters)-1]; // dernier

    array_pop($delimiters);

    foreach($delimiters as $delimiter){

        $string= str_replace($delimiter, $mainDelim, $string);

    }

    $result= explode($mainDelim, $string);
    return $result;

}



function bag_tracker($num){
  
  $opts = array();

  $context = stream_context_create($opts);
  $source = file_get_contents("http://services.atlatszo.hu/store_.xml", false, $context);
  if ($source=="") return false;
  else {
   $DOM = new DOMDocument;
   $DOM->loadXML($source);
   $nodes = $DOM->getElementsByTagName("elem");
  $nodeArray=array();
  $changedArray =array();
  foreach ($nodes as $node){
   if ($node->getAttribute('date')=="-") { $nodeArray[$node->getAttribute('name')]=$node; }
   else { $changedArray[$node->getAttribute('date').$node->getAttribute('name')] = $node; }
  }
  ksort($changedArray);
  //$result="<li>";
  $result="";
  for( $i=1; $i<=$num; $i++){
  $node=array_pop($changedArray);
  //$result .= "<li><time>".$node->getAttribute('date').' - </time><a href="'.$node->getAttribute('id').'">'.$node->getAttribute('name')."</a></li>";

  $result .= "<li class='article_list mb10'><a href='".$node->getAttribute('id')."'><time>".$node->getAttribute('date')." - </time><article>".$node->getAttribute('name')."</article></a></li>";
  }
  //$result.="</p><p>A jelenleg megfigyelt üvegzsebek száma: ".$nodes->length."</p>";
  return $result;
  }

} 


function stripInvalidXml($value)
{
    $ret = "";
    $current;
    if (empty($value)) 
    {
        return $ret;
    }

    $length = strlen($value);
    for ($i=0; $i < $length; $i++)
    {
        $current = ord($value{$i});
        if (($current == 0x9) ||
            ($current == 0xA) ||
            ($current == 0xD) ||
            (($current >= 0x20) && ($current <= 0xD7FF)) ||
            (($current >= 0xE000) && ($current <= 0xFFFD)) ||
            (($current >= 0x10000) && ($current <= 0x10FFFF)))
        {
            $ret .= chr($current);
        }
        else
        {
            $ret .= " ";
        }
    }
    return $ret;
}

function RSS_list($RSS_Url,$num) {
  $opts = http_opts();

  $context = stream_context_create($opts);
  $source = file_get_contents($RSS_Url, false, $context);
if ($source=="") return false;
else {
  $DOM = new DOMDocument;
  $DOM->loadXML(stripInvalidXml($source));
  $nodes = $DOM->getElementsByTagName("entry");
  $nodeArray=array();
  foreach ($nodes as $node){
  // if (strstr($node->getElementsByTagName('content')->item(0)->nodeValue,'Sikeresen z&#225;rult')) { 
   $nodeArray[$node->getElementsByTagName('published')->item(0)->nodeValue]=$node;//}
  }
  ksort($nodeArray);
  if ($num>count($nodeArray)) $num=count($nodeArray);

  //$result="<p>";
  $result="";
  for( $i=0; $i<=$num; $i++){
    $node=array_pop($nodeArray);
    if($node){

      $result.="<li class='article_list mb10'>";
      $result.= '<a class="alist" href="'.$node->getElementsByTagName('link')->item(0)->getAttribute('href').'">';
      $result.="<time>";
      $result.= str_replace('-','.',substr($node->getElementsByTagName('published')->item(0)->nodeValue,0,10)).'. - </time>';
      $result.="<article>";
      $result.= $node->getElementsByTagName('title')->item(0)->nodeValue;
      $result.="</article>";
      $result.="</a>";
      $result.="</li>";

    }
  }
  //$result.="</p>";
  return $result;
  }
}

function RSS_list2($RSS_Url,$num) {
  error_reporting(E_ERROR | E_PARSE );
  $opts = http_opts();

  $context = stream_context_create($opts);
  $source = file_get_contents($RSS_Url, false, $context);

if ($source=="") return false;
else {
  $DOM = new DOMDocument;
  $DOM->loadXML($source);
  $nodes = $DOM->getElementsByTagName("item");
  $nodeArray=array();
  foreach ($nodes as $node){
  // if (strstr($node->getElementsByTagName('content')->item(0)->nodeValue,'Sikeresen z&#225;rult')) { 
   $nodeArray[strtotime($node->getElementsByTagName('pubDate')->item(0)->nodeValue)]=$node;//}
  }
  ksort($nodeArray);
  if ($num>count($nodeArray)) $num=count($nodeArray);

  $result=array();

  for( $i=0; $i<$num; $i++){
    $node=array_pop($nodeArray);
    array_push($result, array('published'=> strtotime($node->getElementsByTagName('pubDate')->item(0)->nodeValue),
                               'url_'     => $node->getElementsByTagName('link')->item(0)->nodeValue,
                               'title'    => $node->getElementsByTagName('title')->item(0)->nodeValue  ));
  }
return $result;
}
}

function merge_feeds($RSS_url_array, $num) {
  error_reporting(E_ERROR | E_PARSE );
  if (empty($RSS_url_array)) return false;
  if ( !is_array($RSS_url_array)) array_push($url_array, $RSS_url_array);
  else $url_array=$RSS_url_array;
  $result=array();
  foreach ($url_array as $url){
    $feed=RSS_list2($url,$num);
    if ($feed) $result=array_merge($result,$feed);
  }
  usort($result, function ($a,$b){if ($a[published] == $b[published])return 0; return ($a[published] > $b[published]) ? -1 : 1;});
  return array_slice($result,0,$num);
}








/*-------- widgets from old theme --------------*/

/*
 * ATLATSZO RSS
 */
class atlatszo_feed extends WP_Widget {
	function atlatszo_feed() {
		$widget_ops = array( 'classname' => 'atlatszo_feed', 'description' => 'Atlatszo style RSS' );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'atlatszo_feed' );
		$this->WP_Widget( 'atlatszo_feed', 'Atlatszo Widget : RSS', $widget_ops, $control_ops);	
	}
	
	function widget($args, $instance) {
		extract( $args );
		$title	= $instance['title'];
		$RSS_Url = $instance['RSS_Url'];
		$num	= $instance['num'];

		echo $before_widget;

			if ( $title ) {
				echo $before_title;
					echo $title;
				echo $after_title;
			}
			//echo '<p>Legutóbb teljesült adatigénylések:</p>';
			echo RSS_list($RSS_Url,$num);
				
	
		echo $after_widget; 
	}
	
	function update($new_instance, $old_instance) {  
		$instance['title']		= strip_tags($new_instance['title']);
		$instance['RSS_Url']		= strip_tags($new_instance['RSS_Url']);
		$instance['num']		= strip_tags($new_instance['num']);
		return $new_instance;
	}
 
	function form($instance) {
		$defaults	= array( 'title' => 'RSS', 'RSS_Url' => '', 'num' => '5');
		$instance = wp_parse_args( (array) $instance, $defaults ); 
	?>

	<p>
		<label for="<?php echo $this->get_field_id('title'); ?>">Title</label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
	</p>

  <p>
		<label for="<?php echo $this->get_field_id('RSS_Url'); ?>">RSS Url</label>
		<input class="widefat" id="<?php echo $this->get_field_id('RSS_Url'); ?>" name="<?php echo $this->get_field_name('RSS_Url'); ?>" type="text" value="<?php echo esc_attr($instance['RSS_Url']); ?>" />
	</p>

	<p>
		<label for="<?php echo $this->get_field_id('num'); ?>">Megjelenítendő elemek száma</label>
		<input id="<?php echo $this->get_field_id('num'); ?>" name="<?php echo $this->get_field_name('num'); ?>" type="text" value="<?php echo esc_attr( $instance['num'] ); ?>" />
	</p>
		
<?php
	}
}
register_widget('atlatszo_feed');

/*
 * BAG TRACKER
 */
class tracker_widget extends WP_Widget {
	function tracker_widget() {
		$widget_ops = array( 'classname' => 'tracker_widget', 'description' => 'Üvegzseb figyelő' );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'tracker_widget' );
		$this->WP_Widget( 'tracker_widget', 'Atlatszo Widget : Tracker', $widget_ops, $control_ops);	
	}
	
	function widget($args, $instance) {
		extract( $args );
		$title	= $instance['title'];
		$num	= $instance['num'];

		echo $before_widget;

			if ( $title ) {
				echo $before_title;
					echo $title;
				echo $after_title;
			}
			//echo '<p>Legutóbb megváltozott üvegzsebek:</p>';			
			//echo bag_tracker($num);
				
	
		echo $after_widget; 
	}
	
	function update($new_instance, $old_instance) {  
		$instance['title']		= strip_tags($new_instance['title']);
		$instance['num']		= strip_tags($new_instance['num']);
		return $new_instance;
	}
 
	function form($instance) {
		$defaults	= array( 'title' => 'Üvegzseb figyelő', 'num' => '5');
		$instance = wp_parse_args( (array) $instance, $defaults ); 
	?>

	<p>
		<label for="<?php echo $this->get_field_id('title'); ?>">Title</label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
	</p>

	<p>
		<label for="<?php echo $this->get_field_id('num'); ?>">Megjelenítendő zsebek száma</label>
		<input id="<?php echo $this->get_field_id('num'); ?>" name="<?php echo $this->get_field_name('num'); ?>" type="text" value="<?php echo esc_attr( $instance['num'] ); ?>" />
	</p>
		
<?php
	}
}
register_widget('tracker_widget');






function get_feed_origin($url){
  $names = array(
    'atlatszo.hu' => 'Átlátszó',
    'blog.atlatszo.hu' => 'Átlátszó blog',
    'vastagbor.atlatszo.hu' => 'Vastagbőr',
    'igyirnankmi.atlatszo.hu' => 'Így írnánk mi',
    'english.atlatszo.hu' => 'English',
    'mutyimondo.atlatszo.hu' => 'Mutyimondó',
    'video.atlatszo.hu' => 'Video',
    'radio.atlatszo.hu' => 'Rádió',
    'szakirodalom.atlatszo.hu' => 'Szakirodalom',
    'darvasbela.atlatszo.hu' => 'Darvas Béla',
    'vilagterkep.atlatszo.hu' => 'Világtérkép',
    'szocio.atlatszo.hu' => 'Szocio',
    'transparency.atlatszo.hu' => 'Transparency',
    'k-monitor.atlatszo.hu' => 'K-monitor',
    'pogiblog.atlatszo.hu' => 'Pogiblog',
    'globalvoices.atlatszo.hu' => 'Global Voices',
    'occrp.atlatszo.hu' => 'OCCRP',
    'annyit.atlatszo.hu' => 'annyit',
    'adatujsagiras.atlatszo.hu' => 'Adatújságírás',
    'pcblog.atlatszo.hu' => 'PCblog',
    'kornyezetvedelem.atlatszo.hu' => 'Környezetvédelem',
    'erdely.atlatszo.hu' => 'Erdély',
    '230.atlatszo.hu' => '230',
    'falramentaparlament.atlatszo.hu' => 'Falramentaparlament',
    'oktatas.atlatszo.hu' => 'Átlátszó Oktatás',
    'slejm.atlatszo.hu' => 'Slejm',
    'torvenygyartok.atlatszo.hu' => 'Törvénygyártók',
    'mertek.atlatszo.hu' => 'Mérték blog',
    'vajdasag.atlatszo.hu' => 'Vajdaság blog',
    'fold.atlatszo.hu' => 'Culus regio',
    'dotoho.atlatszo.hu' => 'Do toho',
    'videkicsajok.atlatszo.hu' => 'Vidéki csajok',
    'kozerdekvedelem.atlatszo.hu' => 'Közérdekvédelem',
    'orszagszerte.atlatszo.hu' => 'Országszerte',
    'crisiszones.atlatszo.hu' => 'CrisisZones',
    'ejeb.atlatszo.hu' => 'Strasbourgi Figyelő',
    'megoldas.atlatszo.hu' => 'Megoldás',
    'koszegferenc.atlatszo.hu' => 'Kőszeg Ferenc',
    'regiblogok.atlatszo.hu' => 'Régi blogok'
  );
  if($val = $names[$url]);
  else $val = $url;
  return $val;
}

function get_feed_url($node){
  $url = $node->getElementsByTagName('link')->item(0)->nodeValue;
  $url_arr = explode('/', $url);
  return $url_arr[2];
}

function atl_format_date($str){
  $time = strtotime($str);
  return strftime('%Y. %m. %d. %H:%M', $time);
}

function trans_list($RSS_Url,$num) {
  $opts = http_opts();

  $context = stream_context_create($opts);
  $source = file_get_contents($RSS_Url, false, $context);
  if ($source=="") return false;
  else {
    $DOM = new DOMDocument;
    $DOM->loadXML($source);
    //$nodes = array_slice($DOM->getElementsByTagName("item"), 0, $num-1);
    $nodes = $DOM->getElementsByTagName("item");
    //echo '<ul>';
    $i=0;
    foreach($nodes as $node){
      
      if($i==$num) {break;}
      $url=get_feed_url($node);
      $blog_name=str_replace('.', '-', $url);
      if ($blog_name!="blog-atlatszo-hu") {$blog_class="kek";} else {$blog_class="";}
      ?><article class="n25 ib vt pt50 item-<?php echo $i; ?>">
         <div class="inner pr50">
            
            <a href="<?php echo "https://".$url; ?>" class="the_category fs15px p10 bred cwhite ib mb20 ls1 <?php echo $blog_class; ?>"><?php echo get_feed_origin($url); ?></a>
            <h2 class="the_title ttn fs18px lh180"><a href="<?php echo $node->getElementsByTagName('link')->item(0)->nodeValue; ?>" class="kszoveg cdarkgrey"><?php echo $node->getElementsByTagName('title')->item(0)->nodeValue; ?></a></h2>

          </div>
        </article><?php
        $i++;
    }
    //echo '</ul>';
}
}


/* New trans_list function to include atlatszo.ro posts in feed */
function trans_list_with_ro($RSS_Url,$num) {
  $opts = http_opts();

  $context = stream_context_create($opts);
  $source = file_get_contents($RSS_Url, false, $context);
  $source_ro = file_get_contents('https://atlatszo.ro/feed/', false, $context);
  if ($source=="" || $source_ro=="") return false;
  else {
    $DOM = new DOMDocument;
    $DOM->loadXML($source);
    //$nodes = array_slice($DOM->getElementsByTagName("item"), 0, $num-1);
    $nodes = $DOM->getElementsByTagName("item");
    //echo '<ul>';
    $i=0;

    $DOM_ro = new DOMDocument;
    $DOM_ro->loadXML($source_ro);
    $nodes_ro = $DOM_ro->getElementsByTagName("item");
    $i_ro=0;
    foreach($nodes as $node){
      
      if($i==$num) {break;}

      if( atl_format_date($node->getElementsByTagName('pubDate')->item(0)->nodeValue) <= atl_format_date($nodes_ro[$i_ro]->getElementsByTagName('pubDate')->item(0)->nodeValue) ) {
        ?><article class="n25 ib vt pt50 item-<?php echo $i; ?>">
        <div class="inner pr50">

          <a href="https://atlatszo.ro" class="the_category fs15px p10 bred cwhite ib mb20 ls1 kek">Átlátszó Erdély</a>
          <h2 class="the_title ttn fs18px lh180"><a href="<?php echo $nodes_ro[$i_ro]->getElementsByTagName('link')->item(0)->nodeValue; ?>" class="kszoveg cdarkgrey"><?php echo $nodes_ro[$i_ro]->getElementsByTagName('title')->item(0)->nodeValue; ?></a></h2>

        </div>
        </article><?php
        $i++;
        $i_ro++;
      }

      if($i==$num) {break;}

      $url=get_feed_url($node);
      $blog_name=str_replace('.', '-', $url);
      if ($blog_name!="blog-atlatszo-hu") {$blog_class="kek";} else {$blog_class="";}
      ?><article class="n25 ib vt pt50 item-<?php echo $i; ?>">
         <div class="inner pr50">
            
            <a href="<?php echo "https://".$url; ?>" class="the_category fs15px p10 bred cwhite ib mb20 ls1 <?php echo $blog_class; ?>"><?php echo get_feed_origin($url); ?></a>
            <h2 class="the_title ttn fs18px lh180"><a href="<?php echo $node->getElementsByTagName('link')->item(0)->nodeValue; ?>" class="kszoveg cdarkgrey"><?php echo $node->getElementsByTagName('title')->item(0)->nodeValue; ?></a></h2>

          </div>
        </article><?php
        $i++;
    }
    //echo '</ul>';
}
}
/* ------------------------------------------------------------- */







class transfeed extends WP_Widget {
	function transfeed() {
		$widget_ops = array( 'classname' => 'transfeed', 'description' => 'Atlatszo style RSS' );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'transfeed' );
		$this->WP_Widget( 'transfeed', 'Transparent Feed Widget : RSS', $widget_ops, $control_ops);	
	}
	
	function widget($args, $instance) {
		extract( $args );
		$title	= $instance['title'];
		$RSS_Url = $instance['RSS_Url'];
		$num	= $instance['num'];

		echo $before_widget;

			if ( $title ) {
				echo $before_title;
					echo $title;
				echo $after_title;
			}
		
			trans_list($RSS_Url,$num);
				
	
		echo $after_widget; 
	}
	
	function update($new_instance, $old_instance) {  
		$instance['title']		= strip_tags($new_instance['title']);
		$instance['RSS_Url']		= strip_tags($new_instance['RSS_Url']);
		$instance['num']		= strip_tags($new_instance['num']);
		return $new_instance;
	}
 
	function form($instance) {
		$defaults	= array( 'title' => 'RSS', 'RSS_Url' => '', 'num' => '5');
		$instance = wp_parse_args( (array) $instance, $defaults ); 
	?>

	<p>
		<label for="<?php echo $this->get_field_id('title'); ?>">Title</label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
	</p>

  <p>
		<label for="<?php echo $this->get_field_id('RSS_Url'); ?>">RSS Url</label>
		<input class="widefat" id="<?php echo $this->get_field_id('RSS_Url'); ?>" name="<?php echo $this->get_field_name('RSS_Url'); ?>" type="text" value="<?php echo esc_attr($instance['RSS_Url']); ?>" />
	</p>

	<p>
		<label for="<?php echo $this->get_field_id('num'); ?>">Megjelenítendő elemek száma</label>
		<input id="<?php echo $this->get_field_id('num'); ?>" name="<?php echo $this->get_field_name('num'); ?>" type="text" value="<?php echo esc_attr( $instance['num'] ); ?>" />
	</p>
		
<?php
	}
}
register_widget('transfeed');


// Shared contentwidget
class shared_content_widget extends WP_Widget {
  function shared_content_widget() {
    $widget_ops = array( 'classname' => 'shared_content_widget', 'description' => 'Megosztott tartalom megjelenitese' );
    $control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'shared_content_widget' );
    $this->WP_Widget( 'shared_content_widget', 'Megosztott tartalom ', $widget_ops, $control_ops);
  }

  function widget($args, $instance) {
    extract( $args );
    $sc_id  = $instance['sc_id'];

    // $original_blog_id = get_current_blog_id();
    // switch_to_blog( 2 );

    echo $before_widget;

    $mypost = get_post($sc_id);
    echo apply_filters('the_content',$mypost->post_content);

    echo $after_widget;

    // switch_to_blog( $original_blog_id );
  }

  function update($new_instance, $old_instance) {
    $instance['sc_id']    = strip_tags($new_instance['sc_id']);
    return $new_instance;
  }

  function form($instance) {
    $defaults = array('sc_id' => '');
    $instance = wp_parse_args( (array) $instance, $defaults );
  ?>

  <p>
    <label for="<?php echo $this->get_field_id('sc_id'); ?>">
      Megosztott tartalom kivalasztasa
    </label>
    <select class='widefat' id="<?php echo $this->get_field_id('sc_id'); ?>"
              name="<?php echo $this->get_field_name('sc_id'); ?>" type="text">
      <?php
        // $original_blog_id = get_current_blog_id();
        // switch_to_blog( 2 );

        $loop = new WP_Query( array('post_type' => array('shared_content')));
        while ( $loop->have_posts() ) : $loop->the_post();
          $selected = $instance['sc_id']==get_the_ID()?'selected':'';
          $select = '<option value="'.get_the_ID().'" '.$selected.'>'.get_the_title().'</option>';
          echo $select;
        endwhile;
        // switch_to_blog( $original_blog_id );
      ?>
    </select>

  </p>

<?php
  }
}
register_widget('shared_content_widget');

// shared content shortcode
function sc_render($atts) {
  $slug = $atts['slug'];

  // $original_blog_id = get_current_blog_id();
  // switch_to_blog( 2 );

  //$mypost = get_post(array('name' => $slug));
  $mypost = get_page_by_path($slug, OBJECT, 'shared_content');
  $sc_content = apply_filters('the_content',$mypost->post_content);

  // switch_to_blog( $original_blog_id );
  return $sc_content;
}
//add_shortcode( 'sharedcontent', array( 'shared_content_widget', 'widget' ) );
add_shortcode( 'sharedcontent',  'sc_render');

?>
