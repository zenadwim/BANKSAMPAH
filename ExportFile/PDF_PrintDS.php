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
$pdf->Cell(180,7,'Data Transaksi Penyetoran',0,1,'C');
$pdf->Cell(10,7,'',0,1);
$pdf->Line(20, 30, 210-20, 30);

// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10,7,'',0,1);
$pdf->Cell(10,7,'',0,1);
$pdf->SetFont('Arial','B',12);

$id_setor = $_GET['id_setor'];
$rekening  = mysqli_query($db, "select * from setoran where id_setor='$id_setor'");
$set = mysqli_fetch_array($rekening);
$id_nasabah = $set['id_nasabah'];
$nasabah = mysqli_query($db, "select * from nasabah where id_nasabah='$id_nasabah'");
$nas = mysqli_fetch_array($nasabah);
$nama=$nas['nama'];
$id_admin=$set['id_admin'];
$admin = mysqli_query($db, "select * from admin where id_admin='$id_admin'");
$adm = mysqli_fetch_array($admin);

$pdf->Cell(10);
$pdf->Cell(35,6,'ID Setor',0,0);
$pdf->Cell(50,6,":".$id_setor,0,1);
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

$pdf->Cell(10,7,'',0,1);

$pdf->Cell(14);
$pdf->SetFont('Arial','B',16);
$pdf->Cell(20,7,'Data Sampah',0,1);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(15);
$pdf->Cell(20,6,'No.',1,0);
$pdf->Cell(50,6,'Sampah',1,0);
$pdf->Cell(40,6,'Bobot/Jumlah',1,0);
$pdf->Cell(40,6,'Harga Sampah',1,1);



$pdf->SetFont('Arial','',12);

$data = mysqli_query($db,"SELECT * FROM detil_setor INNER JOIN sampah ON detil_setor.id_sampah=sampah.id_sampah where id_setor='$id_setor'");
$no = 1;
while ($d = mysqli_fetch_array($data)){
    $x= $x + $d["harga_nasabah"];
    $pdf->Cell(15);
    $pdf->Cell(20,6,$no++,1,0);
    $pdf->Cell(50,6,$d['nama_sampah'],1,0);
    $pdf->Cell(40,6,$d['total']."(".$d['satuan'].")",1,0);
    
    $hasil_rupiah = "Rp. " . number_format($d['harga_nasabah'],2,',','.');
    
    $pdf->Cell(40,6,$hasil_rupiah,1,1);


}
    $pdf->Cell(15);
    $pdf->Cell(110,6,"Jumlah Harga",1,0,'C');
    
    $hasil_rupiahx = "Rp. " . number_format($x,2,',','.');
    
    $pdf->Cell(40,6,$hasil_rupiahx,1,1);

$pdf->Output();