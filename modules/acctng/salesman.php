<?php
include('../../classes/inc/dbConBIR.php'); 
global $dbir;

$sql = "SELECT *FROM salesman";
$result=$dbir->query($sql);
	//$c=1;
if ($result->num_rows > 0){
	while ($row=$result->fetch_assoc()){
		echo '<tr>';
		echo '<td>'.$row['Fname'].'</td>';
		echo '<td>'.$row['Mname'].'</td>';
		echo '<td>'.$row['Lname'].'</td>';
		echo '<td>'.$row['Location'].'</td>';
		echo '<td>'.$row['Category'].'</td>';
		echo '<td> 
					<button type="button" class="btn btn-primary" name="btnviewmat1" id="">Select
					</button>
					</td>';

		echo "</tr>";
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template-->
  <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="../../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- Custom styles for this template-->
  <link href="../../css/sb-admin.css" rel="stylesheet">
	<title></title>
</head>
<body>

</body>
</html>