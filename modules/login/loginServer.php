<?php
  session_start();

    if (isset($_SESSION['username'])){
        header('location:../dashboard/index.php');
    }

  if (isset($_POST['btnSubmit'])){
    /*if (isset($_POST['txtUsername'])){
die("yes");
    }
    else {
      die("no");
    }*/

    global $db;
    // var_dump($db);
    $username=$_POST['txtUsername'];
    $password=$_POST['txtPassword'];

    /*$username="admin";
    $password="admin";*/
/*   echo $username;
    var_dump($username);*/
    
    $sql="SELECT *FROM users WHERE username='".$username."' AND password='".$password."'";
    $result=$db->query($sql);  
    //var_dump($result);
     if ($result->num_rows > 0){
      if ($username == "accounting"){
        header('location:../acctng/accounting_main.php');
      }
      else {
        header('location:../dashboard/index.php');
      }
      
        while ($row=$result->fetch_assoc()){
          $_SESSION['username']=$row['username'];
          $_SESSION['userinfoid']=$row['userinfoid'];
          $_SESSION['user_id']=$row['user_id'];
          //echo $_SESSION['username']=$row['username'];;
        
        // echo $_SESSION['username'];
  			}
       // header('location:../dashboard/index.php');
     }else{
     	echo'<font color="red"><center>Invalid Username/Password</font></center>';
     }
}
?>