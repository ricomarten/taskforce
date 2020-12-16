<?php
$responses = array();	

if(empty($_POST['a'])){
	$responses=array("output"=>"data tidak ditemukan");
}
else{
	include 'koneksi.php';
    $prov = preg_replace("/[^a-zA-Z0-9\s]/", "", $_POST['a']);
    $kab = preg_replace("/[^a-zA-Z0-9\s]/", "", $_POST['b']);
    $kec = preg_replace("/[^a-zA-Z0-9\s]/", "", $_POST['c']);
		
	$sql_kab=mysqli_query($conn,"SELECT * from master_desa where KDPROV = '".$prov."' and KDKAB = '".$kab."'  and KDKEC = '".$kec."'");
	while($data_kab = mysqli_fetch_array( $sql_kab)){
		$respon = array("code"=>$data_kab['KDDESA'],
						"name"=>"[".$data_kab['KDDESA']."] ".mb_convert_encoding($data_kab['NMDESA'], 'UTF-8', 'UTF-8'),
						"full_name"=>$data_kab['NMDESA']);
		array_push($responses,$respon);
		//print_r($data_user);
	}
	$row_count = mysqli_num_rows($sql_kab);	
	$hasil=array("total_count"=>$row_count,
			"status"=>1,
			"incomplete_results"=> false,
			"items"=>$responses);


}
header("Content-type: application/json"); 
// send response
echo json_encode($responses);
//print_r($responses);
?>