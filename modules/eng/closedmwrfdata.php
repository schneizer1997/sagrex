<?php
include('../../classes/inc/dbCon.php');
	global $db;

	$appendurlid = $_GET['mwrfid'];
	$sql = "SELECT MWRFID,MWRFNo,RequestType,PlateNo,WorkType,WorkVenue,JobClassification,RepairType,PMType,ImprovementType,BreakdownType,CompletionTargetDate,TimeFile,DateFile,PropertyDescription,ProblemCause,CorrectiveAction,PreventiveAction,Remarks,RequestedBy,DepartmentHeadManager,Designated1,Designated2,Designated3,StartTime,StartDate,FinishTime,FinishDate,RequestReceivedBy,RequestApprovedBy,TypeOfRequest,TotalManHours,WarehouseCheckedBy,CompletedMWRFVerifiedBy,RRNo,DateAdded,DateEdited,MWRFStatus,Requestor, TIME(`FinishTime`) AS time_fin, TIME(`StartTime`) AS time_start FROM tblrequestform WHERE MWRFID = '".$appendurlid."' AND MWRFStatus = 'COMPLETED' AND isdelete = 1 ";
	$result=$db->query ($sql);
	$c=1;
	if ($result->num_rows > 0 ){
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
			/*echo '<input type = "text" id = "">';*/
			echo '<button type="button" class="btn btn-primary" id="btndata" style ="display:none;"  onclick=\'(closemwrfmodal("'.$mwrfid.'","'.$mwrfno.'","'.$rt.'","'.$pn.'",
					"'.$wt.'","'.$wv.'","'.$jc.'","'.$rept.'","'.$pt.'","'.$it.'","'.$bt.'","'.$ctd.'",
					"'.$tf.'","'.$df.'","'.$pd.'","'.$pc.'","'.$ca.'","'.$pa.'","'.$remarks.'","'.$rb.'","'.$dhm.'","'.$d1.'","'.$d2.'","'.$d3.'","'.$st.'","'.$sd.'","'.$ft.'","'.$fd.'","'.$rrb.'","'.$rab.'","'.$cmvb.'","'.$ms.'","'.$timestart.'","'.$timefin.'"))\'><i style="padding-right: 2px;" class="fas fa-edit"></i>Edit</button>';

			$count = $result->num_rows;
			/*var_dump($count);*/
			echo "<input type = 'hidden' id = 'txtcount' name = 'txtcount' value = '$count'>";
		}
	}
	else {
		var_dump("not found.");
	}


 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 </head>
 <body>
 

 <script type="text/javascript">


    function closemwrfmodal(mwrfid,MWRFNo,rt,pn,wt,wv,jc,rept,pt,it,bt,ctd,tf,df,pd,pc,ca,pa,remarks,rb,dhm,d1,d2,d3,st,sd,ft,fd,rrb,rab,cmvb,ms,timestart,timefin){
      $('#txtMWRFID').val(mwrfid);
        $('#txtMWRF').val(MWRFNo);
        $("select#cborequesttype option").each(function() { this.selected = (this.text == rt); });

        $('#txtplatenos').val(pn);
        $('#txtworktype').val(wt);
        //$('select#txtworktype option').each(function() { this.selected = (this.text == wt); });
        $('#txtworkvenue').val(wv);
        //$('select#txtworkvenue option').each(function() { this.selected = (this.text == wv); });
        $('#txtjobclass').val(jc);
        //$('select#txtjobclass option').each(function() { this.selected = (this.text == jc); });
        $('#txtrepairtype').val(rept);
        //$('select#txtrepairtype option').each(function() { this.selected = (this.text == rept); });
        $('#txtpmtype').val(pt);
        //$('select#txtpmtype option').each(function() { this.selected = (this.text == pt); });
        $('#txtimprovement').val(it);
        //$('select#txtimprovement option').each(function() { this.selected = (this.text == it); });
        $('#txtbreakdown').val(bt);
        //$('select#txtbreakdown option').each(function() { this.selected = (this.text == bt); });
        $('#dtpcompletion').val(ctd);
        document.getElementById('txtcurrtime').innerHTML = tf;
          //$('#txtcurrdate').val(new Date().toDateInputValue());
        document.getElementById('txtcurrdate').innerHTML = df;
          
          $('#txtDescription').val(pd);
          $('#txtCauses').val(pc);
          /*$('#txtCorrective').val(ca);
          $('#txtPreventive').val(pa);*/
          $('#txtremarks').val(remarks);
          $('#txtrequestby').val(rb);
          $('#txtdepthead').val(dhm);
          $('#txtdesignated1').val(d1);
          $('#txtdesignated2').val(d2);
          $('#txtdesignated3').val(d3);
          $('#stime').val(timestart);
          $('#ftime').val(timefin);
          $('#sdate').val(sd);
          //$('#ftime').val(ft);
          $('#fdate').val(fd);
          $('#txtrecby').val(rrb);
          $('#txtappby').val(rab);
          $('#txtcmvb').val(cmvb);
          $("select#cbostatus option").each(function() { this.selected = (this.text == ms); });


     }
 </script>
 </body>
 </html>