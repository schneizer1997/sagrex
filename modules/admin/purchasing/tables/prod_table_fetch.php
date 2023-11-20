<?php

//fetch.php
$connect = mysqli_connect("localhost", "root", "OSXVD2XSQk1PhOvD", "purchasing2021");
$columns = array('prod_info_id', 'designation', 'item_name', 'descr', 'brand', 'purpose', 'qty', 'unit', 'price', 'amount', 'supp_name', 'supp_addr', 'rf_no', 'rf_date', 'po_no', 'po_date', 'req_by', 'ref_no', 'ref_date', 'cvjv_no', 'pjd_no', 'other_ref', 'remarks', 'status');

$query = "SELECT * FROM prod_info where ";

if($_POST["is_date_search"] == "yes")
{
 $query .= ' ref_date BETWEEN "'.$_POST["start_date"].'" AND "'.$_POST["end_date"].'" AND ';
}

if(isset($_POST["search"]["value"]))
{
 $query .= ' (prod_info_id LIKE "%'.$_POST["search"]["value"].'%" ';
            $query .= ' OR item_name LIKE "%'.$_POST["search"]["value"].'%" ';           
            $query .= ' OR designation LIKE "%'.$_POST["search"]["value"].'%" ';
            $query .= ' OR supp_addr LIKE "%'.$_POST["search"]["value"].'%" ';
            $query .= ' OR descr LIKE "%'.$_POST["search"]["value"].'%") ';
            $query .= ' AND status = 1 ';    
}

if(isset($_POST["order"]))
{
 $query .= ' ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
 ';
}
else
{
 $query .= ' ORDER BY prod_info_id DESC ';
}

$query1 = '';
if($_POST["length"] != -1){
            $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}   
/*if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}*/

/*$number_filter_row = mysqli_num_rows(mysqli_query($connect, $query));

$result = mysqli_query($connect, $query . $query1);

$data = array();
*/
//var_dump($query);
$result = mysqli_query($this->dbConnect, $query);
$numRows = mysqli_num_rows($result);

$number_filter_row = mysqli_num_rows(mysqli_query($connect, $query));

$result = mysqli_query($connect, $query . $query1);

$data = array();

$employeeData = array(); 

while($row = mysqli_fetch_array($result))
{  
   $empRows = array();

   $empRows[] = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['prod_info_id']);
   $empRows[] =preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['designation']);
   $empRows[] = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['item_name']);
   $empRows[] = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['descr']);
   $empRows[] = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['brand']);
   $empRows[] = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['purpose']);
   $empRows[] = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['qty']);
   $empRows[] = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['unit']);
   $empRows[] = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['price']);
   $empRows[] = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['amount']);
   $empRows[] = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['supp_name']);
   $empRows[] = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['supp_addr']);
   $empRows[] = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['rf_no']);
   $empRows[] = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['rf_date']);
   $empRows[] = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['po_no']);
   $empRows[] = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['po_date']);
   $empRows[] = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['req_by']);
   $empRows[] = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['ref_no']);
   $empRows[] = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['ref_date']);
   $empRows[] = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['cvjv_no']);
   $empRows[] = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['pjd_no']);
   $empRows[] = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['other_ref']);
   $empRows[] = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['remarks']);
   $empRows[] = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['status']);           

   $employeeData[] = $empRows;
}
//var_dump($employeeData);
/*function get_all_data($connect)
{
 $query = "SELECT * FROM prod_info";
 $result = mysqli_query($this->dbConnect, $query);
 return mysqli_num_rows($result);
}*/

function get_all_data($connect)
{
 $query = "SELECT * FROM prod_info";
 $result = mysqli_query($connect, $query);
 return mysqli_num_rows($result);
}

$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  get_all_data($connect),
 "recordsFiltered" => $number_filter_row,
 "data"    => $data
);

echo json_encode($output);
//var_dump($output);





?>