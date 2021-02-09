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

Die folgende erste sehr experimentelle Übersicht über sächsische Schulen ist
aus der <a href="https://schuldatenbank.sachsen.de/">Sächsischen
Schuldatenbank</a> über deren <a href=
"https://schuldatenbank.sachsen.de/docs/api.html">API</a> generiert.  </div>

'.getSchools().'
</div>
';
echo showPage($content);

?>
