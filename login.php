<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
            Login
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
        <meta name="description" content="Login">
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
        <!-- Optional: page related CSS-->
        <link rel="stylesheet" media="screen, print" href="css/fa-brands.css">
        <link rel="stylesheet" media="screen, print" href="css/notifications/sweetalert2/sweetalert2.bundle.css">
    </head>
    <body>
        <div class="page-wrapper">
            <div class="page-inner bg-brand-gradient">
                <div class="page-content-wrapper bg-transparent m-0">
                    <div class="height-10 w-100 shadow-lg px-4 bg-brand-gradient">
                        <div class="d-flex align-items-center container p-0">
                            <div class="page-logo width-mobile-auto m-0 align-items-center justify-content-center p-0 bg-transparent bg-img-none shadow-0 height-9">
                                <a href="javascript:void(0)" class="page-logo-link press-scale-down d-flex align-items-center">
                                    <img src="img/Sensus Penduduk 2020_2.png" alt="SP 2020 -Task Force" aria-roledescription="logo">
                                    <span class="page-logo-text mr-1">SP 2020 -Task Force</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-1" style="background: url(img/svg/pattern-2.svg) no-repeat center bottom fixed; background-size: cover;">
                        <div class="container py-4 py-lg-5 my-lg-5 px-4 px-sm-0 text-white d-flex align-items-center justify-content-center">
                            <form id="js-login" action="intel_analytics_dashboard.html" role="form" class="text-center text-white mb-5 pb-5">
                                <div class="py-5">
                                    <img src="img/demo/avatars/avatar-m.png" class="img-responsive rounded-circle img-thumbnail" alt="thumbnail">
                                </div>
                                <div class="form-group">          
                                    <p class="text-white">Masukkan Username dan Password Community</p>
                                    <div class="input-group input-group-lg">
                                        <input type="text" class="form-control" id="username" placeholder="username@bps.go.id">
                                    </div>    
                                    <br>                
                                    <div class="input-group input-group-lg">
                                        <input type="password" class="form-control" id="password" placeholder="password">
                                        <div class="input-group-append">
                                            <button class="btn btn-success shadow-0" onclick() type="button" id="button-addon5"><i class="fal fa-key"></i></button>
                                        </div>
                                    </div>
                                    <div id="loading_proses">
                                        <strong>Loading...</strong> <img src="img/loading.gif"/>
                                    </div>
                                </div>
                            </form>
                            <div class="position-absolute pos-bottom pos-left pos-right p-3 text-center text-white">
                            <span class="hidden-md-down fw-700">Badan Pusat Statistik - Subdit Pengembangan Basis Data</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        function encrypt($str) {
            $kunci = '979a218e0632df2935317f98d47956c7';
            $hasil="";
            for ($i = 0; $i < strlen($str); $i++) {
                $karakter = substr($str, $i, 1);
                $kuncikarakter = substr($kunci, ($i % strlen($kunci))-1, 1);
                $karakter = chr(ord($karakter)+ord($kuncikarakter));
                $hasil .= $karakter;
            }
            return urlencode(base64_encode($hasil));
         }
        ?>
        <script src="js/vendors.bundle.js"></script>
        <script src="js/app.bundle.js"></script>
        <script src="js/notifications/sweetalert2/sweetalert2.js"></script>
        <script>
            document.getElementById("loading_proses").style.display = "none";
            $("#button-addon5").click(function(event)
            {
                var xhr = new XMLHttpRequest();
                var url = "tf_api_login.php";
                document.getElementById("loading_proses").style.display = "block";

                var data = JSON.stringify({
                    username: document.getElementById("username").value.replace("@bps.go.id",""),
                    password: document.getElementById("password").value,
                    menuId: 1
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
                            title: "Oops...",
                            text: this.responseText,
                        });
                        document.getElementById("loading_proses").style.display = "none";
                    }
                };

                xhr.send(data);
                return false;
                
            });

        </script>
    </body>
</html>
