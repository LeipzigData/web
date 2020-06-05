<?php
/**
 * User: Hans-Gert Gräbe
 * Last Update: 2020-06-05
 */

include_once("helper.php");

function createDump($src,$dest) {
    $string = file_get_contents($src);
    $res = json_decode($string, true);
    jsonDump("Dumps/$dest.json",$res);
}

function jsonDump($fn,$s) {
    $fp=fopen($fn, "w");
    fwrite($fp, json_encode($s));
    fclose($fp);
}

function createDumps() {
    $prefix="https://bne-sachsen.de/wp-json/content/";
    createDump($prefix."offers","Offers");
    createDump($prefix."events","Events");
    createDump($prefix."materials","Materials");
    createDump($prefix."posts","Posts");
}

// ---- test ----
createDumps();