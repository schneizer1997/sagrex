<?php
include ('../../classes/inc/dbCon.php');
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
				CompletedMWRFVerifiedBy,RRNo,DateAdded,DateEdited,MWRFStatus,Requestor)VALUES
				('".$MWRFNo."','".$RequestType."','".$PlateNo."','".$wk."','".$wv."','".$jc."','".$rt."',
				'".$pt."','".$it."','".$bt."','".$ctd."','".$tf."','".$df."','".$pd."','".$pc."','".$ca."','".$pa."','".
				$remarks."','".$rb."','".$dhm."','".$d1."','".$d2."','".$d3."','".$combineDT."','".$sd."','".$ft."','".$fd."','".$reqrecby."',
				'".$reqappby."','".$tor."','".$tmh."','".$wcb."','".$cmvb."','".$rrno."','".$dateadd."','".$dateedit."',
				'".$mwrfstat."','".$requestor."')";

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
	function updateformrequest($MWRFID,$MWRFNo,$RequestType,$PlateNo,$wk,$wv,$jc,$rt,$pt,
		$it,$bt,$ctd,$tf,$df,$pd,$pc,$ca,$pa,$remarks,$rb,$dhm,$d1,$d2,$d3,$st,$sd,$ft,$fd,
		$reqrecby,$reqappby,$tor,$tmh,$wcb,$cmvb,$rrno,$dateadd,$dateedit,$mwrfstat,$requestor){
		global $db;

		$objResponse= new xajaxResponse();

		$sqlformupdate = "UPDATE tblrequestform SET MWRFNo = '".$MWRFNo."', RequestType= '".$RequestType."',PlateNo = '".$PlateNo."',
		WorkType='".$wk."',WorkVenue='".$wv."',JobClassification='".$jc."',
		RepairType='".$rt."',PMType = '".$pt."',ImprovementType = '".$it."',
		BreakdownType='".$bt."',CompletionTargetDate = '".$ctd."',TimeFile = '".$tf."',
		DateFile='".$df."',PropertyDescription ='".$pd."',ProblemCause = '".$pc."',
		CorrectiveAction='".$pa."',Remarks = '".$remarks."',RequestedBy = '".$rb."',
		DepartmentHeadManager='".$dhm."',Designated1='".$d1."',Designated2='".$d2."',
		Designated1='".$d3."',StartTime='".$st."',StartDate='".$sd."',
		FinishTime ='".$ft."',FinishDate = '".$fd."',RequestReceivedBy = 
		'".$reqrecby."',RequestApprovedBy='".$reqappby."',TypeOfRequest='".$tor."',
		TotalManHours='".$tmh."',WarehouseCheckedBy='".$wcb."',CompletedMWRFVerifiedBy =
		'".$cmvb."',RRNo='".$rrno."',
		DateAdded='".$dateadd."',DateEdited='".$dateedit."',MWRFStatus='".$mwrfstat."',
		Requestor='".$requestor."' WHERE MWRFID = '".$MWRFID."'";


			if ($db->query($sqlformupdate) == TRUE){
				//$objResponse->addAlert('Request Successfully Updated.');
			}
			else{
				error_reporting(E_ALL);
			$objResponse->addAlert('Error');
		}

		return $objResponse;

	}
	function materialverification($materialid,$verified){
		global $db;
		$objResponse= new xajaxResponse();

		$sqlver = "UPDATE tblRequestMaterials SET Verified = '".$verified."' WHERE MaterialsID = '".$materialid."' ";

		if ($db->query($sqlver) == TRUE){
			$objResponse->addAlert('Successfully Updated.');
		}
		else{

			//die($db->query($sqlnewreq));
			$objResponse->addAlert('Error');
			//die($db->query($sqlmaterial));

		}

		return $objResponse;

	}

	function updatematerial($materialid,$material,$qty){
		global $db;
		$objResponse= new xajaxResponse();

		$sqlupdate = "UPDATE tblRequestMaterials SET Materials='".$material."',
		Quantity='".$qty."' WHERE MaterialsID='".$materialid."'";


		if ($db->query($sqlupdate) == TRUE){
			$objResponse->addAlert('Successfully Updated.');
		}
		else{

			//die($db->query($sqlnewreq));
			$objResponse->addAlert('Error');
			//die($db->query($sqlmaterial));

		}

		return $objResponse;
	}
	function deletematerial($materialid){
		global $db;
		$objResponse= new xajaxResponse();

		$sqldelete = "UPDATE tblRequestMaterials SET isdelete = 0 WHERE MaterialsID = 
		'".$materialid."'";

		if ($db->query($sqldelete) == TRUE){
			$objResponse->addAlert('Successfully Deleted. Click Reload to view');
		}
		else{
				//die($db->query($sqlnewreq));

			$objResponse->addAlert('Error');

						//die($db->query($sqlmaterial));

		}

		return $objResponse;


	}
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
	function updatestatus($materialid,$rrno,$status){
		global $db;
		$objResponse = new xajaxResponse();
		$sqlstatus = "UPDATE tblrequestmaterials SET RRNo = '".$rrno."', 
		CheckByLogistics = '".$status."' WHERE MaterialsID= '".$materialid."' ";
		if ($db->query($sqlstatus) == TRUE){
			$objResponse->addAlert('Material has been updated.');
		}
		else{
				//die($db->query($sqlnewreq));

			$objResponse->addAlert('Error');

						//die($db->query($sqlmaterial));

		}

		return $objResponse;

	}
	function updatewcb($mwrfid,$wcb){
		global $db;
		$objResponse = new xajaxResponse();
		$sqlwcb = "UPDATE tblrequestform SET WarehouseCheckedBy = '".$wcb."' WHERE MWRFID = '".$mwrfid."'";

		if ($db->query($sqlwcb) == TRUE){
			//$objResponse->addAlert('Material has been updated.');
		}
		else{
				//die($db->query($sqlnewreq));

			$objResponse->addAlert('Error');

						//die($db->query($sqlmaterial));

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
				//die($db->query($sqlnewreq));

			$objResponse->addAlert('Error');

				//die($db->query($sqlmaterial));
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
				//die($db->query($sqlnewreq));

			$objResponse->addAlert('Error');

						//die($db->query($sqlmaterial));

		}

		return $objResponse;
	}
		//this function only alert
	function loadmaterials($mwrf){
		global $db;
		$objResponse= new xajaxResponse();

		$sql = "SELECT Materials,Quantity FROM tblRequestMaterials WHERE MWRFID = 
		'".$mwrf."' LIMIT 3";
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


	require("sales.common.php");
	$xajax->processRequests();
	?>