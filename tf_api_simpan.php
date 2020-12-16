<?php
include "koneksi.php";
$today = date("Y-m-d"); 
$json_str = file_get_contents('php://input');
$json_obj = json_decode($json_str);
$array = json_decode($json_str, true);
$row=(count($array['tabel']))/8;
//echo $row;
$kolom=0;
$err=0;
//print_r($array);
$id=mysqli_fetch_array(mysqli_query($conn, "SELECT UUID() as id "));
$sql_insert="INSERT into data (id,prov,kab,nama,tanggal,jml,nip) values
                  ('".$id['id']."','".$array['provinsi']."','".$array['kabupaten']."',
                  '".$array['nama_data']."','".$today."',$row,'".$array['nip']."')";
$insert=mysqli_query($conn, $sql_insert);
for($i=1;$i<$row;$i++){  
    for($j=0;$j<=7;$j++){
        if($j==1){
            $nik= $array['tabel'][$i*8+$j]['tabel']['nilai'];
        }elseif($j==2){
            $kk= $array['tabel'][$i*8+$j]['tabel']['nilai'];
        }elseif($j==3){
            $nama= $array['tabel'][$i*8+$j]['tabel']['nilai'];
        }elseif($j==4){
            $jk= $array['tabel'][$i*8+$j]['tabel']['nilai'];
        }elseif($j==5){
            $alamat= $array['tabel'][$i*8+$j]['tabel']['nilai'];
        }elseif($j==6){
            if($array['tabel'][$i*8+$j]['tabel']['nilai']=='-'){
                $tanggal='1800-01-01';
            }else{
                //$tgl= $array['tabel'][$i*8+$j]['tabel']['nilai'];
                $tgl=explode("/",$array['tabel'][$i*8+$j]['tabel']['nilai']);
                $tanggal=$tgl[2]."-".$tgl[1]."-".$tgl[0];
            }
        }elseif($j==7){
            if($array['tabel'][$i*8+$j]['tabel']['nilai']=='-'){
                $umur='-1';
            }else{
                $umur= $array['tabel'][$i*8+$j]['tabel']['nilai'];
            }
        }
        //echo $array['tabel'][$i*8+$j]['tabel']['nilai'];
        
    }
    //echo $nik." ".$kk." ".$nama." ".$jk." ".$tgl;
    $sql=mysqli_query($conn, "INSERT into detail_data(nik,kk,nama,jenkel,alamat,tgl_lhr,umur,id_data)
                            values('$nik','$kk','".strtoupper($nama)."','".strtoupper($jk)."','$alamat','$tanggal','$umur','".$id['id']."')");
    $kolom++;
    if(!$sql){
        $err++;
    }
}
if(!$insert || ($err>0)){
    echo "Error input atau data sudah pernah diupload";
    mysqli_query($conn, "DELETE from data where id='".$id['id']."'");
    mysqli_query($conn, "DELETE from detail_data where id_data='".$id['id']."'");
}else{
    echo "ok";
}

?>