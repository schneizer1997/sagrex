<?php

include('../../../../classes/inc/dbCon.php');

//session_start();
global $db;
$appendurlid = $_GET['mwrfid'];
//die($appendurlid);
$sql = "SELECT * FROM tblrequestmaterials LEFT JOIN inventorydatabase.`rrinfo` AS irr ON tblrequestmaterials.`RRNo` = irr.`rrno` LEFT JOIN inventorydatabase.`tblcustomer` AS tc ON irr.`vendor_id` = tc.cust_id LEFT JOIN inventorydatabase.tblpersonnel_ware AS tpw 
ON irr.`pers_id_ware` = tpw.`pers_id`
LEFT JOIN inventorydatabase.tblpersonnel_dept as tpd
ON irr.pers_id_dept = tpd.pers_id
WHERE MWRFID = '".$appendurlid."' AND `tblrequestmaterials`.isdelete = 2 OR MWRFID = '".$appendurlid."' AND tblrequestmaterials.isdelete = 1 ORDER BY MWRFID DESC ";
$result=$db->query($sql);
$c=0;

echo '<form action = "mwrf_items.php" method = "GET">';
echo '<table class="table table-striped header-fixed table-bordered table-hover table-info " id ="tblrr" cellspacing="0" style= "width:100%;table-layout: fixed;margin-bottom: -15px;overflow-y: auto; height: 100px;">';
echo '<div>';
echo '<thead style = "position: sticky; top: 0;background-color:#17A2B8;z-index:999;">';
echo '<tr>';
echo '<div id = "wew" style = "position:sticky;" width="100%">';
echo '<th style = "width:70px;">No. RR</th><th>Materials</th><th>Qty</th><th>Unit Price</th><th width = "20%">Shop</th><th>RR Item qty Declare</th><th>Action</th>';
echo '</tr>';
echo '</div>';
echo '</thead>';
echo '</div>';
echo '<tbody style = "overflow-y: scroll;">';
if ($result->num_rows > 0 ){
	//echo '<td>'.$resultcount->num_rows.'</td>';	
	while ($row=$result->fetch_assoc()){
		try {
			$materialsid = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['MaterialsID']);
			$materials = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['Materials']);
			$qty = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['Quantity']);
			$up = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['UnitPrice']);
			$shop = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['Shop']);
			$amount = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['Amount']);
			$rrno = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['RRNo']);
		//die($materials);
			$vendor_id = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['vendor_id']);
			$addr_id = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['addr_id']);
			$reference = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['reference']);
			$pers_id_ware = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['pers_id_ware']);
			$pers_id_dept = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['pers_id_dept']);
			$cust_name = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['cust_name']);
			$cust_addr = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['cust_addr']);
			$client_date = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['client_date']);
			$fullname_ware = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['fullname_ware']);
			$fullname_dept = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['fullname_dept']);

			echo '<tr>';
			$sqlcount = "SELECT *FROM tblmaterialsrr AS tms JOIN dx_requestform.`tblrequestmaterials` AS dxtms ON tms.`mwrf_mat_id` = dxtms.`MaterialsID` WHERE tms.`mwrf_mat_id` = '".$materialsid."' AND tms.`isdelete` = 1";
			$resultcount=$dbinv->query($sqlcount);
			if ($resultcount->num_rows >= 0 ){
				echo '<td style = "width:70px;">'.$resultcount->num_rows.'</td>';	
			/*while ($rows=$resultcount->fetch_assoc()){
				$cc++;
				//echo '<td>'.$cc.'</td>';

			}*/
		}

		
		/*echo '<td><input type = "checkbox" id = "txtchkbox'.$c.'" class = "form-check-input" style = "width:90px;"></td>';*/
		echo '<input type = "hidden" id = "txtmatid'.$c.'" class = "form-control" style = "width:90px;"  value = "'.$materialsid.'">';
		echo '<td contenteditable="true" style = "width:450px;">'.$row['Materials'].'</td>';
		echo '<td style = "width:90px;">'.$row['Quantity'].'</td>';
		echo '<td style = "width:90px;">'.$row['UnitPrice'].'</td>';
		echo '<td style = "width:90px;">'.$row['Shop'].'</td>';
		/*echo '<td style = "width:90px;">'.$row['RRNo'].'</td>';*/
		echo '<td><input type = "text" id = "txtrrqty'.$c.'" class = "form-control" style = "width:90px;"  ></td>';

		echo '<td style = "width:90px;">

		<button type="button" id = "btnselect'.$c.'" name = "btnselecttorr" class="btn btn-primary" onclick = \'(parent.selectmaterial("'.$materials.'","'.$qty.'","'.$up.'","'.$amount.'","'.$materialsid.'","'.$rrno.'","'.$vendor_id.'","'.$addr_id.'","'.$reference.'","'.$pers_id_ware.'","'.$pers_id_dept.'","'.$client_date.'","'.$cust_name.'","'.$cust_addr.'","'.$fullname_ware.'","'.$fullname_dept.'","'.$c.'"))\'>SELECT</button>
		</td>';
		/*<button type="button" id = "btndelete'.$c.'" name = "btndelete" class="btn btn-danger" onclick = \'(parent.selectmaterialdelete("'.$materials.'","'.$qty.'","'.$up.'","'.$amount.'","'.$materialsid.'","'.$rrno.'","'.$vendor_id.'","'.$addr_id.'","'.$reference.'","'.$pers_id_ware.'","'.$pers_id_dept.'","'.$client_date.'","'.$cust_name.'","'.$cust_addr.'","'.$fullname_ware.'","'.$fullname_dept.'","'.$c.'"))\'><i class="fas fa-trash" style="margin-right: 5px;"></i></button>*/
		
		echo '</tr>';
	} catch (Exception $e) {
		var_dump($e);
	}

	$c++;
}
}
echo '<td><input type = "hidden" id = "txtcount" class = "form-control" style = "width:90px;"  value = "'.$c.'"></td>';
echo '</tbody>';
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
	<script src="../../../../vendor/datatables/jquery.stickytableheaders.js"></script>
	<script src="../../../../vendor/datatables/jquery.stickytableheaders.min.js"></script>
	<script type="text/javascript">
		//$("#tblrr").stickyTableHeaders();
		$('#tblrr tbody tr').click(function() {
			$(this).addClass('bg-dark text-white').siblings().removeClass('bg-dark text-white');
			//$(this).addClass('text-*').siblings().removeClass('text-*');
		});
		$('[name=btnselecttorr]').click(function(){
			//alert('sds');
			window.parent.document.getElementById("btnrrupdate").disabled=true;
			window.parent.document.getElementById("btnrrsave").disabled=false;
			window.parent.document.getElementById("btnprintrr").disabled=true;
			window.parent.document.getElementById("btnrrdelete").disabled=true;
			//$('#btnrrupdate').removeAttr('disabled');

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
/*var count = $('#txtcount').val();
var clicked = true;
//var s = array();
var temp = -1;
var arr = [];
for(var i = 0; i <= count;i++){
if (arr[i] == i){
	$('#btnselect'+i).css('background-color','red');	
	}
	
	arr[i] = i;
	$('#btnselect'+i).click(function(){
	$(this).css('background-color','yellow');
	if (arr[i] == i){
	$('#btnselect'+i).css('background-color','red');	
}*/
	/*var color = clicked ? 'red' : 'blue';
    $(this).css('background-color', color);
    clicked = !clicked;*/

    /*if (!clicked == false){
    	$(this).css('background-color',color);

    }	*/
	/*if (temp == i){
		$('btnselect'+temp)
	}*/
	//alert(temp);
	/*var prev = $('#btnselect').prev();
	prev.css('color','white');*/
/*});
}*/
/*$(document).ready(function() {
    var table = $('#example').DataTable( {
        fixedHeader: {
            header: true,
            footer: true
        }
    } );
} );*/

</script>
</body>
</html>