<?php

$server = "180.235.148.89";
$user = "ublmobil";
$password = "d8yNDY&kwIDL";
$nama_database = "ublmobil_bank_sampah";

$db = mysqli_connect($server, $user, $password, $nama_database);

if( !$db ){
    die("Gagal terhubung dengan database: " . mysqli_connect_error());
}

?>