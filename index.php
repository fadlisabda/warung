<?php 
	require 'functions.php';
	session_start();
	if (!isset($_SESSION["login"])) {
		header('Location:login.php');
		exit;
	}
	$jumlahDataPerHalaman=3;
	$jumlahData=count(data("SELECT * FROM data"));
	$jumlahHalaman=ceil($jumlahData/$jumlahDataPerHalaman);
	$halamanAktif=(isset($_GET["halaman"])) ? $_GET["halaman"] : 1; 
	$awalData=$jumlahDataPerHalaman*$halamanAktif-$jumlahDataPerHalaman;
	$isi=data("SELECT * FROM data ORDER BY id ASC LIMIT $awalData,$jumlahDataPerHalaman");
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Halaman Admin</title>
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<script src="js/jquery-3.5.1.min.js"></script>
	<script src="js/script.js"></script>
</head>
<body>
	<div class="container">
	<h1 class="header1">Daftar Pemesanan Makanan Warung</h1>
	<button class="tambah"><a href="tambah.php">Tambah Data Pesanan</a></button> <a href="cetak.php" target="_blank" class="cetak">Cetak</a>
	<form action="" method="get">
		<input type="text" name="cari" placeholder="masukkan data yang ingin dicari.." size="50" autocomplete="off" id="cari">
		<button type="submit" id="submit">Cari</button>	
		<img src="gambar/loader.gif" class="loader">
	</form>
	<div class="link">
	<?php if ($halamanAktif>1): ?>
		<a href="?halaman=<?= (isset($_GET["cari"])) ? ($halamanAktif-1).'&'.'cari='.$_GET["cari"] : ($halamanAktif-1); ?>">&laquo;</a>
	<?php endif; ?>

	<?php for ($i=1; $i <=$jumlahHalaman ; $i++) : ?>
		<?php if ($i==$halamanAktif): ?>
			<a href="?halaman=<?= (isset($_GET["cari"])) ? $i.'&'.'cari='.$_GET["cari"] : $i; ?>" style="font-weight: bold; color: red;"><?= $i; ?></a>	
		<?php else : ?>
			<a href="?halaman=<?= (isset($_GET["cari"])) ? $i.'&'.'cari='.$_GET["cari"] : $i;  ?>"><?= $i; ?></a>
		<?php endif; ?>
	<?php endfor; ?>

	<?php if ($halamanAktif<$jumlahHalaman): ?>
		<a href="?halaman=<?= (isset($_GET["cari"])) ? ($halamanAktif+1).'&'.'cari='.$_GET["cari"] : ($halamanAktif+1); ?>">&raquo;</a>
	<?php endif; ?>
	</div>
	<div class="table">
	<table cellspacing="0" cellpadding="10">
		<thead>
			<tr>
				<th>Urutan Pelanggan</th>
				<th>Email Pelanggan</th>
				<th>No Tlp</th>
				<th>Detail Makanan</th>
				<th>Jumlah</th>
				<th>Alamat</th>
				<th>Gambar Makanan</th>
				<th class="aksi">Tombol</th>
			</tr>
		</thead>
		<tbody>
			<?php $i=1+$awalData; ?>
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
					<td>
						<div class="tes2">
							<button class="ubah"><a href="ubah.php?id=<?= $tampilkan["id"]; ?>">ubah</a></button> 
						</div>

						<div class="tes3">
							<button class="hapus"><a href="hapus.php?id=<?= $tampilkan["id"]; ?>" onclick="return confirm('anda yakin ingin menghapus data ini ?');">hapus</a> </button>
						</div>
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
	</div> 
	<button class="logout"><a href="logout.php" class="logout">Logout</a></button>
	</div>
</body>
</html>