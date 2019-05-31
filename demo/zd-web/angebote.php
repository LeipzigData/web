<?php
/**
 * User: Hans-Gert Gräbe
 * Date: 2018-06-07
 * Last Update: 2019-05-31
 */

include_once("layout.php");

$content='      
<div class="container">
<h2 align="center">Die Angebote</h2>

'.file_get_contents("content.php").'
</div>
';
echo showPage($content);

?>
