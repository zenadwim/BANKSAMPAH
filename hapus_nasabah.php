<?php

include("config.php");

// cek apakah tombol HapusData sudah diklik atau blum?
if(isset($_GET['HapusData'])){
    // ambil data dari formulir
    $id_nasabah = $_GET['id_nasabah'];

    // buat query update
    $sql = "DELETE FROM nasabah WHERE id_nasabah='$id_nasabah'";
    $query = mysqli_query($db, $sql);

    // apakah query update berhasil?
    if( $query ) {
        // kalau berhasil alihkan ke halaman tabel_nasabah.php
        header('Location: tabel_nasabah.php');
    } else {
        // kalau gagal tampilkan pesan
        die("Gagal menghapus perubahan...");
    }
} else {
    die("Akses dilarang...");
}
?>