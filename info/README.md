# Demonstations-Site des Leipzig Data Projekts

In diesem Verzeichnis sind einige Demonstrationen zur Nutzung offener Daten
zusammengetragen.

## MINT-Personen in Leipzig

Eine noch sehr experimentelle Übersicht über ausgewählte Personen aus dem
Leipziger MINT-Netzwerk, die aus verschiedenen Quellen extrahiert wurde.
 
## MINT-Katalog

Im Zuge der Erfassung regionaler MINT-Angebote durch die Initiativgruppe "MINT
Mitteldeutschland" wird versucht, sich einen Überblick über die bundesweit
existierenden Datensammlungen und -friedhöfe in diesem Bereich zu verschaffen.
Die Daten sind auch als DCAT-Katalog öffentlich zugänglich und können über
unseren SPARQL-Endpunkt detaillierter abgefragt werden.
 
## MINT-MD-Katalog

Im Zuge der Erfassung regionaler MINT-Angebote durch die Initiativgruppe "MINT
Mitteldeutschland" wurde 2018 ein Überblick über bundesweit existierende Links
in diesem Bereich in einer Excel-Tabelle zusammengetragen, die hier in einen
DCAT-Katalog verwandelt und öffentlich zugänglich gemacht ist.

## Gebäudenavigator

Eine Anwendung, die auf die SPARQL-Schnittstelle des Gebäudenavigators im RDF
Store des Open Data Portals der Stadt Leipzig zugreift.

Der Leipziger Gebäudenavigator wurde im Rahmen des Projekts
[LEDS](https://aksw.org/Projects/LEDS.html) entwickelt, in dem unter der
Leitung von Konrad Abicht gemeinsam mit dem Behindertenverband Leipzig eine
RDF-basierte Übersicht über die behindertengerechte Ausstattung Leipziger Orte
erstellt wurde.

Die Daten sind im RDF Store des Open Data Portals der Stadt Leipzig verfügbar
und können über deren SPARQL Endpunkt ausgelesen werden.

## Schulen in Sachsen

Die sächsische Schuldatenbank kann über eine API

https://schuldatenbank.sachsen.de/docs/api.html

ausgelesen werden. Wie das genau funktioniert, ist wenig plausibel, allerdings
kann ein
[Dump aller Schulen](https://schuldatenbank.sachsen.de/api/v1/schools)
heruntergeladen werden (aber nur direkt von der Webseite, ansonsten greift die
Beschränkung auf 20 Einträge). Dieser ist unter rdf/schools.json gespeichert
und dient als Basis für die kleine Applikation.


