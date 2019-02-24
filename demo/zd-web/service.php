<?php
/**
 * User: Hans-Gert Gräbe
 * Date: 2019-02-24
 * Last Update: 2019-02-24
 */

include_once("Zukunftsdiplom.php");

if (isset($_GET['teilnehmer'])) {
    return derTeilnehmer();
} else if (isset($_GET['veranstaltungen'])) {
    return dieVeranstaltungen();
} else if (isset($_GET['ranking'])) {
    return dasRanking();
} else return "Fehler 404";


