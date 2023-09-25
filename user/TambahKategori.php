<?php
include '../Configurasi/koneksi.php';

$kategori = $_POST['kategori'];

mysqli_query($koneksi, "INSERT into kategori values('', '$kategori')");

header("location: kategori.php");

?>