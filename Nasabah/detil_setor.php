<?php
session_start();
//cek apakah user sudah login
if(!isset($_SESSION['id_nasabah'])){
die("Anda belum login");//jika belum login jangan lanjut..
}
include '../config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Nasabah | Tabungan</title>
    <!-- Favicons -->
    <link href="../assets/img/favicon.png" rel="icon">
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php include "sidemenu_nasabah.php"; ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php include "topbar_nasabah.php"; ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800" align="center">Detil Transaksi</h1>
                    <div class="card shadow mb-4">
                        
                    <?php
                    include '../config.php';
                    $id_setor= $_GET['id_setor'];
                    $id_nasabah= $_SESSION['id_nasabah'];
                    $nasabah = mysqli_query($db, "select * from nasabah where id_nasabah='$id_nasabah'");
                    $nas = mysqli_fetch_array($nasabah);
                    $rekening  = mysqli_query($db, "select * from setoran where id_setor='$id_setor'");
                    $row        = mysqli_fetch_array($rekening);
                    $id_admin=$row['id_admin'];
                    $admin  = mysqli_query($db, "select * from admin where id_admin='$id_admin'");
                    $adm        = mysqli_fetch_array($admin);

                    ?>
                    <div class="card-body">
                        <input type="text" name="id_setor" id="id_setor" class="form-control" value="<?php echo $id_setor; ?>" style="display: none;" readonly />
                    <table class="table table-bordered">
                        <tr>
                            <td style="width: 50%;">
                                ID Setor
                            </td>
                            <td style="width: 50%;">
                            <?php echo $id_setor ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 50%;">
                                Nama Nasabah
                            </td>
                            <td style="width: 50%;">
                            <?php echo $nas['nama'] ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 50%;">
                                Tanggal
                            </td>
                            <td style="width: 50%;">
                            <?php 
                            $cr_date=date_create($row['tgl_setor']);
                            $for_date=strftime('%d-%B-%Y', $cr_date->getTimestamp());
                            echo $for_date ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 50%;">
                                Nama Admin
                            </td>
                            <td style="width: 50%;">
                            <?php echo $adm['nama'] ?>
                            </td>
                        </tr>
                        </table>  

                            
                        <div>
                        
                        <div class="container" style="width:100%;">  
                        <h3>Daftar Sampah</h3>          
                 
                        <div style="clear:both"></div>                 
                        
                        <div id="order_table">  
                            <table class="table table-bordered">  
                                <tr>  
                                    
                                    <th>Sampah</th>
                                    <th>Bobot/Jumlah</th>
                                    <th>harga_nasabah</th>
                                        
                                </tr>  
                            <?php
                            $query = "SELECT * FROM detil_setor INNER JOIN sampah ON detil_setor.id_sampah=sampah.id_sampah INNER JOIN kategori ON kategori.id_kategori=sampah.id_kategori where id_setor='$id_setor' ORDER BY sampah.id_kategori ";  
                            $result = mysqli_query($db, $query);
                            $x=0;  
                            while($row = mysqli_fetch_array($result))  
                            {
                                
                                $x= $x + $row["harga_nasabah"];
                            ?>  
                                <tr>  
                                    <td><?php echo $row["nama_sampah"]; ?></td>  
                                    <td><?php echo $row['total']."(".$row['satuan'].")"; ?></td>  
                                    <?php $hasil_rupiah = "Rp. " . number_format($row['harga_nasabah'],2,',','.'); ?>
                                    <td><?php echo $hasil_rupiah; ?></td>
                                        
                                </tr>  
                            <?php  
                            }  
                            ?>  
                            </table>
                            <table class="table table-bordered">
                            <tr>
                                <td style="width: 50%;">
                                    Total
                                </td>
                                <td style="width: 50%;">
                                    <?php $hasil_rupiahx = "Rp. " . number_format($x,2,',','.'); ?>
                                    <?php echo $hasil_rupiahx ?>
                                </td>
                            </tr>
                            </table>
                            <div>
                                <input type="button" name="exportPDF" id="exportPDF" value="Print PDF" class="btn btn-primary"/>
                            </div>
                        </div>  
                        </div>
                        </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                    Copyright &copy; <strong><span>2022</span></strong>. All Rights Reserved
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

     <?php include "profileLogoutModal_nasabah.php"; ?>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/chart-area-demo.js"></script>
    <script src="../js/demo/chart-pie-demo.js"></script>
    
     
     <script>  
        $(document).ready(function(){  
            
            $('#exportPDF').click(function(){ 
                var id_setor = $('#id_setor').val();
                
                if(id_setor != '')  
                {    
                    window.location.assign("../ExportFile/PDF_PrintDSN.php?id_setor="+id_setor);
                }  
                else{  
                    alert("Data id_nasabah Tidak ada");  
                }
            });

            
        });  
     </script>

    

</body>
</html>