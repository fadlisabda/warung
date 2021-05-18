<?php 
	session_start();
	if (!isset($_SESSION["login"])) {
		header('Location:login.php');
		exit;
	}
	session_start();
	session_unset();
	$_SESSION=[];
	session_destroy();
	setcookie('nomor','',time()-3200);
	setcookie('key','',time()-3200);
	header('Location:login.php');
	exit;
 ?>