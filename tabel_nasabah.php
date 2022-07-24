<?php
session_start();

//cek apakah user sudah login
if(!isset($_SESSION['id_admin'])){
die("Anda belum login");//jika belum login jangan lanjut..
}

require_once "config.php";
// $query = mysqli_query($db, "SELECT max(id_nasabah) as idTerbesar FROM nasabah");
// 	$data = mysqli_fetch_array($query);
// 	$idnasabah = $data['idTerbesar'];
 
// 	$urutan = (int) substr($idnasabah, 3, 3);
 
// 	$urutan++;
 
// 	$huruf = "a";
// 	$idnasabah = $huruf . sprintf("%03s", $urutan);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin | Tabel Nasabah</title>
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
    
    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

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
                    <h1 class="h3 mb-4 text-gray-800" align="center">Informasi Nasabah</h1>

                    <div id="tambahNasabah" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Tambah Nasabah</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <form action="proses-buatnasabah.php" method="post" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <!-- <div class="form-group">
                                            <label class="control-label" for="id_nasabah">ID Nasabah : </label>
                                            <input type="text" name="id_nasabah" class="form-control" id="id_nasabah" value="<?php echo $idnasabah ?>" required/>
                                        </div> -->
                                        <div class="form-group">
                                            <label class="control-label" for="nama">Nama: </label>
                                            <input type="text" name="nama" class="form-control" id="nama" required/>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="no_telepon">No Handphone: </label>
                                            <input type="number" name="no_telepon" class="form-control" id="no_telepon" required/>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="alamat">Alamat: </label>
                                            <input type="text" name="alamat" class="form-control" id="alamat" required/>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="password">Password: </label>
                                            <input type="text" name="password" class="form-control" id="password" value="12345" required/>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="reset" class="btn btn-danger">Reset</button>
                                        <input type="submit" value="Input" name="Input" class="btn btn-success"/>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- DataTables Nasabah -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between">
                            <h4 class="m-0 font-weight-bold text-primary">Data Nasabah</h4>
                            <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#tambahNasabah">Tambah</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>ID</th>
                                            <th>Nama</th>
                                            <th>No Handphone</th>
                                            <th>Alamat</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Include config file
                                        require_once "config.php";

                                        // Attempt select query execution
                                        $sql = "SELECT * FROM nasabah";
                                        if($result = mysqli_query($db, $sql)){
                                            if(mysqli_num_rows($result) > 0){
                                                $no=0;
                                                while($row = mysqli_fetch_array($result)){
                                                    $no++;
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $no; ?></td>
                                                        <td><?php echo $row['id_nasabah']; ?></td>
                                                        <td><?php echo $row['nama']; ?></td>
                                                        <td><?php echo $row['no_telepon']; ?></td>
                                                        <td><?php echo $row['alamat']; ?></td>
                                                        <td class='d-flex justify-content-around'>
                                                            <a href="#" data-toggle="modal" data-target="#editModal<?php echo $row['id_nasabah']; ?>"><span class='fas fa-pencil-alt'></span></a>
                                                            <a href="#" data-toggle="modal" data-target="#deleteModal<?php echo $row['id_nasabah']; ?>"><span class='fas fa-trash-alt'></span></a>
                                                        </td>  
                                                    </tr>

                                                    <!-- MODAL edit nasabah -->
                                                    <div id="editModal<?php echo $row['id_nasabah']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title" id="exampleModalLabel">Ubah Nasabah</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                </div>
                                                                <form action="ubah_nasabah.php" method="get">
                                                                    <?php
                                                                    include 'config.php';
                                                                    $id_nasabah = $row['id_nasabah'];
                                                                    $query_edit  = mysqli_query($db, "select * from nasabah where id_nasabah='$id_nasabah'");
                                                                    while($data = mysqli_fetch_array($query_edit)){
                                                                    ?>
                                                                    <div class="modal-body">
                                                                        <input type="hidden" name="id_nasabah" id="id_nasabah" value="<?php echo $data['id_nasabah']; ?>"/>
                                                                        <div class="form-group">
                                                                            <label class="control-label" for="nama">Nama : </label>
                                                                            <input type="text" name="nama" class="form-control" id="nama" value="<?php echo $data['nama']; ?>"/>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="control-label" for="no_telepon">No Handphone : </label>
                                                                            <input type="number" name="no_telepon" class="form-control" id="no_telepon" value="<?php echo $data['no_telepon']; ?>"/>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="control-label" for="alamat">Alamat : </label>
                                                                            <input type="text" name="alamat" class="form-control" id="alamat" value="<?php echo $data['alamat']; ?>"/>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="control-label" for="password">Password: </label>
                                                                            <input type="text" name="password" class="form-control" id="password" value="<?php echo $data['password']; ?>"/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <input type="submit" value="Simpan" name="Simpan" class="btn btn-success"/>
                                                                    </div>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- MODAL delete nasabah -->
                                                    <div id="deleteModal<?php echo $row['id_nasabah']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title" id="exampleModalLabel">Hapus Nasabah</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                </div>
                                                                <form action="hapus_nasabah.php" method="get">
                                                                    <?php
                                                                    include 'config.php';
                                                                    $id_nasabah = $row['id_nasabah'];
                                                                    $query_delete  = mysqli_query($db, "select * from nasabah where id_nasabah='$id_nasabah'");
                                                                    while($data = mysqli_fetch_array($query_delete)){
                                                                    ?>
                                                                    <div class="modal-body">
                                                                        <input type="hidden" name="id_nasabah" id="id_nasabah" value="<?php echo $data['id_nasabah']; ?>"/>
                                                                        <p> Apakah kamu yakin ingin menghapus data ini ??</p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <input type="submit" value="Ya" name="HapusData" class="btn btn-primary"/>
                                                                    </div>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                                // Free result set
                                                mysqli_free_result($result);
                                            } else{
                                                echo "<tr>  
                                                            <td colspan='6'><p style='color:red'>Tidak ada data yang ditemukan.</p></td>  
                                                    </tr>";
                                            }
                                        } else{
                                            echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
                                        }
                                        // Close connection
                                        mysqli_close($db);
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

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

</body>