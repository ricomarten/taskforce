<main id="js-page-content" role="main" class="page-content">
    <ol class="breadcrumb page-breadcrumb">
        <li class="position-absolute pos-top pos-right "><span class="js-get-date"></span></li>
    </ol>
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-database'></i> Rekap Data
        </h1>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div id="panel-2" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Rekap Data
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <table id="dt-basic-example" class="table table-bordered table-hover  w-100" style="width:100%">
                            <thead>
                                <tr class="table-active text-center">
                                    <th>Provinsi</th>
                                    <th>Kabupaten/Kota</th>
                                    <th>Punya NIK L</th>
                                    <th>Punya NIK P</th>
                                    <th>Tidak Punya NIK L</th>
                                    <th>Tidak Punya NIK P</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php                            
                                $sql="SELECT
                                master_kab.KDPROV,
                                master_kab.KDKAB,
                                master_kab.NMKAB,
                                master_prov.NMPROV,
                                (SELECT
                                count(detail_data.nik)
                                FROM
                                detail_data
                                INNER JOIN data ON 
                                detail_data.id_data = data.id 
                                where data.prov=master_kab.KDPROV and data.kab=master_kab.KDKAB and detail_data.nik='-' and jenkel='L') as tanpa_nip_l,
                                (SELECT
                                count(detail_data.nik)
                                FROM
                                detail_data
                                INNER JOIN data ON 
                                detail_data.id_data = data.id 
                                where data.prov=master_kab.KDPROV and data.kab=master_kab.KDKAB and detail_data.nik='-' and jenkel='P') as tanpa_nip_p,
                                (SELECT
                                count(detail_data.nik)
                                FROM
                                detail_data
                                INNER JOIN data ON 
                                detail_data.id_data = data.id 
                                where data.prov=master_kab.KDPROV and data.kab=master_kab.KDKAB and detail_data.nik<>'-' and jenkel='L') as nip_l,
                                (SELECT
                                count(detail_data.nik)
                                FROM
                                detail_data
                                INNER JOIN data ON 
                                detail_data.id_data = data.id 
                                where data.prov=master_kab.KDPROV and data.kab=master_kab.KDKAB and detail_data.nik<>'-' and jenkel='P') as nip_p
                                FROM
                                master_kab LEFT JOIN master_prov on master_prov.KDPROV=master_kab.KDPROV
                                
                                ";
                                if($_SESSION['prov']=='00'){
                                    $sql=$sql;
                                }else{
                                    $sql=$sql."where master_kab.KDPROV='".$_SESSION['prov']."'";
                                }                         
                                //$query=sqlsrv_query($conn,$sql);
                                $query=mysqli_query($conn,$sql);
                                //echo $sql;
                                while($data=mysqli_fetch_array($query)){
                                    echo "<tr>";
                                    echo "<td>[".$data['KDPROV']."] ".$data['NMPROV']."</td>";
                                    echo "<td>[".$data['KDKAB']."] ".$data['NMKAB']."</td>";
                                    echo "<td>".$data['nip_l']."</td>";
                                    echo "<td>".$data['nip_p']."</td>";
                                    echo "<td>".$data['tanpa_nip_l']."</td>";
                                    echo "<td>".$data['tanpa_nip_p']."</td>";
        
                                    echo "<td>".($data['nip_l']+$data['nip_p']+$data['tanpa_nip_l']+$data['tanpa_nip_p'])."</td>";
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
    
</main>
<!-- Modal -->
