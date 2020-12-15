<?php
session_start();
error_reporting(0);
date_default_timezone_set('Asia/Jakarta');
require('spreadsheet-reader-master/php-excel-reader/excel_reader2.php');
require('spreadsheet-reader-master/SpreadsheetReader.php');
$tanggal=date("Y-m-d H:i:s");
include 'koneksi.php';
//$json_str = file_get_contents('php://input');
//$json_obj = json_decode($json_str);
echo '<div class="table-responsive my-custom-scrollbar">';
//echo $_POST['index'];
$target = basename($_FILES['data']['name']) ;
move_uploaded_file($_FILES['data']['tmp_name'], $target);
chmod($_FILES['data']['name'],0777);
$data = new SpreadsheetReader($_FILES['data']['name'],false);

function cetak_error($kolom){
    echo "<td class='table-danger'>".$kolom."</td>";
}

function cek_string($arr) {
    if (is_array($arr) && count($arr) === count(array_filter(str_replace('/', '', $arr), 'is_numeric'))) {
        return false;
    } else {
        return true;
    }
}
function ContainsNumbers($String){
    if(preg_match('/\\d/', $String) > 0) return true;
    else return false;
}

$tabel=[];$judul=[];
$Sheets = $data -> Sheets();
foreach ($Sheets as $Index => $Name){
    if($Index==$_POST['index']){
        $data -> ChangeSheet($Index);
        $j=0;
        foreach ($data as $Key => $Row){
            if($j==0){
                for($i=0;$i<7;$i++){
                    $judul[$i]=$Row[$i];
                }    
            }
            for($i=0;$i<7;$i++){
                $tabel[$j][$i]=$Row[$i];
            }            
            $j++;
        }      
    }        
}
$error=0;
//echo "<button type='button' class='btn btn-info' onclick='tampilin()'>Hide/Preview Data</button><br>";
echo "<div id='preview'>";
echo "<table class='table  table-bordered table-striped ' id='datatabel'><tbody>";
for($baris=0;$baris<$j;$baris++){
    echo "<tr>";
    if($baris==0){
        echo "<th>#</th>";
    }else{
        echo "<td>".$baris."</td>";
    }  
    for($kolom=0;$kolom<$i;$kolom++){
        if($baris==0){           
            if($tabel[$baris][$kolom]==''){
                cetak_error($tabel[$baris][$kolom]);
                $error++;
            }else{
                echo "<th width='".(100/$i)."%'>".$tabel[$baris][$kolom]."</th>";
            }
        }else{           
            if($tabel[$baris][$kolom]==''){
                cetak_error($tabel[$baris][$kolom]);
                $error++;
            }else{
                if($kolom==0){
                    if(strlen($tabel[$baris][$kolom])<>16 && $tabel[$baris][$kolom]<>'-'){
                        cetak_error($tabel[$baris][$kolom]);
                        $error++;
                    }else{
                        echo "<td width='".(100/$i)."%'>".$tabel[$baris][$kolom]."</td>";
                    }
                }elseif($kolom==1){
                    if($tabel[$baris][$kolom]==$tabel[$baris][$kolom-1] && $tabel[$baris][$kolom]<>'-'){
                        cetak_error($tabel[$baris][$kolom]);
                        $error++;
                    }else if(strlen($tabel[$baris][$kolom])<>16 && $tabel[$baris][$kolom]<>'-'){
                        cetak_error($tabel[$baris][$kolom]);
                        $error++;
                    }else{
                        echo "<td width='".(100/$i)."%'>".$tabel[$baris][$kolom]."</td>";
                    }
                }elseif($kolom==2){
                    if(strlen($tabel[$baris][$kolom])<4 || ContainsNumbers($tabel[$baris][$kolom])){
                        cetak_error($tabel[$baris][$kolom]);
                        $error++;
                    }else{
                        echo "<td width='".(100/$i)."%'>".$tabel[$baris][$kolom]."</td>";
                    }
                }elseif($kolom==3){
                    if($tabel[$baris][$kolom]<>'L' && $tabel[$baris][$kolom]<>'l' &&
                        $tabel[$baris][$kolom]<>'P' && $tabel[$baris][$kolom]<>'p' ){
                        cetak_error($tabel[$baris][$kolom]);
                        $error++;
                    }else{
                        echo "<td width='".(100/$i)."%'>".$tabel[$baris][$kolom]."</td>";
                    }
                }elseif($kolom==6){
                    $tgl=explode("/",$tabel[$baris][($kolom-1)]);
                    $tanggal=$tgl[1]."/".$tgl[0]."/".$tgl[2];                    
                    $date = new DateTime($tanggal);
                    $now = new DateTime();
                    $interval = $now->diff($date);
                    if(($interval->y)<>$tabel[$baris][$kolom]){
                        cetak_error($tabel[$baris][$kolom]);
                        $error++;
                    }else{
                        echo "<td width='".(100/$i)."%'>".$tabel[$baris][$kolom]."</td>";
                    }
                }else{
                    echo "<td width='".(100/$i)."%'>".$tabel[$baris][$kolom]."</td>";
                }
                
            }  
        }
    }
    echo "<tr>";
}
echo "</tbody></table>";
echo "</div>";
echo "<input type='hidden' name='jml_error' id='jml_error' value='".$error."'>";
unlink($_FILES['data']['name']);

?>