<?php 
error_reporting(0);
require "../../../../../fpdf/fpdf.php";
//$db = new PDO('mysql:host=localhost;dbname=dx_requestform2','root','');
$server = "localhost";
$user = "root";
$pass = "OSXVD2XSQk1PhOvD";
$db = "inventorydatabase";
$conn = mysqli_connect($server,$user,$pass,$db);



//die($to . " " . $fromdate );
class myPDF extends FPDF{
    function myCell($w,$h,$x,$t){
        $height=$h/3;
        $first=$height+2;
        $second=$height+$height+$height+3;
        $len=strlen($t);
        if($len>23){
            $txt=str_split($t,23);
            $this->SetX($x);
            $this->Cell($w,$first,$txt[0],'','','');
            $this->SetX($x);
            $this->Cell($w,$second,$txt[1],'','','');
            $this->SetX($x);
            $this->Cell($w,$h,'','',0,'L',0);
        }
        else{
            $this->SetX($x);
            $this->Cell($w,$h,$t,'',0,'L',0);
        }
    }
    
    function vcell($c_width,$c_height,$x_axis,$text){
        $w_w=$c_height/3;
        $w_w_1=$w_w+2;
        $w_w1=$w_w+$w_w+$w_w+3;
        $len=strlen($text);
        if($len>30){
            $w_text=str_split($text,24);
            $this->SetX($x_axis);
            $this->Cell($c_width,$w_w_1,$w_text[0],'','','');
            $this->SetX($x_axis);
            $this->Cell($c_width,$w_w1,$w_text[1],'','','');
            $this->SetX($x_axis);
            $this->Cell($c_width,$c_height,'','LTRB',0,'L',0);
        }
        else{
            $this->SetX($x_axis);
            $this->Cell($c_width,$c_height,$text,'LTRB',0,'L',0);
        }
    }
    function headerTable(){
        //$this->image('logo2.png',10,5);
        //$this->SetFont('Arial','B',20);
        //$this->setTextColor(0,0,0);

        $this->Ln();
        $this->SetFont('ARIAL','B',12);
        $this->Cell(185,0,'SAGREX CORPORATION',0,1,'C');
        $this->SetFont('Times','',8);
        $this->Cell(185,10,'( INVENTORY DETAILED REPORT )',0,0,'C');
        $this->Ln();

        $this->SetFont('Times','B',8);
        $this->setFillColor(230,230,230); 
        $this->Cell(20,6,'Date',1,0,'C',1);
        $this->Cell(30,6,'RR/SIS',1,0,'C',1);
        $this->Cell(30,6,'Reference',1,0,'C',1);
        $this->Cell(45,6,'Customer/Supplier',1,0,'C',1);
        $this->Cell(20,6,'In',1,0,'C',1);
        $this->Cell(20,6,'Out',1,0,'C',1);
        $this->Cell(20,6,'Balance',1,0,'C',1);
        $this->Ln();
    }
    function viewTable($conn){
        $this->SetFont('Times','',8);
        $this->setTextColor(0,0,0);
        $this->setFillColor(255,255,255);
        $wew = 18458;
        $fromdate = $_GET['fromdate'];
        $to = $_GET['to'];
        $itemid = $_GET['itemid'];
        $invclass = $_GET['invc'];
        //die($invclass);
        
        $prevmonth = date("m", strtotime($fromdate . "-1 month"));
        $year = date("Y", strtotime($fromdate . "-1 month"));

        $prevdatefrom = $year."-".$prevmonth."-"."01 00:00:00";
        $prevdateto = date("Y-m-d", strtotime($fromdate . "-1 day")) . " 23:59:59";
        //var_dump($prevdateto);
        
       // die($itemid);
        $classtype="";
        if($invclass == ""){
            //die('sss');
            $classtype = "AND i.item_class = 'Raw' OR i.item_class = 'FG' OR i.item_class = 'Equipment'";
        }
        else {
            //die('wew');
            $classtype = "AND i.item_class = '".$invclass."'";
        }
        
        if($itemid == " "){
            $sql = "SELECT DISTINCT item_id FROM tblitemsrr";
            $result = $conn->query($sql);
            $prevbal = "";
            if ($result->num_rows > 0){
                while ($row=$result->fetch_assoc()){
                    $itemids = $row['item_id'];
                    $sqlprevbal = "SELECT bal_id, tiba.`item_id`,tiba.`time_created`,item.`Description`,tiba.balance FROM `tblitembalancearchive` AS tiba LEFT JOIN item ON item.`MyID` = tiba.`item_id` WHERE item_id = '".$itemids."' AND `time_created` BETWEEN '".$prevdatefrom."' AND '".$prevdateto."' ORDER BY time_created desc LIMIT 1";
                    //die($sqlprevbal);
                    //var_dump($resulprev->num_rows);
                    //$prevbal = "";
                    $resultprev = $conn->query($sqlprevbal);
                    if ($resultprev->num_rows > 0){ // if naa nay unod ang archive
                        
                        while ($rows=$resultprev->fetch_assoc()){
                            //die('sds');
                            $prevbal = $rows['balance'];
                            $Description = $rows['Description'];
                            $this->Cell(92.5,6,"Item Name: " .$Description,1,0,'C');
                            $this->Cell(92.5,6,"Begin Balance: ".$prevbal,1,1,'C');
                        }
                    }
                    else if($resultprev->num_rows <= 0 ){ //if walay unod ang archive
                        //die('sdss');
                        $sqlprevbalno = "SELECT bal_id, tiba.`item_id`,tiba.`time_created`,item.`Description`,tiba.balance FROM `tblitembalancearchive` AS tiba LEFT JOIN item ON item.`MyID` = tiba.`item_id` WHERE item_id = '".$itemids."' AND `time_created` BETWEEN '".$fromdate." 00:00:00' AND '".$to." 23:59:59' ORDER BY time_created asc LIMIT 1";
                    //var_dump($sqlprevbalno);
                        //$prevbal = "";

                        $resultprevno = $conn->query($sqlprevbalno);
                        if ($resultprevno->num_rows > 0){ // if naa nay unod ang archive
                            //die($sqlprevbalno);
                            while ($rows=$resultprevno->fetch_assoc()){
                                die('sdss');
                                $prevbal = 0;
                                $Description = $rows['Description'];
                                $this->Cell(92.5,6,"Item Name: " .$Description,1,0,'C');
                                $this->Cell(92.5,6,"Begin Balance: ".$prevbal,1,1,'C');
                            }
                        }

                    }
                   /* else {
                        die('No data');
                    }*/
                    $sql = "SELECT 
                    tblrr.`rrno` AS rrno,
                    tblrr.`qty` AS rrqty,
                    '' AS sisqty,
                    tblrr.`item_id` AS rrsisitemid,
                    tblrr.`date_rr` AS daterrsis,
                    tbc.`cust_name` AS cus_name,
                    i.`Description`,
                    i.Balance, 
                    rri.`reference` AS ref
                    FROM
                    tblitemsrr AS tblrr 
                    LEFT JOIN item AS i 
                    ON i.`MyID` = tblrr.`item_id` 
                    LEFT JOIN rrinfo AS rri 
                    ON rri.`rrno` = tblrr.`rrno` 
                    LEFT JOIN tblcustomer AS tbc 
                    ON tbc.`cust_id` = rri.`vendor_id` 
                    WHERE tblrr.item_id = '".$itemids."' AND date_rr BETWEEN '".$fromdate."' AND '".$to."' $classtype 
                    UNION
                    SELECT 
                    sisi.`issued_nos` AS rrno,
                    '' AS rrqty,
                    tblsis.qty AS sisqty,
                    tblsis.`item_id` AS rrsisitemid,
                    tblsis.`sis_date` AS daterrsis,
                    tbc.`cust_name` AS cust_name,
                    i.`Description`,
                    i.Balance,
                    sisi.reference AS ref 
                    FROM
                    tblitemsis AS tblsis 
                    LEFT JOIN item AS i 
                    ON i.`MyID` = tblsis.`item_id` 
                    LEFT JOIN sisinfo AS sisi 
                    ON sisi.issued_nos = tblsis.sisno 
                    LEFT JOIN tblcustomer AS tbc 
                    ON tbc.`cust_id` = sisi.`cust_id` 
                    WHERE tblsis.item_id = '".$itemids."' AND sis_date BETWEEN '".$fromdate."' AND '".$to."' $classtype ";
                    //var_dump($sql);
                    $results = $conn->query($sql);
                    $dTotalBalance = 0;
                    $finalBalance = 0;
                    $balance = "";
                    $bal = array();
                    $c = 0;
                    if ($results->num_rows > 0 ){
                        while ($row=$results->fetch_assoc()){
                           $this->vcell(20,6,10,$row['daterrsis'],1,0,'C');
                           $this->vcell(30,6,30,$row['rrno'],1,0,'C');
                           $this->vcell(30,6,60,$row['ref'],1,0,'C');
                           $this->vcell(45,6,90,$row['cus_name'],1,0,'C');
                           $this->Cell(20,6,$row['rrqty'],1,0,'C'); 
                           $this->Cell(20,6,$row['sisqty'],1,0,'C');

                           if ($row['rrqty'] != ''){
                               $balance = (double)$row['Balance'];   
                               $rrqty = (double)$row['rrqty'];
                               $sisqty = (double)$row['sisqty'];

                               if (sizeof($bal) > 0){
                                $bal[$c] = (double)$bal[$c-1] + (double)$rrqty;
                                $this->Cell(20,6,(double)$bal[$c],1,0,'C');

                            }
                            else {
                                $bal[$c] = $prevbal;
                                $bal[$c] = (double)$bal[$c] + (double)$rrqty;
                                $this->Cell(20,6,(double)$bal[$c],1,0,'C');
                            }

                        }
                        else if ($row['sisqty'] != ''){
                            $balance = (double)$row['Balance'];   
                            $rrqty = (double)$row['rrqty'];
                            $sisqty = (double)$row['sisqty'];
                            $bals = ""; 
                            if (sizeof($bal) > 0){
                                $bal[$c] = (double)$bal[$c-1] - (double)$sisqty;
                                $bals = (double)$bals. "-" . (double)$bal[$c];
                                $this->Cell(20,6,(double)$bal[$c],1,0,'C');

                            }
                            else {
                                $bal[$c] = $prevbal;
                                $bal[$c] = (double)$bal[$c] - (double)$sisqty;
                                $this->Cell(20,6,(double)$bal[$c],1,0,'C');
                            }
                        }
                        $this->Ln();

                        $c++;
                    }
                }
                /*else if($results->num_rows <= 0){
                    echo 'No data';
                }*/
                //var_dump((double)$bal[$c-1]);
                $this->Cell(185,6,'Final Balance: '.(double)$bal[$c-1],1,1,'R');
                //echo $bal[$c-1];
            }
        }
    }
    else{
        //die('sds');
        $sqlprevbal = "SELECT bal_id, tiba.`item_id`,tiba.`time_created`,item.`Description`,tiba.balance FROM `tblitembalancearchive` AS tiba LEFT JOIN item ON item.`MyID` = tiba.`item_id` WHERE item_id = '".$itemid."' AND `time_created` BETWEEN 
        '".$prevdatefrom."' AND '".$prevdateto."' ORDER BY bal_id desc LIMIT 1";
        //var_dump($prevdateto."-".$prevdatefrom);
        //die($sqlprevbal);
        $prevbal = "";

        $resultprev = $conn->query($sqlprevbal);
        //var_dump($resultprev->num_rows);
        if ($resultprev->num_rows > 0 ){
            while ($row=$resultprev->fetch_assoc()){
                $prevbal = $row['balance'];
                $Description = $row['Description'];
                $this->Cell(92.5,6,"Item Name: " .$Description,1,0,'C');
                $this->Cell(92.5,6,"Begin Balance: ".$prevbal,  1,1,'C');
            }
        }
        else if($resultprev->num_rows <= 0 ){

            $sqlprevbalno = "SELECT bal_id, tiba.`item_id`,tiba.`time_created`,item.`Description`,tiba.balance FROM `tblitembalancearchive` AS tiba LEFT JOIN item ON item.`MyID` = tiba.`item_id` WHERE item_id = '".$itemid."' AND `time_created` BETWEEN '".$fromdate." 00:00:00' AND '".$to." 23:59:59' ORDER BY time_created desc LIMIT 1";

            $resultprevno = $conn->query($sqlprevbalno);
            if ($resultprevno->num_rows > 0 ){ 
                while ($row=$resultprevno->fetch_assoc()){
                    $prevbal = $row['balance'];
                    $Description = $row['Description'];
                    $this->Cell(92.5,6,"Item Name: " .$Description,1,0,'C');
                    $this->Cell(92.5,6,"Begin Balance: ".$prevbal,1,1,'C');
                }
            }

        }

        $sql = "SELECT 
        tblrr.`rrno` AS rrno,
        tblrr.`qty` AS rrqty,
        '' AS sisqty,
        tblrr.`item_id` AS rrsisitemid,
        tblrr.`date_rr` AS daterrsis,
        tbc.`cust_name` AS cus_name,
        i.`Description`,
        i.Balance, 
        rri.`reference` AS ref
        FROM
        tblitemsrr AS tblrr 
        LEFT JOIN item AS i 
        ON i.`MyID` = tblrr.`item_id` 
        LEFT JOIN rrinfo AS rri 
        ON rri.`rrno` = tblrr.`rrno` 
        LEFT JOIN tblcustomer AS tbc 
        ON tbc.`cust_id` = rri.`vendor_id` 
        WHERE tblrr.item_id = '".$itemid."' AND date_rr BETWEEN '".$fromdate."' AND '".$to."' $classtype 
        UNION
        SELECT 
        sisi.issued_nos AS rrno,
        '' AS rrqty,
        tblsis.qty AS sisqty,
        tblsis.`item_id` AS rrsisitemid,
        tblsis.`sis_date` AS daterrsis,
        tbc.`cust_name` AS cust_name,
        i.`Description`,
        i.Balance,
        sisi.reference AS ref 
        FROM
        tblitemsis AS tblsis 
        LEFT JOIN item AS i 
        ON i.`MyID` = tblsis.`item_id` 
        LEFT JOIN sisinfo AS sisi 
        ON sisi.issued_nos = tblsis.sisno 
        LEFT JOIN tblcustomer AS tbc 
        ON tbc.`cust_id` = sisi.`cust_id` 
        WHERE tblsis.item_id = '".$itemid."' AND sis_date BETWEEN '".$fromdate."' AND '".$to."' $classtype ";
        $result = $conn->query($sql);
        $dTotalBalance = 0;
        $finalBalance = 0;
        $balance = "";
        $bal = array();
        $c = 0;
        if ($result->num_rows > 0 ){
            while ($row=$result->fetch_assoc()){
             $this->vcell(20,6,10,$row['daterrsis'],1,0,'C');
             $this->vcell(30,6,30,$row['rrno'],1,0,'C');
             $this->vcell(30,6,60,$row['ref'],1,0,'C');
             $this->vcell(45,6,90,$row['cus_name'],1,0,'C');
             $this->Cell(20,6,$row['rrqty'],1,0,'C'); 
             $this->Cell(20,6,$row['sisqty'],1,0,'C');

             if ($row['rrqty'] != ''){
                 $balance = $row['Balance'];   
                 $rrqty = (double)$row['rrqty'];
                 $sisqty = (double)$row['sisqty'];

                 if (sizeof($bal) > 0){
                    $bal[$c] = (double)$bal[$c-1] + (double)$rrqty;
                    $this->Cell(20,6,(double)$bal[$c],1,0,'C');

                }
                else {
                    $bal[$c] = (double)$prevbal;
                    $bal[$c] = (double)$bal[$c] + (double)$rrqty;
                    $this->Cell(20,6,(double)$bal[$c],1,0,'C');
                }

            }
            else if ($row['sisqty'] != ''){
                $balance = (double)$row['Balance'];   
                $rrqty = (double)$row['rrqty'];
                $sisqty = (double)$row['sisqty'];
                $bals = "";
                if (sizeof($bal) > 0){
                    $bal[$c] = (double)$bal[$c-1] - (double)$sisqty;
                    $bals = (double)$bals. "-" . (double)$bal[$c];
                    $this->Cell(20,6,(double)$bal[$c],1,0,'C');

                }
                else {
                    $bal[$c] = (double)$prevbal;
                    $bal[$c] = (double)$bal[$c] - (double)$sisqty;
                    $this->Cell(20,6,(double)$bal[$c],1,0,'C');
                }
            }
            $this->Ln();

            $c++;
        }

    }
   /* else if($result->num_rows <= 0){
        echo 'No data';
    }*/
    $this->Cell(185,6,'Final Balance: '.(double)$bal[$c-1],1,1,'R');
}


}
}

$pdf = new myPDF();
$pdf->AliasNbPages();
$pagesize = array(107, 199);
$pdf->AddPage('L','A5',0);
//$pdf->dataforms();
//$pdf->SetAutoPageBreak(true);;
$pdf->headerTable();
$pdf->viewTable($conn);
$height_of_cell = 60; // mm
$page_height = 297/2; // mm (portrait letter)

$pdf->Output();