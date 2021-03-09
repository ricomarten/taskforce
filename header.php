<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
<?php
foreach($manus as $menu){
    $judul=explode('#',$menu);
    if(!isset($_GET['menu'])){
        echo "Rekap Data";
    }
    elseif(decrypt($_GET['menu'])==$judul[0]){
        echo $judul[1];
    }
}
?>
        </title>
        <script>
            document.addEventListener("contextmenu", function(e){
                e.preventDefault();
            }, false);
            document.addEventListener("keydown", function(e){
            if (e.ctrlKey || (e.keyCode>=112 && e.keyCode<=123)) {
                e.stopPropagation();
                e.preventDefault();
            }
            });
        </script>
        <meta name="description" content="Export">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
        <!-- Call App Mode on ios devices -->
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <!-- Remove Tap Highlight on Windows Phone IE -->
        <meta name="msapplication-tap-highlight" content="no">
        <!-- base css -->
        <link rel="stylesheet" media="screen, print" href="css/vendors.bundle.css">
        <link rel="stylesheet" media="screen, print" href="css/app.bundle.css">
        <!-- Place favicon.ico in the root directory -->
        <link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="img/favicon/favicon-32x32.png">
        <link rel="mask-icon" href="img/favicon/safari-pinned-tab.svg" color="#5bbad5">
        <link rel="stylesheet" media="screen, print" href="css/datagrid/datatables/datatables.bundle.css">
        <link rel="stylesheet" media="screen, print" href="css/fa-solid.css">
        <!-- page related CSS below -->
        <link rel="stylesheet" media="screen, print" href="css/formplugins/select2/select2.bundle.css">
        <link rel="stylesheet" media="screen, print" href="css/notifications/sweetalert2/sweetalert2.bundle.css">
        <link rel="stylesheet" media="screen, print" href="css/formplugins/bootstrap-datepicker/bootstrap-datepicker.css">
        <link rel="stylesheet" media="screen, print" href="css/datagrid/datatables/datatables.bundle.css">
        <link rel="stylesheet" media="screen, print" href="css/formplugins/bootstrap-daterangepicker/bootstrap-daterangepicker.css">
        
    </head>
    <body class="mod-bg-1 ">
        <!-- DOC: script to save and load page settings -->
        <script>
            /**
             *	This script should be placed right after the body tag for fast execution 
             *	Note: the script is written in pure javascript and does not depend on thirdparty library
             **/
            'use strict';
            localStorage.setItem('themeSettings', '{"themeOptions":"mod-bg-1 header-function-fixed header-function-fixed nav-function-fixed ","themeURL":"css/themes/cust-theme-3.css"}');
           
            var classHolder = document.getElementsByTagName("BODY")[0],
                /** 
                 * Load from localstorage
                 **/
                themeSettings = (localStorage.getItem('themeSettings')) ? JSON.parse(localStorage.getItem('themeSettings')) :
                {},
                themeURL="css/themes/cust-theme-3.css",
                //themeURL = themeSettings.themeURL || '',
                themeOptions = "mod-bg-1 header-function-fixed header-function-fixed nav-function-fixed ";
            /** 
             * Load theme options
             **/
            if (themeSettings.themeOptions)
            {
                classHolder.className = themeSettings.themeOptions;
                console.log("%c✔ Theme settings loaded", "color: #148f32");
            }
            else
            {
                console.log("Heads up! Theme settings is empty or does not exist, loading default settings...");
            }
            if (themeSettings.themeURL && !document.getElementById('mytheme'))
            {
                var cssfile = document.createElement('link');
                cssfile.id = 'mytheme';
                cssfile.rel = 'stylesheet';
                cssfile.href = themeURL;
                document.getElementsByTagName('head')[0].appendChild(cssfile);
            }
              /** 
             * Save to localstorage 
             **/
            var saveSettings = function()
            {
                themeSettings.themeOptions = String(classHolder.className).split(/[^\w-]+/).filter(function(item)
                {
                    return /^(nav|header|mod|display)-/i.test(item);
                }).join(' ');
                if (document.getElementById('mytheme'))
                {
                    themeSettings.themeURL = document.getElementById('mytheme').getAttribute("href");
                };
                localStorage.setItem('themeSettings', JSON.stringify(themeSettings));
                //localStorage.setItem('themeSettings', '{"themeOptions":"mod-bg-1 header-function-fixed header-function-fixed nav-function-fixed nav-function-minified nav-function-minify","themeURL":"css/themes/cust-theme-3.css"}');
            }
            /** 
             * Reset settings
             **/
            var resetSettings = function()
            {
                localStorage.setItem("themeSettings", '{"themeOptions":"mod-bg-1 header-function-fixed header-function-fixed nav-function-fixed nav-function-minified nav-function-minify","themeURL":"css/themes/cust-theme-3.css"}');
            }

        </script>
        <!-- BEGIN Page Wrapper -->