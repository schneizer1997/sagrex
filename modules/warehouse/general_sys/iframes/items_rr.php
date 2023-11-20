<?php
include('../../../../classes/inc/dbCon.php');
// Load data in maintenance module

global $dbinv;
//$appendurlid = $_GET['rrno'];


//var_dump($result);

echo '<form action = "mwrf_items.php" method = "GET">';
echo '<table class="table table-striped header-fixed table-bordered table-hover table-info " id ="tblnewitemrr" cellspacing="0" style= "width:100%;table-layout: fixed;margin-bottom: -15px;overflow-y: auto; height: 100px;">';
echo '<div>';
echo '<thead style = "position: sticky; top: 0;background-color:#17A2B8;z-index:999;">';
echo '<tr>';
echo '<div id = "wew" style = "position:sticky;" width="100%">';
echo '<th>ID</th><th>Description</th><th>Qty RR</th><th>Action</th>';
echo '</tr>';
echo '</div>';
echo '</thead>';
echo '</div>';
echo '<tbody style = "overflow-y: scroll;">';
$sql = "SELECT *FROM item_temp ORDER BY temp_id ASC  ";

$result=$dbinv->query($sql);
$c=0;
if ($result->num_rows > 0){
	while ($row=$result->fetch_assoc()){
		$temp_id = $row['temp_id'];
		$item_id = $row['item_id'];
		$description = $row['description'];
		$unit = $row['unit'];

		echo '<tr>';
		echo '<td>'.$item_id.'</td>';
		echo '<td>'.$description.'</td>';
		echo '<td><input type = "text" class = "txtqtyrr form-control" id = "txtqtyrr'.$c.'" onkeypress = "return isNumber(event)"></input></td>';
		echo '<td>
		<button type = "button" id = "btnnewitem'.$c.'" class = "btn btn-danger" onclick=\'parent.deselectitems("'.$temp_id.'","'.$item_id.'","'.$description.'", "'.$unit.'")\'><i class="fa fa-trash" style="margin-right: 5px;"></i>REMOVE</button>
		</td>';
		echo '</tr>';
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
	<script type="text/javascript">
		//var table = $('iframe[name=frameitemsrr]').contents().find('#tblnewitemrr').dataTable();
		/*function insertnewitemrr(rrno){
			//alert(rrno);
			var table = $('#tblnewitemrr').DataTable();

			table
			.column(0)
			.data()
			.each(function(value, index) {
				//alert( 'Data in index: '+index+' is: '+value );
				xajax_insertitemrr(value,rrno);
				//alert(rrno);
			} );
		}*/
		function isNumber(evt){
			var charCode = (evt.which) ? evt.which : evt.keyCode;
          if (charCode != 46 && charCode > 31 
            && (charCode < 48 || charCode > 57))
             return false;

          return true;

		}
	</script>
</body>
</html>