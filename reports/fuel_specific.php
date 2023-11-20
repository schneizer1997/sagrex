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

/*$dbpurchasing= new mysqli($serverName3,$username3,$password3,$databaseName3);

 // var_dump($db);
if ($dbpurchasing1->connect_error){

    die ("Connection Failed ". $dbpurchasing1->connect_error);
    //echo "Connection Failed" ;

}*/
//ini_set('display_errors', 0);
$xml = simplexml_load_file("trythis.jrxml");
$platenos = strval($_GET['plateno']);
$appenddatefrom = date("YmdHis", strtotime($_GET['datefrom']));
$appenddateto = date("YmdHis", strtotime($_GET['dateto']));
$appenddatefromrange = $_GET['datefrom'];
$appenddatetorange = $_GET['dateto'];

$PHPJasperXML = new PHPJasperXML();
$PHPJasperXML->arrayParameter=array("platenumber"=>$platenos);
//var_dump($PHPJasperXML->arrayParameter=array("platenumber"=>$platenos));
$PHPJasperXML->xml_dismantle($xml);

$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db);
$PHPJasperXML->outpage("I");    //page output method I:standard output  D:Download file


?>
