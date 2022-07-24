<?php

include("config.php");

// cek apakah tombol HapusData sudah diklik atau blum?
if(isset($_GET['HapusData'])){
    // ambil data dari formulir
    $id_kategori = $_GET['id_kategori'];

    // buat query update
    $sql = "DELETE FROM kategori WHERE id_kategori='$id_kategori'";
    $query = mysqli_query($db, $sql);

    // apakah query update berhasil?
    if( $query ) {
        // kalau berhasil alihkan ke halaman tabel_kategori.php
        header('Location: tabel_kategori.php');
    } else {
        // kalau gagal tampilkan pesan
        die("Gagal menghapus perubahan...");
    }
} else {
    die("Akses dilarang...");
}
?>