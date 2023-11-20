<?php
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
<body id="page-top">
	<button id="btncreatenewrr" class="btn btn-primary" style="float: right;">
		<i style="padding-right: 5px;" class="fas fa-folder"></i>Create RR
	</button><br><br>
	<!-- RR TABLE -->
	<div class="card mb-3">
		<div class="card-header" style="background-color: #3399CC;color: white;">
			<i class="fas fa-table"></i>
		RRNO Table</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-hover"  data-sort-order = "desc" id="dataTable2" width="100%" cellspacing="100">
					<thead>
						<tr>
							<th width="10%">RRNO</th>
							<th width="20%">Customer</th>
							<th width="10%">Reference</th>
							<th width="10%%">Date</th>
							<th width="50%">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						include('tables/rr_items_load.php');
						?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
	</div>
	<!-- ITEMS MODAL -->
	<div class="modal fade bd-example-modal-lg" id="itemsmodal" tabindex="1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-centered" role="document" style="width: auto;">
			<div class="modal-content" style="width: 1400px;height: 800px;">
				<div class="modal-header" style="background-color: #17A2B8;color:white;">
					<h5 class="modal-title" id="formModalLabel"><strong>Select item[s]</strong></h5>
					<button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnFormClose" style="border:0px;color: white;"><i class="fa fa-close"></i></button>
				</div>
				<table class="table table-bordered table-striped" id="mtable1" cellspacing="0">
					<tbody id="mtable2">
						<iframe style="border: 0px;padding-left: 10px;height: 800px;" width="100%" name="frameitems" id="frameitems" src="tables/items_load.php?mwrfid=" /></iframe>
					</tbody>
				</table>
				
			</div>
		</div>
	</div>
	<!-- END -->

	<!-- ITEMS MODAL -->
	<div class="modal fade bd-example-modal-lg" id="itemsmodal2" tabindex="2" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-centered" role="document" style="width: auto;">
			<div class="modal-content" style="width: 1400px;height: 800px;">
				<div class="modal-header" style="background-color: #17A2B8;color:white;">
					<h5 class="modal-title" id="formModalLabel"><strong>Select item[s]</strong></h5>
					<button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnFormClose" style="border:0px;color: white;"><i class="fa fa-close"></i></button>
				</div>
				<table class="table table-bordered table-striped" id="mtable1" cellspacing="0">
					<tbody id="mtable2">
						<iframe style="border: 0px;padding-left: 10px;height: 800px;" width="100%" name="frameitems2" id="frameitems2" src="tables/items_load2.php?mwrfid=" /></iframe>
					</tbody>
				</table>
				
			</div>
		</div>
	</div>
	<!-- END -->
	

	<!-- Modal for creating -->
	<div class="modal fade bd-example-modal-lg" id="rrmodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" style="width: auto;">
			<div class="modal-content" style="width: 1350px;margin-left: -270px;min-height: 800px;">
				<div class="modal-header" style="background-color: #17A2B8;color:white;">
					<h5 class="modal-title" id="formModalLabel"><strong>Create RR</strong></h5>
					<button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnFormClose" style="border:0px;color: white;"><i class="fa fa-close"></i></button>
				</div>
				<form method="POST" enctype="multipart/form-data">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="margin:-10px;">
						<table class="table table-bordered">
							<tr>
								<td colspan="4" style="border:1px solid #17A2B8;"><strong>Receiving Receipt</strong></td>
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
										<input type="text" name="txtrrnonew" class="form-control" id="txtrrnonew"   placeholder="" style="height: 35px;width: 300px;">
									</div>
									<br>
									<div>
										<input type="text" id="txtvendornew" name="txtvendor" class="form-control">
										<input type="hidden" id="txtvendoridnew" name="txtvendoridnew" class="form-control">

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
										echo "<input type = 'hidden'  value= '".$c."' id = 'txtlastvendoridnew'";
										?>
									</div><br>
									<div>
										<input type="text" id="txtaddrnew" name="txtaddrnew" class="form-control" autocomplete="off">
										<input type="hidden" id="txtaddridnew" name="txtaddridnew" class="form-control" autocomplete="off">

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
										echo "<input type = 'hidden' id = 'txtlastaddridnew' value = '".$c."'";
										?>
									</div><br>

									<div>
										<input type="date" name="txtclientdatenew" class="form-control" id="txtclientdatenew" placeholder="Plate/Machine No." style="height: 35px;width: 300px;">
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
											<input type="text" name="txtreferencerrnew" class="form-control" id="txtreferencerrnew" placeholder="" style="height: 35px;width: 350px;">
										</div><br>
										<div>
											<?php
											global $dbinv;
											$sql = "SELECT *FROM tblpersonnel_ware WHERE isdelete =1 and category_id = 1 ORDER BY fullname_ware ASC";
											$result=$dbinv->query($sql);
											$c=1;

											echo '<select class="form-control" id="cbowarehousemannew" style="height: 35px;width: 350px;">';
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

											echo '<select class="form-control" id="cbodeptnew" style="height: 35px;width: 350px;">';
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
											<button type="button" id="btnrrsavenew" class="btn btn-primary"><i class="fas fa-save" style="margin-right: 5px;"></i>SAVE</button>
											<!-- <button type="button" id="btnrrupdatenew" class="btn btn-primary">UPDATE</button> -->
											<!-- <button type="button" id="btnrrdeletenew" class="btn btn-danger"><i class="fa fa-trash" style="margin-right: 5px;"></i>DELETE</button> -->
										</div><br>
									</td>
								</td>


							</tr><br/>
						</td>
					</td>
				</tr>
				<tr>

				</tr>
				<form action="iframes/mwrf_items.php" method="GET" enctype="multipart/form-data">
					<table width="100%">
						<tr>
							<td style="border: 1px solid #17A2B8;float: left;margin-left: 0px;">
								<button type="button" id="btnselectitem" class="btn btn-info"><i class="fas fa-clipboard-list" style="margin-right: 5px;"></i>SELECT ITEM</button>
								<button type="button" id="btndeselectall" class="btn btn-danger"><i class="fa fa-trash" style="margin-right: 5px;"></i>REMOVE ALL</button>
							</td>
						</tr>
					</table>
				</form>
				<form action="iframes/mwrf_items.php" method="GET" enctype="multipart/form-data">
					<table width="100%">
						<tr>
							<td colspan="3" width="70%" style="border: 1px solid #17A2B8;height: 300px;" id="tditemsrr">
								<table class="table table-bordered table-striped" id="mtable1" cellspacing="0">
									<tbody id="mtable2">
										<iframe style="border: 0px;margin-top: 0px;" width="100%" height="100%" name="frameitemsrr" id="frameitemsrr" src="iframes/items_rr.php" />
									</iframe>
								</tbody>
							</table>
						</td>
						<!-- <td colspan="3" width="50%" style="border: 1px solid #17A2B8;height: 300px;" id="tditemsrr">
							<table class="table table-bordered" id="mtable1" cellspacing="0">
								<tbody id="mtable2">
									<iframe width="100%" height="100%" style="border: 0px;margin-top: 0px;" name="framemat2" id="framemat2" src="iframes/mwrf_items_rr.php?matid=" /></iframe>
								</tbody>
							</table>
						</td> -->
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
<!-- END RR -->

