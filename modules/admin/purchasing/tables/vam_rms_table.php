<?php
include('../../../classes/inc/dbCon.php');
global $dbpurchasing;
// Load data in maintenance module

//global $dbinv;

/*echo '<form action = "mwrf_items.php" method = "GET">';
echo '<table class="table table-striped header-fixed table-bordered table-hover table-info " id ="tblitempurch" cellspacing="0" style= "width:100%;table-layout: fixed;margin-bottom: -15px;overflow-y: auto; height: 100px;">';
echo '<div>';
echo '<thead style = "position: sticky; top: 0;background-color:#17A2B8;z-index:999;">';
echo '<tr>';
echo '<div id = "wew" style = "position:sticky;" width="100%">';
echo '<th >ID</th>
<th >Plate No.</th>
<th >Assignee</th>
<th >Item</th>
<th >Description</th>
<th >Brand</th>
<th >Qty</th>
<th >Unit</th>
<th >Price</th>
<th >Total Amount</th>
<th >Supplier</th>
<th >Address</th>
<th >RF No.</th>
<th >Date</th>
<th >PO No.</th>
<th >Date</th>
<th >Requested By</th>
<th >Ref No.</th>
<th >Date</th>
<th >CV/JV No.</th>
<th >Other Ref.</th>
<th >Remarks</th>';
echo '</tr>';
echo '</div>';
echo '</thead>';
echo '</div>';
echo '<tbody style = "overflow-y: scroll;">';

//echo '<input type = "text" id = "txtcountitems" name = "txtcountitems" value ="'.$c.'" >';
echo '</tbody>';
echo '</table>';
echo '</form>';*/
$sql = "SELECT *FROM vehicle_rms_info AS vhi JOIN plates ON vhi.`plate_id` = plates.`plate_id` AND vhi.status =1";

$result=$dbpurchasing->query($sql);
$c=0;
if ($result->num_rows > 0){
	while ($row=$result->fetch_assoc()){
		

		$vehinfo_rms_id= preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['vehinfo_rms_id']);
		$plate_id=preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['plate_id']);
		$plate_no=preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['plate_no']);
		$assign_name = $row['assign_name'];		
		$repairetype=preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['repairetype']); 
		$descr=preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['descr']);
		$brand=preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['brand']);
		$qty=preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['qty']);
		$unit=preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['unit']);
		$price=preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['price']);
		$amount=preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['amount']);
		$supp_name=$row['supp_name'];
		$address=$row['address'];
		$rf_no=$row['rf_no'];
		$daterfno=preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['daterfno']);
		$po_no=$row['po_no'];
		$po_date=preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['po_date']);
		$req_by=$row['req_by'];
		$ref_no=$row['ref_no'];
		$daterefno=preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['daterefno']);
		$cvjv=$row['cvjv'];
		$other_ref=$row['other_ref'];
		$remarks=$row['remarks'];
		$status=preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['status']);



		echo '<tr>';
		echo '<td  style = "width:90px;">'.$vehinfo_rms_id.'</td>';
		echo '<td  style = "width:90px;">'.$plate_id.'</td>';
		echo '<td  style = "width:90px;">'.$plate_no.'</td>';
		echo '<td  style = "width:90px;">'.$assign_name.'</td>';
		echo '<td  style = "width:90px;">'.$repairetype.'</td>';
		echo '<td  style = "width:90px;">'.$descr.'</td>';
		echo '<td  style = "width:90px;">'.$brand.'</td>';
		echo '<td  style = "width:90px;">'.$qty.'</td>';
		echo '<td  style = "width:90px;">'.$unit.'</td>';
		echo '<td  style = "width:90px;">'.$price.'</td>';
		echo '<td  style = "width:90px;">'.$amount.'</td>';
		echo '<td  style = "width:90px;">'.$supp_name.'</td>';
		echo '<td  style = "width:90px;">'.$address.'</td>';
		echo '<td  style = "width:90px;">'.$rf_no.'</td>';
		echo '<td  style = "width:90px;">'.$daterfno.'</td>';
		echo '<td  style = "width:90px;">'.$po_no.'</td>';
		echo '<td  style = "width:90px;">'.$po_date.'</td>';
		echo '<td  style = "width:90px;">'.$req_by.'</td>';
		echo '<td  style = "width:90px;">'.$ref_no.'</td>';
		echo '<td  style = "width:90px;">'.$daterefno.'</td>';
		echo '<td  style = "width:90px;">'.$cvjv.'</td>';
		echo '<td  style = "width:90px;">'.$other_ref.'</td>';
		echo '<td  style = "width:90px;">'.$remarks.'</td>';
		//echo '<td  style = "width:90px;">'.$status.'</td>';
		echo '</tr>';
	}
}

?>
<!DOCTYPE html>
<html>

<script type="text/javascript">
	
   /* window.parent.$('.dataTable').on('click', 'tbody tr', function() {
                    console.log('API row values : ', table.row(this).data());
                    alert(table.row(this).data());
                  });
*/
</script>
</html>
