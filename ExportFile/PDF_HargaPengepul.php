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

$from_date = $_GET['from_date'];
$coba = explode("-", $from_date);
$hari2= $coba[0];
$bulan2= $coba[1];
$tahun2= $coba[2];
$dari=$coba[2]."-".$coba[1]."-".$coba[0];

$testin = $_GET['testin'];
$test = explode("-", $testin);
$hari2= $test[0];
$bulan2= $test[1];
$tahun2= $test[2];
$ke=$test[2]."-".$test[1]."-".$test[0];

// intance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF();
// membuat halaman baru
$pdf->AddPage();
// setting jenis font yang akan digunakan
$pdf->SetFont('Arial','B',16);
// mencetak string 
// logo atau gambar, 
// 'logo.php' di bawah berarti path atau alamat gambar
// dengan panjang posisi X = 10, Y = 6, dan panjang 30 
// $pdf->Image('../assets/img/logo.jpeg',10,6,30);
$pdf->Cell(10,7,$pdf->Image('../assets/img/logobspbs.png',45,5,30),0,0,'C');
$pdf->Cell(200,7,'Data Harga Untuk Pengepul',0,1,'C');
$pdf->Cell(220,7, $dari . ' Sampai ' . $ke,0,1,'C');

// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10,7,'',0,1);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,6,'No.',1,0);
$pdf->Cell(35,6,'ID Harga Pengepul',1,0);
$pdf->Cell(20,6,'ID Sampah',1,0);
$pdf->Cell(25,6,'Harga Lama',1,0);
$pdf->Cell(27,6,'Harga Baru',1,0);
$pdf->Cell(30,6,'Tanggal',1,0);
$pdf->Cell(30,6,'Admin',1,1);

$pdf->SetFont('Arial','',10);

$data = mysqli_query($db,"SELECT * FROM harga_pengepul INNER JOIN admin ON harga_pengepul.id_admin=admin.id_admin where tanggal BETWEEN '".$dari."' AND '".$ke."';");
$no = 1;
while ($d = mysqli_fetch_array($data)){
    $cr_date=date_create($d['tanggal']);
    $for_date=strftime('%e-%B-%Y', $cr_date->getTimestamp());

    $pdf->Cell(10,6,$no++,1,0);
    $pdf->Cell(35,6,$d['id_hrgpengepul'],1,0);
    $pdf->Cell(20,6,$d['id_sampah'],1,0);
    $pdf->Cell(25,6,$d['harga_lama'],1,0);
    $pdf->Cell(27,6,$d['harga_baru'],1,0);
    $pdf->Cell(30,6,$for_date,1,0);
    $pdf->Cell(30,6,$d['nama'],1,1); 
}

$pdf->Output();