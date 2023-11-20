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
         echo '<input type="hidden" id="txtusername" name = "txtusername" value="'.$username.'">';
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
          
          <div class="" style="min-height: 400px;">
          <div class="form-group row" style="border:0px solid grey;height:50px;background-color: #17A2B8;padding: 5px;">
              <label class="col-sm-1 col-form-label" id="" style="height: 30px;color: white;">Search</label>
              <div class="col-sm-2" style="margin-right: 0px;">
                <input type="text" name="txtsearch" id="txtsearch" placeholder="MWRF ID" class="form-control" style="width:150px; ">
              </div>
              <button id="btnsearch" name="btnsearch" class="btn btn-primary" style="height: 40px;">Search ID</button>
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

    <!-- Edit Request Info -->
  <div class="modal fade bd-example-modal-lg" id="closedrequestmodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" style="width: 1250px;margin-left: -210px;min-height: 1050;">
        <div class="modal-header" style="background-color: #17A2B8;color:white;">
              <h5 class="modal-title" id="formModalLabel"><strong>Closed Request</strong></h5><button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnFormClose"><i style="padding-right: 0px;" class="fa fa-close"></i></button>
            </div>
        <iframe src="close.php" scrolling="no" id="frameclose" name="frameclose" style="border:0px;min-height: 1070px;margin:0px;"></iframe>

      </div>
    </div>
  </div>

        
      <!-- End -->

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
      $('#btnsearch').click(function(){
        

        var mwrfid = $('#txtsearch').val();
        if (mwrfid == ""){
          alert("Enter MWRF ID First.");
        }
        else {

        history.replaceState("","","?mwrfid=" + mwrfid);
        document.getElementById("frameclose").src = 'close.php?mwrfid=' + mwrfid;
        
        }
        
        
            
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
      });
    </script>

  </body>

</html>
