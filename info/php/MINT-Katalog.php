<?php 

/* changed to lib/EasyRdf.php and CONSTRUCT query */

require_once("lib/EasyRdf.php");

// --------------- MINT-Orte --------------------------------------

function katalog() {  
  EasyRdf_Namespace::set('dct', 'http://purl.org/dc/terms/');
  EasyRdf_Namespace::set('dcat', 'http://www.w3.org/ns/dcat#');
  EasyRdf_Namespace::set('', 'http://leipzig-data.de/Data/MINT-Katalog/');

  $out='<h2> Die Datasets </h2>';
  $out.=dieDatasets();
  return $out;
}

function dieDatasets() {
    $graph=new EasyRdf_Graph();
    $graph->parsefile("http://www.leipzig-data.de/RDFData/MINT-Katalog.ttl");
  // echo $result->dump("turtle");
  $s=array();
  foreach ($graph->allOfType("dcat:DataSet") as $v) {
      $s[$v->getUri()]=displayDataset($v);
  }
  sort($s);
  return join($s,"\n") ; 		
}

function displayDataset($v) {
    $a=$v->getUri();
    $label=$v->get('dct:title'); 
    $landingPage=$v->get('dcat:landingPage'); 
    $description=$v->get('dct:description');
    $url=$v->get('foaf:homepage');
    $distributions=join(", ",$v->all('dcat:distribution'));
    $out='
<h3> <a href="getdata.php?show='.$a.'">'.$label.'</a></h3>
<div class="row">Webseite: '.$landingPage.' </div>
<div class="row">Beschreibung: '.$description.' </div>
<div class="row">Homepage: '.$url.' </div>
<div class="row">Datensätze: '.$distributions.' </div>';
    return $out;
}



// ---- test ----
//echo katalog();
