<?php
include("config.php");

// cek apakah tombol simpan sudah diklik atau blum?
if(isset($_GET['Simpan'])){
    // ambil data dari formulir
    $id_admin = $_GET['id_admin'];
    $alamat = $_GET['alamat'];
    $password = $_GET['password'];
    $nama = $_GET['nama'];
    $no_telepon = $_GET['no_telepon'];

    // buat query update
    $sql = "UPDATE admin SET alamat='$alamat', password='$password', nama='$nama', no_telepon='$no_telepon' WHERE id_admin='$id_admin'";
    $query = mysqli_query($db, $sql);

    // apakah query update berhasil?
    if( $query ) {
        // kalau berhasil alihkan ke halaman tabel_admin.php
        header('Location: tabel_admin.php');
    } else {
        // kalau gagal tampilkan pesan
        die("Gagal menyimpan perubahan...");
    }
} else {
    die("Akses dilarang...");
}
?>