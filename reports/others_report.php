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
$designation = strval($_GET['designation']);
$appenddatefrom = date("YmdHis", strtotime($_GET['datefrom']));
$appenddateto = date("YmdHis", strtotime($_GET['dateto']));
$appenddatefromrange = $_GET['datefrom'];
$appenddatetorange = $_GET['dateto'];
$appendcategory = $_GET['category'];
/*$appenddatefrom = date("Y-m-d", implode("-",array_reverse(explode("/",strtotime($_GET['dateto'])))));
$appenddateto = date("Y-m-d", str_replace('-"', '/', strtotime($_GET['dateto'])));*/
//$sample = new SimpleDateFormat("dd MMMM yyyy").format($_GET['datefrom']);
//die($appenddatefrom);
 //var_dump($appenddatefrom);
//new SimpleDateFormat("dd MMMM yyyy").format($F{report_date})
//var_dump($appenddatefrom . $appenddateto);
$id = "2";
/*$datefrom = '2022-03-16';
$dateto = '2022-03-21';*/
$datefrom = "2022-03-16";
$newDatefrom = date("d-m-Y", strtotime($appenddatefrom));

$WD1 = implode("-",array_reverse(explode("/",$_GET['datefrom'])));
$WD2 = implode("-",array_reverse(explode("/",$appenddateto)));
//var_dump($platenos);

$dateto = "2022-03-16";
$newDateto = date("d-m-Y", strtotime($appenddateto));

/*$datefrom = date("m/d/y", strtotime("2022/03/16") );
$dateto = date("m/d/y", strtotime("2022/03/21") );*/
//date("Y-m-d", strtotime($var) );
$PHPJasperXML = new PHPJasperXML();
$PHPJasperXML->arrayParameter=array("datefrom"=>$appenddatefrom,"dateto"=>$appenddateto,"datefromrange"=>$appenddatefromrange,"datetorange"=>$appenddatetorange,"designation"=>"'".$designation."'","category"=>"'".$appendcategory."'");
$xml = simplexml_load_file("others_report.jrxml");
/*if ($platenos != ' '){

}*/
/*else {
    $PHPJasperXML->arrayParameter=array("platenos"=>$platenos,"datefrom"=>$appenddatefrom,"dateto"=>$appenddateto);
    $xml = simplexml_load_file("fuel_report_specific.jrxml");
}*/

//$PHPJasperXML->debugsql=true;
//$PHPJasperXML->arrayParameter=array("fid"=>$id);

//$PHPJasperXML->arrayParameter=array("dateto"=>$_GET['dateto']);
//var_dump($PHPJasperXML->arrayParameter=array("datefrom"=>$appenddatefrom));
//$PHPJasperXML-> load_xml_file("fuel_info_v2.jrxml");
$PHPJasperXML->xml_dismantle($xml);

$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db);
$PHPJasperXML->outpage("I",date("dmYhis"));    //page output method I:standard output  D:Download file


?>
