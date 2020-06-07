<?php
/**
 * User: Hans-Gert Gräbe
 * Last Update: 2020-06-07
 */

include_once("layout.php");
include_once("helper.php");

function getPosts() {
    $src="Dumps/Posts.json";
    $string = file_get_contents($src);
    $res = json_decode($string, true);
    $s;
    foreach($res as $row) {
        $s[]=thePost($row);
    }
    // ksort($s);
    return join("\n",$s);
}

function thePost($v) {
    // ein Post
    $id=$v["id"];
    $src="https://bne-sachsen.de/wp-json/content/posts?p=$id";
    $title=$v["title"];
    $pd=getDatum($v["date"]);
    $kontakt=$v["author"];
    $beschreibung=$v["content"];
    $summary=$v["excerpt"];
    $out='<h3> <a href="'.$src.'">'.$title.'</a></h3>
<div class="row"> <ul>';
    $out.='<li>Veröffentlicht am: '.$pd.'</li>';
    $out.='<li>Ansprechpartner: '.$kontakt.'</li>';
    $out.='<li><strong>Summary:</strong> '.$summary.'</li>';
    $out.='<li> <strong>Mitteilung:</strong> '.$beschreibung.' </li>';
    $out.='</ul></div>';
    return $out;
}

$content='
<div class="container"> 
<h2 align="center">Die Posts</h2>
'.getPosts().'
</div>
';
echo showPage($content);

?>
