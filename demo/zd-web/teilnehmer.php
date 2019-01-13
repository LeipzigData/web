<?php
/**
 * User: Hans-Gert Gräbe
 * Date: 2018-06-30
 * Last Update: 2019-01-13
 */

include_once("layout.php");
include_once("Zukunftsdiplom.php");

$content='      
<div class="container">
<h2 align="center">Management der Teilnehmer/innen</h2>

<div class="row"> 

<p>Die Erfassung der Teilnehmer/innen erfolgt über Erfassungsbögen durch die
Anbieter der einzelnen Veranstaltungen.  Zur Vorbereitung der Ausgabe der
Zukunftsdiplome zur Abschlussveranstaltung und zur Einladung zu dieser
Veranstaltung ist außerdem eine <a
href="https://post.civinews.de/civicrm/event/register?id=39">digitale
Registrierung als Teilnehmer/in</a> erforderlich. </p>

<p>Wir versuchen auf dieser Seite in enger Abstimmung mit den Veranstaltern,
die Teilnahmemeldungen öffentlich darzustellen. Um dabei datenschutzrechtliche
Belange umzusetzen sind diese Informationen anonymisiert dargestellt.  Dazu
bekommt jeder (registrierte) Teilnehmer
<ul>

<li> eine mehrstellige Teilnehmernummer.  Diese Teilnehmernummer ist
vergleichbar zur Matrikelnummer von Studierenden und wird in der öffentlichen
Referenzierung der Ergebnisse verwendet. </li>

<li> eine deutlich längere Teilnehmer-ID, die nur der Teilnehmerin selbst
bekannt ist, mit deren Hilfe die über die jeweilige Person gespeicherten Daten
eingesehen werden können.  Ein entsprechender Link wird (ggf. zeitversetzt) an
die bei der Registrierung angegebene Mail-Adresse verschickt. </li>
</ul>
</div>

'.derTeilnehmer().'

</div>
';
echo showPage($content);

?>
