<?php
//session_start();
/*include('../../../classes/inc/dbConInventory.php');*/
/*include('../../../classes/inc/dbCon.php');*/
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
<style type="text/css">
	

</style>
<body id="page-top">
	<button id="btncreatenewitem" class="btn btn-primary" style="float: right;">
		<i style="padding-right: 5px;" class="fas fa-folder"></i>New Item
	</button><br><br>
	<!-- RR TABLE -->
	<div class="card mb-3">
		<div class="card-header" style="background-color: #3399CC;color: white;">
			<i class="fas fa-table"></i>
		Items Table</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-hover" id="dataTable3" data-show-refresh="true"
				data-auto-refresh="true"
				data-pagination="true" data-target = "items_content" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>ID</th>
						<th>Description</th>
						<th>Unit</th>
						<th>Date Created</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody id = "tablerows">
					<?php
					include('tables/items_new_load.php');
					?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
</div>
<!-- Modal for creating -->
<div class="modal fade bd-example-modal-lg" id="itemnewmodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content" style="width: 500px;min-height: 350px;">
			<div class="modal-header" style="background-color: #17A2B8;color:white;">
				<h5 class="modal-title" id="formModalLabel">Add New Item</h5>
			</div>
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<div class="form-group" style="margin-left: 10px;">New Item</div>
				<div>
					<form action="loadmaterials.php" method="GET" enctype="multipart/form-data">
						<div style="border: 1px;min-height: 100px;min-width:300px;line-height: 50px;margin: 10px;">
							<div class="form-group row">
								<label class="col-sm-3 col-form-label" id="" style="height: 30px;">Description:</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="txtdescription" placeholder="" style="height:30px;">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-3 col-form-label" id="" style="height: 30px;">Unit:</label>
								<div class="col-sm-8">
									<?php
									global $dbinv;
									$sql = "SELECT *FROM tblunits";
									$result=$dbinv->query($sql);
									$c=1;

									echo '<select class="form-control" id="cbounits">';
									echo '<option value= "0" selected disabled>- Select -</option>';
									if ($result->num_rows > 0 ){
										while ($row=$result->fetch_assoc()){
											echo '<option>'.$row['Unit'].'</option>';
										}
									}
									echo '</select>';
									?>

								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-3 col-form-label" id="" style="height: 30px;">Type:</label>
								<div class="col-sm-8">
									<!-- <input type="text" class="form-control" id="txttype" placeholder="" style="height:30px;"> -->
									<select class="form-control" id="txttype">
										<option>Inventory</option>
										<option>Non-Inventory</option>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-3 col-form-label" id="" style="height: 30px;">Class:</label>
								<div class="col-sm-8">
									<!-- <input type="text" class="form-control" id="txtclass" placeholder="" style="height:30px;"> -->
									<select class="form-control" id="txtclass">
										<option>Raw</option>
										<option>FG</option>
										<option>Equipment</option>
										<option>Supply</option>
									</select>
								</div>
							</div>
							<!-- <div class="form-group row">
								<label class="col-sm-3 col-form-label">Quantity</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="txtbalance" name="txtbalance">
								</div>
							</div> -->

						</div>
					</form>
					<div class="modal-footer">
						<button type="button" class="btn btn-info" id="btnaddnewitem"><i style="padding-right: 5px;" class="fas fa-save"></i>Save</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnFormClose"><i style="padding-right: 5px;" class="fa fa-close"></i>Close</button>

					</div>

				</div>


			</table>

		</div>


	</div>
</div>
<!-- END -->

<!-- Modal for creating -->
<div class="modal fade bd-example-modal-lg" id="itemneweditmodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content" style="width: 500px;min-height: 350px;">
			<div class="modal-header" style="background-color: #17A2B8;color:white;">
				<h5 class="modal-title" id="formModalLabel">Add New Item</h5>
			</div>
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<div class="form-group" style="margin-left: 10px;">New Item</div>
				<div>
					<form action="loadmaterials.php" method="GET" enctype="multipart/form-data">
						<div style="border: 1px;min-height: 100px;min-width:300px;line-height: 50px;margin: 10px;">
							<div class="form-group row">
								<label class="col-sm-3 col-form-label" id="" style="height: 30px;">Description:</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="txtdescriptionedit" placeholder="" style="height:30px;">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-3 col-form-label" id="" style="height: 30px;">Unit:</label>
								<div class="col-sm-8">
									<?php
									global $dbinv;
									$sql = "SELECT *FROM tblunits";
									$result=$dbinv->query($sql);
									$c=1;

									echo '<select class="form-control" id="cbounitsedit">';
									echo '<option value= "0" selected disabled>- Select -</option>';
									if ($result->num_rows > 0 ){
										while ($row=$result->fetch_assoc()){
											echo '<option value= "'.$row['Unit'].'">'.$row['Unit'].'</option>';
										}
									}
									echo '</select>';
									?>

								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-3 col-form-label" id="" style="height: 30px;">Type:</label>
								<div class="col-sm-8">
									<select class="form-control" id="txttypeedit">
										<option>Inventory</option>
										<option>Non-Inventory</option>
									</select>
								</div>
								<!-- <div class="col-sm-8">
									<input type="text" class="form-control" id="txttypeedit" placeholder="" style="height:30px;">
								</div> -->
							</div>
							<div class="form-group row">
								<label class="col-sm-3 col-form-label" id="" style="height: 30px;">Class:</label>
								<div class="col-sm-8">
									<select class="form-control" id="txtclassedit">
										<option>Raw</option>
										<option>FG</option>
										<option>Equipment</option>
										<option>Supply</option>
									</select>
								</div>
								<!-- <div class="col-sm-8">
									<input type="text" class="form-control" id="txtclassedit" placeholder="" style="height:30px;">
								</div> -->
							</div>
							<!-- <div class="form-group row">
								<label class="col-sm-3 col-form-label">Quantity</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="txtbalanceedit" name="txtbalance">
								</div>
							</div> -->
						</div>
					</form>
					<div class="modal-footer">
						<button type="button" class="btn btn-info" id="btnaddnewitemedit"><i style="padding-right: 5px;" class="fas fa-save"></i>Save</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnFormClose"><i style="padding-right: 5px;" class="fa fa-close"></i>Close</button>

					</div>

				</div>


			</table>

		</div>


	</div>
