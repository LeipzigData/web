<?php
/**
 * User: Hans-Gert Gräbe
 * Date: 2019-02-18
 * Last Update: 2020-07-19
 */

include_once("Zukunftsdiplom.php");

function showTargetGroups() {
    $src="Dump/activities.json";
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

function showCategories() {
    $src="http://daten.nachhaltiges-leipzig.de/api/v1/categories.json";
    $string = file_get_contents($src);
    $res = json_decode($string, true);
    $s=array();
    foreach($res as $row) {
        $s=addCategory($s,$row);
    }
    return $s;
}

function addCategory($s,$row) {
    $a=array();
    $id=$row["id"];
    $a["name"]=$row["name"];
    $a["parent"]=$row["parent_id"];
    $a["goals"]=extractGoals($row["goal_cloud"]);
    $s[$id]=$a;
    foreach($row["children"] as $v){
      $s=addCategory($s,$v);
    }
    return $s;
}

function extractGoals($v) {
    $a=array();
    foreach($v as $entry) {
        $a[]=$entry["name"];
    }
    return join("; ",$a);
}

function createZDDumps() {
    $src="Dumps/activities.json";
    $string = file_get_contents($src);
    $res = json_decode($string, true);
    $s=array();
    $users=array();
    foreach($res as $row) {
        if (isZDListed($row)) {
            $s[$row["id"]]=$row;
            $users[$row["user_id"]]=1;
        }
    }
    jsonDump("Dumps/Zukunftsdiplom.json",$s);
    $s=getUsers(array_keys($users));
    jsonDump("Dumps/Veranstalter.json",$s);
}

function getUsers($s) {
    $a=array();
    foreach($s as $id) {
        $src="http://daten.nachhaltiges-leipzig.de/api/v1/users/$id.json";
        $string = file_get_contents($src);
        $res = json_decode($string, true);
        $a[$id]=$res;
    }
    return $a;
}

/*
 Ueberprueft, ob das Angebot ein Teil des Zukunftsdiplom ist.
*/
function isZDListed($row) {
    $goals='';
    if (array_key_exists("goals",$row)) {
        $goals=join(", ",$row['goals']);
        }
    return strpos(" $goals","Zukunfts-Diplom");
}

function createAdditionalDumps() {
    $src="Dump/activities.json";
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

function createDumps() {
    // Dump aller Aktivitaeten in NL
    $src="http://daten.nachhaltiges-leipzig.de/api/v1/activities.json";
    $string = file_get_contents($src);
    $res = json_decode($string, true);
    jsonDump("Dumps/activities.json",$res);
    // -----------------------------------
    // Dump nur der Bildungsangebote
    $s=array();
    foreach($res as $row) {
        if ($row["service_type"]=="Bildungsangebot") {
            $s[$row["id"]]=$row;
        }
    }
    jsonDump("Dumps/Bildungsangebote.json",$s);
    // -----------------------------------
    // Dump der Bildungsangebote bei bne-sachsen.de 
    $src="https://bne-sachsen.de/wp-json/content/offers";
    $string = file_get_contents($src);
    $res = json_decode($string, true);
    jsonDump("Dumps/BNE-Offers.json",$res);
}

function jsonDump($fn,$s) {
    $fp=fopen($fn, "w");
    fwrite($fp, json_encode($s));
    fclose($fp);
}

function createWebsiteDump($fn) {
    $out=dieVeranstaltungen();
    $fp=fopen($fn, "w");
    fwrite($fp, $out);
    fclose($fp);
}

function dumpCategories() {
    $s=showCategories();
    jsonDump("Dumps/Categories.json",$s);
}

// ---- test ----
createDumps();
createZDDumps();
//dumpCategories();
//createAdditionalDumps();
