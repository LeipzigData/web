<?php
/**
 * User: Hans-Gert Gräbe
 * Date: 2018-06-07
 * Last Update: 2019-01-13
 */

include_once("layout.php");
include_once("Zukunftsdiplom.php");

$content='      
<div class="container">
<h2 align="center">Die Partner und ihre Angebote</h2>

'.diePartner().'
</div>
';
echo showPage($content);

?>
