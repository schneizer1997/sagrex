<?php
/*include('../../../classes/inc/dbConInventory.php');*/
include('classes/inc/dbCon.php');
// Load data in maintenance module

global $dbir;

$sql = "SELECT a.AccountNumber, a.AccountCode FROM account as a JOIN AccountLedger as acc ON  a.AccountCode = acc.AccountCode";
//var_dump($sql);

$result=$dbir->query($sql);
$c=1;
//var_dump($result);
if ($result->num_rows > 0){
	while ($row=$result->fetch_assoc()){
		$accnos = $row['AccountNumber'];
		$acccode = $row['AccountCode'];
		$sqlupdate = "UPDATE AccountLedger SET AccountNumber = (SELECT AccountNumber FROM account WHERE AccountCode = '".$acccode."') WHERE AccountCode = '".$acccode."'";
		if ($dbir->query($sqlupdate) == TRUE){

		}
	}

}

?>
