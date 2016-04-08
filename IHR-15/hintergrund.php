<?php 

require_once("header.php");
require_once("footer.php");

$content='
   <h2 align="center">Hintergrundinformationen zum Projekt</h2> 

   <h3>Was ist ein Haushaltsplanrechner?</h3> 

<p>Mit dem Begriff <em>Haushaltsplanrechner</em> bezeichnen wir eine öffentlich zugängliche Internetseite, welche den Haushalt der Stadt übersichtlich präsentiert und somit für mehr Transparenz sorgen soll. Der Haushaltsplan der Stadt liegt ansonsten in einem großen Dokument mit mehreren hundert Seiten vor, in dem Einnahmen und Ausgaben nur schwer verständlich und unübersichtlich aufgeführt sind. Dadurch besteht eine große Hürde für die meisten interessierten Menschen, sich mit dieser Thematik zu befassen. Ein Haushaltsplanrechner hat das Ziel, diese Hürde zu überwinden und allen Bürgerinnen und B&uuml;rgern zu ermöglichen, den Haushalt ihrer Stadt nachvollziehen zu können.</p>

<p> Ein <em>Interaktiver Haushaltsplanrechner</em> geht über dieses Ziel noch hinaus. Hier steht neben der Transparenz die Teilhabe im Mittelpunkt. Dabei geht es einerseits darum, Inhalte nach eigenen Bedürfnissen „interaktiv“ abrufen zu können und andererseits um die Möglichkeit, selbst „interaktiv“ in Entscheidungsprozesse einbezogen zu werden. Beim Entwurf eines neuen Haushaltsplans gibt es sehr viele Dinge zu beachten und viele Bürgerinnen und Bürger haben genauso unterschiedliche Ideen oder Präferenzen – und ihr Recht, diese in Form von Einwänden einzubringen, ist gesetzlich vorgegeben. Darüber hinaus gibt es aber viele weitere Möglichkeiten, aktiv in Entscheidungsprozesse der Haushaltsplanaufstellung einbezogen zu werden, wie exemplarisch Vorschlags-, Kommentierungs- und Bewertungsoptionen, die im Zuge eines interaktiven Haushaltsplanrechners genutzt werden könnten. </p>  

   <h3>Zum Projektauftrag</h3> 
<p>Seit 2007 bestand f&uuml;r Leipziger B&uuml;rgerinnen und B&uuml;rger die M&ouml;glichkeit, sich &uuml;ber einen Interaktiven Haushaltsplan direkt in die Debatte zur Haushaltsplanung einzubringen. Letztmalig, bereits in <a href="http://www.haushaltsplanrechner-leipzig.de/" target="_blank" title="externer Verweis (in neuem Fenster)" class="outerlink">&uuml;berarbeiteter Form</a>, stand diese M&ouml;glichkeit im Jahr 2012 f&uuml;r den Haushalt 2013 offen. Mit der Umstellung auf das doppische Buchungsverfahren wurde eine Überarbeitung des vorhandenen Interaktiven Haushaltsplans erforderlich. Mit Blick auf die geringe Resonanz und die entstehenden Kosten wurde diese Beteiligungsoption deshalb mit dem Haushalt 2014 eingestellt. Auf den Seiten des Forum Bürgerstadt Leipzig finden sich noch Bürgergutachten und Dokumentation zum Haushaltsplan.</p>

<p>Im Rahmen eines vom Bundesministerium für Bildung und Forschung (BMBF) geförderten Vorhabens „Nachhaltige Stadtfinanzen &ndash; Akzeptanzsteigerung der bürgerschaftlichen Beteiligung an der Haushaltsplanung“ analysierte das Institut für Öffentliche Finanzen und Public Management an der Universität Leipzig auch den bisherigen Interaktiven Haushaltsplan. Dabei wurde eruiert, inwiefern Information und Teilhabe effektiv und effizient erfolgen können. Die prototypische informationstechnische Umsetzung dieser Vorgaben hat das Institut für Informatik (Prof. Gräbe) übernommen. Im Rahmen der Bachelorausbildung im Fach Informatik bzw. im Wahlbereich Bachelor GSW wurde dazu von zwei studentischen Teams im Studienjahr 2014/15 eine entsprechende Webanwendung konzipiert und umgesetzt. </p>

<p>Mit diesem Projekt soll erreicht werden, den Bürgerinnen und Bürgern noch einfachere Möglichkeiten an die Hand zu geben, sich in die Haushaltsdebatten einzubringen. Dafür sind ein besserer Zugang zu Haushaltsinformationen und deren Transparenz entscheidend. Es muss klar sein, welche Mittel vorhanden sind und wie dieses verwendet werden sowie welche Mittel „frei“ verfügbar sind und wofür diese verplant werden können. Nur so können fundiert eigene Vorschläge eingebracht werden.</p>
';

echo myHeader().($content).myFooter();
