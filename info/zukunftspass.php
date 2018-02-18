<?php
/**
 * User: Hans-Gert Gräbe
 * Date: 2015-07-26
 */

include_once("layout.php");
include_once("php/Zukunftspass.php");

$content='      
<div class="container">
<h2 align="center">Zukunftspass</h2>

<div class="row"> Die folgende Übersicht wurde aus Ferienpassdaten der
Sommerferien 2017 erstellt. </div>

'.pass().'
</div>
';
echo showPage($content);

?>
