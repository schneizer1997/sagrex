<?php 
//error_reporting(0);
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
        $this->SetFont('ARIAL','',12);
        $this->Cell(185,0,'SAGREX CORPORATION',0,1,'C');
        $this->SetFont('Times','',8);
        $this->Cell(185,10,'( INVENTORY SUMMARY REPORT )',0,0,'C');
        $this->Ln();

        $this->SetFont('Times','B',8);
        $this->setFillColor(230,230,230); 
        $this->Cell(35,6,'Date Range',1,0,'C',1);
        $this->Cell(50,6,'Item Description',1,0,'C',1);
        $this->Cell(30,6,'In',1,0,'C',1);
        $this->Cell(45,6,'Out',1,0,'C',1);
        $this->Cell(20,6,'Qty on hand',1,0,'C',1);
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
            if ($result->num_rows > 0 ){
                while ($row=$result->fetch_assoc()){
                    $itemid = $row['item_id'];
                    $sqlprevbal = "SELECT bal_id, tiba.`item_id`,tiba.`time_created`,item.`Description`,tiba.balance FROM `tblitembalancearchive` AS tiba LEFT JOIN item ON item.`MyID` = tiba.`item_id` WHERE item_id = '".$itemid."' AND `time_created` BETWEEN '".$prevdatefrom."' AND '".$prevdateto."' ORDER BY bal_id asc LIMIT 1";
                    $prevbal = "";
                    $resultprev = $conn->query($sqlprevbal);
                    if ($resultprev->num_rows > 0 ){
                        while ($row=$resultprev->fetch_assoc()){
                            $prevbal = $row['balance'];
                            $Description = $row['Description'];
                        }
                    }
                    else if($resultprev->num_rows <= 0 ){

                        $sqlprevbalno = "SELECT bal_id, tiba.`item_id`,tiba.`time_created`,item.`Description`,tiba.balance FROM `tblitembalancearchive` AS tiba LEFT JOIN item ON item.`MyID` = tiba.`item_id` WHERE item_id = '".$itemid."' AND `time_created` BETWEEN '".$fromdate." 00:00:00' AND '".$fromdate." 23:59:59' ORDER BY time_created asc LIMIT 1";

                        $resultprevno = $conn->query($sqlprevbalno);
                        if ($resultprevno->num_rows >= 0 ){ 
                            while ($row=$resultprevno->fetch_assoc()){
                                $prevbal = $row['balance'];
                                $Description = $row['Description'];
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
                    WHERE tblsis.item_id = '".$itemid."' AND sis_date BETWEEN '".$fromdate."' AND '".$to."' $classtype";
                    $results = $conn->query($sql);
                    $dTotalBalance = 0;
                    $finalBalance = 0;
                    $balance = "";
                    $totalsisqty = 0;
                    $totalrrqty = 0;
                    $desc = "";
                    $qtyonhand = 0;
                    $bal = array();
                    $c = 0;
                    if ($results->num_rows > 0 ){
                        while ($row=$results->fetch_assoc()){
                            $totalrrqty = $totalrrqty + (double)$row['rrqty'];
                            $totalsisqty = $totalsisqty + (double)$row['sisqty'];
                            $desc = $row['Description'];


                            if ($row['rrqty'] != ''){
                             $balance = $row['Balance'];   
                             $rrqty = (double)$row['rrqty'];
                             $sisqty = (double)$row['sisqty'];

                             if (sizeof($bal) > 0){
                                $bal[$c] = (double)$bal[$c-1] + (double)$rrqty;
                                $qtyonhand = $bal[$c];

                            }
                            else {
                                $bal[$c] = $prevbal;
                                $bal[$c] = (double)$bal[$c] + (double)$rrqty;
                                $qtyonhand = $bal[$c];
                            }

                        }
                        else if ($row['sisqty'] != ''){
                            $balance = $row['Balance'];   
                            $rrqty = (double)$row['rrqty'];
                            $sisqty = (double)$row['sisqty'];
                            $bals = "";
                            if (sizeof($bal) > 0){
                                $bal[$c] = $bal[$c-1] - (double)$sisqty;
                                $bals = $bals. "-" . $bal[$c];
                                $qtyonhand = $bal[$c];

                            }
                            else {
                                $bal[$c] = $prevbal;
                                $bal[$c] = (double)$bal[$c] - (double)$sisqty;
                                $qtyonhand = $bal[$c];
                            }
                        }

                        $c++;
                    }
                }
                $this->vcell(35,6,10,$fromdate. " - ".$to,1,0,'C');
                $this->vcell(50,6,45,$desc,1,0,'C');
                $this->vcell(30,6,95,$totalrrqty,1,0,'C');
                $this->vcell(45,6,125,$totalsisqty,1,0,'C');
                $this->vcell(20,6,170,(double)$bal[$c-1],1,0,'C');
                $this->Ln();
            }
        }
    }
    else {
        $sqlprevbal = "SELECT bal_id, tiba.`item_id`,tiba.`time_created`,item.`Description`,tiba.balance FROM `tblitembalancearchive` AS tiba LEFT JOIN item ON item.`MyID` = tiba.`item_id` WHERE item_id = '".$itemid."' AND `time_created` BETWEEN '".$prevdatefrom."' AND '".$prevdateto."' ORDER BY bal_id asc LIMIT 1";
        $prevbal = "";
        $resultprev = $conn->query($sqlprevbal);
        if ($resultprev->num_rows > 0 ){
            while ($row=$resultprev->fetch_assoc()){
                $prevbal = $row['balance'];
                $Description = $row['Description'];
            }
        }
        else if($resultprev->num_rows <= 0 ){

            $sqlprevbalno = "SELECT bal_id, tiba.`item_id`,tiba.`time_created`,item.`Description`,tiba.balance FROM `tblitembalancearchive` AS tiba LEFT JOIN item ON item.`MyID` = tiba.`item_id` WHERE item_id = '".$itemid."' AND `time_created` BETWEEN '".$fromdate." 00:00:00' AND '".$fromdate." 23:59:59' ORDER BY time_created asc LIMIT 1";

            $resultprevno = $conn->query($sqlprevbalno);
            if ($resultprevno->num_rows > 0 ){ 
                while ($row=$resultprevno->fetch_assoc()){
                    $prevbal = $row['balance'];
                    $Description = $row['Description'];
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
        WHERE tblsis.item_id = '".$itemid."' AND sis_date BETWEEN '".$fromdate."' AND '".$to."' $classtype";
        //var_dump($sql);
        $result = $conn->query($sql);
        $dTotalBalance = 0;
        $finalBalance = 0;
        $balance = "";
        $totalsisqty = 0;
        $totalrrqty = 0;
        $desc = "";
        $qtyonhand = 0;
        $bal = array();

        $c = 0;
        if ($result->num_rows > 0 ){
            while ($row=$result->fetch_assoc()){
                $totalrrqty = $totalrrqty + (double)$row['rrqty'];
                $totalsisqty = $totalsisqty + (double)$row['sisqty'];
                $desc = $row['Description'];

                if ($row['rrqty'] != ''){
                 $balance = $row['Balance'];   
                 $rrqty = (double)$row['rrqty'];
                 $sisqty = (double)$row['sisqty'];

                 if (sizeof($bal) > 0){
                    $bal[$c] = $bal[$c-1] + (double)$rrqty;
                    $qtyonhand = $bal[$c];

                }
                else {
                    $bal[$c] = $prevbal;
                    $bal[$c] = (double)$bal[$c] + (double)$rrqty;
                    $qtyonhand = $bal[$c];
                }

            }
            else if ($row['sisqty'] != ''){
                $balance = $row['Balance'];   
                $rrqty = (double)$row['rrqty'];
                $sisqty = (double)$row['sisqty'];
                $bals = "";
                if (sizeof($bal) > 0){
                    $bal[$c] = (double)$bal[$c-1] - (double)$sisqty;
                    $bals = $bals. "-" . $bal[$c];
                    $qtyonhand = $bal[$c];

                }
                else {
                    $bal[$c] = $prevbal;
                    $bal[$c] = (double)$bal[$c] - (double)$sisqty;
                    $qtyonhand = $bal[$c];
                }
            }

            $c++;
        }
    }
    $this->vcell(35,6,10,$fromdate. " - ".$to,1,0,'C');
    $this->vcell(50,6,45,$desc,1,0,'C');
    $this->vcell(30,6,95,$totalrrqty,1,0,'C');
    $this->vcell(45,6,125,$totalsisqty,1,0,'C');
    $this->vcell(20,6,170,(double)$bal[$c-1],1,0,'C');
    //$this->vcell(20,6,170,(double)$qtyonhand,1,0,'C');
    $this->Ln();
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