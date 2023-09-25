<?php
//Include file koneksi ke database
include "../Configurasi/koneksi.php";

//menerima nilai dari kiriman form pendaftaran

$email=$_POST["email"];
$password=md5($_POST["password"]); //untuk password digunakan enskripsi md5


//Query input menginput data kedalam tabel anggota

$data=mysqli_query($koneksi,"select * from user where email='$email'");
//Mengeksekusi/menjalankan query diatas	
 
  $cek = mysqli_num_rows($data);
//Kondisi apakah berhasil atau tidak

if($cek > 0){
	
$sql="UPDATE user SET password='$password' WHERE email='$email'";

$hasil=mysqli_query($koneksi,$sql);
header("location:login.php");
	exit;

}else{
	header("location:lupapassword.php?pesan=gagal");
}


?>
