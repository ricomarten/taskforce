<style>

</style>
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
        .modal-dialog-full-width {
        width: 100% !important;
        height: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
        max-width:none !important;

    }
    .modal-content-full-width  {
        height: auto !important;
        min-height: 100% !important;
        border-radius: 0 !important;
        background-color: #ececec !important 
    }

    .modal-header-full-width  {
        border-bottom: 1px solid #9ea2a2 !important;
    }

    .modal-footer-full-width  {
        border-top: 1px solid #9ea2a2 !important;
    }
    </style>
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-database'></i> Daftar Upload Data
        </h1>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div id="panel-2" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Daftar Upload Data
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <a href="<?php echo "index.php?menu=".encrypt('upload'); ?>" type="button" class="btn btn-sm btn-outline-success waves-effect waves-themed">
                            <span class="fal fa-file-excel mr-1"></span> Upload data 
                        </a>
                        <br><br>
                        <table id="dt-basic-example" class="table table-bordered table-hover  w-100" style="width:100%">
                            <thead>
                                <tr class="table-active text-center">
                                    <th>Nama Data</th>
                                    <th>Provinsi</th>
                                    <th>Kabupaten</th>
                                    <th>Lihat Data</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                //$sql="SELECT * from d.TabelData where NipUpload='".$_SESSION['niplama']."'";
                                if($_SESSION['jabatan']=='-'){
                                    $unit=substr($_SESSION['unitkerja_id'],0,4);
                                }elseif($_SESSION['jabatan']=='4'){
                                    $unit=substr($_SESSION['unitkerja_id'],0,4);
                                }elseif($_SESSION['jabatan']=='3'){
                                    $unit=substr($_SESSION['unitkerja_id'],0,3);
                                }elseif($_SESSION['jabatan']=='2'){
                                    $unit=substr($_SESSION['unitkerja_id'],0,2);
                                }elseif($_SESSION['jabatan']=='1'){
                                    $unit=substr($_SESSION['unitkerja_id'],0,1);
                                }
                                $prov=substr($_SESSION['wilayah_id'],0,2);
                                $kab=substr($_SESSION['wilayah_id'],0,2);
                                
                                $sql="SELECT * from data";
                                                               
                                //$query=sqlsrv_query($conn,$sql);
                                $query=mysqli_query($conn,$sql);
                                //echo $sql;
                                while($data=mysqli_fetch_array($query)){
                                    if($data['Status']=='2'){
                                        echo "<tr class='table-success'>";
                                    }elseif($data['Status']=='1'){
                                        echo "<tr class='table-warning'>";
                                    }else{
                                        echo "<tr class='table-danger'>";
                                    }
                                   
                                    echo "<td>".$data['prov']."</td>";
                                    echo "<td>".$data['kab']."</td>";
                                    //echo "<td>".tgl_indo($data['CyclePeriod']->format('Y-m-d'))."</td>";
                                   // echo "<td>".$data['nama']."</td>";
                                    //echo "<td>".$data['UnitKerja']."</td>";
                                    //echo "<td>".$data['Wilayah']."</td>";
                                    //echo "<td>".$data['TanggalUpload']->format('Y-m-d H:i:s')."</td>";
                                    if($data['Status']=='1' || $data['Status']=='0' ){
                                        if($data['Status']=='1')
                                            echo "<td> Menunggu Approval ke-2 </td>";
                                        else 
                                            echo "<td> Menunggu Approval ke-1 </td>";
                                    }else{
                                        echo "<td> Sudah Approve </td>";
                                    }
                                    echo "<td>";
									echo "<button type='button' onclick=\"Modal('".$data['IdTabel']."','".$data['NamaTabel']."','".$data['Status']."')\" 
                                    class='btn btn-xs btn-info waves-effect waves-themed'>
                                    <i class='fal fa-search'></i>";
									if(($data['NipUpload']==$_SESSION['niplama'] && $data['Status']=='0')  || $_SESSION['admin']=='1' ){
										echo "<button type='button' onclick=\"hapus('".$data['IdTabel']."','".$data['NamaTabel']."')\" 
										class='btn btn-xs btn-danger waves-effect waves-themed'>
										<i class='fal fa-trash'></i>";
                                    }
                                    if($data['Status']=='0'){
                                        if(($prov=='00' && $kab=='00' && $_SESSION['jabatan']=='3') ||
                                        ($prov<>'00' && $_SESSION['jabatan']=='4')  || $_SESSION['admin']=='1'){
                                            echo "<button type='button' onclick=\"approve_awal('".$data['IdTabel']."','".$data['NamaTabel']."')\" 
										    class='btn btn-xs btn-success waves-effect waves-themed'>
										    <i class='fal fa-check'></i>";
                                        }                     
                                    }
                                    if($data['Status']=='1'){
                                        if(($prov=='00' && $kab=='00' && $_SESSION['jabatan']=='3') ||
                                        ($prov<>'00' && $_SESSION['jabatan']=='4') || $_SESSION['admin']=='1'){
                                            echo "<button type='button' onclick=\"batal_approve('".$data['IdTabel']."','".$data['NamaTabel']."')\" 
										    class='btn btn-xs btn-warning waves-effect waves-themed'>
										    <i class='fal fa-times'></i>";
                                        }
                                        if(($prov=='00' && $kab=='00' && $_SESSION['jabatan']=='2') ||
                                        ($prov<>'00' && $_SESSION['jabatan']=='3') || $_SESSION['admin']=='1'){
                                            echo "<button type='button' onclick=\"approve('".$data['IdTabel']."','".$data['NamaTabel']."')\" 
										    class='btn btn-xs btn-success waves-effect waves-themed'>
                                            <i class='fal fa-check'></i>";
                                        }
                                    }
                                   
                                    echo "</td>";
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
    <div class="modal-dialog-full-width modal-dialog momodel modal-fluid" role="document">
        <div class="modal-content-full-width modal-content ">
            <div class=" modal-header-full-width   modal-header text-center">
                <h5 class="modal-title w-100" id="exampleModalPreviewLabel"><span id="judul"></span></h5>
                <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                    <span style="font-size: 1.3em;" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="loading_proses_modal">
                    <strong>Loading...</strong> <img src="img/loading.gif"/>
                </div>
                <div id="modalResult"></div>
            </div>
            <div class="modal-footer-full-width  modal-footer">
                <button type="button" class="btn btn-danger btn-md btn-rounded" data-dismiss="modal">Close</button>
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
            title: "Apakah yakin akan menghapus Data "+nama+"?",
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
                    menuId: 5
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
    function approve_awal(id,nama){
        Swal.fire(
        {
            title: "Apakah yakin akan menerima data "+nama+"?",
            text: "Anda tidak dapat membatalkan proses",
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
                    id: id,
                    menuId: 9
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
    function batal_approve(id,nama){
        Swal.fire(
        {
            title: "Apakah yakin akan membatalkan data "+nama+" yang telah diapprove?",
            text: "Anda tidak dapat membatalkan proses",
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
                    id: id,
                    menuId: 10
                });

                xhr.open("POST", url, true);
                xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
                xhr.onload = function () {               
                    console.log (this.responseText);
                    if(this.responseText=='ok'){
                        Swal.fire({
                            title: "Proses Berhasil",
                            text: "Data "+nama+" berhasil unapprove",
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