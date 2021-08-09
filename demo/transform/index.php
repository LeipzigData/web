<?php
/**
 * User: Hans-Gert Gräbe
 * LastUpdate: 2020-03-27
 */

include_once("layout.php");

$content='
<div class="container">

<p> Mit dieser kleinen Anwendung wird gezeigt, wie sich Informationen zu
BNE-Akteuren und -Aktivitäten aus verschiedenen Quellen mit einer
entsprechenden öffentlich auslesbaren API vereinheitlichen lassen.  </p>

<p> Der Transformationsprozess selbst ist im Verzeichnis <em>Transform</em>
des LeipzigData-Projekt <a href="https://github.com/LeipzigData/Tools"
>LeipzigData/Tools</a> genauer beschrieben und wird mit den dortigen
Werkzeugen ausgeführt. Als Zwischenformat werden verschiedene RDF-Quellen
erzeugt, die hier im Verzeichnis <em>rdf</em> abgelegt sind und aus denen sich
diese prototypische Demo speist, mit der gezeigt wird, wie sich Informationen
(hier zu BNE-Akteuren und -Aktivitäten) aus verschiedenen Quellen mit einer
entsprechenden öffentlich auslesbaren API vereinheitlichen lassen.  </p>

<p> Dies kann nur ein Anfang sein, da die verschiedenen Datenmodelle der
einzelnen Plattformen nur bedingt eine Vereinheitlichung zulassen.  Diese
prototypische Implementierung soll deshalb auch dazu anregen, hier durch
entsprechende Absprachen zu einer größeren Einheitlichkeit zu kommen und damit
die Austauschbarkeit und Nachnutzung der Informationen und damit letztlich
auch die Sichtbarkeit der einzelnen Plattformen zu erhöhen.  </p>

</div> 
';

echo showPage($content);
