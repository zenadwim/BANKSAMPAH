<?php
session_start();

//cek apakah user sudah login
if(!isset($_SESSION['id_admin'])){
die("Anda belum login");//jika belum login jangan lanjut..
}
?>
<?php
//include connection file 
include_once("../config.php");
include_once('../libs/fpdf.php');



// intance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF();
// membuat halaman baru
$pdf->AddPage();
// setting jenis font yang akan digunakan
$pdf->SetFont('Arial','B',16);

$pdf->Cell(200,7,'Data Harga Untuk Nasabah',0,1,'C');





$pdf->Output();