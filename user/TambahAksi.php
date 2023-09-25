<?php 
// koneksi database
include "../Configurasi/koneksi.php";
 
// menangkap data yang di kirim dari form
$username = $_POST['username'];
$password = md5($_POST['password']);
$email = $_POST['email'];
$nama = $_POST['nama'];
$level = 'admin';


//Query input menginput data kedalam tabel anggota
$sql="INSERT INTO user (username,password,email,nama,level) values
('$username','$password','$email','$nama', '$level')";

//Mengeksekusi/menjalankan query diatas	
$hasil=mysqli_query($koneksi,$sql);
 
// mengalihkan halaman kembali ke index.php
header("location:crud.php");
 
?>