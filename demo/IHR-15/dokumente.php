<?php 

require_once("header.php");
require_once("footer.php");

$content='
<h2 align="center">Dokumente</h2>

<h3>Projektunterlagen</h3>
<ul>
  <li><a href="./Material/Projektbericht_Stadt.pdf">Projektbericht</a></li>
  <li><a href="./Material/FinalesRelease.zip">Finales Release</a> (25 MB)</li>
  <li><a href="http://www.leipzig-data.de:8891/sparql">SPARQL Endpunkt</a>.</li>
</ul>

<p>Bitte beachten Sie, dass die vom Dezernat für Finanzen der Stadt Leipzig zur Verfügung gestellten und für den RDF Store aufbereiteten Daten nicht mit den <a href="http://www.leipzig.de/buergerservice-und-verwaltung/stadtverwaltung/haushalt-und-finanzen/">veröffentlichten Haushaltsplänen</a> übereinstimmen und deshalb nur geeignet sind, das Potenzial unseres Ansatzes <i>prinzipiell</i> zu demonstrieren.</p>

<h3>Projektdokumentation</h3>

<ul>
  <li><a href="./Material/Evaluationsbericht.pdf">Evaluationsbericht</a> zum Vergleich der Haushaltsrechner</li>
  <li><a href="./Material/Anforderungsanalyse.pdf">Anforderungsanalyse</a> und <a href="./Material/Partizipationskonzept.pdf">Partizipationskonzept</a></li>
  <li>Weitere im Projektverlauf aufgenommene <a href="./Material/Requirements.pdf">Requirements</a> und deren Einordnung</li>
  <li><a href="./Material/Installationsanleitung.pdf">Installations- und Konfigurationsanleitung</a></li>
  <li><a href="./Material/Benutzerhandbuch.pdf">Benutzerhandbuch</a></li>
  <li><a href="./Material/Entwurfsbeschreibung.pdf">Entwurfsbeschreibung</a></li>
  <li><a href="./Material/RDF-Cube.pdf">Das RDF-Cube Datenkonzept</a></li>
  <li><a href="https://github.com/LeipzigData/IHR-15">github-Repo</a> mit Daten und Werkzeugen des Projekts</li>
</ul>

<h3>Weitere Projektunterlagen</h3>

<ul>            
  <li> <a href="./Anforderungsanalyse/141106-Vortragsfolien.pdf">Vortrag</a> zum Thema „Kommunale Finanzpolitik in der Stadt Leipzig“</li>
  <li><a href="./Anforderungsanalyse/HaushaltsrechnerHamburg.pdf">Analyse</a> des <a href="http://www.buergerhaushalt-hamburg.de/">Hamburger Haushaltsrechners</a></li>
  <li><a href="./Anforderungsanalyse/HaushaltsrechnerBund.pdf">Analyse</a> des <a href="http://www.bundeshaushalt-info.de/startseite.html" >Bundeshaltsplanrechners</a></li>
  <li><a href="./Anforderungsanalyse/SkizzeHaushaltsrechner.pdf">Skizze</a> f&uuml;r Design-Elemente eines Haushaltsrechners</li>
</ul>

 ';

echo myHeader().($content).myFooter();
