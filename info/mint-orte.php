<?php
/**
 * User: Hans-Gert Gräbe
 * Date: 2015-07-26
 */

include_once("layout.php");
include_once("php/MINT.php");

$content='      
<div class="container">
<h2 align="center">Leipziger MINT-Orte</h2>

<div class="row">
Die folgende Übersicht über Leipziger MINT-Orte ist aus der 
<a href="http://leipzig-data.de/Data/MINTBroschuere2014/" >Leipzig Data MINT
Übersicht</a> generiert.  
</div>

'.mintorte().'

</div>
';
echo showPage($content);

?>
