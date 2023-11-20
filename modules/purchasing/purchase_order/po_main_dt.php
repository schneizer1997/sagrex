<?php
//session_start();
/*include('../../../classes/inc/dbConInventory.php');*/
include('../../../classes/inc/dbCon.php');
//require('../admin.common.php');
require('po.common.php');
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
  .dataTables_scroll
    {
        position: relative;
        overflow-y: auto;
        overflow-x: none;
        max-height: 400px;/*the maximum height you want to achieve*/
        width: 100%;
    }
  .dataTables_scroll thead{
    position: -webkit-sticky;
    position: sticky;
    top: 0;
    background-color: #fff;
    z-index: 2;
  }

</style>
<body id="page-top">


  <button class="btn btn-info" type="button" class="btn btn-info" id="btnnewpo" style="float:right;"><i style ="padding-right:5px;" class="fa fa-plus-square"></i>Create New</button>


  <div style="border:0px solid red;height: 50px;" width = "100%"></div>
  <div class="card mb-3">
    <div class="card-header" style="background-color: #3399CC;color: white;">
      <i class="fas fa-table"></i>
    Items Table</div>

    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover" id="tblpo" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>ID</th>
              <th>PO NO</th>
              <th>NAME</th>
              <th>ADDRESS</th>
              <th width="20%">DATE</th>
              <th>TERMS</th>
              <th>REQBY</th>
              <th>PREPBY</th>
              <th>NOTEBY</th>
              <th>APPROVBY</th>
              <th>PURPOSE</th>
              <th>NOTE</th>
              <th>ACTION</th>
            </tr>
          </thead>
          <!-- <tfoot>
            <tr>
              <th>ID</th>
              <th>PO NO</th>
              <th>NAME</th>
              <th>ADDRESS</th>
              <th width="20%">DATE</th>
              <th>TERMS</th>
              <th>REQBY</th>
              <th>PREPBY</th>
              <th>NOTEBY</th>
              <th>APPROVBY</th>
              <th>PURPOSE</th>
              <th>ACTION</th>
            </tr>
          </tfoot> -->
        </table>
      </div>
    </div>
    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
  </div> 


  <!-- New Purchase item -->
  <!-- Edit Request Material -->
  <div class="modal fade bd-example-modal-lg" id="pomodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" style="width: 650px;min-height:400px;position: center;">
        <div class="modal-header" style="background-color: #17A2B8;color:white;">
          <h5 class="modal-title" id="formModalLabel">New PO</h5>
          <button type="button" style="border:0px;color: white;background-color: orange;" class="btn btn-secondary" data-dismiss="modal" id="btnformpoclose"><i class="fa fa-close"></i>
          </button>
        </div>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <div style="margin-left: 10px;margin-top: 1px solid black;margin-bottom: 1px solid black;">PO Info</div>

          <div style="float: left;border: 1px;" id="divholder">
            <!-- <form action="" method="GET" enctype="multipart/form-data"> -->
              <div style="border: 1px;min-height: 100px;min-width:300px;line-height: 50px;margin: 10px;">
                <div id="leftmat" style="border: 1px;min-width: 600px;float: left;">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label" id="" style="height: 30px;">PO #:</label>
                    <div class="col-sm-8">                        
                      <input type="text" class="form-control" name="" id="txtpono" placeholder="" style="height: 30px;">

                      <!-- <input type="hidden" class="form-control" id="mwrfidmaterialhidden" placeholder="" style="height: 30px;"> -->
                    </div>
                    
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label" id="" style="height: 30px;">Supplier Name:</label>
                    <div class="col-sm-8">
                      <textarea type="text" class="form-control" id="txtsuppname" placeholder="" style="height: 30px;"></textarea>
                      </div>
                   
                      <!-- <input type="hidden" class="form-control" id="txtassignid" placeholder="" style="height: 30px;"> -->
                    
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label" id="" style="height: 30px;">Address:</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="txtaddr" placeholder="" style="height: 30px;" >
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label" id="" style="height: 30px;">Date</label>
                    <div class="col-sm-8">
                      <input type="date" class="form-control" id="txtpodate" placeholder="" style="height: 30px;" >
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label" id="" style="height: 30px;">Terms:</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="txtterms" placeholder="" style="height: 30px;" >
                    </div>
                  </div>
                   <div class="form-group row">
                    <label class="col-sm-3 col-form-label" id="" style="height: 30px;">Purpose:</label>
                    <div class="col-sm-8">
                    <textarea type="text" class="form-control" id="txtpurpose" placeholder="" style="height: 30px;"></textarea>
                      </div>
                    </div>
                  </div>
                   <div class="form-group row">
                    <label class="col-sm-3 col-form-label" id="" style="height: 30px;margin-left: 5px;">Requested By:</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="txtreqby" placeholder="" style="height: 30px;" >
                    </div>
                  </div>
                   <div class="form-group row">
                    <label class="col-sm-3 col-form-label" id="" style="height: 30px;margin-left: 5px;">Prepared By:</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="txtprepby" placeholder="" style="height: 30px;" >
                    </div>
                  </div>
                   <div class="form-group row">
                    <label class="col-sm-3 col-form-label" id="" style="height: 30px;margin-left: 5px;">Note By:</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="txtnoteby" placeholder="" style="height: 30px;" >
                    </div>
                  </div>
                   <div class="form-group row">
                    <label class="col-sm-3 col-form-label" id="" style="height: 30px;margin-left: 5px;">Approved By:</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="txtapprovby" placeholder="" style="height: 30px;" >
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label" id="" style="height: 30px;margin-left: 5px;">Note:</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="txtnote" placeholder="" style="height: 30px;" >
                    </div>
                  </div>
                 
                  <!-- </form> -->
                  <div class="modal-footer" style="border: 1px;">
                    <button type="button" class="btn btn-info" id="btnsaveaspo">
                      <i style="padding-right: 5px;" class="fas fa-save"></i>SAVE AS NEW</button> 
                      <button type="button" class="btn btn-info" id="btnupdatepo">
                        <i style="padding-right: 5px;" class="fas fa-save"></i>UPDATE</button>    
                      <button type="button" class="btn btn-info" id="btnsavepo">
                        <i style="padding-right: 5px;" class="fas fa-save"></i>SAVE</button>
                        <!-- <button type="button" class="btn btn-info" id="btnprintpo">
                          <i style="padding-right: 5px;" class="fas fa-save"></i>PRINT</button> -->
                        </div>
                </div>


              </div>

             
                  </div>


                </table>

              </div>
            </div>
          </div>
          <!-- end -->
          <!-- START -->

         <!-- ITEMS -->
                <div class="modal fade bd-example-modal-lg" id="poitemmodal" tabindex="1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document" style="width: auto;">
                    <div class="modal-content" style="">
                      <div class="modal-header" style="">
                        <h5 class="modal-title" id="formModalLabel"><strong>Item's List</strong></h5>
                        <button class="btn btn-secondary" id="btnformitemclose" style="border:0px;color: white;background-color: orange;"><i class="fa fa-close"></i></button>
                        
                      </div>

                      <div class="form-group" style="border-bottom:1px solid black;margin-bottom: -20px;">

                        <hr class="my-2" />

                        <div class="form-group row" style="height:30px;">
                          <label  id="" style="height: 30px;margin-left: 30px;margin-right: 10px;font-size: 12px;">PO No:</label>&nbsp;&nbsp;
                          <div class="col-sm-4">                        
                            <input type="text" class="form-control" name="" id="txtitempo" placeholder="" style="height: 50px;border: 1px solid black;color: black;height: 30px;" disabled>
                          </div>
                          <label  id="" style="height: 30px;margin-left: 30px;margin-right: 20px;font-size: 12px;">Unit:</label>&nbsp;&nbsp;
                          <div class="col-sm-4">                        
                            <input tabindex="3" type="text" class="form-control" name="" id="txtitemunit" placeholder="" style="height: 50px;border: 1px solid black;color: black;height: 30px;">
                          </div>
                         
                          
                          
                          
                        </div>
                        <div class="form-group row" style="height:30px;">
                          <label  id="" style="height: 30px;margin-right: -18px;margin-left: 30px;font-size: 12px;">Description:</label>&nbsp;&nbsp;
                          <div class="col-sm-4">                        
                            <input tabindex="1" type="text" class="form-control" name="" id="txtitemdesc"  placeholder="" style="height: 50px;border: 1px solid black;color: black;height: 30px;">
                          </div>

                          <label  id="" style="height: 30px;margin-left: 30px;margin-right: 25px;font-size: 12px;">UP:</label>&nbsp;&nbsp;
                          <div class="col-sm-4">                        
                            <input tabindex="4" type="number" onchange="setTwoNumberDecimal" min="0" max="10" step="0.25" class="form-control" name="" id="txtitemup" placeholder="" style="height: 50px;border: 1px solid black;color: black;height: 30px;">
                          </div>
                            
                          </div>
                          
                          

                         
                        <div class="form-group row" style="height:30px;">
                          <label id="" style="height: 30px;margin-left: 30px;margin-right: 25px;font-size: 12px;">Qty:</label>&nbsp;&nbsp;
                          <!-- <div class="col-sm-4">
                            <input type="number" tabindex="2" class="form-control" oninput="this.value = this.value.replace(/[^1-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" name="" id="txtitemqty" placeholder="" style="height: 50px;border: 1px solid black;color: black;height: 30px;">
                          </div> -->

                          <div class="col-sm-4">
                            <input type="number" tabindex="2" class="form-control" name="" id="txtitemqty" placeholder="" style="height: 50px;border: 1px solid black;color: black;height: 30px;">
                          </div>


                           

                          <label id="" style="height: 30px;margin-left: 25px;font-size: 12px;">Amount:</label> &nbsp;&nbsp;
                          <div class="col-sm-4">                        
                            <input type="text" class="form-control" name="" id="txtitemamount" placeholder="" style="height: 50px;border: 1px solid black;color: black;height: 30px;" disabled>
                        </div>


                    


                        </div>
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

                      <div class="table-responsive">
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
                     <!-- <tfoot>
                      <tr>
                        <th>ID</th>

                        <th width="20%">PO NO</th>

                        <th>QTY</th>
                        <th width="20%">UNIT</th>
                        <th width="20%">DESCRIPTION</th>
                        <th width="20%">UP</th>
                        <th width="20%">AMOUNT</th>
                        <th>ACTION</th>

                      </tr>
                    </tfoot> -->
                 </table>
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

          <!-- END -->



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
                  <script src="../../../vendor/bootstrap/js/jquery.num2words.js" type="text/javascript"></script>
                 <!--  <script src="../../../vendor/bootstrap/js/bootstrap-select.js" type="text/javascript"></script> -->

                  <script type="text/javascript">
                    //$('.selectpicker').selectpicker();

                    var tablepo = "";
                    var tblpoitems = "";
                    var check = "";


                    $(document).ready(function(){
                      /* $('.selectpicker').selectpicker();
                      $('#example').hierarchySelect({
                        hierarchy: true,
                        width: 'auto'
                      });*/


                      $('#tblpo tfoot th').each( function (i) {
                        var title = $(this).text();
                        $(this).html( '<input id="searchcolumn'+i+'" type="text" size=10 placeholder="Search'+title+'" data-index="'+i+'" />' );
                      } );

                     
                      tablepo = $('#tblpo').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "ajax": "scripts/po_data.php",
                        "scrollX": true,

                        order: [ 0, 'desc' ],
                        responsive: true,
                        pageLength : 15,

                        "columns": [ 
                        {"dt": "id"},        
                        {'dt': 'po_no'},
                        {'dt': 'po_name'},
                        {'dt': 'po_addr'},
                        {'dt': 'po_date'},
                        {'dt': 'po_terms'},
                        {'dt': 'reqby'},
                        {'dt': 'prepby'},
                        {'dt': 'noteby'},
                        {'dt': 'approveby'},
                        {'dt': 'purpose'},
                        {'dt': 'note'}



                        ],
                        "columnDefs": [
                        {
                          "data": null, 
                          "render": function ( data, type, row, meta ) { 
                          var pays = row[2];

                           function escapeHtml(str)
                      {
                        var map =
                        {
                          '&': '&amp;',
                          '<': '&lt;',
                          '>': '&gt;',
                          '"': '&quot;',
                          "'": '&#039;'
                        };
                        return str.replace(/[&<>"']/g, function(m) {return map[m];});
                      }
                            var response = pays.replace(/\'/g,'&apos;');
                          return '<button data-po_id="'+data+'" onclick="po_items('+row[0]+',\''+row[1]+'\',\''+row[2]+'\')" type = "button"  class="btn btn-success btn-xs">Add Item</button>&nbsp;<button data-po_id="'+data+'" onclick="po_edit('+row[0]+',\''+row[1]+'\',\''+escapeHtml(row[2])+'\',\''+row[3]+'\',\''+row[4]+'\',\''+row[5]+'\',\''+row[6]+'\',\''+row[7]+'\',\''+row[8]+'\',\''+row[9]+'\',\''+row[10]+'\',\''+row[11]+'\')" type = "button"  class="btn btn-success btn-xs">Edit</button>&nbsp;<button data-po_id="'+data+'" onclick="po_print('+row[0]+',\''+row[1]+'\',\''+row[2]+'\',\''+row[3]+'\',\''+row[4]+'\',\''+row[5]+'\')" type = "button"  class="btn btn-success btn-xs">Print</button>&nbsp;<button data-cheq_id="'+data+'" onclick="delete_po('+row[0]+',\''+row[1]+'\',\''+row[2]+'\')" type = "button"  class="btn btn-danger btn-xs"><i class="fa fa-trash" style = "line-height:25px;" aria-hidden="true"></i></button>'
                        }, 
                        
                        "targets": [12]
                      },
                      {
                        "targets": [ 1,2 ],
                        "visible": true,
                        "searchable": true
                      },
                      {
                        "targets": [6],
                        "visible": false,
                        "searchable": false
                      },
                      {
                        "targets": [7],
                        "visible": false,
                        "searchable": false
                      },
                      {
                        "targets": [8],
                        "visible": false,
                        "searchable": false
                      },
                      {
                        "targets": [9],
                        "visible": false,
                        "searchable": false
                      },
                      {
                        "targets": [10],
                        "visible": false,
                        "searchable": false
                      },
                       {
                        "targets": [11],
                        "visible": false,
                        "searchable": false
                      }
                      ],

                     /* drawCallback: function () {
                        var api = this.api();
                        $( api.column(3).footer() ).html(
                          api.column( 3, {page:'current'} ).data().sum()
                          );

                      },
                      initComplete: function () {
                        this.api().columns().every( function () {
                          var that = this;

                          $( 'input', this.footer() ).on( 'keyup change clear', function () {
                            if ( that.search() !== this.value ) {
                              check = this.value;
                              that
                              .search( this.value )
                              .draw();
                            }
                          } );
                        } );
                      }*/

                    });
                       $('#tblpoitems').wrap('<div class="dataTables_scroll" />');

                      tblpoitems = $('#tblpoitems').DataTable({
                        processing: true,
                        serverSide: true,
                        paging: false,
                        pagination: false,
                        searching: false,
                        "info": false,
                        //"scrollY": 300,
                        //"scrollCollapse": true, 
                        //"paging": true,


                        order: [ 0, 'desc' ],
                        ajax: 'scripts/po_items_data.php?pono=',

                        "columnDefs": [
                        {
                          "data": null, 
                          "render": function ( data, type, row, meta ) { 
                          //var pays = row[2];
                          return '<button data-cheq_id="'+data+'" onclick="select_item('+row[0]+',\''+row[1]+'\',\''+row[2]+'\',\''+row[3]+'\',\''+row[4]+'\',\''+row[5]+'\',\''+row[6]+'\')" type = "button"  class="btn btn-success btn-xs">Edit</button>&nbsp;<button data-cheq_id="'+data+'" onclick="delete_item('+row[0]+',\''+row[1]+'\',\''+row[2]+'\',\''+row[3]+'\',\''+row[4]+'\',\''+row[5]+'\',\''+row[6]+'\')" type = "button"  class="btn btn-danger btn-xs"><i class="fa fa-trash" style = "line-height:25px;" aria-hidden="true"></i></button>'
                        }, 

                        "targets": [7]
                      },
                      {
                        "targets": [ 0 ],
                        "visible": true,
                        "searchable": true
                      },
                      {
                        "targets": [ 1 ],
                        "visible": false,
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
                      tblpoitems.columns.adjust().draw();




                    });
/*var tblpoitems = $('#tblpoitems').DataTable();
                    $(window).resize( function () {
        tblpoitems.columns.adjust();
    } );*/
                    var po_id = "";
                    function po_edit(poid,po_no,po_name,po_addr,po_date,po_terms,reqby,prepby,noteby,approveby,purpose,note) {

                    po_id = poid;
                    alert(po_name);
                    var pono = $('#txtpono').val(po_no);
                    var name = $('#txtsuppname').val(po_name);
                    var addr = $('#txtaddr').val(po_addr);
                    var terms = $('#txtterms').val(po_terms);
                    var dates = $('#txtpodate').val(po_date);
                    var purpose = $('#txtpurpose').val(purpose);
                    var reqby = $('#txtreqby').val(reqby);
                    var prepby = $('#txtprepby').val(prepby);
                    var noteby = $('#txtnoteby').val(noteby);
                    var approveby = $('#txtapprovby').val(approveby);
                     var note = $('#txtnote').val(note);

                   /* $('#txtcheckno').val(check_no);
                    $('#txtpayto').val(payto);
                    $('#txtamount').val(amount);
                    $('#txtwords').val(amwords);
                    $('#txtdate').val(transdate);
                    cheq_id = check_id;
                    $('#pomodal').modal('show');
                    $("#btnupdatecheck").show();
                    $("#btnsaveascheck").show();
                    $("#btnsavecheck").hide();*/

                      //alert(transdate);
                    $("#btnsaveaspo").show();
                    $("#btnsavepo").hide();
                    $("#pomodal").modal('show');
                    $("#btnupdatepo").show();

                    }
                    function setTwoNumberDecimal(event) {
                      this.value = parseFloat(this.value).toFixed(2);
                    }
                    function delete_po(id,pono){
                       Swal.fire({
                        title: 'Are you sure you want to delete?',
                        text: "You won't be able to revert this!",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes'
                      }).then((result) => {
                        if (result.value) {
                          $.ajax({
                            url: xajax_updatepostatus(id),
                            complete: function(data)
                            {

                              Swal.fire({
                                type: 'success',
                                title: '',
                                text: 'Deleted!'
                              }).then(function() {
                                refreshtable();
                              });

                            }
                          });
                        }
                      })

                    }

                    var itempoid = "";
                    function po_items(id,pono){
                      //alert(pono);
                      itempoid = id;
                      $("#poitemmodal").modal('show');
                      $('#txtitempo').val(pono);
                      //var ponos = "pono" + pono;

                      history.replaceState("","","?pono=" + pono);
                      tblpoitems.ajax.url('scripts/po_items_data.php?pono=' + pono).load();
                      refreshtable();
                       //tblpoitems.columns.adjust().draw();
                      /*$.ajax({  
                        type: 'GET',
                        url: 'scripts/po_items_data.php= pono ' + pono, 
                        //data: {po:pono},
                        success: function(response) {
                          //alert(data[1]);
                          //content.html(response);
                        }
                      });*/

                    }
                    function po_print(id,pono){
                      //alert(pono);
                      window.open("../../../reports/purchase_order.php?pono= " + pono, "_blank");

                    }

                    $('#txtitemprint').click(function(){
                      var itempono = $('#txtitempo').val();
                      window.open("../../../reports/purchase_order.php?pono= " + itempono, "_blank");


                    });

                    
                    var itemid = "";
                    function select_item(id,ponoitem,qty,unit,desc,up,amount){
                      itemid = id;
                      //alert(id);
                      $('#txtitemdesc').val(desc);
                      $('#txtitemqty').val(qty);
                      $('#txtitemup').val(up);
                      $('#txtitemunit').val(unit);
                      $('#txtitemamount').val(amount);
                     //$('#txtitempo').val();

                    }
                    function delete_item(id,ponoitem,qty,unit,desc,up,amount){
                      itemid = id;


                      Swal.fire({
                        title: 'Are you sure you want to delete?',
                        text: "You won't be able to revert this!",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes'
                      }).then((result) => {
                        if (result.value) {
                          $.ajax({
                            url: xajax_updatepoitemstatus(itemid),
                            complete: function(data)
                            {

                              Swal.fire({
                                type: 'success',
                                title: '',
                                text: 'Deleted!'
                              }).then(function() {
                                refreshtable();
                              });

                            }
                          });
                        }
                      })
                      //alert(id);
                      /*$('#txtitemdesc').val(desc);
                      $('#txtitemqty').val(qty);
                      $('#txtitemup').val(up);
                      $('#txtitemunit').val(unit);
                      $('#txtitemamount').val(amount);*/
                     //$('#txtitempo').val();

                    }
                
                    function escapeHtml(str)
                    {
                      var map =
                      {
                        '&': '&amp;',
                        '<': '&lt;',
                        '>': '&gt;',
                        '"': '&quot;',
                        "'": '&#039;'
                      };
                      return str.replace(/[&<>"']/g, function(m) {return map[m];});
                    }

                    $('#btnnewpo').click(function(){
                      var samples = "Eng'g";

                      alert(escapeHtml(samples));
                    $('#txtcheckno').val("");
                    $('#txtpayto').val("");
                    $('#txtamount').val("");
                    $('#txtwords').val("");
                    $('#txtdate').val("");


                    $("#btnsaveaspo").hide();
                    $("#btnsavepo").show();
                    $("#btnupdatepo").hide();

                      $('#pomodal').modal('show');
                      refreshtable();
                    });
                    function refreshtable(){
                      $('#tblpo').DataTable().ajax.reload();
                      $('#tblpoitems').DataTable().ajax.reload();
                    }
                    $('#btnformitemclose').click(function(){
                      $('#poitemmodal').modal('hide');

                    });
                  

                    $('#btnsaveaspo').click(function(){
                      var pono = $('#txtpono').val();
                      var name = $('#txtsuppname').val();
                      var addr = $('#txtaddr').val();
                      var terms = $('#txtterms').val();
                      var dates = $('#txtpodate').val();
                      var purpose = $('#txtpurpose').val();
                      var reqby = $('#txtreqby').val();
                      var prepby = $('#txtprepby').val();
                      var noteby = $('#txtnoteby').val();
                      var approveby = $('#txtapprovby').val();
                      var notes = $('#txtnote').val();

                      


                      if (pono == ""){
                        Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'PO No is Empty!.'
                      })

                      }
                      else {


                      $.ajax({
                            url: xajax_insertpo(pono,name,addr,dates,terms,purpose,reqby,prepby,noteby,approveby,purpose,notes),
                            complete: function(data)
                            {
                              //alert(xajax_deletepayto(id));
                              Swal.fire({
                                type: 'success',
                                title: '',
                                text: 'Save!.'
                              }).then(function() {
                                refreshtable();
                        //$( '#framepay' ).attr( 'src', function ( i, val ) { return val; });
                        //history.go(0);
                      });
                              //$( '#framepay' ).attr( 'src', function ( i, val ) { return val; });

                            }
                          });
                        

                      }

                    });

                    $('#btnupdatepo').click(function(){
                      var pono = $('#txtpono').val();
                      var name = $('#txtsuppname').val();
                      var addr = $('#txtaddr').val();
                      var terms = $('#txtterms').val();
                      var dates = $('#txtpodate').val();
                      var purpose = $('#txtpurpose').val();
                      var reqby = $('#txtreqby').val();
                      var prepby = $('#txtprepby').val();
                      var noteby = $('#txtnoteby').val();
                      var approveby = $('#txtapprovby').val();
                      var notes = $('#txtnote').val();

                      
                      if (pono == ""){
                        Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'PO No is Empty!.'
                      })

                      }
                      else {

                        $.ajax({
                          url: xajax_updatepo(po_id,pono,name,addr,dates,terms,purpose,reqby,prepby,noteby,approveby,purpose,notes),
                          complete: function(data)
                          {

                            Swal.fire({
                              type: 'success',
                              title: '',
                              text: 'UPDATED!.'
                            }).then(function() {
                              refreshtable();
                            });
                          }
                        });
                        

                      }

                    });

                    $('#btnsavepo').click(function(){
                      var pono = $('#txtpono').val();
                      var name = $('#txtsuppname').val();
                      var addr = $('#txtaddr').val();
                      var terms = $('#txtterms').val();
                      var dates = $('#txtpodate').val();
                      var purpose = $('#txtpurpose').val();
                      var reqby = $('#txtreqby').val();
                      var prepby = $('#txtprepby').val();
                      var noteby = $('#txtnoteby').val();
                      var approveby = $('#txtapprovby').val();
                      var notes = $('#txtnote').val();

                      


                      if (pono == ""){
                        Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'PO No is Empty!.'
                      })

                      }
                      else {


                      $.ajax({
                            url: xajax_insertpo(pono,name,addr,dates,terms,purpose,reqby,prepby,noteby,approveby,purpose,notes),
                            complete: function(data)
                            {
                              //alert(xajax_deletepayto(id));
                              Swal.fire({
                                type: 'success',
                                title: '',
                                text: 'Save!.'
                              }).then(function() {
                                refreshtable();
                        //$( '#framepay' ).attr( 'src', function ( i, val ) { return val; });
                        //history.go(0);
                      });
                              //$( '#framepay' ).attr( 'src', function ( i, val ) { return val; });

                            }
                          });
                        

                      }

                    });

                    $('#txtitemsave').click(function(){
                      var itemdesc = $('#txtitemdesc').val();
                      var itemqty = $('#txtitemqty').val();
                      var itemup = $('#txtitemup').val();
                      var itemunit = $('#txtitemunit').val();
                      var itemamount = $('#txtitemamount').val();
                      var itemponos = $('#txtitempo').val();
                      //xajax_insertpoitem(itemponos,itemdesc,itemqty,itemup,itemunit,itemamount);
                      $.ajax({
                            url: xajax_insertpoitem(itempoid,itemponos,itemdesc,itemqty,itemup,itemunit,itemamount),
                            complete: function(data)
                            {
                              //alert(xajax_deletepayto(id));
                              Swal.fire({
                                type: 'success',
                                title: '',
                                text: 'Save!.'
                              }).then(function() {
                                refreshtable();
               
                      });
                             

                            }
                          });



                    });

                    $('#txtitemupdate').click(function(){
                      var itemdesc = $('#txtitemdesc').val();
                      var itemqty = $('#txtitemqty').val();
                      var itemup = $('#txtitemup').val();
                      var itemunit = $('#txtitemunit').val();
                      var itemamount = $('#txtitemamount').val();
                      var itemponos = $('#txtitempo').val();
                      //xajax_insertpoitem(itemponos,itemdesc,itemqty,itemup,itemunit,itemamount);
                      $.ajax({
                            url: xajax_updatepoitem(itemid,itemponos,itemdesc,itemqty,itemup,itemunit,itemamount),
                            complete: function(data)
                            {
                              //alert(xajax_deletepayto(id));
                              Swal.fire({
                                type: 'success',
                                title: '',
                                text: 'Updated!.'
                              }).then(function() {
                                refreshtable();
               
                      });
                             

                            }
                          });



                    });
                    $( "#txtitemqty" ).keyup(function() {
                     var itemqty = $('#txtitemqty').val();
                     var itemup = $('#txtitemup').val();

                     var totalamount = itemqty * itemup;
                     //alert(totalamount);

                     $('#txtitemamount').val(totalamount);

                    });
                    $( "#txtitemup" ).keyup(function() {
                     var itemqty = $('#txtitemqty').val();
                     var itemup = $('#txtitemup').val();

                     var totalamount = itemqty * itemup;
                     $('#txtitemamount').val(totalamount);
                     //alert(totalamount);

                    });

      


                  </script>
                </body>
                </html>