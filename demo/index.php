<?php
/**
 * User: Hans-Gert Gräbe
 * Date: 2018-10-14
 */

include_once("layout.php");

$content='      
<div class="container">
<div class="row">
<div  class="col-lg-1 col-sm-1"></div><div  class="col-lg-10 col-sm-10">

<p>In diesem Bereich sind Präsentationen zusammengetragen, die in verschiedenen
studentischen Arbeiten im Rahmen des Leipzig Data Projekts entstanden sind.
Die Präsentationen dienen als Referenz, da die hier zusammengetragenen Projekte
in der Mehrzahl längst abgeschlossen sind.  </p>

<p>Die Beispiele nutzen das <a href="http://getbootstrap.com" >Bootstrap
Framework</a>.  Umfassendere Informationen sowie Quellen zu den einzelnen
Projekten sind in unseren git-Repo <a href="https://github.com/LeipzigData"
>https://github.com/LeipzigData</a> zu finden. </p> </div>

<div class="col-lg-1 col-sm-1"> </div> </div>

';
echo showPage($content);

?>
