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

$db="purchase_order";

$pass="OSXVD2XSQk1PhOvD";

$user="root";


$pono = strval($_GET['pono']);



/*$datefrom = date("m/d/y", strtotime("2022/03/16") );
$dateto = date("m/d/y", strtotime("2022/03/21") );*/
//date("Y-m-d", strtotime($var) );
$PHPJasperXML = new PHPJasperXML();
$PHPJasperXML->arrayParameter=array("po_no"=>$pono);
$xml = simplexml_load_file("purchasing/purchase_order_final.jrxml");

$PHPJasperXML->xml_dismantle($xml);

$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db);
$PHPJasperXML->outpage("I",date("dmYhis"));    //page output method I:standard output  D:Download file


?>
