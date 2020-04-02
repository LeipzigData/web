<?php
/**
 * User: Hans-Gert Gräbe
 * Date: 2020-04-01, Kopie von zd-web/index.php
 * Last Update: 2020-04-02
 */

include_once("layout.php");

$content='      
<div class="container">
<div class="row">
<div  class="col-lg-3 col-sm-1"></div><div  class="col-lg-6 col-sm-10">

<p>Die <a href="https://leipziger-ecken.de">Leipziger Ecken</a> ist eine
Stadtteilplattform, deren Daten ebenfalls über eine API ausgelesen werden
können. </p>

<p>Auf dieser Webpräsenz werden eine Reihe prototypischer Anwendungen gezeigt,
die auf der Basis diser öffentlichen Schnittstelle erstellt wurden.  Es geht
dabei nicht um Schönheit, sondern darum, die prinzipiellen Möglichkeiten einer
solchen Schnittstelle zu demonstrieren.  Der Quellcode der Anwendungen ist im
<a href="https://github.com/LeipzigData/web">github Repo</a> des Leipzig Data
Projekts zu finden.  </p>

</div> </div>

';
echo showPage($content);

?>
