<?php
/**
 * User: Hans-Gert Gräbe
 * Date: 2018-09-11
 */

include_once("query.php");
include_once("layout.php");
include_once("php/Gebaeudenavigator.php");

$content='      
<div class="container"> 

<h2 align="center">Der Leipziger Gebäudenavigator</h2>

<div class="row">Der Leipziger Gebäudenavigator ist ein Projekt im Rahmen von
<a href="http://aksw.org/Projects/LEDS.html">LEDS</a>, in dem unter der
Projektleitung von Konrad Abicht gemeinsam mit dem Behindertenverband Leipzig
eine RDF-basierte Übersicht über die behindertengerechte Ausstattung Leipziger
Orte erstellt wurde.  

<p>Die Daten sind im RDF Store des Open Data Portals der Stadt Leipzig
verfügbar und können über deren SPARQL Endpunkt ausgelesen werden.</p>

<p>Die folgende Übersicht demonstriert, wie dies praktisch umgesetzt werden
kann.  Es wird die Liste der 814 Leipziger Orte extrahiert, die im
Gebäudenavigator erfasst sind, und für jeden dieser Orte ein Link
bereitgestellt, über den die für diesen ort hinterlegten Informationen im
RDF-Format abgerufen werden können.  Der Code (31 Zeilen) kann in unserem Git
Repo studiert werden. </p>

<h3>Mehr zum Projekt "Leipziger Gebäudenavigator"</h3>
<ul>
<li> <a href="http://leipzig-data.de/anwendungen/gebaudenavigator/">Mehr zum
    Projekt</a> auf den Seiten von leipzig-data.de</li>
<li> <a href="https://behindertenverband-leipzig.de/gebaeude-navigator">Die
Navigatordemo</a></li>
</ul>
'.navigator().'
</div>
</div>';

echo showPage($content);

?>
