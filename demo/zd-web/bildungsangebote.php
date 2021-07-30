<?php
/**
 * User: Hans-Gert Gräbe
 * Last Update: 2021-07-30
 */

include_once("layout.php");
include_once("Zukunftsdiplom.php");

function getBA() {
    $src="Dumps/Bildungsangebote.json";
    $string = file_get_contents($src);
    $res1 = json_decode($string, true);
    $src="Dumps/BNE-Offers.json";
    $string = file_get_contents($src);
    $res2 = json_decode($string, true);
    $s;
    foreach($res1 as $row) {
        $s[]=normalizeNLService($row);
    }
    foreach($res2 as $row) {
        //if (strpos(join(", ",$row["districts"]),"Leipzig")) {
        $s[]=normalizeBNEService($row);
        //}
    } 
    return $s;
}

function normalizeNLService($v) {
    $a=array();
    // Angebot
    $a["quelle"]="Nachhaltiges Leipzig"; 
    $a["aid"]=$v["id"]; 
    $a["alink"]="http://daten.nachhaltiges-leipzig.de/api/v1/activities/".$v["id"].".json";
    $a["title"]=$v["name"];
    $a["url"]=$v["info_url"];
    // Veranstalter
    $a["vid"]=$v["user_id"];
    $a["vlink"]="http://daten.nachhaltiges-leipzig.de/api/v1/users/".$v["user_id"].".json";
    // Ort
    $a["ort"]=$v["full_address"];
    $a["geo"]=geoData($v);
    // Beschreibung    
    $a["angebotsart"]=$v["education_type"];
    $a["kurzbeschreibung"]=$v["short_description"];
    $a["zielgruppe"]=$v["target_group_selection"];
    $a["goals"]=join(", ",$v["goals"]);
    return $a;
}

function normalizeBNEService($v) {
    $a=array();
    // Angebot
    $a["quelle"]="bne-sachsen.de"; 
    $a["aid"]=$v["id"]; 
    $a["alink"]="https://bne-sachsen.de/wp-json/content/offers?p=".$v["id"];
    $a["title"]=$v["title"];
    $a["url"]=$v["link"];
    // Veranstalter
    $a["ansprechpartner"]=$v["author"];
    // Ort
    $a["ort"]="Nicht mit ausgeliefert"; //$v["full_address"];
    //$a["geo"]=geoData($v);
    // Beschreibung    
    //$a["angebotsart"]=$v["education_type"];
    $a["kurzbeschreibung"]=$v["content"];
    /* $s=array();
    foreach($v["target_group"]["extracurricular"] as $t) { $s[]=$t; }
    foreach($v["target_group"]["school"] as $t) { $s[]=$t; }
    $a["zielgruppe"]=join(", ",$s);
    $s=array();
    foreach($v["topics"] as $t) { $s[]=$t["name"]; }
    $a["goals"]=join(", ",$s);
    $a["format"]=join(", ",$v["format"]); */    
    return $a;
}
    
function displayOffer($a) {
    $out='
<h3> <a href="'.$a["alink"].'">'.$a["title"].'</a></h3>
<div class="row"> <ul>';
    $out.='<li> <strong>Quelle:</strong> '.$a["quelle"].'</li>'; 
    if (!empty($a["ort"])) {
        $out.='<li> <strong>Ort:</strong> '.$a["ort"].' </li>';
    }
    if (!empty($a["geo"])) {
        $out.='<li><strong>Geokoordinaten</strong> im WKT-Format: '.$a["geo"].'</li>';
    }
    if (!empty($a["vid"])) {
        $out.='<li> <strong>Veranstalter: </strong>'
            .createLink($a["vlink"],$a["vid"]).'</li>';
    }
    if (!empty($a["ansprechpartner"])) {
        $out.='<li> <strong>Ansprechpartner: </strong>'
            .$a["ansprechpartner"].'</li>';
    }
    if (!empty($a["angebotsart"])) {
        $out.='<li><strong>Angebotsart:</strong> '.$a["angebotsart"].'</li>';
    }
    if (!empty($a["format"])) {
        $out.='<li><strong>Format:</strong> '.$a["format"].'</li>';
    }
    if (!empty($a["zielgruppe"])) {
        $out.='<li> <strong>Zielgruppe:</strong> '.$a["zielgruppe"].' </li>';
    }
    if (!empty($a["goals"])) {
        $out.='<li> <strong>Ziele:</strong> '.$a["goals"].' </li>';
    }
    if (!empty($a["kurzbeschreibung"])) {
        $out.='<li> <strong>Kurzbeschreibung:</strong> '
            .$a["kurzbeschreibung"].' </li>';
    }
    if (!empty($a["url"])) {
        $out.='<li>'.createLink($a["url"],$a["url"]).'</li>';
    }
    $out.='</dl></div>';
    return $out;
}

function dieBildungsangebote() {
    $a=array();
    foreach (getBA() as $v) {
        $a[strtolower($v["title"])]=displayOffer($v);
    }
    ksort($a);
    return join("<br/>",$a);
}

$content='
<div class="container">
<h2 align="center">Bildungsangebote</h2>

<p>Dies ist ein erster Versuch, die Bildungsangebote aus den Plattformen
"Nachhaltiges Leipzig" und "BNE Sachsen" (nur die für Leipzig relevanten)
trotz der deutlichen Differenzen in den Datenmodellen in einer Anzeige
zusammenzuführen. </p>

'.dieBildungsangebote().'
</div>
';
echo showPage($content);

?>
