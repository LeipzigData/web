<?php
/**
 * User: Hans-Gert Gräbe
 * Last Update: 2021-08-28
 */

include_once("layout.php");
include_once("Zukunftsdiplom.php");

function getUser($uid) {
    $string = file_get_contents("http://daten.nachhaltiges-leipzig.de/api/v1/users/$uid.json");
    $res = json_decode($string, true);
    return $res["name"];
}

function getServices() {
    $src="Dumps/activities.json";
    $base="http://daten.nachhaltiges-leipzig.de/api/v1";
    $string = file_get_contents($src);
    $res = json_decode($string, true);
    $s=array();
    foreach($res as $row) {
        if ($row["type"]=="Service") {
            $id=$row["id"];
            $uid=$row["user_id"];
            $name=$row["name"];
            $user=getUser($uid);
            $s[$name]='<tr><td>'.createLink("$base/activities/$id.json",$name).'</td><td>'
                .createLink("$base/users/$uid.json",$user).'</td></tr>';
        }
    }
    ksort($s);
    return '<table class="table table-sm table-bordered">
<tr><th>Name der Veranstaltung</th><th>Veranstalter</th></tr>'
    .join("\n",$s).'</table>';
}

$content='
<div class="container">
<h2 align="center">Die Services</h2>

<p>Auf dieser Seite werden alle Einträge gelistet, die in die Kategorie
"Services" fallen. Die Links verweisen jeweils auf die Detaileinträge in der
NDS-Datenbank.  Der Seitenaufbau dauert etwas länger, da die User über
einzelne JSON-Abrufe gefunden werden.  Das kann man durch eine Verbesserung
der verwendeten Datenstrukturen noch optimieren. </p>

'.getServices().'
</div>
';
echo showPage($content);

?>
