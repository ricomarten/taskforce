<!-- this overlay is activated only when mobile menu is triggered -->
<div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div> <!-- END Page Content -->
                    <!-- BEGIN Page Footer -->
                    <footer class="page-footer" role="contentinfo">
                        <div class="d-flex align-items-center flex-1 text-muted">
                            <span class="hidden-md-down fw-700">Badan Pusat Statistik - Subdit Pengembangan Basis Data</span>
                        </div>
                        
                    </footer>
                    <!-- END Page Footer -->
                    <!-- BEGIN Shortcuts -->

                </div>
            </div>
        </div>
        <!-- END Page Wrapper -->
        <!-- BEGIN Quick Menu -->
        <!-- to add more items, please make sure to change the variable '$menu-items: number;' in your _page-components-shortcut.scss -->
        <nav class="shortcut-menu d-none d-sm-block">
            <input type="checkbox" class="menu-open" name="menu-open" id="menu_open" />
            <label for="menu_open" class="menu-open-button ">
                <span class="app-shortcut-icon d-block"></span>
            </label>
            <a href="#" class="menu-item btn" data-toggle="tooltip" data-placement="left" title="Scroll Top">
                <i class="fal fa-arrow-up"></i>
            </a>
            
            <a href="logout.php" class="menu-item btn" data-toggle="tooltip" data-placement="left" title="Logout">
                <i class="fal fa-sign-out"></i>
            </a>
            <a href="#" class="menu-item btn" data-action="app-fullscreen" data-toggle="tooltip" data-placement="left" title="Full Screen">
                <i class="fal fa-expand"></i>
            </a>
            <a href="#" class="menu-item btn" data-action="app-print" data-toggle="tooltip" data-placement="left" title="Print page">
                <i class="fal fa-print"></i>
            </a>
            
        </nav>
        <!-- END Quick Menu -->
        
        <!-- BEGIN Page Settings -->
        <div class="modal fade js-modal-settings modal-backdrop-transparent" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-right modal-md">
                <div class="modal-content">
                    <div class="dropdown-header bg-trans-gradient d-flex justify-content-center align-items-center w-100">
                        <h4 class="m-0 text-center color-white">
                            Layout Settings
                            <small class="mb-0 opacity-80">User Interface Settings</small>
                        </h4>
                        <button type="button" class="close text-white position-absolute pos-top pos-right p-2 m-1 mr-2" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fal fa-times"></i></span>
                        </button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="settings-panel">
                            <div class="mt-4 d-table w-100 px-5">
                                <div class="d-table-cell align-middle">
                                    <h5 class="p-0">
                                        App Layout
                                    </h5>
                                </div>
                            </div>
                            <div class="list" id="fh">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="header-function-fixed"></a>
                                <span class="onoffswitch-title">Fixed Header</span>
                                <span class="onoffswitch-title-desc">header is in a fixed at all times</span>
                            </div>
                            <div class="list" id="nff">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="nav-function-fixed"></a>
                                <span class="onoffswitch-title">Fixed Navigation</span>
                                <span class="onoffswitch-title-desc">left panel is fixed</span>
                            </div>
                            <div class="list" id="nfm">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="nav-function-minify"></a>
                                <span class="onoffswitch-title">Minify Navigation</span>
                                <span class="onoffswitch-title-desc">Skew nav to maximize space</span>
                            </div>
                            <div class="list" id="nfh">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="nav-function-hidden"></a>
                                <span class="onoffswitch-title">Hide Navigation</span>
                                <span class="onoffswitch-title-desc">roll mouse on edge to reveal</span>
                            </div>
                            <div class="list" id="nft">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="nav-function-top"></a>
                                <span class="onoffswitch-title">Top Navigation</span>
                                <span class="onoffswitch-title-desc">Relocate left pane to top</span>
                            </div>
                            <div class="list" id="mmb">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-main-boxed"></a>
                                <span class="onoffswitch-title">Boxed Layout</span>
                                <span class="onoffswitch-title-desc">Encapsulates to a container</span>
                            </div>
                            <div class="expanded">
                                <ul class="">
                                    <li>
                                        <div class="bg-fusion-50" data-action="toggle" data-class="mod-bg-1"></div>
                                    </li>
                                    <li>
                                        <div class="bg-warning-200" data-action="toggle" data-class="mod-bg-2"></div>
                                    </li>
                                    <li>
                                        <div class="bg-primary-200" data-action="toggle" data-class="mod-bg-3"></div>
                                    </li>
                                    <li>
                                        <div class="bg-success-300" data-action="toggle" data-class="mod-bg-4"></div>
                                    </li>
                                </ul>
                                <div class="list" id="mbgf">
                                    <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-fixed-bg"></a>
                                    <span class="onoffswitch-title">Fixed Background</span>
                                </div>
                            </div>
                            <div class="mt-4 d-table w-100 px-5">
                                <div class="d-table-cell align-middle">
                                    <h5 class="p-0">
                                        Accessibility
                                    </h5>
                                </div>
                            </div>
                            <div class="list" id="mbf">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-bigger-font"></a>
                                <span class="onoffswitch-title">Bigger Content Font</span>
                                <span class="onoffswitch-title-desc">content fonts are bigger for readability</span>
                            </div>
                            <div class="list" id="mhc">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-high-contrast"></a>
                                <span class="onoffswitch-title">High Contrast Text (WCAG 2 AA)</span>
                                <span class="onoffswitch-title-desc">4.5:1 text contrast ratio</span>
                            </div>
                            <div class="list" id="mcb">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-color-blind"></a>
                                <span class="onoffswitch-title">Daltonism <sup>(beta)</sup> </span>
                                <span class="onoffswitch-title-desc">color vision deficiency</span>
                            </div>
                            <div class="list" id="mpc">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-pace-custom"></a>
                                <span class="onoffswitch-title">Preloader Inside</span>
                                <span class="onoffswitch-title-desc">preloader will be inside content</span>
                            </div>
                            <div class="mt-4 d-table w-100 px-5">
                                <div class="d-table-cell align-middle">
                                    <h5 class="p-0">
                                        Global Modifications
                                    </h5>
                                </div>
                            </div>
                            <div class="list" id="mcbg">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-clean-page-bg"></a>
                                <span class="onoffswitch-title">Clean Page Background</span>
                                <span class="onoffswitch-title-desc">adds more whitespace</span>
                            </div>
                            <div class="list" id="mhni">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-hide-nav-icons"></a>
                                <span class="onoffswitch-title">Hide Navigation Icons</span>
                                <span class="onoffswitch-title-desc">invisible navigation icons</span>
                            </div>
                            <div class="list" id="dan">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-disable-animation"></a>
                                <span class="onoffswitch-title">Disable CSS Animation</span>
                                <span class="onoffswitch-title-desc">Disables CSS based animations</span>
                            </div>
                            <div class="list" id="mhic">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-hide-info-card"></a>
                                <span class="onoffswitch-title">Hide Info Card</span>
                                <span class="onoffswitch-title-desc">Hides info card from left panel</span>
                            </div>
                            <div class="list" id="mlph">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-lean-subheader"></a>
                                <span class="onoffswitch-title">Lean Subheader</span>
                                <span class="onoffswitch-title-desc">distinguished page header</span>
                            </div>
                            <div class="list" id="mnl">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-nav-link"></a>
                                <span class="onoffswitch-title">Hierarchical Navigation</span>
                                <span class="onoffswitch-title-desc">Clear breakdown of nav links</span>
                            </div>
                            <div class="list mt-1">
                                <span class="onoffswitch-title">Global Font Size <small>(RESETS ON REFRESH)</small> </span>
                                <div class="btn-group btn-group-sm btn-group-toggle my-2" data-toggle="buttons">
                                    <label class="btn btn-default btn-sm" data-action="toggle-swap" data-class="root-text-sm" data-target="html">
                                        <input type="radio" name="changeFrontSize"> SM
                                    </label>
                                    <label class="btn btn-default btn-sm" data-action="toggle-swap" data-class="root-text" data-target="html">
                                        <input type="radio" name="changeFrontSize" checked=""> MD
                                    </label>
                                    <label class="btn btn-default btn-sm" data-action="toggle-swap" data-class="root-text-lg" data-target="html">
                                        <input type="radio" name="changeFrontSize"> LG
                                    </label>
                                    <label class="btn btn-default btn-sm" data-action="toggle-swap" data-class="root-text-xl" data-target="html">
                                        <input type="radio" name="changeFrontSize"> XL
                                    </label>
                                </div>
                                <span class="onoffswitch-title-desc d-block mb-g">Change <strong>root</strong> font size to effect rem values</span>
                            </div>
                            <div class="mt-2 d-table w-100 pl-5 pr-3">
                                <div class="d-table-cell align-middle">
                                    <h5 class="p-0">
                                        Theme colors <small>(overlays base css)</small>
                                    </h5>
                                    <div class="fs-xs text-muted p-2 alert alert-warning mt-3 mb-0">
                                        <i class="fal fa-exclamation-triangle text-warning mr-2"></i>Due to network latency and CPU utilization, you may experience a brief flickering effect on page load which may show the intial applied theme for a split second. Setting the prefered style/theme in the header will prevent this from happening.
                                    </div>
                                </div>
                            </div>
                            <div class="expanded theme-colors pl-5 pr-3">
                                <ul class="m-0">
                                    <li><a href="#" id="myapp-0" data-action="theme-update" data-themesave data-theme="" data-toggle="tooltip" data-placement="top" title="Wisteria (base css)" data-original-title="Wisteria (base css)"></a></li>
                                    <li><a href="#" id="myapp-1" data-action="theme-update" data-themesave data-theme="css/themes/cust-theme-1.css" data-toggle="tooltip" data-placement="top" title="Tapestry" data-original-title="Tapestry"></a></li>
                                    <li><a href="#" id="myapp-2" data-action="theme-update" data-themesave data-theme="css/themes/cust-theme-2.css" data-toggle="tooltip" data-placement="top" title="Atlantis" data-original-title="Atlantis"></a></li>
                                    <li><a href="#" id="myapp-3" data-action="theme-update" data-themesave data-theme="css/themes/cust-theme-3.css" data-toggle="tooltip" data-placement="top" title="Indigo" data-original-title="Indigo"></a></li>
                                    <li><a href="#" id="myapp-4" data-action="theme-update" data-themesave data-theme="css/themes/cust-theme-4.css" data-toggle="tooltip" data-placement="top" title="Dodger Blue" data-original-title="Dodger Blue"></a></li>
                                    <li><a href="#" id="myapp-5" data-action="theme-update" data-themesave data-theme="css/themes/cust-theme-5.css" data-toggle="tooltip" data-placement="top" title="Tradewind" data-original-title="Tradewind"></a></li>
                                    <li><a href="#" id="myapp-6" data-action="theme-update" data-themesave data-theme="css/themes/cust-theme-6.css" data-toggle="tooltip" data-placement="top" title="Cranberry" data-original-title="Cranberry"></a></li>
                                    <li><a href="#" id="myapp-7" data-action="theme-update" data-themesave data-theme="css/themes/cust-theme-7.css" data-toggle="tooltip" data-placement="top" title="Oslo Gray" data-original-title="Oslo Gray"></a></li>
                                    <li><a href="#" id="myapp-8" data-action="theme-update" data-themesave data-theme="css/themes/cust-theme-8.css" data-toggle="tooltip" data-placement="top" title="Chetwode Blue" data-original-title="Chetwode Blue"></a></li>
                                    <li><a href="#" id="myapp-9" data-action="theme-update" data-themesave data-theme="css/themes/cust-theme-9.css" data-toggle="tooltip" data-placement="top" title="Apricot" data-original-title="Apricot"></a></li>
                                    <li><a href="#" id="myapp-10" data-action="theme-update" data-themesave data-theme="css/themes/cust-theme-10.css" data-toggle="tooltip" data-placement="top" title="Blue Smoke" data-original-title="Blue Smoke"></a></li>
                                    <li><a href="#" id="myapp-11" data-action="theme-update" data-themesave data-theme="css/themes/cust-theme-11.css" data-toggle="tooltip" data-placement="top" title="Green Smoke" data-original-title="Green Smoke"></a></li>
                                    <li><a href="#" id="myapp-12" data-action="theme-update" data-themesave data-theme="css/themes/cust-theme-12.css" data-toggle="tooltip" data-placement="top" title="Wild Blue Yonder" data-original-title="Wild Blue Yonder"></a></li>
                                    <li><a href="#" id="myapp-13" data-action="theme-update" data-themesave data-theme="css/themes/cust-theme-13.css" data-toggle="tooltip" data-placement="top" title="Emerald" data-original-title="Emerald"></a></li>
                                </ul>
                            </div>
                            <hr class="mb-0 mt-4">
                            <div class="pl-5 pr-3 py-3 bg-faded">
                                <div class="row no-gutters">
                                    <div class="col-6 pr-1">
                                        <a href="#" class="btn btn-outline-danger fw-500 btn-block" data-action="app-reset">Reset Settings</a>
                                    </div>
                                    <div class="col-6 pl-1">
                                        <a href="#" class="btn btn-danger fw-500 btn-block" data-action="factory-reset">Factory Reset</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <span id="saving"></span>
                    </div>
                </div>
            </div>
        </div> <!-- END Page Settings -->
        <script src="js/vendors.bundle.js"></script>
        <script src="js/app.bundle.js"></script>
        <script src="js/notifications/sweetalert2/sweetalert2.js"></script>
        <script src="js/formplugins/select2/select2.js"></script>
        <script src="js/dependency/moment/moment.js"></script>
        <script src="js/formplugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
        <script src="js/formplugins/bootstrap-daterangepicker/bootstrap-daterangepicker.js"></script>
        
        <script>
            var controls = {
                leftArrow: '<i class="fal fa-angle-left" style="font-size: 1.25rem"></i>',
                rightArrow: '<i class="fal fa-angle-right" style="font-size: 1.25rem"></i>'
            }
            
            var runDatePicker = function()
            {
                $('#periode').datepicker(
                {
                    todayHighlight: true,
                    orientation: "bottom left",
                    templates: controls,
                    format: "dd-mm-yyyy",
                });
                $('#tanggal_kegiatan').datepicker(
                {
                    todayHighlight: true,
                    orientation: "bottom left",
                    templates: controls,
                    format: "yyyy-mm-dd",
                });
            }        
            $(document).ready(function()
            {
                runDatePicker();
                <?php if(decrypt($_GET['menu'])=='upload'){?>
                
                $('#provinsi').select2({
                    placeholder: "Pilih Provinsi"
                });
                $('#kabupaten').select2({
                    placeholder: "Pilih Kabupaten/Kota"
                });
                $('#provinsi').change(function() {
                    var selectedCategory = $('#provinsi option:selected').val();
                    document.getElementById("loading_proses").style.display = "block";
                    $.ajax({
                        type: 'POST',
                        url: 'tf_api_kabupaten.php',
                        dataType: 'html',
                        data: {
                            a: 'kabupaten',
                            c: selectedCategory
                        },
                        success: function(txt){
                            //no action on success, its done in the next part
                        }
                    }).done(function(data){
                        //get JSON
                        data = $.parseJSON(data);
                        //generate <options from JSON
                        var list_html = '';
                        list_html += '<option value=></option>';
                        $.each(data, function(i, item) {
                            list_html += '<option value='+data[i].code+'>'+data[i].name+'</option>';
                        });
                        $('#kabupaten').html(list_html);
                        $('#kabupaten').select2({placeholder: data.length +' results'});
                        document.getElementById("loading_proses").style.display = "none";
                    })                  
                });
                
                <?php } ?>
                <?php if(decrypt($_GET['menu'])=='generate' || decrypt($_GET['menu'])=='entri'){?>
                $('#daterange').daterangepicker(
                {
                    opens: 'left'
                }, function(start, end, label)
                {
                    console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
                });

                $('#wilayah').select2({
                    placeholder: "Pilih wilayah"
                });
                $('#transaksi').select2({
                    placeholder: "Pilih jenis transaksi"
                });
                $('#kodetransaksi').select2({
                    placeholder: "Pilih kode transaksi"
                });
                $('#institusi').select2({
                    placeholder: "Pilih sektor institusi"
                });
                $('#kodeinstitusi').select2({
                    placeholder: "Pilih kode institusi"
                });
                $('#series').select2({
                    placeholder: "Pilih series data"
                });
                $('#detailseries').select2({
                    placeholder: "Pilih detail series data"
                });
                $('#detailseries').select2({
                    placeholder: "Pilih detail series data"
                });
                $('#detailseriestahun').select2({
                    placeholder: "Pilih tahun data"
                });
                $('#kuantitas').select2({
                    placeholder: "Pilih ukuran kuantitas"
                });             
                $('#konkordansi').select2({
                    placeholder: "Pilih konkordansi"
                });
                $('#komoditas').select2({
                    placeholder: "Pilih jenis klasifikasi"
                });
                $('#kodekomoditas').select2({
                    placeholder: "Pilih kode aset/komoditas"
                });
                $('#klasifikasi').select2({
                    placeholder: "Pilih jenis klasifikasi"
                });
                $('#kodeklasifikasi').select2({
                    placeholder: "Pilih kode aktivitas/lapangan usaha"
                });
                $('#tren').select2({
                    placeholder: "Pilih tren data"
                });
                $('#seriesdata').select2({
                    placeholder: "Pilih series data"
                });
                $('#range').select2({
                    placeholder: "Pilih rentang periode data"
                });
                $('#komoditas').change(function() {
                    var selectedCategory = $('#komoditas option:selected').val();
                    document.getElementById("loading_proses3").style.display = "block";
                    $.ajax({
                        type: 'POST',
                        url: <?php if(decrypt($_GET['menu'])=='entri') echo "'komoditasid.php'"; else echo "'komoditas.php'"; ?>,
                        dataType: 'html',
                        data: {
                            a: 'kodekomoditas',
                            c: selectedCategory
                        },
                        success: function(txt){
                            //no action on success, its done in the next part
                        }
                    }).done(function(data){
                        //get JSON
                        data = $.parseJSON(data);
                        //generate <options from JSON
                        var list_html = '';
                        list_html += '<option value=></option>';
                        $.each(data, function(i, item) {
                            list_html += '<option value='+data[i].code+'>'+data[i].name+'</option>';
                        });
                        $('#kodekomoditas').html(list_html);
                        $('#kodekomoditas').select2({placeholder: data.length +' results'});
                        document.getElementById("loading_proses3").style.display = "none";
                    })                  
                });
                $('#klasifikasi').change(function() {
                    var selectedCategory = $('#klasifikasi option:selected').val();
                    document.getElementById("loading_proses2").style.display = "block";
                    $.ajax({
                        type: 'POST',
                        url: <?php if(decrypt($_GET['menu'])=='entri') echo "'komoditasid.php'"; else echo "'komoditas.php'"; ?>,
                        dataType: 'html',
                        data: {
                            a: 'kodeklasifikasi',
                            c: selectedCategory
                        },
                        success: function(txt){
                            //no action on success, its done in the next part
                        }
                    }).done(function(data){
                        //get JSON
                        data = $.parseJSON(data);
                        //generate <options from JSON
                        var list_html = '';
                        list_html += '<option value=></option>';
                        $.each(data, function(i, item) {
                            list_html += '<option value='+data[i].code+'>'+data[i].name+'</option>';
                        });
                        $('#kodeklasifikasi').html(list_html);
                        $('#kodeklasifikasi').select2({placeholder: data.length +' results'});
                        document.getElementById("loading_proses2").style.display = "none";
                    })                  
                });
                $('#transaksi').change(function() {
                    var selectedCategory = $('#transaksi option:selected').val();
                    document.getElementById("loading_proses4").style.display = "block";
                    $.ajax({
                        type: 'POST',
                        url: <?php if(decrypt($_GET['menu'])=='entri') echo "'komoditasid.php'"; else echo "'komoditas.php'"; ?>,
                        dataType: 'html',
                        data: {
                            a: 'kodetransaksi',
                            c: selectedCategory
                        },
                        success: function(txt){
                            //no action on success, its done in the next part
                        }
                    }).done(function(data){
                        //get JSON
                        data = $.parseJSON(data);
                        //generate <options from JSON
                        var list_html = '';
                        list_html += '<option value=></option>';
                        $.each(data, function(i, item) {
                            list_html += '<option value='+data[i].code+'>'+data[i].name+'</option>';
                        });
                        $('#kodetransaksi').html(list_html);
                        $('#kodetransaksi').select2({placeholder: data.length +' results'});
                        document.getElementById("loading_proses4").style.display = "none";
                    })                  
                });
                $('#institusi').change(function() {
                    var selectedCategory = $('#institusi option:selected').val();
                    document.getElementById("loading_proses5").style.display = "block";
                    $.ajax({
                        type: 'POST',
                        url: <?php if(decrypt($_GET['menu'])=='entri') echo "'komoditasid.php'"; else echo "'komoditas.php'"; ?>,
                        dataType: 'html',
                        data: {
                            a: 'kodeinstitusi',
                            c: selectedCategory
                        },
                        success: function(txt){
                            //no action on success, its done in the next part
                        }
                    }).done(function(data){
                        //get JSON
                        data = $.parseJSON(data);
                        //generate <options from JSON
                        var list_html = '';
                        list_html += '<option value=></option>';
                        $.each(data, function(i, item) {
                            list_html += '<option value='+data[i].code+'>'+data[i].name+'</option>';
                        });
                        $('#kodeinstitusi').html(list_html);
                        $('#kodeinstitusi').select2({placeholder: data.length +' results'});
                        document.getElementById("loading_proses5").style.display = "none";
                    })                  
                });
                $('#series').change(function() {
                    var selectedCategory = $('#series option:selected').val();
                    if(selectedCategory=='A'){
                        $("#periodeHari").hide();
                        $("#periodeBulan").hide();
                        $("#periodeTahun").show();
                    }else if(selectedCategory=='D' || selectedCategory=='U' ){
                        $("#periodeHari").show();
                        $("#periodeBulan").hide();
                        $("#periodeTahun").hide();
                    }else{
                        $("#periodeHari").hide();
                        $("#periodeBulan").show();
                        $("#periodeTahun").show();
                    }
                    
                    document.getElementById("loading_proses6").style.display = "block";
                    $.ajax({
                        type: 'POST',
                        url: 'detailPeriode.php',
                        dataType: 'html',
                        data: {
                            a: 'series',
                            c: selectedCategory
                        },
                        success: function(txt){
                            //no action on success, its done in the next part
                        }
                    }).done(function(data){
                        //get JSON
                        data = $.parseJSON(data);
                        //generate <options from JSON
                        var list_html = '';
                        list_html += '<option value=></option>';
                        $.each(data, function(i, item) {
                            list_html += '<option value='+data[i].code+'>'+data[i].name+'</option>';
                        });
                        $('#detailseries').html(list_html);
                        $('#detailseries').select2({placeholder: data.length +' results'});
                        document.getElementById("loading_proses6").style.display = "none";
                    })                  
                });
                <?php } ?>
            });
</script>
<?php if(decrypt($_GET['menu'])=='daftar'){?>
        <script src="js/datagrid/datatables/jquery.dataTables.min.js"></script>
        <script src="js/datagrid/datatables/dataTables.bootstrap4.min.js"></script>
        <script src="js/datagrid/datatables/dataTables.buttons.min.js"></script>
        <script src="js/datagrid/datatables/buttons.flash.min.js"></script>
        <script src="js/datagrid/datatables/dataTables.rowReorder.min.js"></script>
        <script src="js/datagrid/datatables/dataTables.responsive.min.js"></script>
<script>
$(document).ready(function() {
    $('#dt-basic-example').DataTable({
        language: {
             emptyTable: "Anda belum memiliki daftar data"
        },
        responsive: true,
        order: [[ 0, "desc" ]],
        lengthChange: true,
        dom: "<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'lB>>" +
                        "<'row'<'col-sm-12'tr>>" +
                        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                        
        buttons: [
                   
        ]
    });
} );
</script>
<?php } ?>
</body>
</html>