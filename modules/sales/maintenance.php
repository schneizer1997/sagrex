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

  <title>SAGREX Maintenance</title>

  <!-- Bootstrap core CSS-->
  <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template-->
  <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="../../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
          <i class="fas fa-fw fa-tachometer-alt"></i>
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
                <button id="btnCreatenew" class="btn btn-primary">
                  <i style="padding-right: 5px;" class="fas fa-folder"></i>Create New</button><br><br>

                  <!-- DataTables Example -->
                  <div class="card mb-3">
                    <div class="card-header" style="background-color: #3399CC;color: white;">
                      <i class="fas fa-table"></i>
                    Pending Request Table</div>
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                          <thead>
                            <tr>
                              <th>MWRFID</th>
                              <th>Property Description</th>
                              <th>Requested By</th>
                              <th>Date File</th>
                              <th><center>Action</center></th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            include('loadrequestform.php');
                            ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
                  </div>

                  <!-- Add Material Request -->
                  <div class="modal fade bd-example-modal-lg" id="addrequestmaterialmodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content" style="width: 500px;min-height: 350px;">
                        <div class="modal-header" style="background-color: #17A2B8;color:white;">
                          <h5 class="modal-title" id="formModalLabel">Add Request Material</h5>
                        </div>
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                          <div class="form-group" style="margin-left: 10px;">Material Request</div>
                          <div>
                            <form action="loadmaterials.php" method="GET" enctype="multipart/form-data">
                              <div style="border: 1px;min-height: 100px;min-width:300px;line-height: 50px;margin: 10px;">
                                <div class="form-group row">
                                  <label class="col-sm-2 col-form-label" id="" style="height: 30px;">MWRF ID:</label>
                                  <div class="col-sm-10">
                                    <input type="text" class="form-control" id="mwrfidmaterial" placeholder="" style="height: 30px;" disabled>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Materials:</label>
                                  <div class="col-sm-10">
                                    <textarea type="text" class="form-control" id="txtmaterials" placeholder="" style="height: 30px;"></textarea>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Quantity:</label>
                                  <div class="col-sm-10">
                                    <input type="number" class="form-control" id="txtqty" placeholder="" style="height: 30px;">
                                    <input type="hidden" class="form-control" id="txtmatpn" placeholder="" style="height: 30px;">
                                    <input type="hidden" class="form-control" id="txtmatmwrfno" placeholder="" style="height: 30px;">
                                    <input type="hidden" class="form-control" id="txtrrno" placeholder="" style="height: 30px;">
                                    <input type="hidden" class="form-control" id="txtmatrt" placeholder="" style="height: 30px;">
                                  </div>
                                </div>

                              </div>

                            </form>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-info" id="btnAddMaterial"><i style="padding-right: 5px;" class="fas fa-save"></i>Save</button>
                              <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnFormClose"><i style="padding-right: 5px;" class="fa fa-close"></i>Close</button>

                            </div>

                          </div>


                        </table>

                      </div>


                    </div>
                  </div>
                  <!-- End -->
                  <!-- Edit Request Material -->
                  <div class="modal fade bd-example-modal-lg" id="verificationmodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content" style="width: 1200px;min-height: 500px;margin-left: -180px;">
                        <div class="modal-header" style="background-color: #17A2B8;color:white;">
                          <h5 class="modal-title" id="formModalLabel">MWRF Verfication</h5>
                          <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnFormClose" style="border:0px;color: white;"><i class="fa fa-close"></i></button>
                        </div>
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                          <div style="margin-left: 10px;"></div>

                          <div>
                            <form action="loadmaterials.php" method="GET" enctype="multipart/form-data">
                              <div style="border: 1px;min-height: 100px;min-width:300px;line-height: 50px;margin: 10px;">
                                <div class="form-group row">
                                  <label class="col-sm-2 col-form-label" id="" style="height: 30px;">MWRF ID:</label>
                                  <div class="col-sm-10">
                                    <input type="text" class="form-control" name="mwrfidmaterial3" id="mwrfidmaterial3" placeholder="" style="width: 300px;"  disabled>
                                    <input type="hidden" class="form-control" id="mwrfidmaterialhidden3" placeholder="" style="height: 30px;">
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Warehouse Status</label>
                                  <div class="col-sm-10">
                                    <select id="cbomwrfstat" class="form-control" style="width: 300px;height: 35px;" disabled>
                                      <option disabled selected>Choose..</option>
                                      <option>COMPLETED</option>
                                      <option>PENDING</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group row">

                                  <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Verified:</label>
                                  <div class="form-check form-check-inline" style="margin-left: 20px;">

                                    <input class="form-check-input" type="checkbox" id="exampleCheck1" name="exampleCheck1">
                                    <label class="form-check-label" id="lblStatus" for="exampleCheck1">COMPLETED</label>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                  </div>
                                  <div class="form-check form-check-inline" style="margin-left: 30px;">
                                    <input class="form-check-input" type="checkbox" id="exampleCheck2" name="exampleCheck2">
                                    <label class="form-check-label" id="lblStatuspend" for="exampleCheck2">PENDING</label>
                                  </div>
                                </div>

                              </div>

                            </form>
                            <div class="modal-footer">     
                              <button type="submit" class="btn btn-info" id="btnmwrfstat"><i style="padding-right: 5px;" class="fas fa-save"></i>Update</button>
                              <button type="button" class="btn btn-info" name="btnloadmatver" id="btnloadmatver"><i style="padding-right: 5px;" class="fa fa-refresh"></i>Reload</button>
                            </div>
                            <thead class="table table-bordered" style="border-top: 2px solid #17A2B8;">
                              <tr>
                                <th style = "width:200px;">Materials</th>
                                <th style = "width:70px;">Quantity</th>
                                <th style = "width:100px;">Unit Price</th>
                                <th style = "width:100px;">Date Granted</th>
                                <th style = "width:100px;">Request Type</th>
                                <th style = "width:70px;">RRNo</th>
                                <th style = "width:70px;">Check By Warehouse</th>
                                <th style = "width:70px;">Verified</th>                    
                                <th style = "width:70px;">Action</th>
                              </tr>
                            </thead>
                            <div style="border: 1px;height:0px;min-width:500px;margin-right:2px;">
                              <table class="table table-bordered" id="mtable1" cellspacing="0">

                                <tbody id="mtable2">
                                  <iframe style="border: 0px;" name="framemat1" id="framemat1" src="loadmaterialsverfication.php" /></iframe>
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
                  <div class="modal fade bd-example-modal-lg" id="viewrequestmaterialmodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content" style="width: 800px;min-height: 500px;">
                        <div class="modal-header" style="background-color: #17A2B8;color:white;">
                          <h5 class="modal-title" id="formModalLabel">Request Materials</h5>
                          <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnFormClose" style="border:0px;color: white;"><i class="fa fa-close"></i></button>
                        </div>
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                          <div style="margin-left: 10px;">Material Information</div>

                          <div>
                            <form action="loadmaterials.php" method="GET" enctype="multipart/form-data">
                              <div style="border: 1px;min-height: 100px;min-width:300px;line-height: 50px;margin: 10px;">
                                <div class="form-group row">
                                  <label class="col-sm-2 col-form-label" id="" style="height: 30px;">MWRF ID:</label>
                                  <div class="col-sm-10">
                                    <input type="text" class="form-control" name="mwrfidmaterial2" id="mwrfidmaterial2" placeholder="" style="height: 30px;"  disabled>
                                    <input type="hidden" class="form-control" id="mwrfidmaterialhidden" placeholder="" style="height: 30px;">
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Materials</label>
                                  <div class="col-sm-10">
                                    <textarea type="text" class="form-control" id="txtmaterialsupdate" placeholder="" style="height: 30px;"></textarea>
                                    <input type="hidden" class="form-control" id="txtmaterialsid" placeholder="" style="height: 30px;">
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Quantity</label>
                                  <div class="col-sm-10">
                                    <input type="text" class="form-control" id="txtqtyupdate" placeholder="" style="height: 30px;">
                                  </div>
                                </div>

                              </div>

                            </form>
                            <div class="modal-footer">     
                              <button type="button" class="btn btn-info" id="btnmaterialupdate"><i style="padding-right: 5px;" class="fas fa-save"></i>Update</button>
                              <button type="button" class="btn btn-info" name="btnloadmat" id="btnloadmat"><i style="padding-right: 5px;" class="fa fa-refresh"></i>Reload</button>
                            </div>
                            <thead class="table table-bordered" style="border-top: 2px solid #17A2B8;">
                              <tr>
                                <th style = "width:450px">Materials</th>
                                <th style = "width:50px">Quantity</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <div style="border: 1px;height:0px;min-width:500px;margin-right:2px;">
                              <table class="table table-bordered" id="mtable1" cellspacing="0">

                                <tbody id="mtable2">
                                  <iframe style="border: 0px;" name="framemat" id="framemat" src="loadmaterials.php" /></iframe>
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
                        <div class="modal-header" style="background-color: #17A2B8;color:white;">
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

            <!-- <div style="border: 1px solid red;height: 300px;min-width: 665px;float: right;margin-right: 2px;">
              <table class="table table-bordered" id="mtable1" width="120%" cellspacing="0">
                <thead class="table table-bordered">
                  <tr>
                    <th>Materials</th>
                    <th>Quantity</th>
                  </tr>
                </thead>
                <tbody id="mtable">

                </tbody>
              </table>
            </div> -->

          </div>


        </table>

      </div>
    </div>
  </div>
  <!-- End -->

  <!-- Edit Request Info -->
  <div class="modal fade bd-example-modal-lg" id="editrequestmodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" style="width: 1200px;margin-left: -180px;min-height: 1100px;">
        <div class="modal-header" style="background-color: #17A2B8;color:white;">
          <h5 class="modal-title" id="formModalLabel"><strong>Edit Request Details</strong></h5>
        </div>
        <form action="loadmaterials.php" method="GET" enctype="multipart/form-data">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="margin-top: -30px;">
            <table class="table table-bordered">
              <tr>
                <td colspan="2" style="border:1px solid #17A2B8;"><strong>Request Details</strong></td>
                <td style="border:1px solid #17A2B8;"><strong>Date Time Filed</strong></td>
                <td style="border:1px solid #17A2B8;"><strong>Maintenance:(Signature and Received Rate)</strong></td>
              </tr>
              <div class="">
                <td rowspan="2" width="20%" style="border-bottom:1px solid #17A2B8;">
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
                <td rowspan="2" style="border:1px solid #17A2B8;">

                  <div>
                    <input type="text" name="txtMWRF" class="form-control" id="txtMWRF"   placeholder="MWRF#" style="height: 35px;width: 300px;">
                    <input type="hidden" name="txtMWRF" class="form-control" id="txtMWRFID"   placeholder="MWRF#" style="height: 35px;width: 300px;">
                  </div>
                  <br>
                  <div>
                    <select id="cborequesttype" class="form-control" style="width: 300px;height: 35px;">
                      <option disabled selected>Options..</option>
                      <option>Vehicle</option>
                      <option>Machine</option>
                      <option>Other Type</option>
                    </select>
                  </div><br>
                  <div>
                    <input type="text" name="txtplate" class="form-control" id="txtplatenos" placeholder="Plate/Machine No." style="height: 35px;width: 300px;">
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

                <td style="border:1px solid #17A2B8;">
                  Date/Time:<br>
                  <p id="txtcurrdate"></p>
                  <p id = "txtcurrtime"></p>
                </td>
                <td style="border:1px solid #17A2B8;"><br><label for="usr"> <!-- Maintenance -->
                </label>
                <input type="text" class="form-control" placeholder="Designated to: (1)" id="txtdesignated1" style="width :300px;height: 30px"><br/>
                <input type="text" class="form-control" placeholder="Designated to: (2)" id="txtdesignated2" style="width :300px;height: 30px"><br/>
                <input type="text" class="form-control" placeholder="Designated to: (3)" id="txtdesignated3" style="width :300px;height: 30px"><br/></td>

                <tr>
                  <td colspan="2" style="border:1px solid #17A2B8;"><strong>Action:Causes</strong><br><br>
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
                      <td rowspan="" ="2" style="border:1px solid #17A2B8;"><strong>START</strong></td>
                      <td style="border:1px solid #17A2B8;"><strong>FINISH</strong></td>
                      <td style="border:1px solid #17A2B8;"><strong>APPROVAL STATUS</strong></td>
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
                    <tr>
                      <td>
                        <div class="col">
                          <label style="height: 30px;"><strong>MWRF Status</strong></label>
                          <select class="form-control" id="cbostatus">
                            <option>PENDING</option>
                            <option>COMPLETED</option>
                            <option>CANCELLED</option>
                          </select>
                        </div> 
                      </td>
                      <td>
                        <div class="col">
                          <label style="height: 30px;"><strong>Completed MWRF Verified by:</strong></label>
                          <input type="" name="txtcmvb" id="txtcmvb" class="form-control">
                        </div>
                      </td>
                    </tr>
                  </table>
                </div>
              </table>
              <div class="modal-footer">
                <button type="button" class="btn btn-info" id="btnFormUpdate"><i style="padding-right: 5px;" class="fas fa-save"></i></i>Update</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnFormClose"><i style="padding-right: 5px;" class="fa fa-close"></i>Close</button>  
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
          <div class="modal-content" style="width: 1200px;margin-left: -180px;min-height: 1000px;">
            <div class="modal-header" style="background-color: #17A2B8;color:white;">
              <h5 class="modal-title" id="formModalLabel"><strong>Create New Request</strong></h5>
            </div>
            <form action="editrequest.php" method="GET" enctype="multipart/form-data">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="margin:-10px;">
                <table class="table table-bordered">
                  <tr>
                    <td colspan="2" style="border:1px solid #17A2B8;"><strong>Request Details</strong></td>
                    <td style="border:1px solid #17A2B8;"><strong>Date Time Filed</strong></td>
                    <td style="border:1px solid #17A2B8;"><strong>Maintenance:(Signature and Received Rate)</strong></td>
                  </tr>
                  <div class="">
                    <td rowspan="2" width="20%" style="border-bottom:1px solid #17A2B8;">
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
                      <div >
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
                        <input type="text" name="txtMWRF" class="form-control" id="txtMWRF1"   placeholder="MWRF#" style="height: 35px;width: 300px;">
                      </div>
                      <br>
                      <div>
                        <select id="cborequesttype1" class="form-control" style="width: 300px;height: 35px;">
                          <option disabled selected>Request Type..</option>
                          <option>Vehicle</option>
                          <option>Machine</option>
                          <option>Other Type</option>
                        </select>
                      </div><br>
                      <div>
                        <input type="text" name="txtplate" class="form-control" id="txtplatenos1" placeholder="Plate/Machine No." style="height: 35px;width: 300px;">
                      </div><br>

                      <div>
                        <!-- <input type="text" class="form-control" id="txtworktype1" placeholder="Work Type" style="height: 35px;width: 300px;"> -->
                        <select class="form-control" id="txtworktype1">
                          <option selected disabled>Work Type</option>
                          <option>Maintenance</option>
                          <option>Repair</option>
                          <option>Installation</option>
                        </select>
                      </div><br>

                      <div>
                        <!-- <input type="text" class="form-control" id="txtworkvenue1" placeholder="Work Venue" style="height: 35px;width: 300px;"> -->
                        <select class="form-control" id="txtworkvenue1">
                          <option selected disabled>Work Venue</option>
                          <option>inhouse</option>
                          <option>jobout</option>
                        </select>
                      </div><br>
                      <div>
                        <!-- <input type="text" class="form-control" id="txtjobclass1" placeholder="Job Classification" style="height: 35px;width: 300px;"> -->
                        <select class="form-control" id="txtjobclass1">
                          <option selected disabled>Job Classification</option>
                          <option>reactive</option>
                          <option>active</option>
                          <option>reactive/active</option>
                        </select>
                      </div><br>
                      <div>
                        <!-- <input type="text" class="form-control" id="txtrepairtype1" placeholder="Repair Type" style="height: 35px;width: 300px;margin-top: 10px;"> -->
                        <select class="form-control" id="txtrepairtype1">
                          <option selected disabled>Repair Type</option>
                          <option>rehabilitate</option>
                          <option>overhaul</option>
                          <option>check</option>
                        </select>
                      </div><br>
                      <div>
                        <!-- <input type="text" class="form-control" id="txtpmtype1" placeholder="PM Type" style="height:35px;width: 300px;margin-top: 10px;"> -->
                        <select class="form-control" id="txtpmtype1">
                          <option selected disabled>Pm Type</option>
                          <option>cleaning</option>
                          <option>adjustment</option>
                          <option>replacement of parts/items</option>
                          <option>fabrication</option>
                        </select>
                      </div><br>
                      <div>
                        <!-- <input type="text" class="form-control" id="txtimprovement1" placeholder="Improvement Type" style="height: 35px;width: 300px;margin-top: 8px;"> -->
                        <select class="form-control" id="txtimprovement1">
                          <option selected disabled>Improvement Type</option>
                          <option>Upgrade</option>
                        </select>
                      </div><br>
                      <div>
                        <!-- <input type="text" class="form-control" id="txtbreakdown1" placeholder="Breakdown Type" style="height: 35px;width: 300px;"> -->
                        <select class="form-control" id="txtbreakdown1">
                          <option selected disabled>Breakdown Type</option>
                          <option>Damage</option>
                        </select>
                      </div><br>
                      <div>
                        <input type="date" class="form-control" id="dtpcompletion1" name="" style="height: 35px;width: 300px;">
                        <br>
                      </div>
                      <br>
                    </td>

                    <td style="border:1px solid #17A2B8;">
                      Date/Time:<br>
                      <p id="txtcurrdate1"></p>
                      <p id = "txtcurrtime1"></p>
                    </td>
                    <td style="border:1px solid #17A2B8;"><br><label for="usr"> <!-- Maintenance -->
                    </label>
                    <input type="text" class="form-control" placeholder="Designated to: (1)" id="txtdesignated11" style="width :300px;height: 30px"><br/>
                    <input type="text" class="form-control" placeholder="Designated to: (2)" id="txtdesignated21" style="width :300px;height: 30px"><br/>
                    <input type="text" class="form-control" placeholder="Designated to: (3)" id="txtdesignated31" style="width :300px;height: 30px"><br/></td>

                    <tr>
                      <td colspan="2" style="border:1px solid #17A2B8;"><strong>Action:Causes</strong></strong><br><br>
                        <div class="form-group row">
                          <label for="inputPassword" class="col-sm-2 col-form-label" style="height: 30px;">Description</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="txtDescription1" placeholder="" style="height: 30px;">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputPassword" class="col-sm-2 col-form-label" id="" style="height: 30px;">Causes</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="txtCauses1" placeholder="" style="height: 30px;">
                          </div>
                        </div>
                        <!-- <div class="form-group row">
                          <label for="inputPassword" class="col-sm-2 col-form-label" style="height: 30px;">Corrective</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="txtCorrective1" placeholder="" style="height: 30px;">
                          </div>
                        </div> -->
                        <!-- <div class="form-group row">
                          <label for="inputPassword" class="col-sm-2 col-form-label" style="height: 30px;">Preventive</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="txtPreventive1" placeholder="" style="height: 30px;">
                          </div>
                        </div> -->
                        Remarks:<br>
                        <textarea class="form-control" id="txtremarks1" rows="3"></textarea>
                        <br>
                        <div class="form-row">
                          <div class="col">
                            <label style="height: 30px;">Request By</label>
                            <input type="text" class="form-control" id="txtrequestby1" placeholder="Request by" style="height: 30px;">
                          </div>
                          <div class="col">
                            <label style="height: 30px;">Department Head/Manager</label>
                            <input type="text" class="form-control" id="txtdepthead1" placeholder="Department Head/Manager" style="height: 30px;">
                          </div>
                        </div>
                        <br/></td></td></tr><br/></td></td></tr>

                      </tr>  
                    </table>
                    <!-- 2nd panel -->
                    <div style="min-width:300px;height: 150px;border-top: 1px solid white;">
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
                                <input id="stime1" type="time" class="form-control" placeholder="Request by" style="height: 30px;">
                              </div>
                              <div class="col">
                                <label style="height: 30px;">Date</label>
                                <input id="sdate1" type="date" class="form-control" placeholder="Department Head/Manager" style="height: 30px;">
                              </div>
                            </div>
                          </td>
                          <td>
                            <div class="form-row">
                              <div class="col">
                                <label style="height: 30px;">Time</label>
                                <input id="ftime1" type="time" class="form-control" placeholder="Request by" style="height: 30px;">
                              </div>
                              <div class="col">
                                <label style="height: 30px;">Date</label>
                                <input id="fdate1" type="date" class="form-control" placeholder="Department Head/Manager" style="height: 30px;">
                              </div>
                            </div>
                          </td>
                          <td>
                            <div class="form-row">
                              <div class="col">
                                <label style="height: 30px;">Received by</label>
                                <input id="txtrecby1" type="text" class="form-control" placeholder="Received by" style="height: 30px;">
                              </div>
                              <div class="col">
                                <label style="height: 30px;">Approved by</label>
                                <input id="txtappby1" type="text" class="form-control" placeholder="Approved by" style="height: 30px;">
                              </div>
                            </div>
                          </td>
                        </tr>
                      </table>
                    </div>
                  </table>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-info" id="btnnewreq"><i style="padding-right: 5px;" class="fas fa-save"></i>Create</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnFormClose"><i style="padding-right: 5px;" class="fa fa-close"></i>Close</button>
                    
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
<!--     <script src="../../vendor/bootstrap/js/jquery/popover.js"></script>
  <script src="../../vendor/bootstrap/js/bootstrap-confirmation.js"></script> -->
  <!-- <script src="../../js/demo/chart-area-demo.js"></script> -->
  <script type="text/javascript">

    var currdate;
    var currtime;
    currdate = new Date();
    currdate = currdate.getFullYear() + '-' +
    ('00' + (currdate.getMonth()+1)).slice(-2) + '-' +
    ('00' + currdate.getDate()).slice(-2);

    currtime = new Date();
    currtime = ('00' + currtime.getHours()).slice(-2) + ':' + 
    ('00' + currtime.getMinutes()).slice(-2) + ':' + 
    ('00' + currtime.getSeconds()).slice(-2);

    var test = new Date().toISOString().slice(0, 19).replace('T', ' ');
    document.getElementById("txtcurrdate1").innerHTML = currdate;
    document.getElementById("txtcurrtime1").innerHTML = currtime;

    $('#btnloadmat').click(function(){
      document.getElementById('framemat').contentWindow.location.reload();

    });
    $('#btnloadmatver').click(function(){
      document.getElementById('framemat1').contentWindow.location.reload();

    });
    /*setInterval(refreshIframe, 1);
    function refreshIframe() {
        $("#framemat")[0].src = $("#framemat")[0].src;
    }*/
