<?php
// Count total request
	global $db;
	// count the pending request
	$sqlpend = "SELECT *FROM tblrequestform WHERE MWRFStatus = 'PENDING' AND isdelete = 1";
	
	$result=$db->query ($sqlpend);
  	$totalpend = $result->num_rows;

  	echo "<input type= 'hidden' id = 'txthiddenpending' value = '$totalpend'>";

  	// count the completed request
  	$sqlcomp = "SELECT *FROM tblrequestform WHERE MWRFStatus = 'COMPLETED' AND isdelete = 1";
	
	$resultcomp=$db->query ($sqlcomp);
  	$totalcomp = $resultcomp->num_rows;

  	echo "<input type= 'hidden' id = 'txthiddencomplete' value = '$totalcomp'>";

  //calculate number of request
  if (isset($_POST['btnbetween'])){
  global $db;
    $from = $_POST['dtpsd'];
    $to = $_POST['dtped'];
    
  $sql = "SELECT *FROM tblrequestform WHERE DateAdded BETWEEN '".$from."' AND '".$to."' AND isdelete = 1";
  $result=$db->query ($sql);
  $totals = $result->num_rows;
  echo "<input type = 'text' name = 'txthiddentotal' class = 'form-control'  id='txthiddentotal' value ='$totals'>";
  }

?>