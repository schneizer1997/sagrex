<?php
include('../../classes/inc/dbCon.php');

	session_start();
	//include('newrequest.php');
	global $db;
	/*$_SESSION['mwrfidmaterial2'] = $_SESSION['mwrfidmaterial2'];
	$wew2 = $_SESSION['mwrfidmaterial2'];*/
	$appendurlid = $_GET['mwrfid1'];

	$sql = "SELECT  *FROM tblrequestmaterials WHERE MWRFID = '".$appendurlid."' AND isdelete = 1 ORDER BY MWRFID DESC";
	$result=$db->query ($sql);
	$c=1;
	if ($result->num_rows > 0 ){
		while ($row=$result->fetch_assoc()){
			$materialsid = $row['MaterialsID'];
			$mwrfid= $row['MWRFID'];
			$materials= preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '',$row['Materials']);
			$qty = $row['Quantity'];
			$unit = $row['UnitPrice'];
			$dategrant = $row['DateGrandted'];
			$shop = $row['Shop'];
			$tt = $row['RequestType'];
			$rrno=$row['RRNo'];
			$cbl = $row['CheckByLogistics'];
			//die($cbl); 
			//error_reporting(E_ALL);

					echo '<form action = "ware_loadmaterials.php" method = "GET">';
					/*echo "<div style='border:1px solid red;height:0px;min-width:500px;float:right;margin-right:2px;'>";*/
					echo '<table width = "100%" style= "" class="table table-bordered" cellspacing="0">';
					echo '<tr>';
					echo '<td style = "width:200px;">'.$row['Materials'].'</td>';
					echo '<td style = "width:70px;">'.$row['Quantity'].'</td>';
					echo '<td style = "width:150px;">'.$row['UnitPrice'].'</td>';
					echo '<td style = "width:100px;">'.$row['DateGrandted'].'</td>';
					echo '<td style = "width:150px;">'.$row['Shop'].'</td>';
					echo '<td style = "width:100px;">'.$row['RequestType'].'</td>';
					echo '<td style = "width:70px;">'.$row['RRNo'].'</td>';
					/*echo '<td style = "width:70px;">'.$row['CheckByLogistics'].'</td>';*/
					if ($row['CheckByLogistics'] == 1){
						echo '<td style = "width:70px;">True</td>';
					}
					else if ($row['CheckByLogistics'] == 0){
						echo '<td style = "width:70px;">False</td>';
					}
					echo '<td> 
					<button type="button" class="btn btn-primary" name="btnviewmat" id="'.$materialsid.'"  onclick=\'(parent.selectmaterials("'.$materialsid.'","'.$rrno.'","'.$cbl.'"))\'>Select
					</button>
					</td>
                        <input type="hidden" name = '.$mwrfid.' value='.$mwrfid.' id="getIdsem'.$c.'">';
					echo '</tr>';
					echo "</table>";
					/*echo "</div>";*/
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
	<script type="text/javascript">
	</script>
</body>
</html>