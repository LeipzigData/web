<?php
/**
 * User: Hans-Gert Gräbe
 * Date: 2018-06-30
 * Last Update: 2020-03-18
 */

// --- Hilfsfunktionen

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

function zdtrim($s) {
    return str_replace("http://leipzig-data.de/Data/",'',$s);
}

function mehrzeilig($a) {
    return str_replace("\n",'<br/>',$a);
}

function geoData($v) {
    if (array_key_exists("latlng",$v)) {
        $l=$v["latlng"];
        return "Point($l[1] $l[0])";
    }
}

function akteursKontakt($v) {
    if (array_key_exists("last_name",$v)) {
        return $v["first_name"]." ".$v["last_name"].", "
            .$v["organization_position"];
    }
}


// --- Die Hauptfunktionen

function getThemes($a) {
    $a=" $a";
    $m=array();
    if (strpos($a,"Energie")) { $m["Klimaschutz"]=1; }
    if (strpos($a,"Mobilität")) { $m["Klimaschutz"]=1; }
    if (strpos($a,"Klimaschutz")) { $m["Klimaschutz"]=1; }
    if (strpos($a,"Stadtraum")) { $m["Stadt, Natur und Wohnen"]=1; }
    if (strpos($a,"Bauen")) { $m["Stadt, Natur und Wohnen"]=1; }
    if (strpos($a,"Wohnen")) { $m["Stadt, Natur und Wohnen"]=1; }
    if (strpos($a,"Ernährung")) { $m["Ernährung"]=1; }
    if (strpos($a,"Gärtnern")) { $m["Ernährung"]=1; }
    if (strpos($a,"Nachhaltiger Konsum")) { $m["Nachhaltiger Konsum"]=1; }
    if (strpos($a,"Reparieren")) { $m["Nachhaltiger Konsum"]=1; }
    if (strpos($a,"Wiederverwenden")) { $m["Nachhaltiger Konsum"]=1; }
    if (strpos($a,"Recycling")) { $m["Nachhaltiger Konsum"]=1; }
    if (strpos($a,"Soziale Nachhaltigkeit")) { $m["Soziales und Kultur"]=1; }
    if (strpos($a,"Zusammenleben")) { $m["Soziales und Kultur"]=1; }
    if (strpos($a,"Kunst")) { $m["Soziales und Kultur"]=1; }
    if (strpos($a,"Kultur")) { $m["Soziales und Kultur"]=1; }
    if (strpos($a,"Bildung")) { $m["Technik, Energie, Mathematik"]=1; }
    if (strpos($a,"Forschung")) { $m["Technik, Energie, Mathematik"]=1; }
    $out=join("; ",array_keys($m));
    if (empty($out)) { return "Nicht zugeordnet"; }
    return $out;
}

function diePartner() {
    $src="Dumps/Veranstalter.json";
    $string = file_get_contents($src);
    $res = json_decode($string, true);
    $partner=array();
    foreach ($res as $row) {
        $partner[trim($row["name"])]=displayPartner($row);
    }
    ksort($partner);
    return join("\n",$partner) ;
}

function displayPartner($v) {
    $vid=$v["id"];
    $va="http://daten.nachhaltiges-leipzig.de/api/v1/users/$vid.json";
    $url=$v["organization_url"];
    $adr=$v["full_address"];
    $geo=geoData($v);
    $kontakt=akteursKontakt($v);
    $head=createLink($va,$v["name"]);
    $out='<h3>'.$head.'</h3> <ul>'
        .'<li>Id: '.$vid.'</li>'
        .'<li>Name: '.$v["name"].'</li>';
    if (!empty($adr)) {
        $out.='<li>Adresse: '.$adr.'</li>';
    }
    if (!empty($geo)) {
        $out.='<li>Geokoordinaten im WKT-Format: '.$geo.'</li>';
    }
    if (!empty($kontakt)) {
        $out.='<li>Ansprechpartner: '.$kontakt.'</li>';
    }
    if (!empty($url)) {
        $out.='<li>URL: '.createLink($url,$url).'</li>';
    }
    return $out."</ul>";
}

