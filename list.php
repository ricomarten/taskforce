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
                    <button class="btn btn-sm btn-default waves-effect waves-themed" onclick="toggle()">Open/Close All </button>
                        <?php
                            $sql=mysqli_query($conn,"SELECT * from file order by nama_file asc");
                            $files_hari=[];
                            $files_bulan=[];
                            $no=1;
                            while($data=mysqli_fetch_array($sql)){
                                if($data['is_bulan']==0){
                                    $periode="harian";
                                    $data['unitkerja_m'] = $data['wilayah']."_".$data['unitkerja'];
                                    $files_hari[]=$data;
                                }else{
                                    $periode="bulanan"; 
                                    $data['unitkerja_m'] = $data['wilayah']."_".$data['unitkerja'];
                                    $files_bulan[]=$data;
                                } 
                                    $no++;
                            }
                            $wilayah_hari = array_unique(array_column($files_hari, 'wilayah'));
                            $unitkerja_hari = array_unique(array_column($files_hari, 'unitkerja_m'));
                            $wilayah_bulan = array_unique(array_column($files_bulan, 'wilayah'));
                            $unitkerja_bulan = array_unique(array_column($files_bulan, 'unitkerja_m'));
                        ?>
                            
                        <div id="jstree">
                            <!-- in this example the tree is populated from inline HTML -->
                            <ul>
                                <li>Harian
                                    <ul>
                                    <?php
                                        if (!empty($wilayah_hari)){
                                            foreach($wilayah_hari as $w_hari){
                                                echo "<li>";
                                                echo $w_hari."<ul>";
                                                foreach($unitkerja_hari as $u_hari){
                                                    if(substr($u_hari,0,4)==$w_hari){
                                                        echo "<li>";
                                                        echo substr($u_hari,5,5)."<ul>";
                                                        foreach($files_hari as $f_hari){
                                                            if($f_hari['wilayah']==substr($u_hari,0,4) && $f_hari['unitkerja']==substr($u_hari,5,5)){
                                                                echo "<li data-jstree='{\"icon\":\"fal fa-file-excel\"}'>";
                                                                echo "<a href='".$f_hari['lokasi_file']."' >".substr($f_hari['nama_file'],10,strlen($f_hari['nama_file']))."</a>";
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
                                        ?>
                                            </ul>
                                        </li>
                                        <li>Bulanan
                                            <ul>
                                        <?php
                                        if (!empty($wilayah_bulan)){
                                            foreach($wilayah_bulan as $w_bulan){
                                                echo "<li>";
                                                echo $w_bulan."<ul>";
                                                foreach($unitkerja_bulan as $u_bulan){
                                                    if(substr($u_bulan,0,4)==$w_bulan){
                                                        echo "<li>";
                                                        echo substr($u_bulan,5,5)."<ul>";
                                                        foreach($files_bulan as $f_bulan){
                                                            if($f_bulan['wilayah']==substr($u_bulan,0,4) && $f_bulan['unitkerja']==substr($u_bulan,5,5)){
                                                                echo "<li data-jstree='{\"icon\":\"fal fa-file-excel\"}'>";
                                                                echo "<a href='".$f_bulan['lokasi_file']."' >".substr($f_bulan['nama_file'],10,strlen($f_bulan['nama_file']))."</a>";
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
</main>
