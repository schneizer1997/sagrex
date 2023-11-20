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

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SAGREX Status</title>

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
    <form method="POST" class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
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
            <a class="nav-link dropdown-toggle" href="#">
              <i class="fa fa-users"style="padding-right: 5px;"></i>
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
                  <li class="breadcrumb-item active">Status</li>
                </ol>

                <!-- DataTables Example -->
                <form method="POST" enctype="multipart/form-data">
                  <div class="form-group"><strong>OVERALL COUNTS OF REQUEST STATUS </strong><label style="color: red;">(Note: This is a constant data.)</label></div>
                  <form method="GET" enctype="multipart/form-data">
                    <div class="row" style="border: 1px solid grey;">
                      <div class="col-sm-1">
                        <label style="color: red;">PENDING:</label>
                        <input type="" name="txtpending" id="txtpending" class="form-control" style="width: 80px;" disabled>
                      </div>
                      <div class="col-sm-1">
                        <label style="color: green;">COMPLETED:</label>
                        <input type="" name="txtcompleted" id="txtcompleted" class="form-control" style="width: 100px;" disabled>
                        <label></label>
                      </div>
                      <div class="col-sm-2" style="margin-left: 20px;">
                        <label style="color: blue;">Over All:</label>
                        <input type="" name="txtoa" id="txtoa" class="form-control" disabled>
                      </div>
                      <div class="col-sm-2" style="border-left: 1px solid grey;">
                        <label>Start Date:</label>
                        <input type="date" name="dtpsd" id="dtpsd" class="form-control">
                      </div>
                      <div class="col-sm-2">
                        <label>End Date:</label>
                        <input type="date" name="dtped" id="dtped" class="form-control">
                      </div>
                      <div class="col-sm-2">
                        <label>Between Dates:</label>
                        <input type="submit" name="btnbetween" id="btnbetween" class="btn btn-info" 
                        value="Calculate">
                      </div>
                      <div class="col-sm-2" style="margin-left: -20px;">
                        <label>TOTAL REQUEST:</label>
                        <?php
                        include('mwrfpendingcount.php');
                        ?>
                      </div>
                    </div>
                  </form>
                </form>

                <form action="mwrfpendingload.php" method="GET" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-sm-6" style="background-color: #dad8d8;padding-top: 10px;">
                      <div class="form-group row" style="margin-left: 10px;">
                        <label class="col-form-label">From:</label>
                        <div class="col-sm-4">
                          <input type="date" name="txtfrompend" id="txtfrompend" class="form-control"> 
                        </div>
                        <label class="col-form-label">To:</label>
                        <div class="col-sm-4">
                          <input type="date" name="txttopend" id="txttopend" class="form-control">      
                        </div>
                        <div class="col-sm-2">
                          <input type="button" name="btnsearchpend" id="btnsearchpend" class="btn btn-primary" value="Search">
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6" style="background-color: #dad8d8;padding-top: 10px;">
                      <div class="form-group row" style="margin-left: 10px;">
                        <label class="col-form-label">From:</label>
                        <div class="col-sm-4">
                          <input type="date" name="txtfromcomp" id="txtfromcomp" class="form-control">      
                        </div>
                        <label class="col-form-label">To:</label>
                        <div class="col-sm-4">
                          <input type="date" name="txttocomp" id="txttocomp" class="form-control">      
                        </div>
                        <div class="col-sm-2">
                          <input type="button" name="btnsearchcomp" class="btn btn-primary"  id="btnsearchcomp" value="Search">      
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6" style="background-color:#dad8d8;">
                      <div class="card mb-3" style="float:left;width: 510px;height:500px;overflow-y: auto;">
                        <div class="card-header">
                          <i class="fas fa-table" style="color: red;"></i>
                        LIST OF PENDING TABLE</div>
                        <div class="card-body">
                          <div class="table-responsive">
                            <table class="table table-hover" id="dataTable" width="10%" cellspacing="0">
                              <thead>
                                <tr>
                                  <th style = "min-width:280px;">MWRFID</th>
                                  <th style = "min-width:100px;">MWRF No.</th>
                                </tr>
                              </thead>
                              <table class="table table-bordered" id="mtable1" cellspacing="0">
                                <tbody id="framepend">
                                  <iframe style="border: 0px;width: 460px;height:280px; " name="framematpend" id="framematpend" src="mwrfpendingload.php?from=&to=" /></iframe>
                                </tbody>
                              </table>
                            </table>
                          </div>
                        </div>
                        <div class="card-footer small text-muted"></div>
                      </div>
                    </div>
                    <div class="col-sm-6" style="background-color:#dad8d8;">
                      <div class="card mb-3" style="float:left;width: 510px;height:500px;overflow-y: auto;">
                        <div class="card-header">
                          <i class="fas fa-table" style="color: green;"></i>
                        LIST OF COMPLETED TABLE</div>
                        <div class="card-body">
                          <div class="table-responsive" col-sm-6>
                            <table class="table table-hover" id="dataTable" width="10%" cellspacing="0">
                              <thead>
                                <tr>
                                  <th style = "min-width:280px;">MWRFID</th>
                                  <th style = "min-width:100px;">MWRFNo</th>
                                </tr>
                              </thead>
                              <table class="table table-bordered" id="mtable1" cellspacing="0">
                                <tbody id="framecomp">
                                  <iframe style="border: 0px;width: 460px;height:280px; " name="framematcomp" id="framematcomp" src="mwrfcompleteload.php?from=&to=" /></iframe>
                                </tbody>
                              </table>
                            </table>
                          </div>
                        </div>
                        <div class="card-footer small text-muted"></div>
                      </div>
                    </div>
                  </div>

                  <div class="row" id="secondrowdate">
                    <div class="col-sm-6" style="background-color: #dad8d8;padding-top: 10px;">
                      <div class="form-group row" style="margin-left: 10px;">
                        <label class="col-form-label">From:</label>
                        <div class="col-sm-4">
                          <input type="date" name="txtfromclose" id="txtfromclose" class="form-control"> 
                        </div>
                        <label class="col-form-label">To:</label>
                        <div class="col-sm-4">
                          <input type="date" name="txttoclose" id="txttoclose" class="form-control">      
                        </div>
                        <div class="col-sm-2">
                          <input type="button" name="btnsearchclose" id="btnsearchclose" class="btn btn-primary" value="Search">
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6" style="background-color: #dad8d8;padding-top: 10px;">
                      <div class="form-group row" style="margin-left: 10px;">
                        <label class="col-form-label">From:</label>
                        <div class="col-sm-4">
                          <input type="date" name="txtfromcancel" id="txtfromcancel" class="form-control">      
                        </div>
                        <label class="col-form-label">To:</label>
                        <div class="col-sm-4">
                          <input type="date" name="txttocancel" id="txttocancel" class="form-control">      
                        </div>
                        <div class="col-sm-2">
                          <input type="button" name="btnsearchcancel" class="btn btn-primary"  id="btnsearchcancel" value="Search">      
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row" id="secondrow">
                    <div class="col-sm-6" style="background-color:#dad8d8;">
                      <div class="card mb-3" style="float:left;width: 510px;height:500px;overflow-y: auto;">
                        <div class="card-header">
                          <i class="fas fa-table" style="color: red;"></i>
                        LIST OF CLOSED TABLE</div>
                        <div class="card-body">
                          <div class="table-responsive">
                            <table class="table table-hover" id="dataTable" width="10%" cellspacing="0">
                              <thead>
                                <tr>
                                  <th style = "min-width:280px;">MWRFID</th>
                                  <th style = "min-width:100px;">MWRF No.</th>
                                </tr>
                              </thead>
                              <table class="table table-bordered" id="mtable1" cellspacing="0">
                                <tbody id="framepend">
                                  <iframe style="border: 0px;width: 460px;height:280px; " name="framecloseload" id="framecloseload" src="mwrfclosedload.php?from=&to=" /></iframe>
                                </tbody>
                              </table>
                            </table>
                          </div>
                        </div>
                        <div class="card-footer small text-muted"></div>
                      </div>
                    </div>
                    <div class="col-sm-6" style="background-color:#dad8d8;">
                      <div class="card mb-3" style="float:left;width: 510px;height:500px;overflow-y: auto;">
                        <div class="card-header">
                          <i class="fas fa-table" style="color: green;"></i>
                        LIST OF CANCELLED TABLE</div>
                        <div class="card-body">
                          <div class="table-responsive" col-sm-6>
                            <table class="table table-hover" id="dataTable" width="10%" cellspacing="0">
                              <thead>
                                <tr>
                                  <th style = "min-width:280px;">MWRFID</th>
                                  <th style = "min-width:100px;">MWRFNo</th>
                                </tr>
                              </thead>
                              <table class="table table-bordered" id="mtable1" cellspacing="0">
                                <tbody id="framecomp">
                                  <iframe style="border: 0px;width: 460px;height:280px; " name="framecancelload" id="framecancelload" src="mwrfcancelledload.php?from=&to=" />
                                </iframe>
                              </tbody>
                            </table>
                          </table>
                        </div>
                      </div>
                      <div class="card-footer small text-muted"></div>
                    </div>
                  </div>
                </div>
                <div class="row" style="background-color: #dad8d8;">
                  <div class="form-group row" style="margin-left: 10px;">
                    <label class="col-form-label" style="color: red;">PENDING:</label>
                    <div class="col-sm-2">
                      <input type="text" name="txtpendingload" id="txtpendingload" class="form-control" disabled>
                    </div>
                    <label class="col-form-label" style="color: green;">COMPLETED:</label>
                    <div class="col-sm-2">
                      <input type="text" name="txtcompletedload" id="txtcompletedload" class="form-control" disabled>
                    </div>
                    <label class="col-form-label" style="color: green;">CLOSED:</label>
                    <div class="col-sm-2">
                      <input type="text" name="txtcloseload" id="txtcloseload" class="form-control" disabled>
                    </div>
                    <label class="col-form-label" style="color: red;">CANCELLED:</label>
                    <div class="col-sm-2"  style="width: 100px;">
                      <input type="text" name="txtcancelload" id="txtcancelload" class="form-control" disabled>
                    </div>
                    <label class="col-form-label" style="color: blue;">Total Records of Pending/Completed/Closed/Cancelled:</label>
                    <div class="col-sm-2">
                      <input type="text" name="txttotalload" id="txttotalload" class="form-control" disabled>
                    </div>
                  </div>
                </div>
              </form>

              <!-- Modal for creating -->
              <div class="modal fade bd-example-modal-lg" id="createrequestmodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content" style="width: 1200px;margin-left: -180px;height: 1200px;">
                    <div class="modal-header">
                      <h5 class="modal-title" id="formModalLabel">Create New Request</h5>
                    </div>
                    <form action="editrequest.php" method="POST" enctype="multipart/form-data">
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

                    <form action="loadmaterials.php" method="POST">
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
              localStorage.clear();

              document.getElementById('dtpsd').value = "<?php if(isset($_POST['dtpsd'])) {echo $_POST['dtpsd'];}?> ";
              document.getElementById('dtped').value = "<?php if(isset($_POST['dtped'])) {echo $_POST['dtped'];}?>";
              document.getElementById('txtfrompend').value = "<?php if(isset($_POST['txtfrompend'])) {echo $_POST['txtfrompend'];}?> ";
              document.getElementById('txttopend').value = "<?php if(isset($_POST['txttopend'])) {echo $_POST['txttopend'];}?>";

      //Paging and search is visible to false
      $('#dataTable').dataTable( {
        paging: false,
        searching: false,
        bInfo: false,
        oLanguage: {
          sEmptyTable: '',  
          sInfoEmpty: '',
          sZeroRecords: ''
        }
      } );
      var totalpend = $('#txthiddenpending').val();
      var totalcomp = $('#txthiddencomplete').val();
      var oa = parseInt(totalpend)  + parseInt(totalcomp);
      $('#txtpending').val(totalpend);
      $('#txtcompleted').val(totalcomp);
      $('#txtoa').val(oa);

      var countpend = $('#txtpendingcount').val();
      var countcomp = $('#txtcompletecount').val();
      document.getElementById('txtpendingload').value = "<?php 
      if(isset($_POST['txtpendingcount'])) {echo $_POST['txtpendingcount'];}?>";

      $('#txtpendingload').val(countpend);
      $('#txtcompletedload').val(countcomp);

      $('#btnsearchpend').click(function(){
        var from = $('#txtfrompend').val();
        var to = $('#txttopend').val();
        document.getElementById("framematpend").src = 'mwrfpendingload.php?from=' + from+'&'+'to='+to;

      });

      $('#btnsearchclose').click(function(){
        var from = $('#txtfromclose').val();
        var to = $('#txttoclose').val();
        //alert(from);
        document.getElementById("framecloseload").src = 'mwrfclosedload.php?from=' + from+'&'+'to='+to;
      });
      $('#framecloseload').on('load', function(){
        var count = $('iframe[name=framecloseload]').contents().find('#txtclosecount').val();
        $('#txtcloseload').val(count);

        var pend = $('#txtpendingload').val();
        var comp = $('#txtcompletedload').val();

        var close = $('#txtcloseload').val();
        var cancel = $('#txtcancelload').val();

        var totalrec = parseInt(pend) + parseInt(comp) + parseInt(close) + parseInt(cancel);
        $('#txttotalload').val(totalrec);
      });

      $('#btnsearchcancel').click(function(){
        var from = $('#txtfromcancel').val();
        var to = $('#txttocancel').val();
        //alert(from);
        document.getElementById("framecancelload").src = 'mwrfcancelledload.php?from=' + from+'&'+'to='+to;

      });
      $('#framecancelload').on('load', function(){
        var count = $('iframe[name=framecancelload]').contents().find('#txtcancelcount').val();
        $('#txtcancelload').val(count);

        var pend = $('#txtpendingload').val();
        var comp = $('#txtcompletedload').val();
        var close = $('#txtcloseload').val();
        var cancel = $('#txtcancelload').val();

        var totalrec = parseInt(pend) + parseInt(comp) + parseInt(close) + parseInt(cancel);
        $('#txttotalload').val(totalrec);
      });
      $('#framematpend').on('load', function(){
        var count = $('iframe[name=framematpend]').contents().find('#txtpendingcount').val();
        $('#txtpendingload').val(count);
        var pend = $('#txtpendingload').val();
        var comp = $('#txtcompletedload').val();

        var close = $('#txtcloseload').val();
        var cancel = $('#txtcancelload').val();

        var totalrec = parseInt(pend) + parseInt(comp) + parseInt(close) + parseInt(cancel);
        $('#txttotalload').val(totalrec);
    //your code (will be called once iframe is done loading)
  });
      $('#btnsearchcomp').click(function(){
        var from = $('#txtfromcomp').val();
        var to = $('#txttocomp').val();
        document.getElementById("framematcomp").src = 'mwrfcompleteload.php?from=' + from+'&'+'to='+to;

      });
      $('#framematcomp').on('load', function(){
        var count = $('iframe[name=framematcomp]').contents().find('#txtcompletecount').val();
        $('#txtcompletedload').val(count);
        var pend = $('#txtpendingload').val();
        var comp = $('#txtcompletedload').val();

        var close = $('#txtcloseload').val();
        var cancel = $('#txtcancelload').val();

        var totalrec = parseInt(pend) + parseInt(comp) + parseInt(close) + parseInt(cancel);
        $('#txttotalload').val(totalrec);
      });
    </script>
  </body>

  </html>