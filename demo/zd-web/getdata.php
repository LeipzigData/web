<?php
/**
 * User: Hans-Gert Gräbe
 * Date: 2017-09-04
 * Last Update: 2019-02-24
 */

include_once("layout.php");

function getData($uri) {
    //echo $uri;
    $store='http://leipzig-data.de:8890/sparql';
    $query=' select * where { <'.$uri.'> ?p ?o . } ';
    $get_parameters =
        '?query=' . urlencode ($query) .
        '&format=application%2Fsparql-results%2Bjson' ; 
    $req = $store . $get_parameters;
    $result = file_get_contents($req);
    //print_r($result);
    $r = json_decode($result,true);
    //print_r($r);
    return $r;
}

function showData($uri) {
    $r=getData($uri);
    if (empty($r['results']['bindings']))
        return "URI <$uri> existiert nicht\n\n" ; 
    $a=array();
    foreach ($r['results']['bindings'] as $k => $v) {
        $a[]='  '.wrap($v['p']).'  '.wrap($v['o']);
    }
    return "<".$uri.">\n  ".join(";\n  ",$a)." . \n\n";
}

function wrap($u) {
    if ($u['type']=="uri") return '<'.$u['value'].'>';
    else return '"'.$u['value'].'"';
}

function prettyprint($u) {
    return "<pre>".htmlspecialchars($u)."</pre>";
}

// echo getData('http://leipzig-data.de/Data/Schule/157-GS'); 
// echo showData('http://leipzig-data.de/Data/Schule/151-GS');
// echo showData('http://leipzig-data.de/Data/Events/');

echo pageHeader().prettyprint(showData($_GET['show'])).pageFooter();