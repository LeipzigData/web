<?php
/**
 * User: Hans-Gert Gräbe
 * Date: 2020-04-01
 * Last Update: 2020-04-02
 */

include_once("layout.php");
include_once("helper.php");

function dieAkteure() {
    // genauere Trennung Ort, Akteur, Adresse
    $graph=loadData();
    setNamespace();
    $s=array();
    foreach ($graph->allOfType("le:Ort") as $v) {
        $s[]=displayOrt($v);
    }    
    return join("\n",$s);
}

function displayOrt($v) {
    $ansprechpartner=$v->getResource("ld:hasSupplier")
                       ->getResource("org:hasMember")->get("foaf_name");
    $adresse=displayAddress($v->getResource("le:hatAdresse"));
    $id=$v->get("le:hasAID");
    $name=$v->get("foaf:name");
    $url=fixURL($v->get("foaf:homepage"));
    $description=$v->get("foaf:description");
    $adresszusatz=$v->get("le:hatAdresszusatz");
    $out='<h3>'.$name.'</h3> <ul>'
        .'<li>Id: '.$id.'</li>';
    if (!empty($description)) {
        $out.='<li><strong>Beschreibung:</strong> '.$description.'</li>';
    }
    if (!empty($adresse)) { $out.=$adresse; }
    if (!empty(trim($adresszusatz))) {
        $out.='<li>Adresszusatz: '.$adresszusatz.'</li>';
    }
    if (!empty($akteur)) {
        $out.='<li>Ansprechpartner: '.$ansprechpartner.'</li>';
    }
    if (!empty($url)) {
        $out.='<li>URL: '.createLink($url,$url).'</li>';
    }
    return $out."</ul>";
}

$content='
<div class="container">
<h2 align="center">Die Akteure</h2>

'.dieAkteure().'
</div>
';
echo showPage($content);
?>
