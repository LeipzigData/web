<?php
/**
 * User: Hans-Gert Gräbe
 * Date: 2020-03-18
 * Last Update: 2020-03-18
 */

include_once("layout.php");
include_once("Zukunftsdiplom.php");

$startDate=date("Y-m-d",strtotime("01.03.2020"));
$endDate=date("Y-m-d",strtotime("31.05.2020"));
$content='
<div class="container">

<h2 align="center">Folgende Veranstaltungen fallen zwischen '
    .date("d. M Y",strtotime($startDate)).' und '
    .date("d. M Y",strtotime($endDate)).' aus</h2>

'.ausfall($startDate,$endDate).'
</div>
';
echo showPage($content);

?>
