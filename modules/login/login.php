<?php include ('../../classes/inc/dbCon.php'); ?>
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
    <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="../../css/sb-admin.css" rel="stylesheet">

  </head>

  <body class="bg-dark" style="background-image: url('logos2.png');height: 100%;

    /* Center and scale the image nicely */
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;">
<!--     style="background-image: url('bgsag.jpg');height: 100%;

    /* Center and scale the image nicely */
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;" -->

    <div class="container">
      <div class="card card-login mx-auto mt-5">
        <div class="card-header">Login</div>
        <div class="card-body">
          <form method = "POST" enctype="multipart/form-data">
            <div class="form-group">
              <div class="form-label-group">
                <input type="text" id="txtUsername" class="form-control" placeholder="" name="txtUsername" required="required" autofocus="autofocus">
                <label >Username</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input type="password" name="txtPassword" id="txtPassword" class="form-control" placeholder="Password" required="required">
                <label>Password</label>
              </div>
            </div>
            
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" value="remember-me">
                  Remember Password
                </label>
              </div>
            </div>
            <?php  
                include ('loginServer.php'); 
                /*$wow = $_POST['txtPassword'];
                
                die($wow);*/

            ?> 
            <!-- <a class="btn btn-primary btn-block" href="dashboard/index.php">Login</a> -->
            <input type="submit" class="btn btn-primary btn-block" value="Login" name="btnSubmit">
            
          </form>
          <div class="text-center">
            <a class="d-block small mt-3" href="register.php">Register an Account</a>
            <a class="d-block small" href="forgot-password.php">Forgot Password?</a>
          </div>

        </div>
        
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>
<script type="text/javascript">
    localStorage.clear();
  </script>
  </body>

</html>
