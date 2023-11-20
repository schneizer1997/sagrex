<?php
session_start();
include('../../classes/inc/dbCon.php');                        
//include('authenticationServer.php');
//include('getMaterials.php');
require('admin.common.php');
$xajax->printJavascript('../../classes/xajax');
date_default_timezone_set("Asia/Manila");

if (isset($_SESSION['username'])){
  $username=$_SESSION['username'];
  $userid=$_SESSION['userinfoid'];
  $iduser=$_SESSION['user_id'];
  //$mwrfid = $_SESSION['txtMWRF1'];

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

  <title>Sagrex Corporation</title>

<!--   <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="../../vendor/bootstrap/css/jquery.datetimepicker.css" rel="stylesheet">
  <link href="../../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <link href="../../css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="../../css/sb-admin.css" rel="stylesheet"> -->

</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="../dashboard/index.php"><strong>SAGREX Corporation</strong></a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form action="getMaterials.php" method="GET" class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0" enctype="multipart/form-data">
      <div class="input-group">
        <input type="text" class="form-control" name="txtsearch" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
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
         echo '<input type="hidden" id="txtusername" value="'.$username.'">'; 
         echo '<input type="hidden" id="userid" value="'.$userid.'">';
         echo '<input type="hidden" id="iduser" value="'.$iduser.'">';?></a>
       </li>
       <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-envelope fa-fw"></i>
          <!-- <span class="badge badge-danger">7</span> for notifications -->
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
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
                          <a href="../dashboard/index.php">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Department Systems</li>
                      </ol>

                      <!-- Page Content -->
                      <span class="glyphicon glyphicon-align-left" aria-hidden="true"></span>
                      <div class="card-header"><p>Engineering Systems</div>
                        
                        <div class="card-header">


                          <div id="accordion">
                            <div class="card">
                              <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                  <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    <strong>Employee Cashslip</strong>

                                  </button>
                                  <div style="float: right;">v1.4</div>

                                </h5>
                              </div>

                              <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="card-body">
                                  <form method="POST">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                      <thead>
                                        <tr style="background-color: #3399CC;color: white;">
                                          <th>Department</th>
                                          <th>Function[s]</th>
                                        </tr>
                                        <tr>
                                          <th><a href="cashslip/emp_info.php" id="btnnewemp">Add new Employee</a></th>

                                          <th>Create and Edit Request</th>
                                        </tr>
                                        <tr>
                                          <th><a href="#" id="btnauthenticatepur">Preview Records</a></th>
                                          <th>Update Credentials</th>
                                        </tr>
                                        <tr>
                                          <th><a href="#" id="btnauthenticateware">List of Employees</a></th>
                                          <th>Check Materials Requested</th>
                                        </tr>

                                        <tr>
                                          <th><a href="mwrfreports.php">Reports</a></th>
                                          <th>Print Reports of Request Forms</th>
                                        </tr>
                                        <!-- <tr>
                                          <th><a href="mwrfstatuscount.php">Status</a></th>
                                          <th>Generate Status of Request Forms</th>
                                        </tr>

                                        <tr>
                                          <th><a href="closedmwrf.php">Closed MWRF</a></th>
                                          <th>Change Status of Request To Closed</th>
                                        </tr> -->

                                      </thead>

                                    </table>
                                  </form>
                                </div>
                              </div>
                            </div>
                            
                            <!-- Toggle Systems -->
                            <div class="card">
                              <div class="card-header" id="headingTwo">
                                <h5 class="mb-0">
                                  <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Purchasing System
                                  </button>
                                </h5>
                              </div>
                              <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordion">
                                <div class="card-body">
                                  <form method="POST">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                      <thead>
                                        <tr style="background-color: #3399CC;color: white;">
                                          <th>Department</th>
                                          <th>Function[s]</th>
                                        </tr>
                                        <tr>
                                          <th>VEHICLES AND MACHINERIES</th>

                                          <th>
                                            <ul>
                                              <li><a href="#">Purchased Item</a><br></li>
                                              <li><a href="#">Repairs/Machining/Servicing</a></li>
                                            </ul>
                                            
                                            
                                          </th>


                                        </tr>
                                        <tr>
                                          <th>FUEL</th>
                                          <th>
                                            <ul>
                                              <li><a href="#">Vehicles and Machineries</a><br></li>
                                              <li><a href="#">Non SAGREX Vehicles</a><br></li>
                                              <li><a href="#">Repairs/Machining/Servicing</a></li>
                                            </ul>
                                          </th>
                                        </tr>
                                        <tr>
                                          <th>PRODUCTION-INSUPACT AND AGRICHEM</th>
                                          <th>
                                            <ul>
                                              <li><a href="#">Purchased Item</a><br></li>
                                              <li><a href="#">Repairs/Machining/Servicing</a><br></li>
                                              
                                            </ul>
                                          </th>
                                        </tr>
                                        <tr>
                                          <th>OFFICE AND WAREHOUSE</th>
                                          <th>
                                            <ul>
                                              <li><a href="#">Assets and Furnitures</a><br></li>
                                              <li><a href="#">Office and Supplies</a><br></li>
                                              <li><a href="#">Purchase Item/Materials</a><br></li>
                                              <li><a href="#">Repairs and Services</a><br></li>
                                              
                                            </ul>
                                          </th>
                                        </tr>
                                        <tr>
                                          <th>OTHERS</th>
                                          <th>
                                             <ul>
                                              <li><a href="#">Affiliates</a><br></li>
                                              <li><a href="#">Customers</a><br></li>
                                              <li><a href="#">Sales Personnel</a><br></li>
                                              
                                              
                                            </ul>

                                          </th>
                                        </tr>

                                        <tr>
                                          <th>VENDOR ACCREDITATION</th>
                                          <th>
                                             <ul>
                                              <li><a href="#">Suppliers</a><br></li>
                                              <li><a href="#">Customers</a><br></li>
                                              <li><a href="#">Sales Personnel</a><br></li>
                                              
                                              
                                            </ul>

                                          </th>
                                        </tr>
                                        <!-- <tr>
                                          <th><a href="mwrfstatuscount.php">Status</a></th>
                                          <th>Generate Status of Request Forms</th>
                                        </tr>

                                        <tr>
                                          <th><a href="closedmwrf.php">Closed MWRF</a></th>
                                          <th>Change Status of Request To Closed</th>
                                        </tr> -->

                                      </thead>

                                    </table>
                                  </form>
                                </div>
                              </div>
                            </div>
                            <div class="card">
                              <div class="card-header" id="headingThree">
                                <h5 class="mb-0">
                                  <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    System #3
                                  </button>
                                </h5>
                              </div>
                              <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                <div class="card-body">
                                  Coming Soon..
                                </div>
                              </div>
                            </div>
                          </div>

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

                  <!-- Login Maintenance -->
                  <form method="POST" enctype="multipart/form-data">
                    <div class="modal fade bd-example-modal-lg" id="emp_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                          <div class="modal-header" style="background-color: #17A2B8;color:white;">
                            <h5 class="modal-title" id="authenformlabel"><center>New Employee Form</center></h5>
                          </div>
                          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                            <div>

                              <div style="border: 1px;min-height: 100px;min-width:300px;line-height: 50px;margin: 10px;">

                                <div class="col-sm-10">
                                  <input type="hidden" class="form-control" name="txtusermain" id="txtusermain" value="" placeholder="" style="height: 30px;">
                                </div>
                                <label class="col-sm-5 col-form-label" id="" style="height: 30px;">First Name:</label>
                                <div class="col-sm-10">
                                  <input type="text" placeholder="" name="txtempname" class="form-control" id="txtempname" placeholder="" style="height: 30px;">
                                </div>

                                <label class="col-sm-8 col-form-label" id="" style="height: 30px;">Middle Name:</label>
                                <div class="col-sm-10">
                                  <input type="text" placeholder="" name="txtempmname" class="form-control" id="txtempname" placeholder="" style="height: 30px;">
                                </div>

                                <label class="col-sm-5 col-form-label" id="" style="height: 30px;">Last Name:</label>
                                <div class="col-sm-10">
                                  <input type="text" placeholder="" name="txtemplname" class="form-control" id="txtempname" placeholder="" style="height: 30px;">
                                </div>

                                <label class="col-sm-5 col-form-label" id="" style="height: 30px;">Gender:</label>
                                <div class="col-sm-10">
                                  <select id="cboemp_gender" class="form-control" style="height: 30px;">
                                    <option value="" disabled selected>Gender..</option>
                                    <option>Male</option>
                                    <option>Female</option>
                                  </select>
                                </div>

                                 <label class="col-sm-5 col-form-label" id="" style="height: 30px;">Department:</label>
                                
                                  <!-- <select id="cboemp_gender" class="form-control" style="height: 30px;">
                                    <option value="" disabled selected>Dept..</option>
                                    <option>ADMINISTRATION</option>
                                    <option>ACCOUNTING</option>
                                    <option>LOGISTICS</option>
                                    <option>Accounting</option>
                                    <option>Accounting</option>
                                    <option>Accounting</option>
                                  </select> -->

                                  <?php
                                  global $dbcashslip;
                                  $sql = "SELECT *FROM tbldepartment WHERE isdelete = 1 ORDER BY dept_name ASC";
                                  $result=$dbcashslip->query($sql);
                                  $c=1;
                                  echo '<div class="col-sm-10">';
                                  echo '<select class="form-control" id="txtdept">';
                                  echo '<option value="" selected disabled>Department</option>';
                                  if ($result->num_rows > 0 ){
                                    while ($row=$result->fetch_assoc()){
                                      echo '<option>'.$row['dept_name'].'</option>';
                                    }
                                  }
                                  echo '</select>';
                                  echo '</div>';

                                  ?>
                                

                              </div>


                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnFormClose1">Cancel</button>
                                <input type="submit" name="btnemp_save" value="Save"  class="btn btn-info" id="btnemp_save">
                              </div>

                            </form>


                          </div>
                        </table>
                      </div>
                    </div>
                  </div>
                  <!-- End -->

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
                        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                        <div class="modal-footer">
                          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                          <a class="btn btn-primary" href="../session/logout.session.php">Logout</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Request Data Modal -->


                  <div class="modal fade bd-example-modal-lg" id="requestModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content" style="width: 1200px;margin-left: -180px;height: 1500px;">
                        <div class="modal-header">
                          <h5 class="modal-title" id="formModalLabel">New Request</h5>
                        </div>
                        <div class="modal-body">
                         <div class="form-group">
      <!-- <div style="border: 1px solid red;width: 1180px;height: 1000px;">
        <div>
        <div style="border: 1px solid red;max-width: 200px;height: 200px;float: left;"></div>
        <div style="border: 1px solid red;max-width: 200px;height: 200px;float: right;"></div>
        </div>

      </div> -->
      <form action="getMaterials.php" method="GET" enctype="multipart/form-data">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <!-- <thead style="border: 5px solid black;width: 100px;">Request Details</thead><br> -->
          <table class="table table-bordered">
            <tr>
              <td colspan="2">Request Details</td>
              <td>Date Time Filed</td>
              <td>Maintenance:(Signature and Received Rate)</td>
            </tr>
            <div class="wew" id = "dsd">
              <td rowspan="2" width="20%">
                <div>
                  <label style="height: 30px;margin-left: 10px;">MWRF#</label>
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
              <td rowspan="2">
                <!-- Input Value -->
                <!-- Input for Request Details -->   
                <div>
                  <input type="text" name="txtMWRF" class="form-control" id="txtMWRF"   placeholder="MWRF#" style="height: 35px;width: 300px;">
                </div>
                <br>
                <?php
                include ('getMaterials.php');
                /*if (array_key_exists('txtMWRF', $_POST)) {
                  echo "wew";
                }
                else{
                  echo "zz";
                }*/
                //phpinfo();
                var_dump($_POST);
                print_r($_POST);
                error_reporting(E_ALL);
                ini_set('display_errors', 1);
                ?>
                
                <div class="col-sm-10">
                  <select id="cborequesttype" class="form-control" style="width: 300px;height: 35px;">
                    <option disabled selected>Request Type..</option>
                    <option>Vehicle</option>
                    <option>Machine</option>
                  </select>
                </div><br>
                <div class="col-sm-10">
                  <input type="text" name="txtplate" class="form-control" id="txtplatenos" placeholder="Plate No." style="height: 35px;width: 300px;">
                </div><br>
                
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="txtworktype" placeholder="Work Type" style="height: 35px;width: 300px;">
                </div><br>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="txtworkvenue" placeholder="Work Venue" style="height: 35px;width: 300px;">
                </div><br>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="txtjobclass" placeholder="Job Classification" style="height: 35px;width: 300px;">
                </div><br>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="txtrepairtype" placeholder="Repair Type" style="height: 35px;width: 300px;">
                </div><br>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="txtpmtype" placeholder="PM Type" style="height:35px;width: 300px;">
                </div><br>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="txtimprovement" placeholder="Improvement Type" style="height: 35px;width: 300px;">
                </div><br>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="txtbreakdown" placeholder="Breakdown Type" style="height: 35px;width: 300px;">
                </div><br>
                <div class="col-sm-10">
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
      <!-- <div style="float: right;">
        <button type="button" class="btn btn-info">Save</button>
        <button type="button" class="btn btn-info">Cancel</button>
      </div><br> -->
      <div>Material Request</div>
      <div>
        <form action="getMaterials.php" method="GET" enctype="multipart/form-data">
          <div style="border: 1px solid black;height: 100px;min-width:300px;line-height: 50px;float: left;">
            <div class="form-group row">
              <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Materials</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="txtmaterials" placeholder="" style="height: 30px;">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Quantity</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="txtqty" placeholder="" style="height: 30px;">
              </div>
            </div>
            <button type = "submit" class="btn btn-secondary" id="btnAdd" name = "btnAdd">Add Item</button>
          </div>
        </form>

        <div style="border: 1px solid red;height: 300px;min-width: 665px;float: right;margin-right: 2px;">
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
        </div>

      </div>

    </table>

  </form>

</div>
</div>
<!-- Footer -->
<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnFormClose">Close</button>
  <button type="button" class="btn btn-info" id="btnFormSubmit">Submit</button>
</div>
</div>
</div>
</div>

<script src="../../vendor/jquery/jquery.min.js"></script>
<script src="../../vendor/jquery/jquery.js"></script>
<!-- <script src="../../jquery/jquery-1.8.3.min.js" charset="UTF-8"></script> -->
<!-- <script src="../../vendor/js/bootstrap.min.js"></script> -->
<script src="../../js/bootstrap-datetimepicker.js" charset="UTF-8"></script> 
<script src="../../js/locales/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>
<script src="../../vendor/jquery/jquery.datetimepicker.js"></script>
<!-- <script src="../../vendor/jquery/karma.conf.js"></script> -->
<script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="../../js/sb-admin.min.js"></script>
<!-- <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
<!--     <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
  <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script> -->
  <!-- <script src="../../js/src/alert.js"></script> -->



  <script type="text/javascript">
    localStorage.clear();

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

  var test = new Date().toISOString().slice(0, 19).replace('T', ' ');
  document.getElementById("txtcurrdate").innerHTML = currdate;
  document.getElementById("txtcurrtime").innerHTML = currtime;

$('#btnnewemp').click(function(e){
  $("#emp_modal").modal('show');
      /*if (username == 'maintenance' || username == 'admin'){
        $('#txtusermain').val("maintenance");
        $("#loginmaintenancemodal").modal('show');
      }
      else {
        e.preventDefault(); 
      }*/
      
    });


  

</script>

</body>

</html>
