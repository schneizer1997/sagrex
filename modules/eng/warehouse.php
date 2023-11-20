<?php
//Warehouse Module
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

?>  
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SAGREX Warehouse</title>

  <!-- Bootstrap core CSS-->
  <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template-->
  <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- Page level plugin CSS-->
  <link href="../../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../../css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="../dashboard/index.php"><strong>SAGREX Corporation</strong></a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form action="ware_loadmaterials.php" method="GET" class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
        <div class="input-group-append">
          <button class="btn btn-primary" type="button">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
      
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link">
         <?php echo 'Welcome, '.$username; 
         echo '<input type="hidden" id="userid" value="'.$userid.'">';
         echo '<input type="hidden" id="iduser" value="'.$iduser.'">';?></a>

       </li>
       <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user-circle fa-fw"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="#">Settings</a>
          <a class="dropdown-item" href="#">Activity Log</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
        </div>
      </li>
    </ul>

  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="../dashboard/index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="../eng/eng.php">
            <i class="fa fa-gear" style="padding-right: 5px;"></i>
            <span>Engineering</span>
          </a>
          <!-- <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Selection</h6>
            <a class="dropdown-item" href="login.html">MWRF</a>
            <a class="dropdown-item" href="register.html">Register</a>
            <a class="dropdown-item" href="forgot-password.html">Forgot Password</a>
            <div class="dropdown-divider"></div>
            <h6 class="dropdown-header">Other Pages:</h6>
            <a class="dropdown-item" href="404.html">404 Page</a>
            <a class="dropdown-item" href="blank.html">Blank Page</a>
          </div> -->
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#">
            <i class="fas fa-calculator" style="padding-right: 5px;"></i>
            <span>Accounting</span></a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#">
            <i class="fas fa-truck" style="padding-right: 5px;"></i>
            <span>Logistics</span></a>
        </li>
        <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#">
                <i class="fa fa-users" style="padding-right: 5px;"></i>
                <span>Human Resource</span></a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#">
              <i class="fa fa-line-chart" style="padding-right: 5px;"></i>
              <span>Sales</span></a>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#">
              <i class="fas fa-clipboard" style="padding-right: 5px;"></i>
              <span>Warehouse</span></a>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#">
              <i class="fas fa-money-check" style="padding-right: 5px;"></i>
              <span>Purchasing</span></a>
        </li>
      </ul>

            <div id="content-wrapper">

              <div class="container-fluid">

                <!-- Breadcrumbs-->
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="#">Dashboard</a>
                  </li>
                  <li class="breadcrumb-item active">Overview</li>
                </ol>

                <!-- DataTables Example -->
                <div class="card mb-3">
                  <div class="card-header" style="background-color: #3399CC;color: white;">
                    <i class="fas fa-table"></i>
                    <strong>Request Material Status</strong></div>
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                          <thead>
                            <tr>
                              <th style = "min-width:0px;">MWRFID</th>
                              <th style = "min-width:70px;">Property Description</th>
                              <th style = "min-width:70px;">Requested By</th>
                              <th style = "min-width:70px;">Date File</th>
                              <th style = "min-width:70px;">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            include('ware_loadrequestform.php');
                            ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
                  </div>

                  <!-- Edit Request Material -->
                  <div class="modal fade bd-example-modal-lg" id="credentialmaterialmodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content" style="width: 1200px;min-height:500px;margin-left: -180px;">
                        <div class="modal-header"  style="background-color: #17A2B8;color:white;">
                          <h5 class="modal-title" id="formModalLabel">Request Materials</h5>
                          <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnFormClose"><i class="fa fa-close"></i></button>
                        </div>
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                          <div style="margin-left: 10px;margin-top: 10px;">Material Information</div>

                          <div style="float: right;border: 1px;">
                            <form action="ware_loadmaterials.php" method="GET" enctype="multipart/form-data">
                              <div style="border: 1px;min-height: 100px;min-width:300px;line-height: 50px;margin: 10px;">
                                <div id="leftmat" style="border: 1px;min-width: 600px;float: left;">
                                  <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" id="" style="height: 30px;">MWRF ID:</label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" name="mwrfidmaterial2" id="mwrfidmaterial2" placeholder="" style="height: 30px;"  disabled>
                                      <input type="hidden" class="form-control" id="mwrfidmaterialhidden" placeholder="" style="height: 30px;">
                                    </div>
                                  </div>

                                  <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" id="" style="height: 30px;">RRNo.</label>
                                    <div class="col-sm-10">
                                      <input type="text" name="" class="form-control" id="txtwarerrno">
                                    </div>
                                    <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Status:</label>
                                    <div class="form-check form-check-inline" style="margin-left: 20px;">

                                      <input class="form-check-input" type="checkbox" id="exampleCheck1">
                                      <label class="form-check-label" id="lblStatus" for="exampleCheck1">COMPLETED</label>
                                    </div>
                                    <div class="form-check form-check-inline" style="margin-left: 30px;">
                                    <input class="form-check-input" type="checkbox" id="exampleCheck2" name="exampleCheck2">
                                    <label class="form-check-label" id="lblStatuspend" for="exampleCheck2">PENDING</label>
                                  </div>
                                  </div>
                                </div>
                                <div id = "rightmat" style="border: 1px;min-width: 400px;float: left;margin-left: 20px;">
                                    <div class="form-group row">
                                      <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Check By:</label>
                                      <div class="col-sm-10">
                                      <input type="text" class="form-control" id="txtrcb" placeholder="" style="height: 40px;">
                                    </div>
                                  </div>
                                  </div>      
                              </div>

                            </form>
                            <div class="modal-footer" style="border: 1px;float: right;">     
                              <button type="button" class="btn btn-info" id="btnstatusupdate">
                                <i style="padding-right: 5px;" class="fas fa-save"></i>Update</button>
                                <button type="button" class="btn btn-info" id="btnstatusupdateall">
                                <i style="padding-right: 5px;" class="fas fa-database"></i>Update All</button>
                                <button type="button" class="btn btn-info" name="btnloadmat" id="btnloadmat" style=""><i style="padding-right: 5px;" class="fa fa-refresh"></i>Reload</button>
                            </div>
                              <thead class="table table-bordered" style="border-top: 0px solid #17A2B8;width: 100%;table-layout: fixed;background-color: #17A2B8;color: white;line-height: 20px;" align="center">
                                <tr>
                                  <th style = "width:170px;">Materials</th>
                                  <th style = "width:70px;">Quantity</th>
                                  <th style = "width:120px;">Unit Price</th>
                                  <th style = "width:120px;">Date Granted</th>
                                  <th style = "width:120px;">Shop</th>
                                  <th style = "width:100px;">Request Type</th>
                                  <th style = "width:70px;">RRNo</th>
                                  <th style = "width:50px;">Check By Warehouse</th>
                                  <th style = "width:70px;">Action</th>
                                </tr>
                              </thead>
                              <div style="border: 1px;height:0px;min-width:500px;margin-right:2px;">
                                <table class="table table-bordered" id="mtable1" cellspacing="0">      
                                  <tbody id="mtable2">
                                    <iframe style="border: 0px solid red;height: 200px;margin-top: -20px;" name="framemat" id="framemat" src="ware_loadmaterials.php" /></iframe>
                                  </tbody>
                                </table>
                              </div>

                            </div>
                          </table>

                        </div>
                      </div>
                    </div>
                    <!-- End -->

                    <form action="ware_loadmaterials.php" method="GET">
                      <input type="hidden" name="txthidden" id="txthidden">

                    </form>
                    <!-- Footer -->

                  </div>

                </div>
                <!-- /.container-fluid -->

                <!-- Sticky Footer -->
                <footer>
                  <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                      <span>Copyright © SAGREX 2018</span>
                    </div>
                  </div>
                </footer>

              </div>
              <!-- /.content-wrapper -->

            </div>
            <!-- /#wrapper -->
            <!-- Scroll to Top Button-->
            <a class="scroll-to-top rounded" href="#page-top">
              <i class="fas fa-angle-up"></i>
            </a>

            <!-- Logout Modal-->
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                  </div>
                  <div class="modal-body">Select "Logout" below if you are ready to end your current session.
                  </div>
                  <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../session/logout.session.php">Logout</a>
                  </div>
                </div>
              </div>
            </div>

            <!-- Bootstrap core JavaScript-->
            <script src="../../vendor/jquery/jquery.min.js"></script>
            <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

            <!-- Core plugin JavaScript-->
            <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>

            <!-- Page level plugin JavaScript-->
            <!-- <script src="../../vendor/chart.js/Chart.min.js"></script> -->
            <script src="../../vendor/datatables/jquery.dataTables.js"></script>
            <script src="../../vendor/datatables/dataTables.bootstrap4.js"></script>

            <!-- Custom scripts for all pages-->
            <script src="../../js/sb-admin.min.js"></script>

            <!-- Demo scripts for this page-->
            <script src="../../js/demo/datatables-demo.js"></script>
            <!-- <script src="../../js/demo/chart-area-demo.js"></script> -->
            <script type="text/javascript">

              var currdate;
              var currtime;
              currdate = new Date();
              currdate = currdate.getFullYear() + '-' +
              ('00' + (currdate.getMonth()+1)).slice(-2) + '-' +
              ('00' + currdate.getDate()).slice(-2);
      //currdate = date("Y-m-d",strtotime(currdate));  

      currtime = new Date();
      currtime = ('00' + currtime.getHours()).slice(-2) + ':' + 
      ('00' + currtime.getMinutes()).slice(-2) + ':' + 
      ('00' + currtime.getSeconds()).slice(-2);

      function selectmaterials(materialsid,rrno,cbl){
        var checks = $('#exampleCheck1').prop('checked'); //true or false
        //var con = checks ? 1 : 0; // convert boolean to string
        $('#mwrfidmaterialhidden').val(materialsid);
        $('#txtwarerrno').val(rrno);
        //alert(i);
        
        if (cbl == 1) {         
          $('#exampleCheck2').prop('checked',false);
          $('#exampleCheck1').prop('checked',true);
          $('#lblStatus').text("COMPLETED");
        }
        else if (cbl == 0){
          cbl = "false";
          $('#exampleCheck1').prop('checked',false);
          $('#exampleCheck2').prop('checked',true);
          $('#lblStatus2').text("PENDING");
        }
        

      }
      function statusmaterialsmodal(mwrfid,wcb){
        $('#mwrfidmaterial2').val(mwrfid);
        $('#mwrfidmaterialhidden').val("");
        $('#txtwarerrno').val("");
        $('#txtrcb').val(wcb);
        var appendurl = $('#mwrfidmaterial2').val();

        history.replaceState("","","?mwrfid1=" + appendurl);

        var myFrame = $('#framemat');
        var url = $(myFrame).attr('src')+"?mwrfid1="+appendurl;

        var loc = url;
        var params = loc.split('?')[1];
        document.getElementById("framemat").src = 'ware_loadmaterials.php?mwrfid1=' + appendurl;
        $('#credentialmaterialmodal').modal('show');
      }

      $(document).ready(function(){
        $('#btnCreatenew').click(function(){
          $('#createrequestmodal').modal('show');

        });

      });
      $('#exampleCheck1').change(function() {
            $('#exampleCheck1').prop('checked',true);
            $('#exampleCheck2').prop('checked',false);
        });

      $('#exampleCheck2').change(function() {
            $('#exampleCheck2').prop('checked',true);
            $('#exampleCheck1').prop('checked',false);
        });
      $('#btnstatusupdate').click(function(){
        var matid = $('#mwrfidmaterialhidden').val();
        var rrno = $('#txtwarerrno').val();
        var mwrfid2 = $('#mwrfidmaterial2').val();
        var wcb = $('#txtrcb').val(); 
        var checks = $('#exampleCheck1').prop('checked'); //true or false
        var con = checks ? 1 : 0; // convert boolean to string
          
          if (matid == ""){
            alert("Select a Material below first.");
          }
          else {
            //alert(checks);
            if (checks == 1){
            xajax_updateisdelete(matid,1);
            }
            xajax_updatestatus(matid,rrno,con);
            xajax_updatewcb(mwrfid2,wcb);
            xajax_archiveinsert("Warehouse","Material ID "+matid+" has been updated its status",currdate + " "+currtime);

            $("#btnloadmat").trigger('click');
            $("#btnloadmat").trigger('click');
            $("#btnloadmat").trigger('click');

          }          
        });
      $('#btnstatusupdateall').click(function(){
        var matid = $('#mwrfidmaterialhidden').val();
        var rrno = $('#txtwarerrno').val();
        var mwrfid2 = $('#mwrfidmaterial2').val();
        var wcb = $('#txtrcb').val(); 
        var checks = $('#exampleCheck1').prop('checked'); //true or false
        var con = checks ? 1 : 0; // convert boolean to string
          var answer = confirm('Are you sure you want to update all materials?\nClick "Ok" to Save and "Cancel" to Continue.');
          if (answer)
          {
            if (checks == 1){
            xajax_updateisdelete(matid,1);
            }
            xajax_updatestatusall(mwrfid2,rrno,status);
            xajax_updatewcb(mwrfid2,wcb);
            xajax_archiveinsert("Warehouse","MWRF ID "+mwrfid2+" has been updated its materials status",currdate + " "+currtime);

            $("#btnloadmat").trigger('click');
            $("#btnloadmat").trigger('click');
            $("#btnloadmat").trigger('click');
          }
          else {
            //alert(checks);
            

          }          
        });
      $('#btnloadmat').click(function(){
        document.getElementById('framemat').contentWindow.location.reload();
        
      });
      $('#credentialmaterialmodal').on('hidden.bs.modal', function() {
        location.reload();
      });

    </script>
  </body>

  </html>
