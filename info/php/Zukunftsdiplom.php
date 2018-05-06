<?php 

require_once("lib/EasyRdf.php");

function pass() {  
  EasyRdf_Namespace::set('ical', 'http://www.w3.org/2002/12/cal/ical#');
  EasyRdf_Namespace::set('ld', 'http://leipzig-data.de/Data/Model/');
  EasyRdf_Namespace::set('nl', 'http://nachhaltiges-leipzig.de/Data/Model#');

  $out='<h2> Die Module </h2>';
  $out.=dieModule();

  $out='<h2> Die Veranstaltungen </h2>';
  $out.=dieVeranstaltungen();

  $out.='<h2> Die Partner </h2>';
  $out.=diePartner();
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
      $s[]='<tr><td>'.$row->l.'</td><td>'.$row->ziele.'</td></tr>';
  }
  return '<table align="center">
<tr><th>Modul</th><th>Lernziele</th></tr>
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

function mehrzeilig($a) {
    $b=array(); 
    foreach($a as $event) {
        $b[]='<li> '.str_replace("\n",'<br/>',$event).' </li>' ;
    }
    return "<ul>".join("\n",$b)."</ul>";
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
}
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

function displayEvent($v) {
    $description=$v->desc;
    $out='
<h3> <a href="getdata.php?show='.$v->a.'">'.$v->l.'</a></h3>
<div class="row">
<dl><dd> <strong>Beschreibung:</strong> '.str_replace("\n",'<br/>',$description).' </dd>
<dd> <strong>Wie angeboten:</strong> '.$v->wie.'</dd>
<dd> <strong>Wo angeboten:</strong> '.$v->wo.'</dd>
<dd> <strong>Altersgruppe:</strong> '.$v->ag.'</dd>
<dd> <strong>Kosten:</strong> '.$v->ko.'</dd>
<dd> <strong>Anmerkungen:</strong> '.$v->an.'</dd>
<dd> <strong>URL:</strong> '.$v->url.'</dd>
<dd> <strong>Veranstalter:</strong> '.$v->wer.'</dd></dl></div>
';
    return $out;
}


// ---- test ----
// echo pass();