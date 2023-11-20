<?php
session_start();
include('../../../classes/inc/dbCon.php');
//require('../admin.common.php');
require('purchasing.common.php');
$xajax->printJavascript('../../../classes/xajax');
date_default_timezone_set("Asia/Manila");

if (isset($_SESSION['username'])){
  $username=$_SESSION['username'];
  $userid=$_SESSION['userinfoid'];
  $iduser=$_SESSION['user_id'];
  
      // die ($userid."ssss ".$username);
}else{
  header('location: ../../../login/login.php');
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

  <title>VAM - Purchased Items</title>
  <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Kraken/3.8.2/js/html5.js"></script> -->

  <link href="../../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../../vendor/bootstrap/css/jquery-ui.css" rel="stylesheet">
  <link href="../../../vendor/bootstrap/css/jquery-ui-min.css" rel="stylesheet">
  <link href="../../../vendor/bootstrap/css/jquery-ui.structure.css" rel="stylesheet">
  <link href="../../../vendor/bootstrap/css/jquery-ui.structure-min.css" rel="stylesheet">
  <link href="../../../vendor/bootstrap/css/jquery-ui.theme.css" rel="stylesheet">
  <link href="../../../vendor/bootstrap/css/jquery-ui.theme.min.css" rel="stylesheet">

  <link href="../../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <link href="../../../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="../../../css/sb-admin.css" rel="stylesheet">
  <link href="../../../vendor/bootstrap/css/sweetalert2.css" rel="stylesheet">
  <link href="../../../vendor/datatables/dataTables.dateTime.min.css" rel="stylesheet">
  <link href="../../../vendor/datatables/buttons.dataTables.min.css" rel="stylesheet">
  
  <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css"> -->


</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="../../dashboard/index.php"><strong>SAGREX Corporation</strong></a>

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

      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="../acctng/acctng.php">
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
                <a class="nav-link dropdown-toggle" href="../warehouse/general_sys/wh_menu.php">
                  <i class="fas fa-clipboard" style="padding-right: 5px;"></i>
                  <span>Warehouses</span></a>
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
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Purchase Item</a>
                      </li>
                      <!-- <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Summary Report</a>
                      </li> -->
                      <!-- <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#items" role="tab" aria-controls="contact" aria-selected="false">Items</a>
                      </li> -->
                    </ul>
                    <!-- TAB END -->

                    <!-- TAB CONTENT -->
                    <div class="tab-content" id="myTabContent">
                      <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab" style="margin-top:10px;">
                        <?php
                        include('vam_item_purch.php');
                        ?>
                      </div>
                      <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <?php
                        //include('rrsis_items.php');
                        //include('report_content/summary_content.php');
                        ?>

                      </div>
                      <!-- <div class="tab-pane fade" id="items" role="tabpanel" aria-labelledby="contact-tab">22
                        <?php
                      //include('items_content.php');
                        ?>
                      </div> -->
                    </div>
                    <!-- END CONTENT -->

                    

                    <!-- /.container-fluid -->



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
              </div>

              <!-- Bootstrap core JavaScript-->
              <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
               <!--  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script> -->
              <script src="../../../vendor/jquery/jquery.min.js"></script>
              <script src="../../../vendor/jquery/jquery-ui.js"></script>
              <script src="../../../vendor/jquery/jquery-ui.min.js"></script>
              <script src="../../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

              <script src="../../../vendor/jquery-easing/jquery.easing.min.js"></script>
              <!-- <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script> -->
              <script src="../../../vendor/datatables/jquery.dataTables.js"></script>
              <script src="../../../vendor/datatables/dataTables.bootstrap4.js"></script>


              <script src="../../../js/sb-admin.min.js"></script>
              <script src="../../../vendor/jquery/jquery.datetimepicker.js"></script>

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
