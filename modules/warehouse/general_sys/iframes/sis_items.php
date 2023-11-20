<?php

include('../../../../classes/inc/dbCon.php');

//session_start();
global $db;
$appendurlid = $_GET['mwrfid'];
$sql = "SELECT mwrf.MaterialsID,mwrf.MWRFID,mwrf.Materials,mwrf.Quantity,mwrf.UnitPrice,mwrf.Amount,mwrf.Shop,mwrf.RRNo FROM inventorydatabase.rrinfo AS rr LEFT JOIN dx_requestform.tblrequestmaterials AS mwrf ON rr.rrno = mwrf.RRNo where mwrf.MWRFID = '".$appendurlid."'";
$result=$db->query($sql);
$c=1;

echo '<form action = "mwrf_items.php" method = "GET">';
echo '<table class="table table-striped table-bordered table-hover table-info" cellspacing="0" style= "width:100%;table-layout: fixed;margin-bottom: -15px;overflow-y: auto; height: 100px;">';
echo '<thead style = "position: sticky; top: 0;background-color:#17A2B8;">';
echo '<tr>';
echo '<th>Materials</th><th>Qty</th><th>UP</th><th>Vendor</th><th>Action</th>';
echo '</tr>';
echo '</thead>';

if ($result->num_rows > 0 ){
	while ($row=$result->fetch_assoc()){
		$materialsid = $row['MaterialsID'];
		$materials = $row['Materials'];
		$qty = $row['Quantity'];
		$up = $row['UnitPrice'];
		$shop = $row['Shop'];
		$amount = $row['Amount'];
		//die($materials);

		echo '<tr>';
		echo '<td style = "width:450px;">'.$row['Materials'].'</td>';
		echo '<td style = "width:90px;">'.$row['Quantity'].'</td>';
		echo '<td style = "width:90px;">'.$row['UnitPrice'].'</td>';
		echo '<td style = "width:90px;">'.$row['Shop'].'</td>';
		echo '<td style = "width:90px;">
		<button type="button" id = "'.$materialsid.'" class="btn btn-primary" onclick = \'(parent.selectmaterial("'.$materials.'","'.$qty.'","'.$up.'","'.$amount.'"))\'>Select</button></td>';
		echo '</tr>';

	}
}

echo '</table>';
echo '</form>';
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>

	<link href="../../../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="../../../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="../../../../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
	<link href="../../../../vendor/datatables/css/scroller.bootstrap.min.css" rel="stylesheet">
	<link href="../../../../css/sb-admin.css" rel="stylesheet">
</head>
<body>
	<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="../../../../vendor/jquery/jquery.min.js"></script>
	<script src="../../../../vendor/jquery-easing/jquery.easing.min.js"></script>
	<script src="../../../../vendor/datatables/jquery.dataTables.js"></script>
	<script src="../../../../vendor/datatables/dataTables.bootstrap4.js"></script>
	<script src="../../../../vendor/datatables/js/dataTables.scroller.min.js"></script>
	<script type="text/javascript">

	</script>
</body>
</html>