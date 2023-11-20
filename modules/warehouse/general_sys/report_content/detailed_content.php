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


<body id="page-top">
  <form action="report_content/detailed_content.php" method="POST" enctype="multipart/form-data">
    <table>
      <div class="col-sm-12" style="border-bottom: 1px solid grey;margin-top: 10px;">
        <div class="form-group row">
          <label class="col-form-label">Description:</label>
          <div class="col-sm-2">

            <input type="text" id="txtdescription" class="form-control" name="">
          </div>
          <label class="col-form-label">Class:</label>
          <div class="col-sm-1">
            <select class="form-control" id="txtclass" name="txtclass">
              <option></option>
              <option>Raw</option>
              <option>FG</option>
              <option>Equipment</option>
              <option>Supply</option>
            </select>
            <!-- <input type="text" id="txttypes" class="form-control" name="txttypes"> -->
          </div>
          <label class="col-form-label">Date From:</label>
          <div class="col-sm-2">
            <input type="date" id="dtpfrom" class="form-control" name="">
          </div>
          <label class="col-form-label">Date To:</label>
          <div class="col-sm-2">
            <input type="date" id="dtpto" class="form-control" name="">
          </div>
          <label class="col-form-label">Type:</label>
          <div class="col-sm-2">
            <!-- <input type="text" id="txtbalance" class="form-control" name=""> -->
            <select id="txttype" class="form-control">
              <option value="0">Detail Report</option>
              <option value="1">Summary Report</option>
            </select>
          </div>
          <div  style="border: 1px solid black;">
            <button type="button" id="btnpreviewreports" style="float:right;"   class="btn btn-primary">Preview</button>
          </div>
        </div>
      </div>
    </table>
  </form> 
  <div class="card mb-3">
    <div class="card-header" style="background-color: #3399CC;color: white;">
      <i class="fas fa-table"></i>
    Items Table</div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover" id="tblreport" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Item ID</th>
              <th style="min-width: 500px;">Description</th>
              <th style="min-width: 200px;">Unit</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            include('tables/detailed_report_items.php');
            ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
  </div> 
  <!-- Edit Request Material -->
  <div class="modal fade bd-example-modal-lg" id="reportsdetailedmodal" tabindex="" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" style="background-color: grey;width: 1200px;min-height:500px;margin-left: -180px;">
        <div class="modal-header" style="background-color: #17A2B8;color:white;">
          <h5 class="modal-title" id="formModalLabel">Detailed Report</h5>
          <button style="border:0px;color:white;" type="button" class="btn btn-secondary" data-dismiss="modal" id="btnFormClose"><i class="fa fa-close"></i></button>
        </div>
        <table class="table table-bordered" id="" width="100%" cellspacing="0">
          <div style="float: right;border: 1px;">

            <div style="height:0px;min-width:500px;margin-right:2px;">

              <tbody id="mtable2">
                <iframe style="border: 0px;height: 500px;" name="framereport" id="framereport" src="report_content/reports/detailed_report.php?fromdate=& to= & desc= & itemid= & invc="></iframe>
              </tbody>
              
            </div>

          </div>
        </table>

      </div>
    </div>
  </div>
  <!-- End -->

  <!-- Edit Request Material -->
  <div class="modal fade bd-example-modal-lg" id="reportssummarymodal" tabindex="" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" style="background-color: grey;width: 1200px;min-height:500px;margin-left: -180px;">
        <div class="modal-header" style="background-color: #17A2B8;color:white;">
          <h5 class="modal-title" id="formModalLabel">Detailed Report</h5>
          <button style="border:0px;color:white;" type="button" class="btn btn-secondary" data-dismiss="modal" id="btnFormClose"><i class="fa fa-close"></i></button>
        </div>
        <table class="table table-bordered" id="" width="100%" cellspacing="0">
          <div style="float: right;border: 1px;">
            <div style="height:0px;min-width:500px;margin-right:2px;">
              <tbody id="mtable2">
                <iframe style="border: 0px;height: 500px;" name="framereportsumm" id="framereportsumm" src="report_content/reports/summary_report.php?fromdate= & to= & desc= & itemid= & invc="></iframe>
              </tbody>             
            </div>
          </div>
        </table>

      </div>
    </div>
  </div>
  <!-- End -->


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

  <script src="../../../vendor/bootstrap/js/bootstrap3-typeahead.min.js" type="text/javascript"></script>
  <script src="../../../vendor/bootstrap/js/bootstrap3-typeahead.js" type="text/javascript"></script>
  <script src="../../../vendor/bootstrap/js/jquery.autocomplete.js" type="text/javascript"></script>
  <script src="../../../vendor/bootstrap/js/jquery.autocomplete.min.js" type="text/javascript"></script>
  <script type="text/javascript">

    $('#btnpreviewreports').click(function(){
      var desc = $('#txtdescription').val();
      var froms = $('#dtpfrom').val();
      var tos = $('#dtpto').val();
      var invclass = $('#txtclass').val();
      //alert(invclass);
      if(desc == ""){
        //alert("zz");
        itemid = "";
      }
      if(froms == "" ||  tos == ""){
        Swal.fire({
          type: 'error',
          title: 'Oops...',
          text: 'Select Date Range first.'
        })
      }
      else {

      //alert(itemid);
      var dept = $('#txttype').children("option:selected").val();
      if(dept == 0){
       var from = $('#dtpfrom').val();
       var to = $('#dtpto').val();

       history.replaceState("","","?fromdate=" + from + " & to=" + to + " & desc=" + itemdesc + " & itemid=" + itemid + " & invc=" + invclass );
       var myFrame = $('#framereport');
       var url = $(myFrame).attr('src')+"?fromdate=" + from + " & to=" + to + " & desc=" + itemdesc + " & itemid=" + itemid + " & invc=" + invclass;

       var loc = url;
       var params = loc.split('?')[1];
       document.getElementById("framereport").src = 'report_content/reports/detailed_report.php?fromdate=' + from + " & to=" + to + " & desc=" + itemdesc + " & itemid=" + itemid + " & invc=" + invclass;
       $('#reportsdetailedmodal').modal('show');
     }
     else if(dept == 1){
      //alert("wew");
      var from = $('#dtpfrom').val();
      var to = $('#dtpto').val();

      history.replaceState("","","?fromdate=" + from + " & to=" + to + " & desc=" + itemdesc + " & itemid=" + itemid + " & invc=" + invclass);
      var myFrame = $('#framereportsumm');
      var url = $(myFrame).attr('src')+"?fromdate=" + from + " & to=" + to + " & desc=" + itemdesc + " & itemid=" + itemid + " & invc=" + invclass;

      var loc = url;
      var params = loc.split('?')[1];
      document.getElementById("framereportsumm").src = 'report_content/reports/summary_report.php?fromdate=' + from + " & to=" + to + " & desc=" + itemdesc + " & itemid=" + itemid + " & invc=" + invclass;
      $('#reportssummarymodal').modal('show');
    }

  }

});
    var itemid = "";
    var itemdesc = "";
    function selectitem(item_id,desc){
      $('#txtdescription').val(desc);
      itemdesc = desc;
      itemid = item_id;

    }



  </script>
</body>
</html>