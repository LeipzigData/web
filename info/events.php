<?php
/**
 * User: Hans-Gert Gräbe
 * Date: 2015-07-26
 */

include_once("layout.php");
include_once("php/Events.php");

$content='      
<div class="container">
<h2 align="center">Übersicht über Events im Leipzig Data Event Channel</h2>

<div class="row">
Die folgende Übersicht über Events ist aus
dem <a href="http://leipzig.data.de/events/" >Leipzig Data Event
Channel</a> generiert.  Events werden einen Monat nach Ablauf aus dem "Event
Channel" in den "Alte Event Channel" übertragen.
</div>

'.events().'
</div>
';
echo showPage($content);

?>
