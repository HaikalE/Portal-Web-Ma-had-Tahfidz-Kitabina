<?php include 'header.php';?>
<?php 
	$limit = 7;
	$halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
	$halaman_awal = ($halaman>1) ? ($halaman * $limit) - $limit : 0;	

	$previous = $halaman - 1;
  $next = $halaman + 1;
  $no_hal = $halaman_awal + 1;

$id = $_GET['p'];

$sqlKategori = "SELECT kategori FROM kategori WHERE id_kategori='$id'";

$kategori_result = mysqli_query($koneksi, $sqlKategori) or die("error");
if(mysqli_num_rows($kategori_result) > 0){
    $kategori = $kategori_result -> fetch_assoc();
    $sqlHalaman = "SELECT
    berita.id_berita,
    berita.judul,
    berita.gambar,
    berita.isi_berita,
    berita.tgl_posting,
    user.id_user,
    user.nama,
    kategori.id_kategori,
    kategori.kategori
    FROM
    user
    INNER JOIN berita ON user.id_user = berita.id_user
    INNER JOIN kategori ON kategori.id_kategori = berita.id_kategori
    WHERE kategori.id_kategori = '$id'
    ORDER BY
    berita.tgl_posting DESC
    LIMIT ".$halaman_awal.",". $limit;

    $sql_rec = "SELECT id_berita FROM berita WHERE id_kategori = '$id'";

    $total_rec = $koneksi->query($sql_rec);
    $qryHal = $koneksi->query($sqlHalaman);
    $total_rec_num = $total_rec->num_rows;
    $total_halaman = ceil($total_rec_num/$limit);
    
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
  }

?>
             <!-- partial -->
             <div class="flash-news-banner">
          <div class="container">
            <div class="d-lg-flex align-items-center justify-content-between">
              <div class="d-flex align-items-center">
                <br>
                <br>
            </div>
          </div>
        </div>
        <div class="content-wrapper">
          <div class="container">
            <div class="col-sm-12">
              <div class="card" data-aos="fade-up">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-12">
                      <h1 class="font-weight-600 mb-4">
                        <?php echo $kategori['kategori'];?>
                      </h1>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-8">
                      <?php while($post = $qryHal -> fetch_assoc()){?>
                      <div class="row">
                        <div class="col-sm-4 grid-margin">
                          <div class="rotate-img">
                            <img
                              src="../assets/images/<?php echo $post['gambar'];?>"
                              alt="banner"
                              class="img-fluid"
                            />
                          </div>
                        </div>
                        <div class="col-sm-8 grid-margin">
                        <a  href="../detail.php?p=<?php echo $post['id_berita'];?>">
                          <h2 class="font-weight-600 mb-2">
                            <?php echo $post['judul'];?>
                          </h2>
                          </a>
                          <p class="fs-13 text-muted mb-0">
                            <span class="mr-2"><?php echo $post['nama'];?></span><?php echo $post['tgl_posting'];?>
                          </p>
                          <p class="fs-15">
                          <?php echo substr($post['isi_berita'], 0,200); ?>...
                          <br> 
                          <a  href="../detail.php?p=<?php echo $post['id_berita'];?>">
                          <b>Read More</b>
                          </a>
                          </p>
                        </div>
                      </div>
                      <?php              
                         $no_hal++;
                        }
                      ?>
                      <nav>
                  <ul class="pagination justify-content-center">
                  <?php if($halaman > 1){ ?>
                    <li class="page-item">
                      <a class="page-link" href="<?php echo "halaman.php?p=".$id."&amp;halaman=".$previous;?>";  ?>Previous</a>
                   <?php }  else{ ?>
                    </li>
                      <li class="page-item disabled">
                    </li>
                   <?php } ?>
                    <?php 
                    for($x=1;$x<=$total_halaman;$x++){
                      ?> 
                      <li class="page-item"><a class="page-link" href="<?php echo "halaman.php?p=".$id."&amp;halaman=".$x;?>"><?php echo $x ?></a></li>
                      <?php
                    }
                    ?>
                    <?php if($halaman == $total_halaman) {?>				
                    <li class="page-item disabled">
                    <?php } else{?>
                    <li class="page-item">
                      <a  class="page-link" href="<?php echo "halaman.php?p=".$id."&amp;halaman=".$next;?>">Next</a>
                    </li>
                    <?php } ?>
                  </ul>
                </nav>

                    </div>
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
                              <a  href="../detail.php?p=<?php echo $terkini['id_berita'];?>">
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
                                    src="../assets/images/<?php echo $terkini['gambar'];?>"
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
                              src="../assets/images/<?php echo $populer['gambar'];?>"
                              alt="banner"
                              class="img-fluid"
                            />
                          </div>
                          <a  href="../detail.php?p=<?php echo $populer['id_berita'];?>">
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
        <!-- main-panel ends -->
        <!-- container-scroller ends -->
        <?php include 'footer.php';?>

    <!-- inject:js -->
    <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- plugin js for this page -->

    <script src="../assets/vendors/aos/dist/aos.js/aos.js"></script>
    <!-- End plugin js for this page -->
    <!-- Custom js for this page-->
    <script src="../assets/js/demo.js"></script>
    <script src="../assets/js/jquery.easeScroll.js"></script>
    <!-- End custom js for this page-->
  </body>
</html>