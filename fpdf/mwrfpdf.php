<?php 
error_reporting(0);
require "fpdf.php";
//$db = new PDO('mysql:host=localhost;dbname=dx_requestform2','root','');
$server = "localhost";
$user = "root";
$pass = "OSXVD2XSQk1PhOvD";
$db = "dx_requestform";
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
        $mwrfid = $_GET['mwrfid1'];
        $this->image('logo2.png',10,3);
        $this->SetFont('Arial','B',20);
        $this->setTextColor(0,0,66);
        $this->Cell(200,0,'Maintenance Work Request Form',0,0,'C');
        $this->SetFont('Times','',8);
        $this->Cell(-50,-10,'MTC-F-00A-1.0/RF-"'.$mwrfid.'"',0,0,'C');
        //$this->Cell(-50,0,'sds',0,1);
        $this->Ln();
        $this->SetFont('Times','',12);
        $this->Cell(200,30,'SAGREX CORPORATION',0,0,'C');
        $this->Ln();
        $mwrfid = $_GET['mwrfid1'];
        $mwrfno = $_GET['mwrfno'];
        $rt = $_GET['rt'];
        $pn = $_GET['pn'];
        $wt = $_GET['wt'];
        $wv = $_GET['wv'];
        $jc = $_GET['jc'];
        $rept = $_GET['rept'];
        $pt = $_GET['pt'];
        $it = $_GET['it'];
        $bt = $_GET['bt'];
        $ctd = $_GET['ctd'];
        $tf = $_GET['tf'];
        $df = $_GET['df'];
        $pd = $_GET['pd'];
        $pc = $_GET['pc'];
        $ca = $_GET['ca'];
        $pa = $_GET['pa'];
        $remarks = $_GET['remarks'];
        $rb = $_GET['rb'];
        $dhm = $_GET['dhm'];
        $d1 = $_GET['d1'];
        $d2 = $_GET['d2'];
        $d3 = $_GET['d3'];
        $st = $_GET['st'];
        $sd = $_GET['sd'];
        $ft = $_GET['ft'];
        $fd = $_GET['fd'];
        $rrb = $_GET['rrb'];
        $rab = $_GET['rab'];
        $tor = $_GET['tor'];
        $tmh = $_GET['tmh'];
        $wcb = $_GET['wcb'];
        $rrno = $_GET['rrno'];
        $ms = $_GET['ms'];
        $requestor = $_GET['requestor'];
        $cmvb = $_GET['cmvb'];
        $da = $_GET['da'];
        $de = $_GET['de'];
        $this->SetFont('Arial','',8);
        $this->Cell(20  ,5,'MWRF No.:',0,0);
        $this->Cell(120  ,5,$mwrfno,0,0);
        $this->Cell(80   ,5,'Designated To:(Signature & Received Date)',0,1);//end of line
        //x tab,y tab ,value,isfield,nextline
        $this->Cell(25  ,5,'Request Type:',0,0);
        //$x=$this->getx();
        $this->myCell(35,5,45,$rt);
        //$this->Cell(30  ,5,$rt,0,0);
        
        $this->Cell(30,5,'Property Description:',0,0);
        $x=$this->getx();
        $this->myCell(40,5,$x,$pd,0);
        //$this->MultiAlignCell(40,5,$pd,1,'L',false);
        //$this->WordWrap('adfafafa',120);
        //$this->MultiCell(35,5,$pd,1,'L');//end of line
        //$this->MultiCell(40,3,"We declare " ,1,'L',false);
        $this->Cell(5, 5,'1:',0,0);//end
        $this->Cell(50,5,$d1,1,1); 

        $this->Cell(40,5,'Plate/Machine No.:',0,0);
        $this->myCell(35,5,45,$pn);
        //$this->Cell(30,5,$pn,0,0);
        $this->Cell(30,5,'Problem Cause:',0,0);
        $x=$this->getx();
        $this->myCell(40,5,$x,$pc);
        //$this->Cell(40,5,$pc,0,0);//end of line
        $this->Cell(5,5,'2:',0,0);//end
        $this->Cell(50,5,$d2,1,1);
        //$this->Cell(34,5,'[1234567]',0,1);

        /*$this->Cell(40,5,'Type of Transaction:',0,0);
        $this->myCell(35,5,45,$tor);*/
        $this->Cell(40,5,'Type of Transaction:',0,0);
        $this->myCell(35,5,45,$tor);
        //$this->Cell(30  ,5,$tor,0,0);

        /*$this->Cell(30   ,5,'Corrective Action:',0,0);
        $x=$this->getx();
        $this->myCell(40,5,$x,$ca);*/
        $this->Cell(30,5,'Remarks:',0,0);
        $x=$this->getx();
        $this->myCell(40,5,$x,$remarks);
        
        //$this->Cell(40,5,$ca,0,0);//end of line
        $this->Cell(5,5,'3:',0,0);//end
        $this->Cell(50,5,$d3,1,1);
        //$this->Cell(34   ,5,'[1234567]',0,1);//end of line

        $this->Cell(40  ,5,'Work Type',0,0);
        $this->myCell(35,5,45,$wt);
        //$this->Cell(30  ,5,$wt,0,0);
        /*$this->Cell(30,5,'Preventive Action:',0,0);
        $x=$this->getx();
        $this->myCell(40,5,$x,$pa);*/

        $this->Cell(30,5,'',0,0);
        $x=$this->getx();
        $this->myCell(40,5,$x,'');
        //$this->Cell(40,5,$pa,0,0);//end of line
        $this->Cell(20,5,'Start Time:',0,0);//end
        $this->Cell(80,5,$st,0,1);
        //$this->Cell(34   ,5,'[1234567]',0,1);//end of line
        /*$this->SetMargins(0,0,0);*/
        /*$this->SetLeftMargin(100);*/
        /*$this->cMargin = 20;*/
        $this->Cell(40,5,'          Work Venue:',0,0);
        $this->myCell(35,5,45,$wv);
        //$this->Cell(30  ,5,$wv,0,0);
        $this->Cell(30,5,'',0,0);
        $x=$this->getx();
        $this->myCell(40,12,$x,'');
        //$this->Cell(40,5,$remarks,0,0);//end of line
        $this->Cell(20,5,'Start Date:',0,0);//end
        $this->Cell(80,5,$sd,0,1);
        //$this->Cell(34   ,5,'',0,1);

        $this->Cell(40,5,'          Job Classification:',0,0);
        $this->myCell(35,5,45,$jc);
        //$this->Cell(30  ,5,$jc,0,0);
        $this->Cell(30   ,5,'',0,0);
        $this->Cell(40,5,'',0,0);//end of line
        $this->Cell(20,5,'Finish Time:',0,0);//end
        $this->Cell(80,5,$ft,0,1);
        //$this->Cell(34   ,5,'[1234567]',0,1);

        $this->Cell(40  ,5,'    Repair Type:',0,0);
        $this->myCell(35,5,45,$rept);
        //$this->Cell(30  ,5,$rept,0,0);
        $this->Cell(30   ,5,'',0,0);
        $this->Cell(40,5,'',0,0);//end of line
        $this->Cell(20,5,'Finish Date:',0,0);//end
        $this->Cell(80,5,$fd,0,1);
        //$this->Cell(34   ,5,'[1234567]',0,1);

        $this->Cell(40  ,5,'    PM Type:',0,0);
        $this->myCell(35,5,45,$pt);
        //$this->Cell(30  ,5,$pt,0,0);
        $this->Cell(30   ,5,'Time File:',0,0);
        $this->myCell(40,5,110,$tf);
        //$this->Cell(40   ,5,$tf,0,0);
        $this->Cell(20,5,'Request by:',0,0);//end
        $this->Cell(80,5,$rb,0,1);

        $this->Cell(40  ,5,'    Improvement Type:',0,0);
        $this->myCell(35,5,45,$it);
        //$this->Cell(30  ,5,$it,0,0);
        $this->Cell(30   ,5,'Date File:',0,0);
        $this->Cell(40   ,5,$df,0,0);
        $this->Cell(25,5,'Department Head:',0,0);//end
        $this->MultiCell(30,5,$dhm,0,1);

        $this->Cell(40  ,5,'    Breakdown Type:',0,0);
        $this->myCell(35,5,45,$bt);
        //$this->Cell(30  ,5,$bt,0,0);
        $this->Cell(30   ,5,'Type of Transaction:',0,0);
        $this->Cell(40   ,5,$tor,0,0);
        $this->Cell(20,5,'Received By:',0,0);//end
        $this->Cell(80,5,$rrb,0,1);

        $this->Cell(40  ,5,'Completion Target Date:',0,0);
        $this->myCell(35,5,45,$ctd);
        //$this->Cell(30  ,5,$ctd,0,0);
        $this->Cell(30   ,5,'Status:',0,0);
        $this->Cell(40   ,5,$ms,0,0);
        $this->Cell(30,5,'Request Approved by:',0,0);//end
        $this->Cell(80,5,$rab,0,1);
        $this->SetFont('Times','B',8);
        $this->setFillColor(0,0,66);
        $this->setTextColor(255,255,255);
        $this->Cell(195   ,5,'WORK REQUEST DETAILS',1,1,'L',1);
        

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
        $this->Cell($c_width,$c_height,'','LTRB',0,'L',0);
        }
        else{
            $this->SetX($x_axis);
            $this->Cell($c_width,$c_height,$text,'LTRB',0,'L',0);
        }
    }
    function headerTable(){
        $this->setTextColor(0,0,0);
        $this->SetFont('Times','B',8);
        $this->Cell(40,6,'Materials',1,0,'C');
        $this->Cell(15,6,'Qty',1,0,'C');
        $this->Cell(25,6,'U/P',1,0,'C');
        $this->Cell(25,6,'Amt',1,0,'C');
        $this->Cell(40,6,'Shop',1,0,'C');
        $this->Cell(30,6,'Transaction Type',1,0,'C');
        $this->Cell(20,6,'Status',1,0,'C');
        $this->Ln();
    }
     
    function viewTable($conn){
        $mwrfid = $_GET['mwrfid1'];
        $wcb = $_GET['wcb'];
        $cmvb = $_GET['cmvb'];
        $rab = $_GET['rab'];
        $tmh = $_GET['tmh'];
        
        $this->SetFont('Times','',8);
        $this->setTextColor(0,0,0);
        $this->setFillColor(255,255,255);

        $sql = "SELECT  *FROM tblrequestmaterials WHERE MWRFID = '".$mwrfid."'";
        $result = $conn->query($sql);
        $dTotalProfit = 0;
        if ($result->num_rows > 0 ){
            while ($row=$result->fetch_assoc()){
            
            
            //var_dump($dTotalProfit);
            //$this->Cell(40,5,$row['Materials'],1,0,'C');
            $this->vcell(40,6,10,$row['Materials'],1,0,'C');
            //$this->Cell(40,4,45,$row['Materials']);
            $this->Cell(15,6,$row['Quantity'],1,0,'C');
            if ($row['UnitPrice'] == 0.0000){
                $this->Cell(25,6,"",1,0,'C');
            }
            else {
            $this->Cell(25,6,$row['UnitPrice'],1,0,'C');    
            }
            if ($row['Amount'] == 0.0000){
                $this->Cell(25,6,"",1,0,'C');
            }
            else {
            $this->Cell(25,6,$row['Amount'],1,0,'C');    
            }
            //$this->MultiCell(35,4,$row['Shop'],1,0,'C');
            $this->vcell(40,6,115,$row['Shop'],1,0,'C');
            $this->Cell(30,6,$row['RequestType'],1,0,'C');
            if ($row['isdelete'] == 0){
                $this->Cell(20,6,'Cancelled',1,0,'C');
            }
            elseif($row['isdelete'] == 1) {
                $this->Cell(20,6,'Cleared',1,0,'C');
                $dTotalProfit = $dTotalProfit + (int)$row['Amount'];
            }
            else {
                $this->Cell(20,6,'',1,0,'C');
            }
            
            $this->Ln();
            }
        }
        
        $this->SetFont('Times','',8);
        $this->setTextColor(0,0,0);
        //$this->Line(200,10,11,11);
        $this->Cell(50   ,7,'Warehouse Checked by:',0,0);
        $this->Cell(50   ,7,'Completed MWRF Verified by:',0,0);
        $this->Cell(50   ,7,'Approved by:',0,0);
        //$this->Cell(25   ,7,'Total Man Hours:',0,0);
        $this->Cell(25   ,4,'',0,0);
        $this->Cell(30   ,4,'',0,1);
        $this->Cell(50   ,5,$wcb,0,0);
        $this->Cell(50   ,5,$cmvb,0,0);
        $this->Cell(50   ,5,$rab,0,0);
        $this->Cell(20   ,5,'Total Amount:',0,0);
        $this->Cell(20,5,number_format($dTotalProfit),0,0);
    }
    function dataforms(){
        
    }
}

$pdf = new myPDF();
$pdf->AliasNbPages();
$pagesize = array(107, 199);
$pdf->AddPage('L','A5',0);
$pdf->dataforms();
//$pdf->SetAutoPageBreak(true);;?
$pdf->headerTable();
$pdf->viewTable($conn);
$height_of_cell = 60; // mm
$page_height = 297/2; // mm (portrait letter)
$pdf->footer();
$pdf->Output();