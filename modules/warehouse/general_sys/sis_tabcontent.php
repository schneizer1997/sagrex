<?php
//session_start();
/*include('../../../classes/inc/dbConInventory.php');*/
include('../../../classes/inc/dbCon.php');
require('warehouse.common.php');
$xajax->printJavascript('../../../classes/xajax');
date_default_timezone_set("Asia/Manila");

if (isset($_SESSION['username'])){
	$username=$_SESSION['username'];
	$userid=$_SESSION['userinfoid'];
	$iduser=$_SESSION['user_id'];
}else{
	header('location: ../../../login/login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<!-- <link href="../../../vendor/bootstrap/css/bootstrap-select.css" rel="stylesheet">
<link href="../../../vendor/bootstrap/css/bootstrap-select.min.css" rel="stylesheet">
<link href="../../../vendor/bootstrap/css/jquery-editable-select.css" rel="stylesheet">
<link href="../../../vendor/bootstrap/css/jquery-editable-select.min.css" rel="stylesheet"> -->
<!-- 
<link rel="stylesheet" href="//code.<jquery class="co"></jquery>m/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css"> -->

<body id="page-top">
	<!-- <button id="btncreatenew" class="btn btn-primary" style="float: right;">
		<i style="padding-right: 5px;" class="fas fa-folder"></i>Create New
	</button><br><br> -->
	<!-- RR TABLE -->
	<div class="card mb-3">
		<div class="card-header" style="background-color: #3399CC;color: white;">
			<i class="fas fa-table"></i>
		MWRF RR/SIS Table</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-hover" id="tblsisinfo" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>SIS No</th>
							<th>RR No</th>
							<th>Reference</th>
							<th><center>Date Created</center></th>
							<!-- <th>Action</th> -->
						</tr>
					</thead>
					<tbody>
						<?php
						include('tables/sis_load.php');
						?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
	</div>
	<!-- END RR -->

	<!-- Modal for creating -->
	<div class="modal fade bd-example-modal-lg" id="rrsismodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" style="width: auto;">
			<div class="modal-content" style="width: 1350px;margin-left: -270px;min-height: 700px;">
				<div class="modal-header" style="background-color: #17A2B8;color:white;">
					<h5 class="modal-title" id="formModalLabel"><strong>RR</strong></h5>
					<button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnFormClose" style="border:0px;color: white;"><i class="fa fa-close"></i></button>
				</div>
				<form method="POST" enctype="multipart/form-data">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="margin:-10px;">
						<table class="table table-bordered">
							<tr>
								<td colspan="4" style="border:1px solid #17A2B8;"><strong>Receiving Receipt</strong></td>
								<!-- <td colspan="3" style="border:1px solid #17A2B8;width: 10px;"><strong>Stock Issue Slip</strong></td> -->

								<!-- <td style="border:1px solid #17A2B8;"><strong>Stock Issue Slip</strong></td> -->
							</tr>
							<div class="">
								<td rowspan="" style="border:0px solid #17A2B8;" id="rrleft">
									<div>
										<label style="height: 30px;margin-left: 10px;">RRNO: </label>
									</div>
									<br>
									<div>
										<label style="height: 30px;margin-left: 10px;">Vendor/Market: </label>

									</div><br>
									<div>
										<label style="height: 30px;margin-left: 10px;">Address: </label>

									</div>
									<br>
									<div>
										<label style="height: 30px;margin-left: 10px;">Client Date:</label>

									</div>
									<br>
									

								</td>
								<!-- Input Value -->
								<!-- Input for Request Details -->   
								<td rowspan="1" style="border:0px solid #17A2B8;width: 100px;" id="rrright">
									<div>
										<input type="text" name="txtrrno" class="form-control" id="txtrrno"   placeholder="" style="height: 35px;width: 300px;">
									</div>
									<br>
									<div>
										<input type="text" id="txtvendor" name="txtvendor" class="form-control">
										<input type="hidden" id="txtvendorid" name="txtvendorid" class="form-control">

										<?php
										global $dbinv;
										$sql = "SELECT *FROM tblcustomer";
										$result=$dbinv->query($sql);
										$c=1;

										if ($result->num_rows > 0 ){
											while ($row=$result->fetch_assoc()){
												$c++;
											}
										}
										echo "<input type = 'hidden'  value= '".$c."' id = 'txtlastvendorid'";
										?>
									</div><br>
									<div>
										<input type="text" id="txtaddr" name="txtaddr" class="form-control" autocomplete="off">
										<input type="hidden" id="txtaddrid" name="txtaddrid" class="form-control" autocomplete="off">

										<?php
										global $dbinv;
										$sql = "SELECT *FROM tbladdress";
										$result=$dbinv->query($sql);
										$c=1;
										if ($result->num_rows > 0 ){
											while ($row=$result->fetch_assoc()){
												$c++;
											}
										}
										echo "<input type = 'hidden' id = 'txtlastaddrid' value = '".$c."'";
										?>
									</div><br>

									<div>
										<input type="date" name="txtclientdate" class="form-control" id="txtclientdate" placeholder="Plate/Machine No." style="height: 35px;width: 300px;">
									</div><br>

									
									


									<br>
								</td>

								<td style="border:0px solid #17A2B8;" width="10%" id="sisleft">
									<div >
										<label style="height: 30px;margin-left: 10px;">Reference: </label>

									</div>
									<br>
									<div>
										<label style="height: 30px;margin-left: 10px;">Warehouseman: </label>

									</div>
									<br>
									<div>
										<label style="height: 30px;margin-left: 10px;">Department: </label>

									</div>
									<br>

									<td style="border:0px solid #17A2B8;min-width: 300px;" id="siscenter">
										<div>
											<input type="text" name="txtreferencerr" class="form-control" id="txtreferencerr" placeholder="" style="height: 35px;width: 300px;">
										</div><br>
										<div>
											<?php
											global $dbinv;
											$sql = "SELECT *FROM tblpersonnel_ware WHERE isdelete =1 and category_id = 1 ORDER BY fullname_ware ASC";
											$result=$dbinv->query($sql);
											$c=1;

											echo '<select class="form-control" id="cbowarehouseman">';
											echo '<option value= "0" selected disabled>- Select -</option>';
											if ($result->num_rows > 0 ){
												while ($row=$result->fetch_assoc()){
													echo '<option value= "'.$row['pers_id'].'">'.$row['fullname_ware'].'</option>';
												}
											}
											echo '</select>';

											?>

										</div><br>
										<div>
											<!-- <input type="text" name="txtdept" class="form-control" id="txtdept" placeholder="" style="height: 35px;width: 300px;"> -->
											<?php
											global $dbinv;
											$sql = "SELECT *FROM tblpersonnel_dept WHERE isdelete =1 ORDER BY fullname_dept ASC";
											$result=$dbinv->query($sql);
											$c=1;

											echo '<select class="form-control" id="cbodept">';
											echo '<option value= "0" selected disabled>- Select -</option>';
											if ($result->num_rows > 0 ){
												while ($row=$result->fetch_assoc()){
													echo '<option value= "'.$row['pers_id'].'">'.$row['fullname_dept'].'</option>';
												}
											}
											echo '</select>';

											?>
										</div><br>
										<div>
											<button type="button" id="btnrrsave" class="btn btn-primary">SAVE</button>
											<button type="button" id="btnrrupdate" class="btn btn-primary">UPDATE</button>
											<button type="button" id="btnrrdelete" class="btn btn-primary">DELETE</button>
										</div><br>
									</td>
								</td>
								

							</tr><br/>
						</td>
					</td>
				</tr>
				<tr>

				</tr>
				<!-- <form action="iframes/mwrf_items.php" method="GET" enctype="multipart/form-data">
					<table width="100%">
						<tr>
							<td style="border: 1px solid #17A2B8;" id="tdparticulars">
								<div class="col-sm-10">
									<label>Particulars</label>
									<input type="text" id="txtparticulars" name="txtparticulars" class="form-control">

								</div>
							</td>
							<td style="border: 1px solid #17A2B8;" >
								<label>Qty</label>
								<input type="text" id="txtqty" name="txtqty" class="form-control" style="width: 100px;">
							</td>
							<td style="border: 1px solid #17A2B8;">
								<label>Unit</label>
								<select class="form-control" id="cbounit">
									<option></option>
								</select>
							</td>
							<td style="border: 1px solid #17A2B8;" >
								<label>Unit Cost</label>
								<input type="text" id="txtunitcost" name="" class="form-control" >
							</td>
							<td style="border: 1px solid #17A2B8;" >
								<label>Amount</label>
								<input type="text" id="txtamount" name="" class="form-control" >
							</td>
							<td style="border: 1px solid #17A2B8;">
								<button type="button" id="btnsaveitem" class="btn btn-primary">SAVE</button>
							</td>
						</tr>
					</table>
				</form> -->
				<form action="iframes/mwrf_items.php" method="GET" enctype="multipart/form-data">
					<table width="100%">
						<tr>
							<td colspan="3" width="70%" style="border: 1px solid #17A2B8;height: 300px;" id="tditemsrr">
								<table class="table table-bordered table-striped" id="mtable1" cellspacing="0">
									<tbody id="mtable2">
										<iframe style="border: 0px;margin-top: 0px;" width="100%" height="100%" name="framemat" id="framemat" src="iframes/mwrf_items.php?mwrfid=" /></iframe>
									</tbody>
								</table>
							</td>
							<td colspan="3" width="50%" style="border: 1px solid #17A2B8;height: 300px;" id="tditemsrr">
								<table class="table table-bordered" id="mtable1" cellspacing="0">
									<tbody id="mtable2">
										<iframe width="100%" height="100%" style="border: 0px;margin-top: 0px;" name="framemat2" id="framemat2" src="iframes/mwrf_items_rr.php?matid=" /></iframe>
									</tbody>
								</table>
							</td>
						</tr>
					</table>
				</form>
				<!-- <tr>
					<td colspan="5">
						<div class="modal-footer">
							<button type="button" class="btn btn-info" id="btnnewrr"><i style="padding-right: 5px;" class="fas fa-save"></i>Create</button>
							<button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnFormClose"><i style="padding-right: 5px;" class="fa fa-close"></i>Close</button>
						</div>
					</td>
				</tr> -->

			</table>
		</table>

	</form>
</div>
</div>
</div>
<!-- END RR -->

<!-- Modal for creating -->
<div class="modal fade bd-example-modal-lg" id="sismodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" style="width: 1350px;margin-left: -270px;min-height: 700px;">
			<div class="modal-header" style="background-color: #17A2B8;color:white;">
				<h5 class="modal-title" id="formModalLabel"><strong>SIS</strong></h5>
				<button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnFormClose" style="border:0px;color: white;"><i class="fa fa-close"></i></button>
			</div>
			<form action="rr_tabcontent.php" method="POST" enctype="multipart/form-data">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="margin:-10px;">
					<table class="table table-bordered">
						<tr>
							<td colspan="4" style="border:1px solid #17A2B8;"><strong>Receiving Receipt</strong></td>
							<!-- <td colspan="3" style="border:1px solid #17A2B8;width: 10px;"><strong>Stock Issue Slip</strong></td> -->

							<!-- <td style="border:1px solid #17A2B8;"><strong>Stock Issue Slip</strong></td> -->
						</tr>
						<div class="">
							<td rowspan="" style="border:0px solid #17A2B8;" id="rrleft">
								<div>
									<label style="height: 30px;margin-left: 10px;">Date Issued: </label>
								</div>
								<br>
								<div>
									<label style="height: 30px;margin-left: 10px;">RR No.: </label>

								</div><br>
								<div>
									<label style="height: 30px;margin-left: 10px;">SIS NO.: </label>

								</div><br>
								<div>
									<label style="height: 30px;margin-left: 10px;">Customer: </label>

								</div>
								<br>
								<div>
									<label style="height: 30px;margin-left: 10px;">Issued Address:</label>

								</div>
								<br>



							</td>
							<!-- Input Value -->
							<!-- Input for Request Details -->   
							<td rowspan="1" style="border:0px solid #17A2B8;width: 100px;" id="rrright">
								<div>
									<input type="date" name="txtdateissued" class="form-control" id="txtdateissued"  placeholder="" style="height: 35px;width: 300px;">
								</div>
								<br>
								<div>
									<input type="text" id="txtissuedno" name="txtissuedno" class="form-control" disabled="true">

									<input type="hidden" id="txtsiscustid" name="txtsiscustid" class="form-control">

									<!-- <div id="result" class="alert alert-success">wew</div> -->
									<?php
									global $dbinv;
									$sql = "SELECT *FROM tblcustomer";
									$result=$dbinv->query($sql);
									$c=1;

									if ($result->num_rows > 0 ){
										while ($row=$result->fetch_assoc()){
											$c++;
										}
									}
									echo "<input type = 'hidden'  value= '".$c."' id = 'txtlastcustid'";
									?>
								</div><br>
								<div>
									<input type="text" id="txtsisno" name="txtsisno" class="form-control">
								</div>
								<br>

								<div>
									<input type="text" id="txtsiscust" name="txtsiscust" class="form-control" autocomplete="off">
									<input type="hidden" id="txtsisaddrid" name="txtsisaddrid" class="form-control" autocomplete="off">

									<?php
									global $dbinv;
									$sql = "SELECT *FROM tbladdress";
									$result=$dbinv->query($sql);
									$c=1;
									if ($result->num_rows > 0 ){
										while ($row=$result->fetch_assoc()){
											$c++;
										}
									}
									echo "<input type = 'hidden' id = 'txtlastaddridsis' value = '".$c."'";
									?>
								</div><br>

								<div>
									<input type="text" name="txtsisaddr" class="form-control" id="txtsisaddr" style="height: 35px;width: 300px;">
								</div><br>





								<br>
							</td>

							<td style="border:0px solid #17A2B8;" width="10%" id="sisleft">
								<div >
									<label style="height: 30px;margin-left: 10px;">Location: </label>

								</div>
								<br>
								<div>
									<label style="height: 30px;margin-left: 10px;">Reference: </label>

								</div>
								<br>
								<div>
									<label style="height: 30px;margin-left: 10px;">Remarks: </label>

								</div>
								<br>

								<td style="border:0px solid #17A2B8;min-width: 300px;" id="siscenter">
									<div>
										<input type="text" name="txtlocationsis" class="form-control" id="txtlocationsis" placeholder="" style="height: 35px;width: 300px;">
									</div><br>
									<div>
										<input type="text" name="txtreferencesis" id="txtreferencesis" class="form-control" style="height: 35px;width: 300px;">

									</div><br>
									<div>
										<!-- <input type="text" name="txtdept" class="form-control" id="txtdept" placeholder="" style="height: 35px;width: 300px;"> -->
										<input type="text" name="txtremarksis" id="txtremarksis" class="form-control" style="height: 35px;width: 300px;">
									</div><br>
									<div>
										<button type="button" id="btnsissave" class="btn btn-primary">SAVE</button>
										<button type="button" id="btnsisupdate" class="btn btn-primary">UPDATE</button>
										<button type="button" id="btnsisdelete" class="btn btn-primary">DELETE</button>
									</div><br>
								</td>
							</td>


						</tr><br/>
					</td>
				</td>
			</tr>
			<tr>
					<!-- <td colspan="5" style="border: 1px solid #17A2B8;" id="tdsearch">
						
						<div class="form-group row">
							<label style="margin-left: 20px;">MWRF No:</label>
							<input class="form-control" type="text" name="txtmwrfsearch" id="txtmwrfsearch" style="width: 200px;margin-left: 10px;">
							<button type="button" class="btn btn-info" style="margin-left: 10px;" id="btnsearch">Search</button>
						</div>
						
					</td> -->
				</tr>
				<!-- <form action="iframes/mwrf_items.php" method="GET" enctype="multipart/form-data">
					<table width="100%">
						<tr>
							<td style="border: 1px solid #17A2B8;" id="tdparticulars">
								<div class="col-sm-10">
									<label>Particulars</label>
									<input type="text" id="txtparticularssis" name="txtparticulars" class="form-control">
									
								</div>
							</td>
							<td style="border: 1px solid #17A2B8;" >
								<label>Qty</label>
								<input type="text" id="txtqtysis" name="txtqtysis" class="form-control" style="width: 100px;">
							</td>
							<td style="border: 1px solid #17A2B8;">
								<label>Unit</label>
								<select class="form-control" id="cbounitsis">
									<option></option>
								</select>
							</td>
							<td style="border: 1px solid #17A2B8;" >
								<label>Unit Cost</label>
								<input type="text" id="txtunitcostsis" name="" class="form-control" >
							</td>
							<td style="border: 1px solid #17A2B8;" >
								<label>Amount</label>
								<input type="text" id="txtamountsis" name="" class="form-control" >
							</td>
							<td style="border: 1px solid #17A2B8;">
								<button type="button" id="btnsaveitemsis" class="btn btn-primary">SAVE</button>
							</td>
						</tr>
					</table>
				</form> -->
				<form action="iframes/mwrf_items.php" method="GET" enctype="multipart/form-data">
					<table width="100%">
						<tr>
							<td colspan="3" width="60%" style="border: 1px solid #17A2B8;height: 300px;" id="tditemsrr">
								<table class="table header-fixed table-bordered table-striped" id="mtable1" cellspacing="0">

									<tbody id="mtable2" style="">
										<iframe style="border: 0px;margin-top: 0px;" width="100%" height="100%" name="framemat3" id="framemat3" src="iframes/mwrf_items2.php?mwrfid=" />
									</iframe>
								</tbody>
							</table>
						</td>
						<td colspan="3" width="50%" style="border: 1px solid #17A2B8;height: 300px;" id="tditemsrr">
							<table class="table table-bordered" id="mtable1" cellspacing="0">

								<tbody id="mtable2">
									<iframe width="100%" height="100%" style="border: 0px;margin-top: 0px;" name="framemat4" id="framemat4" src="iframes/mwrf_items2_sis.php?matid=&rrno=" /></iframe>
								</tbody>
							</table>
						</td>
					</tr>
				</table> 
			</form>
			<!-- <tr>
				<td colspan="5">
					<div class="modal-footer">
						<button type="button" class="btn btn-info" id="btnnewrr"><i style="padding-right: 5px;" class="fas fa-save"></i>Create</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnFormClose"><i style="padding-right: 5px;" class="fa fa-close"></i>Close</button>
					</div>
				</td>
			</tr> -->

		</table>
	</table>

</form>
</div>
</div>
</div>
<!-- END RR -->


<!-- <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script> -->
<script src="../../../vendor/jquery/jquery.min.js"></script>
<script src="../../../vendor/jquery/jquery-ui.js"></script>
<script src="../../../vendor/jquery/jquery-ui.min.js"></script>
<!-- <script src="//code.jquery.com/jquery-2.1.4.min.js" type="text/javascript"></script> -->
<script src="../../../vendor/bootstrap/js/bootstrap.bundle.min.js" type="text/javascript"></script>

<script src="../../../vendor/jquery-easing/jquery.easing.min.js" type="text/javascript"></script>

<script src="../../../vendor/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="../../../vendor/datatables/dataTables.bootstrap4.js" type="text/javascript"></script>

<script src="../../../js/sb-admin.min.js" type="text/javascript"></script>
<script src="../../../vendor/jquery/jquery.datetimepicker.js" type="text/javascript"></script>

<script src="../../../js/demo/datatables-demo.js" type="text/javascript"></script>
<!-- <script src="../../../vendor/bootstrap/js/bootstrap-select.min.js" type="text/javascript"></script>
<script src="../../../vendor/bootstrap/js/bootstrap-select.js" type="text/javascript"></script>
<script src="../../../vendor/bootstrap/js/jquery-editable-select.js" type="text/javascript"></script>
<script src="../../../vendor/bootstrap/js/jquery-editable-select.min.js" type="text/javascript"></script> -->
<script src="../../../vendor/bootstrap/js/bootstrap3-typeahead.min.js" type="text/javascript"></script>
<script src="../../../vendor/bootstrap/js/bootstrap3-typeahead.js" type="text/javascript"></script>
<script src="../../../vendor/bootstrap/js/jquery.autocomplete.js" type="text/javascript"></script>
<script src="../../../vendor/bootstrap/js/jquery.autocomplete.min.js" type="text/javascript"></script>
<script type="text/javascript">
	var currdate;
	var currtime;
	currdate = new Date();
	currdate = currdate.getFullYear() + '-' +
	('00' + (currdate.getMonth()+1)).slice(-2) + '-' +
	('00' + currdate.getDate()).slice(-2);

	currtime = new Date();
	currtime = ('00' + currtime.getHours()).slice(-2) + ':' + 
	('00' + currtime.getMinutes()).slice(-2) + ':' + 
	('00' + currtime.getSeconds()).slice(-2);

</script>
</body>
</html>