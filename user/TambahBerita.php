<?php
include 'header.php';
include 'body.php';
$sql_kat = 'SELECT kategori.id_kategori, kategori.kategori FROM kategori ORDER BY kategori.kategori ASC';
$qry_kat = $koneksi->query($sql_kat) or die ($koneksi->error);
?>
<!---Berita-->
    <div class="container">
          <h3><i class="fas fa-file-medical"></i>&nbsp;Add News</h3>
          <hr>
          <form action="proses_tambahberita.php" method="POST" enctype="multipart/form-data">
              <div class="row">
                  <div class="col-sm-8">
                      <div class="form-group">
                          <input type="text" class="form-control" autocomplete="off" name="judul" id="judul" placeholder="News Title">
                      </div>
                   </div>
                  <div class="col-sm-4">
                      <div class="form-group">
                          <input type="date" class="form-control" name="tgl_posting" value="<?php echo date('Y-m-d'); ?>"disabled>
                      </div>
                    </div>
                    <div class="col-sm-8">
                      <div class="form-group">
                        <textarea class="form-control input-sm" name="isi_berita" id="isiberita" rows="20"></textarea>
                      </div>
                     </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Category</label>
                          <br>
                         <select class="form-control" name="kategori">
                             <option value="">Select Category</option> 
                             <?php
                             while($kat= $qry_kat->fetch_assoc()){?>
                             <option value="<?php echo $kat['id_kategori'];?>"><?php echo $kat['kategori'];?></option>
                            <?php } ?>    
                                </select>
                        </div>
                      <div class="form-group">
                        <label>News Cover</label>
                        <input type="file" name="cover" id="gambar" onchange="return validasiFile()">
                              <label class="text-muted">Max. Size : 1 MB</label>
                              <br>
                              <label>Image Preview</label>
                              <div id="pratinjauGambar"></div>
                        </div>
                    </div>
                        <div class="col-sm-12">
                          <a href="berita.php" class="button" style="text-decoration: none;"><i class="far fa-hand-point-left"></i>&nbsp;Back</a>
                          <button class="button1" type="submit" name="btn_publish">
                          <i class="fas fa-file-upload"></i>&nbsp;  Publish
                         </button> 
                        </div>
              </div>
            </form>
        </div>
     </div>

    <script>
    CKEDITOR.replace( 'isiberita' );
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