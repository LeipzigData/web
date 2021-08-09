<?php
/**
 * User: Hans-Gert Gräbe
 * Last Update: 2021-08-08

 * Darstellung der nach rdf/Akteure.rdf extrahierten Akteure. 

 */

require_once("helper.php");
require_once("layout.php");

function getAkteure() {
    setNamespaces();
    $graph = new \EasyRdf\Graph('http://leipzig-data.de/rdf/Akteure/');
    $graph->parseFile('rdf/Akteure.rdf');
    //echo $graph->dump("turtle");
    $a=array();
    foreach($graph->allOfType('ld:Akteur') as $v) {
        $name=$v->get("rdfs:label");
        $url=$v->get("foaf:homepage");
        $source=$v->get("ld:hasSource");
        $type=$v->get("ld:hasType");
        $lid=$v->get("rdfs:isDefinedBy");
        $address=$v->get("ld:hasFullAddress");
        $geo=$v->get("gsp:asWKT");
        $region=join(", ",$v->all("ld:inRegion"));
        $a[createIndex($name)]='<h4>'.createLink($lid,$name).'</h4>
<strong>Quelle:</strong> '.$source.'<br/>
<strong>Akteurstyp:</strong> '.$type.'<br/>
<strong>Adresse:</strong> '.$address.'<br/>
<strong>Geokoordinaten:</strong> '.$geo.'<br/>
<strong>Region:</strong> '.$region.'<br/>
';
    }
    ksort($a);
    return join("\n",$a);
}

$content='
<div class="container">

  <h2 align="center">Akteure</h2>

<p> Eine aus verschiedenen Quellen akkumulierte Übersicht.</p>
'.getAkteure().'

</div> 
';

// zum Testen
// echo getAllActivities();

echo showpage($content);

?>
