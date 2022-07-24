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

    <title>Admin | Detil Harga Nasabah</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>  
    <script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>  
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">  
    
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
                    <h1 class="h3 mb-2 text-gray-800" align="center">Detail Harga Nasabah</h1>
                    <div class="mb-4">
                        <br/>
                        <div class="d-flex justify-content-center"> 
                            <div class="col-md-8">
                                <table>
                                    <tr>
                                    <form class="form-inline" method="post" action="PDF_HargaNasabah.php">
                                    <td>  <input type="text" name="from_date" id="from_date" class="form-control"  />  </td>
                                    <td>  <input type="text" name="testin" id="testin" class="form-control"  />  </td>
                                    <td> <input type="button" name="filter" id="filter" value="Filter" class="btn btn-info" />  </td>
                                    <td> <input type="button" name="reset" id="reset" value="reset" class="btn btn-info" />  </td>
                                    <!-- <td> <input type="button" name="exportExcel" id="exportExcel" value="Export Excel" class="btn btn-success"/></td> -->
                                    <td> <input type="button" name="exportPDF" id="exportPDF" value="Export PDF" class="btn btn-primary"/></td>
                                    </form>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <br/>
                        <div class="card shadow mb-4">
                            <div class="card-header py-3 d-flex justify-content-between">
                                <h4 class="m-0 font-weight-bold text-primary">Data Harga Nasabah</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive" id='order_table'>
                                <?php
                                // Include config file
                                require_once "config.php";
                                setlocale(LC_ALL, 'id-ID', 'id_ID');
                                // Attempt select query execution
                                $sql = "SELECT * FROM harga_nasabah INNER JOIN admin ON harga_nasabah.id_admin=admin.id_admin INNER JOIN sampah ON harga_nasabah.id_sampah=sampah.id_sampah ORDER BY harga_nasabah.tanggal DESC;";
                                if($result = mysqli_query($db, $sql)){
                                    if(mysqli_num_rows($result) > 0){
                                        echo "<table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>";
                                            echo "<thead>";
                                                echo "<tr>";
                                                    echo "<th>No </th>";
                                                    echo "<th>ID Harga Nasabah </th>";
                                                    echo "<th>Sampah</th>";
                                                    echo "<th>Harga Lama</th>";
                                                    echo "<th>Harga Baru</th>";
                                                    echo "<th>Tanggal</th>";
                                                    echo "<th>Admin</th>";
                                                echo "</tr>";
                                            echo "</thead>";
                                            echo "<tbody id='myTable'>";
                                            $no=0;
                                            while($row = mysqli_fetch_array($result)){
                                                $cr_date=date_create($row['tanggal']);
                                                $for_date=strftime('%e-%B-%Y', $cr_date->getTimestamp());
                                                $no++;
                                                echo "<tr>";
                                                    echo "<td>" . $no . "</td>";
                                                    echo "<td>" . $row['id_hrgnasabah'] . "</td>";
                                                    echo "<td>" . $row['nama_sampah'] . "</td>";
                                                    echo "<td>" . $row['harga_lama'] . "</td>";
                                                    echo "<td>" . $row['harga_baru'] . "</td>";
                                                    echo "<td>" . $for_date . "</td>";
                                                    echo "<td>" . $row['nama'] . "</td>";
                                                    
                                                echo "</tr>";
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

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
    <script>  
        $(document).ready(function(){  
            var d = new Date();
            var currMonth = d.getMonth();
            var currYear = d.getFullYear();
            var startDate = new Date(currYear, 0, 1);
            var lastDate=new Date(currYear, currMonth + 1,0);
            
            $('#from_date').datepicker({ dateFormat: 'dd-mm-yy',changeMonth: true,changeYear: true }); // format to show
            $('#from_date').datepicker('setDate', startDate);
            $('#testin').datepicker({ dateFormat: 'dd-mm-yy',changeMonth: true,changeYear: true }); // format to show
            $('#testin').datepicker('setDate', lastDate); 
                
            $('#filter').click(function(){  
                // var from_date = $('#from_date').val();
                // var from_date2 = new Date(from_date);
                // var hari = from_date2.getDate();
                // var bulan = from_date2.getMonth();
                // var tahun = from_date2.getFullYear();
                // function pad(n) {
                //     return n<10 ? '0'+n : n;
                // }
                // var baru = tahun + "-" + pad(hari) + "-" + pad(bulan + 1);
                // var dari = baru;
                
                var ubahdate = $('#from_date').val();
                var ubah = ubahdate.split("-");
                var hari2= ubah[0];
                var bulan2= ubah[1];
                var tahun2= ubah[2];
                var dari=ubah[2] + "-" + ubah[1]+ "-" + ubah[0];
                
                var testin = $('#testin').val();
                var test = testin.split("-");
                var hari2= test[0];
                var bulan2= test[1];
                var tahun2= test[2];
                var ke=test[2] + "-" + test[1]+ "-" + test[0];
                
                if(dari != '' && ke != '')  
                {  
                    $.ajax({  
                        url:"filter_hargaNasabah.php",  
                        method:"POST",  
                        data:{from_date:dari, to_date:ke},  
                        success:function(data)  
                        {  
                            $('#myTable').html(data);  
                        }  
                    });  
                }  
                else{  
                    alert("Please Select Date");  
                }  
            });

            $('#exportExcel').click(function(){ 
                var from_date = $('#from_date').val();
                var from_date2 = new Date(from_date);
                var hari = from_date2.getDate();
                var bulan = from_date2.getMonth();
                var tahun = from_date2.getFullYear();
                function pad(n) {
                    return n<10 ? '0'+n : n;
                }
                var baru = tahun + "-" + pad(hari) + "-" + pad(bulan + 1);
                var dari = baru;
                var testin = $('#testin').val();
                var test = testin.split("-");
                var hari2= test[0];
                var bulan2= test[1];
                var tahun2= test[2];
                var ke=test[2] + "-" + test[1]+ "-" + test[0];
                
                if(dari != '' && ke != '')  
                {    
                    window.location.href = "ExportFile/Excel_HargaNasabah.php?from_date="+dari+"&to_date="+ke; 
                }  
                else{  
                    alert("Please Select Date");  
                }  
            });
            
            $('#exportPDF').click(function(){ 
                var from_date = $('#from_date').val();
                var testin = $('#testin').val();
                if(from_date != '' && testin != '')  
                {    
                    window.location.assign("ExportFile/PDF_HargaNasabah.php?from_date="+from_date+"&testin="+testin);
                }  
                else{  
                    alert("Please Select Date");  
                }
            });

            $('#reset').click(function() {
            location.reload();
            }); 
        });  
     </script>

</body>
</html>