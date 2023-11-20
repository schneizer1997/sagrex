<?php
/*ob_start();
ob_end_clean();*/
error_reporting(0);
include('../classes/inc/dbCon.php');
//require_once("http://localhost:8080/JavaBridge/java/Java.inc")
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//require_once("http://localhost:8080/JavaBridge/java/Java.inc");
include_once('phpjasperxml_0.9d/class/tcpdf/tcpdf.php');
include_once("phpjasperxml_0.9d/class/PHPJasperXML.inc.php");
//include_once("phpjasperxml_0.9d/class/PHPJasperXMLSubReport.inc.php");
//include('../classes/inc/dbCon.php'); 
/*include_once('PhpJasperLibrary/tcpdf/tcpdf.php');
include_once('PhpJasperLibrary/PHPJasperXML.inc.php')*/;
//include_once('PhpJasperLibrary/tcpdf/tcpdf.php');

$server = "localhost";
$user = "root";
$pass = "OSXVD2XSQk1PhOvD";
$db = "inventorydatabase";
$wew = 1;
//private $footerbandheight=0;
/*$mwrfid = $_GET['mwrfid1'];
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
$de = $_GET['de'];*/

//global $db;

$PHPJasperXML = new PHPJasperXML();

$PHPJasperXML->arrayParameter=array("item_id"=>$wew/*"mwrfid1"=>$mwrfid,"mwrfid"=>$mwrfid,"mwrfno"=>$mwrfno,"rt"=>$rt,"pn"=>$pn,"wt"=>$wt,"wv"=>$wv,"jc"=>$jc,"reptype"=>$rept,"pt"=>$pt,"it"=>$it,"bt"=>$bt,"ctd"=>$ctd,"tf"=>$tf,"df"=>$df,"pd"=>$pd,"pc"=>$pc,"ca"=>$ca,"pa"=>$pa,"remarks"=>$remarks,"rb"=>$rb,"dhm"=>$dhm,"d1"=>$d1,"d2"=>$d2,"d3"=>$d3,"st"=>$st,"sd"=>$sd,"ft"=>$ft,"fd"=>$fd,"rrb"=>$rrb,"rab"=>$rab,"tor"=>$tor,"tmh"=>$tmh,"wcb"=>$wcb,"rrno"=>$rrno,"ms"=>$ms,"requestor"=>$requestor,"field"=>$mwrfid*/);

$PHPJasperXML->load_xml_file("sample2.pdf");		

/*$conn = mysqli_connect($server,$user,$pass,$db);
$sql = "SELECT  *FROM tblrequestmaterials WHERE MWRFID = 1003";

$result = $conn->query($sql);

//$data=[];
if ($result->num_rows > 0 ){

		$data=[
			[
				'materials' => $row['Materials'],
				'quantity' => $row['Quantity'],
				'uprice' => $row['UnitPrice'],
				'amount' => $row['Amount'],	
			]
		];
		$PHPJasperXML->arraysqltable=$data;

		//var_dump($PHPJasperXML->arraysqltable);
}*/

//error_reporting(E_ALL);
$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db);

$PHPJasperXML->outpage("I");
//ob_end_flush();

?>
