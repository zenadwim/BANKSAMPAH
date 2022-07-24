<?php
include("config.php");
$data = json_decode(file_get_contents('php://input'), true);

$number = 1;
// ini number harusnya dapet dari count id_setornya, tapi di akalin dulu , coba masuk atau enggak, yang di luar data bisa masuk, yang didalem ga bisa
if ($number > 0) {
     $id_setoran = $data['id_setoran'];
     $tgl_setor = $data['tanggal_setor'];
     $id_nasabah = $data['id_nasabah'];
     $id_admin = $data['id_admin'];
     $sql = "INSERT INTO setoran (id_setor, tgl_setor, id_nasabah, id_admin) VALUE ('$id_setoran', '$tgl_setor', '$id_nasabah', '$id_admin')";
     $query = mysqli_query($db, $sql);

     $jumlah=0;
     foreach ($data['data'] as $row) {
          
          $id_sampah = $row['sampah'];
          $total = $row['total'];
          $harga_nasabah = $row['harga_nasabah'];
          $jumlah=$jumlah+$row['harga_nasabah'];
          $harga_pengepul = $row['harga_pengepul'];
          if($total != "0"){
          $sql2 = "INSERT INTO detil_setor(id_setor, id_sampah, total, harga_nasabah, harga_pengepul)
             VALUES('$id_setoran', '$id_sampah', '$total', '$harga_nasabah', '$harga_pengepul')";
          mysqli_query($db, $sql2);
          }
     }
     $jml = $jumlah+$data['saldo'];
     $sql3 = "UPDATE tabungan SET saldo='$jml' WHERE id_nasabah='$id_nasabah'";
     $query = mysqli_query($db, $sql3);

     echo "Data Inserted";
     
} else {
     echo "Please Enter Name";
}
?>