<?php

//MWRF

$serverName="localhost";

$databaseName="dx_requestform";

$password="OSXVD2XSQk1PhOvD";

$username="root";

$db= new mysqli($serverName,$username,$password,$databaseName);

 // var_dump($db);
if ($db->connect_error){

	die ("Connection Failed ". $db->connect_error);
	//echo "Connection Failed" ;

}

/*$serverName2="localhost";

$databaseName2="bir_2019";

$password2="OSXVD2XSQk1PhOvD";

$username2="root";

$dbir= new mysqli($serverName2,$username2,$password2,$databaseName2);

 // var_dump($db);
if ($dbir->connect_error){

	die ("Connection Failed ". $dbir->connect_error);
	//echo "Connection Failed" ;

}*/

// RRSIS
$serverName1="localhost";

$databaseName1="inventorydatabase";

$password1="OSXVD2XSQk1PhOvD";

$username1="root";

$dbinv= new mysqli($serverName1,$username1,$password1,$databaseName1);

 // var_dump($db);
if ($dbinv->connect_error){

	die ("Connection Failed ". $dbinv->connect_error);
	//echo "Connection Failed" ;

}

//EMPLOYEE CASHLIP
/*$serverName2="localhost";

$databaseName2="employeecashslip";

$password2="OSXVD2XSQk1PhOvD";

$username2="root";

$dbcashslip= new mysqli($serverName2,$username2,$password2,$databaseName2);

 // var_dump($db);
if ($dbcashslip->connect_error){

	die ("Connection Failed ". $dbcashslip->connect_error);
	//echo "Connection Failed" ;

}*/

$serverName3="localhost";

$databaseName3="purchasing2021";

$password3="OSXVD2XSQk1PhOvD";

$username3="root";

$dbpurchasing= new mysqli($serverName3,$username3,$password3,$databaseName3);

 // var_dump($db);
if ($dbpurchasing->connect_error){

	die ("Connection Failed ". $dbpurchasing->connect_error);
	//echo "Connection Failed" ;

}

$serverName4="localhost";

$databaseName4="acctng_cheque";

$password4="OSXVD2XSQk1PhOvD";

$username4="root";

$dbcheque= new mysqli($serverName4,$username4,$password4,$databaseName4);

 // var_dump($db);
if ($dbcheque->connect_error){

	die ("Connection Failed ". $dbcheque->connect_error);
	//echo "Connection Failed" ;

}

$serverName5="localhost";

$databaseName5="purchase_order";

$password5="OSXVD2XSQk1PhOvD";

$username5="root";

$dbpo= new mysqli($serverName5,$username5,$password5,$databaseName5);

 // var_dump($db);
if ($dbpo->connect_error){

	die ("Connection Failed ". $dbpo->connect_error);
	//echo "Connection Failed" ;

}


$serverName6="localhost";

$databaseName6="inventory_it";

$password6="OSXVD2XSQk1PhOvD";

$username6="root";

$dbitinv= new mysqli($serverName6,$username6,$password6,$databaseName6);

 // var_dump($db);
if ($dbitinv->connect_error){

	die ("Connection Failed ". $dbitinv->connect_error);
	//echo "Connection Failed" ;

}
/*$connect = new PDO("mysql:host=localhost;dbname=inventorydatabase","root","OSXVD2XSQk1PhOvD");

$conns = new mysqli('localhost', 'root', 'OSXVD2XSQk1PhOvD' , 'inventorydatabase');
$conns = new mysqli($serverName, $username, $password , $databaseName);*/
?>