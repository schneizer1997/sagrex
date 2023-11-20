<?php
require_once('../../../classes/xajax/xajax.inc.php');
$xajax = new xajax("cheque.server.php");
$xajax->setCharEncoding("ISO-8859-1");

$xajax->registerFunction('insertcheck');
$xajax->registerFunction('insertpayto');
$xajax->registerFunction('deletepayto');
$xajax->registerFunction('updatecheckinfo');



//
?>