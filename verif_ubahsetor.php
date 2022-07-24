<?php
session_start();

//cek apakah user sudah login
if(!isset($_SESSION['id_admin'])){
die("Anda belum login");//jika belum login jangan lanjut..
}
?>

<?php
include 'config.php';
$tanggal = $_GET['from_date'];
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin | Setor Sampah</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>  
          
        <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>  
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">  
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
                    <h1 class="h3 mb-2 text-gray-800" align="center">Ubah Setoran Menjadi Harga Terbaru</h1>

                    <div class="mb-4" align="center">
                        <form name="setor" id="setor">
                        <div class="table-responsive" style="margin-top:30px;">
                            <table>
                                
                                
                               
                                
                                
                            </table>
                        </div>
                        <div class="table-responsive" style="margin-top:30px">
                        <?php
                            // Include config file
                            require_once "config.php";

                            $i=0;
                            $sql = "select setoran.id_setor,setoran.tgl_setor,setoran.id_nasabah, setoran.id_admin, detil_setor.id_setor, detil_setor.id_sampah,detil_setor.total,detil_setor.harga_nasabah,detil_setor.harga_pengepul,sampah.id_sampah,sampah.harga_nasabah AS hn,sampah.harga_pengepul AS hp FROM setoran INNER JOIN detil_setor ON setoran.id_setor =detil_setor.id_setor INNER JOIN sampah ON detil_setor.id_sampah =sampah.id_sampah where tgl_setor='$tanggal'";
                            if($result = mysqli_query($db, $sql)){
                            if(mysqli_num_rows($result) > 0){
                                echo "Apakah yakin ingin Mengubah Semua Data Setoran di tanggal ".$tanggal." menjadi harga yang terbaru ? <br/>";
                                echo "<table class='table table-bordered' id='dynamic_field' style='display: none;'>";
                                echo "<thead>";
                                        echo "<tr>";
                                            echo "<th>Nama Sampah</th>";
                                            echo "<th>Bobot</th>";
                                            echo "<th>Satuan</th>";
                                        echo "</tr>";
                                echo "</thead>";  
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                        $i++;
                                        echo "<tr id='row-$i'>";
                                        echo "<td><input type='text' name='id_setor' class='form-control' value=". $row['id_setor'] ."  /></td>";
                                        echo "<td><input type='text' name='id_nasabah' class='form-control' value=". $row['id_nasabah'] ."  /></td>";
                                        echo "<td><input type='text' name='tgl_setor' class='form-control' value=". $row['tgl_setor'] ." readonly /></td>";
                                        echo "<td><input type='text' name='id_sampah' class='form-control' value=". $row['id_sampah'] ." /></td>";
                                        $jumlah=$row['total'];
                                        echo "<td><input type='text' name='total' class='form-control' value=". $row['total'] ." /></td>";
                                        echo "<td><input type='text' name='harga_nasabah' class='form-control' value=". $row['harga_nasabah'] ." /></td>";
                                        echo "<td><input type='text' name='harga_pengepul' class='form-control' value=". $row['harga_pengepul'] ." /></td>";
                                        $thp=$row['hp'];
                                        $thn=$row['hn'];
                                        $totalhp=$jumlah * $thp;
                                        $totalhn=$jumlah * $thn;
                                        echo "<td><input type='text' name='hn' class='form-control' value=". $totalhn ." /></td>";
                                        echo "<td><input type='text' name='hp' class='form-control' value=". $totalhp ." /></td>";                                       
                                        echo "</tr>";
                                }
                                echo "</tbody>";
                                echo "</table>";
                                // Free result set
                                mysqli_free_result($result);
                                ?>
                                <input type="button" name="submit" id="submit" class="btn btn-info" value="Ubah" />
                                <input type="button" name="batal" id="batal" class="btn btn-danger" value="Batal" />
                                <?php
                                } else{
                                        echo "<p class='lead'><em>Tidak ditemukan data Pada tanggal ".$tanggal." </em></p>";
                                        echo "<input type='button' name='batal' id='batal' class='btn btn-danger' value='Kembali' />";
                                }
                            } else{
                            echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
                            }

                            // Close connection
                            mysqli_close($db);
                            ?>
                                
                            
                        </div>
                        </form>
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
        $(document).ready(function() {
            

            
            $('#submit').click(function() {
                
                
                
                var json = Object();

                var rowData = [];

                json["tanggal"] = $("#tanggal").val();
                
                var row = $('#dynamic_field > tbody > tr');
                $.each(row, function(index, value) {  
                        
                        var id = $(value).attr("id").replace("row-", "");
                        var id_setor = $(value).find('input[name="id_setor"]').val();
                        var id_nasabah = $(value).find('input[name="id_nasabah"]').val();
                        var id_sampah = $(value).find('input[name="id_sampah"]').val();
                        var total = $(value).find('input[name="total"]').val();
                        var harga_nasabah = $(value).find('input[name="harga_nasabah"]').val();
                        var harga_pengepul = $(value).find('input[name="harga_pengepul"]').val();
                        var hn = $(value).find('input[name="hn"]').val();
                        var hp = $(value).find('input[name="hp"]').val();
                        var data = {
                            id: id,
                            id_setor: id_setor,
                            id_nasabah: id_nasabah,
                            id_sampah: id_sampah,
                            total: total,
                            harga_nasabah: harga_nasabah,
                            harga_pengepul: harga_pengepul,
                            hn: hn,
                            hp: hp
                        };
                        rowData.push(data);
                });
                json["data"] = rowData;

                console.log(JSON.stringify(json));
                
                $.ajax({  
                    url:"proses_ubahsetor.php",  
                    method:"POST",  
                    data:JSON.stringify(json),  
                    success:function(data)  
                    {  
                        alert(data);  
                        
                        window.location.assign("test.php"); 
                    }  
                });
            });
        });
    </script>
    <script>  
        $(document).ready(function(){  
            $('#batal').click(function(){ 
                window.location.href = "ubah_setor.php"; 
            });
        });  
     </script>
    
</body>