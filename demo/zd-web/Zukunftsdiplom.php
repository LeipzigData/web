<?php 
/**
 * User: Hans-Gert Gräbe
 * Date: 2018-06-30
 * Last Update: 2019-01-13
 */

require_once("lib/EasyRdf.php");
require_once("inc.php");

// --- Hilfsfunktionen

function getAddress($adr) {
  $query = '
PREFIX ld: <http://leipzig-data.de/Data/Model/> 
select ?l 
from <http://leipzig-data.de/Data/Adressen/>
Where { 
  <'.$adr.'> rdfs:label ?l . 
}
';
  
  $sparql = new EasyRdf_Sparql_Client('http://leipzig-data.de:8890/sparql');
  $result=$sparql->query($query);
  $s=array();
  foreach ($result as $row) {
      $s[]=$row->l;
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

function showURL($url) {
    return '<a href="'.$url.'">'.$url.'</a>';
}

function createLink($url) {
    return '<a href="getdata.php?show=http://leipzig-data.de/Data/'.$url.'">'.$url.'</a>';
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
} order by ?l
';
  
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
<h3> <a href="getdata.php?show='.$v->wo.'">'.$v->l.'</a></h3>
<div class="row"> <dl>';
    if (isset($v->adr)) { $out.='<dd> <strong>Adresse:</strong> '.getAddress($v->adr).' </dd>'; }
    if (isset($v->e)) { $out.='<dd> <strong>Erreichbarkeit:</strong> '.$v->e.'</dd>'; }
    if (isset($v->url)) { $out.='<dd> <strong>URL:</strong> '.showURL($v->url).'</dd>'; }
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
} order by ?l
';
  
  $sparql = new EasyRdf_Sparql_Client('http://leipzig-data.de:8890/sparql');
  $result=$sparql->query($query); 
  // echo $result->dump("turtle");
  $s=array();
  foreach ($result as $row) {
      $s[]='<dt>'.$row->l.'</dt><dd>'.$row->ziele.'</dd>';
  }
  return '<ul>'.join($s,"\n").'</ul>' ; 		
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
optional { ?a nl:hasLink ?link . }
} order by ?l
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
    if (isset($v->contact)) { $out.='<div class="row">Kontakt: '.$v->contact.' </div>'; }
    if (isset($v->address)) { $out.='<div class="row">Adresse: '.getAddress($v->address).' </div>'; }
    if (isset($v->url)) { $out.='<div class="row">URL: '.showURL($v->url).' </div>'; }
    if (isset($v->link)) { $out.='<div class="row"><a href="'.$v->link.'">Eintrag bei Nachhaltiges Leipzig</a> </div>'; }
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
optional { ?a ical:summary ?sum . }
optional { ?a ical:description ?desc . }
optional { ?a ld:Altersgruppe ?ag . }
optional { ?a ld:Veranstaltungsmodus ?wie . }
optional { ?a ld:Veranstaltungsort ?wo . ?wo rdfs:label ?wol . }
optional { ?a ld:Veranstalter ?wer . ?wer rdfs:label ?werl . }
optional { ?a ld:Kosten ?ko . }
optional { ?a ld:Anmerkung ?an . }
optional { ?a ld:Einordnung ?ein . ?ein rdfs:label ?einl . }
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

