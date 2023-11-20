<?php 
include('../../../../classes/inc/dbCon.php');
$appendurlid = $_GET['rrno'];
//var_dump(appendurlid);
//die($appendurlid);

//include('../../../../classes/inc/dbCon.php');

//session_start();
global $dbinv;
$sql = "SELECT *FROM tblitemsrr AS tir LEFT JOIN item ON tir.`item_id` = item.`MyID` LEFT JOIN rrinfo AS inforr ON inforr.rrno = tir.`rrno` LEFT JOIN tblpersonnel_ware as tpw ON tpw.`pers_id` = inforr.`pers_id_ware` LEFT JOIN tblpersonnel_dept as tpd
  ON tpd.`pers_id` = inforr.`pers_id_ware` LEFT JOIN tbladdress AS tadd 
    ON tadd.`addr_id` = inforr.`addr_id` LEFT JOIN tblcustomer as tcust
    on tcust.`cust_id` = inforr.`vendor_id` WHERE inforr.rrno = '".$appendurlid."' AND tir.`isdelete` = 1 AND inforr.`isdelete` = 1 ORDER BY tir.item_id DESC ";
    //die($sql);
    //var_dump($sql);
$result=$dbinv->query($sql);
$result1 = $dbinv->query($sql);
$checkby = "";
$notesby = "";
if ($result->num_rows > 0 ){
	$rowhead = $result1->fetch_assoc();
		/*echo '<br>';
		echo '<br>';*/
		echo '<table style = "position:relative;top:-380px;margin:0px;line-height: 0 !important;font-size: 13px;" >';
		echo '<tr style = "border:0px solid black;color:black;width:100px;height:18px;">
		<td colspan = "3" style = "border:0px solid black;color:black;width:290px;padding-left:50px;"><a style = "visibility:hidden;">RECEIVED FROM:</a>'. $rowhead['cust_name'].'</td>
		<td colspan = "2" style = "border:0px solid black;color:black;width:100px;"><center>'.$rowhead['DateCreated'].'</td>
		
		</tr>';
		echo '<tr style = "border:0px solid black;color:black;width:100px;height:18px;">
		<td colspan = "3" style = "border:0px solid black;color:black;width:290px;padding-left:50px;"><a style = "visibility:hidden;">ADDRESS:</a>'. $rowhead['addr_name'].'</td>
		<td colspan = "2" style = "border:0px solid black;color:black;width:100px;"><center>'. $rowhead['reference'].'</td>
		
		</tr>';

		echo '<tr style = "border:0px solid black;color:black;width:100px;height:35px;">
		<td style = "border:0px solid black;color:black;width:290px;"><center style = "visibility:hidden;">PARTICULAR</td>
		<td style = "border:0px solid black;color:black;width:60px;"><center style = "visibility:hidden;">QTY</td>
		<td style = "border:0px solid black;color:black;width:210px;"><center style = "visibility:hidden;">UNITS IN</td>
		<td style = "border:0px solid black;color:black;width:100px;"><center style = "visibility:hidden;">UNIT COST</td>
		<td style = "border:0px solid black;color:black;width:100px;"><center style = "visibility:hidden;">AMOUNT</td>
		</tr>';
		//echo '<br>';
		
		
		echo '<img src="../../../../images/rr.png" alt="Italian Trulli" style = "visibility:hidden;">';
		/*echo '<img src="../../../../images/rr.png" alt="Italian Trulli" style = "visibility:hidden;">';
		echo '<div style = "position:relative;top:-375px;left:200px;"><strong>'. $rowhead['cust_name'].'</div><br>';
		echo '<div style = "position:relative;top:-395px;left:200px;">'. $rowhead['addr_name'].'</div><br>';
		echo '<div style = "position:relative;top:-445px;left:650px;">'.$rowhead['DateCreated'].'</div>';
		echo '<div style = "position:relative;top:-445px;left:650px;">'. $rowhead['reference'].'</div>';
		//echo '<br>';
		echo '<div style = "position:relative;top:-190px;left:100px;">'. $rowhead['fullname_ware'].'</div>';
		echo '<div style = "position:relative;top:-205px;left:580px;">'. $rowhead['fullname_dept'].'</div>';*/
		
		/*var_dump($result);*/
	while ($row=$result->fetch_assoc()){
		//var_dump($result);
		//$rrno = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['rrno']);
		/*$addr = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['addr_name']);
		$from = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['Shop']);
		$daterr = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['DateCreated']);
		$ref = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['reference']);*/
		$particular = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['Description']);
		$qty = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['qty']);
		//$unitin = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['rrno']);
		$ucost = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['unit_price']);
		$unitm = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['UnitOfMeasureSetRefFullName']);
		(double)$amount = (double)$qty * (double)$ucost;
		$checkby = $row['fullname_ware'];
		$notesby = $row['fullname_dept'];
		//$warep = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['fullname_ware']);

		/*echo '<b style = "position:relative;top:-445px;left:50px;">'. $particular.'</b>';
		echo '<b style = "position:relative;top:-445px;left:140px;">'. $qty.'</b>';
		echo '<b style = "position:relative;top:-445px;left:400px;">'. $ucost.'</b>';
		echo '<b style = "position:relative;top:-445px;left:450px;">'. (double)$amount.'</b><br>';*/
		
		echo '<tr style = "border:0px solid black;color:black;width:100px;height:15px;">
		<td style = "border:0px solid black;color:black;width:290px;"><center>'. $particular.'</td>
		<td style = "border:0px solid black;color:black;width:60px;"><center>'. $qty.'</td>
		<td style = "border:0px solid black;color:black;width:210px;"><center>'. $unitm.'</td>
		<td style = "border:0px solid black;color:black;width:100px;"><center>'. $ucost.'</td>
		<td style = "border:0px solid black;color:black;width:100px;"><center>'. (double)$amount.'</td>
		</tr>';
		
		
		}
/*		echo '<tr style = "position:relative;top:175px;border:0px solid black;color:black;width:100px;height:15px;">
		<td style = "border:0px solid black;color:black;width:290px;"><center>'.$checkby.'</td>
		<td colspan = "2" style = "border:0px solid black;color:black;width:60px;"><center></td>
		<td colspan = "" style = "border:0px solid black;color:black;width:60px;"><center>'.$notesby.'</td>

		</tr>';*/
		echo '</table>';
		echo '<div style = "position:absolute;top:480px;left:100px;margin:0px;line-height: 0 !important;font-size: 13px;"><center>'.$checkby.'</div>';
		echo '<div style = "position:absolute;top:480px;left:600px;margin:0px;line-height: 0 !important;font-size: 13px;"><center>'.$notesby.'</div>';
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