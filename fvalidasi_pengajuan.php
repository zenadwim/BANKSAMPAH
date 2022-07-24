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
                    <h1 class="h3 mb-4 text-gray-800" align="center">Ubah Pengajuan</h1>

                    <!-- Content Row -->
                    <div class="row">
                    <?php
                    include 'config.php';
                    $id_pengajuan = $_GET['id_pengajuan'];
                    $pengajuan  = mysqli_query($db, "select * from pengajuan where id_pengajuan='$id_pengajuan' ");
                    $baris  = mysqli_fetch_array($pengajuan);
                    $id_nasabah = $baris['id_nasabah'];

                    $tabungan  = mysqli_query($db, "select * from tabungan where id_nasabah='$id_nasabah' ");
                    $tabung  = mysqli_fetch_array($tabungan);

                    $nasabah  = mysqli_query($db, "select * from nasabah where id_nasabah='$id_nasabah' ");
                    $nsb  = mysqli_fetch_array($nasabah);

                    $saldo_sekarang=$tabung['saldo'];
                    ?>
                    <div class="card-body" style="margin-left: 150px; margin-right: 150px">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" cellspacing="0">
                                <form action="proses-validasipengajuan.php" method="POST" onSubmit="return validasi_data(this)">
                                    <input type="hidden" value="<?php echo $tabung['saldo']; ?>" name="money" id="money" />
                                    <tr>
                                        <td for="nama">Nama Pengaju </td>
                                        <td><input type="text" name="nama" value="<?php echo $nsb['nama'] ?>" /></td>
                                    </tr>
                                    <tr>
                                        <td>Total Uang Yang Ada Direkening </td>
                                        <td><span id="formattedMoney"></span></td>
                                        <!-- <td><input type="text" name="formattedMoney" id="formattedMoney"/></td> -->
                                    </tr>
                                    <tr>
                                        <td for="jumlah">Jumlah yang di ajukan: </td>
                                        <td><input type="text" name="jumlah" id="jumlah" value="<?php echo $baris['jumlah'] ?>" /></td>
                                    </tr>
                                    <tr>
                                        <td>Status: </td>
                                        <td>
                                            <select name="status" id="status">
                                                <option value="Sedang diproses">Sedang diproses</option>
                                                <option value="Diterima">Diterima</option>
                                                <option value="Ditolak">Ditolak</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <p style="display:none">
                                        <input type="text" id ="saldo" name="saldo" value="<?php $tabung['saldo']; ?>" />
                                        <input type="text" name="id_admin" value="<?php echo $_SESSION['id_admin']; ?>" />
                                        <input type="text" name="id_nasabah" value="<?php echo $id_nasabah ?>" />
                                        <input type="text" name="id_pengajuan" value="<?php echo $id_pengajuan ?>" />
                                        
                                    <p>
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
    <script>
        var uang = document.getElementById('money').value;
        // var min_saldo = document.getElementById('minsaldo').value;
        // var coba_saldo=uang-min_saldo
        //1st way
        var moneyFormatter = new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 2
        });
        document.getElementById('formattedMoney').innerText = moneyFormatter.format(uang);
        //   document.getElementById('bisaditarik').innerText = moneyFormatter.format(coba_saldo);
        //   document.getElementById('min').value=coba_saldo ;
    </script>
    
    <script type="text/javascript">
        function validasi_data(form) {  
            var jumlah = document.getElementById("jumlah").value;
                var money = document.getElementById("money").value;
                var a =parseInt(jumlah);
                var b =parseInt(money);
            if (a>=b) {
            alert('test');
            form.jumlah.focus();
            return false;
            }else
            return true;
        }
    </script> 
</body>
</html>