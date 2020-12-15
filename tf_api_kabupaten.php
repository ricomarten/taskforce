<?php
$responses = array();	

if(empty($_POST['c'])){
	$responses=array("output"=>"data tidak ditemukan");
}
else{
	include 'koneksi.php';
	$id = preg_replace("/[^a-zA-Z0-9\s]/", "", $_POST['c']);
	//echo $id;
    //$new_string = preg_replace('/\s/', '-', $new_string);
	//$id = urlencode($new_string);
	
	$sql_kab=mysqli_query($conn,"SELECT * from master_kab where KDPROV = '".$id."'");
	while($data_kab = mysqli_fetch_array( $sql_kab)){
		$respon = array("code"=>$data_kab['KDKAB'],
						"name"=>"[".$data_kab['KDKAB']."] ".mb_convert_encoding($data_kab['NMKAB'], 'UTF-8', 'UTF-8'),
						"full_name"=>$data_kab['NMKAB']);
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