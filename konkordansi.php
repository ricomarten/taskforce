<main id="js-page-content" role="main" class="page-content">
    <ol class="breadcrumb page-breadcrumb">
        <li class="position-absolute pos-top pos-right "><span class="js-get-date"></span></li>
    </ol>
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-link'></i> Konkordansi Klasifikasi
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
                        Konkordansi Klasifikasi
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                    <div class="text-left">
                            <button id="btn-export" onclick="uploadFile()" type="button" class="btn btn-md btn-outline-primary waves-effect waves-themed">
                                <span class="fal fa-plus mr-1"></span> Tambah Konkordansi
                            </button>
                        </div>
                        <div class="form-group row">
                            <label for="konkordansi" class="col-sm-2 col-form-label">Konkordansi</label>                   
                            <div class="col-sm-10">
                                 <div class="input-group">
                                    <select class="select2-placeholder form-control w-100" id="konkordansi" onchange="callTable(this.value)">
                                    <option value=''></option>
                                    <?php
                                        $sql_series=sqlsrv_query($conn, "SELECT * from c.ClassificationConcordance");
                                        while($series = sqlsrv_fetch_array($sql_series, SQLSRV_FETCH_ASSOC)){
                                            echo "<option value='".$series['ClassificationConcordanceID']."'>".$series['ClassificationConcordanceName']."</option>";              
                                        }
                                    ?>
                                    </select>
                                </div>
                            </div>                                                                
                        </div>
                        <div class="form-group row">
                            <div id="search">
                                <div class="col-sm-4">
                                    <div class="input-group mb-3" >
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="filter">Filter</span>
                                        </div>
                                        <input type="text" class="form-control" data-table="table" data-count="#count" placeholder="Enter text to filter..." aria-label="Filter" aria-describedby="filter">
                                    </div>
                                <div>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            
                            <div class="col-sm-12" id="keterangan"></div>
                        </div>
                        <div id="result"></div>
                        
                        <input type="hidden" id="nip" value="<?php echo $_SESSION['niplama'] ?>">
                        <input type="hidden" id="unitkerja" value="<?php echo $_SESSION['unitkerja_id'] ?>">
                        <input type="hidden" id="wilayah" value="<?php echo $_SESSION['wilayah_id'] ?>">
                        <div class="panel-footer text-center">
                            <div id="loading_proses">
                                <strong>Loading...</strong> <img src="img/loading.gif"/>
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        document.getElementById("loading_proses").style.display = "none";
        document.getElementById("search").style.display = "none";
        function callTable(data){
            document.getElementById("result").innerHTML="";
            document.getElementById("loading_proses").style.display = "block";
            document.getElementById("search").style.display = "block";
            var fd = new FormData();
            fd.append("id", data);
            var xmlHTTP= new XMLHttpRequest();
            var url = "konkordansifile.php"; 
                xmlHTTP.open("POST", url, true);
                xmlHTTP.onload = function() {
                    if (xmlHTTP.status >= 200 && xmlHTTP.status < 400) {
                       if(this.responseText=="ok"){
                            document.getElementById("result").innerHTML='<div class="alert alert-success alert-dismissible fade show" role="alert">'+
                                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">'+
                                            '<i class="fal fa-times"></i></span></button> Berhasil mengupload file silahkan lihat daftar Laporan di <a href="index.php?menu=<?php echo encrypt('laporan')?>"> Daftar File Laporan WFH</a></div>';
                        }else{
                            document.getElementById("result").innerHTML=this.responseText
                        }
                    }
                    document.getElementById("loading_proses").style.display = "none";
                }              
                xmlHTTP.send(fd);                 
            }
    
        
        </script>

</main>
<script>
(function () {
  "use strict";

  var TableFilter = (function () {
    var search;

    function dquery(selector) {
      // Returns an array of elements corresponding to the selector
      return Array.prototype.slice.call(document.querySelectorAll(selector));
    }

    function onInputEvent(e) {
      // Retrieves the text to search
      var input = e.target;
      search = input.value.toLocaleLowerCase();
      // Get the lines where to search
      // (the data-table attribute of the input is used to identify the table to be filtered)
      var selector = input.getAttribute("data-table") + " tbody tr";
      var rows = dquery(selector);
      // Searches for the requested text on all rows of the table
      [].forEach.call(rows, filter);
      // Updating the line counter (if there is one defined)
      // (the data-count attribute of the input is used to identify the element where to display the counter)
      var writer = input.getAttribute("data-count");
      if (writer) {
        // If there is a data-count attribute, we count visible rows
        var count = rows.reduce(function (t, x) { return t + (x.style.display === "none" ? 0 : 1); }, 0);
        // Then we display the counter
        dquery(writer)[0].textContent = count;
      }
    }

    function filter(row) {
      // Caching the tr line in lowercase
      if (row.lowerTextContent === undefined)
        row.lowerTextContent = row.textContent.toLocaleLowerCase();
      // Hide the line if it does not contain the search text
      row.style.display = row.lowerTextContent.indexOf(search) === -1 ? "none" : "table-row";
    }

    return {
      init: function () {
        // get the list of input fields with a data-table attribute
        var inputs = dquery("input[data-table]");
        [].forEach.call(inputs, function (input) {
          // Triggers the search as soon as you enter a search filter
          input.oninput = onInputEvent;
          // If we already have a value (following navigation back), we relaunch the search
          if (input.value !== "") input.oninput({ target: input });
        });
      }
    };

  })();

  TableFilter.init();
})();
</script>