<?php

include('../../../../classes/inc/dbCon.php');

//session_start();
global $dbinv;
$appendurlid = $_GET['mwrfid'];
//die($appendurlid);
$sql = "SELECT 
tbm.`MaterialsID`,
tbm.`Materials`,
tbm.`Quantity` AS mwrfqty,
tbm.`Quantity`,
tbm.`UnitPrice`,
tbm.`Amount`,
tbm.`Shop`,
tbr.`rrno` AS RRNo,
tbr.`qty` AS rrdeclaredqty

FROM
`tblmaterialsrr` AS tbr 
LEFT JOIN `dx_requestform`.`tblrequestmaterials` AS tbm 
ON tbm.`MaterialsID` = tbr.`mwrf_mat_id` 
LEFT JOIN rrinfo AS inforr
ON inforr.`rrno` = tbr.`rrno` 

WHERE tbr.`mwrf_req_id` = '".$appendurlid."' AND tbr.`isdelete` = 1
ORDER BY tbr.`rrno` ASC";
$result=$dbinv->query($sql);
$c=0;
$cc = 0;

echo '<form action = "mwrf_items.php" method = "GET">';
echo '<table class="table table-striped table-bordered table-hover table-info" id ="tblsis" cellspacing="0" style= "width:100%;table-layout: fixed;margin-bottom: -15px;overflow-y: auto; height: 100px;">';
echo '<thead style = "position: sticky; top: 0;background-color:#17A2B8;">';
echo '<tr>';
echo '<th>No. of SIS</th><th>RRNo</th><th>Materials</th><th>Shop</th><th>RR Item Qty Declared</th><th>SIS Item Qty Issue</th><th>Action</th>';
echo '</tr>';
echo '</thead>';

if ($result->num_rows > 0 ){
	while ($row=$result->fetch_assoc()){

		$materialsid = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['MaterialsID']);
		$materials = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['Materials']);
		$rrno = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['RRNo']);
		$qty = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['rrdeclaredqty']);
		$shop = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['Shop']);