<!-- RR SELECT -->

<!-- Modal for creating -->
<div class="modal fade bd-example-modal-lg" id="siscrmodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" style="width: 1350px;margin-left: -270px;min-height: 500px;">
			<div class="modal-header" style="background-color: #17A2B8;color:white;">
				<h5 class="modal-title" id="formModalLabel"><strong>Edit SIS</strong></h5>
				<button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnFormClose" style="border:0px;color: white;"><i class="fa fa-close"></i></button>
			</div>
			<form action="rr_tabcontent.php" method="POST" enctype="multipart/form-data">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="margin:-10px;">
					<table class="table table-bordered">
						<tr>
							<td colspan="6" style="border:1px solid #17A2B8;"><strong>Receiving Receipt</strong></td>
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
									<label style="height: 30px;margin-left: 10px;">SIS No.: </label>

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

							<td rowspan="1" style="border:0px solid #17A2B8;width: 100px;" id="rrright">
								<div>
									<input type="date" name="txtdateissuedcr" class="form-control" id="txtdateissuedcr"  placeholder="" style="height: 35px;width: 300px;" >
								</div>
								<br>
								<div>
									<input type="text" id="txtissuednocr" name="txtissuednocr" class="form-control" disabled="true">
									<input type="hidden" id="txtsiscustidcr" name="txtsiscustidcr" class="form-control">
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
									echo "<input type = 'hidden'  value= '".$c."' id = 'txtlastcustidcr'";
									?>
								</div><br>
								<div>
									<input id="txtsisnoitems" type="text"  name="txtsisnoitems" class="form-control">
								</div><br>
								<div>
									<input type="text" id="txtsiscustcr" name="txtsiscustcr" class="form-control" autocomplete="off">
									<input type="hidden" id="txtsisaddridcr" name="txtsisaddridcr" class="form-control" autocomplete="off">

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
									echo "<input type = 'hidden' id = 'txtlastaddridsiscr' value = '".$c."'";
									?>
								</div><br>

								<div>
									<input type="text" name="txtsisaddrcr" class="form-control" id="txtsisaddrcr" style="height: 35px;width: 300px;">
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

								<td style="border:0px solid #17A2B8;min-width: 300px;" id="siscenter">
									<div>
										<input type="text" name="txtlocationsiscr" class="form-control" id="txtlocationsiscr" placeholder="" style="height: 35px;width: 300px;">
									</div><br>
									<div>
										<input type="text" name="txtreferencesiscr" id="txtreferencesiscr" class="form-control" style="height: 35px;width: 300px;">

									</div><br>
									<div>
										<input type="text" name="txtremarksiscr" id="txtremarksiscr" class="form-control" style="height: 35px;width: 300px;">
									</div><br>
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
										<button type="button" id="btnsissavecr" class="btn btn-primary"><i class="fas fa-save" style="margin-right: 5px;"></i>SAVE</button>
										<button type="button" id="btnsisupdatecr" class="btn btn-success"><i class="fa fa-refresh" style="margin-right: 5px;"></i>UPDATE</button>
										<!-- <button type="button" id="btnsisdeletecr" class="btn btn-danger"><i class="fa fa-trash" style="margin-right: 5px;"></i>DELETE</button> -->
									</div><br>
								</td>
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
									<!-- <button type="button" id="btnsisprint" class="btn btn-success" style="float: right;" ><i class="fas fa-print" style="margin-right: 5px;"></i>PRINT</button> -->

								</td>


						</tr><br/>
					</td>
				</td>
			</tr>
			<tr>
			</tr>
			<form action="iframes/mwrf_items.php" method="GET" enctype="multipart/form-data">
				<table width="100%">
					<tr>
						<td colspan="3" width="60%" style="border: 1px solid #17A2B8;height: 300px;" id="tditemsrr">
							<table class="table header-fixed table-bordered table-striped" id="mtable1" cellspacing="0">

								<tbody id="mtable2" style="">
									<iframe style="border: 0px;margin-top: 0px;" width="100%" height="100%" id="frameitemsis" name="frameitemsis"  src="iframes/items_sis_gen.php?rrno=" /></iframe>
								</tbody>
							</table>
						</td>
						<td colspan="3" width="50%" style="border: 1px solid #17A2B8;height: 300px;" id="tditemsrr">
							<table class="table table-bordered" id="mtable1" cellspacing="0">
								<tbody id="mtable2">
									<iframe width="100%" height="100%" style="border: 0px;margin-top: 0px;" id="framebalsis" name="framebalsis"  src="iframes/items_sis_balance.php?rrno= & item_id=" />
								</iframe>
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
<div class="modal fade bd-example-modal-lg" id="rrcrmodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" style="width: auto;">
		<div class="modal-content" style="width: 1350px;margin-left: -270px;min-height: 800px;">
			<div class="modal-header" style="background-color: #17A2B8;color:white;">
				<h5 class="modal-title" id="formModalLabel"><strong>Edit RR</strong></h5>
				<button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnFormClose" style="border:0px;color: white;"><i class="fa fa-close"></i></button>
			</div>
			<form method="POST" enctype="multipart/form-data">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="margin:-10px;">
					<table class="table table-bordered">
						<tr>
							<td colspan="4" style="border:1px solid #17A2B8;"><strong>Receiving Receipt</strong></td>
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
									<input type="text" name="txtrrnocrnew" class="form-control" id="txtrrnocrnew"   placeholder="" style="height: 35px;width: 300px;">
									<input type="hidden" name="txtrrnocrnewhid" class="form-control" id="txtrrnocrnewhid"   placeholder="" style="height: 35px;width: 300px;">
								</div>
								<br>
								<div>
									<input type="text" id="txtvendorcrnew" name="txtvendorcrnew" class="form-control">
									<input type="hidden" id="txtvendoridcrnew" name="txtvendoridcrnew" class="form-control">

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
									echo "<input type = 'hidden'  value= '".$c."' id = 'txtlastvendoridcrnew'";
									?>
								</div><br>
								<div>
									<input type="text" id="txtaddrcrnew" name="txtaddrcrnew" class="form-control" autocomplete="off">
									<input type="hidden" id="txtaddridcrnew" name="txtaddridcrnew" class="form-control" autocomplete="off">

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
									echo "<input type = 'hidden' id = 'txtlastaddridcrnew' value = '".$c."'";
									?>
								</div><br>

								<div>
									<input type="date" name="txtclientdatecrnew" class="form-control" id="txtclientdatecrnew" placeholder="Plate/Machine No." style="height: 35px;width: 300px;">
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
										<input type="text" name="txtreferencerrcrnew" class="form-control" id="txtreferencerrcrnew" placeholder="" style="height: 35px;width: 300px;">
									</div><br>
									<div>
										<?php
										global $dbinv;
										$sql = "SELECT *FROM tblpersonnel_ware WHERE isdelete =1 and category_id = 1 ORDER BY fullname_ware ASC";
										$result=$dbinv->query($sql);
										$c=1;

										echo '<select class="form-control" id="cbowarehousemancrnew">';
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

										echo '<select class="form-control" id="cbodeptcrnew">';
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
										<!-- <button type="button" id="btnrrsavecrnew" class="btn btn-primary">SAVE</button> -->
										<button type="button" id="btnrrupdatecrnew" class="btn btn-success"><i class="fa fa-refresh" style="margin-right: 5px;"></i>UPDATE</button>
										<!-- <button type="button" id="btnrrdeletecrnew" class="btn btn-primary">DELETE</button> -->
									</div><br>
									<div style="float:right;">
										<button type="button" id="btnprintitemrr" class="btn btn-primary"><i class="fas fa-print" style="margin-right: 5px;"></i>PRINT RR</button>
									</div>
								</td>
							</td>


						</tr><br/>
					</td>
				</td>
			</tr>
			<tr>

			</tr>
			<form action="iframes/mwrf_items.php" method="GET" enctype="multipart/form-data">
				<table width="100%">
					<tr>
						<td style="border: 1px solid #17A2B8;float:left;margin-left: 10px;">
							<button type="button" id="btnselectitemnew" class="btn btn-info"><i class="fas fa-clipboard-list" style="padding-right: 5px;" ></i>ADD ITEM</button>
							<!-- <button type="button" id="btndeselectallnew" class="btn btn-primary">REMOVE ALL</button> -->
						</td>
					</tr>
				</table>
			</form>
			<form action="iframes/mwrf_items.php" method="GET" enctype="multipart/form-data">
				<table width="100%">
					<tr>
						<td colspan="3" width="70%" style="border: 1px solid #17A2B8;height: 300px;" id="tditemsrr2">
							<table class="table table-bordered table-striped" id="mtable1" cellspacing="0">
								<tbody id="mtable2">
									<iframe style="border: 0px;margin-top: 0px;" width="100%" height="100%" name="frameitemsrrcr" id="frameitemsrrcr" src="iframes/items_rr_gen.php" />
								</iframe>
							</tbody>
						</table>
					</td>
					<!-- <td colspan="3" width="50%" style="border: 1px solid #17A2B8;height: 300px;" id="tditemsrr">
						<table class="table table-bordered" id="mtable1" cellspacing="0">
							<tbody id="mtable2">
								<iframe width="100%" height="100%" style="border: 0px;margin-top: 0px;" name="framemat2" id="framemat2" src="iframes/mwrf_items_rr.php?matid=" /></iframe>
							</tbody>
						</table>
					</td> -->
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
<!-- END -->
<script src="../../../vendor/jquery/jquery.min.js"></script>
<script src="../../../vendor/jquery/jquery-ui.js"></script>
<script src="../../../vendor/jquery/jquery-ui.min.js"></script>
<script src="../../../vendor/bootstrap/js/bootstrap.bundle.min.js" type="text/javascript"></script>

