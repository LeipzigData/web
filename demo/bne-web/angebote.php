<?php
/**
 * User: Hans-Gert Gräbe
 * Last Update: 2020-06-05
 */

include_once("layout.php");
include_once("helper.php");

function getOffers() {
    $src="Dumps/Offers.json";
    $string = file_get_contents($src);
    $res = json_decode($string, true);
    $s;
    foreach($res as $row) {
        $s[]=theOffer($row);
    }
    // ksort($s);
    return join("\n",$s);
}

function theOffer($v) {
    // ein Angebot
    $id=$v["id"];
    $src="https://bne-sachsen.de/wp-json/content/offers?p=$id";
    $title=$v["title"];
    // $ort=getLocation($v);
    // $organizer=getOrganizer($v["organizer"]);
    $kontakt=$v["author"];
    // $zielgruppe=getTargetGroup($v["target_group"]);
    $topics=getTopics($v["topics"]);
    $region=join(", ",$v["districts"]);
    $beschreibung=$v["teaser_text"];
    $kontext=getContext($v);
    $out='<h3> <a href="'.$src.'">'.$title.'</a></h3>
<div class="row"> <ul>';
    $out.='<li> <strong>Region: </strong>'.$region.'</li>';
     //$out.='<li> <strong>Veranstalter: </strong>'.$organizer.'</li>';
    $out.='<li>Ansprechpartner des Veranstalters: '.$kontakt.'</li>';
    //$out.='<li> <strong>Zielgruppe:</strong> '.$zielgruppe.' </li>';
    $out.='<li> <strong>Kontext:</strong> '.$kontext.' </li>';
    $out.='<li> <strong>Topics:</strong> '.$topics.' </li>';
    $out.='<li> <strong>Beschreibung:</strong> '.$beschreibung.' </li>';
    $out.='</ul></div>';
    return $out;
}

$content='
<div class="container"> 
<h2 align="center">Die Angebote</h2>
'.getOffers().'
</div>
';
echo showPage($content);

?>
