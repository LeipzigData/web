<?php
/**
 * User: Hans-Gert Gräbe
 * Last Update: 2019-07-26
 */

include_once("layout.php");
include_once("Zukunftsdiplom.php");

/*
Diese Funktion ist sehr langsam, da sie auf die URL zugreift.
*/
function getUsers() {
    $src="http://daten.nachhaltiges-leipzig.de/api/v1/users.json";
    //$src="Dumps/Zukunftsdiplom.json";
    $string = file_get_contents($src);
    $res = json_decode($string, true);
    $s;
    foreach($res as $row) {
        $s[trim($row["name"])]=displayUser($row); //Einige Namen hatten am Anfang ein Leerzeichen. Dadruch war die Sotierung fehlerhaft.
    }
    ksort($s);
    return join("\n",$s);
}

function displayUser($v) {
    $vid=$v["id"];
    $va="http://daten.nachhaltiges-leipzig.de/api/v1/users/$vid.json";
    $url=$v["organization_url"];
    $type=$v["organization_type"];
    $adr=$v["full_address"];
    $head=createLink($va,$v["name"]);
    $out='<h3>'.$head.'</h3> <ul>'
        .'<li>Id: '.$vid.'</li>'
        .'<li>Type: '.$type.'</li>'
        .'<li>Name: '.$v["name"].'</li>';
    if (!empty($adr)) {
        $out.='<li>Adresse: '.$adr.'</li>';
    }
    if (!empty($url)) {
        $out.='<li>URL: '.createLink($url,$url).'</li>';
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
