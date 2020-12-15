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
	
	$sql_user=sqlsrv_query($conn,"SELECT * from c.Code where ClassificationID = '".$id."'");
	while($data_user = sqlsrv_fetch_array( $sql_user, SQLSRV_FETCH_ASSOC)){
		$respon = array("code"=>$data_user['CodeID'],
						"name"=>"[".$data_user['Code']."] ".mb_convert_encoding($data_user['CodeName'], 'UTF-8', 'UTF-8'),
						"full_name"=>$data_user['Description']);
		array_push($responses,$respon);
		//print_r($data_user);
	}
	$row_count = sqlsrv_num_rows($sql_user);	
	$hasil=array("total_count"=>$row_count,
			"status"=>1,
			"incomplete_results"=> false,
			"items"=>$responses);


}
header("Content-type: application/json"); 
// send response
echo json_encode($responses);
//print_r($responses);