/*    window.setInterval(function() {
            reloadIFrame()
        }, 1);

        function reloadIFrame() {
            //console.log('reloading..');
            document.getElementById('framemat').contentWindow.location.reload();
        }*/

/*    function setupRefresh() {
      setTimeout("refreshPage();", 1000); // milliseconds
    }

    function refreshPage() {
    $('#framemat').attr( 'src', function (i,val) { return val; });
    }*/

    function selectmaterials(materialsid,materials,qty){
        //alert("wew");
        $('#txtmaterialsid').val(materialsid);
        $('#txtmaterialsupdate').val(materials);
        $('#txtqtyupdate').val(qty);
      }
    function selecttoverify(materialsid,verified,cbl){
        var checks = $('#exampleCheck1').prop('checked');
        $('#txtmaterialsid').val(materialsid);
        if (cbl == 1){;
          $('#lblStatus').text("COMPLETED");
          $("select#cbomwrfstat option").each(function() { this.selected = (this.text == "COMPLETED"); });
        }else if(cbl == 0){
          $('#lblStatuspend').text("PENDING");
          $("select#cbomwrfstat option").each(function() { this.selected = (this.text == "PENDING"); });
        }
        if (verified == 1){
          $('#exampleCheck1').prop('checked',true);
          $('#exampleCheck2').prop('checked',false);
        }
        else if(verified == 0){
          $('#exampleCheck2').prop('checked',true);
          $('#exampleCheck1').prop('checked',false);

        }

    }
      function deletematerials(materialsid){

        //var txt;
        var r = confirm("Are you sure do you want to delete?");
        if (r == true) {
            //txt = "You pressed OK!";
            xajax_deletematerial(materialsid);
            xajax_archiveinsert("Engineering","Material ID. "+materialsid+" has been deleted.",currdate + " "+currtime);
            $("#framemat")[0].src = $("#framemat")[0].src;
          } else {
            //txt = "You pressed Cancel!";
          }

        }
        function verificationmodal(mwrfid,ms){
          $('#mwrfidmaterial3').val(mwrfid);
          var appendurl = $('#mwrfidmaterial3').val();
          $("select#cbomwrfstat option").each(function() { this.selected = (this.text == ms); });
          $('#txtmaterialsupdate').val("");
          $('#txtqtyupdate').val("");

          history.replaceState("","","?mwrfid2=" + appendurl);

          var myFrame = $('#framemat1');
          var url = $(myFrame).attr('src')+"?mwrfid2="+appendurl;

          var loc = url;
          var params = loc.split('?')[1];
          document.getElementById("framemat1").src = 'loadmaterialsverfication.php?mwrfid2=' + appendurl;
          $('#verificationmodal').modal('show');

        }
        function viewrequestmaterialsmodal(mwrfid){
          $('#mwrfidmaterial2').val(mwrfid);
          var appendurl = $('#mwrfidmaterial2').val();
          $('#txtmaterialsupdate').val("");
          $('#txtqtyupdate').val("");

          history.replaceState("","","?mwrfid1=" + appendurl);

          var myFrame = $('#framemat');
          var url = $(myFrame).attr('src')+"?mwrfid1="+appendurl;

          var loc = url;
          var params = loc.split('?')[1];
          document.getElementById("framemat").src = 'loadmaterials.php?mwrfid1=' + appendurl;
          $('#viewrequestmaterialmodal').modal('show');

        }
        function addrequestmaterialmodal(mwrfid,PlateNo,MWRFNo,RequestType,rrno){
          $('#mwrfidmaterial').val(mwrfid);
          $('#txtmatmwrfno').val(MWRFNo);
          $('#txtmatpn').val(PlateNo);
          $('#txtmatrt').val(RequestType);
          $('#txtrrno').val(rrno);

          $('#addrequestmaterialmodal').modal('show');
        }


        function editrequestmodal(mwrfid,MWRFNo,rt,pn,wt,wv,jc,rept,pt,it,bt,ctd,tf,df,pd,pc,ca,pa,remarks,rb,dhm,d1,d2,d3,st,sd,ft,fd,rrb,rab,cmvb,ms,timestart,timefin){
        //alert(pd);
        history.replaceState("","","?mwrfid1=" + mwrfid);
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
          $('#stime').val(timestart);
          $('#ftime').val(timefin);
          $('#sdate').val(sd);
          //$('#ftime').val(ft);
          $('#fdate').val(fd);
          $('#txtrecby').val(rrb);
          $('#txtappby').val(rab);
          $('#txtcmvb').val(cmvb);
          $("select#cbostatus option").each(function() { this.selected = (this.text == ms); });


          $('#editrequestmodal').modal('show');

        }
        $('#btnCreatenew').click(function(){
          document.getElementById("txtcurrdate").innerHTML = currdate;
          document.getElementById("txtcurrtime").innerHTML = currtime;
          $('#createrequestmodal').modal('show');

        });


        $('#btnmwrfstat').click(function(){

          var checks = $('#exampleCheck1').prop('checked');
          var matid = $('#txtmaterialsid').val();
          var stat = $('#cbomwrfstat option:selected').val();
          
          if (stat == "PENDING"){
            alert("Ask the warehouse first.");
          }
          else if (matid == ""){
            alert("Select material first.");
          }
          else if(stat == "COMPLETED") {
            if (checks == true){
              xajax_materialverification(matid,1);
              xajax_archiveinsert("Engineering","Material ID. "+matid+" has been updated its status.",currdate + " "+currtime);  
            }
            else if(checks == false){
              xajax_materialverification(matid,0);
              xajax_archiveinsert("Engineering","Material ID. "+matid+" has been updated its status.",currdate + " "+currtime);

            }
            else
            {
              alert("error");
            }
            

          }

        });
        $('#btnmaterialupdate').click(function(){
          var matid = $('#txtmaterialsid').val();
          var materials = $('#txtmaterialsupdate').val();
          var qty = $('#txtqtyupdate').val();

          //alert(matid);
          if (materials == ""){
            alert("Select a Material below first.");
          }
          else {
            xajax_updatematerial(matid,materials,qty);
            xajax_archiveinsert("Engineering","Material ID. "+matid+" has been updated.",currdate + " "+currtime);

          }
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
          
          xajax_archiveinsert("Engineering","Material ID. "+mwrfidmaterial+" has been added.",currdate + " "+currtime);
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

        xajax_addrequestmaterial(mwrf,mat,qty,0,"",sdate,1,1,"dsd",1321,2,"","",1,
          1);
      });

        $('#exampleCheck1').change(function() {
            $('#exampleCheck1').prop('checked',true);
            $('#exampleCheck2').prop('checked',false);
        });

        $('#exampleCheck2').change(function() {
            $('#exampleCheck2').prop('checked',true);
            $('#exampleCheck1').prop('checked',false);
        });
        // Insert new Request Form
        $('#btnnewreq').click(function(){
          var mwrfno = $('#txtMWRF1').val();
          var rt = $('#cborequesttype1 option:selected').val();
          var plate = $('#txtplatenos1').val();
          var worktype = $('#txtworktype1').val();
          var workvenue = $('#txtworkvenue1').val();
          var job = $('#txtjobclass1').val();
          var repair = $('#txtrepairtype1').val();
          var pmtype = $('#txtpmtype1').val();
          var imp = $('#txtimprovement1').val();
          var breakd = $('#txtbreakdown1').val();
          var compl = $('#dtpcompletion1').val();
          var timef = $('#txtcurrtime1').val();
          var datef = $('#txtcurrdate1').val();
          var desc = $('#txtDescription1').val();
          var cause = $('#txtCauses1').val();
          var ca = $('#txtCorrective1').val();
          var pa = $('#txtPreventive1').val();
          var remarks = $('#txtremarks1').val();
          var reqby = $('#txtrequestby1').val();
          var dhm = $('#txtdepthead1').val();
          var d1 = $('#txtdesignated11').val();
          var d2 = $('#txtdesignated21').val();
          var d3 = $('#txtdesignated31').val();
          var stime = $('#stime1').val();
          var sdate = $('#sdate1').val();
          var fdate = $('#fdate1').val();
          var ftime = $('#ftime1').val();
          var rrb = $('#txtrecby1').val();
          var rab = $('#txtappby1').val();


          //alert(plate);
          xajax_archiveinsert("Engineering","New Request MWRF No. "+mwrfno+" has been added.",currdate + " "+currtime);
          xajax_createnewrequest(mwrfno,rt,plate,worktype,workvenue,job,repair,pmtype,imp,breakd,compl,currdate + " "+currtime,currdate,desc,cause,ca,pa,remarks,reqby,dhm,d1,d2,d3,sdate+" "+stime+":00",sdate,fdate + " "+ ftime+":00",fdate,rrb,rab,"","","","","",currdate,"0000-00-00","PENDING","");

          alert("Successfully Added.");
          location.reload();
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
          var timef = document.getElementById('txtcurrtime').innerHTML;
          var datef = document.getElementById('txtcurrdate').innerHTML;
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
          var ms = $('#cbostatus option:selected').val();
          var cmvb = $('#txtcmvb').val();

          xajax_updateformrequest(mwrfid,mwrf,rt,plate,worktype,workvenue,job,repair,pmtype,imp,breakd,compl,
            timef,datef,desc,cause,ca,pa,remarks,reqby,dhm,d1,d2,d3,sdate+" "+stime+":00",sdate,
            fdate + " "+ ftime+":00",fdate,rrb,rab,"","","",cmvb,"",datef,currdate,ms,"");
          xajax_archiveinsert("Engineering","Request MWRF ID "+mwrfid+" has been updated",currdate + " "+currtime);
          alert("Successfully Updated.");
          location.reload();

        });
      </script>
    </body>

    </html>
