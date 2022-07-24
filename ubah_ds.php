<?php
session_start();

//cek apakah user sudah login
if(!isset($_SESSION['id_admin'])){
    die("Anda belum login");//jika belum login jangan lanjut..
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin | Dasboard</title>
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
                    <h1 class="h3 mb-4 text-gray-800" align="center">Ubah Bobot</h1>

                    <!-- Content Row -->
                    <div class="row">
                    <?php
                    include 'config.php';
                    $id_setor = $_GET['id_setor'];
                    $id_sampah = $_GET['id_sampah'];
                    $detil  = mysqli_query($db, "select * from detil_setor where id_sampah='$id_sampah' AND id_setor='$id_setor' ");
                    $row        = mysqli_fetch_array($detil);
                    
                    $setor  = mysqli_query($db, "select * from setoran where id_setor='$id_setor' ");
                    $baris  = mysqli_fetch_array($setor);
                    $id_nasabah = $baris['id_nasabah'];
                    
                    $tabungan  = mysqli_query($db, "select * from tabungan where id_nasabah='$id_nasabah' ");
                    $tabung  = mysqli_fetch_array($tabungan);
                    
                    $sampah  = mysqli_query($db, "select * from sampah where id_sampah='$id_sampah' ");
                    $smp  = mysqli_fetch_array($sampah);
                    
                    $saldo_sekarang=$tabung['saldo']-$row['harga_nasabah'];
                    ?>
                    <div class="card-body" style="margin-left: 150px; margin-right: 150px">
                        <div class="table-responsive">
                            <table class="shadow table table-bordered" cellspacing="0">
                                <form action="proses-ubahds.php" method="POST">
                                    <tr>
                                        <td>Nama Sampah </td>
                                        <td><input type="text" name="nama_sampah" value="<?php echo $smp['nama_sampah'] ?>" /></td>
                                    </tr>
                                    <tr>
                                        <td>Bobot </td>
                                        <td><input type="number" name="jumlah" id="jumlah" value="<?php echo $row['total'] ?>" /></td>
                                    </tr>
                                    <input type="hidden" name="harga_nasabah" id="harga_nasabah" value="<?php echo $smp['harga_nasabah'] ?>" />
                                    <input type="hidden" name="harga_pengepul" id="harga_pengepul" value="<?php echo $smp['harga_pengepul'] ?>" />
                                    <input type="hidden" name="hrg_nasabah" id="hrg_nasabah"  value="<?php $hrg_n=$row['total']*$smp['harga_nasabah']; echo $hrg_n ?>"  readonly="readonly" />
                                    <input type="hidden" name="hrg_pengepul" id="hrg_pengepul"  value="<?php $hrg_p=$row['total']*$smp['harga_pengepul']; echo $hrg_p ?>"  readonly="readonly" /></td>
                                    
                                    <p style="display:none">
                                        <input type="text" name="saldo" value="<?php echo $saldo_sekarang ?>" />
                                        <input type="text" name="id_nasabah" value="<?php echo $id_nasabah ?>" />
                                        <input type="text" name="id_setor" value="<?php echo $id_setor ?>" />
                                        <input type="text" name="id_sampah" value="<?php echo $id_sampah ?>" />
                                    </p>
                                    <tr>
                                        <td></td>
                                        <td><input type="submit" value="Simpan" name="simpan" /></td>
                                    </tr>
                                </form>
                            </table>
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
    <script type="text/javascript">
        $(document).ready(function() {
            $('#jumlah').change(function(){
            
            var jumlah=parseInt($('#jumlah').val());
            var harga_nasabah=parseInt($('#harga_nasabah').val());
            var harga_pengepul=parseInt($('#harga_pengepul').val());
            
            var credit=jumlah*harga_nasabah;
            var credit2=jumlah*harga_pengepul;
            $('#hrg_nasabah').val(credit);
            $('#hrg_pengepul').val(credit2);
            });
        });
    </script>
</body>
</html>
