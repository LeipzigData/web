# Code für API-Nutzung der Plattform "Leipziger Ecken"

## Grundsätzliches

Die Applikation greift auf die RDF REST API der "Leipziger Ecken" zu, um von
dort relevante Informationen zu extrahieren, die sich am Vorbild der NDL-API
orientieren.  Dazu werden zunächst mit `make` die vier Datenquellen über die
API ausgelesen und in einer einzigen RDF-Datei `Data.json`im RDF/JSON Format
gespeichert, als Basis für alle weiteren Transformationen.

## Abhängigenkeiten

Diese Seite nutzt:
* php 5 oder höher
* bootstrap 3.5
* jQuery v1.11.1
