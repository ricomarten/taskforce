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
	
	$sql_user=sqlsrv_query($conn,"SELECT
    c.DataSeries.DataSeriesID,
    c.DataSeries.DataSeriesCode,
    c.DataSeries.DataSeriesName,
    c.DataSeries.Description,
    c.DetailDataSeries.DetailDataSeriesID,
    c.DetailDataSeries.DetailDataSeriesCode,
    c.DetailDataSeries.DetailDataSeriesName,
    c.DetailDataSeries.Description
    
    FROM
    c.DataSeries
    INNER JOIN c.DetailDataSeries ON c.DataSeries.DataSeriesID = c.DetailDataSeries.DataSeriesID
    where  c.DataSeries.DataSeriesCode = '".$id."'");
	while($data_user = sqlsrv_fetch_array( $sql_user, SQLSRV_FETCH_ASSOC)){
		if($data_user['DetailDataSeriesCode']=='6'){
			$tahun=date("Y");
			$date1 = date("l, M jS, Y", strtotime($tahun."W".$week[1]."1") ); // First day of week
            $date2 = date("l, M jS, Y", strtotime($year."W".$week."7") ); // Last day of week
		}else{
			$respon = array("code"=>$data_user['DetailDataSeriesCode'],
			"name"=>"[".$data_user['DetailDataSeriesCode']."] ".mb_convert_encoding($data_user['DetailDataSeriesName'], 'UTF-8', 'UTF-8'),
			"full_name"=>$data_user['Description']);	
		}
		$respon = array("code"=>$data_user['DetailDataSeriesCode'],
						"name"=>"[".$data_user['DetailDataSeriesCode']."] ".mb_convert_encoding($data_user['DetailDataSeriesName'], 'UTF-8', 'UTF-8'),
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
?>