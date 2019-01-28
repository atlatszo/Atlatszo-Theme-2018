<?php
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
?>