<?php
/**
 * User: Hans-Gert Gräbe
 * Date: 2015-07-26
 */

include_once("layout.php");
include_once("php/AlteEvents.php");

$content='      
<div class="container">
<h2 align="center">Übersicht über vergangene Events im Leipzig Data Event Channel</h2>

<div class="row">
Die folgende Übersicht über vergangene Events ist aus
dem <a href="http://leipzig.data.de/Data/AlteEvents/" >Leipzig Data Alte Event
Channel</a> generiert.  Events verbleiben ein Jahr nach Ablauf im Alte Event
Channel und werden danach gelöscht.
</div>

'.alteEvents().'
</div>
';
echo showPage($content);

?>
