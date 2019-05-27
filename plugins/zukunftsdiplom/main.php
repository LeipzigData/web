<?php
/**
   Plugin Name: Zukunftsdiplom der Zukunftsakademie Leipzig
   Version: 0.0.1

   Description: Lade die im Kontext von Leipzig Datae extern aufgebaute
   Webpräsenz zum Zukunftsdiplom in eine Wordpress-Instanz

   @author Hans-Gert Gräbe <graebe@informatik.uni-leipzig.de>
   @link   http://bis.informatik.uni-leipzig.de/HansGertGraebe
*/

require_once "helper.php";

function zukunftsdiplom() {
    return file_get_contents("http://leipzig-data.de/demo/zd-web/content.html");
}
    
if (defined('ABSPATH') ) { 
    add_shortcode('zukunftsdiplom', 'zukunftsdiplom');
} else {
    $s=array(); echo htmlEnv(zukunftsdiplom($s)); // for testing
}

?>
