<aside class="page-sidebar">
    <div class="page-logo">
        
            <img src="img/Sensus Penduduk 2020_2.png" alt="SP 2020 -Task Force" aria-roledescription="logo">
            <span class="page-logo-text mr-1">Task Force</span>
            <span class="position-absolute text-white opacity-50 small pos-top pos-right mr-2 mt-n2"></span>
            
    </div>
    <!-- BEGIN PRIMARY NAVIGATION -->
    <nav id="js-primary-nav" class="primary-nav" role="navigation">
        <div class="nav-filter">
            <div class="position-relative">
                <input type="text" id="nav_filter_input" placeholder="Filter menu" class="form-control" tabindex="0">
                <a href="#" onclick="return false;" class="btn-primary btn-search-close js-waves-off" data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar">
                    <i class="fal fa-chevron-up"></i>
                </a>
            </div>
        </div>
        <div class="info-card">
            <img src="<?php echo $_SESSION['url_foto']; ?>" onerror="this.onerror=null;this.src='img/demo/avatars/avatar-m.png'" class="profile-image rounded-circle" alt="<?php echo $_SESSION['nama'];  ?>">
            <div class="info-card-text">
                <a href="#" class="d-flex align-items-center text-white">
                    <span class="text-truncate text-truncate-sm d-inline-block">
                        <?php echo $_SESSION['nama'];  ?>
                    </span>
                </a>
                <span class="d-inline-block text-truncate text-truncate-sm"><?php echo $_SESSION['unitkerja'];  ?></span>
            </div>
            <img src="img/card-backgrounds/cover-2-lg.png" class="cover" alt="cover">
            <a href="#" onclick="return false;" class="pull-trigger-btn" data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar" data-focus="nav_filter_input">
                <i class="fal fa-angle-down"></i>
            </a>
        </div>        
        <ul id="js-nav-menu" class="nav-menu">
            <li class="nav-title">Daftar Menu</li>    
<?php
foreach($manus as $menu){
    $pisah=explode('#',$menu);
    if(!isset($_GET['menu'])){
        $_GET['menu']='daftar';
    }
    if($pisah[3]=='1'){
        if(decrypt($_GET['menu'])==$pisah[0]){
            echo "<li class='active open'>";
        }else{
            echo "<li>";
        }
        
        echo "<a href='index.php?menu=".encrypt($pisah[0])."' title='".$pisah[1]."' data-filter-tags='".strtolower($pisah[1])."'>";
        echo "<i class='fal fa-".$pisah[2]."'></i>";
        echo "<span class='nav-link-text' data-i18n='nav.".str_replace(' ','_',strtolower($pisah[1]))."'>".$pisah[1]."</span>";
        echo "</a>";
        echo "</li>";
    }
}
?>   
        </ul>
        
        <div class="filter-message js-filter-message bg-success-600"></div>
    </nav>
    <!-- END PRIMARY NAVIGATION -->
    <!-- NAV FOOTER -->
    <div class="nav-footer shadow-top">
        <a href="#" onclick="return false;" data-action="toggle" data-class="nav-function-minify" class="hidden-md-down">
            <i class="ni ni-chevron-right"></i>
            <i class="ni ni-chevron-right"></i>
        </a>
        <ul class="list-table m-auto nav-footer-buttons">
            <!--
            <li>
                <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Chat logs">
                    <i class="fal fa-comments"></i>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Support Chat">
                    <i class="fal fa-life-ring"></i>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Make a call">
                    <i class="fal fa-phone"></i>
                </a>
            </li>
            -->
        </ul>
    </div> <!-- END NAV FOOTER -->
