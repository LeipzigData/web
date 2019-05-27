<?php 
/**
 * User: Hans-Gert Gräbe
 * Date: 2019-02-18
 * Last Update: 2019-05-27
 */

include_once("Zukunftsdiplom.php");

function showTargetGroups() { 
    //$src="http://daten.nachhaltiges-leipzig.de/api/v1/activities.json";
    $src="activities.json";
    $string = file_get_contents($src);
    $res = json_decode($string, true);
    $s=array();
    foreach($res as $row) {
        if (array_key_exists("goals",$row)) {
            echo $row['id'].", ".join(":",$row['goals']),", ".
                $row['type']."\n";
        }
    }
}

function createZDDump() { 
    $src="http://daten.nachhaltiges-leipzig.de/api/v1/activities.json";
    //$src="activities.json";
    $string = file_get_contents($src);
    $res = json_decode($string, true);
    $s=array();
    foreach($res as $row) {
        if (isZDListed($row)) { $s[$row["id"]]=$row; }
    }
    jsonDump("Dumps/Zukunftsdiplom.json",$s);
}

function isZDListed($row) {
    $goals='';
    if (array_key_exists("goals",$row)) {
        $goals=join(", ",$row['goals']);
        }
    return strpos(" $goals","Zukunfts-Diplom");
}

function createAdditionalDumps() { 
    //$src="http://daten.nachhaltiges-leipzig.de/api/v1/activities.json";
    $src="activities.json";
    $string = file_get_contents($src);
    $res = json_decode($string, true);
    // -----------------------------------
    $s=array();
    foreach($res as $row) {
        if ($row["type"]=="Action") {
            $s[$row["id"]]=$row;
        }
    }
    jsonDump("Dumps/Actions.json",$s);
    // -----------------------------------
    $s=array();
    foreach($res as $row) {
        if ($row["type"]=="Project") {
            $s[$row["id"]]=$row;
        }
    }
    jsonDump("Dumps/Projects.json",$s);
    // -----------------------------------
    $s=array();
    foreach($res as $row) {
        if ($row["type"]=="Service") {
            $s[$row["id"]]=$row;
        }
    }
    jsonDump("Dumps/Services.json",$s);
    // -----------------------------------
    $s=array();
    foreach($res as $row) {
        if ($row["type"]=="Store") {
            $s[$row["id"]]=$row;
        }
    }
    jsonDump("Dumps/Stores.json",$s);
    // -----------------------------------
}

function jsonDump($fn,$s) {
    $fp=fopen($fn, "w");
    fwrite($fp, json_encode($s));
    fclose($fp);
}

function createWebsiteDump($fn) { 
    $src="http://daten.nachhaltiges-leipzig.de/api/v1/activities.json";
    $string = file_get_contents($src);
    $res = json_decode($string, true);
    $b=array();
    $e=array();
    foreach($res as $row) {
        if (isZDListed($row)) {
            if ($row["type"]=="Event") {
                if ($row["start_at"]>"2019-05") {
                    $e[$row["start_at"]]=displayEvent($row);
                }
            }
            else { $b[]=displayBA($row); }
        }
    }
    sort($e);
    $out="<h2> Die Bildungsangebote </h2> "
        .join($b,"\n")
        ."<h2> Weitere Veranstaltungen </h2> "
        .join($e,"\n"); 
    $fp=fopen($fn, "w");
    fwrite($fp, $out);
    fclose($fp);		
}

// ---- test ----
createZDDump();
createWebsiteDump("content.php");
// showTargetGroups();
