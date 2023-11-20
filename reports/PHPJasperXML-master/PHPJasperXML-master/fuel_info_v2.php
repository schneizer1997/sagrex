<?php
error_reporting(0);
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once('PHPJasperXML-master/PHPJasperXML-master/class/tcpdf/tcpdf.php');
include_once("PHPJasperXML-master/PHPJasperXML-master/class/PHPJasperXML.inc.php");
/*include_once ('setting.php');*/


$server="localhost";

$db="purchasing2021";

$pass="OSXVD2XSQk1PhOvD";

$user="root";


$id = "1";

$PHPJasperXML = new PHPJasperXML();
//$PHPJasperXML->debugsql=true;
$PHPJasperXML->arrayParameter=array("fid"=>$id);

$PHPJasperXML-> load_xml_file("fuel_info_v2.jrxml");
/*$PHPJasperXML->xml_dismantle($xml);*/

$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db);
$PHPJasperXML->outpage("I");    //page output method I:standard output  D:Download file


?>
