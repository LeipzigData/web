# Code für die Webpräsenz des Leipziger Zukunftsdiploms

## Grundsätzliches

Die neue Applikation greift auf die REST API der Nachhaltigkeitsdatenbank (NL)
zu, um von dort die relevanten Veranstaltungen (entsprechend ausgezeichnete
Events und Bildungsangebote) zu extrahieren.  Diese werden mit
`createDump.php` über einen cron-Job in `Dumps/Zukunftsdiplom.json` sowie
`Dumps/Veranstalter.json` im json-Format gespeichert.

Daten über Teilnehmer werden nicht mehr im System gespeichert, da die
Teilnahme nun im Zukunftspass des jeweiligen Teilnehmers bestätigt wird, der
zum Ende der jeweiligen Runde des Zukunftsdiploms einzuschicken ist, um das
Zukunftsdiplom zu erhalten, wenn die Kriterien erfüllt sind.

Veranstaltungen sind fest vorgegebenen Themenbereichen zugeordnet, die aus den
Kategorien der jeweiligen Angebote in der NL inferiert werden.  Die
entsprechende thematische Zuordnung ist derzeit fest in der Funktion
`getThemes($a)` in der Datei `Zukunftsdiplom.php` über einfaches
String-Matching eingebrannt.

Die wichtigsten Codeteile aus dem Jahr 2018 sind im Verzeichnis `Code-2018` zu
finden.

Die Ausgabe greift auf drei lokale Dumps zu:

* `Veranstalter.json` - in den Event-Daten ist der Veranstalter nur durch
  seine Id angegeben, in diesem Dump sind die weiteren Informationen.
* `Categories.json` - der zugeordnete Modul wird aus der first_root_category
  extrahiert, zu der in den Event-Daten auch nur eine Id angegeben ist, die
  sich allerdings auf die Kategorien in der NL-Datenbank bezieht. Über diese
  Tabelle wird deren Name extrahiert, der in getThemes($c) dann einem unserer
  Modulthemen zugeordnet wird.
* Zukunftsdiplom.json - hier werden alle für das ZD relevanten Activities
  rausgefiltert (d.h. wenn die Goals das Wort "Zukunfts-Diplom" enthalten).
  Events (diese haben ein Datum) und andere Aktivitäten (diese haben kein
  Datum) werden verschieden aggregiert. Bei anderen Aktivitäten wird
  vorausgesetzt, dass es sich um Bildungsangebote handelt.  Das Erscheinen von
  Aktivitäten in der Auflistung kann also direkt durch Setzen oder Entfernen
  eines entsprechenden Goals in der NL-Datenbank gesteuert werden. 

Der Ausgabezeitraum kann in `angebote.php` und `archiv.php` durch die Änderung
der Start- und Enddaten modifiziert werden.


## Lokales Testen

Damit es lokal ausgeführt werden kann, müssen die Dump-Dateien mit
`php createDump.php` erzeugt werden.

Um den Apache-Server lokal ausführen zu können, kann ein Docker Container
mit `sudo docker-compose up` gestartet werden. Dadurch startet ein
Apache-Server auf localhost:80. Bearbeitete PHP-Dateien werden automatisch
nachgeladen, wodurch ein Neustart nicht nötig ist.


## Abhängigenkeiten

Diese Seite nutzt:
* php 5 oder höher
* bootstrap 3.5
* jQuery v1.11.1
