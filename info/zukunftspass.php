<?php
/**
 * User: Hans-Gert Gräbe
 * Date: 2018-03-19
 */

include_once("layout.php");
include_once("php/Zukunftspass.php");

$content='      
<div class="container">
<h2 align="center">Erste Absprachen zum Zukunftspass</h2>

<div class="row"> Die folgende Übersicht enthält Partner, die bisher
Veranstaltungen für das Projekt "Zukunftsdiplom" im Rahmen des Leipziger
Ferienpassprogramms im Sommer 2018 gemeldet haben. </div>

'.pass().'
</div>
';
echo showPage($content);

?>
