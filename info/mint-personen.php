<?php
/**
 * User: Hans-Gert Gräbe
 * Date: 2015-07-26
 */

include_once("layout.php");
include_once("php/MINT.php");

$content='      
<div class="container">
<h2 align="center">Leipziger MINT-Netzwerk. Ausgewählte Personen</h2>

<div class="row"> Die folgende <strong>noch sehr experimentelle</strong>
Übersicht über ausgewählte Personen aus dem Leipziger MINT-Netzwerk ist aus
verschiedenen Quellen extrahiert.  </div>

'.mintpersonen().'

</div>
';
echo showPage($content);

?>