function dieVeranstaltungen($startDate,$endDate,$archiv=false) {
    $currentDate=date("Y-m-d");
    $src="Dumps/Veranstalter.json";
    $string = file_get_contents($src);
    $users = json_decode($string, true);
    $src="Dumps/Categories.json";
    $string = file_get_contents($src);
    $cat = json_decode($string, true);
    $src="Dumps/Zukunftsdiplom.json";
    $string = file_get_contents($src);
    $res = json_decode($string, true);
    $b=array();
    $e=array();
    foreach($res as $row) {
        $c=$cat[$row["first_root_category"]]["name"];
        $t=getThemes($c);
        if (faelltaus($row)) ;
        else if ($row["type"]=="Event") {
            if ($row["start_at"]>$currentDate && $archiv == false &&
            $row["start_at"]<$endDate) {
                $e[$row["start_at"]]=displayEvent($row,$users,$c,$t);
            }
            else if ($row["start_at"]>$startDate && $archiv == true
            && $row["start_at"]<$currentDate ){
                $e[$row["start_at"]]=displayEvent($row,$users,$c,$t);
            }
        }
        else if ($archiv==false){
            $b[]=displayBA($row,$users,$c,$t);
        }
    }
    ksort($e);
    $out="<h2> Die Bildungsangebote </h2> "
        .join($b,"\n")
        ."<h2> Weitere Veranstaltungen </h2> "
        .join($e,"\n");
    return $out;
}

function dasArchiv($startDate,$endDate){
    $out = dieVeranstaltungen($startDate,$endDate,true);
    $out = str_replace("<h2> Die Bildungsangebote </h2>", "", $out);
    $out = str_replace("Weitere", "Vergangene", $out);
    return $out;
}

function calculateArchivDate() {
  $currentDate = date("Y-m-d");
  if ($currentDate < date("Y-06-22")){
    return date("Y-m-d",mktime(0, 0,0 , 6, 22, date("Y")-1));
  }
  return date("Y-m-d",mktime(0, 0,0 , 6, 22, date("Y")));
}

function displayBA($v,$users,$c,$t) {
    // ein Bildungsangebot
    $id=$v["id"];
    $vid=$v["user_id"];
    $src="http://daten.nachhaltiges-leipzig.de/api/v1/activities/$id.json";
    $va="http://daten.nachhaltiges-leipzig.de/api/v1/users/$vid.json";
    $title=$v["name"];
    $beschreibung=$v["description"];
    $veranstalter=$users[$v["user_id"]]["name"];
    $kontakt=akteursKontakt($users[$v["user_id"]]);
    $ort=$v["full_address"];
    $geo=geoData($v);
    $zielgruppe=$v["target_group"];
    $url=$v["info_url"];
    $goals=join(", ",$v["goals"]);
    $themes=getThemes($goals);
    $out='
<h3> <a href="'.$src.'">'.$title.'</a></h3>
<div class="row"> <ul>';
    if (!empty($ort)) {
        $out.='<li> <strong>Ort:</strong> '.$ort.' </li>';
    }
    if (!empty($geo)) {
        $out.='<li>Geokoordinaten im WKT-Format: '.$geo.'</li>';
    }
    if (!empty($veranstalter)) {
        $out.='<li> <strong>Veranstalter: </strong>'
            .createLink($va,$veranstalter).'</li>';
    }
    if (!empty($kontakt)) {
        $out.='<li>Ansprechpartner des Veranstalters: '.$kontakt.'</li>';
    }
    if (!empty($zielgruppe)) {
        $out.='<li> <strong>Zielgruppe:</strong> '.$zielgruppe.' </li>';
    }
    $out.='<li> <strong>Modul:</strong> '.$t.'</li>';
    if (!empty($beschreibung)) {
        $out.='<li> <strong>Beschreibung:</strong> '.$beschreibung.' </li>';
    }
    if (!empty($url)) {
        $out.='<li>'.createLink($url,$url).'</li>';
    }
    else{
      $url = json_decode(file_get_contents("Dumps/Veranstalter.json"),true);
      $url = $url[$vid]['organization_url'];
      $out.='<li>'.createLink($url,$url).'</li>';
    }
    $out.='</dl></div>';
    return $out;
}

