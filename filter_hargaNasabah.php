<?php
    if(isset($_POST["from_date"], $_POST["to_date"])){  
        require_once "config.php";
        setlocale(LC_ALL, 'id-ID', 'id_ID');
        $output = '';  
        $query = "SELECT * FROM harga_nasabah INNER JOIN admin ON harga_nasabah.id_admin=admin.id_admin where tanggal BETWEEN '".$_POST["from_date"]."' AND '".$_POST["to_date"]."';";
        $result = mysqli_query($db, $query);  
            if(mysqli_num_rows($result) > 0)  
            {  
                $no=0;
                while($row = mysqli_fetch_array($result))  
                {  
                    $cr_date=date_create($row['tanggal']);
                    $for_date=strftime('%e-%B-%Y', $cr_date->getTimestamp());
                    $no++;
                    $output .= '  
                            <tr>  
                            <td>' . $no . '</td>
                            <td>' . $row["id_hrgnasabah"] . '</td>
                            <td>' . $row["id_sampah"] . '</td>
                            <td>' . $row["harga_lama"] . '</td>
                            <td>' . $row["harga_baru"] . '</td>
                            <td>' . $for_date . '</td>
                            <td>' . $row["nama"] . '</td>
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