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
				<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>MWRF ID</th>
							<th>Materials</th>
							<th>Requested by</th>
							<th><center>Date File</center></th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						include('tables/mwrf_load.php');
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
											<button type="button" id="btnrrsave" class="btn btn-primary"><i class="fas fa-save" style="margin-right: 5px;"></i>SAVE</button>
											<button type="button" id="btnrrupdate" class="btn btn-success" disabled><i class="fa fa-refresh" style="margin-right: 5px;" ></i>UPDATE</button>
											
											<button type="button" id="btnrrdelete" class="btn btn-danger" disabled>DELETE</button>
										</div>
										<br>
										<div style="float:right;">
											<button type="button" id="btnprintrr" class="btn btn-primary"><i class="fas fa-print" style="margin-right: 5px;"></i>PRINT RR</button>
										</div>
										<br>
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
							<div style="border: 0px solid black;display:table;height: 20;width: 100%;">
								<div style="border: 0px solid black;float: left;width: 70%;"><b style="margin-left:10px;">TO ISSUE:</b><a style="color:red;">&nbsp;(Note: Select a Material/Item first to ISSUE a RR)</a></div>
								<div style="border: 0px solid black;float: left;width: 30%;"><b style="margin-left:10px;">ISSUED RR:</b><a style="color:red;">&nbsp;(Note: All RR issued per Item)</a></div>
							</div>
							
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
							<td colspan="6" style="border:1px solid #17A2B8;"><strong>Stock Issued</strong></td>
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
								<div>
									<label style="height: 30px;margin-left: 10px;">Prepared By: </label>

								</div>
								<br>
								<div>
									<label style="height: 30px;margin-left: 10px;">Received By: </label>

								</div>
								<br>

								<td style="border:0px solid #17A2B8;width: 150px;" id="siscenter">
									<div>
										<input type="text" name="txtlocationsis" class="form-control" id="txtlocationsis" placeholder="" style="height: 35px;width: 300px;">
									</div><br>
									<div>
										<input type="text" name="txtreferencesis" id="txtreferencesis" class="form-control" style="height: 35px;width: 300px;">

									</div><br>
									<div>
										<!-- <input type="text" name="txtdept" class="form-control" id="txtdept" placeholder="" style="height: 35px;width: 300px;"> -->
										<input type="text" name="txtremarksis" id="txtremarksis" class="form-control" style="height: 35px;width: 300px;">
									</div>
									<br>
									<?php
											global $dbinv;
											$sql = "SELECT *FROM tbl_sis_preparedby ORDER BY PreparedBy ASC";
											$result=$dbinv->query($sql);
											$c=1;

											echo '<select class="form-control" id="cboprepby">';
											echo '<option value= "0" selected disabled>- Select -</option>';
											if ($result->num_rows > 0 ){
												while ($row=$result->fetch_assoc()){
													echo '<option>'.$row['PreparedBy'].'</option>';
												}
											}
											echo '</select>';

											?><br>
									<?php
											global $dbinv;
											$sql = "SELECT *FROM tbl_sis_receivedby ORDER BY ReceivedBy ASC";
											$result=$dbinv->query($sql);
											$c=1;

											echo '<select class="form-control" id="cborecby">';
											echo '<option value= "0" selected disabled>- Select -</option>';
											if ($result->num_rows > 0 ){
												while ($row=$result->fetch_assoc()){
													echo '<option>'.$row['ReceivedBy'].'</option>';
												}
											}
											echo '</select>';

											?><br>
									
									
									
									
									<div>
										<button type="button" id="btnsissave" class="btn btn-primary"><i class="fas fa-save" style="margin-right: 5px;"></i>SAVE</button>
										<button type="button" id="btnsisupdate" class="btn btn-success" disabled><i class="fa fa-refresh" style="margin-right: 5px;"></i>UPDATE</button>
										<!-- <button type="button" id="btnsisdelete" class="btn btn-primary">DELETE</button> -->
										<!-- <button type="button" id="btnsisprint" class="btn btn-success" style="float: right;" ><i class="fas fa-print" style="margin-right: 5px;"></i>PRINT</button> -->
									</div><br>
									
								</td>
								<td style="border:0px solid red;width: 5px;">
									
									<div>
										<!-- <input type="text" name="txtreferencesis" id="txtreferencesis" class="form-control" style="height: 35px;width: 150px;"> -->
										<label>Noted By:</label>

									</div>
									<br>
								</td>
								<td style="border:0px solid red;min-width: 50px;">
									<?php
											global $dbinv;
											$sql = "SELECT *FROM tbl_sis_notedby ORDER BY SISNotedBy ASC";
											$result=$dbinv->query($sql);
											$c=1;

											echo '<select class="form-control" id="cbonotedby">';
											echo '<option value= "0" selected disabled>- Select -</option>';
											if ($result->num_rows > 0 ){
												while ($row=$result->fetch_assoc()){
													echo '<option>'.$row['SISNotedBy'].'</option>';
												}
											}
											echo '</select>';

											?>
									<br>
									<br>
									<br>
									<br>
									<br>
									<br>
									<br>
									<br>
									<br>
									<br>
									<br>
									<br>
									<br>
									<button type="button" id="btnsisprint" class="btn btn-success" style="float: right;" ><i class="fas fa-print" style="margin-right: 5px;"></i>PRINT</button>

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
							<div style="border: 0px solid black;display:table;height: 20;width: 100%;">
								<div style="border: 0px solid black;float: left;width: 60%;"><b style="margin-left:10px;">TO ISSUE:</b><a style="color:red;">&nbsp;(Note: Select a RR first to ISSUE a SIS)</a></div>
								<div style="border: 0px solid black;float: left;width: 40%;"><b style="margin-left:10px;">ISSUED SIS:</b><a style="color:red;">&nbsp;(Note: All SIS issued per RR)</a></div>
							</div>
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
	var mwrf_id = "";
	var mwrf_mat_id = "";
	
	function viewrrsis(mwrfid){ //rr
		mwrf_id = mwrfid;
		//alert(mwrfid);
		//var appendurl = $('#txtmwrfsearch').val(mwrfid);
		history.replaceState("","","?mwrfid=" + mwrfid);
		var myFrame = $('#framemat');
		var url = $(myFrame).attr('src')+"?mwrfid="+mwrfid;

		var loc = url;
		var params = loc.split('?')[1];
		document.getElementById("framemat").src = 'iframes/mwrf_items.php?mwrfid=' + mwrfid;
		$('#rrsismodal').modal('show');
		document.getElementById("framemat2").src = 'iframes/mwrf_items_rr.php?matid=';
		$('#btnrrupdate').attr('disabled','disabled');
		$('#btnprintrr').attr('disabled','disabled');
		$('#btnrrdelete').attr('disabled','disabled');
		$('#btnrrsave').attr('disabled','disabled');
		//$('#btnrrsave').removeAttr('disabled');
		$('#txtrrno').val("");
		$('#txtaddr').val("");
		$('#txtreferencerr').val("");
		$('#txtvendor').val("");

		$( "#txtrrno" ).prop( "disabled", true );
		$( "#txtaddr" ).prop( "disabled", true );
		$( "#txtreferencerr" ).prop( "disabled", true );
		$( "#txtvendor" ).prop( "disabled", true );
		$( "#txtclientdate" ).prop( "disabled", true );
		$( "#cbowarehouseman" ).prop( "disabled", true );
		$( "#cbodept" ).prop( "disabled", true );



	}
	function viewsis(mwrfid){ //sis

		$('#txtsiscust').val("");
		$('#txtsiscustid').val("");
		$('#txtsisaddr').val("");
		$('#txtsisaddrid').val("");
		$('#txtsisno').val("");
		$('#txtlocationsis').val("");
		$('#txtreferencesis').val("");
		$('#txtremarksis').val("");

		$('#btnsisupdate').attr('disabled','disabled');
		$('#btnsissave').attr('disabled','disabled');

		$( "#txtsiscust" ).prop( "disabled", true );
		$( "#txtsiscustid" ).prop( "disabled", true );
		$( "#txtsisaddr" ).prop( "disabled", true );
		$( "#txtsisaddrid" ).prop( "disabled", true );
		$( "#txtsisno" ).prop( "disabled", true );
		$( "#txtlocationsis" ).prop( "disabled", true );
		$( "#txtreferencesis" ).prop( "disabled", true );
		$( "#txtremarksis" ).prop( "disabled", true );
		$( "#cboprepby" ).prop( "disabled", true );
		$( "#cborecby" ).prop( "disabled", true );
		$( "#cbonotedby" ).prop( "disabled", true );
		$( "#txtdateissued" ).prop( "disabled", true );
		//$('#btnsissave').removeAttr('disabled');

		mwrf_id = mwrfid;

		history.replaceState("","","?mwrfid=" + mwrfid);
		var myFrame = $('#framemat3');
		var url = $(myFrame).attr('src')+"?mwrfid="+mwrfid;

		var loc = url;
		var params = loc.split('?')[1];
		document.getElementById("framemat3").src = 'iframes/mwrf_items2.php?mwrfid=' + mwrfid;
		$('#sismodal').modal('show');
		document.getElementById("framemat4").src = 'iframes/mwrf_items2_sis.php?matid=' + " & rrno=";
	}
	var rrnos = "";
	//alert(rrnos);
	var countrr = "";
	function selectmaterial(material,qty,up,amount,matid,rrno,vendor_id,addr_id,reference,pers_id_ware,pers_id_dept,client_date,cust_name,cust_addr,fullname_ware,fullname_dept,c){
		//var text = $("select[name=cboparticulars] option[value='1']").text();
		//$('.bootstrap-select .filter-option').text(material);
		//$('select[name=cboparticulars]').val(material);
		//alert(matid);
		rrnos = rrno;
		countrr = c;
		mwrf_mat_id = matid;
		//alert(matid);
		$('#txtparticulars').val(material);
		$('#txtqty').val(qty);
		$('#txtunitcost').val(up);
		$('#txtamount').val(amount);

		$('#txtrrno').val("");
		$('#txtaddr').val("");
		$('#txtreferencerr').val("");
		$('#txtvendor').val("");

		$('#btnrrsave').attr('enable','enable');

		$( "#txtrrno" ).prop( "disabled", false );
		$( "#txtaddr" ).prop( "disabled", false );
		$( "#txtreferencerr" ).prop( "disabled", false );
		$( "#txtvendor" ).prop( "disabled", false );
		$( "#txtclientdate" ).prop( "disabled", false );
		$( "#cbowarehouseman" ).prop( "disabled", false );
		$( "#cbodept" ).prop( "disabled", false );


		/*$('#txtrrno').val(rrno);
		$('#txtvendorid').val(vendor_id);
		$('#txtaddrid').val(addr_id);
		$('#txtvendor').val(cust_name);
		$('#txtaddr').val(cust_addr);
		$('#txtreferencerr').val(reference);
		
		$("select#cbowarehouseman option").each(function() { this.selected = (this.text == fullname_ware); });
		$("select#cbodept option").each(function() { this.selected = (this.text == fullname_dept); });*/
		//$('#cbowarehouseman option:selected').val(cust_name);
		//$('#cbowarehouseman').children("option:selected").val(pers_id_ware);
		//$( "#cbowarehouseman option:selected" ).text(pers_id_ware);

		history.replaceState("","","?matid=" + matid);
		var myFrame = $('#framemat2');
		var url = $(myFrame).attr('src')+"?matid="+matid;

		var loc = url;
		var params = loc.split('?')[1];
		document.getElementById("framemat2").src = 'iframes/mwrf_items_rr.php?matid=' + matid;
	}
	function selectmaterialdelete(material,qty,up,amount,matid,rrno,vendor_id,addr_id,reference,pers_id_ware,pers_id_dept,client_date,cust_name,cust_addr,fullname_ware,fullname_dept,c){
		//var text = $("select[name=cboparticulars] option[value='1']").text();
		//$('.bootstrap-select .filter-option').text(material);
		//$('select[name=cboparticulars]').val(material);
		//alert(matid);
		rrnos = rrno;
		countrr = c;
		mwrf_mat_id = matid;
		//alert(matid);
		$('#txtparticulars').val(material);
		$('#txtqty').val(qty);
		$('#txtunitcost').val(up);
		$('#txtamount').val(amount);

		$('#txtrrno').val("");
		$('#txtaddr').val("");
		$('#txtreferencerr').val("");
		$('#txtvendor').val("");

		$('#btnrrsave').attr('enable','enable');

		$( "#txtrrno" ).prop( "disabled", false );
		$( "#txtaddr" ).prop( "disabled", false );
		$( "#txtreferencerr" ).prop( "disabled", false );
		$( "#txtvendor" ).prop( "disabled", false );
		$( "#txtclientdate" ).prop( "disabled", false );
		$( "#cbowarehouseman" ).prop( "disabled", false );
		$( "#cbodept" ).prop( "disabled", false );


		/*$('#txtrrno').val(rrno);
		$('#txtvendorid').val(vendor_id);
		$('#txtaddrid').val(addr_id);
		$('#txtvendor').val(cust_name);
		$('#txtaddr').val(cust_addr);
		$('#txtreferencerr').val(reference);
		
		$("select#cbowarehouseman option").each(function() { this.selected = (this.text == fullname_ware); });
		$("select#cbodept option").each(function() { this.selected = (this.text == fullname_dept); });*/
		//$('#cbowarehouseman option:selected').val(cust_name);
		//$('#cbowarehouseman').children("option:selected").val(pers_id_ware);
		//$( "#cbowarehouseman option:selected" ).text(pers_id_ware);

		history.replaceState("","","?matid=" + matid);
		var myFrame = $('#framemat2');
		var url = $(myFrame).attr('src')+"?matid="+matid;

		var loc = url;
		var params = loc.split('?')[1];
		document.getElementById("framemat2").src = 'iframes/mwrf_items_rr.php?matid=' + matid;

		Swal.fire({
			title: 'Are you sure you want to delete?',
			text: "You won't be able to revert this!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, remove it!'
		}).then((result) => {
			if (result.value) {
				$.ajax({
					url: xajax_deletemwrfrr(matrrid),
					complete: function(data)
					{
						Swal.fire({
							type: 'success',
							title: '',
							text: 'Material/Item has been Deleted.'
						})
						document.getElementById('framemat2').contentWindow.location.reload();
						document.getElementById('framemat').contentWindow.location.reload();
						//$("#tablerows").load("tables/items_new_load.php");

					}
				});
			}
		})
	}
	var countrrbal = "";
	var matrrid = "";
	function selectmaterialbal(mat_rr_id,material,qty,up,amount,matid,rrno,vendor_id,addr_id,reference,pers_id_ware,pers_id_dept,client_date,cust_name,cust_addr,fullname_ware,fullname_dept,c){
		//var text = $("select[name=cboparticulars] option[value='1']").text();
		//$('.bootstrap-select .filter-option').text(material);
		//$('select[name=cboparticulars]').val(material);
		//alert(matid);
		rrnos = rrno;
		countrrbal = c;
		mwrf_mat_id = matid;
		matrrid = mat_rr_id;
		//alert(matrrid);
		//alert(matid);
		$('#txtparticulars').val(material);
		$('#txtqty').val(qty);
		$('#txtunitcost').val(up);
		$('#txtamount').val(amount);

		$('#txtrrno').val(rrno);
		$('#txtvendorid').val(vendor_id);
		$('#txtaddrid').val(addr_id);
		$('#txtvendor').val(cust_name);
		$('#txtaddr').val(cust_addr);
		$('#txtreferencerr').val(reference);
		$('#txtclientdate').val(client_date);
		//alert(addr_id + "-"+cust_addr);
		
		$("select#cbowarehouseman option").each(function() { this.selected = (this.text == fullname_ware); });
		$("select#cbodept option").each(function() { this.selected = (this.text == fullname_dept); });
		//$('#cbowarehouseman option:selected').val(cust_name);
		//$('#cbowarehouseman').children("option:selected").val(pers_id_ware);
		//$( "#cbowarehouseman option:selected" ).text(pers_id_ware);

		history.replaceState("","","?matid=" + matid);
		var myFrame = $('#framemat2');
		var url = $(myFrame).attr('src')+"?matid="+matid;

		var loc = url;
		var params = loc.split('?')[1];
		document.getElementById("framemat2").src = 'iframes/mwrf_items_rr.php?matid=' + matid;
	}
	var countsis = "";
	function selectmaterialsis(rrno,materialsid,c){
		//var text = $("select[name=cboparticulars] option[value='1']").text();
		//$('.bootstrap-select .filter-option').text(material);
		//$('select[name=cboparticulars]').val(material);
		//alert(matid);
		//alert(cust_name);
		/*var id = $(this).closest("tr").find('td:eq(2)').text();
		alert(id);*/
		//alert(c);
		countsis = c;
		rrnos = rrno;
		mwrf_mat_id = materialsid;
		/*$('#txtparticularssis').val(materials);
		$('#txtqtysis').val(qty);
		$('#txtunitcostsis').val(up);
		$('#txtamountsis').val(amount);

		$('#txtdateissued').val(issued_date);*/
		$('#txtissuedno').val(rrnos);
		$('#txtsiscust').val("");
		$('#txtsiscustid').val("");
		$('#txtsisaddr').val("");
		$('#txtsisaddrid').val("");
		$('#txtsisno').val("");
		$('#txtlocationsis').val("");
		$('#txtreferencesis').val("");
		$('#txtremarksis').val("");

		$('#btnsissave').attr('enable','enable');

		$( "#txtsiscust" ).prop( "disabled", false );
		$( "#txtsiscustid" ).prop( "disabled", false );
		$( "#txtsisaddr" ).prop( "disabled", false );
		$( "#txtsisaddrid" ).prop( "disabled", false );
		$( "#txtsisno" ).prop( "disabled", false );
		$( "#txtlocationsis" ).prop( "disabled", false );
		$( "#txtreferencesis" ).prop( "disabled", false );
		$( "#txtremarksis" ).prop( "disabled", false );
		$( "#cboprepby" ).prop( "disabled", false );
		$( "#cborecby" ).prop( "disabled", false );
		$( "#cbonotedby" ).prop( "disabled", false );
		$( "#txtdateissued" ).prop( "disabled", false );
		//alert(addr_id);

		history.replaceState("","","?matid=" + materialsid + " & rrno=" + rrno);
		var myFrame = $('#framemat4');
		var url = $(myFrame).attr('src')+"?matid="+materialsid + " & rrno=" + rrno;

		var loc = url;
		var params = loc.split('?')[1];
		document.getElementById("framemat4").src = 'iframes/mwrf_items2_sis.php?matid=' + materialsid+ " & rrno=" + rrno;
	}
	function selectmaterialsisviews(rrno,issued_date,issued_nos,addr_id,addr_name,loc,reference,remarks,cust_name,cust_id,c,prepby,recby,noteby){
		//countsis = c;
		rrnos = rrno;
		//alert(prepby);
		$('#txtdateissued').val(issued_date);
		$('#txtissuedno').val(rrnos);
		$('#txtsiscust').val(cust_name);
		$('#txtsiscustid').val(cust_id);
		$('#txtsisaddr').val(addr_name);
		$('#txtsisaddrid').val(addr_id);
		$('#txtsisno').val(issued_nos);
		$('#txtlocationsis').val(loc);
		$('#txtreferencesis').val(reference);
		$('#txtremarksis').val(remarks);
		/*$("select#cboprep option").each(function() { this.selected = (this.text == prepby); });
		$("select#cborecby option").each(function() { this.selected = (this.text == recby); });
		$("select#cbonotedby option").each(function() { this.selected = (this.text == noteby); });*/
		//$('#cboprep').children("option:selected").val(prepby)
		//alert(recby);
		//alert(addr_id);

		/*history.replaceState("","","?matid=" + materialsid + "&rrno=" + rrno);
		var myFrame = $('#framemat4');
		var url = $(myFrame).attr('src')+"?matid="+materialsid + "&rrno=" + rrno;

		var loc = url;
		var params = loc.split('?')[1];
		document.getElementById("framemat4").src = 'iframes/mwrf_items2_sis.php?matid=' + materialsid+ "&rrno=" + rrno;*/

	}
	$('#btnsearch').click(function(){
		var appendurl = $('#txtmwrfsearch').val();
		history.replaceState("","","?mwrfid=" + appendurl);
		var myFrame = $('#framemat');
		var url = $(myFrame).attr('src')+"?mwrfid="+appendurl;

		var loc = url;
		var params = loc.split('?')[1];
		document.getElementById("framemat").src = 'iframes/mwrf_items.php?mwrfid=' + appendurl;
		//alert("sds");
	});

	

	$('#btnrrsave').click(function(){
		//textfield
		var rrno = $('#txtrrno').val();
		var vendor_id = $('#txtvendorid').val();
		var vendor = $('#txtvendor').val();
		var addr_id = $('#txtaddrid').val();
		var addr = $('#txtaddr').val();
		var ref = $('#txtreferencerr').val();
		var warehouse = $('#cbowarehouseman').children("option:selected").val();
		var dept = $('#cbodept').children("option:selected").val();
		var clientdate = $('#txtclientdate').val();
		if (vendor_id == "" || addr_id == "" || rrno == ""){
			Swal.fire({
				type: 'error',
				title: 'Oops...',
				text: 'Fill in missing fields'
			})
		}
		else {
			

			var matid = $('iframe[name=framemat]').contents().find('#txtmatid'+countrr).val();
			var qty = $('iframe[name=framemat]').contents().find('#txtrrqty'+countrr).val();
			//alert(matid);
			if (countrr == ""){
				Swal.fire({
					type: 'error',
					title: 'Oops...',
					text: 'Select item first.'
				})
			}
			else {
				xajax_insertaddr(vendor);
				xajax_insertcustomer(addr);
				xajax_insertrr(rrno,vendor_id,addr_id,clientdate,ref,warehouse,dept);
				
				xajax_insertrrqty(matid,mwrf_id,rrno,qty);
				xajax_updatemwrfrrno(matid,rrno);
				
				Swal.fire({
						type: 'success',
						title: '',
						text: 'RR Successfully saved.'
					}).then(function() {
                        document.getElementById('framemat').contentWindow.location.reload();
                        //history.go(0);
                      });
			}
			

			//var rrno = $('#txtrrno').val();
		/*	var count = $('iframe[name=framemat]').contents().find('#txtcount').val();
			for(var i = 0;i <= count;i++){
				var matid = $('iframe[name=framemat]').contents().find('#txtmatid'+i).val();

				var qty = $('iframe[name=framemat]').contents().find('#txtrrqty'+i).val();
				var checks = $('iframe[name=framemat]').contents().find('#txtchkbox'+i).prop('checked');
				var con = checks ? 1 : 0;
				if (con == 1){	
        		//alert(matid);
        		xajax_insertrrqty(matid,mwrf_id,rrno,qty); //add declared rr qty
        		xajax_updatemwrfrrno(matid,rrno); //update rrno
        	}

        }*/
    }
    document.getElementById('framemat').contentWindow.location.reload();
});
	$('#btnsissave').click(function(){
		//alert(rrnos);
		var dateissued = $('#txtdateissued').val();
		//var issuednos = $('#txtissuedno').val();
		var cust_name = $('#txtsiscust').val();
		var cust_id = $('#txtsiscustid').val();
		var addr_name = $('#txtsisaddr').val();
		var addr_id = $('#txtsisaddrid').val();
		var ref = $('#txtreferencesis').val();
		var remarks = $('#txtremarksis').val();
		var location = $('#txtlocationsis').val();
		var sisno = $('#txtsisno').val();
		var rrnofield = $('#txtissuedno').val();
		var cboprep = $('#cboprepby').children("option:selected").val();
		var cborec = $('#cborecby').children("option:selected").val();
		var cbonote = $('#cbonotedby').children("option:selected").val();
		//alert(cboprep);
		//var sisno = $('#txtissuedno').val();
		//var sisno = $('#txtissuedno').val();
		//alert(sisno);
		if(cust_id == "" || addr_id == "" || sisno == "" ){
			/*document.getElementById("txtsiscust").required = true;
			document.getElementById("txtsisaddr").required = true;*/
			//alert("Fill in missing field");
			Swal.fire({
				type: 'error',
				title: 'Oops...',
				text: 'Fill in missing fields'
			})
			
		}
		else{
			var matid = $('iframe[name=framemat3]').contents().find('#txtmatidsis'+countsis).val();
			var rrno = $('iframe[name=framemat3]').contents().find('#txtrrno'+countsis).html();
			var qty = $('iframe[name=framemat3]').contents().find('#txtsisqty'+countsis).val();
			var btn = $('iframe[name=framemat3]').contents().find('#btnselectsis'+countsis);
			//alert(matid + "-" + rrno + "-" + qty);

			if (countsis == "" || rrnofield == ""){
				Swal.fire({
					type: 'error',
					title: 'Oops...',
					text: 'Select Item first.'
				})

			}
			else if(qty == ""){
				Swal.fire({
					type: 'error',
					title: 'Oops...',
					text: 'Enter value to Issue first.'
				})
			}
			else {
				var lastbalance = $('#framemat4').contents().find('#txtbalancemwrf').val();
				var countbalance = $('#framemat4').contents().find('#txtcountbalance').val();

				if (parseFloat(qty) > parseFloat(lastbalance) && parseFloat(countbalance) != 0){
					//alert("dli pwde");
					Swal.fire({
						type: 'error',
						title: 'Oops...',
						text: 'The value exceeded from current balance.'
					})
				}
				else if(qty <= 0){
					Swal.fire({
						type: 'error',
						title: 'Oops...',
						text: 'The quantity must greater than 0.'
					})
				}
				else if(parseFloat(qty) <= parseFloat(lastbalance) || parseFloat(countbalance) == 0) {

					xajax_insertsis(rrno,cust_id,addr_id,dateissued,sisno,location,ref,remarks,cboprep,cborec,cbonote);
					xajax_insertsisqty(matid,mwrf_id,sisno,rrno,qty);
					Swal.fire({
						type: 'success',
						title: '',
						text: 'SIS Successfully added'
					})
					document.getElementById('framemat3').contentWindow.location.reload();
					document.getElementById('framemat4').contentWindow.location.reload();
					//alert("okeh keyoh");
				}
				else
				{
					alert("error");
				}

				
			}
			

			//var count = $('iframe[name=framemat3]').contents().find('#txtcountsis').val();
			
			/*for(var i = 0;i < count;i++){*/
				/*var matid = $('iframe[name=framemat3]').contents().find('#txtmatidsis'+i).val();
				var rrno = $('iframe[name=framemat3]').contents().find('#txtrrno'+i).html();
				var qty = $('iframe[name=framemat3]').contents().find('#txtsisqty'+i).val();
				var btn = $('iframe[name=framemat3]').contents().find('#btnselectsis'+i);*/
				
				/*if(btn.data('clicked'))
				{
					alert(count);
				}
				else {
					
				}*/
				/*var checks = $('iframe[name=framemat3]').contents().find('#txtchkboxsis'+i).prop('checked');
				//event.preventBubble=true;
				var con = checks ? 1 : 0;
				if (con == 1){*/
					//alert(count);
					/*xajax_insertsis(rrno,cust_id,addr_id,dateissued,sisno,location,ref,remarks);
					xajax_insertsisqty(matid,mwrf_id,sisno,rrno,qty);*/

					/*}*/

					/*}*/
					
				}
				
			});
	$('#btnsisupdate').click(function(){
		var dateissued = $('#txtdateissued').val();
		var issuednos = $('#txtissuedno').val();
		//alert(issuednos);
		var cust_id = $('#txtsiscustid').val();
		var cust_addr_id = $('#txtsisaddrid').val();
		var loc = $('#txtlocationsis').val();
		var ref = $('#txtreferencesis').val();
		var rem = $('#txtremarksis').val();
		var sisno = $('#txtsisno').val();

		if(cust_id == "" || cust_addr_id == "" || sisno == ""){
			Swal.fire({
				type: 'error',
				title: 'Oops...',
				text: 'Fill in missing empty first.'
			})
		}
		else if(countsis == "" || issuednos == "") {
			Swal.fire({
				type: 'error',
				title: 'Oops...',
				text: 'Select SIS first.'
			})
		}
		else {
			var matid = $('iframe[name=framemat3]').contents().find('#txtmatidsis'+countsis).val();
			var rrno = $('iframe[name=framemat3]').contents().find('#txtrrno'+countsis).html();
			var qty = $('iframe[name=framemat3]').contents().find('#txtsisqty'+countsis).val();
			var btn = $('iframe[name=framemat3]').contents().find('#btnselectsis'+countsis);
			var qty = $('iframe[name=framemat4]').contents().find('#txtsismatqty'+countsis).text();

			xajax_updatesisinfo(issuednos,cust_id,cust_addr_id,dateissued,loc,sisno,ref,rem);
			xajax_updatesisqty(matid,sisno,qty,rrno);
			document.getElementById('framemat3').contentWindow.location.reload();
			Swal.fire({
				position: 'top',
				type: 'success',
				title: 'Your work has been saved',
				showConfirmButton: false,
				timer: 1500
			})
		}



		/*var count = $('iframe[name=framemat3]').contents().find('#txtcountsis').val();
		for(var i = 0;i < count;i++){
			var matid = $('iframe[name=framemat3]').contents().find('#txtmatidsis'+i).val();
			var rrno = $('iframe[name=framemat3]').contents().find('#txtrrno'+i).html();
			var qty = $('iframe[name=framemat3]').contents().find('#txtsisqty'+i).val();*/
			/*var checks = $('iframe[name=framemat3]').contents().find('#txtchkboxsis'+i).prop('checked');
				//event.preventBubble=true;
				var con = checks ? 1 : 0;
				if (con == 1){*/
					/*xajax_updatesisqty(matid,sisno,qty,rrno);
					document.getElementById('framemat4').contentWindow.location.reload();*/
					/*xajax_insertsis(rrno,cust_id,addr_id,dateissued,rrno,ref,remarks);
					xajax_insertsisqty(matid,mwrf_id,rrno,qty);*/
					/*Swal.fire({
						position: 'top',
						type: 'success',
						title: 'Your work has been saved',
						showConfirmButton: false,
						timer: 1500
					})*/
					
				//alert("wewe" + count);
        		//alert(matid);
        		/*xajax_insertrrqty(matid,mwrf_id,rrno,qty); //add declared rr qty
        		xajax_updatemwrfrrno(matid,rrno); //update rrno*/
        		/*}*/
        		/*}*/

        	});
	$('#btnrrupdate').click(function(){
		//alert("sds");
		//var rrno = $('#txtrrno').val();
		var vendor_id = $('#txtvendorid').val();
		var vendor = $('#txtvendor').val();
		var addr_id = $('#txtaddrid').val();
		var addr = $('#txtaddr').val();
		var ref = $('#txtreferencerr').val();
		var warehouse = $('#cbowarehouseman').children("option:selected").val();
		var dept = $('#cbodept').children("option:selected").val();
		var clientdate = $('#txtclientdate').val();
		if (rrnos == ""){
			Swal.fire({
				type: 'error',
				title: 'Oops!',
				text: 'Select material in the bottom first.'
			})
		}
		else {
			xajax_updaterrinfo(rrnos,vendor_id,addr_id,clientdate,ref,warehouse,dept);
			var qty = $('iframe[name=framemat2]').contents().find('#txtrrqty'+countrrbal).text();
			//alert(qty);
			xajax_updatemwrfrrqty(matrrid,qty);
			

			Swal.fire({
				position: 'top',
				type: 'success',
				title: 'Your work has been saved',
				showConfirmButton: false,
				timer: 1500
			})
			document.getElementById('framemat2').contentWindow.location.reload();
		}
		
		//alert(rrnos);
	});
	$('#btnrrdelete').click(function(){
		/*if (rrnos == ""){
			Swal.fire({
				type: 'error',
				title: 'Oops!',
				text: 'Select material in the bottom first.'
			})
		}
		else {
			xajax_deletemwrfrr(matrrid);
			Swal.fire({
				position: 'top',
				type: 'success',
				title: 'Your work has been saved',
				showConfirmButton: false,
				timer: 1500
			})
			document.getElementById('framemat2').contentWindow.location.reload();
		}*/
		if (rrnos == ""){
			Swal.fire({
				type: 'error',
				title: 'Oops!',
				text: 'Select RR issued first.'
			})
		}
		else {
			Swal.fire({
			title: 'Are you sure you want to delete?',
			text: "You won't be able to revert this!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, remove it!'
		}).then((result) => {
			if (result.value) {
				$.ajax({
					url: xajax_deletemwrfrr(matrrid),
					complete: function(data)
					{
						Swal.fire({
							type: 'success',
							title: '',
							text: 'RR Deleted.'
						})
						document.getElementById('framemat2').contentWindow.location.reload();
						document.getElementById('framemat').contentWindow.location.reload();
						//$("#tablerows").load("tables/items_new_load.php");

					}
				});
			}
		})
		}
		

	});

