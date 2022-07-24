<?php

include("config.php");

// cek apakah tombol HapusData sudah diklik atau blum?
if(isset($_GET['HapusData'])){
    // ambil data dari formulir
    $id_sampah = $_GET['id_sampah'];

    // buat query update
    $sql = "DELETE FROM sampah WHERE id_sampah='$id_sampah'";
    $query = mysqli_query($db, $sql);

    // apakah query update berhasil?
    if( $query ) {
        // kalau berhasil alihkan ke halaman sampah.php
        header('Location: sampah.php');
    } else {
        // kalau gagal tampilkan pesan
        die("Gagal menghapus perubahan...");
    }
} else {
    die("Akses dilarang...");
}
?>