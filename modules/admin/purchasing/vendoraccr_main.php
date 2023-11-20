<?php
//Maintenance/Engineering Module
session_start();
/*include('../../../classes/inc/dbConInventory.php');*/
include('../../../classes/inc/dbCon.php');
require('purchasing.common.php');
$xajax->printJavascript('../../../classes/xajax');
date_default_timezone_set("Asia/Manila");

if (isset($_SESSION['username'])){
  $username=$_SESSION['username'];
  $userid=$_SESSION['userinfoid'];
  $iduser=$_SESSION['user_id'];
}else{
  header('location: ../../login/login.php');
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

  <title>VENDOR ACCR</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  
  <link href="../../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="../../../vendor/bootstrap/css/jquery-ui.css" rel="stylesheet"/>
  <link href="../../../vendor/bootstrap/css/jquery-ui-min.css" rel="stylesheet"/>
  <link href="../../../vendor/bootstrap/css/jquery-ui.structure.css" rel="stylesheet"/>
  <link href="../../../vendor/bootstrap/css/jquery-ui.structure-min.css" rel="stylesheet"/>
  <link href="../../../vendor/bootstrap/css/jquery-ui.theme.css" rel="stylesheet"/>
  <link href="../../../vendor/bootstrap/css/jquery-ui.theme.min.css" rel="stylesheet"/>

  <link href="../../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <link href="../../../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="../../../css/sb-admin.css" rel="stylesheet">
  <link href="../../../vendor/bootstrap/css/sweetalert2.css" rel="stylesheet"/>
  <link href="../../../vendor/datatables/dataTables.dateTime.min.css" rel="stylesheet">
  <link href="../../../vendor/datatables/buttons.dataTables.min.css" rel="stylesheet">


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
         echo '<input type="hidden" id="username" value="'.$username.'">'; 
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
        <a class="nav-link" href="../../dashboard/index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="../eng/eng.php">
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
            <a class="nav-link dropdown-toggle" href="../../admin/purchasing/purchasing_admin.php">
              <i class="fa fa-users" style="padding-right: 5px;"></i>
              <span>Human Resource</span></a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#">
                <i class="fa fa-line-chart" style="padding-right: 5px;"></i>
                <span>Sales</span></a>
              </li>

              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="wh_menu.php">
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


                    <!-- TABS -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">RR and SIS (MWRF Items)</a>
                      </li>
                      
                    </ul>
                    <!-- TAB END -->

                    <!-- TAB CONTENT -->
                    <div class="tab-content" id="myTabContent">
                      <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab" style="margin-top:10px;">
                        <?php
                        include('vendoraccr_main_info.php');
                        ?>
                      </div>
                      
                    </div>
                    <!-- END CONTENT -->



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
                                <button type="button" class="btn btn-info" name="btnloadmatver" id="btnloadmatver" style="display: none;"><i style="padding-right: 5px;" class="fa fa-refresh"></i>Reload</button>
                              </div>
                              <thead class="table table-bordered" style="border-top: 0px solid #17A2B8;width: 100%;table-layout: fixed;background-color: #17A2B8;color: white;" align="center">
                                <tr>
                                  <th style = "width:195px;">Materials</th>
                                  <th style = "width:75px;">Quantity</th>
                                  <th style = "width:90px;">Unit Price</th>
                                  <th style = "width:100px;">Date Granted</th>
                                  <th style = "width:100px;">Request Type</th>
                                  <th style = "width:70px;">RRNo</th>
                                  <th style = "width:40px;">Check By Warehouse</th>
                                  <th style = "width:100px;">Verified</th>                    
                                  <th style = "width:70px;">Action</th>
                                </tr>
                              </thead>
                              <div style="border: 1px;height:0px;min-width:500px;margin-right:2px;">
                                <table class="table table-bordered" id="mtable1" cellspacing="0">

                                  <tbody id="mtable2">
                                    <iframe style="border: 0px;margin-top: -20px;" name="framemat1" id="framemat1" src="loadmaterialsverfication.php" /></iframe>
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
                                <button type="button" class="btn btn-info" name="btnloadmat" id="btnloadmat" style=""><i style="padding-right: 5px;" class="fa fa-refresh"></i>Reload</button>
                              </div>
                              <thead class="table table-bordered" style="border-top: 2px solid #17A2B8;background-color: #17A2B8;color: white;" align="center">
                                <tr>
                                  <th style = "width:450px">Materials</th>
                                  <th style = "width:50px">Quantity</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <div style="border: 1px;height:0px;min-width:500px;margin-right:2px;">
                                <table class="table table-bordered" id="mtable1" cellspacing="0">

                                  <tbody id="mtable2">
                                    <iframe style="border: 0px;margin-top: -20px;" name="framemat" id="framemat" src="loadmaterials.php" /></iframe>
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
                                  <td style="border:1px solid #17A2B8;"><strong>Date/Time Filed</strong></td>
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
                                      <input type="text" name="txtMWRF" class="form-control" id="txtMWRF"   placeholder="MWRF#" style="height: 35px;width: 300px;">
                                      <input type="hidden" name="txtMWRF" class="form-control" id="txtMWRFID"   placeholder="MWRF#" style="height: 35px;width: 300px;">
                                    </div>
                                    <br>
                                    <div>
                                      <select id="cborequesttype" class="form-control" style="width: 300px;height: 35px;">
                                        <option value="" disabled selected>Options..</option>
                                        <option>Vehicle</option>
                                        <option>Machine</option>
                                        <option>Other Type</option>
                                      </select>
                                    </div><br>
                                    <div>
                                      <input type="text" name="txtplate" class="form-control" id="txtplatenos" placeholder="Plate/Machine No." style="height: 35px;width: 300px;">
                                    </div><br>

                                    <div>
                                      <select class="form-control" id="txtworktype">
                                        <option value="" selected disabled>Work Type</option>
                                        <option>maintenance</option>
                                        <option>repair</option>
                                        <option>installation</option>
                                      </select>
                                    </div><br>

                                    <div>

                                      <select class="form-control" id="txtworkvenue">
                                        <option value="" selected disabled>Work Venue</option>
                                        <option>inhouse</option>
                                        <option>jobout</option>
                                      </select>
                                    </div><br>
                                    <div>

                                      <select class="form-control" id="txtjobclass">
                                        <option value="" selected disabled>Job Classification</option>
                                        <option>reactive</option>
                                        <option>active</option>
                                        <option>reactive/active</option>
                                      </select>
                                    </div><br>
                                    <div>
                                      <select class="form-control" id="txtrepairtype">
                                        <option value="" selected disabled>Repair Type</option>
                                        <option>rehabilitate</option>
                                        <option>overhaul</option>
                                        <option>check</option>
                                      </select>
                                    </div><br>
                                    <div>
                                      <select class="form-control" id="txtpmtype">
                                        <option value="" selected disabled>Pm Type</option>
                                        <option>cleaning</option>
                                        <option>adjustment</option>
                                        <option>replacement of parts/items</option>
                                        <option>fabrication</option>
                                      </select>
                                    </div><br>
                                    <div>
                                      <select class="form-control" id="txtimprovement">
                                        <option value="" selected disabled>Improvement Type</option>
                                        <option>Upgrade</option>
                                      </select>
                                    </div><br>
                                    <div>
                                      <select class="form-control" id="txtbreakdown">
                                        <option value="" selected disabled>Breakdown Type</option>
                                        <option>Damage</option>
                                      </select>
                                    </div><br>
                                    <div>
                                      <input type="date" id="dtpcompletion" class="form-control"  name="dtpcompletion" style="height: 35px;width: 300px;">
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
                                  <input type="text" class="form-control" id="txtdesignated1" placeholder="Designated to: (1)"  style="width :300px;height: 30px"><br/>
                                  <input type="text" class="form-control" id="txtdesignated2" placeholder="Designated to: (2)"  style="width :300px;height: 30px"><br/>
                                  <input type="text" class="form-control" id="txtdesignated3" placeholder="Designated to: (3)"  style="width :300px;height: 30px"><br/></td>

                                  <tr>
                                    <td colspan="2" style="border:1px solid #17A2B8;"><strong>Action:Causes</strong><br><br>

                                      <label for="inputPassword" class="col-form-label" style="height: 30px;">Property Description:</label>

                                      <input type="text" class="form-control" id="txtDescription" placeholder="" style="height: 30px;">
                                      Problem Causes:<br>
                                      <textarea class="form-control" id="txtCauses" rows="2"></textarea>
                                      Remarks:<br>
                                      <textarea class="form-control" id="txtremarks" rows="2"></textarea>
                                      <br>
                                      <div class="form-row">
                                        <div class="col">
                                          <label style="height: 30px;">Request By</label>
                                          <?php
                                          global $dbinv;
                                          $sql = "SELECT *FROM tblstaffs WHERE infono = 1 AND status = 1 ORDER BY name ASC";
                                          $result=$dbinv->query($sql);
                                          $c=1;
                                          echo '<div class="col-sm-10">';
                                          echo '<select class="form-control" id="txtrequestby">';
                                          echo '<option value="" selected disabled>Request By</option>';
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
                                          $sql = "SELECT *FROM tblstaffs WHERE infono = 2 AND status = 1 ORDER BY name ASC";
                                          $result=$db->query($sql);
                                          $c=1;
                                          echo '<div class="col-sm-10">';
                                          echo '<select class="form-control" id="txtdepthead">';
                                          echo '<option value="" selected disabled>Department Head/Manager</option>';
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
                                        <td rowspan ="2" style="border:1px solid #17A2B8;"><strong>START</strong></td>
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

                                              <?php
                                              global $db;
                                              $sql = "SELECT *FROM tblstaffs WHERE infono = 3 AND status = 1 ORDER BY name ASC";
                                              $result=$db->query($sql);
                                              $c=1;
                                              echo '<div class="col-sm-10">';
                                              echo '<select class="form-control" id="txtrecby" style ="width:150px;">';
                                              echo '<option value="" selected disabled>Received By</option>';
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
                                              <label style="height: 30px;">Approved by</label>

                                              <?php
                                              global $db;
                                              $sql = "SELECT *FROM tblstaffs WHERE infono = 4 AND status = 1 ORDER BY name ASC";
                                              $result=$db->query($sql);
                                              $c=1;
                                              echo '<div class="col-sm-10">';
                                              echo '<select class="form-control" id="txtappby" style ="width:150px;">';
                                              echo '<option value="" selected disabled>Approved By</option>';
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
                                      <td style="border:1px solid #17A2B8;"><strong>Date/Time Filed</strong></td>
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
                                            <option value="" disabled selected>Request Type..</option>
                                            <option>Vehicle</option>
                                            <option>Machine</option>
                                            <option>Other Type</option>
                                          </select>
                                        </div><br>
                                        <div>
                                          <input type="text" name="txtplate" class="form-control" id="txtplatenos1" placeholder="Plate/Machine No." style="height: 35px;width: 300px;">
                                        </div><br>

                                        <div>
                                          <select class="form-control" id="txtworktype1">
                                            <option value="" selected disabled>Work Type</option>
                                            <option>Maintenance</option>
                                            <option>Repair</option>
                                            <option>Installation</option>
                                          </select>
                                        </div><br>

                                        <div>
                                          <select class="form-control" id="txtworkvenue1">
                                            <option value="" selected disabled>Work Venue</option>
                                            <option>inhouse</option>
                                            <option>jobout</option>
                                          </select>
                                        </div><br>
                                        <div>

                                          <select class="form-control" id="txtjobclass1">
                                            <option value="" selected disabled>Job Classification</option>
                                            <option>reactive</option>
                                            <option>active</option>
                                            <option>reactive/active</option>
                                          </select>
                                        </div><br>
                                        <div>

                                          <select class="form-control" id="txtrepairtype1">
                                            <option value="" selected disabled>Repair Type</option>
                                            <option>rehabilitate</option>
                                            <option>overhaul</option>
                                            <option>check</option>
                                          </select>
                                        </div><br>
                                        <div>

                                          <select class="form-control" id="txtpmtype1">
                                            <option value="" selected disabled>Pm Type</option>
                                            <option>cleaning</option>
                                            <option>adjustment</option>
                                            <option>replacement of parts/items</option>
                                            <option>fabrication</option>
                                          </select>
                                        </div><br>
                                        <div>

                                          <select class="form-control" id="txtimprovement1">
                                            <option value="" selected disabled>Improvement Type</option>
                                            <option>Upgrade</option>
                                          </select>
                                        </div><br>
                                        <div>

                                          <select class="form-control" id="txtbreakdown1">
                                            <option value="" selected disabled>Breakdown Type</option>
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

                                          <label for="inputPassword" class="col-form-label" style="height: 30px;">Property Description:</label>

                                          <input type="text" class="form-control" id="txtDescription1" placeholder="" style="height: 30px;">
                                          Problem Causes:<br>
                                          <textarea class="form-control" id="txtCauses1" rows="2"></textarea>
                                          Remarks:<br>
                                          <textarea class="form-control" id="txtremarks1" rows="2"></textarea>
                                          <br>
                                          <div class="form-row">
                                            <div class="col">
                                              <label style="height: 30px;">Request By</label>
                                              <?php
                                              global $db;
                                              $sql = "SELECT *FROM tblstaffs WHERE infono = 1 AND status = 1 ORDER BY name ASC";
                                              $result=$db->query($sql);
                                              $c=1;
                                              echo '<div class="col-sm-10">';
                                              echo '<select class="form-control" id="txtrequestby1">';
                                              echo '<option value="" selected disabled>Request By</option>';
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
                                              $sql = "SELECT *FROM tblstaffs WHERE infono = 2 AND status = 1 ORDER BY name ASC";
                                              $result=$db->query($sql);
                                              $c=1;
                                              echo '<div class="col-sm-10">';
                                              echo '<select class="form-control" id="txtdepthead1">';
                                              echo '<option value="" selected disabled>Department Head/Manager</option>';
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
                                      <div style="min-width:300px;height: 150px;border-top: 1px solid white;">
                                        <table class="table table-bordered">
                                          <tr>
                                            <td rowspan ="2" style="border:1px solid #17A2B8;"><strong>START</strong></td>
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
                                                  <?php
                                                  global $db;
                                                  $sql = "SELECT *FROM tblstaffs WHERE infono = 3 ORDER BY name ASC";
                                                  $result=$db->query($sql);
                                                  $c=1;
                                                  echo '<div class="col-sm-10">';
                                                  echo '<select class="form-control" id="txtrecby1">';
                                                  echo '<option value="" selected disabled>Received By</option>';
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
                                                  <label style="height: 30px;">Approved by</label>
                                                  <?php
                                                  global $db;
                                                  $sql = "SELECT *FROM tblstaffs WHERE infono = 4 AND status = 1 ORDER BY name ASC";
                                                  $result=$db->query($sql);
                                                  $c=1;
                                                  echo '<div class="col-sm-10">';
                                                  echo '<select class="form-control" id="txtappby1" style ="width:150px;">';
                                                  echo '<option value="" selected disabled>Approved By</option>';
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
                                <input type="hidden" namselectmateriale="txthidden" id="txthidden">
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
                      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
                      <script src="../../../vendor/jquery/jquery.min.js"></script>
                      <script src="../../../vendor/jquery/jquery-ui.js"></script>
                      <script src="../../../vendor/jquery/jquery-ui.min.js"></script>
                      <script src="../../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

                      <!-- Core plugin JavaScript-->
                      <script src="../../../vendor/jquery-easing/jquery.easing.min.js"></script>

                      <!-- Page level plugin JavaScript-->
                      <!-- <script src="../../vendor/chart.js/Chart.min.js"></script> -->
                      <script src="../../../vendor/datatables/jquery.dataTables.js"></script>
                      <script src="../../../vendor/datatables/dataTables.bootstrap4.js"></script>

                      <!-- Custom scripts for all pages-->
                      <script src="../../../js/sb-admin.min.js"></script>
                      <script src="../../../vendor/jquery/jquery.datetimepicker.js"></script>

                      <!-- Demo scripts for this page-->
                      <script src="../../../js/demo/datatables-demo.js"></script>
                      <script src="../../../vendor/bootstrap/js/bootstrap3-typeahead.min.js" type="text/javascript"></script>
                      <script src="../../../vendor/bootstrap/js/bootstrap3-typeahead.js" type="text/javascript"></script>

                      <script src="../../../vendor/bootstrap/js/jquery.autocomplete.js" type="text/javascript"></script>
                      <script src="../../../vendor/bootstrap/js/jquery.autocomplete.min.js" type="text/javascript"></script>
                      <script src="../../../vendor/bootstrap/js/sweetalert2.js" type="text/javascript"></script>
                      <script src="../../../vendor/datatables/moment.js/2.18.1/moment.min.js" type="text/javascript"></script>
              <script src="../../../vendor/datatables/dataTables.dateTime.min.js" type="text/javascript"></script>
              <script src="../../../vendor/datatables/dataTables.buttons.min.js" type="text/javascript"></script>
              <script src="../../../vendor/datatables/jszip.min.js" type="text/javascript"></script>
              <script src="../../../vendor/datatables/pdfmake.min.js" type="text/javascript"></script>
              <script src="../../../vendor/datatables/vfs_fonts.js" type="text/javascript"></script>
              <script src="../../../vendor/datatables/buttons.html5.min.js" type="text/javascript"></script>
              <script src="../../../vendor/datatables/buttons.print.min.js" type="text/javascript"></script>
              <script src="../../../vendor/datatables/sum().js" type="text/javascript"></script>

                    </body>

                    </html>
