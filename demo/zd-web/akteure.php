<?php
/**
 * User: Hans-Gert Gräbe
 * Date: 2018-06-07
 * Last Update: 2019-04-01
 */

include_once("layout.php");
include_once("Zukunftsdiplom.php");

$content='      
<div class="container">
<h2 align="center">Die Partner</h2>

<p>Auf dieser Seite sind die Commitments der Partner dargestellt, die nun
durch Einspielen konkreter Bildungsangebote in die Nachhaltigkeitsdatenbank
(ND) weiter untersetzt werden müssen.  Bitte markieren Sie diese Angebote mit
dem Tag "Zukunfts-Diplom". </p>

<p>Die Auflistung gibt den Stand zum 6.3. wieder, wie er zur MV der
Zukunftsakademie kommuniziert wurde. </p>

<p>Es ist prinzipiell angedacht, Angeboten (Typ "Service" in der ND) einzelne
Veranstaltungstermine (Typ "Event" in der ND) zuzuordnen.  Das muss aktuell
allerdings manuell über das Redaktionsteam des Zukunftsdiploms erfolgen. </p>

'.diePartner().'
</div>
';
echo showPage($content);

?>
