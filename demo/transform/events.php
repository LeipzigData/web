<?php
/**
 * User: Hans-Gert Gräbe
 * Last Update: 2020-03-27

 * Darstellung der Events (ab 2021) aus den beteiligten Plattformen. 

 */

include_once("helper.php");
require_once("layout.php");

function getEvents() {
    setNamespaces();
    $graph = new \EasyRdf\Graph('http://leipzig-data.de/rdf/Events/');
    $graph->parseFile('rdf/NachhaltigesSachsen.rdf');
    $a=array();
    foreach($graph->allOfType('nl:Event') as $v) {
        $date=$v->get("ical:dtstart");
        if ($date<"2021") { continue; }
        $uri=$v->getURI();
        $name=$v->get("rdfs:label");
        $url=$v->get("foaf:homepage");
        $source=$v->get("ld:hasSource");
        $address=$v->get("ld:hasFullAddress");
        $geo=$v->get("gsp:asWKT");
        $region=getNames($v->all("ld:inRegion"));
        $akteur=getNames($v->all("ld:hasAkteur"));
        // Kategorien sind noch nicht in die RDF-Quelle extrahiert.
        $categories=join(", ",$v->all("ld:hasCategory"));
        $categories=str_replace("https://daten.nachhaltiges-sachsen.de/api/v1/categories/","",$categories);
        $goals=join(", ",$v->all("ld:hasGoal"));
        $a[createIndex($date.$name)]='<h4>'.createLink($uri,$name).'</h4>
<strong>Quelle:</strong> '.$source.'<br/>
<strong>Datum:</strong> '.showDate($date).'<br/>
<strong>Akteur:</strong> '.$akteur.'<br/>
<strong>Adresse:</strong> '.$address.'<br/>
<strong>Geokoordinaten:</strong> '.$geo.'<br/>
<strong>Region:</strong> '.$region.'<br/>
<strong>Kategorien:</strong> '.$categories.'<br/>
';
    }
    $graph->parseFile('rdf/LeipzigerEcken.rdf');
    foreach($graph->allOfType('le:Event') as $v) {
        $date=$v->get("ical:dtstart");
        if ($date<"2021") { continue; }
        $uri=$v->getURI();
        $name=$v->get("rdfs:label");
        $url=$v->get("foaf:homepage");
        $source=$v->get("ld:hasSource");
        $address=$v->get("ld:hasFullAddress");
        $geo=$v->get("gsp:asWKT");
        $region=getNames($v->all("ld:inRegion"));
        $akteur=getNames($v->all("ld:hasAkteur"));
        $categories=getNames($v->all("ld:hasCategory"));
        $goals=getNames($v->all("ld:hasTag"));
        $a[createIndex($date.$name)]='<h4>'.createLink($uri,$name).'</h4>
<strong>Quelle:</strong> '.$source.'<br/>
<strong>Datum:</strong> '.showDate($date).'<br/>
<strong>Akteur:</strong> '.$akteur.'<br/>
<strong>Adresse:</strong> '.$address.'<br/>
<strong>Geokoordinaten:</strong> '.$geo.'<br/>
<strong>Region:</strong> '.$region.'<br/>
<strong>Kategorien:</strong> '.$categories.'<br/>
<strong>Goals:</strong> '.$goals.'<br/>
';
    }
    krsort($a);
    return join("\n",$a);
}

$content='
<div class="container">

  <h2 align="center">Events</h2>

<p> Eine aus verschiedenen Quellen akkumulierte Übersicht.  Revers nach Datum
geordnet</p>
'.getEvents().'

</div> 
';

echo showpage($content);

?>
