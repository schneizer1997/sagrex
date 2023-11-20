<?php
if (isset($_POST['btnauthmaint'])){
  global $db;
  $user = $_POST['txtusermain'];
  $pass = $_POST['txtpasswordmain'];
  //var_dump($user);
  //var_dump($pass);

  if ($user == "maintenance"){
  $sql = "SELECT *FROM users WHERE username = '".$user."' AND `password` = '".$pass."' AND isactive = 1";
  $result=$db->query($sql);
  if ($result->num_rows > 0){
    header('location:maintenance.php');


  }
  else{
    echo'<font color="red"><center>Invalid Username/Password</font></center>';
  }


  }
  elseif ($user == "purchasing") {
     $sql = "SELECT *FROM users WHERE username = '".$user."' AND `password` = '".$pass."' AND isactive = 1";
  $result=$db->query($sql);
  if ($result->num_rows > 0){
    header('location:purchasing.php');


  }
  else{
    echo'<font color="red"><center>Invalid Username/Password</font></center>';
  }
  }
    elseif ($user == "warehouse") {
     $sql = "SELECT *FROM users WHERE username = '".$user."' AND `password` = '".$pass."' AND isactive = 1";
  $result=$db->query($sql);
  if ($result->num_rows > 0){
    header('location:warehouse.php');


  }
  else{
    echo'<font color="red"><center>Invalid Username/Password</font></center>';
  }
  }
  
}
?>