<?php
include('../../../classes/inc/dbCon.php');
global $dbinv;
//$appendurlid = $_GET['rrno'];

$sql = "SELECT 
  * , rri.rrno as rrnoall, rri.addr_id as rraddr_id, sis.addr_id as sisaddr_id, rri.`reference` as rref
FROM
rrinfo AS rri 
LEFT JOIN tblcustomer AS cust 
ON rri.`vendor_id` = cust.`cust_id` 
LEFT JOIN tbladdress AS addr 
ON rri.`addr_id` = addr.`addr_id`
LEFT JOIN  tblpersonnel_dept AS tpd
ON rri.`pers_id_dept` = tpd.`pers_id`
LEFT JOIN `tblpersonnel_ware` AS tpw
ON rri.`pers_id_ware` = tpw.`pers_id`
LEFT JOIN sisinfo AS sis
ON rri.`rrno` = sis.`issued_nos`
ORDER BY rri.`rr_id` DESC";

$result=$dbinv->query($sql);
$c=1;

if ($result->num_rows > 0){
	while ($row=$result->fetch_assoc()){
		$rr_id = $row['rr_id'];
		$rrno = $row['rrnoall'];
		$vendor_id = $row['vendor_id'];
		$addr_id = $row['rraddr_id'];
		$cust_name = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['cust_name']);
		$addr_name = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['addr_name']);
		$client_date = $row['client_date'];
		$reference = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['rref']);
		//var_dump($reference);
		$pers_id_ware = $row['pers_id_ware'];
		$pers_id_dept = $row['pers_id_dept'];
		$fullname_ware = $row['fullname_ware'];
		$fullname_dept = $row['fullname_dept'];
		//SIS
		$issued_nos = $row['issued_nos'];
		$sisdate = $row['issued_date'];
		$cust_idsis = $row['cust_id'];
		$addr_idsis = $row['sisaddr_id'];
		$loc = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['location']);
		//$reference = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['reference']);
		$remarks = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['remarks']);

		echo '<tr>';
		echo '<td style= "width:100px;">'.$rrno.'</td>';
		echo '<td style= "width:200px;">'.$cust_name.'</td>';
		echo '<td style= "width:120px;">'.$reference.'</td>';
		echo '<td style= "width:120px;">'.$client_date.'</td>';
		echo '<td>

		<button type="button" class="btn btn-info" id="btnnewitemrr'.$c.'"  onclick=\'selectrr("'.$rr_id.'","'.$rrno.'","'.$vendor_id.'","'.$addr_id.'","'.$cust_name.'","'.$addr_name.'","'.$client_date.'","'.$reference.'","'.$pers_id_dept.'","'.$fullname_ware.'","'.$fullname_dept.'")\'><i style="padding-right: 2px;" class="far fa-edit"></i>RR</button>
		<button type="button" class="btn btn-info" id="btnnewitemsis'.$c.'"  onclick=\'selectsis("'.$rrno.'","'.$cust_idsis.'","'.$addr_idsis.'","'.$loc.'","'.$reference.'","'.$remarks.'","'.$sisdate.'","'.$cust_name.'","'.$addr_name.'")\'><i style="padding-right: 2px;" class="far fa-edit"></i></i>SIS</button>
		</td>';
		echo '</tr>';
		$c++;
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<link href="../../../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<link href="../../../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="../../../../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

	<link href="../../../../css/sb-admin.css" rel="stylesheet">
	<title></title>
</head>
<body>

</body>
</html>