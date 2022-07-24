<?php
session_start();

//cek apakah user sudah login
if(!isset($_SESSION['id_admin'])){
die("Anda belum login");//jika belum login jangan lanjut..
}
?>

<?php
include 'config.php';
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
                    <h1 class="h3 mb-2 text-gray-800" align="center">Nasabah Setor Sampah</h1>

                    <div class="card shadow mb-4">
                        <div class="card-body">
                        <form name="setor" id="setor">
                        <div class="table-responsive" style="margin-top:30px;">
                            <table>
                                <tr>
                                    <td>ID Nasabah</td>
                                    <td>: <input type="text" name="id_nasabah" id="id_nasabah"/></td>
                                    <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-item">Pilih</button></td>
                                </tr>
                                <tr>
                                    <td>Nama Nasabah</td>
                                    <td>: <input type="text" name="nama" id="nama"/></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Saldo</td>
                                    <td>: <input type="text" name="saldo" id="saldo"/></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Setor</td>
                                    <td>: <input type="text" name="tgl_setor" id="tgl_setor"/></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    
                                    <td style="display:none">: <input type="text" name="id_admin" id="id_admin" value="<?php echo $_SESSION['id_admin'] ?>"/></td>
                                    <td></td>
                                </tr>
                            </table>
                        </div>
                        <div class="table-responsive" style="margin-top:30px">
                        <?php
                            // Include config file
                            require_once "config.php";

                            $i=0;
                            $sql = "SELECT * FROM sampah INNER JOIN kategori ON sampah.id_kategori=kategori.id_kategori ORDER BY nama_sampah ASC;";
                            if($result = mysqli_query($db, $sql)){
                            if(mysqli_num_rows($result) > 0){
                                
                                echo "<table class='table table-bordered' id='dynamic_field'>";
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
                                    echo "<td style='display: none;'><input type='text' name='sampah' class='form-control' value=". $row['id_sampah'] ."  /></td>";
                                    ?>
                                    <td><input type='text' name='nama_sampah' class='form-control' value="<?php echo $row["nama_sampah"]; ?>"  readonly/></td>
                                    
                                    <?php
                                    
                                    echo "<td style='display: none;'><input type='text' name='harga_nasabah' class='form-control' value=". $row['harga_nasabah'] ."  /></td>";
                                    echo "<td style='display: none;'><input type='text' name='harga_pengepul' class='form-control' value=". $row['harga_pengepul'] ."  /></td>";
                                    echo "<td><input type='number' name='jumlah' class='form-control' value='0'/></td>";
                                    echo "<td style='display: none;'><input type='number' name='jumlah2' class='form-control' value='0'/></td>";
                                    echo "<td style='display: none;'><input type='text' name='hrg_nasabah' class='form-control' value='0'/></td>";
                                    echo "<td style='display: none;'><input type='text' name='hrg_pengepul' class='form-control' value='0'/></td>";
                                    
                                    echo"<td><select name='satuan' class='form-control'>";
                                    if ($row['satuan']=='KG'){
                                    echo "<option value='KG' selected>KG</option>
                                    <option value='Gram'>Gram</option>
                                    <option value='Ons'>Ons</option>";
                                    }else if ($row['satuan']=='Liter'){
                                    echo "<option value='Liter'>Liter</option>";
                                    }
                                    echo "</select></td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";
                                echo "</table>";
                                // Free result set
                                mysqli_free_result($result);
                                } else{
                                        echo "<p class='lead'><em>No records were found.</em></p>";
                                }
                            } else{
                            echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
                            }

                            // Close connection
                            mysqli_close($db);
                            ?>
                                
                            <input type="button" name="submit" id="submit" class="btn btn-info" value="Submit" />
                        </div>
                        </form>
                    </div>


                    <div class="modal  fade" id="modal-item">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Pilih Penabung</h4>
                                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    
                                </div>
                                <div>
                                    <input id="myInput" type="text" placeholder="Search.."
                                        style="
                                        margin-top: 20px;
                                        margin-left: 18px;
                                        border: 1px solid grey;
                                        border-radius: 5px;
                                        height: 35px;
                                        padding: 2px 23px 2px 30px;
                                        outline: 0;
                                        background-color: #98AFC7;"
                                    >
                                </div>
                                <div class="modal-body table-responsive">
                                    
                                    <table class="table table-bordered table-striped" id="table1">
                                        <thead>
                                            <tr>
                                                <th>id nasabah</th>
                                                <th>nama</th>
                                                <th>Saldo</th>
                                                <th>Opsi</th>
                                            </tr>
                                        </thead>

                                        <?php
                                        $connect = new PDO("mysql:host=180.235.148.89; dbname=ublmobil_bank_sampah", "ublmobil", "d8yNDY&kwIDL");
                                        $query = "SELECT * FROM nasabah INNER JOIN tabungan ON nasabah.id_nasabah = tabungan.id_nasabah";
                                        
                                        $statement = $connect->prepare($query);
                                        $statement->execute();
                                        $total_data = $statement->rowCount();
                                        
                                        $result = $statement->fetchAll();
                                        ?>
                                        <tbody id="myTable">
                                            <?php foreach ($result as $dt) : ?>                                            
                                                <tr role="row" class="odd" >
                                                    <td><?= $dt['id_nasabah']; ?></td>
                                                    <td><?= $dt['nama']; ?></td>
                                                    <td><?= $dt['saldo']; ?></td>
                                                    <td>
                                                        <button id="pilihMuzakki" type="button" data-id="<?= $dt['id_nasabah']; ?>" data-nama="<?= $dt['nama']; ?>" data-saldo="<?= $dt['saldo']; ?>"  class="btnSelectMuzakki btn btn-primary btn-sm">Pilih</button>
                                                    </td>
                                                    
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
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
    
    <script>
        $(document).ready(function() {
            $(document).on('change', 'input[name="jumlah"]' , function() {
                //Get parent row
                var parent = $(this).parent().parent();
                //get row ID
                var id = $(parent).attr("id").replace("row-", "");
                //Get amount
                var jumlah = $(parent).find('input[name="jumlah"]').val();
                //
                var satuan = $(parent).find('select[name="satuan"]').val();
                if(satuan=="Gram"){
                var jumlah2 = $(parent).find('input[name="jumlah2"]');
                var jumlahtotal=jumlah/1000;
                $(jumlah2).val(jumlahtotal);
                }else if(satuan=="Ons"){
                var jumlah2 = $(parent).find('input[name="jumlah2"]');
                var jumlahtotal=jumlah/10;
                $(jumlah2).val(jumlahtotal);
                
                }else{
                var jumlah2 = $(parent).find('input[name="jumlah2"]');
                var jumlahtotal=jumlah;
                $(jumlah2).val(jumlahtotal);
                }
                
                //Get Price value
                var harga_nasabah = $(parent).find('input[name="harga_nasabah"]').val();
                var harga_pengepul = $(parent).find('input[name="harga_pengepul"]').val();
                //Calculate
                var credit = jumlahtotal * harga_nasabah;
                var credit2 = jumlahtotal * harga_pengepul;
                //Set into Total
                var hrg_nasabah = $(parent).find('input[name="hrg_nasabah"]');
                $(hrg_nasabah).val(credit);
                var hrg_pengepul = $(parent).find('input[name="hrg_pengepul"]');
                $(hrg_pengepul).val(credit2);
            });

            $(document).on('change', 'select[name="satuan"]' , function() {
                //Get parent row
                var parent = $(this).parent().parent();
                //get row ID
                var id = $(parent).attr("id").replace("row-", "");
                //Get amount
                var jumlah = $(parent).find('input[name="jumlah"]').val();
                //
                var satuan = $(parent).find('select[name="satuan"]').val();
                if(satuan=="Gram"){
                var jumlah2 = $(parent).find('input[name="jumlah2"]');
                var jumlahtotal=jumlah/1000;
                $(jumlah2).val(jumlahtotal);
                }else if(satuan=="Ons"){
                var jumlah2 = $(parent).find('input[name="jumlah2"]');
                var jumlahtotal=jumlah/10;
                $(jumlah2).val(jumlahtotal);
                
                }else{
                var jumlah2 = $(parent).find('input[name="jumlah2"]');
                var jumlahtotal=jumlah;
                $(jumlah2).val(jumlahtotal);
                }
                
                //Get Price value
                var harga_nasabah = $(parent).find('input[name="harga_nasabah"]').val();
                var harga_pengepul = $(parent).find('input[name="harga_pengepul"]').val();
                //Calculate
                var credit = jumlahtotal * harga_nasabah;
                var credit2 = jumlahtotal * harga_pengepul;
                //Set into Total
                var hrg_nasabah = $(parent).find('input[name="hrg_nasabah"]');
                $(hrg_nasabah).val(credit);
                var hrg_pengepul = $(parent).find('input[name="hrg_pengepul"]');
                $(hrg_pengepul).val(credit2);
            });

            
            $('#submit').click(function() {
                var id_nasabah=$('#id_nasabah').val();
                var tgl_setor = $('#tgl_setor').val();
                
                var test = tgl_setor.split("-");
                var hari2 = test[0];
                var bulan2 = test[1];
                var tahun2 = test[2];

                var ke = id_nasabah + test[2] + test[1] + test[0];
                var tgl = test[2] +"-"+ test[1] +"-"+ test[0];
                var json = Object();

                var rowData = [];
                json["id_setoran"] = ke;
                // json["tanggal_setor"] = $("#tgl_setor").val();
                json["tanggal_setor"] = tgl;
                json["id_nasabah"] = $("#id_nasabah").val();
                json["id_admin"] = $("#id_admin").val();
                json["saldo"] = $("#saldo").val();
                
                var row = $('#dynamic_field > tbody > tr');
                $.each(row, function(index, value) {  
                        
                        var id = $(value).attr("id").replace("row-", "");
                        var sampah = $(value).find('input[name="sampah"]').val();
                        var harga_nasabah = $(value).find('input[name="hrg_nasabah"]').val();
                        var harga_pengepul = $(value).find('input[name="hrg_pengepul"]').val();
                        var total = $(value).find('input[name="jumlah"]').val();
                        var data = {
                            id: id,
                            sampah: sampah,
                            harga_nasabah: harga_nasabah,
                            harga_pengepul: harga_pengepul,
                            total: total
                        };
                        rowData.push(data);
                });
                json["data"] = rowData;

                console.log(JSON.stringify(json));
                
                $.ajax({  
                    url:"proses_setor.php",  
                    method:"POST",  
                    data:JSON.stringify(json),  
                    success:function(data)  
                    {  
                        alert(data);  
                        // window.location.assign("tabel_penabung.php")
                        window.location.assign("ds.php?id_setor="+ke); 
                    }  
                });
            });
        });
    </script>
    <script>
        $(document).ready(function(){  
            $('.btnSelectMuzakki').click(function() {
                console.log('hello pilih')
                    var id = $(this).data('id');
                    var nama = $(this).data('nama');
                    var saldo = $(this).data('saldo');
                    
                    $('#id_nasabah').val(id);
                    $('#nama').val(nama);
                    $('#saldo').val(saldo);
                    $('#modal-item').modal('toggle');
            });
            
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });

            $('#tgl_setor').datepicker({ dateFormat: 'dd-mm-yy',changeMonth: true,changeYear: true }); // format to show
            $('#tgl_setor').datepicker('setDate', 'today');
            
            $(document).on('change', 'input[name="jumlah"]', function() {
                var id_nasabah=$('#id_nasabah').val();
                var tgl_setor = $('#tgl_setor').val();
                    
                    var test = tgl_setor.split("-");
                    var hari2= test[0];
                    var bulan2= test[1];
                    var tahun2= test[2];
                    var ke=id_nasabah+test[2] + test[1] + test[0];
                $('#id_setoran').val(ke);
            });
        });
    </script>
</body>