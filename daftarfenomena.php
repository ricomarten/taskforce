<main id="js-page-content" role="main" class="page-content">
    <ol class="breadcrumb page-breadcrumb">
        <li class="position-absolute pos-top pos-right "><span class="js-get-date"></span></li>
    </ol>
    <style>
        .my-custom-scrollbar {
        position: relative;
        height: 400px;
        overflow: auto;
        }
        .table-wrapper-scroll-y {
        display: block;
        }
    </style>
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-snowflake'></i> Daftar Fenomena
        </h1>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div id="panel-2" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Daftar Fenomena
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <a href="<?php echo "index.php?menu=".encrypt('entri'); ?>" type="button" class="btn btn-sm btn-outline-success waves-effect waves-themed">
                            <span class="fal fa-plus mr-1"></span> Tambah Fenomena 
                        </a>
                        <table id="dt-basic-example" class="table table-bordered table-hover  w-100" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Wilayah</th>
                                    <th>Fenomena</th>
                                    <th>Sumber</th>
                                    <th>Tren</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                //$sql="SELECT * from d.TabelData where NipUpload='".$_SESSION['niplama']."'";
                                $sql="SELECT
                                c.Trend.TrendName,
                                c.AdministrativeArea.AdministrativeAreaName,
                                d.InputPhenomena.DataPhenomenaSummary,
                                d.InputPhenomena.DataPhenomenaDetail,
                                d.InputPhenomena.DataPhenomenaSource
                                
                                FROM
                                d.InputPhenomena
                                INNER JOIN c.Trend ON d.InputPhenomena.TrendID = c.Trend.TrendID
                                INNER JOIN c.AdministrativeArea ON d.InputPhenomena.AdministrativeAreaID = c.AdministrativeArea.AdministrativeAreaID
                                
                                ";
                                $query=sqlsrv_query($conn,$sql);
                                while($data=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC)){
                                    echo "<tr>";
                                    echo "<td>".$data['AdministrativeAreaName']."</td>";
                                    echo "<td>".$data['DataPhenomenaDetail']."</td>";
                                    echo "<td>".$data['DataPhenomenaSource']."</td>";
                                    echo "<td>".$data['TrendName']." <button type='button' onclick=\"hapus('".$data['InputPhenomenaID']."','".$data['DataPhenomenaDetail']."')\" class='btn btn-xs btn-danger waves-effect waves-themed'>
                                    <i class='fal fa-trash'></i> </td>";
                                    /*
                                    echo "<td>".$data['TanggalUpload']->format('Y-m-d H:i:s')."</td>";
                                    if($data['Status']=='1'){
                                        echo "<td> Belum Approve </td>";
                                    }else{
                                        echo "<td> Sudah Approve </td>";
                                    }
                                    echo "<td>";
									echo "<button type='button' onclick=\"Modal('".$data['IdTabel']."','".$data['NamaTabel']."','".$data['Status']."')\" 
                                    class='btn btn-xs btn-info waves-effect waves-themed'>
                                    <i class='fal fa-search'></i>";
									if($data['NipUpload']==$_SESSION['niplama']){
										echo "<button type='button' onclick=\"hapus('".$data['IdTabel']."','".$data['NamaTabel']."')\" 
										class='btn btn-xs btn-danger waves-effect waves-themed'>
										<i class='fal fa-trash'></i>";
                                    }
                                    if($data['Status']=='1'){
                                        echo "<button type='button' onclick=\"approve('".$data['IdTabel']."','".$data['NamaTabel']."')\" 
										class='btn btn-xs btn-success waves-effect waves-themed'>
										<i class='fal fa-check'></i>";
                                    }
                                   
                                    echo "</td>";
                                    */
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
<div class="modal fade" id="myModal" role="dialog"aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail <span id="judul"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                </button>
            </div>
            <div class="modal-body"> 
                <div id="loading_proses_modal">
                    <strong>Loading...</strong> <img src="img/loading.gif"/>
                </div>
                <div id="modalResult"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    function Modal(id,nama,status){
        $("#myModal").modal();
        document.getElementById("judul").innerHTML = nama;
        var xhr = new XMLHttpRequest();
        var url = "submit_ajax.php";
        document.getElementById("loading_proses_modal").style.display = "block";

        var data = JSON.stringify({
            param: id,
            menuId: 4,
            status: status
            
        });

        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
        xhr.onload = function () {               
            console.log (this.responseText);
            document.getElementById("modalResult").innerHTML=this.responseText;
            document.getElementById("loading_proses_modal").style.display = "none";
        };

        xhr.send(data);
        return false; 
    }

    function hapus(id,nama){
        Swal.fire(
        {
            title: "Apakah yakin akan menghapus fenomena "+nama+"?",
            text: "Anda tidak dapat membatalkan proses",
            icon: "warning",
            showCancelButton: true,
            cancelButtonText: "Batal",
            confirmButtonText: "Ya"
        }).then(function(result)
        {
            if (result.value)
            {
                var xhr = new XMLHttpRequest();
                var url = "submit_ajax.php";
                var data = JSON.stringify({
                    id: id,
                    menuId: 8
                });

                xhr.open("POST", url, true);
                xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
                xhr.onload = function () {               
                    console.log (this.responseText);
                    if(this.responseText=='ok'){
                        Swal.fire({
                            title: "Terhapus",
                            text: "Data "+nama+" sudah terhapus",
                            icon: "success",
                            confirmButtonText: "Ok"
                        }).then(function(result)
                        {
                            window.location.href = "index.php?menu=<?php echo encrypt('fenomena')?>";
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

    function approve(id,nama){
        Swal.fire(
        {
            title: "Apakah yakin akan menerima data "+nama+"?",
            text: "Anda tidak dapat membatalkan proses",
            icon: "warning",
            showCancelButton: true,
            cancelButtonText: "Batal",
            confirmButtonText: "Ya"
        }).then(function(result)
        {
            if (result.value)
            {
                var xhr = new XMLHttpRequest();
                var url = "submit_ajax.php";
                var data = JSON.stringify({
                    id: id,
                    menuId: 6
                });

                xhr.open("POST", url, true);
                xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
                xhr.onload = function () {               
                    console.log (this.responseText);
                    if(this.responseText=='ok'){
                        Swal.fire({
                            title: "Berhasil menyimpan",
                            text: "Data "+nama+" berhasil disimpan",
                            icon: "success",
                            confirmButtonText: "Ok"
                        }).then(function(result)
                        {
                            window.location.href = "index.php?menu=<?php echo encrypt('daftar')?>";
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
</script>    