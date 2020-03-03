<?php
/**
 * User: Hans-Gert Gräbe
 * Date: 2018-06-07
 * Last Update: 2020-03-03
 */

include_once("layout.php");
include_once("Zukunftsdiplom.php");

$startDate=date("Y-m-d",strtotime("01.04.2020"));
$endDate=date("Y-m-d",strtotime("31.08.2020"));
$content='
<div class="container">
<h2 align="center">Die vergangene Veranstaltungen des Monats</h2>
Aktuelle Verantaltung finden Sie <a href="angebote.php">hier</a>.
'.dasArchiv($startDate,$endDate).'
</div>
';
echo showPage($content);

?>
