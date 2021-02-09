<?php
/**
 * User: Hans-Gert Gräbe
 * Last Update: 2021-02-09
 */

function getPrefix() {
    return '@prefix ssc: &lt;http://leipzig-data.de/Data/SchoolModel/&gt; .';
}

function displaySchool($v) {
    $name=$v["buildings"][0]["name"];
    $id=$v["institution_key"];
    $title=$v["abbreviation"];
    $a=array();
    foreach($v as $key => $value) {
        $a[]="ssc:$key \"$value\"";
    }
    return "<h3>Name: $name<br/> Kürzel: $title</h3>". 
    '<h4>RDF Record</h4> <pre>'.getPrefix()."<br/>ssc:$id a ssc:School;<br/>"
    .join(";<br/>",$a).' .</pre>';
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
