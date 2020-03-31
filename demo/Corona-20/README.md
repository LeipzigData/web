# Auswertung von Daten zur Corona-Pandemie

Quelle sind die von der John Hopkins Universität veröffentlichten Daten, die
im github Repository <https://github.com/CSSEGISandData/COVID-19>
veröffentlicht wurden.

Zunächst muss das git Repo lokal geklont und der Pfad im Skript
`extractData.pl` eingetragen werden.

Die Daten enthalten kumulierte Zeitreihen ab 22.01.2020 über die Zahl der
Infizierten, Genesenen und Gestorbenen aufgeschlüsselt auf einzelne Länder
(US-Daten sind noch kleinteiliger erfasst).

Die Daten werden für ausgewählte Länder mit dem Perl-Skript `extractData.pl`
für die weitere Verarbeitung aufbereitet und in einer Datei `BasicData.txt'
gespeichert, um dann mit dem freies CAS
[Maxima](http://maxima.sourceforge.net/de/) weiterverarbeitet zu werden.

