<?php 

require_once("header.php");
require_once("footer.php");

$content='
<h2 align="center">Das Projekt „Interaktiver Haushaltsplanrechner Leipzig 2015“</h2>

<h3>Einordnung des Projekts</h3>

<p>Das Projekt <strong>„Interaktiver Haushaltsplanrechner Leipzig 2015“</strong> ist ein wesentlicher Baustein des in enger Zusammenarbeit der Koordinierungsstelle für Bürgerbeteiligung der Stadt Leipzig („Leipzig weiter denken“), des Dezernats Finanzen der Stadt Leipzig und des Instituts für Öffentliche Finanzen und Public Management entwickelten Vorhabens <strong>„Nachhaltige Stadtfinanzen &ndash; Akzeptanzsteigerung der bürgerschaftlichen Beteiligung an der Haushaltsplanung“</strong>. Dieses Vorhaben wurde im Rahmen der Initiative „ZukunftsWerkStadt” im Zeitraum von Oktober 2014 bis August 2015 vom Bundesministerium für Bildung und Forschung (BMBF) durch Fördermittel unterstützt.</p>

<p>Als Teil der Strategie „Leipzig weiter denken 2.0“ war das Ziel des Vorhabens, die deliberativen Diskussions- und Beteiligungsstrukturen im Haushaltsplanungsprozess der Stadt Leipzig weiter zu stärken. Neben der im Rahmen von „Leipzig weiter denken“ bereits entwickelten repräsentativen Bürgerwerkstatt, sollte deshalb eine noch intensivere bürgerschaftliche Einbindung ermöglicht werden. Für die Haushaltsentwurfsplanung bedeutet dies, das Handeln der Stadt noch transparenter zu gestalten und die Bürgerinnen und Bürger aktiver in Entscheidungsprozesse mit einzubeziehen. In diesem Zusammenhang wurde der von der Stadt Leipzig in den Jahren 2008 bis 2012 bereitgestellte, aber wenig genutzte „interaktive Haushaltsplan“ geprüft. Das Vorhaben wurde von der Koordinierungsstelle „Leipzig weiter denken“ beraten.</p>

<p>Aufbauend auf Ergebnissen aus Umfragen, Workshops und Good-Practiceanalysen wurde im Projektbaustein „Interaktiver Haushaltsplanrechner Leipzig 2015“ ein für Leipzig bedarfs- und zielgruppengerechtes Instrument erstellt. Anknüpfend an vorhandene Erfahrungen auch der Leipziger Agenda21 Gruppe bzw. des Forums Bürgerstadt Leipzig, deren Mitarbeiter die Entwicklung des „Interaktive Haushaltsplan“ unterstützt und begleitet haben, wurden Instrumente entwickelt, um haushaltsrelevante Informationen nutzergruppenfreundlich aufzubereiten und geeignete Partizipationsmöglichkeiten zu schaffen. </p>

<p>Projektpartner bei der Entwicklung seitens der Universität waren das Institut für Öffentliche Finanzen und Public Management (Prof. Lenk, Herr Redlich, Herr Glinka), das in der informationstechnischen Umsetzung durch das Institut für Informatik (Prof. Gräbe) bei der Anforderungsanalyse und der prototypischen technischen Realisierung eines neuen Online-Tools unterstützt wurde. Nachfolgend werden die Ergebnisse der studentischen Arbeit vorgestellt. Den Projektbericht des Gesamtprojektes finden Sie im <ahref="./dokumente.php">Bereich Dokumente</a>. </p>

<h3>Anforderungsanalyse</h3>

<p>Die Anforderungsanalyse führte ein interdisziplinär zusammengesetztes studentisches Team im Wintersemester 2015/16 als Projektarbeit im Rahmen des <a href="http://bis.informatik.uni-leipzig.de/de/Lehre/Graebe/Inter">Interdisziplinären Lehrprojekts „Gesellschaftliche Strukturen im digitalen Wandel“</a> am Institut für Informatik durch.</p>

