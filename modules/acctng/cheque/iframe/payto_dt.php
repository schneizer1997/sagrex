<?php
include('../../../../classes/inc/dbCon.php');
// Load data in maintenance module
//$appendrrno = $_GET['rrno'];
//die($appendrrno);
global $dbcheque;


echo '<form action = "" method = "GET">';
echo '<table class="table table-striped header-fixed table-bordered table-hover table-info " id ="dataTable" cellspacing="0" style= "width:100%;table-layout: fixed;margin-bottom: -15px;overflow-y: auto; height: 100px;">';
echo '<div>';
echo '<thead style = "position: sticky; top: 0;background-color:#17A2B8;z-index:999;">';
echo '<tr>';
echo '<div id = "wew" style = "position:sticky;" width="100%">';
echo '<th>ID</th><th>Name</th><th>Action</th>';
echo '</tr>';
echo '</div>';
echo '</thead>';
echo '</div>';
echo '<tbody style = "overflow-y: scroll;">';
$sql = "SELECT *FROM payto_tbl WHERE status = 1";

$result=$dbcheque->query($sql);
$c=0;
//var_dump($result);
if ($result->num_rows > 0){

    while ($row=$result->fetch_assoc()){

        $myid= preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['payto_id']);
        $name= preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['payto_name']);
        /*$myid= preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['MyID']);
        $description=preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['Description']);
        $qtyonhand = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['QuantityOnHand']); 
        $unit = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row['UnitOfMeasureSetRefFullName']); */
        echo '<tr>';
        echo '<td id = "txtmyid'.$c.'" style= "">'.$myid.'</td>';
        echo '<td id = "txtpaytoname'.$c.'" style= "">'.$name.'</td>';
        echo '<td><button type = "button" id  = "btnselectpay'.$c.'" name = "btnselectpay" class = "btnselectplate btn btn-success" onclick=\'parent.selectpay("'.$myid.'","'.$name.'")\'><i class = "fa fa-plus" style="padding-right: 5px;"></i>SELECT</button>
        <button type = "button" id  = "btndeletepay'.$c.'" name = "btndeletepay" class = "btndeletepay btn btn-danger" onclick=\'parent.deletepay("'.$myid.'","'.$name.'")\'><i class = "fa fa-trash" style="padding-right: 5px;"></i>DELETE</button>
        </td>';
        echo '</tr>';
        /*echo '<tr>';
        echo '<td id = "txtmyid'.$c.'" style= "">'.$myid.'</td>';
        echo '<td id = "txtdescription'.$c.'" style= "">'.$description.'</td>';
        echo '<td id = "txtunit'.$c.'" style= "">'.$unit.'</td>';
        echo '<td><button type = "button" id  = "btnselectitem'.$c.'" name = "btnselectitem" class = "btnselectitem btn btn-success" onclick=\'parent.additems("'.$myid.'","'.$appendrrno.'")\'><i class = "fa fa-plus" style="padding-right: 5px;"></i>ADD</button>
        </td>';
        echo '</tr>';*/
        $c++;
    }
}
//echo '<input type = "text" id = "txtcountitems" name = "txtcountitems" value ="'.$c.'" >';
echo '</tbody>';
echo '</table>';
echo '</form>';
?>
<!DOCTYPE html>
<html>
<head>
    <link href="../../../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../../../../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="../../../../vendor/datatables/css/scroller.bootstrap.min.css" rel="stylesheet">
    <link href="../../../../css/sb-admin.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="../../../../css/sb-admin.css" rel="stylesheet">
    
</head>
<body>
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="../../../../vendor/jquery/jquery.min.js"></script>
    <script src="../../../../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../../../../vendor/datatables/jquery.dataTables.js"></script>
    <script src="../../../../vendor/datatables/dataTables.bootstrap4.js"></script>
    <script src="../../../../vendor/datatables/js/dataTables.scroller.min.js"></script>
    <script src="../../../../vendor/datatables/jquery.stickytableheaders.js"></script>
    <script src="../../../../vendor/datatables/jquery.stickytableheaders.min.js"></script>
    <script src="../../../../js/demo/datatables-demo.js" type="text/javascript"></script>
    <script type="text/javascript">
        $('[name=btnselectpay]').click(function(){
            //alert('sds');
            /*window.parent.document.getElementById("btnnewplate").style.visibility='hidden';
            window.parent.document.getElementById("btnsaveplate").style.visibility='visible';*/
            //window.parent.shownewplatebtn();
            window.parent.document.getElementById("btnupdatepay").disabled=false;
            window.parent.document.getElementById("btnnewpay").disabled=false;
            window.parent.document.getElementById("btnsavepay").disabled=true;
            //$('#btnrrupdate').removeAttr('disabled');

        });
        $('[name=btndeletepay]').click(function(){
            //alert('sds');
            /*window.parent.document.getElementById("btnnewplate").style.visibility='hidden';
            window.parent.document.getElementById("btnsaveplate").style.visibility='visible';*/
            //window.parent.shownewplatebtn();
            window.parent.document.getElementById("btnupdatepay").disabled=false;
            window.parent.document.getElementById("btnnewpay").disabled=true;
            window.parent.document.getElementById("btnsavepay").disabled=false;
            //$('#btnrrupdate').removeAttr('disabled');

        });
    </script>
</body>
</html>