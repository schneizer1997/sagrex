<?php
//include('../../../classes/inc/dbCon.php');
//global $dbinv;
$serverName1="localhost";

$databaseName1="inventorydatabase";

$password1="OSXVD2XSQk1PhOvD";

$username1="root";
//$appendurlid = $_GET['rrno'];
$link = mysqli_connect($serverName1,$username1,$password1,$databaseName1);
$sql = "SELECT *FROM item ORDER BY MyID DESC";

//$result=$dbinv->query($sql);
$result = mysqli_query($link, $sql);
//$result = mysqli_query( $con, $query );
//var_dump($result);
if (mysqli_num_rows($result) > 0){

	while ($row=mysqli_fetch_array($result)){
		$myid = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['MyID']);
		$description = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['Description']);
		$unit = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['UnitOfMeasureSetRefFullName']);
		$timecreated = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['TimeCreated']);
		$timemodified = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['TimeModified']);
		$balance = $row['Balance'];

		echo '<tr>';
		echo '<td style= "width:100px;">'.$myid.'</td>';
		echo '<td style= "width:200px;">'.$description.'</td>';
		echo '<td style= "width:120px;">'.$unit.'</td>';
		echo '<td style= "width:120px;">'.$timecreated.'</td>';
		echo '<td><button type = "button" class = "btn btn-info" onclick=\'selectitemnew("'.$myid.'","'.$description.'","'.$unit.'")\'><i style="padding-right: 2px;" class="far fa-edit"></i>Edit</button>&nbsp;
		<button type = "button" class = "btn btn-danger" onclick=\'deletenewitem("'.$myid.'")\'><i style="padding-right: 2px;" class="far fa-trash-alt"></i>Delete</button
		</td>';
		echo '</tr>';
		}
		//$result->close();
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