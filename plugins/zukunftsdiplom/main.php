<?php
/**
   Plugin Name: Zukunftsdiplom der Zukunftsakademie Leipzig
   Version: 0.1

   Description: Lade die im Kontext von Leipzig Data extern aufgebaute
   Webpräsenz zum Zukunftsdiplom in eine Wordpress-Instanz

   @author Hans-Gert Gräbe <graebe@informatik.uni-leipzig.de>
   @link   http://bis.informatik.uni-leipzig.de/HansGertGraebe
*/

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

function zukunftsdiplom() {
    return file_get_contents("http://leipzig-data.de/demo/zd-web/content.php");
}

function zd($atts) {
    $action=$atts["action"];
    return file_get_contents("http://leipzig-data.de/demo/zd-web/content.php?$action");
}

if (defined('ABSPATH') ) {
    add_shortcode('zukunftsdiplom', 'zukunftsdiplom');
    add_shortcode('zd', 'zd');
} else {
    $s=array("action" => "meier"); echo htmlEnv(zd($s)); // for testing
}

?>