function displayEvent($v,$users,$c,$t) {
    // ein Event
    $id=$v["id"];
    $vid=$v["user_id"];
    $src="http://daten.nachhaltiges-leipzig.de/api/v1/activities/$id.json";
    $va="http://daten.nachhaltiges-leipzig.de/api/v1/users/$vid.json";
    $title=$v["name"];
    $beschreibung=$v["description"];
    $veranstalter=$users[$v["user_id"]]["name"];
    $kontakt=akteursKontakt($users[$v["user_id"]]);
    $ort=$v["full_address"];
    $geo=geoData($v);
    $zielgruppe=$v["target_group"];
    $url=$v["info_url"];
    $von=$v["start_at"];
    $bis=$v["end_at"];
    $goals=join(", ",$v["goals"]);
    $themes=getThemes($goals);
    $out='
<h3> <a href="'.$src.'">'.$title.'</a></h3>
<div class="row"> <ul>';
    if (!empty($von)) {
        $out.='<li> <strong>Beginn:</strong> '.getDatum($von).' </li>';
    }
    if (!empty($ort)) {
        $out.='<li> <strong>Ort:</strong> '.$ort.' </li>';
    }
    if (!empty($geo)) {
        $out.='<li>Geokoordinaten im WKT-Format: '.$geo.'</li>';
    }
    if (!empty($veranstalter)) {
        $out.='<li> <strong>Veranstalter: </strong>'
            .createLink($va,$veranstalter).'</li>';
    }
    if (!empty($kontakt)) {
        $out.='<li>Ansprechpartner des Veranstalters: '.$kontakt.'</li>';
    }
    if (!empty($zielgruppe)) {
        $out.='<li> <strong>Zielgruppe:</strong> '.$zielgruppe.' </li>';
    }
    $out.='<li> <strong>Modul:</strong> '.$t.'</li>';
    if (!empty($beschreibung)) {
        $out.='<li> <strong>Beschreibung:</strong> '.$beschreibung.' </li>';
    }
    if (!empty($url)) {
        $out.='<li>'.createLink($url,$url).'</li>';
    }
    else{
      $url = json_decode(file_get_contents("Dumps/Veranstalter.json"),true);
      $url = $url[$vid]['organization_url'];
      $out.='<li>'.createLink($url,$url).'</li>';
    }
    $out.='</ul></div>';
    return $out;
}

function dieOrte(){
  $src="Dumps/Zukunftsdiplom.json";
  $string = file_get_contents($src);
  $res = json_decode($string, true);
  $b=array();
  foreach ($res as $row) {
    array_push($b, $row["full_address"]);
  }
  $b = array_unique($b);
  $result = "";
  foreach ($b as $ort) {
    $result =  $result."<li>".$ort."</li>";
  }
  return $result;
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

// --------  Veranstaltungsausfall

function faelltaus($row) {
    return (stripos(strtolower($row['name']),"fällt")
    || stripos(strtolower($row['beschreibung']),"fällt"));
}
    
function ausfall($startDate,$endDate) {
    $currentDate=date("Y-m-d");
    $src="Dumps/activities.json";
    $string = file_get_contents($src);
    $res = json_decode($string, true);
    $e=array();
    foreach($res as $row) {
        if ($row["type"]=="Event" && $row["start_at"]>$startDate
        && $row["start_at"]<$endDate && faelltaus($row)) {
            $e[$row["start_at"]]=shortDisplay($row);
        }
    }
    ksort($e);
    $out=join($e,"\n");
    return $out;
}

function shortDisplay($v) {
    // ein Event
    $id=$v["id"];
    $vid=$v["user_id"];
    $title=$v["name"];
    $beschreibung=$v["description"];
    $ort=$v["full_address"];
    $url=$v["info_url"];
    $von=$v["start_at"];
    $bis=$v["end_at"];
    $out='
<h3> '.$title.'</h3>
<div class="row"> <ul>';
    if (!empty($von)) {
        $out.='<li> <strong>Beginn:</strong> '.getDatum($von).' </li>';
    }
    if (!empty($ort)) {
        $out.='<li> <strong>Ort:</strong> '.$ort.' </li>';
    }
    if (!empty($beschreibung)) {
        $out.='<li> <strong>Beschreibung:</strong> '.$beschreibung.' </li>';
    }
    if (!empty($url)) {
        $out.='<li>'.createLink($url,$url).'</li>';
    }
    $out.='</ul></div>';
    return $out;
}


// ---- test ----
// echo dieVeranstaltungen();
// echo diePartner();
