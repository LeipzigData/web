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

// --- Die Hauptmodule

function dieOrte() {
    $orte=array();
    foreach (getVeranstaltungen() as $row) {
        $orte=getOrt($orte,$row);
    }
    $s=array();
    foreach ($orte as $row) {
        $s[]=displayOrt($row);
    }
    return join($s,"\n") ; 		
}

function getOrt($orte,$nr) {
    $src="http://daten.nachhaltiges-leipzig.de/api/v1/activities/$nr.json";
    $string = file_get_contents($src);
    $v = json_decode($string, true);
    $orte[$v["full_address"]]=$v;
    return $orte;
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
    $partner=array();
    foreach (getVeranstaltungen() as $nr) {
        $partner=getPartner($partner,$nr);
    }
    return join("\n",$partner) ; 		
}

function getPartner($partner,$nr) {
    $src="http://daten.nachhaltiges-leipzig.de/api/v1/activities/$nr.json";
    $string = file_get_contents($src);
    $v = json_decode($string, true);
    $user=$v["user_id"];
    $src="http://daten.nachhaltiges-leipzig.de/api/v1/users/$user.json";
    $string = file_get_contents($src);
    $v = json_decode($string, true);
    $partner[$user]=displayPartner($v);
    return $partner;
}

function displayPartner($v) {
    $name=$v['name'];
    $id=$v['id'];
    $adresse=$v['full_address'];
    $email=$v['email'];
    $src="http://daten.nachhaltiges-leipzig.de/api/v1/users/$id.json";
    if (!isset($name)) { return ''; }
    $out='
<h3> <a href="'.$src.'">'.$name.'</a></h3>';
    if (isset($adresse)) {
        $out.="\n".'<div class="row">Adresse: '.$adresse.' </div>';
    } else { $out.="\n".'<div class="row">Adresse nicht eingetragen</div>'; }
    if (isset($email)) { $out.="\n".'<div class="row">Email: '.$email.' </div>'; }
    return $out;
}

function dieVeranstaltungen() {
    $s=array();
    foreach (getVeranstaltungen() as $row) {
      $s[]=displayEvent($row);
  }
  //sort($s);
  return join($s,"\n") ; 		
}

function displayEvent($nr) {
    $src="http://daten.nachhaltiges-leipzig.de/api/v1/activities/$nr.json";
    $string = file_get_contents($src);
    $v = json_decode($string, true);
    $title=$v["name"];
    $beschreibung=$v["description"];
    $veranstalter=getUser($v["user_id"]);
    $ort=$v["full_address"];
    $termin=$v["start_at"];
    $url=$v["info_url"];
    $out='
<h3> <a href="'.$src.'">'.$title.'</a></h3>
<div class="row"> <dl>';
    if (isset($termin)) {
        $out.='<dd> <strong>Tag und Zeit:</strong> '.$termin.' </dd>';
    }
    if (isset($ort)) {
        $out.='<dd> <strong>Veranstaltungsort:</strong> '.$ort.' </dd>';
    }
    if (isset($veranstalter)) {
        $out.='<dd> <strong>Veranstalter:</strong> '.$veranstalter.' </dd>';
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

function getCategory($nr) {
    $src="http://daten.nachhaltiges-leipzig.de/api/v1/categories/$nr.json";
    $string = file_get_contents($src);
    $res = json_decode($string, true);
    return '<a href="'.$src.'">'.$res["name"].'</a>';
}

function getCategories($a) {
    $b=array();
    foreach ($a as $u) {
        $b[]=getCategory($u);
    }
    return "\n".join("\n",$b);
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
    return array(1552, 1553, 1554, 1555);
}

// ---- test ----
// echo checkTeilnehmer('12');
// echo checkTeilnehmer('thaexaedaiweuvi5ceiphu4hoh6Yi3');
// echo dasRanking();
// echo TeilnehmerProVeranstaltung("Veranstaltung.13");
// echo TeilnehmerProVeranstaltung("Veranstaltung.14");
// echo diePartner();
// echo dieOrte();
// echo dieVeranstaltungen();
// echo displayPartner("55");
// echo displayEvent("1556");
// echo getCategory("55");