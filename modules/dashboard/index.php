<?php
session_start();
include('../../classes/inc/dbCon.php');
require('index.common.php');
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

  <title>SB Admin - Dashboard</title>

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
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
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
         echo '<input type="hidden" id="txtusername" value="'.$username.'">';
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
          <a class="nav-link dropdown-toggle" href="../acctng/accounting_main.php">
            <i class="fas fa-calculator" style="padding-right: 5px;"></i>
            <span>Accounting</span></a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#">
              <i class="fas fa-truck" style="padding-right: 5px;"></i>
              <span>Logistics</span></a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="../admin/purchasing/purchasing_admin.php">
                <i class="fa fa-users" style="padding-right: 5px;"></i>
                <span>Human Resource</span></a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#">
                  <i class="fa fa-line-chart" style="padding-right: 5px;"></i>
                  <span>Sales</span></a>
                </li>

                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="../warehouse/general_sys/wh_menu.php">
                    <i class="fas fa-clipboard" style="padding-right: 5px;"></i>
                    <span>Warehouses</span></a>
                  </li>

                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="../purchasing/purchasing_main.php">
                      <i class="fas fa-money-check" style="padding-right: 5px;"></i>
                      <span>Purchasing</span></a>
                    </li>

                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="../it/it_inventory/it_menu.php">
                      <i class="fas fa-money-check" style="padding-right: 5px;"></i>
                      <span>I.T.</span></a>
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

                      <!-- Icon Cards-->
          <!-- <div class="row">
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-comments"></i>
                  </div>
                  <div class="mr-5">26 New Messages!</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                  <span class="float-left">View Details</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-warning o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-list"></i>
                  </div>
                  <div class="mr-5">11 New Tasks!</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                  <span class="float-left">View Details</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-success o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-shopping-cart"></i>
                  </div>
                  <div class="mr-5">123 New Orders!</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                  <span class="float-left">View Details</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-danger o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-life-ring"></i>
                  </div>
                  <div class="mr-5">13 New Tickets!</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                  <span class="float-left">View Details</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
          </div> -->

          <!-- Area Chart Example-->
          <!-- <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-chart-area"></i>
              Area Chart Example</div>
            <div class="card-body">
              <canvas id="myAreaChart" width="100%" height="30"></canvas>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
          </div> -->

          <!-- DataTables Example -->
          <div class="" style="min-height: 700px;border:1px solid white;">
            <div class="card mb-3" id="archive">
              <div class="card-header" style="background-color: #3399CC;color: white;">
                <i class="fas fa-table" style="padding-right: 5px;"></i>
                <strong>Activity Logs</strong></div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>Department</th>
                          <th>Action Description</th>
                          <th>Date & Time</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        include('archiveload.php');
                        ?>     
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
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
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
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
        var user = $('#txtusername').val();
        if (user != 'admin'){
          $('#archive').hide();
        }
        
      </script>
    </body>

    </html>
