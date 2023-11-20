<?php
  	require_once('../../classes/xajax/xajax.inc.php');
  	$xajax = new xajax("sales.server.php");
	$xajax->setCharEncoding("ISO-8859-1");
	
	$xajax->registerFunction('addrequestmaterial');
	$xajax->registerFunction('createnewrequest');
	$xajax->registerFunction('wew');
	$xajax->registerFunction('loadmaterials');
	$xajax->registerFunction('updatematerial');
	$xajax->registerFunction('deletematerial');
	$xajax->registerFunction('updateformrequest');
	$xajax->registerFunction('updatecredentials');
	$xajax->registerFunction('updatestatus');
	$xajax->registerFunction('updatewcb');
	$xajax->registerFunction('loginmaint');
	$xajax->registerFunction('updatemwrfstatus');
	$xajax->registerFunction('materialverification');
	$xajax->registerFunction('archiveinsert');
?>