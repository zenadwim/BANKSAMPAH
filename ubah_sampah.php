<?php

include("config.php");

// cek apakah tombol simpan sudah diklik atau blum?
if(isset($_GET['simpan'])){

    // ambil data dari formulir
    $id_sampah = $_GET['id_sampah'];
    $nama_sampah = $_GET['nama_sampah'];
    $satuan = $_GET['satuan'];

    // buat query update
    $sql = "UPDATE sampah SET nama_sampah='$nama_sampah', satuan='$satuan' WHERE id_sampah='$id_sampah'";
    $query = mysqli_query($db, $sql);

    // apakah query update berhasil?
    if( $query ) {
        // kalau berhasil alihkan ke halaman sampah.php
        header('Location: sampah.php');
    } else {
        // kalau gagal tampilkan pesan
        die("Gagal menyimpan perubahan...");
    }


} else {
    die("Akses dilarang...");
}

?>