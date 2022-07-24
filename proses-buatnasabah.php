<?php

include("config.php");

// cek apakah tombol daftar sudah diklik atau blum?
if(isset($_POST['Input'])){

    // ambil data dari formulir
    
    
    $alamat = $_POST['alamat'];
    $password = $_POST['password'];
    $nama = $_POST['nama'];
    $no_telepon = $_POST['no_telepon'];
    $saldoawal =0;
   
    // buat query
        $query = mysqli_query($db , "INSERT INTO nasabah (nasabah.alamat,nasabah.nama,nasabah.password,nasabah.no_telepon) VALUES ('$alamat','$nama','$password','$no_telepon')");
         $query2 = mysqli_query($db , "SELECT nasabah.id_nasabah FROM nasabah WHERE nasabah.no_telepon ='$no_telepon'");
         $ajuan =mysqli_fetch_assoc($query2);
         $id_nasabah =$ajuan['id_nasabah'];
         $query3 = mysqli_query($db , "INSERT INTO tabungan (tabungan.id_nasabah,tabungan.saldo) VALUES ('$id_nasabah','$saldoawal')");


    // apakah query simpan berhasil?
    if( $query && $query3 ) {
        // kalau berhasil alihkan ke halaman index.php dengan status=sukses
        header('Location: tabel_nasabah.php?status=sukses');
    } else {
        // kalau gagal alihkan ke halaman indek.php dengan status=gagal
        header('Location: tabel_nasabah.php?status=gagal');
    }


} else {
    die("Akses dilarang...");
}

?>