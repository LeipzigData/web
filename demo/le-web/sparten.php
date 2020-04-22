<?php
/**
 * User: Hans-Gert Gräbe
 * Date: 2020-04-01
 * Last Update: 2020-04-22
 */

include_once("layout.php");
include_once("helper.php");

function getSparten() {
    $graph=loadData();
    setNamespace();
    $s=array();
    foreach ($graph->allOfType("le:Sparte") as $v) {
        $name=$v->get("rdfs:label");
        $s["$name"]=displaySparte($v); 
    }
    ksort($s);
    return '<table border="1" align="center">
<tr><th>URI</th><th>Sparte</th></tr>'
    .join("\n",$s).'</table>';
}

function displaySparte($v) {
    $id=str_replace("http://leipziger-ecken.de/Data/","",$v->getUri());
    $name=$v->get("rdfs:label");
    return "<tr><td>$id</td><td>$name</td><td>$geo</td></tr>";
}

$content='
<div class="container">
<h2 align="center">Die Sparten</h2>

'.getSparten().'
</div>
';
echo showPage($content);

?>
