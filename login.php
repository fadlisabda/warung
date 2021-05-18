<?php
	session_start();
	require 'functions.php'; 
	if (isset($_COOKIE['nomor'])&&isset($_COOKIE['key'])) {
		$nomor=$_COOKIE['nomor'];
		$key=$_COOKIE['key'];
		$result=mysqli_query($conn,"SELECT email FROM user WHERE id='$nomor'");
		$row=mysqli_fetch_assoc($result);
		if ($key===hash('sha256', $row["email"])) {
			$_SESSION['login']=true;
		}
	}
	if (isset($_SESSION['login'])) {
		header('Location:index.php');
		exit;
	}
	if (isset($_POST["login"])) {
		$email=$_POST["email"];
		$password=$_POST["password"];
		$result=mysqli_query($conn,"SELECT * FROM user WHERE email='$email'");
		if (mysqli_num_rows($result)===1) {
			$row=mysqli_fetch_assoc($result);
			if (password_verify($password, $row["password"])) {
				$_SESSION['login']=true;
				if (isset($_POST["remember"])) {
					setcookie('nomor',$row["id"],time()+60);
					setcookie('key',hash('sha256', $row["email"]),time()+60);
				}
				header('Location:index.php');
				exit;
			}
		}
		$error=true;
	}
	function hari_ini(){
	 $hari = date ("D");
	 
	 switch($hari){
		 case 'Sun':
		 $hari_ini = "Minggu";
		 break;
		 
		 case 'Mon': 
		 $hari_ini = "Senin";
		 break;
		 
		 case 'Tue':
		 $hari_ini = "Selasa";
		 break;
		 
		 case 'Wed':
		 $hari_ini = "Rabu";
		 break;
		 
		 case 'Thu':
		 $hari_ini = "Kamis";
		 break;
		 
		 case 'Fri':
		 $hari_ini = "Jumat";
		 break;
		 
		 case 'Sat':
		 $hari_ini = "Sabtu";
		 break;
		 
		 default:
		 $hari_ini = "Tidak di ketahui"; 
		 break;
 	}
 		return $hari_ini;
}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Login Akun</title>
	<link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
<div class="container">
	<div class="gambar1">
		<h1 class="header1">Login Akun</h1>
		<p class="date"><?= hari_ini().date(" d M Y"); ?></p>
		<?php if (isset($error)): ?>
			<p class="error">email / password salah</p>
		<?php endif; ?>
		<form action="" method="post">
			<table>
				<tr>
					<td>
						<label for="email">Email</label>
					</td>
					<td>
						<input type="email" name="email" id="email" autocomplete="off" size="40" required autofocus>
					</td>
				</tr>	
				<tr>
					<td>
						<label for="password">Password</label>
					</td>
					<td>
						<input type="password" name="password" id="password" size="40" required>
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center" >
						<input type="checkbox" name="remember" id="remember" class="remember">
						<label for="remember">Remember me</label>	
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center"> 
						<button type="submit" name="login" class="button">Login</button>
					</td>
				</tr>
			</table>	
		</form>
	</div>
	<div class="gambar2">
		<h1 class="header2">Register</h1>
		<p class="klik">Jika Anda Belum Punya Akun Silahkan Klik <a href="register.php?register=true" class="link">Register</a> </p>
	</div>
</div>
</body>
</html>