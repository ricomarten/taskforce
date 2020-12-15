<?php
session_start();
error_reporting(0);
date_default_timezone_set('Asia/Jakarta');
$tanggal=date("Y-m-d H:i:s");
require('spreadsheet-reader-master/php-excel-reader/excel_reader2.php');
require('spreadsheet-reader-master/SpreadsheetReader.php');
include "koneksi.php";
include "uuid.php";


 function getBulan($bln){
    switch ($bln){
        case 1: 
            return "Januari";
            break;
        case 2:
            return "Februari";
            break;
        case 3:
            return "Maret";
            break;
        case 4:
            return "April";
            break;
        case 5:
            return "Mei";
            break;
        case 6:
            return "Juni";
            break;
        case 7:
            return "Juli";
            break;
        case 8:
            return "Agustus";
            break;
        case 9:
            return "September";
            break;
        case 10:
            return "Oktober";
            break;
        case 11:
            return "November";
            break;
        case 12:
            return "Desember";
            break;
    }
} 
 function tgl_indo($tanggal){
	$bulan = array (
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('-', $tanggal);
	
	// variabel pecahkan 0 = tanggal
	// variabel pecahkan 1 = bulan
	// variabel pecahkan 2 = tahun
 
	return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}
 function clean($string) {
    $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
 
    return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
 }

$json_str = file_get_contents('php://input');
$json_obj = json_decode($json_str);
//login
if($json_obj->menuId==1){
    if($json_obj->username=='' || $json_obj->password==''){
        echo "Username dan password harus terisi";
    }else if($json_obj->username=='admin' || $json_obj->password=='admin'){
        $_SESSION['niplama']='334053331';
        $_SESSION['nama']='admin';
        $_SESSION['unitkerja']='33300';
        $_SESSION['email']='';
        $_SESSION['unitkerja_id']='71300';
        $_SESSION['wilayah_id']='0000';
        $_SESSION['url_foto']='';
        $_SESSION['jabatan']='3';
        echo "ok";
    }else{
        //login
        $username=$json_obj->username."@bps.go.id";
        $sql = "SELECT
        *
        FROM
        email_pegawai
        INNER JOIN pegawai_selindo ON email_pegawai.NIP = pegawai_selindo.niplama where email_pegawai.Email='".$username."'";
        // Executes the query
        $stmt = sqlsrv_query($conn, $sql);

        // Error handling
        if ($stmt === false) {
            die(formatErrors(sqlsrv_errors()));
        }
        
        $params = array();
        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
        $stmt = sqlsrv_query( $conn, $sql , $params, $options );
        $data = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        $row_count = sqlsrv_num_rows( $stmt );
        
        if($row_count>0){
            $_SESSION['niplama']=$data['niplama'];
            $_SESSION['nama']=$data['nama'];
            $_SESSION['unitkerja']=$data['kdorg'];
            $_SESSION['email']=$data['Email'];
            $_SESSION['unitkerja_id']=$data['kdorg'];
            $_SESSION['wilayah_id']=$data['kdprop'].$data['kdkab'];;
            $_SESSION['url_foto']="";
            $_SESSION['zoom_admin']=$data['zoom_admin'];
            
            $update = sqlsrv_query($conn, "update pegawai_selindo set login='".$tanggal."', nlogin=nlogin+1 where niplama='".$community->niplama."'");
            echo "ok";
        }else{
            echo "Username tidak ditemukan.";
        }
        
    }
}
if($json_obj->menuId==2){
    echo '<div class="table-responsive my-custom-scrollbar">';
    if($json_obj->param=='domain'){
        $sql=sqlsrv_query($conn,"SELECT * FROM c.StatisticalDomain");
        
        echo "<table class='table table-bordered table-striped mb-0'>";
        echo "<thead><tr>";
        echo "<th>Code</th>";
        echo "<th>Name</th>";
        echo "</tr></thead>";
        echo "<tbody>";
        while($data = sqlsrv_fetch_array( $sql, SQLSRV_FETCH_ASSOC)){
            echo "<tr>";
            echo "<td>".$data['StatisticalDomainCode']."</td>";
            echo "<td>".$data['StatisticalDomainName']."</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    }elseif($json_obj->param=='transaksi'){
        $sql=sqlsrv_query($conn,"SELECT * from c.Classification where StatisticalDomainID<>'16'");
        
        echo "<table class='table table-bordered table-striped mb-0'>";
        echo "<thead><tr>";
        //echo "<th>ID</th>";
        echo "<th>Name</th>";
        echo "<th>Description</th>";
        echo "</tr></thead>";
        echo "<tbody>";
        while($data = sqlsrv_fetch_array( $sql, SQLSRV_FETCH_ASSOC)){
            echo "<tr>";
            //echo "<td>".$data['ClassificationID']."</td>";
            echo "<td>".$data['ClassificationName']."</td>";
            echo "<td>".$data['Description']."</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    }elseif($json_obj->param=='institusi'){
        $sql=sqlsrv_query($conn,"SELECT * from c.Classification where StatisticalDomainID<>'17'");
        
        echo "<table class='table table-bordered table-striped mb-0'>";
        echo "<thead><tr>";
        //echo "<th>ID</th>";
        echo "<th>Name</th>";
        echo "<th>Description</th>";
        echo "</tr></thead>";
        echo "<tbody>";
        while($data = sqlsrv_fetch_array( $sql, SQLSRV_FETCH_ASSOC)){
            echo "<tr>";
            //echo "<td>".$data['ClassificationID']."</td>";
            echo "<td>".$data['ClassificationName']."</td>";
            echo "<td>".$data['Description']."</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    }elseif($json_obj->param=='kuantitas'){
        $sql=sqlsrv_query($conn,"SELECT * from c.Measurement");
        
        echo "<table class='table table-bordered table-striped mb-0'>";
        echo "<thead><tr>";
        echo "<th>ID</th>";
        echo "<th>Measurement Name</th>";
        echo "<th>National Account Measurement Name</th>";       
        echo "</tr></thead>";
        echo "<tbody>";
        while($data = sqlsrv_fetch_array( $sql, SQLSRV_FETCH_ASSOC)){
            echo "<tr>";
            echo "<td>".$data['MeasurementID']."</td>";
            echo "<td>".$data['MeasurementName']."</td>";
            echo "<td>".$data['NationalAccountMeasurementName']."</td>";       
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    }elseif($json_obj->param=='series'){
        $sql=sqlsrv_query($conn,"SELECT * from c.DataSeries");
        
        echo "<table class='table table-bordered table-striped mb-0'>";
        echo "<thead><tr>";
        echo "<th>DataSeries Code</th>";
        echo "<th>DataSeries Name</th>";
        echo "<th>Description</th>";       
        echo "</tr></thead>";
        echo "<tbody>";
        while($data = sqlsrv_fetch_array( $sql, SQLSRV_FETCH_ASSOC)){
            echo "<tr>";
            echo "<td>".$data['DataSeriesCode']."</td>";
            echo "<td>".$data['DataSeriesName']."</td>";
            echo "<td>".$data['Description']."</td>";       
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    }elseif($json_obj->param=='klasifikasi'){
        $sql=sqlsrv_query($conn,"SELECT * from c.Classification where StatisticalDomainID<>'14'");
        
        echo "<table class='table table-bordered table-striped mb-0'>";
        echo "<thead><tr>";
        //echo "<th>ID</th>";
        echo "<th>Name</th>";
        echo "<th>Description</th>";
        echo "</tr></thead>";
        echo "<tbody>";
        while($data = sqlsrv_fetch_array( $sql, SQLSRV_FETCH_ASSOC)){
            echo "<tr>";
            //echo "<td>".$data['ClassificationID']."</td>";
            echo "<td>".$data['ClassificationName']."</td>";
            echo "<td>".$data['Description']."</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    }elseif($json_obj->param=='komoditas'){
        $sql=sqlsrv_query($conn,"SELECT * from c.Classification where StatisticalDomainID='15'");      
        echo "<table class='table table-bordered table-striped mb-0'>";
        echo "<thead><tr>";
        //echo "<th>ID</th>";
        echo "<th>Name</th>";
        echo "<th>Description</th>";
        echo "</tr></thead>";
        echo "<tbody>";
        while($data = sqlsrv_fetch_array( $sql, SQLSRV_FETCH_ASSOC)){
            echo "<tr>";
            //echo "<td>".$data['ClassificationID']."</td>";
            echo "<td>".$data['ClassificationName']."</td>";
            echo "<td>".$data['Description']."</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    }
    echo '</div>';
}
if($json_obj->menuId==3){ 
    $array = json_decode($json_str, true);
    //echo "<pre>";
    //print_r($json_obj->arrdata);
    //print_r($array['tabel']);
    $splitData=explode("#",$json_obj->arrdata);
    $cekBaris = str_split($splitData[1]);
    //print_r($cekBaris);
    $namaklasifikasi='';
    $namakomoditas='';
    $namatransaksi='';
    $namainstitusi='';
    $namakuantitas='';
    $namaseries='';
    $kegiatan=$splitData[0];
    $cekWilayah=$cekBaris[0];
    $cekKlasifikasi=$cekBaris[1];
    $cekKomoditas=$cekBaris[2];
    $cekTransaksi=$cekBaris[3];
    $cekInstitusi=$cekBaris[4];
    $cekKuantitas=$cekBaris[5];
    $cekSeries=$cekBaris[6];
    //data wilayah
    $wilayah=$splitData[2];
    //data klasifikasi
    $klasifikasi=$splitData[3];
    $kodeklasifikasi=$splitData[4];
    //data komoditas
    $komoditas=$splitData[5];
    $kodekomoditas=$splitData[6];
    //data transaksi
    $transaksi=$splitData[7];
    $kodetransaksi=$splitData[8];
    //data institusi
    $institusi=$splitData[9];
    $kodeinstitusi=$splitData[10];
    //data kuantitas
    $kuantitas=$splitData[11];
    //data series
    $series=$splitData[12];
    //data periode
    $periode=$splitData[13];
    
    $row=(count($array['tabel']))/($json_obj->jmlkol+1)-1;
    //echo $row;
    $kolom=$json_obj->jmlkol+1;
    //echo " ".$kolom;
    if($cekWilayah=='1'){
        $sql_query=sqlsrv_query($conn, "SELECT * from c.AdministrativeArea 
        where AdministrativeAreaCode='$wilayah'");      
        $data=sqlsrv_fetch_array($sql_query,SQLSRV_FETCH_ASSOC);
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
        $namaklasifikasi=$data['ClassificationName'];
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
        $namakomoditas= $data['ClassificationName'];
    }
    //transaksi
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
        $namatransaksi= $data['ClassificationName'];
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
        $namainstitusi= $data['ClassificationName'];
    }
    //kuantitas
    if($cekKuantitas=='1'){
        $sql_query=sqlsrv_query($conn, "SELECT * from c.Measurement where MeasurementID='".$kuantitas."'");
        $data=sqlsrv_fetch_array($sql_query,SQLSRV_FETCH_ASSOC);
        $namakuantitas= $data['NationalAccountMeasurementName'];
    }
    //series
    if($cekSeries=='1'){
        $sql_query=sqlsrv_query($conn, "SELECT * from c.DataSeries where DataSeriesCode='".$series."'");
        $data=sqlsrv_fetch_array($sql_query,SQLSRV_FETCH_ASSOC);
        $namaseries= $data['DataSeriesName'];
    }
    //echo "<br><br>";
    //echo "<br>". $namaklasifikasi;
    //echo "<br>". $namakomoditas;
    //echo "<br>". $namatransaksi;
    //echo "<br>". $namainstitusi;
    //echo "<br>". $namakuantitas;
    //print_r(($array['tabel'][0]['tabel']));
    //echo "<table border='1'>";
    //for($i=0;$i<=$json_obj->jmlkol;$i++){
    //    echo "<td>".(($array['tabel'][$i]['tabel']['nilai']))."</td>";
    //}

    
    $j=0;
    $kolwilayah=-1;
    $kolklasifikasi=-1;
    $kolnamaklasifikasi=-1;
    $kolkomoditas=-1;
    $kolnamakomoditas=-1;
    $koltransaksi=-1;
    $kolnamatransaksi=-1;
    $kolinstitusi=-1;
    $kolnamainstitusi=-1;
    $kolkuantitas=-1;
    //$kolnamakuantitas=-1;
    $kolseries=-1;
    $kolperiode=-1;
    $kolnilai=-1;
    $kolsatuan=-1;
    $koltahun=-1;
    

    //$id=uniqid();
    $id=uuid(); 
    $insert=sqlsrv_query($conn,"INSERT INTO d.TabelData (IdTabel,NamaTabel,NipUpload,TanggalUpload,UnitKerja,Wilayah,Status)
     values ('$id','$json_obj->nama_kegiatan','$json_obj->nip','$tanggal','$json_obj->unitkerja','$json_obj->wilayah','0')");
    //echo "</pre>";
    $insertCycle=sqlsrv_query($conn,"INSERT INTO p.StatisticalProgramCycle (StatisticalProgramCycleName,CycleFrequencyCode,CyclePeriod,IdTabel)
     values ('$json_obj->nama_kegiatan','$json_obj->periode_kegiatan','$json_obj->tanggal_kegiatan','$id')");
    if( $insert === false ) {
        if( ($errors = sqlsrv_errors() ) != null) {
            foreach( $errors as $error ) {
                echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
                echo "code: ".$error[ 'code']."<br />";
                echo "message: ".$error[ 'message']."<br />";
            }
        }
        //sqlsrv_query($conn,"DELETE from d.InputData where IdTabelData='$id'");
        sqlsrv_query($conn,"DELETE from d.TabelData where IdTabel='$id'");
        //sqlsrv_query($conn,"DELETE from p.StatisticalProgramCycle where IdTabel='$id'");
    }
    elseif( $insertCycle === false ) {
        if( ($errors = sqlsrv_errors() ) != null) {
            foreach( $errors as $error ) {
                echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
                echo "code: ".$error[ 'code']."<br />";
                echo "message: ".$error[ 'message']."<br />";
            }
        }
        //sqlsrv_query($conn,"DELETE from d.InputData where IdTabelData='$id'");
        sqlsrv_query($conn,"DELETE from d.TabelData where IdTabel='$id'");
        sqlsrv_query($conn,"DELETE from p.StatisticalProgramCycle where IdTabel='$id'");
    }
    else{
        $errorinsert=0;
        for($i=1;$i<=$row;$i++){       
            //echo "<tr>";
            if($cekWilayah=='1'){
                //echo "<td>".$wilayah."</td>";
            }elseif($cekWilayah=='2'){
                if($j==($kolom))$j=0;
                if($kolwilayah==-1)$kolwilayah=$j;
                //echo "<td>".($array['tabel'][($i*$kolom+$kolwilayah)]['tabel']['nilai'])."</td>";
                $wilayah=$array['tabel'][($i*$kolom+$kolwilayah)]['tabel']['nilai'];
                $j++;
            }
            if($cekKlasifikasi=='1'){
                //echo "<td>".$namaklasifikasi."</td>";
                //echo "<td>".$kodeklasifikasi."</td>";
            }elseif($cekKlasifikasi=='2'){
                if($j==($kolom))$j=0;
                if($kolnamaklasifikasi==-1)$kolnamaklasifikasi=$j;
                //echo "<td>".($array['tabel'][($i*$kolom+$kolnamaklasifikasi)]['tabel']['nilai'])."</td>";
                $namaklasifikasi=$array['tabel'][($i*$kolom+$kolnamaklasifikasi)]['tabel']['nilai'];
                $j++;
                if($j==($kolom))$j=0;
                if($kolklasifikasi==-1)$kolklasifikasi=$j;
                //echo "<td>".($array['tabel'][($i*$kolom+$kolklasifikasi)]['tabel']['nilai'])."</td>";
                $kodeklasifikasi=$array['tabel'][($i*$kolom+$kolklasifikasi)]['tabel']['nilai'];
                $j++;
            }
            if($cekKomoditas=='1'){
                //echo "<td>".$namakomoditas."</td>";
                //echo "<td>".$kodekomoditas."</td>";
            }elseif($cekKomoditas=='2'){
                if($j==($kolom))$j=0;
                if($kolnamakomoditas==-1)$kolnamakomoditas=$j;
                //echo "<td>".($array['tabel'][($i*$kolom+$kolnamakomoditas)]['tabel']['nilai'])."</td>";
                $namakomoditas=$array['tabel'][($i*$kolom+$kolnamakomoditas)]['tabel']['nilai'];
                $j++;
                if($j==($kolom))$j=0;
                if($kolkomoditas==-1)$kolkomoditas=$j;
                //echo "<td>".($array['tabel'][($i*$kolom+$kolkomoditas)]['tabel']['nilai'])."</td>";
                $kodekomoditas=$array['tabel'][($i*$kolom+$kolkomoditas)]['tabel']['nilai'];
                $j++;
            }
            if($cekTransaksi=='1'){
                //echo "<td>".$namatransaksi."</td>";
                //echo "<td>".$kodetransaksi."</td>";
            }elseif($cekTransaksi=='2'){
                if($j==($kolom))$j=0;
                if($kolnamatransaksi==-1)$kolnamatransaksi=$j;
                //echo "<td>".($array['tabel'][($i*$kolom+$kolnamatransaksi)]['tabel']['nilai'])."</td>";
                $namatransaksi=$array['tabel'][($i*$kolom+$kolnamatransaksi)]['tabel']['nilai'];
                $j++;
                if($j==($kolom))$j=0;
                if($koltransaksi==-1)$koltransaksi=$j;
                //echo "<td>".($array['tabel'][($i*$kolom+$koltransaksi)]['tabel']['nilai'])."</td>";
                $kodetransaksi=$array['tabel'][($i*$kolom+$koltransaksi)]['tabel']['nilai'];     
                $j++;
            }
            if($cekInstitusi=='1'){
                //echo "<td>".$namainstitusi."</td>";
                //echo "<td>".$kodeinstitusi."</td>";
            }elseif($cekInstitusi=='2'){
                if($j==($kolom))$j=0;
                if($kolnamainstitusi==-1)$kolnamainstitusi=$j;
                //echo "<td>".($array['tabel'][($i*$kolom+$kolnamainstitusi)]['tabel']['nilai'])."</td>";
                $namainstitusi=$array['tabel'][($i*$kolom+$kolnamainstitusi)]['tabel']['nilai'];    
                $j++;
                if($j==($kolom))$j=0;
                if($kolinstitusi==-1)$kolinstitusi=$j;
                //echo "<td>".($array['tabel'][($i*$kolom+$kolinstitusi)]['tabel']['nilai'])."</td>"; 
                $kodeinstitusi=$array['tabel'][($i*$kolom+$kolinstitusi)]['tabel']['nilai'];   
                $j++;
            }
            if($cekKuantitas=='1'){
                //echo "<td>".$namakuantitas."</td>";
                //echo "<td>".$kuantitas."</td>";
            }elseif($cekKuantitas=='2'){
                if($j==($kolom))$j=0;
                if($kolkuantitas==-1)$kolkuantitas=$j;
                //echo "<td>".($array['tabel'][($i*$kolom+$kolkuantitas)]['tabel']['nilai'])."</td>";
                $namakuantitas=$array['tabel'][($i*$kolom+$kolkuantitas)]['tabel']['nilai'];    
                $j++;
            }
            if($cekSeries=='1'){
                //echo "<td>".$namaseries."</td>";
                //echo "<td>".$periode."</td>";
                if($series=='A'){
                    $insertperiode=$periode."-01-01"; 
                }elseif($series=='D' || $series=='U'){
                    $pecah=explode("-",$periode);
                    $insertperiode=$pecah[2]."-".$pecah[1]."-".$pecah[0];
                }else{
                    $pecah=explode("_",$periode);
                    if($series=='S'){
                        $tahun=$pecah[1];
                        $month = explode("S",$pecah[0]);                   
                        if($month[1]=='1'){
                            $month[1]='01';
                            $detailseriesnama="Semester I";
                        }else{
                            $month[1]='07';
                            $detailseriesnama="Semester II";
                        }
                        $insertperiode =  $tahun."-".$month[1]."-01";
                        $detailseries=$pecah[0];                  
                    }elseif($series=='R'){
                        $tahun=$pecah[1];
                        $month = explode("R",$pecah[0]);                   
                        if($month[1]=='1'){
                            $month[1]='01';
                            $detailseriesnama="Caturwulan I";
                        }elseif($month[1]=='2'){
                            $month[1]='05';
                            $detailseriesnama="Caturwulan II";
                        }else{
                            $month[1]='09';
                            $detailseriesnama="Caturwulan III";
                        }
                        $insertperiode =  $tahun."-".$month[1]."-01";
                        $detailseries=$pecah[0];
                    }elseif($series=='Q'){
                        $tahun=$pecah[1];
                        $month = explode("Q",$pecah[0]);                   
                        if($month[1]=='1'){
                            $month[1]='01';
                            $detailseriesnama="Triwulan I";
                        }elseif($month[1]=='2'){
                            $month[1]='04';
                            $detailseriesnama="Triwulan II";
                        }elseif($month[1]=='3'){
                            $month[1]='07';
                            $detailseriesnama="Triwulan III";
                        }else{
                            $month[1]='10';
                            $detailseriesnama="Triwulan IV";
                        }
                        $insertperiode =  $tahun."-".$month[1]."-01";
                        $detailseries=$pecah[0];
                    }elseif($series=='M'){                   
                        $tahun=$pecah[1];
                        $month = explode("M",$pecah[0]);
                        $detailseriesnama=getBulan($month[1]);
                        
                        if($month[1]<10){
                            $month[1]="0".$month[1];
                        }
                        $insertperiode =  $tahun."-".$month[1]."-01";
                        $detailseries=$pecah[0];                 
                        
                    }elseif($series=='W'){
                        $tahun=$pecah[1];
                        $week = explode("W",$pecah[0]);
                        if($week[1]<10){
                            $week[1]="0".$week[1];
                        }
                        $insertperiode = date("Y-m-d", strtotime($tahun."W".$week[1]."1") ); // First day of week
                        //$date2 = date( "l, M jS, Y", strtotime($year."W".$week."7") ); // Last day of week

                        $detailseries=$pecah[0];                 
                        $detailseriesnama="Minggu ".$week[1];
                    }
                }
            
            }elseif($cekSeries=='2'){
                if($j==($kolom))$j=0;
                if($kolseries==-1)$kolseries=$j;
                //echo "<td>".($array['tabel'][($i*$kolom+$kolseries)]['tabel']['nilai'])."</td>";
                $namaseries=$array['tabel'][($i*$kolom+$kolseries)]['tabel']['nilai'];
                $j++;
                if($j==($kolom))$j=0;
                if($kolperiode==-1)$kolperiode=$j;
                //echo "<td>".($array['tabel'][($i*$kolom+$kolperiode)]['tabel']['nilai'])."</td>";
                $periode=$array['tabel'][($i*$kolom+$kolperiode)]['tabel']['nilai'];
                $j++;
                if($j==($kolom))$j=0;
                if($koltahun==-1)$koltahun=$j;
                $tahun=$array['tabel'][($i*$kolom+$koltahun)]['tabel']['nilai'];
                $j++;
                //$pecah=explode("-",$periode);
                //$insertperiode="20".$pecah[2]."-".$pecah[0]."-".$pecah[1];
                if($namaseries=='Tahunan'){
                    $insertperiode=$periode."-01-01"; 
                }elseif($namaseries=='Harian' || $namaseries=='Tidak Rutin'){
                    $pecah=explode("-",$periode);
                    $insertperiode="20".$pecah[2]."-".$pecah[1]."-".$pecah[0];
                }else{
                    $detailseriesnama=$periode;
                    if($namaseries=='Semesteran'){                  
                        if($periode=="Semester I"){
                            $month='01';
                            $detailseries='S1';                      
                        }else{
                            $month='07';
                            $detailseries='S2'; 
                        }
                        $insertperiode =  $tahun."-".$month."-01";                 
                    }elseif($namaseries=='Caturwulanan'){                 
                        if($periode=="Caturwulan I"){
                            $month='01';
                            $detailseries='R1';                      
                        }elseif($periode=="Caturwulan II"){
                            $month='06';
                            $detailseries='R2';                      
                        }else{
                            $month='09';
                            $detailseries='R3'; 
                        }
                        $insertperiode =  $tahun."-".$month."-01";
                    }elseif($namaseries=='Triwulanan'){
                        if($periode=="Triwulan I"){
                            $month='01';
                            $detailseries='Q1';                      
                        }elseif($periode=="Triwulan II"){
                            $month='04';
                            $detailseries='Q2';                      
                        }elseif($periode=="Triwulan III"){
                            $month='07';
                            $detailseries='Q3';                      
                        }else{
                            $month='10';
                            $detailseries='Q4'; 
                        }
                        $insertperiode =  $tahun."-".$month."-01";
                    }elseif($namaseries=='Bulanan'){ 
                        if($periode=="Januari"){
                            $month='01';
                            $detailseries='M1';                      
                        }elseif($periode=="Februari"){
                            $month='02';
                            $detailseries='M2';                      
                        }elseif($periode=="Maret"){
                            $month='03';
                            $detailseries='M3';                      
                        }elseif($periode=="April"){
                            $month='04';
                            $detailseries='M4';                      
                        }elseif($periode=="Mei"){
                            $month='05';
                            $detailseries='M5';                      
                        }elseif($periode=="Juni"){
                            $month='06';
                            $detailseries='M6';                      
                        }elseif($periode=="Juli"){
                            $month='07';
                            $detailseries='M7';                      
                        }elseif($periode=="Agustus"){
                            $month='08';
                            $detailseries='M8';                      
                        }elseif($periode=="September"){
                            $month='09';
                            $detailseries='M9';                      
                        }elseif($periode=="Oktober"){
                            $month='10';
                            $detailseries='M10';                      
                        }elseif($periode=="November"){
                            $month='11';
                            $detailseries='M11';                      
                        }else{
                            $month='12';
                            $detailseries='M12'; 
                        }
                        $insertperiode =  $tahun."-".$month."-01";
                    }elseif($namaseries=='Mingguan'){
                        $week = explode("Minggu",$pecah[0]);
                        if($week[1]<10){
                            $week[1]="0".$week[1];
                        }
                        $insertperiode = date("Y-m-d", strtotime($tahun."W".$week[1]."1") ); // First day of week
                        //$date2 = date( "l, M jS, Y", strtotime($year."W".$week."7") ); // Last day of week

                        //$detailseries=$pecah[0];                 
                        $detailseries="W".$week[1];
                    }
                }
                
            }
            if($j==($kolom))$j=0;
            if($kolnilai==-1)$kolnilai=$j;
            //echo "<td>".($array['tabel'][($i*$kolom+$kolnilai)]['tabel']['nilai'])."</td>";
            $nilai=$array['tabel'][($i*$kolom+$kolnilai)]['tabel']['nilai'];
            $j++;
            if($j==($kolom))$j=0;
            if($kolsatuan==-1)$kolsatuan=$j;
            //echo "<td>".($array['tabel'][($i*$kolom+$kolsatuan)]['tabel']['nilai'])."</td>";
            $satuan=$array['tabel'][($i*$kolom+$kolsatuan)]['tabel']['nilai'];
            $j++;
            //echo "</tr>";
            $sql="INSERT INTO d.TempInputData(
                MeasurementName,
                TransactionClassificationName,
                TransactionCode,
                CommodityClassificationName,
                CommodityCode,
                ActivityClassificationName,
                ActivityCode,
                InstitutionalSectorClassificationName,
                InstitutionalSectorCode,
                AdministrativeAreaClassificationName,
                AdministrativeAreaCode,
                DataSeriesName,
                MacroDataPeriod,
                MacroDataValue,
                UnitName,
                StatisticalProgramCycleName,
                IdTabelData,
                DataSeriesCode,
                DetailDataSeriesCode,
                tahun,
                DetailDataSeriesName)
                values (
                '$namakuantitas',
                '$namatransaksi',
                '$kodetransaksi',
                '$namakomoditas',
                '$kodekomoditas',
                '$namaklasifikasi',
                '$kodeklasifikasi',
                '$namainstitusi',
                '$kodeinstitusi',
                'Klasifikasi Wilayah Administrasi (MFD)',
                '$wilayah',
                '$namaseries',
                '$insertperiode',
                '$nilai',
                '$satuan',
                '$json_obj->nama_kegiatan',
                '$id',
                '$series',
                '$detailseries',
                '$tahun',
                '$detailseriesnama')";
            //echo $sql;
            $insertdata=sqlsrv_query($conn,$sql);
            if( $insertdata === false ) {
                if( ($errors = sqlsrv_errors() ) != null) {
                    foreach( $errors as $error ) {
                        echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
                        echo "code: ".$error[ 'code']."<br />";
                        echo "message: ".$error[ 'message']."<br />";
                    }
                }
                $errorinsert++; 
            }
        }
        if($errorinsert>0){
            sqlsrv_query($conn,"DELETE from d.TempInputData where IdTabelData='$id'");
            sqlsrv_query($conn,"DELETE from d.TabelData where IdTabel='$id'");
            sqlsrv_query($conn,"DELETE from p.StatisticalProgramCycle where IdTabel='$id'");
        }else{
            echo "ok";
        }
    }
    
    //echo "</table>";
}

if($json_obj->menuId==4){
    //print_r($json_obj->status);
    echo '<div class="table-responsive my-custom-scrollbar">';
    if($json_obj->status=='1' || $json_obj->status=='0'){
        $sql=sqlsrv_query($conn,"SELECT * FROM d.TempInputData where IdTabelData='$json_obj->param'");
    }else{
        $sql=sqlsrv_query($conn,"SELECT * FROM d.InputData where IdTabelData='$json_obj->param'");
    }
      
    echo "<table class='table table-bordered table-striped mb-0'>";
    echo "<thead><tr>";
    echo "<th>StatisticalProgramCycleName</th>";
    echo "<th>MeasurementName</th>";
    echo "<th>TransactionClassificationName</th>";
    echo "<th>TransactionCode</th>";
    echo "<th>CommodityClassificationName</th>";
    echo "<th>CommodityCode</th>";
    echo "<th>ActivityClassificationName</th>";
    echo "<th>ActivityCode</th>";
    echo "<th>InstitutionalSectorClassificationName</th>";
    echo "<th>InstitutionalSectorCode</th>";
    echo "<th>AdministrativeAreaClassificationName</th>";
    echo "<th>AdministrativeAreaCode</th>";
    echo "<th>DataSeriesName</th>";
    echo "<th>MacroDataPeriod</th>";
    echo "<th>MacroDataValue</th>";
    echo "<th>UnitName</th>";

    echo "</tr></thead>";
    echo "<tbody>";
    while($data = sqlsrv_fetch_array( $sql, SQLSRV_FETCH_ASSOC)){
        echo "<tr>";
        echo "<td>".$data['StatisticalProgramCycleName']."</td>";
        echo "<td>".$data['MeasurementName']."</td>";
        echo "<td>".$data['TransactionClassificationName']."</td>";
        echo "<td>".$data['TransactionCode']."</td>";
        echo "<td>".$data['CommodityClassificationName']."</td>";
        echo "<td>".$data['CommodityCode']."</td>";
        echo "<td>".$data['ActivityClassificationName']."</td>";
        echo "<td>".$data['ActivityCode']."</td>";
        echo "<td>".$data['InstitutionalSectorClassificationName']."</td>";
        echo "<td>".$data['InstitutionalSectorCode']."</td>";
        echo "<td>".$data['AdministrativeAreaClassificationName']."</td>";
        echo "<td>".$data['AdministrativeAreaCode']."</td>";
        echo "<td>".$data['DataSeriesName']."</td>";
        echo "<td>".$data['MacroDataPeriod']->format('Y-m-d')."</td>";
        echo "<td class='text-right'>".number_format($data['MacroDataValue'],2)."</td>";
        echo "<td>".$data['UnitName']."</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
}
if($json_obj->menuId==5){
    $deleteinput=sqlsrv_query($conn,"DELETE from d.InputData where IdTabelData='$json_obj->id'");
    $deletetabel=sqlsrv_query($conn,"DELETE from d.TabelData where IdTabel='$json_obj->id'");
    sqlsrv_query($conn,"DELETE from p.StatisticalProgramCycle where IdTabel='$json_obj->id'");
    sqlsrv_query($conn,"DELETE from d.TempInputData where IdTabelData='$json_obj->id'");
    //echo "</pre>";
    if( $deleteinput === false || $deletetabel=== false) {
        if( ($errors = sqlsrv_errors() ) != null) {
            foreach( $errors as $error ) {
                echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
                echo "code: ".$error[ 'code']."<br />";
                echo "message: ".$error[ 'message']."<br />";
            }
        }
    }else{
        echo "ok";
    }
}
if($json_obj->menuId==6){
    $sqlinsert=sqlsrv_query($conn,"INSERT into d.InputData(
        MeasurementName,
        TransactionClassificationName,
        TransactionCode,
        CommodityClassificationName,
        CommodityCode,
        ActivityClassificationName,
        ActivityCode,
        InstitutionalSectorClassificationName,
        InstitutionalSectorCode,
        AdministrativeAreaClassificationName,
        AdministrativeAreaCode,
        DataSeriesName,
        MacroDataPeriod,
        MacroDataValue,
        UnitName,
        StatisticalProgramCycleName,
        IdTabelData,
        DataSeriesCode,
        DetailDataSeriesCode,
        tahun,
        DetailDataSeriesName) 
        
        SELECT MeasurementName,
        TransactionClassificationName,
        TransactionCode,
        CommodityClassificationName,
        CommodityCode,
        ActivityClassificationName,
        ActivityCode,
        InstitutionalSectorClassificationName,
        InstitutionalSectorCode,
        AdministrativeAreaClassificationName,
        AdministrativeAreaCode,
        DataSeriesName,
        MacroDataPeriod,
        MacroDataValue,
        UnitName,
        StatisticalProgramCycleName,
        IdTabelData,
        DataSeriesCode,
        DetailDataSeriesCode,
        tahun,
        DetailDataSeriesName from d.TempInputData where IdTabelData='$json_obj->id'");

    $sqldelete=sqlsrv_query($conn,"DELETE from d.TempInputData where IdTabelData='$json_obj->id'");
    sqlsrv_query($conn,"UPDATE d.TabelData set Status=2 where IdTabel='$json_obj->id'");
    //echo "</pre>";
    if( $sqlinsert === false || $sqldelete=== false) {
        if( ($errors = sqlsrv_errors() ) != null) {
            foreach( $errors as $error ) {
                echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
                echo "code: ".$error[ 'code']."<br />";
                echo "message: ".$error[ 'message']."<br />";
            }
        }
    }else{
        echo "ok";
    }
}
if($json_obj->menuId==7){
    //print_r($json_obj);
    function format_tanggal($s){
        $tgl=explode("/",trim($s));
        return $tgl[2]."-".$tgl[0]."-".$tgl[1];
    }
    $pecah_periode=explode("-",$json_obj->periode);
    for($i=0;$i<$json_obj->jml;$i++){
        $id=uuid();
        if(strlen($json_obj->fenomena[$i])>200){
            $ringkasan=substr($json_obj->fenomena[$i],200);
        }else{
            $ringkasan= $json_obj->fenomena[$i];       
        }
        $sql= "INSERT into d.InputPhenomena (
        TrendID,
        MeasurementID,
        TransactionCodeID,
        CommodityCodeID,
        ActivityCodeID,
        InstitutionalSectorCodeID,
        AdministrativeAreaID,
        DataSeriesID,
        PeriodRangeID,
        DataPhenomenaStartPeriod,
        DataPhenomenaEndPeriod,
        DataPhenomenaSummary,
        DataPhenomenaDetail,
        DataPhenomenaSource) 
        values (
        ".$json_obj->tren.",
        ".$json_obj->kuantitas.",
        ".$json_obj->kodetransaksi.",
        ".$json_obj->kodekomoditas.",
        ".$json_obj->kodeklasifikasi.",
        ".$json_obj->kodeinstitusi.",
        ".$json_obj->wilayah.",
        ".$json_obj->series.",
        ".$json_obj->range.",
        '".format_tanggal($pecah_periode[0])."',
        '".format_tanggal($pecah_periode[1])."',
        '".$ringkasan."',
        '".$json_obj->fenomena[$i]."',
        '".$json_obj->sumber[$i]."')
        ";
        //echo $sql;
        $sqlinsert=sqlsrv_query($conn,$sql);
        if( $sqlinsert === false ) {
            if( ($errors = sqlsrv_errors() ) != null) {
                foreach( $errors as $error ) {
                    echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
                    echo "code: ".$error[ 'code']."<br />";
                    echo "message: ".$error[ 'message']."<br />";
                    $ok="error";
                }
            }
        }else{
            $ok="ok";
        }
    }
    echo $ok;
}if($json_obj->menuId==8){
    $deleteinput=sqlsrv_query($conn,"DELETE from d.InputPhenomena where InputPhenomenaID='$json_obj->id'");
    if( $deleteinput === false ) {
        if( ($errors = sqlsrv_errors() ) != null) {
            foreach( $errors as $error ) {
                echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
                echo "code: ".$error[ 'code']."<br />";
                echo "message: ".$error[ 'message']."<br />";
            }
        }
    }else{
        echo "ok";
    }
}
if($json_obj->menuId==9){
    $sqlupdate=sqlsrv_query($conn,"UPDATE d.TabelData set Status=1 where IdTabel='$json_obj->id'");
    //echo "</pre>";
    if( $sqlupdate === false) {
        if( ($errors = sqlsrv_errors() ) != null) {
            foreach( $errors as $error ) {
                echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
                echo "code: ".$error[ 'code']."<br />";
                echo "message: ".$error[ 'message']."<br />";
            }
        }
    }else{
        echo "ok";
    }
}
if($json_obj->menuId==10){
    $sqlupdate=sqlsrv_query($conn,"UPDATE d.TabelData set Status=0 where IdTabel='$json_obj->id'");
    //echo "</pre>";
    if( $sqlupdate === false) {
        if( ($errors = sqlsrv_errors() ) != null) {
            foreach( $errors as $error ) {
                echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
                echo "code: ".$error[ 'code']."<br />";
                echo "message: ".$error[ 'message']."<br />";
            }
        }
    }else{
        echo "ok";
    }
}
?>