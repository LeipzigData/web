<?php
/**
 * User: Hans-Gert Gräbe
 * Last Update: 2020-06-05
 */

include_once("layout.php");
include_once("helper.php");

$content='      
<div class="container">
<h2 align="center">Die Partner</h2>

'.diePartner().'
</div>
';
echo showPage($content);

?>
