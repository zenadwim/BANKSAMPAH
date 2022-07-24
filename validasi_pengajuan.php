<?php
session_start();

//cek apakah user sudah login
if(!isset($_SESSION['id_admin'])){
die("Anda belum login");//jika belum login jangan lanjut..
}

require_once "config.php";

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
                    <div class="card shadow mb-4" style="margin-top:40px">
                        <div class="card-header py-3 d-flex justify-content-between">
                            <h4 class="m-0 font-weight-bold text-primary">Informasi Pengajuan</h4>
                            <input id="myInput" type="text" placeholder="Search.."
                                style="
                                border: 1px solid grey;
                                border-radius: 5px;
                                height: 35px;
                                padding: 2px 23px 2px 30px;
                                outline: 0;
                                background-color: #98AFC7;"
                            >  
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>  
                                    <tr>  
                                        <th>ID</th>  
                                        <th>Tanggal Pengajuan</th>  
                                        <th>Admin</th>
                                        <th>Jumlah</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody id="myTable">  
                                    <?php
                                    include 'config.php';
                                    setlocale(LC_ALL, 'id-ID', 'id_ID');
                                    $query = "SELECT pengajuan.id_pengajuan , pengajuan.tanggal_pengajuan,pengajuan.id_nasabah,pengajuan.id_admin, pengajuan.status,pengajuan.jumlah ,admin.nama AS name1 ,nasabah.id_nasabah ,nasabah.nama AS name2 FROM pengajuan LEFT JOIN admin ON pengajuan.id_admin = admin.id_admin RIGHT JOIN nasabah ON pengajuan.id_nasabah = nasabah.id_nasabah WHERE pengajuan.status='Sedang diproses'";  
                                    $result = mysqli_query($db, $query);  
                                    while($row = mysqli_fetch_array($result)){  
                                        $cr_date=date_create($row['tanggal_pengajuan']);
                                        $for_date=strftime('%d-%B-%Y', $cr_date->getTimestamp());
                                    ?>  
                                        <tr>
                                                
                                            <td><?php echo $row["id_pengajuan"]; ?></td>  
                                            <td><?php echo $for_date; ?></td>
                                            <td><?php echo $row["name2"]; ?></td>  
                                            <td><?php echo $row["jumlah"]; ?></td>
                                            <td><?php echo $row["status"]; ?></td>
                                            <?php echo " <td><a href='fvalidasi_pengajuan.php?id_pengajuan=".$row['id_pengajuan']."' >Validasi</a></td>";?>   
                                        </tr>  
                                    <?php  
                                    }  
                                    ?>
                                </tbody>  
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
        $(document).ready(function(){
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        });
    </script>
</body>