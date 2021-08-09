<?php
/**
 * User: Hans-Gert Gräbe
 * Last Update: 2021-08-07
 */

include_once("helper.php");

function testEvents() {
    $src="Dumps/Events.json";
    $string = file_get_contents($src);
    $res = json_decode($string, true);
    foreach($res as $row) {
        echo $row["id"]."--".$row["type"]."\n"
                       .$row["slug"]."\n".$row["content"]."\n";
    }
}

testEvents();
