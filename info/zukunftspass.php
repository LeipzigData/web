<?php
/**
 * User: Hans-Gert Gräbe
 * Date: 2015-07-26
 */

include_once("layout.php");
include_once("php/Zukunftspass.php");

$content='      
<div class="container">
<h2 align="center">Übersicht über Events im Ferienpass Sommer 2017, die für einen Zukunftspass in Frage kämen</h2>

<div class="row"> Die folgende Übersicht über Events ist von Prof. Hans-Gert
Gräbe aus Ferienpassdaten der Sommerferien 2017 erstellt worden.  </div>

'.pass().'
</div>
';
echo showPage($content);

?>
