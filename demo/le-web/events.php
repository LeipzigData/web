<?php
/**
 * User: Hans-Gert Gräbe
 * Last Update: 2020-04-02
 */

include_once("layout.php");
include_once("helper.php");

function getEvents($startDate) {
    $graph=loadData();
    setNamespace();
    $s=array();
    foreach ($graph->allOfType("ld:Event") as $v) {
        $eventdate=$v->get("ical:dtstart");
        $name=$v->get("rdfs:label");
        if ($eventdate>$startDate) {
            $s[$eventdate.$name]=displayEvent($v);
        }
    }
    ksort($s);
    return join("\n",$s);
}

function displayEvent($v) {
    $ansprechpartner=$v->getResource("ical:creator")->get("foaf_name");
    $adresse=displayAddress($v->getResource("ical:location"));
    $id=$v->get("le:hasEID");
    $name=$v->get("rdfs:label");
    $url=fixURL($v->get("ical:url"));
    $description=$v->get("ical:summary");
    $start=getDatum($v->get("ical:dtstart"));
    $adresszusatz=$v->get("le:hatAdresszusatz");
    $out='<h3>'.$name.'</h3> <ul>'
        .'<li>Id: '.$id.'</li>';
    if (!empty($start)) {
        $out.='<li><strong>Beginn:</strong> '.$start.'</li>';
    }
    if (!empty($description)) {
        $out.='<li><strong>Summary:</strong> '.$description.'</li>';
    }
    if (!empty($adresse)) { $out.=$adresse; }
    if (!empty($akteur)) {
        $out.='<li>Eingestellt von: '.$ansprechpartner.'</li>';
    }
    if (!empty($url)) {
        $out.='<li>URL: '.createLink($url,$url).'</li>';
    }
    return $out."</ul>";
}

$startDate="2020-10-01";
$content='
<div class="container">
<h2 align="center">Die Events</h2>

'.getEvents($startDate).'
</div>
';
echo showPage($content);

?>
