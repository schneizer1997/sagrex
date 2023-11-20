<?php
	
	if (isset($_POST["btnsample2"])){
		$sample = $_POST['txtsample'] ;
		echo "$sample";
	}
	if (isset($_POST["btnsample3"])){
		$sample = $_GET['MWRFID'] ;
		echo "$sample";
	}
	if (isset($_POST['txtsample'])){
		echo "not";
	}
	else{
		echo "asd";
	}
?>
<!DOCTYPE html>

<html>
<head>
	<title></title>
</head>
<body>

	
	<div id = "mtable"></div>
	<form action="sampleserver.php" method="GET" enctype="multipart/form-data">
	<table>
		<tr>
			<td>
	<div>
	<input type="text" id="txtsample" name="txtsample" value="www">
	<button type="submit" id="btnsample" name="btnsample">SAMPLE</button>
	
	<button type="button" id="btnsample2" name="btnsample2">SAMPLE2</button>
	<button type="button" id="btnsample3" name="btnsample3">SAMPLE3</button>
	<input type="submit" name="btnsample4">
	</div>
	</td>
	</tr>
	</table>
	</form>
	
	
	<!-- Bootstrap core JavaScript-->
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="../../vendor/chart.js/Chart.min.js"></script>
    <script src="../../vendor/datatables/jquery.dataTables.js"></script>
    <script src="../../vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../js/sb-admin.min.js"></script>

    <!-- Demo scripts for this page-->
    <script src="../../js/demo/datatables-demo.js"></script>
    <script src="../../js/demo/chart-area-demo.js"></script>

	<script type="text/javascript">
		$('#btnsample2').click(function(){
			$('#mtable').load('sampleserver.php');
			//history.pushState({},"","?MWRFID="+1+1);
			alert("sdsd");
		});
		$('#btnsample3').click(function(){
			window.location.href="sample.php?MWRF="+21;
          //history.pushState({},"","?MWRF="+21);
			//history.pushState({},"","?MWRFID="+1+2);
			alert("sdsd");
			//window.location.search += 'MWRFID='+21;
			
		});
	</script>

	
</body>
</html>