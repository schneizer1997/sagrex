<?php
include('../../../classes/inc/dbCon.php');
//RR
function insertrr($rrno,$vendor_id,$addr_id,$clientdate,$ref,$pers_id_ware,$pers_id_dept){
	global $dbinv;
	$objResponse= new xajaxResponse();
	$sqlselect = "SELECT *FROM rrinfo where rrno = '".$rrno."'";
	$result = $dbinv->query($sqlselect);
	//die($sqlselect);
	if($result->num_rows > 0){
		//$objResponse->addAlert('RRNo has already exist.');
	}
	else {
		$sqlrrinsert = "INSERT INTO rrinfo(rrno,vendor_id,addr_id,client_date,reference,pers_id_ware,pers_id_dept,DateCreated,isdelete)VALUES('".$rrno."',$vendor_id,$addr_id,'".$clientdate."','".$ref."',$pers_id_ware,$pers_id_dept,'".date('Y-m-d')."','1')";
	//die($sqlrrinsert);
		if ($dbinv->query($sqlrrinsert) == TRUE){
			//$objResponse->addAlert('RR Added Successfully.');
		}
		else{
			$objResponse->addAlert('Error insertrr');
		}
	}
	
	return $objResponse;
}
function updaterrinfo($rrno,$vendor_id,$addr_id,$clientdate,$ref,$pers_id_ware,$pers_id_dept){
	global $dbinv;
	//$matid = $_GET['matid'];
	//die($addr_id);
	$objResponse = new xajaxResponse();
	$sqlupdate = "UPDATE rrinfo SET vendor_id = $vendor_id, addr_id = $addr_id,client_date = '".$clientdate."',reference = '".$ref."',pers_id_ware = $pers_id_ware, pers_id_dept = $pers_id_dept WHERE rrno = $rrno and isdelete = 1";
	$result = $dbinv->query($sqlupdate);

	if ($dbinv->query($sqlupdate) == TRUE){
		//$objResponse->addAlert('RR Updated Successfully.');
	}
	else{
		//$objResponse->addAlert('Not found RRNo.');
	}
	return $objResponse;
}
function insertaddr($addr_name){
	global $dbinv;
	$objResponse = new xajaxResponse();
	$sqlinsert = "INSERT INTO tbladdress(addr_name,category_id,category_name,isdelete)VALUES('".$addr_name."',1,'rr',1)";
	if ($dbinv->query($sqlinsert) == TRUE){
		//$objResponse->addAlert('Material Added Successfully.');
	}
	else{
		$objResponse->addAlert('Error insertaddr');
	}
	return $objResponse;
}
function insertcustomer($cust_name){
	global $dbinv;
	$objResponse = new xajaxResponse();
	$sqlinsert = "INSERT INTO tblcustomer(cust_name,isdelete)VALUES('".$cust_name."',1)";
	if ($dbinv->query($sqlinsert) == TRUE){
		//$objResponse->addAlert('Material Added Successfully.');
	}
	else{
		$objResponse->addAlert('Error insertcustomer');
	}
	return $objResponse;
}
function insertrrqty($mwrf_mat_id,$mwrf_req_id,$rrno,$qty){
	global $dbinv;
	$objResponse = new xajaxResponse();
	/*$sqlselect = "SELECT *FROM tblmaterialsrr where rrno = '".$rrno."'";
	$result = $dbinv->query($sqlselect);
	//die($sqlselect);
	if($result->num_rows > 0){
		//$objResponse->addAlert('SIS No has already exist.');
	}*/
	/*else {*/
		$sqlinsert = "INSERT INTO tblmaterialsrr(mwrf_mat_id,mwrf_req_id,rrno,qty,isdelete)VALUES('".$mwrf_mat_id."','".$mwrf_req_id."','".$rrno."','".$qty."',1)";
		//var_dump($sqlinsert);
		if ($dbinv->query($sqlinsert) == TRUE){
		//$objResponse->addAlert('Material Added Successfully.');
		}
		else{
			$objResponse->addAlert('Error insertrrqty');
		}
		/*}*/
		
		return $objResponse;
	}
	function updatemwrfrrno($mwrf_mat_id,$rrno){
		global $db;
		$objResponse = new xajaxResponse();
		$sqlselect = "SELECT *FROM tblrequestmaterials WHERE MaterialsID = '".$mwrf_mat_id."'";
		$result = $db->query($sqlselect);
	//die($sqlselect);
		if($result->num_rows > 0){
			while ($row=$result->fetch_assoc()){
				$rrnos = $row['RRNo'];
				if ($rrnos == ""){
					$sqlupdate = "UPDATE tblrequestmaterials SET RRNo = '".$rrno."', CheckByLogistics = 1 WHERE MaterialsID = '".$mwrf_mat_id."' AND isdelete = 2 OR MaterialsID = '".$mwrf_mat_id."' AND isdelete = 1";
					if ($db->query($sqlupdate) == TRUE){
		//$objResponse->addAlert('Update Successfully.');
					}
					else{
						$objResponse->addAlert('Error updatemwrfrrno');
					}
				}
			}
		}



		return $objResponse;

	}
	function updatemwrfrrqty($mat_rr_id,$qty){
		global $dbinv;
		$objResponse = new xajaxResponse();
		/*$sqlselect = "SELECT *FROM sisinfo where rrno = '".$rrno."' AND issued_nos = '".$issued_nos."'";
		$result = $dbinv->query($sqlselect);
	//die($sqlselect);
		if($result->num_rows > 0){
		//$objResponse->addAlert('SIS has already exist.');
		}
		else{*/
			$sqlupdate = "UPDATE tblmaterialsrr SET qty = '".$qty."' WHERE mat_rr_id = '".$mat_rr_id."'";
	//die($sqlupdate);
			if ($dbinv->query($sqlupdate) == TRUE){
			//$objResponse->addAlert('SIS Added Successfully.');
			}
			else{
				$objResponse->addAlert('Error updatemwrfrrqty');
			}
			/*}*/

			return $objResponse;
		}
	function deletemwrfrr($mat_rr_id){
		global $dbinv;
		$objResponse = new xajaxResponse();
		/*$sqlselect = "SELECT *FROM sisinfo where rrno = '".$rrno."' AND issued_nos = '".$issued_nos."'";
		$result = $dbinv->query($sqlselect);
	//die($sqlselect);
		if($result->num_rows > 0){
		//$objResponse->addAlert('SIS has already exist.');
		}
		else{*/
			$sqlupdate = "UPDATE tblmaterialsrr SET isdelete = 0 WHERE mat_rr_id = '".$mat_rr_id."'";
	//die($sqlupdate);
			if ($dbinv->query($sqlupdate) == TRUE){
			//$objResponse->addAlert('SIS Added Successfully.');
			}
			else{
				$objResponse->addAlert('Error updatemwrfrrqty');
			}
			/*}*/

			return $objResponse;
	}
