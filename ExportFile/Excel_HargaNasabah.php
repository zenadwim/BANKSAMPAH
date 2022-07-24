<!DOCTYPE html>
<html>
<head>
	<title>Export Data Ke Excel</title>
</head>
<body>

	<?php
	// koneksi database
	require_once "../config.php";
	$from_date = $_GET['from_date'];  
	$to_date = $_GET['to_date'];
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=Data Harga Nasabah.xls");
	?>

	<center>
		<h1>DATA HARGA UNTUK NASABAH </h1>
		<h2>mulai <?php echo $from_date; ?> sampai <?php echo $to_date; ?></h2>
	</center>

	<table id="cetak" border="1">
        <thead>
            <tr>
				<th>No. </th>
                <th>ID Harga Nasabah </th>
                <th>ID Sampah</th>
                <th>Harga Lama</th>
                <th>Harga Baru</th>
                <th>Tanggal</th>
                <th>Admin</th>
            </tr>
        </thead>
        <tbody>
        <?php
 
		// menampilkan data harga Nasabah
		$data = mysqli_query($db,"SELECT * FROM harga_nasabah INNER JOIN admin ON harga_nasabah.id_admin=admin.id_admin where tanggal BETWEEN '".$from_date."' AND '".$to_date."';");
		$no = 1;
		while($d = mysqli_fetch_array($data)){
            $cr_date=date_create($d['tanggal']);
			$for_date=strftime('%e-%B-%Y', $cr_date->getTimestamp());
		?>
		<tr>
			<td><?php echo $no++; ?></td>
			<td><?php echo $d['id_hrgnasabah']; ?></td>
			<td><?php echo $d['id_sampah']; ?></td>
			<td><?php echo $d['harga_lama']; ?></td>
			<td><?php echo $d['harga_baru']; ?></td>
            <td><?php echo $for_date; ?></td>
            <td><?php echo $d['nama']; ?></td>
		</tr>
		<?php 
		}
		?>
        
	</table>
</body>
</html>