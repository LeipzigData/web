<?php 
/**
 * User: Hans-Gert Gräbe
 * Date: 2018-06-30
 * Last Update: 2019-05-16

 * Bisherige Version nach Zukunftsdiplom-1.php ausgelagert.
 */

require_once("lib/EasyRdf.php");

// --- Hilfsfunktionen

function getDatum($d) {
// Verwandelt 2019-08-11T15:00:00.000+02:00 in Lesbares
    return date("d. M Y, H:i",strtotime($d)); 
}

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

function createLink($s,$text) {
    return "<a href=\"$s\">$text</a>";
}

function zdtrim($s) {
    return str_replace("http://leipzig-data.de/Data/",'',$s);
}

function mehrzeilig($a) {
    return str_replace("\n",'<br/>',$a);
}

// --- Die Hauptmodule

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
select  ?a ?l ?k ?c ?n
from <http://leipzig-data.de/Data/Zukunftsdiplom/>
Where { 
  ?a a nl:Partner ; rdfs:label ?l .
optional { ?a nl:contact ?k . } 
optional { ?a nl:hasLink ?n . } 
optional { ?a rdfs:comment ?c . } 
} order by ?l
';
  
    $sparql = new EasyRdf_Sparql_Client('http://leipzig-data.de:8890/sparql');
    $result=$sparql->query($query); 
    // echo $result->dump("turtle");
    $s=array();
    foreach ($result as $row) {
        $s[]=displayPartner($row);
    }
    return join("\n",$s) ; 		
}

function getPartner($partner,$row) {
    $user=$row["user_id"];
    $src="http://daten.nachhaltiges-leipzig.de/api/v1/users/$user.json";
    $string = file_get_contents($src);
    $v = json_decode($string, true);
    $partner[$user]=displayPartner($v);
    return $partner;
}

function displayPartner($v) {
    $head=$v->l;
    if (isset($v->n)) { $head=createLink($v->n,$head) ; }
    $out="<h3>$head</h3> <ul><li>Id: $v->a</li>";
    if (isset($v->k)) { $out.="<li>Kontakt: $v->k</li>" ; }
    if (isset($v->c)) {
        $out.="<li>Kommentar: ".mehrzeilig($v->c)."</li>" ;
    }
    return $out."</ul> <p>Hier sind noch die Angebote zu ergänzen.</p>";  
}

function dieVeranstaltungen() {
    return file_get_contents("content.html"); 		
}

function displayBA($v) {
    // ein Bildungsangebot
    $id=$v["id"];
    $nr="1"; // temporär, bis die Sache mit den Themenbereichen geklärt ist.
    $src="http://daten.nachhaltiges-leipzig.de/api/v1/activities/$id.json";
    $title=$v["name"];
    $beschreibung=$v["description"];
    $veranstalter=getUser($v["user_id"]);
    $ort=$v["full_address"];
    $zielgruppe=$v["target_group"];
    $url=$v["info_url"];
    $out='
<h3> <a href="'.$src.'">'.$title.'</a></h3>
<div class="row"> <ul>';
    if (isset($ort)) {
        $out.='<li> <strong>Ort:</strong> '.$ort.' </li>';
    }
    if (isset($veranstalter)) {
        $out.='<li> <strong>Veranstalter:</strong> '.$veranstalter.' </li>';
    }
    if (isset($zielgruppe)) {
        $out.='<li> <strong>Zielgruppe:</strong> '.$zielgruppe.' </li>';
    }
    $out.='<li> <strong>Zum Modul:</strong> '.getModul($nr).'</li>'; 
    if (isset($beschreibung)) {
        $out.='<li> <strong>Beschreibung:</strong> '.$beschreibung.' </li>';
    }
    if (isset($url)) {
        $out.='<li> <a href="'.$url.'">Link des Veranstalters</a> </li>';
    }
    $out.='</dl></div>';
    return $out;
}

function displayEvent($v) {
    // ein Event
    $id=$v["id"];
    $nr="1"; // temporär, bis die Sache mit den Themenbereichen geklärt ist.
    $src="http://daten.nachhaltiges-leipzig.de/api/v1/activities/$id.json";
    $title=$v["name"];
    $beschreibung=$v["description"];
    $veranstalter=getUser($v["user_id"]);
    $ort=$v["full_address"];
    $zielgruppe=$v["target_group"];
    $url=$v["info_url"];
    $von=$v["start_at"];
    $bis=$v["end_at"];
    $out='
<h3> <a href="'.$src.'">'.$title.'</a></h3>
<div class="row"> <ul>';
    if (isset($von)) {
        $out.='<li> <strong>Beginn:</strong> '.getDatum($von).' </li>';
    }
    if (isset($ort)) {
        $out.='<li> <strong>Ort:</strong> '.$ort.' </li>';
    }
    if (isset($veranstalter)) {
        $out.='<li> <strong>Veranstalter:</strong> '.$veranstalter.' </li>';
    }
    if (isset($zielgruppe)) {
        $out.='<li> <strong>Zielgruppe:</strong> '.$zielgruppe.' </li>';
    }
    $out.='<li> <strong>Zum Modul:</strong> '.getModul($nr).'</li>'; 
    if (isset($beschreibung)) {
        $out.='<li> <strong>Beschreibung:</strong> '.$beschreibung.' </li>';
    }
    if (isset($url)) {
        $out.='<li> <a href="'.$url.'">Link des Veranstalters</a> </li>';
    }
    $out.='</ul></div>';
    return $out;
}

function getUser($nr) {
    $src="http://daten.nachhaltiges-leipzig.de/api/v1/users/$nr.json";
    $string = file_get_contents($src);
    $res = json_decode($string, true);
    return '<a href="'.$src.'">'.$res["name"].'</a>';
}

function getModul($nr) {
    return "Noch nicht implementiert.";
}

function getVeranstaltungen() { // ein Mock
    $src="http://leipzig-data.de/demo/zd-web/Dumps/Zukunftsdiplom.json";
    // $src="Dumps/Zukunftsdiplom.json";
    $string = file_get_contents($src);
    $res = json_decode($string, true);
    $s=array();
    foreach($res as $row) {
        $s[$row["id"]]=$row;
    }
    return $s;
}

function displayService($v) {
    $id=$v["id"];
    $src="http://daten.nachhaltiges-leipzig.de/api/v1/activities/$id.json";
    $title=$v["name"];
    $stype=$v["service_type"];
    $out='
<li> <a href="'.$src.'">'.$title.'</a>, Service Type '.$stype.'</li>';
        return $out;
}

// ---- test ----
// echo dieModule();
// echo dieVeranstaltungen();
// echo diePartner();

