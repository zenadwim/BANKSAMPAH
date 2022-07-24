<?php

include("config.php");

// cek apakah tombol simpan sudah diklik atau blum?
if(isset($_POST['simpan'])){

    // ambil data dari formulir
    $saldo=$_POST['money'];
    $id_pengajuan   = $_POST['id_pengajuan'];
    $jumlah  = $_POST['jumlah'];
    $status  = $_POST['status'];
    $jml=0;
    $jml=$saldo-$jumlah;
    $id_nasabah = $_POST['id_nasabah'];
    $id_admin = $_POST['id_admin'];

    // buat query update
    $sql = "UPDATE pengajuan SET jumlah='$jumlah', status='$status', id_admin='$id_admin' WHERE id_pengajuan='$id_pengajuan' ";
    $sql2 = "UPDATE tabungan SET saldo='$jml' WHERE id_nasabah='$id_nasabah'";
    $query = mysqli_query($db, $sql);
    $query = mysqli_query($db, $sql2);


    // apakah query update berhasil?
    if( $query ) {
        // kalau berhasil alihkan ke halaman list-siswa.php
        header('Location: validasi_hasil.php?id_pengajuan='.$id_pengajuan.'');
        
    } else {
        // kalau gagal tampilkan pesan
        die("Gagal menyimpan perubahan...");
    }


} else {
    die("Akses dilarang...");
}

?>