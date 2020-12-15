<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
$tanggal=date("Y-m-d H:i:s");
foreach ($_COOKIE as $key=>$val){
    //echo $key.' is '.$val."<br>\n";
    unset($_COOKIE[$key]);
} 
clearstatcache();
include ("koneksi.php");
mysqli_query($conn,"update pegawai_selindo set logout='".$tanggal."' where niplama='".$_SESSION['niplama']."'");
//echo "update pegawai_selindo set loguot='".$tanggal."' where niplama='".$_SESSION['niplama']."'";
mysqli_close($conn);
session_destroy();
//$url=$_SESSION['url_logout'];
header("Location:index.php");
?>

