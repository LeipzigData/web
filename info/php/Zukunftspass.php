<?php 

require_once("lib/EasyRdf.php");

function pass() {  
  EasyRdf_Namespace::set('ical', 'http://www.w3.org/2002/12/cal/ical#');
  EasyRdf_Namespace::set('ld', 'http://leipzig-data.de/Data/Model/');
  EasyRdf_Namespace::set('nl', 'http://nachhaltiges-leipzig.de/Data/Model#');

  $out='<h2> Die Partner </h2>';
  $out.=diePartner();
  $out.='<h2> Relevante Events in den Sommerferien 2017 </h2>';
  $out.=dieEvents();
  return $out;
}

function diePartner() {
  $query = '
PREFIX ld: <http://leipzig-data.de/Data/Model/> 
PREFIX nl: <http://nachhaltiges-leipzig.de/Data/Model#> 
PREFIX ical: <http://www.w3.org/2002/12/cal/ical#>
construct { ?a ?p ?q . } 
from <http://leipzig-data.de/Data/Zukunftspass/>
from <http://leipzig-data.de/Data/Vereine/>
from <http://leipzig-data.de/Data/Unternehmen/>
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

function displayPartner($v) {
    $a=$v->getUri();
    $label=$v->get('rdfs:label'); 
    $loc=$v->get('nl:Ferienpass');
    $com=$v->get('rdfs:comment');
    $out='
<div class="row">
<h3> <a href="getdata.php?show='.$a.'">'.$label.'</a></h3>
<dl><dt> Kommentar: '.$loc.'. '.$com.' </dt>';
    return $out."</div>";
}

function dieEvents() {
  $query = '
PREFIX ld: <http://leipzig-data.de/Data/Model/> 
PREFIX nl: <http://nachhaltiges-leipzig.de/Data/Model#> 
PREFIX ical: <http://www.w3.org/2002/12/cal/ical#>
construct {
?a a ld:Event ; rdfs:label ?l ; ical:dtstart ?begin ; ical:description ?d ;
ical:location ?locname . 
}
from <http://leipzig-data.de/Data/Zukunftspass/>
from <http://leipzig-data.de/Data/Orte/>
from <http://leipzig-data.de/Data/Treffpunkte/>
from <http://leipzig-data.de/Data/Adressen/>
Where { 
?a a ld:Event ; rdfs:label ?l ; ical:dtstart ?begin .
optional { ?a ical:description ?d . } 
optional { ?a ld:hatVeranstaltungsort ?loc . ?loc rdfs:label ?locname . } 
optional { ?a ld:hatTreffpunkt ?loc . ?loc rdfs:label ?locname . } 
}
';
  
  $sparql = new EasyRdf_Sparql_Client('http://leipzig-data.de:8890/sparql');
  $result=$sparql->query($query); // CONSTRUCT funktioniert nicht mit php-7
  // echo $result->dump("turtle");
  $s=array();
  foreach ($result->allOfType("ld:Event") as $v) {
    $a=$v->getUri();
    $date=$v->get('ical:dtstart');
    $s["$date.$a"]=displayPassEvent($v);
  }
  ksort($s);
  return join($s,"\n") ; 		
}

function displayPassEvent($v) {
    $a=$v->getUri();
    $label=$v->get('rdfs:label'); 
    $date=$v->get('ical:dtstart');
    $from=date_format(date_create($date),"d.m.Y H:i");
    $loc=$v->get('ical:location');
    $description=$v->get('ical:description');
    $out='
<div class="row">
<h3> <a href="getdata.php?show='.$a.'">'.$label.'</a></h3>
<dl><dt> Wann? '.$from.' </dt><dt> Wo? '.$loc.'.</dt>
<dt> <strong>Beschreibung:</strong> '.$description.'</dt>
';
    return $out."</div>";
}


// ---- test ----
// echo pass();