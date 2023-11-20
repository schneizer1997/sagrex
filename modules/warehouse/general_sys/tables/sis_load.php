<?php
/*include('../../../classes/inc/dbConInventory.php');*/
include('../../../classes/inc/dbCon.php');
// Load data in maintenance module

global $dbinv;

$sql = "SELECT issued_nos, rrno,reference,datecreated FROM sisinfo LEFT JOIN tblcustomer ON tblcustomer.cust_id = sisinfo.cust_id LEFT JOIN tbladdress ON tbladdress.addr_id = sisinfo.addr_id";
//var_dump($sql);

$result=$dbinv->query($sql);
$c=1;
//var_dump($result);
if ($result->num_rows > 0){
	while ($row=$result->fetch_assoc()){
		echo "<tr>";
		echo '<td>'.$row['issued_nos'].'</td>';
		echo '<td style= "width:200px;">'.$row['rrno'].'</td>';
		echo '<td style= "width:120px;">'.$row['reference'].'</td>';
		echo '<td style= "width:120px;">'.$row['datecreated'].'</td>';
		echo '</tr>';
		/*echo '<td><button type="button" class="btn btn-primary" id=""  onclick="viewrrsis()"><i style="padding-right: 2px;" class="fa fa-plus-square"></i>Select</button></td>';
		echo "</tr>";*/
	}

}

?>
<!DOCTYPE html>
<html>
<head>
	<link href="../../../../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<!-- Custom fonts for this template-->
	<link href="../../../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

	<!-- Page level plugin CSS-->
	<link href="../../../../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->

	<!-- Custom styles for this template-->
	<link href="../../../../css/sb-admin.css" rel="stylesheet">
	<title></title>
</head>
<body>

</body>
</html>