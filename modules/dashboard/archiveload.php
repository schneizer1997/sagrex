<?php
include('../../classes/inc/dbCon.php');

	//session_start();

	global $db;

	$sql = "SELECT *FROM archive WHERE isdelete = 1 ORDER BY arch_id DESC";
	$result=$db->query ($sql);
	if ($result->num_rows > 0 ){
		while ($row=$result->fetch_assoc()){
				echo '<tr>';
				echo '<td style = "width:50px">'.$row['department'].'</td>';
				echo '<td style = "width:300px">'.$row['action'].'</td>';
				echo '<td style = "width:70px">'.$row['datetransact'].'</td>';
		}
	}

?>