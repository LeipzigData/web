<?php 

require_once("lib/EasyRdf.php");

function pass() {  
  EasyRdf_Namespace::set('ical', 'http://www.w3.org/2002/12/cal/ical#');
  EasyRdf_Namespace::set('ld', 'http://leipzig-data.de/Data/Model/');
  EasyRdf_Namespace::set('nl', 'http://nachhaltiges-leipzig.de/Data/Model#');

  $out='<h2> Die Module </h2>';
  $out.=dieModule();

  $out.='<h2> Die Partner </h2>';
  $out.=diePartner();
  return $out;
}

function diePartnerOld() {
  $query = '
PREFIX ld: <http://leipzig-data.de/Data/Model/> 
PREFIX nl: <http://nachhaltiges-leipzig.de/Data/Model#> 
PREFIX ical: <http://www.w3.org/2002/12/cal/ical#>
construct { ?a ?p ?q . } 
from <http://leipzig-data.de/Data/Zukunftspass/>
Where { 
?a  a nl:Partner ; ?p ?q . 
}
';
  
  $sparql = new EasyRdf_Sparql_Client('http://leipzig-data.de:8890/sparql');
  $result=$sparql->query($query); // CONSTRUCT funktioniert nicht mit php-7
  // echo $result->dump("turtle");
  $s=array();
  foreach ($result->allOfType("nl:Partner") as $v) {
      $s[$v->getUri()]=displayPartner($v);
  }
  return join($s,"\n") ; 		
}

function diePartner() {
    $graph=new EasyRdf_Graph();
    $graph->parsefile("http://www.leipzig-data.de/RDFData/Zukunftsdiplom.ttl");
  // echo $result->dump("turtle");
  $s=array();
  foreach ($graph->allOfType("nl:Partner") as $v) {
      $s[$v->getUri()]=displayPartner($v);
  }
  sort($s);
  return join($s,"\n") ; 		
}

function displayPartner($v) {
    $a=$v->getUri();
    $label=$v->get('rdfs:label'); 
    $contact=$v->get('ld:contact'); 
    $gelistet=$v->get('nl:Ferienpass');
    $teilnahme=$v->get('nl:Teilnahme');
    $abschluss=$v->get('nl:Abschlussveranstaltung');
    $com=$v->get('rdfs:comment');
    if (strpos($teilnahme,"bisher keine Antwort")!==false) { return ''; }
    $out='
<h3> <a href="getdata.php?show='.$a.'">'.$label.'</a></h3>
<div class="row">Ferienpass: '.$gelistet.' </div>
<div class="row">Anmerkungen: '.$teilnahme.' </div>';
    return $out;
}

function mehrzeilig($a) {
    $b=array(); 
    foreach($a as $event) {
        $b[]='<li> '.str_replace("\n",'<br/>',$event).' </li>' ;
    }
    return "<ul>".join("\n",$b)."</ul>";
}

function dieModule() {
    $graph=new EasyRdf_Graph();
    $graph->parsefile("http://www.leipzig-data.de/RDFData/Zukunftsdiplom.ttl");
  // echo $result->dump("turtle");
  $s=array();
  foreach ($graph->allOfType("nl:Modul") as $v) {
      $s[$v->getUri()]=displayEvent($v);
  }
  sort($s);
  return join($s,"\n") ; 		
}

function displayEvent($v) {
    $a=$v->getUri();
    $label=$v->get('rdfs:label');
    $description=$v->get('ical:description');
    $altersgruppe=$v->get('ld:Altersgruppe');
    $kosten=$v->get('ld:Kosten');
    $modus=$v->get('ld:Veranstaltungsmodus');
    $ort=$v->get('ld:Veranstaltungsort');
    $wer=$v->get('ld:Veranstalter');
    $url=$v->get('ical:url');
    $out='
<h3> <a href="getdata.php?show='.$a.'">'.$label.'</a></h3>
<div class="row">
<dl><dd> <strong>Beschreibung:</strong> '.str_replace("\n",'<br/>',$description).' </dd>
<dd> <strong>Wie angeboten:</strong> '.$modus.'</dd>
<dd> <strong>Wo angeboten:</strong> '.$ort.'</dd>
<dd> <strong>Altersgruppe:</strong> '.$altersgruppe.'</dd>
<dd> <strong>Kosten:</strong> '.$kosten.'</dd>
<dd> <strong>URL:</strong> '.$url.'</dd>
<dd> <strong>Veranstalter:</strong> '.$wer.'</dd></dl></div>
';
    return $out;
}


// ---- test ----
// echo pass();