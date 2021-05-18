<?php 
	session_start();
	if (!isset($_GET["register"])) {
		header('Location:login.php');
	}
	require 'functions.php';
	if (isset($_POST["register"])) {
		if (register($_POST)>0) {
			echo "
				<script>
					alert('user baru berhasil ditambahkan');
					document.location.href='login.php';
				</script>
			";
		}
		else{
			echo mysqli_error($conn);
		}
	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Register Akun</title>
	<link rel="stylesheet" type="text/css" href="css/register.css">
</head>
<body>
<div class="container">
	<div class="information">
		<h1>INFORMATION</h1>
		<p class="p1">Jika Sudah Punya Akun Silahkan Klik <a href="login.php">Login</a></p>
	</div>
	<div class="register">
		<h1 class="header1">Register</h1>
		<form action="" method="post">
			<table>
				<tr>
					<td>
						<label for="email">Email </label>		
					</td>
					<td>
						<input type="email" name="email" id="email" required autocomplete="off" size="40" autofocus>
					</td>
				</tr>
				<tr>
					<td>
						<label for="password1">Password </label>
					</td>
					<td>
						<input type="password" name="password1" id="password1" size="40" required>
					</td>
				</tr>
				<tr>
					<td>
						<label for="password2">Konfirmasi Password </label>
					</td>
					<td>
						<input type="password" name="password2" id="password2" size="40" required>
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<button type="submit" name="register" class="button">Register</button>
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>
</body>
</html>