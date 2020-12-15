<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
$tanggal=date("Y-m-d H:i:s");
include "koneksi.php";
include "enkripsi.php";

if (!isset($_SESSION['niplama'])){ 
   header('Location: login.php');
}else{
   $manus = array( 
                "daftar#Dashboard#home#1",
                "upload#Upload Data#cloud-upload#0",
                "fenomena#Entri Fenomena#eye#0",
                "entri#Entri Fenomena#eye#0",
                "daftar#Daftar Upload Data#database#1",
                "konkordansi#Konkordansi Klasifikasi#link#0",
            );
   include ("header.php");
   include ("main.php");
   include ("footer.php");
}

?>
