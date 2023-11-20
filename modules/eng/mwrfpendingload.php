<?php
	include('../../classes/inc/dbCon.php');

	//session_start();
	// Load pending request based on date
	global $db;

	$from = $_GET['from'];
	$to = $_GET['to'];

	$sql = "SELECT  *FROM tblrequestform WHERE DateAdded BETWEEN '".$from."' AND  '".$to."' AND MWRFStatus = 'PENDING' AND isdelete = 1";

	$result=$db->query ($sql);
	$c=1;
	if ($result->num_rows > 0 ){
		while ($row=$result->fetch_assoc()){
			$mwrfid=$row['MWRFID'];
			$mwrfno=$row['MWRFNo'];
			$rt=$row['RequestType'];
			$pn=$row['PlateNo'];
			$wt=$row['WorkType'];
			$wv=(string)$row['WorkVenue'];
			/*$wv2 = "json_encode($wv)";*/
			$jc=$row['JobClassification'];
			$rept=$row['RepairType'];
			$pt=$row['PMType'];
			$it=$row['ImprovementType'];
			$bt=$row['BreakdownType'];
			$ctd=$row['CompletionTargetDate'];
			$tf=$row['TimeFile'];
			$df=$row['DateFile'];
			$pd=$row['PropertyDescription'];
			$pc=$row['ProblemCause'];
			$ca=$row['CorrectiveAction'];
			$pa=$row['PreventiveAction'];
			$remarks=$row['Remarks'];
			$rb=$row['RequestedBy'];
			$dhm=$row['DepartmentHeadManager'];
			$d1=$row['Designated1'];
			$d2=$row['Designated2'];
			$d3=$row['Designated3'];
			$st=$row['StartTime'];
			$sd=$row['StartDate'];
			$ft=$row['FinishTime'];
			$fd=$row['FinishDate'];
			$rrb=$row['RequestReceivedBy'];
			$rab=$row['RequestApprovedBy'];
			$tor=$row['TypeOfRequest'];
			$tmh=$row['TotalManHours'];
			$wcb=$row['WarehouseCheckedBy'];
			$cmvb=$row['CompletedMWRFVerifiedBy'];
			$rrno=$row['RRNo'];
			$da=$row['DateAdded'];
			$de=$row['DateEdited'];
			$ms=$row['MWRFStatus'];
			$requestor=$row['Requestor'];
			//die($wv); 
			//error_reporting(E_ALL);
					echo '<form action = "loadmaterials.php" method = "GET">';

					echo '<table width = "100%" class="table table-bordered" cellspacing="0">';
					echo '<tr>';
					echo '<td style= "min-width:100px;">'.$row['MWRFID'].'</td>';
					echo '<td style= "min-width:100px;">'.$row['MWRFNo'].'</td>';
					echo '</tr>';
					echo "</table>";
					echo "</form>";	
			}
		}
		$pendingcount = $result->num_rows;
		echo "<input type = 'hidden' name = 'txtpendingcount' id = 'txtpendingcount' value='$pendingcount'>";
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>

	<link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template-->
  <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="../../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../../css/sb-admin.css" rel="stylesheet">
</head>
<body>
	<script type="text/javascript">

	</script>
</body>
</html>