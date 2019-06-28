<?php
/**
 * User: Hans-Gert Gräbe
 * Date: 2018-06-07
 * Last Update: 2019-05-31
 */

include_once("Zukunftsdiplom.php");

$action=$_GET["action"];

if ($action=="archiv") { echo dasArchiv($archiv=true); }
if ($action=="meier") { echo "Das ist ein Parameter zum Testen der Verbindung\n"; }
else { echo dieVeranstaltungen(); }

?>
