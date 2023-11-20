<?php
error_reporting(0);
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once('PHPJasperXML-master/PHPJasperXML-master/class/tcpdf/tcpdf.php');
include_once("PHPJasperXML-master/PHPJasperXML-master/class/PHPJasperXML.inc.php");
include_once ('setting.php');


$server="localhost";

$db="dx_requestform";

$pass="OSXVD2XSQk1PhOvD";

$user="root";


//$sampleid = "dad";

$mwrfid = $_GET['mwrfid1'];

//$xml =  simplexml_load_file("fuelreport.jrxml");
$PHPJasperXML = new PHPJasperXML();
//$PHPJasperXML->debugsql=true;
$PHPJasperXML->arrayParameter=array("id"=>$mwrfid);
//$PHPJasperXML->arrayParameter=array("parameter1"=>$value);
$PHPJasperXML->load_xml_file("mwrf_final.jrxml");
$PHPJasperXML->xml_dismantle($xml);

$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db);
$PHPJasperXML->outpage("I",date("dmYhis"));    //page output method I:standard output  D:Download file


?>
