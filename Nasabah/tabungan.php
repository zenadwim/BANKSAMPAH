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

    <title>Nasabah | Tabungan</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>  
          
        <script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>  
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">  
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
                    <h1 class="h3 mb-2 text-gray-800" align="center">Informasi Rekening Anda</h1>
                    <div class="mb-4">
                    <?php
                    include '../config.php';
                    $id_nasabah= $_SESSION['id_nasabah'];
                    $rekening  = mysqli_query($db, "select * from tabungan where id_nasabah='$id_nasabah'");
                    $row        = mysqli_fetch_array($rekening);
                    ?>
                    <input type="hidden" value="<?php echo $row['saldo']; ?>" name="money" id="money" />
                    <p style="text-align: center;">Total Uang Direkening anda sebesar : <span id="formattedMoney"></span></p>
                    
                    <div>
                    <br/>
                    <div class="container" style="width:100%;"> 
                         <div class="d-flex justify-content-around"> 
                              <div class="col-md-8">
                                    <table>
                                        <tr>
                                        
                                        <td>  <input type="text" name="from_date" id="from_date" class="form-control"  />  </td>

                                        <td>  <input type="text" name="testin" id="testin" class="form-control"  />  </td>
                                        
                                        <td> <input type="button" name="filter" id="filter" value="Filter" class="btn btn-info" />  </td>
                                        <td> <input type="button" name="reset" id="reset" value="reset" class="btn btn-info" />  </td>
                                        
                                        <!--<td> <button type="button" id="generate_pdf" name="generate_pdf" class="btn btn-primary"><i class="fa fa-pdf" aria-hidden="true"></i>Generate PDF</button>  </td>-->
                                        
                                        </tr>
                                    </table>
                                </div>  
                              
                         </div> 
                    <div style="clear:both"></div>                 
                    <br />  
                    <div id="order_table">  
                     <table class="table table-bordered">  
                          <tr>  
                               <th>ID</th>  
                               <th >tanggal setor</th>  
                               <th>Admin</th>
                               <th>Setor</th>
                               <th>Aksi</th>  

                          </tr>  
                     <?php
                     setlocale(LC_ALL, 'id-ID', 'id_ID');
                     $query = "SELECT setoran.id_setor , setoran.tgl_setor,setoran.id_nasabah,setoran.id_admin, admin.nama,SUM(detil_setor.harga_nasabah) as harga FROM setoran RIGHT JOIN detil_setor ON setoran.id_setor = detil_setor.id_setor RIGHT JOIN admin ON setoran.id_admin = admin.id_admin  where id_nasabah='$id_nasabah' GROUP BY setoran.id_setor ORDER BY tgl_setor desc";  
                     $result = mysqli_query($db, $query);  
                     while($row = mysqli_fetch_array($result))  
                     {  
                         $cr_date=date_create($row['tgl_setor']);
                         
                         $for_date=strftime('%d-%B-%Y', $cr_date->getTimestamp());
                         
                     ?>  
                          <tr>
                                 
                               <td><?php echo $row["id_setor"]; ?></td>  
                               <td><?php echo $for_date; ?></td>  
                               <td><?php echo $row["nama"]; ?></td>
                               <td><?php echo $row["harga"]; ?></td>
                              <?php echo " <td><a href='detil_setor.php?id_setor=".$row['id_setor']."' >Detil</a></td>";?>   
                          </tr>  
                     <?php  
                     }  
                     ?>  
                     </table>  
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
          var calculation = document.getElementById('money').value;

          //1st way
          var moneyFormatter = new Intl.NumberFormat('id-ID', {
          style: 'currency',
          currency: 'IDR',
          minimumFractionDigits: 2
          });
          document.getElementById('formattedMoney').innerText = moneyFormatter.format(calculation);
     </script>

     <script>  
          $(document).ready(function(){  
               
                var d = new Date();
                var currMonth = d.getMonth();
                var currYear = d.getFullYear();
                var startDate = new Date(currYear, 0, 1);
                var lastDate=new Date(currYear, currMonth + 1,0);
                  

                $('#from_date').datepicker({ dateFormat: 'dd-mm-yy',changeMonth: true,changeYear: true }); // format to show
                $('#from_date').datepicker('setDate', startDate);
                
                // $('#dari').datepicker({ dateFormat: 'yy-mm-dd',changeMonth: true,changeYear: true }); // format to show
                // $('#dari').datepicker('setDate', baru);
                $('#testin').datepicker({ dateFormat: 'dd-mm-yy',changeMonth: true,changeYear: true }); // format to show
                $('#testin').datepicker('setDate', lastDate); 
                 
               $('#filter').click(function(){  
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
                    
                      
                    

                    //
                    var testin = $('#testin').val();
                    
                    var test = testin.split("-");
                    var hari2= test[0];
                    
                    var bulan2= test[1];
                    
                    var tahun2= test[2];
                    

                    var ke=test[2] + "-" + test[1]+ "-" + test[0];
                    
                    // var from_date2 = new Date($('#from_date').val());
                    // var hari = from_date2.getDate();
                    // var bulan = from_date2.getMonth();
                    // var tahun = from_date2.getFullYear();
                    // function pad(n) {
                    // return n<10 ? '0'+n : n;
                    // }
                    // var baru = tahun + "-" + pad(hari) + "-" + pad(bulan + 1);
                    // var dari = baru;
                    // console.log("dari2 = "+dari);
                      
                    
                    
                   
                      
                    if(dari != '' && ke != '')  
                    {  
                         $.ajax({  
                              url:"filter_tabungan.php",  
                              method:"POST",  
                              data:{from_date:dari, to_date:ke},  
                              success:function(data)  
                              {  
                                   $('#order_table').html(data);  
                              }  
                         });  
                    }  
                    else  
                    {  
                         alert("Please Select Date");  
                    }  
               });
               //tombol reset 
                $('#reset').click(function() {
                location.reload();
                });
                //tombol pdf
                $('#generate_pdf').click(function(){ 
                var from_date = $('#from_date').val();
        
                var testin = $('#testin').val();
               
                
                if(from_date != '' && testin != '')  
                {    
                    window.location.assign("generate_pdf.php?from_date="+from_date+"&testin="+testin);
                    
                }  
                else{  
                    alert("Please Select Date");  
                }  
            });

          });  
     </script>

</body>
</html>