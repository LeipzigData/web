<?php
/**
 * User: Hans-Gert Gräbe
 * Date: 2018-06-07
 * Last Update: 2019-05-31
 */

include_once("Zukunftsdiplom.php");

$action=$_GET["action"];
$startDate=date("Y-m-d",strtotime("01.04.2020"));
$endDate=date("Y-m-d",strtotime("31.08.2020"));
if ($action=="archiv") { echo dasArchiv(); }
else if ($action=="meier") {
    echo "Das ist ein Parameter zum Testen der Verbindung\n";
}
else { echo dieVeranstaltungen($startDate,$endDate); }

?>
