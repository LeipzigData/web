<?php
/**
 * User: Hans-Gert Gräbe
 * Date: 2019-02-24
 * Last Update: 2019-11-12
 */

include_once("layout.php");
include_once("Zukunftsdiplom.php");

function getGTAServices() {
    $src="Dumps/Services.json";
    $string = file_get_contents($src);
    $res = json_decode($string, true);
    $s;
    foreach($res as $row) {
        if ($row["service_type"]=="GTA") {
            $s[$row["id"]]=displayService($row);
        }
    }
    return join("\n",$s);
}

$content='
<div class="container">
<h2 align="center">Die GTA-Angebote</h2>

<p>Auf dieser Seite werden alle Einträge gelistet, die den Service-Type "GTA"
haben. </p>

'.getGTAServices().'
</div>
';
echo showPage($content);

?>
