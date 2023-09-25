<?php 
include '../Configurasi/koneksi.php';
session_start();
$_SESSION['username'];
$_SESSION['id_user'];
$_SESSION['login'];
session_unset();
session_destroy();
header("Location:login.php?pesan=logout");
?>