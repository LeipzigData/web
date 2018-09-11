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
Orte erstellt wurde.</div>

<div class="row">Mehr zum Projekt
<ul>
<li> <a href="http://leipzig-data.de/anwendungen/gebaudenavigator/">Mehr zum
    Projekt</a> auf den Seiten von leipzig-data.de</li>
<li> <a href="https://behindertenverband-leipzig.de/gebaeude-navigator">Die
Navigatordemo</a></li>
</ul>
</div>
'.navigator().'

</div>';

echo showPage($content);

?>
