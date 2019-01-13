# Code für das Teilnehmer-Management des Leipziger Zukunftsdiploms

## Grundsätzliches

Die Applikation greift auf die REST API der Nachhaltigkeitsdatenbank (NL) zu,
um von dort die relevanten Veranstaltungen, Akteure und Orte zu extrahieren.
Über Kreuzreferenzen werden auch Informationen aus Leipzig Data (LD) mit
verwendet.

Das Management der Teilnehmer und Teilnahmen erfolgt direkt über eine lokale
Datenbank, die nach Ablauf der Sperrfrist komplett gelöscht wird.

Veranstaltungen sind fest vorgegebenen Modulen zuzuordnen. Wie das genau in NL
dargestellt wird, ist noch zu besprechen.  Eine solche Liste von Modulen wird
parallel bei LD gehalten und für die Veranstaltungszuordnung verwendet. QWie
das genau mit NL abgeglichen werden kann, muss noch besprochen werden.

## Installation

* Ausrollen dieses Verzeichnisses in ein Verzeichnis auf dem Webserver Ihrer
  Wahl.
* Kopiere inc_sample.php auf inc.php und trage dort die Zugangsdaten für die
  lokale MySQL-Datenbank ein (alternativ kann db_query() auch direkt auf eine
  entsprechende Funktion Ihrer Webanwendung wie etwa Wordpress oder Drupal
  umgeleitet werden).
* Spiele die Definition zd.sql der Teilnehmertabelle in die lokale Datenbank
  ein.

## Management der Teilnehmermeldungen

... erfolgt aktuell manuell direkt über die Datenbankschnittstelle und ist
hier zu gegebener Zeit noch genauer zu beschreiben.

## Datenmodell

### Teilnehmer

* Teilnehmer werden entsprechend den eingehenden Anmeldungen im civicrm
  händisch in die Datenbank eingetragen und nach Eintrag ggf. per Mail
  informiert.
* Beim Eintrag werden eine ID und ein Hash generiert. Die ID ist die
  öffentlich verwendete "Matrikelnummer", der Hash kann verwendet werden, um
  die gespeicherten personenbezogenen Daten anzuschauen. Beides wird dem
  Teilnehmer per Mail mitgeteilt.

### Veranstaltungen

Es wird eine Kurzversion der Veranstaltungen aus der NL REST API extrahiert.

* ID ist die ID der Aktivität bei NL,
* URI ist die bei Leipzig Data gespeicherte URI, wenn die Veranstaltung
  dorthin übernommen wurde.
* modul ist die URI des zugeordneten Moduls aus der bei Leipzig Data
  gespeicherten Modulübersicht (jede Veranstaltung ist aktuell genau einem
  Modul zuzuordnen)
* veranstalter ist die ID des Veranstalters.
* title, ort, datum, anmerkung sind die aus NL extrahierten Angaben. 

### Besuche

Kreuztabelle, die Teilnehmer-ID (tid) und Veranstaltungs-ID (vid)
zusammenführt.
