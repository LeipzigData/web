<?php
/**
 * User: Hans-Gert Gräbe
 * Date: 2015-07-26
 */

include_once("layout.php");

$content='      
<div class="container">
<div class="row">
<div  class="col-lg-2 col-sm-1"></div><div  class="col-lg-8 col-sm-10">

<p>Hier wird demonstriert, welche Art von Webseiten sich aus den im Rahmen des
Leipzig Data Projekts zusammengetragenen RDF-Quellen mit kleinen PHP-Skripten
erstellen lassen.  Die Site dient wissenschaftlichen Zwecken im Sinne von § 27
BDSG (neu). </p>

<p>Die Beispiele nutzen das <a href="http://getbootstrap.com" >Bootstrap
Framework</a> sowie die <a href="http://www.easyrdf.org/" >EasyRdf PHP
Bibliothek</a>.  Der Code ist in unserem git-Repo <a
href="https://github.com/LeipzigData/web"
>https://github.com/LeipzigData/web</a> verfügbar. </p> 
</div>

<div class="col-lg-2 col-sm-1"> </div> </div>

';
echo showPage($content);

?>
