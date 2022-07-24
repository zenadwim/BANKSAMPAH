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
// mencetak string 
// logo atau gambar, 
// 'logo.php' di bawah berarti path atau alamat gambar
// dengan panjang posisi X = 10, Y = 6, dan panjang 30 
// $pdf->Image('../assets/img/logo.jpeg',10,6,30);
$pdf->Cell(15,7,$pdf->Image('../assets/img/logobspbs.png',30,5,30),0,0,'C');
$pdf->Cell(180,7,'Data Transaksi Pengajuan',0,1,'C');
$pdf->Cell(10,7,'',0,1);
$pdf->Line(20, 30, 210-20, 30);

// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10,7,'',0,1);
$pdf->Cell(10,7,'',0,1);
$pdf->SetFont('Arial','B',12);

$id_pengajuan = $_GET['id_pengajuan'];
$pengajuan  = mysqli_query($db, "select * from pengajuan where id_pengajuan='$id_pengajuan'");
$set = mysqli_fetch_array($pengajuan);
$id_nasabah = $set['id_nasabah'];
$nasabah = mysqli_query($db, "select * from nasabah where id_nasabah='$id_nasabah'");
$nas = mysqli_fetch_array($nasabah);
$nama=$nas['nama'];
$id_admin=$set['id_admin'];
$admin = mysqli_query($db, "select * from admin where id_admin='$id_admin'");
$adm = mysqli_fetch_array($admin);

$pdf->Cell(10);
$pdf->Cell(35,6,'ID Pengajuan',0,0);
$pdf->Cell(50,6,":".$id_pengajuan,0,1);
$pdf->Cell(10);
$pdf->Cell(35,6,'Nama Nasabah',0,0);
$pdf->Cell(50,6,":".$nama,0,1);
$pdf->Cell(10);
$pdf->Cell(35,6,'Tanggal',0,0);

$cr_date=date_create($set['tgl_setor']);
$for_date=strftime('%d-%B-%Y', $cr_date->getTimestamp());

$pdf->Cell(50,6,":".$for_date,0,1);
$pdf->Cell(10);
$pdf->Cell(35,6,'Nama Admin',0,0);
$pdf->Cell(50,6,":".$adm['nama'],0,1);
$pdf->Cell(10);
$pdf->Cell(35,6,'Status',0,0);
$pdf->Cell(50,6,":".$set['status'],0,1);

$pdf->Cell(10,7,'',0,1);

$pdf->Cell(14);
$pdf->SetFont('Arial','B',16);
$hasil_rupiah = "Rp. " . number_format($set['jumlah'],2,',','.');
$pdf->Cell(20,7,'Uang yang di ajukan'.$hasil_rupiah.' ',0,1);


$pdf->Output();