<?php
/**
 * User: Hans-Gert Gräbe
 * Date: 2019-02-24
 * Last Update: 2019-05-23
 */

include_once("layout.php");
include_once("Zukunftsdiplom.php");

function getServices() {
    $src="Dumps/Services.json";
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
