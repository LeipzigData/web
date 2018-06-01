<?php

require 'vendor/autoload.php';

// --- Die main Funktion

function pass() {  
  EasyRdf_Namespace::set('ical', 'http://www.w3.org/2002/12/cal/ical#');
  EasyRdf_Namespace::set('ld', 'http://leipzig-data.de/Data/Model/');
  EasyRdf_Namespace::set('nl', 'http://nachhaltiges-leipzig.de/Data/Model#');

  $out='<h2> Die Module </h2>';
  $out.=dieModule();

  $out.='<h2> Die Themenbereiche </h2>';
  $out.=dieThemenbereiche();

  $out.='<h2> Die Veranstaltungen </h2>';
  $out.=dieVeranstaltungen();

  $out.='<h2> Die Partner </h2>';
  $out.=diePartner();
  
  $out.='<h2> Die Orte </h2>';
  $out.=dieOrte();
  return $out;
}

// --- Hilfsfunktionen

function listeVeranstaltungen($praedikat,$objekt) {
  $query = '
PREFIX ld: <http://leipzig-data.de/Data/Model/> 
PREFIX nl: <http://nachhaltiges-leipzig.de/Data/Model#> 
select  ?a 
from <http://leipzig-data.de/Data/Zukunftsdiplom/>
Where { 
  ?a a nl:Event; '.$praedikat.' '.$objekt.' . 
}
';
  
  $sparql = new EasyRdf_Sparql_Client('http://leipzig-data.de:8890/sparql');
  $result=$sparql->query($query);
  $s=array();
  foreach ($result as $row) {
      $s[]=zdtrim($row->a);
  } 
  return join(", ",$s);
}

function zdtrim($s) {
    return str_replace("http://leipzig-data.de/Data/",'',$s);
}

function mehrzeilig($a) {
    $b=array(); 
    foreach($a as $event) {
        $b[]='<li> '.str_replace("\n",'<br/>',$event).' </li>' ;
    }
    return "<ul>".join("\n",$b)."</ul>";
}

// --- Die Hauptmodule

function dieOrte() {
  $query = 'PREFIX ld: <http://leipzig-data.de/Data/Model/> 
PREFIX nl: <http://nachhaltiges-leipzig.de/Data/Model#> 
PREFIX ical: <http://www.w3.org/2002/12/cal/ical#>
select distinct(?wo) ?l ?adr ?e ?url
from <http://leipzig-data.de/Data/Zukunftsdiplom/>
Where {
?a ld:Veranstaltungsort ?wo . ?wo rdfs:label ?l .
optional { ?wo ld:hasAddress ?adr . }
optional { ?wo ld:erreichbar ?e . }
optional { ?wo foaf:homepage ?url . }
} ';
  
  $sparql = new EasyRdf_Sparql_Client('http://leipzig-data.de:8890/sparql');
  $result=$sparql->query($query); 
  $s=array();
  foreach ($result as $row) {
      $s[]=displayOrt($row);
  }
  return join($s,"\n") ; 		
}

function displayOrt($v) {
    $out='
<h3> <a href="getdata.php?show='.$v->a.'">'.$v->l.'</a></h3>
<div class="row"> <dl>';
    if (isset($v->adr))   { $out.='<dd> <strong>Adresse:</strong> '.$v->adr.' </dd>'; }
    if (isset($v->e))   { $out.='<dd> <strong>Erreichbarkeit:</strong> '.$v->e.'</dd>'; }
    if (isset($v->url))   { $out.='<dd> <strong>URL:</strong> '.$v->url.'</dd>'; }
    $out.='</dl></div>';
    return $out;
}

function dieModule() {
  $query = '
PREFIX ld: <http://leipzig-data.de/Data/Model/> 
PREFIX nl: <http://nachhaltiges-leipzig.de/Data/Model#> 
select  ?a ?l ?ziele
from <http://leipzig-data.de/Data/Zukunftsdiplom/>
Where { 
  ?a a nl:Modul ; rdfs:label ?l; ld:Lernziele ?ziele . 
}
';
  
  $sparql = new EasyRdf_Sparql_Client('http://leipzig-data.de:8890/sparql');
  $result=$sparql->query($query); 
  // echo $result->dump("turtle");
  $s=array();
  foreach ($result as $row) {
      $u=listeVeranstaltungen("ld:Einordnung","<$row->a>"); 
      $s[]='<tr><td>'.zdtrim($row->a).'</td><td>'.$row->l.'</td><td>'.$row->ziele.
          '</td><td>'.$u.'</td></tr>';
  }
  return '<table align="center" border="3" width="70%">
<tr><th>Modul</th><th>Thema</th><th>Lernziele</th><th>Veranstaltungen</th></tr>
'.join($s,"\n").'
</table>' ; 		
}

function dieThemenbereiche() {
  $query = '
PREFIX ld: <http://leipzig-data.de/Data/Model/> 
PREFIX nl: <http://nachhaltiges-leipzig.de/Data/Model#> 
select  ?a ?l 
from <http://leipzig-data.de/Data/Zukunftsdiplom/>
Where { 
  ?a a nl:Themenbereich ; rdfs:label ?l . 
}
';
  
  $sparql = new EasyRdf_Sparql_Client('http://leipzig-data.de:8890/sparql');
  $result=$sparql->query($query); 
  // echo $result->dump("turtle");
  $s=array();
  foreach ($result as $row) {
      $u=listeVeranstaltungen("ld:Einordnung","<$row->a>"); 
      $s[]='<tr><td>'.zdtrim($row->a).'</td><td>'.$row->l.'</td><td>'.$u.'</td></tr>';
  }
  return '<table align="center" border="3" width="70%">
<tr><th>Themenbereich</th><th>Thema</th><th>Veranstaltungen</th></tr>
'.join($s,"\n").'
</table>' ; 		
}