</aside>
<!-- END Left Aside -->
<div class="page-content-wrapper">
    <!-- BEGIN Page Header -->
    <header class="page-header" role="banner">
        <!-- we need this logo when user switches to nav-function-top -->
        <div class="page-logo">
            <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative" data-toggle="modal" data-target="#modal-shortcut">
                <img src="img/Sensus Penduduk 2020_2.png" alt="SP 2020 -Task Force" aria-roledescription="logo">
                <span class="page-logo-text mr-1">Task Force</span>
                <span class="position-absolute text-white opacity-50 small pos-top pos-right mr-2 mt-n2"></span>
                <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
            </a>
        </div>
        <!-- DOC: nav menu layout change shortcut -->
        <div class="hidden-md-down dropdown-icon-menu position-relative">
            <a href="#" class="header-btn btn js-waves-off" data-action="toggle" data-class="nav-function-hidden" title="Hide Navigation">
                <i class="ni ni-menu"></i>
            </a>
            <ul>
                <li>
                    <a href="#" class="btn js-waves-off" data-action="toggle" data-class="nav-function-minify" title="Minify Navigation">
                        <i class="ni ni-minify-nav"></i>
                    </a>
                </li>
                <li>
                    <a href="#" class="btn js-waves-off" data-action="toggle" data-class="nav-function-fixed" title="Lock Navigation">
                        <i class="ni ni-lock-nav"></i>
                    </a>
                </li>
            </ul>
        </div>
        <!-- DOC: mobile button appears during mobile width -->
        <div class="hidden-lg-up">
            <a href="#" class="header-btn btn press-scale-down" data-action="toggle" data-class="mobile-nav-on">
                <i class="ni ni-menu"></i>
            </a>
        </div>
        
        <div class="ml-auto d-flex">
            <!-- app settings -->
            <div class="hidden-md-down">
                <a href="#" class="header-icon" data-toggle="modal" data-target=".js-modal-settings">
                    <i class="fal fa-cog"></i>
                </a>
            </div>
            <!-- app message 
            <a href="#" class="header-icon" data-toggle="modal" data-target=".js-modal-messenger">
                <i class="fal fa-globe"></i>
                <span class="badge badge-icon">!</span>
            </a> -->
            <!-- app notification -->
            <!-- app user menu -->
            <div>
                <a href="#" data-toggle="dropdown" title="<?php echo $_SESSION['email']; ?>" class="header-icon d-flex align-items-center justify-content-center ml-2">
                    <img src="<?php echo $_SESSION['url_foto']; ?>" onerror="this.onerror=null;this.src='img/demo/avatars/avatar-m.png'" class="profile-image rounded-circle" >
                    <span class="ml-1 mr-1 text-truncate text-truncate-header hidden-xs-down"><?php echo $_SESSION['nama']; ?></span>
                    <i class="ni ni-chevron-down hidden-xs-down"></i> 
                </a>
                <div class="dropdown-menu dropdown-menu-animated dropdown-lg">
                    <div class="dropdown-header bg-trans-gradient d-flex flex-row py-4 rounded-top">
                        <div class="d-flex flex-row align-items-center mt-1 mb-1 color-white">
                            <span class="mr-2">
                                <img src="<?php echo $_SESSION['url_foto']; ?>" onerror="this.onerror=null;this.src='img/demo/avatars/avatar-m.png'" class="rounded-circle profile-image">
                            </span>
                            <div class="info-card-text">
                                <div class="fs-lg text-truncate text-truncate-lg"><?php echo $_SESSION['nama']; ?></div>
                                <span class="text-truncate text-truncate-md opacity-80"><?php echo $_SESSION['email']; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown-divider m-0"></div>
                    <a href="#" class="dropdown-item" data-action="app-reset">
                        <span data-i18n="drpdwn.reset_layout">Reset Layout</span>
                    </a>
                    <a href="#" class="dropdown-item" data-toggle="modal" data-target=".js-modal-settings">
                        <span data-i18n="drpdwn.settings">Settings</span>
                    </a>
                    <div class="dropdown-divider m-0"></div>
                    <a href="#" class="dropdown-item" data-action="app-fullscreen">
                        <span data-i18n="drpdwn.fullscreen">Fullscreen</span>
                        <i class="float-right text-muted fw-n">F11</i>
                    </a>
                    <a href="#" class="dropdown-item" data-action="app-print">
                        <span data-i18n="drpdwn.print">Print</span>
                        <i class="float-right text-muted fw-n">Ctrl + P</i>
                    </a>
            
                    <div class="dropdown-divider m-0"></div>
                    <a class="dropdown-item fw-500 pt-3 pb-3" href="logout.php">
                        <span data-i18n="drpdwn.page-logout">Logout</span>
                        <i class="float-right text-muted fw-n fal fa-sign-out"></i>
                        
                    </a>
                </div>
            </div>
        </div>
    </header>
    <!-- END Page Header -->
                