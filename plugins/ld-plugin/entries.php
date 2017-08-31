<?php

require 'vendor/autoload.php';
require_once 'helper.php';

function getNameList($node,$type) 
{
    $s=array();
    foreach ($node->resources() as $a) {
        if ($a->type() == $type) {
            $id=$a->getUri();
            $title=$a->get("foaf:title");
            $name=$a->get("foaf:name");
            $location=$a->get("lifis:location");
            $interest=join(" / ", $a->all("foaf:topic_interest"));
            $email=$a->get("foaf:mbox");
            $out="$title <strong>$name</strong>";
            if (!empty($location)) {
                $out.=", $location"; 
            }
            $out.="<br/>";
            if (!empty($interest)) {
                $out.="$interest<br/>"; 
            }
            if (!empty($email)) {
                $out.='Email: <a href="mailto:'.$email.'">'.$email.'</a>'; 
            }
            $s["$id"]='<div class="member"><p>'.$out.'</p></div>';
        }
    }
    ksort($s);
    return '<div class="memberlist">'."\n".join("\n\n\n", $s).'</div>';
}

function getItemList($atts) 
{
    EasyRdf_Namespace::set('ld', 'http://leipzig-data.de/Data/Model/');
    $sparql = new EasyRdf_Sparql_Client('http://leipzig-data.de:8890/sparql');
    $result = $sparql->query(
        'SELECT * WHERE {'.
        '  ?u a ld:Ort; rdfs:label ?label .'.
        '} ORDER BY ?label'
    );
    $a=array();
    foreach ($result as $row) {
        $a[]="<li>".$row->u.", ". $row->label."</li>";
    }
    
    return join("\n ",$a);
}

function uhu($atts) 
{
    $graph = new EasyRdf_Graph("http://leipzig-data.de/Data/Orte/");
    $graph->parseFile("http://leipzig-data.de/RDFData/Orte.ttl");
    print_r($graph);
}


if (defined('ABSPATH') ) { 
    add_shortcode('itemlist', 'getItemList');
} else {
    $s=array(); echo htmlEnv(uhu($s)); // for testing
}

?>
