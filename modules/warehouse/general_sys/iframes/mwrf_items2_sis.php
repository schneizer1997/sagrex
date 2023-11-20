<?php

include('../../../../classes/inc/dbCon.php');

//session_start();
global $dbinv;
$appendurlid = $_GET['matid'];
$appendurlrrno = $_GET['rrno'];
//die($appendurlid);
$sql = "SELECT 
  tms.`rrno`,
  tms.`sisno`,
  tms.`qty`,
  tms.`mwrf_mat_id`,
  tms.`mwrf_req_id`,
  tms.`isdelete`,
  tmr.`qty` AS qtyrr,
  infosis.`cust_id`,
  infosis.`addr_id`,
  infosis.`issued_date`,
  infosis.`issued_nos`,
  infosis.`location`,
  infosis.`reference`,
  infosis.`remarks`,
  infosis.`preparedby_id`,
  infosis.`receivedby_id`,
  infosis.`notedby_id`,
  tc.`cust_id`,
  tc.`cust_name`,
  ta.`addr_id`,
  ta.`addr_name` 
FROM
  tblmaterialsis AS tms 
  LEFT JOIN `tblmaterialsrr` AS tmr 
    ON tmr.`rrno` = tms.`rrno` 
    AND tmr.`mwrf_mat_id` = tms.`mwrf_mat_id` 
  LEFT JOIN sisinfo AS infosis 
    ON infosis.`issued_nos` = tms.`sisno`
    AND infosis.rrno = tms.rrno
  LEFT JOIN `tblcustomer` AS tc 
    ON tc.`cust_id` = infosis.`cust_id` 
  LEFT JOIN tbladdress AS ta 
    ON ta.`addr_id` = infosis.`addr_id` 
WHERE tms.`mwrf_mat_id` = '".$appendurlid."' 
  AND tms.rrno = '".$appendurlrrno."' 
  AND tms.`isdelete` = 1 AND tmr.`isdelete` = 1";
$result=$dbinv->query($sql);
$c=0;

echo '<form action = "mwrf_items.php" method = "GET">';
echo '<table class="table table-striped header-fixed table-bordered table-hover table-info" id ="tblsisqty" cellspacing="0" style= "width:100%;table-layout: fixed;margin-bottom: -15px;overflow-y: auto; height: 100px;">';
echo '<div style = "position:sticky;top:100px;z-index:999;">';
echo '<thead style = "position: sticky; top: 0;background-color:#17A2B8;z-index:999;">';
echo '<th>SIS No</th><th>Item Qty Issue</th><th>Warehouse stock</th><th>Balance</th><th>Action</th>';
/*echo '<th>SIS No</th><th>SIS Qty</th><th>RR Balance</th><th>Total Balance</th><th>Action</th>';*/
echo '</thead>';
echo '</div>';
$balance = "";
$balance2 = array();
$balancerr = "";
if ($result->num_rows > 0 ){	
	while ($row=$result->fetch_assoc()){
		//$materialsid = $row['MaterialsID'];
		//$materials = $row['Materials'];

		/*$rrno = $row['RRNo'];
		$qty = $row['rrdeclaredqty'];
		$up = $row['UnitPrice'];
		$amount = $row['Amount'];
		$shop = $row['Shop'];*/
		$rrno = $row['rrno'];
		$date_issued = $row['issued_date'];
		$issued_nos = $row['issued_nos'];
		$addr_id = $row['addr_id'];
		$addr_name = $row['addr_name'];
		$loc = $row['location'];
		$reference = $row['reference'];
		$remarks = $row['remarks'];
		$cust_name = $row['cust_name'];
		$cust_id = $row['cust_id'];
		$sisno = $row['sisno'];
		$prepby = $row['preparedby_id'];
		$recby = $row['receivedby_id'];
		$noteby = $row['notedby_id'];
		//var_dump($cust_id);

		/*$materialsid = $row['MaterialsID'];
		$materials = $row['Materials'];
		$qty = $row['Quantity'];
		$up = $row['UnitPrice'];
		$shop = $row['Shop'];
		$amount = $row['Amount'];
		$rrno = $row['RRNo'];*/
		//die($materials);
		if (sizeof($balance2) > 0){
			$rr_qty = $row['qty']; //sis qty
			$balancerr =  $balance;
			$balance = $balance - $rr_qty;	
			$balance2[$c] = $balance;
			//$balancerr = $balancerr - $rr_qty;
		}

		else if(sizeof($balance2) < 1) {
			//$mwrf_qty = $row['Quantity'];
			$rr_qty = $row['qty']; //sis qty
			
			$balance2[$c] = $balance;

			$qtydeclaredrr = $row['qtyrr'];
			$balancerr = $qtydeclaredrr;
			$balance = $balancerr - $rr_qty;
		}		
		echo '<tr>';
		/*echo '<td style = "width:90px;">'.$row['rrno'].'</td>';*/
		echo '<td style = "width:90px;">'.$sisno.'</td>';
		echo '<td style = "width:90px;" contenteditable="true" id = "txtsismatqty'.$c.'">'.$rr_qty.'</td>';
		echo '<td style = "width:90px;">'.abs($balancerr).'</td>';
		echo '<td style = "width:90px;">'.abs($balance).'</td>'; //total balance
		echo '<td><button type = "button" name = "btnselectsis"  class = "btn btn-primary" onclick = \'(parent.selectmaterialsisviews("'.$rrno.'","'.$date_issued.'","'.$sisno.'","'.$addr_id.'","'.$addr_name.'","'.$loc.'","'.$reference.'","'.$remarks.'","'.$cust_name.'","'.$cust_id.'","'.$c.'","'.$prepby.'","'.$recby.'","'.$noteby.'"))\' >Select</button></td>';

		
		echo '</tr>';
		$c++;
	}
}
else {
	echo '<tr>';
	echo '<td colspan = "5" style = "width:90px;"><center>No result found.<center></td>';
	echo '</tr>';
}
echo '<input type = "hidden" id = "txtbalancemwrf" value = "'.abs($balance).'">';
echo '<input type = "hidden" id = "txtcountbalance" value = "'.abs($c).'">';
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
		//$("#tblsisqty").stickyTableHeaders();
		$('#tblsisqty tbody tr').click(function() {
			$(this).addClass('bg-dark text-white').siblings().removeClass('bg-dark text-white');
			//$(this).addClass('text-*').siblings().removeClass('text-*');
		});
		$('[name=btnselectsis]').click(function(){
			//alert('sds');
			window.parent.document.getElementById("btnsisupdate").disabled=false;
			window.parent.document.getElementById("btnsissave").disabled=true;
			//window.parent.document.getElementById("btnprintrr").disabled=false;
			//$('#btnrrupdate').removeAttr('disabled');

		});
	</script>
</body>
</html>