<?php
//session_start();
/*include('../../../classes/inc/dbConInventory.php');*/
include('../../../classes/inc/dbCon.php');
//require('../admin.common.php');
require('cheque.common.php');
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
<!--     <p>
    <span id="date-label-from" class="date-label">From: </span><input class="date_range_filter date" type="text" id="datepicker_from" />
    <span id="date-label-to" class="date-label">To:&nbsp;&nbsp;</span><input class="date_range_filter date" type="text" id="datepicker_to" />
    <button id="btnprintreport" class="btn btn-info"><i style ="padding-right:5px;" class="fas fa-print"></i>PRINT</button>
  <select id="cboreporttype">
    <option>ALL</option>
    <option>SPECIFIC pay</option>
  </select>
  <button class="btn btn-secondary" type="button" class="btn btn-info" id="btnpurchitemreport">Generate Report</button> -->

<!-- <div id="demo" class="container"><h1>jQuery num2words Converter Example</h1><h3> Enter amount: </h3>
  <input id="num" type="text" class="form-control" placeholder="$"><br>
<br>

  <input id="trans" type="button" value="Convert to words" class="btn btn-danger"><br>
<br>

  <div class="well"></div>
</div> -->

  <button class="btn btn-info" type="button" class="btn btn-info" id="btnnewcheck" style="float:right;"><i style ="padding-right:5px;" class="fa fa-plus-square"></i>Create New</button>

  <div style="border:0px solid red;height: 50px;" width = "100%"></div>
  <div class="card mb-3">
    <div class="card-header" style="background-color: #3399CC;color: white;">
      <i class="fas fa-table"></i>
    Items Table</div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover" id="tblcheque" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>ID</th>
              <th>CHECK NO</th>
              <th>PAY TO</th>
              <th>AMOUNT</th>
              <th width="20%">AMOUNT IN WORDS</th>
              <th>TRANS DATE</th>
              <th>ACTION</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>ID</th>
              <th>CHECK NO</th>
              <th>PAY TO</th>
              <th>AMOUNT</th>
              <th>AMOUNT IN WORDS</th>
              <th>TRANS DATE</th>
              <th>ACTION</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
  </div> 
  <!-- New Purchase item -->
  <!-- Edit Request Material -->
  <div class="modal fade bd-example-modal-lg" id="checkmodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" style="width: 650px;min-height:400px;position: center;">
        <div class="modal-header" style="background-color: #17A2B8;color:white;">
          <h5 class="modal-title" id="formModalLabel">New Check</h5>
          <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnFormClose"><i class="fa fa-close"></i>
          </button>
        </div>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <div style="margin-left: 10px;">Check Info</div>

          <div style="float: left;border: 1px;" id="divholder">
            <!-- <form action="" method="GET" enctype="multipart/form-data"> -->
              <div style="border: 1px;min-height: 100px;min-width:300px;line-height: 50px;margin: 10px;">
                <div id="leftmat" style="border: 1px;min-width: 600px;float: left;">
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Check #:</label>
                    <div class="col-sm-10">                        
                      <input type="text" class="form-control" name="" id="txtcheckno" placeholder="" style="height: 30px;">

                      <!-- <input type="hidden" class="form-control" id="mwrfidmaterialhidden" placeholder="" style="height: 30px;"> -->
                    </div>
                    
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Pay To:</label>
                    <div class="col-sm-8">
                      <textarea type="text" class="form-control" id="txtpayto" placeholder="" style="height: 30px;"></textarea>
                      </div>
                      <div class="col-sm-2">
                      <button class="btn btn-primary" id="btnpaytomodal"><i class = "fa fa-plus-circle"></i></button>
                      <!-- <input type="hidden" class="form-control" id="mwrfidmaterialhidden" placeholder="" style="height: 30px;"> -->
                    </div>
                      <input type="hidden" class="form-control" id="txtassignid" placeholder="" style="height: 30px;">
                    
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Amount:</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="txtamount" placeholder="" style="height: 30px;" >
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label" id="" style="height: 30px;">In Words:</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="txtwords" placeholder="" style="height: 30px;" >
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label" id="" style="height: 30px;">Date:</label>
                    <div class="col-sm-10">
                      <input type="date" class="form-control" id="txtdate" placeholder="" style="height: 30px;" >
                    </div>
                  </div>
                  <!-- </form> -->
                  <div class="modal-footer" style="border: 1px;">
                    <button type="button" class="btn btn-info" id="btnsaveascheck">
                      <i style="padding-right: 5px;" class="fas fa-save"></i>SAVE AS NEW</button> 
                      <button type="button" class="btn btn-info" id="btnupdatecheck">
                        <i style="padding-right: 5px;" class="fas fa-save"></i>UPDATE</button>    
                      <button type="button" class="btn btn-info" id="btnsavecheck">
                        <i style="padding-right: 5px;" class="fas fa-save"></i>SAVE</button>
                        <button type="button" class="btn btn-info" id="btnprintcheck">
                          <i style="padding-right: 5px;" class="fas fa-save"></i>PRINT</button>
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

          <div class="modal fade bd-example-modal-lg" id="selectpaytomodal" tabindex="1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document" style="width: auto;">
              <div class="modal-content" style="width: 1400px;height: 800px;">
                <div class="modal-header" style="background-color: #17A2B8;color:white;">
                  <h5 class="modal-title" id="formModalLabel"><strong>Select To Pay</strong></h5>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnFormClose" style="border:0px;color: white;"><i class="fa fa-close"></i></button>
                </div>

                <div class="form-group row" style="border-bottom:1px solid grey;padding-bottom: 10px;">
                  <label class="col-sm-1 col-form-label" style = "margin-left:20px;">Name: </label>
                  <!-- <input type="text" class="form-control" id="txtamount" placeholder="" style="height: 30px;"> -->
                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="txtpaynosnew" placeholder="" style="height: 50px;">
                  </div>
                  <!-- <button type="button" class="btn btn-success" id="btnnewpay">CREATE</button>&nbsp; -->
                  <button type="button" class="btn btn-success" id="btnsavepay">SAVE</button>&nbsp;
                  <!-- <button type="button" class="btn btn-success" id="btnupdatepay" disabled>UPDATE</button> -->
                </div>

                <table class="table table-bordered table-striped" id="mtable1" cellspacing="0">
                  <tbody id="mtable2">
                  
                    <iframe style="border: 0px;padding-left: 10px;height: 800px;" width="100%" name="framepay" id="framepay" src="iframe/payto_dt.php?mwrfid=" /></iframe>
                  </tbody>
                </table>

              </div>
            </div>
          </div>

          <div class="modal fade bd-example-modal-lg" id="vamreport" tabindex="1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document" style="width: auto;">
              <div class="modal-content" style="width: 1400px;height: 800px;">
                <div class="modal-header" style="background-color: #17A2B8;color:white;">
                  <h5 class="modal-title" id="formModalLabel"><strong>Select To Pay</strong></h5>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnFormClose" style="border:0px;color: white;"><i class="fa fa-close"></i></button>
                </div>

                <div class="form-group row" style="border-bottom:1px solid black;">
                  <label class="col-sm-1col-form-label" style = "margin-left:20px;">Name: </label>
                  <!-- <input type="text" class="form-control" id="txtamount" placeholder="" style="height: 30px;"> -->
                  <div class="col-sm-3">
                    <input type="text" class="form-control" id="txtpaynosnew" placeholder="" style="height: 50px;" disabled>
                  </div>
                  <button type="button" class="btn btn-success" id="btnnewpay">CREATE</button>&nbsp;
                  <button type="button" class="btn btn-success" id="btnsavepay">SAVE</button>&nbsp;
                  <button type="button" class="btn btn-success" id="btnupdatepay" disabled>UPDATE</button>
                </div>

                <table class="table table-bordered table-striped" id="mtable1" cellspacing="0">
                  <tbody id="mtable2">
                    <iframe style="border: 0px;padding-left: 10px;height: 800px;" width="100%" name="framepays" id="framepays" src="iframes/pay_view.php?mwrfid=" /></iframe>
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
                  <script src="../../../vendor/bootstrap/js/jquery.num2words.js" type="text/javascript"></script>
                 <!--  <script src="../../../vendor/bootstrap/js/bootstrap-select.js" type="text/javascript"></script> -->

                  <script type="text/javascript">
                    //$('.selectpicker').selectpicker();

                    var table = "";
                    var check = "";



                    $(document).ready(function(){
                      /* $('.selectpicker').selectpicker();
                      $('#example').hierarchySelect({
                        hierarchy: true,
                        width: 'auto'
                      });*/


                      $('#tblcheque tfoot th').each( function (i) {
                        var title = $(this).text();
                        $(this).html( '<input id="searchcolumn'+i+'" type="text" size=10 placeholder="Search'+title+'" data-index="'+i+'" />' );
                      } );
                      table = $('#tblcheque').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "ajax": "scripts/cheque_data.php",
                        "scrollX": true,
                        order: [ 0, 'desc' ],
                        responsive: true,
                        pageLength : 15,

                        "columns": [ 
                        {"dt": "cheq_id"},        
                        {'dt': 'cheq_no'},
                        {'dt': 'pay_to'},
                        {'dt': 'amount'},
                        {'dt': 'amount_words'},
                        {'dt': 'trans_date'}



                        ],
                        "columnDefs": [
                        {
                          "data": null, 
                          "render": function ( data, type, row, meta ) { 
                          //var pays = row[2];
                          return '<button data-cheq_id="'+data+'" onclick="cheq_edit('+row[0]+',\''+row[1]+'\',\''+row[2]+'\','+row[3]+',\''+row[4]+'\',\''+row[5]+'\')" type = "button"  class="btn btn-success btn-xs">Edit</button>&nbsp;<button data-cheq_id="'+data+'" onclick="cheq_print('+row[0]+',\''+row[1]+'\',\''+row[2]+'\','+row[3]+',\''+row[4]+'\',\''+row[5]+'\')" type = "button"  class="btn btn-success btn-xs">Print</button>'
                        }, 
                        
                        "targets": [6]
                      },
                      {
                        "targets": [ 1,2 ],
                        "visible": true,
                        "searchable": true
                      }
                      ],

                      drawCallback: function () {
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
                      }

                    });
                    });
                    
                    var cheq_id = "";
                    function cheq_edit(check_id,check_no,payto,amount,amwords,transdate) {
                    $('#txtcheckno').val(check_no);
                    $('#txtpayto').val(payto);
                    $('#txtamount').val(amount);
                    $('#txtwords').val(amwords);
                    $('#txtdate').val(transdate);
                    cheq_id = check_id;
                    $('#checkmodal').modal('show');
                    $("#btnupdatecheck").show();
                    $("#btnsaveascheck").show();
                    $("#btnsavecheck").hide();

                      //alert(transdate);

                    }
                    function cheq_print(check_id,check_no,payto,amount,amwords,transdate){
                      window.open("../../../reports/check_print.php?id= " + check_id, "_blank");
                      //alert(check_id);
                    }
                    $('#btnnewcheck').click(function(){
                    $('#txtcheckno').val("");
                    $('#txtpayto').val("");
                    $('#txtamount').val("");
                    $('#txtwords').val("");
                    $('#txtdate').val("");
                    $("#btnsaveascheck").hide();
                    $("#btnupdatecheck").hide();
                      $('#checkmodal').modal('show');
                      refreshtable();
                    });
                    function refreshtable(){
                      $('#tblcheque').DataTable().ajax.reload();
                    }
                    function selectpay(id,name){
                      $('#txtpayto').val(name);
                      //plate_id = id;
                      $('#selectpaytomodal').modal('hide');
                    }
                    function deletepay(id,name){

                      //xajax_deletepayto(id);
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
                            url: xajax_deletepayto(id),
                            complete: function(data)
                            {
                              //alert(xajax_deletepayto(id));
                              Swal.fire({
                                type: 'success',
                                title: '',
                                text: 'Deleted.'
                              })
                              $( '#framepay' ).attr( 'src', function ( i, val ) { return val; });

                            }
                          });
                        }
                      })

                    }
                    //number to words

                    $('#txtamount').focus();
                    $('#txtwords').num2words();

                    $('#btnsavecheck').click(function(){
                    
                    var checkno = $('#txtcheckno').val();
                    var payto = $('#txtpayto').val();
                    var amount = $('#txtamount').val();
                    var inwords = $('#txtwords').val();
                    var tdate = $('#txtdate').val();

                    /*var num2words = new NumberToWords();
                    var intl2 = num2words.numberToWords(amount);

                    $('#txtwords').val(intl2);*/

                    //var towords = toWords(amount);
                      //alert(towords);
                   /*var wew = numberToWords(amount);
                   alert(wew);*/

                      if(checkno == ""){
                        Swal.fire({
                          type: 'warning',
                          title: '',
                          text: 'please fill in the missing fields.'
                        })
                      }
                      else {
                        xajax_insertcheck(checkno,payto,amount,inwords,tdate);

                        swal.fire({
                          title: "SAVE!",
                          text: "Check has been added!",
                          type: "success"
                        }).then(function() {
                          //history.go(0);
                          refreshtable();
                        });

                      }

                      
                    });

                    $('#btnsaveascheck').click(function(){
                    
                    var checkno = $('#txtcheckno').val();
                    var payto = $('#txtpayto').val();
                    var amount = $('#txtamount').val();
                    var inwords = $('#txtwords').val();
                    var tdate = $('#txtdate').val();

                    /*var num2words = new NumberToWords();
                    var intl2 = num2words.numberToWords(amount);

                    $('#txtwords').val(intl2);*/

                    //var towords = toWords(amount);
                      //alert(towords);
                   /*var wew = numberToWords(amount);
                   alert(wew);*/

                      if(checkno == ""){
                        Swal.fire({
                          type: 'warning',
                          title: '',
                          text: 'please fill in the missing fields.'
                        })
                      }
                      else {
                        xajax_insertcheck(checkno,payto,amount,inwords,tdate);

                        swal.fire({
                          title: "SAVE!",
                          text: "Check has been added!",
                          type: "success"
                        }).then(function() {
                          //history.go(0);
                          refreshtable();
                        });

                      }

                      
                    });

                    $('#btnupdatecheck').click(function(){

                      var checkno = $('#txtcheckno').val();
                      var payto = $('#txtpayto').val();
                      var amount = $('#txtamount').val();
                      var inwords = $('#txtwords').val();
                      var tdate = $('#txtdate').val();
                      xajax_updatecheckinfo(cheq_id,checkno,payto,amount,inwords,tdate);

                       swal.fire({
                          title: "UPDATED!",
                          text: "Check has been updated!",
                          type: "success"
                        }).then(function() {
                          //history.go(0);
                          refreshtable();
                        });


                    });

                    $('#btnprintcheck').click(function(){
                      var checkno = $('#txtcheckno').val();
                      var payto = $('#txtpayto').val();
                      var amount = $('#txtamount').val();
                      var inwords = $('#txtwords').val();
                      var tdate = $('#txtdate').val();

                      window.open("../../../reports/check_print_unsave.php?checkno=" + checkno +" & payto=" + payto + " & amount="+amount+" & inwords=" + inwords + " & tdate=" +tdate+ " & id=" +1, "_blank");

                    });
                    $('#btnpaytomodal').click(function(){
                      $('#selectpaytomodal').modal('show');
                    });
                    $('#btnnewpay').click(function(){
                    //$('#purchaseitemmodal').modal('show');
                    $('#btnsavepay').show();
                    $("#btnnewpay").hide();

                    
                    document.getElementById("btnsavepay").disabled=false;
                    document.getElementById("btnupdatepay").disabled=false;
                    document.getElementById("txtpaynosnew").disabled=false;
                    /*document.getElementById("btnsavepay").style.visibility='visible';
                    document.getElementById("btnnewpay").style.visibility='hidden';*/
                  });

                    $('#btnsavepay').click(function(){
                    var platenos = $('#txtpaynosnew').val();
                    if (platenos == ""){
                      Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Name is Empty!.'
                      })
                    }
                    else {
                      //alert(platenos);
                      var payname = $('#txtpaynosnew').val();
                      xajax_insertpayto(payname);
                      //xajax_insertplate(platenos);
                      swal.fire({
                        title: "SAVE!",
                        text: "Name has been added!",
                        type: "success"
                      }).then(function() {
                        $( '#framepay' ).attr( 'src', function ( i, val ) { return val; });
                        //history.go(0);
                      });
                      //alert(resp());


                    }
                    //$('#purchaseitemmodal').modal('show');
                  }); 
                   /* function respo(){
                      alert('weweaweaweadasd');
                    }*/

      


                  </script>
                </body>
                </html>