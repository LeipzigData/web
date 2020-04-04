# Code für API-Nutzung der Plattform "Leipziger Ecken"

## Grundsätzliches

Die Applikation greift auf einen Dump `Data.json` der RDF/JSON REST API der
"Leipziger Ecken" zu, der im Verzeichnis `Transform/leipziger-ecken` des
github LD-Repos `Tools` erzeugt und hierher gespiegelt wird.

Von dort werden relevante Informationen extrahiert, die sich am Vorbild der
NDL-API orientieren.

## Abhängigenkeiten

Diese Seite nutzt:
* php 5 oder höher
* bootstrap 3.5
* jQuery v1.11.1
