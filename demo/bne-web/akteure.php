<?php
/**
 * User: Hans-Gert Gräbe
 * Last Update: 2020-06-05
 */

include_once("layout.php");
include_once("helper.php");

function dieAnbieter() {
    $src="Dumps/Events.json";
    $string = file_get_contents($src);
    $res = json_decode($string, true);
    $s=array();
    foreach($res as $row) {
        $s=addAnbieter($s,$row["organizer"],"events?p=".$row["id"]);
    }
    $src="Dumps/Materials.json";
    $string = file_get_contents($src);
    $res = json_decode($string, true);
    $s;
    foreach($res as $row) {
        $s=addAnbieter($s,$row["offerer"],"materials?p=".$row["id"]);
    }
    return "<dl>".join("\n",$s)."</dl>";
}

function addAnbieter($s,$v,$id) {
    if (!empty($v["name"])) {
        $s[]="<dt>".getOrganizer($v)."</dt> <dd>mit Angebot "
            .createLink("https://bne-sachsen.de/wp-json/content/$id",$id)
            ."</dd>";
    }
    return $s;
}


$content='      
<div class="container">
<h2 align="center">Die Anbieter</h2>

<p>Anbieter oder Akteure sind in den Daten nur spärlich hinterlegt - sie
werden als "organizer" von Events sowie als "offerer" von Materialien geführt,
die entsprechenden Felder sind aber meist leer. </p>

'.dieAnbieter().'
</div>
';
echo showPage($content);

?>
