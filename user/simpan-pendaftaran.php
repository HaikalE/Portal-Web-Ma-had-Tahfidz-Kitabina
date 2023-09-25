<?php
//Include file koneksi ke database
include "../Configurasi/koneksi.php";

//menerima nilai dari kiriman form pendaftaran
$username=$_POST["username"];
$nama=$_POST["nama"];
$email=$_POST["email"];
$password=md5($_POST["password"]); //untuk password digunakan enskripsi md5
$cpass =md5($_POST["cpass"]);
$level = 'member';

$cek_user=mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM user WHERE username='$_POST[username]'"));
if ($cek_user > 0) {
	 echo '<script language="javascript">
            alert ("Username Sudah Ada Yang Menggunakan!");
            window.location="register.php";
            </script>';
            exit();
}
else{
	$sql="INSERT INTO user (username,nama,email,password,level) values
	('$username','$nama','$email','$password', '$level')";

	$hasil=mysqli_query($koneksi,$sql);

	if ($hasil) {
		header("location: login.php");
		exit;
	}
	else {
		echo "Gagal simpan data anggota";
		exit;
	}
 

}
?>