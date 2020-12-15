<main id="js-page-content" role="main" class="page-content">
    <ol class="breadcrumb page-breadcrumb">
        <li class="position-absolute pos-top pos-right "><span class="js-get-date"></span></li>
    </ol>
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-clipboard-list'></i> Daftar Laporan Kinerja WFH
        </h1>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Daftar Laporan Kinerja WFH
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="form-group row">
                            <label for="nama" class="col-sm-2 col-form-label  ">Nama</label>
                            <div class="col-sm-10">
                                <input value="<?php echo $_SESSION['nama'] ?>" class="form-control" name="nama" id="nama" maxlength="250" placeholder="Isikan Nama Rapat" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama" class="col-sm-2 col-form-label  ">Unit Kerja</label>
                            <div class="col-sm-10">
                                <input value="<?php echo $_SESSION['unitkerja'] ?>" class="form-control" name="nama" id="nama" maxlength="250" placeholder="Isikan Nama Rapat" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama" class="col-sm-2 col-form-label  ">Daftar File</label>
                            <div class="col-sm-10">
                                <button class="btn btn-sm btn-default waves-effect waves-themed" onclick="toggle()">Open/Close All </button>
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
            $sql=mysqli_query($conn,"SELECT * from file 
            where unitkerja='".$_SESSION['unitkerja_id']."' 
            and wilayah='".$_SESSION['wilayah_id']."' order by nama_file asc");

            $sql_user=mysqli_query($conn,"SELECT * from pegawai_selindo where
            kdprop='$kode_prov' and kdkab='$kode_kab' 
            and kdorg like  '".$unit."%' ");
        }if($_SESSION['jabatan']=='Eselon III'){
            $unit=substr($_SESSION['unitkerja_id'],0,3);
            $sql=mysqli_query($conn,"SELECT * from file 
            where unitkerja like '".$unit."%' 
            and wilayah='".$_SESSION['wilayah_id']."' order by nama_file asc");

            $sql_user=mysqli_query($conn,"SELECT * from pegawai_selindo where
            kdprop='$kode_prov' and kdkab='$kode_kab' 
            and kdorg like  '".$unit."%' ");
        }if($_SESSION['jabatan']=='Eselon II'){
            $unit=substr($_SESSION['unitkerja_id'],0,2);
            $sql=mysqli_query($conn,"SELECT * from file 
            where unitkerja like '".$unit."%' 
            and wilayah like '".substr($_SESSION['wilayah_id'],0,2)."%' order by nama_file asc");
            
            $sql_user=mysqli_query($conn,"SELECT * from pegawai_selindo where
            kdprop='$kode_prov'
            and kdorg like  '".$unit."%' ");
        }if($_SESSION['jabatan']=='Eselon I'){
            $unit=substr($_SESSION['unitkerja_id'],0,1);
            $sql=mysqli_query($conn,"SELECT * from file 
            where unitkerja like '".$unit."%' 
            and wilayah like '".substr($_SESSION['wilayah_id'],0,1)."%' order by nama_file asc");
            
            $sql_user=mysqli_query($conn,"SELECT * from pegawai_selindo where
            kdprop='$kode_prov'
            and kdorg like  '".$unit."%' ");
        }  
            
    }else{
        $sql=mysqli_query($conn,"SELECT * from file 
            where nip='".$_SESSION['niplama']."' order by nama_file asc");
        $sql_user=mysqli_query($conn,"SELECT * from pegawai_selindo where
        niplama='".$_SESSION['niplama']."'");
    }
    
    //echo $_SESSION['unitkerja'];
    $files_hari=[];
    $files_bulan=[];
    $pegawai=[];
    $no=1;
    while($data=mysqli_fetch_array($sql)){
        if($data['is_bulan']==0){
            $periode="harian";
            $data['unitkerja_m'] = $data['wilayah']."_".$data['unitkerja'];
            $data['nip_m']=$data['wilayah']."_".$data['unitkerja']."_".$data['nip'];
            if(strlen($data['nip'])<10)
            $data['bulan']=substr($data['nama_file'],24,7);
            $files_hari[]=$data;
        }else{
            $periode="bulanan"; 
            $data['unitkerja_m'] = $data['wilayah']."_".$data['unitkerja'];
            $data['nip_m']=$data['wilayah']."_".$data['unitkerja']."_".$data['nip'];
            $files_bulan[]=$data;
        } 
            $no++;
    }
    while($data_peg=mysqli_fetch_array($sql_user)){
        $pegawai[$data_peg['niplama']]=$data_peg['nama'];

    }
    //print_r($pegawai);
    $wilayah_hari = array_unique(array_column($files_hari, 'wilayah'));
    $unitkerja_hari = array_unique(array_column($files_hari, 'unitkerja_m'));
    $nip_hari = array_unique(array_column($files_hari, 'nip_m'));
    $wilayah_bulan = array_unique(array_column($files_bulan, 'wilayah'));
    $unitkerja_bulan = array_unique(array_column($files_bulan, 'unitkerja_m'));
    $nip_bulan = array_unique(array_column($files_bulan, 'nip_m'));
    $bulan=array_unique(array_column($files_hari, 'bulan'));
?>
                                    
                                <div id="jstree">
                                    <!-- in this example the tree is populated from inline HTML -->
                                    <ul>
                                        <li>Harian
                                            <ul>
<?php
if (!empty($wilayah_hari)){
    if($_SESSION['wilayah_id']<>'0000' && $_SESSION['jabatan']=='Eselon II'){
        foreach($wilayah_hari as $w_hari){
            echo "<li>";
            echo $w_hari."<ul>";
            foreach($unitkerja_hari as $u_hari){
                if(substr($u_hari,0,4)==$w_hari){
                    echo "<li>";
                    echo substr($u_hari,5,5)." ".$organisasi[substr($u_hari,5,5)]."<ul>";
                    if($_SESSION['jabatan']=='Eselon IV' || 
                            $_SESSION['jabatan']=='Eselon III' ||
                            $_SESSION['jabatan']=='Eselon II' ||
                            $_SESSION['jabatan']=='Eselon I'){
                        foreach($nip_hari as $n_hari){
                            if(substr($n_hari,0,4)==substr($u_hari,0,4) 
                                && substr($n_hari,5,5)==substr($u_hari,5,5)){
                                    echo "<li>";
                                    $nip=substr($n_hari,11,9);
                                    echo $nip." ".$pegawai[$nip]."<ul>";
                                    foreach($bulan as $bln){
                                        echo "<li> Bulan ".$bln;
                                        echo "<ul>";
                                        foreach($files_hari as $f_hari){
                                            if($f_hari['wilayah']==substr($n_hari,0,4) 
                                                && $f_hari['unitkerja']==substr($n_hari,5,5)
                                                && $f_hari['nip']==substr($n_hari,11,9)
                                                && $f_hari['bulan']==$bln){
                                                echo "<li data-jstree='{\"icon\":\"fal fa-file-excel\"}'>";
                                                //echo "<a href='".$f_hari['lokasi_file']."' >".$f_hari['nama_file']."</a>";
                                                echo $f_hari['nama_file'];
                                                echo " <button data-toggle=\"modal\" data-target=\"#modal_excel\" onclick=\"lihat('".$f_hari['lokasi_file']."')\" class='btn btn-info btn-pills btn-sm btn-icon fal fa-search' title='Lihat'></button> ";
                                                echo " <button onclick=\"download('".$f_hari['lokasi_file']."')\" class='btn btn-primary btn-pills btn-sm btn-icon fal fa-download' title='Download'></button> ";
                                                if($_SESSION['niplama']==$f_hari['nip']){
                                                    if($f_hari['approve']=='1')
                                                    echo "<button class='btn btn-success btn-pills btn-sm btn-icon fal fa-check' title='Approveed'></button> ";
                                                    else
                                                    echo " <button onclick=\"hapus('".$f_hari['lokasi_file']."','".$f_hari['nama_file']."')\" class='btn btn-danger btn-pills btn-sm btn-icon fal fa-times' title='Hapus'></button> ";      
                                                }
                                                else{
                                                    if($f_hari['approve']=='0')
                                                    echo "<button id='".$f_hari['nama_file']."' onclick=\"approve('".$f_hari['nama_file']."')\" class='btn btn-warning btn-pills btn-sm btn-icon fal fa-exclamation' title='Approve?'></button> ";
                                                    else
                                                    echo "<button class='btn btn-success btn-pills btn-sm btn-icon fal fa-check' title='Approveed'></button> ";
                                                                
                                                }
                                                echo "</li>";
                                            }
                                        }    
                                        echo "</ul>";
                                        echo "</li>";
                                    }
                                    
                                    echo "</ul>";
                                    echo "</li>";
                            }
                        }
                    }else{
                        foreach($bulan as $bln){
                            echo "<li> Bulan ".$bln;
                            echo "<ul>";
                            foreach($files_hari as $f_hari){
                                if($f_hari['wilayah']==substr($u_hari,0,4) && $f_hari['unitkerja']==substr($u_hari,5,5)
                                && $f_hari['bulan']==$bln){
                                    echo "<li data-jstree='{\"icon\":\"fal fa-file-excel\"}'>";
                                    //echo "<a href='".$f_hari['lokasi_file']."' >".$f_hari['nama_file']."</a>";
                                    echo $f_hari['nama_file'];
                                    echo " <button data-toggle=\"modal\" data-target=\"#modal_excel\" onclick=\"lihat('".$f_hari['lokasi_file']."')\" class='btn btn-info btn-pills btn-sm btn-icon fal fa-search' title='Lihat'></button> ";
                                    echo " <button onclick=\"download('".$f_hari['lokasi_file']."')\" class='btn btn-primary btn-pills btn-sm btn-icon fal fa-download' title='Download'></button> ";
                                    if($f_hari['approve']=='1')
                                    echo "<button class='btn btn-success btn-pills btn-sm btn-icon fal fa-check' title='Approveed'></button> ";
                                    else
                                    echo " <button onclick=\"hapus('".$f_hari['lokasi_file']."','".$f_hari['nama_file']."')\" class='btn btn-danger btn-pills btn-sm btn-icon fal fa-times' title='Hapus'></button> ";
                                    echo "</li>";
                                }
                            }
                            echo "</ul>";
                            echo "</li>";
                        }
                        
                    }
                    
                    echo "</ul>";
                    echo "</li>";
                }
            }
            echo "</ul>";
            echo "</li>";
        }
    }else{
        foreach($unitkerja_hari as $u_hari){
            echo "<li>";
            echo substr($u_hari,5,5)." ".$organisasi[substr($u_hari,5,5)]."<ul>";
            if($_SESSION['jabatan']=='Eselon IV' || 
                    $_SESSION['jabatan']=='Eselon III' ||
                    $_SESSION['jabatan']=='Eselon II'||
                    $_SESSION['jabatan']=='Eselon I'){
                foreach($nip_hari as $n_hari){
                    if(substr($n_hari,0,4)==substr($u_hari,0,4) 
                        && substr($n_hari,5,5)==substr($u_hari,5,5)){
                            echo "<li>";
                            $nip=substr($n_hari,11,9);
                            echo substr($n_hari,11,9)." ".$pegawai[$nip]."<ul>";
                            foreach($bulan as $bln){
                                echo "<li> Bulan ".$bln;
                                echo "<ul>";
                                foreach($files_hari as $f_hari){
                                    if($f_hari['wilayah']==substr($n_hari,0,4) 
                                        && $f_hari['unitkerja']==substr($n_hari,5,5)
                                        && $f_hari['nip']==substr($n_hari,11,9)
                                        && $f_hari['bulan']==$bln){
                                        echo "<li data-jstree='{\"icon\":\"fal fa-file-excel\"}'>";
                                        //echo "<a href='".$f_hari['lokasi_file']."' >".$f_hari['nama_file']."</a>";
                                        echo $f_hari['nama_file'];
                                        echo " <button data-toggle=\"modal\" data-target=\"#modal_excel\" onclick=\"lihat('".$f_hari['lokasi_file']."')\" class='btn btn-info btn-pills btn-sm btn-icon fal fa-search' title='Lihat'></button> ";
                                        echo " <button onclick=\"download('".$f_hari['lokasi_file']."')\" class='btn btn-primary btn-pills btn-sm btn-icon fal fa-download' title='Download'></button> ";
                                        if($_SESSION['niplama']==$f_hari['nip']){
                                            if($f_hari['approve']=='1')
                                            echo "<button class='btn btn-success btn-pills btn-sm btn-icon fal fa-check' title='Approveed'></button> ";
                                            else
                                            echo " <button onclick=\"hapus('".$f_hari['lokasi_file']."','".$f_hari['nama_file']."')\" class='btn btn-danger btn-pills btn-sm btn-icon fal fa-times' title='Hapus'></button> ";      
                                        }
                                        else{
                                            if($f_hari['approve']=='0')
                                            echo "<button id='".$f_hari['nama_file']."' onclick=\"approve('".$f_hari['nama_file']."')\" class='btn btn-warning btn-pills btn-sm btn-icon fal fa-exclamation' title='Approve?'></button> ";
                                            else
                                            echo "<button class='btn btn-success btn-pills btn-sm btn-icon fal fa-check' title='Approveed'></button> ";
                                                   
                                        }
                                        echo "</li>";
                                    }
                                }    
                                echo "</ul>";
                                echo "</li>";
                            }
                            echo "</ul>";
                            echo "</li>";
                    }
                }
            }else{
                foreach($bulan as $bln){
                    echo "<li> Bulan ".$bln;
                    echo "<ul>";
                    foreach($files_hari as $f_hari){
                        if($f_hari['wilayah']==substr($u_hari,0,4) && $f_hari['unitkerja']==substr($u_hari,5,5)
                        && $f_hari['bulan']==$bln){
                            echo "<li data-jstree='{\"icon\":\"fal fa-file-excel\"}'>";
                            //echo "<a href='".$f_hari['lokasi_file']."' >".$f_hari['nama_file']."</a>";
                            echo $f_hari['nama_file'];
                            echo " <button data-toggle=\"modal\" data-target=\"#modal_excel\" onclick=\"lihat('".$f_hari['lokasi_file']."')\" class='btn btn-info btn-pills btn-sm btn-icon fal fa-search' title='Lihat'></button> ";
                            echo " <button onclick=\"download('".$f_hari['lokasi_file']."')\" class='btn btn-primary btn-pills btn-sm btn-icon fal fa-download' title='Download'></button> ";
                            if($f_hari['approve']=='1')
                            echo "<button class='btn btn-success btn-pills btn-sm btn-icon fal fa-check' title='Approveed'></button> ";
                            else
                            echo " <button onclick=\"hapus('".$f_hari['lokasi_file']."','".$f_hari['nama_file']."')\" class='btn btn-danger btn-pills btn-sm btn-icon fal fa-times' title='Hapus'></button> ";
                            echo "</li>";
                        }
                    }
                    echo "</ul>";
                    echo "</li>";

                }
            }

            echo "</ul>";
            echo "</li>";
        }
        
        
    }
    
}
?>
                                            </ul>
                                        </li>
                                        <li>Bulanan
                                            <ul>
<?php
if (!empty($wilayah_bulan)){
    if($_SESSION['wilayah_id']<>'0000' && $_SESSION['jabatan']=='Eselon II'){
        foreach($wilayah_bulan as $w_bulan){
            echo "<li>";
            echo $w_bulan."<ul>";
            foreach($unitkerja_bulan as $u_bulan){
                if(substr($u_bulan,0,4)==$w_bulan){
                    echo "<li>";
                    //echo substr($u_bulan,5,5)."<ul>";
                    echo substr($u_bulan,5,5)." ".$organisasi[substr($u_bulan,5,5)]."<ul>";
                    if($_SESSION['jabatan']=='Eselon IV' || 
                        $_SESSION['jabatan']=='Eselon III' ||
                        $_SESSION['jabatan']=='Eselon II'||
                        $_SESSION['jabatan']=='Eselon I'){
                            foreach($nip_bulan as $n_bulan){
                            if(substr($n_bulan,0,4)==substr($u_bulan,0,4) 
                                && substr($n_bulan,5,5)==substr($u_bulan,5,5)){
                                    echo "<li>";
                                    $nip=substr($n_bulan,11,9);
                                    echo $nip." ".$pegawai[$nip]."<ul>";
                                    //echo substr($n_bulan,11,9)."<ul>";
                                    foreach($files_bulan as $f_bulan){
                                        if($f_bulan['wilayah']==substr($n_bulan,0,4) 
                                            && $f_bulan['unitkerja']==substr($n_bulan,5,5)
                                            && $f_bulan['nip']==substr($n_bulan,11,9)){
                                            echo "<li data-jstree='{\"icon\":\"fal fa-file-excel\"}'>";
                                            //echo "<a href='".$f_bulan['lokasi_file']."' >".$f_bulan['nama_file']."</a>";
                                            echo $f_bulan['nama_file'];
                                            echo " <button data-toggle=\"modal\" data-target=\"#modal_excel\" onclick=\"lihat('".$f_bulan['lokasi_file']."')\" class='btn btn-info btn-pills btn-sm btn-icon fal fa-search' title='Lihat'></button> ";
                                            echo " <button onclick=\"download('".$f_bulan['lokasi_file']."')\" class='btn btn-primary btn-pills btn-sm btn-icon fal fa-download' title='Download'></button> ";
                                            if($_SESSION['niplama']==$f_bulan['nip']){
                                                if($f_bulan['approve']=='1')
                                                echo "<button class='btn btn-success btn-pills btn-sm btn-icon fal fa-check' title='Approveed'></button> ";
                                                else
                                                echo " <button onclick=\"hapus('".$f_bulan['lokasi_file']."','".$f_bulan['nama_file']."')\" class='btn btn-danger btn-pills btn-sm btn-icon fal fa-times' title='Hapus'></button> ";
                                            }else{
                                                if($f_bulan['approve']=='0')
                                                echo " <button  id='".$f_bulan['nama_file']."' onclick=\"approve('".$f_bulan['nama_file']."')\" class='btn btn-warning btn-pills btn-sm btn-icon fal fa-exclamation' title='Approve?'></button> ";
                                                else
                                                echo "<button class='btn btn-success btn-pills btn-sm btn-icon fal fa-check' title='Approveed'></button> ";
                                                   
                                            }
                                            echo "</li>";
                                        }
                                    }
                                    echo "</ul>";
                                    echo "</li>";
                            }
                        }
                    }else{
                        foreach($files_bulan as $f_bulan){
                            if($f_bulan['wilayah']==substr($u_bulan,0,4) && $f_bulan['unitkerja']==substr($u_bulan,5,5)){
                                echo "<li data-jstree='{\"icon\":\"fal fa-file-excel\"}'>";
                                //echo "<a href='".$f_bulan['lokasi_file']."' >".$f_bulan['nama_file']."</a>";
                                echo $f_bulan['nama_file'];
                                echo " <button data-toggle=\"modal\" data-target=\"#modal_excel\" onclick=\"lihat('".$f_bulan['lokasi_file']."')\" class='btn btn-info btn-pills btn-sm btn-icon fal fa-search' title='Lihat'></button> ";
                                echo " <button onclick=\"download('".$f_bulan['lokasi_file']."')\" class='btn btn-primary btn-pills btn-sm btn-icon fal fa-download' title='Download'></button> ";
                                if($f_bulan['approve']=='1')
                                echo "<button class='btn btn-success btn-pills btn-sm btn-icon fal fa-check' title='Approveed'></button> ";
                                else
                                echo " <button onclick=\"hapus('".$f_bulan['lokasi_file']."','".$f_bulan['nama_file']."')\" class='btn btn-danger btn-pills btn-sm btn-icon fal fa-times' title='Hapus'></button> ";
                                echo "</li>";
                            }
                        }
                    }
                    echo "</ul>";
                    echo "</li>";
                }
            }
            echo "</ul>";
            echo "</li>";
        }
    }else{
        foreach($unitkerja_bulan as $u_bulan){
            echo "<li>";
            //echo substr($u_bulan,5,5)."<ul>";
            echo substr($u_bulan,5,5)." ".$organisasi[substr($u_bulan,5,5)]."<ul>";
            if($_SESSION['jabatan']=='Eselon IV' || 
                $_SESSION['jabatan']=='Eselon III' ||
                $_SESSION['jabatan']=='Eselon II'||
                $_SESSION['jabatan']=='Eselon I'){
                    foreach($nip_bulan as $n_bulan){
                    if(substr($n_bulan,0,4)==substr($u_bulan,0,4) 
                        && substr($n_bulan,5,5)==substr($u_bulan,5,5)){
                            echo "<li>";
                            $nip=substr($n_bulan,11,9);
                            echo $nip." ".$pegawai[$nip]."<ul>";
                            //echo substr($n_bulan,11,9)."<ul>";
                            foreach($files_bulan as $f_bulan){
                                if($f_bulan['wilayah']==substr($n_bulan,0,4) 
                                    && $f_bulan['unitkerja']==substr($n_bulan,5,5)
                                    && $f_bulan['nip']==substr($n_bulan,11,9)){
                                    echo "<li data-jstree='{\"icon\":\"fal fa-file-excel\"}'>";
                                    //echo "<a href='".$f_bulan['lokasi_file']."' >".$f_bulan['nama_file']."</a>";
                                    echo $f_bulan['nama_file'];
                                    echo " <button data-toggle=\"modal\" data-target=\"#modal_excel\" onclick=\"lihat('".$f_bulan['lokasi_file']."')\" class='btn btn-info btn-pills btn-sm btn-icon fal fa-search' title='Lihat'></button> ";
                                    echo " <button onclick=\"download('".$f_bulan['lokasi_file']."')\" class='btn btn-primary btn-pills btn-sm btn-icon fal fa-download' title='Download'></button> ";
                                    if($_SESSION['niplama']==$f_bulan['nip']){
                                        if($f_bulan['approve']=='1')
                                        echo "<button class='btn btn-success btn-pills btn-sm btn-icon fal fa-check' title='Approveed'></button> ";
                                        else
                                        echo " <button onclick=\"hapus('".$f_bulan['lokasi_file']."','".$f_bulan['nama_file']."')\" class='btn btn-danger btn-pills btn-sm btn-icon fal fa-times' title='Hapus'></button> ";
                                    }else{
                                        if($f_bulan['approve']=='0')
                                        echo " <button id='".$f_bulan['nama_file']."' onclick=\"approve('".$f_bulan['nama_file']."')\" class='btn btn-warning btn-pills btn-sm btn-icon fal fa-exclamation' title='Approve?'></button> ";
                                        else
                                        echo "<button class='btn btn-success btn-pills btn-sm btn-icon fal fa-check' title='Approveed'></button> ";
                                                   
                                    }
                                    echo "</li>";
                                }
                            }
                            echo "</ul>";
                            echo "</li>";
                    }
                }
            }else{
                foreach($files_bulan as $f_bulan){
                    if($f_bulan['wilayah']==substr($u_bulan,0,4) && $f_bulan['unitkerja']==substr($u_bulan,5,5)){
                        echo "<li data-jstree='{\"icon\":\"fal fa-file-excel\"}'>";
                        //echo "<a href='".$f_bulan['lokasi_file']."' >".$f_bulan['nama_file']."</a>";
                        echo $f_bulan['nama_file'];
                        echo " <button data-toggle=\"modal\" data-target=\"#modal_excel\" onclick=\"lihat('".$f_bulan['lokasi_file']."')\" class='btn btn-info btn-pills btn-sm btn-icon fal fa-search' title='Lihat'></button> ";
                        echo " <button onclick=\"download('".$f_bulan['lokasi_file']."')\" class='btn btn-primary btn-pills btn-sm btn-icon fal fa-download' title='Download'></button> ";
                        if($f_bulan['approve']=='1')
                        echo "<button class='btn btn-success btn-pills btn-sm btn-icon fal fa-check' title='Approveed'></button> ";
                        else
                        echo " <button onclick=\"hapus('".$f_bulan['lokasi_file']."','".$f_bulan['nama_file']."')\" class='btn btn-danger btn-pills btn-sm btn-icon fal fa-times' title='Hapus'></button> ";
                        echo "</li>";
                    }
                }
            }
            echo "</ul>";
            echo "</li>";
        }
        
    }
}
?>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
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
<script>
document.getElementById("loading_proses").style.display = "none";
function lihat(id){
    //alert(id)
    var xhr = new XMLHttpRequest();
    var url = "submit_ajax.php";
    var captionText = document.getElementById("caption");
    captionText.innerHTML ="";
    document.getElementById("loading_proses").style.display = "block";
    
    var data = JSON.stringify({
        file: id,
        menuId: 4
    });

    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    xhr.onload = function () {               
        console.log (this.responseText);
        if(this.responseText=='ok'){
            window.location.href = "index.php?menu=<?php echo encrypt('awal') ?>";
            document.getElementById("loading_proses").style.display = "none";
        }else {
            //Swal.fire(
            //{
            //    icon: "error",
            //    title: "Oops...",
            //    text: this.responseText,
            //});   
            
            captionText.innerHTML = this.responseText;
            document.getElementById("loading_proses").style.display = "none";
        }
    };

    xhr.send(data);
    return false;

}
function hapus(id,nama){
        Swal.fire(
        {
            title: "Apakah yakin akan menghapus file "+nama+"?",
            text: "Anda tidak dapat membatalkan proses",
            width: 600,
            icon: "warning",
            showCancelButton: true,
            cancelButtonText: "Tidak",
            confirmButtonText: "Ya"
        }).then(function(result)
        {
            if (result.value)
            {
                var xhr = new XMLHttpRequest();
                var url = "submit_ajax.php";
                var data = JSON.stringify({
                    lokasi: id,
                    file: nama,
                    menuId: 8
                });

                xhr.open("POST", url, true);
                xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
                xhr.onload = function () {               
                    console.log (this.responseText);
                    if(this.responseText=='ok'){
                        Swal.fire({
                            title: "Terhapus",
                            text: "File "+nama+" sudah terhapus",
                            width: 600,
                            icon: "success",
                            confirmButtonText: "Ok"
                        }).then(function(result)
                        {
                            window.location.href = "index.php?menu=<?php echo encrypt('laporan')?>";
                        });  
                    }else {
                        Swal.fire("Oops...", this.responseText, "error");
                    }
                };

                xhr.send(data);
                return false;
                //Swal.fire("Deleted!", "Your file has been deleted.", "success");
            }
        });
    }
function download(id){
    window.location.href=id;
}
function approve(id){
    Swal.fire(
        {
            title: "Apakah yakin akan menerima file "+id+"?",
            text: "Anda tidak dapat membatalkan proses",
            width: 600,
            icon: "warning",
            showCancelButton: true,
            cancelButtonText: "Tidak",
            confirmButtonText: "Ya"
        }).then(function(result)
        {
            if (result.value)
            {
                var xhr = new XMLHttpRequest();
                var url = "submit_ajax.php";
                var data = JSON.stringify({
                    file: id,
                    menuId: 5
                });

                xhr.open("POST", url, true);
                xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
                xhr.onload = function () {               
                    console.log (this.responseText);
                    if(this.responseText=='ok'){
                        Swal.fire({
                            title: "Berhasil",
                            text: "File "+id+" sudah diterima",
                            width: 600,
                            icon: "success",
                            confirmButtonText: "Ok"
                        }).then(function(result)
                        {
                            document.getElementById(id).removeAttribute("class");
                            document.getElementById(id).setAttribute("class", "btn btn-success btn-pills btn-sm btn-icon fal fa-check");
                        });  
                    }else {
                        Swal.fire("Oops...", this.responseText, "error");
                    }
                };

                xhr.send(data);
                return false;
            }
        });
}

</script>