<?php 


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Kraken/3.8.2/js/html5.js"></script>

  <link href="../.../../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../.../../../vendor/bootstrap/css/jquery-ui.css" rel="stylesheet">
  <link href="../.../../../vendor/bootstrap/css/jquery-ui-min.css" rel="stylesheet">
  <link href="../.../../../vendor/bootstrap/css/jquery-ui.structure.css" rel="stylesheet">
  <link href="../.../../../vendor/bootstrap/css/jquery-ui.structure-min.css" rel="stylesheet">
  <link href="../.../../../vendor/bootstrap/css/jquery-ui.theme.css" rel="stylesheet">
  <link href="../.../../../vendor/bootstrap/css/jquery-ui.theme.min.css" rel="stylesheet">
  <link href="../.../../../vendor/datatables/jquery.datatables.yadcf.css" rel="stylesheet" type="text/css" />

  <link href="../.../../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

 <!--  <link href="../../../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet"> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="../../../css/sb-admin.css" rel="stylesheet">
  <link href="../../../vendor/bootstrap/css/sweetalert2.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/datetime/1.1.1/css/dataTables.dateTime.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/buttons/2.1.0/css/buttons.dataTables.min.css" rel="stylesheet">
 
<!-- <link href='//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css' rel='stylesheet' type='text/css'> -->
</head>
<body>
<table class="table table-hover" id="tblproditem" width="100%" cellspacing="0">
          <thead>
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
              <th class="all">Designation</th>
              <th class="all">Item Name</th>
              <th class="all">Description</th>
              <th class="all">Brand</th>
              <th class="all">Purpose</th>
              <th class="all">Qty</th>
              <th class="all">Unit</th>
              <th class="all">Price</th>
              <th class="all">Amount</th>
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
              <th class="all">PJD No.</th>
              <th class="all">Other Ref.</th>
              <th class="all">Remarks</th>
            </tr>
              

            </thead>
            <tbody></tbody>
           
            <tfoot style="width:50px;" rowspan = "0" colspan = "0">
        <tr>
          <th class="all">ID</th>
              <th class="all">Designation</th>
              <th class="all">Item Name</th>
              <th class="all">Description</th>
              <th class="all">Brand</th>
              <th class="all">Purpose</th>
              <th class="all">Qty</th>
              <th class="all">Unit</th>
              <th class="all">Price</th>
              <th class="all">Amount</th>
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
              <th class="all">PJD No.</th>
              <th class="all">Other Ref.</th>
              <th class="all">Remarks</th>
         </tr>
    </tfoot>
          </table>
          <script src="../.../../../vendor/jquery/jquery.min.js"></script>
              <script src="../.../../../vendor/jquery/jquery-ui.js"></script>
              <script src="../.../../../vendor/jquery/jquery-ui.min.js"></script>
              <script src="../.../../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

              <script src="../.../../../vendor/jquery-easing/jquery.easing.min.js"></script>


              <script src="../.../../../vendor/datatables/jquery.dataTables.js"></script>
              <script src="../.../../../vendor/datatables/jquery.dataTables.yadcf.js" type="text/javascript"></script>
              <script src="../.../../../vendor/datatables/dataTables.bootstrap4.js"></script>

              <script src="../.../../../js/sb-admin.min.js"></script>
              <script src="../.../../../vendor/jquery/jquery.datetimepicker.js"></script>

              <script src="../.../../../js/demo/datatables-demo.js"></script>
              <script src="../.../../../vendor/bootstrap/js/bootstrap3-typeahead.min.js" type="text/javascript"></script>
              <script src="../.../../../vendor/bootstrap/js/bootstrap3-typeahead.js" type="text/javascript"></script>

              <script src="../.../../../vendor/bootstrap/js/jquery.autocomplete.js" type="text/javascript"></script>
              <script src="../.../../../vendor/bootstrap/js/jquery.autocomplete.min.js" type="text/javascript"></script>
              <script src="../.../../../vendor/bootstrap/js/sweetalert2.js" type="text/javascript"></script>
              <script src="../.../../../vendor/datatables/moment.js/2.18.1/moment.min.js" type="text/javascript"></script>
              <script src="../.../../../vendor/datatables/dataTables.dateTime.min.js" type="text/javascript"></script>
              <script src="../.../../../vendor/datatables/dataTables.buttons.min.js" type="text/javascript"></script>
              <script src="../.../../../vendor/datatables/jszip.min.js" type="text/javascript"></script>
              <script src="../.../../../vendor/datatables/pdfmake.min.js" type="text/javascript"></script>
              <script src="../.../../../vendor/datatables/vfs_fonts.js" type="text/javascript"></script>
              <script src="../.../../../vendor/datatables/buttons.html5.min.js" type="text/javascript"></script>
              <script src="../.../../../vendor/datatables/buttons.print.min.js" type="text/javascript"></script>
              <script src="../.../../../vendor/datatables/sum().js" type="text/javascript"></script>
</body>
</html>