<div id="team">
<p><strong>Im Team haben mitgearbeitet:</strong> Wolfgang Amann (Informatik), Sarah Cujé (Kommunikations- und Medienwissenschaften), Christian Hoffmann (Geografie), Tamara Winter (Kommunikations- und Medienwissenschaften), Kalle Willi Wollinger (Informatik)</p>
<p><strong>Betreuer:</strong> Prof. Dr. Hans-Gert Gr&auml;be,  <strong>Tutor:</strong> Marius Brunnert (Informatik), <strong>Partner:</strong> Philipp Glinka, Matthias Redlich</p>
</div>

<p>Das Projektteam befasste sich zun&auml;chst genauer mit Fragen kommunaler Stadthaushalte &ndash; Systematik, Handlungsspielr&auml;ume, Optionen, Beteiligungsm&ouml;glichkeiten &ndash; und studierte die Umsetzung der Haushaltsplanrechner verschiedener Kommunen sowie den Bundeshaushaltsrechner. Auf dieser Basis wurde eine <a href="Material/Anforderungsanalyse.pdf">Anforderungsanalyse</a> sowie ein <a href="Material/Partizipationskonzept.pdf">Partizipationskonzept</a> f&uuml;r den in der zweiten Projektphase zu erstellenden Prototyp eines Interaktiven Haushaltsplanrechners entwickelt.</p>

<h3>Der neue Interaktive Haushaltsplanrechner entsteht</h3>

<p>Im Sommersemester 2015 entwickelte ein zweites studentisches Team im Rahmen des <a href="http://bis.informatik.uni-leipzig.de/de/Lehre/BAMA/SWP">Softwaretechnik-Praktikums</a> im Studiengang Bachelor Informatik auf dieser Basis die prototypische Version eines neuen Interaktiven Haushaltsplanrechners. Dabei wurden konsequent RDF-basierte <a href="https://de.wikipedia.org/wiki/Open_Data">Open Data Konzepte</a> umgesetzt, womit sich die Neuentwicklung nahtlos auch in die sich entwickelnde Landschaft des „Web 2.0“ integrieren l&auml;sst. Der Prototyp wurde auf der Basis des verbreiteten Open Source CMS <a href="https://www.drupal.org/">Drupal</a> entwickelt, womit auch die Voraussetzungen f&uuml;r eine nachhaltige Weiterentwicklung des Prototyps gegeben sind. Die Softwarequellen und Daten sind als Open Data verf&uuml;gbar. </p>

<div id="team">
<p><strong>Im Team haben mitgearbeitet:</strong> Wolfgang Amann, Janos Borst, Dennis Kreußel, Fabian Niehoff, Tobias Wieprich, Sebastian Zänker</p>
<p><strong>Betreuer:</strong> Prof. Dr. Hans-Gert Gr&auml;be, Herr H&ouml;ffner, <strong>Tutor:</strong> Marius Brunnert, <strong>Partner:</strong> Philipp Glinka, Matthias Redlich</p>
</div>

<h3>Der neue Interaktive Haushaltsplanrechner wird erprobt</h3>

<p>Nach Abschluss des Softwaretechnik-Praktikums im Mai 2015 arbeitete ein Teil des Teams bis zum Projektende im August 2015 weiter im Projekt mit, um den neuen Interaktiven Haushaltsplanrechner im Probebetrieb im Rahmen eines Workshops sowie eines Alphatests interessierten B&uuml;rgerinnen und B&uuml;rgern sowie Vertretern der Stadtverwaltung vorzustellen, dabei weitere Anregungen aufzunehmen, zu priorisieren und nach M&ouml;glichkeit umzusetzen. Nacharbeiten wurden im September 2015 ausgef&uuml;rt und das Ergebnis als Releaseb&uuml;ndel Anfang Oktober an die Stadt Leipzig &uuml;bergeben.</p>

<div id="team">
<p><strong>Im studentischen Team haben mitgearbeitet:</strong> Wolfgang Amann, Marius Brunnert, Fabian Niehoff, Tobias Wieprich, Sebastian Zänker</p>
<p><strong>Betreuer:</strong> Prof. Dr. Hans-Gert Gr&auml;be, <strong>Partner:</strong> Philipp Glinka, Matthias Redlich</p>
</div>


 ';

echo myHeader().($content).myFooter();
