<?php
/**
 * User: Hans-Gert Gräbe
 * Date: 2018-06-07
 * Last Update: 2020-07-16
 */

include_once("layout.php");
include_once("Zukunftsdiplom.php");

$startDate=date("Y-m-d",strtotime("19.07.2020"));
$endDate=date("Y-m-d",strtotime("01.11.2020"));
$content='
<div class="container">
<h2 align="center">Die Angebote</h2>
Vergange Verantaltung finden Sie <a href="archiv.php">hier</a>.
'.dieVeranstaltungen($startDate,$endDate).'
</div>
';
echo showPage($content);

?>
