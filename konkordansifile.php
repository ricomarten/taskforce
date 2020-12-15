<?php
session_start();
//error_reporting(0);
date_default_timezone_set('Asia/Jakarta');
require('spreadsheet-reader-master/php-excel-reader/excel_reader2.php');
require('spreadsheet-reader-master/SpreadsheetReader.php');
$tanggal=date("Y-m-d H:i:s");
include 'koneksi.php';
//print_r($_POST);
$sql_jenis=sqlsrv_query($conn,"SELECT
c.ClassificationConcordance.ClassificationConcordanceID,
c.ClassificationConcordance.ClassificationConcordanceName,
c.ClassificationConcordance.FirstClassificationID,
c.ClassificationConcordance.SecondClassificationID,
c.Classification.ClassificationName a,
b.ClassificationName b

FROM
c.ClassificationConcordance
LEFT JOIN c.Classification ON c.ClassificationConcordance.FirstClassificationID = c.Classification.ClassificationID
LEFT JOIN c.Classification b ON c.ClassificationConcordance.SecondClassificationID = b.ClassificationID
where c.ClassificationConcordance.ClassificationConcordanceID ='".$_POST['id']."'
");
$jenis = sqlsrv_fetch_array($sql_jenis, SQLSRV_FETCH_ASSOC);
$sql_series=sqlsrv_query($conn, "SELECT
--c.CodeConcordance.FirstCode,
--c.CodeConcordance.SecondCode,
--c.CodeConcordance.CodeConcordanceID,
--c.CodeConcordance.FirstRelation,
--c.CodeConcordance.SecondRelation,
--c.CodeConcordance.ClassificationConcordanceID,
code1.CategoryCode a,
code1.Code b,
code1.CodeName c,
code2.CategoryCode d,
code2.Code e,
code2.CodeName f

FROM
c.CodeConcordance
LEFT JOIN c.Code code1 ON c.CodeConcordance.FirstCode = code1.Code
LEFT JOIN c.Code code2 ON c.CodeConcordance.SecondCode = code2.Code
 where ClassificationConcordanceID='".$_POST['id']."'");
 
echo '<div class="table-responsive my-custom-scrollbar">';
echo "<table class='book table table-bordered table-striped mb-0'>";
echo "<thead><tr>";
echo "<th colspan=3>".$jenis['a']."</th>";
echo "<th colspan=3>".$jenis['b']."</th>";
echo "</tr><tr>";
echo "<td>Kategori</td>";
echo "<td>Kode</td>";
echo "<td>Nama</td>";
echo "<td>Kategori</td>";
echo "<td>Kode</td>";
echo "<td>Nama</td>";
echo "</tr></thead>";
echo "<tbody>";

while($series = sqlsrv_fetch_array($sql_series, SQLSRV_FETCH_ASSOC)){
    $arr[]=$series;
    echo "<tr>";
    echo "<td>".$series['a']."</td>";  
    echo "<td>".$series['b']."</td>";  
    echo "<td>".$series['c']."</td>";  
    echo "<td>".$series['d']."</td>";  
    echo "<td>".$series['e']."</td>";  
    echo "<td>".$series['f']."</td>"; 
    echo "<tr>";            
}

echo "</tbody>";
echo "</table>";
echo "</div>";
?>