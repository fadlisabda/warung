<?php 
	$conn=mysqli_connect("localhost","root","","warung");
	function data($query){
		global $conn;
		$result=mysqli_query($conn,$query);
		$arr=[];
		while ($row=mysqli_fetch_assoc($result)) {
			$arr[]=$row;
		}
		return $arr;
	}

	function tambah($post){
		global $conn;
		$email=htmlspecialchars($post["email"]);
		$no=htmlspecialchars($post["no"]);
		$makanan=$post["makanan"];
		$jumlah=$post["jumlah"];
		$alamat=htmlspecialchars($post["alamat"]);
		$gambar=upload();
		if (!$gambar) {
			return false;
		}
		$query="INSERT INTO data VALUES('','$email','$no','$makanan','$jumlah','$alamat','$gambar')";
		mysqli_query($conn,$query);
		return mysqli_affected_rows($conn);
	}

	function upload(){
		$name=$_FILES["gambar"]["name"];
		$tmp_name=$_FILES["gambar"]["tmp_name"];
		$error=$_FILES["gambar"]["error"];
		$size=$_FILES["gambar"]["size"];
		if ($error===4) {
			echo "
				<script>
					alert('pilih gambar terlebih dahulu');
				</script>
			";
			return false;
		}	
		$ekstensi1=["jpg","jpeg","png"];
		$ekstensi2=pathinfo(strtolower($name),PATHINFO_EXTENSION);	
		if (!in_array($ekstensi2, $ekstensi1)) {
			echo "
				<script>
					alert('yang anda upload bukan gambar');
				</script>
			";
			return false;
		}
		if ($size>=1000000) {
			echo "
				<script>
					alert('ukuran gambar maksimal 1mb');
				</script>
			";
			return false;
		}

		$namaBaru=uniqid();
		$namaBaru.='.';
		$namaBaru.=$ekstensi2;
		move_uploaded_file($tmp_name, 'gambar/'.$namaBaru);
		return $namaBaru;
	}

	function hapus($id){
		global $conn;
		mysqli_query($conn,"DELETE FROM data WHERE id='$id'");
		return mysqli_affected_rows($conn);
	}

	function ubah($post){
		global $conn;
		$id=$post["id"];
		$email=htmlspecialchars($post["email"]);
		$no=htmlspecialchars($post["no"]);
		$makanan=$post["makanan"];
		$jumlah=$post["jumlah"];
		$alamat=htmlspecialchars($post["alamat"]);
		$gambarlama=htmlspecialchars($post["gambarlama"]);
		if ($_FILES["gambar"]["error"]===4) {
			$gambar=$gambarlama;
		}
		else{
			$gambar=upload();	
		}
		$query="UPDATE data SET email='$email',no='$no',detail='$makanan',jumlah='$jumlah',alamat='$alamat',gambar='$gambar' WHERE id=$id";
		mysqli_query($conn,$query);
		return mysqli_affected_rows($conn);
	}

	function register($post){
		global $conn;
		$email=strtolower(stripslashes($post["email"]));
		$password1=mysqli_real_escape_string($conn,$post["password1"]);
		$password2=mysqli_real_escape_string($conn,$post["password2"]);
		$result=mysqli_query($conn,"SELECT email FROM user WHERE email='$email'");
		if (mysqli_fetch_assoc($result)) {
			echo "
				<script>
					alert('email sudah terdaftar');
				</script>
			";
			return false;
		}
		if ($password1!=$password2) {
			echo "
				<script>
					alert('konfirmasi password tidak sesuai');
				</script>
			";
			return false;
		}
		$password=password_hash($password1, PASSWORD_DEFAULT);
		mysqli_query($conn,"INSERT INTO user VALUES('','$email','$password')");
		return mysqli_affected_rows($conn);
	}
 ?>