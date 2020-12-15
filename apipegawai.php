<?php
$hasil = array();	

if(empty($_GET['nip'])){
	$hasil=array("output"=>"data tidak ditemukan");
}
/*
------------------------------------------------------------------------------------------------
Parameter yang digunakan, khusus untuk $client_id & $client_secret 
di ganti sesuai dengan yang didapatkan dari subdit JKD
------------------------------------------------------------------------------------------------
*/
$url_base       = 'https://sso.bps.go.id/auth/';
$url_token      = $url_base.'realms/pegawai-bps/protocol/openid-connect/token';
$url_api        = $url_base.'realms/pegawai-bps/api-pegawai/nip/'.$_GET['nip'];
$client_id      = '03330-mdm-r1m'; 
$client_secret  = '3dd61dcf-24c7-41e9-a907-397c0aaeb41a'; 
$query_search ='';
//$query_search   = '?username='.$_GET['username'].''; //'?username={username}' atau '?email={email pegawai}'


/*
------------------------------------------------------------------------------------------------
Tahap 1 :
Mendapatkan akses token
------------------------------------------------------------------------------------------------
*/
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

//print_r($json_token);
/*
------------------------------------------------------------------------------------------------
Tahap 2 :
Mendapatkan data pegawai dengan username tertentu
------------------------------------------------------------------------------------------------
*/
$ch = curl_init($url_api.$query_search);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , 'Authorization: Bearer '.$access_token ));  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
if(curl_errno($ch)){
    throw new Exception(curl_error($ch));
}
curl_close ($ch);
$json = json_decode($response, true);

foreach ($json as $result){
$hasil = array("username"=>$result['username'],
                "golongan"=>$result['attributes']['attribute-golongan'][0],
                "jabatan"=>$result['attributes']['attribute-jabatan'][0],
                "nip-lama"=>$result['attributes']['attribute-nip-lama'][0],
                "nip"=>$result['attributes']['attribute-nip'][0],
                "nama"=>$result['attributes']['attribute-nama'][0],
                "provinsi"=>$result['attributes']['attribute-provinsi'][0],
                "kabupaten"=>$result['attributes']['attribute-kabupaten'][0],
                "email"=>$result['attributes']['attribute-email'][0],
                "eselon"=>$result['attributes']['attribute-eselon'][0],
                "organisasi"=>$result['attributes']['attribute-organisasi'][0]);
		//array_push($responses,$respon);
}
header("Content-type: application/json"); 
// send response
echo json_encode($hasil);

?>
