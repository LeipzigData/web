<?php
/**
 * User: Hans-Gert Gräbe
 * last update: 2019-08-05
 */

function pageHeader() {
  return '
<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="description" content="Leipzig Data Demonstration Site"/>
    <meta name="author" content="Leipzig Data Project"/>

    <title>Leipzig Data Demonstration Site</title>
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
            <li><a href="mint-personen.php">MINT-Personen in Leipzig</a></li>
            <li><a href="mint-katalog.php">MINT-Katalog</a></li> 
            <li><a href="mint-md-katalog.php">MINT-MD-Katalog</a></li> 
            <li><a href="gebaeudenavigator.php">Gebäudenavigator</a></li> 
          </ul>
        </div><!-- navbar end -->
      </div><!-- container end -->
    </nav>';
}

function generalContent() {
  return '
<div class="container">
  <h1 align="center">Demonstations-Site des Leipzig Data Projekts</h1>
</div>
';
}

function pageFooter() {
  return '

      <div class="container">
    <div class="footer">
        <p class="text-muted">&copy; <a href="http://leipzig-data.de">Leipzig Data Projekt</a> seit 2015 </p>
        <p class="text-left">Leipzig Data gehört zum <a href="http://leipzig-data.de/impressum/">Netzprojekt</a> an der Universität Leipzig, dessen <a href="http://leipzig-data.de/impressum/">Datenschutzregeln</a> auch hier Anwendung finden. </p>
      </div>
    </div>
    <!-- jQuery (necessary for Bootstrap JavaScript plugins) -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    
  </body>
</html>';
}

function showPage($content) {
  return pageHeader().generalContent().pageNavbar().($content).pageFooter();
}
