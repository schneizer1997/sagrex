<?php 
// Database connection info 
$dbDetails = array( 
    'host' => 'localhost', 
    'user' => 'root', 
    'pass' => 'OSXVD2XSQk1PhOvD', 
    'db'   => 'acctng_cheque' 
); 
 
// DB table to use 
$table = 'cheq_info'; 
 
// Table's primary key 
$primaryKey = 'cheq_id'; 
 
// Array of database columns which should be read and sent back to DataTables. 
// The `db` parameter represents the column name in the database.  
// The `dt` parameter represents the DataTables column identifier. 
$columns = array( 
    array( 'db' => 'cheq_id', 'dt' => 0 ), 
    array( 'db' => 'cheq_no', 'dt' => 1 ), 
    array( 'db' => 'pay_to',  'dt' => 2 ), 
    array( 'db' => 'amount',      'dt' => 3 ), 
    array( 'db' => 'amount_words',     'dt' => 4 ), 
    array( 'db' => 'trans_date',    'dt' => 5 )
); 
//die($columns);
 
// Include SQL query processing class 
require 'ssp.class.php'; 
 
// Output data as json format 
echo json_encode( 
    SSP::simple( $_GET, $dbDetails, $table, $primaryKey, $columns ) 
);
