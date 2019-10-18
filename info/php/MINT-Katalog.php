<?php 

/* 

Author: Hans-Gert Graebe
last modified: 2019-10-16

 */

require_once("lib/EasyRdf.php");

function multiline($a) {
    return str_replace("\n", " <br/>", $a);
}

function katalog($quelle) {  
  EasyRdf_Namespace::set('dct', 'http://purl.org/dc/terms/');
  EasyRdf_Namespace::set('dcat', 'http://www.w3.org/ns/dcat#');

  return dieDatasets($quelle);
}

function dieDatasets($quelle) {
    $graph=new EasyRdf_Graph();
    $graph->parsefile($quelle);
    // echo $result->dump("turtle");
    $s=array();
    foreach ($graph->allOfType("dcat:Dataset") as $v) {
        $s[$v->getUri()]=displayDataset($quelle,$v);
    }
    sort($s);
    return join($s,"\n") ; 		
}

function displayDataset($quelle,$v) {
    $a=$v->getUri();
    $label=$v->get('dct:title'); 
    $landingPage=$v->all('dcat:landingPage'); 
    $description=$v->get('dct:description');
    $datensaetze=displayDistributions($v);
    $url=$v->get('foaf:homepage');
    $out='
<!--    <h3> <a href="getdata.php?src='.$quelle.'&show='.$a.'">'.$label.'</a></h3> -->
    <h3> '.$label.'</h3>
    <div class="row"><strong>Beschreibung:</strong> '.multiline($description).' </div>
';
    if (isset($landingPage)) {
        foreach ($landingPage as $v) {
            $out.='<div class="row"><strong>Landing Page:</strong> '
                .highlightLink($v).' </div>';
        }
    }
    if (isset($url)) {
        $out.='<div class="row"><strong>Weitere URL:</strong> '.$url.' </div>';
    }
    if (!empty($datensaetze)) {
        $out.='<h4>Datensätze</h4><dl>'
            .$datensaetze.'</dl>';
    }
    return $out;
}

function displayDistributions($v) {
    $out='';
    foreach($v->all('dcat:distribution') as $u) {
        $a=$u->getURI();
        $label=$u->get('dct:title'); 
        $mediatype=$u->get('dcat:mediaType'); 
        $durl=$u->get('dcat:downloadURL'); 
        $aurl=$u->get('dcat:accessURL'); 
        $out.='<dt> <a href="getdata.php?show='.$a.'">'.$label.'</a></dt><ul>';
        if (isset($mediatype)) { $out.='<li><strong>MediaType:</strong> '.$mediatype.' </li>'; }
        if (isset($durl)) { $out.='<li><strong>DownloadURL:</strong> '.highlightLink($durl).' </li>'; }
        if (isset($aurl)) { $out.='<li><strong>AccessURL:</strong> '.highlightLink($aurl).' </li>'; }
        $out.='</ul>';
    }
    return $out;
}

function highlightLink($u) {
    $u=preg_replace(".(\S+//\S+).","<a href=\"$1\">$1</a>",$u);
    return $u;
}

// ---- test ----
//echo katalog("../rdf/MINT-Katalog.rdf");
//echo katalog("../rdf/MINT-Katalog-MINT-MD.rdf");
