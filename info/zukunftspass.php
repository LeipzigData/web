<?php
/**
 * User: Hans-Gert Gräbe
 * Date: 2015-07-26
 */

include_once("layout.php");
include_once("php/Zukunftspass.php");

$content='      
<div class="container">
<h2 align="center">Erste Absprachen zum Zukunftspass</h2>

<div class="row"> Die folgende Übersicht enthält Partner, die sich entweder
während der Projektbörse 2017 zur Mitarbeit im Projekt "Zukunftsdiplom" bereit
erklärt hatten oder auf den Aufruf der Zukunftsakademie Anfang 2018 reagiert
haben. </div>

'.pass().'
</div>
';
echo showPage($content);

?>
