<?php

$serverName="localhost";

$databaseName="bir_reportdb2";

$password="OSXVD2XSQk1PhOvD";

$username="root";

$dbir= new mysqli($serverName,$username,$password,$databaseName);

 // var_dump($db);
if ($dbir->connect_error){

	die ("Connection Failed ". $dbir->connect_error);
	//echo "Connection Failed" ;

}

?>