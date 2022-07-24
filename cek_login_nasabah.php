<?php 
// mengaktifkan session pada php
session_start();
 
// menghubungkan php dengan koneksi database
include 'config.php';
 
// menangkap data yang dikirim dari form login
$no_telepon = $_POST['no_telepon'];
$password = $_POST['password'];
 
 
// menyeleksi data user dengan username dan password yang sesuai
$login = mysqli_query($db,"select * from nasabah where no_telepon='$no_telepon' and password='$password'");
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);
 
// cek apakah username dan password di temukan pada database
if($cek > 0){
 
	$data = mysqli_fetch_assoc($login);
	
		$nama=$data['nama'];
		$id_nasabah=$data['id_nasabah'];
		$_SESSION['nama'] =$iduser ;
		$_SESSION['id_nasabah'] =$id_nasabah;
		$_SESSION['no_telepon'] =$no_telepon;

		
		// alihkan ke halaman dashboard nasabah
		header("location:Nasabah/halaman_nasabah.php");
 
	
		
}else{
	header("location:login_nasabah.php?pesan=gagal");
}
 
?>