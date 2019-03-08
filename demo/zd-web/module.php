<?php
/**
 * User: Hans-Gert Gräbe
 * Date: 2018-06-07
 * Last Update: 2019-01-13
 */

include_once("layout.php");
include_once("Zukunftsdiplom.php");

$content='      
<div class="container">
<h2 align="center">Die Themenbereiche</h2>

'.dieModule().'

<h2 align="center">Angebote nach Themenbereichen sortiert</h2>

'.dieVeranstaltungen().'
</div>
';
echo showPage($content);

?>
