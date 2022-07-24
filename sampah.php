<?php
session_start();

//cek apakah user sudah login
if(!isset($_SESSION['id_admin'])){
die("Anda belum login");//jika belum login jangan lanjut..
}
require_once "config.php";

// $query = mysqli_query($db, "SELECT max(id_sampah) as idTerbesar FROM sampah");
// 	$data = mysqli_fetch_array($query);
// 	$idsampah = $data['idTerbesar'];
 
// 	$urutan = (int) substr($idsampah, 3, 3);
 
// 	$urutan++;
 
// 	$huruf = "SMP";
// 	$idsampah = $huruf . sprintf("%03s", $urutan);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin | Tabel Sampah</title>
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
                    <h1 class="h3 mb-4 text-gray-800" align="center">Informasi Sampah</h1>

                    <!-- Modal Buat Sampah -->
                    <div id="tambahSampah" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Buat Sampah</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <form action="proses-buatsampah.php" method="post" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <!-- <div class="form-group">
                                            <label class="control-label" for="id_sampah">ID Sampah: </label>
                                            <input type="text" name="id_sampah" class="form-control" id="id_sampah" value="<?php echo $idsampah ?>" required/>
                                        </div> -->
                                        <div class="form-group">
                                            <label class="control-label" for="nama_sampah">Nama Sampah: </label>
                                            <input type="text" name="nama_sampah" class="form-control" id="nama_sampah" required/>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="id_kategori">ID Kategori: </label>
                                            <select name="id_kategori" id="id_kategori" class="form-control">
                                            <option disabled selected> Pilih </option>
                                                <?php 
                                                $sql = "SELECT * FROM kategori";
                                                if($result = mysqli_query($db, $sql)){
                                                while ($data=mysqli_fetch_array($result)) {
                                                ?>
                                                <option value="<?=$data['id_kategori']?>"><?=$data['deskripsi']?></option> 
                                                <?php
                                                }}
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="satuan">Satuan: </label>
                                            <select name="satuan" class="form-control" id="satuan"/>
                                                <option disabled selected> Pilih </option>
                                                <option value='KG'>KG</option>
                                                <option value='Liter'>Liter</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="harga_pengepul">Harga Pengepul: </label>
                                            <input type="number" name="harga_pengepul" class="form-control" id="harga_pengepul" required/>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="harga_nasabah">Harga Nasabah: </label>
                                            <input type="number" name="harga_nasabah" class="form-control" id="harga_nasabah" required/>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="tanggal">Tanggal: </label>
                                            <input type="date" name="tanggal" class="form-control" id="tanggal" value="<?php echo date('Y-m-d'); ?>" required/>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="id_admin">ID Admin: </label>
                                            <input type="text" name="id_admin" class="form-control" id="id_admin" value="<?php echo $_SESSION['id_admin'] ?>" readonly/>
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

                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between">
                            <h4 class="m-0 font-weight-bold text-primary">Data Sampah</h4>
                            <div>
                                <input type="button" name="exportPDF" id="exportPDF" value="Print Harga Terbaru" class="btn btn-primary"/>
                                <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#tambahSampah">Tambah</button>
                            </div>
                            
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <?php
                            // Include config file
                            require_once "config.php";

                            // Attempt select query execution
                            $sql = "SELECT * FROM sampah INNER JOIN kategori ON sampah.id_kategori=kategori.id_kategori ORDER BY kategori.id_kategori;";
                            if($result = mysqli_query($db, $sql)){
                                if(mysqli_num_rows($result) > 0){
                                    echo "<table class='table table-bordered table-striped' id='dataTable' width='100%' cellspacing='0'>";
                                        echo "<thead>";
                                            echo "<tr>";
                                                echo "<th>No</th>";
                                                echo "<th>ID Sampah</th>";
                                                echo "<th>Kategori</th>";
                                                echo "<th>Nama Sampah</th>";
                                                echo "<th>Satuan</th>";
                                                echo "<th>Harga Pengepul</th>";
                                                echo "<th>Harga Nasabah</th>";
                                                echo "<th>Opsi</th>";
                                            echo "</tr>";
                                        echo "</thead>";
                                        echo "<tbody>";
                                        $no=0;
                                        while($row = mysqli_fetch_array($result)){
                                            $no++;
                                            ?>
                                            <tr>
                                                <td><?php echo $no?></td>
                                                <td><?php echo $row['id_sampah']?></td>
                                                <td><?php echo $row['deskripsi']?></td>
                                                <td><?php echo $row['nama_sampah']?></td>
                                                <td><?php echo $row['satuan']?></td>
                                                <td><?php echo $row['harga_pengepul']?></td>
                                                <td><?php echo $row['harga_nasabah']?></td>
                                                <td class='d-flex justify-content-around'>
                                                    <div class="dropdown">
                                                        <a href="#" class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class='fas fa-pencil-alt'></span></a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="border: 3px outset blue; background-color: lightblue;">
                                                            <a style="text-align: center;" class="dropdown-item" href="#" data-toggle="modal" data-target="#editSampahModal<?php echo $row['id_sampah']; ?>">Edit Sampah</a>
                                                            <a style="text-align: center;" class="dropdown-item" href="#" data-toggle="modal" data-target="#editHrgPengepulModal<?php echo $row['id_sampah']; ?>">Edit Harga Pengepul</a>
                                                            <a style="text-align: center;" class="dropdown-item" href="#" data-toggle="modal" data-target="#editHrgNasabahModal<?php echo $row['id_sampah']; ?>">Edit Harga Nasabah</a>
                                                        </div>
                                                    </div>
                                                    <a href="#" data-toggle="modal" data-target="#deleteModal<?php echo $row['id_sampah']; ?>"><span class='fas fa-trash-alt'></span></a>
                                                </td>
                                            </tr>

                                            <!-- MODAL edit Sampah -->
                                            <div id="editSampahModal<?php echo $row['id_sampah']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="exampleModalLabel">Ubah Sampah</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        </div>
                                                        <form action="ubah_sampah.php" method="get">
                                                            <?php
                                                            include 'config.php';
                                                            $id_sampah = $row['id_sampah'];
                                                            $query_edit  = mysqli_query($db, "select * from sampah where id_sampah='$id_sampah'");
                                                            while($data = mysqli_fetch_array($query_edit)){
                                                            ?>
                                                            <div class="modal-body">
                                                                <input type="hidden" name="id_sampah" id="id_sampah" value="<?php echo $data['id_sampah']; ?>"/>
                                                                <div class="form-group">
                                                                    <label class="control-label" for="nama_sampah">Nama Sampah : </label>
                                                                    <input type="text" name="nama_sampah" class="form-control" id="nama_sampah" value="<?php echo $data['nama_sampah']; ?>" required/>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label" for="satuan">Satuan: </label>
                                                                    <select name="satuan" class="form-control" id="satuan"/>
                                                                        <option disabled selected> Pilih </option>
                                                                        <option value='KG'>KG</option>
                                                                        <option value='Liter'>Liter</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <input type="submit" value="Simpan" name="simpan" class="btn btn-success"/>
                                                            </div>
                                                            <?php
                                                            }
                                                            ?>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- MODAL edit Harga Sampah (Pengepul) -->
                                            <div id="editHrgPengepulModal<?php echo $row['id_sampah']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="exampleModalLabel">Ubah Harga Sampah (Pengepul)</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        </div>
                                                        <form action="ubah_hargaPengepul.php" method="get">
                                                            <?php
                                                            include 'config.php';
                                                            $id_sampah = $row['id_sampah'];
                                                            $query_edit  = mysqli_query($db, "select * from sampah where id_sampah='$id_sampah'");
                                                            while($data = mysqli_fetch_array($query_edit)){
                                                            ?>
                                                            <div class="modal-body">
                                                                <input type="hidden" name="id_sampah" id="id_sampah" value="<?php echo $data['id_sampah']; ?>"/>
                                                                <input type="hidden" name="harga_pengepul_lama" value="<?php echo $data['harga_pengepul'] ?>" />
                                                                <input type="hidden" name="id_admin" value="<?php echo $_SESSION['id_admin']; ?>" />
                                                                <div class="form-group">
                                                                    <label class="control-label" for="harga_pengepul">harga : </label>
                                                                    <input type="text" name="harga_pengepul" class="form-control" id="harga_pengepul" value="<?php echo $data['harga_pengepul']; ?>" required/>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label" for="tanggal">tanggal : </label>
                                                                    <input type="date" name="tanggal" class="form-control" id="tanggal" value="<?php echo date('Y-m-d'); ?>"/>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label" for="id_admin">admin yang mengubah : </label>
                                                                    <input type="text" name="id_admin" class="form-control" id="id_admin" value="<?php echo $_SESSION['id_admin']; ?>" disabled/>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <input type="submit" value="Simpan" name="simpan" class="btn btn-success"/>
                                                            </div>
                                                            <?php
                                                            }
                                                            ?>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- MODAL edit Harga Sampah (Nasabah) -->
                                            <div id="editHrgNasabahModal<?php echo $row['id_sampah']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="exampleModalLabel">Ubah Harga Sampah (Nasabah)</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        </div>
                                                        <form action="ubah_hargaNasabah.php" method="get">
                                                            <?php
                                                            include 'config.php';
                                                            $id_sampah = $row['id_sampah'];
                                                            $query_edit  = mysqli_query($db, "select * from sampah where id_sampah='$id_sampah'");
                                                            while($data = mysqli_fetch_array($query_edit)){
                                                            ?>
                                                            <div class="modal-body">
                                                                <input type="hidden" name="id_sampah" id="id_sampah" value="<?php echo $data['id_sampah']; ?>"/>
                                                                <input type="hidden" name="harga_nasabah_lama" value="<?php echo $data['harga_nasabah'] ?>" />
                                                                <input type="hidden" name="id_admin" value="<?php echo $_SESSION['id_admin']; ?>" />
                                                                <div class="form-group">
                                                                    <label class="control-label" for="harga_nasabah">harga : </label>
                                                                    <input type="text" name="harga_nasabah" class="form-control" id="harga_nasabah" value="<?php echo $data['harga_nasabah']; ?>" required/>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label" for="tanggal">tanggal : </label>
                                                                    <input type="date" name="tanggal" class="form-control" id="tanggal" value="<?php echo date('Y-m-d'); ?>"/>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label" for="id_admin">admin yang mengubah : </label>
                                                                    <input type="text" name="id_admin" class="form-control" id="id_admin" value="<?php echo $_SESSION['id_admin']; ?>" disabled/>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <input type="submit" value="Simpan" name="simpan" class="btn btn-success"/>
                                                            </div>
                                                            <?php
                                                            }
                                                            ?>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- MODAL delete sampah -->
                                            <div id="deleteModal<?php echo $row['id_sampah']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="exampleModalLabel">Hapus Sampah</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        </div>
                                                        <form action="hapus_sampah.php" method="get">
                                                            <?php
                                                            include 'config.php';
                                                            $id_nasabah = $row['id_sampah'];
                                                            $query_delete  = mysqli_query($db, "select * from sampah where id_sampah='$id_sampah'");
                                                            while($data = mysqli_fetch_array($query_delete)){
                                                            ?>
                                                            <div class="modal-body">
                                                                <input type="hidden" name="id_sampah" id="id_sampah" value="<?php echo $data['id_sampah']; ?>"/>
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
                                        echo "</tbody>";
                                    echo "</table>";
                                    // Free result set
                                    mysqli_free_result($result);
                                } else{
                                    echo "<tr>  
                                                <td colspan='7'><p style='color:red'>Tidak ada data yang ditemukan.</p></td>  
                                        </tr>";
                                }
                            } else{
                                echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
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
    
    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
    <script>
          $(document).ready(function(){  
            

            
            
            $('#exportPDF').click(function(){ 
                
                    window.location.assign("ExportFile/PDF_HargaTerbaru.php");
                
            });

            
        });
    </script>

</body>