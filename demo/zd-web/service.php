<?php
/**
 * User: Hans-Gert Gräbe
 * Date: 2019-02-24
 * Last Update: 2019-07-22
 */

include_once("layout.php");
include_once("Zukunftsdiplom.php");

function recordService($s,$v) {
    $title=$v["name"];
    $a=$s[$title];
    if (empty($a)) { $a=array();}
    $a["user"][$v["user_id"]]=1;
    $a["id"][$v["id"]]=1;
    $s[$title]=$a;
    return $s;
}

function getServices() {
    $src="Dumps/activities.json";
    $string = file_get_contents($src);
    $res = json_decode($string, true);
    $s=array();
    foreach($res as $row) {
        if ($row["type"]=="Service") {$s=recordService($s,$row);}
    }
    ksort($s);
    $a=array();
    foreach($s as $key => $value) {
        $ids=join(", ",array_keys($s[$key]["id"]));
        $users=join(", ",array_keys($s[$key]["user"]));
        $a[]='<tr><td>'.$key.'</td><td>'.$ids.'</td><td>'.$users.'</td></tr>';
    }
    return '<table align="center" border="1">
<tr><th>Name der Veranstaltung</th><th>Id der Veranstaltung</th><th>Id des Veranstalters</th></tr>'
    .join("\n",$a).'</table>';
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
