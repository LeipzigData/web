<?php
/**
 * User: Hans-Gert Gräbe
 * Date: 2018-06-07
 * Last Update: 2019-11-12
 */

include_once("layout.php");

$content='      
<div class="container">
<div class="row">
<div  class="col-lg-3 col-sm-1"></div><div  class="col-lg-6 col-sm-10">

<p>Die <a href="https://www.zukunftsakademie-leipzig.de">ZAK –
Zukunftsakademie Leipzig e.V. (ZAK)</a> wurde im Juni 2011 mit dem Ziel
gegründet, lokale Akteure im Bereich Bildung für nachhaltige Entwicklung zu
beraten, zu vernetzen sowie inhaltlich und organisatorisch dabei zu
unterstützen, Bildungskonzepte für alle Bevölkerungsgruppen anzubieten.  Sie
ist integraler Bestandteil des <a href="https://www.nachhaltiges-leipzig.de/"
>Forums Nachhaltiges Leipzig</a>.  </p>

<p>Auf dieser Webpräsenz werden eine Reihe prototypischer Anwendungen gezeigt,
die auf der Basis der öffentlichen Schnittstelle unserer 
<a href="https://daten.nachhaltiges-leipzig.de/">Akteursdatenbank</a> erstellt 
wurden.  Es geht dabei nicht um Schönheit, sondern darum, die prinzipiellen
Möglichkeiten einer solchen Schnittstelle zu demonstrieren.  Der Quellcode der
Anwendungen ist im <a href="https://github.com/LeipzigData/web">github
Repo</a> des Leipzig Data Projekts zu finden.  </p>

</div> </div>

';
echo showPage($content);

?>
