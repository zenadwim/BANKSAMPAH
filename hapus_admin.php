<?php

include("config.php");

// cek apakah tombol HapusData sudah diklik atau blum?
if(isset($_GET['HapusData'])){
    // ambil data dari formulir
    $id_admin = $_GET['id_admin'];

    // buat query update
    $sql = "DELETE FROM admin WHERE id_admin='$id_admin'";
    $query = mysqli_query($db, $sql);

    // apakah query update berhasil?
    if( $query ) {
        // kalau berhasil alihkan ke halaman tabel_admin.php
        header('Location: tabel_admin.php');
    } else {
        // kalau gagal tampilkan pesan
        die("Gagal menghapus perubahan...");
    }
} else {
    die("Akses dilarang...");
}
?>