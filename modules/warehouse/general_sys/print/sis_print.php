<?php 
include('../../../../classes/inc/dbCon.php');
$appendurlsisno = $_GET['sisno'];
//$appendurlid = $_GET['matid'];
//var_dump(appendurlid);
//die($appendurlid);

//include('../../../../classes/inc/dbCon.php');

//session_start();
global $dbinv;
$sql = "SELECT 
  tms.`rrno`,
  tms.`sisno`,
  tms.`qty`,
  tms.`mwrf_mat_id`,
  tms.`mwrf_req_id`,
  tms.`isdelete`,
  tmr.`qty` AS qtyrr,
  infosis.`cust_id`,
  infosis.`addr_id`,
  infosis.`issued_date`,
  infosis.`issued_nos`,
  infosis.`location`,
  infosis.`reference`,
  infosis.`remarks`,
  infosis.DateCreated,
  infosis.preparedby_id,
  infosis.receivedby_id,
  infosis.notedby_id,
  tc.`cust_id`,
  tc.`cust_name`,
  ta.`addr_id`,
  ta.`addr_name` 
FROM
  tblmaterialsis AS tms 
  LEFT JOIN `tblmaterialsrr` AS tmr 
    ON tmr.`rrno` = tms.`rrno` 
    AND tmr.`mwrf_mat_id` = tms.`mwrf_mat_id` 
  LEFT JOIN sisinfo AS infosis 
    ON infosis.`issued_nos` = tms.`sisno` 
    AND infosis.rrno = tms.rrno 
  LEFT JOIN `tblcustomer` AS tc 
    ON tc.`cust_id` = infosis.`cust_id` 
  LEFT JOIN tbladdress AS ta 
    ON ta.`addr_id` = infosis.`addr_id` 
WHERE tms.sisno = '".$appendurlsisno."' 
  AND tms.`isdelete` = 1 ";
$result=$dbinv->query($sql);

if ($result->num_rows > 0 ){
	$rowhead = $result->fetch_assoc();
	//echo '<br>';
		echo '<img src="../../../../images/rr.png" alt="Italian Trulli" style = "visibility:hidden;">';
		echo '<div style = "position:relative;top:-375px;left:200px;"><strong>'. $rowhead['cust_name'].'</div><br>';
		echo '<div style = "position:relative;top:-395px;left:200px;">'. $rowhead['addr_name'].'</div><br>';
		echo '<div style = "position:relative;top:-445px;left:650px;">'.$rowhead['location'].'</div>';
		echo '<div style = "position:relative;top:-445px;left:650px;">'.$rowhead['DateCreated'].'</div>';
		echo '<div style = "position:relative;top:-445px;left:650px;">'. $rowhead['reference'].'</div>';
		//echo '<br>';
		echo '<div style = "position:relative;top:-190px;left:100px;">'. $rowhead['remarks'].'</div>';
		echo '<div style = "position:relative;top:-190px;left:100px;">'. $rowhead['preparedby_id'].'</div>';
		echo '<div style = "position:relative;top:-190px;left:100px;">'. $rowhead['receivedby_id'].'</div>';
		echo '<div style = "position:relative;top:-205px;left:580px;">'. $rowhead['notedby_id'].'</div>';
	while ($row=$result->fetch_assoc()){
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
		echo '<b style = "position:relative;top:-445px;left:150px;">'. $qty.'</b>';
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