<?php
	include 'config.php';
 
	$result = array();

	$row0 = array();
	$row0['id'] = 0;
	$row0['value'] = "Pilih Kategori";
	
	array_push($result, $row0);
 
	$query = "SELECT * FROM kategori ORDER BY id_kategori ASC";
	$dewan1 = $db->prepare($query);
	$dewan1->execute();
	$res1 = $dewan1->get_result();
	while ($row = $res1->fetch_assoc()) {
		$rowData = array();
		$rowData['id'] = $row['id_kategori'];
		$rowData['value'] = $row['deskripsi'];
		array_push($result, $rowData);
	}

	echo json_encode($result);
