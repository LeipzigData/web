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
        $s[$row["start"]]=theEvent($row);
    }
    ksort($s);
    return join("\n",$s);
}

function theEvent($v) {
    // ein Event
    $id=$v["id"];
    $src="https://bne-sachsen.de/wp-json/content/events?p=$id";
    $title=$v["title"];
    //$ort=getOrt($v["organizer"]);
    $von=$v["start"];
    $out='
<tr><td><a href="'.$src.'">'.$title.'</a></td><td>'
    .getDatum($von).'</td><td>'.$ort.'</td></tr>';
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
