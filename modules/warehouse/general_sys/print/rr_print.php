<?php 
include('../../../../classes/inc/dbCon.php');
$appendurlid = $_GET['rrno'];
//var_dump(appendurlid);
//die($appendurlid);

//include('../../../../classes/inc/dbCon.php');

//session_start();
global $dbinv;
$sql = "SELECT *FROM tblmaterialsrr AS tms JOIN dx_requestform.`tblrequestmaterials` AS dxtms ON tms.`mwrf_mat_id` = dxtms.`MaterialsID` LEFT JOIN rrinfo as inforr 
    on inforr.`rrno` = tms.`rrno`
    LEFT JOIN tblcustomer as cust
    on cust.`cust_id` = inforr.`vendor_id`
    left join tbladdress as addr 
    on addr.`addr_id` = inforr.`addr_id`
    LEFT JOIN inventorydatabase.tblpersonnel_ware AS tpw 
    ON inforr.`pers_id_ware` = tpw.`pers_id` 
  LEFT JOIN inventorydatabase.tblpersonnel_dept as tpd 
  ON inforr.pers_id_dept = tpd.pers_id
     WHERE tms.`rrno` = '".$appendurlid."' AND tms.`isdelete` = 1";
$result=$dbinv->query($sql);
$result1 = $dbinv->query($sql);

if ($result->num_rows > 0 ){
	$rowhead = $result1->fetch_assoc();
		echo '<br>';
		echo '<br>';
		echo '<img src="../../../../images/rr.png" alt="Italian Trulli" style = "visibility:hidden;">';
		echo '<div style = "position:relative;top:-375px;left:200px;"><strong>'. $rowhead['Shop'].'</div><br>';
		echo '<div style = "position:relative;top:-395px;left:200px;">'. $rowhead['addr_name'].'</div><br>';
		echo '<div style = "position:relative;top:-445px;left:650px;">'.$rowhead['DateCreated'].'</div>';
		echo '<div style = "position:relative;top:-445px;left:650px;">'. $rowhead['reference'].'</div>';
		//echo '<br>';
		echo '<div style = "position:relative;top:-190px;left:100px;">'. $rowhead['fullname_ware'].'</div>';
		echo '<div style = "position:relative;top:-205px;left:580px;">'. $rowhead['fullname_dept'].'</div>';
		/*var_dump($result);*/
	while ($row=$result->fetch_assoc()){
		//var_dump($result);
		//$rrno = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['rrno']);
		/*$addr = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['addr_name']);
		$from = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['Shop']);
		$daterr = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['DateCreated']);
		$ref = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['reference']);*/
		$particular = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['Materials']);
		$qty = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['qty']);
		//$unitin = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['rrno']);
		$ucost = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['UnitPrice']);
		(double)$amount = (double)$qty * (double)$ucost;
		//$warep = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['fullname_ware']);

		

		echo '<b style = "position:relative;top:-445px;left:50px;">'. $particular.'</b>';
		echo '<b style = "position:relative;top:-445px;left:140px;">'. $qty.'</b>';
		echo '<b style = "position:relative;top:-445px;left:400px;">'. $ucost.'</b>';
		echo '<b style = "position:relative;top:-445px;left:450px;">'. (double)$amount.'</b><br>';
		
		
		}
	}
echo '<form action = "" method = "GET">';
echo '</form>';
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body >


</body>
</html>