<?php

include("config.php");

// cek apakah tombol simpan sudah diklik atau blum?
if(isset($_GET['simpan'])){

    // ambil data dari formulir
    $id_sampah = $_GET['id_sampah'];
    $harga_nasabah_lama = $_GET['harga_nasabah_lama'];
    $harga_nasabah = $_GET['harga_nasabah'];
    $tanggal = $_GET['tanggal'];
    $id_admin = $_GET['id_admin'];

    // buat query update
    $sql = "UPDATE sampah SET harga_nasabah='$harga_nasabah' WHERE id_sampah='$id_sampah'";
    $sql2 = "INSERT INTO harga_nasabah (id_sampah, harga_lama, harga_baru, tanggal, id_admin) VALUE ('$id_sampah', '$harga_nasabah_lama', '$harga_nasabah', '$tanggal', '$id_admin')";
    $query = mysqli_query($db, $sql);
    $query = mysqli_query($db, $sql2);

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