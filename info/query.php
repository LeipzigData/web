<?php
/**
 * User: Hans-Gert Gräbe
 * Date: 2017-09-04 
 * Last Update: 2018-09-11
 *
 */

function queryStore($store,$query) {
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

function showData($store,$uri) {
    $query=' select * where { <'.$uri.'> ?p ?o . } ';
    $r=queryStore($store,$query);
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

// echo showData('http://leipzig-data.de:8890/sparql','http://leipzig-data.de/Data/Schule/157-GS');
// echo showData('https://opendata.leipzig.de/virt-sparql','');
