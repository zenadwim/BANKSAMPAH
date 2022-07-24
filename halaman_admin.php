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
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>
                    <div class="card shadow mb-4">
                    <!-- Page Heading -->
                    <div class="card-header py-3 d-flex justify-content-between">
                            <h4 class="m-0 font-weight-bold text-primary">Data Sampah selama ini</h4>
                            
                        </div>

                    <!-- Content Row -->
                    <div class="card-body">
                    <div class="row">
                        <?php
                        // Include config file
                        require_once "config.php";
                        $i=0;

                        // $sql = "SELECT * FROM detil_setor INNER JOIN sampah ON detil_setor.id_sampah=sampah.id_sampah;";
                        $sql = "SELECT * FROM sampah;";
                        
                        if($result = mysqli_query($db, $sql)){
                            if(mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_array($result)){                                
                                      $i++;
                                      $id_sampah = $row['id_sampah'];
                                      echo "<div class='col-xl-3 col-md-6 mb-4' id='row-$i'>";
                                        echo "<div class='card border-left-primary shadow h-100 py-2'>";
                                            echo "<div class='card-body'>";
                                                echo "<div class='row no-gutters align-items-center'>";
                                                    echo "<div class='col mr-2'>";
                                                        echo "<div class='h4 font-weight-bold text-primary text-uppercase mb-1'>". $row['nama_sampah'] ."</div>";
                                                        $query = "SELECT * FROM detil_setor where id_sampah='$id_sampah'";
                                                        $hasil = mysqli_query($db, $query);
                                                        $x=0;  
                                                        while($data = mysqli_fetch_array($hasil))  
                                                        { 
                                                            $x= $x + $data['total'];
                                                        } 
                                                        echo "<div class='h5 mb-0 font-weight-bold text-gray-800'>$x (". $row['satuan'].")</div>";
                                                    echo '</div>';
                                                    echo "<div class='col-auto'><i class='fas fa-shopping-basket fa-2x text-gray-300'></i></div>";
                                                echo "</div>";
                                            echo "</div>";
                                        echo "</div>";
                                      echo "</div>";
                                }
                                // Free result set
                                mysqli_free_result($result);
                            }
                        }
                        // Close connection
                        mysqli_close($db);
                        ?>
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

</body>

</html>