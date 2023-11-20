<?php
//session_start();
/*include('../../../classes/inc/dbConInventory.php');*/
include('../../../classes/inc/dbCon.php');
//require('../admin.common.php');
require('purchasing.common.php');
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
<head>
  <!-- <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content=""> -->
</head>
<title>Purchasing</title>
<style type="text/css">
tfoot input {
  width: 100px;
}
</style>
<body id="page-top">


  <p id="date_filter">
    <span id="date-label-from" class="date-label">From: </span><input class="date_range_filter date" type="text" id="datepicker_from" />
    <span id="date-label-to" class="date-label">To:&nbsp;&nbsp;</span><input class="date_range_filter date" type="text" id="datepicker_to" />
    <button id="btnprintreport" class="btn btn-info"><i style ="padding-right:5px;" class="fas fa-print"></i>PRINT</button>
    <select id="cboreporttype">
      <option>ALL</option>
      <option>SPECIFIC PLATE</option>
    </select>
    <button class="btn btn-secondary" type="button" class="btn btn-info" id="btnpurchitemreport">Generate Report</button>
    <button class="btn btn-info" type="button" class="btn btn-info" id="btnnewpurchitem" style="float:right;"><i style ="padding-right:5px;" class="fa fa-plus-square"></i>Create New</button>
    <div class="card mb-3">
      <div class="card-header" style="background-color: #3399CC;color: white;">
        <i class="fas fa-table"></i>
      Items Table</div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover" id="tblfuelinfo" width="100%" cellspacing="0">
            <thead id="thfuel">

              <!-- <th>Plate No.</th>
              <th style="min-width: 500px;">Assignee</th>
              <th style="min-width: 200px;">Item</th>
              <th style="min-width: 200px;">Item</th>
              <th style="min-width: 200px;">Item</th>
              <th style="min-width: 200px;">Item</th>
              <th style="min-width: 200px;">Item</th>
              <th style="min-width: 200px;">Item</th>
              <th style="min-width: 200px;">Item</th>
              <th style="min-width: 200px;">Item</th>
              <th style="min-width: 200px;">Item</th>
              <th style="min-width: 200px;">Item</th>
              <th style="min-width: 200px;">Item</th>
              <th style="min-width: 200px;">Item</th>
              <th>Action</th> -->
              <!-- <th>Plate No.</th>
              <th style="min-width: 500px;">Assignee</th>
              <th style="min-width: 200px;">Item</th>
              <th style="min-width: 200px;">Item</th>
              <th style="min-width: 200px;">Item</th>
              <th style="min-width: 200px;">Item</th>
              <th style="min-width: 200px;">Item</th>
              <th style="min-width: 200px;">Item</th>
              <th style="min-width: 200px;">Item</th>
              <th style="min-width: 200px;">Item</th>
              <th style="min-width: 200px;">Item</th>
              <th style="min-width: 200px;">Item</th>
              <th style="min-width: 200px;">Item</th>
              <th style="min-width: 200px;">Item</th>
              <th>Action</th> -->
              <th class="all">ID</th>
              <th class="all">Plate ID.</th>
              <th class="all">Plate No.</th>
              <th class="all">Description</th>
              <th class="all">Assignee</th>
              <th class="all">Fuel Name</th>
              <th class="all">LITER/S</th>
              <th class="all">Price</th>
              <th class="all">Total Amount</th>
              <th class="all">Supplier</th>
              <th class="all">Model</th>
              
              <th class="all">RF No.</th>
              <th class="all">Date</th>
              <th class="all">PO No.</th>
              <th class="all">Date</th>
              <th class="all">Requested By</th>
              <th class="all">Ref No.</th>
              <th class="all">Date</th>
              <th class="all">CV/JV No.</th>
              <th class="all">Other Ref.</th>
              <th class="all">Remarks</th>

            </thead>
            <tbody>
              <?php
              include('tables/fuel_main_table.php');
              ?>
            </tbody>
            <tfoot style="width:50px;" rowspan = "0" colspan = "0" id="sample2">
              <tr>
          <!-- <th>Plate No.</th>
              <th style="min-width: 500px;">Assignee</th>
              <th style="min-width: 200px;">Item</th>
              <th style="min-width: 200px;">Item</th>
              <th style="min-width: 200px;">Item</th>
              <th style="min-width: 200px;">Item</th>
              <th style="min-width: 200px;">Item</th>
              <th style="min-width: 200px;">Item</th>
              <th style="min-width: 200px;">Item</th>
              <th style="min-width: 200px;">Item</th>
              <th style="min-width: 200px;">Item</th>
              <th style="min-width: 200px;">Item</th>
              <th style="min-width: 200px;">Item</th>
              <th style="min-width: 200px;">Item</th>
              <th>Action</th> -->
              <th class="all" id="footerid">ID</th>
              <th class="all">Plate No.</th>
              <th class="all">Plate ID.</th>
              <th class="all">Description</th>
              <th class="all">Assignee</th>
              <th class="all">Fuel Name</th>
              <th class="all">LITER/S</th>
              <th class="all">Price</th>
              <th class="all">Total Amount</th>
              <th class="all">Model</th>
              <th class="all">Supplier</th>
              <th class="all">RF No.</th>
              <th class="all">Date</th>
              <th class="all">PO No.</th>
              <th class="all">Date</th>
              <th class="all">Requested By</th>
              <th class="all">Ref No.</th>
              <th class="all">Date</th>
              <th class="all">CV/JV No.</th>
              <th class="all">Other Ref.</th>
              <th class="all">Remarks</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
  </div> 
  <!-- New Purchase item -->
  <!-- Edit Request Material -->
  <div class="modal fade bd-example-modal-lg" id="purchaseitemmodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" style="width: 1200px;min-height:650px;margin-left: -180px;">
        <div class="modal-header" style="background-color: #17A2B8;color:white;">
          <h5 class="modal-title" id="formModalLabel">New Purchase Item</h5>
          <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnFormClose"><i class="fa fa-close"></i>
          </button>
        </div>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <div style="margin-left: 10px;">Item Info</div>

          <div style="float: right;border: 1px;">
            <!-- <form action="" method="GET" enctype="multipart/form-data"> -->
              <div style="border: 1px;min-height: 100px;min-width:300px;line-height: 50px;margin: 10px;">
                <div id="leftmat" style="border: 1px;min-width: 600px;float: left;">
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Plate No:</label>
                    <div class="col-sm-8">                        
                      <input type="text" class="form-control" name="" id="txtplatenos" placeholder="" style="height: 30px;" disabled>

                      <!-- <input type="hidden" class="form-control" id="mwrfidmaterialhidden" placeholder="" style="height: 30px;"> -->
                    </div>
                    <div class="col-sm-2">
                      <button class="btn btn-primary" id="btnplatemodal"><i class = "fa fa-plus-circle"></i></button>
                      <!-- <input type="hidden" class="form-control" id="mwrfidmaterialhidden" placeholder="" style="height: 30px;"> -->
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Assignee:</label>
                    <div class="col-sm-10">
                      <textarea type="text" class="form-control" id="txtassign" placeholder="" style="height: 30px;"></textarea>
                      <input type="hidden" class="form-control" id="txtassignid" placeholder="" style="height: 30px;">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Fuel:</label>
                    <div class="col-sm-8">                        
                      <input type="text" class="form-control" name="" id="txtfuelname" placeholder="" style="height: 30px;" >

                      <!-- <input type="hidden" class="form-control" id="mwrfidmaterialhidden" placeholder="" style="height: 30px;"> -->
                    </div>
                    <div class="col-sm-2">
                      <!-- <button class="btn btn-primary" id="btnplatemodal"><i class = "fa fa-plus-circle"></i></button> -->
                      <!-- <input type="hidden" class="form-control" id="mwrfidmaterialhidden" placeholder="" style="height: 30px;"> -->
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Description:</label>
                    <div class="col-sm-10">
                      <select class="form-control" id="txtdesc">
                        <option>Vehicles and Machineries</option>
                        <option>Non Sagrex Vehicles</option>
                        <option>Motor Rental</option>
                      </select>
                      <!-- <input type="text" class="form-control" id="txtdesc" placeholder="" style="height: 30px;" > -->
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Liters[s]:</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="txtqty" placeholder="" style="height: 30px;" >
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Price:</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="txtprice" placeholder="" style="height: 30px;" >
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Amount:</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="txtamount" placeholder="" style="height: 30px;" >
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Model:</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="txtmodel" placeholder="" style="height: 30px;" >
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Supplier:</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="txtsupp" placeholder="" style="height: 30px;" >
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label" id="" style="height: 30px;">RF NO:</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="txtrfno" placeholder="" style="height: 50px;">
                    </div>
                  </div>

                </div>
                <!-- <div id></div> -->
                <div id = "rightmat" style="border: 1px;width: 550px;float: right;">
                  
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Date:</label>
                    <div class="col-sm-10">
                      <input type="date" class="form-control" id="txtdaterfno" placeholder="" style="height: 30px;" >
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label" id="" style="height: 30px;">PO NO:</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="txtpono" placeholder="" style="height: 30px;" >
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Date:</label>
                    <div class="col-sm-10">
                      <input type="date" class="form-control" id="txtponodate" placeholder="" style="height: 30px;" >
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Req By:</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="txtreqby" placeholder="" style="height: 30px;" >
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label" id="" style="height: 30px;">REF NO:</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="txtrefno" placeholder="" style="height: 30px;" >
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Date:</label>
                    <div class="col-sm-10">
                      <input type="date" class="form-control" id="txtdaterefno" placeholder="" style="height: 30px;" >
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label" id="" style="height: 30px;">CV/JV:</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="txtref" placeholder="" style="height: 30px;" >
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label" id="" style="height: 30px;">OTHER REF:</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="txtotherref" placeholder="" style="height: 30px;" >
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Remark:</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="txtremark" placeholder="" style="height: 30px;" >
                    </div>
                  </div>
                </div>      
              </div>

              <!-- </form> -->
              <div class="modal-footer" style="border: 1px;float: right;"> 
                <button type="button" class="btn btn-info" id="btnsaveasitem">
                  <i style="padding-right: 5px;" class="fas fa-save"></i>SAVE AS NEW</button>    
                  <button type="button" class="btn btn-info" id="btnsaveitem">
                    <i style="padding-right: 5px;" class="fas fa-save"></i>SAVE</button>
                    <button type="button" class="btn btn-info" name="btnupdateitem" id="btnupdateitem" style=""><i style="padding-right: 5px;" class="fa fa-refresh"></i>UPDATE</button>

                  </div>
                          <!-- <thead class="table table-bordered" style="border-top: 0px solid #17A2B8;table-layout: fixed;background-color: #17A2B8;color: white;" align="center">
                            <tr>
                              <th style = "width:180px;">Materials</th>
                              <th style = "width:70px;">Quantity</th>
                              <th style = "width:120px;">Unit Price</th>
                              <th style = "width:120px;">Amount</th>
                              <th style = "width:120px;">Date Granted</th>
                              <th style = "width:140px;">Shop</th>
                              <th style = "width:140px;">Request Type</th>
                              <th style = "width:180px;">Action</th>
                            </tr>
                          </thead>
                          <div style="height:0px;min-width:500px;margin-right:2px;">
                            <table class="table table-bordered" id="mtable1" cellspacing="0">

                              <tbody id="mtable2">
                                <iframe style="border-bottom:2px solid #17A2B8;margin-top: -20px;" name="framemat" id="framemat" src="pur_loadmaterials.php" allowfullscreen/></iframe>
                              </tbody>
                            </table>
                            <div class="form-group row">
                              <label id="" style="height: 30px;margin-left: 20px;">Grand Total:</label>
                              <div class="col-sm-2">
                                <input type="text" class="form-control" id="txtgrandtotal" name="txtgrandtotal" disabled="" style="color: red;">
                              </div>
                            </div>
                          </div> -->


                        </div>


                      </table>

                    </div>
                  </div>
                </div>
                <!-- end -->

                <!-- start -->

                <div class="modal fade bd-example-modal-lg" id="selectplatemodal" tabindex="1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg modal-dialog-centered" role="document" style="width: auto;">
                    <div class="modal-content" style="width: 1400px;height: 800px;">
                      <div class="modal-header" style="background-color: #17A2B8;color:white;">
                        <h5 class="modal-title" id="formModalLabel"><strong>Select Plate[s]</strong></h5>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnFormClose" style="border:0px;color: white;"><i class="fa fa-close"></i></button>
                      </div>

                      <div class="form-group row" style="border-bottom:1px solid black;">
                        <label class="col-sm-1col-form-label" style = "margin-left:20px;">Plate No.</label>
                        <!-- <input type="text" class="form-control" id="txtamount" placeholder="" style="height: 30px;"> -->
                        <div class="col-sm-3">
                          <input type="text" class="form-control" id="txtplatenosnew" placeholder="" style="height: 50px;" disabled>
                        </div>
                        <button type="button" class="btn btn-success" id="btnnewplate">CREATE</button>&nbsp;
                        <button type="button" class="btn btn-success" id="btnsaveplate">SAVE</button>&nbsp;
                        <button type="button" class="btn btn-success" id="btnupdateplate" disabled>UPDATE</button>
                      </div>

                      <table class="table table-bordered table-striped" id="mtable1" cellspacing="0">
                        <tbody id="mtable2">
                          <iframe style="border: 0px;padding-left: 10px;height: 800px;" width="100%" name="frameplates" id="frameplates" src="iframes/plate_view.php?mwrfid=" /></iframe>
                        </tbody>
                      </table>

                    </div>
                  </div>
                </div>
                <!-- end -->



                <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
                  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script> -->
                  <script src="../../../vendor/jquery/jquery.min.js"></script>
                  <script src="../../../vendor/jquery/jquery-ui.js"></script>
                  <script src="../../../vendor/jquery/jquery-ui.min.js"></script>
                  
                  <script src="../../../vendor/bootstrap/js/bootstrap.bundle.min.js" type="text/javascript"></script>

                  <script src="../../../vendor/jquery-easing/jquery.easing.min.js" type="text/javascript"></script>

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
                    var plate_id = "";
                    function editplate(id,platenos){
                      $('#txtplatenosnew').val(platenos);
                      document.getElementById("txtplatenosnew").disabled=false;
                      
                  //plate_id = id;
                  //alert(plate_id);
                }
                function selectplate(id,platenos){
                  $('#txtplatenos').val(platenos);
                  plate_id = id;
                  $('#selectplatemodal').modal('hide');
                  //alert(plate_id);
                }
                  //document.getElementById("btnsaveplate").style.visibility='hidden';
                  $('#btnsaveplate').hide();
                  $('#btnupdateitem').hide();
                  $('#cboreporttype').hide();
                  $('#btnpurchitemreport').hide();
                  

                  $('#btnnewpurchitem').click(function(){
                    //alert("dsds");
                    $('#purchaseitemmodal').modal('show');

                    $('#txtplatenos').val("");
                    $('#txtassign').val("");
                    $('#txtitem').val("");
                    $('#txtfuelname').val("");
                    $('#txtdesc').val("");
                    $('#txtbrand').val("");
                    $('#txtqty').val("");
                    $('#txtunit').val("");
                    $('#txtprice').val("");
                    $('#txtamount').val("");
                    $('#txtmodel').val("");
                    $('#txtsupp').val("");
                    $('#txtaddr').val("");
                    $('#txtrfno').val("");
                    $('#txtdaterfno').val("");
                    $('#txtpono').val("");
                    $('#txtponodate').val("");
                    $('#txtreqby').val("");
                    $('#txtrefno').val("");
                    $('#txtdaterefno').val("");
                    $('#txtref').val("");
                    $('#txtotherref').val("");
                    $('#txtremark').val("");

                    $('#btnupdateitem').hide();
                    $('#btnsaveitem').show();
                    $('#btnsaveasitem').hide();
                  }); 
                  $('#btnplatemodal').click(function(){
                    $('#selectplatemodal').modal('show');
                  });

                  $('#btnnewplate').click(function(){
                    //$('#purchaseitemmodal').modal('show');
                    $('#btnsaveplate').show();
                    $("#btnnewplate").hide();
                    document.getElementById("btnsaveplate").disabled=false;
                    document.getElementById("btnupdateplate").disabled=true;
                    document.getElementById("txtplatenosnew").disabled=false;
                    /*document.getElementById("btnsaveplate").style.visibility='visible';
                    document.getElementById("btnnewplate").style.visibility='hidden';*/
                  });
                  
                  
                  $('#btnupdateplate').click(function(){
                    var platenos = $("#txtplatenosnew").val();
                    //alert(platenos);
                    //xajax_updatesample(plate_id,platenos);

                    xajax_updateplate(plate_id,platenos);
                    swal.fire({
                      title: "UPDATED!",
                      text: "Plate has been updated!",
                      type: "success"
                    }).then(function() {
                      $( '#frameplates' ).attr( 'src', function ( i, val ) { return val; });
                    });
                    //xajax_insertsample();
                    //$('#purchaseitemmodal').modal('show');
                    /*$('#btnsaveplate').show();
                    $("#btnnewplate").hide();
                    document.getElementById("btnsaveplate").disabled=false;
                    document.getElementById("btnupdateplate").disabled=true;
                    document.getElementById("txtplatenosnew").disabled=false;*/
                    /*document.getElementById("btnsaveplate").style.visibility='visible';
                    document.getElementById("btnnewplate").style.visibility='hidden';*/
                  });
                  $('#btnsaveitem').click(function(){

                    //var platenos = $('#txtplatenos').val();
                    var assign = $('#txtassign').val();
                    var item = $('#txtfuelname').val();
                    var descr = $('#txtdesc option:selected').val();
                    //var brand = $('#txtbrand').val();
                    var qty = $('#txtqty').val();
                    //var unit = $('#txtunit').val();
                    var price = $('#txtprice').val();
                    var amount = $('#txtamount').val();
                    var supp_name = $('#txtsupp').val();
                    var model = $('#txtmodel').val();
                    var rf_no = $('#txtrfno').val();
                    var daterfno = $('#txtdaterfno').val();
                    var po_no = $('#txtpono').val();
                    var po_date = $('#txtponodate').val();
                    var req_by = $('#txtreqby').val();
                    var ref_no = $('#txtrefno').val();
                    var daterefno = $('#txtdaterefno').val();
                    var cvjv = $('#txtref').val();
                    var other_ref = $('#txtotherref').val();
                    var remarks = $('#txtremark').val();
                    var descr = $('#txtdesc').val();
                    //alert(assign);
                    if (plate_id == ""){
                      if(assign == "" || daterefno == ""){
                        Swal.fire({
                          type: 'warning',
                          title: '',
                          text: 'please fill in the missing fields.'
                        })

                      }
                      else if(descr == 'Motor Rental') {
                        
                        xajax_insertfuelinfo(plate_id,assign,item,qty,price,amount,supp_name,model,rf_no,daterfno,po_no,po_date,req_by,ref_no,daterefno,cvjv,other_ref,remarks,descr,1);

                        swal.fire({
                          title: "SAVE!",
                          text: "Item has been added!",
                          type: "success"
                        }).then(function() {
                          history.go(0);
                        });

                      }
                      else {
                        Swal.fire({
                          type: 'warning',
                          title: '',
                          text: 'please fill in the missing fields.'
                        })
                      }
                      

                    }
                    else {
                      //xajax_insertvamitem(plate_id,assign,item,descr,brand,qty,unit,price,amount,supp,addr,rfno,daterfno,pono,ponodate,reqby,refno,daterefno,otherref,remarks,1);
                      xajax_insertfuelinfo(plate_id,assign,item,qty,price,amount,supp_name,model,rf_no,daterfno,po_no,po_date,req_by,ref_no,daterefno,cvjv,other_ref,remarks,descr,1);

                      swal.fire({
                        title: "SAVE!",
                        text: "Item has been added!",
                        type: "success"
                      }).then(function() {
                        history.go(0);
                      });
                    }

                  });
                  $('#btnsaveasitem').click(function(){
                    //var platenos = $('#txtplatenos').val();
                    var assign = $('#txtassign').val();
                    var item = $('#txtfuelname').val();
                    var descr = $('#txtdesc option:selected').val();
                    //var brand = $('#txtbrand').val();
                    var qty = $('#txtqty').val();
                    //var unit = $('#txtunit').val();
                    var price = $('#txtprice').val();
                    var amount = $('#txtamount').val();
                    var supp_name = $('#txtsupp').val();
                    var model = $('#txtmodel').val();
                    var rf_no = $('#txtrfno').val();
                    var daterfno = $('#txtdaterfno').val();
                    var po_no = $('#txtpono').val();
                    var po_date = $('#txtponodate').val();
                    var req_by = $('#txtreqby').val();
                    var ref_no = $('#txtrefno').val();
                    var daterefno = $('#txtdaterefno').val();
                    var cvjv = $('#txtref').val();
                    var other_ref = $('#txtotherref').val();
                    var remarks = $('#txtremark').val();
                    var descr = $('#txtdesc').val();
                    //alert(assign);
                    if (plate_id == ""){
                      if(assign == "" || daterefno == ""){
                        Swal.fire({
                          type: 'warning',
                          title: '',
                          text: 'please fill in the missing fields.'
                        })

                      }
                      else if(descr == 'Motor Rental') {
                        
                        xajax_insertfuelinfo(plate_id,assign,item,qty,price,amount,supp_name,model,rf_no,daterfno,po_no,po_date,req_by,ref_no,daterefno,cvjv,other_ref,remarks,descr,1);

                        swal.fire({
                          title: "SAVE!",
                          text: "Item has been added!",
                          type: "success"
                        }).then(function() {
                          history.go(0);
                        });

                      }
                      else {
                        Swal.fire({
                          type: 'warning',
                          title: '',
                          text: 'please fill in the missing fields.'
                        })
                      }
                      

                    }
                    else {
                      //xajax_insertvamitem(plate_id,assign,item,descr,brand,qty,unit,price,amount,supp,addr,rfno,daterfno,pono,ponodate,reqby,refno,daterefno,otherref,remarks,1);
                      xajax_insertfuelinfo(plate_id,assign,item,qty,price,amount,supp_name,model,rf_no,daterfno,po_no,po_date,req_by,ref_no,daterefno,cvjv,other_ref,remarks,descr,1);

                      swal.fire({
                        title: "SAVE!",
                        text: "Item has been added!",
                        type: "success"
                      }).then(function() {
                        history.go(0);
                      });
                    }
                  })


                  $('#btnpurchitemreport').click(function(){
                    /*document.getElementById("framemat").src = '../../fpdf/mwrfpdf.php?mwrfid1=' + mwrfid+"&"+"mwrfno="+MWRFNo+"&"+"rt="+rt+"&"+"pn="+pn+"&"+"wt="+wt+"&"+"wv="+wv+"&"+"jc="+jc+"&"+"rept="+rept+"&"+"pt="+pt+"&"+"it="+it+"&"+"bt="+bt+"&"+"ctd="+ctd+"&"+"tf="+tf+"&"+"df="+df+"&"+"pd="+pd+"&"+"pc="+pc+"&"+"ca="+ca+"&"+"pa="+pa+"&"+"remarks="+remarks+"&"+"rb="+rb+"&"+"dhm="+dhm+"&"+"d1="+d1+"&"+"d2="+d2+"&"+"d3="+d3+"&"+"st="+st+"&"+"sd="+sd+"&"+"ft="+ft+"&"+"fd="+fd+"&"+"rrb="+rrb+"&"+"rab="+rab+"&"+"tor="+tor+"&"+"tmh="+tmh+"&"+"wcb="+wcb+"&"+"rrno="+rrno+"&"+"ms="+ms+"&"+"requestor="+requestor+"&"+"cmvb="+cmvb+"&"+"da="+da+"&"+"de="+de;*/
                    $('#reportsmodal').modal('show');
                    var fromdate = $('#datepicker_from').val();
                    alert(fromdate);
                    //$('#purchaseitemmodal').modal('show');
                    //xajax_insertsample();
                  });
                  $('#btnsaveplate').click(function(){
                    var platenos = $('#txtplatenosnew').val();
                    if (platenos == ""){
                      Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Plate No. is Empty!.'
                      })
                    }
                    else {
                      //alert(platenos);
                      var platenos = $('#txtplatenosnew').val();
                      xajax_insertplate(platenos);
                      swal.fire({
                        title: "SAVE!",
                        text: "Plate has been added!",
                        type: "success"
                      }).then(function() {
                        $( '#frameplates' ).attr( 'src', function ( i, val ) { return val; });
                        //history.go(0);
                      });


                    }
                    //$('#purchaseitemmodal').modal('show');
                  }); 
                  function shownewplatebtn(){
                    $("#btnnewplate").show();
                    $("#btnsaveplate").hide();
                  }
                  $('#btnprintreport').click(function(){
                    var from = $('#datepicker_from').val();
                    var to = $('#datepicker_to').val();
                    var tfplatenos =$('#searchcolumn2').val();
                    //var descr = $('#txtdesc option:selected').val();
                    //alert(platenumber);
                    //alert(val);
                    if ($('#datepicker_from').val() == '' || $('#datepicker_to').val() == '' ){
                       Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Please select daterange first!.'
                      })
                    }

                    else if (platenumber == ''){ //without platenumber
                      if(val == 'Motor Rental'){
                        window.open("../../../reports/fuel_info_specific_desc.php?datefrom= " + from + " & dateto="+to+" & plateno="+platenumber.toString()+" & descr="+val.toString(), "_blank");
                      }
                      if(val == 'Non Sagrex Vehicles'){ //all non sagrex vehicles
                        //alert('wewe');
                        window.open("../../../reports/fuel_info_v2.php?datefrom= " + from + " & dateto="+to+" & plateno="+platenumber.toString()+" & descr="+val.toString(), "_blank");

                      }
                      if(val == 'Vehicles and Machineries'){ // all Vehicles and Machineries
                        //alert('wewe');
                         window.open("../../../reports/fuel_info_v2.php?datefrom= " + from + " & dateto="+to+" & plateno="+platenumber.toString()+" & descr="+val.toString(), "_blank"); 

                      }
                      if (val == ''){
                        Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Please select description first!.'
                      })
                      }
                      /*else {
                        window.open("../../../reports/fuel_info_v2.php?datefrom= " + from + " & dateto="+to+" & plateno="+platenumber.toString()+" & descr="+val.toString(), "_blank"); 
                      }*/
                    }
                    else if(platenumber != '') { //with platenumber
                      if(val == 'Vehicles and Machineries'){ // specific plate of Vehicles and Machineries
                        //alert('wewe');
                         window.open("../../../reports/fuel_info_specific.php?datefrom= " + from + " & dateto="+to+" & plateno="+platenumber.toString()+" & descr="+val.toString(), "_blank");

                      }
                      if(val == 'Non Sagrex Vehicles'){ // specific plate of non vehicles
                        //alert('wewe');
                        window.open("../../../reports/fuel_info_specific.php?datefrom= " + from + " & dateto="+to+" & plateno="+platenumber.toString()+" & descr="+val.toString(), "_blank");

                      }
                      if (val == ''){
                        Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Please select description first!.'
                      })
                      }

                     
                     // window.open("../../../reports/fuel_specific.php?datefrom= " + from + " & dateto="+to+" & plateno="+tfplatenos.toString(), "_blank");
                   }
                   
                   

                   
                    //alert(from);

                  });


                  


                  /*$('#tblfuelinfo').dataTable( {
  "scrollX": true
} );*/
var minDate, maxDate;

