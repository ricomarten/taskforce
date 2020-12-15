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
            <i class='subheader-icon fal fa-database'></i> Daftar Kode
        </h1>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div id="panel-2" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Daftar Kode dan Klasifikasi
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                    <table class='table table-bordered table-striped mb-0'>
                        <thead>
                            <tr>
                                <th>Master</th>
                                <th>Lihat</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Jenis Lapangan Usaha</td>
                                <td><button type="button" onclick="Modal('klasifikasi')" class="btn btn-xs btn-info waves-effect waves-themed">
                                    <i class="fal fa-search"></i> </button></td>
                            </tr>
                            <tr>
                                <td>Klasifikasi Komoditas</td>
                                <td><button type="button" onclick="Modal('komoditas')" class="btn btn-xs btn-info waves-effect waves-themed">
                                    <i class="fal fa-search"></i> </button></td>
                            </tr>
                            <tr>
                                <td>Jenis Transaksi</td>
                                <td><button type="button" onclick="Modal('transaksi')" class="btn btn-xs btn-info waves-effect waves-themed">
                                    <i class="fal fa-search"></i> </button></td>
                            </tr>
                            <tr>
                                <td>Sektor Institusi</td>
                                <td><button type="button" onclick="Modal('institusi')" class="btn btn-xs btn-info waves-effect waves-themed">
                                    <i class="fal fa-search"></i> </button></td>
                            </tr>
                            <tr>
                                <td>Ukuran Kuantitas</td>
                                <td><button type="button" onclick="Modal('kuantitas')" class="btn btn-xs btn-info waves-effect waves-themed">
                                    <i class="fal fa-search"></i> </button></td>
                            </tr>
                            <tr>
                                <td>Series Data</td>
                                <td><button type="button" onclick="Modal('series')" class="btn btn-xs btn-info waves-effect waves-themed">
                                    <i class="fal fa-search"></i> </button></td>
                            </tr>
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