<?php

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
    $store='http://leipzig-data.de:8890/sparql';
    $query='
PREFIX ld: <http://leipzig-data.de/Data/Model/>
SELECT * 
from <http://leipzig-data.de/Data/Orte/>
WHERE {
?u a ld:Ort; rdfs:label ?label } 
ORDER BY ?label';
    $result=sparqlQuery($query,$store);
    $a=array();
    foreach ($result['results']['bindings'] as $k => $v) {
        $a[]="<li>".$v['u']['value'].", ". $v['label']['value']."</li>";
    }
    return join("\n ",$a);
}


if (defined('ABSPATH') ) { 
    add_shortcode('itemlist', 'getItemList');
} else {
    $s=array(); echo getItemList($s); // for testing
}

?>
