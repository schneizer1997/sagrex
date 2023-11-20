<?php

include('../../../classes/inc/dbCon.php');
function insertplate($platenos){
	//error_reporting(E_ALL);
	global $dbpurchasing;
	$objResponse= new xajaxResponse();
	$sqlselect = "SELECT *FROM plates where plate_no = '".$platenos."' ";
	$result = $dbpurchasing->query($sqlselect);
	//die($sqlselect);
	if($result->num_rows > 0){
		//$objResponse->addAlert('Plate No. is already exist.');
	}
	else {
		$sqlplateinsert = "INSERT INTO plates(plate_no,status)VALUES('".$platenos."','1')";
	//die($sqlrrinsert);
			if ($dbpurchasing->query($sqlplateinsert) == TRUE){
				//$objResponse->addAlert('Plate Added Successfully.');
			}
			else{
			//$objResponse->addAlert('Error');
			}
		}

		return $objResponse;
	}
	function updateplate($plate_id,$platenos){
		global $dbpurchasing;
		$objResponse= new xajaxResponse();
		$sqlselect = "SELECT *FROM plates WHERE plate_no = '".$platenos."' AND status = 1";
		$result = $dbpurchasing->query($sqlselect);
		if($result->num_rows > 0){
		//$objResponse->addAlert('Plate No. is already exist.');
		}
		else {

			$sqlplateupdate = "UPDATE plates SET plate_no = '".$platenos."' WHERE plate_id = $plate_id AND status = 1";
			//var_dump($sqlplateupdate);
			if ($dbpurchasing->query($sqlplateupdate) == TRUE){
				//$objResponse->addAlert('Plate Updated Successfully.');
			}
			else{
			//$objResponse->addAlert('Error');
			}


		}


		return $objResponse;
	}
	function insertitemvam($plate_id,$assign_name,$item,$descr,$brand,$qty,$unit,$price,$amount,$supp_name,$supp_addr,$rf_no,$daterfno,$po_no,$po_date,$req_by,$ref_no,$daterefno,$cvjv,$other_ref,$remarks,$status){
		
		global $dbpurchasing;
		$objResponse= new xajaxResponse();


		$sqlinsertitem = "INSERT INTO vehicle_info(plate_id,assign_name,item,descr,brand,qty,unit,price,amount,supp_name,address,rf_no,daterfno,po_no,po_date,req_by,ref_no,daterefno,cvjv,other_ref,remarks,status)VALUES($plate_id,'".addslashes($assign_name)."','".addslashes($item)."','".addslashes($descr)."','".addslashes($brand)."','".$qty."','".$unit."','".$price."','".$amount."','".addslashes($supp_name)."','".addslashes($supp_addr)."','".addslashes($rf_no)."','".$daterfno."','".addslashes($po_no)."','".$po_date."','".addslashes($req_by)."','".addslashes($ref_no)."','".$daterefno."','".addslashes($cvjv)."','".addslashes($other_ref)."','".addslashes($remarks)."',$status)";
					//die($sqlmaterial);
					//var_dump($sqlmaterial);
			if ($dbpurchasing->query($sqlinsertitem) == TRUE){
				//$objResponse->addAlert('Item has been added.');
			}
			else{
				$objResponse->addAlert('Error');

						//die($db->query($sqlmaterial));

			}
			return $objResponse;
		}
	function updateitemvam($plate_id,$vehinfo_id,$assign_name,$item,$descr,$brand,$qty,$unit,$price,$amount,$supp_name,$supp_addr,$rf_no,$daterfno,$po_no,$po_date,$req_by,$ref_no,$daterefno,$cvjv,$other_ref,$remarks,$status){
		
		global $dbpurchasing;
		$objResponse= new xajaxResponse();
		//var_dump($vehinfo_id);
		$sqlupdateitem = "UPDATE vehicle_info SET plate_id = $plate_id,assign_name = '".addslashes($assign_name)."',item ='".addslashes($item)."' ,descr ='".addslashes($descr)."' ,brand ='".addslashes($brand)."' ,qty='".$qty."',unit='".$unit."',price='".$price."',amount='".$amount."',supp_name = '".addslashes($supp_name)."',address = '".addslashes($supp_addr)."',rf_no ='".addslashes($rf_no)."',daterfno ='".$daterfno."',po_no='".addslashes($po_no)."',po_date ='".$po_date."',req_by='".addslashes($req_by)."',ref_no='".addslashes($ref_no)."',daterefno='".$daterefno."',cvjv='".addslashes($cvjv)."',other_ref ='".addslashes($other_ref)."',remarks ='".addslashes($remarks)."' WHERE vehinfo_id = $vehinfo_id AND status = 1";
					//die($sqlmaterial);
					//var_dump($sqlupdateitem);
			if ($dbpurchasing->query($sqlupdateitem) == TRUE){
				//$objResponse->addAlert('Item has been updated.');
			}
			else{
				$objResponse->addAlert('Error');

						//die($db->query($sqlmaterial));

			}
			return $objResponse;
		}
		function insertrmsvam($plate_id,$assign_name,$repairetype,$descr,$brand,$qty,$unit,$price,$amount,$supp_name,$supp_addr,$rf_no,$daterfno,$po_no,$po_date,$req_by,$ref_no,$daterefno,$cvjv,$other_ref,$remarks,$status){
		
		global $dbpurchasing;
		$objResponse= new xajaxResponse();


		$sqlinsertitem = "INSERT INTO vehicle_rms_info(plate_id,assign_name,repairetype,descr,brand,qty,unit,price,amount,supp_name,address,rf_no,daterfno,po_no,po_date,req_by,ref_no,daterefno,cvjv,other_ref,remarks,status)VALUES($plate_id,'".addslashes($assign_name)."','".addslashes($repairetype)."','".addslashes($descr)."','".addslashes($brand)."','".$qty."','".$unit."','".$price."','".$amount."','".addslashes($supp_name)."','".addslashes($supp_addr)."','".addslashes($rf_no)."','".$daterfno."','".addslashes($po_no)."','".$po_date."','".addslashes($req_by)."','".addslashes($ref_no)."','".$daterefno."','".addslashes($cvjv)."','".addslashes($other_ref)."','".addslashes($remarks)."',$status)";
					//die($sqlmaterial);
					//var_dump($sqlmaterial);
			if ($dbpurchasing->query($sqlinsertitem) == TRUE){
				//$objResponse->addAlert('Item has been added.');
			}
			else{
				$objResponse->addAlert('Error');

						//die($db->query($sqlmaterial));

			}
			return $objResponse;
		}
		function updatermsvam($vehinfo_rms_id,$plate_id,$assign_name,$repairetype,$descr,$brand,$qty,$unit,$price,$amount,$supp_name,$supp_addr,$rf_no,$daterfno,$po_no,$po_date,$req_by,$ref_no,$daterefno,$cvjv,$other_ref,$remarks,$status){
		
		global $dbpurchasing;
		$objResponse= new xajaxResponse();
		//var_dump($vehinfo_id);
		$sqlupdateitem = "UPDATE vehicle_rms_info SET plate_id = $plate_id,assign_name = '".addslashes($assign_name)."',repairetype ='".addslashes($repairetype)."' ,descr ='".addslashes($descr)."' ,brand ='".addslashes($brand)."' ,qty='".$qty."',unit='".$unit."',price='".$price."',amount='".$amount."',supp_name = '".addslashes($supp_name)."',address = '".addslashes($supp_addr)."',rf_no ='".addslashes($rf_no)."',daterfno ='".$daterfno."',po_no='".addslashes($po_no)."',po_date ='".$po_date."',req_by='".addslashes($req_by)."',ref_no='".addslashes($ref_no)."',daterefno='".$daterefno."',cvjv='".addslashes($cvjv)."',other_ref ='".addslashes($other_ref)."',remarks ='".addslashes($remarks)."' WHERE vehinfo_rms_id = $vehinfo_rms_id AND status = 1";
					//die($sqlmaterial);
					//var_dump($sqlupdateitem);
			if ($dbpurchasing->query($sqlupdateitem) == TRUE){
				//$objResponse->addAlert('Item has been updated.');
			}
			else{
				$objResponse->addAlert('Error');

						//die($db->query($sqlmaterial));

			}
			return $objResponse;
		}
		function insertfuelinfo($plate_id,$assign,$item,$qty,$price,$amount,$supp_name,$model,$rf_no,$daterfno,$po_no,$po_date,$req_by,$ref_no,$daterefno,$cvjv,$other_ref,$remarks,$descr,$status){
		
		global $dbpurchasing;
		$objResponse= new xajaxResponse();


		$sqlinsertitem = "INSERT INTO fuel_info(plate_id,assign,fuel_name,qty,price,amount,supp_name,model,rf_no,daterfno,po_no,po_date,req_by,ref_no,daterefno,cvjv,other_ref,remarks,descr,status)VALUES('".$plate_id."','".addslashes($assign)."','".addslashes($item)."','".$qty."','".$price."','".$amount."','".addslashes($supp_name)."','".addslashes($model)."','".addslashes($rf_no)."','".$daterfno."','".addslashes($po_no)."','".$po_date."','".addslashes($req_by)."','".addslashes($ref_no)."','".$daterefno."','".addslashes($cvjv)."','".addslashes($other_ref)."','".addslashes($remarks)."','".addslashes($descr)."',$status)";
					//die($sqlmaterial);
					//var_dump($sqlinsertitem);
			if ($dbpurchasing->query($sqlinsertitem) == TRUE){
				//$objResponse->addAlert('Item has been added.');
			}
			else{
			$objResponse->addAlert('Error');

						//die($db->query($sqlmaterial));

			}
			return $objResponse;
		}
		function updatefuelinfo($fuel_info_id,$plate_id,$assign,$item,$qty,$price,$amount,$supp_name,$model,$rf_no,$daterfno,$po_no,$po_date,$req_by,$ref_no,$daterefno,$cvjv,$other_ref,$remarks,$descr,$status){
		
		global $dbpurchasing;
		$objResponse= new xajaxResponse();
		//var_dump($vehinfo_id);
		$sqlupdateitem = "UPDATE fuel_info SET plate_id = '".$plate_id."',assign = '".addslashes($assign)."',fuel_name ='".$item."',qty='".$qty."',price='".$price."',amount='".$amount."',supp_name = '".addslashes($supp_name)."',model = '".addslashes($model)."',rf_no ='".addslashes($rf_no)."',daterfno ='".$daterfno."',po_no='".addslashes($po_no)."',po_date ='".$po_date."',req_by='".addslashes($req_by)."',ref_no='".addslashes($ref_no)."',daterefno='".$daterefno."',cvjv='".addslashes($cvjv)."',other_ref ='".addslashes($other_ref)."',remarks ='".addslashes($remarks)."',descr ='".addslashes($descr)."' WHERE fuel_info_id = $fuel_info_id AND status = 1" ;
					//die($sqlmaterial);
					//var_dump($sqlupdateitem);
			if ($dbpurchasing->query($sqlupdateitem) == TRUE){
				//$objResponse->addAlert('Item has been updated.');
			}
			else{
				$objResponse->addAlert('Error');

						//die($db->query($sqlmaterial));

			}
			return $objResponse;
		}
		function insertproditem($desig,$item,$descr,$brand,$purp,$qty,$unit,$price,$amount,$supp_name,$supp_addr,$rf_no,$daterfno,$po_no,$po_date,$req_by,$ref_no,$daterefno,$cvjv,$pjd,$other_ref,$remarks){
		
		global $dbpurchasing;
		$objResponse= new xajaxResponse();


		$sqlinsertitem = "INSERT INTO prod_info(designation,item_name,descr,brand,purpose,qty,unit,price,amount,supp_name,supp_addr,rf_no,rf_date,po_no,po_date,req_by,ref_no,ref_date,cvjv_no,pjd_no,other_ref,remarks,status)VALUES('".$desig."','".addslashes($item)."','".addslashes($descr)."','".addslashes($brand)."','".addslashes($purp)."','".$qty."','".$unit."','".$price."','".$amount."','".addslashes($supp_name)."','".addslashes($supp_addr)."','".addslashes($rf_no)."','".$daterfno."','".addslashes($po_no)."','".$po_date."','".addslashes($req_by)."','".addslashes($ref_no)."','".$daterefno."','".addslashes($cvjv)."','".addslashes($pjd)."','".addslashes($other_ref)."','".addslashes($remarks)."',1)";
					//die($sqlmaterial);
					//var_dump($sqlmaterial);
			if ($dbpurchasing->query($sqlinsertitem) == TRUE){
				//$objResponse->addAlert('Item has been added.');
			}
			else{
				$objResponse->addAlert('Error');

						//die($db->query($sqlmaterial));

			}
			return $objResponse;
		}

		function updateproditem($prodinfo_id,$desig,$item,$descr,$brand,$purp,$qty,$unit,$price,$amount,$supp_name,$supp_addr,$rf_no,$daterfno,$po_no,$po_date,$req_by,$ref_no,$daterefno,$cvjv,$pjd,$other_ref,$remarks){
		
		global $dbpurchasing;
		$objResponse= new xajaxResponse();
		//var_dump($vehinfo_id);
		$sqlupdateitem = "UPDATE prod_info SET designation = '".$desig."',item_name ='".addslashes($item)."' ,descr ='".addslashes($descr)."' ,brand ='".addslashes($brand)."',purpose ='".addslashes($purp)."' ,qty='".$qty."',unit='".$unit."',price='".$price."',amount='".$amount."',supp_name = '".addslashes($supp_name)."',supp_addr = '".addslashes($supp_addr)."',rf_no ='".addslashes($rf_no)."',rf_date ='".$daterfno."',po_no='".addslashes($po_no)."',po_date ='".$po_date."',req_by='".addslashes($req_by)."',ref_no='".addslashes($ref_no)."',ref_date='".$daterefno."',cvjv_no='".addslashes($cvjv)."',pjd_no='".addslashes($pjd)."',other_ref ='".addslashes($other_ref)."',remarks ='".addslashes($remarks)."' WHERE prod_info_id = $prodinfo_id AND status = 1";
					//die($sqlmaterial);
					//var_dump($sqlupdateitem);
			if ($dbpurchasing->query($sqlupdateitem) == TRUE){
				//$objResponse->addAlert('Item has been updated.');
			}
			else{
				$objResponse->addAlert('Error');

						//die($db->query($sqlmaterial));

			}
			return $objResponse;
		}

		function insertproditemrms($desig,$item,$descr,$brand,$purp,$qty,$unit,$price,$amount,$supp_name,$supp_addr,$rf_no,$daterfno,$po_no,$po_date,$req_by,$ref_no,$daterefno,$cvjv,$pjd,$other_ref,$remarks){
		
		global $dbpurchasing;
		$objResponse= new xajaxResponse();


		$sqlinsertitem = "INSERT INTO prod_rms_info(designation,repair_type,descr,brand,purpose,qty,unit,price,amount,supp_name,supp_addr,rf_no,rf_date,po_no,po_date,req_by,ref_no,ref_date,cvjv_no,pjd_no,other_ref,remarks,status)VALUES('".$desig."','".addslashes($item)."','".addslashes($descr)."','".addslashes($brand)."','".addslashes($purp)."','".$qty."','".$unit."','".$price."','".$amount."','".addslashes($supp_name)."','".addslashes($supp_addr)."','".addslashes($rf_no)."','".$daterfno."','".addslashes($po_no)."','".$po_date."','".addslashes($req_by)."','".addslashes($ref_no)."','".$daterefno."','".addslashes($cvjv)."','".addslashes($pjd)."','".addslashes($other_ref)."','".addslashes($remarks)."',1)";
					//die($sqlmaterial);
					//var_dump($sqlmaterial);
			if ($dbpurchasing->query($sqlinsertitem) == TRUE){
				//$objResponse->addAlert('Item has been added.');
			}
			else{
				$objResponse->addAlert('Error');

						//die($db->query($sqlmaterial));

			}
			return $objResponse;
		}
		function updateproditemrms($prodinfo_id,$desig,$item,$descr,$brand,$purp,$qty,$unit,$price,$amount,$supp_name,$supp_addr,$rf_no,$daterfno,$po_no,$po_date,$req_by,$ref_no,$daterefno,$cvjv,$pjd,$other_ref,$remarks){
		
		global $dbpurchasing;
		$objResponse= new xajaxResponse();
		//var_dump($vehinfo_id);
		$sqlupdateitem = "UPDATE prod_rms_info SET designation = '".$desig."',repair_type ='".addslashes($item)."' ,descr ='".addslashes($descr)."' ,brand ='".addslashes($brand)."',purpose ='".addslashes($purp)."' ,qty='".$qty."',unit='".$unit."',price='".$price."',amount='".$amount."',supp_name = '".addslashes($supp_name)."',supp_addr = '".addslashes($supp_addr)."',rf_no ='".addslashes($rf_no)."',rf_date ='".$daterfno."',po_no='".addslashes($po_no)."',po_date ='".$po_date."',req_by='".addslashes($req_by)."',ref_no='".addslashes($ref_no)."',ref_date='".$daterefno."',cvjv_no='".addslashes($cvjv)."',pjd_no='".addslashes($pjd)."',other_ref ='".addslashes($other_ref)."',remarks ='".addslashes($remarks)."' WHERE prod_rms_info_id = $prodinfo_id AND status = 1";
					//die($sqlmaterial);
					//var_dump($sqlupdateitem);
			if ($dbpurchasing->query($sqlupdateitem) == TRUE){
				//$objResponse->addAlert('Item has been updated.');
			}
			else{
				$objResponse->addAlert('Error');

						//die($db->query($sqlmaterial));

			}
			return $objResponse;
		}

		function insertofficecoaco($desig,$category,$item,$descr,$brand,$purp,$qty,$unit,$price,$amount,$supp_name,$supp_addr,$rf_no,$daterfno,$po_no,$po_date,$req_by,$ref_no,$daterefno,$cvjv,$pjd,$other_ref,$remarks){
		
		global $dbpurchasing;
		$objResponse= new xajaxResponse();


		$sqlinsertitem = "INSERT INTO officeandwarehouse_info(designation,category,item_name,descr,brand,purpose,qty,unit,price,amount,supp_name,supp_addr,rf_no,rf_date,po_no,po_date,req_by,ref_no,ref_date,cvjv_no,pjd_no,other_ref,remarks,status)VALUES('".$desig."','".$category."','".addslashes($item)."','".addslashes($descr)."','".addslashes($brand)."','".addslashes($purp)."','".$qty."','".$unit."','".$price."','".$amount."','".addslashes($supp_name)."','".addslashes($supp_addr)."','".addslashes($rf_no)."','".$daterfno."','".addslashes($po_no)."','".$po_date."','".addslashes($req_by)."','".addslashes($ref_no)."','".$daterefno."','".addslashes($cvjv)."','".addslashes($pjd)."','".addslashes($other_ref)."','".addslashes($remarks)."',1)";
					//die($sqlmaterial);
					//var_dump($sqlmaterial);
			if ($dbpurchasing->query($sqlinsertitem) == TRUE){
				//$objResponse->addAlert('Item has been added.');
			}
			else{
				$objResponse->addAlert('Error');

						//die($db->query($sqlmaterial));

			}
			return $objResponse;
		}

		function updateofficecoaco($oaw_info_id,$desig,$category,$item,$descr,$brand,$purp,$qty,$unit,$price,$amount,$supp_name,$supp_addr,$rf_no,$daterfno,$po_no,$po_date,$req_by,$ref_no,$daterefno,$cvjv,$pjd,$other_ref,$remarks){
		
		global $dbpurchasing;
		$objResponse= new xajaxResponse();
		//var_dump($vehinfo_id);
		$sqlupdateitem = "UPDATE officeandwarehouse_info SET designation = '".$desig."',category = '".$category."',item_name ='".addslashes($item)."' ,descr ='".addslashes($descr)."' ,brand ='".addslashes($brand)."',purpose ='".addslashes($purp)."' ,qty='".$qty."',unit='".$unit."',price='".$price."',amount='".$amount."',supp_name = '".addslashes($supp_name)."',supp_addr = '".addslashes($supp_addr)."',rf_no ='".addslashes($rf_no)."',rf_date ='".$daterfno."',po_no='".addslashes($po_no)."',po_date ='".$po_date."',req_by='".addslashes($req_by)."',ref_no='".addslashes($ref_no)."',ref_date='".$daterefno."',cvjv_no='".addslashes($cvjv)."',pjd_no='".addslashes($pjd)."',other_ref ='".addslashes($other_ref)."',remarks ='".addslashes($remarks)."' WHERE oaw_info_id = $oaw_info_id AND status = 1";
					//die($sqlmaterial);
					//var_dump($sqlupdateitem);
			if ($dbpurchasing->query($sqlupdateitem) == TRUE){
				//$objResponse->addAlert('Item has been updated.');
			}
			else{
				$objResponse->addAlert('Error');

						//die($db->query($sqlmaterial));

			}
			return $objResponse;
		}
		function insertothersitem($desig,$item,$descr,$brand,$purp,$qty,$unit,$price,$amount,$supp_name,$supp_addr,$rf_no,$daterfno,$po_no,$po_date,$req_by,$ref_no,$daterefno,$cvjv,$pjd,$other_ref,$remarks){
		
		global $dbpurchasing;
		$objResponse= new xajaxResponse();


		$sqlinsertitem = "INSERT INTO others_info(designation,item_name,descr,brand,purpose,qty,unit,price,amount,supp_name,supp_addr,rf_no,rf_date,po_no,po_date,req_by,ref_no,ref_date,cvjv_no,pjd_no,other_ref,remarks,status)VALUES('".$desig."','".addslashes($item)."','".addslashes($descr)."','".addslashes($brand)."','".addslashes($purp)."','".$qty."','".$unit."','".$price."','".$amount."','".addslashes($supp_name)."','".addslashes($supp_addr)."','".addslashes($rf_no)."','".$daterfno."','".addslashes($po_no)."','".$po_date."','".addslashes($req_by)."','".addslashes($ref_no)."','".$daterefno."','".addslashes($cvjv)."','".addslashes($pjd)."','".addslashes($other_ref)."','".addslashes($remarks)."',1)";
					//die($sqlmaterial);
					//var_dump($sqlinsertitem);
			if ($dbpurchasing->query($sqlinsertitem) == TRUE){
				//$objResponse->addAlert('Item has been added.');
			}
			else{
				$objResponse->addAlert('Error');

						//die($db->query($sqlmaterial));

			}
			return $objResponse;
		}

		function updateinfoitem($othersinfo_id,$desig,$item,$descr,$brand,$purp,$qty,$unit,$price,$amount,$supp_name,$supp_addr,$rf_no,$daterfno,$po_no,$po_date,$req_by,$ref_no,$daterefno,$cvjv,$pjd,$other_ref,$remarks){
		
		global $dbpurchasing;
		$objResponse= new xajaxResponse();
		//var_dump($vehinfo_id);
		$sqlupdateitem = "UPDATE others_info SET designation = '".$desig."',item_name ='".addslashes($item)."' ,descr ='".addslashes($descr)."' ,brand ='".addslashes($brand)."',purpose ='".addslashes($purp)."' ,qty='".$qty."',unit='".$unit."',price='".$price."',amount='".$amount."',supp_name = '".addslashes($supp_name)."',supp_addr = '".addslashes($supp_addr)."',rf_no ='".addslashes($rf_no)."',rf_date ='".$daterfno."',po_no='".addslashes($po_no)."',po_date ='".$po_date."',req_by='".addslashes($req_by)."',ref_no='".addslashes($ref_no)."',ref_date='".$daterefno."',cvjv_no='".addslashes($cvjv)."',pjd_no='".addslashes($pjd)."',other_ref ='".addslashes($other_ref)."',remarks ='".addslashes($remarks)."' WHERE others_info_id = $othersinfo_id AND status = 1";
					//die($sqlmaterial);
					//var_dump($sqlupdateitem);
			if ($dbpurchasing->query($sqlupdateitem) == TRUE){
				//$objResponse->addAlert('Item has been updated.');
			}
			else{
				$objResponse->addAlert('Error');

						//die($db->query($sqlmaterial));

			}
			return $objResponse;
		}
		function insertvendor($comp,$prevname,$type,$nature,$busaddr,$billaddr,$contact,$position,$telno,$faxno,$mobno,$email,$terms,$credit,$regno,$secreg,$permit,$bircr,$tinno,$vatno,$tax,$bank,$loc,$acctname,$holder,$signa,$verby,$vendorimg,$bankimg,$currdate){
			/*$vendor = addslashes(file_get_contents($_FILE['inputimg']['name']));
			$bank = addslashes(file_get_contents($_FILE['uploadimg']['name']));*/

		global $dbpurchasing;
		$objResponse= new xajaxResponse();

		$sqlinsertitem = "INSERT INTO vendor_accr(com_name,comp_prev_name,type,nature,busi_addr,bill_addr,contact_name,position,tel_no,fax_no,mobile_no,email,terms,credit_limit,reg_no,sec_reg,permit_no,bir_cert,tin_no,vat_no,tax,bank_name,bank_loc,acct_name,acct_sign_holder,sign_office,verified_by,vendor_img,upload_img,date_created,date_modified,status)VALUES('".addslashes($comp)."','".addslashes($prevname)."','".addslashes($type)."','".addslashes($nature)."','".addslashes($busaddr)."','".addslashes($billaddr)."','".addslashes($contact)."','".addslashes($position)."','".$telno."','".$faxno."','".$mobno."','".$email."','".addslashes($terms)."','".$credit."','".addslashes($regno)."','".$secreg."','".$permit."','".$bircr."','".$tinno."','".$vatno."','".$tax."','".$bank."','".$loc."','".$acctname."','".$holder."','".$signa."','".$verby."',$vendorimg,$bankimg,'".$currdate."',1)";
					//die($sqlmaterial);
					var_dump($sqlinsertitem);
			if ($dbpurchasing->query($sqlinsertitem) == TRUE){
				$objResponse->addAlert('Item has been added.');
			}
			else{
				$objResponse->addAlert('Error');

						//die($db->query($sqlmaterial));

			}
			return $objResponse;

		}

