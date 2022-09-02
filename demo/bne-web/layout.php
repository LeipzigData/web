<?php
/**
 * User: Hans-Gert Gräbe
 * Last Update: 2020-06-05
 */

function pageHeader() {
  return '
<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="description" content="Forum Nachhaltiges Leipzig - bne-sachsen.de"/>
    <meta name="author" content="Leipzig Data Project"/>

    <title>Forum Nachhaltiges Leipzig - bne-sachsen.de</title>
    <!-- Bootstrap core CSS -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet"/>

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
            <!-- <li><a href="index.php">Startseite</a></li>
            <li><a href="angebote.php">Die Angebote</a></li>
            <li><a href="events.php">Die Events</a></li>
            <li><a href="materialien.php">Die Materialien</a></li> -->
            <li><a href="posts.php">Die Mitteilungen</a></li>
            <!-- <li><a href="akteure.php">Die Anbieter</a></li> -->
          </ul>
	</div><!-- collapse end -->
      </div><!-- container end -->
    </nav>';
}

function generalContent() {
  return '
<div class="container">
  <h1 align="center">Forum Nachhaltiges Leipzig - bne-sachsen.de</h1>
</div>
';
}

function pageFooter() {
  return '

      <div class="container">
    <div class="footer">
      <p class="text-muted">&copy;
  <a href="https://zukunftsakademie-leipzig.de">Zukunftsakademie Leipzig
        e.V.</a> 2019-2020 </p>
      </div>
    </div>
    <!-- jQuery (necessary for Bootstrap JavaScript plugins) -->
    <script src="../../js/jquery.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script src="../../js/bootstrap.min.js"></script>

  </body>
</html>';
}

function showPage($content) {
  return pageHeader().pageNavbar().generalContent().($content).pageFooter();
}

?>
