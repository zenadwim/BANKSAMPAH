<?php
    if(isset($_POST["from_date"], $_POST["to_date"])){
        $id_nasabah=$_POST["id_nasabah"];
        require_once "config.php";
        setlocale(LC_ALL, 'id-ID', 'id_ID');
        $output = '';  
        $query = "SELECT setoran.id_setor , setoran.tgl_setor,setoran.id_nasabah,setoran.id_admin, admin.nama,SUM(detil_setor.harga_nasabah) as harga FROM setoran RIGHT JOIN detil_setor ON setoran.id_setor = detil_setor.id_setor RIGHT JOIN admin ON setoran.id_admin = admin.id_admin  where id_nasabah='$id_nasabah' AND tgl_setor BETWEEN '".$_POST["from_date"]."' AND '".$_POST["to_date"]."' GROUP BY setoran.id_setor ORDER BY tgl_setor desc;";

        $result = mysqli_query($db, $query);  
            if(mysqli_num_rows($result) > 0)  
            {  
                $no=0;
                while($row = mysqli_fetch_array($result))  
                {  
                    $cr_date=date_create($row['tgl_setor']);
                    $for_date=strftime('%e-%B-%Y', $cr_date->getTimestamp());
                    $no++;
                    $output .= '  
                            <tr>  
                            <td>' . $row["id_setor"] . '</td>
                            <td>' . $for_date . '</td>
                            <td>' . $row["nama"] . '</td>
                            <td>' . $row["harga"] . '</td>
                            <td><a href="ds.php?id_setor='.$row["id_setor"].'" >Detil</a></td>
                            </tr>  
                    ';  
                }  
            } else{
                $output .= '  
                            <tr>  
                                    <td colspan="7" style="color:red">Tidak ada data yang ditemukan.</td>  
                            </tr>  
                        '; 
            }    
            echo $output;  
    }
?>