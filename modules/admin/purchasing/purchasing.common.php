<?php
require_once('../../../classes/xajax/xajax.inc.php');
$xajax = new xajax("purchasing.server.php");
$xajax->setCharEncoding("ISO-8859-1");

$xajax->registerFunction('insertsample');
$xajax->registerFunction('insertplate');
$xajax->registerFunction('updateplate');
$xajax->registerFunction('insertvamitem');
//insertvamitem
$xajax->registerFunction('insertitemvam');
$xajax->registerFunction('updateitemvam');
$xajax->registerFunction('insertrmsvam');
$xajax->registerFunction('updatermsvam');
$xajax->registerFunction('insertfuelinfo');
$xajax->registerFunction('updatefuelinfo');
$xajax->registerFunction('insertproditem');
$xajax->registerFunction('updateproditem');
$xajax->registerFunction('insertproditemrms');
$xajax->registerFunction('updateproditemrms');
$xajax->registerFunction('insertofficecoaco');
$xajax->registerFunction('updateofficecoaco');
$xajax->registerFunction('insertothersitem');
$xajax->registerFunction('updateinfoitem');
$xajax->registerFunction('insertvendor');








//
?>