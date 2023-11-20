<?php
/*include('../../../classes/inc/dbConInventory.php');*/
include('../../../classes/inc/dbCon.php');
// Load data in maintenance module

global $db;
$sql = "SELECT MWRFID,MWRFNo,RequestType,PlateNo,WorkType,WorkVenue,JobClassification,RepairType,PMType,ImprovementType,BreakdownType,CompletionTargetDate,TimeFile,DateFile,PropertyDescription,ProblemCause,CorrectiveAction,PreventiveAction,Remarks,RequestedBy,DepartmentHeadManager,Designated1,Designated2,Designated3,StartTime,StartDate,FinishTime,FinishDate,RequestReceivedBy,RequestApprovedBy,TypeOfRequest,TotalManHours,WarehouseCheckedBy,CompletedMWRFVerifiedBy,RRNo,DateAdded,DateEdited,MWRFStatus,Requestor, TIME(`FinishTime`) AS time_fin, TIME(`StartTime`) AS time_start FROM tblrequestform WHERE MWRFStatus = 'PENDING' AND isdelete = 1 ORDER BY MWRFID DESC";

$result=$db->query($sql);
$c=1;
if ($result->num_rows > 0){

	while ($row=$result->fetch_assoc()){
		$mwrfid=$row['MWRFID'];
		$mwrfno=$row['MWRFNo'];
		$rt=$row['RequestType'];
		$pn=preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['PlateNo']);
		$wt=$row['WorkType'];
		$wv=(string)$row['WorkVenue'];
		$jc=$row['JobClassification'];
		$rept=$row['RepairType'];
		$pt=$row['PMType'];
		$it=$row['ImprovementType'];
		$bt=$row['BreakdownType'];
		$ctd=$row['CompletionTargetDate'];
		$tf=$row['TimeFile'];
		$df=$row['DateFile'];
		$pd=preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['PropertyDescription']) ;
		$pc=preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '',$row['ProblemCause']);
		$remarks=preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['Remarks']);
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
		$timestart = $row['time_start'];
		$timefin = $row['time_fin'];

		echo "<tr>";
		echo '<td>'.$row['MWRFID'].'</td>';
		echo '<td style= "width:200px;">'.$row['PropertyDescription'].'</td>';
		echo '<td style= "width:120px;">'.$row['RequestedBy'].'</td>';
		echo '<td>'.$row['DateFile'].'</td>';
		echo '<td>

		<button type="button" class="btn btn-info" id="btnrrmodal"  onclick=\'(viewrrsis("'.$mwrfid.'"))\'><i style="padding-right: 2px;" class="far fa-edit"></i>RR</button>
		<button type="button" class="btn btn-info" id="btnsismodal"  onclick=\'(viewsis("'.$mwrfid.'"))\'><i style="padding-right: 2px;" class="far fa-edit"></i>SIS</button>
		</td>';
		echo "</tr>";
	}

}

?>
<!DOCTYPE html>
<html>
<head>
	<link href="../../../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="../../../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="../../../../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
	<link href="../../../../css/sb-admin.css" rel="stylesheet">
	<title></title>
</head>
<body>

</body>
</html>