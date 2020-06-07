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
    $pd=getDatum($v["date"]);
    $ort=getLocation($v);
    $organizer=getOrganizer($v["organizer"]);
    $kontakt=$v["author"];
    $region=join(", ",$v["districts"]);
    $von=$v["start"];
    $zielgruppe=getTargetGroup($v["target_group"]);
    $topics=getTopics($v["topics"]);
    $beschreibung=$v["description"];
    $out='<h3> <a href="'.$src.'">'.$title.'</a></h3>
<div class="row"> <ul>';
    $out.='<li>Veröffentlicht am: '.$pd.'</li>';
    $out.='<li>Ansprechpartner: '.$kontakt.'</li>';
    if (!empty($von)) {
        $out.='<li> <strong>Beginn:</strong> '.getDatum($von).' </li>';
    }
    if (!empty($ort)) {
        $out.='<li> <strong>Ort:</strong> '.$ort.' </li>';
    }
    $out.='<li> <strong>Region: </strong>'.$region.'</li>';
    $out.='<li> <strong>Veranstalter: </strong>'.$organizer.'</li>';
    $out.='<li> <strong>Zielgruppe:</strong> '.$zielgruppe.' </li>';
    $out.='<li> <strong>Topics:</strong> '.$topics.' </li>';
    $out.='<li> <strong>Beschreibung:</strong> '.$beschreibung.' </li>';
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
