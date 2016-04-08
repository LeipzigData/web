<?php 

require_once("header.php");
require_once("footer.php");

$content='
<h2 align="center">Projektverlauf</h2>

<h3>Voraussetzungen</h3> 
<p>Die Haushaltsplanaufstellung ist einer der wichtigsten Planungs- und Entscheidungsprozesse in einer Kommune. Mit dieser wird die finanzielle Situation aufgezeigt und über die Bereitstellung finanzieller Mittel in den einzelnen kommunalen Tätigkeitsfeldern entschieden. Kommunale Haushaltsplanung ist dabei keine leichte, sondern eine eher komplizierte Materie, in der Pflichtaufgaben und freiwillige Aufgaben der Kommune mit verschieden ausgeprägten Gestaltungsmöglichkeiten zusammentreffen. Diese Abwägungsprozesse bilden die maßgebliche Grundlage für eine nachhaltige Stadtentwicklung. Information und Einbeziehung der Bürgerinnen und Bürger sind aber deshalb gerade hier besonders wichtig. Die  <a href="http://www.leipzig.de/buergerservice-und-verwaltung/stadtverwaltung/haushalt-und-finanzen/">Leipziger Haushaltspl&auml;ne</a> der letzten Jahre sind als je gut 1000-seitige pdf-Dokumente (in vier Bänden) im Internet zu finden, entsprechende Daten für 2014 lagen den beiden Projektteams von Anfang an im CSV-Format vor. </p>

<h3>Anforderungsanalyse</h3> 
<p>Im ersten Teilprojekt (Oktober 2014 &ndash; Januar 2015) untersuchte ein interdisziplin&auml;r zusammengesetztes studentisches Team, welche Gestaltungsm&ouml;glichkeiten in der Haushaltsplanung bestehen, wie andere Kommunen an die Thematik herangehen und welche interessanten  Webl&ouml;sungen existieren. Dazu wurden sowohl der alte Leipziger als auch der Hamburger Haushaltsrechner und der Haushaltsplanrechner des Bundes sowie die Plattform <a href="http://offenerhaushalt.de">offenerHaushalt.de</a> der Open Knowledge Foundation Deutschland e.V. genauer analysiert. Vor dem Hintergrund der weiteren Untersuchungen im Gesamtvorhaben wurden die Ergebnisse mit den projektverantwortlichen Mitarbeitern des Institut für Öffentliche Finanzen und Public Management (Herr Redlich, Herr Glinka) und des Institut für Informatik (Prof. Gräbe) diskutiert. Bedeutsam war in diesem Kontext insbesondere die Analyse der <a href="https://openspending.org/">OpenSpending Plattform</a>, in der nach dem OpenData-Prinzip weltweit Finanzdaten öffentlicher Haushalte zusammengetragen werden. Das <a href="http://linkedspending.aksw.org/">Projekt "Linked Spending"</a> der <a href="http://aksw.org">AKSW-Gruppe</a>, einer im Bereich semantischer Technologien weltweit führenden Forschungsgruppe am Institut für Informatik, verbindet diesen Ansatz mit RDF-Technologien auf der Basis des RDF Data Cube Konzepts. Diese Konzepte kamen bereits vorher in einer weiteren Projektgruppe "Linked Spending" im <a href="http://pcai042.informatik.uni-leipzig.de/swp/SWP-14/index.html">SWT-Praktikum 2014</a> zum Einsatz.</p>

<p>In der zweiten Phase des ersten Teilprojekts wurden diese Informationen in einem <a href="./Material/Evaluationsbericht.pdf">Evaluationsbericht</a> zusammengetragen sowie zu einer <a href="Material/Anforderungsanalyse.pdf">Anforderungsanalyse</a> und einem <a href="Material/Partizipationskonzept.pdf">Partizipationskonzept</a> f&uuml;r den neu zu gestaltenden Leipziger Haushaltsplanrechner verdichtet, ein genaueres Datenmodell auf der Basis des <a href="www.w3.org/TR/vocab-data-cube/">RDF Data Cube</a> entwickelt und die vorliegenden Haushaltsdaten f&uuml;r 2014 in dieses Format transformiert.</p>

<h3>Grundlegende Umsetzung eines prototypischen neuen Online-Tools</h3> 
<p>Im zweiten Teilprojekt (Januar &ndash; Mai 2015) wurde im Rahmen einer Projektgruppenarbeit im Softwaretechnik-Praktikum am Institut f&uuml;r Informatik, einem Pflichtbestandteil in der Ausbildung zum Bachelor Informatik, ein prototypisches Online-Tool zur B&uuml;rgerbeteiligung entwickelt. Das Team entschied sich mit <a href="https://www.drupal.org/">Drupal</a> f&uuml;r den Einsatz eines weit verbreiteten Open Source CMS, das einerseits um entsprechende semantische Konzepte f&uuml;r Management und Darstellung von RDF-basierten Daten und andererseits um angemessene Visualisierungskonzepte zu erweitern war.  Die technischen Voraussetzungen f&uuml;r das vom ersten Team entwickelte Partizipationskonzept wurden durch Einbindung und Anpassung eines Drupal-Forums geschaffen. </p>

<h3>Weitere Anpassung des neuen Online-Tools</h3> 

<p>Ein Teil des zweiten Projektteams arbeitete nach dem Abschluss des Praktikums an der weiteren Konsolidierung des Prototyps. Aufbauend auf den Ergebnissen der Good-Practiceanalysen und der Umfragen zur Einschätzungen und Bedürfnisse hinsichtlich einer partizipativen Haushaltsplanung in der Stadt Leipzig (Bürger- und Interessengruppen) sowie der Workshops (Interessengruppen und Alphatest) ergaben sich zusätzliche Anforderungen, die umzusetzen und zu integrieren waren.</p>

<p>Au&szlig;erdem wurde die Datenbasis auf den aktuellen Stadt-Haushalt 2015/16 aktualisiert. In der finalen Version des Haushaltsplanrechners wurden die Haushaltsdaten bis zur vierten Ebene der <em>Schl&uuml;sselprodukte</em> aggregiert dargestellt, zu denen auch <em>Produktsteckbriefe</em> vorliegen. Entsprechende Informationen wurden im Rahmen der Datenaufbereitung aus den vorliegenden detaillierteren Prim&auml;rdaten f&uuml;r die Planwerte der Jahre 2014 bis 2019 aggregiert. </p>

<p>Bis zum Projektende konnten allerdings eine Reihe von Unklarheiten und Inkonsistenzen in den uns zur Verf&uuml;gung gestellten Haushaltsdaten nicht ausger&auml;umt werden.  Das finale Release ist deshalb mit Daten ausgeliefert, die ausschlie&szlig;lich dazu dienen, das B&uuml;ndel der implementierten Funktionalit&auml;ten zu demonstrieren, aber keine belastbaren Informationen &uuml;ber die Haushaltssituation in der Stadt Leipzig liefern. </p>

 ';

echo myHeader().($content).myFooter();
