<div class="page-wrapper">
<div class="page-inner">
<!-- BEGIN Left Aside -->
<?php include "sidebar.php" ?>

<!-- BEGIN Page Content -->
<!-- the #js-page-content id is needed for some plugins to initialize -->
<?php
if(!isset($_GET['menu']) || empty($_GET['menu']) ){
    include "daftar.php";
}elseif(decrypt($_GET['menu'])=='konkordansi'){
    include "konkordansi.php";
}elseif(decrypt($_GET['menu'])=='upload'){
    include "upload.php";
}elseif(decrypt($_GET['menu'])=='fenomena'){
    include "daftarfenomena.php";
}elseif(decrypt($_GET['menu'])=='entri'){
    include "fenomena.php";
}elseif(decrypt($_GET['menu'])=='master'){
    include "master.php";
}elseif($_GET['menu']=='list'){
    include "list.php";
}elseif($_GET['menu']=='update'){
    include "update.php";
}elseif(decrypt($_GET['menu'])=='generate'){
    include "generete_template.php";
}elseif(decrypt($_GET['menu'])=='daftar'){
    include "daftar.php";
}
else{
    include "upload.php";
}

?>
