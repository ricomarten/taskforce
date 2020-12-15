<?php
require_once 'PHPExcel/Classes/PHPExcel.php';
require_once 'PHPExcel/Classes/PHPExcel/IOFactory.php';
include 'koneksi.php';
error_reporting(0);
$kolom = array( 0=>'A',
1 => 'B',2 => 'C', 3 => 'D', 4 => 'E', 5 => 'F', 6 => 'G', 7 => 'H', 8 => 'I', 9 => 'J', 10 => 'K', 11 => 'L', 12 => 'M',
13 => 'N',14 => 'O',15 => 'P',16 => 'Q',17 => 'R',18 => 'S',19 => 'T',20 => 'U',21 => 'V',22 => 'W',23 => 'X',24 => 'Y',25 => 'Z');

$arr=[];
$n=1;
$kol=0;

$kegiatan=          $_GET['kegiatan'];
$cekWilayah =       $_GET['cekWilayah'];
$wilayah =          $_GET['wilayah'];
$cekKlasifikasi =   $_GET['cekKlasifikasi'];
$klasifikasi=       $_GET['klasifikasi'];
$kodeklasifikasi=   $_GET['kodeklasifikasi'];
$cekKomoditas =     $_GET['cekKomoditas'];
$komoditas=         $_GET['komoditas'];
$kodekomoditas=     $_GET['kodekomoditas'];
$cekTransaksi =     $_GET['cekTransaksi'];
$transaksi=         $_GET['transaksi'];
$kodetransaksi=     $_GET['kodetransaksi'];
$cekInstitusi =     $_GET['cekInstitusi'];
$institusi=         $_GET['institusi'];
$kodeinstitusi=     $_GET['kodeinstitusi'];
$cekKuantitas =     $_GET['cekKuantitas'];
$kuantitas=         $_GET['kuantitas'];
$cekSeries =        $_GET['cekSeries'];
$series =           $_GET['series'];
$periode =          $_GET['periode'];

$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator("Rico")
       ->setLastModifiedBy("Rico")
       ->setTitle("Excel Template")
       ->setSubject("Excel Template")
       ->setDescription("Excel Template")
       ->setKeywords("phpExcel")
       ->setCategory("Excel Template");
       
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn('A')->setAutoSize(true);
//kegiatan

// $text="kegiatan=".$kegiatan.
//     "&cekKlasifikasi=".$cekKlasifikasi.
//     "&cekKomoditas=".$cekKomoditas.
//     "&cekTransaksi=".$cekTransaksi.
//     "&cekInstitusi=".$cekInstitusi.
//     "&cekKuantitas=".$cekKuantitas.               
//     "&cekSeries=".$cekSeries.
//     "&klasifikasi=".$klasifikasi.
//     "&kodeklasifikasi=".$kodeklasifikasi.
//     "&komoditas=".$komoditas.
//     "&kodekomoditas=".$kodekomoditas.
//     "&transaksi=".$transaksi.
//     "&institusi=".$institusi.
//     "&kuantitas=".$kuantitas.
//     "&series=".$series.
//     "&periode=".$periode;
//kodeidentitas= [keg]#[W][L][D][T][I][K][S]#
$text=$kegiatan.
    "#".$cekWilayah.$cekKlasifikasi.$cekKomoditas.$cekTransaksi.$cekInstitusi.$cekKuantitas.$cekSeries.
    "#".$wilayah.
    "#".$klasifikasi.
    "#".$kodeklasifikasi.
    "#".$komoditas.
    "#".$kodekomoditas.
    "#".$transaksi.
    "#".$kodetransaksi.
    "#".$institusi.
    "#".$kodeinstitusi.
    "#".$kuantitas.
    "#".$series.
    "#".$periode;

