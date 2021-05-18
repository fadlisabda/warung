<?php 
	require 'functions.php';
	session_start();
	if (!isset($_SESSION["login"])) {
		header('Location:login.php');
		exit;
	}
	if (isset($_POST["tambah"])) {
		if (tambah($_POST)>0) {
			echo "
				<script>
					alert('data berhasil ditambahkan');
					document.location.href='index.php';
				</script>
			";
		}
		else{
			echo "
				<script>
					alert('data gagal ditambahkan');
					document.location.href='index.php';
				</script>
			";
		}
	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Tambah Data Pesanan</title>
	<link rel="stylesheet" type="text/css" href="css/tambah.css">
</head>
<body>
	<div class="container">
	<h1 class="header1">Tambah Data Pesanan</h1>
	<form action="" method="post" enctype="multipart/form-data">
	<table>
		<tr>
			<td>
				<label for="email">Email </label>
			</td>
			<td>
				<input type="email" name="email" id="email" required size="40" autocomplete="off" autofocus>	
			</td>
		</tr>
		<tr>
			<td>
				<label for="no">No Telepon </label>	
			</td>
			<td>
				<input type="number" name="no" id="no" required autocomplete="off" size="40">	
			</td>
		</tr>
		<tr>
			<td>
				<label for="makanan">Pilih Makanan </label>	
			</td>
			<td>
				<select name="makanan" id="makanan" required>
					<option>Nasi Goreng Rp 10.000</option>
					<option>Mie Goreng Rp 10.000</option>
					<option>Mie Rebus Rp 10.000</option>
					<option>Sambal Ikan Rp 10.000</option>
					<option>Sambal Ayam Rp 10.000</option>
					<option>Telur Dadar Rp 5.000</option>
				</select>	
			</td>
		</tr>
		<tr>
			<td>
				<label for="jumlah">Jumlah </label>
			</td>
			<td>
				<input type="number" name="jumlah" id="jumlah" required class="jumlah">
			</td>
		</tr>	
		<tr>
			<td>
				<label for="alamat">Alamat Lengkap </label>
			</td>
			<td>
				<textarea name="alamat" id="alamat" required cols="44" rows="5" class="area"></textarea>
			</td>
		</tr>	
		<tr>
			<td>
				<label for="gambar">Contoh Gambar Makanan </label>
			</td>
			<td>
				<input type="file" name="gambar" id="gambar" class="upload">
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<button type="submit" name="tambah" class="button">Tambah Pesanan</button>
				<button type="button" class="button2">
					<a href="index.php">Kembali</a>
				</button>
			</td>
		</tr>
	</table>
	</form>
	</div>
</body>
</html>