<?php
/**
 * User: Hans-Gert Gräbe
 * Last Update: 2020-06-07
 */

include_once("layout.php");
include_once("helper.php");

function getMaterials() {
    $src="Dumps/Materials.json";
    $string = file_get_contents($src);
    $res = json_decode($string, true);
    $s;
    foreach($res as $row) {
        $s[]=theMaterial($row);
    }
    // ksort($s);
    return join("\n",$s);
}

function theMaterial($v) {
    // ein Material
    $id=$v["id"];
    $src="https://bne-sachsen.de/wp-json/content/materials?p=$id";
    $title=$v["title"];
    $pd=getDatum($v["date"]);
    $kontakt=$v["author"];
    // $zielgruppe=getTargetGroup($v["target_group"]);
    $topics=getTopics($v["topics"]);
    $organizer=getOrganizer($v["offerer"]);
    $beschreibung=$v["description"];
    $out='<h3> <a href="'.$src.'">'.$title.'</a></h3>
<div class="row"> <ul>';
    $out.='<li>Veröffentlicht am: '.$pd.'</li>';
    $out.='<li>Ansprechpartner: '.$kontakt.'</li>';
    //$out.='<li> <strong>Zielgruppe:</strong> '.$zielgruppe.' </li>';
    $out.='<li> <strong>Anbieter: </strong>'.$organizer.'</li>';
    $out.='<li> <strong>Topics:</strong> '.$topics.' </li>';
    $out.='<li> <strong>Beschreibung:</strong> '.$beschreibung.' </li>';
    $out.='</ul></div>';
    return $out;
}

$content='
<div class="container"> 
<h2 align="center">Die Materialien</h2>
'.getMaterials().'
</div>
';
echo showPage($content);

?>
