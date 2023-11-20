<?php
include('../../classes/inc/dbCon.php');

	global $db;
	
	$sql = "SELECT  *FROM tblrequestform WHERE MWRFStatus = 'COMPLETED' OR MWRFStatus = 'PENDING' ORDER BY MWRFID DESC";
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
			//die($wv); 
			error_reporting(E_ALL);
					echo '<tr>';
					echo '<td>'.$row['MWRFID'].'</td>';
					echo '<td>'.$row['PropertyDescription'].'</td>';
					echo '<td>'.$row['RequestedBy'].'</td>';
					echo '<td>'.$row['DateFile'].'</td>';
					echo '<td> 
					
					<button type="button" class="btn btn-primary" id="'.$mwrfid.'"  onclick=\'(loadreportpdf("'. $mwrfid .'","'.$mwrfno.'","'.$rt.'","'.$pn.'",
					"'.$wt.'","'.$wv.'","'.$jc.'","'.$rept.'","'.$pt.'","'.$it.'","'.$bt.'","'.$ctd.'",
					"'.$tf.'","'.$df.'","'.$pd.'","'.$pc.'","'.$ca.'","'.$pa.'","'.$remarks.'","'.$rb.'","'.$dhm.'","'.$d1.'","'.$d2.'","'.$d3.'","'.$st.'","'.$sd.'","'.$ft.'","'.$fd.'","'.$rrb.'","'.$rab.'","'.$tor.'","'.$tmh.'","'.$wcb.'","'.$rrno.'","'.$ms.'","'.$requestor.'","'.$cmvb.'","'.$da.'","'.$de.'"))\'><i style ="padding-right:5px;" class="fas fa-print"></i>Preview</button>
					
					</td>
                        <input type="hidden" value='.$mwrfid.' id="getIdsem'.$c.'">';

					echo '</tr>';	
			}
		}

?>