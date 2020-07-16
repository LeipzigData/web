<?php
/**
 * User: Hans-Gert Gräbe
 * Date: 2019-02-24
 * Last Update: 2020-07-16
 */

include_once("layout.php");
include_once("Zukunftsdiplom.php");

function getBA() {
    $src="Dumps/Bildungsangebote.json";
    $string = file_get_contents($src);
    $res = json_decode($string, true);
    $s;
    foreach($res as $row) {
        $s[$row["id"]]=displayService($row);
    }
    return join("\n",$s);
}

$content='
<div class="container">
<h2 align="center">Alle Bildungsangebote</h2>

<p>Auf dieser Seite werden alle Einträge gelistet, die in die Kategorie
"Bildungsangebote" fallen. </p>

'.getBA().'
</div>
';
echo showPage($content);

?>
