<?php

function htmlEnv($out) 
{
    return '
<HTML>
<HEAD>
  <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
</HEAD><BODY>
'.$out.'
</BODY></HTML>
';
}

function sparqlQuery($query,$store) {
    $parameters =
        '?query=' . urlencode ($query) .
        '&format=application%2Fsparql-results%2Bjson'.
        '&timeout=0' .                          
        '&debug=on';
    $req = $store . $parameters;
    $result = file_get_contents($req);
    $r = json_decode($result,true);
    return $r;
}


function fixEncoding($out) 
{
    return str_replace(
        array("„","“","–"), array("&#8222","&#8221","&ndash;"), $out
    );
}

function getFile($fn) 
{
    if (! defined('ABSPATH') ) {
        return $fn; 
    } else {
        return plugin_dir_path(__FILE__).$fn; 
    } 
}


/* test

$store='http://leipzig-data.de:8890/sparql';
$query='
PREFIX ld: <http://leipzig-data.de/Data/Model/>
SELECT * 
from <http://leipzig-data.de/Data/Orte/>
WHERE {
?u a ld:Ort; rdfs:label ?label } 
ORDER BY ?label';
print_r(sparqlQuery($query,$store));
*/
?>