</div>
<!-- END -->
<script src="../../../vendor/jquery/jquery.min.js"></script>
<script src="../../../vendor/jquery/jquery-ui.js"></script>
<script src="../../../vendor/jquery/jquery-ui.min.js"></script>
<script src="../../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="../../../vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Page level plugin JavaScript-->
<!-- <script src="../../vendor/chart.js/Chart.min.js"></script> -->
<script src="../../../vendor/datatables/jquery.dataTables.js"></script>
<script src="../../../vendor/datatables/dataTables.bootstrap4.js"></script>

<!-- Custom scripts for all pages-->
<script src="../../../js/sb-admin.min.js"></script>
<script src="../../../vendor/jquery/jquery.datetimepicker.js"></script>

<!-- Demo scripts for this page-->
<!-- <script src="../../../js/demo/datatables-demo.js"></script> -->
<script src="../../../vendor/bootstrap/js/bootstrap3-typeahead.min.js" type="text/javascript"></script>
<script src="../../../vendor/bootstrap/js/bootstrap3-typeahead.js" type="text/javascript"></script>

<script src="../../../vendor/bootstrap/js/jquery.autocomplete.js" type="text/javascript"></script>
<script src="../../../vendor/bootstrap/js/jquery.autocomplete.min.js" type="text/javascript"></script>
<script src="../../../vendor/bootstrap/js/sweetalert2.js" type="text/javascript"></script>

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

	var myids = "";
	$('#btncreatenewitem').click(function(){
		$('#itemnewmodal').modal('show');
	});
	function newitem(){	
		var desc = $('#txtdescription').val();
		var units = $('#cbounits').val();
		var types = $('#txttype').val();
		var classes = $('#txtclass').val();
		//var balance = $('#txtbalance').val();
		$.ajax({
			url: xajax_insertnewitem(desc,units,0,types,classes),
			complete: function(data)
			{
					//$("#dataTable3").html("tables/items_new_load.php");
					//$('#dataTable3').DataTable().clear().draw();
					$("#tablerows").load("tables/items_new_load.php");

				}
			});
	}
	function selectitemnew(myid,description,unit){
		$('#txtdescriptionedit').val(description);
		$('#cbounitsedit').val(unit);
		myids = myid
		//$('#txtbalanceedit').val(balance);
		$('#itemneweditmodal').modal('show');
	}
	function deletenewitem(myid){
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
					url: xajax_deletenewitem(myid),
					complete: function(data)
					{
						Swal.fire({
							type: 'success',
							title: '',
							text: 'Item Deleted.'
						})
						$("#tablerows").load("tables/items_new_load.php");

					}
				});
			}
		})
		
		//xajax_deletenewitem(myid);
	}
	var container = $('#dataTable3');
	$('#btnaddnewitem').click(function(){
		newitem();
	});
	$('#btnaddnewitemedit').click(function(){
		var description = $('#txtdescriptionedit').val();
		var unit = $('#cbounitsedit').val();
		var balance = $('#txtbalanceedit').val();
		var types = $('#txttypeedit').val();
		var classes = $('#txtclassedit').val();
		//alert(types);
		$.ajax({
			url: xajax_updatenewitem(myids,description,unit,types,classes),
			complete: function(data)
			{
					//$("#dataTable3").html("tables/items_new_load.php");
					//$('#dataTable3').DataTable().clear().draw();
					$("#tablerows").load("tables/items_new_load.php");

				}
			});
		
	});
	$('#itemnewmodal').draggable({
		handle: ".modal-header"
	});

	$(document).ready(function() {
		$('.modal').on('hidden.bs.modal', function(event) {
			$(this).removeClass( 'fv-modal-stack' );
			$('body').data( 'fv_open_modals', $('body').data( 'fv_open_modals' ) - 1 );
		});

		$('.modal').on('shown.bs.modal', function (event) {
			if ( typeof( $('body').data( 'fv_open_modals' ) ) == 'undefined' ) {
				$('body').data( 'fv_open_modals', 0 );
			}
			if ($(this).hasClass('fv-modal-stack')) {
				return;
			}

			$(this).addClass('fv-modal-stack');
			$('body').data('fv_open_modals', $('body').data('fv_open_modals' ) + 1 );
			$(this).css('z-index', 1040 + (10 * $('body').data('fv_open_modals' )));
			$('.modal-backdrop').not('.fv-modal-stack').css('z-index', 1039 + (10 * $('body').data('fv_open_modals')));
			$('.modal-backdrop').not('fv-modal-stack').addClass('fv-modal-stack'); 

		});        
	});
</script>
</body>
</html>