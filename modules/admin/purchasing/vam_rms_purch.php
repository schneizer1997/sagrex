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

  <!-- <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>
  <form action="report_content/detailed_content.php" method="POST" enctype="multipart/form-data">
    <table>
      <div class="col-sm-12" style="border-bottom: 1px solid grey;margin-top: 10px;">
        <div class="form-group row">

        </div>
      </div>
    </table>
  </form> -->
<!--   <table border="0" cellspacing="5" cellpadding="5">
        <tbody><tr>
            <td>Minimum date:</td>
            <td><input type="text" id="vamdatefrom" name="vamdatefrom"></td>
        </tr>
        <tr>
            <td>Maximum date:</td>
            <td><input type="text" id="vamdateto" name="vamdateto"></td>
        </tr>
    </tbody></table> -->
    <!-- <table>
      <tbody>
        <a>Date From:</a>
        <input type="date" id="vamdatefrom" name="vamdatefrom">
        <a>Date To:</a>
        <input type="date" id="vamdateto" name="vamdateto">
      </tbody>
    </table> -->
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
        <table class="table table-hover" id="tblitempurch" width="100%" cellspacing="0">
          <thead>

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
              <th class="all">Plate ID</th>
              <th class="all">Plate No.</th>
              <th class="all">Assignee</th>
              <th class="all">Repair Type</th>
              <th class="all">Description</th>
              <th class="all">Brand</th>
              <th class="all">Qty</th>
              <th class="all">Unit</th>
              <th class="all">Price</th>
              <th class="all">Total Amount</th>
              <th class="all">Supplier</th>
              <th class="all">Address</th>
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
              include('tables/vam_rms_table.php');
              ?>
            </tbody>
            <tfoot style="width:50px;" rowspan = "0" colspan = "0">
        <tr>
          <th class="all">ID</th>
          <th class="all">Plate ID</th>
          <th class="all">Plate No.</th>
          <th class="all">Assignee</th>
          <th class="all">Repair Type</th>
          <th class="all">Description</th>
          <th class="all">Brand</th>
          <th class="all">Qty</th>
          <th class="all">Unit</th>
          <th class="all">Price</th>
          <th class="all">Total Amount</th>
          <th class="all">Supplier</th>
          <th class="all">Address</th>
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
                      <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Repair Type:</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtrepairtype" placeholder="" style="height: 30px;" >
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Description:</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtdesc" placeholder="" style="height: 30px;" >
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Brand:</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtbrand" placeholder="" style="height: 30px;" >
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Quantity:</label>
                      <div class="col-sm-10">
                        <input type="number" class="form-control" id="txtqty" placeholder="" style="height: 30px;" >
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Unit:</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtunit" placeholder="" style="height: 30px;" >
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
                      <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Supplier:</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtsupp" placeholder="" style="height: 30px;" >
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Address:</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtaddr" placeholder="" style="height: 30px;" >
                      </div>
                    </div>

                  </div>
                  <!-- <div id></div> -->
                  <div id = "rightmat" style="border: 1px;width: 550px;float: right;">
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label" id="" style="height: 30px;">RF NO:</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtrfno" placeholder="" style="height: 50px;">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Date:</label>
                      <div class="col-sm-10">
                        <input type="date" class="form-control" id="txtdaterfno" placeholder="" style="height: 30px;" >
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label" id="" style="height: 30px;">JOC NO:</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtpono" placeholder="" style="height: 30px;" >
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label" id="" style="height: 30px;">DATE:</label>
                      <div class="col-sm-10">
                        <input type="date" class="form-control" id="txtponodate" placeholder="" style="height: 30px;" >
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Req. By:</label>
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
                    <button type="button" class="btn btn-info" id="btnupdateitem">
                    <i style="padding-right: 5px;" class="fas fa-save"></i>UPDATE</button>
                    <!-- <button type="button" class="btn btn-info" name="btnloadmat" id="btnloadmat" style=""><i style="padding-right: 5px;" class="fa fa-refresh"></i>Reload</button> -->

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

                <div class="modal fade bd-example-modal-lg" id="vamreport" tabindex="1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                <div class="modal fade bd-example-modal-lg" id="reportsmodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content" style="background-color: grey;width: 1200px;min-height:500px;margin-left: -180px;">
                      <div class="modal-header" style="background-color: #17A2B8;color:white;">
                        <h5 class="modal-title" id="formModalLabel">MWRF Report</h5>
                        <button style="border:0px;color:white;" type="button" class="btn btn-secondary" data-dismiss="modal" id="btnFormClose"><i class="fa fa-close"></i></button>
                      </div>
                      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <div style="float: right;border: 1px;">

                          <div style="height:0px;min-width:500px;margin-right:2px;">
                            <table class="table table-bordered" id="mtable1" cellspacing="0">

                              <tbody id="mtable2">
                                <iframe style="border: 0px;height: 500px;" name="framemat" id="framemat" src="../../../fpdf/vam_report_pdf.php" /></iframe>
                              </tbody>
                            </table>
                          </div>

                        </div>
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
                    $('#txtrepairtype').val("");
                    $('#txtdesc').val("");
                    $('#txtbrand').val("");
                    $('#txtqty').val("");
                    $('#txtunit').val("");
                    $('#txtprice').val("");
                    $('#txtamount').val("");
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
                    var item = $('#txtrepairtype').val();
                    var descr = $('#txtdesc').val();
                    var brand = $('#txtbrand').val();
                    var qty = $('#txtqty').val();
                    var unit = $('#txtunit').val();
                    var price = $('#txtprice').val();
                    var amount = $('#txtamount').val();
                    var supp_name = $('#txtsupp').val();
                    var supp_addr = $('#txtaddr').val();
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
                    //alert(assign);
                    if (plate_id == "" || assign == "" || daterefno == ""){
                      Swal.fire({
                        type: 'warning',
                        title: '',
                        text: 'please fill in the missing fields.'
                      })

                    }
                    else {
                      //xajax_insertvamitem(plate_id,assign,item,descr,brand,qty,unit,price,amount,supp,addr,rfno,daterfno,pono,ponodate,reqby,refno,daterefno,otherref,remarks,1);
                      xajax_insertrmsvam(plate_id,assign,item,descr,brand,qty,unit,price,amount,supp_name,supp_addr,rf_no,daterfno,po_no,po_date,req_by,ref_no,daterefno,cvjv,other_ref,remarks,1);

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
                    var item = $('#txtrepairtype').val();
                    var descr = $('#txtdesc').val();
                    var brand = $('#txtbrand').val();
                    var qty = $('#txtqty').val();
                    var unit = $('#txtunit').val();
                    var price = $('#txtprice').val();
                    var amount = $('#txtamount').val();
                    var supp_name = $('#txtsupp').val();
                    var supp_addr = $('#txtaddr').val();
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
                    //alert(assign);
                    if (plate_id == "" || assign == "" || daterefno == ""){
                      Swal.fire({
                        type: 'warning',
                        title: '',
                        text: 'please fill in the missing fields.'
                      })

                    }
                    else {
                      //xajax_insertvamitem(plate_id,assign,item,descr,brand,qty,unit,price,amount,supp,addr,rfno,daterfno,pono,ponodate,reqby,refno,daterefno,otherref,remarks,1);
                      xajax_insertrmsvam(plate_id,assign,item,descr,brand,qty,unit,price,amount,supp_name,supp_addr,rf_no,daterfno,po_no,po_date,req_by,ref_no,daterefno,cvjv,other_ref,remarks,1);

                       swal.fire({
                        title: "SAVE!",
                        text: "Item has been added!",
                        type: "success"
                      }).then(function() {
                        history.go(0);
                      });
                    }

                   });


                  $('#btnpurchitemreport').click(function(){
                    /*document.getElementById("framemat").src = '../../fpdf/mwrfpdf.php?mwrfid1=' + mwrfid+"&"+"mwrfno="+MWRFNo+"&"+"rt="+rt+"&"+"pn="+pn+"&"+"wt="+wt+"&"+"wv="+wv+"&"+"jc="+jc+"&"+"rept="+rept+"&"+"pt="+pt+"&"+"it="+it+"&"+"bt="+bt+"&"+"ctd="+ctd+"&"+"tf="+tf+"&"+"df="+df+"&"+"pd="+pd+"&"+"pc="+pc+"&"+"ca="+ca+"&"+"pa="+pa+"&"+"remarks="+remarks+"&"+"rb="+rb+"&"+"dhm="+dhm+"&"+"d1="+d1+"&"+"d2="+d2+"&"+"d3="+d3+"&"+"st="+st+"&"+"sd="+sd+"&"+"ft="+ft+"&"+"fd="+fd+"&"+"rrb="+rrb+"&"+"rab="+rab+"&"+"tor="+tor+"&"+"tmh="+tmh+"&"+"wcb="+wcb+"&"+"rrno="+rrno+"&"+"ms="+ms+"&"+"requestor="+requestor+"&"+"cmvb="+cmvb+"&"+"da="+da+"&"+"de="+de;*/
                    $('#reportsmodal').modal('show');
                    var fromdate = $('#datepicker_from').val();
                    //alert(fromdate);
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
                    //alert(tfplatenos);

                    if (tfplatenos == ''){
                      window.open("../../../reports/vam_rms_report.php?datefrom= " + from + " & dateto="+to+" & plateno="+tfplatenos.toString(), "_blank"); 
                    }
                    else if(tfplatenos != '') {
                      window.open("../../../reports/vam_rms_specific.php?datefrom= " + from + " & dateto="+to+" & plateno="+tfplatenos.toString(), "_blank");
                     // window.open("../../../reports/fuel_specific.php?datefrom= " + from + " & dateto="+to+" & plateno="+tfplatenos.toString(), "_blank");
                    }

                    
                    //alert(from);

                  });

                  


                  /*$('#tblitempurch').dataTable( {
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
    var table = $('#tblitempurch').DataTable();
 
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
    var table = $('#tblitempurch').DataTable();
 $('#vamdatefrom').change(function (e) {
        table.draw();

    });
    $('#vamdateto').change(function (e) {
          table.draw();

    });*/


