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
<title>VENDOR</title>
<style type="text/css">
tfoot input {
  width: 100px;
}
</style>
<body id="page-top">

    <!-- <p id="date_filter">
    <span id="date-label-from" class="date-label">From: </span><input class="date_range_filter date" type="text" id="datepicker_from" />
    <span id="date-label-to" class="date-label">To:&nbsp;&nbsp;</span><input class="date_range_filter date" type="text" id="datepicker_to" />
    <button id="btnprintreport" class="btn btn-info"><i style ="padding-right:5px;" class="fas fa-print"></i>PRINT</button>
  <select id="cboreporttype">
    <option>ALL</option>
    <option>SPECIFIC PLATE</option>
  </select>
  <button class="btn btn-secondary" type="button" class="btn btn-info" id="btnpurchitemreport">Generate Report</button> -->
  <button class="btn btn-info" type="button" class="btn btn-info" id="btnnewpurchitem" style="float:right;"><i style ="padding-right:5px;" class="fa fa-plus-square"></i>Create New</button><br><br>
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
              <th class="all">COMPANY NAME</th>
              <th class="all">PREV. NAME</th>
              <th class="all">TYPE</th>
              <th class="all">NATURE</th>
              <th class="all">BUSINESS ADDR</th>
              <th class="all">BILLING ADDR</th>
              <th class="all">CONTACT NAME</th>
              <th class="all">POSITION</th>
              <th class="all">TEL. #</th>
              <th class="all">FAX #</th>
              <th class="all">MOBILE #</th>
              <th class="all">EMAIL</th>
              <th class="all">TERMS</th>
              <th class="all">CREDIT LIMIT</th>
              <th class="all">REG. NO.</th>
              <th class="all">SEC. REG.</th>

              <th class="all">PERMIT NO.</th>
              <th class="all">BIR CERT.</th>
              <th class="all">TIN</th>
              <th class="all">VAT No.</th>
              <th class="all">TAX</th>
              <th class="all">BANK NAME</th>
              <th class="all">BANK LOC.</th>
              <th class="all">ACCT NAME</th>
              <th class="all">ACCT SIGN.</th>
              
              <th class="all">SIGN. OFFICER</th>
              <th class="all">VERIFIED BY</th>
              <th class="all">VENDOR IMAGE</th>
              <th class="all">UPLOAD IMAGE</th>
