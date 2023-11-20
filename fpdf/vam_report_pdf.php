<?php 
error_reporting(0);
require "fpdf.php";
//$db = new PDO('mysql:host=localhost;dbname=dx_requestform2','root','');
$server = "localhost";
$user = "root";
$pass = "OSXVD2XSQk1PhOvD";
$db = "purchasing2021";
$conn = mysqli_connect($server,$user,$pass,$db);

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
    function header(){
        //$mwrfid = $_GET['mwrfid1'];
        $this->image('logo2.png',45,3);
        $this->SetFont('Arial','B',20);
        $this->setTextColor(0,0,66);
        $this->Cell(200,0,'SAGREX CORPORATION',0,0,'C');
        $this->SetFont('Times','',8);
        //$this->Cell(-50,-10,'MTC-F-00A-1.0/RF-"'.$mwrfid.'"',0,0,'C');
        //$this->Cell(-50,0,'sds',0,1);
        $this->Ln();
        $this->SetFont('Times','',12);
        $this->Cell(200,30,'Km.8 Coaco Road, Barrio Pampanga, Davao City',0,0,'C');
        $this->Ln();
        $this->Cell(200,10,'Telephone No. (082) 234-0963 Fax No. (082) 234-6678',0,0,'C');
        $this->Ln();
        $this->Cell(200,30,'Email address: inquiry@sagrex.com',0,0,'C');
        $this->Ln();
        

    }
    function footer(){
        $this->SetY(-15);
        //$this->SetFont('Arial','',8);
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
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
        $this->Cell($c_width,$c_height,'','LTRB',0,'P',0);
        }
        else{
            $this->SetX($x_axis);
            $this->Cell($c_width,$c_height,$text,'LTRB',0,'L',0);
        }
    }
    function headerTable(){
        $this->setTextColor(0,0,0);
        $this->SetFont('Times','B',8);
        $this->Cell(20,6,'PLATE NO.',1,0,'C');
        $this->Cell(30,6,'ASSIGNEE',1,0,'C');
        $this->Cell(30,6,'DATE',1,0,'C');
        $this->Cell(25,6,'UNIT',1,0,'C');
        $this->Cell(25,6,'QTY',1,0,'C');
        $this->Cell(25,6,'PRICE',1,0,'C');
        $this->Cell(25,6,'AMOUNT',1,0,'C');
        
        $this->Ln();
    }
     
    function viewTable($conn){
       /* $mwrfid = $_GET['mwrfid1'];
        $wcb = $_GET['wcb'];
        $cmvb = $_GET['cmvb'];
        $rab = $_GET['rab'];
        $tmh = $_GET['tmh'];*/
        
        $this->SetFont('Times','',8);
        $this->setTextColor(0,0,0);
        $this->setFillColor(255,255,255);

        $sql = "SELECT  *FROM vehicle_info";
        $result = $conn->query($sql);
        $dTotalProfit = 0;
        if ($result->num_rows > 0 ){
            while ($row=$result->fetch_assoc()){
            
            
            //var_dump($dTotalProfit);
            //$this->Cell(40,5,$row['Materials'],1,0,'C');
            $this->vcell(20,6,10,$row['plate_id'],1,0,'C');
            //$this->Cell(40,4,45,$row['Materials']);
            $this->Cell(30,6,$row['assign_name'],1,0,'C');
            $this->vcell(30,6,60,$row['po_date'],1,0,'C');
            $this->Cell(25,6,$row['unit'],1,0,'C');
            if ($row['qty'] == 0.0000){
                $this->Cell(25,6,"",1,0,'C');
            }
            else {
            $this->Cell(25,6,$row['qty'],1,0,'C');    
            }

            if ($row['price'] == 0.0000){
                $this->Cell(25,6,"",1,0,'C');
            }
            else {
            $this->Cell(25,6,$row['price'],1,0,'C');    
            }
            if ($row['amount'] == 0.0000){
                $this->Cell(25,6,"",1,0,'C');
            }
            else {
            $this->Cell(25,6,$row['amount'],1,0,'C');    
            }
            //$this->MultiCell(35,4,$row['Shop'],1,0,'C');
            
            
            //$this->Cell(20,6,$row['amount'],1,0,'C');
            /*if ($row['isdelete'] == 0){
                $this->Cell(20,6,'Cancelled',1,0,'C');
            }
            elseif($row['isdelete'] == 1) {
                $this->Cell(20,6,'Cleared',1,0,'C');
                $dTotalProfit = $dTotalProfit + (int)$row['Amount'];
            }
            else {
                $this->Cell(20,6,'',1,0,'C');
            }*/
            
            $this->Ln();
            }
        }
        
        $this->SetFont('Times','',8);
        $this->setTextColor(0,0,0);
        //$this->Line(200,10,11,11);
       /* $this->Cell(50   ,7,'Warehouse Checked by:',0,0);
        $this->Cell(50   ,7,'Completed MWRF Verified by:',0,0);
        $this->Cell(50   ,7,'Approved by:',0,0);*/
        //$this->Cell(25   ,7,'Total Man Hours:',0,0);
        $this->Cell(25   ,4,'',0,0);
        $this->Cell(30   ,4,'',0,1);
        /*$this->Cell(50   ,5,$wcb,0,0);
        $this->Cell(50   ,5,$cmvb,0,0);
        $this->Cell(50   ,5,$rab,0,0);
        $this->Cell(20   ,5,'Total Amount:',0,0);
        $this->Cell(20,5,number_format($dTotalProfit),0,0);*/
    }
    function dataforms(){
        
    }
}

$pdf = new myPDF();
$pdf->AliasNbPages();
$pagesize = array(107, 199);
$pdf->AddPage('P','A4',0);
$pdf->dataforms();
//$pdf->SetAutoPageBreak(true);;
$pdf->headerTable();
$pdf->viewTable($conn);
$height_of_cell = 60; // mm
$page_height = 297/2; // mm (portrait letter)
$pdf->footer();
$pdf->Output();