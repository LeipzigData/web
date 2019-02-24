# Code für das Teilnehmer-Management des Leipziger Zukunftsdiploms

## Grundsätzliches

Die Applikation greift auf die REST API der Nachhaltigkeitsdatenbank (NL) zu,
um von dort die relevanten Veranstaltungen, Akteure und Orte zu extrahieren.
Das Ganze wird über die LD-Datei Zukunftsdiplom.ttl gesteuert.  Über
Kreuzreferenzen können künftig auch weitere Informationen aus LD mit verwendet
werden.

Das Management der Teilnehmer und Teilnahmen erfolgt direkt über eine lokale
Datenbank, die nach Ablauf der Sperrfrist komplett gelöscht wird.

Veranstaltungen sind fest vorgegebenen Modulen zuzuordnen. Das wird aktuell
ebenfalls in Zukunftsdiplom.ttl abgebildet, da entsprechende Strukturen in der
Nachhaltigkeitsdatenbank noch fehlen.

Die einzelnen Bestandteile können über das Skript service.php und
entsprechende GET-Parameter ausgelesen werden. Es wird jeweils ein
HTML-Schnipsel zurückgegeben, das zum Beispiel als Shortcode in Wordpress
eingebunden werden kann.

* service.php?teilnehmer&id=<id> - Information zu einem einzelnen Teilnehmer
* service.php?veranstaltungen - Information zu den Veranstaltungen
* service.php?ranking - Das Ranking

## Installation

Die Applikation ist im Demobereich von Leipzig-Data ausgerollt, kann aber auch
lokal nachgenutzt werden. Dazu sich folgende Schitte erforderlich:

* Ausrollen dieses Verzeichnisses in ein Verzeichnis auf dem Webserver Ihrer
  Wahl.
* Kopiere inc_sample.php auf inc.php und trage dort die Zugangsdaten für die
  lokale MySQL-Datenbank ein. Alternativ kann db_query() auch direkt auf eine
  entsprechende Funktion Ihrer Webanwendung wie etwa Wordpress oder Drupal
  umgeleitet werden.
* Spiele die Definition zd.sql der Teilnehmertabelle in die lokale Datenbank
  ein.

## Management der Teilnehmermeldungen

... erfolgt aktuell manuell direkt über die Datenbankschnittstelle und ist
hier zu gegebener Zeit noch genauer zu beschreiben.

## Datenmodell

### Teilnehmer

* Teilnehmer werden entsprechend den eingehenden Anmeldungen händisch in die
  Datenbank eingetragen und nach Eintrag ggf. per Mail informiert.
* Beim Eintrag werden eine ID und ein Hash generiert. Die ID ist die
  öffentlich verwendete "Matrikelnummer", der Hash kann verwendet werden, um
  die gespeicherten personenbezogenen Daten anzuschauen. Beides wird dem
  Teilnehmer per Mail mitgeteilt.

### Akteure

Die Akteure (Anbieter von Veranstaltungen) müssen sich für das Zukunftsdiplom
anmelden und außerdem in der Nachhaltigkeitsdatenbank registriert sein, um
Angebote eintragen zu können.  Die Akteursanmeldungen werden in der Datei
Zukunftsdiplom.ttl vermerkt und bilden die Basis für das Ausfiltern von
Veranstaltungen aus der Nachhaltigkeitsdatenbank.  Eine separate Anzeige der
Akteure (und der Veranstaltungsorte) erfolgt nicht mehr.

### Veranstaltungen

Aus Performancegründen (die Veranstaltungen können nur komplett aus der
Nachhaltigkeitsdatenbank gezogen werden, was inzwischen durch die erreichte
schiere Größe längere Zeit in Anspruch nimmt) erfolgt eine Vorauswahl von
potenziellen Veranstaltungen in einen hier gespeicherten Dump, der täglich als
cron-Job aus der NL REST API neu extrahiert wird. 

Daraus wird eine Kurzversion der Veranstaltungen extrahiert mit folgenden
Informationen:
* id ist die ID der Aktivität bei NL.
* modul ist die URI des zugeordneten Moduls aus der bei Leipzig Data
  gespeicherten Modulübersicht.
* veranstalter ist die ID des Veranstalters.
* title, ort, datum, anmerkung sind die aus NL extrahierten Angaben. 

### Besuche

Kreuztabelle, die Teilnehmer-ID (tid) und Veranstaltungs-ID (vid)
zusammenführt.
