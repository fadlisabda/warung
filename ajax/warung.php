<?php 
	usleep(500000);
	require '../functions.php';
	if (isset($_GET["cari"])) {
		$cari = $_GET["cari"];
		$query = "SELECT * FROM data
	            WHERE
	          email LIKE '%$cari%' OR
	          alamat LIKE '%$cari%' OR
	          no LIKE '%$cari%'
	        ";
		$isi = data($query);
	}
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 	<link rel="stylesheet" type="text/css" href="../css/index.css">
 </head>
 <body>
 	<table cellspacing="0" cellpadding="10">
		<thead>
			<tr>
				<th>ID Pelanggan</th>
				<th>Email Pelanggan</th>
				<th>No Tlp</th>
				<th>Detail Makanan</th>
				<th>Jumlah</th>
				<th>Alamat</th>
				<th>Gambar Makanan</th>
				<th class="aksi">Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php $i=1; ?>
			<?php foreach ($isi as $tampilkan): ?>
				<tr>
					<td>
						<?= $i; ?>
					</td>
					<td>
						<?= $tampilkan["email"]; ?>
					</td>
					<td>
						<?= $tampilkan["no"]; ?>
					</td>
					<td>
						<?= $tampilkan["detail"]; ?>
					</td>
					<td>
						<?= $tampilkan["jumlah"]; ?>
					</td>
					<td>
						<?php
						 	$str="{$tampilkan["alamat"]}";
							echo wordwrap($str,20,"<br>",TRUE); 
						?>
					</td>
					<td>
						<img src="gambar/<?= $tampilkan["gambar"]; ?>" width="50">
					</td>
					<td class="aksi">
						<button class="ubah"><a href="ubah.php?id=<?= $tampilkan["id"]; ?>">ubah</a></button> <button class="hapus"><a href="hapus.php?id=<?= $tampilkan["id"]; ?>" onclick="return confirm('anda yakin ingin menghapus data ini ?');">hapus</a></button> 
					</td>
				</tr>
				<?php $i++; ?>
			<?php endforeach; ?>
			<?php if (count($isi)===0): ?>
				<tr>
					<td colspan="8">
						<p align="center" style="font-weight: bold;">Data Tidak Ditemukan</p>
					</td>
				</tr>
			<?php endif; ?>
		</tbody>
	</table>
 </body>
 </html>
 