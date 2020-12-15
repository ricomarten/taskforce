<?php
 require_once 'Classes/PHPExcel.php';
 require_once 'Classes/PHPExcel/IOFactory.php';
 error_reporting(0);
//      $serverName = "10.0.37.55"; //serverName\instanceName
//      $connectionInfo = array( "Database"=>"dukcapil",
//                                  "UID" => "dukcapil",
//                                  "PWD" => "tarikdata2019");

// $conn = sqlsrv_connect( $serverName, $connectionInfo);
// if( !$conn ) {
//     die( print_r( sqlsrv_errors(), true));
// }
 //require_once("codelibrary/inc/variables.php");//to connect to database and some core functions



// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator("RN Kushwaha")
       ->setLastModifiedBy("Aryan")
       ->setTitle("Reports")
       ->setSubject("Excel Turorials")
       ->setDescription("Test document ")
       ->setKeywords("phpExcel")
       ->setCategory("Test file");
       
// Create a first sheet, representing sales data
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'ID');
$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Name');
$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Email');
$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Phone');

// $n=2;
// $qry= sqlsrv_query($conn,"select * from tb_user ");
// while($d= sqlsrv_fetch_array($qry, SQLSRV_FETCH_ASSOC)){
//  $objPHPExcel->getActiveSheet()->setCellValue('A'.$n, $d['nama']);
//  $objPHPExcel->getActiveSheet()->setCellValue('B'.$n, $d['username']);
//  $objPHPExcel->getActiveSheet()->setCellValue('C'.$n, $d['password']);
//  $objPHPExcel->getActiveSheet()->setCellValue('D'.$n, $d['level']);
//    $n++;
// }               
               
// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Agents');

// Create a new worksheet, after the default sheet
$objPHPExcel->createSheet();

// Add some data to the second sheet, resembling some different data types
$objPHPExcel->setActiveSheetIndex(1);
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'ID');
$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Title');
$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Email');
$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Phone No');

// $n=2;
// $qry=sqlsrv_query($conn,"select * from tb_user ");
// while($d= sqlsrv_fetch_array($qry, SQLSRV_FETCH_ASSOC)){
//  $objPHPExcel->getActiveSheet()->setCellValue('A'.$n, $d['nama']);
//  $objPHPExcel->getActiveSheet()->setCellValue('B'.$n, $d['username']);
//  $objPHPExcel->getActiveSheet()->setCellValue('C'.$n, $d['password']);
//  $objPHPExcel->getActiveSheet()->setCellValue('D'.$n, $d['level']);
// $n++;
// }      

// Rename 2nd sheet
$objPHPExcel->getActiveSheet()->setTitle('Technician');

// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="data.xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');

?>