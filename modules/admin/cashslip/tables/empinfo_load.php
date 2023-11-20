<?php
include('../../../../classes/inc/dbCon.php');
// Load data in maintenance module

global $dbcashslip;

echo '<form action = "mwrf_items.php" method = "GET">';
echo '<table class="table table-striped header-fixed table-bordered table-hover table-info " id ="dataTable" cellspacing="0" style= "width:100%;table-layout: fixed;margin-bottom: -15px;overflow-y: auto; height: 100px;">';
echo '<div>';
echo '<thead style = "position: sticky; top: 0;background-color:#17A2B8;z-index:999;">';
echo '<tr>';
echo '<div id = "wew" style = "position:sticky;" width="100%">';
echo '<th>ID</th><th>Description</th><th>Unit</th><th>Action</th>';
echo '</tr>';
echo '</div>';
echo '</thead>';
echo '</div>';
echo '<tbody style = "overflow-y: scroll;">';
$sql = "SELECT *FROM tblemployees ";

$result=$dbcashslip->query($sql);
$c=0;
if ($result->num_rows > 0){
	while ($row=$result->fetch_assoc()){
		

		
		$c++;
	}
}
//echo '<input type = "text" id = "txtcountitems" name = "txtcountitems" value ="'.$c.'" >';
echo '</tbody>';
echo '</table>';
echo '</form>';
?>
<!DOCTYPE html>
<html>
<head>
	<link href="../../../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="../../../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="../../../../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
	<link href="../../../../vendor/datatables/css/scroller.bootstrap.min.css" rel="stylesheet">
	<link href="../../../../css/sb-admin.css" rel="stylesheet">
	<!-- Custom styles for this template-->
	<link href="../../../../css/sb-admin.css" rel="stylesheet">
	
</head>
<body>
	<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="../../../../vendor/jquery/jquery.min.js"></script>
	<script src="../../../../vendor/jquery-easing/jquery.easing.min.js"></script>
	<script src="../../../../vendor/datatables/jquery.dataTables.js"></script>
	<script src="../../../../vendor/datatables/dataTables.bootstrap4.js"></script>
	<script src="../../../../vendor/datatables/js/dataTables.scroller.min.js"></script>
	<script src="../../../../vendor/datatables/jquery.stickytableheaders.js"></script>
	<script src="../../../../vendor/datatables/jquery.stickytableheaders.min.js"></script>
	<script src="../../../../js/demo/datatables-demo.js" type="text/javascript"></script>
	<script type="text/javascript">
		
	</script>
</body>
</html>