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
$sql = "SELECT *FROM vendor_accr where status = 1";

$result=$dbpurchasing->query($sql);
$c=0;
$emparray= array();
if ($result->num_rows > 0){
	while ($row=$result->fetch_assoc()){
		

		$vendoraccr_id= preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['vendoraccr_id']);
		$comp_name= preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['comp_name']);
		$comp_prev_name=preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['comp_prev_name']);
		$type=preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['type']);
		$nature=preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['nature']);
		$busi_addr=preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['busi_addr']);
		$bill_addr=preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['bill_addr']);
		$contact_name=preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['contact_name']);
		$position=preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['position']);
		$tel_no=preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['tel_no']);
		$fax_no=preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['fax_no']);
		$mobile_no=preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['mobile_no']);
		$email=preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['email']);
		$terms=preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['terms']);
		$credit_limit=preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['credit_limit']);
		$reg_no=preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['reg_no']);
		$sec_reg=preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['sec_reg']);
		$permit_no=preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['permit_no']);
		$bir_cert=preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['bir_cert']);
		$tin_no=preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['tin_no']);
		$vat_no=preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['vat_no']);
		$tax=preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['tax']);
		$bank_name=preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['bank_name']);
		$bank_loc=preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['bank_loc']);
		$acct_name=preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['acct_name']);
		$acct_sign=preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['acct_sign']);
		$sign_office=preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['sign_office']);
		$verified_by=preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['verified_by']);
		$vendor_img=preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['vendor_img']);
		$upload_img=preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['upload_img']);
		$emparray[]= $row;



		echo '<tr id = "clickable-row">';
		echo '<td  style = "width:90px;">'.$vendoraccr_id.'</td>';
		echo '<td  style = "width:90px;">'.$comp_name.'</td>';
		echo '<td  style = "width:90px;">'.$comp_prev_name.'</td>';
		echo '<td  style = "width:90px;">'.$type.'</td>';
		echo '<td  style = "width:90px;">'.$nature.'</td>';
		echo '<td  style = "width:90px;">'.$busi_addr.'</td>';
		echo '<td  style = "width:90px;">'.$bill_addr.'</td>';
		echo '<td  style = "width:90px;">'.$contact_name.'</td>';
		echo '<td  style = "width:90px;">'.$position.'</td>';
		echo '<td  style = "width:90px;">'.$tel_no.'</td>';
		echo '<td  style = "width:90px;">'.$fax_no.'</td>';
		echo '<td  style = "width:90px;">'.$mobile_no.'</td>';
		echo '<td  style = "width:90px;">'.$email.'</td>';
		echo '<td  style = "width:90px;">'.$terms.'</td>';
		echo '<td  style = "width:90px;">'.$credit_limit.'</td>';
		echo '<td  style = "width:90px;">'.$reg_no.'</td>';
		echo '<td  style = "width:90px;">'.$sec_reg.'</td>';
		echo '<td  style = "width:90px;">'.$permit_no.'</td>';
		echo '<td  style = "width:90px;">'.$bir_cert.'</td>';
		echo '<td  style = "width:90px;">'.$tin_no.'</td>';
		echo '<td  style = "width:90px;">'.$tax.'</td>';
		echo '<td  style = "width:90px;">'.$bank_name.'</td>';
		echo '<td  style = "width:90px;">'.$bank_loc.'</td>';
		echo '<td  style = "width:90px;">'.$acct_name.'</td>';
		echo '<td  style = "width:90px;">'.$acct_sign.'</td>';
		echo '<td  style = "width:90px;">'.$sign_office.'</td>';
		echo '<td  style = "width:90px;">'.$verified_by.'</td>';
		echo '<td  style = "width:90px;">'.$vendor_img.'</td>';
		echo '<td  style = "width:90px;">'.$upload_img.'</td>';
		//echo '<td  style = "width:90px;">'.$status.'</td>';
		echo '</tr>';
	}
	//echo json_encode($emparray);
	$results = array(
"allitem" => $emparray
);
	//echo json_encode($results);
	$fp = fopen('prod_item.json', 'w');
    fwrite($fp, json_encode($results));
    fclose($fp);
}

/*echo '<tr>';
echo '<td  style = "width:90px;">assss</td>';
echo '<td  style = "width:90px;">assss</td>';
echo '<td  style = "width:90px;">assss</td>';
echo '<td  style = "width:90px;">assss</td>';
echo '<td  style = "width:90px;">assss</td>';
echo '<td  style = "width:90px;">assss</td>';
echo '<td  style = "width:90px;">assss</td>';
echo '<td  style = "width:90px;">assss</td>';
echo '<td  style = "width:90px;">assss</td>';
echo '<td  style = "width:90px;">assss</td>';
echo '<td  style = "width:90px;">assss</td>';
echo '<td  style = "width:90px;">assss</td>';
echo '<td  style = "width:90px;">assss</td>';
echo '<td  style = "width:90px;">assss</td>';
echo '<td  style = "width:90px;">assss</td>';
echo '<td  style = "width:90px;">assss</td>';
echo '<td  style = "width:90px;">assss</td>';
echo '<td  style = "width:90px;">assss</td>';
echo '<td  style = "width:90px;">assss</td>';
echo '<td  style = "width:90px;">assss</td>';
echo '<td  style = "width:90px;">assss</td>';
echo '<td  style = "width:90px;">assss</td>';
echo '</tr>';*/



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