// Custom filtering function which will search data in column four between two values
/*$.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
        var min = minDate.val();
        var max = maxDate.val();
        var date = new Date( data[14] );
 
        if (
            ( min === null && max === null ) ||
            ( min === null && date <= max ) ||
            ( min <= date   && max === null ) ||
            ( min <= date   && date <= max )
        ) {

            return true;
        }
        return false;
    }
);
 
$(document).ready(function() {
    // Create date inputs
    minDate = new DateTime($('#vamdatefrom'), {
        format: 'MMMM Do YYYY'
    });
    alert(minDate.val());
    maxDate = new DateTime($('#vamdateto'), {
        format: 'MMMM Do YYYY'
    });
 
    // DataTables initialisation
    var table = $('#tblfuelinfo').DataTable();
 
    // Refilter the table
    $('#vamdatefrom, #vamdateto').on('change', function () {
        table.draw();
        //alert(maxDate);
    });
});
*/

/*$.fn.dataTable.ext.search.push(
    function (settings, data, dataIndex) {
        var FilterStart = $('#vamdatefrom').val();
        var FilterEnd = $('#vamdateto').val();
        var DataTableStart = data[14].trim();
        var DataTableEnd = data[15].trim();
        if (FilterStart == '' || FilterEnd == '') {
            return true;
        }
        if (DataTableStart >= FilterStart && DataTableEnd <= FilterEnd)
        {
            return true;
        }
        else {
            return false;
        }
        
    });
    --------------------------
    var table = $('#tblfuelinfo').DataTable();
 $('#vamdatefrom').change(function (e) {
        table.draw();

    });
    $('#vamdateto').change(function (e) {
          table.draw();

        });*/


        /*                  $(document).ready(function() {*/
  //$('#tblfuelinfo').DataTable();
