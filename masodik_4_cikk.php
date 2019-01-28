<?php
$top_sztori_alatti_tipus=get_field('top_sztori_alatti_tipus');

if ($top_sztori_alatti_tipus=="blogajánló") { ?>
<div class="masodik_4_cikk pb80 elso_blogajanlo">
	<div class="shell">

<?php
  $num=4;
  $opts = http_opts();

  $context = stream_context_create($opts);
  $source = file_get_contents('https://dummy.atlatszo.hu/multifeed', false, $context);
	  if ($source=="") return false;
	  else {
	    $DOM = new DOMDocument;
	    $DOM->loadXML($source);
	    $nodes = $DOM->getElementsByTagName("item");
	    $i=0;

	    foreach($nodes as $node){
	      
	      if($i==$num) {break;}
	      $url=get_feed_url($node);
	      $blog_name=str_replace('.', '-', $url);
	      if ($blog_name!="blog-atlatszo-hu") {$blog_class="kek";} else {$blog_class="";}
	      ?><article class="n25 ib vt mb40">
	         <div class="inner pr50">

	            <a href="<?php echo "https://".$url; ?>" class="the_category mb30 bl <?php echo $blog_class; ?>"><?php echo get_feed_origin($url); ?></a>
	            <h3 class="the_title ttn"><a href="<?php echo $node->getElementsByTagName('link')->item(0)->nodeValue; ?>" class="kszoveg cdarkgrey lh200"><?php echo $node->getElementsByTagName('title')->item(0)->nodeValue; ?></a></h3>

	          </div>
	        </article><?php
	        $i++;
	    }

	}
	?>

	</div>
</div>
<?php
}

if (have_rows('statikus_cikkek') && $top_sztori_alatti_tipus=="statikus cikkek") { ?>

<div class="masodik_4_cikk pb80">
	<div class="shell">
		<?php while (have_rows('statikus_cikkek') ) : the_row();

	$statikus_cikk_kategoria=get_sub_field('statikus_cikk_kategoria');
	$statikus_cikk=get_sub_field('statikus_cikk');

	$statikus_cikk_kategoria_szin=get_sub_field('statikus_cikk_kategoria_szin');

	// Ha nincs kiválasztva cikk

	if (!$statikus_cikk) {
	
		$statikus_cikk_cim=get_sub_field('statikus_cikk_cim');
		$statikus_cikk_url=get_sub_field('statikus_cikk_url');	
	
	} else {

		$statikus_cikk_cim=get_the_title($statikus_cikk[0]);
		$statikus_cikk_url=get_permalink($statikus_cikk[0]);

	}

	// Ha nincs kiválasztva kategória

	if (!$statikus_cikk_kategoria) {
		$statikus_cikk_kategoria_nev=get_sub_field('statikus_cikk_kategoria_nev');
		$statikus_cikk_kategoria_url=get_sub_field('statikus_cikk_kategoria_url');

	} else {

		$statikus_cikk_kategoria_url=get_category_link($statikus_cikk_kategoria);
		$statikus_cikk_kategoria_nev=get_cat_name($statikus_cikk_kategoria);

	}

		?><article class="n25 ib vt mb40">
			<div class="inner pr50">
				<a href="<?php echo $statikus_cikk_kategoria_url; ?>" class="the_category mb30 bl <?php echo $statikus_cikk_kategoria_szin; ?>"><?php echo $statikus_cikk_kategoria_nev; ?></a>
				<h3 class="the_title ttn"><a href="<?php echo $statikus_cikk_url; ?>" class="kszoveg cdarkgrey lh200"><?php echo $statikus_cikk_cim; ?></a></h3>
			</div>
		</article><?php endwhile; ?>
	</div>
</div>

<?php } ?>