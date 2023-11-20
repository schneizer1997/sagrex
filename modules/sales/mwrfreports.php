<?php
session_start();
include('../../classes/inc/dbCon.php');
require('sales.common.php');
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

  <title>SAGREX Reports</title>

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
    <form action="loadmaterials.php" method="GET" class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
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
            <i class="fas fa-fw fa-tachometer-alt" style="padding-right: 5px;"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="../sales/sales.php">
            <i class="fa fa-gear" style="padding-right: 5px;"></i>
            <span>Engineering</span>
          </a>

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
    Report Table</div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th style = "min-width:300px;">MWRFID</th>
              <th style = "min-width:70px;">Property Description</th>
              <th style = "min-width:70px;">Requested By</th>
              <th style = "min-width:70px;">Date File</th>
              <th style = "min-width:70px;">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            include('mwrfreports_pdf.php');
            ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
  </div>

  

  <!-- Edit Request Material -->
  <div class="modal fade bd-example-modal-lg" id="reportsmodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" style="background-color: grey;width: 1200px;min-height:500px;margin-left: -180px;">
        <div class="modal-header" style="background-color: #17A2B8;color:white;">
          <h5 class="modal-title" id="formModalLabel">MWRF Report</h5>
              <button style="border:0px;color:white;" type="button" class="btn btn-secondary" data-dismiss="modal" id="btnFormClose"><i class="fa fa-close"></i></button>
        </div>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <div style="float: right;border: 1px;">

            <div style="height:0px;min-width:500px;margin-right:2px;">
              <table class="table table-bordered" id="mtable1" cellspacing="0">
                
                <tbody id="mtable2">
                  <iframe style="border: 0px;height: 500px;" name="framemat" id="framemat" src="../../fpdf/mwrfpdf.php" /></iframe>
                </tbody>
              </table>
            </div>

          </div>
        </table>

      </div>
    </div>
  </div>
  <!-- End -->

  <!-- Edit Request Material -->
  <div class="modal fade bd-example-modal-lg" id="editrequestmaterialmodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content" style="width: 500px;height: 350px;">
        <div class="modal-header">
          <h5 class="modal-title" id="formModalLabel">Add Request Material</h5>
        </div>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <div>Material Request</div>
          <div>
            <form action="loadmaterials.php" method="GET" enctype="multipart/form-data">
              <div style="border: 1px;min-height: 100px;min-width:300px;line-height: 50px;margin: 10px;">
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label" id="" style="height: 30px;">MWRF ID:</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="mwrfidmaterial" placeholder="" style="height: 30px;">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Materials</label>
                  <div class="col-sm-10">
                    <textarea type="text" class="form-control" id="txtmaterials" placeholder="" style="height: 30px;"></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Quantity</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="txtqty" placeholder="" style="height: 30px;">
                  </div>
                </div>
                
              </div>

            </form>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnFormClose">Close</button>
              <button type="button" class="btn btn-info" id="btnAddMaterial">Add</button>
            </div>
          </div>
        </table>

      </div>
    </div>
  </div>
  <!-- End -->

  <!-- Edit Request Info -->
  <div class="modal fade bd-example-modal-lg" id="editrequestmodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" style="width: 1200px;margin-left: -180px;height: 1200px;">
        <div class="modal-header">
          <h5 class="modal-title" id="formModalLabel">Edit Request Details</h5>
        </div>
        <form action="loadmaterials.php" method="GET" enctype="multipart/form-data">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <table class="table table-bordered">
              <tr>
                <td colspan="2">Request Details</td>
                <td>Date Time Filed</td>
                <td>Maintenance:(Signature and Received Rate)</td>
              </tr>
              <div class="wew" id = "dsd">
                <td rowspan="2" width="20%">
                  <div>
                    <label style="height: 30px;margin-left: 10px;">MWRF No.</label>
                  </div>
                  <br>
                  <div>
                    <label style="height: 30px;margin-left: 10px;">Request Type</label>

                  </div><br>
                  <div>
                    <label style="height: 30px;margin-left: 10px;">Plate No.</label>

                  </div>
                  <br>
                  <div>
                    <label style="height: 30px;margin-left: 10px;">Work Type</label>

                  </div>
                  <br>
                  <div >
                    <label style="height: 30px;margin-left: 10px;">Work Venue</label>

                  </div>
                  <br>
                  <div>
                    <label style="height: 30px;margin-left: 10px;">Job Classification</label>

                  </div>
                  <br>
                  <div>
                    <label style="height: 30px;margin-left: 10px;">Repair Type</label>

                  </div>
                  <br>
                  <div>
                    <label style="height:30px;margin-left: 10px;">PM Type</label>
                  </div>
                  <br>
                  <div style="width: 200px;">
                    <label style="height: 30px;margin-left: 10px;">Improvement Type</label>      
                  </div>
                  <br>
                  <div style="width: 200px;">
                    <label style="height: 30px;margin-left: 10px;">Breakdown Type</label>      
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
                <td rowspan="2">

                  <div>
                    <input type="text" name="txtMWRF" class="form-control" id="txtMWRF"   placeholder="MWRF#" style="height: 35px;width: 300px;">
                    <input type="hidden" name="txtMWRF" class="form-control" id="txtMWRFID"   placeholder="MWRF#" style="height: 35px;width: 300px;">
                  </div>
                  <br>
                  <div>
                    <select id="cborequesttype" class="form-control" style="width: 300px;height: 35px;">
                      <option disabled selected>Request Type..</option>
                      <option>Vehicle</option>
                      <option>Machine</option>
                    </select>
                  </div><br>
                  <div>
                    <input type="text" name="txtplate" class="form-control" id="txtplatenos" placeholder="Plate No." style="height: 35px;width: 300px;">
                  </div><br>

                  <div>
                    <input type="text" class="form-control" id="txtworktype" placeholder="Work Type" style="height: 35px;width: 300px;">
                  </div><br>
                  <div>
                    <input type="text" class="form-control" id="txtworkvenue" placeholder="Work Venue" style="height: 35px;width: 300px;">
                  </div><br>
                  <div>
                    <input type="text" class="form-control" id="txtjobclass" placeholder="Job Classification" style="height: 35px;width: 300px;">
                  </div><br>
                  <div>
                    <input type="text" class="form-control" id="txtrepairtype" placeholder="Repair Type" style="height: 35px;width: 300px;">
                  </div><br>
                  <div>
                    <input type="text" class="form-control" id="txtpmtype" placeholder="PM Type" style="height:35px;width: 300px;">
                  </div><br>
                  <div>
                    <input type="text" class="form-control" id="txtimprovement" placeholder="Improvement Type" style="height: 35px;width: 300px;">
                  </div><br>
                  <div>
                    <input type="text" class="form-control" id="txtbreakdown" placeholder="Breakdown Type" style="height: 35px;width: 300px;">
                  </div><br>
                  <div>
                    <input type="date" class="form-control" id="dtpcompletion" name="" style="height: 35px;width: 300px;">
                    <br>
                  </div>
                  <br>
                </td>

                <td>
                  Date/Time:<br>
                  <p id="txtcurrdate"></p>
                  <p id = "txtcurrtime"></p>
                </td>
                <td><br><label for="usr"> <!-- Maintenance -->
                </label>
                <input type="text" class="form-control" placeholder="Designated to: (1)" id="txtdesignated1" style="width :300px;height: 30px"><br/>
                <input type="text" class="form-control" placeholder="Designated to: (2)" id="txtdesignated2" style="width :300px;height: 30px"><br/>
                <input type="text" class="form-control" placeholder="Designated to: (3)" id="txtdesignated3" style="width :300px;height: 30px"><br/></td>

                <tr>
                  <td colspan="2">Action:Causes<br><br>
                    <div class="form-group row">
                      <label for="inputPassword" class="col-sm-2 col-form-label" style="height: 30px;">Description</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtDescription" placeholder="" style="height: 30px;">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputPassword" class="col-sm-2 col-form-label" id="" style="height: 30px;">Causes</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtCauses" placeholder="" style="height: 30px;">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputPassword" class="col-sm-2 col-form-label" style="height: 30px;">Corrective</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtCorrective" placeholder="" style="height: 30px;">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputPassword" class="col-sm-2 col-form-label" style="height: 30px;">Preventive</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtPreventive" placeholder="" style="height: 30px;">
                      </div>
                    </div>
                    Remarks:<br>
                    <textarea class="form-control" id="txtremarks" rows="3"></textarea>
                    <br>
                    <div class="form-row">
                      <div class="col">
                        <label style="height: 30px;">Request By</label>
                        <input type="text" class="form-control" id="txtrequestby" placeholder="Request by" style="height: 30px;">
                      </div>
                      <div class="col">
                        <label style="height: 30px;">Department Head/Manager</label>
                        <input type="text" class="form-control" id="txtdepthead" placeholder="Department Head/Manager" style="height: 30px;">
                      </div>
                    </div>
                    <br/></td></td></tr><br/></td></td></tr>

                  </tr>  
                </table>
                <!-- 2nd panel -->
                <div style="min-width:300px;height: 150px;border: 1px solid white;">
                  <table class="table table-bordered">
                    <tr>
                      <td rowspan="" ="2">START</td>
                      <td>FINISH</td>
                      <td>APPROVAL STATUS</td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-row">
                          <div class="col">
                            <label style="height: 30px;">Time</label>
                            <input id="stime" type="time" class="form-control" placeholder="Request by" style="height: 30px;">
                          </div>
                          <div class="col">
                            <label style="height: 30px;">Date</label>
                            <input id="sdate" type="date" class="form-control" placeholder="Department Head/Manager" style="height: 30px;">
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="form-row">
                          <div class="col">
                            <label style="height: 30px;">Time</label>
                            <input id="ftime" type="time" class="form-control" placeholder="Request by" style="height: 30px;">
                          </div>
                          <div class="col">
                            <label style="height: 30px;">Date</label>
                            <input id="fdate" type="date" class="form-control" placeholder="Department Head/Manager" style="height: 30px;">
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="form-row">
                          <div class="col">
                            <label style="height: 30px;">Received by</label>
                            <input id="txtrecby" type="text" class="form-control" placeholder="Received by" style="height: 30px;">
                          </div>
                          <div class="col">
                            <label style="height: 30px;">Approved by</label>
                            <input id="txtappby" type="text" class="form-control" placeholder="Approved by" style="height: 30px;">
                          </div>
                        </div>
                      </td>
                    </tr>
                  </table>
                </div>
              </table>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnFormClose">Close</button>
                <button type="button" class="btn btn-info" id="btnFormUpdate">Update</button>
              </div>
            </form>
          </div>
        </div>

        <form action="loadmaterials.php" method="GET">
          <input type="hidden" name="txthidden" id="txthidden">

        </form>

      </div>
      <!-- End -->

      <!-- Modal for creating -->
      <div class="modal fade bd-example-modal-lg" id="createrequestmodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content" style="width: 1200px;margin-left: -180px;height: 1200px;">
            <div class="modal-header">
              <h5 class="modal-title" id="formModalLabel">Create New Request</h5>
            </div>
            <form action="editrequest.php" method="GET" enctype="multipart/form-data">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <table class="table table-bordered">
                  <tr>
                    <td colspan="2">Request Details</td>
                    <td>Date Time Filed</td>
                    <td>Maintenance:(Signature and Received Rate)</td>
                  </tr>
                  <div class="wew" id = "dsd">
                    <td rowspan="2" width="20%">
                      <div>
                        <label style="height: 30px;margin-left: 10px;">MWRF No.</label>
                      </div>
                      <br>
                      <div>
                        <label style="height: 30px;margin-left: 10px;">Request Type</label>

                      </div><br>
                      <div>
                        <label style="height: 30px;margin-left: 10px;">Plate No.</label>

                      </div>
                      <br>
                      <div>
                        <label style="height: 30px;margin-left: 10px;">Work Type</label>

                      </div>
                      <br>
                      <div >
                        <label style="height: 30px;margin-left: 10px;">Work Venue</label>

                      </div>
                      <br>
                      <div>
                        <label style="height: 30px;margin-left: 10px;">Job Classification</label>

                      </div>
                      <br>
                      <div>
                        <label style="height: 30px;margin-left: 10px;">Repair Type</label>

                      </div>
                      <br>
                      <div>
                        <label style="height:30px;margin-left: 10px;">PM Type</label>
                      </div>
                      <br>
                      <div style="width: 200px;">
                        <label style="height: 30px;margin-left: 10px;">Improvement Type</label>      
                      </div>
                      <br>
                      <div style="width: 200px;">
                        <label style="height: 30px;margin-left: 10px;">Breakdown Type</label>      
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
                    <td rowspan="2">

                      <div>
                        <input type="text" name="txtMWRF" class="form-control" id="txtMWRF"   placeholder="MWRF#" style="height: 35px;width: 300px;">
                      </div>
                      <br>
                      <div>
                        <select id="cborequesttype" class="form-control" style="width: 300px;height: 35px;">
                          <option disabled selected>Request Type..</option>
                          <option>Vehicle</option>
                          <option>Machine</option>
                        </select>
                      </div><br>
                      <div>
                        <input type="text" name="txtplate" class="form-control" id="txtplatenos" placeholder="Plate No." style="height: 35px;width: 300px;">
                      </div><br>

                      <div>
                        <input type="text" class="form-control" id="txtworktype" placeholder="Work Type" style="height: 35px;width: 300px;">
                      </div><br>
                      <div>
                        <input type="text" class="form-control" id="txtworkvenue" placeholder="Work Venue" style="height: 35px;width: 300px;">
                      </div><br>
                      <div>
                        <input type="text" class="form-control" id="txtjobclass" placeholder="Job Classification" style="height: 35px;width: 300px;">
                      </div><br>
                      <div>
                        <input type="text" class="form-control" id="txtrepairtype" placeholder="Repair Type" style="height: 35px;width: 300px;">
                      </div><br>
                      <div>
                        <input type="text" class="form-control" id="txtpmtype" placeholder="PM Type" style="height:35px;width: 300px;">
                      </div><br>
                      <div>
                        <input type="text" class="form-control" id="txtimprovement" placeholder="Improvement Type" style="height: 35px;width: 300px;">
                      </div><br>
                      <div>
                        <input type="text" class="form-control" id="txtbreakdown" placeholder="Breakdown Type" style="height: 35px;width: 300px;">
                      </div><br>
                      <div>
                        <input type="date" class="form-control" id="dtpcompletion" name="" style="height: 35px;width: 300px;">
                        <br>
                      </div>
                      <br>
                    </td>

                    <td>
                      Date/Time:<br>
                      <p id="txtcurrdate"></p>
                      <p id = "txtcurrtime"></p>
                    </td>
                    <td><br><label for="usr"> <!-- Maintenance -->
                    </label>
                    <input type="text" class="form-control" placeholder="Designated to: (1)" id="txtdesignated1" style="width :300px;height: 30px"><br/>
                    <input type="text" class="form-control" placeholder="Designated to: (2)" id="txtdesignated2" style="width :300px;height: 30px"><br/>
                    <input type="text" class="form-control" placeholder="Designated to: (3)" id="txtdesignated3" style="width :300px;height: 30px"><br/></td>

                    <tr>
                      <td colspan="2">Action:Causes<br><br>
                        <div class="form-group row">
                          <label for="inputPassword" class="col-sm-2 col-form-label" style="height: 30px;">Description</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="txtDescription" placeholder="" style="height: 30px;">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputPassword" class="col-sm-2 col-form-label" id="" style="height: 30px;">Causes</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="txtCauses" placeholder="" style="height: 30px;">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputPassword" class="col-sm-2 col-form-label" style="height: 30px;">Corrective</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="txtCorrective" placeholder="" style="height: 30px;">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputPassword" class="col-sm-2 col-form-label" style="height: 30px;">Preventive</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="txtPreventive" placeholder="" style="height: 30px;">
                          </div>
                        </div>
                        Remarks:<br>
                        <textarea class="form-control" id="txtremarks" rows="3"></textarea>
                        <br>
                        <div class="form-row">
                          <div class="col">
                            <label style="height: 30px;">Request By</label>
                            <input type="text" class="form-control" id="txtrequestby" placeholder="Request by" style="height: 30px;">
                          </div>
                          <div class="col">
                            <label style="height: 30px;">Department Head/Manager</label>
                            <input type="text" class="form-control" id="txtdepthead" placeholder="Department Head/Manager" style="height: 30px;">
                          </div>
                        </div>
                        <br/></td></td></tr><br/></td></td></tr>

                      </tr>  
                    </table>
                    <!-- 2nd panel -->
                    <div style="min-width:300px;height: 150px;border: 1px solid white;">
                      <table class="table table-bordered">
                        <tr>
                          <td rowspan="" ="2">START</td>
                          <td>FINISH</td>
                          <td>APPROVAL STATUS</td>
                        </tr>
                        <tr>
                          <td>
                            <div class="form-row">
                              <div class="col">
                                <label style="height: 30px;">Time</label>
                                <input id="stime" type="time" class="form-control" placeholder="Request by" style="height: 30px;">
                              </div>
                              <div class="col">
                                <label style="height: 30px;">Date</label>
                                <input id="sdate" type="date" class="form-control" placeholder="Department Head/Manager" style="height: 30px;">
                              </div>
                            </div>
                          </td>
                          <td>
                            <div class="form-row">
                              <div class="col">
                                <label style="height: 30px;">Time</label>
                                <input id="ftime" type="time" class="form-control" placeholder="Request by" style="height: 30px;">
                              </div>
                              <div class="col">
                                <label style="height: 30px;">Date</label>
                                <input id="fdate" type="date" class="form-control" placeholder="Department Head/Manager" style="height: 30px;">
                              </div>
                            </div>
                          </td>
                          <td>
                            <div class="form-row">
                              <div class="col">
                                <label style="height: 30px;">Received by</label>
                                <input id="txtrecby" type="text" class="form-control" placeholder="Received by" style="height: 30px;">
                              </div>
                              <div class="col">
                                <label style="height: 30px;">Approved by</label>
                                <input id="txtappby" type="text" class="form-control" placeholder="Approved by" style="height: 30px;">
                              </div>
                            </div>
                          </td>
                        </tr>
                      </table>
                    </div>
                  </table>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnFormClose">Close</button>
                    <button type="button" class="btn btn-info" id="btnnewreq">Create</button>
                  </div>
                </form>
              </div>
            </div>

            <form action="loadmaterials.php" method="GET">
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


      function selectmaterials(materialsid,materials,qty,unit,dategrant,shop,tt){
        //alert("wew");
        $('#txtmaterialsid').val(materialsid);
        $('#txtmaterialsupdate').val(materials);
        $('#txtqtyupdate').val(qty);
        $('#txtunitprice').val(unit);
        $('#txtnewdategrant').val(dategrant);
        $("select#cboshop option").each(function() { this.selected = (this.text == shop); });
        $("select#cbott option").each(function() { this.selected = (this.text == tt); });

      }
      function deletematerials(materialsid){
        xajax_deletematerial(materialsid);
      }
      function loadreportpdf(mwrfid,MWRFNo,rt,pn,wt,wv,jc,rept,pt,it,bt,ctd,tf,df,pd,pc,ca,pa,remarks,rb,dhm,d1,d2,d3,st,sd,ft,fd,rrb,rab,tor,tmh,wcb,rrno,ms,requestor,cmvb,da,de){

        document.getElementById("framemat").src = '../../fpdf/mwrfpdf.php?mwrfid1=' + mwrfid+"&"+"mwrfno="+MWRFNo+"&"+"rt="+rt+"&"+"pn="+pn+"&"+"wt="+wt+"&"+"wv="+wv+"&"+"jc="+jc+"&"+"rept="+rept+"&"+"pt="+pt+"&"+"it="+it+"&"+"bt="+bt+"&"+"ctd="+ctd+"&"+"tf="+tf+"&"+"df="+df+"&"+"pd="+pd+"&"+"pc="+pc+"&"+"ca="+ca+"&"+"pa="+pa+"&"+"remarks="+remarks+"&"+"rb="+rb+"&"+"dhm="+dhm+"&"+"d1="+d1+"&"+"d2="+d2+"&"+"d3="+d3+"&"+"st="+st+"&"+"sd="+sd+"&"+"ft="+ft+"&"+"fd="+fd+"&"+"rrb="+rrb+"&"+"rab="+rab+"&"+"tor="+tor+"&"+"tmh="+tmh+"&"+"wcb="+wcb+"&"+"rrno="+rrno+"&"+"ms="+ms+"&"+"requestor="+requestor+"&"+"cmvb="+cmvb+"&"+"da="+da+"&"+"de="+de;
        $('#reportsmodal').modal('show');
      }
      function credentialmaterialsmodal(mwrfid){
        $('#mwrfidmaterial2').val(mwrfid);
        var appendurl = $('#mwrfidmaterial2').val();
        $('#txtmaterialsupdate').val("");
        $('#txtqtyupdate').val("");

        history.replaceState("","","?mwrfid1=" + appendurl);

        var myFrame = $('#framemat');
        var url = $(myFrame).attr('src')+"?mwrfid1="+appendurl;

        var loc = url;
        var params = loc.split('?')[1];
        document.getElementById("framemat").src = 'pur_loadmaterials.php?mwrfid1=' + appendurl;
        $('#credentialmaterialmodal').modal('show');
      }
      function addrequestmaterialmodal(mwrfid,PlateNo,MWRFNo,RequestType,rrno){
        $('#mwrfidmaterial').val(mwrfid);
        $('#txtmatmwrfno').val(MWRFNo);
        $('#txtmatpn').val(PlateNo);
        $('#txtmatrt').val(RequestType);
        $('#txtrrno').val(rrno);
        
        $('#addrequestmaterialmodal').modal('show');
      }


      function editrequestmodal(mwrfid,MWRFNo,rt,pn,wt,wv,jc,rept,pt,it,bt,ctd,tf,df,pd,pc,ca,pa,remarks,rb,dhm,d1,d2,d3,st,sd,ft,fd,rrb,rab){

          $('#txthidden').val(mwrfid);
          $('#txtMWRF').val(MWRFNo);
          $("select#cborequesttype option").each(function() { this.selected = (this.text == rt); });
          $('#txtplatenos').val(pn);
          $('#txtworktype').val(wt);
          $('#txtworkvenue').val(wv);
          $('#txtjobclass').val(jc);
          $('#txtrepairtype').val(rept);
          $('#txtpmtype').val(pt);
          $('#txtimprovement').val(it);
          $('#txtbreakdown').val(bt);
          $('#dtpcompletion').val(ctd);
          document.getElementById('txtcurrtime').innerHTML = tf;
          //$('#txtcurrdate').val(new Date().toDateInputValue());
          document.getElementById('txtcurrdate').innerHTML = df;
          $('#txtDescription').val(pd);
          $('#txtCauses').val(pc);
          $('#txtCorrective').val(ca);
          $('#txtPreventive').val(pa);
          $('#txtremarks').val(remarks);
          $('#txtrequestby').val(rb);
          $('#txtdepthead').val(dhm);
          $('#txtdesignated1').val(d1);
          $('#txtdesignated2').val(d2);
          $('#txtdesignated3').val(d3);
          $('#stime').val(st);
          $('#sdate').val(sd);
          $('#ftime').val(ft);
          $('#fdate').val(fd);
          $('#txtrecby').val(rrb);
          $('#txtappby').val(rab);



          $('#editrequestmodal').modal('show');
          

          
        }
        $(document).ready(function(){
          $('#btnCreatenew').click(function(){
            $('#createrequestmodal').modal('show');

          });

        });
        $('#btncredentialupdate').click(function(){
          var matid = $('#txtmaterialsid').val();
          var materials = $('#txtmaterialsupdate').val();
          var qty = $('#txtqtyupdate').val();
          var unit = $('#txtunitprice').val();
          var dategrant = $('#txtnewdategrant').val();
          var shop =  $('#cboshop').val();
          var rt = $('#cbott').val();
          //var amount = $().val();

          if (matid == ""){
            alert("Select a Material below first.");
          }
          else {

            xajax_updatecredentials(matid,materials,qty,unit,dategrant,shop,rt);
          }
        });
        $('#btnloadmat').click(function(){
        document.getElementById('framemat').contentWindow.location.reload();
        
      });
        // Insert new Request Form
        $('#btnnewreq').click(function(){
          var mwrf = $('#txtMWRF').val();
          var rt = $('#cborequesttype option:selected').val();
          var plate = $('#txtplatenos').val();
          var worktype = $('#txtworktype').val();
          var workvenue = $('#txtworkvenue').val();
          var job = $('#txtjobclass').val();
          var repair = $('#txtrepairtype').val();
          var pmtype = $('#txtpmtype').val();
          var imp = $('#txtimprovement').val();
          var breakd = $('#txtbreakdown').val();
          var compl = $('#dtpcompletion').val();
          var timef = $('#txtcurrtime').val();
          var datef = $('#txtcurrdate').val();
          var desc = $('#txtDescription').val();
          var cause = $('#txtCauses').val();
          var ca = $('#txtCorrective').val();
          var pa = $('#txtPreventive').val();
          var remarks = $('#txtremarks').val();
          var reqby = $('#txtrequestby').val();
          var dhm = $('#txtdepthead').val();
          var d1 = $('#txtdesignated1').val();
          var d2 = $('#txtdesignated2').val();
          var d3 = $('#txtdesignated3').val();
          var stime = $('#stime').val();
          var sdate = $('#sdate').val();
          var fdate = $('#fdate').val();
          var ftime = $('#ftime').val();
          var rrb = $('#txtrecby').val();
          var rab = $('#txtappby').val();

          xajax_createnewrequest(mwrf,rt,plate,worktype,workvenue,job,repair,pmtype,imp,breakd,compl,
            "1902-09-30",sdate,desc,cause,ca,pa,remarks,reqby,dhm,d1,d2,d3,stime,sdate,
            ftime,fdate,rrb,rab,"asd","","","","",currdate,sdate,"PENDING","");
        });
        // Insert new Material
        $('#btnAddMaterial').click(function(){
          var mwrfidmaterial = $('#mwrfidmaterial').val();
          var materialdesc = $('#txtmaterials').val();
          var matqty = $('#txtqty').val();
          var dategrant = $('#txtcurrdate').val();
          var matmwrfno = $('#txtmatmwrfno').val();
          var matpn = $('#txtmatpn').val();
          var matrt = $('#txtmatrt').val();
          var matrrno = $('#txtrrno').val();
          
          xajax_addrequestmaterial(mwrfidmaterial,materialdesc,matqty,0,"",dategrant,0,0,"",matpn,matmwrfno,matrt,matrrno,0,1);
            //var mwrfidmaterial = $('#mwrfidmaterial').val();
            $('#txtmaterials').val("");
            $('#txtqty').val("");
            //$('#txtcurrdate').val();
          });
        $('#btnAdd').click(function(){ 
        //e.preventDefault();      
        var mwrf = $('#txtMWRF').val();
        var mat = $('#txtmaterials').val();
        var qty = $('#txtqty').val();
        var dates  = "1992-10-22";
        var sdate = $('#sdate').val();
           //xajax_wew(mwrf,1992-10-22);
           alert("asd");
           //alert(mwrf);
           xajax_addrequestmaterial(mwrf,mat,qty,0,"",sdate,1,1,"dsd",1321,2,"","",1,
            1);
        //xajax_loadmaterials(mwrf);

         //$('#mtable').load('getMaterials.php', {mwrf:mwrf});
         //$('#mtable').load('getMaterials.php');
        //$('#mtable').show('getMaterials.php');
      });
        $('#btnFormUpdate').click(function(){
          var mwrfid = $('#txthidden').val();
          var mwrf = $('#txtMWRF').val();
          var rt = $('#cborequesttype option:selected').val();
          var plate = $('#txtplatenos').val();
          var worktype = $('#txtworktype').val();
          var workvenue = $('#txtworkvenue').val();
          var job = $('#txtjobclass').val();
          var repair = $('#txtrepairtype').val();
          var pmtype = $('#txtpmtype').val();
          var imp = $('#txtimprovement').val();
          var breakd = $('#txtbreakdown').val();
          var compl = $('#dtpcompletion').val();
          var timef = $('#txtcurrtime').val();
          var datef = $('#txtcurrdate').val();
          var desc = $('#txtDescription').val();
          var cause = $('#txtCauses').val();
          var ca = $('#txtCorrective').val();
          var pa = $('#txtPreventive').val();
          var remarks = $('#txtremarks').val();
          var reqby = $('#txtrequestby').val();
          var dhm = $('#txtdepthead').val();
          var d1 = $('#txtdesignated1').val();
          var d2 = $('#txtdesignated2').val();
          var d3 = $('#txtdesignated3').val();
          var stime = $('#stime').val();
          var sdate = $('#sdate').val();
          var fdate = $('#fdate').val();
          var ftime = $('#ftime').val();
          var rrb = $('#txtrecby').val();
          var rab = $('#txtappby').val();
          $('#dataTables').DataTable().ajax.reload();

          xajax_updateformrequest(mwrfid,mwrf,rt,plate,worktype,workvenue,job,repair,pmtype,imp,breakd,compl,
            "1902-09-30",sdate,desc,cause,ca,pa,remarks,reqby,dhm,d1,d2,d3,stime,sdate,
            ftime,fdate,rrb,rab,"","","","","",currdate,sdate,"PENDING","");
        });
      </script>
    </body>

    </html>
