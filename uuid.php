<?php
//$u=uuid();   // 0001-7f000001-478c8000-4801-47242987
//echo $u;
//echo "<br>";
//print_r(uuidDecode($u)); // Array ( [serverID] => 0001 [ip] => 127.0.0.1 [unixtime] => 1200390144 [micro] => 0.28126525878906 )

function uuid($serverID=1)
{
    $t=explode(" ",microtime());
    return sprintf( '%04x-%08s-%08s-%04s-%04x%04x',
        $serverID,
        clientIPToHex(),
        substr("00000000".dechex($t[1]),-8),   // get 8HEX of unixtime
        substr("0000".dechex(round($t[0]*65536)),-4), // get 4HEX of microtime
        mt_rand(0,0xffff), mt_rand(0,0xffff));
}

function uuidDecode($uuid) {
    $rez=Array();
    $u=explode("-",$uuid);
    if(is_array($u)&&count($u)==5) {
        $rez=Array(
            'serverID'=>$u[0],
            'ip'=>clientIPFromHex($u[1]),
            'unixtime'=>hexdec($u[2]),
            'micro'=>(hexdec($u[3])/65536)
        );
    }
    return $rez;
}

function clientIPToHex($ip="") {
    $hex="";
    if($ip=="") $ip=getEnv("REMOTE_ADDR");
    $part=explode('.', $ip);
    for ($i=0; $i<=count($part)-1; $i++) {
        $hex.=substr("0".dechex($part[$i]),-2);
    }
    return $hex;
}

function clientIPFromHex($hex) {
    $ip="";
    if(strlen($hex)==8) {
        $ip.=hexdec(substr($hex,0,2)).".";
        $ip.=hexdec(substr($hex,2,2)).".";
        $ip.=hexdec(substr($hex,4,2)).".";
        $ip.=hexdec(substr($hex,6,2));
    }
    return $ip;
}
?>