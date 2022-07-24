<?php

include("config.php");

// cek apakah tombol simpan sudah diklik atau blum?
if(isset($_POST['simpan'])){

    // ambil data dari formulir
    $id_setor  = $_POST['id_setor'];
    $id_sampah  = $_POST['id_sampah'];
    $harga_pengepul = $_POST['hrg_pengepul'];
    $saldo = $_POST['saldo'];
    $harga_nasabah = $_POST['hrg_nasabah'];
    $jumlah = $_POST['jumlah'];
    $jml=0;
    $jml=$saldo+$harga_nasabah;
    $id_nasabah = $_POST['id_nasabah'];

    // buat query update
    $sql = "UPDATE detil_setor SET harga_pengepul='$harga_pengepul', harga_nasabah='$harga_nasabah', total='$jumlah' WHERE id_setor='$id_setor' AND id_sampah='$id_sampah'";
    $sql2 = "UPDATE tabungan SET saldo='$jml' WHERE id_nasabah='$id_nasabah'";
    $query = mysqli_query($db, $sql);
    $query = mysqli_query($db, $sql2);


    // apakah query update berhasil?
    if( $query ) {
        // kalau berhasil alihkan ke halaman list-siswa.php
        header('Location: ds.php?id_setor='.$id_setor.'');
    } else {
        // kalau gagal tampilkan pesan
        die("Gagal menyimpan perubahan...");
    }


} else {
    die("Akses dilarang...");
}

?>