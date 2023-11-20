<?php

include('../../../classes/inc/dbCon.php');

function insertsingleitem($desc,$qty,$unit,$serial_no,$barcode,$category,$status,$remarks,$dateadded,$user_id,$is_assign)
{
	global $dbitinv;
	$objResponse= new xajaxResponse();
	$sql = "INSERT INTO tblitems(descr,qty,unit,serial_no,barcode,category,status,remarks,date_added,user_id,is_assign,isdelete)VALUES('".addslashes($desc)."','".(int)$qty."','".addslashes($unit)."','".($serial_no)."','".addslashes($barcode)."','SINGLE','".addslashes($status)."','".addslashes($remarks)."','".date("Y/m/d")."',1,1,1)";
	//var_dump($sql);
			//die($sql);
			if ($dbitinv->query($sql) == TRUE){
				$objResponse->addAlert('Item Added Successfully.');
			}
			else{
			//$objResponse->addAlert('Error');
			//die($sql);
			}
		return $objResponse;
}


function insertpackitem($desc,$qty,$unit,$serial_no,$barcode,$category,$status,$remarks,$dateadded,$user_id,$is_assign)
{
	global $dbitinv;
	$objResponse= new xajaxResponse();
	$sql = "INSERT INTO tblitems(descr,qty,unit,serial_no,barcode,category,status,remarks,date_added,user_id,is_assign,isdelete)VALUES('".addslashes($desc)."','".(int)$qty."','".addslashes($unit)."','','".addslashes($barcode)."','PACKAGE','".addslashes($status)."','".addslashes($remarks)."','".date("Y/m/d")."',1,1,1)";
	//var_dump($sql);
			//die($sql);
			if ($dbitinv->query($sql) == TRUE){
				$objResponse->addAlert('Item Added Successfully.');
			}
			else{
			//$objResponse->addAlert('Error');
			die($sql);
			}
		return $objResponse;
}

function insertpackitem2($barcode,$serial_no,$descr,$remarks,$status,$assign_to,$isdelete)
{
	global $dbitinv;
	$objResponse= new xajaxResponse();
	$sql = "INSERT INTO tblpackitems(barcode,serial_no,descr,remarks,status,assign_to,isdelete)VALUES('".addslashes($barcode)."','".addslashes($serial_no)."','".addslashes($descr)."','','".addslashes($remarks)."','".addslashes($status)."','".addslashes($date_pack).",'".addslashes($assign_to)."',1)";
	//var_dump($sql);
			//die($sql);
			if ($dbitinv->query($sql) == TRUE){
				$objResponse->addAlert('Item Added Successfully.');
			}
			else{
			//$objResponse->addAlert('Error');
			//die($sql);
			}
		return $objResponse;
}


require("it_inventory.common.php");
$xajax->processRequests();
?>