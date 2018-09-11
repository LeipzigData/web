<?php
/**
 * User: Hans-Gert Gräbe
 * Date: 2017-09-04
 * Last Update: 2018-09-11
 *
 * From getdata.php. Common part moved to query.php
 */

require_once("query.php");
require_once("layout.php");

$store='https://opendata.leipzig.de/virt-sparql';
echo pageHeader().prettyprint(showData($store,$_GET['show'])).pageFooter();

