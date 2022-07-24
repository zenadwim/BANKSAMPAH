<?php
session_start();

//cek apakah user sudah login
if(!isset($_SESSION['id_nasabah'])){
die("Anda belum login");//jika belum login jangan lanjut..
}


?>
<?php  
 //filter.php  
 if(isset($_POST["from_date"], $_POST["to_date"]))  
 {  
     $id_nasabah= $_SESSION['id_nasabah'];
    require_once "config.php";
    setlocale(LC_ALL, 'id-ID', 'id_ID');
      $output = '';  
      $query = "  
      SELECT pengajuan.id_pengajuan , pengajuan.tanggal_pengajuan,pengajuan.id_nasabah,pengajuan.id_admin, pengajuan.status,pengajuan.jumlah , admin.nama FROM pengajuan LEFT JOIN admin ON pengajuan.id_admin = admin.id_admin where id_nasabah='$id_nasabah' AND tanggal_pengajuan BETWEEN '".$_POST["from_date"]."' AND '".$_POST["to_date"]."' GROUP BY pengajuan.id_pengajuan ORDER BY tanggal_pengajuan desc  
      ";  
      $result = mysqli_query($db, $query);  
      $output .= '  
           <table class="table table-bordered">  
                 <tr>  
                               <th>ID</th>  
                               <th >tanggal</th>  
                               <th>Admin</th>
                               <th>Jumlah</th>
                               <th>Status</th>
                                 

                          </tr>  
      ';  
      if(mysqli_num_rows($result) > 0)  
      {  
           while($row = mysqli_fetch_array($result))  
           {  
               $cr_date=date_create($row['tanggal_pengajuan']);
                         
               $for_date=strftime('%d-%B-%Y', $cr_date->getTimestamp());
                $output .= '  
                     <tr>  
                          <td>'. $row["id_pengajuan"] .'</td>  
                          <td>'. $for_date .'</td>  
                          <td>'. $row["nama"] .'</td> 
                          <td>'. $row["jumlah"] .'</td> 
                          <td>'. $row["status"] .'</td>  
                          
                     </tr>  
                ';  
           }  
      }  
      else  
      {  
           $output .= '  
                <tr>  
                     <td colspan="5">No Order Found</td>  
                </tr>  
           ';  
      }  
      $output .= '</table>';  
      echo $output;  
 }  
 ?>