/*		$qty = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['rrdeclaredqty']);
		$up = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['UnitPrice']);
		$amount = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['Amount']);
		$shop = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['Shop']);
		$date_issued = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['issued_date']);
		$issued_nos = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['issued_nos']);
		$addr_id = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['addr_id']);
		$addr_name = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['addr_name']);
		$loc = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['location']);
		$reference = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['reference']);
		$remarks = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['remarks']);
		$cust_name = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['cust_name']);
		$cust_id = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['cust_id']);*/

		echo '<tr>';
		$sqlcount = "SELECT DISTINCT
		tms.`rrno`,tms.`sisno`,tms.`qty`,tms.`mwrf_mat_id`,tms.`mwrf_req_id`,tms.`isdelete`,dxtms.Quantity,tmr.`qty` AS qtyrr
		FROM
		tblmaterialsis AS tms 
		LEFT JOIN dx_requestform.`tblrequestmaterials` AS dxtms 
		ON tms.`mwrf_mat_id` = dxtms.`MaterialsID` 
		LEFT JOIN `tblmaterialsrr` AS tmr 
		ON tmr.`rrno` = tms.`rrno`
		WHERE tms.`mwrf_mat_id` = '".$materialsid."' and tms.rrno = '".$rrno."'
		AND tms.`isdelete` = 1";
		$resultcount=$dbinv->query($sqlcount);
		if ($resultcount->num_rows >= 0 ){
			echo '<td>'.$resultcount->num_rows.'</td>';	
			/*while ($rows=$resultcount->fetch_assoc()){
				$cc++;
				//echo '<td>'.$cc.'</td>';

			}*/
		}
		
		/*echo '<td><input type = "checkbox" id = "txtchkboxsis'.$c.'" class = "form-check-input" style = "width:90px;"></td>';*/

		echo '<td id = "txtrrno'.$c.'" style = "width:90px;">'.$row['RRNo'].'</td>';
		echo '<input type = "hidden" id = "txtmatidsis'.$c.'" class = "form-control" style = "width:90px;"  value = "'.$materialsid.'">';
		echo '<td contenteditable="true" style = "width:450px;">'.$row['Materials'].'</td>';
		echo '<td style = "width:90px;">'.$shop.'</td>';
		/*echo '<td style = "width:90px;">'.$row['Quantity'].'</td>';
		echo '<td style = "width:90px;">'.$row['UnitPrice'].'</td>';*/
		
		echo '<td style = "width:90px;">'.$qty.'</td>';
		echo '<td><input type = "text" id = "txtsisqty'.$c.'" class = "form-control" style = "width:90px;"  ></td>';
		/*echo '<td style = "width:90px;">
		<button type="button" id = "btnselectsis'.$c.'" name = "btnselectsis" class="btnselectsis btn btn-primary" onclick = \'(parent.selectmaterialsis("'.$materials.'","'.$qty.'","'.$up.'","'.$amount.'","'.$materialsid.'","'.$rrno.'","'.$date_issued.'","'.$issued_nos.'","'.$addr_id.'","'.$addr_name.'","'.$loc.'","'.$reference.'","'.$remarks.'","'.$cust_name.'","'.$cust_id.'","'.$c.'"))\'>Select</button></td>';*/
		echo '<td style = "width:90px;">
		<button type="button" id = "btnselectsis'.$c.'" name = "btnselectsis" class="btnselectsis btn btn-primary" onclick = \'(parent.selectmaterialsis("'.$rrno.'","'.$materialsid.'","'.$c.'"))\'>Select</button></td>';
		echo '</tr>';
		$c++;
	}
}
echo '<td><input type = "hidden" id = "txtcountsis" class = "form-control" style = "width:90px;"  value = "'.$c.'"></td>';

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
	<!-- <script src="../../../../vendor/datatables/js/dataTables.scroller.min.js"></script> -->
	<script src="../../../../vendor/datatables/jquery.stickytableheaders.js"></script>
	<script src="../../../../vendor/datatables/jquery.stickytableheaders.min.js"></script>
	<script type="text/javascript">
		//$("#tblsis").stickyTableHeaders();
		$('#tblsis tbody tr').click(function() {
			$(this).addClass('bg-dark text-white').siblings().removeClass('bg-dark text-white');
			//$(this).addClass('text-*').siblings().removeClass('text-*');
		});
		$('[name=btnselectsis]').click(function(){
			//alert('sds');
			/*window.parent.document.getElementById("btnrrupdate").disabled=false;
			window.parent.document.getElementById("btnrrsave").disabled=true;
			window.parent.document.getElementById("btnprintrr").disabled=false;
			window.parent.document.getElementById("btnrrdelete").disabled=false;*/
			//$('#btnrrupdate').removeAttr('disabled');
			window.parent.document.getElementById("btnsissave").disabled=false;
			window.parent.document.getElementById("btnsisupdate").disabled=true;

		});
		/*var count = 0;
		var table = $('#example').DataTable();
		window.parent.$('#btnnewrr').click(function(){
			alert("wew" +table.data().count());
		//$('#txtrrqty').attr('enabled', 'enabled');
		$('#txtrrqty').each(function(){		
			count = count + 1;
			alert('wew' + count);
		});
	});*/

		/*var table = $('#example').DataTable();
		$('#btnselect').click(function(){
			var ids = $.map(table.rows('#txtrrqty').data(), function (item) {
        alert(item[0]);
        //return item[0];
    });
});*/
/*var count = $('#txtcountsis').val();
for(var i = 0; i >= count;i++){
	$('#btnselectsis' +i).click(function(){
		var name_by_id = $('#btnselectsis' + i).attr('name');
		alert(name_by_id);	
	});

}
*/


</script>
</body>
</html>