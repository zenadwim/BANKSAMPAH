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

    <title>Nasabah | Dasboard</title>
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

    <!-- Custom styles for this page -->
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <style>
        body {
            background: rgb(99, 39, 120)
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #BA68C8
        }

        .profile-button {
            background: rgb(99, 39, 120);
            box-shadow: none;
            border: none
        }

        .profile-button:hover {
            background: #682773
        }

        .profile-button:focus {
            background: #682773;
            box-shadow: none
        }

        .profile-button:active {
            background: #682773;
            box-shadow: none
        }

        .back:hover {
            color: #682773;
            cursor: pointer
        }

        .labels {
            font-size: 11px
        }

        .add-experience:hover {
            background: #BA68C8;
            color: #fff;
            cursor: pointer;
            border: solid 1px #BA68C8
        }
    </style>

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

                    <!-- Content Row -->
                    <div class="container rounded bg-white mt-5 mb-5">
                        <?php
                        // Include config file
                        require_once "../config.php";
                        // Attempt select query execution
                        $id_nasabah=  $_SESSION['id_nasabah'];
                        $sql = "SELECT * FROM nasabah WHERE id_nasabah='$id_nasabah'";
                        if($result = mysqli_query($db, $sql)){
                            if(mysqli_num_rows($result) > 0){
                                $row = mysqli_fetch_array($result);
                        ?>
                        <div class="row">
                            <div class="col-md-3 border-right">
                                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                                    <img class="rounded-circle mt-5" width="150px" src="https://icon-library.com/images/user-icon-jpg/user-icon-jpg-5.jpg">
                                    <span class="font-weight-bold mt-2"><?php echo $row['nama'] ?></span>
                                    <button type="button" class="btn btn-primary pull-right mt-4" data-toggle="modal" data-target="#EditProfile<?php echo $row['id_nasabah']; ?>">EDIT</button>
                                </div>
                            </div>
                            <div class="p-3 py-5">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="text-right">Profile Nasabah</h4>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12"><label class="labels">Nama Nasabah</label><input type="text" class="form-control" value="<?php echo $row['nama'] ?>" readonly></div>
                                    <div class="col-md-12"><label class="labels">No Telepon</label><input type="text" class="form-control" value="<?php echo $row['no_telepon'] ?>" readonly></div>
                                    <div class="col-md-12"><label class="labels">Alamat</label><input type="text" class="form-control" value="<?php echo $row['alamat'] ?>" readonly></div>
                                </div>
                            </div>
                        </div>

                        <!-- MODAL edit profile -->
                        <div id="EditProfile<?php echo $row['id_nasabah']; ?>" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Edit Profile</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <form action="proses-editprofile.php" method="get" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <input type="hidden" name="id_nasabah" class="form-control" id="id_nasabah" value="<?php echo $row['id_nasabah']; ?>"/>
                                            <div class="form-group">
                                                <label class="control-label" for="nama">Nama : </label>
                                                <input type="text" name="nama" class="form-control" id="nama" value="<?php echo $row['nama'] ?>" required/>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label" for="no_telepon">No Handphone : </label>
                                                <input type="number" name="no_telepon" class="form-control" id="no_telepon" value="<?php echo $row['no_telepon'] ?>" required/>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label" for="alamat">Alamat : </label>
                                                <input type="text" name="alamat" class="form-control" id="alamat" value="<?php echo $row['alamat'] ?>" required/>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label" for="password">Password: </label>
                                                <input type="text" name="password" class="form-control" id="password" value="<?php echo $row['password'] ?>" required/>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="submit" value="Simpan" name="Simpan" class="btn btn-success"/>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php
                        
                            }else{
                                echo "<p class='lead'><em>No records were found.</em></p>";
                            }
                        }else{
                            echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
                        }
                        ?>
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

    <!-- Page level plugins -->
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/datatables-demo.js"></script>

</body>

</html>