<!--               <th class="all">Date</th>
              <th class="all">Requested By</th>
              <th class="all">Ref No.</th>
              <th class="all">Date</th>
              <th class="all">CV/JV No.</th>
              <th class="all">Other Ref.</th>
              <th class="all">Remarks</th>
              <th class="all">Description</th> -->

            </thead>
            <tbody>
              <?php
              include('tables/vendoraccr_main_table.php');
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
              <th class="all">ID</th>
              <th class="all">COMPANY NAME</th>
              <th class="all">PREV. NAME</th>
              <th class="all">TYPE</th>
              <th class="all">NATURE</th>
              <th class="all">BUSINESS ADDR</th>
              <th class="all">BILLING ADDR</th>
              <th class="all">CONTACT NAME</th>
              <th class="all">POSITION</th>
              <th class="all">TEL. #</th>
              <th class="all">FAX #</th>
              <th class="all">MOBILE #</th>
              <th class="all">EMAIL</th>
              <th class="all">TERMS</th>
              <th class="all">CREDIT LIMIT</th>
              <th class="all">REG. NO.</th>
              <th class="all">SEC. REG.</th>

              <th class="all">PERMIT NO.</th>
              <th class="all">BIR CERT.</th>
              <th class="all">TIN</th>
              <th class="all">VAT No.</th>
              <th class="all">TAX</th>
              <th class="all">BANK NAME</th>
              <th class="all">BANK LOC.</th>
              <th class="all">ACCT NAME</th>
              <th class="all">ACCT SIGN.</th>
              
              <th class="all">SIGN. OFFICER</th>
              <th class="all">VERIFIED BY</th>
              <th class="all">VENDOR IMAGE</th>
              <th class="all">UPLOAD IMAGE</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
  </div> 
  <!-- New Purchase item -->
  <!-- Edit Request Material -->
  <div class="modal fade bd-example-modal-lg" data-bs-keyboard="false" id="purchaseitemmodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" style="width: 1400px;min-height:650px;margin-left: -350px;">
        <div class="modal-header" style="background-color: #17A2B8;color:white;">
          <h5 class="modal-title" id="formModalLabel">New Purchase Item</h5>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i>
          </button>
        </div>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <div style="margin-left: 10px;"></div>
            <!-- <div style="float: left";>
              <div style="border: 1px;min-height: 100px;min-width:300px;line-height: 50px;margin: 10px;">
                <div id="leftmat" style="border: 1px;min-width: 600px;float: left;">
                  
                </div>
              </div>
            </div> -->

            <div style="float: right;border: 1px;">
              <!-- <form action="" method="GET" enctype="multipart/form-data"> -->
                <div style="border: 1px;min-height: 100px;min-width:300px;line-height: 50px;margin: 10px;">
                  <div id="leftmat" style="border: 1px;min-width: 200px;float: left;">
                    <div class="form-group row">
                      <div class="panel panel-default" >
                        <div class="panel-heading" style="border:1px solid #dee2e6;padding-left: 20px;" >VENDOR</div>
                        <div class="panel-body" style="border:1px solid #dee2e6;height: 150px;width: 200px;">
                          <img id="vendorimg" src="#" alt="UPLOAD IMAGE" />
                          <!-- <button class="btn btn-primary" id=""><i class = "fa fa-plus-circle"></i>Upload Image</button> -->
                        </div>
                        <div class="panel-body">
                          <input type="file" class="form-control" name="inputimg" id="inputimg" placeholder="" style="width: 200px;" accept="image/png, image/gif, image/jpeg">
                          <!-- <button class="btn btn-primary" id=""><i class = "fa fa-plus-circle"></i>Upload Image</button> -->
                        </div>

                        
                      </div>
                      <!-- <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Plate No:</label> -->
                      <!-- <div class="col-sm-1">                        
                        <input type="text" class="form-control" name="" id="txtplatenos" placeholder="" style="height: 30px;" disabled>
                      </div> -->
                    </div>

                  </div>
                  <div id="leftmat" style="border: 1px;min-width: 500px;float: left;border-right: 1px solid #dee2e6;">
                    <div class="panel panel-default" style="border-left: 1px solid #dee2e6;">
                      <div class="panel-heading" style="border-bottom:1px solid #dee2e6;border-top:1px solid #dee2e6;padding-left: 20px;">Business Information</div>
                      <p></p>
                      <div class="panel-body" style="border-bottom: 1px solid #dee2e6;padding-bottom: 20px;padding-left: 20px;">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label" id="" style="height: 30px;border: 0px solid black;">Company:</label>
                          <div class="col-sm-8">                        
                            <input type="text" class="form-control" name="" id="txtcomp" placeholder="Company" style="height: 30px;">

                            <!-- <input type="hidden" class="form-control" id="mwrfidmaterialhidden" placeholder="" style="height: 30px;"> -->
                          </div>

                        </div>
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Prev. Name:</label>
                          <div class="col-sm-8">
                            <textarea class="form-control" id="txtprevname" placeholder="Prev. Name"></textarea>
                            <!-- <input type="text" class="form-control" id="txtprevname" placeholder="Prev. Name" style="height: 30px;"> -->
                            <input type="hidden" class="form-control" id="txtassignid" placeholder="" style="height: 30px;">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Type:</label>
                          <div class="col-sm-8">                        
                           <select class="form-control" id="cbotype" placeholder = "">
                            <option disabled="">Type</option>
                            <option></option>
                            <option>SOLE PROPREITOR</option>
                            <option>PARTNERSHIP</option>
                            <option>CORPORATION</option>
                          </select>

                          <!-- <input type="hidden" class="form-control" id="mwrfidmaterialhidden" placeholder="" style="height: 30px;"> -->
                        </div>
                        <div class="col-sm-2">
                          <!-- <button class="btn btn-primary" id="btnplatemodal"><i class = "fa fa-plus-circle"></i></button> -->
                          <!-- <input type="hidden" class="form-control" id="mwrfidmaterialhidden" placeholder="" style="height: 30px;"> -->
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Nature:</label>
                        <div class="col-sm-8">
                          <textarea class="form-control" id="txtnature" placeholder="Nature"></textarea>
                          <!-- <input type="text" class="form-control" id="txtnature" placeholder="Nature" style="height: 30px;"> -->
                          <!-- <input type="text" class="form-control" id="txtdesc" placeholder="" style="height: 30px;" > -->
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Business Address:</label>
                        <div class="col-sm-8">
                          <!-- <input type="text" class="form-control" id="txtbusaddr" placeholder="Business Address" style="height: 30px;" > -->
                          <textarea class="form-control" id="txtbusaddr" placeholder="Business Address"></textarea>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Billing Address:</label>
                        <div class="col-sm-8">
                          <!-- <input type="text" class="form-control" id="txtbilladdr" placeholder="Billing Address" style="height: 30px;" > -->
                          <textarea class="form-control" id="txtbilladdr" placeholder="Billing Address"></textarea>
                        </div>
                      </div>

                    </div>
                  </div>
                  <!-- panel end -->
                </div>
                <!-- <div id></div> -->
                <div id = "rightmat" style="border: 1px;width: 600px;float: right;">

                  <div class="panel panel-default" style="border-left: 1px solid #dee2e6;border-right: 1px solid #dee2e6;">
                    <div class="panel-heading" style="border-bottom:1px solid #dee2e6;border-top:1px solid #dee2e6;padding-left: 20px;">Bank Information</div>
                    <p></p>
                    <div class="panel-body" style="border-bottom: 1px solid #dee2e6;padding-bottom: 20px;padding-left: 20px;">
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label" id="" style="height: 30px;border: 0px solid black;">Bank:</label>
                        <div class="col-sm-8">                        
                          <input type="text" class="form-control" name="" id="txtbank" placeholder="Bank Name" style="height: 30px;">

                          <!-- <input type="hidden" class="form-control" id="mwrfidmaterialhidden" placeholder="" style="height: 30px;"> -->
                        </div>

                      </div>
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Location:</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="txtloc" placeholder="Bank Location" style="height: 30px;">
                          <input type="hidden" class="form-control" id="txtassignid" placeholder="" style="height: 30px;">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Acct No.:</label>
                        <div class="col-sm-8">                        
                          <input type="text" class="form-control" id="txtacctno" placeholder="Account No." style="height: 30px;">

                          <!-- <input type="hidden" class="form-control" id="mwrfidmaterialhidden" placeholder="" style="height: 30px;"> -->
                        </div>
                        <div class="col-sm-2">
                          <!-- <button class="btn btn-primary" id="btnplatemodal"><i class = "fa fa-plus-circle"></i></button> -->
                          <!-- <input type="hidden" class="form-control" id="mwrfidmaterialhidden" placeholder="" style="height: 30px;"> -->
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Acct. Type:</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="txtaccttype" placeholder="Account Type" style="height: 30px;">
                          <!-- <input type="text" class="form-control" id="txtdesc" placeholder="" style="height: 30px;" > -->
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Acct. Name:</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="txtacctname" placeholder="Account Name" style="height: 30px;" >
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Holder Sign:</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="txtholder" placeholder="Holder Signatory" style="height: 30px;" >
                        </div>
                      </div>
                      <br>
                      <div class="form-group row">
                        <label class="col-sm-5 col-form-label" id="" style="height: 30px;">Signatory Officer:</label>
                        <label class="col-sm-5 col-form-label" id="" style="height: 30px;">Verified By:</label>
                      </div>
                      <div class="form-group row">
                        <div class="col-sm-5">
                          <input type="text" class="form-control" id="txtsignatory" placeholder="Signatory Officer" style="height: 30px;" >
                        </div>
                        <div class="col-sm-5">
                          <input type="text" class="form-control" id="txtverby" placeholder="Verified By" style="height: 30px;" >
                        </div>
                      </div>

                      <div class="form-group row" style="width:400px;">
                        
                          
                          <div class="col-sm-4" style="width:50px;height: 50px;">
                            <img id="bankimg" src="#" alt="UPLOAD FILE" />
                          
                          </div>
                          <div class="col-sm-5">
                            <input type="file" class="form-control" name="uploadimg" id="uploadimg" placeholder="" style="width: 200px;" accept="image/png, image/gif, image/jpeg">
                          </div>
                          


                        
                      </div>

                  </div>
                </div>
                <!-- panel end -->

              </div>      
            </div>

            <!-- </form> -->
            <div class="modal-footer" style="border: 1px;float: right;">     
                  <!-- <button type="button" class="btn btn-info" id="btnsaveitem">
                    <i style="padding-right: 5px;" class="fas fa-save"></i>SAVE</button>
                    <button type="button" class="btn btn-info" name="btnupdateitem" id="btnupdateitem" style=""><i style="padding-right: 5px;" class="fa fa-refresh"></i>UPDATE</button> -->

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
                        <!-- end div -->
                        <div style="border: 1px;min-width: 500px;float: left;border-right: 1px solid #dee2e6;">
                          <div style="float:left;border:0px solid black;width: 600px;">
                            <div class="panel panel-default" style="border-left: 1px solid #dee2e6;">
                              <div class="panel-heading" style="border-bottom:1px solid #dee2e6;border-top:1px solid #dee2e6;padding-left: 20px;">Business Contacts</div>
                              <p></p>
                              <div class="panel-body" style="border-bottom: 1px solid #dee2e6;padding-bottom: 20px;padding-left: 20px;">
                                <div class="form-group row">
                                  <label class="col-sm-2 col-form-label" id="" style="height: 30px;border: 0px solid black;">Name:</label>
                                  <div class="col-sm-8">                        
                                    <input type="text" class="form-control" name="" id="txtcontact" placeholder="Contact Person" style="height: 30px;">

                                    <!-- <input type="hidden" class="form-control" id="mwrfidmaterialhidden" placeholder="" style="height: 30px;"> -->
                                  </div>

                                </div>
                                <div class="form-group row">
                                  <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Position:</label>
                                  <div class="col-sm-8">
                                    <input type="text" class="form-control" id="txtposition" placeholder="Position" style="height: 30px;">
                                    <input type="hidden" class="form-control" id="txtassignid" placeholder="" style="height: 30px;">
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Tel No.:</label>
                                  <div class="col-sm-8">                        
                                   <input type="text" class="form-control" id="txttelno" placeholder="Tel No." style="height: 30px;">

                                  <!-- <input type="hidden" class="form-control" id="mwrfidmaterialhidden" placeholder="" style="height: 30px;"> -->
                                </div>
                                <div class="col-sm-2">
                                  <!-- <button class="btn btn-primary" id="btnplatemodal"><i class = "fa fa-plus-circle"></i></button> -->
                                  <!-- <input type="hidden" class="form-control" id="mwrfidmaterialhidden" placeholder="" style="height: 30px;"> -->
                                </div>
                              </div>

                              <div class="form-group row">
                                <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Fax No.:</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="txtfaxno" placeholder="Fax No." style="height: 30px;">
                                  <!-- <input type="text" class="form-control" id="txtdesc" placeholder="" style="height: 30px;" > -->
                                </div>
                              </div>

                              <div class="form-group row">
                                <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Mobile No.:</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="txtmobno" placeholder="Mobile No." style="height: 30px;" >
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Email:</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="txtemail" placeholder="Email Address" style="height: 30px;" >
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Terms:</label>
                                <div class="col-sm-8">
                                  <!-- <input type="text" class="form-control" id="txtterms" placeholder="Terms" style="height: 30px;" > -->
                                  <select class="form-control" id="cboterms" placeholder = "" style="height: 30px;">
                                    <option disabled="">Days</option>
                                    <option></option>
                                    <option>15</option>
                                    <option>30</option>
                                  </select>
                                </div>
                                <p></p>
                                <p></p>
                                <p></p>
                              </div>
                              <!-- <div class="form-group row">
                                <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Terms:</label>
                                <div class="col-sm-8">
                                  <select class="form-control" id="cboterms" placeholder = "" style="height: 30px;">
                                    <option disabled="">Days</option>
                                    <option></option>
                                    <option>15</option>
                                    <option>30</option>
                                  </select>
                                </div>
                              </div> -->


                            </div>
                          </div>
                        </div>
                        <div style="float:left;border:0px solid black;">
                          <div class="panel panel-default" style="border-left: 0px solid #dee2e6;border-right: 1px solid #dee2e6;width: 600px;">
                            <div class="panel-heading" style="border-bottom:1px solid #dee2e6;border-top:1px solid #dee2e6;padding-left: 20px;"> &nbsp;</div>
                            <p></p>
                            <div class="panel-body" style="border-bottom: 1px solid #dee2e6;padding-bottom: 20px;padding-left: 20px;">
                              <div class="form-group row">
                                <label class="col-sm-2 col-form-label" id="" style="height: 30px;border: 0px solid black;">Limit:</label>
                                <div class="col-sm-8">                        
                                  <input type="text" class="form-control" name="" id="txtcredit" placeholder="Credit Limit" style="height: 30px;">

                                  <!-- <input type="hidden" class="form-control" id="mwrfidmaterialhidden" placeholder="" style="height: 30px;"> -->
                                </div>

                              </div>
                              <div class="form-group row">
                                <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Reg. No.:</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="txtregno" placeholder="Business Registration No." style="height: 30px;">
                                  <input type="hidden" class="form-control" id="txtassignid" placeholder="" style="height: 30px;">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Sec. Reg.:</label>
                                <div class="col-sm-8">                        
                                 <input type="text" class="form-control" id="txtsecreg" placeholder="Sec. Registration" style="height: 30px;">

                                <!-- <input type="hidden" class="form-control" id="mwrfidmaterialhidden" placeholder="" style="height: 30px;"> -->
                              </div>
                              <div class="col-sm-2">
                                <!-- <button class="btn btn-primary" id="btnplatemodal"><i class = "fa fa-plus-circle"></i></button> -->
                                <!-- <input type="hidden" class="form-control" id="mwrfidmaterialhidden" placeholder="" style="height: 30px;"> -->
                              </div>
                            </div>

                            <div class="form-group row">
                              <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Permit:</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control" id="txtpermit" placeholder="Business Permit" style="height: 30px;">
                                <!-- <input type="text" class="form-control" id="txtdesc" placeholder="" style="height: 30px;" > -->
                              </div>
                            </div>

                            <div class="form-group row">
                              <label class="col-sm-2 col-form-label" id="" style="height: 30px;">BIR CR:</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control" id="txtbircr" placeholder="BIR Certificate of Registration" style="height: 30px;" >
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-sm-2 col-form-label" id="" style="height: 30px;">TIN No.:</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control" id="txttinno" placeholder="TIN NO." style="height: 30px;" >
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-sm-2 col-form-label" id="" style="height: 30px;">VAT No.:</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control" id="txtvatno" placeholder="VAT No." style="height: 30px;" >
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-sm-2 col-form-label" id="" style="height: 30px;">TAX:</label>
                              <div class="col-sm-8">
                                <select class="form-control" id="cbotax" placeholder = "" style="height: 30px;">
                                    <option disabled="">TAX</option>
                                    <option></option>
                                    <option>VAT</option>
                                    <option>Non-VAT</option>
                                </select>
                              </div>
                            </div>

                          </div>
                        </div>
                      </div>
                      <!-- panel end -->
                      <div style="float:left;border:0px solid black;">
                          <div class="panel panel-default" style="border-left: 0px solid #dee2e6;border-right: 1px solid #dee2e6;padding-right: 20px;">
                            <div class="panel-heading" style="border-bottom:1px solid #dee2e6;border-top:1px solid #dee2e6;padding-left: 20px;"> &nbsp;</div>
                            <p></p>
                            <div class="panel-body" style="border-bottom: 1px solid #dee2e6;padding-bottom: 20px;padding-left: 20px;">
                              <button id="btnsavevendor" class="btn btn-success">SAVE</button>
                              <button id="btnupdatevendor" class="btn btn-success">UPDATE</button>
                            </div>
                          </div>
                      </div>
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
                    let imgInput = document.getElementById('inputimg');
                    imgInput.addEventListener('change', function (e) {
                      if (e.target.files) {
                        let imageFile = e.target.files[0];
                        var reader = new FileReader();
                        reader.onload = function (e) {
                          var img = document.createElement("img");
                          img.onload = function (event) {
                        // Dynamically create a canvas element
                        var canvas = document.createElement("canvas");

                        // var canvas = document.getElementById("canvas");
                        var ctx = canvas.getContext("2d");

                        // Actual resizing
                        ctx.drawImage(img, 0, 0, 200, 150);

                        // Show resized image in preview element
                        var dataurl = canvas.toDataURL(imageFile.type);
                        document.getElementById("vendorimg").src = dataurl;
                      }
                      img.src = e.target.result;
                    }
                    reader.readAsDataURL(imageFile);
                  }
                });

                let imgBank = document.getElementById('uploadimg');
                    imgBank.addEventListener('change', function (e) {
                      if (e.target.files) {
                        let imageFile = e.target.files[0];
                        var reader = new FileReader();
                        reader.onload = function (e) {
                          var img = document.createElement("img");
                          img.onload = function (event) {
                        // Dynamically create a canvas element
                        var canvas = document.createElement("canvas");

                        // var canvas = document.getElementById("canvas");
                        var ctx = canvas.getContext("2d");

                        // Actual resizing
                        ctx.drawImage(img, 0, 0, 50, 50);

                        // Show resized image in preview element
                        var dataurl = canvas.toDataURL(imageFile.type);
                        document.getElementById("bankimg").src = dataurl;
                      }
                      img.src = e.target.result;
                    }
                    reader.readAsDataURL(imageFile);
                  }
                });
                $('#btnsavevendor').click(function(){
                  var currdate = new Date().toISOString().slice(0, 10).replace('T', ' ');
                  var vendorimg = document.getElementById("inputimg").files[0].name;
                  alert(vendorimg);
                  var comp = $('#txtcomp').val();
                  var prevname = $('#txtprevname').val();
                  var type = $('#cbotype option:selected').val();
                  var nature = $('#txtnature').val();
                  var busaddr = $('#txtbusaddr').val();
                  var billaddr = $('#txtbilladdr').val();
                  var bank = $('#txtbank').val();
                  var loc = $('#txtloc').val();
                  var acctno = $('#txtacctno').val();
                  var accttype = $('#txtaccttype').val();
                  var acctname = $('#txtacctname').val();
                  var holder = $('#txtholder').val();
                  var signa = $('#txtsignatory').val();
                  var verby = $('#txtverby').val();
                  var bankimg = $('#uploadimg').val();
                  var contact = $('#txtcontact').val();
                  var position = $('#txtposition').val();
                  var telno = $('#txttelno').val();
                  var faxno = $('#txtfaxno').val();
                  var mobno = $('#txtmobno').val();
                  var email = $('#txtemail').val();
                  var terms = $('#cboterms').val();
                  var credit = $('#txtcredit').val();
                  var regno = $('#txtregno').val();
                  var secreg = $('#txtsecreg').val();
                  var permit = $('#txtpermit').val();
                  var bircr = $('#txtbircr').val();
                  var tinno = $('#txttinno').val();
                  var vatno = $('#txtvatno').val();
                  var tax = $('#cbotax option:selected').val();


                  xajax_insertvendor(comp,prevname,type,nature,busaddr,billaddr,contact,position,telno,faxno,mobno,email,terms,credit,regno,secreg,permit,bircr,tinno,vatno,tax,bank,loc,acctname,holder,signa,verby,vendorimg,bankimg,currdate);
                  //alert(wew);

                })    
                  /*$('document').ready(function () {
    $("#inputimg").change(function () {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#vendorimg').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });
});
*/
var plate_id = "";
function editplate(id,platenos){
  $('#txtplatenosnew').val(platenos);
  document.getElementById("txtplatenosnew").disabled=false;

  plate_id = id;
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
                    var descr = $('#txtdesc').val();
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
                    if (plate_id == "" || assign == "" || daterefno == ""){
                      Swal.fire({
                        type: 'warning',
                        title: '',
                        text: 'please fill in the missing fields.'
                      })

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

                    //alert(plate_id + assign + item + desc + brand + qty + unit + price + amount + supp + addr + rfno + daterfno + pono + reqby + refno + daterefno + ref + otherref + remarks,1);
                    
                    //xajax_insertvamitem($plate_id,$assign_id,$item,$desc,$brand,$qty,$unit,$price,$amount,$supp_name,$supp_addr,$rf_no,$daterfno,$po_no,$po_date,$req_by,$ref_no,$daterefno,$other_ref,$remarks,$status)
                    /*var platenos = $("#txtplatenosnew").val();
                    //alert(platenos);
                    //xajax_updatesample(plate_id,platenos);
                    xajax_updateplate(plate_id,platenos);*/
                  });


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
                      window.open("../../../reports/fuel_info_v2.php?datefrom= " + from + " & dateto="+to+" & plateno="+tfplatenos.toString(), "_blank"); 
                    }
                    else if(tfplatenos != '') {
                      window.open("../../../reports/fuel_info_specific.php?datefrom= " + from + " & dateto="+to+" & plateno="+tfplatenos.toString(), "_blank");
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
  /*  drawCallback: function () {
      var api = this.api();
      $( api.column(5).footer() ).html(
        api.column( 5, {page:'current'} ).data().sum()
      );
      $( api.column(6).footer() ).html(
        api.column( 6, {page:'current'} ).data().sum()
      );
      $( api.column(7).footer() ).html(
        api.column( 7, {page:'current'} ).data().sum()
      );

    },*/
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
    //alert(maxDateFilter);
    table.draw();
  });


