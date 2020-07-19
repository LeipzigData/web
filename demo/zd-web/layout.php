<?php
/**
 * User: Hans-Gert Gräbe
 * Date: 2018-06-30
 * Last Update: 2020-07-16
 */

function pageHeader() {
  return '
<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="description" content="Leipzig Data Projekt und Zukunftsakademie"/>
    <meta name="author" content="Leipzig Data Project"/>

    <title>Leipzig Data Projekt und Zukunftsakademie</title>
    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet"/>

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
	<button class="navbar-toggle hidden-sm-up pull-right" type="button"
		data-toggle="collapse" data-target="#navbar"> ☰
	</button>
	<div class="collapse navbar-collapse" id="navbar">
          <ul class="nav navbar-nav">
            <li><a href="index.php">Startseite</a></li>
            <li><a href="zd.php">Das Zukunftsdiplom</a></li>
            <li><a href="angebote.php">Die ZD-Angebote</a></li>
            <li><a href="akteure.php">Die ZD-Anbieter</a></li>
            <li><a href="bildungsangebote.php">Bildungsangebote</a></li>
            <!-- <li><a href="ausfall.php">Ausfallende Veranstaltungen</a></li>
            <li><a href="events.php">Die Events</a></li>
            <li><a href="locations.php">Die Orte</a></li> 
            <li><a href="gta.php">Die GTA-Angebote</a></li> 
            <li><a href="service.php">Die Services</a></li>
            <li><a href="alleAkteure.php">Alle Akteure</a></li> 
            -->
          </ul>
	</div><!-- collapse end -->
      </div><!-- container end -->
    </nav>';
}

function generalContent() {
  return '
<div class="container">
  <h1 align="center">Leipzig Data Projekt und Zukunftsakademie</h1>
</div>
';
}

function pageFooter() {
  return '

      <div class="container">
    <div class="footer">
      <p class="text-muted">&copy;
  <a href="https://leipzig-data.de">Leipzig Data Projekt</a> seit 2015 </p>
      <p class="text-muted">&copy;
  <a href="https://zukunftsakademie-leipzig.de">Zukunftsakademie Leipzig
        e.V.</a> 2019-2020 </p>
      </div>
    </div>
    <!-- jQuery (necessary for Bootstrap JavaScript plugins) -->
    <script src="../js/jquery.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>

  </body>
</html>';
}

function showPage($content) {
  return pageHeader().pageNavbar().generalContent().($content).pageFooter();
}

?>
