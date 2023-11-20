<?php
session_start();
include('../../../classes/inc/dbCon.php');                        
//include('authenticationServer.php');
//include('getMaterials.php');
require('purchasing.common.php');
$xajax->printJavascript('../../../classes/xajax');
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

  <!-- Bootstrap core CSS-->
  <link href="../../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template-->
  <link href="../../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="../../../vendor/bootstrap/css/jquery.datetimepicker.css" rel="stylesheet">
  <!-- Page level plugin CSS-->
  <link href="../../../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <link href="../../../css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Custom styles for this template-->
  <link href="../../../css/sb-admin.css" rel="stylesheet">
  <!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"> -->

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
                                              <li><a href="../purchasing/vam_item.php">Purchased Item</a><br></li>
                                              <li><a href="../purchasing/vam_rms.php">Repairs/Machining/Servicing</a></li>
                                            </ul>
                                            
                                            
                                          </th>


                                        </tr>
                                        <tr>
                                          <th>FUEL</th>
                                          <th>
                                            <ul>
                                              <li><a href="../purchasing/fuel_main.php">View Fuels</a><br></li>
                                              <!-- <li><a href="#">Vehicles and Machineries</a><br></li>
                                              <li><a href="#">Non SAGREX Vehicles</a><br></li>
                                              <li><a href="#">Repairs/Machining/Servicing</a></li> -->
                                            </ul>
                                          </th>
                                        </tr>
                                        <tr>
                                          <th>PRODUCTION-INSUPACK AND AGRICHEM</th>
                                          <th>
                                            <ul>
                                              <li><a href="../purchasing/production_item.php">Purchased Item</a><br></li>
                                              <li><a href="../purchasing/production_rms.php">Repairs/Machining/Servicing</a><br></li>
                                              
                                            </ul>
                                          </th>
                                        </tr>
                                        <tr>
                                          <th>OFFICE AND WAREHOUSE</th>
                                          <th>
                                            <ul>
                                              <li><a href="../purchasing/officeandwarehouse_main.php">View Office AND Warehouses</a><br></li>
                                              
                                            </ul>
                                          </th>
                                        </tr>
                                        <tr>
                                          <th>OTHERS</th>
                                          <th>
                                           <ul>
                                            <li><a href="../purchasing/others_main.php">View Others</a><br></li>


                                          </ul>

                                        </th>
                                      </tr>

                                        <!-- <tr>
                                          <th>VENDOR ACCREDITATION</th>
                                          <th>
                                             <ul>
                                              <li><a href="../purchasing/vendoraccr_main.php">Suppliers</a><br></li>
                                              
                                              
                                            </ul>

                                          </th>
                                        </tr> -->
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
                            <a class="btn btn-primary" href="../../session/logout.session.php">Logout</a>
                          </div>
                        </div>
                      </div>
                    </div>


<script src="../../../vendor/jquery/jquery.min.js"></script>
<script src="../../../vendor/jquery/jquery.js"></script>
<!-- <script src="../../jquery/jquery-1.8.3.min.js" charset="UTF-8"></script> -->
<!-- <script src="../../vendor/js/bootstrap.min.js"></script> -->
<script src="../../../js/bootstrap-datetimepicker.js" charset="UTF-8"></script> 
<script src="../../../js/locales/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>
<script src="../../../vendor/jquery/jquery.datetimepicker.js"></script>
<!-- <script src="../../vendor/jquery/karma.conf.js"></script> -->
<script src="../../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="../../../vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="../../../js/sb-admin.min.js"></script>
<!-- <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
<!--     <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
  <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script> -->
  <!-- <script src="../../js/src/alert.js"></script> -->



</body>

</html>
