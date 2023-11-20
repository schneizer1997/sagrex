<?php

include('../../../../classes/inc/dbCon.php');

//session_start();
global $dbinv;
$appendurlid = $_GET['matid'];
//die($appendurlid);
$sql = "SELECT *FROM tblmaterialsrr AS tms JOIN dx_requestform.`tblrequestmaterials` AS dxtms ON tms.`mwrf_mat_id` = dxtms.`MaterialsID` LEFT JOIN rrinfo as inforr 
    on inforr.`rrno` = tms.`rrno`
    LEFT JOIN tblcustomer as cust
    on cust.`cust_id` = inforr.`vendor_id`
    left join tbladdress as addr 
    on addr.`addr_id` = inforr.`addr_id`
    LEFT JOIN inventorydatabase.tblpersonnel_ware AS tpw 
    ON inforr.`pers_id_ware` = tpw.`pers_id` 
  LEFT JOIN inventorydatabase.tblpersonnel_dept as tpd 
  ON inforr.pers_id_dept = tpd.pers_id
     WHERE tms.`mwrf_mat_id` = '".$appendurlid."' AND tms.`isdelete` = 1";
$result=$dbinv->query($sql);
$c=0;

echo '<form action = "mwrf_items.php" method = "GET">';
echo '<table class="table table-striped table-bordered table-hover table-info" id ="tblrrqty" cellspacing="0" style= "width:100%;table-layout: fixed;margin-bottom: -15px;overflow-y: auto; height: 100px;">';
echo '<thead style = "position: sticky; top: 0;background-color:#17A2B8;">';
echo '<tr>';
echo '<th>RRNO</th><th>Item RR Qty</th><th>Balance</th><th>Action</th>';
echo '</tr>';
echo '</thead>';
$balance = "";
$balance2 = array();
if ($result->num_rows > 0 ){
	while ($row=$result->fetch_assoc()){
		$mat_rr_id = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['mat_rr_id']);
		$materialsid = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['MaterialsID']);
		$materials = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['Materials']);
		$qty = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['Quantity']);
		$up = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['UnitPrice']);
		$shop = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['Shop']);
		$amount = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['Amount']);
		$rrno = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['rrno']);
		//die($materials);
		$vendor_id = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['vendor_id']);
		//die($vendor_id);
		$addr_id = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['addr_id']);
		$reference = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['reference']);
		$pers_id_ware = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['pers_id_ware']);
		$pers_id_dept = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['pers_id_dept']);
		$cust_name = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['cust_name']);
		$cust_addr = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['addr_name']);
		$client_date = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['client_date']);
		$fullname_ware = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['fullname_ware']);
		$fullname_dept = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['fullname_dept']);
		/*$materialsid = $row['MaterialsID'];
		$materials = $row['Materials'];
		$qty = $row['Quantity'];
		$up = $row['UnitPrice'];
		$shop = $row['Shop'];
		$amount = $row['Amount'];
		$rrno = $row['RRNo'];*/
		//die($materials);
		if (sizeof($balance2) > 0){
		$rr_qty = $row['qty'];
		$balance = $balance - $rr_qty;	
		$balance2[$c] = $balance;
		}

		else if(sizeof($balance2) < 1) {
		$mwrf_qty = $row['Quantity'];
		$rr_qty = $row['qty'];
		$balance = $mwrf_qty - $rr_qty;
		$balance2[$c] = $balance;
		}
		echo '<tr>';
		echo '<td style = "width:90px;">'.$row['rrno'].'</td>';
		echo '<td style = "width:90px;" contenteditable="true" id = "txtrrqty'.$c.'">'.$rr_qty.'</td>';
		echo '<td style = "width:90px;">'.abs($balance).'</td>';
		echo '<td style = "width:90px;">
		<button type="button" id = "btnselectrr'.$c.'" name = "btnselectrr" class="btnselectsis btn btn-primary" onclick = \'(parent.selectmaterialbal("'.$mat_rr_id.'","'.$materials.'","'.$qty.'","'.$up.'","'.$amount.'","'.$materialsid.'","'.$rrno.'","'.$vendor_id.'","'.$addr_id.'","'.$reference.'","'.$pers_id_ware.'","'.$pers_id_dept.'","'.$client_date.'","'.$cust_name.'","'.$cust_addr.'","'.$fullname_ware.'","'.$fullname_dept.'","'.$c.'"))\'>Select</button></td>';
		/*onclick = \'(parent.selectmaterialsis("'.$materials.'","'.$qty.'","'.$up.'","'.$amount.'","'.$materialsid.'","'.$rrno.'","'.$date_issued.'","'.$issued_nos.'","'.$addr_id.'","'.$addr_name.'","'.$loc.'","'.$reference.'","'.$remarks.'","'.$cust_name.'","'.$cust_id.'","'.$c.'"))\'*/
		echo '</tr>';
		$c++;
	}
}
else {
	echo '<tr>';
	echo '<td colspan = "3" style = "width:90px;"><center>No result found.<center></td>';
	echo '</tr>';
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
		//$("#tblrrqty").stickyTableHeaders();
		//$('#btnrrupdate').removeAttr('disabled');
		$('[name=btnselectrr]').click(function(){
			//alert('sds');
			window.parent.document.getElementById("btnrrupdate").disabled=false;
			window.parent.document.getElementById("btnrrsave").disabled=true;
			window.parent.document.getElementById("btnprintrr").disabled=false;
			window.parent.document.getElementById("btnrrdelete").disabled=false;
			//$('#btnrrupdate').removeAttr('disabled');

		});
		$('#tblrrqty tbody tr').click(function() {
			$(this).addClass('bg-dark text-white').siblings().removeClass('bg-dark text-white');
			//$(this).addClass('text-*').siblings().removeClass('text-*');
		});
		/*$('.btnselectrr').click(function(){
			alert('sad');
		});*/
		//document.getElementById("").disabled = true;
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


</script>
</body>
</html>