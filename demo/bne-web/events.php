<?php
/**
 * User: Hans-Gert Gräbe
 * Last Update: 2020-006-05
 */

include_once("layout.php");
include_once("helper.php");

function getEvents() {
    $src="Dumps/Events.json";
    $string = file_get_contents($src);
    $res = json_decode($string, true);
    $s;
    foreach($res as $row) {
        $date=strtotime($row["start"]);
        $s[$date]=theEvent($row);
    }
    ksort($s);
    return join("\n",$s);
}

function theEvent($v) {
    // ein Event
    $id=$v["id"];
    $src="https://bne-sachsen.de/wp-json/content/events?p=$id";
    $title=$v["title"];
    $ort=getLocation($v);
    $von=$v["start"];
    $beschreibung=$v["description"];
    $out='<h3> <a href="'.$src.'">'.$title.'</a></h3>
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
    if (!empty($beschreibung)) {
        $out.='<li> <strong>Beschreibung:</strong> '.$beschreibung.' </li>';
    }
    if (!empty($url)) {
        $out.='<li>'.createLink($url,$url).'</li>';
    }
    $out.='</ul></div>';
    return $out;
}

$content='
<div class="container">
<h2 align="center">Die Events</h2>

<table align="center" border="1">
<!-- <tr><th>Titel</th><th>Datum</th><th>Ort</th><th>URL</th><th>Goals</th></tr> -->
<tr><th>Titel</th><th>Datum</th></tr> 
'.getEvents().'
</table>
</div>
';
echo showPage($content);

?>
