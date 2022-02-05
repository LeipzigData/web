<?php
/**
 * User: Hans-Gert Gräbe
 * Date: 2022-02-05
 */

include_once("layout.php");

$content='      
<div class="container">
<h2 align="center">Leipziger MINT-Orte</h2>

<div class="row">
  <p>
    Im Rahmen dieses studentischen Projekts wurden 2015 die als pdf-Dokumente
    vorhandenen Daten des 2014er MINT-Katalogs der Stadt Leipzig als RDF
    aufbereitet, mit den vorhandenen Daten des 2012er MINT-Katalogs der Stadt
    Leipzig abgeglichen und für eine Online-Präsentation aufbereitet.
  </p>
  
  <p>
    Die Webpräsenz wurde mit Angular erstellt, später auf Angular 2
    aktualisiert, danach aber nicht mehr weiterentwickelt.  Der Code des
    Projekts ist als <a href="MINT-15.zip">zip-Datei</a> verfügbar, eine
    Demoversion <a href="http://leipzig-data.de/MINT-Orte">hier</a>.  
  </p>
</div>
</div>
';
echo showPage($content);

?>
