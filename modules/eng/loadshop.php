<?php
include('../../classes/inc/dbCon.php');

	global $db;
	$shopname = $_GET['shopname'];
	
	$sql = "SELECT *FROM tbladdnewshop WHERE ShopName LIKE '%".$shopname."%' AND isdelete = 1 ORDER BY ID ASC";
	$result=$db->query($sql);
	$c=1;

	if ($result->num_rows > 0){
		while ($row=$result->fetch_assoc()){
			$shopid = $row['ID'];
			$refname = $row['ReferenceName'];
			$shopname = $row['ShopName'];

					echo '<form action = "loadshop.php" method = "GET">';

					echo '<table width = "100%" class="table table-bordered table-hover table-info" cellspacing="0" style= "width:100%;table-layout: fixed;margin-bottom: -15px;">';
					echo '<td style = "width:50px;">'.$row['ID'].'</td>';
					echo '<td style= "width:250px;">'.$row['ReferenceName'].'</td>';
					echo '<td style= "width:250px;">'.$row['ShopName'].'</td>';
					echo '<td>
					<button type="button" class="btn btn-primary" name="btnviewmat" id="'.$shopid.'" onclick = \'(parent.selectshop("'.$shopid.'","'.$refname.'","'.$shopname.'"))\'>Select
					</button>

					</td>';

					echo '</tr>';	
					echo "</table>";
					echo "</form>";
			}
		}

?>
<!DOCTYPE html>
<html>
<head>
<title></title>
<link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template-->
  <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Page level plugin CSS-->
  <link href="../../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../../css/sb-admin.css" rel="stylesheet">
	
</head>
<body>
    <script type="text/javascript">
    	/*window.parent.$('#btncredentialupdate').click(function(){
    		window.parent.$("#btnloadmat").trigger('click');
    		window.parent.$("#btnloadmat").trigger('click');
    	});*/
    </script>
</body>
</html>