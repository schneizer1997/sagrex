<?php
include('../../classes/inc/dbCon.php');

	session_start();

	echo '<form action = "" method = "GET">';
echo '<table class="table table-striped header-fixed table-bordered table-hover table-info " id ="" cellspacing="0" style= "width:100%;table-layout: fixed;margin-bottom: -15px;overflow-y: auto; height: 100px;">';
echo '<div>';
echo '<thead style = "position: sticky; top: 0;background-color:#17A2B8;z-index:999;">';
echo '<tr>';
echo '<th >Materials</th>
                    <th >Quantity</th>
                    <th >Unit Price</th>
                    <th>Amount</th>
                    <th >Date Granted</th>
                    <th >Shop</th>
                    <th >Request Type</th>
                    <th >Check by Warehouse</th>
                    <th >Action</th>';
echo '</tr>';
echo '</div>';
echo '</thead>';
echo '</div>';
echo '<tbody style = "overflow-y: scroll;">';

	global $db;
	$appendurlid = $_GET['mwrfid1'];

	$sql = "SELECT  *FROM tblrequestmaterials WHERE MWRFID = '".$appendurlid."' AND isdelete = 2 OR MWRFID = '".$appendurlid."' AND isdelete = 1 ORDER BY MWRFID DESC";
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

					echo '<form action = "loadmaterials.php" method = "GET">';
					echo '<table class="table table-bordered table-hover table-info" cellspacing="0" style= "width:100%;table-layout: fixed;margin-bottom: -15px;">';
					echo '<tr>';
					echo '<td >'.$row['Materials'].'</td>';
					echo '<td >'.$row['Quantity'].'</td>';
					echo '<td >'.$row['UnitPrice'].'</td>';
					echo '<td >'.$row['Amount'].'</td>';
					echo '<td >'.$row['DateGrandted'].'</td>';
					echo '<td >'.$row['Shop'].'</td>';
					echo '<td >'.$row['RequestType'].'</td>';
					if ($row['CheckByLogistics'] == 1){
						echo '<td >True</td>';
					}
					else if ($row['CheckByLogistics'] == 0){
						echo '<td >False</td>';
					}
					echo '<td> 
					
					<button type="button" class="btn btn-primary" name="btnviewmat" id="'.$materialsid.'"  onclick=\'(parent.selectmaterials("'.$materialsid.'","'.$materials.'","'.$qty.'","'.$unit.'","'.$amount.'","'.$dategrant.'","'.$shop.'","'.$tt.'"))\'>Select
					</button>
					<button type="button" class="btn btn-primary" name="btnviewmat" id="'.$materialsid.'"  onclick=\'(parent.deletematerials("'.$materialsid.'"))\'>Delete
					</button>
					</td>
                        <input type="hidden" name = '.$mwrfid.' value='.$mwrfid.' id="getIdsem'.$c.'">';
					echo '</tr>';
					echo "</table>";
					echo "</form>";	
			}
			echo "<input type= 'hidden' id = 'txttotalamount' value = '$total'>";
		}
echo '</table>';
echo '</form>';
?>

<!DOCTYPE html>
<html>
<head>
	<link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="../../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
	<link href="../../vendor/datatables/css/scroller.bootstrap.min.css" rel="stylesheet">
	<link href="../../css/sb-admin.css" rel="stylesheet">
	<!-- Custom styles for this template-->
	<link href="../../css/sb-admin.css" rel="stylesheet">
</head>
<body>
	<script type="text/javascript">

	</script>
	<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="../../vendor/jquery/jquery.min.js"></script>
	<script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>
	<script src="../../vendor/datatables/jquery.dataTables.js"></script>
	<script src="../../vendor/datatables/dataTables.bootstrap4.js"></script>
	<script src="../../vendor/datatables/js/dataTables.scroller.min.js"></script>
	<script src="../../vendor/datatables/jquery.stickytableheaders.js"></script>
	<script src="../../vendor/datatables/jquery.stickytableheaders.min.js"></script>
	<script src="../../js/demo/datatables-demo.js" type="text/javascript"></script>
</body>
</html>