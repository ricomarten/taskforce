 <?php
    include "koneksi.php";
    error_reporting(0);
    $sql=mysqli_query($conn,"SELECT * from file where status='0' order by nama_file,tgl_upload asc");
    $responses = array();	
    while($data=mysqli_fetch_array($sql)){
        $respon=array("nip"=>$data['nip'],
                "nama_file"=>$data['nama_file'], 
                "lokasi_file"=>"https://laporanwfh.bps.go.id/".$data['lokasi_file'],
                "wilayah"=>$data['wilayah'],
                "unitkerja"=>$data['unitkerja'],
                "is_bulan"=>$data['is_bulan'],
                "tgl_upload"=>$data['tgl_upload'],
                "status"=>$data['status'],
                "approve"=>$data['approve']);
        array_push($responses,$respon);
    }
    
    //print_r($files_hari);
    header("Content-type: application/json"); 
    // send response
    echo json_encode($responses);
?>
             
                    