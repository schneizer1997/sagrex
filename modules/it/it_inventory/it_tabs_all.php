<?php
include('../../../classes/inc/dbCon.php');
require('it_inventory.common.php');
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
		ITEMS</div>
		<div style="margin-top:10px;">
			<button id = "btnpack" class="btn btn-primary" style="width:200px;float:right;margin-left: 10px;margin-right: 10px;">PACKAGE</button>
			<button id="btnsingle" class="btn btn-primary" style="width:200px;float: right;">SINGLE</button>
		</div>
		<hr>

		
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-hover" id="tblallitems" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>ID</th>
							<th>DESC</th>
							<th>QTY</th>
							<th>UNIT</th>
							<th>SERIAL</th>
							<th>BARCODE</th>
							<th>CATEGORY</th>
							<th>REMARKS</th>
							<th><center>DATE ADDED</center></th>
							<th>STATUS</th>
							<th>ACTION</th>
						</tr>
					</thead>
<!-- 					<tbody>
						
					</tbody> -->
				</table>
			</div>
		</div>
		<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
	</div>
	<!-- END RR -->

<!-- ITEMS SINGLE -->
                <div class="modal fade bd-example-modal-lg" id="additemmodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="">
                  <div class="modal-dialog modal-lg" role="document" style="width: auto;">
                    <div class="modal-content" style="">
                      <div class="modal-header" style="">
                        <h5 class="modal-title" id="formModalLabel"><strong>Item's Info</strong></h5>
                        <button class="btn btn-secondary" id="btnformitemclose" style="border:0px;color: white;background-color: orange;"><i class="fa fa-close"></i></button>
                        
                      </div>

                      <div class="form-group" style="border-bottom:1px solid black;margin-bottom: -20px;">

                        <hr class="my-2" />

                        <div class="form-group row" style="height:30px;">
                        	<label  id="" style="height: 30px;margin-right: -5px;margin-left: 30px;font-size: 12px;">Description:</label>&nbsp;&nbsp;
                          <div class="col-sm-4">                        
                            <input tabindex="3" type="text" class="form-control" name="" id="txtadditemdesc"  placeholder="" style="height: 50px;border: 1px solid black;color: black;height: 30px;">
                          </div>
                         <!--  <label  id="" style="height: 30px;margin-left: 30px;margin-right: 10px;font-size: 12px;">Barcode:</label>&nbsp;&nbsp;
                          <div class="col-sm-4">                        
                            <input tabindex="1" type="text" class="form-control" name="" id="txtaddbarcode" placeholder="" style="height: 50px;border: 1px solid black;color: black;height: 30px;">
                          </div> -->
                          <!-- <label  id="" style="height: 30px;margin-left: 30px;margin-right: 20px;font-size: 12px;">Serial:</label>&nbsp;&nbsp;

                          <div class="col-sm-4">                        
                            <input tabindex="2" type="text" class="form-control" name="" id="txtaddserial" placeholder="" style="height: 50px;border: 1px solid black;color: black;height: 30px;">
                          </div> -->

                          <label  id="" style="height: 30px;margin-left: 30px;margin-right: 30px;font-size: 12px;">Unit:</label>&nbsp;&nbsp;
                          <div class="col-sm-4">                        
                            <input tabindex="4" type="text" onchange="setTwoNumberDecimal" min="0" max="10" step="0.25" class="form-control" name="" id="txtaddunit" placeholder="" style="height: 50px;border: 1px solid black;color: black;height: 30px;">
                          </div>
                         
                          
                          
                          
                        </div>
                        <div class="form-group row" style="height:30px;">
                        	<label id="" style="height: 30px;margin-left: 30px;margin-right: 40px;font-size: 12px;">Qty:</label>&nbsp;&nbsp;
                          <!-- <div class="col-sm-4">
                            <input type="number" tabindex="2" class="form-control" oninput="this.value = this.value.replace(/[^1-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" name="" id="txtitemqty" placeholder="" style="height: 50px;border: 1px solid black;color: black;height: 30px;">
                          </div> -->

                          <div class="col-sm-4">
                            <input tabindex="5" type="number"  class="form-control" name="" id="txtadditemqty" placeholder="" style="height: 50px;border: 1px solid black;color: black;height: 30px;">
                          </div>
                          <label id="" style="height: 30px;margin-left: 25px;font-size: 12px;">Category:</label> &nbsp;&nbsp;
                          <div class="col-sm-4">                        
                            <!-- <input tabindex="6" type="text" class="form-control" name="" id="txtcategory" placeholder="" value="SINGLE" style="height: 50px;border: 1px solid black;color: black;height: 30px;"> -->


                             <select tabindex="8" type="text" class="form-control" name="" id="txtaddcategory" placeholder="" style="height: 50px;border: 1px solid black;color: black;height: 30px;">
                            	<option></option>
                            	<option>MOUSE</option>
                            	<option>KEYBOARD</option>
                            	<option>MONITOR</option>
                            	<option>PRINTER</option>
                            	<option>PARTS</option>
                            	<option>OTHERS</option>
                            </select>
                        </div>

                          
                            
                          </div>
                          
                          

                         
                        <div class="form-group row" style="height:30px;">
                          


                           

                          
                        </div>

                        <hr>
                        <div class="form-group row" style="height:30px;float: right;">
                          <div class="col-sm-3">                        

                            <button class="btn btn-primary" id="txtadditemsave" style="height: 30px;line-height: 0px;">SAVE</button>

                          </div>
                          <div class="col-sm-3">                        

                            <button class="btn btn-primary" id="txtadditemupdate" style="height: 30px;line-height: 0px;">UPDATE</button>

                          </div>&nbsp;&nbsp;&nbsp;&nbsp;

                          <div class="col-sm-3">                        
                            <button class="btn btn-primary" id="txtadditemprint" style="height: 30px;line-height: 0px;">PRINT</button>
                          </div>
                          
                        </div>


                        </div>
                        <hr class="my-2" />


                      <!-- <button type="button" class="btn btn-success" id="btnnewplate">CREATE</button>&nbsp; -->

                      <!-- <div class="table-responsive">
                        <table id="tblpoitems" class="table table-striped header-fixed-bordered table-hover table-striped" width="100%" style="overflow:auto;table-layout:auto !important;">
                           <thead class="thead-dark" width = "100%">
                            <tr>
                             <th>ID</th>

                             <th>PO#</th>

                             <th>QTY</th>
                             <th>UNIT</th>
                             <th>DESCRIPTION</th>
                             <th>UP</th>
                             <th>AMOUNT</th>
                             <th>ACTION</th>
                             
                         </tr>
                     </thead>
                 </table>
             </div> -->

                      <!-- <table class="table table-bordered table-striped" id="mtable1" cellspacing="0">
                        <tbody id="mtable2">
                          <iframe style="border: 0px;padding-left: 10px;height: 800px;" width="100%" name="frameplates" id="frameplates" src="" /></iframe>
                        </tbody>
                      </table> -->

                    </div>
                  </div>
                </div>
                <!-- END ITEMS -->

