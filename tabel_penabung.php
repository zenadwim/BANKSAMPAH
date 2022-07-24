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

    <title>Admin | Tabel Penabung</title>
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
                    
                    
                    
                            
                            
                        
                        <!--<div class="form-group">-->
                        <!--    <input type="text" name="search_box" id="search_box" class="form-control" placeholder="Type your search query here" />-->
                        <!--</div>-->
                        <!--<div class="table-responsive" id="dynamic_content">-->
                            
                        <!--</div>-->
                        
                        <!--test-->
                        <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between">
                            <h4 class="m-0 font-weight-bold text-primary">Data Penyetor/Penabung</h4>
                            
                            <input type="button" name="ubah_setor" id="ubah_setor" value="ubah setor" class="btn btn-success pull-right" />
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                    <th>id nasabah</th>
                                    <th>Nama</th>
                                    <th>No Telp</th>
                                    <th>Saldo</th>
                                    <th>Opsi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Include config file
                                        require_once "config.php";

                                        // Attempt select query execution
                                        $sql = "SELECT * FROM nasabah INNER JOIN tabungan ON nasabah.id_nasabah = tabungan.id_nasabah ORDER BY nasabah.id_nasabah ASC";
                                        if($result = mysqli_query($db, $sql)){
                                            if(mysqli_num_rows($result) > 0){
                                                $no=0;
                                                while($row = mysqli_fetch_array($result)){
                                                    $no++;
                                                    echo'
                                                    <tr>
                                                    <td>'.$row["id_nasabah"].'</td>
                                                    <td>'.$row["nama"].'</td>
                                                    <td>'.$row["no_telepon"].'</td>
                                                    <td>'.$row["saldo"].'</td>
                                                    <td>
                                                    <a href="info_penabung.php?id_nasabah='.$row["id_nasabah"].'" >Riwayat Setor</a>
                                                    </td>
                                                    </tr>';
                                                    ?>
                                                    


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

    <script>
        // $(document).ready(function(){

        //     load_data(1);

        //     function load_data(page, query = '')
        //     {
        //     $.ajax({
        //         url:"get_penabung.php",
        //         method:"POST",
        //         data:{page:page, query:query},
        //         success:function(data)
        //         {
        //         $('#dynamic_content').html(data);
        //         }
        //     });
        //     }

        //     $(document).on('click', '.page-link', function(){
        //     var page = $(this).data('page_number');
        //     var query = $('#search_box').val();
        //     load_data(page, query);
        //     });

        //     $('#search_box').keyup(function(){
        //     var query = $('#search_box').val();
        //     load_data(1, query);
        //     });

        // });
    </script>
    <script>  
        $(document).ready(function(){  
            $('#ubah_setor').click(function(){ 
                window.location.href = "ubah_setor.php"; 
            });
        });  
     </script>

</body>