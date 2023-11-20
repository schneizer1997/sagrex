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
//error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

$id = $_GET['id'];
$checkno = strval($_GET['checkno']);
$payto = strval($_GET['payto']);
$amount = strval($_GET['amount']);
$inwords = strval($_GET['inwords']);
$tdate = date("F d, Y", strtotime($_GET['tdate']));
$old_date = date('l, F d y h:i:s',$_GET['tdate']);              // returns Saturday, January 30 10 02:06:34
/*$old_date_timestamp = strtotime($old_date);
$new_date = date('Y-m-d H:i:s', $old_date_timestamp); */

//var_dump($tdate);



/*$datefrom = date("m/d/y", strtotime("2022/03/16") );
$dateto = date("m/d/y", strtotime("2022/03/21") );*/
//date("Y-m-d", strtotime($var) );
$PHPJasperXML = new PHPJasperXML();
$PHPJasperXML->arrayParameter=array("checkid"=>$id,"checkno"=>$checkno,"payto"=>'***'.$payto.'***',"amount"=>$amount,"inwords"=>$inwords,"tdate"=>$tdate);
$xml = simplexml_load_file("check_print_unsave.jrxml");

$PHPJasperXML->xml_dismantle($xml);
//var_dump($PHPJasperXML->arrayParameter);
//$PHPJasperXML-> load_xml_file("check_print_unsave.jrxml");

$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db);
$PHPJasperXML->outpage("I",date("dmYhis"));    //page output method I:standard output  D:Download file


?>
