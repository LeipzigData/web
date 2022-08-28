<?php 
/**
 * User: Hans-Gert Gräbe
 * Last Update: 2022-08-28
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
    $src="http://daten.nachhaltiges-leipzig.de/api/v1/activities/$id.json";
    $title=$v["name"];
    $ort=$v["full_address"];
    $region=$v["region"]["name"];
    $out='
<h3> <a href="'.$src.'">'.$title.'</a></h3>
<div class="row"> <ul>';
    if (!empty($ort)) {
        $out.='<li> <strong>Ort:</strong> '.$ort.' </li>';
    }
    if (!empty($region)) {
        $out.='<li> <strong>Region:</strong> '.$region.' </li>';
    }
    $out.='</ul></div>';
    return $out;
}

function checkProjects($file) {
    $string = file_get_contents($file);
    $res = json_decode($string, true);
    $s=array(); 
    foreach($res as $row) {
        if ($row["type"]=='Project') {
            $id=$row["id"];
            $uid=$row["user_id"];
            $name=$row["name"];
            $region=$row["region"]["name"];
            $s[]="$id\n$uid\n$name\n$region\n=========";
        }
    }
    return join("\n",$s);
}

function checkUsers($file) {
    $string = file_get_contents($file);
    $res = json_decode($string, true);
    $s=array(); 
    foreach($res as $row) {
        $id=$row["id"];
        $name=$row["name"];
        $geo="fehlt";
        if (isset($row["latlng"])) {$geo=join(", ",$row["latlng"]);}
        $s[]="<tr><td>$id</td><td>$name</td><td>$geo</td></tr>";
    }
    return '<table border="2">'.join("\n",$s).'</table>';
}

function checkLocations($file) {
    $string = file_get_contents($file);
    $res = json_decode($string, true);
    $s=array(); 
    foreach($res as $row) {
        $id=$row["id"];
        $name=$row["name"];
        $adresse=$row["zip"].' '.$row["city"].', '.$row["street"];
        $s[]="<tr><td>$id</td><td>$name</td><td>$adresse</td></tr>";
    }
    return '<table border="2">'.join("\n",$s).'</table>';
}

function checkEvents($file) {
    $string = file_get_contents($file);
    $res = json_decode($string, true);
    $s=array(); 
    foreach($res as $row) {
        if ($row["type"]=="Event") {
            $id=$row["id"];
            $url="http://daten.nachhaltiges-leipzig.de/api/v1/activities/$id.json";           
            $name=$row["name"];
            $beginn=$row["start_at"];
            $s[]='<tr><td>'.createLink($url,$name).'</td><td>'
                .$beginn.'</td></tr>';
        }
    }
    return '<table class="table table-bordered">'.join("\n",$s).'</table>';
}



// ---- test ----
// $s=getUsers("Dumps/activities.json"); analyze($s);
// echo checkProjects("Dumps/activities.json");
// echo checkUsers("Dumps/users.json");
// echo checkLocations("Dumps/locations.json");
echo checkEvents("Dumps/activities.json");
