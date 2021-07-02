<?php
/**
 * User: Hans-Gert Gräbe
 * Last Update: 2020-07-20
 */

include_once("layout.php");
include_once("Zukunftsdiplom.php");

$startDate=date("Y-m-d",strtotime("19.07.2020"));
$endDate=date("Y-m-d",strtotime("01.11.2020"));
$thema=$_GET["thema"];
$out='';
if ($thema) {
    $out=dieVeranstaltungen($startDate,$endDate,$thema);
} else {
    $out=Angebotsuebersicht($startDate,$endDate);
}
$content='
<div class="container">
<h2 align="center">Die Angebote im Zukunftsdiplom 2020</h2>
Vergange Verantaltung finden Sie <a href="archiv.php">hier</a>.
'.$out.'</div>';
echo showPage($content);

?>
