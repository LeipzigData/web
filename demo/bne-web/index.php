<?php
/**
 * User: Hans-Gert Gräbe
 * Last Update: 2020-06-05
 */

include_once("layout.php");

$content='      
<div class="container">
<div class="row">
<div  class="col-lg-3 col-sm-1"></div><div  class="col-lg-6 col-sm-10">

<p>Auf der Plattform <a href="https://bne-sachsen.de">bne-sachsen.de</a>
werden von verschiedenen Akteuren Daten über die eigenen Aktivitäten
zusammengetragen. Im Zuge der Vernetzung von Plattformen strebt die Leipziger
Zukunftsakademie (ZAK) eine einheitliche Lösung an, über die in den lokalen
Plattformen eingegebene Daten in übergreifende Plattformen integriert werden
können, um das lästige vielfache Eingeben derselben Informationen in
verschiedene Plattformen verschiedener Betreiber zu vermeiden, nur weil diese
nicht in der Lage oder willens sind, sich untereinander abzusprechen.  Das
Projekt steht in engem Zusammenhang mit Bemühungen des <a
href="https://www.nachhaltiges-leipzig.de/" >Forums Nachhaltiges Leipzig</a>.
</p>

<p>Auf dieser Webpräsenz werden eine Reihe prototypischer Anwendungen gezeigt,
die auf der Basis dieser öffentlichen Schnittstelle erstellt wurden.  Es geht
dabei nicht um Schönheit, sondern darum, die prinzipiellen Möglichkeiten einer
solchen Schnittstelle zu demonstrieren.  Der Quellcode der Anwendungen ist im
<a href="https://github.com/LeipzigData/web">github Repo</a> des Leipzig Data
Projekts zu finden.  </p>

</div> </div>

';
echo showPage($content);

?>
