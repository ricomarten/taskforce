<?php
    $kode_prov=substr($_SESSION['wilayah_id'],0,2);
    $kode_kab=substr($_SESSION['wilayah_id'],2,2);
    $sql_unit=mysqli_query($conn,"SELECT * FROM unit_kerja_pusat
    UNION SELECT * FROM unit_kerja_provinsi
    UNION SELECT * FROM unit_kerja_kabkot");
    $organisasi=[];
    while($data_unit=mysqli_fetch_array($sql_unit)){
        $organisasi[$data_unit['unit_kerja_id']]=$data_unit['unit_kerja'];
    }
    if($_SESSION['jabatan']=='Eselon IV' || 
        $_SESSION['jabatan']=='Eselon III' ||
        $_SESSION['jabatan']=='Eselon II' || 
        $_SESSION['jabatan']=='Eselon I'){
        if($_SESSION['jabatan']=='Eselon IV'){
            $unit=$_SESSION['unitkerja_id'];
            $sql=mysqli_query($conn,"SELECT
            file.nip,
            min(pegawai_selindo.nama) nama,
            CASE 
                WHEN MID(file.nama_file, 22, 5)='bulan' THEN
                    MID(file.nama_file, 28, 1)
                ELSE
                    CAST(MID(file.nama_file, 25, 2) as UNSIGNED)
            END bulan,
            Count(file.nama_file) jml_file,
            Min(file.wilayah) wilayah,
            Min(file.unitkerja) unitkerja,
            
            sum( CASE 
                WHEN is_bulan='1' THEN 1
                ELSE 0
            END) bulanan,
            sum(CASE 
                WHEN is_bulan='0' THEN 1
                ELSE 0
            END) harian,
            sum(CASE 
                WHEN approve='1' and is_bulan='1' THEN 1
                ELSE 0
            END) approve_bulan,
            sum(CASE 
                WHEN approve='1' and is_bulan='0' THEN 1
                ELSE 0
            END) approve_hari
            FROM
            pegawai_selindo
            INNER JOIN file ON pegawai_selindo.niplama = file.nip
            GROUP BY
            pegawai_selindo.niplama,CASE 
                WHEN MID(file.nama_file, 22, 5)='bulan' THEN
                    MID(file.nama_file, 28, 1)
                ELSE
                    CAST(MID(file.nama_file, 25, 2) as UNSIGNED)
            END 
 
            HAVING unitkerja='".$_SESSION['unitkerja_id']."' 
            and wilayah='".$_SESSION['wilayah_id']."' order by nama,bulan asc");

            $sql_user=mysqli_query($conn,"SELECT * from pegawai_selindo where
            kdprop='$kode_prov' and kdkab='$kode_kab' 
            and kdorg like  '".$unit."%' ");
        }if($_SESSION['jabatan']=='Eselon III'){
            $unit=substr($_SESSION['unitkerja_id'],0,3);
            $sql=mysqli_query($conn,"SELECT
            file.nip,
            min(pegawai_selindo.nama) nama,
            CASE 
                WHEN MID(file.nama_file, 22, 5)='bulan' THEN
                    MID(file.nama_file, 28, 1)
                ELSE
                    CAST(MID(file.nama_file, 25, 2) as UNSIGNED)
            END bulan,
            Count(file.nama_file) jml_file,
            Min(file.wilayah) wilayah,
            Min(file.unitkerja) unitkerja,
            
            sum( CASE 
                WHEN is_bulan='1' THEN 1
                ELSE 0
            END) bulanan,
            sum(CASE 
                WHEN is_bulan='0' THEN 1
                ELSE 0
            END) harian,
            sum(CASE 
                WHEN approve='1' and is_bulan='1' THEN 1
                ELSE 0
            END) approve_bulan,
            sum(CASE 
                WHEN approve='1' and is_bulan='0' THEN 1
                ELSE 0
            END) approve_hari
            FROM
            pegawai_selindo
            INNER JOIN file ON pegawai_selindo.niplama = file.nip
            GROUP BY
            pegawai_selindo.niplama,CASE 
                WHEN MID(file.nama_file, 22, 5)='bulan' THEN
                    MID(file.nama_file, 28, 1)
                ELSE
                    CAST(MID(file.nama_file, 25, 2) as UNSIGNED)
            END 
 
            HAVING unitkerja like '".$unit."%' 
            and wilayah='".$_SESSION['wilayah_id']."' order by nama,bulan asc");

            $sql_user=mysqli_query($conn,"SELECT * from pegawai_selindo where
            kdprop='$kode_prov' and kdkab='$kode_kab' 
            and kdorg like  '".$unit."%' ");
        }if($_SESSION['jabatan']=='Eselon II'){
            $unit=substr($_SESSION['unitkerja_id'],0,2);
            $sql=mysqli_query($conn,"SELECT
            file.nip,
            min(pegawai_selindo.nama) nama,
            CASE 
                WHEN MID(file.nama_file, 22, 5)='bulan' THEN
                    MID(file.nama_file, 28, 1)
                ELSE
                    CAST(MID(file.nama_file, 25, 2) as UNSIGNED)
            END bulan,
            Count(file.nama_file) jml_file,
            Min(file.wilayah) wilayah,
            Min(file.unitkerja) unitkerja,
            
            sum( CASE 
                WHEN is_bulan='1' THEN 1
                ELSE 0
            END) bulanan,
            sum(CASE 
                WHEN is_bulan='0' THEN 1
                ELSE 0
            END) harian,
            sum(CASE 
                WHEN approve='1' and is_bulan='1' THEN 1
                ELSE 0
            END) approve_bulan,
            sum(CASE 
                WHEN approve='1' and is_bulan='0' THEN 1
                ELSE 0
            END) approve_hari
            FROM
            pegawai_selindo
            INNER JOIN file ON pegawai_selindo.niplama = file.nip
            GROUP BY
            pegawai_selindo.niplama,CASE 
                WHEN MID(file.nama_file, 22, 5)='bulan' THEN
                    MID(file.nama_file, 28, 1)
                ELSE
                    CAST(MID(file.nama_file, 25, 2) as UNSIGNED)
            END 
 
            HAVING unitkerja like '".$unit."%' 
            and wilayah like '".substr($_SESSION['wilayah_id'],0,2)."%' order by nama,bulan asc");
            
            $sql_user=mysqli_query($conn,"SELECT * from pegawai_selindo where
            kdprop='$kode_prov'
            and kdorg like  '".$unit."%' ");
        }if($_SESSION['jabatan']=='Eselon I'){
            $unit=substr($_SESSION['unitkerja_id'],0,1);
            $sql=mysqli_query($conn,"SELECT
            file.nip,
            min(pegawai_selindo.nama) nama,
            CASE 
                WHEN MID(file.nama_file, 22, 5)='bulan' THEN
                    MID(file.nama_file, 28, 1)
                ELSE
                    CAST(MID(file.nama_file, 25, 2) as UNSIGNED)
            END bulan,
            Count(file.nama_file) jml_file,
            Min(file.wilayah) wilayah,
            Min(file.unitkerja) unitkerja,
            
            sum( CASE 
                WHEN is_bulan='1' THEN 1
                ELSE 0
            END) bulanan,
            sum(CASE 
                WHEN is_bulan='0' THEN 1
                ELSE 0
            END) harian,
            sum(CASE 
                WHEN approve='1' and is_bulan='1' THEN 1
                ELSE 0
            END) approve_bulan,
            sum(CASE 
                WHEN approve='1' and is_bulan='0' THEN 1
                ELSE 0
            END) approve_hari
            FROM
            pegawai_selindo
            INNER JOIN file ON pegawai_selindo.niplama = file.nip
            GROUP BY
            pegawai_selindo.niplama,CASE 
                WHEN MID(file.nama_file, 22, 5)='bulan' THEN
                    MID(file.nama_file, 28, 1)
                ELSE
                    CAST(MID(file.nama_file, 25, 2) as UNSIGNED)
            END 
  
            HAVING unitkerja like '".$unit."%' 
            and wilayah like '".substr($_SESSION['wilayah_id'],0,1)."%' order by nama,bulan asc");
            
            $sql_user=mysqli_query($conn,"SELECT * from pegawai_selindo where
            kdprop='$kode_prov'
            and kdorg like  '".$unit."%' ");
        }  
            
    }else{
        $sql=mysqli_query($conn,"SELECT
        file.nip,
        min(pegawai_selindo.nama) nama,
        CASE 
            WHEN MID(file.nama_file, 22, 5)='bulan' THEN
                MID(file.nama_file, 28, 1)
            ELSE
                CAST(MID(file.nama_file, 25, 2) as UNSIGNED)
        END bulan,
        Count(file.nama_file) jml_file,
        Min(file.wilayah) wilayah,
        Min(file.unitkerja) unitkerja,
        
        sum( CASE 
            WHEN is_bulan='1' THEN 1
            ELSE 0
        END) bulanan,
        sum(CASE 
            WHEN is_bulan='0' THEN 1
            ELSE 0
        END) harian,
        sum(CASE 
            WHEN approve='1' and is_bulan='1' THEN 1
            ELSE 0
        END) approve_bulan,
        sum(CASE 
            WHEN approve='1' and is_bulan='0' THEN 1
            ELSE 0
        END) approve_hari
        FROM
        pegawai_selindo
        INNER JOIN file ON pegawai_selindo.niplama = file.nip
        GROUP BY
        pegawai_selindo.niplama,CASE 
            WHEN MID(file.nama_file, 22, 5)='bulan' THEN
                MID(file.nama_file, 28, 1)
            ELSE
                CAST(MID(file.nama_file, 25, 2) as UNSIGNED)
        END 

            HAVING nip='".$_SESSION['niplama']."' order by nama,bulan asc");
        $sql_user=mysqli_query($conn,"SELECT * from pegawai_selindo where
        niplama='".$_SESSION['niplama']."'");
    }

     //echo $_SESSION['unitkerja'];
    $pegawai=[];$nip=[];
    while($data=mysqli_fetch_array($sql)){
        $rekap[]=$data;
    }
    while($data_peg=mysqli_fetch_array($sql_user)){
        $pegawai[$data_peg['niplama']]=$data_peg['nama'];
        $nip[]=$data_peg['niplama'];
    }
    $pegawai_isi = array_unique(array_column($rekap, 'nip'));
    //echo "<pre>";
    //print_r($pegawai_isi);
    //print_r($pegawai);
    //print_r($rekap);
    $result=array_diff($nip,$pegawai_isi);
    //echo "</pre>";
    $nama_bulan = array( 1 => '[01] Januari',
                     2 => '[02] Februari', 
                     3 => '[03] Maret', 
                     4 => '[04] April', 
                     5 => '[05] Mei', 
                     6 => '[06] Juni', 
                     7 => '[07] Juli', 
                     8 => '[08] Agustus', 
                     9 => '[09] September', 
                     10 => '[10] Oktober', 
                     11 => '[11] November', 
                     12 => '[12] Desember');

    ?>
<main id="js-page-content" role="main" class="page-content">
    <ol class="breadcrumb page-breadcrumb">
        <li class="position-absolute pos-top pos-right "><span class="js-get-date"></span></li>
    </ol>
    
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-clipboard-list'></i> Rekap Laporan Kinerja WFH
        </h1>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div id="panel-2" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Rekap Pegawai Kirim Laporan Kinerja WFH <?php echo $_SESSION['unitkerja'];?>
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <table id="dt-basic-example2" class="table table-bordered table-hover  w-100" >
                            <thead>
                                <tr>
                                    <th rowspan="2">Nama</th>
                                    <th colspan="12"><center>Bulan</center></th>
                                </tr>
                                <tr>
                                    <th>01</th>
                                    <th>02</th>
                                    <th>03</th>
                                    <th>04</th>
                                    <th>05</th>
                                    <th>06</th>
                                    <th>07</th>
                                    <th>08</th>
                                    <th>09</th>
                                    <th>10</th>
                                    <th>11</th>
                                    <th>12</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                foreach($pegawai_isi as $sudah){
                                    $cetak=[];
                                    echo "<tr>";
                                    echo "<td class='table-success'>".$pegawai[$sudah]."</td>";
                                    for ($i=1;$i<=12;$i++){
                                        foreach($rekap as $data_rekap){
                                            if($data_rekap['nip']==$sudah ){                                            
                                                if($data_rekap['bulan']==$i){
                                                   // $cetak[$i]="<td class='table-success'><button class='btn btn-success btn-xs btn-icon rounded-circle waves-effect waves-themed'>
                                                    //<i class='fal fa-check'></i>
                                                   // </button></td>";
                                                   $cetak[$i]="berhasil";
                                                }             
                                            }
                                        }
                                        
                                    }
                                    for($j=1;$j<=12;$j++){
                                        if(!empty($cetak[$j])){
                                            echo "<td class='table-success'><button class='btn btn-success btn-xs btn-icon rounded-circle waves-effect waves-themed'>
                                                    <i class='fal fa-check'></i>
                                                    </button></td>";
                                        }else{
                                            echo "<td class='table-danger'><button class='btn btn-danger btn-xs btn-icon rounded-circle waves-effect waves-themed'>
                                                    <i class='fal fa-times'></i>
                                                    </button></td>";
                                        }
                                    }
                                    echo "</tr>";
                                }
                                foreach($result as $belum){
                                    echo "<tr class='table-danger'>";
                                    echo "<td>".$pegawai[$belum]."</td>";
                                    for ($i=0;$i<=11;$i++){
                                        echo "<td><button class='btn btn-danger btn-xs btn-icon rounded-circle waves-effect waves-themed'>
                                            <i class='fal fa-times'></i>
                                            </button></td>";
                                    }
                                    echo "</tr>";
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Rekap Jumlah Laporan Kinerja WFH <?php echo $_SESSION['unitkerja'];?>
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <table id="dt-basic-example" class="table table-bordered table-hover  w-100" >
                            <thead>
                                <tr>
                                    <th rowspan="2">Nama</th>
                                    <th rowspan="2">Bulan</th>
                                    <th colspan="3" class='table-primary'><center>Jumlah Laporan Harian</center></th>
                                    <th colspan="3" class='table-secondary'><center>Jumlah Laporan Bulanan</center></th>
                                </tr>
                                <tr>
                                    <th class='table-success'>Approved</th>
                                    <th class='table-danger'>Unapproved</th>
                                    <th class='table-warning'>Total</th>
                                    <th class='table-success'>Approved</th>
                                    <th class='table-danger'>Unapproved</th>
                                    <th class='table-warning'>Total</th>
                                </tr>
                            </thead>
                            <tbody>
<?php

foreach($rekap as $rkp){
    echo "<tr>";
    echo "<td>".$rkp['nama']."</td>";
    echo "<td>".$nama_bulan[$rkp['bulan']]."</td>";
   
    echo "<td class='table-success'>".$rkp['approve_hari']."</td>";
    echo "<td class='table-danger'>".($rkp['harian']-$rkp['approve_hari'])."</td>";
    echo "<td class='table-warning'>".$rkp['harian']."</td>";

    echo "<td class='table-success'>".$rkp['approve_bulan']."</td>";
    echo "<td class='table-danger'>".($rkp['bulanan']-$rkp['approve_bulan'])."</td>";
    echo "<td class='table-warning'>".$rkp['bulanan']."</td>";
    echo "</tr>";

}

?>
                                
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Jumlah</th>
                                    <th>&nbsp;</th>
                                    <th class='sum'><?php //echo $total1 ?></th>
                                    <th class='sum'><?php //echo $total2 ?></th>
                                    <th class='sum'><?php //echo $total3 ?></th>
                                    <th class='sum'><?php //echo $total4 ?></th>
                                    <td class='sum'><?php //echo $total5 ?></td>
                                    <td class='sum'><?php //echo $total6 ?></td>
                                </tr>
                            </tfoot>
                        </table>    
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- modal -->
<div class="modal fade" id="modal_excel" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                   Detail Dokumen
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="loading_proses">
                            <strong>Loading...</strong> <img src="img/loading.gif"/>
                        </div>
                        <div class="table-responsive">    
                        <div id="caption"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
