<?php
/**
 * User: Hans-Gert Gräbe
 * Date: 2020-04-01
 * Last Update: 2020-04-01
 */

include_once("layout.php");
include_once("helper.php");

function getEvents() {
    $src="Dumps/activities.json";
    $string = file_get_contents($src);
    $res = json_decode($string, true);
    $s;
    foreach($res as $row) {
        if ($row["type"]=="Event") {
            $s[$row["start_at"]]=theEvent($row);
        }
    }
    ksort($s);
    return join("\n",$s);
}

function theEvent($v) {
    // ein Event
    $id=$v["id"];
    $src="http://daten.nachhaltiges-leipzig.de/api/v1/activities/$id.json";
    $title=$v["name"];
    $ort=$v["full_address"];
    $url=$v["info_url"];
    $von=$v["start_at"];
    $out='
<tr><td><a href="'.$src.'">'.$title.'</a></td><td>'
    .getDatum($von).'</td><td>'.$ort.'</td><td>'
         .createLink($url,$url).'</td></tr>';
    return $out;
}

$content='
<div class="container">
<h2 align="center">Die Events</h2>

<table align="center" border="1">
<tr><th>Titel</th><th>Datum</th><th>Ort</th><th>URL</th></tr>
'.getEvents().'
</table>
</div>
';
echo showPage($content);

?>
