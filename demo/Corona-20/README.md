# Auswertung von Daten zur Corona-Pandemie

## Datenquelle

Quelle sind die von der John Hopkins Universität veröffentlichten Daten, die
im github Repository <https://github.com/CSSEGISandData/COVID-19>
veröffentlicht wurden.

Die Daten enthalten kumulierte Zeitreihen ab 22.01.2020 über die Zahl der
Infizierten, Genesenen und Gestorbenen aufgeschlüsselt auf einzelne Länder
(US-Daten sind noch kleinteiliger erfasst).

## Installation 

Zunächst muss das git Repo lokal geklont und der Pfad im Skript
`extractData.pl` eingetragen werden.

Die Daten werden für ausgewählte Länder mit dem Perl-Skript `extractData.pl`
für die weitere Verarbeitung aufbereitet und in einer Datei `BasicData.txt'
gespeichert, um dann mit dem freies CAS
[Maxima](http://maxima.sourceforge.net/de/) weiterverarbeitet zu werden.

## Weitere Informationen

Außerdem heruntergeladen und hier der Aufsatz des Schweizer Arztes
Prof. Dr. med. Dr. h.c. Paul Robert Vogt

COVID-19 - eine Zwischenbilanz oder eine Analyse der Moral, der medizinischen
Fakten, sowie der aktuellen und zukünftigen politischen Entscheidungen

Die Mittelländische Zeitung, 07. April 2020

Quelle: https://www.mittellaendische.ch/2020/04/07/covid-19-eine-zwischenbilanz-oder-eine-analyse-der-moral-der-medizinischen-fakten-sowie-der-aktuellen-und-zuk%C3%BCnftigen-politischen-entscheidungen/

sowie eine Übersicht zu den Simulationsrechnungen von Peter Karl Fleißner zur
Corona-Dynamik in Österreich (Stand Mai 2020, Folien aus einem Webinar bei
transform.at)

## Bilder

Daten:
- p(t) - die positiv Getesteten
- r(t) - die Genesenen und Verstorbenen (kumuliert = g(t)+v(t))
- i(t)=p(t)-r(t) - die aktuell noch Infizierten (unter den Getesteten)
- Delta(f(t))=f(t)-f(t-1) - Zuwachs der Kurve f(t)

Datenbasis JHU, Stand 28.05.2020
- MG-1 = p(t) (rot) und r(t) (grün) für Deutschland
- MG-2 = Delta(p(t)) (rot) und Delta(r(t)) (grün) für Deutschland
- MG-3 = i(t) für Deutschland
- MG-4 = Vergleich i(t) (rot) und Delta(p(t)) (grün)
- MG-4 = Vergleich u(t)=Delta(p(t)) (rot) und glD(u(t),14) 

Fittings
- Land = Fitting von p(t) gegen die Errorfunktion
- Land-1 = Fitting von p(t) gegen die logarithmische Funktion, Schätzung
  Anfang April 2020
- Land-2 = Fitting von p(t) gegen die logarithmische Funktion, korrigierte
  Schätzung mit anders geschätztem K_0 Ende Mai 2020
- Land-3 = Fitting von p(t) gegen die logarithmische Funktion, es wurden zwei
  verschiedene Datenintervalle gegenübergestellt (vor und nach Lockdown), Ende
  Mai 2020