<?php 

/* 

Author: Hans-Gert Graebe
last modified: 2018-04-15

 */

require_once("lib/EasyRdf.php");

function katalog() {  
  EasyRdf_Namespace::set('dct', 'http://purl.org/dc/terms/');
  EasyRdf_Namespace::set('dcat', 'http://www.w3.org/ns/dcat#');
  EasyRdf_Namespace::set('', 'http://leipzig-data.de/Data/MINT-Katalog/');

  $out='<h2>Liste der MINT-Kataloge mit mitteldeutschen Einträgen</h2>';
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
    $datensaetze=displayDistributions($v);
    $url=$v->get('foaf:homepage');
    $out='
    <h3> <a href="getdata.php?show='.$a.'">'.$label.'</a></h3>
    <div class="row"><strong>Beschreibung:</strong> '.$description.' </div>
';
    if (isset($landingPage)) {
        $out.='<div class="row"><strong>Webseite:</strong> '
            .$landingPage.' </div>';
    }
    if (isset($url)) {
        $out.='<div class="row"><strong>Weitere URL:</strong> '.$url.' </div>';
    }
    if (!empty($datensaetze)) {
        $out.='<div class="row"><h5>Datensätze<h5><ul>'
            .$datensaetze.'</ul></div>';
    }
    return $out;
}

function displayDistributions($v) {
    $out='';
    foreach($v->all('dcat:distribution') as $u) {
        $out.='<li>'.$u->getURI().'</li>';
    }
    return $out;
}



// ---- test ----
// echo katalog();
