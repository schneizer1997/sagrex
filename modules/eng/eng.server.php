<?php
include ('../../classes/inc/dbCon.php');

/*Maintenance Module*/

//Add request
function addrequestmaterial($mwrfid,$material,$qty,$unit,$shop,$dg,$checkby,$verified,$pt,$pn,$mwrfno,$rt,$rn,$amount,$isdelete){

	global $db;
	$objResponse= new xajaxResponse();


	$sqlmaterial = "INSERT INTO tblRequestMaterials(MWRFID,Materials,Quantity,
	UnitPrice,Shop,DateGrandted,CheckbyLogistics,Verified,PropertyType,PlateNo,
	MWRFNo,RequestType,RRNo,Amount,isdelete)VALUES('".$mwrfid."','".$material."',$qty,$unit,'".$shop."','".$dg."','".$checkby."','".$verified."','".$pt."','".$pn."','".$mwrfno."','".$rt."','".$rn."','".$amount."','".$isdelete."')" ;
					//die($sqlmaterial);
					//var_dump($sqlmaterial);
	if ($db->query($sqlmaterial) == TRUE){
		$objResponse->addAlert('Material Added Successfully.');
	}
	else{
		$objResponse->addAlert('Error');

						//die($db->query($sqlmaterial));

	}
	return $objResponse;
}
//create request
function createnewrequest($MWRFNo,$RequestType,$PlateNo,$wk,$wv,$jc,$rt,$pt,$it,
	$bt,$ctd,$tf,$df,$pd,$pc,$ca,$pa,$remarks,$rb,$dhm,$d1,$d2,$d3,$st,$sd,$ft,$fd,
	$reqrecby,$reqappby,$tor,$tmh,$wcb,$cmvb,
	$rrno,$dateadd,$dateedit,$mwrfstat,$requestor){
	global $db;

	$objResponse= new xajaxResponse();

	$combineDT = date('Y-m-d H:i:s',strtotime("$sd $st"));
				//$objResponse->addAlert('Inserted'.$combineDT);
	$sqlnewreq = "INSERT INTO tblrequestform(MWRFNo,RequestType,PlateNo,WorkType,WorkVenue,
	JobClassification,RepairType,PMType,ImprovementType,BreakdownType,CompletionTargetDate,TimeFile,DateFile,
	PropertyDescription,ProblemCause,CorrectiveAction,PreventiveAction,Remarks,RequestedBy,
	DepartmentHeadManager,Designated1,Designated2,Designated3,StartTime,StartDate,FinishTime,FinishDate,
	RequestReceivedBy,RequestApprovedBy,TypeOfRequest,TotalManHours,WarehouseCheckedBy,
	CompletedMWRFVerifiedBy,RRNo,DateAdded,DateEdited,MWRFStatus,Requestor,isdelete)VALUES
	('".$MWRFNo."','".$RequestType."','".$PlateNo."','".$wk."','".$wv."','".$jc."','".$rt."',
	'".$pt."','".$it."','".$bt."','".$ctd."','".$tf."','".$df."','".$pd."','".$pc."','".$ca."','".$pa."','".
	$remarks."','".$rb."','".$dhm."','".$d1."','".$d2."','".$d3."','".$combineDT."','".$sd."','".$ft."','".$fd."','".$reqrecby."',
	'".$reqappby."','".$tor."','".$tmh."','".$wcb."','".$cmvb."','".$rrno."','".$dateadd."','".$dateedit."',
	'".$mwrfstat."','".$requestor."',1)";

	if ($db->query($sqlnewreq) == TRUE){
				//$objResponse->addAlert('Request Successfully Added.');
	}
	else{
		error_reporting(E_ALL);
			/*$a=array($MWRFNo,$RequestType,$PlateNo,$wk,$wv,$jc,$rt,$pt,$it,
			$bt,$ctd,$tf,$df,$pd,$pc,$ca,$pa,$remarks,$rb,$dhm,$d1,$d2,$d3,$st,$sd,$ft,$fd,
			$reqrecby,$reqappby,$tor,$tmh,$wcb,$cmvb,
			$rrno,$dateadd,$dateedit,$mwrfstat,$requestor);
			print_r($a);*/
			$objResponse->addAlert('Error');
				//die($db->query($sqlmaterial));
		}

		return $objResponse;

	}
	//update data of request
	function updateformrequest($MWRFID,$MWRFNo,$RequestType,$PlateNo,$wk,$wv,$jc,$rt,$pt,
		$it,$bt,$ctd,$tf,$df,$pd,$pc,$remarks,$rb,$dhm,$d1,$d2,$d3,$st,$sd,$ft,$fd,
		$reqrecby,$reqappby,$tor,$tmh,$wcb,$cmvb,$rrno,$dateadd,$dateedit,$mwrfstat,$requestor){
		global $db;

		$objResponse= new xajaxResponse();

		$sqlformupdate = "UPDATE tblrequestform SET MWRFNo = '".$MWRFNo."', RequestType= '".$RequestType."',PlateNo = '".$PlateNo."',
		WorkType='".$wk."',WorkVenue='".$wv."',JobClassification='".$jc."',
		RepairType='".$rt."',PMType = '".$pt."',ImprovementType = '".$it."',
		BreakdownType='".$bt."',CompletionTargetDate = '".$ctd."',TimeFile = '".$tf."',
		DateFile='".$df."',PropertyDescription ='".$pd."',ProblemCause = '".$pc."',
		Remarks = '".$remarks."',RequestedBy = '".$rb."',
		DepartmentHeadManager='".$dhm."',Designated1='".$d1."',Designated2='".$d2."',
		Designated3='".$d3."',StartTime='".$st."',StartDate='".$sd."',
		FinishTime ='".$ft."',FinishDate = '".$fd."',RequestReceivedBy = 
		'".$reqrecby."',RequestApprovedBy='".$reqappby."',TypeOfRequest='".$tor."',
		TotalManHours='".$tmh."',WarehouseCheckedBy='".$wcb."',CompletedMWRFVerifiedBy =
		'".$cmvb."',RRNo='".$rrno."',
		DateAdded='".$dateadd."',DateEdited='".$dateedit."',MWRFStatus='".$mwrfstat."',
		Requestor='".$requestor."' WHERE MWRFID = '".$MWRFID."'";
		//$objResponse->addAlert('WEW.'. $d1);
		//die($sqlformupdate);

		if ($db->query($sqlformupdate) == TRUE){
				//$objResponse->addAlert('Request Successfully Updated.');
		}
		else{
			error_reporting(E_ALL);
			$objResponse->addAlert('Error');
		}

		return $objResponse;

	}
	//update verification of material
	function materialverification($materialid,$verified){
		global $db;
		$objResponse= new xajaxResponse();

		$sqlver = "UPDATE tblRequestMaterials SET Verified = '".$verified."' WHERE MaterialsID = '".$materialid."' ";

		if ($db->query($sqlver) == TRUE){
			$objResponse->addAlert('Successfully Updated.');
		}
		else{

			$objResponse->addAlert('Error');

		}

		return $objResponse;

	}
	//update data of material
	function updatematerial($materialid,$material,$qty){
		global $db;
		$objResponse= new xajaxResponse();

		$sqlupdate = "UPDATE tblRequestMaterials SET Materials='".$material."',
		Quantity='".$qty."' WHERE MaterialsID='".$materialid."'";


		if ($db->query($sqlupdate) == TRUE){
			$objResponse->addAlert('Successfully Updated.');
		}
		else{

			$objResponse->addAlert('Error');

		}

		return $objResponse;
	}
	//delete material in maintenance
	function deletematerial($materialid){
		global $db;
		$objResponse= new xajaxResponse();

		$sqldelete = "UPDATE tblRequestMaterials SET isdelete = 0 WHERE MaterialsID = 
		'".$materialid."'";

		if ($db->query($sqldelete) == TRUE){
			$objResponse->addAlert('Successfully Deleted.');
		}
		else{

			$objResponse->addAlert('Error');


		}

		return $objResponse;


	}

	/*Purchasing Module*/

	//update credential in purchasing
	function updatecredentials($materialid,$material,$qty,$unit,$amount,$dategranted,$shop,$tt){
		global $db;
		$objResponse = new xajaxResponse();
		$sqlcredential = "UPDATE tblRequestMaterials SET UnitPrice='".$unit."',Amount='".$amount."',
		Shop='".$shop."',DateGrandted='".$dategranted."',RequestType='".$tt."' WHERE MaterialsID = 
		'".$materialid."' ";

		if ($db->query($sqlcredential) == TRUE){
			$objResponse->addAlert('Updated Successfully');
		}
		else{
				//die($db->query($sqlnewreq));

			$objResponse->addAlert('Error');

						//die($db->query($sqlmaterial));
		}

		return $objResponse;

	}
	function shopinsert($refname,$shopname){
		global $db;
		$objResponse = new xajaxResponse();
		$sqlcheckvalue = "SELECT *FROM tbladdnewshop WHERE ShopName = '".$shopname."' OR ReferenceName = '".$refname."'";
		$result = $db->query($sqlcheckvalue);
		if ($result->num_rows > 0 ){
			$objResponse->addAlert('Shop/Reference name is already exist.');
		}
		else {
			$sql = "INSERT INTO tbladdnewshop(ReferenceName,ShopName,isdelete)VALUES('".$refname."','".$shopname."',1)";

			if ($db->query($sql) == TRUE){
				$objResponse->addAlert('Added Successfully');
			}
			else{

				$objResponse->addAlert('Error');

			}
		}
		

		return $objResponse;
	}
	function shopupdate($sid,$refname,$shopname){
		global $db;
		$objResponse = new xajaxResponse();
		$sql = "UPDATE tbladdnewshop SET ReferenceName = '".$refname."',
		ShopName = '".$shopname."' WHERE ID = '".$sid."' ";

		if ($db->query($sql) == TRUE){
			$objResponse->addAlert('Updated Successfully');
		}
		else{

			$objResponse->addAlert('Error');

		}

		return $objResponse;
	}

	/*Warehouse Module*/

	//update status warehouse
	function updatestatus($materialid,$rrno,$status){
		global $db;
		$objResponse = new xajaxResponse();
		$sqlstatus = "UPDATE tblrequestmaterials SET RRNo = '".$rrno."', 
		CheckByLogistics = '".$status."' WHERE MaterialsID= '".$materialid."' ";
		if ($db->query($sqlstatus) == TRUE){
			$objResponse->addAlert('Material has been updated.');
		}
		else{

			$objResponse->addAlert('Error');

		}

		return $objResponse;

	}
	function updatestatusall($mwrfid,$rrno,$status){
		global $db;
		$objResponse = new xajaxResponse();
		$sqlstatusall = "UPDATE tblrequestmaterials SET RRNo = '".$rrno."', 
		CheckByLogistics = '".$status."' WHERE MWRFID= '".$mwrfid."' ";
		if ($db->query($sqlstatusall) == TRUE){
			//$objResponse->addAlert('Material has been updated.');
		}
		else{

			$objResponse->addAlert('Error');

		}

		return $objResponse;
	}
	function updateisdelete($materialid,$isdelete){
		global $db;
		$objResponse = new xajaxResponse();
		$sqlisdelete = "UPDATE tblrequestmaterials SET isdelete = '".$isdelete."' WHERE MaterialsID= '".$materialid."' ";
		if ($db->query($sqlisdelete) == TRUE){
			//$objResponse->addAlert('sdsdsd has been updated.');
		}
		else{

			$objResponse->addAlert('Error');

		}

		return $objResponse;

	}
	//update checkby warehouse
	function updatewcb($mwrfid,$wcb){
		global $db;
		$objResponse = new xajaxResponse();
		$sqlwcb = "UPDATE tblrequestform SET WarehouseCheckedBy = '".$wcb."' WHERE MWRFID = '".$mwrfid."'";

		if ($db->query($sqlwcb) == TRUE){
			//$objResponse->addAlert('Material has been updated.');
		}
		else{
			$objResponse->addAlert('Error');


		}

		return $objResponse;


	}
	function loginmaint($username,$pass){
		global $db;
		$objResponse = new xajaxResponse();
		$sqlmaint = "SELECT *FROM users WHERE username = '".$username."' AND password = '".$pass."' ";
		die($db->query($sqlmaint));

		return $db->query($sqlmaint);
		return $objResponse;

	}

	function archiveinsert($dept,$act,$datetransc){
		global $db;
		$objResponse= new xajaxResponse();

		$sqlarch = "INSERT INTO archive(department,action,datetransact,isdelete)VALUES('".$dept."','".$act."','".$datetransc."',1)";
		if ($db->query($sqlarch) == TRUE){
			//$objResponse->addAlert('archived');
		}
		else{

			$objResponse->addAlert('Error');
		}

		return $objResponse;
	}
	function wew($wew,$dateadd){
		global $db;
		$objResponse= new xajaxResponse();

		$dateadd =strtotime($dateadd);

		$objResponse->addAlert('insert'.date('Y-m-d',$dateadd));
		$sqlsample = "INSERT INTO sample(wew,dateadd)VALUES('".$wew."',$dateadd)";
		if ($db->query($sqlsample) == TRUE){
			$objResponse->addAlert('Inserted');
		}
		else{

			$objResponse->addAlert('Error');

		}

		return $objResponse;
	}
		//this function only alert
	function loadmaterials($mwrf){
		global $db;
		$objResponse= new xajaxResponse();

		$sql = "SELECT Materials,Quantity FROM tblRequestMaterials WHERE MWRFID = 
		'".$mwrf."' AND isdelete = 1 LIMIT 3";
		$result=$db->query($sql);

		if ($result->num_rows > 0 ){
			while ($row=$result->fetch_assoc()){
				echo '<tr>';
				echo '<td>'.$row['Materials'].'</td>';
				echo '<td>'.$row['Quantity'].'</td>';
				echo '</tr>';	
			}
		}
		return $objResponse;
	}

	/*Closed MWRF Module*/

	function insertclosed($mwrfid){
		global $db;
		$objResponse= new xajaxResponse();

		$sql = "UPDATE tblrequestform SET MWRFStatus = 'CLOSED' WHERE MWRFID = 
		'".$mwrfid."'";
		//$result=$db->query($sql);
		if ($db->query($sql) == TRUE){
			$objResponse->addAlert('Successfully Closed MWRF.');
		}
		else{

			$objResponse->addAlert('Error');

		}

		return $objResponse;
	}
	function insertclosedarchive($dept,$act,$datetransc){
		global $db;
		$objResponse= new xajaxResponse();

		$sqlarch = "INSERT INTO archive(department,action,datetransact,isdelete)VALUES('".$dept."','".$act."','".$datetransc."',1)";
		if ($db->query($sqlarch) == TRUE){
			//$objResponse->addAlert('archived');
		}
		else{

			$objResponse->addAlert('Error');
		}

		return $objResponse;
	}
	require("eng.common.php");
	$xajax->processRequests();
	?>