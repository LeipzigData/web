<?php
/**
 * User: Hans-Gert Gräbe
 * Date: 2020-04-01
 * Last Update: 2020-04-22
 */

include_once("layout.php");
include_once("helper.php");

function getAdressen() {
    $graph=loadData();
    setNamespace();
    $s=array();
    foreach ($graph->allOfType("le:Adresse") as $v) {
        $name=$v->get("rdfs:label");
        $s["$name"]=displayAdresse($v); 
    }
    ksort($s);
    return '<table border="1" align="center">
<tr><th>URI</th><th>Adresse</th><th>Geokoordinaten</th></tr>'
    .join("\n",$s).'</table>';
}

function displayAdresse($v) {
    $id=str_replace("http://leipziger-ecken.de/Data/","",$v->getUri());
    $name=$v->get("rdfs:label");
    $geo=$v->get("gsp:asWKT");
    return "<tr><td>$id</td><td>$name</td><td>$geo</td></tr>";
}

$content='
<div class="container">
<h2 align="center">Die Adressen</h2>

'.getAdressen().'
</div>
';
echo showPage($content);

?>
