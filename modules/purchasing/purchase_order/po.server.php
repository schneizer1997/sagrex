<?php

include('../../../classes/inc/dbCon.php');

function insertpo($pono,$name,$addr,$date,$terms,$purpose,$req,$prep,$note,$approved,$purpose,$notess){
	//error_reporting(E_ALL);
	global $dbpo;
	$objResponse= new xajaxResponse();
	$sqlselect = "SELECT *FROM tblpo where po_no = '".$pono."' ";
	$result = $dbpo->query($sqlselect);
	//die($sqlselect);
	if($result->num_rows > 0){
		$objResponse->addAlert('PO No. is already exist.');
	}
	else {
		$sqlpoinsert = "INSERT INTO tblpo(po_no,po_name,po_addr,po_date,po_terms,date_modified,reqby,prepby,noteby,approveby,purpose,status,note)VALUES('".addslashes($pono)."','".addslashes($name)."','".addslashes($addr)."','".($date)."','".addslashes($terms)."','".date("Y/m/d")."','".addslashes($req)."','".addslashes($prep)."','".addslashes($note)."','".addslashes($approved)."','".addslashes($purpose)."','1','".addslashes($notess)."')";
	//var_dump($sqlpoinsert);
			if ($dbpo->query($sqlpoinsert) == TRUE){
				//$objResponse->addAlert('Plate Added Successfully.');
			}
			else{
			//$objResponse->addAlert('Error');
			}
		}

		return $objResponse;
	}

	function updatepo($id,$pono,$name,$addr,$date,$terms,$purpose,$req,$prep,$note,$approved,$purpose,$notess){
	//error_reporting(E_ALL);
	global $dbpo;
	$objResponse= new xajaxResponse();
	$sqlselect = "SELECT *FROM tblpo where po_no = '".$pono."' ";
	$result = $dbpo->query($sqlselect);
	//die($sqlselect);
	/*if($result->num_rows > 0){
		$objResponse->addAlert('PO No. is already exist.');
	}*/
	/*else {*/

		$sqlupdatepo = "UPDATE tblpo SET po_no = '".$pono."',po_name ='".addslashes($name)."' ,po_addr ='".addslashes($addr)."',po_date ='".($date)."',po_terms ='".($terms)."', date_modified= '".date("Y/m/d")."',reqby ='".($req)."',prepby ='".($prep)."',noteby ='".($note)."',approveby ='".($approved)."',purpose ='".($purpose)."',note ='".($notess)."' WHERE id = '".$id."' ";

		$sqlupdatepoitems = "UPDATE tblpo_items SET po_no = '".$pono."' WHERE po_id = '".$id."' ";

			if ($dbpo->query($sqlupdatepo) == TRUE){
				//$objResponse->addAlert('Plate Added Successfully.');
			}
			if ($dbpo->query($sqlupdatepoitems) == TRUE){

			}
			else{
			$objResponse->addAlert('Error');
			}
	

	/*}*/
	


		return $objResponse;
	}

	function updatepostatus($id){

	global $dbpo;
	$objResponse= new xajaxResponse();
	//$sqlselect = "SELECT *FROM tblpo where po_no = '".$pono."' ";
	//$result = $dbpo->query($sqlselect);
	//die($sqlselect);
	/*if($result->num_rows > 0){
		$objResponse->addAlert('PO No. is already exist.');
	}*/
	/*else {*/

		$sqlupdatepo = "UPDATE tblpo SET status = 0 WHERE id = '".$id."' ";

		//$sqlupdatepoitems = "UPDATE tblpo_items SET po_no = '".$pono."' WHERE po_id = '".$id."' ";

			if ($dbpo->query($sqlupdatepo) == TRUE){
				//$objResponse->addAlert('Plate Added Successfully.');
			}
			
			else{
			$objResponse->addAlert('Error');
			}
	

	/*}*/
	


		return $objResponse;

	}

	function insertpoitem($po_id,$pono,$desc,$qty,$up,$unit,$amount){
	//error_reporting(E_ALL);
	global $dbpo;
	$objResponse= new xajaxResponse();
	

		$sqlpoiteminsert = "INSERT INTO tblpo_items(po_id,po_no,po_qty,po_unit,po_desc,po_up,po_amount,date_modified,status)VALUES('".($po_id)."','".($pono)."','".($qty)."','".($unit)."','".addslashes($desc)."','".($up)."','".($amount)."','".date("Y/m/d")."','1')";
	//var_dump($sqlpoiteminsert);

			if ($dbpo->query($sqlpoiteminsert) == TRUE){
				//$objResponse->addAlert('Plate Added Successfully.');
			}
			else{
			$objResponse->addAlert('Error');
			}
	

		return $objResponse;
	}

	function updatepoitem($id,$pono,$desc,$qty,$up,$unit,$amount){
	//error_reporting(E_ALL);
	global $dbpo;
	$objResponse= new xajaxResponse();
	

		$sqlupdateitempo = "UPDATE tblpo_items SET po_qty = '".$qty."',po_unit ='".addslashes($unit)."' ,po_desc ='".addslashes($desc)."',po_up ='".($up)."',po_amount ='".($amount)."', date_modified= '".date("Y/m/d")."' WHERE id = '".$id."' ";

			if ($dbpo->query($sqlupdateitempo) == TRUE){
				//$objResponse->addAlert('Plate Added Successfully.');
			}
			else{
			$objResponse->addAlert('Error');
			}
	

		return $objResponse;
	}

	function updatepoitemstatus($id){
	//error_reporting(E_ALL);
	global $dbpo;
	$objResponse= new xajaxResponse();
	

		$sqlupdateitempo = "UPDATE tblpo_items SET status = '0' WHERE id = '".$id."' ";

			if ($dbpo->query($sqlupdateitempo) == TRUE){
				//$objResponse->addAlert('Plate Added Successfully.');
			}
			else{
			$objResponse->addAlert('Error');
			}
	

		return $objResponse;
	}



require("po.common.php");
$xajax->processRequests();
?>