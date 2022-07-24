<?php 
// mengaktifkan session php
session_start();
 
// menghapus semua session
session_destroy();
unset($_SESSION['nama']);
unset($_SESSION['id_nasabah']);
unset($_SESSION['id_admin']);
// mengalihkan halaman ke halaman login
header("location:index.php");
?>