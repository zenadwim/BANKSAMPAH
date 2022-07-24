<?php
	include('config.php');

    $data = json_decode(file_get_contents('php://input'), true);


    $rowData = array();
    $rowData['data'] = 0;

    $query = "SELECT * FROM sampah WHERE id_sampah=? and id_kategori=?";
	$dewan1 = $db->prepare($query);
    $dewan1->bind_param("ss", $data['sampah'], $data['kategori']);
	$dewan1->execute();
	$res1 = $dewan1->get_result();
	$row = $res1->fetch_assoc();
    
    if(isset($row['harga_nasabah']))
    {
        $rowData['data'] = $row['harga_nasabah'];
    }

    echo json_encode($rowData);
?>