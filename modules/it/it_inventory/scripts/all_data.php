<?php 
// Database connection info 
$dbDetails = array( 
    'host' => 'localhost', 
    'user' => 'root', 
    'pass' => 'OSXVD2XSQk1PhOvD', 
    'db'   => 'inventory_it' 
); 
 
// DB table to use 
$table = 'tblitems'; 
 
// Table's primary key 
$primaryKey = 'item_id'; 
$where = 'isdelete = 1'; 
 
// Array of database columns which should be read and sent back to DataTables. 
// The `db` parameter represents the column name in the database.  
// The `dt` parameter represents the DataTables column identifier. 
$columns = array( 
    array( 'db' => 'item_id', 'dt' => 0 ), 
    array( 'db' => 'descr', 'dt' => 1 ), 
    array( 'db' => 'qty',  'dt' => 2 ), 
    array( 'db' => 'unit',      'dt' => 3 ), 
    array( 'db' => 'serial_no',     'dt' => 4 ), 
    array( 'db' => 'barcode',    'dt' => 5 ),
    array( 'db' => 'category',    'dt' => 6 ),
    array( 'db' => 'remarks',    'dt' => 7 ),
    array( 'db' => 'date_added',    'dt' => 8 ),
    array( 'db' => 'status',    'dt' => 9 )

); 
//die($columns);
 
// Include SQL query processing class 
require 'ssp.class.php'; 
 
// Output data as json format 
echo json_encode( 
    //SSP::simple( $_GET, $dbDetails, $table, $primaryKey, $columns ) 
    SSP::complex( $_GET, $dbDetails, $table, $primaryKey, $columns,null,$where )
);
