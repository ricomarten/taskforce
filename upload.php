<main id="js-page-content" role="main" class="page-content">
    <ol class="breadcrumb page-breadcrumb">
        <li class="position-absolute pos-top pos-right "><span class="js-get-date"></span></li>
    </ol>
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-cloud-upload'></i> Upload DATA
        </h1>
    </div>
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
    <div class="row">
        <div class="col-sm-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Form Upload DATA
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <a href="upload/format data excel.xlsx" type="button" class="btn btn-sm btn-outline-success waves-effect waves-themed">
                            <span class="fal fa-file-excel mr-1"></span> Download Template Excel 
                        </a>
                        <br><br>
                        <div class="form-group row">
                            <label for="domain" class="col-sm-2 col-form-label"><strong>Nama Data</strong></label>                   
                            <div class="col-sm-10">
                                 <div class="input-group">
                                    <input type="text" class="form-control"  id="nama_data" autocomplete="off" placeholder="Isikan nama data"/>
                                </div>
                            </div>                                                                
                        </div>
                        <div class="form-group row">
                            <label for="provinsi" class="col-sm-2 col-form-label"><strong>Provinsi</strong></label>                   
                            <div class="col-sm-10">    
                                <select class="select2-placeholder form-control w-100" id="provinsi">
                                    <option value=''></option>
                                    <?php
                                        if($_SESSION['prov']=='00'){
                                            $sql_prov=mysqli_query($conn, "SELECT * from master_prov where KDPROV<>'00'");
                                        }else{
                                            $sql_prov=mysqli_query($conn, "SELECT * from master_prov where KDPROV='".$_SESSION['prov']."'");
                                        }
                                        
                                        while($prov = mysqli_fetch_array($sql_prov)){
                                            echo "<option value='".$prov['KDPROV']."'>[".$prov['KDPROV']."] ".$prov['NMPROV']."</option>";
                                        }
                                    ?>
                                </select>
                            </div>                                                                
                        </div>
                        <div class="form-group row">
                            <label for="kabupaten" class="col-sm-2 col-form-label"><strong>Kabupaten/Kota</strong></label>                   
                            <div class="col-sm-10">                          
                                <div class="input-group" >
                                    <select class="select2-placeholder form-control w-100" id="kabupaten" >
                                    <option value=''></option>
                                    </select>
                                </div>
                            </div>                                                             
                        </div>
                        <div class="form-group row">
                            <label for="kecamatan" class="col-sm-2 col-form-label"><strong>Kecamatan</strong></label>                   
                            <div class="col-sm-10">                          
                                <div class="input-group" >
                                    <select class="select2-placeholder form-control w-100" id="kecamatan" >
                                    <option value=''></option>
                                    </select>
                                </div>
                            </div>                                                             
                        </div>
                        <div class="form-group row">
                            <label for="desa" class="col-sm-2 col-form-label"><strong>Desa</strong></label>                   
                            <div class="col-sm-10">                          
                                <div class="input-group" >
                                    <select class="select2-placeholder form-control w-100" id="desa" >
                                    <option value=''></option>
                                    </select>
                                </div>
                            </div>                                                             
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Upload Data</label>
                            <div class="col-sm-10">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="filepegawai" name="filepegawai" onchange="selectedFile();">
                                    <label class="custom-file-label" for="filepegawai">Pilih File</label>
                                </div>
                            </div>                                            
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12" id="keterangan"></div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-11">
                                <progress id="progressBar" style="width:100%" value="0" max="100" class="rm-progress"></progress>
                            </div>
                            <div class="col-sm-1 text-center">
                                <div id="percentageCalc"></div>
                            </div>
                        </div>
                        <div id="status"></div><div id="status2"></div>
                        <div id="result"></div>
                        <div id="loading_proses">
                            <strong>Loading...</strong> <img src="img/loading.gif"/>
                        </div>
                        <div id="loading_proses_upload">
                            <strong>Loading...</strong> <img src="img/loading.gif"/>
                        </div>
                        <input type="hidden" id="nip" value="<?php echo $_SESSION['niplama'] ?>">
                        <input type="hidden" id="unitkerja" value="<?php echo $_SESSION['unitkerja_id'] ?>">
                        <input type="hidden" id="wilayah" value="<?php echo $_SESSION['wilayah_id'] ?>">
                        <div class="panel-footer text-center">
                            <br>
                            <a href="index.php?menu=<?php echo encrypt('daftar') ?>" id="btn-kembali" type="button" class="btn btn-md btn-outline-dark waves-effect waves-themed">
                                <span class="fal fa-arrow-left mr-1"></span> Kembali
                            </a>
                            <button id="btn-export" onclick="Simpan()" type="button" class="btn btn-md btn-outline-primary waves-effect waves-themed">
                                <span class="fal fa-save mr-1"></span> Simpan
                            </button>
                        </div>   
                    </div>
                </div>
            </div>
        </div>
    </div>
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
    function Modal(id){
        $("#myModal").modal();
        document.getElementById("judul").innerHTML = id;
        var xhr = new XMLHttpRequest();
        var url = "submit_ajax.php";
        document.getElementById("loading_proses_modal").style.display = "block";

        var data = JSON.stringify({
            param: id,
            menuId: 2
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
    
</script>

<script type="text/javascript">
    document.getElementById("loading_proses").style.display = "none";
    document.getElementById("loading_proses_modal").style.display = "none";
    document.getElementById("loading_proses_upload").style.display = "none";
    document.getElementById("progressBar").style.display = "none";
    document.getElementById("percentageCalc").style.display = "none";
    function selectedFile() {
        document.getElementById("status").innerHTML = "";
        document.getElementById("result").innerHTML = "";
        document.getElementById('keterangan').innerHTML = "";;
        var archivoSeleccionado = document.getElementById("filepegawai");
        var file = archivoSeleccionado.files[0];
        if (file) {
            var fileSize = 0;
            if (file.size > 1048576){
                fileSize = (Math.round(file.size * 100 / 1048576) / 100).toString() + ' MB';
            }else{
                fileSize = (Math.round(file.size * 100 / 1024) / 100).toString() + ' Kb';
            }          
            var keterangan = document.getElementById('keterangan');
            //var divfileType = document.getElementById('fileType');
            keterangan.innerHTML = '<div class="panel-tag">Nama file:<code>'+file.name+'</code> <br>Ukuran file:<code>'+fileSize+'</code><br>Tipe file <code>'+file.type+'</code></div>' ;
            document.getElementById("status").innerHTML = "";
            //if(file.size>=2097152){
            if(file.size>=1048576){
                document.getElementById("result").innerHTML='<div class="alert alert-danger alert-dismissible fade show" role="alert">'+
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fal fa-times"></i></span></button>File yang diupload tidak lebih dari 1 MB</div>';
            }else{
                document.getElementById("result").innerHTML = "";
                uploadFile()
            }           
        }
    }     

    function uploadFile(){
        document.getElementById("status").innerHTML = "";
        document.getElementById("result").innerHTML = "";
        var dokumen = document.getElementById("filepegawai");
        var file = dokumen.files[0];
        var splitName = file.name.split(".");
        var length = splitName.length;
        if( splitName[length-1]=='xls' || splitName[length-1]=='xlsx' ||
            splitName[length-1]=='XLS' || splitName[length-1]=='XLSX'){
            document.getElementById("loading_proses_upload").style.display = "block";
            document.getElementById("progressBar").style.display = "block";
            document.getElementById("percentageCalc").style.display = "block";
            var url = "uploadfile.php";      
            var fd = new FormData();
            //fd.append("klasifikasi", klasifikasi);
            //fd.append("jenis_data", jenis_data);
            fd.append("data", file);
            var xmlHTTP= new XMLHttpRequest();
            //xmlHTTP.upload.addEventListener("loadstart", loadStartFunction, false);
            xmlHTTP.upload.addEventListener("progress", progressFunction, false);
            //xmlHTTP.addEventListener("load", transferCompleteFunction, false);
            xmlHTTP.addEventListener("error", uploadFailed, false);
            xmlHTTP.addEventListener("abort", uploadCanceled, false);
            xmlHTTP.open("POST", url, true);
            xmlHTTP.onload = function() {
                if (xmlHTTP.status >= 200 && xmlHTTP.status < 400) {
                    //alert (this.responseText);
                    if(this.responseText=="ok"){
                        document.getElementById("result").innerHTML='<div class="alert alert-success alert-dismissible fade show" role="alert">'+
                                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">'+
                                        '<i class="fal fa-times"></i></span></button> Berhasil mengupload file silahkan lihat daftar Laporan di <a href="index.php?menu=<?php echo encrypt('laporan')?>"> Daftar File Laporan WFH</a></div>';
                    }else{
                        //document.getElementById("result").innerHTML='<div class="alert alert-danger alert-dismissible fade show" role="alert">'+
                        //'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fal fa-times"></i></span></button>'+this.responseText+'</div>';
                        document.getElementById("result").innerHTML=this.responseText
                        document.getElementById("loading_proses_upload").style.display = "none";
                    }
                }
                document.getElementById("progressBar").style.display = "none";
                document.getElementById("percentageCalc").style.display = "none";
                document.getElementById("filepegawai").value="";
                //document.getElementById("kegiatan").value=document.getElementById("nama_kegiatan").value;
                //document.getElementById("status").innerHTML="<pre>"+document.getElementById("variabel_sama").value+"</pre>";
            }              
            xmlHTTP.send(fd);                 
        }else{
            document.getElementById("result").innerHTML='<div class="alert alert-danger alert-dismissible fade show" role="alert">'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fal fa-times"></i></span></button>File yang diupload harus <code>.xls</code> atau <code>.xlsx</code></div>';
        }         
    }       
    function Simpan(){
        if(document.body.contains(document.getElementById('jml_error'))){
            var nip = document.getElementById("nip").value;
            var unitkerja= document.getElementById("unitkerja").value;
            var wilayah= document.getElementById("wilayah").value;
        
            var nama_data= document.getElementById("nama_data").value;
            var provinsi= document.getElementById("provinsi").value;
            var kabupaten= document.getElementById("kabupaten").value;
            var kecamatan= document.getElementById("kecamatan").value;
            var desa= document.getElementById("desa").value;
            var jml_error=document.getElementById("jml_error").value;
            var jml_baris=document.getElementById("jml_baris").value;
            
            if (jml_error>0){
                Swal.fire({
                    icon: "error",
                    title: "Terjadi kesalahan",
                    html: "Data masih ada yang error",
                });
            }else if(jml_baris<=1){
                Swal.fire({
                    icon: "error",
                    title: "Terjadi kesalahan",
                    html: "Data harus terisi minimal 1",
                });
            }
            else if(nama_data=='' || provinsi=='' ||kabupaten=='' || kecamatan=='' || desa==''){
                Swal.fire({
                    icon: "error",
                    title: "Terjadi kesalahan",
                    html: "Semua isian form harus terisi",
                });
            }
            else {
                //alert(arrdata+"\nNIP:"+nip+"\nUnit Kerja:"+unitkerja+"\nWilayah:"+wilayah+"\nData:"+
                //JSON.stringify(GetCellValues(), null, 4))
                var xhr = new XMLHttpRequest();
                var url = "tf_api_simpan.php";
                document.getElementById("loading_proses").style.display = "block";
                
                var data = JSON.stringify({
                    //arrdata:arrdata,
                    tabel:GetCellValues(),
                    nip:nip,
                    unitkerja:unitkerja,
                    nama_data:nama_data,
                    provinsi:provinsi,
                    kabupaten:kabupaten,
                    kecamatan:kecamatan,
                    desa:desa,
                    jml_baris:jml_baris,
                });

                xhr.open("POST", url, true);
                xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
                xhr.onload = function () {               
                    console.log (this.responseText);
                    if(this.responseText=='ok'){
                        window.location.href = "index.php?menu=<?php echo encrypt('daftar') ?>";
                        document.getElementById("loading_proses").style.display = "none";
                    }else {
                        Swal.fire(
                        {
                            icon: "error",
                            title: "Terjadi kesalahan",
                            html: this.responseText,
                        });
                        document.getElementById("loading_proses").style.display = "none";
                        //document.getElementById("status2").innerHTML = this.responseText;
                    }
                };

                xhr.send(data);
                return false;
            }
        }else{
            Swal.fire({
                icon: "error",
                title: "Terjadi kesalahan",
                html: "File belum diupload",
            });
        }   
    }
    function GetCellValues() {
        var arr=[]
        var table = document.getElementById('datatabel');
        for (var r = 0, n = table.rows.length; r < n; r++) {
            for (var c = 0, m = table.rows[r].cells.length; c < m; c++) {
                //alert(table.rows[r].cells[c].innerHTML);
                judul="arr_" + r + "_" + c
                arr.push({tabel:{
                    judul:judul,
                    nilai:table.rows[r].cells[c].innerHTML
                }})
            }
        }
        return(arr)
    }
    function progressFunction(evt){
        var progressBar = document.getElementById("progressBar");
        var percentageDiv = document.getElementById("percentageCalc");
        if (evt.lengthComputable) {
            progressBar.max = evt.total;
            progressBar.value = evt.loaded;
            percentageDiv.innerHTML = Math.round(evt.loaded / evt.total * 100) + "%";
        }
    }

    function loadStartFunction(evt){
        var div = document.getElementById('status');
        div.innerHTML += '<div class="alert alert-success alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fal fa-times"></i></span></button><strong>Mulai</strong> mengupload file.</div>';
        //alert('Mulai mengupload file');
    }
    function transferCompleteFunction(evt){
        var div = document.getElementById('status');
        div.innerHTML += '<div class="alert alert-success alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fal fa-times"></i></span></button><strong>Berhasil</strong> mengupload file.</div>';
        //alert('Berhasil mengupload file');
        var progressBar = document.getElementById("progressBar");
        var percentageDiv = document.getElementById("percentageCalc");
        progressBar.value = 100;
        percentageDiv.innerHTML = "100%";
    }   

    function uploadFailed(evt) {
        var div = document.getElementById('status');
        div.innerHTML += '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fal fa-times"></i></span></button><strong>Terjadi kesalahan</strong> saat mengupload file.</div>';
        //alert("Terjadi kesalahan saat mengupload file.");
    }

    function uploadCanceled(evt) {
        var div = document.getElementById('status');
        div.innerHTML += '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fal fa-times"></i></span></button><strong>Terjadi kesalahan</strong> saat mengupload file.</div>';
        //alert("Operasi dibatalkan atau koneksi terputus.");
    }
    function templateTunggal(){
        window.location.href="template_seragam.xls"
    }
    function templateVariasi(){
        window.location.href="template_variasi.xls"
    }
</script>

</main>
