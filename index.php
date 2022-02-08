<?php
/**
 * User: Hans-Gert Gräbe
 * last update: 2022-02-05
 */

function pageHeader() {
  return '
<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="description" content="Leipzig Data Project"/>
    <meta name="author" content="Leipzig Data Project"/>

    <title>The Leipzig Data Project</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    
  </head>
<!-- end header -->
  <body>

';
}

function pageNavbar() {
  return '

    <!-- Fixed navbar -->
    <nav class="navbar navbar-default" role="navigation">
      <div class="container">
	<button class="navbar-toggle  hidden-sm-up pull-right" type="button"
		data-toggle="collapse" data-target="#navbar"> ☰
	</button>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="index.php">Startseite</a></li>
            <li><a href="https://leipzigdata.github.io">Das Leipzig Data
		Projekt Wiki</a></li>
            <li><a href="demo/index.php">LD Präsentationen</a></li> 
            <li><a href="info/index.php">LD Demonstrator</a></li> 
          </ul>
        </div><!-- navbar end -->
      </div><!-- container end -->
    </nav>';
}

$content='
<div class="container">
  <h1 align="center">Das Leipzig Data Projekt</h1>

  <div class="row">
    <div  class="col-lg-1 col-sm-1"></div>
    <div  class="col-lg-10 col-sm-10">
      <p>Die "Leipziger Initiative für Offene Daten" ist angetreten, um die
	Bemühungen zur <em>Etablierung Offener Daten</em> als wesentlichen
	Teil einer sich entfaltenden Weblandschaft in der Leipziger Region
	voranzubringen und die dafür erforderliche <em>regionale technische
	Kompetenz</em> weiterzuentwickeln und zu bündeln.</p>

      <p>Kern der Bemühungen ist die Etablierung von <strong>Leipzig
	  Data</strong> als einer signifikanten Menge von Beschreibungen des
	"Leipziger Lebens", die unter einer freien Lizenz in digital
	adressierbarer Form öffentlich verfügbar sind.</p>

      <p>Die Initiative setzt die Aktivitäten
	von <a href"http://www.leipzig-netz.de/index.php/LD.API-Leipzig">API
	Leipzig</a> mit veränderter Schwerpunktsetzung fort. Sie wurde von der
	Stadt Leipzig in einem Kurzzeitprojekt (Nov. 2012 bis April 2013) im
	Rahmen ihrer
	<a href="http://www.leipzig-netz.de/index.php/LD.OpenInnovation-12">"Open
	  Innovation" Ausschreibung</a> unterstützt. </p>

      <p>Die Entwicklungen wurden nach Ende der Förderung unter dem Titel
	"Leipzig Data" im Rahmen vorhandener Ressourcen weitergeführt und sind
	<strong>in diesem Portal</strong> genauer dargestellt.</p>
    </div>
    <div class="col-lg-1 col-sm-1"> </div>
  </div>
  <div class="footer">
    <p class="text-muted">&copy;
      <a href="http://leipzig-data.de">Leipzig Data Projekt</a> seit 2012 </p>

    <p class="text-left">Leipzig Data gehört
      zum <a href="https://leipzigdata.github.io/Impressum">Netzprojekt</a> an
      der Universität Leipzig, dessen
      <a href="https://leipzigdata.github.io/Impressum">Datenschutzregeln</a>
      auch hier Anwendung finden. </p>
  </div>
</div> <!-- end container -->
<!-- jQuery (necessary for Bootstrap JavaScript plugins) -->
<script src="js/jquery.js"></script>
<!-- Bootstrap core JavaScript -->
<script src="js/bootstrap.min.js"></script>

  </body>
</html>';

echo pageHeader().pageNavbar().$content;

?>
