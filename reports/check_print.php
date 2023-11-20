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

$db="acctng_cheque";

$pass="OSXVD2XSQk1PhOvD";

$user="root";


$checkid = strval($_GET['id']);



/*$datefrom = date("m/d/y", strtotime("2022/03/16") );
$dateto = date("m/d/y", strtotime("2022/03/21") );*/
//date("Y-m-d", strtotime($var) );
$PHPJasperXML = new PHPJasperXML();
$PHPJasperXML->arrayParameter=array("checkid"=>$checkid);
$xml = simplexml_load_file("check_print.jrxml");

$PHPJasperXML->xml_dismantle($xml);

$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db);
$PHPJasperXML->outpage("I",date("dmYhis"));    //page output method I:standard output  D:Download file


?>
