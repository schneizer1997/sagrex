<?php
//session_start();
/*include('../../../classes/inc/dbConInventory.php');*/
include('../../../classes/inc/dbCon.php');
//require('../admin.common.php');
require('admin.common.php');
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
<!-- <?xml version="1.0" encoding="UTF-8"?> -->

<html lang="en">
<head>
  <!-- <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content=""> -->
</head>

<body id="page-top">

  <form action="report_content/detailed_content.php" method="POST" enctype="multipart/form-data">
    <table>
      <div class="col-sm-12" style="border-bottom: 1px solid grey;margin-top: 10px;">
        <div class="form-group row">

        </div>
      </div>
    </table>
  </form> 
  <a>Date From:</a>
  <input type="date" name="">
  <a>Date To:</a>
  <input type="date" name="">
  <button class="btn btn-secondary" type="button" class="btn btn-info" id="btnpurchitemreport">Generate Report</button>
  <button class="btn btn-secondary" type="button" class="btn btn-info" id="btnnewpurchitem">Add</button>
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
              <th class="all">Plate No.</th>
              <th class="all">Assignee</th>
              <th class="all">Repaire Type</th>
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
              //include('tables/vam_item_purch_table.php');
              ?>
            </tbody>
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
                      <div class="col-sm-8"
>                        <input type="text" class="form-control" name="" id="txtplatenos" placeholder="" style="height: 30px;">

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
                        <textarea type="text" class="form-control" id="txtmaterialsupdate" placeholder="" style="height: 30px;"></textarea>
                        <input type="hidden" class="form-control" id="txtmaterialsid" placeholder="" style="height: 30px;">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Repaire Type:</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtunitprice" placeholder="" style="height: 30px;" >
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Description:</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtqtyupdate" placeholder="" style="height: 30px;" >
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Brand:</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtamount" placeholder="" style="height: 30px;" >
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Quantity:</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtamount" placeholder="" style="height: 30px;" >
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Unit:</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtamount" placeholder="" style="height: 30px;" >
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Price:</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtamount" placeholder="" style="height: 30px;" >
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Total Amount:</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtamount" placeholder="" style="height: 30px;" >
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Supplier:</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtamount" placeholder="" style="height: 30px;" >
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Address:</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtamount" placeholder="" style="height: 30px;" >
                      </div>
                    </div>

                  </div>
                  <!-- <div id></div> -->
                  <div id = "rightmat" style="border: 1px;width: 550px;float: right;">
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label" id="" style="height: 30px;">RF NO:</label>
                      <div class="col-sm-10">
                        <input type="date" class="form-control" id="txtnewdategrant" placeholder="" style="height: 50px;">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Date:</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtamount" placeholder="" style="height: 30px;" >
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label" id="" style="height: 30px;">PO NO:</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtamount" placeholder="" style="height: 30px;" >
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Req. By:</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtamount" placeholder="" style="height: 30px;" >
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label" id="" style="height: 30px;">REF NO:</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtamount" placeholder="" style="height: 30px;" >
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Date:</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtamount" placeholder="" style="height: 30px;" >
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label" id="" style="height: 30px;">CV/JV:</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtamount" placeholder="" style="height: 30px;" >
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label" id="" style="height: 30px;">OTHER REF:</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtamount" placeholder="" style="height: 30px;" >
                      </div>
                    </div>
                    
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Remark:</label>
                      <div class="col-sm-10">
                        <select class="form-control" id="cbott">
                          <option  selected>Select</option>
                          <option>CASH</option>
                          <option>JOB ORDER</option>
                          <option>PURCHASE ORDER</option>
                        </select>
                      </div>
                    </div>
                  </div>      
                </div>

                <!-- </form> -->
                <div class="modal-footer" style="border: 1px;float: right;">     
                  <button type="button" class="btn btn-info" id="btncredentialupdate">
                    <i style="padding-right: 5px;" class="fas fa-save"></i>Update</button>
                    <button type="button" class="btn btn-info" name="btnloadmat" id="btnloadmat" style=""><i style="padding-right: 5px;" class="fa fa-refresh"></i>Reload</button>

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
                          <input type="text" class="form-control" id="txtplatenosnew" placeholder="" style="height: 50px;">
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


                <!-- <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script> -->
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
                  //document.getElementById("btnsaveplate").style.visibility='hidden';
                  $('#btnsaveplate').hide();

                  $('#btnnewpurchitem').click(function(){
                    $('#purchaseitemmodal').modal('show');
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
                    /*document.getElementById("btnsaveplate").style.visibility='visible';
                    document.getElementById("btnnewplate").style.visibility='hidden';*/
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
                      alert(platenos);
                      //var platenos = $('#txtplatenosnew').val();
                      xajax_insertplate(platenos);


                    }
                    //$('#purchaseitemmodal').modal('show');
                  }); 
                  function shownewplatebtn(){
                    $("#btnnewplate").show();
                    $("#btnsaveplate").hide();
                  }

                  $('#tblitempurch').dataTable( {
  "scrollX": true/*,
  searching: false, paging: false, info: false*/
} );


</script>
</body>
</html>