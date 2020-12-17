<?php
include "koneksi.php";
$today = date("Y-m-d"); 
$json_str = file_get_contents('php://input');
$json_obj = json_decode($json_str);
$array = json_decode($json_str, true);

$kolom=8;
$row=$array['jml_baris'];
$kolom=$kolom+1;
$err=0;
//print_r($array);
$id=mysqli_fetch_array(mysqli_query($conn, "SELECT UUID() as id "));
$sql_insert="INSERT into data (id,prov,kab,kec,desa,nama,tanggal,jml,nip) values
                  ('".$id['id']."','".$array['provinsi']."','".$array['kabupaten']."','".$array['kecamatan']."','".$array['desa']."',
                  '".$array['nama_data']."','".$today."',".($row-1).",'".$array['nip']."')";
$insert=mysqli_query($conn, $sql_insert);
if($insert)$error_insert_data="Error data: " . mysqli_error($conn);
$error_insert_detail='';
for($i=1;$i<$row;$i++){  
    for($j=0;$j<=$kolom;$j++){
        if($j==1){
            $adanik= $array['tabel'][$i*$kolom+$j]['tabel']['nilai'];
        }elseif($j==2){
            $nik= $array['tabel'][$i*$kolom+$j]['tabel']['nilai'];
        }elseif($j==3){
            $kk= $array['tabel'][$i*$kolom+$j]['tabel']['nilai'];
        }elseif($j==4){
            $nama= $array['tabel'][$i*$kolom+$j]['tabel']['nilai'];
        }elseif($j==5){
            $jk= $array['tabel'][$i*$kolom+$j]['tabel']['nilai'];
        }elseif($j==6){
            $alamat= $array['tabel'][$i*$kolom+$j]['tabel']['nilai'];
        }elseif($j==7){
            if($array['tabel'][$i*$kolom+$j]['tabel']['nilai']=='-'){
                $tanggal='0000-00-00';
            }else{
                //$tgl= $array['tabel'][$i*8+$j]['tabel']['nilai'];
                $tgl=explode("/",$array['tabel'][$i*$kolom+$j]['tabel']['nilai']);
                $tanggal=$tgl[2]."-".$tgl[1]."-".$tgl[0];
            }
        }elseif($j==8){
            if($array['tabel'][$i*$kolom+$j]['tabel']['nilai']=='-'){
                $umur='-1';
            }else{
                $umur= $array['tabel'][$i*$kolom+$j]['tabel']['nilai'];
            }
        }
        //echo $array['tabel'][$i*$kolom+$j]['tabel']['nilai']."##";
        
    }
    //echo $adanik." ".$nik." ".$kk." ".$nama." ".$jk." ".$tanggal." ". $umur ;
    //echo "<hr>";
    $sqldata="INSERT into detail_data(ada_nik,nik,kk,nama,jenkel,alamat,tgl_lhr,umur,id_data)
    values('$adanik','$nik','$kk','".strtoupper($nama)."','".strtoupper($jk)."','$alamat','$tanggal','$umur','".$id['id']."')";
    $sql=mysqli_query($conn, $sqldata);   
    if(!$sql){
        $err++;
        $error_insert_detail="Error detail ".$i." : " . mysqli_error($conn);
    }
   // echo $sqldata;
}
if(!$insert || ($err>0)){
    if($insert){
        echo $error_insert_data;
    }else{
        //echo $error_insert_detail;
        echo "Ada data yang double";
    }
    //echo "Error input atau data sudah pernah diupload";
    mysqli_query($conn, "DELETE from data where id='".$id['id']."'");
    mysqli_query($conn, "DELETE from detail_data where id_data='".$id['id']."'");
}else{
    echo "ok";
}

?>