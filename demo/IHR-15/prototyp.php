<?php 

require_once("header.php");
require_once("footer.php");

$content='
<h2 align="center">Prototyp</h2>

<!-- http://www.leipzig-data.de/drupal/ -->

<p>Der Drupal basierte Prototyp wird derzeit nicht präsentiert, da der Aufwand
der (aus Sicherheitsgründen erforderlichen) Anpassung an neue Versionen der
Drupal-Basiskonfiguration mit Blick auf das fehlende Interesse an der Lösung
nicht geleistet werden kann.</p>  

<p>Da die Quellen öffentlich verfügbar sind, können Interessenten den Prototyp
lokal aufsetzen und ausprobieren.  Die dazu erforderlichen Daten werden weiter
in unserem RDF Store bereitgestellt. </p>

<div style="text-align:center; margin-top:5em"><img src="http://www.leipzig-data.de/Upload/images/IHR-15.png" alt="Eingangsbild des Haushaltsrechners"/></div>

 ';

echo myHeader().($content).myFooter();
