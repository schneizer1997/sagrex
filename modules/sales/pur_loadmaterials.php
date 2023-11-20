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
	$total = 0;
	if ($result->num_rows > 0 ){

		while ($row=$result->fetch_assoc()){
			$materialsid = $row['MaterialsID'];
			$mwrfid= $row['MWRFID'];
			$materials= preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '',$row['Materials']);
			$qty = $row['Quantity'];
			$unit = $row['UnitPrice'];
			$amount = $row['Amount'];
			$dategrant = $row['DateGrandted'];
			$shop = $row['Shop'];
			$tt = $row['RequestType'];

			$total = (int)$total + (int)$amount;
			//var_dump($total);
			//die($wv); 
			//error_reporting(E_ALL);

					echo '<form action = "loadmaterials.php" method = "GET">';
					/*echo "<div style='border:1px solid red;height:0px;min-width:500px;float:right;margin-right:2px;'>";*/
					echo '<table width = "100%" class="table table-bordered" cellspacing="0">';
					echo '<tr>';
					echo '<td style = "min-width:200px;">'.$row['Materials'].'</td>';
					echo '<td style = "min-width:50px;">'.$row['Quantity'].'</td>';
					echo '<td style = "min-width:130px;">'.$row['UnitPrice'].'</td>';
					echo '<td style = "min-width:130px;">'.$row['Amount'].'</td>';
					echo '<td style = "min-width:100px;">'.$row['DateGrandted'].'</td>';
					echo '<td style = "min-width:150px;">'.$row['Shop'].'</td>';
					echo '<td style = "min-width:150px;">'.$row['RequestType'].'</td>';
					echo '<td> 
					
					<button type="button" class="btn btn-primary" name="btnviewmat" id="'.$materialsid.'"  onclick=\'(parent.selectmaterials("'.$materialsid.'","'.$materials.'","'.$qty.'","'.$unit.'","'.$amount.'","'.$dategrant.'","'.$shop.'","'.$tt.'"))\'>Select
					</button>
					</td>
                        <input type="hidden" name = '.$mwrfid.' value='.$mwrfid.' id="getIdsem'.$c.'">';
					echo '</tr>';
					echo "</table>";
					/*echo "</div>";*/
					echo "</form>";	
			}
			echo "<div style = 'margin-right:5px;float:right;'>Grand Total: " . $total."</div>";
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
		
		/*function iframecall(materialsid,materials,qty){
			document.getElementById("framemat").contentWindow.updatematerials(materialsid,materials,qty);
		}*/
	</script>
</body>
</html>