// Date range filter
var minDateFilter = "";
var maxDateFilter = "";

$.fn.dataTableExt.afnFiltering.push(
  function(oSettings, aData, iDataIndex) {
    if (typeof aData._date == 'undefined') {
      aData._date = new Date(aData[16]).getTime();
    }
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
      if ( ( isNaN( minDateFilter ) && isNaN( maxDateFilter ) ) ||
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
  rowassign =  $(this).find('td:eq(2)').text();
  //rowitem =  $(this).find('td:eq(3)').text();
  //rowdesc =  $(this).find('td:eq(4)').text();
  rowfuelname =  $(this).find('td:eq(3)').text();
  
  //rowbrand =  $(this).find('td:eq(5)').text();
  rowqty =  $(this).find('td:eq(4)').text();
  //rowunit =  $(this).find('td:eq(5)').text();
  rowprice =  $(this).find('td:eq(5)').text();
  rowamount =  $(this).find('td:eq(6)').text();
  rowsupp =  $(this).find('td:eq(7)').text();
  rowmodel =  $(this).find('td:eq(8)').text();
  //rowsupp =  $(this).find('td:eq(10)').text();
  //rowaddr =  $(this).find('td:eq(11)').text();
  rowrfno =  $(this).find('td:eq(9)').text();
  rowrfdate =  $(this).find('td:eq(10)').text();
  rowpono =  $(this).find('td:eq(11)').text();
  rowpodate =  $(this).find('td:eq(12)').text();
  rowreqby =  $(this).find('td:eq(13)').text();
  rowrefno =  $(this).find('td:eq(14)').text();
  rowrefdate =  $(this).find('td:eq(15)').text();
  rowcvjv =  $(this).find('td:eq(16)').text();
  rowotherref =  $(this).find('td:eq(17)').text();
  roworemarks =  $(this).find('td:eq(18)').text();
  rowdesc =  $(this).find('td:eq(19)').text();

  fuelid = rowid;
  $('#txtplatenos').val(rowplate);
  $('#txtassign').val(rowassign);
  //$('#txtitem').val(rowitem);
  $('#txtfuelname').val(rowfuelname);
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
  $('#txtremark').val(rowdesc);

  $('#btnupdateitem').show();
  $('#btnsaveitem').hide();

  $('#purchaseitemmodal').modal('show');
});
$('#btnupdateitem').click(function(){

  xajax_updatefuelinfo(fuelid,rowplateid,$('#txtassign').val(),$('#txtfuelname').val(),$('#txtqty').val(),$('#txtprice').val(),$('#txtamount').val(),$('#txtsupp').val(),$('#txtmodel').val(),$('#txtrfno').val(),$('#txtdaterfno').val(),$('#txtpono').val(),$('#txtponodate').val(),$('#txtreqby').val(),$('#txtrefno').val(),$('#txtdaterefno').val(),$('#txtref').val(),$('#txtotherref').val(),$('#txtremark').val(),$('#txtdesc').val(),1);
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