// SIS
		function insertsis($rrno,$cust_id,$addr_id,$issued_date,$issued_nos,$location,$reference,$remarks,$prepby,$recby,$noteby){
			global $dbinv;
			$objResponse = new xajaxResponse();
			$sqlselect = "SELECT *FROM sisinfo where rrno = '".$rrno."' AND issued_nos = '".$issued_nos."'";
			$result = $dbinv->query($sqlselect);
	//die($sqlselect);
			if($result->num_rows > 0){
		//$objResponse->addAlert('SIS has already exist.');
			}
			else{
				$sqlinsert = "INSERT INTO sisinfo(rrno,cust_id,addr_id,issued_date,issued_nos,location,reference,remarks,DateCreated,isdelete,preparedby_id,receivedby_id,notedby_id)VALUES('".$rrno."','".$cust_id."','".$addr_id."','".$issued_date."','".$issued_nos."','".$location."','".$reference."','".$remarks."','".date('Y-m-d')."',1,'".$prepby."','".$recby."','".$noteby."')";
	//die($sqlrrinsert);
				if ($dbinv->query($sqlinsert) == TRUE){
			//$objResponse->addAlert('SIS Added Successfully.');
				}
				else{
					$objResponse->addAlert('Error insertsis');
				}
			}

			return $objResponse;

		}
		function insertsisqty($mwrf_mat_id,$mwrf_req_id,$sisno,$rrno,$qty){		
			global $dbinv;
			$objResponse = new xajaxResponse();
	/*$sqlselect = "SELECT *FROM tblmaterialsis where rrno = '".$rrno."' AND mwrf_mat_id = '".$mwrf_mat_id."'";
	$result = $dbinv->query($sqlselect);
	if($result->num_rows > 0){
	}
	else {*/
		$sqlinsert = "INSERT INTO tblmaterialsis(mwrf_mat_id,mwrf_req_id,sisno,rrno,qty,isdelete)VALUES('".$mwrf_mat_id."','".$mwrf_req_id."','".$sisno."','".$rrno."','".$qty."',1)";
		//var_dump($sqlinsert);
		if($dbinv->query($sqlinsert) == TRUE){
		//$objResponse->addAlert('SIS successfully');
		}
		else {
			$objResponse->addAlert('Error insertsisqty');
		}
	//}

	//die($objResponse);
		return $objResponse;

	}

	function updatesisinfo($rrno,$cust_id,$addr_id,$issued_date,$location,$issued_nos,$reference,$remarks){
		global $dbinv;
		$objResponse = new xajaxResponse();
		$sqlupdate = "UPDATE sisinfo SET cust_id = $cust_id,addr_id = $addr_id,issued_date = '".$issued_date."',location = '".$location."',reference = '".$reference."',remarks = '".$remarks."',DateModified = '".date('Y-m-d')."' where rrno = '".$rrno."' AND issued_nos = '".$issued_nos."' AND isdelete = 1";
	//var_dump($sqlupdate);
		if($dbinv->query($sqlupdate) == TRUE){
			//$objResponse->addAlert('SIS successfully updated');
		}
		else {
			$objResponse->addAlert('Error updatesisinfo');
		}
	//die($objResponse);
		return $objResponse;
	}
	function updatesisqty($mwrf_mat_id,$sisno,$qty,$rrno){

		global $dbinv;
		$objResponse = new xajaxResponse();
		$sqlupdate = "UPDATE tblmaterialsis SET qty = '".$qty."' WHERE sisno = '".$sisno."' AND mwrf_mat_id = $mwrf_mat_id AND rrno = '".$rrno."'";

		if($dbinv->query($sqlupdate) == TRUE){
		//$objResponse->addAlert('SIS successfully updated');
		}
		else {
			$objResponse->addAlert('Error updatesisqty');
		}
	//die($objResponse);
		return $objResponse;

	}
