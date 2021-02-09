<?php
/**
 * User: Hans-Gert Gräbe
 * Last Update: 2021-02-09
 */


function displaySchool($v) {
    $name=$v["buildings"][0]["name"];
    $id=$v["institution_key"];
    $title=$v["abbreviation"];
    $schulleiter=$v["headmaster_firstname"].' '.$v["headmaster_lastname"];
    $a=array();
    foreach($v as $key => $value) {
        $a[]="ssc:$key \"$value\"";
    }
    return "<h3>Name: $name<br/> Kürzel: $title<br/>Schulleiter/in: $schulleiter</h3>".
    "<h4>RDF Record</h4> ssc:$id a ssc:School;<br>".join(";<br/>",$a);
}

function getSchools() {
    $src="rdf/schools.json";
    $string = file_get_contents($src);
    $res = json_decode($string, true);
    $s=array();
    foreach($res as $row) {
        $s[$row["institution_number"]]=displaySchool($row);
    }
    ksort($s);
    return join("\n",$s);
}

?>
