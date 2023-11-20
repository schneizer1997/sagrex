<?php
//Purchasing Module
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

  <title>SAGREX Purchasing</title>

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
  <div class="form-group" style="border:1px solid white;margin-bottom: 50px;margin-right: 20px;">
    <div style="float: right;">
    <button class="btn btn-primary" data-toggle="modal" href="#addshopmodal" id="btnaddshop"><i class="  fa fa-plus-circle" style="padding-right: 5px;"></i>Shop</button>   
    </div>
  </div>
  <div class="card mb-3">
    <div class="card-header" style="background-color: #3399CC;color: white;">
      <i class="fas fa-table"></i>
    <strong>Pending Request Table</strong></div>
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
            include('pur_loadrequestform.php');
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
                    <textarea type="text" class="form-control" id="txtmaterials" placeholder="" style="height: 30px;" rows="3"></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Quantity</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="txtqty" placeholder="" style="height: 30px;">
                    <input type="hidden" class="form-control" id="txtmatpn" placeholder="" style="height: 30px;">
                    <input type="hidden" class="form-control" id="txtmatmwrfno" placeholder="" style="height: 30px;">
                    <input type="hidden" class="form-control" id="txtrrno" placeholder="" style="height: 30px;">
                    <input type="hidden" class="form-control" id="txtmatrt" placeholder="" style="height: 30px;">
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

  <!-- New Shop Modal -->
  <div class="modal fade bd-example-modal-lg" id="addshopmodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"">
    <div class="modal-dialog modal-sm">
      <div class="modal-content" style="min-width:700px;min-height: 550px;
      margin-left: -180px;">
        <div class="modal-header" style="background-color: #17A2B8;color:white;">
          <h5 class="modal-title" id="formModalLabel">Shop Module</h5>
          <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnFormClose"><i class="fa fa-close"></i></button>
        </div>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <div style="line-height: 50px;margin-left: 10px;">Shop Info</div>
          <div>
            <div style="border: 1px solid white;min-height: 100px;min-width:300px;line-height: 50px;margin: 10px;">
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Reference Name:</label>
                  <div class="col-sm-10">
                    <input type="hidden" id="txtshopid" name="txtshopid">
                    <input type="text" class="form-control" id="txtshopref" placeholder="" style="height: 30px;margin-top: 5px;">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Shop Name:</label>
                  <div class="col-sm-10">
                    <textarea type="text" class="form-control" id="txtshopname" placeholder="" style="height: 50px;" rows="3"></textarea>
                  </div>
                </div>
                
                <div style="">
                <div style="float: right;">
                <button type="button" class="btn btn-info" id="btnshopupdate" disabled>Update</button>
                <button type="button" class="btn btn-info" id="btnshopsave">Save</button>
                <button type="button" class="btn btn-info" id="btnshopaddnew">Add New</button>
                </div>
                </div>
                  <table class="table table-hover" id="dataTable" width="10%" cellspacing="0">
                    <div class="form-group row">
                    <label class="" style="margin-left: 20px;">Search:</label>
                    <div class="col-sm-3">
                    <input type="text" class="form-control" id="txtsearch" placeholder="Shop Name" name="txtsearch">
                    </div>
                    </div>
                  <thead style="border-top: 2px solid #17A2B8;background-color: #17A2B8;color: white;">
                  <tr>
                    <th style = "width:50px;">ID</th>
                    <th style = "width:300px;">Reference Name</th>
                    <th style = "width:200px;">Shop Name</th>
                    <th style="">Action</th>
                  </tr>
                </thead>

            <div id="shoptable">
              <table class="table table-bordered" id="mtable1" cellspacing="0">
                
                <tbody id="mtable2">
                  <iframe style="border: 0px;margin-top: -20px;" name="framemat4" id="framemat4" src="loadshop.php?shopname=" allowfullscreen/></iframe>
                </tbody>
              </table>
            </table>
            </div>

            <div class="modal-footer">
              
              
            </div>
          </div>


        </table>

      </div>


    </div>
  </div>
    <!-- End -->

  <!-- Edit Request Material -->
  <div class="modal fade bd-example-modal-lg" id="credentialmaterialmodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" style="width: 1200px;min-height:650px;margin-left: -180px;">
        <div class="modal-header" style="background-color: #17A2B8;color:white;">
          <h5 class="modal-title" id="formModalLabel">Credential Materials</h5>
          <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnFormClose"><i class="fa fa-close"></i>
              </button>
        </div>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <div style="margin-left: 10px;">Material Information</div>

          <div style="float: right;border: 1px;">
            <!-- <form action="" method="GET" enctype="multipart/form-data"> -->
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
                  <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Materials:</label>
                  <div class="col-sm-10">
                    <textarea type="text" class="form-control" id="txtmaterialsupdate" placeholder="" style="height: 30px;"></textarea>
                    <input type="hidden" class="form-control" id="txtmaterialsid" placeholder="" style="height: 30px;">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Unit Price</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="txtunitprice" placeholder="" style="height: 30px;" >
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Quantity:</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="txtqtyupdate" placeholder="" style="height: 30px;" disabled>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Amount:</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="txtamount" placeholder="" style="height: 30px;" disabled>
                  </div>
                </div>
                  
                </div>
                <div id = "rightmat" style="border: 1px;width: 550px;float: right;">
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Date Granted:</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" id="txtnewdategrant" placeholder="" style="height: 50px;">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Shop:</label>
                   <?php
                              global $db;
                              $sql = "SELECT DISTINCT ShopName FROM tbladdnewshop WHERE isdelete = 1 ORDER BY ShopName ASC";
                              $result=$db->query($sql);
                              $c=1;
                              echo '<div class="col-sm-10">';
                              echo '<select class="form-control" id="cboshop">';
                              if ($result->num_rows > 0 ){
                                while ($row=$result->fetch_assoc()){
                                  echo '<option value="'.$row['ShopName'].'">'.$row['ShopName'].'</option>';
                                }
                              }
                              echo '</select>';
                              echo '</div>';

                               ?>
                    <!-- <button class="btn btn-primary" data-toggle="modal" href="#addshopmodal" id="btnaddshop"><i class="  fa fa-plus-circle" style="padding-right: 5px;"></i>ADD</button> -->

                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Type of Transaction:</label>
                  <div class="col-sm-10">
                    <select class="form-control" id="cbott">
                      <option disabled selected>Select</option>
                      <option>CASH</option>
                      <option>JOB ORDER</option>
                      <option>PURCHASE ORDER</option>
                    </select>
                  </div>
                </div>
                </div>      
              </div>

            <!-- </form> -->
            <div class="modal-footer" style="border: 1px;float: right;">     
              <button type="button" class="btn btn-info" id="btncredentialupdate">
              <i style="padding-right: 5px;" class="fas fa-save"></i>Update</button>
              <button type="button" class="btn btn-info" name="btnloadmat" id="btnloadmat" style=""><i style="padding-right: 5px;" class="fa fa-refresh"></i>Reload</button>
              
            </div>
            <!-- <thead class="table table-bordered" style="border-top: 0px solid #17A2B8;table-layout: fixed;background-color: #17A2B8;color: white;" align="center">
                  <tr>
                    <th style = "width:180px;">Materials</th>
                    <th style = "width:70px;">Quantity</th>
                    <th style = "width:120px;">Unit Price</th>
                    <th style = "width:120px;">Amount</th>
                    <th style = "width:120px;">Date Granted</th>
                    <th style = "width:140px;">Shop</th>
                    <th style = "width:140px;">Request Type</th>
                    <th style = "width:140px;">Check by Warehouse</th>
                    <th style = "width:180px;">Action</th>
                  </tr>
                </thead> -->
            <div style="height:0px;min-width:500px;margin-right:2px;">
              <table class="table table-bordered" id="mtable1" cellspacing="0">
                
                <tbody id="mtable2">
                  <iframe style="border-bottom:0px solid #17A2B8;margin-top: -20px;" name="framemat" id="framemat" src="pur_loadmaterials.php" allowfullscreen/></iframe>
                </tbody>
              </table>
              <div class="form-group row">
                  <label id="" style="height: 30px;margin-left: 20px;">Grand Total:</label>
                  <div class="col-sm-2">
                    <input type="text" class="form-control" id="txtgrandtotal" name="txtgrandtotal" disabled="" style="color: red;">
                  </div>
                </div>
            </div>
            

          </div>


        </table>

      </div>
    </div>
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

            <form action="" method="GET">
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



      function selectmaterials(materialsid,materials,qty,unit,amount,dategrant,shop,tt){
        $('#txtmaterialsid').val(materialsid);
        $('#txtmaterialsupdate').val(materials);
        $('#txtqtyupdate').val(qty);
        $('#txtunitprice').val(unit);
        $('#txtnewdategrant').val(dategrant);
        $('#txtamount').val(amount);
        $("select#cboshop option").each(function() { this.selected = (this.text == shop); });
        $("select#cbott option").each(function() { this.selected = (this.text == tt); });

      }
      function deletematerials(materialsid){
        
        //var txt;
        var r = confirm("Are you sure do you want to delete?");
        if (r == true) {
            //txt = "You pressed OK!";
            xajax_deletematerial(materialsid);
            xajax_archiveinsert("Purchasing","Material ID. "+materialsid+" has been deleted.",currdate + " "+currtime);
        $("#btnloadmat").trigger('click');
        $("#btnloadmat").trigger('click');
        $("#btnloadmat").trigger('click'); 
          } else {
            
            //txt = "You pressed Cancel!";
          }

        }
      function credentialmaterialsmodal(mwrfid){
        $('#txtmaterialsid').val("");
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
        $('#txtunitprice').val("");
        $('#txtamount').val("");
        $('#txtnewdategrant').val("");
        $("select#cboshop option").each(function() { this.selected = (this.text == ""); });
        $("select#cbott option").each(function() { this.selected = (this.text == ""); });
        $('#credentialmaterialmodal').modal('show');
      }
      function selectshop(id,sr,sn){
          $('#txtshopid').val(id);
          $('#txtshopname').val(sn);
          $('#txtshopref').val(sr);

          $('#btnshopupdate').prop('disabled', false);
          //$('#btnshopaddnew').prop('disabled', true);
          $('#btnshopsave').prop('disabled', true);
      }


        $(document).ready(function(){
          $('#btnCreatenew').click(function(){
            $('#createrequestmodal').modal('show');

          });

        });
        $('#txtunitprice').keyup(function(){
          var price = $('#txtunitprice').val();
          var qty = $('#txtqtyupdate').val();

          if (qty == 0){
            $('#txtamount').val(price);

          }
          else {
          var mult = price * qty;

          $('#txtamount').val(mult);  
          }
          

        });
        $('#txtsearch').keyup(function(){
          var shopname = $('#txtsearch').val();
          document.getElementById("framemat4").src = 'loadshop.php?shopname=' + shopname;
        });
        $('#btnshopaddnew').click(function(){
          $('#txtshopid').val("");
          $('#txtshopname').val("");
          $('#txtshopref').val("");

          $('#btnshopupdate').prop('disabled', true);
          $('#btnshopsave').prop('disabled', false);
          //$('#addshopmodal').modal('show');
        });
        $('#btnshopsave').click(function(){
          //var shid = $('#txtshopid').val();
          var sn = $('#txtshopname').val();
          var sr = $('#txtshopref').val();

          if (sn == "" || sr == ""){
            alert("Fill in the fields.");
          }
          else {
            xajax_shopinsert(sn,sr);
            $("#btnloadmat").trigger('click');
            $("#btnloadmat").trigger('click');
             $("#btnloadmat").trigger('click');
          }
        });
        $('#btnshopupdate').click(function(){
          var shid = $('#txtshopid').val();
          var sn = $('#txtshopname').val();
          var sr = $('#txtshopref').val();
          xajax_shopupdate(shid,sn,sr);
          $("#btnloadmat").trigger('click');
            $("#btnloadmat").trigger('click');
             $("#btnloadmat").trigger('click');

        });
        $('#btncredentialupdate').click(function(){
          var matid = $('#txtmaterialsid').val();
          var materials = $('#txtmaterialsupdate').val();
          var qty = $('#txtqtyupdate').val();
          var unit = $('#txtunitprice').val();
          var dategrant = $('#txtnewdategrant').val();
          var shop =  $('#cboshop').val();
          var rt = $('#cbott').val();
          var amount = $('#txtamount').val();
          
          if (matid == "" && materials == ""){
            alert("Select a Material below first.");
          }
          else {

            xajax_updatecredentials(matid,materials,qty,unit,amount,dategrant,shop,rt);
            xajax_archiveinsert("Purchasing","Material ID "+matid+" has been updated its credential",currdate + " "+currtime);
            $("#btnloadmat").trigger('click');
            /*$("#btnloadmat").trigger('click');
             $("#btnloadmat").trigger('click');*/
          }
        });

        $('#btnloadmat').click(function(){
        document.getElementById('framemat').contentWindow.location.reload();
        document.getElementById('framemat4').contentWindow.location.reload();
      });
        $('#framemat').on('load', function(){
        var amount = $('iframe[name=framemat]').contents().find('#txttotalamount').val();
        $('#txtgrandtotal').val(amount);
        //alert(amount);
      });
        $('#addshopmodal').on('hidden.bs.modal', function () {
         location.reload();
        });
        $('#credentialmaterialmodal').on('hidden.bs.modal', function () {
         location.reload();
        });
      </script>
    </body>

    </html>
