<?php
/**
 * User: Hans-Gert Gräbe
 * Date: 2018-06-07
 * Last Update: 2019-05-31
 */

include_once("layout.php");
include_once("Zukunftsdiplom.php");

$content='
<div class="container">
<h2 align="center">Die vergangene Veranstaltungen des Monats</h2>
Aktuelle Verantaltung finden Sie <a href="angebote.php">hier</a>.
'.dasArchiv().'
</div>
';
echo showPage($content);

?>
