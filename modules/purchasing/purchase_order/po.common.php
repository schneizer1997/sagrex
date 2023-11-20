<?php
require_once('../../../classes/xajax/xajax.inc.php');
$xajax = new xajax("po.server.php");
$xajax->setCharEncoding("ISO-8859-1");

/*$xajax->registerFunction('insertcheck');
$xajax->registerFunction('insertpayto');
$xajax->registerFunction('deletepayto');
$xajax->registerFunction('updatecheckinfo');*/

$xajax->registerFunction('insertpo');
$xajax->registerFunction('insertpoitem');
$xajax->registerFunction('updatepoitem');
$xajax->registerFunction('updatepoitemstatus');
$xajax->registerFunction('updatepo');
$xajax->registerFunction('updatepostatus');



//
?>