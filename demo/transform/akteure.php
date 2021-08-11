<?php
/**
 * User: Hans-Gert Gräbe
 * Last Update: 2021-08-11

 * Darstellung der Akteure aus den beteiligten Plattformen. 

 */

require_once("helper.php");
require_once("layout.php");

function getAkteure() {
    setNamespaces();
    $graph = new \EasyRdf\Graph('http://leipzig-data.de/rdf/Akteure/');
    $graph->parseFile('rdf/NachhaltigesSachsen.rdf');
    //echo $graph->dump("turtle");
    $a=array();
    foreach($graph->allOfType('nl:Akteur') as $v) {
        $uri=$v->getURI();
        $name=$v->get("rdfs:label");
        $url=$v->get("foaf:homepage");
        $source=$v->get("ld:hasSource");
        $type=$v->get("ld:hasType");
        $address=$v->get("ld:hasFullAddress");
        $geo=$v->get("gsp:asWKT");
        $region=join(", ",$v->all("ld:inRegion"));
        $a[createIndex($name)]='<h4>'.createLink($uri,$name).'</h4>
<strong>Quelle:</strong> '.$source.'<br/>
<strong>Akteurstyp:</strong> '.$type.'<br/>
<strong>Adresse:</strong> '.$address.'<br/>
<strong>Geokoordinaten:</strong> '.$geo.'<br/>
<strong>Region:</strong> '.$region.'<br/>
';
    }
    $graph->parseFile('rdf/LeipzigerEcken.rdf');
    //echo $graph->dump("turtle");
    foreach($graph->allOfType('le:Akteur') as $v) {
        $uri=$v->getURI();
        $name=$v->get("rdfs:label");
        $url=$v->get("foaf:homepage");
        $source=$v->get("ld:hasSource");
        $type=getNames($v->all("ld:hasType"));
        $address=$v->get("ld:hasFullAddress");
        $geo=$v->get("gsp:asWKT");
        $region=getNames($v->all("ld:inRegion"));
        $categories=getNames($v->all("ld:hasCategory"));
        $targets=getNames($v->all("ld:hasTargetGroup"));
        $tags=getNames($v->all("ld:hasTag"));
        $a[createIndex($name)]='<h4>'.createLink($uri,$name).'</h4>
<strong>Quelle:</strong> '.$source.'<br/>
<strong>Akteurstyp:</strong> '.$type.'<br/>
<strong>Adresse:</strong> '.$address.'<br/>
<strong>Geokoordinaten:</strong> '.$geo.'<br/>
<strong>Region:</strong> '.$region.'<br/>
<strong>Kategorien:</strong> '.$categories.'<br/>
<strong>Target-Gruppen:</strong> '.$targets.'<br/>
<strong>Tags:</strong> '.$tags.'<br/>
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

echo showpage($content);

?>
