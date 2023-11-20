<?php 
// Database connection info 
$dbDetails = array( 
    'host' => 'localhost', 
    'user' => 'root', 
    'pass' => 'OSXVD2XSQk1PhOvD', 
    'db'   => 'purchase_order' 
);

$po_no = strval($_GET['pono']);
//echo strval($_GET['po']);
/*if (isset($_POST['po'])) {
    $po_no = $_POST['po'];
//$po_no = $_GET['pono'];
} 
else {
   // echo '<script>alert("wew");</script>';
}*/
/*if (isset($_GET['pono'])) {
$po_no = $_GET['pono'];
} */
/*if(!isset($_GET['pono'])) {
//echo 'wewe';

}
if (isset($_GET['pono'])) {
$po_no = $_GET['pono'];
} */

//console.log($po_no);
 
// DB table to use 
$table = 'tblpo_items'; 
 
// Table's primary key 
$primaryKey = 'id';

$where = 'po_no ="'.$po_no.'" AND status = 1'; 
 
// Array of database columns which should be read and sent back to DataTables. 
// The `db` parameter represents the column name in the database.  
// The `dt` parameter represents the DataTables column identifier. 
$columns = array( 
    array( 'db' => 'id', 'dt' => 0 ), 
    array( 'db' => 'po_no', 'dt' => 1 ), 
    array( 'db' => 'po_qty',  'dt' => 2 ), 
    array( 'db' => 'po_unit',      'dt' => 3 ), 
    array( 'db' => 'po_desc',     'dt' => 4 ), 
    array( 'db' => 'po_up',    'dt' => 5 ),
    array( 'db' => 'po_amount',    'dt' => 6 )

); 
//die($columns);
 
// Include SQL query processing class 
require 'ssp.class.php'; 
 
// Output data as json format 
echo json_encode( 
    //SSP::simple( $_GET, $dbDetails, $table, $primaryKey, $columns ) 
    SSP::complex( $_GET, $dbDetails, $table, $primaryKey, $columns,null,$where )
);
