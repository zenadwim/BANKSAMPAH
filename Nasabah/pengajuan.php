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

    <title>Nasabah | Pengajuan</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>  
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
                    <h1 class="h3 mb-2 text-gray-800" align="center">Form Pengajuan</h1>
                    <div class="mb-4">
                    <?php
                    include '../config.php';
                    $id_nasabah= $_SESSION['id_nasabah'];
                    $rekening  = mysqli_query($db, "select * from tabungan where id_nasabah='$id_nasabah'");
                    $row        = mysqli_fetch_array($rekening);
                    // $min  = mysqli_query($db, "select * from min_saldo ");
                    // $row_min        = mysqli_fetch_array($min);

                    ?>
                    <input type="hidden" value="<?php echo $row['saldo']; ?>" name="money" id="money" />
                    <!-- <input type="text" value="<?php echo $row_min['saldo']; ?>" name="minsaldo" id="minsaldo" /> -->
                    
                    <!-- <p style="text-align: center;">Total Uang Direkening anda sebesar : <span id="formattedMoney"></span></p> -->
                    <!-- <p style="text-align: center;">Jumlah Uang Yang Bisa Ditarik Direkening Anda Sebesar : <span id="bisaditarik"></span></p> -->
                    
                        <div class="card-body" style="margin-left: 150px; margin-right: 150px">
                            <div class="table-responsive">
                                <table class="shadow table table-bordered" cellspacing="0">
                                    <form name="pengajuan" id="pengajuan">
                                        <input type="hidden" name="tanggal_pengajuan" id="tanggal_pengajuan" value="<?php echo date('Y-m-d'); ?>" />
                                        <!-- <input type="hidden"  name="min" id="min" /> -->
                                        <input type="hidden" name="id_nasabah" id="id_nasabah"value="<?php echo $row['id_nasabah'] ?>"  />
                                        <tr>
                                            <td><label for="formattedMoney">Saldo anda sebesar</label></td>
                                            <td><span id="formattedMoney"></span></td>
                                        </tr>
                                        <tr>
                                            <td><label for="jumlah">Nominal yang ingin diajukan</label></td>
                                            <td><input type="text" name="jumlah" id="jumlah" style="width: 100%"/></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td><input type="button" name="submit" id="submit" class="btn btn-info" value="Submit" /></td>
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

    <?php include "profileLogoutModal_nasabah.php"; ?>

    <!-- Bootstrap core JavaScript-->
    
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
        // document.getElementById('bisaditarik').innerText = moneyFormatter.format(coba_saldo);
        // document.getElementById('min').value=coba_saldo ;
    </script>

    <script>
        $(document).ready(function() {
            $('#submit').click(function() {
                var id_nasabah=$('#id_nasabah').val();
                var tanggal_pengajuan=$('#tanggal_pengajuan').val();
                var test = tanggal_pengajuan.split("-");
                var tahun2 = test[0];
                var bulan2 = test[1];
                var hari2 = test[2];
                var id_pengajuan = id_nasabah + test[0] + test[1] + test[2];
                
                var json = Object();

                var rowData = [];
                json["id_pengajuan"] = id_pengajuan;
                json["id_nasabah"] = $("#id_nasabah").val();
                
                json["tanggal_pengajuan"] = $("#tanggal_pengajuan").val();
                json["jumlah"] = $("#jumlah").val();
                json["min"] = $("#money").val();

                console.log(JSON.stringify(json));
                
                $.ajax({  
                url:"proses_pengajuan.php",  
                method:"POST",  
                data:JSON.stringify(json),  
                success:function(data)  
                {  
                    alert(data);  
                    window.location.assign("pengajuan.php") 
                }  
                });
            });
        });
    </script>
</body>
</html>