<?php
include("config.php");
$data = json_decode(file_get_contents('php://input'), true);

$number = 1;
// ini number harusnya dapet dari count id_setornya, tapi di akalin dulu , coba masuk atau enggak, yang di luar data bisa masuk, yang didalem ga bisa
if ($number > 0) {

     
     foreach ($data['data'] as $row) {
        $harga_kurang=0;
        $saldo_tambah=0;
          $id_setor = $row['id_setor'];
          $id_nasabah = $row['id_nasabah'];
          $query2 = mysqli_query($db , "SELECT tabungan.id_nasabah,tabungan.saldo FROM tabungan WHERE tabungan.id_nasabah ='$id_nasabah'");
          $tabung =mysqli_fetch_assoc($query2);
          $saldo =$tabung['saldo'];
          $harga_nasabah = $row['harga_nasabah'];
          $harga_pengepul = $row['harga_pengepul'];
          $harga_kurang = $saldo - $harga_nasabah;
          $sql3 = "UPDATE tabungan SET saldo='$harga_kurang' WHERE id_nasabah='$id_nasabah'";
          $query = mysqli_query($db, $sql3);
          $hn = $row['hn'];
          $hp = $row['hp'];
          $saldo_tambah = $harga_kurang + $hn;
          $sql4 = "UPDATE tabungan SET saldo='$saldo_tambah' WHERE id_nasabah='$id_nasabah'";
          $query = mysqli_query($db, $sql4);
          $id_sampah = $row['id_sampah'];
          $sql4 = "UPDATE detil_setor SET harga_nasabah='$hn',harga_pengepul='$hp' WHERE id_setor='$id_setor' AND id_sampah='$id_sampah'";
          $query = mysqli_query($db, $sql4);
          
     }

     echo "Data Inserted";
     
} else {
     echo "Please Enter Name";
}
?>