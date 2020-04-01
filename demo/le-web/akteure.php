<?php
/**
 * User: Hans-Gert Gräbe
 * Date: 2020-04-01
 * Last Update: 2020-04-01
 */

require('vendor/autoload.php');
include_once("layout.php");
include_once("helper.php");



function dieAkteure() {
    $src="Akteure.rdf";
    $graph = new EasyRdf_Graph("https://leipziger-ecken.de/Data/");
    $graph->parseFile($src);
    print_r($graph);
}

echo dieAkteure();
?>
