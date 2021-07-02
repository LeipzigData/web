<?php 
/**
 * User: Hans-Gert Gräbe
 * Last Update: 2021-07-02
 */

include_once("Zukunftsdiplom.php");

function getUser($file) { 
    $string = file_get_contents($file);
    $res = json_decode($string, true);
    $s=array();
    $users=array();
    foreach($res as $row) {
        $s[$row["id"]]=$row;
        $users[$row["user_id"]]=1;
    }
    return array_keys($users);
}

function analyze($s) {
    $a=array();
    foreach($s as $id) {
        $src="http://daten.nachhaltiges-leipzig.de/api/v1/users/$id.json";
        $string = file_get_contents($src);
        $res = json_decode($string, true);
        $a[$id]=$res;
    }
    print_r($a);
}   

function displayMyEvent($v) {
    // ein Event
    $id=$v["id"];
    $nr="1"; // temporär, bis die Sache mit den Themenbereichen geklärt ist.
    $src="http://daten.nachhaltiges-leipzig.de/api/v1/activities/$id.json";
    $title=$v["name"];
    $beschreibung=$v["description"];
    $ort=$v["full_address"];
    $zielgruppe=$v["target_group"];
    $url=$v["info_url"];
    $von=$v["start_at"];
    $bis=$v["end_at"];
    $out='
<h3> <a href="'.$src.'">'.$title.'</a></h3>
<div class="row"> <ul>';
    if (!empty($von)) {
        $out.='<li> <strong>Beginn:</strong> '.getDatum($von).' </li>';
    }
    if (!empty($ort)) {
        $out.='<li> <strong>Ort:</strong> '.$ort.' </li>';
    }
    if (!empty($zielgruppe)) {
        $out.='<li> <strong>Zielgruppe:</strong> '.$zielgruppe.' </li>';
    }
    if (!empty($beschreibung)) {
        $out.='<li> <strong>Beschreibung:</strong> '.$beschreibung.' </li>';
    }
    if (!empty($url)) {
        $out.='<li> <a href="'.$url.'">Link des Veranstalters</a> </li>';
    }
    $out.='</ul></div>';
    return $out;
}

function checkFile($file) {
    $string = file_get_contents($file);
    $res = json_decode($string, true);
    $s=array(); 
    foreach($res as $row) {
        if ($row["type"]=='Project') {
            $id=$row["id"];
            $uid=$row["user_id"];
            $name=$row["name"];
            $s[]="$id\n$uid\n$name\n=========";
        }
    }
    return join("\n",$s);
}


// ---- test ----
// $s=getUsers("Dumps/activities.json"); analyze($s);
echo checkFile("Dumps/activities.json");
