<?php 
	require 'functions.php';
	session_start();
	if (!isset($_SESSION["login"])) {
		header('Location:login.php');
		exit;
	}
	$id=$_GET["id"];
	$isi=data("SELECT * FROM data WHERE id='$id'")[0];
	if (isset($_POST["ubah"])) {
		if (ubah($_POST)>0) {
			echo "
				<script>
					alert('data berhasil diubah');
					document.location.href='index.php';
				</script>
			";
		}
		else{
			echo "
				<script>
					alert('data gagal diubah');
					document.location.href='index.php';
				</script>
			";
		}
	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Ubah Data Pesanan</title>
	<link rel="stylesheet" type="text/css" href="css/ubah.css">
</head>
<body>
	<div class="container">
	<h1 class="header1">Ubah Data Pesanan</h1>
	<form action="" method="post" enctype="multipart/form-data">
	<table>
		<input type="hidden" name="id" value="<?= $isi["id"]; ?>">
		<input type="text" name="gambarlama" value="<?= $isi["gambar"]; ?>">
		<tr>
			<td>
				<label for="email">Email: </label>
			</td>
			<td>
				<input type="email" name="email" id="email" value="<?= $isi["email"]; ?>">	
			</td>
		</tr>
		<tr>
			<td>
				<label for="no">No Telepon : </label>	
			</td>
			<td>
				<input type="number" name="no" id="no" value="<?= $isi["no"]; ?>">	
			</td>
		</tr>
		<tr>
			<td>
				<label for="makanan">Pilih Makanan : </label>	
			</td>
			<td>
				<select name="makanan" id="makanan">
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
				<label for="jumlah">Jumlah : </label>
			</td>
			<td>
				<input type="number" name="jumlah" id="jumlah" value="<?= $isi["jumlah"]; ?>">
			</td>
		</tr>	
		<tr>
			<td>
				<label for="alamat">Alamat Lengkap : </label>
			</td>
			<td>
				<textarea name="alamat" id="alamat" class="area" cols="43" rows="3"><?= $isi["alamat"]; ?></textarea>
			</td>
		</tr>	
		<tr>
			<td>
				<label for="lama">Gambar Lama : </label>
			</td>
			<td>
				<img src="gambar/<?= $isi["gambar"]; ?>" width="50">
			</td>
		</tr>
		<tr>
			<td>
				<label for="gambar">Contoh Gambar Makanan : </label>
			</td>
			<td>
				<input type="file" name="gambar" id="gambar">
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<button type="submit" name="ubah" class="button">Ubah Pesanan</button>
				<button class="button2">
					<a href="index.php">Kembali</a>
				</button>	
			</td>
		</tr>
	</table>
	</form>
	</div>
</body>
</html>