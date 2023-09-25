<?php
include('../Configurasi/koneksi.php');
session_start();
if (isset($_POST['btn_publish'])) {
    $judul = $koneksi->real_escape_string($_POST['judul']);
    $kategori = $_POST['kategori'];
    $isi_berita = $_POST['isi_berita'];
    $tgl_posting = date('Y-m-d H:i:s');
    $id_user = $_SESSION['id_user'];

    if($judul !== '' && $isi_berita != ''){
        if (isset($_FILES["cover"]["name"])) {

            $name = $_FILES["cover"]["name"];
            $x = explode('.', $nama);
            $tmp_name = $_FILES['cover']['tmp_name'];
            $error = $_FILES['cover']['error'];
        
            if (!empty($name)) {
                $location = '../assets/images/';
                if  (move_uploaded_file($tmp_name, $location.$name)){
                    echo 'Uploaded';
                }
                mysqli_query($koneksi, "INSERT into berita values ('', '$judul', '$kategori', '$name', '$isi_berita', '$tgl_posting', '$id_user', '0')");
                echo "<script>alert('Yey! Berita Berhasil dipublikasi'); window.location = 'berita.php'</script>";                    
        
            } else {
                echo "<script>alert('Silahkan masukkan gambar terlebih dahulu!'); window.location = 'TambahBerita.php'</script>";
            }
        }  
    }
    else{
        echo "<script>alert('Upload berita gagal, mohon periksa lagi berita Anda!'); window.location = 'TambahBerita.php'</script>";
    }

}
?>