<script src="../../../../vendor/jquery-easing/jquery.easing.min.js" type="text/javascript"></script>

<script src="../../../vendor/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="../../../vendor/datatables/dataTables.bootstrap4.js" type="text/javascript"></script>

<script src="../../../js/sb-admin.min.js" type="text/javascript"></script>
<script src="../../../vendor/jquery/jquery.datetimepicker.js" type="text/javascript"></script>

<script src="../../../js/demo/datatables-demo.js" type="text/javascript"></script>
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

	function selectrr(rr_id,rrno,vendor_id,addr_id,cust_name,addr_name,client_date,reference,pers_id_dept,fullname_ware,fullname_dept){
		//alert(rrno);iframes/mwrf_items2.php
		
		$('#txtrrnocrnewhid').val(rrno);
		$('#txtrrnocrnew').val(rrno);
		$('#txtvendoridcrnew').val(vendor_id);
		$('#txtaddridcrnew').val(addr_id);
		//alert(addr_id);
		$('#txtvendorcrnew').val(cust_name);
		$('#txtaddrcrnew').val(addr_name);
		$('#txtreferencerrcrnew').val(reference);
		$('#txtclientdatecrnew').val(client_date);
		//$('#txtissuednocr').val(rrno);
		
		$("select#cbowarehousemancrnew option").each(function() { this.selected = (this.text == fullname_ware); });
		$("select#cbodeptcrnew option").each(function() { this.selected = (this.text == fullname_dept); });
		//history.replaceState("","","?rrno=" + rrno);
		history.replaceState("","","?rrno=" + rrno);
		var myFrame = $('#frameitemsrrcr');
		var url = $(myFrame).attr('src')+"?rrno="+rrno;

		var loc = url;
		var params = loc.split('?')[1];
		document.getElementById("frameitemsrrcr").src = 'iframes/items_rr_gen.php?rrno=' + rrno;
		document.getElementById("frameitems2").src = 'tables/items_load2.php?rrno=' + rrno;

		$('#rrcrmodal').modal('show');


	}
	function selectsis(rrno,cust_id,addr_id,loc,reference,remarks,issued_date,cust_name,addr_name){
		/*$('#txtdateissuedcr').val(issued_date);
		$('#txtissuednocr').val(rrno);
		$('#txtsiscustcr').val(cust_name);
		$('#txtsiscustidcr').val(cust_id);
		$('#txtsisaddrcr').val(addr_name);
		$('#txtsisaddridcr').val(addr_id);
		$('#txtlocationsiscr').val(loc);
		$('#txtreferencesiscr').val(reference);
		$('#txtremarksiscr').val(remarks);*/
		$('#txtissuednocr').val(rrno);
		history.replaceState("","","?rrno=" + rrno);
		var myFrame = $('#frameitemsis');
		var url = $(myFrame).attr('src')+"?rrno="+rrno;
		var loc = url;
		var params = loc.split('?')[1];
		document.getElementById("frameitemsis").src = 'iframes/items_sis_gen.php?rrno=' + rrno;
		$('#siscrmodal').modal('show');
	}
	var countsisbal = "";
	var sisbalitemid = "";
	function selectmaterialsisview(rrno,date_issued,sisno,addr_id,addr_name,loc,reference,remarks,cust_name,cust_id,c,item_id){
		countsisbal = c;
		sisbalitemid = item_id;
		//alert(countsisbal);
		$('#txtdateissuedcr').val(date_issued);
		$('#txtissuednocr').val(rrno);
		$('#txtsisnoitems').val(sisno);
		$('#txtsiscustcr').val(cust_name);
		$('#txtsisaddrcr').val(addr_name);
		$('#txtlocationsiscr').val(loc);
		$('#txtreferencesiscr').val(reference);
		$('#txtremarksiscr').val(remarks);
		$('#txtsiscustidcr').val(cust_id);
		$('#txtsisaddridcr').val(addr_id);
	}
	var countsisitems = "";
	var items_id = "";
	function selectsisview(rrno,item_id,c){
		countsisitems = c;
		items_id = item_id;
		//alert(rrno);
		history.replaceState("","","?rrno=" + rrno + " & item_id=" + item_id);
		var myFrame = $('#framebalsis');
		var url = $(myFrame).attr('src')+"?rrno="+rrno + " & item_id=" + item_id;
		var loc = url;
		var params = loc.split('?')[1];
		document.getElementById("framebalsis").src = 'iframes/items_sis_balance.php?rrno=' + rrno + " & item_id=" + item_id;
	}
	function selectitems(myid,description,qtyonhand,unit){
		$.ajax({
			url:insertselecteditems(myid,description,qtyonhand,unit),
			success:function(){
				document.getElementById('frameitemsrr').contentWindow.location.reload();
			}
		})	
	}
	function additems(myid,rrno){
		$.ajax({
			url:insertselecteditems2(myid,rrno),
			success:function(){
				document.getElementById('frameitemsrrcr').contentWindow.location.reload();
			}
		})	
	}
	function insertselecteditems(myid,description,qtyonhand,unit){
		xajax_insertitemtemp(myid,description,unit);
	}
	function insertselecteditems2(myid,rrno){
		xajax_insertitemperma(myid,rrno);
	}
	function deselectitems(temp_id,item_id,description,unit){
		Swal.fire({
			title: 'Are you sure?',
			text: "You won't be able to revert this!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, remove it!'
		}).then((result) => {
			if (result.value) {
				$.ajax({
					url:deletedeselecteditems(temp_id),
					success:function(){
						document.getElementById('frameitemsrr').contentWindow.location.reload();
						Swal.fire(
							'Removed!',
							'Item has been removed.',
							'success'
							)
					}
				})
			}
		})
	}
	/*$('#btndeselectallnew').click(function(){
		var rrno = $('#txtrrnocrnew').val();
		Swal.fire({
			title: 'Are you sure?',
			text: "You won't be able to revert this!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, remove all!'
		}).then((result) => {
			if (result.value) {
				$.ajax({
					url:removeallitem(rrno),
					success:function(){
						document.getElementById('frameitemsrrcr').contentWindow.location.reload();
						Swal.fire(
							'Removed!',
							'Item has been removed.',
							'success'
							)
					}
				})
			}
		})
	});
	function removeallitem(rrno){
		xajax_removeallitem(rrno);
	}*/
	function removeitem(itemrr_id,qty,item_id){
		/*var newqty = qty;
		alert(newqty);*/
		//alert( "qty "+qty + " item_id " + item_id);
		Swal.fire({
			title: 'Are you sure?',
			text: "You won't be able to revert this!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, remove it!'
		}).then((result) => {
			if (result.value) {
				$.ajax({
					url:deletedeselecteditems2(itemrr_id,qty,item_id),
					success:function(){
						document.getElementById('frameitemsrrcr').contentWindow.location.reload();

						Swal.fire(
							'Removed!',
							'Item has been removed.',
							'success'
							)
					}
				})
			}
		})
	}
	function deletedeselecteditems2(itemrr_id,qty,item_id){
		/*var table = $('#frameitemsrrcr').contents().find('#tblnewitemrr').DataTable();
		table
		.column(0)
		.data()
		.each(function(value, index) {
			//alert(value + index);
			var qty = $('#frameitemsrrcr').contents().find('#txtqty' + index).val();
			var qtyprev = $('#frameitemsrrcr').contents().find('#txtqtyprev' + index).val();
			//alert(qtyprev);
			//xajax_updateitemqty(value,qty,rrno,qtyprev);
		});*/
		xajax_deleteitemperm(itemrr_id,qty,item_id);
	}
	
	function deletedeselecteditems(temp_id){
		xajax_deleteitemtemp(temp_id);
	}
	
	$('#btncreatenewrr').click(function(){
		$('#rrmodal').modal('show');
	});
	$('#btnselectitem').click(function(){
		$('#itemsmodal').modal({show:true});
	});
	$('#btnselectitemnew').click(function(){
		$('#itemsmodal2').modal({show:true});
	});
	$('#btnrrsavenew').click(function(){
		var rrno = $('#txtrrnonew').val();
		var vendor_id = $('#txtvendoridnew').val();
		var vendor = $('#txtvendornew').val();
		var addr_id = $('#txtaddridnew').val();
		var addr = $('#txtaddrnew').val();
		var ref = $('#txtreferencerrnew').val();
		var warehouse = $('#cbowarehousemannew').children("option:selected").val();
		var dept = $('#cbodeptnew').children("option:selected").val();
		var clientdate = $('#txtclientdatenew').val();

		if (rrno == "" || vendor_id == "" || addr_id == ""){
			Swal.fire({
				type: 'error',
				title: 'Oops...',
				text: 'Fill in RRNo field.'
			})
		}
		else {
			xajax_insertitemrrinfo(rrno,vendor_id,addr_id,clientdate,ref,warehouse,dept);
			var table = $('#frameitemsrr').contents().find('#tblnewitemrr').DataTable();
			table
			.column(0)
			.data()
			.each(function(value, index) {
				var qty = $('#frameitemsrr').contents().find('#txtqtyrr' + index).val();
				//alert( 'Data in index: '+index+' is: '+value );
				xajax_insertitemrr(value,rrno,qty);
				xajax_updateitembalance(value,qty);
				//alert(rrno);
			} );

			/*Swal.fire({
				type: 'success',
				title: '',
				text: 'Successfully added.'
			})*/
			document.getElementById('frameitemsrr').contentWindow.location.reload();
		}
		//document.getElementById("frameitemsrr").contentWindow.insertnewitemrr(rrno);
		
	});
	$('#btndeselectall').click(function(){
		Swal.fire({
			title: 'Are you sure?',
			text: "You won't be able to revert this!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, remove all!'
		}).then((result) => {
			if (result.value) {
				$.ajax({
					url:xajax_deselectallitem(),
					complete:function(){
						Swal.fire({
							type: 'success',
							title: '',
							text: 'Successfully removed.'
						})
						document.getElementById('frameitemsrr').contentWindow.location.reload();
					}
				})
			}
		})
	});
	$('#btnrrupdatecrnew').click(function(){
		var rrno = $('#txtrrnocrnew').val();
		var rrnohidprev = $('#txtrrnocrnewhid').val();
		//alert(rrnohidprev);
		var vendorid = $('#txtvendoridcrnew').val();
		var addrid = $('#txtaddridcrnew').val();
		var client_date = $('#txtclientdatecrnew').val();
		var ref = $('#txtreferencerrcrnew').val();
		/*var ware = $('#cbowarehousemancrnew').val();
		var dept = $('#cbodeptcrnew').val();*/
		var ware = $('#cbowarehousemancrnew').children("option:selected").val();
		var dept = $('#cbodeptcrnew').children("option:selected").val();

		xajax_updateitemrrinfo(rrno,rrnohidprev,vendorid,addrid,client_date,ref,ware,dept);
		document.getElementById('frameitemsrrcr').contentWindow.location.reload();
		var table = $('#frameitemsrrcr').contents().find('#tblnewitemrr').DataTable();
		table
		.column(0)
		.data()
		.each(function(value, index) {
			//alert(value + index);
			var qty = $('#frameitemsrrcr').contents().find('#txtqty' + index).val();
			var qtyprev = $('#frameitemsrrcr').contents().find('#txtqtyprev' + index).val();
			var ucost = $('#frameitemsrrcr').contents().find('#txtucost' + index).val();
			//alert(ucost);
			xajax_updateitemqty(value,qty,rrno,rrnohidprev,qtyprev,ucost);
		});
		document.getElementById('frameitemsrrcr').contentWindow.location.reload();
		Swal.fire({
			type: 'success',
			title: '',
			text: 'Successfully added.'
		})
	});
	$('#btnsissavecr').click(function(){
		var dateissued = $('#txtdateissuedcr').val();
		var cust_name = $('#txtsiscustcr').val();
		var cust_id = $('#txtsiscustidcr').val();
		var addr_name = $('#txtsisaddrcr').val();
		var addr_id = $('#txtsisaddridcr').val();
		var ref = $('#txtreferencesiscr').val();
		var remarks = $('#txtremarksiscr').val();
		var rrno = $('#txtissuednocr').val();
		var loc = $('#txtlocationsiscr').val();
		var sisno = $('#txtsisnoitems').val();
		var cboprep = $('#cboprepby').children("option:selected").val();
		var cborec = $('#cborecby').children("option:selected").val();
		var cbonote = $('#cbonotedby').children("option:selected").val();
		//alert(sisno);
		if(cust_id == "" || addr_id == "" || sisno == ""){
			Swal.fire({
				type: 'error',
				title: 'Oops...',
				text: 'Fill in missing fields'
			})
			
		}
		else {
			if (countsisitems == ""){
				Swal.fire({
					type: 'error',
					title: 'Oops...',
					text: 'Select item first.'
				})
			}
			else {

				var qty = $('#frameitemsis').contents().find('#txtqtysis' + countsisitems).val();
				var qtysishid = $('#frameitemsis').contents().find('#txtqtysis' + countsisitems).val();
				var lastbalance = $('#framebalsis').contents().find('#txtbalance').val();
				var countbalance = $('#framebalsis').contents().find('#txtcountbalance').val();
				//alert(lastbalance);

				if (parseFloat(qty) > parseFloat(lastbalance) && parseFloat(countbalance) != 0){
					//alert("dli pwde");
					Swal.fire({
						type: 'error',
						title: 'Oops...',
						text: 'The value exceeded from current balance.'
					})
				}
				/*if(qty <= 0){
					Swal.fire({
						type: 'error',
						title: 'Oops...',
						text: 'The quantity must greater than 0.'
					})
				}*/
				else if(parseFloat(qty) <= parseFloat(lastbalance) || parseFloat(countbalance) == 0) {
					xajax_insertsis(rrno,cust_id,addr_id,dateissued,sisno,loc,ref,remarks,cboprep,cborec,cbonote);
					xajax_insertitemsis(items_id,sisno,qty,qtysishid,rrno);
					
					Swal.fire({
						type: 'success',
						title: '',
						text: 'SIS Successfully saved.'
					}).then(function() {
                        document.getElementById('frameitemsis').contentWindow.location.reload();
                        //history.go(0);
                      });
					
					//alert("okeh keyoh");
				}
				else if(parseFloat(qty) == 0) {
					Swal.fire({
						type: 'warning',
						title: '',
						text: 'Quantity should not zero.'
					})
				}
				/*else if(parseFloat(countbalance) == 0){

				}*/
				//xajax_insertsis(rrno,cust_id,addr_id,dateissued,sisno,loc,ref,remarks);
				/*var qty = $('#frameitemsis').contents().find('#txtqtysis' + countsisitems).val();
				var qtysishid = $('#frameitemsis').contents().find('#txtqtysis' + countsisitems).val();
				var lastbalance = $('#framebalsis').contents().find('#txtbalance').val();*/
				//alert(qty);
				
				/*//xajax_insertitemsis(items_id,sisno,qty,qtysishid,rrno);
				document.getElementById('frameitemsis').contentWindow.location.reload();
				//document.getElementById('framebalsis').contentWindow.location.reload();
				Swal.fire({
					type: 'success',
					title: '',
					text: 'SIS Successfully saved.'
				})*/
			}

			/*xajax_insertsis(rrno,cust_id,addr_id,dateissued,sisno,loc,ref,remarks);
			var table = $('#frameitemsis').contents().find('#tblnewitemsis').DataTable();

			table
			.column(1)
			.data()
			.each(function(value, index) {

				var checks = $('iframe[name=frameitemsis]').contents().find('#txtchkboxsis'+index).prop('checked');
				var con = checks ? 1 : 0;
				if (con == 1){
					var qty = $('#frameitemsis').contents().find('#txtqtysis' + index).val();
					var qtysishid = $('#frameitemsis').contents().find('#txtqtysishid' + index).val();
					//xajax_insertitemsis(value,sisno,qty,qtysishid);
					//alert("qty:" + qty + "qtysishid:" + qtysishid);
				}
			} );
			document.getElementById('frameitemsis').contentWindow.location.reload();
			Swal.fire({
				type: 'success',
				title: '',
				text: 'SIS Successfully saved.'
			})*/
		}

	});
	$('#btnsisupdatecr').click(function(){
		var dateissued = $('#txtdateissuedcr').val();
		var cust_name = $('#txtsiscustcr').val();
		var cust_id = $('#txtsiscustidcr').val();
		var addr_name = $('#txtsisaddrcr').val();
		var addr_id = $('#txtsisaddridcr').val();
		var ref = $('#txtreferencesiscr').val();
		var remarks = $('#txtremarksiscr').val();
		var sisno = $('#txtsisnoitems').val();
		var loc = $('#txtlocationsiscr').val();
		var rrno = $('#txtissuednocr').val();

		if(cust_id == "" || addr_id == "" || sisno == ""){
			Swal.fire({
				type: 'error',
				title: 'Oops...',
				text: 'Fill in missing fields'
			})
			
		}
		else {
			if(countsisbal == ""){
				Swal.fire({
					type: 'error',
					title: 'Oops...',
					text: 'Select SIS to edit first.'
				})
			}
			else {
				var qty = $('#framebalsis').contents().find('#txtsisqty' + countsisbal).text();
				var prevqty = $('#framebalsis').contents().find('#txtprevqty' + countsisbal).val();
				//alert(prevqty);
				xajax_updatesisinfo(rrno,cust_id,addr_id,dateissued,loc,sisno,ref,remarks);
				//alert(qty);
				xajax_updatesisitemqty(sisbalitemid,qty,sisno,prevqty);
				//alert(si);
				Swal.fire({
					type: 'success',
					title: '',
					text: 'SIS Successfully updateds.'
				})			
				document.getElementById('frameitemsis').contentWindow.location.reload();
			}

			/*xajax_updatesisinfo(sisno,cust_id,addr_id,dateissued,loc,sisno,ref,remarks);
			var table = $('#frameitemsis').contents().find('#tblnewitemsis').DataTable();
			table
			.column(1)
			.data()
			.each(function(value, index) {
				var checks = $('iframe[name=frameitemsis]').contents().find('#txtchkboxsis'+index).prop('checked');
				var con = checks ? 1 : 0;
				if (con == 1){
					//alert(value);
					var qty = $('#frameitemsis').contents().find('#txtqtysis' + index).val();
					var qtysishid = $('#frameitemsis').contents().find('#txtqtysishid' + index).val();
					xajax_updatesisitemqty(value,qty,sisno,qtysishid);
				}
				
			} );
			document.getElementById('frameitemsis').contentWindow.location.reload();
			Swal.fire({
				type: 'success',
				title: '',
				text: 'SIS Successfully updated.'
			})*/
		}
	});
	$('#btnprintitemrr').click(function(){
		//alert('sad');
		var rrno = $('#txtrrnocrnew').val();
		window.open ('print/rr_print_items.php?rrno='+ rrno);

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
	$(document).ready(function() {
		$('#txtvendornew').typeahead({
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
					var lastid = $('#txtlastvendoridnew').val();
					$('#txtvendoridnew').val(lastid);
				}else {
					//$('#txtvendor').val(item.value);
					$('#txtvendoridnew').val(item.id);
					
				}
				return item.value;
				
			}
		});

		$('#txtvendornew').on('input', function() {
			if ($('#txtvendornew').val() == ""){
				$('#txtvendoridnew').val("");
			}
		});
		//
		$('#txtsiscustcr').typeahead({
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
					var lastid = $('#txtlastcustidcr').val();
					$('#txtsiscustidcr').val(lastid);
				}else {
					//$('#txtvendor').val(item.value);
					$('#txtsiscustidcr').val(item.id);
					
				}
				return item.value;
				
			}
		});
		
		$('#txtsiscustcr').on('input', function() {
			if ($('#txtsiscustcr').val() == ""){
				$('#txtsiscustidcr').val("");
			}
		});
		//
		$('#txtsisaddrcr').typeahead({
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
					var lastidaddr = $('#txtlastaddridsiscr').val(); 
					$('#txtsisaddridcr').val(lastidaddr);
				}else {
					$('#txtsisaddridcr').val(item.id);
					
				}
				return item.value;
			}
		});
		$('#txtsisaddrcr').on('input', function() {
			if ($('#txtsisaddridcr').val() == ""){
				$('#txtsisaddridcr').val("");
			}
		});
		//
		$('#txtvendorcrnew').typeahead({
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
					var lastid = $('#txtlastvendoridcrnew').val();
					$('#txtvendoridcrnew').val(lastid);
				}else {
					$('#txtvendoridcrnew').val(item.id);
					
				}
				return item.value;
				
			}
		});

		$('#txtvendornew').on('input', function() {
			if ($('#txtvendornew').val() == ""){
				$('#txtvendoridnew').val("");
			}
		});
		//
		$('#txtaddrnew').typeahead({
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
					var lastidaddrnew = $('#txtlastaddridnew').val(); 
					$('#txtaddridnew').val(lastidaddr);	
				}else {
					$('#txtaddridnew').val(item.id);
					
				}
				return item.value;
			}
		});
		$('#txtaddrnew').on('input', function() {
			if ($('#txtaddrnew').val() == ""){
				$('#txtaddridnew').val("");
			}
		});
		//
		$('#txtaddrcrnew').typeahead({
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
					var lastidaddrnew = $('#txtlastaddridcrnew').val(); 
					$('#txtaddridcrnew').val(lastidaddrnew);
					//alert(lastidaddrnew);	
				}else {
					$('#txtaddridcrnew').val(item.id);
					//alert(item.id);
					
				}
				return item.value;
			}
		});
		$('#txtaddrcrnew').on('input', function() {
			if ($('#txtaddrcrnew').val() == ""){
				$('#txtaddridcrnew').val("");
			}
		});
	});

