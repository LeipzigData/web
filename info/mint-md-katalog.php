<?php
/**
 * User: Hans-Gert Gräbe
 * Date: 2015-07-26
 */

include_once("layout.php");
include_once("php/MINT-Katalog.php");

$content='      
<div class="container">
<h2 align="center">Sammlung bundesweiter MINT-Kataloge von MINT Mitteldeutschland</h2>

<div class="row"> Im Zuge der Erfassung regionaler MINT-Angebote durch die
Initiativgruppe "MINT Mitteldeutschland" wurde 2018 ein Überblick über
bundesweit existierende Links in diesem Bereich in einer Excel-Tabelle
zusammengetragen, die hier in einen <a
href="https://www.w3.org/TR/vocab-dcat/">DCAT-Katalog</a> verwandelt und öffentlich
zugänglich gemacht ist.  </div>

'.katalog("rdf/MINT-Katalog-MINT-MD.rdf").'

</div>
';
echo showPage($content);

?>
