<?php
/**
 * User: Hans-Gert Gräbe
 * Date: 2018-06-07
 * Last Update: 2019-04-01
 */

include_once("layout.php");
include_once("Zukunftsdiplom.php");

$content='      
<div class="container">
<h2 align="center">Die Themenbereiche</h2>

<p>Dies sind die Themenbereiche aus 2018, über den Zuschnitt der
Themenbereiche in 2019 ist noch nicht abschließend entschieden. </p>

'.dieModule().'
</div>
';
echo showPage($content);

?>