/*	$('#btncreatenew').click(function(){
		//viewrrsis();
	});*/
	/*var samp = $("#framemat2").contents().find("").click();
	alert(samp);*/
	//$('#btnrrupdate').removeAttr('disabled');
	$('#btnprintrr').click(function(){
		//alert('sad');
		var rrno = $('#txtrrno').val();
		window.open ('print/rr_print.php?rrno='+ rrno);

		//alert(rrno);
		/*var table = $('iframe[name=framemat]').contents().find('#example').dataTable();
		alert("wew" +table.data().count());*/
		/*var count = 0;
		var rrqty = $('iframe[name=framemat]').contents().find('#txtrrqty');
		$(rrqty).each(function(){
			alert('wew' + count);
			count++;
		});
		*/
		
		//viewrrsis();
	});
	$('#btnsisprint').click(function(){
		//alert('sad');
		var sisno = $('#txtsisno').val();
		window.open ('print/sis_print.php?sisno='+ sisno);

		//alert(rrno);
		/*var table = $('iframe[name=framemat]').contents().find('#example').dataTable();
		alert("wew" +table.data().count());*/
		/*var count = 0;
		var rrqty = $('iframe[name=framemat]').contents().find('#txtrrqty');
		$(rrqty).each(function(){
			alert('wew' + count);
			count++;
		});
		*/
		
		//viewrrsis();
	});



	//Editable
	//
	/*$('#cbowarehouseman').editableSelect();
	//$('#cbovendor').editableSelect();
	$('#cboaddr').editableSelect();*/
	//$('#cboparticulars').editableSelect();

	// AJAX for inputs
	$(document).ready(function() {
		$('#txtvendor').typeahead({
			source: function (query, result) {
				//alert(query);
				$.ajax({
					url: "json/json_customer.php",
					data: 'queryvendor=' + query,            
					dataType: "json",
					type: "POST",
					success: function (data) { //data is the output of query in json
						//alert(data);
						//var result = $.parseJSON(result);
						/*$.each(result, function(i, element){        
							var id=element.id;
							var name=element.name;  
						}*/
						//result($.each(data, function (/*i,*/item) { // each name in json
							//alert(item);
							/*var id=item.id;
							var name=item.value;
							return name; */							
							/*
							return {
								id: item.id, //id
								value: item.value //name
							}*/
							//return item;
						//}));
						result(data);
					}
				});
			},
			autoSelect: true,
			displayText: function (item) {
				if (item.value == ""){
					var lastid = $('#txtlastvendorid').val();
					$('#txtvendorid').val(lastid);
				}else {
					//$('#txtvendor').val(item.value);
					$('#txtvendorid').val(item.id);
					
				}
				return item.value;
				
			}
		});
		
		$('#txtvendor').on('input', function() {
			if ($('#txtvendor').val() == ""){
				$('#txtvendorid').val("");
			}
		});
		//
		$('#txtsiscust').typeahead({
			source: function (query, result) {
				//alert(query);
				$.ajax({
					url: "json/json_customer.php",
					data: 'queryvendor=' + query,            
					dataType: "json",
					type: "POST",
					success: function (data) { //data is the output of query in json

						result(data);
					}
				});
			},
			autoSelect: true,
			displayText: function (item) {
				if (item.value == ""){
					var lastid = $('#txtlastcustid').val();
					$('#txtsiscustid').val(lastid);
				}else {
					//$('#txtvendor').val(item.value);
					$('#txtsiscustid').val(item.id);
					
				}
				return item.value;
				
			}
		});
		
		$('#txtsiscust').on('input', function() {
			if ($('#txtsiscust').val() == ""){
				$('#txtsiscustid').val("");
			}
		});

		//
		$('#txtaddr').typeahead({
			source: function (query, result) {
				$.ajax({
					url: "json/json_address_rr.php",
					data: 'queryaddr=' + query,            
					dataType: "json",
					type: "POST",
					success: function (data) {
						//alert(data);
						result(data);
					}
				});
			},
			autoSelect: false,
			displayText: function (item) {
				//$('#txtvendorid').val(item.id);
				if (item.value == ""){
					var lastidaddr = $('#txtlastaddrid').val(); 
					$('#txtaddrid').val(lastidaddr);	
				}else {
					$('#txtaddrid').val(item.id);
					
				}
				return item.value;
			}
		});
		$('#txtaddr').on('input', function() {
			if ($('#txtaddr').val() == ""){
				$('#txtaddrid').val("");
			}
		});
		$('#txtsisaddr').typeahead({
			source: function (query, result) {
				$.ajax({
					url: "json/json_address_sis.php",
					data: 'queryaddr=' + query,            
					dataType: "json",
					type: "POST",
					success: function (data) {
						//alert(data);
						result(data);
					}
				});
			},
			autoSelect: false,
			displayText: function (item) {
				//$('#txtvendorid').val(item.id);
				if (item.value == ""){
					/*$('#txtsisaddrid').val("");	*/
					var lastidaddr = $('#txtlastaddridsis').val(); 
					$('#txtsisaddrid').val(lastidaddr);
				}else {
					$('#txtsisaddrid').val(item.id);
					
				}
				return item.value;
			}
		});
		$('#txtsisaddr').on('input', function() {
			if ($('#txtsisaddrid').val() == ""){
				$('#txtsisaddrid').val("");
			}
		});

		/*$.ajaxSetup ({
			cache: false
		});
		var ajax_load = "<img src='http://automobiles.honda.com/images/current-offers/small-loading.gif' alt='loading...' />";


		var loadUrl = "rr_tabcontent.php";
		$("#btnrrdelete").click(function(e){
			e.preventDefault();
			e.stopPropagation(); 
			$("#dataTable").html(ajax_load).load(loadUrl);
		});*/
	});


	$('#rrsismodal').draggable({
		handle: ".modal-header"
	});
	$('#sismodal').draggable({
		handle: ".modal-header"
	});

	 /*var rrbtn = $('iframe[name=framemat2]').contents().find('#btnselectrr0');
	 rrbtn.click(function(){
	 	alert('adas');
	 	console.log('sss');
	 });
*/	/*$rrframe = $('#framemat2');
	//$rrframe.contents().find("#btnselectrr").on("click", alert('sds'));
	$rrframe.contents().find("#btnselectrr").click(function(){
		alert('ssss');
	});*/
	/*$('iframe[name=framemat2]').contents().find('#btnselectrr').click(function(){
		alert("sds");
	});*/
	//$("#framemat2").contents().find("#btnselectrr").attr('disabled','disabled');

/*  $(document).ready(function() {
    var table = $('iframe[name=framemat]').contents().find('#example').DataTable( {
        fixedHeader: {
            header: true,
            footer: true
        }
    } );
} );*/
/*$('#dataTable').dataTable({
	'iDisplayLength': 100
});*/


</script>
</body>
</html>