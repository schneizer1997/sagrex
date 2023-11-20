<?php
include('../../classes/inc/dbCon.php');
//session_start();
	global $db;
	//htmlspecialchars
	/*echo "<form action = 'getMaterials.php' method = 'POST'>";
	echo "<input type='text' name = 'wew' value='11'></input>";
	echo "</form>";*/

if (isset($_GET['MWRF'])){
$mwrfid = $_GET['MWRF'];
echo $mwrfid;

$sql = "SELECT Materials,Quantity FROM tblRequestMaterials WHERE MWRFID = 
		'".$mwrfid."' LIMIT 3";
	$result=$db->query($sql);

	if ($result->num_rows > 0 ){
		while ($row=$result->fetch_assoc()){
					echo '<tr>';
					echo '<td>'.$row['Materials'].'</td>';
					echo '<td>'.$row['Quantity'].'</td>';
					echo '</tr>';	
			}
		}
	}
	else {
		echo filter_input(INPUT_GET,"link",FILTER_SANITIZE_STRING);
	/*die("wew" . $mwrfid);*/
	//var_dump($mwrfid);
	error_reporting(E_ALL);	
	echo "wlwlwlwlwl";
	}
	
	
	//phpinfo();
	//ini_set('display_errors', 1);
	/*if (empty($_GET)){
		die("empty");
	}*/
	
		
	

	

/*}else{
	
	ini_set('display_errors', 1);
	echo "error";
}*/

?>