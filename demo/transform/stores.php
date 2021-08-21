<?php
/**
 * User: Hans-Gert Gräbe
 * Last Update: 2021-08-21

 * Darstellung der Fair Trade Shops aus NL

 */

require_once("helper.php");
require_once("layout.php");

function getStores() {
    setNamespaces();
    $graph = new \EasyRdf\Graph('http://leipzig-data.de/rdf/Stores/');
    $graph->parseFile('rdf/NachhaltigesSachsen.rdf');
    //echo $graph->dump("turtle");
    $a=array();
    foreach($graph->allOfType('nl:Store') as $v) {
        //$uri=$v->getURI();
        $name=$v->get("rdfs:label");
        $url=$v->get("foaf:homepage");
        $source=$v->get("ld:hasSource");
        $akteur=getNames($v->all("ld:hasAkteur"));
        $link=$v->get("rdfs:seeAlso");
        $address=$v->get("ld:hasFullAddress");
        $geo=$v->get("gsp:asWKT");
        $region=join(", ",$v->all("ld:inRegion"));
        $produkte=join(", ",$v->all("ld:hasProduct"));
        $kategorien=join(", ",$v->all("ld:hasTradeCategory"));
        $typ=join(", ",$v->all("ld:hasTradeType"));
        $a[createIndex($name)]='<h4>'.createLink($link,$name).'</h4>
<strong>Quelle:</strong> '.$source.'<br/>
<strong>Adresse:</strong> '.$address.'<br/>
<strong>Geokoordinaten:</strong> '.$geo.'<br/>
<strong>Akteur:</strong> '.$akteur.'<br/>
<strong>Region:</strong> '.$region.'<br/>
<strong>Produkte:</strong> '.$produkte.'<br/>
<strong>Kategorien:</strong> '.$kategorien.'<br/>
<strong>Typ:</strong> '.$typ.'<br/>
';
    }
    ksort($a);
    return join("\n",$a);
}

$content='
<div class="container">

  <h2 align="center">Fair Trade Stores</h2>

<p> Eine aus "Nachhaltiges Sachsen" akkumulierte Übersicht.</p>
'.getStores().'

</div> 
';

echo showpage($content);

?>
