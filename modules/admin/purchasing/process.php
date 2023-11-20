<?php
include('tables/production_item_purch_table.php');
$emp = new Prod();


if(!empty($_POST['action']) && $_POST['action'] == 'listprod') {
	
	if(!empty($_POST['start_date']) && !empty($_POST['end_date'])){
		//var_dump($_POST['start_date']);
		$fromdate = date('Y-m-d', strtotime($_POST['start_date']));
		$todate = date('Y-m-d', strtotime($_POST['end_date']));
		/*$desig = $_POST['desigselected'];*/
		$emp->prodListfilterdate($fromdate,$todate/*,$desig*/);
	}
	else {
		//var_dump($_POST['start_date']);
		$emp->prodList();
	}
	//var_dump($_POST['start_date']);

}
/*if(!empty($_POST['action']) && $_POST['action'] == 'prodgeneratedate') {
	//$emp->prodListfilterdate(isset($_POST['start_date']),isset($_POST['end_date']));
	if(isset($_POST['start_date']) && isset($_POST['end_date'])){
		//var_dump($_POST['start_date']);
		$emp->prodListfilterdate($_POST['start_date'],$_POST['end_date']);
	}
	
}*/
/*if (!empty($_POST['action2']) && $_POST['action2'] == 'listprod2'){
	$emp->proddaterange();

}

*/
 ?>