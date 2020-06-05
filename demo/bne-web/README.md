# Code für einen prototypischen Test der API von bne-sachsen.de 

## Grundsätzliches

Anfang Juni 2020 wurde die folgende API veröffentlicht, über die einzene Teile
der Datenbasis ausgelesen werden können.  Die Daten werden als JSON-Array
zurückgegeben.  
* Angebote: https://bne-sachsen.de/wp-json/content/offers
* Veranstaltungen: https://bne-sachsen.de/wp-json/content/events
* Materialien: https://bne-sachsen.de/wp-json/content/materials
* News: https://bne-sachsen.de/wp-json/content/posts

Mit Hilfe von Parametern können die zurückgegebenen Beiträge eingegrenzt
werden.  Parameter werden immer mit der Syntax "?{PARAMETER_NAME}={WERT}"
übergeben und können auf die üblcihe Weise kombiniert werden. 

Bsp.: https://bne-sachsen.de/wp-json/content/offers?p=8234 

* p - einzelnen Eintrag ausgeben. ID des Beitrags muss übergeben werden.
  https://bne-sachsen.de/wp-json/content/offers?p=8234
* limit - Maximum der ausgegebenen Beiträgen angeben.
  https://bne-sachsen.de/wp-json/content/offers?&limit=20
* author - Gibt alle Beiträge eines Autors zurück.
  https://bne-sachsen.de/wp-json/content/offers?author=115
* author_name - Gibt alle Beiträge eines Autors zurück. Der "Slug" des Autors
  muss übergeben werden. Der Slug kann aus dem Link zum Autorenprofil
  übernommen werden. 
  https://bne-sachsen.de/anbieter/ackerdemia-e-v/
  https://bne-sachsen.de/wp-json/content/offers?author_name=ackerdemia-e-v
* district - Gibt alle Beiträge aus dem Landkreis zurück. Nur für
  Veranstaltungen und Angebote verfügbar. 
  https://bne-sachsen.de/wp-json/content/offers?district=dresden

## Mehr zu prototypischen Implementierung

Diese setzt auf einer minimalen Bootstrap-Umgebung von css und js auf
(einheitliche Quellen in den Verzeichnissen ../css und ../js). Die
Rahmenapplikation wird mit `index.php` gestartet, das Menü ist in `layout.php`
definiert, jeder einzelne Menüpunkt wird in einer eigenen php-Datei
zusammengestellt, `helper.php` enthält gemeinsamen Quellcode.

Aus (aktuell allerdings noch nicht kritischen) Performancegründen wird auf
einen lokalen Dump der Daten zugegriffen, der mit `createDump.php` erzeugt
werden kann. 
