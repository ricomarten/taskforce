<?php
include "koneksi.php";
$today = date("Y-m-d"); 
$json_str = file_get_contents('php://input');
$json_obj = json_decode($json_str);
    //print_r($json_obj->status);
    echo '<div class="table-responsive my-custom-scrollbar">';
    $sql=mysqli_query($conn,"SELECT * FROM detail_data where id_data='$json_obj->param'");
     
    echo "<table class='table table-bordered table-striped mb-0'>";
    echo "<thead><tr>";
    echo "<th>#</th>";
    echo "<th>PUNYA NIK</th>";
    echo "<th>NIK</th>";
    echo "<th>KK</th>";
    echo "<th>NAMA</th>";
    echo "<th>JK</th>";
    echo "<th>ALAMAT</th>";
    echo "<th>TGL LAHIR</th>";
    echo "<th>UMUR</th>";
    echo "</tr></thead>";
    echo "<tbody>";
    $i=1;
    while($data = mysqli_fetch_array( $sql)){
        echo "<tr>";
        echo "<td>".$i++."</td>";
        echo "<td>".$data['ada_nik']."</td>";
        echo "<td>".$data['nik']."</td>";
        echo "<td>".$data['kk']."</td>";
        echo "<td>".$data['nama']."</td>";
        echo "<td>".$data['jenkel']."</td>";
        echo "<td>".$data['alamat']."</td>";
        echo "<td>".$data['tgl_lhr']."</td>";
        echo "<td>".$data['umur']."</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";

?>