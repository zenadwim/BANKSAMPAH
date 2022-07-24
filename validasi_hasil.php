<?php
session_start();

//cek apakah user sudah login
if(!isset($_SESSION['id_admin'])){
die("Anda belum login");//jika belum login jangan lanjut..
}

require_once "config.php";
$id_pengajuan = $_GET['id_pengajuan'];
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin | Info Penabung</title>
    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php include "Admin/sidebar_admin.php"; ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php include "Admin/topbar_admin.php"; ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800" align="center">Informasi Detil Penyetoran</h1>

                    <div class="card shadow mb-4">
                        <input type="text" name="id_pengajuan" id="id_pengajuan" class="form-control" value="<?php echo $id_pengajuan; ?>" style="display: none;" readonly />
                        <?php
                        $pengajuan  = mysqli_query($db, "select * from pengajuan where id_pengajuan='$id_pengajuan'");
                        $set = mysqli_fetch_array($pengajuan);
                        $id_nasabah = $set['id_nasabah'];
                        $nasabah = mysqli_query($db, "select * from nasabah where id_nasabah='$id_nasabah'");
                        $nas = mysqli_fetch_array($nasabah);
                        $id_admin=$set['id_admin'];
                        $admin = mysqli_query($db, "select * from admin where id_admin='$id_admin'");
                        $adm = mysqli_fetch_array($admin);
                        ?>
                        <div class="card-body">
                            <table class="table table-bordered">
                        <tr>
                            <td style="width: 50%;">
                                ID Pengajuan
                            </td>
                            <td style="width: 50%;">
                            <?php echo $id_pengajuan ?>
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
                            $cr_date=date_create($set['tgl_setor']);
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
                        <tr>
                            <td style="width: 50%;">
                                Status
                            </td>
                            <td style="width: 50%;">
                            <?php echo $set['status']; ?>
                            </td>
                        </tr>
                        
                        </table>
                        <?php
                        
                        
                        $hasil_rupiah = "Rp. " . number_format($set['jumlah'],2,',','.');
                        ?>
                            <div class="container" style="width:100%;">
                            <h3>Uang yang di ajukan <?php echo $hasil_rupiah ?></h3>
                        
                        </div>
                        <div>
                            <input type="button" name="exportPDF" id="exportPDF" value="Print PDF" class="btn btn-primary"/>
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

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    
    <script>  
        $(document).ready(function(){  
            
            $('#exportPDF').click(function(){ 
                var id_pengajuan = $('#id_pengajuan').val();
                
                if(id_pengajuan != '')  
                {    
                    window.location.assign("ExportFile/PDF_PrintValidasi.php?id_pengajuan="+id_pengajuan);
                }  
                else{  
                    alert("Data id_nasabah Tidak ada");  
                }
            });

            
        });  
     </script>

</body>