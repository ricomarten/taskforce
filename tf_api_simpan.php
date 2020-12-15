<?php
$json_str = file_get_contents('php://input');
$json_obj = json_decode($json_str);
$array = json_decode($json_str, true);
$row=(count($array['tabel']))/8;
//echo $row;
$kolom=0;
//print_r($array);
for($i=1;$i<$row;$i++){  
    for($j=0;$j<=7;$j++){
        echo $array['tabel'][$i*8+$j]['tabel']['nilai']."#";
    }
    $kolom++;
    echo "<hr>";
}
?>