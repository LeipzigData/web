<?php
/**
 * User: Hans-Gert Gräbe
 * Date: 2022-02-05
 */

include_once("layout.php");

$content='      
<div class="container">
<h2 align="center">Projekt Nachgeradelt</h2>

<div class="row">
<p>
  Das Projekt war ein Beitrag zum Wettbewerb "Coding da Vinci Ost 2018".  Zur
  Verfügung standen Digitalisate alter Tourenbücher, die in dem Kontext digital
  aufbereitet und durch Abfahren der Routen aktualisiert wurden.
</p>

<p>
  Idee: Eine Webanwendung, um diese Behauptung exemplarisch für eine
  historische Radtourenbeschreibungen um Leipzig zu überprüfen und um ggf.
  anschließend als Event zu veranstalten und Nachahmer zu aktivieren. Über
  Filterfunktionen soll digitalisiertes Wissen auch von (anderen) Kulturgütern
  entlang der Strecke darstellbar sein. Die Webanwendung soll im Idealfall
  Nachnutzung ermöglichen. In der Pilotphase ensteht eine Tour bei oder um
  Leipzig.
</p>

<p>
  Der Code des Projekts ist
  auf <a href="https://github.com/nachgeradelt">github</a> zu finden, ein
  prototypischer Demonstrator
  auf <a href="http://leipzig-data.de/Nachgeradelt">dieser Seite</a>.
</p>
</div>
</div>
';
echo showPage($content);

?>
