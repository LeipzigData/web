# Präsentation der RDF-Daten aus den APIs der verschiedenen Plattformen

## Grundsätzliche Struktur des Verzeichnisses

In diesem Verzeichnis sind prototypisch verschiedene
Präsentationsmöglichkeiten der Daten im Verzeichnis _rdf_ (diese wurden aus
den APIs der einzelnen Plattformen gewonnen, siehe dazu das Verzeichnis
_Transform_ im LD-Repo _Tools_) zusammengestellt.  Diese Daten realisieren ein
__gemeinsames Datenmodell__ auf der Basis der verschiedenen Datenmodelle der
einzelnen Plattformen, so weit dies möglich ist.

Die entsprechenden Präsentationen werden von den Scripten `events.php`, und
`akteure.php` aus den RDF-Daten zusammengestellt und durch die gemeinsame
Datei `helper.php` unterstützt, in der vor allem verschiedene Routinen zum
Adjustieren von Strings sowie zum Erstellen von Einträgen zusammengefasst
sind, die immer wieder benötigt werden. Die Dateien `index.php` und
`layout.php` dienen dem Aufbau der Webseiten.

Die in `composer.json` definierten Abhängigkeiten müssen vorab über 
```
composer update
```
installiert werden. 

Die weiteren Dateien sind aus einer Vorgängerversion übernommen und derzeit
ohne Bedeutung.

## Namensschemata für lokale URIs

Als URI eines einzelnen Datensatzes mit direkter Referenz zur jeweiligen
Plattform wird dessen API-Link verwendet, da hiermit die Linked-Data-Regel
"upon HTTP request deliver a useful chunk of information" ansatzweise erfüllt
wird.  Dies entspricht dem, was das Prädikat `rdfs:isDefinedBy` ausliefern
würde.

Zu ergänzen: Was passiert, wenn Teile eines Datensatzes 

Für Typen und Prädikate werden die Namensraumpräfixe

-  ld: <http://leipzig-data.de/Data/Model/> 
-  le: <http://leipziger-ecken.de/Data/Model/> 
-  nl: <http://nachhaltiges-sachsen.de/Data/Model/> 

verwendet, die spezifisch für die einzelnen Plattformen sind.  Die
(zusätzlichen) Prädikate des gemeinsamen Datenmodells gehören zum Namensraum
ld:.  Daneben werden (neben rdf: und rdfs:) weitere verbreitete Ontologien wie

-  dct: <http://purl.org/dc/terms/>
-  foaf: <http://xmlns.com/foaf/0.1/> 
-  gsp: <http://www.opengis.net/ont/geosparql#> 
-  ical: <http://www.w3.org/2002/12/cal/ical#>
-  org: <http://www.w3.org/ns/org#>

eingesetzt.

## Datenmodell und dessen Transformation. 

(Das Folgende ist zu überarbeiten)

*activities* ist ein Obertyp zu verschiedenen Arten von Aktivitäten (Aktionen,
Events, Projekte, Services, Stores), die mit dem Prädikat *nl:hasType* näher
spezifiziert werden. *activities.php* stellt Routinen für gesonderte Dumps der
einzelnen Typen zur Verfügung.

In der Collection *users* (Akteure) sind Informationen über Akteure
zusammengefasst, wobei nicht zwischen den juristischen Personen und den für
diese agierenden personellen Verantwortlichen unterschieden wird. Das wir im
Transformationsprozess über das Konzept org:Membership getrennt und über die
RDF-Klassen nl:Akteur und foaf:Person auch in verschiedenen RDF-Graphen
erfasst.  *akteure.php* stellt Routinen für gesonderte Dumps der Akteure und
der Personen zur Verfügung.

Transformationen:

* full_address => String - Verwandlung in ld:proposedAddress im Datenmodell von
  leipzig-data.de

* latlng => Array - Verwandlung in gsp:asWKT "Point(lng lat)" 

Jede Instanz wird über eine ID referenziert.

## Datenmodell und dessen Transformation. Weitere Klassen.

Die folgenden Teile der Modellierung sind noch wenig ausgearbeitet und
enthalten oft nur wenige Instanzen pro Klasse. Die entsprechenden JSON-Dateien
sind zu Referenzzwecken im Verzeichnis ../Daten gespeichert.

*categories* repräsentiert eine baumartige Struktur verschiedener Tags, die
einzelnen Aktivitäten zugewiesen sind.

* id => String
* name => String
* depth => String
* parent_id => String
* children => Array
* goal_cloud => Array

*goals* repräsentiert eine geordnete Liste verschiedener Tags, die einzelnen
Aktivitäten zugewiesen sind.

*products* repräsentiert eine Liste verschiedener Produktkategorien, die
einzelnen Stores zugewiesen sind.

* id => String
* name => String

*trade_types* und *trade_categories* repräsentieren zwei geordnete Listen
verschiedener Tags, die einzelnen Akteuren über die Tabellen
*trade_categories_users* und *trade_types_users* zugewiesen sind.

* id => String
* name => String