function diePartner() {
  $query = '
PREFIX ld: <http://leipzig-data.de/Data/Model/> 
PREFIX nl: <http://nachhaltiges-leipzig.de/Data/Model#> 
PREFIX ical: <http://www.w3.org/2002/12/cal/ical#>
select * 
from <http://leipzig-data.de/Data/Zukunftsdiplom/>
Where { 
?a  a nl:Partner ; rdfs:label ?l . 
optional { ?a nl:Teilnahme ?tn . }
optional { ?a ld:contact ?contact . }
optional { ?a ld:hasAddress ?address . }
optional { ?a foaf:homepage ?url . }
}
';
  
  $sparql = new EasyRdf_Sparql_Client('http://leipzig-data.de:8890/sparql');
  $result=$sparql->query($query); 
  // echo $result->dump("turtle");
  $s=array();
  foreach ($result as $row) {
      $s[]=displayPartner($row);
  }
  return join($s,"\n") ; 		
}

function displayPartner($v) {
    if (isset($v->tn)) { return ''; }
    $out='
<h3> <a href="getdata.php?show='.$v->a.'">'.$v->l.'</a></h3>';
    if (isset($v->contact))   { $out.='<div class="row">Kontakt: '.$v->contact.' </div>'; }
    if (isset($v->address))   { $out.='<div class="row">Adresse: '.$v->address.' </div>'; }
    if (isset($v->url))   { $out.='<div class="row">URL: <a href='.$v->url.'>'.$v->url.'</a> </div>'; }
    return $out;
}

function dieVeranstaltungen() {
  $query = '
PREFIX ld: <http://leipzig-data.de/Data/Model/> 
PREFIX nl: <http://nachhaltiges-leipzig.de/Data/Model#> 
PREFIX ical: <http://www.w3.org/2002/12/cal/ical#>
select * 
from <http://leipzig-data.de/Data/Zukunftsdiplom/>
Where { 
?a  a nl:Event ; rdfs:label ?l . 
optional { ?a ical:description ?desc . }
optional { ?a ld:Altersgruppe ?ag . }
optional { ?a ld:Veranstaltungsmodus ?wie . }
optional { ?a ld:Veranstaltungsort ?wo . }
optional { ?a ld:Veranstalter ?wer . }
optional { ?a ld:Kosten ?ko . }
optional { ?a ld:Anmerkung ?an . }
optional { ?a ical:url ?url . }
} order by ?a 
';
  
  $sparql = new EasyRdf_Sparql_Client('http://leipzig-data.de:8890/sparql');
  $result=$sparql->query($query); 
  // echo $result->dump("turtle");
  $s=array();
  foreach ($result as $row) {
      $s[]=displayEvent($row);
  }
  //sort($s);
  return join($s,"\n") ; 		
}

/* 

Vorschlag Schirmer vom 24.5., was angegeben werden soll
* Titel der Veranstaltung
* Kurzbeschreibung 
* Datum, Uhrzeit, Ort - Veranstaltungsmodus
* ggf. Erreichbarkeit 
* Kosten
* Anmerkungen: Was ist mitzubringen oder zu beachten? (ganz kurz)
Aus meiner Sicht weiter:
* Veranstalter
* Altersgruppe
* URL der Veranstaltung


*/

function displayEvent($v) {
    $out='
<h3> '.zdtrim($v->a).': <a href="getdata.php?show='.$v->a.'">'.$v->l.'</a></h3>
<div class="row"> <dl>';
    if (isset($v->desc))   { $out.='<dd> <strong>Beschreibung:</strong> '.str_replace("\n",'<br/>',$v->desc).' </dd>'; }
    if (isset($v->wie))   { $out.='<dd> <strong>Veranstaltungsmodus:</strong> '.$v->wie.'</dd>'; }
    if (isset($v->wo))   { $out.='<dd> <strong>Veranstaltungsort:</strong> '.$v->wo.'</dd>'; }
    if (isset($v->ag))   { $out.='<dd> <strong>Altersgruppe:</strong> '.$v->ag.'</dd>'; }
    if (isset($v->ko))   { $out.='<dd> <strong>Kosten:</strong> '.$v->ko.'</dd>'; }
    if (isset($v->an))   { $out.='<dd> <strong>Anmerkungen:</strong> '.$v->an.'</dd>'; }
    if (isset($v->wer))   { $out.='<dd> <strong>Veranstalter:</strong> '.$v->wer.'</dd>'; }
    if (isset($v->url))   { $out.='<dd> <strong>URL:</strong> '.$v->url.'</dd>'; }
    $out.='</dl></div>';
    return $out;
}
  
if (defined('ABSPATH') ) { 
    add_shortcode('dieOrte', 'dieOrte');
    add_shortcode('dieModule', 'dieModule');
    add_shortcode('dieThemenbereiche', 'dieThemenbereiche');
    add_shortcode('diePartner', 'diePartner');
    add_shortcode('dieVeranstaltungen', 'dieVeranstaltungen');
} else {
    $s=array(); echo pass($s); // for testing
}

?>
