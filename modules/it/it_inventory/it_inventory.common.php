<?php
require_once('../../../classes/xajax/xajax.inc.php');
$xajax = new xajax("it_inventory.server.php");
$xajax->setCharEncoding("ISO-8859-1");


$xajax->registerFunction('insertsingleitem');



//
?>