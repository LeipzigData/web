# Code für API-Nutzung der Plattform "Leipziger Ecken"

## Grundsätzliches

Die Applikation greift auf einen Dump `Data.json` der RDF/JSON REST API der
"Leipziger Ecken" zu, der im Verzeichnis `Transform/leipziger-ecken` des
github LD-Repos `Tools` erzeugt und hierher gespiegelt wird.

Von dort werden relevante Informationen extrahiert, die sich am Vorbild der
NDL-API orientieren.

## Abhängigkeiten

Diese Seite nutzt:
* php 5 oder höher
* bootstrap 3.5
* jQuery v1.11.1

# Neue API (2021)

https://github.com/Leipziger-Ecken/drupal/blob/master/docu/API.md

Es wird der Aufbau der API nach <http://jsonapi.org/format/1.0/> umgesetzt. 

Es werden die folgenden Teil-APIs angeboten:
- Akteure/Actors https://leipziger-ecken.de/jsonapi/akteure
- Veranstaltungen/Events https://leipziger-ecken.de/jsonapi/events
- Bezirke/Districts https://leipziger-ecken.de/jsonapi/districts
- Akteurtypen/ActorTypes https://leipziger-ecken.de/jsonapi/akteur_types
- Kategorien/Categories https://leipziger-ecken.de/jsonapi/categories
- Schlagwörter/Tags https://leipziger-ecken.de/jsonapi/tags
- Zielgruppen/TargetGroups https://leipziger-ecken.de/jsonapi/target_groups


