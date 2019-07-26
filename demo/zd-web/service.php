<?php
/**
 * User: Hans-Gert Gräbe
 * Date: 2019-02-24
 * Last Update: 2019-05-23
 */

include_once("layout.php");
include_once("Zukunftsdiplom.php");

/*
Diese Funktion ist sehr langsam, da sie auf die URL zugreift.
In der Dump/Zukunftsdiplom.json sind weniger Services vorhanden,
da diese Datei nur Services des Zukunftsdiplom enthält.
Einige Service existieren wahrscheinlich nicht mehr, da das Datum
in der Beschreibung überschritten ist.
*/
function getServices() {
    $src="http://daten.nachhaltiges-leipzig.de/api/v1/activities.json";
    //$src="Dumps/Zukunftsdiplom.json";
    $string = file_get_contents($src);
    $res = json_decode($string, true);
    $s;
    foreach($res as $row) {
        if ($row["type"]=="Service") {
            $s[$row["id"]]=displayService($row);
        }
    }
    return join("\n",$s);
}

$content='
<div class="container">
<h2 align="center">Die Services</h2>

<p>Auf dieser Seite werden alle Einträge gelistet, die in die Kategorie
"Services" fallen. </p>

'.getServices().'
</div>
';
echo showPage($content);

?>
