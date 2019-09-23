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
function getBA() {
    $src="Dumps/Bildungsangebote.json";
    $string = file_get_contents($src);
    $res = json_decode($string, true);
    $s;
    foreach($res as $row) {
        if ($row["service_type"]=="Bildungsangebot") {
            $s[$row["id"]]=displayService($row);
        }
    }
    return join("\n",$s);
}

$content='
<div class="container">
<h2 align="center">Die Bildungsangebote</h2>

<p>Auf dieser Seite werden alle Einträge gelistet, die in die Kategorie
"Bildungsangebote" fallen. </p>

'.getBA().'
</div>
';
echo showPage($content);

?>
