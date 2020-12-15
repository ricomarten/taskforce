<main id="js-page-content" role="main" class="page-content">
    <ol class="breadcrumb page-breadcrumb">
        <li class="position-absolute pos-top pos-right "><span class="js-get-date"></span></li>
    </ol>
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-file-excel'></i> Generate Template
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
                        Form Generate Template
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
                            <label for="domain" class="col-sm-2 col-form-label"><strong>Nama Template Data</strong></label>
                            <div class="col-sm-9">
                                 <div class="input-group">
                                    <input type="text" onchange="radioValidation()" class="form-control" id="kegiatan"> 
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <a class="btn btn-info btn-xs btn-icon waves-effect waves-themed" data-toggle="collapse" 
                                    href="#collapseTemplate" role="button" aria-expanded="false" aria-controls="collapseTemplate">
                                <i class="fal fa-info"></i></a>
                            </div>                  
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <div class="collapse" id="collapseTemplate">
                                    <div class="card card-body">
                                        Nama template ini dapat digunakan untuk data dari beberapa survei yang memiliki jenis output data yang sama/
                                        Misalnya survei A berulang semesteran dalam satu tahun namun memiliki output data yang sama.
                                        Maka template ini dapat digunakan untuk tiap semester dengan henya mengganti isian datanya.
                                    </div>
                                </div>
                            </div>   
                        </div>
                        <div class="form-group">
                            <label class="form-label">
                                Apakah data yang akan Anda upload memiliki Kode Wilayah Administrasi yang seragam?
                            </label>
                            <a class="btn btn-info btn-xs btn-icon waves-effect waves-themed" data-toggle="collapse" 
                                href="#collapseWilayah" role="button" aria-expanded="false" aria-controls="collapseWilayah">
                            <i class="fal fa-info"></i></a>
                            <div class="collapse" id="collapseWilayah">
                                <div class="card card-body">
                                    Yang dimaksud Kode Wilayah Administrasi yang seragam adalah dalam satu file data yang diupload, 
                                    cakupan wilayah datanya hanya untuk satu lokasi wilayah tertentu saja.
                                </div>
                            </div>
                            <div class="input-group row">
                                <div class="col-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="cekWilayahYes" onclick="cekWilayah()" name="cekWilayah" class="custom-control-input">
                                                <label class="custom-control-label" for="cekWilayahYes">Ya</label>
                                            </div>
                                        </div>
                                        <div class="input-group-text">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="cekWilayahNo"  onclick="cekWilayah()" name="cekWilayah" class="custom-control-input">
                                                <label class="custom-control-label" for="cekWilayahNo">Tidak</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                <script>
                                    function cekWilayah(){
                                        radioValidation()
                                        var cek=document.getElementById("cekWilayahYes").checked;
                                        if(cek){
                                            document.getElementById("selectWilayah").removeAttribute("class");
                                            document.getElementById("selectWilayah").setAttribute("class", "form-group row");
                                        }else{
                                            document.getElementById("selectWilayah").removeAttribute("class");
                                            document.getElementById("selectWilayah").setAttribute("class", "form-group row d-none");
                                            var select = document.getElementById("wilayah");
                                            select.selectedIndex = 0;                                    
                                        }                         
                                    }
                                </script>
                                 <div class="input-group d-none" id="selectWilayah">
                                    <select class="select2-placeholder form-control w-100" id="wilayah" onchange="radioValidation()" >
                                        <option value=''></option>
                                        <?php
                                            $sql_series=sqlsrv_query($conn, "SELECT * from c.AdministrativeArea");
                                            while($series = sqlsrv_fetch_array($sql_series, SQLSRV_FETCH_ASSOC)){
                                                echo "<option value='".$series['AdministrativeAreaCode']."'>[".$series['AdministrativeAreaCode']."] ".$series['AdministrativeAreaName']."</option>";
                                            }
                                        ?>
                                        </select>
                                    </div>
                                </div>   
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">
                                Apakah data yang akan Anda upload memiliki kode Aktivitas/Jenis Lapangan Usaha yang seragam?
                            </label>
                            <a class="btn btn-info btn-xs btn-icon waves-effect waves-themed" data-toggle="collapse" 
                                href="#collapseLapangan" role="button" aria-expanded="false" aria-controls="collapseLapangan">
                            <i class="fal fa-info"></i></a>
                            <div class="collapse" id="collapseLapangan">
                                <div class="card card-body">
                                    Yang dimaksud Jenis Lapangan Usaha yang seragam adalah ....
                                </div>
                            </div>
                            <div class="input-group row">
                                <div class="col-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="cekKlasifikasiYes" onclick="cekKlasifikasi()" name="cekKlasifikasi" class="custom-control-input">
                                                <label class="custom-control-label" for="cekKlasifikasiYes">Ya</label>
                                            </div>
                                        </div>
                                        <div class="input-group-text">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="cekKlasifikasiNo"  onclick="cekKlasifikasi()" name="cekKlasifikasi" class="custom-control-input">
                                                <label class="custom-control-label" for="cekKlasifikasiNo">Tidak</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                <script>
                                    function cekKlasifikasi(){
                                        radioValidation()
                                        var cek=document.getElementById("cekKlasifikasiYes").checked;
                                        if(cek){
                                            document.getElementById("selectKlasifikasi").removeAttribute("class");
                                            document.getElementById("selectKlasifikasi").setAttribute("class", "form-group row");
                                            document.getElementById("showkodeklasifikasi").removeAttribute("class");
                                            document.getElementById("showkodeklasifikasi").setAttribute("class", "form-group");                                       
                                        }else{
                                            document.getElementById("selectKlasifikasi").removeAttribute("class");
                                            document.getElementById("selectKlasifikasi").setAttribute("class", "form-group row d-none");
                                            document.getElementById("showkodeklasifikasi").setAttribute("class","d-none");
                                            document.getElementById("showkodeklasifikasi").setAttribute("class", "form-group d-none");
                                            var select = document.getElementById("klasifikasi");
                                            select.selectedIndex = 0;
                                            var select2 = document.getElementById("kodeklasifikasi")
                                            for (i = select2.options.length-1; i >= 0; i--) {
                                                select2.options[i] = null;
                                            }                   
                                        }
                                    }
                                </script>
                                    <div class="input-group d-none" id="selectKlasifikasi">
                                        <select class="select2-placeholder form-control w-100" id="klasifikasi">
                                        <option value=''></option>
                                        <?php
                                            $sql_series=sqlsrv_query($conn, "SELECT * from c.Classification where StatisticalDomainID='14'");
                                            while($series = sqlsrv_fetch_array($sql_series, SQLSRV_FETCH_ASSOC)){
                                                echo "<option value='".$series['ClassificationID']."'>".$series['ClassificationName']."</option>";
                                            }
                                        ?>
                                        </select>
                                    </div>
                                </div>   
                            </div>
                        </div>
                        <div id="loading_proses2">
                            <strong>Loading...</strong> <img src="img/loading.gif"/>
                        </div>
                        <div id="showkodeklasifikasi" class="form-group d-none">
                            <div class="input-group ">
                                <label class="col-sm-2 col-form-label">Pilih kode lapangan usaha</label>                              
                                <div class="col-sm-10">                          
                                    <div class="input-group" id="selectKodeKlasifikasi">
                                        <select class="select2-placeholder form-control w-100" id="kodeklasifikasi" onchange="radioValidation()">
                                        <option value=''></option>
                                        </select>
                                    </div>
                                </div>   
                            </div>                                                            
                        </div>
                        <div class="form-group">
                            <label class="form-label">
                                Apakah data yang akan Anda upload memiliki Kode Aset/Komoditas yang seragam?
                            </label>
                            <a class="btn btn-info btn-xs btn-icon waves-effect waves-themed" data-toggle="collapse" 
                                href="#collapseKomoditi" role="button" aria-expanded="false" aria-controls="collapseKomoditi">
                            <i class="fal fa-info"></i></a>
                            <div class="collapse" id="collapseKomoditi">
                                <div class="card card-body">
                                    Yang dimaksud Kode Komoditas yang seragam adalah ....
                                </div>
                            </div>
                            <div class="input-group row">
                                <div class="col-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="cekKomoditasYes" onclick="cekKomoditas()" name="cekKomoditas" class="custom-control-input">
                                                <label class="custom-control-label" for="cekKomoditasYes">Ya</label>
                                            </div>
                                        </div>
                                        <div class="input-group-text">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="cekKomoditasNo"  onclick="cekKomoditas()" name="cekKomoditas" class="custom-control-input">
                                                <label class="custom-control-label" for="cekKomoditasNo">Tidak</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                <script>
                                    function cekKomoditas(){
                                        radioValidation()
                                        var cek=document.getElementById("cekKomoditasYes").checked;
                                        if(cek){
                                            document.getElementById("selectKomoditas").removeAttribute("class");
                                            document.getElementById("selectKomoditas").setAttribute("class", "form-group row");
                                            document.getElementById("showkodekomoditas").removeAttribute("class");
                                            document.getElementById("showkodekomoditas").setAttribute("class", "form-group");                                          
                                        }else{
                                            document.getElementById("selectKomoditas").removeAttribute("class");
                                            document.getElementById("selectKomoditas").setAttribute("class", "form-group row d-none");
                                            document.getElementById("showkodekomoditas").setAttribute("class","d-none");
                                            document.getElementById("showkodekomoditas").setAttribute("class", "form-group d-none");
                                            var select = document.getElementById("komoditas");
                                            select.selectedIndex = 0;
                                            var select2 = document.getElementById("kodekomoditas")
                                            for (i = select2.options.length-1; i >= 0; i--) {
                                                select2.options[i] = null;
                                            }
                                        }                         
                                    }
                                </script>
                                    <div class="input-group d-none" id="selectKomoditas">
                                        <select class="select2-placeholder form-control w-100" id="komoditas">
                                        <option value=''></option>
                                        <?php
                                            $sql_series=sqlsrv_query($conn, "SELECT * from c.Classification where StatisticalDomainID='15'");
                                            while($series = sqlsrv_fetch_array($sql_series, SQLSRV_FETCH_ASSOC)){
                                                echo "<option value='".$series['ClassificationID']."'>".$series['ClassificationName']."</option>";
                                            }
                                        ?>
                                        </select>
                                    </div>
                                </div>   
                            </div>
                        </div>
                        <div id="loading_proses3">
                            <strong>Loading...</strong> <img src="img/loading.gif"/>
                        </div>
                        <div id="showkodekomoditas" class="form-group d-none">
                            <div class="input-group">
                                <label class="col-sm-2 col-form-label">Pilih kode komoditas</label>   
                                <div class="col-sm-10">
                                    <div class="input-group" id="selectKodeKomoditas">
                                        <select class="select2-placeholder form-control w-100" id="kodekomoditas" onchange="radioValidation()" >
                                        <option value=''></option>
                                        </select>
                                    </div>
                                </div>   
                            </div>                                                            
                        </div>
                        <div class="form-group">
                            <label class="form-label">
                                Apakah data yang akan Anda upload memiliki Jenis Transaksi yang seragam?
                            </label>
                            <a class="btn btn-info btn-xs btn-icon waves-effect waves-themed" data-toggle="collapse" 
                                href="#collapseTransaksi" role="button" aria-expanded="false" aria-controls="collapseTransaksi">
                            <i class="fal fa-info"></i></a>
                            <div class="collapse" id="collapseTransaksi">
                                <div class="card card-body">
                                    Yang dimaksud Jenis Transaksi yang seragam adalah ....
                                </div>
                            </div>
                            <div class="input-group row">
                                <div class="col-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="cekTransaksiYes" onclick="cekTransaksi()" name="cekTransaksi" class="custom-control-input">
                                                <label class="custom-control-label" for="cekTransaksiYes">Ya</label>
                                            </div>
                                        </div>
                                        <div class="input-group-text">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="cekTransaksiNo"  onclick="cekTransaksi()" name="cekTransaksi" class="custom-control-input">
                                                <label class="custom-control-label" for="cekTransaksiNo">Tidak</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <script>
                                        function cekTransaksi(){
                                            radioValidation()
                                            var cek=document.getElementById("cekTransaksiYes").checked;
                                            if(cek){
                                                document.getElementById("selectTransaksi").removeAttribute("class");
                                                document.getElementById("selectTransaksi").setAttribute("class", "form-group row");
                                                document.getElementById("showkodetransaksi").removeAttribute("class");
                                                document.getElementById("showkodetransaksi").setAttribute("class", "form-group"); 
                                            }else{
                                                document.getElementById("selectTransaksi").removeAttribute("class");
                                                document.getElementById("selectTransaksi").setAttribute("class", "form-group row d-none");
                                                document.getElementById("showkodetransaksi").setAttribute("class","d-none");
                                                document.getElementById("showkodetransaksi").setAttribute("class", "form-group d-none");
                                                
                                                var select = document.getElementById("transaksi");
                                                select.selectedIndex = 0;    
                                                var select2 = document.getElementById("kodetransaksi")
                                                for (i = select2.options.length-1; i >= 0; i--) {
                                                    select2.options[i] = null;
                                                }                                
                                            }                         
                                        }
                                    </script>
                                    <div class="input-group d-none" id="selectTransaksi">
                                        <select class="select2-placeholder form-control w-100" id="transaksi" onchange="radioValidation()" >
                                            <option value=''></option>
                                            <?php
                                                $sql_series=sqlsrv_query($conn, "SELECT * from c.Classification where StatisticalDomainID='16'");
                                                while($series = sqlsrv_fetch_array($sql_series, SQLSRV_FETCH_ASSOC)){
                                                    echo "<option value='".$series['ClassificationID']."'>".$series['ClassificationName']."</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>   
                            </div>
                        </div>
                        <div id="loading_proses4">
                            <strong>Loading...</strong> <img src="img/loading.gif"/>
                        </div>
                        <div id="showkodetransaksi" class="form-group d-none">
                            <div class="input-group">
                                <label class="col-sm-2 col-form-label">Pilih kode transaksi</label>   
                                <div class="col-sm-10">
                                    <div class="input-group" id="selectKodeTransaksi">
                                        <select class="select2-placeholder form-control w-100" id="kodetransaksi" onchange="radioValidation()" >
                                        <option value=''></option>
                                        </select>
                                    </div>
                                </div>   
                            </div>                                                            
                        </div>
                        <div class="form-group">
                            <label class="form-label">
                                Apakah data yang akan Anda upload memiliki Sektor Institusi yang seragam?
                            </label>
                            <a class="btn btn-info btn-xs btn-icon waves-effect waves-themed" data-toggle="collapse" 
                                href="#collapseInstitusi" role="button" aria-expanded="false" aria-controls="collapseInstitusi">
                            <i class="fal fa-info"></i></a>
                            <div class="collapse" id="collapseInstitusi">
                                <div class="card card-body">
                                    Yang dimaksud Sektor Institusi yang seragam adalah ....
                                </div>
                            </div>
                            <div class="input-group row">
                                <div class="col-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="cekInstitusiYes" onclick="cekInstitusi()" name="cekInstitusi" class="custom-control-input">
                                                <label class="custom-control-label" for="cekInstitusiYes">Ya</label>
                                            </div>
                                        </div>
                                        <div class="input-group-text">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="cekInstitusiNo"  onclick="cekInstitusi()" name="cekInstitusi" class="custom-control-input">
                                                <label class="custom-control-label" for="cekInstitusiNo">Tidak</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <script>
                                        function cekInstitusi(){
                                            radioValidation()
                                            var cek=document.getElementById("cekInstitusiYes").checked;
                                            if(cek){
                                                document.getElementById("selectInstitusi").removeAttribute("class");
                                                document.getElementById("selectInstitusi").setAttribute("class", "form-group row");
                                                document.getElementById("showkodeinstitusi").removeAttribute("class");
                                                document.getElementById("showkodeinstitusi").setAttribute("class", "form-group"); 
                                            }else{
                                                document.getElementById("selectInstitusi").removeAttribute("class");
                                                document.getElementById("selectInstitusi").setAttribute("class", "form-group row d-none");
                                                document.getElementById("showkodeinstitusi").setAttribute("class","d-none");
                                                document.getElementById("showkodeinstitusi").setAttribute("class", "form-group d-none");
    
                                                var select = document.getElementById("institusi");
                                                select.selectedIndex = 0;    
                                                var select2 = document.getElementById("kodeinstitusi")
                                                for (i = select2.options.length-1; i >= 0; i--) {
                                                    select2.options[i] = null;
                                                } 
                                            }
                                        }
                                    </script>
                                    <div class="input-group d-none" id="selectInstitusi">
                                        <select class="select2-placeholder form-control w-100" id="institusi" onchange="radioValidation()" >
                                            <option value=''></option>
                                            <?php
                                                $sql_series=sqlsrv_query($conn, "SELECT * from c.Classification where StatisticalDomainID='17'");
                                                while($series = sqlsrv_fetch_array($sql_series, SQLSRV_FETCH_ASSOC)){
                                                    echo "<option value='".$series['ClassificationID']."'>".$series['ClassificationName']."</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>   
                            </div>
                        </div>
                        <div id="loading_proses5">
                            <strong>Loading...</strong> <img src="img/loading.gif"/>
                        </div>
                        <div id="showkodeinstitusi" class="form-group d-none">
                            <div class="input-group">
                                <label class="col-sm-2 col-form-label">Pilih kode institusi</label>   
                                <div class="col-sm-10">
                                    <div class="input-group" id="selectKodeInstitusi">
                                        <select class="select2-placeholder form-control w-100" id="kodeinstitusi" onchange="radioValidation()" >
                                        <option value=''></option>
                                        </select>
                                    </div>
                                </div>   
                            </div>                                                            
                        </div>
                        <div class="form-group">
                            <label class="form-label">
                                Apakah data yang akan Anda upload memiliki Ukuran Kuantitas yang seragam?
                            </label>
                            <a class="btn btn-info btn-xs btn-icon waves-effect waves-themed" data-toggle="collapse" 
                                href="#collapseKuantitas" role="button" aria-expanded="false" aria-controls="collapseKuantitas">
                            <i class="fal fa-info"></i></a>
                            <div class="collapse" id="collapseKuantitas">
                                <div class="card card-body">
                                    Yang dimaksud Ukuran Kuantitas yang seragam adalah ....
                                </div>
                            </div>
                            <div class="input-group row">
                                <div class="col-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="cekKuantitasYes" onclick="cekKuantitas()" name="cekKuantitas" class="custom-control-input">
                                                <label class="custom-control-label" for="cekKuantitasYes">Ya</label>
                                            </div>
                                        </div>
                                        <div class="input-group-text">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="cekKuantitasNo"  onclick="cekKuantitas()" name="cekKuantitas" class="custom-control-input">
                                                <label class="custom-control-label" for="cekKuantitasNo">Tidak</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                <script>
                                    function cekKuantitas(){
                                        radioValidation()
                                        var cek=document.getElementById("cekKuantitasYes").checked;
                                        if(cek){
                                            document.getElementById("selectKuantitas").removeAttribute("class");
                                            document.getElementById("selectKuantitas").setAttribute("class", "form-group row");
                                        }else{
                                            document.getElementById("selectKuantitas").removeAttribute("class");
                                            document.getElementById("selectKuantitas").setAttribute("class", "form-group row d-none");
                                            var select = document.getElementById("kuantitas");
                                            select.selectedIndex = 0;
                                        }                         
                                    }
                                </script>
                                    <div class="input-group d-none" id="selectKuantitas">
                                        <select class="select2-placeholder form-control w-100" id="kuantitas" onchange="radioValidation()" >
                                        <option value=''></option>
                                        <?php
                                            $sql_series=sqlsrv_query($conn, "SELECT * from c.Measurement");
                                            while($series = sqlsrv_fetch_array($sql_series, SQLSRV_FETCH_ASSOC)){
                                                echo "<option value='".$series['MeasurementID']."'>".$series['NationalAccountMeasurementName']."</option>";
                                            }
                                        ?>
                                        </select>
                                    </div>
                                </div>   
                            </div>
                        </div> 
                        <div class="form-group">
                            <label class="form-label">
                                Apakah data yang akan Anda upload memiliki Series Data yang seragam?
                            </label>
                            <a class="btn btn-info btn-xs btn-icon waves-effect waves-themed" data-toggle="collapse" 
                                href="#collapseSeries" role="button" aria-expanded="false" aria-controls="collapseSeries">
                            <i class="fal fa-info"></i></a>
                            <div class="collapse" id="collapseSeries">
                                <div class="card card-body">
                                    Yang dimaksud Series Data yang seragam adalah ....
                                </div>
                            </div>
                            <div class="input-group row">
                                <div class="col-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="cekSeriesYes" onclick="cekSeries()" name="cekSeries" class="custom-control-input">
                                                <label class="custom-control-label" for="cekSeriesYes">Ya</label>
                                            </div>
                                        </div>
                                        <div class="input-group-text">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="cekSeriesNo"  onclick="cekSeries()" name="cekSeries" class="custom-control-input">
                                                <label class="custom-control-label" for="cekSeriesNo">Tidak</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                <script>
                                    function cekSeries(){
                                        radioValidation()
                                        var cek=document.getElementById("cekSeriesYes").checked;
                                        if(cek){
                                            document.getElementById("selectSeries").removeAttribute("class");
                                            document.getElementById("selectSeries").setAttribute("class", "form-group row");
                                            document.getElementById("showPeriode").removeAttribute("class");
                                            document.getElementById("showPeriode").setAttribute("class", "form-group");
                                        }else{
                                            document.getElementById("selectSeries").removeAttribute("class");
                                            document.getElementById("selectSeries").setAttribute("class", "form-group row d-none");
                                            document.getElementById("showPeriode").removeAttribute("class");
                                            document.getElementById("showPeriode").setAttribute("class", "form-group d-none");
                                            var select = document.getElementById("series");
                                            select.selectedIndex = 0;
                                            document.getElementById("periode").value='';
                                        }                         
                                    }
                                </script>
                                    <div class="input-group d-none" id="selectSeries">
                                        <select class="select2-placeholder form-control w-100" id="series">
                                        <option value=''></option>
                                        <?php
                                            $sql_series=sqlsrv_query($conn, "SELECT * from c.DataSeries");
                                            while($series = sqlsrv_fetch_array($sql_series, SQLSRV_FETCH_ASSOC)){
                                                echo "<option value='".$series['DataSeriesCode']."'>".$series['DataSeriesName']."</option>";
                                            }
                                        ?>
                                        </select>
                                    </div>
                                </div>   
                            </div>
                        </div>
                        <div id="loading_proses6">
                            <strong>Loading...</strong> <img src="img/loading.gif"/>
                        </div>   
                        <div class="form-group d-none" id="showPeriode">
                            <div class="input-group" id="periodeHari" style="display:none">
                                <label class="col-sm-2 col-form-label">Pilih periode data</label> 
                                <div class="col-sm-10">
                                    <div id="selectPeriode">
                                        <div class="input-group">
                                            <input  type="text" class="form-control "readonly placeholder="Pilih Periode" id="periode" name="periode" onchange="radioValidation()" >
                                            <div class="input-group-append">
                                                <span class="input-group-text fs-xl">
                                                    <i class="fal fa-calendar-alt"></i>
                                                </span>
                                            </div>
                                         </div>
                                    </div>
                                </div>   
                            </div>
        
                            <div class="input-group" id="periodeBulan" style="display:none">
                                <label class="col-sm-2 col-form-label">Pilih periode data</label>   
                                <div class="col-sm-10">
                                    <div class="input-group" id="selectDetailSeries">
                                        <select class="select2-placeholder form-control w-100" id="detailseries" onchange="radioValidation()" >
                                        <option value=''></option>
                                        </select>
                                    </div>
                                </div>   
                            </div> 
                            <div class="input-group" id="periodeTahun" style="display:none">
                                <label class="col-sm-2 col-form-label">Tahun</label>   
                                <div class="col-sm-10">
                                    <div class="input-group" id="selectDetailSeriesTahun">
                                        <select class="select2-placeholder form-control w-100" id="detailseriestahun" onchange="radioValidation()" >
                                        <?php
                                            for($i=date("Y");$i>=1950;$i--){
                                                echo "<option value='$i'>$i</option>";
                                            }
                                        ?>
                                        
                                        </select>
                                    </div>
                                </div>   
                            </div> 

                        </div>                                      
                        
                        <div id="generateButton" class="form-group text-center">
                            <button id="btn-export" onclick="generateTemplate()" type="button" class="btn btn-md btn-outline-dark waves-effect waves-themed">
                                <span class="fal fa-file-excel mr-1"></span> Generate Template
                            </button>  
                            <br><br>
                        </div>
                        <div id="loading_proses">
                            <strong>Loading...</strong> <img src="img/loading.gif"/>
                        </div>
                        <div id="loading_proses_upload">
                            <strong>Loading...</strong> <img src="img/loading.gif"/>
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
    function cekRadio(id){
        var hasil=false;
        var cek = document.getElementsByName(id);
        for(var i=0; i<cek.length;i++){
            if(cek[i].checked == true){hasil = true;}
        }
        return hasil;
    }
    function cekRadioValue(id){
        var hasil=0;
        var tercek=false;
        var cek = document.getElementsByName(id);
        for(var i=0; i<cek.length;i++){
            if(cek[i].checked == true){tercek = true;}
        }
        if(tercek){
            if(cek[0].checked == true){hasil=1}
            if(cek[1].checked == true){hasil=2}
        }
        return hasil;
    }
   
    function radioValidation(){
        var cek=true;
        var kegiatan=           document.getElementById("kegiatan").value;
        var cekWilayah =        cekRadioValue('cekWilayah');
        var cekTransaksi =      cekRadioValue('cekTransaksi');
        var cekInstitusi =      cekRadioValue('cekInstitusi');
        var cekKuantitas =      cekRadioValue('cekKuantitas');
        var cekSeries =         cekRadioValue('cekSeries');
        var cekKlasifikasi =    cekRadioValue('cekKlasifikasi');
        var cekKomoditas =      cekRadioValue('cekKomoditas');
        var wilayah=            document.getElementById("wilayah").value;
        var klasifikasi =       document.getElementById("klasifikasi").value;
        var kodeklasifikasi =   document.getElementById("kodeklasifikasi").value;
        var komoditas =         document.getElementById("komoditas").value;
        var kodekomoditas =     document.getElementById("kodekomoditas").value;
        var transaksi =         document.getElementById("transaksi").value;
        var kodetransaksi =     document.getElementById("kodetransaksi").value;
        var institusi =         document.getElementById("institusi").value;
        var kodeinstitusi =     document.getElementById("kodeinstitusi").value;
        var kuantitas =         document.getElementById("kuantitas").value;
        var series =            document.getElementById("series").value;
        var periode='';
        if(series=='A'){
             periode = document.getElementById("detailseriestahun").value;
        }else if(series=='D' || series=='U'){
             periode = document.getElementById("periode").value;
        }else{
            if( document.getElementById("detailseries").value=='' || document.getElementById("detailseriestahun").value==''){
                 periode=''; 
            }else{
                 periode = document.getElementById("detailseries").value+'_'+document.getElementById("detailseriestahun").value;
            }          
        }
        

        if(kegiatan=='' || (cekKlasifikasi==0) || (cekKomoditas==0)|| (cekTransaksi==0) || 
            (cekWilayah==0) || (cekInstitusi==0) || (cekKuantitas==0) || (cekSeries==0)){
            cek=false;
        }else{
            if(cekWilayah==1 && wilayah==''){
                cek=false;
            }else if(cekKlasifikasi==1 && kodeklasifikasi==''){
                cek=false;
            }else if(cekKomoditas==1 && kodekomoditas==''){
                cek=false;
            }else if(cekTransaksi==1 && kodetransaksi==''){
                cek=false;
            }else if(cekInstitusi==1 && kodeinstitusi==''){
                cek=false;
            }else if(cekKuantitas==1 && kuantitas==''){
                cek=false;
            }else if(cekSeries==1  && periode==''){
                cek=false;
            }
            else{
                cek=true;
            }      
        }
        //if(cek){
            //document.getElementById("generateButton").removeAttribute("class");
            //document.getElementById("generateButton").setAttribute("class", "text-center"); 
            
        //}else{
            //document.getElementById("generateButton").removeAttribute("class");
            //document.getElementById("generateButton").setAttribute("class", "text-center d-none");
        //}
        return cek;
    }
    function generateTemplate(){
        var kegiatan=           document.getElementById("kegiatan").value;
        var cekWilayah=         cekRadioValue('cekWilayah');
        var cekKlasifikasi =    cekRadioValue('cekKlasifikasi');
        var cekKomoditas =      cekRadioValue('cekKomoditas');
        var cekTransaksi =      cekRadioValue('cekTransaksi');
        var cekInstitusi =      cekRadioValue('cekInstitusi');
        var cekKuantitas =      cekRadioValue('cekKuantitas');
        var cekSeries =         cekRadioValue('cekSeries');
        var wilayah =           document.getElementById("wilayah").value;
        var klasifikasi =       document.getElementById("klasifikasi").value;
        var kodeklasifikasi =   document.getElementById("kodeklasifikasi").value;
        var komoditas =         document.getElementById("komoditas").value;
        var kodekomoditas =     document.getElementById("kodekomoditas").value;
        var transaksi =         document.getElementById("transaksi").value;
        var kodetransaksi =     document.getElementById("kodetransaksi").value;
        var institusi =         document.getElementById("institusi").value;
        var kodeinstitusi =     document.getElementById("kodeinstitusi").value;
        var kuantitas =         document.getElementById("kuantitas").value;
        var series =            document.getElementById("series").value;   
        //var periode =           document.getElementById("periode").value;
        var periode='';
        if(series=='A'){
             periode = document.getElementById("detailseriestahun").value;
        }else if(series=='D' || series=='U'){
             periode = document.getElementById("periode").value;
        }else{
            if( document.getElementById("detailseries").value=='' || document.getElementById("detailseriestahun").value==''){
                 periode=''; 
            }else{
                 periode = document.getElementById("detailseries").value+'_'+document.getElementById("detailseriestahun").value;
            }          
        }
              
        if(radioValidation()){
            var data ="?kegiatan="+kegiatan+
                "&cekWilayah="+cekWilayah+
                "&cekKlasifikasi="+cekKlasifikasi+
                "&cekKomoditas="+cekKomoditas+
                "&cekTransaksi="+cekTransaksi+
                "&cekInstitusi="+cekInstitusi+
                "&cekKuantitas="+cekKuantitas+               
                "&cekSeries="+cekSeries+
                "&wilayah="+wilayah+
                "&klasifikasi="+klasifikasi+
                "&kodeklasifikasi="+kodeklasifikasi+
                "&komoditas="+komoditas+
                "&kodekomoditas="+kodekomoditas+
                "&transaksi="+transaksi+
                "&kodetransaksi="+kodetransaksi+
                "&institusi="+institusi+
                "&kodeinstitusi="+kodeinstitusi+
                "&kuantitas="+kuantitas+
                "&series="+series+
                "&periode="+periode;
                //var r = confirm(data);
                //if (r == true) {
                    window.location.href="generate.php"+data;
                    //alert(data)
                //}         
        }else{
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Semua isian harus terisi",
            });
        }
        
    }
</script>

<script type="text/javascript">
    document.getElementById("loading_proses").style.display = "none";
    document.getElementById("loading_proses2").style.display = "none";
    document.getElementById("loading_proses3").style.display = "none";
    document.getElementById("loading_proses4").style.display = "none";
    document.getElementById("loading_proses5").style.display = "none";
    document.getElementById("loading_proses6").style.display = "none";
    document.getElementById("loading_proses_modal").style.display = "none";
    document.getElementById("loading_proses_upload").style.display = "none";
     
</script>

</main>
