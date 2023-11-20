<?php
session_start();
include('../../classes/inc/dbCon.php');
require('eng.common.php');
$xajax->printJavascript('../../classes/xajax');
date_default_timezone_set("Asia/Manila");

if (isset($_SESSION['username'])){
  $username=$_SESSION['username'];
  $userid=$_SESSION['userinfoid'];
  $iduser=$_SESSION['user_id'];
      // die ($userid."ssss ".$username);
}else{
  header('location: ../login/login.php');
}
include('closedmwrfdata.php');
?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template-->
  <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
<!--   <link href="../../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet"> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- Custom styles for this template-->
  <link href="../../css/sb-admin.css" rel="stylesheet">
</head>
<body>
        <?php  
         echo '<input type="hidden" id="username" value="'.$username.'">';
         echo '<input type="hidden" id="userid" value="'.$userid.'">';
         echo '<input type="hidden" id="iduser" value="'.$iduser.'">';
        ?>
<!-- Edit Request Info -->
  <div class="" id="closedrequestmodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" style="width: 1200px;margin-left: -200px;min-height: 1000px;">

        <form action="loadmaterials.php" method="GET" enctype="multipart/form-data">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="margin-top: -30px;">
            <table class="table table-bordered">
              <tr>
                <td colspan="2" style="border:1px solid #17A2B8;"><strong>Request Details</strong></td>
                <td style="border:1px solid #17A2B8;"><strong>Date/Time Filed</strong></td>
                <td style="border:1px solid #17A2B8;"><strong>Maintenance:(Signature and Received Rate)</strong></td>
              </tr>
              <div class="">
                <td rowspan="2" width="20%" style="border-bottom:1px solid #17A2B8;border-left:1px solid #17A2B8;">
                  <div>
                    <label style="height: 30px;margin-left: 10px;">MWRF No.</label>
                  </div>
                  <br>
                  <div>
                    <label style="height: 30px;margin-left: 10px;">Request Type</label>

                  </div><br>
                  <div>
                    <label style="height: 30px;margin-left: 10px;">Plate/Machine No.</label>

                  </div>
                  <br>
                  <div>
                        <label style="height: 30px;margin-left: 10px;">Work Type</label>

                      </div>
                      <br>
                  <div>
                        <label style="height: 30px;margin-left: 70px;">Work Venue</label>

                      </div>
                      <br>
                      <div>
                        <label style="height: 30px;margin-left: 70px;">Job Classification</label>

                      </div>
                      <br>
                      <div>
                        <label style="height: 30px;margin-left: 30px;">Repair Type</label>

                      </div>
                      <br>
                      <div>
                        <label style="height:30px;margin-left: 30px;">PM Type</label>
                      </div>
                      <br>
                      <div style="width: 200px;">
                        <label style="height: 30px;margin-left: 30px;">Improvement Type</label>      
                      </div>
                      <br>
                      <div style="width: 200px;">
                        <label style="height: 30px;margin-left: 30px;">Breakdown Type</label>      
                      </div>
                      <br>
                  <div style="width: 200px;">
                    <label style="height: 30px;margin-left: 10px;">Completion Target Date</label>      
                  </div>
                  <br>
                  <br>
                </td>
                <!-- Input Value -->
                <!-- Input for Request Details -->   
                <td rowspan="2" style="border:1px solid #17A2B8;">

                  <div>
                    <input type="text" name="txtMWRF" class="form-control" id="txtMWRF"   placeholder="MWRF#" style="height: 35px;width: 300px;" disabled>
                    <input type="hidden" name="txtMWRFID" id="txtMWRFID" class="form-control"    placeholder="MWRF#" style="height: 35px;width: 300px;" disabled>
                  </div>
                  <br>
                  <div>
                    <select id="cborequesttype" class="form-control" style="width: 300px;height: 35px;" disabled>
                      <option disabled selected>Options..</option>
                      <option>Vehicle</option>
                      <option>Machine</option>
                      <option>Other Type</option>
                    </select>
                  </div><br>
                  <div>
                    <input type="text" name="txtplate" class="form-control" id="txtplatenos" placeholder="Plate/Machine No." style="height: 35px;width: 300px;" disabled>
                  </div><br>

                  <div>

                        <select class="form-control" id="txtworktype" disabled>
                          <option selected disabled>Work Type</option>
                          <option>maintenance</option>
                          <option>repair</option>
                          <option>installation</option>
                        </select>
                      </div><br>

                      <div>

                        <select class="form-control" id="txtworkvenue" disabled>
                          <option selected disabled>Work Venue</option>
                          <option>inhouse</option>
                          <option>jobout</option>
                        </select>
                      </div><br>
                      <div>
                        <select class="form-control" id="txtjobclass" disabled>
                          <option selected disabled>Job Classification</option>
                          <option>reactive</option>
                          <option>active</option>
                          <option>reactive/active</option>
                        </select>
                      </div><br>
                      <div>
                        <select class="form-control" id="txtrepairtype" disabled>
                          <option selected disabled>Repair Type</option>
                          <option>rehabilitate</option>
                          <option>overhaul</option>
                          <option>check</option>
                        </select>
                      </div><br>
                      <div>
                        <select class="form-control" id="txtpmtype" disabled>
                          <option selected disabled>Pm Type</option>
                          <option>cleaning</option>
                          <option>adjustment</option>
                          <option>replacement of parts/items</option>
                          <option>fabrication</option>
                        </select>
                      </div><br>
                      <div>
                        <select class="form-control" id="txtimprovement" disabled>
                          <option selected disabled>Improvement Type</option>
                          <option>Upgrade</option>
                        </select>
                      </div><br>
                      <div>
                        <select class="form-control" id="txtbreakdown" disabled>
                          <option selected disabled>Breakdown Type</option>
                          <option>Damage</option>
                        </select>
                      </div><br>
                  <div>
                    <input type="date" class="form-control" id="dtpcompletion" name="" style="height: 35px;width: 300px;" disabled>
                    <br>
                  </div>
                  <br>
                </td>

                <td style="border:1px solid #17A2B8;">
                  Date/Time:<br>
                  <p id="txtcurrdate" style="display: none;"></p>
                  <p id = "txtcurrtime"></p>
                </td>
                <td style="border:1px solid #17A2B8;"><br><label for="usr"> <!-- Maintenance -->
                </label>
                <input type="text" class="form-control" placeholder="Designated to: (1)" id="txtdesignated1" style="width :300px;height: 30px" disabled><br/>
                <input type="text" class="form-control" placeholder="Designated to: (2)" id="txtdesignated2" style="width :300px;height: 30px" disabled><br/>
                <input type="text" class="form-control" placeholder="Designated to: (3)" id="txtdesignated3" style="width :300px;height: 30px" disabled><br/></td>

                <tr>
                  <td colspan="2" style="border:1px solid #17A2B8;"><strong>Action:Causes</strong><br><br>
                   
                      <label for="inputPassword" class="col-form-label" style="height: 30px;">Property Description:</label>
                      
                        <input type="text" class="form-control" id="txtDescription" placeholder="" style="height: 30px;" disabled>
                      
                    Problem Causes:<br>
                    <textarea class="form-control" id="txtCauses" rows="2" disabled></textarea>

                    Remarks:<br>
                    <textarea class="form-control" id="txtremarks" rows="2" disabled></textarea>
                    <br>
                    <div class="form-row">
                      <div class="col">
                        <label style="height: 30px;">Request By</label>
                        <?php
                              global $db;
                              $sql = "SELECT *FROM tblstaffs WHERE infono = 1";
                              $result=$db->query($sql);
                              $c=1;
                              echo '<div class="col-sm-10">';
                              echo '<select class="form-control" id="txtrequestby" disabled>';
                              echo '<option selected disabled>Request By</option>';
                              if ($result->num_rows > 0 ){
                                while ($row=$result->fetch_assoc()){
                                  echo '<option>'.$row['name'].'</option>';
                                }
                              }
                              echo '</select>';
                              echo '</div>';
                         ?>
                      </div>
                      <div class="col">
                        <label style="height: 30px;">Department Head/Manager</label>
                        <?php
                              global $db;
                              $sql = "SELECT *FROM tblstaffs WHERE infono = 2";
                              $result=$db->query($sql);
                              $c=1;
                              echo '<div class="col-sm-10">';
                              echo '<select class="form-control" id="txtdepthead" disabled>';
                              echo '<option selected disabled>Department Head/Manager</option>';
                              if ($result->num_rows > 0 ){
                                while ($row=$result->fetch_assoc()){
                                  echo '<option>'.$row['name'].'</option>';
                                }
                              }
                              echo '</select>';
                              echo '</div>';
                         ?>
                      </div>
                    </div>
                    <br/></td></td></tr><br/></td></td></tr>

                  </tr>  
                </table>
                <!-- 2nd panel -->
                <div style="min-width:300px;height: 150px;border: 1px solid white;">
                  <table class="table table-bordered">
                    <tr>
                      <td rowspan="" ="2" style="border:1px solid #17A2B8;"><strong>START</strong></td>
                      <td style="border:1px solid #17A2B8;"><strong>FINISH</strong></td>
                      <td style="border:1px solid #17A2B8;"><strong>APPROVAL STATUS</strong></td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-row">
                          <div class="col">
                            <label style="height: 30px;">Time</label>
                            <input id="stime" type="time" class="form-control" placeholder="Request by" style="height: 30px;" disabled>
                          </div>
                          <div class="col">
                            <label style="height: 30px;">Date</label>
                            <input id="sdate" type="date" class="form-control" placeholder="Department Head/Manager" style="height: 30px;" disabled>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="form-row">
                          <div class="col">
                            <label style="height: 30px;">Time</label>
                            <input id="ftime" type="time" class="form-control" placeholder="Request by" style="height: 30px;" disabled>
                          </div>
                          <div class="col">
                            <label style="height: 30px;">Date</label>
                            <input id="fdate" type="date" class="form-control" placeholder="Department Head/Manager" style="height: 30px;" disabled>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="form-row">
                          <div class="col">
                            <label style="height: 30px;">Received by</label>
                            <input id="txtrecby" type="text" class="form-control" placeholder="Received by" style="height: 30px;" disabled>
                          </div>
                          <div class="col">
                            <label style="height: 30px;">Approved by</label>
                            <input id="txtappby" type="text" class="form-control" placeholder="Approved by" style="height: 30px;" disabled>
                          </div>
                        </div>
                      </td>
                      
                    </tr>
                    <tr>
                      <td>
                        <div class="col">
                          <label style="height: 30px;"><strong>MWRF Status</strong></label>
                          <select class="form-control" id="cbostatus" disabled>
                            <option>COMPLETED</option>
                            <option>CANCELLED</option>
                            <option>PENDING</option> 
                          </select>
                        </div> 
                      </td>
                      <td>
                        <div class="col">
                          <label style="height: 30px;"><strong>Completed MWRF Verified by:</strong></label>
                          <input type="" name="txtcmvb" id="txtcmvb" class="form-control" disabled>
                        </div>
                      </td>
                    </tr>
                  </table>
                </div>
              </table>
              <div class="modal-footer">
                <button type="button" class="btn btn-info" id="btnFormUpdate"><i style="padding-right: 5px;" class="fas fa-save"></i></i>Close MWRF</button>  
              </div>
            </form>
          </div>
        </div>

        <form action="loadmaterials.php" method="GET">
          <input type="hidden" name="txthidden" id="txthidden">

        </form>

      </div>
      <!-- End -->

    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../js/sb-admin.min.js"></script>
    <script type="text/javascript">

    var currdate;
    //var currtime;
    currdate = new Date();
    currdate = currdate.getFullYear() + '-' +
    ('00' + (currdate.getMonth()+1)).slice(-2) + '-' +
    ('00' + currdate.getDate()).slice(-2);

    $("#btndata").trigger('click');

     var hid = $('#txtMWRFID').val();
     var search = window.parent.$('#txtsearch').val();

     //if txtsearch is blank catch     
     if (search == ""){

     }
     // if no id found
     else if (hid == ""){
        alert("no data found");
     }
     //if id found
     else {
      window.parent.$('#closedrequestmodal').modal('show');
     }

     $('#btnFormUpdate').click(function(){
      var dept = window.parent.$('#txtusername').val();
      var mwrfid = $('#txtMWRFID').val();
      //alert(username);
      xajax_insertclosedarchive(dept,"Request MWRF ID " +mwrfid + " "+ "has been closed",currdate);
      xajax_insertclosed(mwrfid);
      //window.top.location.reload();
     });
    </script>
</body>
</html>