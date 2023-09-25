<?php
include '../Configurasi/koneksi.php';

$id = $_GET['id'];

mysqli_query($koneksi, "DELETE FROM kategori where id_kategori='$id'");

header("location:kategori.php");

?>