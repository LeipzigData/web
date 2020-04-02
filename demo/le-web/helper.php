<?php

require 'vendor/autoload.php';

function getDatum($d) {
// Verwandelt 2019-08-11T15:00:00.000+02:00 in Lesbares
    $out=date("d. M Y, H:i",strtotime($d));
    $out=str_replace('Jan','Januar',$out);
    $out=str_replace('Feb','Februar',$out);
    $out=str_replace('Mar','März',$out);
    $out=str_replace('Apr','April',$out);
    $out=str_replace('May','Mai',$out);
    $out=str_replace('Jun','Juni',$out);
    $out=str_replace('Jul','Juli',$out);
    $out=str_replace('Aug','August',$out);
    $out=str_replace('Sep','September',$out);
    $out=str_replace('Oct','Oktober',$out);
    $out=str_replace('Nov','November',$out);
    $out=str_replace('Dec','Dezember',$out);
    return $out;
}

function createLink($s,$text) {
    return "<a href=\"$s\" target=\"_blank\">$text</a>";
}

function fixURL($u) {
    if ($u=='http://') { return ''; }
}

function fixURI($u) { // Umlaute und so'n Zeugs transformieren
  $u=str_replace("str.", "strasse", $u);
  $u=str_replace(" ", "", $u);
  $u=str_replace("ä", "ae", $u);
  $u=str_replace("ö", "oe", $u);
  $u=str_replace("ü", "ue", $u);
  $u=str_replace("Ä", "Ae", $u);
  $u=str_replace("Ö", "Oe", $u);
  $u=str_replace("Ü", "Ue", $u);
  $u=str_replace("ß", "ss", $u);  
  return $u;
}

function setNamespace() {
  EasyRdf_Namespace::set('ld', 'http://leipzig-data.de/Data/Model/');
  EasyRdf_Namespace::set('rdf', 'http://www.w3.org/1999/02/22-rdf-syntax-ns#');
  EasyRdf_Namespace::set('rdfs', 'http://www.w3.org/2000/01/rdf-schema#');
  EasyRdf_Namespace::set('owl', 'http://www.w3.org/2002/07/owl#');
  EasyRdf_Namespace::set('foaf', 'http://xmlns.com/foaf/0.1/');
  EasyRdf_Namespace::set('org', 'http://www.w3.org/ns/org#');
  EasyRdf_Namespace::set('ld', 'http://leipzig-data.de/Data/Model/');
  EasyRdf_Namespace::set('le', 'http://leipziger-ecken.de/Data/Model#');
  EasyRdf_Namespace::set('ical', 'http://www.w3.org/2002/12/cal/ical#');
  EasyRdf_Namespace::set('dct', 'http://purl.org/dc/terms/');
  EasyRdf_Namespace::set('gsp', 'http://www.opengis.net/ont/geosparql#');
}

function loadData() {
  $graph = new EasyRdf_Graph("http://leipziger-ecken.de/rdf/");
  $graph->parseFile("Data.json");
  return $graph;
}

function showData($graph) {
    $graph->parseFile("Data.json");
    setNamespace();
    return $graph->serialise("turtle");
}

function displayAddress($v) {
    $geo=$v->get("gsp:asWKT");
    $name=$v->get("rdfs:label");
    $out='';
    if (!empty($name)) {
        $out.='<li><strong>Adresse:</strong> '.$name.'</li>';
    }
    if (!empty($geo)) {
        $out.='<li>Geokoordinaten im WKT-Format: '.$geo.'</li>';
    }
    return $out;
}

