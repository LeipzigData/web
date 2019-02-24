<?php
/**
 * User: Hans-Gert Gräbe
 * Date: 2019-02-24
 * Last Update: 2019-02-24
 */

include_once("Zukunftsdiplom.php");

if (isset($_GET['teilnehmer'])) {
    echo derTeilnehmer();
} else if (isset($_GET['veranstaltungen'])) {
    echo dieVeranstaltungen();
} else if (isset($_GET['ranking'])) {
    echo dasRanking();
} else echo "Fehler 404";


