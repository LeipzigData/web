<?php
/**
 * User: Hans-Gert Gräbe
 * Date: 2018-06-30
 */

include_once("layout.php");
include_once("php/Zukunftsdiplom.php");

$content='      
<div class="container"> 

<h2 align="center">Leipziger Zukunftsdiplom im Sommer 2018</h2>

<div class="row"> Siehe 
<ul>
<li> <a href="https://www.zukunftsakademie-leipzig.de/ziele/zukunftsdiplom/">die Webseiten des Veranstalters</a></li>
<li> <a href="http://pcai042.informatik.uni-leipzig.de/~zd18/zd-web/">den Pitch einer alternativen Webpräsenz auf RDF-Basis</a></li>
<li> eine <a href="http://leipzig-netz.de/index.php5/ZAK.Zukunftsdiplom">Darstellung der Hintergründe</a> auf den Seiten des Leizig-Wikis</li>
</ul>
</div>

</div>
';
echo showPage($content);

?>
