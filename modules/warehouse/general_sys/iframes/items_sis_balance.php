<?php

include('../../../../classes/inc/dbCon.php');

//session_start();
global $dbinv;
$appendurlitemid = $_GET['item_id'];
$appendurlrrno = $_GET['rrno'];
//die($appendurlid);
$sql = "SELECT 
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
WHERE tis.`item_id` = '".$appendurlitemid."' 
AND tis.rrno = '".$appendurlrrno."' 
AND tis.`isdelete` = 1 ";
$result=$dbinv->query($sql);
$c=0;

echo '<form action = "mwrf_items.php" method = "GET">';
echo '<table class="table table-striped header-fixed table-bordered table-hover table-info" id ="tblsisqty" cellspacing="0" style= "width:100%;table-layout: fixed;margin-bottom: -15px;overflow-y: auto; height: 100px;">';
echo '<div style = "position:sticky;top:100px;z-index:999;">';
echo '<thead style = "position: sticky; top: 0;background-color:#17A2B8;z-index:999;">';
echo '<th>SIS No</th><th>SIS Item Qty Issue</th><th>RR Item Declared</th><th>Balance</th><th>Action</th>';
echo '</thead>';
echo '</div>';
$balance = "";
$balance2 = array();
$balancerr = "";
if ($result->num_rows > 0 ){
	
	while ($row=$result->fetch_assoc()){

		$rrno = $row['rrno'];
		$date_issued = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['issued_date']);
		$issued_nos = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['issued_nos']);
		$addr_id = $row['addr_id'];
		$addr_name = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['addr_name']);
		$loc = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['location']);
		$reference = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['reference']);
		$remarks = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['remarks']);
		$cust_name = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['cust_name']);
		$cust_id = $row['cust_id'];
		$sisno = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['sisno']);
		$item_id = $row['sisitemid'];

		

		if (sizeof($balance2) > 0){
			//var_dump($balancerr); // 600 and 300
			$sis_qty = $row['sisqty']; //sis qty
			//var_dump($sis_qty); // 300 and 101
			$balancerr = $balance;
			$balance = $balance - $sis_qty; // 150 and 49
			//var_dump($balance);

			$balance2[$c] = $balance;
			//var_dump($balance2[$c]); // 150 and 49
			//$balancerr = (double)$balancerr - $sis_qty;
			//var_dump($balancerr); //300 and 199

			//var_dump("balance rr = ".$balancerr . " /// "."sis qty =" . $sis_qty ." /// ".  "balance = ".$balance);
		}

		else if(sizeof($balance2) < 1) {
			//$mwrf_qty = $row['Quantity'];
			$sis_qty = $row['sisqty'];
			$balance2[$c] = $balance;
			$qtydeclaredrr = $row['rrqty'];
			$balancerr = (double)$qtydeclaredrr; //600
			$balance = (double)$balancerr - $sis_qty; //450
			//var_dump($balance);
			//var_dump($balancerr);
			//var_dump("balance rr = ".$balancerr . " /// "."sis qty =" . $sis_qty ." /// ".  "balance = ".$balance);
		}		
		
		
		echo '<tr>';
		echo '<td style = "width:90px;">'.$sisno.'</td>';
		echo '<td contenteditable="true" style = "width:90px;" id = "txtsisqty'.$c.'">'.$sis_qty.'</td>';
		echo '<input type = "hidden" id = "txtprevqty'.$c.'" value = "'.$sis_qty.'">';
		echo '<td style = "width:90px;">'.abs($balancerr).'</td>';
		echo '<td style = "width:90px;">'.abs($balance).'</td>'; //total balance
		echo '<td><button type = "button"  class = "btn btn-primary" onclick = \'(parent.selectmaterialsisview("'.$rrno.'","'.$date_issued.'","'.$sisno.'","'.$addr_id.'","'.$addr_name.'","'.$loc.'","'.$reference.'","'.$remarks.'","'.$cust_name.'","'.$cust_id.'","'.$c.'","'.$item_id.'"))\' >Select</button></td>';

		
		echo '</tr>';
		$c++;
	}
}

else {
	echo '<tr>';
	echo '<td colspan = "5" style = "width:90px;"><center>No result found.<center></td>';
	echo '</tr>';
}
echo '<input type = "hidden" id = "txtbalance" value = "'.abs($balance).'">';
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
		$("#tblsisqty").stickyTableHeaders();
		window.parent.$('#btnsissavecr').click(function(){
			location.reload();
		});
		$('#tblsisqty tbody tr').click(function() {
			$(this).addClass('bg-dark text-white').siblings().removeClass('bg-dark text-white');
			//$(this).addClass('text-*').siblings().removeClass('text-*');
		});

	</script>
</body>
</html>