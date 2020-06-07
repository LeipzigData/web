<?php
/**
 * User: Hans-Gert Gräbe
 * Last Update: 2020-06-05
 */

include_once("helper.php");

function testEvents() {
    $src="Dumps/Events.json";
    $string = file_get_contents($src);
    $res = json_decode($string, true);
    foreach($res as $row) {
        echo $row["id"]."--".$row["districts"]."\n";
    }
}

testEvents();