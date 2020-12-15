<?php
$page = $_SERVER['PHP_SELF'];
$sec = "5";
header("Refresh: $sec; url=$page");
include "koneksi.php";
error_reporting(0);
date_default_timezone_set("Asia/Jakarta");
$table='pegawai_selindo';

$time_start = microtime(true); 

echo "<table border='1'><tr>";
echo "<td>No</td>";
echo "<td>NIP lama</td>";
echo "<td>NIP</td>";
echo "<td>Organisasi</td>";
echo "<td>Nama Lengkap</td>";
echo "<td>email</td>";
echo "<td>eselon</td>";
echo  "</tr>";

//do{
	$sql = "SELECT * FROM ".$table." where cek ='0' ORDER BY niplama  OFFSET 0 ROWS FETCH NEXT 50 ROWS ONLY;";
	$stmt = sqlsrv_query( $conn, $sql );
	if( $stmt === false) {
		die( print_r( sqlsrv_errors(), true) );
	}
	
	$i=1;
	while( $data = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
        //echo $data[0]."<br>";

$url_base       = 'https://sso.bps.go.id/auth/';
$url_token      = $url_base.'realms/pegawai-bps/protocol/openid-connect/token';
$url_api        = $url_base.'realms/pegawai-bps/api-pegawai/nip/'.$data['niplama'];
$client_id      = '03330-mdm-r1m'; 
$client_secret  = '3dd61dcf-24c7-41e9-a907-397c0aaeb41a'; 
$query_search ='';
//$query_search   = '?username='.$_GET['username'].''; //'?username={username}' atau '?email={email pegawai}'

$ch = curl_init($url_token);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
curl_setopt($ch, CURLOPT_POSTFIELDS,"grant_type=client_credentials");
curl_setopt($ch, CURLOPT_USERPWD, $client_id . ":" . $client_secret);  
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response_token = curl_exec($ch);
if(curl_errno($ch)){
    throw new Exception(curl_error($ch));
}
curl_close ($ch);
$json_token = json_decode($response_token, true);
$access_token = $json_token['access_token'];


$ch = curl_init($url_api.$query_search);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , 'Authorization: Bearer '.$access_token ));  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
if(curl_errno($ch)){
    throw new Exception(curl_error($ch));
    echo curl_error($ch);
}
curl_close ($ch);
$json = json_decode($response, true);
//print_r($json);
        foreach ($json as $result){
                //$get_data = callAPI('GET',$link , false);
                //$response = json_decode($get_data, true);
                echo "<tr>";
                echo "<td>".$i++."</td>";
                echo "<td>".$result['attributes']['attribute-nip-lama'][0]."</td>";
                echo "<td>".$result['attributes']['attribute-nip'][0]."</td>";
                echo "<td>".$result['attributes']['attribute-organisasi'][0]."</td>";
                echo "<td>".$result['attributes']['attribute-nama'][0]."</td>";
                echo "<td>".$result['attributes']['attribute-email'][0]."</td>";
                echo "<td>".$result['attributes']['attribute-eselon'][0]."</td>";
                echo"</tr>";
                
                //if($datta['RESPON']<>'Kuota Akses Hari ini telah Habis')
                sqlsrv_query($conn,"UPDATE ".$table." SET 
                email='".str_replace("'","''",$result['attributes']['attribute-email'][0])."',
                organisasi='".$result['attributes']['attribute-organisasi'][0]."',
                eselon='".$result['attributes']['attribute-eselon'][0]."',
                nama_community='".str_replace("'","''",$result['attributes']['attribute-nama'][0])."',
                nip='".$result['attributes']['attribute-nip'][0]."',
                cek='1' WHERE niplama='".$data['niplama']."'");
                echo  "</tr>";
        }
        sqlsrv_query($conn,"UPDATE ".$table." SET 
                cek='1' WHERE niplama='".$data['niplama']."'");
		//$i++;
	}
//}while($datta['RESPON']<>'Kuota Akses Hari ini telah Habis');
echo "</table>";

$time_end = microtime(true);
//dividing with 60 will give the execution time in minutes otherwise seconds
$execution_time = ($time_end - $time_start);
//execution time of the script
echo '<b>Total Execution Time:</b> '.$execution_time.' Mins';
sqlsrv_free_stmt( $stmt);

?>