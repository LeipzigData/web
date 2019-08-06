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
<h2 align="center">Die Orte</h2>
<ul>
'.dieOrte().'
</ul>
</div>
';
echo showPage($content);

?>
