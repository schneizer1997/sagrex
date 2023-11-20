<?php
include('../../classes/inc/dbCon.php');

	global $db;
	
	$sql = "SELECT MWRFID,MWRFNo,RequestType,PlateNo,WorkType,WorkVenue,JobClassification,RepairType,PMType,ImprovementType,BreakdownType,CompletionTargetDate,TimeFile,DateFile,PropertyDescription,ProblemCause,CorrectiveAction,PreventiveAction,Remarks,RequestedBy,DepartmentHeadManager,Designated1,Designated2,Designated3,StartTime,StartDate,FinishTime,FinishDate,RequestReceivedBy,RequestApprovedBy,TypeOfRequest,TotalManHours,WarehouseCheckedBy,CompletedMWRFVerifiedBy,RRNo,DateAdded,DateEdited,MWRFStatus,Requestor, TIME(`FinishTime`) AS time_fin, TIME(`StartTime`) AS time_start FROM tblrequestform WHERE MWRFStatus = 'PENDING' ORDER BY MWRFID DESC";
	$result=$db->query($sql);
	$c=1;
	if ($result->num_rows > 0){
		while ($row=$result->fetch_assoc()){
			$mwrfid=$row['MWRFID'];
			$mwrfno=$row['MWRFNo'];
			$rt=$row['RequestType'];
			$pn=$row['PlateNo'];
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
			//var_dump($pd);
			$pc=preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '',$row['ProblemCause']);
			$ca=preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '',$row['CorrectiveAction']);
			$pa=preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '',$row['PreventiveAction']);
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
			//var_dump($timepart);
			//die($wv); 
			error_reporting(E_ALL);
/*$html = <<<HTML
  <tr>
  	<td>$mwrfid</td>
  	<td>$pd</td>
  	<td>$rb</td>
  	<td>$df</td>
  	<td>
  		<button type="button" class="btn btn-primary" 
  		onclick="editrequestmodal($mwrfid,$mwrfno,$rt,$pn,
					$wt,$wv,$jc,$rept,$pt,$it,$bt,$ctd,
					$tf,$df,$pd,$pc,$ca,$pa,$remarks,$rb,$dhm,$d1,$d2,$d3,$st,$sd,$ft,$fd,
					$rrb,$rab,$ms,$timestart,$timefin);"></button>
  	</td>
  </tr>
HTML;
echo $html;*/
					echo '<td>'.$row['MWRFID'].'</td>';
					echo '<td style= "width:200px;">'.$row['PropertyDescription'].'</td>';
					echo '<td>'.$row['RequestedBy'].'</td>';
					echo '<td>'.$row['DateFile'].'</td>';
					echo '<td> 
					<button type="button" class="btn btn-primary" id="'.$mwrfid.'"  onclick=\'(editrequestmodal("'.$mwrfid.'","'.$mwrfno.'","'.$rt.'","'.$pn.'",
					"'.$wt.'","'.$wv.'","'.$jc.'","'.$rept.'","'.$pt.'","'.$it.'","'.$bt.'","'.$ctd.'",
					"'.$tf.'","'.$df.'","'.$pd.'","'.$pc.'","'.$ca.'","'.$pa.'","'.$remarks.'","'.$rb.'","'.$dhm.'","'.$d1.'","'.$d2.'","'.$d3.'","'.$st.'","'.$sd.'","'.$ft.'","'.$fd.'","'.$rrb.'","'.$rab.'","'.$cmvb.'","'.$ms.'","'.$timestart.'","'.$timefin.'"))\'><i style="padding-right: 2px;" class="fas fa-edit"></i>Edit</button>

					<button type="button" class="btn btn-primary" id="'.$mwrfid.'"  onclick=\'(addrequestmaterialmodal("'.$mwrfid.'","'.$pn.'","'.$mwrfno.'","'.$rt.'","'.$rrno.'"))\'><i style="padding-right: 2px;" class="fa fa-plus-square"></i>Add</button>
					<button type="button" class="btn btn-primary" id="'.$mwrfid.'"  onclick=\'(viewrequestmaterialsmodal("'.$mwrfid .'"))\'><i style="padding-right: 2px;" class="fas fa-clipboard-list"></i>Items</button>
					<button type="button" class="btn btn-primary" id="'.$mwrfid.'"  onclick=\'(verificationmodal("'.$mwrfid.'","'.$ms.'"))\'>
					<i style="padding-right: 2px;" class="fas fa-clipboard-check"></i>Verify Items</button>
					
					</td>';

					echo '</tr>';	
			}
		}

?>
<!DOCTYPE html>
<html>
<head>
	<link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template-->
  <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="../../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- Custom styles for this template-->
  <link href="../../css/sb-admin.css" rel="stylesheet">
	<title></title>
</head>
<body>

</body>
</html>