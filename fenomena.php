<main id="js-page-content" role="main" class="page-content">
    <ol class="breadcrumb page-breadcrumb">
        <li class="position-absolute pos-top pos-right "><span class="js-get-date"></span></li>
    </ol>
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-snowflake'></i> Entri Fenomena
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
                        Entri Fenomena
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="form-group">
                            <div class="input-group row">                           
                                <label class="col-sm-2 col-form-label">Wilayah Fenomena</label>
                                <div class="col-sm-10">
                                    <div class="input-group" id="selectWilayah">
                                        <select class="select2-placeholder form-control w-100" id="wilayah"  >
                                        <option value=''></option>
                                        <?php
                                            $sql_series=sqlsrv_query($conn, "SELECT * from c.AdministrativeArea");
                                            while($series = sqlsrv_fetch_array($sql_series, SQLSRV_FETCH_ASSOC)){
                                                echo "<option value='".$series['AdministrativeAreaID']."'>[".$series['AdministrativeAreaCode']."] ".$series['AdministrativeAreaName']."</option>";
                                            }
                                        ?>
                                        </select>
                                    </div>
                                </div>   
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group row">
                                <label class="col-sm-2 col-form-label"> Aktivitas/Lapangan Usaha</label>
                                <div class="col-sm-4">
                                    <div class="input-group" id="selectKlasifikasi">
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
                                <div class="col-sm-6">                          
                                    <div class="input-group" id="selectKodeKlasifikasi">
                                        <select class="select2-placeholder form-control w-100" id="kodeklasifikasi" >
                                        <option value=''></option>
                                        </select>
                                    </div>
                                </div>  
                            </div>
                        </div>
                        <div id="loading_proses2">
                            <strong>Loading...</strong> <img src="img/loading.gif"/>
                        </div>
                        <div class="form-group">
                            <div class="input-group row">
                                <label class="col-sm-2 col-form-label">Aset/Komoditas</label>
                                <div class="col-sm-4">
                                    <div class="input-group" id="selectKomoditas">
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
                                <div class="col-sm-6">
                                    <div class="input-group" id="selectKodeKomoditas">
                                        <select class="select2-placeholder form-control w-100" id="kodekomoditas"  >
                                        <option value=''></option>
                                        </select>
                                    </div>
                                </div>     
                            </div>
                        </div>
                        <div id="loading_proses3">
                            <strong>Loading...</strong> <img src="img/loading.gif"/>
                        </div>
                        <div class="form-group">
                            <div class="input-group row">
                                <label class="col-sm-2 col-form-label">Jenis Transaksi</label>
                                <div class="col-sm-4">
                                    <div class="input-group" id="selectTransaksi">
                                        <select class="select2-placeholder form-control w-100" id="transaksi"  >
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
                                <div class="col-sm-6">
                                    <div class="input-group" id="selectKodeTransaksi">
                                        <select class="select2-placeholder form-control w-100" id="kodetransaksi"  >
                                        <option value=''></option>
                                        </select>
                                    </div>
                                </div> 
                            </div>
                        </div>
                        <div id="loading_proses4">
                            <strong>Loading...</strong> <img src="img/loading.gif"/>
                        </div>
                        <div class="form-group">
                            <div class="input-group row">
                                <label class="col-sm-2 col-form-label">Sektor Institusi</label>
                                <div class="col-sm-4">
                                    <div class="input-group" id="selectInstitusi">
                                        <select class="select2-placeholder form-control w-100" id="institusi"  >
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
                                <div class="col-sm-6">
                                    <div class="input-group" id="selectKodeInstitusi">
                                        <select class="select2-placeholder form-control w-100" id="kodeinstitusi"  >
                                        <option value=''></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="loading_proses5">
                            <strong>Loading...</strong> <img src="img/loading.gif"/>
                        </div>
                        <div class="form-group">
                            <div class="input-group row">
                                <label class="col-sm-2 col-form-label">Ukuran Kuantitas</label>
                                <div class="col-sm-10">
                                    <div class="input-group" id="selectKuantitas">
                                        <select class="select2-placeholder form-control w-100" id="kuantitas"  >
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
                            <div class="input-group row">
                                <label class="col-sm-2 col-form-label">Series Data</label>
                                <div class="col-sm-10">
                                    <div class="input-group" id="selectSeries">
                                        <select class="select2-placeholder form-control w-100" id="seriesdata">
                                        <option value=''></option>
                                        <?php
                                            $sql_series=sqlsrv_query($conn, "SELECT * from c.DataSeries");
                                            while($series = sqlsrv_fetch_array($sql_series, SQLSRV_FETCH_ASSOC)){
                                                echo "<option value='".$series['DataSeriesID']."'>".$series['DataSeriesName']."</option>";
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
                        <div class="form-group">
                            <div class="input-group row">
                                <label class="col-sm-2 col-form-label">Rentang Periode Data</label>
                                <div class="col-sm-5">
                                    <div class="input-group" id="selectSeries">
                                        <select class="select2-placeholder form-control w-100" id="range">
                                        <option value=''></option>
                                        <?php
                                            $sql_range=sqlsrv_query($conn, "SELECT * from c.PeriodRange");
                                            while($range = sqlsrv_fetch_array($sql_range, SQLSRV_FETCH_ASSOC)){
                                                echo "<option value='".$range['PeriodRangeID']."'>".$range['PeriodRangeName']."</option>";
                                            }
                                        ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="daterange" placeholder="Select date" >
                                </div>   
                            </div>
                        </div>
                        <div class="form-group" id="showPeriode">
                            <div class="input-group row" id="periodeHari" style="display:none">
                                <label class="col-sm-2 col-form-label">Pilih periode data</label> 
                                <div class="col-sm-10">
                                    <div id="selectPeriode">
                                        <div class="input-group">
                                            <input  type="text" class="form-control "readonly placeholder="Pilih Periode" id="periode" name="periode"  >
                                            <div class="input-group-append">
                                                <span class="input-group-text fs-xl">
                                                    <i class="fal fa-calendar-alt"></i>
                                                </span>
                                            </div>
                                         </div>
                                    </div>
                                </div>   
                            </div>
        
                            <div class="input-group row" id="periodeBulan" style="display:none">
                                <label class="col-sm-2 col-form-label">Pilih periode data</label>   
                                <div class="col-sm-10">
                                    <div class="input-group" id="selectDetailSeries">
                                        <select class="select2-placeholder form-control w-100" id="detailseries"  >
                                        <option value=''></option>
                                        </select>
                                    </div>
                                </div>   
                            </div> 
                            <div class="input-group row" id="periodeTahun" style="display:none">
                                <label class="col-sm-2 col-form-label">Tahun</label>   
                                <div class="col-sm-10">
                                    <div class="input-group" id="selectDetailSeriesTahun">
                                        <select class="select2-placeholder form-control w-100" id="detailseriestahun"  >
                                        <?php
                                            for($i=date("Y");$i>=1950;$i--){
                                                echo "<option value='$i'>$i</option>";
                                            }
                                        ?>
                                        
                                        </select>
                                    </div>
                                </div>   
                            </div> 

                        </div > 
                        <div class="form-group">
                            <div class="input-group row">
                                <label class="col-sm-2 col-form-label">Tren Data</label>
                                <div class="col-sm-10">
                                    <div class="input-group" id="selectSeries">
                                        <select class="select2-placeholder form-control w-100" id="tren">
                                        <option value=''></option>
                                        <?php
                                            $sql_series=sqlsrv_query($conn, "SELECT * from c.Trend");
                                            while($series = sqlsrv_fetch_array($sql_series, SQLSRV_FETCH_ASSOC)){
                                                echo "<option value='".$series['TrendID']."'>".$series['TrendName']."</option>";
                                            }
                                        ?>
                                        </select>
                                    </div>
                                </div>   
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group row">
                                <label class="col-sm-2 col-form-label">Fenomena</label>  
                                <div class="col-sm-10">                     
                                    <textarea id="fenomena1" rows="4" class="form-control" name="foo01" value="first name"></textarea>
                                </div> 
                            </div>
                        </div>
                        <input type="text" id="jml" name="jml" class="d-none">
                        <div class="form-group">
                            <div class="input-group row">
                            <label class="col-sm-2 col-form-label">Sumber Fenomena</label>  
                                <div class="col-sm-10">                     
                                    <textarea id="sumber1" rows="4" class="form-control" name="foo02" value="last name"></textarea>               
                                </div>  
                            </div>
                        </div>
                        
                        <div id="tambahan">
                        </div>
                        
                        <button type="button" class="btn btn-sm btn-outline-success waves-effect waves-themed" onclick="add()">
                            <span class="fal fa-plus mr-1"></span> Tambah Isian Fenomena 
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-danger waves-effect waves-themed" onclick="removeRow()">
                            <span class="fal fa-trash mr-1"></span> Hapus
                        </button>              
                        <div id="generateButton" class="form-group text-center">
                            <button id="btn-export" onclick="generateTemplate()" type="button" class="btn btn-md btn-outline-dark waves-effect waves-themed">
                                <span class="fal fa-save mr-1"></span> Simpan Fenomena
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
 <script>
    var x = 1;
    document.getElementById("jml").value=x;
    function removeRow(){
        var fooId = "foo";
        if(x>=2){
            document.getElementById(fooId+(x)).remove();
            x--         
        }else{
            Swal.fire({
                icon: "error",
                title: "Terjadi kesalahan",
                text: "Form awal tidak dapat dihapus",
            });
        }
        document.getElementById("jml").value=x;
    }  
    function add() {
        console.log(x);
        x++;
        var fooId = "foo";
        div= document.createElement("div");
        div.setAttribute("class", "form-group");
        div.setAttribute("id", fooId+x);

        var div1 = document.createElement("div");
        div1.setAttribute("class", "form-group");
        var div2 = document.createElement("div");
        div2.setAttribute("class", "input-group row");
        var label= document.createElement("label");
        label.setAttribute("class","col-sm-2 col-form-label");
        label.innerHTML="Fenomena "+x;
        var div3= document.createElement("div");
        div3.setAttribute("class","col-sm-10");
        var fenomena= document.createElement("textarea");
        fenomena.setAttribute("class","form-control");
        fenomena.setAttribute("rows","4");
        fenomena.setAttribute("id","fenomena"+x);
        div3.appendChild(fenomena);
        div2.appendChild(label);
        div2.appendChild(div3);
        div1.appendChild(div2);
        div.appendChild(div1);

        var div1 = document.createElement("div");
        div1.setAttribute("class", "form-group");
        var div2 = document.createElement("div");
        div2.setAttribute("class", "input-group row");
        var label= document.createElement("label");
        label.setAttribute("class","col-sm-2 col-form-label");
        label.innerHTML="Sumber Fenomena "+x;
        var div3= document.createElement("div");
        div3.setAttribute("class","col-sm-10");
        var sumber= document.createElement("textarea");
        sumber.setAttribute("class","form-control");
        sumber.setAttribute("rows","4");
        sumber.setAttribute("id","sumber"+x);
        div3.appendChild(sumber);
        div2.appendChild(label);
        div2.appendChild(div3);
        div1.appendChild(div2);
        div.appendChild(div1);

        var foo = document.getElementById("tambahan");       
        foo.appendChild(div);
        document.getElementById("jml").value=x;
        
    }

    function cekFenomena(n){
        var hasil=true;
        for(i=1;i<=n;i++){
            fenomena=document.getElementById("fenomena"+i).value;
            sumber=document.getElementById("sumber"+i).value;
            if(fenomena.length<5 || sumber.length<5 ){hasil =false}
        }
        return hasil;
    }
    function radioValidation(){
        var cek=true;
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
        var series =            document.getElementById("seriesdata").value;
        var range=              document.getElementById("range").value;
        var periode=            document.getElementById("daterange").value;
        var tren =            document.getElementById("tren").value;
        var jml =             document.getElementById("jml").value;  
        var fenomena=cekFenomena(jml);
            if(wilayah==''){
                cek=false;
            }else if(!fenomena){
                cek=false;
            }else if(kodeklasifikasi==''){
                cek=false;
            }else if(kodekomoditas==''){
                cek=false;
            }else if(kodetransaksi==''){
                cek=false;
            }else if(kodeinstitusi==''){
                cek=false;
            }else if(kuantitas==''){
                cek=false;
            }else if(periode==''){
                cek=false;
            }else if(range==''){
                cek=false;
            }else if(tren==''){
                cek=false;
            }else if(jml==''){
                cek=false;
            }
            else{
                cek=true;
            }      
        return cek;
    }
    function generateTemplate(){
        var json_arr = {};
        json_arr["wilayah"] = document.getElementById("wilayah").value;
        json_arr["klasifikasi"] = document.getElementById("klasifikasi").value;
        json_arr["kodeklasifikasi"] = document.getElementById("kodeklasifikasi").value;
        json_arr["komoditas"] = document.getElementById("komoditas").value;
        json_arr["kodekomoditas"] = document.getElementById("kodekomoditas").value;
        json_arr["transaksi"] = document.getElementById("transaksi").value;
        json_arr["kodetransaksi"] = document.getElementById("kodetransaksi").value;
        json_arr["institusi"] = document.getElementById("institusi").value;
        json_arr["kodeinstitusi"] = document.getElementById("kodeinstitusi").value;
        json_arr["kuantitas"] = document.getElementById("kuantitas").value;
        json_arr["series"] = document.getElementById("seriesdata").value;
        json_arr["tren"] = document.getElementById("tren").value;
        json_arr["jml"] = document.getElementById("jml").value;
        json_arr["range"]= document.getElementById("range").value;
        json_arr["periode"]= document.getElementById("daterange").value;
        json_arr["menuId"] = 7;
       
        json_fenomena = [];
        json_sumber = [];
        for(i=1;i<=document.getElementById("jml").value;i++){
            json_fenomena[i-1]=document.getElementById("fenomena"+i).value;
            json_sumber[i-1]=document.getElementById("sumber"+i).value;
        }
        json_arr["fenomena"]=json_fenomena;
        json_arr["sumber"]=json_sumber;
        var data = JSON.stringify(json_arr);
        if(radioValidation()){
            document.getElementById("loading_proses").style.display = "block";
            //var r = confirm(data);
            var xhr = new XMLHttpRequest();
            var url = "submit_ajax.php";
            xhr.open("POST", url, true);
            xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
            xhr.onload = function () {     
                if(this.responseText=='ok'){
                        Swal.fire({
                        title: "Selamat",
                        text: "Anda berhasil menambahkan fenomena",
                        icon: "success",
                        confirmButtonText: "Ok"
                        }).then(function(result)
                        {
                            document.getElementById("loading_proses").style.display = "none";
                            window.location.href = "index.php?menu=<?php echo encrypt('fenomena')?>";
                        });                
                }else {
                    // alert(this.responseText);
                    Swal.fire(
                    {
                        icon: "error",
                        title: "Oops...",
                        html: '<div class="alert alert-danger">'+this.responseText+'</div>',
                        //footer: "<a href>Why do I have this issue?</a>"
                    });
                    document.getElementById("loading_proses").style.display = "none";
                }
            };
            xhr.send(data);
            return false;
        }else{
            Swal.fire({
                icon: "error",
                title: "Terjadi kesalahan",
                //text: data
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
    document.getElementById("loading_proses_upload").style.display = "none";
</script>

</main>
