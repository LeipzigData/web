<?php 
/**
 * User: Hans-Gert Gräbe
 * Date: 2018-06-30
 * Last Update: 2019-03-05
 */

require_once("lib/EasyRdf.php");
require_once("inc.php");

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

function createLink($s) {
    return "<a href=\"$s\">$s</a>";
}

function zdtrim($s) {
    return str_replace("http://leipzig-data.de/Data/",'',$s);
}

function mehrzeilig($a) {
    return str_replace("\n",'<br/>',$a);
}

// --- Die Hauptmodule

function dieOrte() {
    $orte=array();
    foreach (getVeranstaltungen() as $row) {
        $orte[$row["full_address"]]=$row;
    }
    $s=array();
    foreach ($orte as $row) {
        $s[]=displayOrt($row);
    }
    return join($s,"\n") ; 		
}

function displayOrt($v) { 
    return '<h3>'.$v["full_address"].'</h3> <p>Weitere Informationen sind zu ergänzen</p>';
    // Das NL-Ortskonzept muss noch mit LD verschränkt werden 
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
    $out="<h3>$v->l</h3> <ul><li>Id: $v->a</li>";
    if (isset($v->k)) { $out.="<li>Kontakt: $v->k</li>" ; }
    if (isset($v->n)) {
        $out.="<li>Link in der Nachhaltigkeitsdatenbank: "
            .createLink($v->n)."</li>" ;
    }
    if (isset($v->c)) {
        $out.="<li>Kommentar: ".mehrzeilig($v->c)."</li>" ;
    }
    return $out."</ul>";  
}

function dieVeranstaltungen() {
    $s=array();
    foreach (getVeranstaltungen() as $row) {
      $s[]=displayEvent($row);
  }
  //sort($s);
  return join($s,"\n") ; 		
}

function displayEvent($v) {
    $title=$v["name"];
    $beschreibung=$v["description"];
    $veranstalter=getUser($v["user_id"]);
    $ort=$v["full_address"];
    $termin=$v["start_at"];
    $zielgruppe=$v["target_group"];
    $url=$v["info_url"];
    $out='
<h3> <a href="'.$src.'">'.$title.'</a></h3>
<div class="row"> <dl>';
    if (isset($termin)) {
        $out.='<dd> <strong>Tag und Zeit:</strong> '.getDatum($termin).' </dd>';
    }
    if (isset($ort)) {
        $out.='<dd> <strong>Veranstaltungsort:</strong> '.$ort.' </dd>';
    }
    if (isset($veranstalter)) {
        $out.='<dd> <strong>Veranstalter:</strong> '.$veranstalter.' </dd>';
    }
    if (isset($zielgruppe)) {
        $out.='<dd> <strong>Zielgruppe:</strong> '.$zielgruppe.' </dd>';
    }
    $out.='<dd> <strong>Zum Modul:</strong> '.getModul($nr).'</dd>'; 
    if (isset($beschreibung)) {
        $out.='<dd> <strong>Beschreibung:</strong> '.$beschreibung.' </dd>';
    }
    if (isset($url)) {
        $out.='<dd> <a href="'.$url.'">Link des Veranstalters</a> </dd>';
    }
    $out.='<dd> <strong>Teilnehmeranzahl: </strong> '.TeilnehmerProVeranstaltung($nr).'</dd>'; 
    $out.='</dl></div>';
    return $out;
}

function derTeilnehmer() {
    $text='';
    if (isset($_GET['id'])) {
        $hash=$_GET['id'];
        $text='Die ID '.$hash.' ist nicht vergeben.'; 
        if(isset($hash)) {
            $u=Teilnehmerinfo($hash);
            if(!empty($u)) { $text=$u; }
        }
        return '
<h3>Informationen zum Teilnehmer</h3>
<div class="row"> <p>'.$text.'</p></div>' ;
    }
    else return 'Keine ID angegeben.' ;
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

// ---- test ----
// echo derTeilnehmer();
// echo dasRanking();
// echo TeilnehmerProVeranstaltung("Veranstaltung.13");
// echo TeilnehmerProVeranstaltung("Veranstaltung.14");
// echo diePartner();
// echo dieOrte();
// echo dieVeranstaltungen();