/*  var table = $('#tblfuelinfo').DataTable();
    $('#tblfuelinfo tr').on('click', 'td', function () {
      var data = table.row( this ).data();
      alert('sds');
      //alert( 'You clicked on '+data[1]+'\'s row' );
  });
});*/
                /*  $('#tblfuelinfo tbody').on( 'click', 'button', function () {
        var data = table.row( $(this).parents('tr') ).data();
        alert( data[0] +"'s salary is: "+ data[ 5 ] );
      } );*/
      

              /*    $('#tblfuelinfo').on('click', 'tbody tr', function() {
                    console.log('API row values : ', table.row(this).data());
                    alert(table.row(this).data());
                  });

                  */
                  var val = "";
                  var platenumber = "";
                  if ( $.fn.dataTable.isDataTable( '#tblfuelinfo' ) ) {
    /*var table = $('#tblfuelinfo').DataTable();
    alert("adads");*/
  }
  else {
  //alert("adad");
  $(document).ready(function() {
    $('#tblfuelinfo tfoot th').each( function (i) {
      var title = $(this).text();
            //var header = $('#thfuel').children(':eq('+$(this).index()+')');
            //alert(header);
            $(this).html( '<input id="searchcolumn'+i+'" type="text" size=10 placeholder="Search'+title+'" data-index="'+i+'" />' );
            //platenumber = $('#searchcolumn2').val();
          } );

    var table = $('#tblfuelinfo').DataTable({
      
   /* footerCallback: function( tfoot, data, start, end, display ) {
        var api = this.api();
        $(api.column(8).footer()).html(
            api.column(8).data().reduce(function ( a, b ) {
                return a + b;
            }, 0)
        );
      },*/
      "scrollX": true,
      responsive: true,
      pageLength : 15,
    //stateSave : true,
    "columnDefs": [
    {
      "targets": [ 1 ],
      "visible": false,
      "searchable": false
    }],
    drawCallback: function () {
      var api = this.api();
      $( api.column(6).footer() ).html(
        api.column( 6, {page:'current'} ).data().sum()
        );
      $( api.column(7).footer() ).html(
        api.column( 7, {page:'current'} ).data().sum()
        );
      $( api.column(8).footer() ).html(
        api.column( 8, {page:'current'} ).data().sum()
        );
      /*$( api.column(10).footer() ).html(
        api.column( 10, {page:'current'} ).data().sum()
        );*/
      },
      initComplete: function () {
            // Apply the search
            this.api().columns().every( function () {
              var that = this;
              
              $( 'input', this.footer() ).on( 'keyup change clear', function () {
                if ( that.search() !== this.value ) {
                  platenumber = this.value;
                  that
                  .search( this.value )
                  .draw();
                }
              } );
            } );
            this.api().columns(3).every( function () {
              var that = this;
              
                /*$( 'input', this.footer() ).on( 'keyup change clear', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                  } );*/
                  var column = this;
                  var select = $('<select id = "cbodesignation" style = "width:100px;" ><option value=""></option><option value="Vehicles and Machineries">Vehicles and Machineries</option><option value="Non Sagrex Vehicles">Non Sagrex Vehicles</option><option value="Motor Rental">Motor Rental</option></select>')
                  .appendTo( $(column.footer()).empty() )
                  .on( 'change', function () {
                    val = $.fn.dataTable.util.escapeRegex(
                      $(this).val()
                      );
                        //alert(val);
                        
                        column
                        .search( val ? '^'+val+'$' : '', true, false )
                        .draw();
                      } );
                /*column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'" >'+d+'</option>' )
                  } );*/

                } );
          },

          dom: 'Bfrtip',
          buttons: [
          {
            extend: 'copyHtml5',
            exportOptions: {
              columns: [ 0, ':visible' ]
            }, footer: true
          },
          {
            extend: 'excelHtml5',
            exportOptions: {
              columns: ':visible'
            }, footer: true
          },
            /*{
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [ 11,2,3,4,8,9,10,5,6,7 ]
                },
                download: 'open',
                footer: true
              },*/
              'colvis'
              ]
            });
    table.column( 6 ).data().sum();
/*   var column = table.column(1);
$(column.footer()).html(
  column.data().reduce(function(a, b) {
    return a + b;
    console.log(a);
  })
  );*/
  $("#datepicker_from").datepicker({
    showOn: "button",
    buttonImage: "../../../images/calendar1.png",
    buttonImageOnly: true,
    "onSelect": function(date) {
      minDateFilter = new Date(date).getTime();
      //alert(minDateFilter);
      table.draw();
    }
  }).keyup(function() {
    minDateFilter = new Date(this.value).getTime();
    table.draw();
  });

  $("#datepicker_to").datepicker({
    showOn: "button",
    buttonImage: "../../../images/calendar1.png",
    buttonImageOnly: true,
    "onSelect": function(date) {
      maxDateFilter = new Date(date).getTime();
      //alert(maxDateFilter);
      table.draw();
    }
  }).keyup(function() {
    maxDateFilter = new Date(this.value).getTime();
    //==alert(maxDateFilter);
    table.draw();
  });


// Date range filter
var minDateFilter = "";
var maxDateFilter = "";

$.fn.dataTableExt.afnFiltering.push(
  function(oSettings, aData, iDataIndex) {
    if (typeof aData._date == 'undefined') {
      aData._date = new Date(aData[17]).getTime()- 86400000;
    }
    //- 86400000
    //alert(aData._date);
/*    if ($('#datepicker_from').val() != '') {
          var minDateFilter = new Date($('#datepicker_from').val());
        } else {
          var minDateFilter = null;
        }
        if ($('#datepicker_to').val() != '') {
          var maxDateFilter = new Date($('#datepicker_to').val());
        } else {
          var maxDateFilter = null;
        }*/

    //alert(aData._date <= minDateFilter);
    if (minDateFilter && !isNaN(minDateFilter)) {
      if (aData._date < minDateFilter) { //false
        return false;
        alert("min");
      }
     /* else if (aData._date == minDateFilter) {
        return true;
      }*/
    }

    if (maxDateFilter && !isNaN(maxDateFilter)) {
      if (aData._date > maxDateFilter) { //false
        return false;
        alert("max");
      }
      /*else if (aData._date == maxDateFilter) {
        return true;
      }*/
    }
    /*if (aData._date <= minDateFilter) {
        return true;
        alert("min");
      }
      if (aData._date <= maxDateFilter) {
        return true;
        alert("max");
      }*/
      if ( 
        /*( minDateFilter === null && maxDateFilter === null ) ||
            ( minDateFilter === null && aData._date <= maxDateFilter ) ||
            ( minDateFilter <= aData._date   && maxDateFilter === null ) ||
            ( minDateFilter <= aData._date   && aData._date <= maxDateFilter ) ||
            ( aData._date >= minDateFilter    && aData._date <= maxDateFilter )*/

      ( isNaN( minDateFilter ) && isNaN( maxDateFilter ) ) ||
        ( isNaN( minDateFilter ) == isNaN( maxDateFilter ) ) ||
        ( isNaN( minDateFilter ) && aData._date <= maxDateFilter ) ||
        ( minDateFilter <= aData._date   && isNaN( maxDateFilter ) ) ||
        ( minDateFilter <= aData._date   && aData._date <= maxDateFilter ) 
        )
      {
        return true;
      }
    /*if (
            ( minDateFilter === null && maxDateFilter === null ) ||
            ( minDateFilter === null && aData._date <= maxDateFilter ) ||
            ( minDateFilter <= aData._date   && maxDateFilter === null ) ||
            ( minDateFilter <= aData._date   && aData._date <= maxDateFilter ) ||
            ( minDateFilter <= aData._date   || aData._date <= maxDateFilter )
        ) {
            return true;
          }*/

          return false;
        }
        );
} );
}
$('#tblfuelinfo tfoot th').each( function () {
  var title = $(this).text();
  $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
} );

