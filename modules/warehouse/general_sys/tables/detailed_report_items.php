<?php
global $dbinv;

$sql = "SELECT *FROM item ";

$result=$dbinv->query($sql);
$c=0;
if ($result->num_rows > 0){
	while ($row=$result->fetch_assoc()){
		$MyID = $row['MyID'];
		$Description = $row['Description'];
		$unit = $row['UnitOfMeasureSetRefFullName'];
		echo '<tr>';
		echo '<td style = "width:90px;">'.$MyID.'</td>';
		echo '<td style = "width:90px;">'.$Description.'</td>';
		echo '<td style = "width:90px;">'.$unit.'</td>';
		echo '<td><button type = "button" onclick = \'(parent.selectitem("'.$MyID.'","'.$Description.'"))\' class = "btn btn-primary">Select</button></td>';
		echo '</tr>';	
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<link href="../../../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="../../../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="../../../../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
	<link href="../../../../vendor/datatables/css/scroller.bootstrap.min.css" rel="stylesheet">
	<link href="../../../../css/sb-admin.css" rel="stylesheet">

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