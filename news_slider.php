<?php
$kategori_list = 'SELECT
					kategori.kategori,
					kategori.id_kategori
					FROM
					berita
					INNER JOIN kategori ON berita.id_kategori = kategori.id_kategori
					GROUP BY
					kategori.kategori,
					kategori.id_kategori';
$list_kategori = $koneksi->query($kategori_list) or die($koneksi->error);

$terkini = 'SELECT
berita.id_berita,
berita.judul,
berita.gambar,
berita.isi_berita,
berita.tgl_posting,
berita.id_user,
user.nama
FROM
berita
INNER JOIN user ON berita.id_user = user.id_user
ORDER BY
berita.tgl_posting DESC
LIMIT 0, 3
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
LIMIT 0, 5
';

$list_terkini = $koneksi->query($terkini) or die ($koneksi->error);
$list_populer = $koneksi->query($populer) or die ($koneksi->error);

?>

<div class="content-wrapper">
          <div class="container">
            <div class="row" data-aos="fade-up">
              <div class="col-xl-8 stretch-card grid-margin">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <ul class="carousel-indicators">
                      <?php 
                      $i = 0;
                      foreach($list_populer as $row){
                        $actives = '';
                        if($i == 0){
                          $actives = 'active';
                        }
                      ?>
                      <li data-target = "#carouselExampleControls" data-slide-to="<?= $i;?>" class="active"></li>
                    <?php $i++; } ?>  
                    </ul>
                      <div class="carousel-inner">
                        <?php 
                        $i = 0;
                        foreach($list_populer as $row){
                          $actives = '';
                          if($i == 0){
                            $actives = 'active';
                          }
                        ?>
                    <div class="carousel-item <?=$actives;?>">
                <div class="position-relative">
                  <img
                    src="assets/images/<?php echo $row['gambar'];?>"
                    alt="banner"
                    width="730"
                    height="455"
                    
                  >
                  <div class="banner-content">
                    <div class="badge badge-danger fs-12 font-weight-bold mb-3">
                      POPULER
                    </div>
                    <a href="detail.php?p=<?php echo $row['id_berita'];?>" class="link2">
                    <h1 class="mb-0"><?php echo $row['judul']?></h1>
                    </a>
                  </div>
                </div>
                <?php $i++;?>
                </div>
                <?php } ?>  
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>

                  </div>

                </div>
              </div>
              <div class="col-xl-4  grid-margin">
                <div class="card bg-dark text-white">
                  <div class="card-body">
                    <h2>Latest News</h2>
                    <?php while ($terkini = $list_terkini -> fetch_assoc()){ ?>
                    <div
                      class="d-flex border-bottom-blue pt-3 pb-4 align-items-center justify-content-between">
                      <div class="pr-3">
                      <a href="detail.php?p=<?php echo $terkini['id_berita'];?>" class="link3">
                        <h5><?php echo $terkini['judul'];?></h5>
                        </a>
                        <div class="fs-12">
                          <span class="mr-2"><?php echo $terkini['nama'];?> </span><?php echo $terkini['tgl_posting'];?>
                        </div>
                      </div>
                      <div class="rotate-img">
                        <img
                          src="assets/images/<?php echo $terkini['gambar'];?>"
                          alt="thumb"
                          class="img-fluid img-lg"
                        />
                      </div>
                    </div>
                    <?php } ?>
              </div>
            </div>
            </div>
            </div>