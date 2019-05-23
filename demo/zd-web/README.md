# Code für das Teilnehmer-Management des Leipziger Zukunftsdiploms

## Grundsätzliches

Die neue Applikation greift auf die REST API der Nachhaltigkeitsdatenbank (NL)
zu, um von dort die relevanten Veranstaltungen (entsprechend ausgezeichnete
Events und Bildungsangebote) zu extrahieren.  Diese werden mit createDump.php
über einen cron-Job in Dumps/Zukunftsdiplom.json im json-Format gespeichert.

Daten über Teilnehmer werden nicht mehr im System gespeichert, da die
Teilnahme nun im Zukunftspass des jeweiligen Teilnehmers bestätigt wird, der
zum Ende der jeweiligen Runde des Zukunftsdiploms einzuschicken ist, um das
Zukunftsdiplom zu erhalten, wenn die Kriterien erfüllt sind.

Veranstaltungen sind fest vorgegebenen Modulen zuzuordnen. Das wird aktuell
ebenfalls in Zukunftsdiplom.ttl abgebildet, da entsprechende Strukturen in der
Nachhaltigkeitsdatenbank noch fehlen.
