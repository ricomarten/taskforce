<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
$tanggal=date("Y-m-d H:i:s");
include ("koneksi.php");
mysqli_query($conn,"update user set logout='".$tanggal."' where niplama='".$_SESSION['niplama']."'");
//echo "update pegawai_selindo set loguot='".$tanggal."' where niplama='".$_SESSION['niplama']."'";
mysqli_close($conn);
session_destroy();
//$url=$_SESSION['url_logout'];
header("Location:index.php");
?>