var vamitemid = "";
var rowplateid = "";
var rowplate =  "";
var rowassign =  "";
var rowitem =  "";
var rowdesc =  "";
var rowbrand =  "";
var rowqty =  "";
var rowunit =  "";
var rowprice =  "";
var rowamount =  "";
var rowsupp =  "";
var rowaddr =  "";
var rowrfno =  "";
var rowrfdate =  "";
var rowpono =  "";
var rowpodate =  "";
var rowreqby =  "";
var rowrefno =  "";
var rowrefdate =  "";
var rowcvjv =  "";
var rowotherref =  "";
var roworemarks =  "";

$('#tblfuelinfo tbody').on('dblclick','tr',function(e){

  var currentRow = $(this).closest("tr");

  var data = $('#tblfuelinfo').DataTable().row(currentRow).data();
    //alert(data['1']);
    var rowid =  $(this).find('td:eq(0)').text();
    rowplateid =  data['1'];
  //alert(rowplateid);
  rowplate =  $(this).find('td:eq(1)').text();
  rowdesc =  $(this).find('td:eq(2)').text();
  rowassign =  $(this).find('td:eq(3)').text();
  //rowitem =  $(this).find('td:eq(3)').text();
  
  rowfuelname =  $(this).find('td:eq(4)').text();
  
  //rowbrand =  $(this).find('td:eq(5)').text();
  rowqty =  $(this).find('td:eq(5)').text();
  //rowunit =  $(this).find('td:eq(5)').text();
  rowprice =  $(this).find('td:eq(6)').text();
  rowamount =  $(this).find('td:eq(7)').text();
  rowsupp =  $(this).find('td:eq(8)').text();
  rowmodel =  $(this).find('td:eq(9)').text();
  //rowsupp =  $(this).find('td:eq(10)').text();
  //rowaddr =  $(this).find('td:eq(11)').text();
  rowrfno =  $(this).find('td:eq(10)').text();
  rowrfdate =  $(this).find('td:eq(11)').text();
  rowpono =  $(this).find('td:eq(12)').text();
  rowpodate =  $(this).find('td:eq(13)').text();
  rowreqby =  $(this).find('td:eq(14)').text();
  rowrefno =  $(this).find('td:eq(15)').text();
  rowrefdate =  $(this).find('td:eq(16)').text();
  rowcvjv =  $(this).find('td:eq(17)').text();
  rowotherref =  $(this).find('td:eq(18)').text();
  roworemarks =  $(this).find('td:eq(19)').text();
  //rowdesc =  $(this).find('td:eq(20)').text();

  fuelid = rowid;
  plate_id = rowplateid;
  $('#txtplatenos').val(rowplate);
  $('#txtassign').val(rowassign);
  //$('#txtitem').val(rowitem);
  $('#txtfuelname').val(rowfuelname);
  //$('#txtdesc').val(rowdesc);
  //$('#txtbrand').val(rowbrand);
  $('#txtqty').val(rowqty);
  //$('#txtunit').val(rowunit);
  $('#txtprice').val(rowprice);
  $('#txtamount').val(rowamount);
  $('#txtmodel').val(rowmodel);
  $('#txtsupp').val(rowsupp);
  //$('#txtaddr').val(rowaddr);
  $('#txtrfno').val(rowrfno);
  $('#txtdaterfno').val(rowrfdate);
  $('#txtpono').val(rowpono);
  $('#txtponodate').val(rowpodate);
  $('#txtreqby').val(rowreqby);
  $('#txtrefno').val(rowrefno);
  $('#txtdaterefno').val(rowrefdate);
  $('#txtref').val(rowcvjv);
  $('#txtotherref').val(rowotherref);
  $('#txtremark').val(roworemarks);
  $('#txtdesc').val(rowdesc);

  $('#btnupdateitem').show();
  $('#btnsaveitem').hide();
  $('#btnsaveasitem').show();

  $('#purchaseitemmodal').modal('show');
});
$('#btnupdateitem').click(function(){
  if(plate_id != '' ){
    xajax_updatefuelinfo(fuelid,plate_id,$('#txtassign').val(),$('#txtfuelname').val(),$('#txtqty').val(),$('#txtprice').val(),$('#txtamount').val(),$('#txtsupp').val(),$('#txtmodel').val(),$('#txtrfno').val(),$('#txtdaterfno').val(),$('#txtpono').val(),$('#txtponodate').val(),$('#txtreqby').val(),$('#txtrefno').val(),$('#txtdaterefno').val(),$('#txtref').val(),$('#txtotherref').val(),$('#txtremark').val(),$('#txtdesc').val(),1);
  }
  else {
    xajax_updatefuelinfo(fuelid,rowplateid,$('#txtassign').val(),$('#txtfuelname').val(),$('#txtqty').val(),$('#txtprice').val(),$('#txtamount').val(),$('#txtsupp').val(),$('#txtmodel').val(),$('#txtrfno').val(),$('#txtdaterfno').val(),$('#txtpono').val(),$('#txtponodate').val(),$('#txtreqby').val(),$('#txtrefno').val(),$('#txtdaterefno').val(),$('#txtref').val(),$('#txtotherref').val(),$('#txtremark').val(),$('#txtdesc').val(),1);
  }


  swal.fire({
    title: "UPDATE!",
    text: "Item has been updated!",
    type: "success"
  }).then(function() {
    history.go(0);
  });

});


//var table = $('#tblfuelinfo').DataTable();

</script>
</body>
</html>