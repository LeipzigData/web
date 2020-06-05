<?php
/**
 * User: Hans-Gert Gräbe
 * Last Update: 2020-06-05
 */

// --- Hilfsfunktionen

function getDatum($d) {
// Verwandelt 2019-08-11T15:00:00.000+02:00 in Lesbares
    $out=date("d. M Y, H:i",strtotime($d));
    $out=str_replace('Jan','Januar',$out);
    $out=str_replace('Feb','Februar',$out);
    $out=str_replace('Mar','März',$out);
    $out=str_replace('Apr','April',$out);
    $out=str_replace('May','Mai',$out);
    $out=str_replace('Jun','Juni',$out);
    $out=str_replace('Jul','Juli',$out);
    $out=str_replace('Aug','August',$out);
    $out=str_replace('Sep','September',$out);
    $out=str_replace('Oct','Oktober',$out);
    $out=str_replace('Nov','November',$out);
    $out=str_replace('Dec','Dezember',$out);
    return $out;
}

function createLink($s,$text) {
    return "<a href=\"$s\" target=\"_blank\">$text</a>";
}

function zdtrim($s) {
    return str_replace("http://leipzig-data.de/Data/",'',$s);
}

function mehrzeilig($a) {
    return str_replace("\n",'<br/>',$a);
}

function geoData($v) {
    if (array_key_exists("latlng",$v)) {
        $l=$v["latlng"];
        return "Point($l[1] $l[0])";
    }
}

function akteursKontakt($v) {
    if (array_key_exists("last_name",$v)) {
        return $v["first_name"]." ".$v["last_name"].", "
            .$v["organization_position"];
    }
}

function displayPartner($v) {
    $vid=$v["id"];
    $va="http://daten.nachhaltiges-leipzig.de/api/v1/users/$vid.json";
    $url=$v["organization_url"];
    $adr=$v["full_address"];
    $geo=geoData($v);
    $kontakt=akteursKontakt($v);
    $head=createLink($va,$v["name"]);
    $out='<h3>'.$head.'</h3> <ul>'
        .'<li>Id: '.$vid.'</li>'
        .'<li>Name: '.$v["name"].'</li>';
    if (!empty($adr)) {
        $out.='<li>Adresse: '.$adr.'</li>';
    }
    if (!empty($geo)) {
        $out.='<li>Geokoordinaten im WKT-Format: '.$geo.'</li>';
    }
    if (!empty($kontakt)) {
        $out.='<li>Ansprechpartner: '.$kontakt.'</li>';
    }
    if (!empty($url)) {
        $out.='<li>URL: '.createLink($url,$url).'</li>';
    }
    return $out."</ul>";
}

function getLocation($v) {
    if ($v["is_online_event"]) { return "Online-Event"; }
    $ort=$v["location"].' '.$v["additional_address"];
    $adresse=$v["street"].", ".$v["zip"]." ".$v["city"];
    return $ort.
        '<br/><strong>Adresse:</strong> '.$adresse;
}

function getTargetGroup($o) {
    $a=join(", ",$o["extracurricular"]);
    $b=join(", ",$o["school"]);
    $out="";
    if (!empty($a)) { $out.="<br/>außerschulisch: $a"; }
    if (!empty($b)) { $out.="<br/>schulisch: $b"; }
    return $out; 
}

function getContext($o) {
    $a=$o["economic_aspect"];
    $b=$o["ecological_aspect"];
    $c=$o["social_aspect"];
    $out="";
    if (!empty($a)) { $out.="<br/>ökonomischer Aspekt: $a"; }
    if (!empty($b)) { $out.="<br/>ökologischer Aspekt: $b"; }
    if (!empty($c)) { $out.="<br/>sozialer Aspekt: $c"; }
    return $out; 
}

function getTopics($o) {
    $s=array();
    foreach($o as $t) { $s[]=$t["name"]; }
    return join(", ",$s); 
}

function getOrganizer($o) {
    $name=$o['name'];
    $adresse=$o['street'].", ".$o['zip']." ".$o['city'];
    $phone=$o['phone'];
    $email=$o['email'];
    $web=$o['website'];
    $out=$name;
    if (!empty($o['city'])) { $out.="<br/>Adresse: $adresse"; }
    if (!empty($phone)) { $out.="<br/>tel.: $phone"; }
    if (!empty($email)) { $out.="<br/>email: $email"; }
    if (!empty($web)) { $out.="<br/>web: ".createlink($web,$web); }
    return $out;
}