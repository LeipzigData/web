<?php 

require_once("header.php");
require_once("footer.php");

$content='
   <h1>Impressum</h1>

   <h2>Inhaltliche Verantwortlichkeit</h2>
<p><strong>Leitung des Projektbausteins „Interaktiver Haushaltsplanrechner Leipzig 2015“:</strong><br /> Prof. Dr. Hans-Gert Gr&auml;be<br /> Universit&auml;t Leipzig<br /> Fakult&auml;t f&uuml;r Mathematik und Informatik<br /> Institut f&uuml;r Informatik<br /> PF 100920<br /> 04009 Leipzig<br />
  
<p>Die Universit&auml;t Leipzig ist eine K&ouml;rperschaft des &Ouml;ffentlichen Rechts. Sie wird durch die Rektorin Prof. Dr. med. Beate A. Sch&uuml;cking gesetzlich vertreten.</p>

<p> Zust&auml;ndige Aufsichtsbeh&ouml;rde:<br /> S&auml;chsisches Staatsministerium f&uuml;r Wissenschaft und Kunst<br /> Wigardstra&szlig;e 17<br /> 01097 Dresden<br /> www.smwk.de</p>

<p>Umsatzsteuer-Identifikationsnummer gem&auml;&szlig; &sect; 27 a Umsatzsteuergesetz: DE 141510383</p>

<p> <strong>Webdesign:</strong> Marius Brunnert</p>

<h2>Disclaimer</h2>
<p>Unser Angebot enth&auml;lt Links zu externen Webseiten Dritter, auf deren Inhalte wir keinen Einfluss haben. F&uuml;r die Inhalte der verlinkten Seiten ist stets der jeweilige Anbieter oder Betreiber der Seiten verantwortlich. F&uuml;r die Inhalte und die Richtigkeit der Informationen verlinkter Websites fremder Informationsanbieter wird keine Gew&auml;hr &uuml;bernommen.</p>

<p> Die durch die Seitenbetreiber erstellten Inhalte und Werke auf diesen Seiten unterliegen dem deutschen Urheberrecht. Die Vervielf&auml;ltigung, Bearbeitung, Verbreitung und jede Art der Verwertung au&szlig;erhalb der Grenzen des Urheberrechtes bed&uuml;rfen der schriftlichen Zustimmung des jeweiligen Autors bzw. Erstellers.</p>

<h2>Haftungsausschluss</h2>
<p>Die Inhalte dieser Website wurden mit gr&ouml;&szlig;tm&ouml;glicher Sorgfalt und nach bestem Wissen erstellt. Da Fehler jedoch nie auszuschlie&szlig;en sind und die Daten sowie weitere Inhalte Ver&auml;nderungen unterliegen k&ouml;nnen, weisen wir darauf hin, dass wir keine Gew&auml;hr f&uuml;r die Aktualit&auml;t, Richtigkeit, Vollst&auml;ndigkeit oder Qualit&auml;t der auf dieser Website bereitgestellten Informationen &uuml;bernehmen. F&uuml;r Sch&auml;den materieller oder immaterieller Art, die durch die Nutzung oder Nichtnutzung der dargebotenen Informationen bzw. durch die Nutzung fehlerhafter und unvollst&auml;ndiger Informationen unmittelbar oder mittelbar verursacht werden, haften wir nicht, sofern nicht nachweislich vors&auml;tzliches oder grob fahrl&auml;ssiges Verschulden zur Last gelegt werden kann.</p>
';

echo myHeader().($content).myFooter();