/*                  $(document).ready(function() {*/
  //$('#tblitempurch').DataTable();
/*  var table = $('#tblitempurch').DataTable();
    $('#tblitempurch tr').on('click', 'td', function () {
      var data = table.row( this ).data();
      alert('sds');
      //alert( 'You clicked on '+data[1]+'\'s row' );
  });
});*/
                /*  $('#tblitempurch tbody').on( 'click', 'button', function () {
        var data = table.row( $(this).parents('tr') ).data();
        alert( data[0] +"'s salary is: "+ data[ 5 ] );
    } );*/
    

              /*    $('#tblitempurch').on('click', 'tbody tr', function() {
                    console.log('API row values : ', table.row(this).data());
                    alert(table.row(this).data());
                  });

*/
if ( $.fn.dataTable.isDataTable( '#tblitempurch' ) ) {
    /*var table = $('#tblitempurch').DataTable();
    alert("adads");*/
  }
  else {
  //alert("adad");
  $(document).ready(function() {
    $('#tblitempurch tfoot th').each( function (i) {
            var title = $(this).text();
            //var header = $('#thfuel').children(':eq('+$(this).index()+')');
            //alert(header);
            $(this).html( '<input id="searchcolumn'+i+'" type="text" size=10 placeholder="Search'+title+'" data-index="'+i+'" />' );
        } );
   var table = $('#tblitempurch').DataTable({
    
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
      $( api.column(7).footer() ).html(
        api.column( 7, {page:'current'} ).data().sum()
      );
      $( api.column(8).footer() ).html(
        api.column( 8, {page:'current'} ).data().sum()
      );
      $( api.column(9).footer() ).html(
        api.column( 9, {page:'current'} ).data().sum()
      );
      $( api.column(10).footer() ).html(
        api.column( 10, {page:'current'} ).data().sum()
      );
    },
    initComplete: function () {
            // Apply the search
            this.api().columns().every( function () {
                var that = this;
 
                $( 'input', this.footer() ).on( 'keyup change clear', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } );
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
                    columns: [ 0,2,3, 5,6,7,8,9,10 ]
                },
                footer: true
            },*/
            'colvis'
        ]
  });
   table.column( 6 ).data().sum();
   $("#datepicker_from").datepicker({
    showOn: "button",
    buttonImage: "../../../images/calendar1.png",
    buttonImageOnly: true,
    "onSelect": function(date) {
      minDateFilter = new Date(date).getTime();
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
      table.draw();
    }
  }).keyup(function() {
    maxDateFilter = new Date(this.value).getTime();
    table.draw();
  });


// Date range filter
minDateFilter = "";
maxDateFilter = "";

$.fn.dataTableExt.afnFiltering.push(
  function(oSettings, aData, iDataIndex) {
    if (typeof aData._date == 'undefined') {
      aData._date = new Date(aData[19]).getTime() - 86400000;
    }

    if (minDateFilter && !isNaN(minDateFilter)) {
      if (aData._date < minDateFilter) {
        return false;
      }
    }

    if (maxDateFilter && !isNaN(maxDateFilter)) {
      if (aData._date > maxDateFilter) {
        return false;
      }
    }

    return true;
  }
  );
} );
}
$('#tblitempurch tfoot th').each( function () {
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

$('#tblitempurch tbody').on('dblclick','tr',function(e){

  var currentRow = $(this).closest("tr");

  var data = $('#tblitempurch').DataTable().row(currentRow).data();
    //alert(data['1']);
  var rowid =  $(this).find('td:eq(0)').text();
  rowplateid =  data['1'];
  rowplate =  $(this).find('td:eq(1)').text();
  rowassign =  $(this).find('td:eq(2)').text();
  rowitem =  $(this).find('td:eq(3)').text();
  rowdesc =  $(this).find('td:eq(4)').text();
  rowbrand =  $(this).find('td:eq(5)').text();
  rowqty =  $(this).find('td:eq(6)').text();
  rowunit =  $(this).find('td:eq(7)').text();
  rowprice =  $(this).find('td:eq(8)').text();
  rowamount =  $(this).find('td:eq(9)').text();
  rowsupp =  $(this).find('td:eq(10)').text();
  rowaddr =  $(this).find('td:eq(11)').text();
  rowrfno =  $(this).find('td:eq(12)').text();
  rowrfdate =  $(this).find('td:eq(13)').text();
  rowpono =  $(this).find('td:eq(14)').text();
  rowpodate =  $(this).find('td:eq(15)').text();
  rowreqby =  $(this).find('td:eq(16)').text();
  rowrefno =  $(this).find('td:eq(17)').text();
  rowrefdate =  $(this).find('td:eq(18)').text();
  rowcvjv =  $(this).find('td:eq(19)').text();
  rowotherref =  $(this).find('td:eq(20)').text();
  roworemarks =  $(this).find('td:eq(21)').text();

  vamitemid = rowid;
  plate_id = rowplateid;
  $('#txtplatenos').val(rowplate);
  $('#txtassign').val(rowassign);
  $('#txtrepairtype').val(rowitem);
  $('#txtdesc').val(rowdesc);
  $('#txtbrand').val(rowbrand);
  $('#txtqty').val(rowqty);
  $('#txtunit').val(rowunit);
  $('#txtprice').val(rowprice);
  $('#txtamount').val(rowamount);
  $('#txtsupp').val(rowsupp);
  $('#txtaddr').val(rowaddr);
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

  $('#btnupdateitem').show();
  $('#btnsaveitem').hide();
  $('#btnsaveasitem').show();

  $('#purchaseitemmodal').modal('show');
                  });
$('#btnupdateitem').click(function(){
if(plate_id != ''){
xajax_updatermsvam(vamitemid,plate_id,$('#txtassign').val(),$('#txtrepairtype').val(),$('#txtdesc').val(),$('#txtbrand').val(),$('#txtqty').val(),$('#txtunit').val(),$('#txtprice').val(),$('#txtamount').val(),$('#txtsupp').val(),$('#txtaddr').val(),$('#txtrfno').val(),$('#txtdaterfno').val(),$('#txtpono').val(),$('#txtponodate').val(),$('#txtreqby').val(),$('#txtrefno').val(),$('#txtdaterefno').val(),$('#txtref').val(),$('#txtotherref').val(),$('#txtremark').val(),1);
}
else {
xajax_updatermsvam(vamitemid,rowplateid,$('#txtassign').val(),$('#txtrepairtype').val(),$('#txtdesc').val(),$('#txtbrand').val(),$('#txtqty').val(),$('#txtunit').val(),$('#txtprice').val(),$('#txtamount').val(),$('#txtsupp').val(),$('#txtaddr').val(),$('#txtrfno').val(),$('#txtdaterfno').val(),$('#txtpono').val(),$('#txtponodate').val(),$('#txtreqby').val(),$('#txtrefno').val(),$('#txtdaterefno').val(),$('#txtref').val(),$('#txtotherref').val(),$('#txtremark').val(),1);
}


swal.fire({
    title: "UPDATE!",
    text: "Item has been updated!",
    type: "success"
}).then(function() {
    history.go(0);
});
/*var refreshedDataFromTheServer = getDataFromServer();

var myTable = $('#tblitempurch').DataTable();
myTable.clear().rows.add(refreshedDataFromTheServer).draw();*/
/*$('#tblitempurch').DataTable().destroy();
$('#tblitempurch').find('tbody').append("<tr><td><value1></td><td><value1></td></tr>");
$('#tblitempurch').DataTable().draw();*/
/*var table = $('#tblitempurch').DataTable();
table.ajax.reload();*/
//table.ajax.reload();

});


//var table = $('#tblitempurch').DataTable();

</script>
</body>
</html>