<?php 
// Database connection info 
$dbDetails = array( 
    'host' => 'localhost', 
    'user' => 'root', 
    'pass' => 'OSXVD2XSQk1PhOvD', 
    'db'   => 'purchase_order' 
); 
 
// DB table to use 
$table = 'tblpo'; 
 
// Table's primary key 
$primaryKey = 'id'; 
$where = 'status = 1'; 
 
// Array of database columns which should be read and sent back to DataTables. 
// The `db` parameter represents the column name in the database.  
// The `dt` parameter represents the DataTables column identifier. 
$columns = array( 
    array( 'db' => 'id', 'dt' => 0 ), 
    array( 'db' => 'po_no', 'dt' => 1 ), 
    array( 'db' => 'po_name',  'dt' => 2 ), 
    array( 'db' => 'po_addr',      'dt' => 3 ), 
    array( 'db' => 'po_date',     'dt' => 4 ), 
    array( 'db' => 'po_terms',    'dt' => 5 ),
    array( 'db' => 'reqby',    'dt' => 6 ),
    array( 'db' => 'prepby',    'dt' => 7 ),
    array( 'db' => 'noteby',    'dt' => 8 ),
    array( 'db' => 'approveby',    'dt' => 9 ),
    array( 'db' => 'purpose',    'dt' => 10 ),
    array( 'db' => 'note',    'dt' => 11 )

); 
//die($columns);
 
// Include SQL query processing class 
require 'ssp.class.php'; 
 
// Output data as json format 
echo json_encode( 
    //SSP::simple( $_GET, $dbDetails, $table, $primaryKey, $columns ) 
    SSP::complex( $_GET, $dbDetails, $table, $primaryKey, $columns,null,$where )
);
