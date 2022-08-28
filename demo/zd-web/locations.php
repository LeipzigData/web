<?php
/**
 * User: Hans-Gert Gräbe
 * Date: 2020-03-26
 * Last Update: 2020-03-26
 */

include_once("layout.php");
//include_once("Zukunftsdiplom.php");

function getLocations() {
    $src="http://daten.nachhaltiges-leipzig.de/api/v1/locations.json";
    $string = file_get_contents($src);
    $res = json_decode($string, true);
    $s;
    foreach($res as $row) {
        $s[$row["name"]]=theLocation($row);       
    }
    ksort($s);
    return join("\n",$s);
}

function theLocation($v) {
    // ein Ort
    $id=$v["id"];
    $src="http://daten.nachhaltiges-leipzig.de/api/v1/locations/$id.json";
    $title=$v["name"];
    $adresse=$v["street"];
    $plz=$v["zip"];
    $ort=$v["city"];
    $strasse=$v["street_name"];
    $nr=$v["house_number"];
    $out='
<tr><td><a href="'.$src.'">'.$title.'</a></td><td>'.$adresse.'</td><td>'
    .$plz.'</td><td>'.$ort.'</td><td>'.$strasse.'</td><td>'.$nr.'</td></tr>';
    return $out;
}

$content='
<div class="container">
<h2 align="center">Die Orte</h2>

<table class="table table-bordered" align="center">
<tr><th>Name</th><th>Adresse</th><th>PLZ</th><th>Ort</th><th>Straße</th><th>Nr.</th></tr>
'.getLocations().'
</table>
</div>
';
echo showPage($content);

?>
