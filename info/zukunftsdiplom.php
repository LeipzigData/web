<?php
/**
 * User: Hans-Gert Gräbe
 * Date: 2018-03-19
 */

include_once("layout.php");
include_once("php/Zukunftsdiplom.php");

$content='      
<div class="container"> 

<h2 align="center">Aktueller Stand zum Angebotsaufbau für das Leipziger
Zukunftsdiplom im Sommer 2018</h2>

<div class="row"> Die folgende Übersicht enthält die bisher eingegangenen
Meldungen von Modulangeboten für das Leipziger Zukunftsdiplom, das in den
Sommerferien 2018 in enger Abstimmung mit dem Ferienpassprogramm der Stadt
Leipzig erstmals vergeben wird. </div>

'.pass().'
</div>
';
echo showPage($content);

?>
