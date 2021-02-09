<?php
/**
 * User: Hans-Gert Gräbe
 * Date: 2021-02-09
 */

include_once("layout.php");
include_once("php/Schools.php");

$content='      
<div class="container">
<h2 align="center">Sächsische Schulen</h2>

<div class="row">

<p>Die folgende erste sehr experimentelle Übersicht über sächsische Schulen ist
aus der <a href="https://schuldatenbank.sachsen.de/">Sächsischen
Schuldatenbank</a> über deren <a href=
"https://schuldatenbank.sachsen.de/docs/api.html">API</a> generiert.</p>

<p> Die Daten sind in einer <a href="rdf/schools.json">lokalen json-Datei</a>
gespeichert, aus der die folgende Übersicht generiert wird.  Der in einem
Array "building" gespeicherte Teil wurde noch nicht weiter analysiert.</p> 

<p>
'.getSchools().'
</p></div></div>
';
echo showPage($content);

?>
