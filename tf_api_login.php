<?php
session_start();
error_reporting(0);
date_default_timezone_set('Asia/Jakarta');
$tanggal=date("Y-m-d H:i:s");
include "koneksi.php";
include "enkripsi.php";
$json_str = file_get_contents('php://input');
$json_obj = json_decode($json_str);

if($json_obj->username=='' || $json_obj->password==''){
    echo "Username dan password harus terisi";
}else{
    $sql=mysqli_query($conn,"SELECT * from user where username='".$json_obj->username."'");
    $data=mysqli_fetch_array($sql);
    if(mysqli_num_rows($sql)>0){
        $_SESSION['niplama']='334053331';
        $_SESSION['nama']='admin';
        $_SESSION['unitkerja']='33300';
        $_SESSION['email']='';
        $_SESSION['unitkerja_id']='71300';
        $_SESSION['wilayah_id']='0000';
        $_SESSION['url_foto']='';
        $_SESSION['jabatan']=$data['jabatan'];
        echo "ok";
    }else{
        echo "User tidak ditemukan";
    }
    
}
?>