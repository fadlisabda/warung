<?php
require_once __DIR__ . '/vendor/autoload.php';
require 'functions.php';
$isi=data("SELECT * FROM data");
$mpdf = new \Mpdf\Mpdf();
$html='<!DOCTYPE html>
<html>
<head>
	<title>Daftar Pemesanan Makanan Warung</title>
	<link rel="stylesheet" href="css/print.css">
</head>
<body>
	<h1 class="header1">Daftar Pemesanan Makanan Warung</h1>
	<table border="1" cellpadding="10" cellspacing="0">
		<thead>
			<tr>
				<th>ID Pelanggan</th>
				<th>Email Pelanggan</th>
				<th>No Tlp</th>
				<th>Detail Makanan</th>
				<th>Jumlah</th>
				<th>Alamat</th>
				<th>Gambar Makanan</th>
			</tr>
		</thead>';
		$i=1;
		foreach ($isi as $tampilkan) {
			$str="{$tampilkan["alamat"]}";
			$html.='
			<tbody>
				<tr>
					<td>'.$i.'</td>
					<td>'.$tampilkan["email"].'</td>
					<td>'.$tampilkan["no"].'</td>
					<td>'.$tampilkan["detail"].'</td>
					<td>'.$tampilkan["jumlah"].'</td>
					<td>'.wordwrap($str,20,"<br>",TRUE).'</td>
					<td><img src="gambar/'.$tampilkan["gambar"].'" width="50"></td>
				</tr>
			</tbody>	
			';
		$i++;
		}
$html.='</table>	
</body>
</html>';
$mpdf->WriteHTML($html);
$mpdf->Output('Daftar-Pemesanan-Makanan-Warung.pdf',\Mpdf\Output\Destination::INLINE);
?>

