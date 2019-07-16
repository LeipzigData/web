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
Kategoien der jeweiligen Angebote in der NL inferiert werden.  Die
entsprechende thematische Zuordnung ist derzeit fest in der Funktion
`getThemes($a)` in der Datei `Zukunftsdiplom.php` über einfaches
String-Matching eingebrannt.

## Lokales Testen

Damit es lokal ausgeführt werden kann, müssen die Dump-Dateien mit
`php createDump.php` erzeugt werden.

Um den Apache-Server lokal ausführen zu können, kann ein Docker Container
mit `sudo docker-compose up` gestartet werden. Dadurch startet ein
Apache-Server auf localhost:80. Bearbeitete PHP-Dateien werden automatisch
nachgeladen, wodurch ein Neustart nicht nötig ist.
