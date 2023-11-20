<?php
include ('../../classes/inc/dbCon.php');

        /*function reserverLab($subjectName,$courseCode,$time_id,$isMonday,$isTuesday,$isWednesday,$isThursday,$isFriday,$lab_id,$teacherID,$reservedDate){
        	global $db;
        	$objResponse= new xajaxResponse();
            // $parsaDate=DateTime::createFromFormat('Y-m-d',$reservedDate);
            // echo $parsaDate;
            // // $objResponse->addAlert(xajax$parsaDate);
            // // die ($parsaDate);

         		
     		$sql="INSERT INTO reservation_list (subjectName,courseCode,time_id,isMonday,isTuesday,isWednesday,isThursday,isFriday,lab_id,teacherID,isApproved,reservedDate,isDecline) VALUES ('".$subjectName."','".$courseCode."',$time_id,$isMonday,$isTuesday,$isWednesday,$isThursday,$isFriday,$lab_id,$teacherID,0,'".$reservedDate."',0)";
     			if ($db->query($sql) == TRUE){
     					// echo 'sd';
                     // $objResponse->addAlert('Please Wait for the approval of the admin');
     			}else{
     				$objResponse->addAlert('Invalid: '. $db->error);
     			// printf("Errormessage: %s\n", $db->error);
     			}



        	return $objResponse;
      }

      function reserveseminar($subjectName,$courseCode,$time_id,$isMonday,$isTuesday,$isWednesday,$isThursday,$isFriday,$lab_id,$teacherID,$reservedDate){
            global $db;
            $objResponse= new xajaxResponse();
            // $parsaDate=DateTime::createFromFormat('Y-m-d',$reservedDate);
            // echo $parsaDate;
            // // $objResponse->addAlert(xajax$parsaDate);
            // // die ($parsaDate);

                
            $sql="INSERT INTO seminarres_list (subject_name,course_code,time_id,isMonday,isTuesday,isWednesday,isThursday,isFriday,lab_id,teacher_id,isApproved,reserve_date,isDecline) VALUES ('".$subjectName."','".$courseCode."',
            '".$time_id."',$isMonday,$isTuesday,$isWednesday,$isThursday,$isFriday,$lab_id,$teacherID,0,'".$reservedDate."',0)";
                if ($db->query($sql) == TRUE){
                        // echo 'sd';
                     // $objResponse->addAlert('Please Wait for the approval of the admin');
                }else{
                    $objResponse->addAlert('Invalid: '. $db->error);
                // printf("Errormessage: %s\n", $db->error);
                }
                //die($objResponse);


            return $objResponse;
      }*/
      /*function reserveseminar($subjectname,$courseCode,$user_id,$reserve_date,$lab_id,$times){
        global $db;
        $objResponse= new xajaxResponse();
        $sql = "INSERT INTO seminarschedule (subject_name,course_code,user_id,reserve_date,lab_id,
        sched_time) VALUES ('".$subjectname."','".$courseCode."',$user_id,'".$reserve_date."',
        $lab_id,'".$times."')";
        $sql = "INSERT INTO seminarschedule (subject_name,course_code,user_id,reserve_date,lab_id,
        sched_time) VALUES ($subjectname,$courseCode,$user_id,$reserve_date,
        $lab_id,$times)";
        if ($db->query($sql) == TRUE){
                        // echo 'sd';
                     // $objResponse->addAlert('Please Wait for the approval of the admin');
                }else{
                    $objResponse->addAlert('Invalid: '. $db->error);
                // printf("Errormessage: %s\n", $db->error);
                }
                //var_dump($sql);die;
        //$objResponse->addAlert('wew'.$sql);

            return $objResponse;
      }*/
      // reserverLab('sd','23232',1,2,3,4,5,6,7,8);

    require("eng.common.php");
    $xajax->processRequests();
?>