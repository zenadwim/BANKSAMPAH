<?php

include("config.php");
if(isset($_GET['Simpan'])){
    // ambil data dari formulir
    $id_kategori = $_GET['id_kategori'];
    $deskripsi = $_GET['deskripsi'];

    // buat query update
    $sql = "UPDATE kategori SET deskripsi='$deskripsi' WHERE id_kategori='$id_kategori'";
    $query = mysqli_query($db, $sql);

    // apakah query update berhasil?
    if( $query ) {
        // kalau berhasil alihkan ke halaman tabel_kategori.php
        header('Location: tabel_kategori.php');
    } else {
        // kalau gagal tampilkan pesan
        die("Gagal menyimpan perubahan...");
    }
} else {
    die("Akses dilarang...");
}
?>