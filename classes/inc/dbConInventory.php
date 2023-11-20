<?php

$serverName1="localhost";

$databaseName1="inventorydatabase";

$password1="OSXVD2XSQk1PhOvD";

$username1="root";
//$appendurlid = $_GET['rrno'];
global $link = mysqli_connect($serverName1,$username1,$password1,$databaseName1);
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}


?>