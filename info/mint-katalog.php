<?php
/**
 * User: Hans-Gert Gräbe
 * Date: 2015-07-26
 */

include_once("layout.php");
include_once("php/MINT-Katalog.php");

$content='      
<div class="container">
<h2 align="center">Katalog bundesweiter MINT-Kataloge mit Einträgen aus dem mitteldeutschen Raum</h2>

<div class="row"> Im Zuge der Erfassung regionaler MINT-Angebote durch die
Initiativgruppe "MINT Mitteldeutschland" versuchen wir, uns einen Überblick
über die bundesweit existierenden Datensammlungen und -friedhöfe in diesem
Bereich zu verschaffen.  Die <a
href="http://leipzig-data.de/RDFData/MINT-Katalog.ttl">Daten</a> sind auch als
<a href="https://www.w3.org/TR/vocab-dcat/">DCAT-Katalog</a> öffentlich
zugänglich und können über unseren <a
href="http://leipzig-data.de:8890/sparql">SPARQL-Endpunkt</a> detaillierter
abgefragt werden.  </div>

'.katalog("rdf/MINT-Katalog.rdf").'

</div>
';
echo showPage($content);

?>
