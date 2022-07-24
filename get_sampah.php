<?php
	include 'config.php';
	
	$data = json_decode(file_get_contents('php://input'), true);

	//echo "<option value='0'>Pilih barang</option>";

	$result = array();

	$row0 = array();
	$row0['id'] = 0;
	$row0['value'] = "Pilih Barang";

	array_push($result, $row0);

	$query = "SELECT * FROM sampah WHERE id_kategori=? ORDER BY nama_sampah ASC";
	$dewan1 = $db->prepare($query);
	$dewan1->bind_param("i", $data['kategori']);
	$dewan1->execute();
	$res1 = $dewan1->get_result();
	while ($row = $res1->fetch_assoc()) {
		$rowData = array();
		$rowData['id'] = $row['id_sampah'];
		$rowData['value'] = $row['nama_sampah'];
		array_push($result, $rowData);
	}

	echo json_encode($result);