/*function insertvamitem($plate_id,$assign_name,$item,$descr,$brand,$qty,$unit,$price,$amount,$supp_name,$supp_addr,$rf_no,$daterfno,$po_no,$po_date,$req_by,$ref_no,$daterefno,$other_ref,$remarks,$status){
	//error_reporting(E_ALL);
	global $dbpurchasing;
	//die("shokt");
	//var_dump($plate_id);
	//console_log($view_variable);
	$objResponse= new xajaxResponse();
	$sqlvamiteminsert = "INSERT INTO vehicle_info(plate_id,assign_name,item,descr,brand,qty,unit,price,amount,supp_name,supp_addr,rf_no,daterfno,po_no,po_date,req_by,ref_no,daterefno,other_ref,remarks,status)VALUES($plate_id,'".$assign_name."','".$item."','".$descr."','".$brand."','".$qty."','".$unit."','".$price."','".$amount."','".$supp_name."','".$supp_addr."','".$rf_no."','".$daterfno."','".$po_no."','".$po_date."','".$req_by."','".$ref_no."','".$daterefno."','".$other_ref."','".$remarks."',$status)";
		var_dump($sqlvamiteminsert);

		//$sqlvamiteminsert = "INSERT INTO vehicle_info(plate_id,assign_name,item,'".$desc."',brand,qty,unit,price,amount,supp_name,address,rf_no,date_req,po_no,po_date,req_by,ref_no,purch_date,other_ref,remarks,status)VALUES($plate_id,$assign_name,$item,$desc,$brand,$qty,$unit,$price,$amount,$supp_name,$supp_addr,$rf_no,$daterfno,$po_no,$po_date,$req_by,$ref_no,$daterefno,$other_ref,$remarks,$status)";

		if ($dbpurchasing->query($sqlvamiteminsert) == TRUE){
			$objResponse->addAlert('Item Added Successfully.');
		}
		else{
			$objResponse->addAlert('Error walang hiya');
		}

		return $objResponse;
	}*/
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
	$sqlplateinsert = "INSERT INTO plates(plate_no,status)VALUES('asdasd','1')";
	//die($sqlrrinsert);
		//var_dump($sqlplateinsert);
	if ($dbpurchasing->query($sqlplateinsert) == TRUE){
		$objResponse->addAlert('Plate Added Successfully.');
	}
	else{
			//$objResponse->addAlert('Error');
	}
	//}
	
	return $objResponse;
}
require("purchasing.common.php");
$xajax->processRequests();
?>