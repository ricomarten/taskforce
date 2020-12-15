<?php
session_start();
require 'sso/vendor/autoload.php';
include "../koneksi.php";
date_default_timezone_set('Asia/Jakarta');
$tanggal=date("Y-m-d H:i:s");

$provider = new JKD\SSO\Client\Provider\Keycloak([
    'authServerUrl'         => 'https://sso.bps.go.id',
    'realm'                 => 'pegawai-bps',
    'clientId'              => 'laporan-wfh',
    'clientSecret'          => '550f9cfd-1f52-43a0-bfc5-df340de6bfa7',
    'redirectUri'           => 'https://laporanwfh.bps.go.id/login/index.php'
]);

if (!isset($_GET['code'])) {

    // Untuk mendapatkan authorization code
    $authUrl = $provider->getAuthorizationUrl();
    $_SESSION['oauth2state'] = $provider->getState();
    header('Location: '.$authUrl);
    exit;

// Mengecek state yang disimpan saat ini untuk memitigasi serangan CSRF
//} elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {

//    unset($_SESSION['oauth2state']);
//    exit('Invalid state');

} else {

    try {
        $token = $provider->getAccessToken('authorization_code', [
            'code' => $_GET['code']
        ]);
        try {

            $user = $provider->getResourceOwner($token);
            $pengguna = $user->toArray();
            $_SESSION['url_logout'] =  $provider->getLogoutUrl();
            $_SESSION['niplama'] = $pengguna['nip-lama'];
                $_SESSION['nama']=$pengguna['name'];
                $_SESSION['unitkerja']=$pengguna['jabatan'];
                $_SESSION['email']=$pengguna['email'];
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_URL, 'https://halosis.bps.go.id/formsjs/data.pegawai.php?id='.$pengguna['username']);
                $result = curl_exec($ch);
                curl_close($ch);
                    $community = json_decode($result);
                    $_SESSION['unitkerja_id']=$community->unitkerja_id;
                    $_SESSION['wilayah_id']=$community->wilayah_id;
                    $_SESSION['url_foto']=$community->url_foto;
                    $_SESSION['jabatan']=$community->jabatan;
                    $_SESSION['username']=($pengguna['username']) ;
    

            
                    $sql_user=mysqli_query($conn,"SELECT niplama,zoom_admin from pegawai_selindo where niplama='".$pengguna['nip-lama']."'");
                    $data=mysqli_fetch_array($sql_user);
                    $row_count = mysqli_num_rows($sql_user);
                    if($row_count>0){
                        $_SESSION['zoom_admin']=$data['zoom_admin'];
                        mysqli_query($conn,"update pegawai_selindo set login='".$tanggal."', nlogin=nlogin+1 where niplama='".$pengguna['nip-lama']."'");
                    }
                    header('Location: https://laporanwfh.bps.go.id/index.php?menu=o5qnqNOTnw%3D%3D');
                    
        } catch (Exception $e) {
            exit('Gagal Mendapatkan Data Pengguna: '.$e->getMessage());
        }
    } catch (Exception $e) {
        session_destroy();
        exit('Gagal mendapatkan akses token : '.$e->getMessage());
    }

    // Opsional: Setelah mendapatkan token, anda dapat melihat data profil pengguna
    
}
?>