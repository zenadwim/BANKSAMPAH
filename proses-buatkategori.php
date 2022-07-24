<?php

include("config.php");

// cek apakah tombol daftar sudah diklik atau blum?
if(isset($_POST['Input'])){

    // ambil data dari formulir
    
    $deskripsi = $_POST['deskripsi'];
   
    // buat query
    $sql = "INSERT INTO kategori (deskripsi) VALUE ( '$deskripsi')";
    $query = mysqli_query($db, $sql);


    // apakah query simpan berhasil?
    if( $query ) {
        // kalau berhasil alihkan ke halaman index.php dengan status=sukses
        header('Location: tabel_kategori.php?status=sukses');
    } else {
        // kalau gagal alihkan ke halaman indek.php dengan status=gagal
        header('Location: tabel_kategori.php?status=gagal');
    }


} else {
    die("Akses dilarang...");
}

?>