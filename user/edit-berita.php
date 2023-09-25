<?php 
include ('../Configurasi/koneksi.php');
include 'header.php';

$ambil_kategori = 'SELECT kategori.id_kategori, kategori.kategori FROM kategori ORDER BY kategori ASC';

$qry_kat = $koneksi -> query($ambil_kategori) or die($koneksi ->error);

$ambil_berita = "SELECT berita.judul, berita.id_kategori, berita.gambar, berita.isi_berita FROM berita WHERE berita.id_berita='$_GET[id]'";

$qry_berita = $koneksi -> query($ambil_berita) or die($koneksi->error);

$data = $qry_berita -> fetch_assoc();

?>

<?php include 'body.php'; ?>

<?php

$var_judul = isset($_POST['judul']) ? $_POST['judul']:$data['judul'];
$var_kategori = isset($_POST['kategori']) ? $_POST['kategori']:$data['id_kategori'];
$var_isiberita = isset($_POST['isi_berita']) ? $_POST['isi_berita']:$data['isi_berita'];


if (isset($_POST['btn_edit'])) {
    $judul = $koneksi->real_escape_string($_POST['judul']);
    $kategori = $_POST['kategori'];
    $isi_berita = $_POST['isi_berita'];
    $tgl_posting = date('Y-m-d H:i:s');

    if($judul !== '' && $isi_berita != ''){
        if (isset($_FILES["cover"]["name"])) {

            $name = $_FILES["cover"]["name"];
            $tmp_name = $_FILES['cover']['tmp_name'];
            $error = $_FILES['cover']['error'];
        
            if (!empty($name)) {
                $location = '../assets/images/';
        
                if  (move_uploaded_file($tmp_name, $location.$name)){
                    echo 'Uploaded';
                }
        
            } else {
                echo 'please choose a file';
            }
        }  
    	$insert_sql = "UPDATE berita SET judul = '$judul', id_kategori ='$kategori', gambar = '$name', isi_berita = '$isi_berita' WHERE id_berita = '$_GET[id]'";
    	$insert_qry = $koneksi->query($insert_sql) or die ($koneksi->error);

    	echo "<script>alert('Berita Berhasil Diperbarui'); window.location = 'berita.php'</script>";
    }

    else{
        echo "<script>alert('Berita gagal diperbaharui!'); window.location = 'edit-berita.php'</script>";
    }

}

?>

<!---Berita-->
<div class="container">
          <h2><i class="fa fa-edit">Edit Berita</i></h2>
          <hr>
          <form action="" method="POST" enctype="multipart/form-data">
              <div class="row">
                  <div class="col-sm-8">
                      <div class="form-group">
                          <input type="text" class="form-control" name="judul" id="judul" placeholder="Judul Berita" value="<?php echo $var_judul; ?>">
                      </div>
                   </div>
                  <div class="col-sm-4">
                      <div class="form-group">
                          <input type="date" class="form-control" name="tgl_posting" value="<?php echo date('Y-m-d'); ?>"disabled>
                      </div>
                    </div>
                    <div class="col-sm-8">
                      <div class="form-group">
                        <textarea class="form-control input-sm" name="isi_berita" id="isiberita" rows="20"><?php echo $var_isiberita; ?></textarea>
                      </div>
                     </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Kategori</label>
                          <br>
                         <select class="form-control" name="kategori">
                             <option>Pilih Kategori</option> 
                             <?php
                             while($kat= $qry_kat->fetch_assoc()){?>
                                <?php if ($kat['id_kategori']==$var_kategori){ ?>
                                    <option value="<?php echo $kat['id_kategori'];?>" selected><?php echo $kat['kategori'];?></option>
                                        <?php }  ?>
                                     <?php } ?>    
                                </select>
                                 </div>
                      <div class="form-group">
                        <label>Cover Berita</label>
                        <input type="file" name="cover" id="gambar" onchange="return validasiFile()">
                              <label class="text-muted">Ukuran gambar maksimal 1 MB</label>
                              <br>
                              <label>Preview Gambar</label>
                              <div id="pratinjauGambar"></div>
                        </div>
                    </div>
                        <div class="col-sm-12">
                        <a href="berita.php" class="button" style="text-decoration: none;"><i class="far fa-hand-point-left"></i>&nbsp;Back</a>
                         <button type="submit" class="btn btn-outline-info" name="btn_edit"><i class="fas fa-save">&nbsp;Simpan</i></button>
                </div>
            </form>
        </div>
     </div>


  <script>
    CKEDITOR.replace('isiberita');
     </script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>

  <script>
    function validasiFile(){
    var inputFile = document.getElementById('gambar');
    var pathFile = inputFile.value;
    var ekstensiOk = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
    if(!ekstensiOk.exec(pathFile)){
      Swal.fire({
      title: 'Hanya menerima gambar berekstensi jpg/jpeg/png/gif',
      width: 600,
      padding: '3em',
      backdrop: `
        rgba(0,0,123,0.4)
        center top
        no-repeat
      `
        })
        inputFile.value = '';
        return false;
    }else{
        //Pratinjau gambar
        if (inputFile.files && inputFile.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('pratinjauGambar').innerHTML = '<img src="'+e.target.result+'" width="100%" height="250"/>';
            };
            reader.readAsDataURL(inputFile.files[0]);
        }
    }
}
  
</script>
<?php include 'footer.php' ?>

              