<!-- ITEMS SINGLE -->
                <div class="modal fade bd-example-modal-lg" id="allitemmodal" tabindex="1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document" style="width: auto;">
                    <div class="modal-content" style="">
                      <div class="modal-header" style="">
                        <h5 class="modal-title" id="formModalLabel"><strong>Item's Info</strong></h5>
                        <button class="btn btn-secondary" id="btnformitemclose" style="border:0px;color: white;background-color: orange;"><i class="fa fa-close"></i></button>
                        
                      </div>

                      <div class="form-group" style="border-bottom:1px solid black;margin-bottom: -20px;">

                        <hr class="my-2" />

                        <div class="form-group row" style="height:30px;">
                          <label  id="" style="height: 30px;margin-left: 30px;margin-right: 10px;font-size: 12px;">Barcode:</label>&nbsp;&nbsp;
                          <div class="col-sm-4">                        
                            <input tabindex="1" type="text" class="form-control" name="" id="txtbarcode" placeholder="" style="height: 50px;border: 1px solid black;color: black;height: 30px;">
                          </div>
                          <label  id="" style="height: 30px;margin-left: 30px;margin-right: 20px;font-size: 12px;">Serial:</label>&nbsp;&nbsp;

                          <div class="col-sm-4">                        
                            <input tabindex="2" type="text" class="form-control" name="" id="txtserial" placeholder="" style="height: 50px;border: 1px solid black;color: black;height: 30px;">
                          </div>
                         
                          
                          
                          
                        </div>
                        <div class="form-group row" style="height:30px;">
                          <label  id="" style="height: 30px;margin-right: -5px;margin-left: 30px;font-size: 12px;">Description:</label>&nbsp;&nbsp;
                          <div class="col-sm-4">                        
                            <input tabindex="3" type="text" class="form-control" name="" id="txtitemdesc"  placeholder="" style="height: 50px;border: 1px solid black;color: black;height: 30px;">
                          </div>

                          <label  id="" style="height: 30px;margin-left: 30px;margin-right: 30px;font-size: 12px;">Unit:</label>&nbsp;&nbsp;
                          <div class="col-sm-4">                        
                            <input tabindex="4" type="text" onchange="setTwoNumberDecimal" min="0" max="10" step="0.25" class="form-control" name="" id="txtunit" placeholder="" style="height: 50px;border: 1px solid black;color: black;height: 30px;">
                          </div>
                            
                          </div>
                          
                          

                         
                        <div class="form-group row" style="height:30px;">
                          <label id="" style="height: 30px;margin-left: 30px;margin-right: 40px;font-size: 12px;">Qty:</label>&nbsp;&nbsp;
                          <!-- <div class="col-sm-4">
                            <input type="number" tabindex="2" class="form-control" oninput="this.value = this.value.replace(/[^1-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" name="" id="txtitemqty" placeholder="" style="height: 50px;border: 1px solid black;color: black;height: 30px;">
                          </div> -->

                          <div class="col-sm-4">
                            <input tabindex="5" type="number"  class="form-control" name="" id="txtitemqty" placeholder="" style="height: 50px;border: 1px solid black;color: black;height: 30px;">
                          </div>


                           

                          <label id="" style="height: 30px;margin-left: 25px;font-size: 12px;">Category:</label> &nbsp;&nbsp;
                          <div class="col-sm-4">                        
                            <!-- <input tabindex="6" type="text" class="form-control" name="" id="txtcategory" placeholder="" value="SINGLE" style="height: 50px;border: 1px solid black;color: black;height: 30px;"> -->


                             <select tabindex="8" type="text" class="form-control" name="" id="txtcategory" placeholder="" style="height: 50px;border: 1px solid black;color: black;height: 30px;">
                            	<option></option>
                            	<option>MOUSE</option>
                            	<option>KEYBOARD</option>
                            	<option>MONITOR</option>
                            	<option>PRINTER</option>
                            	<option>PARTS</option>
                            	<option>OTHERS</option>
                            </select>
                        </div>
                        </div>

                        <div class="form-group row" style="height:30px;">
                          <label id="" style="height: 30px;margin-left: 30px;margin-right: 12px;font-size: 12px;">Remarks:</label>&nbsp;&nbsp;
                          <!-- <div class="col-sm-4">
                            <input type="number" tabindex="2" class="form-control" oninput="this.value = this.value.replace(/[^1-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" name="" id="txtitemqty" placeholder="" style="height: 50px;border: 1px solid black;color: black;height: 30px;">
                          </div> -->

                          <div class="col-sm-4">
                            <input tabindex="7" type="number"  class="form-control" name="" id="txtremarks" placeholder="" style="height: 50px;border: 1px solid black;color: black;height: 30px;">
                          </div>


                           

                          <label id="" style="height: 30px;margin-left: 25px;margin-right: 20px;font-size: 12px;">Status:</label> &nbsp;&nbsp;
                          <div class="col-sm-4">                        
                            <!-- <input tabindex="8" type="text" class="form-control" name="" id="txtstatus" placeholder="" style="height: 50px;border: 1px solid black;color: black;height: 30px;"> -->
                            <select tabindex="8" type="text" class="form-control" name="" id="txtstatus" placeholder="" style="height: 50px;border: 1px solid black;color: black;height: 30px;">
                            	<option>NEW</option>
                            	<option>BROKEN</option>
                            	<option>DISPOSE</option>
                            </select>
                        </div>
                        </div>

                        <hr>

                        <div class="form-group row" style="height:30px;">
                          <label id="" style="height: 30px;margin-left: 25px;margin-right: 20px;font-size: 12px;">Assignee:</label>&nbsp;&nbsp;
                          <!-- <div class="col-sm-4">
                            <input type="number" tabindex="2" class="form-control" oninput="this.value = this.value.replace(/[^1-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" name="" id="txtitemqty" placeholder="" style="height: 50px;border: 1px solid black;color: black;height: 30px;">
                          </div> -->

                          <div class="col-sm-4">
                            <input tabindex="7" type="text"  class="form-control" name="" id="txtassignee" placeholder="" style="height: 50px;border: 1px solid black;color: black;height: 30px;">
                          </div>


                          <label id="" style="height: 30px;margin-left: 20px;font-size: 12px;">Date Assigned:</label> &nbsp;&nbsp;
                          <div class="col-sm-4">                        
                            <input tabindex="8" type="date" class="form-control" name="" id="txtdateassign" placeholder="" style="height: 50px;border: 1px solid black;color: black;height: 30px;">
                        </div>
                        </div>

                        <hr>



                        <div class="form-group row" style="height:30px;float: right;">
                          <div class="col-sm-3">                        

                            <button class="btn btn-primary" id="txtitemsave" style="height: 30px;line-height: 0px;">SAVE</button>

                          </div>
                          <div class="col-sm-3">                        

                            <button class="btn btn-primary" id="txtitemupdate" style="height: 30px;line-height: 0px;">UPDATE</button>

                          </div>&nbsp;&nbsp;&nbsp;&nbsp;

                          <div class="col-sm-3">                        
                            <button class="btn btn-primary" id="txtitemprint" style="height: 30px;line-height: 0px;">PRINT</button>
                          </div>
                          
                        </div>

                        </div>
                        <hr class="my-2" />


                      <!-- <button type="button" class="btn btn-success" id="btnnewplate">CREATE</button>&nbsp; -->

                      <!-- <div class="table-responsive">
                        <table id="tblpoitems" class="table table-striped header-fixed-bordered table-hover table-striped" width="100%" style="overflow:auto;table-layout:auto !important;">
                           <thead class="thead-dark" width = "100%">
                            <tr>
                             <th>ID</th>

                             <th>PO#</th>

                             <th>QTY</th>
                             <th>UNIT</th>
                             <th>DESCRIPTION</th>
                             <th>UP</th>
                             <th>AMOUNT</th>
                             <th>ACTION</th>
                             
                         </tr>
                     </thead>
                 </table>
             </div> -->

                      <!-- <table class="table table-bordered table-striped" id="mtable1" cellspacing="0">
                        <tbody id="mtable2">
                          <iframe style="border: 0px;padding-left: 10px;height: 800px;" width="100%" name="frameplates" id="frameplates" src="" /></iframe>
                        </tbody>
                      </table> -->

                    </div>
                  </div>
                </div>
                <!-- END ITEMS -->


                


                <!-- ITEMS PACKAGe -->
                <div class="modal fade bd-example-modal-lg" id="packageitemmodal" tabindex="1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document" style="width: auto;">
                    <div class="modal-content" style="height: 800px;">
                      <div class="modal-header" style="">
                        <h5 class="modal-title" id="formModalLabel"><strong>Item's Info</strong></h5>
                        <button class="btn btn-secondary" id="btnformitemclosepack" style="border:0px;color: white;background-color: orange;"><i class="fa fa-close"></i></button>
                        
                      </div>

                      <div class="form-group" style="border-bottom:1px solid black;margin-bottom: -20px;">

                        <hr class="my-2" />

                        <div class="form-group row" style="height:30px;">
                          <label  id="" style="height: 30px;margin-left: 30px;margin-right: 10px;font-size: 12px;">Barcode:</label>&nbsp;&nbsp;
                          <div class="col-sm-4">                        
                            <input tabindex="1" type="text" class="form-control" name="" id="txtbarcodepack" placeholder="" style="height: 50px;border: 1px solid black;color: black;height: 30px;">
                          </div>
                          <label  id="" style="height: 30px;margin-left: 30px;margin-right: 20px;font-size: 12px;">Serial:</label>&nbsp;&nbsp;

                          <div class="col-sm-4">                        
                            <input tabindex="2" type="text" class="form-control" name="" id="txtserialpack" placeholder="" style="height: 50px;border: 1px solid black;color: black;height: 30px;">
                          </div>
                         
                          
                          
                          
                        </div>
                        <div class="form-group row" style="height:30px;">
                          <label  id="" style="height: 30px;margin-right: -5px;margin-left: 30px;font-size: 12px;">Description:</label>&nbsp;&nbsp;
                          <div class="col-sm-4">                        
                            <input tabindex="3" type="text" class="form-control" name="" id="txtitemdescpack"  placeholder="" style="height: 50px;border: 1px solid black;color: black;height: 30px;">
                          </div>
                          <label id="" style="height: 30px;margin-left: 25px;margin-right: 20px;font-size: 12px;">Status:</label> &nbsp;&nbsp;
                          <div class="col-sm-4">                        
                            <!-- <input tabindex="8" type="text" class="form-control" name="" id="txtstatus" placeholder="" style="height: 50px;border: 1px solid black;color: black;height: 30px;"> -->
                            <select tabindex="8" type="text" class="form-control" name="" id="txtstatuspack" placeholder="" style="height: 50px;border: 1px solid black;color: black;height: 30px;">
                            	<option>NEW</option>
                            	<option>BROKEN</option>
                            	<option>DISPOSE</option>
                            </select>
                        </div>

                          <!-- <label  id="" style="height: 30px;margin-left: 30px;margin-right: 30px;font-size: 12px;">Unit:</label>&nbsp;&nbsp;
                          <div class="col-sm-4">                        
                            <input tabindex="4" type="text" onchange="setTwoNumberDecimal" min="0" max="10" step="0.25" class="form-control" name="" id="txtunitpack" placeholder="" style="height: 50px;border: 1px solid black;color: black;height: 30px;">
                          </div> -->
                            
                          </div>

                        <div class="form-group row" style="height:30px;">
                          <label id="" style="height: 30px;margin-left: 30px;margin-right: 12px;font-size: 12px;">Remarks:</label>&nbsp;&nbsp;
                          <!-- <div class="col-sm-4">
                            <input type="number" tabindex="2" class="form-control" oninput="this.value = this.value.replace(/[^1-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" name="" id="txtitemqty" placeholder="" style="height: 50px;border: 1px solid black;color: black;height: 30px;">
                          </div> -->

                          <div class="col-sm-4">
                            <input tabindex="7" type="text"  class="form-control" name="" id="txtremarkspack" placeholder="" style="height: 50px;border: 1px solid black;color: black;height: 30px;">
                          </div>


                           

                          
                        </div>

                        <hr>

                        <div class="form-group row" style="height:30px;">
                          <label id="" style="height: 30px;margin-left: 25px;margin-right: 20px;font-size: 12px;">Assignee:</label>&nbsp;&nbsp;
                          <!-- <div class="col-sm-4">
                            <input type="number" tabindex="2" class="form-control" oninput="this.value = this.value.replace(/[^1-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" name="" id="txtitemqty" placeholder="" style="height: 50px;border: 1px solid black;color: black;height: 30px;">
                          </div> -->

                          <div class="col-sm-4">
                            <input tabindex="7" type="text"  class="form-control" name="" id="txtassigneepack" placeholder="" style="height: 50px;border: 1px solid black;color: black;height: 30px;">
                          </div>


                          <label id="" style="height: 30px;margin-left: 20px;font-size: 12px;">Date Assigned:</label> &nbsp;&nbsp;
                          <div class="col-sm-4">                        
                            <input tabindex="8" type="date" class="form-control" name="" id="txtdateassignpack" placeholder="" style="height: 50px;border: 1px solid black;color: black;height: 30px;">
                        </div>
                        </div>

                        <hr>



                        

                        </div>
                        <hr class="my-2" />

                        <div class="form-group row" style="float: right;height:30px;margin-bottom: -20px;margin-top: 10px;border: 0px solid black;">
                          <div class="col-sm-12">                        

                            <button class="btn btn-primary" id="btnadditem" style="height: 30px;line-height: 0px;float: right;margin-left: 10px;margin-right: 10px;">ADD ITEM</button>

                          </div>

                          
                        </div>


                      <!-- <button type="button" class="btn btn-success" id="btnnewplate">CREATE</button>&nbsp; -->
                      <hr class="my-2">

                      <div class="table-responsive" style="overflow:auto;">
                      	<table id="tblitemspack" class="table table-striped header-fixed-bordered table-hover table-striped" style="">

                      		<thead class="thead-dark" width = "100%" style="width:1000px;">
                      			<tr>
                      				<th style="width: 200px;">ID</th>
                      				<th style="width: 200px;">DESC</th>
                      				<th style="width: 200px;">QTY</th>
                      				<th style="width: 200px;">UNIT</th>
                      				<!-- <th style="width: 200px;">SERIAL</th> -->
                      				<th style="width: 200px;">ACTION</th>  
                      			</tr>
                      		</thead>
                      	</table>
                      </div>

                      <div class="form-group row" style="height:30px;float: right;margin-top: 20px;">

                      	<div class="col-sm-12"> 
                   
                            <button class="btn btn-primary" id="txtitemprintpack" style="float: right;height: 30px;line-height: 0px;margin-right: 10px;">PRINT</button>&nbsp;&nbsp;&nbsp;

                            <button class="btn btn-primary" id="txtitemupdatepack" style="float: right;height: 30px;line-height: 0px;margin-right: 10px;">UPDATE</button>&nbsp;&nbsp;&nbsp;

                            <button class="btn btn-primary" id="txtitemsavepack" style="float: right;height: 30px;line-height: 0px;margin-right: 10px;">SAVE</button> &nbsp;&nbsp;&nbsp;
                      </div>

                      <!-- <table class="table table-bordered table-striped" id="mtable1" cellspacing="0">
                        <tbody id="mtable2">
                          <iframe style="border: 0px;padding-left: 10px;height: 800px;" width="100%" name="frameplates" id="frameplates" src="" /></iframe>
                        </tbody>
                      </table> -->

                    </div>
                  </div>
                </div>
                <!-- END ITEMS -->


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

	var tblallitems = "";
	var tblitemspack = "";
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
	$(document).ready(function(){

		//$('#tblallitems').wrap('<div class="dataTables_scroll" />');

                      tblallitems = $('#tblallitems').DataTable({
                        processing: true,
                        serverSide: true,
                        paging: true,
                        pagination: true,
                        searching: true,
                        "info": false,
                        //"scrollY": 300,
                        //"scrollCollapse": true, 
                        //"paging": true,


                        order: [ 0, 'desc' ],
                        ajax: 'scripts/all_data.php',

                        "columnDefs": [
                        {
                          "data": null, 
                          "render": function ( data, type, row, meta ) { 
                          //var pays = row[2];
                          return '<button data-cheq_id="'+data+'" onclick="select_item('+row[0]+',\''+row[1]+'\',\''+row[2]+'\',\''+row[3]+'\',\''+row[4]+'\',\''+row[5]+'\',\''+row[6]+'\')" type = "button"  class="btn btn-success btn-xs">Edit</button>&nbsp;<button data-cheq_id="'+data+'" onclick="delete_item('+row[0]+',\''+row[1]+'\',\''+row[2]+'\',\''+row[3]+'\',\''+row[4]+'\',\''+row[5]+'\',\''+row[6]+'\')" type = "button"  class="btn btn-danger btn-xs"><i class="fa fa-trash" style = "line-height:25px;" aria-hidden="true"></i></button>'
                        }, 

                        "targets": [10]
                      },
                      {
                        "targets": [ 0 ],
                        "visible": true,
                        "searchable": true
                      },
                      {
                        "targets": [ 1 ],
                        "visible": true,
                        "searchable": true
                      }

                      /*,
                      { 
                        render: function (data, type, full, meta) {
                          return "<div class='text-wrap'>" + data + "</div>";
                        },
                        targets: 1
                      },
                      { 
                        render: function (data, type, full, meta) {
                          return "<div class='text-wrap'>" + data + "</div>";
                        },
                        targets: 2
                      },
                      { 
                        render: function (data, type, full, meta) {
                          return "<div class='text-wrap'>" + data + "</div>";
                        },
                        targets: 3
                      }*/
                      ],
                      //fixedColumns: true
                    });

                      tblitemspack = $('#tblitemspack').DataTable({
                        processing: true,
                        serverSide: true,
                        paging: false,
                        pagination: false,
                        searching: false,
                        "info": false,
                        fixedHeader: {
                        	header: true,
                        	footer: true
                        },
                        paging: false,
                        scrollCollapse: true,
                        //scrollX: true,
                        scrollY: 300,
                        //"scrollY": 300,
                        //"scrollCollapse": true, 
                        //"paging": true,


                        order: [ 0, 'desc' ],
                        ajax: 'scripts/pack_items_data.php?barcode=',
/*
                        "columns": [
         
            { "data": "item_id" },
            { "data": "descr" },
            { "data": "qty" },
            { "data": "unit" },
            { "data": "serial_no" },
            { "data": "action" }
        ],
*/
                        "columnDefs": [
                        {
                          "data": null, 
                          "render": function ( data, type, row, meta ) { 
                          //var pays = row[2];
                          return '<button data-cheq_id="'+data+'" onclick="select_item('+row[0]+',\''+row[1]+'\',\''+row[2]+'\',\''+row[3]+'\')" type = "button"  class="btn btn-success btn-xs">Edit</button>&nbsp;<button data-cheq_id="'+data+'" onclick="delete_item('+row[0]+',\''+row[1]+'\',\''+row[2]+'\',\''+row[3]+'\')" type = "button"  class="btn btn-danger btn-xs"><i class="fa fa-trash" style = "line-height:25px;" aria-hidden="true"></i></button>'
                        }, 

                        "targets": [4]
                      },
                      {
                        "targets": [ 0 ],
                        "visible": true,
                        "searchable": true
                      },
                      {
                        "targets": [ 1 ],
                        "visible": true,
                        "searchable": true
                      }

                      /*,
                      { 
                        render: function (data, type, full, meta) {
                          return "<div class='text-wrap'>" + data + "</div>";
                        },
                        targets: 1
                      },
                      { 
                        render: function (data, type, full, meta) {
                          return "<div class='text-wrap'>" + data + "</div>";
                        },
                        targets: 2
                      },
                      { 
                        render: function (data, type, full, meta) {
                          return "<div class='text-wrap'>" + data + "</div>";
                        },
                        targets: 3
                      }*/
                      ],
                      //fixedColumns: true
                    });

                      $('#myCollapsible').on('shown.bs.collapse', function () {
   $($.fn.dataTable.tables(true)).DataTable()
      .columns.adjust();
});



    $("#txtitemsave").click(function(){
		//alert("s");
		var barcode = $('#txtbarcode').val();
		var serial_no = $('#txtserial').val();
		var desc = $('#txtitemdesc').val();
		var unit = $('#txtunit').val();
		var qty = $('#txtitemqty').val();
		var category = $('#txtcategory').val();
		var remarks = $('#txtremarks').val();
		var status = $('#txtstatus').val();
		var assignee = $('#txtassignee').val();
		var dateassign = $('#txtdateassign').val();
		
		xajax_insertsingleitem(desc,qty,unit,serial_no,barcode,category,status,remarks,'','','');

	});

	});

	$('#btnsingle').click(function(){
		$('#allitemmodal').modal('show');

	});
	$('#btnpack').click(function(){
		$('#packageitemmodal').modal('show');

		$('#tblitemspack').DataTable().ajax.reload();

	});

	$('#btnadditem').click(function(){
		$('#additemmodal').modal('show');
		$("#additemmodal").css("z-index", "1500");

	});

	$('#txtadditemsave').click(function(){
		var barcodes = $('#txtaddbarcode').val();
		var qty = $('#txtadditemqty').val();
		var unit = $('#txtaddunit').val();
		var category = $('#txtaddunit').val();
		
	});
	

	
</script>
</body>
</html>