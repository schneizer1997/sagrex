<?php
include('../../../classes/inc/dbCon.php');


function updatesample($plate_id,$platenos){
	global $dbpurchasing;
	//$matid = $_GET['matid'];
	//die($addr_id);
	$objResponse = new xajaxResponse();
	$sqlupdate = "UPDATE plates SET plate_no = '".$platenos."' WHERE plate_id = $plate_id AND status = 1 ";
	$result = $dbpurchasing->query($sqlupdate);

	if ($dbinv->query($sqlupdate) == TRUE){
		$objResponse->addAlert('RR Updated Successfully.');
	}
	else{
		//$objResponse->addAlert('Not found RRNo.');
	}
	return $objResponse;
}
function updateplate($plate_id,$platenos){
	global $dbpurchasing;
	//$sqlplateupdate = "";
	$objResponse= new xajaxResponse();
	$sqlselect = "SELECT *FROM plates WHERE plate_no = '".$platenos."' AND status = 1";
	$result = $dbpurchasing->query($sqlselect);
	if($result->num_rows > 0){
		$objResponse->addAlert('Plate No. is already exist.');
	}
	else {
		
		$sqlplateupdate = "UPDATE plates SET plate_no = '".$platenos."' WHERE plate_id = $plate_id AND status = 1 ";
		if ($dbpurchasing->query($sqlplateupdate) == TRUE){
			$objResponse->addAlert('Plate Updated Successfully.');
		}
		else{
			$objResponse->addAlert('Error');
		}


	}


	return $objResponse;
}

function insertsample(){
	global $dbpurchasing;
	$sqlplateinsert = "";
	$objResponse= new xajaxResponse();
	//$/*sqlselect = "SELECT *FROM plates where plate_no = '".$platenos."'";
	//$result = $dbpurchasing->query($sqlselect);
	//die($sqlselect);
	/*if($result->num_rows > 0){
		//$objResponse->addAlert('Plate No. is already exist.');
	}*/
	//else {
	$sqlplateinsert = "INSERT INTO plates(plate_no,status)VALUES('asdas','1')";
	//die($sqlrrinsert);
	if ($dbpurchasing->query($sqlplateinsert) == TRUE){
		$objResponse->addAlert('Plate Added Successfully.');
	}
	else{
			//$objResponse->addAlert('Error');
	}
	//}
	
	return $objResponse;
}

require("admin.common.php");
$xajax->processRequests();
?>