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
    require_once "../config.php";
    setlocale(LC_ALL, 'id-ID', 'id_ID');
      $output = '';  
      $query = "  
      SELECT setoran.id_setor , setoran.tgl_setor,setoran.id_nasabah,setoran.id_admin, admin.nama,SUM(detil_setor.harga_nasabah) as harga FROM setoran RIGHT JOIN detil_setor ON setoran.id_setor = detil_setor.id_setor RIGHT JOIN admin ON setoran.id_admin = admin.id_admin  where id_nasabah='$id_nasabah' AND tgl_setor BETWEEN '".$_POST["from_date"]."' AND '".$_POST["to_date"]."' GROUP BY setoran.id_setor ORDER BY tgl_setor desc  
      ";  
      $result = mysqli_query($db, $query);  
      $output .= '  
           <table class="table table-bordered">  
                 <tr>  
                               <th>ID</th>  
                               <th >tanggal setor</th>  
                               <th>Admin</th>
                               <th>Setor</th>
                               <th>Aksi</th>  

                          </tr>  
      ';  
      if(mysqli_num_rows($result) > 0)  
      {  
           while($row = mysqli_fetch_array($result))  
           {  
               $cr_date=date_create($row['tgl_setor']);
                         
               $for_date=strftime('%B-%Y', $cr_date->getTimestamp());
                $output .= '  
                     <tr>  
                          <td>'. $row["id_setor"] .'</td>  
                          <td>'. $for_date .'</td>  
                          <td>'. $row["nama"] .'</td>
                          <td>'. $row["harga"] .'</td>  
                          <td><a href="detil_setor.php?id_setor='.$row['id_setor'].'" >Detil</a></td>
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