$objPHPExcel->getActiveSheet()->setCellValue('A'.$n, 'kode Identitas: ');
$objPHPExcel->getActiveSheet()->setCellValue('B'.$n, $text);   
$n++;
$objPHPExcel->getActiveSheet()->setCellValue('A'.$n, 'Template Statistik: ');
$objPHPExcel->getActiveSheet()->getStyle('A'.($n))->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->setCellValue('B'.$n, $kegiatan);
$n++;
$objPHPExcel->getActiveSheet()->getRowDimension(1)->setVisible(false);
//wilayah
if($cekWilayah=='1'){
    $sql_query=sqlsrv_query($conn, "SELECT * from c.AdministrativeArea where AdministrativeAreaCode='$wilayah'");
    
    $data=sqlsrv_fetch_array($sql_query,SQLSRV_FETCH_ASSOC);
    $objPHPExcel->getActiveSheet()->setCellValue('A'.$n, 'Kode Wilayah Administrasi: ');
    $objPHPExcel->getActiveSheet()->getStyle('A'.($n))->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->setCellValue('C'.$n, '['.$data['AdministrativeAreaCode'].']'.$data['AdministrativeAreaName']);
    $n++;
}else{
    array_push($arr,"Kode Wilayah Administrasi");
    $kol++;
}
//klasifikasi
if($cekKlasifikasi=='1'){
    $sql_query=sqlsrv_query($conn, "SELECT
    c.Classification.ClassificationName,
    c.Code.CategoryCode,
    c.Code.Code,
    c.Code.CodeName 
    FROM
    c.Code
    INNER JOIN c.Classification ON c.Code.ClassificationID = c.Classification.ClassificationID
    where Code='".$kodeklasifikasi."' and  c.Code.ClassificationID='".$klasifikasi."'");
    $data=sqlsrv_fetch_array($sql_query,SQLSRV_FETCH_ASSOC);
    $objPHPExcel->getActiveSheet()->setCellValue('A'.$n, 'Klasifikasi Lapangan Usaha: ');
    $objPHPExcel->getActiveSheet()->getStyle('A'.($n))->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->setCellValue('B'.$n, $data['ClassificationName']);
    $objPHPExcel->getActiveSheet()->setCellValue('C'.$n, '['.$data['Code'].']'.$data['CodeName']);
    $n++;
}else{
    array_push($arr,"Klasifikasi Lapangan Usaha");
    $sql=sqlsrv_query($conn, "SELECT *
    FROM
    c.Classification
    WHERE StatisticalDomainID = '14'");
    $isi_kbli='"';
    while($datakbli=sqlsrv_fetch_array($sql,SQLSRV_FETCH_ASSOC)){
        $isi_kbli.=$datakbli['ClassificationName'].",";
    }
    $isi_kbli=substr($isi_kbli, 0, -1);
    $isi_kbli.='"';
    $kol_kbli=$kol;
    $kol++;
    array_push($arr,"Kode Lapangan Usaha");
    $kol++;
}
//komoditas
if($cekKomoditas=='1'){
    $sql_query=sqlsrv_query($conn, "SELECT
    c.Classification.ClassificationName,
    c.Code.CategoryCode,
    c.Code.Code,
    c.Code.CodeName 
    FROM
    c.Code
    INNER JOIN c.Classification ON c.Code.ClassificationID = c.Classification.ClassificationID
    where Code='".$kodekomoditas."' and  c.Code.ClassificationID='".$komoditas."'");
    $data=sqlsrv_fetch_array($sql_query,SQLSRV_FETCH_ASSOC);
    $objPHPExcel->getActiveSheet()->setCellValue('A'.$n, 'Klasifikasi Komoditas: ');
    $objPHPExcel->getActiveSheet()->getStyle('A'.($n))->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->setCellValue('B'.$n, $data['ClassificationName']);
    $objPHPExcel->getActiveSheet()->setCellValue('C'.$n, '['.$data['Code'].']'.$data['CodeName']);   
    $n++;
}else{
    array_push($arr,"Klasifikasi Komoditas");
    $sql=sqlsrv_query($conn, "SELECT *
    FROM
    c.Classification
    WHERE StatisticalDomainID = '15'");
    $isi_komoditas='"';
    while($datakbli=sqlsrv_fetch_array($sql,SQLSRV_FETCH_ASSOC)){
        $isi_komoditas.=$datakbli['ClassificationName'].",";
    }
    $isi_komoditas=substr($isi_komoditas, 0, -1);
    $isi_komoditas.='"';
    $kol_komoditas=$kol;   
    $kol++;
    array_push($arr,"Kode Komoditas");
    $kol++;
}
//tramsaksi
if($cekTransaksi=='1'){
    $sql_query=sqlsrv_query($conn, "SELECT
    c.Classification.ClassificationName,
    c.Code.CategoryCode,
    c.Code.Code,
    c.Code.CodeName 
    FROM
    c.Code
    INNER JOIN c.Classification ON c.Code.ClassificationID = c.Classification.ClassificationID
    where Code='".$kodetransaksi."' and  c.Code.ClassificationID='".$transaksi."'");
    $data=sqlsrv_fetch_array($sql_query,SQLSRV_FETCH_ASSOC);
    $objPHPExcel->getActiveSheet()->setCellValue('A'.$n, 'Jenis Transaksi: ');
    $objPHPExcel->getActiveSheet()->getStyle('A'.($n))->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->setCellValue('B'.$n, $data['ClassificationName']);
    $objPHPExcel->getActiveSheet()->setCellValue('C'.$n, '['.$data['Code'].']'.$data['CodeName']);
   
    $n++;
}else{
    array_push($arr,"Klasifikasi Transaksi");
    $sql=sqlsrv_query($conn, "SELECT *
    FROM
    c.Classification
    WHERE StatisticalDomainID = '16'");
    $isi_transaksi='"';
    while($datakbli=sqlsrv_fetch_array($sql,SQLSRV_FETCH_ASSOC)){
        $isi_transaksi.=$datakbli['ClassificationName'].",";
    }
    $isi_transaksi=substr($isi_transaksi, 0, -1);
    $isi_transaksi.='"';
    $kol_transaksi=$kol;    
    $kol++;
    array_push($arr,"Kode Transaksi");
    $kol++;
}
//institusi
if($cekInstitusi=='1'){
    $sql_query=sqlsrv_query($conn, "SELECT
    c.Classification.ClassificationName,
    c.Code.CategoryCode,
    c.Code.Code,
    c.Code.CodeName 
    FROM
    c.Code
    INNER JOIN c.Classification ON c.Code.ClassificationID = c.Classification.ClassificationID
    where Code='".$kodeinstitusi."' and  c.Code.ClassificationID='".$institusi."'");
    $data=sqlsrv_fetch_array($sql_query,SQLSRV_FETCH_ASSOC);
    $objPHPExcel->getActiveSheet()->setCellValue('A'.$n, 'Sektor Institusi: ');
    $objPHPExcel->getActiveSheet()->getStyle('A'.($n))->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->setCellValue('B'.$n, $data['ClassificationName']);
    $objPHPExcel->getActiveSheet()->setCellValue('C'.$n, '['.$data['Code'].']'.$data['CodeName']);
   
    $n++;
}else{
    array_push($arr,"Klasifikasi Sektor Institusi");
    $sql=sqlsrv_query($conn, "SELECT *
    FROM
    c.Classification
    WHERE StatisticalDomainID = '17'");
    $isi_institusi='"';
    while($datakbli=sqlsrv_fetch_array($sql,SQLSRV_FETCH_ASSOC)){
        $isi_institusi.=$datakbli['ClassificationName'].",";
    }
    $isi_institusi=substr($isi_institusi, 0, -1);
    $isi_institusi.='"';
    $kol_institusi=$kol;   
    $kol++;
    array_push($arr,"Kode Sektor Institusi");
    $kol++;
}
//kuantitas
if($cekKuantitas=='1'){
    $sql_query=sqlsrv_query($conn, "SELECT * from c.Measurement where MeasurementID='".$kuantitas."'");
    $data=sqlsrv_fetch_array($sql_query,SQLSRV_FETCH_ASSOC);
    $objPHPExcel->getActiveSheet()->setCellValue('A'.$n, 'Ukuran Kuantitas: ');
    $objPHPExcel->getActiveSheet()->getStyle('A'.($n))->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->setCellValue('C'.$n, '['.$data['MeasurementID'].']'.$data['NationalAccountMeasurementName']);
   
    $n++;
    $sql=sqlsrv_query($conn, "SELECT
    c.Unit.UnitID,
    c.Unit.UnitName,
    c.Unit.UnitSymbol,
    c.Unit.ParentUnitID,
    c.Unit.MultiplierFactor,
    c.Unit.UnitPredicate,
    c.Unit.MeasurementID,
    c.Measurement.MeasurementName,
    c.MeasurementType.MeasurementTypeName

    FROM
    c.Unit
    INNER JOIN c.Measurement ON c.Unit.MeasurementID = c.Measurement.MeasurementID
    INNER JOIN c.MeasurementType ON c.Measurement.MeasurementTypeID = c.MeasurementType.MeasurementTypeID
    where 
    Unit.MeasurementID='".$kuantitas."'");
    $isi_kuantitas='"';
    while($datakuantitas=sqlsrv_fetch_array($sql,SQLSRV_FETCH_ASSOC)){
        $isi_kuantitas.=$datakuantitas['UnitName'].",";
    }
    $isi_kuantitas=substr($isi_kuantitas, 0, -1);
    $isi_kuantitas.='"';
}else{
    $sql=sqlsrv_query($conn, "SELECT
    c.Unit.UnitID,
    c.Unit.UnitName,
    c.Unit.UnitSymbol,
    c.Unit.ParentUnitID,
    c.Unit.MultiplierFactor,
    c.Unit.UnitPredicate,
    c.Unit.MeasurementID,
    c.Measurement.MeasurementName,
    c.MeasurementType.MeasurementTypeName

    FROM
    c.Unit
    INNER JOIN c.Measurement ON c.Unit.MeasurementID = c.Measurement.MeasurementID
    INNER JOIN c.MeasurementType ON c.Measurement.MeasurementTypeID = c.MeasurementType.MeasurementTypeID");
    $isi_kuantitas='"';
    while($datakuantitas=sqlsrv_fetch_array($sql,SQLSRV_FETCH_ASSOC)){
        $isi_kuantitas.=$datakuantitas['UnitName'].",";
    }
    $isi_kuantitas=substr($isi_kuantitas, 0, -1);
    $isi_kuantitas.='"';
    
    //kuantitas_2 pilihan jenis kuantitasnya
    $qry2=sqlsrv_query($conn,"SELECT
    c.Measurement.MeasurementID,
    c.Measurement.MeasurementName,
    c.Measurement.NationalAccountMeasurementName,
    c.Measurement.MeasurementTypeID,
    c.MeasurementType.MeasurementTypeName
    FROM  c.Measurement
    INNER JOIN c.MeasurementType ON c.Measurement.MeasurementTypeID = c.MeasurementType.MeasurementTypeID");
    $isi_kuantitas2='"';
    while($datakuantitas2= sqlsrv_fetch_array($qry2, SQLSRV_FETCH_ASSOC)){
        $isi_kuantitas2.=$datakuantitas2['NationalAccountMeasurementName'].",";
    }  
    $isi_kuantitas2=substr($isi_kuantitas2, 0, -1);
    $isi_kuantitas2.='"';
    $kol_kuantitas=$kol; 

    array_push($arr,"Ukuran Kuantitas");
    $kol++;
}
//series
if($cekSeries=='1'){
    $sql_query=sqlsrv_query($conn, "SELECT * from c.DataSeries where DataSeriesCode='".$series."'");
    $data=sqlsrv_fetch_array($sql_query,SQLSRV_FETCH_ASSOC);
    $objPHPExcel->getActiveSheet()->setCellValue('A'.$n, 'Series Data: ');
    $objPHPExcel->getActiveSheet()->getStyle('A'.($n))->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->setCellValue('C'.$n, '['.$data['DataSeriesCode'].']'.$data['DataSeriesName']);
    $n++;
    $objPHPExcel->getActiveSheet()->setCellValue('A'.$n, 'Periode Data: ');
    $objPHPExcel->getActiveSheet()->getStyle('A'.($n))->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->setCellValue('C'.$n, $periode);
    $n++;
}else{
    array_push($arr,"Series Data");
    $sql=sqlsrv_query($conn, "SELECT
    c.DataSeries.DataSeriesID,
    c.DataSeries.DataSeriesCode,
    c.DataSeries.DataSeriesName,
    c.DataSeries.Description
    
    FROM
    c.DataSeries");
    $isi_series='"';
    while($datakbli=sqlsrv_fetch_array($sql,SQLSRV_FETCH_ASSOC)){
        $isi_series.=$datakbli['DataSeriesName'].",";
    }
    $isi_series=substr($isi_series, 0, -1);
    $isi_series.='"';
    $kol_series=$kol;  
    
    $kolomperiode=$kol+1;
    array_push($arr,"Periode Data");
    array_push($arr,"Tahun Data");
    $kol=$kol+3;
}
array_push($arr,"Nilai","Satuan");
for($i=0;$i<count($arr);$i++){
    $objPHPExcel->getActiveSheet()->setCellValue($kolom[$i].($n+1), $arr[$i]);
    if($i<>0)
    $objPHPExcel->getActiveSheet()->getColumnDimension($kolom[$i])->setWidth(20);
}
//judul
$objPHPExcel->getActiveSheet()->getStyle($kolom[0].($n+1).':'.$kolom[$i].($n+1))->getFont()->setBold(true);

if($cekSeries=='2'){
    //$objPHPExcel->getActiveSheet()->getStyle($kolom[$kolomperiode])->getNumberFormat()->setFormatCode('dd-mmm-yyyy');
    $objPHPExcel->getActiveSheet()->setCellValue($kolom[$kolomperiode].($n+2), 'MM-DD-YYYY');
    $objPHPExcel->getActiveSheet()->getStyle($kolom[$kolomperiode].($n+2))->getFont()->setItalic(true);
}

//set dropdown
for ($j = ($n+2); $j <= 250; $j++){
    $objValidation2 = $objPHPExcel->getActiveSheet()->getCell($kolom[($kol+1)] . $j)->getDataValidation();
    $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
    $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
    $objValidation2->setAllowBlank(false);
    $objValidation2->setShowInputMessage(true);
    $objValidation2->setShowDropDown(true);
    $objValidation2->setPromptTitle('Pilih satuan');
    $objValidation2->setPrompt('Siahkan pilih satuan dari dropdown yang disediakan.');
    $objValidation2->setErrorTitle('Input error');
    $objValidation2->setError('Value is not in list');
    $objValidation2->setFormula1(''.$isi_kuantitas.'');
}
//ISI pilihan lapangan usaha
if($isi_kbli<>''){
    for ($j = ($n+2); $j <= 250; $j++){
        $objValidation2 = $objPHPExcel->getActiveSheet()->getCell($kolom[($kol_kbli)] . $j)->getDataValidation();
        $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
        $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
        $objValidation2->setAllowBlank(false);
        $objValidation2->setShowInputMessage(true);
        $objValidation2->setShowDropDown(true);
        $objValidation2->setPromptTitle('Pilih Klasifikasi Lapangan Usaha');
        $objValidation2->setPrompt('Siahkan pilih Klasifikasi Lapangan Usaha dari dropdown yang disediakan.');
        $objValidation2->setErrorTitle('Input error');
        $objValidation2->setError('Value is not in list');
        $objValidation2->setFormula1(''.$isi_kbli.'');
    } 
}
if($isi_komoditas<>''){
    for ($j = ($n+2); $j <= 250; $j++){
        $objValidation2 = $objPHPExcel->getActiveSheet()->getCell($kolom[($kol_komoditas)] . $j)->getDataValidation();
        $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
        $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
        $objValidation2->setAllowBlank(false);
        $objValidation2->setShowInputMessage(true);
        $objValidation2->setShowDropDown(true);
        $objValidation2->setPromptTitle('Pilih Klasifikasi Komoditas');
        $objValidation2->setPrompt('Siahkan pilih Klasifikasi Komoditas dari dropdown yang disediakan.');
        $objValidation2->setErrorTitle('Input error');
        $objValidation2->setError('Value is not in list');
        $objValidation2->setFormula1(''.$isi_komoditas.'');
    }
}
if($isi_transaksi<>''){
    for ($j = ($n+2); $j <= 250; $j++){
        $objValidation2 = $objPHPExcel->getActiveSheet()->getCell($kolom[($kol_transaksi)] . $j)->getDataValidation();
        $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
        $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
        $objValidation2->setAllowBlank(false);
        $objValidation2->setShowInputMessage(true);
        $objValidation2->setShowDropDown(true);
        $objValidation2->setPromptTitle('Pilih Klasifikasi Transaksi');
        $objValidation2->setPrompt('Siahkan pilih Klasifikasi Transaksi dari dropdown yang disediakan.');
        $objValidation2->setErrorTitle('Input error');
        $objValidation2->setError('Value is not in list');
        $objValidation2->setFormula1(''.$isi_transaksi.'');
    }
}
if($isi_institusi<>''){
    for ($j = ($n+2); $j <= 250; $j++){
        $objValidation2 = $objPHPExcel->getActiveSheet()->getCell($kolom[($kol_institusi)] . $j)->getDataValidation();
        $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
        $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
        $objValidation2->setAllowBlank(false);
        $objValidation2->setShowInputMessage(true);
        $objValidation2->setShowDropDown(true);
        $objValidation2->setPromptTitle('Pilih Klasifikasi Sektor Institusi');
        $objValidation2->setPrompt('Siahkan pilih Klasifikasi Sektor Institusi dari dropdown yang disediakan.');
        $objValidation2->setErrorTitle('Input error');
        $objValidation2->setError('Value is not in list');
        $objValidation2->setFormula1(''.$isi_institusi.'');
    }
}
if($isi_kuantitas2<>''){
    for ($j = ($n+2); $j <= 250; $j++){
        $objValidation2 = $objPHPExcel->getActiveSheet()->getCell($kolom[($kol_kuantitas)] . $j)->getDataValidation();
        $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
        $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
        $objValidation2->setAllowBlank(false);
        $objValidation2->setShowInputMessage(true);
        $objValidation2->setShowDropDown(true);
        $objValidation2->setPromptTitle('Pilih Ukuran Kuantitas Data');
        $objValidation2->setPrompt('Siahkan pilih Ukuran Kuantitas Data dari dropdown yang disediakan.');
        $objValidation2->setErrorTitle('Input error');
        $objValidation2->setError('Value is not in list');
        $objValidation2->setFormula1(''.$isi_kuantitas2.'');
    }
}
if($isi_series<>''){
    for ($j = ($n+2); $j <= 250; $j++){
        $objValidation2 = $objPHPExcel->getActiveSheet()->getCell($kolom[($kol_series)] . $j)->getDataValidation();
        $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
        $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
        $objValidation2->setAllowBlank(false);
        $objValidation2->setShowInputMessage(true);
        $objValidation2->setShowDropDown(true);
        $objValidation2->setPromptTitle('Pilih Series Data');
        $objValidation2->setPrompt('Siahkan pilih Series Data dari dropdown yang disediakan.');
        $objValidation2->setErrorTitle('Input error');
        $objValidation2->setError('Value is not in list');
        $objValidation2->setFormula1(''.$isi_series.'');
    }
}
$objPHPExcel->getActiveSheet()->setTitle('Template Data');

$indek=0;
if($cekWilayah=='2'){
    //tambah sheet master wilayah
    $indek++;
    $objPHPExcel->createSheet();
    $objPHPExcel->setActiveSheetIndex($indek);
    $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn('A')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getStyle('A1:B1')->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Kode');
    $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Nama');
    $objPHPExcel->getActiveSheet()->setAutoFilter('A1:B1');
    $n=2;
    $qry=sqlsrv_query($conn,"SELECT * FROM c.AdministrativeArea");
    while($d= sqlsrv_fetch_array($qry, SQLSRV_FETCH_ASSOC)){
        $objPHPExcel->getActiveSheet()->setCellValue('A'.$n, $d['AdministrativeAreaCode']);
        $objPHPExcel->getActiveSheet()->getStyle('A'.$n)->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
        $objPHPExcel->getActiveSheet()->setCellValue('B'.$n, $d['AdministrativeAreaName']);
        $n++;
    }      
    $objPHPExcel->getActiveSheet()->setTitle('Kode Wilayah Administrasi');
}
// sheet Klasifikasi
if($cekKlasifikasi=='2'){
    $indek++;
    $objPHPExcel->createSheet();
    $objPHPExcel->setActiveSheetIndex($indek);
    $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn('A')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
    $objPHPExcel->getActiveSheet()->getStyle('A1:C1')->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Kode');
    $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Nama');
    $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Nama Klasifikasi');
    $objPHPExcel->getActiveSheet()->setAutoFilter('A1:C1');
    $objPHPExcel->getActiveSheet()->getStyle('A'.$n)->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
        
    $n=2;
    $qry=sqlsrv_query($conn,"SELECT c.Code.Code,c.Code.CodeName,c.Classification.ClassificationName
    FROM c.Classification
    INNER JOIN c.StatisticalDomain ON c.Classification.StatisticalDomainID = c.StatisticalDomain.StatisticalDomainID
    INNER JOIN c.Code ON c.Code.ClassificationID = c.Classification.ClassificationID
    WHERE c.StatisticalDomain.StatisticalDomainID = '14'");
    while($d= sqlsrv_fetch_array($qry, SQLSRV_FETCH_ASSOC)){
        $objPHPExcel->getActiveSheet()->setCellValue('A'.$n, $d['Code']);
        $objPHPExcel->getActiveSheet()->setCellValue('B'.$n, $d['CodeName']);
        $objPHPExcel->getActiveSheet()->setCellValue('C'.$n, $d['ClassificationName']);
        $n++;
    }      
    $objPHPExcel->getActiveSheet()->setTitle('Kode Lapangan Usaha');
}
// sheet Komoditas
if($cekKomoditas=='2'){
    $indek++;
    $objPHPExcel->createSheet();
    $objPHPExcel->setActiveSheetIndex($indek);
    $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn('A')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
    $objPHPExcel->getActiveSheet()->getStyle('A1:C1')->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Kode');
    $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Nama');
    $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Nama Klasifikasi');
    $objPHPExcel->getActiveSheet()->setAutoFilter('A1:C1');
    $objPHPExcel->getActiveSheet()->getStyle('A'.$n)->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
     
    $n=2;
    $qry=sqlsrv_query($conn,"SELECT c.Code.Code,c.Code.CodeName,c.Classification.ClassificationName
    FROM c.Classification
    INNER JOIN c.StatisticalDomain ON c.Classification.StatisticalDomainID = c.StatisticalDomain.StatisticalDomainID
    INNER JOIN c.Code ON c.Code.ClassificationID = c.Classification.ClassificationID
    WHERE c.StatisticalDomain.StatisticalDomainID = '15'");
    while($d= sqlsrv_fetch_array($qry, SQLSRV_FETCH_ASSOC)){
        $objPHPExcel->getActiveSheet()->setCellValue('A'.$n, $d['Code']);
        $objPHPExcel->getActiveSheet()->setCellValue('B'.$n, $d['CodeName']);
        $objPHPExcel->getActiveSheet()->setCellValue('C'.$n, $d['ClassificationName']);
        $n++;
    }      
    $objPHPExcel->getActiveSheet()->setTitle('Kode Komoditas');
}
// sheet Transaksi
if($cekTransaksi=='2'){
    $indek++;
    $objPHPExcel->createSheet();
    $objPHPExcel->setActiveSheetIndex($indek);
    $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn('A')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
    $objPHPExcel->getActiveSheet()->getStyle('A1:C1')->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Kode');
    $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Nama');
    $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Nama Klasifikasi');
    $objPHPExcel->getActiveSheet()->setAutoFilter('A1:C1');
    $objPHPExcel->getActiveSheet()->getStyle('A'.$n)->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
     
    $n=2;
    $qry=sqlsrv_query($conn,"SELECT c.Code.Code,c.Code.CodeName,c.Classification.ClassificationName
    FROM c.Classification
    INNER JOIN c.StatisticalDomain ON c.Classification.StatisticalDomainID = c.StatisticalDomain.StatisticalDomainID
    INNER JOIN c.Code ON c.Code.ClassificationID = c.Classification.ClassificationID
    WHERE c.StatisticalDomain.StatisticalDomainID = '16'");
    while($d= sqlsrv_fetch_array($qry, SQLSRV_FETCH_ASSOC)){
        $objPHPExcel->getActiveSheet()->setCellValue('A'.$n, $d['Code']);
        $objPHPExcel->getActiveSheet()->setCellValue('B'.$n, $d['CodeName']);
        $objPHPExcel->getActiveSheet()->setCellValue('C'.$n, $d['ClassificationName']);
        $n++;
    }      
    $objPHPExcel->getActiveSheet()->setTitle('Kode Transaksi');
}
// sheet Institusi
if($cekInstitusi=='2'){
    $indek++;
    $objPHPExcel->createSheet();
    $objPHPExcel->setActiveSheetIndex($indek);
    $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn('A')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
    $objPHPExcel->getActiveSheet()->getStyle('A1:C1')->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Kode');
    $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Nama');
    $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Nama Klasifikasi');
    $objPHPExcel->getActiveSheet()->setAutoFilter('A1:C1');
    $objPHPExcel->getActiveSheet()->getStyle('A'.$n)->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
     
    $n=2;
    $qry=sqlsrv_query($conn,"SELECT c.Code.Code,c.Code.CodeName,c.Classification.ClassificationName
    FROM c.Classification
    INNER JOIN c.StatisticalDomain ON c.Classification.StatisticalDomainID = c.StatisticalDomain.StatisticalDomainID
    INNER JOIN c.Code ON c.Code.ClassificationID = c.Classification.ClassificationID
    WHERE c.StatisticalDomain.StatisticalDomainID = '17'");
    while($d= sqlsrv_fetch_array($qry, SQLSRV_FETCH_ASSOC)){
        $objPHPExcel->getActiveSheet()->setCellValue('A'.$n, $d['Code']);
        $objPHPExcel->getActiveSheet()->setCellValue('B'.$n, $d['CodeName']);
        $objPHPExcel->getActiveSheet()->setCellValue('C'.$n, $d['ClassificationName']);
        $n++;
    }      
    $objPHPExcel->getActiveSheet()->setTitle('Kode Sektor Institusi');
}
//sheet kuantitas
if($cekKuantitas=='2'){
    $indek++;
    $objPHPExcel->createSheet();
    $objPHPExcel->setActiveSheetIndex($indek);
    $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn('A')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
    $objPHPExcel->getActiveSheet()->getStyle('A1:C1')->getFont()->setBold(true);
    //$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Kode');
    $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Nama');
    $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Tipe');
    $objPHPExcel->getActiveSheet()->setAutoFilter('A1:B1');
    $objPHPExcel->getActiveSheet()->getStyle('A'.$n)->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
     
    $n=2;
    $qry=sqlsrv_query($conn,"SELECT
    c.Measurement.MeasurementID,
    c.Measurement.MeasurementName,
    c.Measurement.NationalAccountMeasurementName,
    c.Measurement.MeasurementTypeID,
    c.MeasurementType.MeasurementTypeName
    FROM  c.Measurement
    INNER JOIN c.MeasurementType ON c.Measurement.MeasurementTypeID = c.MeasurementType.MeasurementTypeID");
    while($d= sqlsrv_fetch_array($qry, SQLSRV_FETCH_ASSOC)){
        //$objPHPExcel->getActiveSheet()->setCellValue('A'.$n, $d['MeasurementID']);
        $objPHPExcel->getActiveSheet()->setCellValue('A'.$n, $d['NationalAccountMeasurementName']);
        $objPHPExcel->getActiveSheet()->setCellValue('B'.$n, $d['MeasurementTypeName']);
        $n++;
    }      
    $objPHPExcel->getActiveSheet()->setTitle('Ukuran Kuantitas');
}
if($cekSeries=='2'){
    $indek++;
    $objPHPExcel->createSheet();
    $objPHPExcel->setActiveSheetIndex($indek);
    $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn('A')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getStyle('A1:C1')->getFont()->setBold(true);
    //$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Kode');
    $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Series Data');
    $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Periode Data');
    //$objPHPExcel->getActiveSheet()->setAutoFilter('A1:C1');
    $objPHPExcel->getActiveSheet()->setAutoFilter('A1:B1');
    $objPHPExcel->getActiveSheet()->getStyle('A'.$n)->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
     
    $n=2;
    $qry=sqlsrv_query($conn,"SELECT
    c.DataSeries.DataSeriesID,
    c.DataSeries.DataSeriesCode,
    c.DataSeries.DataSeriesName,
    c.DetailDataSeries.DetailDataSeriesID,
    c.DetailDataSeries.DetailDataSeriesCode,
    c.DetailDataSeries.DetailDataSeriesName
    
    FROM
    c.DataSeries
    LEFT JOIN c.DetailDataSeries ON c.DataSeries.DataSeriesID = c.DetailDataSeries.DataSeriesID");
    while($d= sqlsrv_fetch_array($qry, SQLSRV_FETCH_ASSOC)){
        //$objPHPExcel->getActiveSheet()->setCellValue('A'.$n, $d['DataSeriesCode']);
        $objPHPExcel->getActiveSheet()->setCellValue('A'.$n, $d['DataSeriesName']);
        $objPHPExcel->getActiveSheet()->setCellValue('B'.$n, $d['DetailDataSeriesName']);
        $n++;
    }      
    $objPHPExcel->getActiveSheet()->setTitle('Data Series');
}
$objPHPExcel->setActiveSheetIndex(0);
//header('Content-Type: application/vnd.ms-excel');
//header('Content-Disposition: attachment;filename="template_'.$kegiatan.'.xls"');
//header('Cache-Control: max-age=0');
//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
//$objWriter->save('php://output');

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="template_'.$kegiatan.'.xlsx"');
header('Cache-Control: max-age=0');
// If you’re serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');
// If you’re serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
unset($objPHPExcel);

?>