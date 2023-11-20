<?php
include('../../../../classes/inc/dbCon.php');
// Load data in maintenance module

global $dbinv;
$appendurlrr = $_GET['rrno'];


//var_dump($result);

echo '<form action = "mwrf_items.php" method = "GET">';
echo '<table class="table table-striped header-fixed table-bordered table-hover table-info " id ="tblnewitemsis" cellspacing="0" style= "width:100%;table-layout: fixed;margin-bottom: -15px;overflow-y: auto; height: 100px;">';
echo '<div>';
echo '<thead style = "position: sticky; top: 0;background-color:#17A2B8;z-index:999;">';
echo '<tr>';
echo '<div id = "wew" style = "position:sticky;" width="100%">';
echo '<th>Select</th><th>ID</th><th>Description</th><th>RR Item Qty Declared</th><th>SIS Item Qty Issue</th><th>Action</th>';
echo '</tr>';
echo '</div>';
echo '</thead>';
echo '</div>';
echo '<tbody style = "overflow-y: scroll;">';
$sql = "SELECT
  *,
tir.item_id AS tir_id,
tir.qty AS qtyrr,
tir.rrno AS tirrrno
FROM
tblitemsrr AS tir 
LEFT JOIN item 
ON tir.`item_id` = item.`MyID`  
WHERE tir.rrno = '".$appendurlrr."' 
ORDER BY tir.item_id DESC ";

$result=$dbinv->query($sql);
$c=0;
if ($result->num_rows > 0){
	while ($row=$result->fetch_assoc()){
		//$temp_id = $row['temp_id'];
		$itemrr_id = $row['itemrr_id'];
		$item_id = $row['tir_id'];
		$description = $row['Description'];
		$unit = $row['UnitOfMeasureSetRefListID'];
		$qtyrr = $row['qtyrr'];
		//$qtysis = $row['qtysis'];
		//$sisno = $row['sisno'];
		$rrno = $row['tirrrno'];
		$sqlcountbal = "SELECT 
  *,tir.`qty` AS rrqty
		, tis.`qty` as sisqty
		, tis.item_id as sisitemid  
		FROM
		tblitemsis as tis 
		LEFT JOIN item as i 
		on i.`MyID` = tis.`item_id` 
		LEFT JOIN sisinfo AS infosis 
		ON infosis.rrno = tis.rrno 
		AND infosis.`issued_nos` = tis.`sisno`
		left join tblitemsrr as tir 
		on tir.`item_id` = tis.`item_id`
		AND tir.`rrno` = tis.`rrno`  
		LEFT JOIN `tblcustomer` AS tc 
		ON tc.`cust_id` = infosis.`cust_id` 
		LEFT JOIN tbladdress AS ta 
		ON ta.`addr_id` = infosis.`addr_id` 
		WHERE tis.`item_id` = '".$item_id."' 
		AND tis.rrno = '".$rrno."' 
		AND tis.`isdelete` = 1 ";

		$result2=$dbinv->query($sqlcountbal);

		echo '<tr>';
		/*echo '<td><input type = "checkbox" id = "txtchkboxsis'.$c.'" class = "form-check-input" style = "width:90px;"></td>';*/
		echo '<td>'.$result2->num_rows.'</td>';
		echo '<td>'.$item_id.'</td>';
		echo '<td>'.$description.'</td>';
		/*echo '<td>'.$sisno.'</td>';*/
		echo '<td>'.$qtyrr.'</td>';
		echo '<td><input type = "text" class = "form-control" id = "txtqtysis'.$c.'" onkeypress = "return isNumber(event)"></input><input type = "hidden" class = "form-control" id = "txtqtysishid'.$c.'"></input></td>';
		/*echo '<td><input type = "text" class = "form-control" id = "txtqtysishid'.$c.'" value = "'.$qtysis.'"></input></td>';*/
		echo '<td>
		<button type = "button" id = "btnnewitem'.$c.'" onclick =\'(parent.selectsisview("'.$rrno.'","'.$item_id.'","'.$c.'"))\' class = "btn btn-primary">Select</button>
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
	<style type="text/css">

		/*tr{cursor: pointer; transition: all .25s ease-in-out}
		.selected{background-color: red; font-weight: bold; color: #fff;}*/

		.well {
			background: none;
		}

		.table-hover > tbody > tr:hover > td,
		.table-hover > tbody > tr:hover > th {
			background-color: #343a40;
			color: white;
		}
	</style>
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
		$('#tblnewitemsis tbody tr').click(function() {
			$(this).addClass('bg-dark text-white').siblings().removeClass('bg-dark text-white');
			//$(this).addClass('text-*').siblings().removeClass('text-*');
		});
	</script>
</body>
</html>