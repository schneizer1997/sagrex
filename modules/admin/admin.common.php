<?php
  	require_once(__DIR__.'../../../classes/xajax/xajax.inc.php');
  	//require('../../../classes/xajax/xajax.inc.php');
  	$xajax = new xajax("admin.server.php");
	$xajax->setCharEncoding("ISO-8859-1");
	
	$xajax->registerFunction('updateplate');
	$xajax->registerFunction('insertplate');
	$xajax->registerFunction('insertsample');
	$xajax->registerFunction('updatesample');
	//$xajax->registerFunction('updateplate');
	
	/*$xajax->registerFunction('addrequestmaterial');
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
	$xajax->registerFunction('insertclosed');
	$xajax->registerFunction('insertclosedarchive');
	$xajax->registerFunction('shopinsert');
	$xajax->registerFunction('shopupdate');
	$xajax->registerFunction('updateisdelete');
	$xajax->registerFunction('updatestatusall');*/
	
	
?>