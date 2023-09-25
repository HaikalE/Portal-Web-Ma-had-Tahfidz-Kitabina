<?php
//memasukkan file koneksi
include 'header.php';

$terkini = 'SELECT
berita.id_berita,
berita.judul,
berita.gambar,
berita.tgl_posting,
berita.id_user,
user.nama
FROM
berita
INNER JOIN user ON berita.id_user = user.id_user
ORDER BY
berita.tgl_posting DESC
LIMIT 0, 4
';

$populer = 'SELECT
berita.id_berita,
berita.judul,
berita.gambar,
berita.tgl_posting,
user.nama,
berita.id_user,
berita.dilihat
FROM
berita
INNER JOIN user ON berita.id_user = user.id_user
ORDER BY
berita.dilihat DESC
LIMIT 0, 3
';

$list_terkini = $koneksi->query($terkini) or die ($koneksi->error);
$list_populer = $koneksi->query($populer) or die ($koneksi->error);

?>
        <div class="content-wrapper">
          <div class="container">
            <div class="col-sm-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-12">
                      <h1 class="font-weight-600 mb-4">
                      Hasil Pencarian
                      </h1>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-8">
<?php
if(!ISSET($_POST['submit'])){

$sql = "SELECT * FROM berita";
$query = mysqli_query($koneksi, $sql);
while ($row = mysqli_fetch_array($query)){

?>
  <div class="row">
    <div class="col-sm-4 grid-margin">
      <div classs="rotate-img">
        <img src="assets/images/<?php echo $row['gambar'];?>" class="img-fluid">
      </div>

        <div class="col-sm-8 grid-margin">
            <a  href="../detail.php?p=<?php echo $row['id_berita'];?>">
               <h2 class="font-weight-600 mb-2">
                   <?php echo $row['judul'];?>
                 </h2>
             </a>
               <p class="fs-13 text-muted mb-0">
               <span class="mr-2"><?php echo $row['nama'];?></span><?php echo $row['tgl_posting'];?>
                 </p>
                  <p class="fs-15">
                  <?php echo substr($row['isi_berita'], 0,200); ?>...
                  <br> 
                  <a  href="../detail.php?p=<?php echo $row['id_berita'];?>">
                  <b>Read More</b>
                  </a>
                  </p>
                    </div>
                  </div>

<?php } } ?>

<?php if (ISSET($_POST['submit'])){
 $cari = $_POST['nt'];
 $query2 = "SELECT * FROM berita WHERE judul LIKE '%$cari%'";
 
 $sql = mysqli_query($koneksi, $query2);
 while ($r = mysqli_fetch_array($sql)){
  ?>
                     <div class="row">
                        <div class="col-sm-4 grid-margin">
                          <div class="rotate-img">
                            <img
                              src="assets/images/<?php echo $r['gambar'];?>"
                              alt="banner"
                              class="img-fluid"
                            />
                          </div>
                        </div>
                        <div class="col-sm-8 grid-margin">
                        <a  href="detail.php?p=<?php echo $r['id_berita'];?>">
                          <h2 class="font-weight-600 mb-2">
                            <?php echo $r['judul'];?>
                          </h2>
                          </a>
                          <p class="fs-15">
                          <?php echo substr($r['isi_berita'], 0,200); ?>...
                          <br> 
                          <a  href="../detail.php?p=<?php echo $r['id_berita'];?>">
                          <b>Read More</b>
                          </a>
                          </p>
                        </div>
                      </div>
 <?php }} ?>
 </div>

</table>

                    <div class="col-lg-4">
                      <h2 class="mb-4 text-primary font-weight-600">
                        Latest news
                      </h2>
                      <?php while($terkini = $list_terkini -> fetch_assoc()){?>
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="border-bottom pb-4 pt-4">
                            <div class="row">
                              <div class="col-sm-8">
                              <a  href="detail.php?p=<?php echo $terkini['id_berita'];?>">
                                <h5 class="font-weight-600 mb-1">
                                <?php echo $terkini['judul'];?>
                                  </h5>
                                  </a>
                                <p class="fs-13 text-muted mb-0">
                                  <span class="mr-2"><?php echo $terkini['nama'];?></span><?php echo $terkini['tgl_posting'];?>
                                </p>
                              </div>
                              <div class="col-sm-4">
                                <div class="rotate-img">
                                  <img
                                    src="assets/images/<?php echo $terkini['gambar'];?>"
                                    alt="banner"
                                    class="img-fluid"
                                  />
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <?php } ?>
                      <div class="trending">
                        <h2 class="mb-4 text-primary font-weight-600">
                          Trending
                        </h2>
                        <?php while($populer = $list_populer-> fetch_assoc()){?>
                        <div class="mb-4">
                          <div class="rotate-img">
                            <img
                              src="assets/images/<?php echo $populer['gambar'];?>"
                              alt="banner"
                              class="img-fluid"
                            />
                          </div>
                          <a  href="detail.php?p=<?php echo $populer['id_berita'];?>">
                          <h3 class="mt-3 font-weight-600">
                            <?php echo $populer['judul'];?>
                          </h3>
                          </a>
                          <p class="fs-13 text-muted mb-0">
                            <span class="mr-2"><?php echo $populer['nama'];?></span><?php echo $populer['tgl_posting'];?>
                          </p>
                        </div>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
<?php include 'footer.php';?>