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
$pdf->Cell(180,7,'Data Harga Terbaru Untuk Nasabah',0,1,'C');
$pdf->Cell(10,7,'',0,1);
$pdf->Line(20, 30, 210-20, 30);

// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10,7,'',0,1);
$pdf->Cell(10,7,'',0,1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(20,6,'No.',1,0);
$pdf->Cell(40,6,'Kategori',1,0);
$pdf->Cell(60,6,'Nama Sampah',1,0);
$pdf->Cell(30,6,'Satuan',1,0);
$pdf->Cell(40,6,'Harga Sampah',1,1);


$pdf->SetFont('Arial','',10);

$data = mysqli_query($db,"SELECT * FROM sampah INNER JOIN kategori ON sampah.id_kategori=kategori.id_kategori ORDER BY kategori.id_kategori DESC");
$no = 1;
while ($d = mysqli_fetch_array($data)){
    

    $pdf->Cell(20,6,$no++,1,0);
    $pdf->Cell(40,6,$d['deskripsi'],1,0);
    $pdf->Cell(60,6,$d['nama_sampah'],1,0);
    $pdf->Cell(30,6,$d['satuan'],1,0);
    $pdf->Cell(40,6,$d['harga_nasabah'],1,1);

}

$pdf->Output();