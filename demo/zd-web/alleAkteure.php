<?php
/**
 * User: Hans-Gert Gräbe
 * Last Update: 2022-08-28
 */

include_once("layout.php");
include_once("Zukunftsdiplom.php");

/*
Diese Funktion ist sehr langsam, da sie auf die URL zugreift.
*/
function getUsers() {
    $src="Dumps/users.json";
    $string = file_get_contents($src);
    $res = json_decode($string, true);
    $s;
    foreach($res as $row) {
        $s[strtolower(trim($row["name"]))]=displayUser($row);
        /* Einige Namen hatten am Anfang ein Leerzeichen. Dadurch war die
           Sotierung fehlerhaft. */
    }
    ksort($s);
    return join("\n",$s);
}

function displayUser($v) {
    $vid=$v["id"];
    //$va="http://daten.nachhaltiges-leipzig.de/api/v1/users/$vid.json";
    $url=$v["organization_url"];
    $type=$v["organization_type"];
    $description=$v["description"];
    $logo=$v["organization_logo_url"];
    $logo_base=$v["organization_logo_url_base"];
    $adr=$v["full_address"];
    $district=$v["district"];
    $geo=$v["latlng"];
    $head=$v["name"];
    $region=$v["region"];
    $out='<h3>'.$head.'</h3> <ul>'
        .'<li>Id: '.$vid.'</li>'
        .'<li>Type: '.$type.'</li>'
        .'<li>Name: '.$v["name"].'</li>';
    if (!empty($adr)) {
        $out.='<li>Adresse: '.$adr.'</li>';
    }
    if (!empty($region)) {
        $out.='<li>Region: '.join(", ",$region).'</li>';
    }
    if (!empty($geo)) {
        $out.='<li>Geokoordinaten: Point('.join(", ",$geo).')</li>';
    }
    if (!empty($description)) {
        $out.='<li>Beschreibung: '.$description.'</li>';
    }
    if (!empty($url)) {
        $out.='<li>URL: '.createLink($url,$url).'</li>';
    }
    if (!empty($logo)) {
        $out.='<li>Logo: '.createLink($logo,$logo).'</li>';
    }
    if (!empty($logo_base)) {
        $out.='<li>Logo URL: '.createLink($logo_base,$logo_base).'</li>';
    }
    return $out."</ul>";
}

$content='
<div class="container">
<h2 align="center">Alle Akteure in der Nachhaltigkeitsdatenbank</h2>

<p>Auf dieser Seite werden alle Akteure in der Nachhaltigkeitsdatenbank
gelistet. </p>

'.getUsers().'
</div>
';
echo showPage($content);

?>