$('#rrmodal').draggable({
	handle: ".modal-header"
});
$('#itemsmodal').draggable({
	handle: ".modal-header"
});
$('#itemsmodal2').draggable({
	handle: ".modal-header"
});

/*$(document).ready(function() {

	$('.modal').on('hidden.bs.modal', function(event) {
		$(this).removeClass( 'fv-modal-stack' );
		$('body').data( 'fv_open_modals', $('body').data( 'fv_open_modals' ) - 1 );
	});

	$('.modal').on('shown.bs.modal', function (event) {
        // keep track of the number of open modals
        if ( typeof( $('body').data( 'fv_open_modals' ) ) == 'undefined' ) {
        	$('body').data( 'fv_open_modals', 0 );
        }

        // if the z-index of this modal has been set, ignore.
        if ($(this).hasClass('fv-modal-stack')) {
        	return;
        }

        $(this).addClass('fv-modal-stack');
        $('body').data('fv_open_modals', $('body').data('fv_open_modals' ) + 1 );
        $(this).css('z-index', 1040 + (10 * $('body').data('fv_open_modals' )));
        $('.modal-backdrop').not('.fv-modal-stack').css('z-index', 1039 + (10 * $('body').data('fv_open_modals')));
        $('.modal-backdrop').not('fv-modal-stack').addClass('fv-modal-stack'); 

    });        
});*/

$(document).on('show.bs.modal', '.modal', function () {
	var zIndex = calculateZIndex();

	$(this).css('z-index', zIndex);

	setTimeout(function () {
		$('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
	}, 0);
})
$(document).on('hidden.bs.modal', '.modal', function () {
	$('.modal:visible').length && $(document.body).addClass('modal-open');
})
function calculateZIndex() {
	var zIndex = Math.max.apply(null, Array.prototype.map.call(document.querySelectorAll('*'), function (el) {
		return +el.style.zIndex;
	})) + 10;

	return zIndex;
}

</script>
</body>
</html>