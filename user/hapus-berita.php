<?php 
include ('../Configurasi/koneksi.php');

$pilih_berita = "SELECT berita.gambar FROM berita WHERE berita.id_berita='$_GET[id]'";

$koneksi_berita = $koneksi->query($pilih_berita) or die ($koneksi -> error);

$num = $koneksi_berita->num_rows;

$data = $koneksi_berita->fetch_assoc();

if ($num==0) {
	header('location:berita.php');
} else {
	$hapus_berita = "DELETE FROM berita WHERE berita.id_berita='$_GET[id]'";

	$hapus_qry = $koneksi->query($hapus_berita);

	if ($hapus_qry) {
		unlink('../images/'.$data['gambar']);
		echo "<script>alert('Berita berhasil dihapus!');window.location = 'berita.php'</script>";
	} else {
		echo $koneksi->error;
	}
}


?>