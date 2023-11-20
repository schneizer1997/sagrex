<?php
echo "<head><meta http-equiv='refresh' content='30'></head>";
include('../../classes/inc/dbCon.php');

	session_start();
	global $db;
	$appendurlid = $_GET['mwrfid1'];

	$sql = "SELECT  *FROM tblrequestmaterials WHERE MWRFID = '".$appendurlid."' AND isdelete = 2 OR MWRFID = '".$appendurlid."' AND isdelete = 1 ORDER BY MWRFID DESC";
	$result=$db->query($sql);
	$c=1;
	if ($result->num_rows > 0 ){
		while ($row=$result->fetch_assoc()){
			$materialsid = $row['MaterialsID'];
			$mwrfid= $row['MWRFID'];
			$materials= preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '',$row['Materials']);
			$qty = $row['Quantity'];

					echo '<form action = "loadmaterials.php" method = "GET">';
					echo '<table class="table table-bordered table-hover table-info" cellspacing="0" style= "width:100%;table-layout: fixed;margin-bottom: -15px;">';
					echo '<tr>';
					echo '<td style = "width:450px">'.$row['Materials'].'</td>';
					echo '<td style = "width:90px">'.$row['Quantity'].'</td>';
					echo '<td> 
					<button type="button" class="btn btn-primary" name="btnviewmat1" id="'.$materialsid.'"  onclick=\'(parent.deletematerials("'.$materialsid.'"))\'>Delete
					</button>
					<button type="button" class="btn btn-primary" name="btnviewmat" id="'.$materialsid.'"  onclick=\'(parent.selectmaterials("'.$materialsid.'","'.$materials.'","'.$qty.'"))\'>Select
					</button>
					</td>
                        <input type="hidden" name = '.$mwrfid.' value='.$mwrfid.' id="getIdsem'.$c.'">';
					echo '</tr>';
					echo "</table>";
					echo "</form>";	
			}
		}

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>

	<link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template-->
  <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="../../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../../css/sb-admin.css" rel="stylesheet">
</head>
<body>
	<script src="../../vendor/datatables/jquery.dataTables.js"></script>
    <script src="../../vendor/datatables/dataTables.bootstrap4.js"></script>
	<script type="text/javascript">
	</script>
</body>
</html>