function displayEvent($v) {
    $id=str_replace('http://leipzig-data.de/Data/','',$v->a);
    $out='
<h3> <a href="getdata.php?show='.$v->a.'">'.$v->l.'</a></h3>
<div class="row"> <dl>';
    if (isset($v->einl)) { $out.='<dd> <strong>Zum Modul:</strong> '.$v->einl.'</dd>'; }
    if (isset($v->sum)) { $out.='<dd> <strong>Kurzbeschreibung:</strong> '.str_replace("\n",'<br/>',$v->sum).' </dd>'; }
    if (isset($v->desc)) { $out.='<dd> <strong>Langbeschreibung:</strong> '.str_replace("\n",'<br/>',$v->desc).' </dd>'; }
    if (isset($v->wie)) { $out.='<dd> <strong>Veranstaltungsmodus:</strong> '.$v->wie.'</dd>'; }
    if (isset($v->wol)) {
        $out.='<dd> <strong>Veranstaltungsort:</strong> <a href="orte.php">'.$v->wol.'</a></dd>'; }
    if (isset($v->ag)) { $out.='<dd> <strong>Altersgruppe:</strong> '.$v->ag.'</dd>'; }
    if (isset($v->ko)) { $out.='<dd> <strong>Kosten:</strong> '.$v->ko.'</dd>'; }
    if (isset($v->an)) { $out.='<dd> <strong>Anmerkungen:</strong> '.$v->an.'</dd>'; }
    if (isset($v->werl)) { $out.='<dd> <strong>Veranstalter:</strong> '.$v->werl.'</dd>'; }
    if (isset($v->url)) { $out.='<dd> <strong>URL:</strong> '.showURL($v->url).'</dd>'; }
    $out.='<dd> <strong>Teilnehmeranzahl: </strong> '.TeilnehmerProVeranstaltung($id).'</dd>'; 
    $out.='</dl></div>';
    return $out;
}

function derTeilnehmer() {
    $hash=$_GET['id'];
    $text='Die ID '.$hash.' ist nicht vergeben.'; 
    if(isset($hash)) {
        $u=Teilnehmerinfo($hash);
        if(!empty($u)) { $text=$u; }
        return '
<h3>Informationen zum Teilnehmer</h3>
<div class="row"> <p>'.$text.'</p></div>' ; }
    else return '' ;
}

function Teilnehmerinfo($hash) {
    $res=db_query('select * from teilnehmer where hash="'.$hash.'"');
    $s=array();
    foreach ($res as $row) {
        $s[]=getInfo($row['id']);
    }
    return join("<br/>==========<br/>",$s);
}

function getInfo($id) {
    $s=array();
    $res=db_query('select * from teilnehmer where id="'.$id.'"');
    foreach ($res as $row) {
        $s[]='Teilnehmerkennung: '.$row['id'];
        $s[]='Name: '.$row['name'];
        $s[]='Adresse: '.$row['adresse'];
        $s[]='E-Mail: '.$row['email'];
        $s[]='Kontaktinformationen: '.$row['info'];
    }
    $res=db_query('select distinct * from veranstaltungen, besuche where tid="'.$id.'" and vid=id');
    $out='';
    foreach ($res as $row) {
        $out.='<li>'.createLink($row['uri']).": ".$row['title'].' im '.$row['modul'].'</li>';
    }
    if (!empty($out)) $s[]='Besuchte Veranstaltungen:<ul>'.$out.'</ul>';
    return join("<br/>",$s);
}

function dasRanking() {
    $s=array();
    $res=db_query('select * from teilnehmer');
    foreach ($res as $row) {
        $query="select * from besuche, veranstaltungen where tid='".$row['id']."' and vid=id";
        $res1=db_query($query);
        $t=array();
        foreach ($res1 as $row1) { $t[]=createLink($row1['uri']); }
        $s[$row['id']]=join(", ",$t);
    }
    $out='
<table border="2" align="center">
<tr><th>Teilnehmer</th><th>Veranstaltungen</th></tr>';
    foreach ($s as $key => $value) {
        $out.='
<tr><td>'.$key.'</td><td>'.$value.'</td></tr>';
    }
    return $out.'</table>' ; 		
}

function TeilnehmerProVeranstaltung($id) {
    $query="select count(*) as uhu from besuche, veranstaltungen where uri='".$id."' and vid=id";
    $res=db_query($query);
    foreach ($res as $row) { return $row['uhu']; }
}


// ---- test ----
// echo checkTeilnehmer('12');
// echo checkTeilnehmer('thaexaedaiweuvi5ceiphu4hoh6Yi3');
// echo dasRanking();
// echo TeilnehmerProVeranstaltung("Veranstaltung.13");
// echo TeilnehmerProVeranstaltung("Veranstaltung.14");
// echo dieVeranstaltungen();