// ITEMS
	function insertitemtemp($myid,$desc,$unit){
		global $dbinv;
		$objResponse = new xajaxResponse();
		$sqlselect = "SELECT *FROM item_temp where item_id = '".$myid."'";
		$result = $dbinv->query($sqlselect);
		if($result->num_rows > 0){
			$objResponse->addAlert('Item is already added.');
		}
		else {
			$sqlinsert = "INSERT INTO item_temp(item_id,description,unit)VALUES($myid,'".$desc."','".$unit."')";

			if($dbinv->query($sqlinsert) == TRUE){
				$objResponse->addAlert('Item successfully added');
			}
			else {
				$objResponse->addAlert('Error insertitemtemp');
			}
		}

		return $objResponse;
	}
	function insertitemperma($myid,$rrno){
		global $dbinv;
		$objResponse = new xajaxResponse();
		$sqlselect = "SELECT *FROM tblitemsrr WHERE item_id = '".$myid."' AND rrno = '".$rrno."' ";
		$result = $dbinv->query($sqlselect);
		if($result->num_rows > 0){
			$objResponse->addAlert('Item is already added.');
		}
		else {
			$sqlinsert = "INSERT INTO tblitemsrr(item_id,rrno,qty,isdelete,date_rr)VALUES('".$myid."','".$rrno."','',1,'".date('Y-m-d')."')";
			//die($sqlinsert);

			if($dbinv->query($sqlinsert) == TRUE){
				$objResponse->addAlert('Item successfully added');
			}
			else {
				$objResponse->addAlert('Error insertitemperma');
			}
		}

		return $objResponse;
	}
	function deleteitemtemp($temp_id){
		global $dbinv;
		$objResponse = new xajaxResponse();
		$sqldelete = "DELETE FROM item_temp WHERE temp_id = '".$temp_id."'";

		if($dbinv->query($sqldelete) == TRUE){
			//$objResponse->addAlert('Item successfully removed');
		}
		else {
			$objResponse->addAlert('Error deleteitemtemp');
		}
		return $objResponse;
	}
	function deleteitemperm($itemrr_id,$balance,$item_id){
		global $dbinv;
		$objResponse = new xajaxResponse();
		$sql = "SELECT *FROM item WHERE MyID = '".$item_id."' ";
		$result=$dbinv->query($sql);
		$c=0;
		//var_dump($balance);
		/*if ($balance == "" || $balance == 0){

		}
		else if($balance > 0){

		}	*/
		if ($result->num_rows > 0){
			while ($row=$result->fetch_assoc()){
				$currbalance = $row['Balance']; //
				(double)$newbal = (double)$currbalance - (double)$balance;
				//$newbalplus = (double)$bal + (double)$balance;
				//var_dump("currbalance".$currbalance);
				$sqldelete = "DELETE FROM tblitemsrr WHERE itemrr_id ='".$itemrr_id."' ";
				$sqlupdate = "UPDATE item SET Balance = '".$newbal."' WHERE MyID = '".$item_id."'";
				$sqlinsert = "INSERT INTO tblitembalancearchive(item_id,balance,time_created)VALUES($item_id,'".$currbalance."','".date('Y-m-d H:i:s')."')";
				//var_dump($sqlinsert);
				if($dbinv->query($sqlinsert) == TRUE){
			//$objResponse->addAlert('Item successfully insert archive');
				}
				//var_dump("newbal".$newbal);

				if($dbinv->query($sqlupdate) == TRUE){
					//$objResponse->addAlert('Item successfully update');
				}
				if($dbinv->query($sqldelete) == TRUE){
					//$objResponse->addAlert('Item successfully removed');
				}
				else {
					$objResponse->addAlert('Error deleteitemperm');
				}
			}
		}

		return $objResponse;
	}
	//New item
	function insertnewitem($description,$unit,$types,$classes){
		global $dbinv;
		$objResponse = new xajaxResponse();
		$sqlselect = "SELECT *FROM item WHERE Description = UPPER('".$description."')";
		$result = $dbinv->query($sqlselect);
		if($result->num_rows > 0){
			$objResponse->addAlert('Item is already added.');
		}
		else {
			$sqlinsert = "INSERT INTO item(TimeCreated,Description,UnitOfMeasureSetRefFullName,item_type,item_class)VALUES('".date('Y-m-d')."',UPPER('".$description."'),'".$unit."','".$types."','".$classes."') ";

			if($dbinv->query($sqlinsert) == TRUE){
				$objResponse->addAlert('Item successfully added');
			}
			else {
				$objResponse->addAlert('Error insertnewitem');
			}
		}
		
		return $objResponse;
	}
	function updatenewitem($myid,$description,$unit,$types,$classes){
		global $dbinv;
		$objResponse = new xajaxResponse();
		$sqlupdate = "UPDATE item SET Description = '".$description."', UnitOfMeasureSetRefFullName = '".$unit."',item_type = '".$types."', item_class = '".$classes."' WHERE MyID = '".$myid."'";
		//var_dump($sqlupdate);
		if($dbinv->query($sqlupdate) == TRUE){
			$objResponse->addAlert('Item successfully updated');
		}
		else {
			$objResponse->addAlert('Error updatenewitem');
		}
		return $objResponse;
	}
	function deletenewitem($MyID){
		global $dbinv;
		$objResponse = new xajaxResponse();
		$sqlupdate = "DELETE FROM item WHERE MyID=$MyID";

		if($dbinv->query($sqlupdate) == TRUE){
			//$objResponse->addAlert('Item successfully updated');
		}
		else {
			$objResponse->addAlert('Error deletenewitem');
		}
		return $objResponse;
	}
	function removeallitem($rrno){
		global $dbinv;
		$objResponse = new xajaxResponse();
		$sqlupdate = "DELETE FROM tblitemsrr WHERE rrno = '".$rrno."' ";

		if($dbinv->query($sqlupdate) == TRUE){
			//$objResponse->addAlert('Item successfully updated');
		}
		else {
			$objResponse->addAlert('Error removeallitem');
		}
		return $objResponse;
	}
	function deselectallitem(){
		global $dbinv;
		$objResponse = new xajaxResponse();
		$sqltruncate = "TRUNCATE TABLE item_temp";

		if($dbinv->query($sqltruncate) == TRUE){
			//$objResponse->addAlert('Item successfully updated');
		}
		else {
			$objResponse->addAlert('Error deselectallitem');
		}
		return $objResponse;
	}
	function insertitemrr($item_id,$rrno,$qty){
		global $dbinv;
		$objResponse = new xajaxResponse();
		$sqlselect ="SELECT *FROM tblitemsrr WHERE item_id = '".$item_id."' AND rrno = '".$rrno."'";
		$result=$dbinv->query($sqlselect);
		$c=0;
		if ($result->num_rows > 0){
			$objResponse->addAlert('Item ID '.$item_id.' with RRNO '.$rrno.' is already exist.');
		}
		else {
			$sqlinsert = "INSERT INTO tblitemsrr(item_id, rrno,qty,isdelete,date_rr)VALUES('".$item_id."','".$rrno."','".(double)$qty."',1,'".date('Y-m-d')."')";

			if($dbinv->query($sqlinsert) == TRUE){
				$objResponse->addAlert('Successfully saved.');
			}
			else {
				$objResponse->addAlert('Error insertitemrr');
			}
		}

		
		return $objResponse;
	}
	function updateitembalance($item_id,$balance){
		global $dbinv;
		$sql = "SELECT *FROM item WHERE MyID = '".$item_id."' ";
		$objResponse = new xajaxResponse();
		$result=$dbinv->query($sql);
		$c=0;
		if ($result->num_rows > 0){
			while ($row=$result->fetch_assoc()){
				$bal = $row['Balance'];
				$newbal = (double)$bal + (double)$balance;
				$sqlupdate = "UPDATE item SET Balance = '".$newbal."' WHERE MyID = '".$item_id."'";
				$sqltruncate = "TRUNCATE TABLE item_temp";
				$sqlinsert = "INSERT INTO tblitembalancearchive(item_id,balance,time_created)VALUES($item_id,'".$bal."','".date('Y-m-d H:i:s')."')";
				//var_dump($sqlinsert);
				if($dbinv->query($sqlinsert) == TRUE){
			//$objResponse->addAlert('Item successfully insert archive');
				}
				if($dbinv->query($sqlupdate) == TRUE){
			//$objResponse->addAlert('Item successfully insert');
				}
				if($dbinv->query($sqltruncate) == TRUE){
			//$objResponse->addAlert('Item successfully insert');
				}
				else {
					$objResponse->addAlert('Error updateitembalance');
				}
			}
		}
		return $objResponse;
	}
	function insertitemrrinfo($rrno,$vendor_id,$addr_id,$clientdate,$ref,$pers_id_ware,$pers_id_dept){
		global $dbinv;
		$objResponse= new xajaxResponse();
		$sqlselect = "SELECT *FROM rrinfo where rrno = '".$rrno."'";
		$result = $dbinv->query($sqlselect);
	//die($sqlselect);
		if($result->num_rows > 0){
			$objResponse->addAlert('RRNo has already exist.');
		}
		else {
			$sqlrrinsert = "INSERT INTO rrinfo(rrno,vendor_id,addr_id,client_date,reference,pers_id_ware,pers_id_dept,DateCreated,isdelete)VALUES('".$rrno."',$vendor_id,$addr_id,'".$clientdate."','".$ref."',$pers_id_ware,$pers_id_dept,'".date('Y-m-d')."','1')";
	//die($sqlrrinsert);
			if ($dbinv->query($sqlrrinsert) == TRUE){
				$objResponse->addAlert('RR Added Successfully.');
			}
			else{
				$objResponse->addAlert('Error insertitemrrinfo');
			}
		}

		return $objResponse;
	}
	function updateitemrrinfo($rrno,$rrnohidprev,$vendor_id,$addr_id,$clientdate,$ref,$pers_id_ware,$pers_id_dept){
		global $dbinv;
		$objResponse = new xajaxResponse();
		$sqlupdate = "UPDATE rrinfo SET rrno ='".$rrno."' ,vendor_id = $vendor_id, addr_id = $addr_id,client_date = '".$clientdate."',reference = '".$ref."',pers_id_ware = $pers_id_ware, pers_id_dept = $pers_id_dept WHERE rrno = '".$rrnohidprev."' and isdelete = 1";
		//$result = $dbinv->query($sqlupdate);
		//die($sqlupdate);
		$sqlupdateitemrr ="UPDATE tblitemsrr SET rrno ='".$rrno."' WHERE rrno = '".$rrnohidprev."' and isdelete = 1";

		if ($dbinv->query($sqlupdate) == TRUE){
			//$objResponse->addAlert('RR Updated Successfully.');
		}
		if ($dbinv->query($sqlupdateitemrr) == TRUE){
			//$objResponse->addAlert('RR Updated Successfully.');
		}
		else{
			$objResponse->addAlert('Error updateitemrrinfo');
		}
		return $objResponse;
	}
	function updateitemqty($item_id,$qty,$rrno,$rrnohidprev,$qtyprev,$ucost){
		//var_dump($rrno); //latest value
		//var_dump($qtyprev); //previous value
		//var_dump($ucost);
		global $dbinv;
		$valueadded= 0;
		$latestbalance = 0;
		$objResponse = new xajaxResponse();
		$sql = "SELECT *FROM item WHERE MyID = '".$item_id."' ";
		//var_dump($sql);
		$result=$dbinv->query($sql);
		$c=0;
		if ($result->num_rows > 0){
			while ($row=$result->fetch_assoc()){
				$currbalance = $row['Balance'];
				//var_dump('currbalance'.$currbalance);
				if ($qty >= $qtyprev){
					$valueadded = (double)$qty - (double)$qtyprev;
					//var_dump("valueadded" .$valueadded);
					(double)$latestbalance = (double)$currbalance + (double)$valueadded;
					//var_dump("$latestbalance".$latestbalance);

					$sqlupdate = "UPDATE tblitemsrr SET qty = '".$qty."',unit_price = '".(double)$ucost."' WHERE item_id = '".$item_id."' AND rrno = '".$rrno."' ";
					
					/*$sqlupdateitembalance = "UPDATE item set Balance = '".$latestbalance."' WHERE MyID = '".$item_id."'";*/
					$sqlselectitemdate = "SELECT *FROM item WHERE MyID = '".$item_id."'";
					$resultdate = $dbinv->query($sqlselectitemdate);
					if($resultdate->num_rows > 0){
						while ($rowsz=$resultdate->fetch_assoc()){
							$sqlinsert = "INSERT INTO tblitembalancearchive(item_id,balance,time_created)VALUES($item_id,'".$currbalance."','".$rowsz['TimeModified']."')";
							if ($dbinv->query($sqlinsert) == TRUE){
			//$objResponse->addAlert('RR Updated Successfully.');
							}
						}

					}

					/*$sqlinsert = "INSERT INTO tblitembalancearchive(item_id,balance,time_created)VALUES($item_id,'".$currbalance."','".date('Y-m-d H:i:s')."')";*/

				//var_dump($sqlinsert);
					/*if($dbinv->query($sqlinsert) == TRUE){
			//$objResponse->addAlert('Item successfully insert archive');
					}*/
					$sqlupdateitembalance = "UPDATE item set Balance = '".$latestbalance."', TimeModified = '".date('Y-m-d H:i:s')."' WHERE MyID = '".$item_id."'";
					if ($dbinv->query($sqlupdateitembalance) == TRUE){
						//var_dump($sqlupdate);
			//$objResponse->addAlert('sds');
					}
					if ($dbinv->query($sqlupdate) == TRUE){
						//var_dump($sqlupdate);
			//$objResponse->addAlert('RR Updated Successfully.');
					}
					else{
						$objResponse->addAlert('Error updateitemqty');
					}
				}
				else if ($qty <= $qtyprev){
					$valueadded =  (double)$qtyprev - (double)$qty;
					//var_dump("valueadded" .$valueadded);
					(double)$latestbalance = (double)$currbalance - (double)$valueadded;
					//var_dump("$latestbalance".$latestbalance);

					$sqlupdate = "UPDATE tblitemsrr SET qty = '".$qty."',unit_price = '".(double)$ucost."' WHERE item_id = '".$item_id."' AND rrno = '".$rrno."' ";
					//var_dump($sqlupdate);
					$sqlupdateitembalance = "UPDATE item set Balance = '".$latestbalance."' WHERE MyID = '".$item_id."'";
					$sqlinsert = "INSERT INTO tblitembalancearchive(item_id,balance,time_created)VALUES($item_id,'".$currbalance."','".date('Y-m-d H:i:s')."')";
				//var_dump($sqlinsert);
					if($dbinv->query($sqlinsert) == TRUE){
			//$objResponse->addAlert('Item successfully insert archive');
					}
					
					if ($dbinv->query($sqlupdateitembalance) == TRUE){
			//$objResponse->addAlert('sds');
					}
					if ($dbinv->query($sqlupdate) == TRUE){
						//var_dump($sqlupdate);
			//$objResponse->addAlert('RR Updated Successfully.');
					}
					else{
						$objResponse->addAlert('Error updateitemqty');
					}
				}
			}
			$c++;
			//var_dump($c);
		}
		//$result = $dbinv->query($sqlupdate);

		/*if ($dbinv->query($sqlupdate) == TRUE){
			//$objResponse->addAlert('RR Updated Successfully.');
		}
		else{
			$objResponse->addAlert('Error updateitemqty');
		}
		return $objResponse;*/
		return $objResponse;
	}
	function updateitembalanceedit($item_id,$qty){
		global $dbinv;
		$sql = "SELECT *FROM item WHERE MyID = '".$item_id."' ";
		$objResponse = new xajaxResponse();
		$result=$dbinv->query($sql);
		$c=0;
		if ($result->num_rows > 0){
			while ($row=$result->fetch_assoc()){
				$bal = $row['Balance'];
				if ($bal > $qty){

				}
				$newbal = $bal + $qty;
				$sqlupdate = "UPDATE item SET Balance = '".$newbal."' WHERE MyID = '".$item_id."'";
				//$sqltruncate = "TRUNCATE TABLE item_temp";
				if($dbinv->query($sqlupdate) == TRUE){
			//$objResponse->addAlert('Item successfully insert');
				}
				/*if($dbinv->query($sqltruncate) == TRUE){
			//$objResponse->addAlert('Item successfully insert');
				}*/
				else {
					$objResponse->addAlert('Error updateitembalanceedit');
				}
			}
		}
		return $objResponse;
	}
	// SIS
	function insertitemsis($item_id,$sisno,$qty,$qtysishid,$rrno){
		global $dbinv;
		$objResponse = new xajaxResponse();

		$sqlselect = "SELECT *FROM tblitemsis WHERE item_id = '".$item_id."' AND sisno = '".$sisno."'";
		$result = $dbinv->query($sqlselect);
		if($result->num_rows > 0){
			//$objResponse->addAlert('already exist.');
		}
		else {
			$sql = "SELECT *FROM item WHERE MyID = '".$item_id."' ";
		//var_dump($qty);
			$latestbalance = 0;
			$resultitem=$dbinv->query($sql);
			$c=0;
			if ($resultitem->num_rows > 0){
				while ($row=$resultitem->fetch_assoc()){
					$currbalance = $row['Balance'];

					(double)$latestbalance = (double)$currbalance - (double)$qty; 
					//var_dump("latestbalance: " . $latestbalance. " item_id: ".$item_id);
					

					$sqlselectitemdate = "SELECT *FROM item WHERE MyID = '".$item_id."'";
					$resultdate = $dbinv->query($sqlselectitemdate);
					if($resultdate->num_rows > 0){
						while ($rowsz=$resultdate->fetch_assoc()){
							$sqlinsertsisarchive = "INSERT INTO tblitembalancearchive(item_id,balance,time_created)VALUES($item_id,'".$currbalance."','".$rowsz['TimeModified']."')";
							if ($dbinv->query($sqlinsertsisarchive) == TRUE){
			//$objResponse->addAlert('RR Updated Successfully.');
							}
						}

					}
					$sqlupdateitembalance = "UPDATE item set Balance = '".$latestbalance."',TimeModified = '".date('Y-m-d H:i:s')."' WHERE MyID = '".$item_id."'";

					if ($dbinv->query($sqlupdateitembalance) == TRUE){
			//$objResponse->addAlert('RR Updated Successfully.');
					}
					
					
				}
			}

			$sqlinsert = "INSERT INTO tblitemsis(item_id,sisno,qty,isdelete,sis_date,rrno)VALUES('".$item_id."','".$sisno."','".$qty."',1,'".date('Y-m-d')."','".$rrno."')";
		//$result = $dbinv->query($sqlupdate);
			if ($dbinv->query($sqlinsert) == TRUE){
			//$objResponse->addAlert('RR Updated Successfully.');
			}
			else{
				$objResponse->addAlert('Error insertitemsis');
			}

		}
		return $objResponse;
	}
	function updatesisitemqty($item_id,$qty,$sisno,$qtysisprev){
		//var_dump($qty); //latest value
		//var_dump($qtyprev); //previous value
		global $dbinv;
		$valueadded= 0;
		$latestbalance = 0;
		$objResponse = new xajaxResponse();
		$sql = "SELECT *FROM item WHERE MyID = '".$item_id."' ";
		//var_dump($sql);
		$result=$dbinv->query($sql);
		$c=0;
		if ($result->num_rows > 0){
			while ($row=$result->fetch_assoc()){
				$currbalance = $row['Balance'];
				//var_dump('currbalance'.$currbalance);
				if ($qty > $qtysisprev){
					$valueadded = (double)$qty - (double)$qtysisprev;
					//var_dump("valueadded" .$valueadded);
					(double)$latestbalance = (double)$currbalance - (double)$valueadded;
					//var_dump("$latestbalance".$latestbalance);

					$sqlupdate = "UPDATE tblitemsis SET qty = '".$qty."' WHERE item_id = '".$item_id."' AND sisno = '".$sisno."'";
					$sqlupdateitembalance = "UPDATE item set Balance = '".$latestbalance."' WHERE MyID = '".$item_id."'";
					$sqlinsert = "INSERT INTO tblitembalancearchive(item_id,balance,time_created)VALUES($item_id,'".$currbalance."','".date('Y-m-d H:i:s')."')";
				//var_dump($sqlinsert);
					if($dbinv->query($sqlinsert) == TRUE){
			//$objResponse->addAlert('Item successfully insert archive');
					}
					
					if ($dbinv->query($sqlupdateitembalance) == TRUE){
			//$objResponse->addAlert('sds');
					}
					if ($dbinv->query($sqlupdate) == TRUE){
			//$objResponse->addAlert('RR Updated Successfully.');
					}
					else{
						$objResponse->addAlert('Error updatesisitemqty');
					}
				}
				else if ($qty < $qtysisprev){
					$valueadded =  (double)$qtysisprev - (double)$qty;
					//var_dump("valueadded" .$valueadded);
					(double)$latestbalance = (double)$currbalance - (double)$valueadded;
					//var_dump("$latestbalance".$latestbalance);

					$sqlupdate = "UPDATE tblitemsis SET qty = '".$qty."' WHERE item_id = '".$item_id."' AND sisno = '".$sisno."' ";
					$sqlupdateitembalance = "UPDATE item set Balance = '".$latestbalance."' WHERE MyID = '".$item_id."'";
					$sqlinsert = "INSERT INTO tblitembalancearchive(item_id,balance,time_created)VALUES($item_id,'".$currbalance."','".date('Y-m-d H:i:s')."')";
				//var_dump($sqlinsert);
					if($dbinv->query($sqlinsert) == TRUE){
			//$objResponse->addAlert('Item successfully insert archive');
					}
					
					if ($dbinv->query($sqlupdateitembalance) == TRUE){
			//$objResponse->addAlert('sds');
					}
					if ($dbinv->query($sqlupdate) == TRUE){
			//$objResponse->addAlert('RR Updated Successfully.');
					}
					else{
						$objResponse->addAlert('Error updatesisitemqty');
					}
				}
			}
			$c++;
			//var_dump($c);
		}
		//$result = $dbinv->query($sqlupdate);

		/*if ($dbinv->query($sqlupdate) == TRUE){
			//$objResponse->addAlert('RR Updated Successfully.');
		}
		else{
			$objResponse->addAlert('Error updateitemqty');
		}
		return $objResponse;*/
		return $objResponse;
	}
	require("warehouse.common.php");
	$xajax->processRequests();
	?>