<?php
include "koneksi.php";
$today = date("Y-m-d"); 
$json_str = file_get_contents('php://input');
$json_obj = json_decode($json_str);

$deleteinput=mysqli_query($conn,"DELETE from data where id='$json_obj->id'");
$deletetabel=mysqli_query($conn,"DELETE from detail_data where id_data='$json_obj->id'");

if($deleteinput && $deletetabel) {
    echo "ok";
    
}else{
    echo "Terjadi kesalahan";
}
?>
 