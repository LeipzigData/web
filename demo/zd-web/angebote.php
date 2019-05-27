<?php
/**
 * User: Hans-Gert Gräbe
 * Date: 2018-06-07
 * Last Update: 2019-04-01
 */

include_once("layout.php");

$content='      
<div class="container">
<h2 align="center">Die Angebote</h2>

<p>Die Datenbasis wird einmal täglich über einen Cron-Job aktualisiert,
Änderungen in der Nachhaltigekitsdatenbank sind also nicht sofort hier
sichtbar. </p>

'.file_get_contents("content.html").'
</div>
';
echo showPage($content);

?>
