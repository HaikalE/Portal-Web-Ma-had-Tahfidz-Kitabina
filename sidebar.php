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
LIMIT 0, 4
';

$list_terkini = $koneksi->query($terkini) or die ($koneksi->error);
$list_populer = $koneksi->query($populer) or die ($koneksi->error);

?>



      <!-- Sidebar Widgets Column -->
      <div class="col-md-4">


        <!-- Categories Widget -->
        <div class="card my-4">
          <h5 class="card-header">Categories</h5>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-6">
                <ul class="list-unstyled  mb-0">
                <?php while($kategori = $list_kategori -> fetch_array()){ ?>
                  <li>
                    <a href="pages/halaman.php?p=<?php echo $kategori['id_kategori'];?>"><?php echo $kategori['kategori'];?></a>
                  </li>
                  <?php } ?>
                  </ul>

            </div>
          </div>
        </div>

        <!-- Side Widget -->
        <div class="card my-4">
          <h5 class="card-header">Berita Terkini</h5>
          <div class="card-body">
          <?php while ($berita = $list_terkini -> fetch_assoc()){ ?>
          <div class="d-flex border-bottom-blue pt-3 pb-4 align-items-center justify-content-between">
              <div class="pr-3">
                  <a href="detail.php?p=<?php echo $berita['id_berita'];?>"><h5><?php echo $berita['judul'];?></h5></a>
                      </div>
                      <div class="rotate-img">
                        <img
                          src="assets/images/<?php echo $berita['gambar'];?>"
                          alt="thumb"
                          class="img-fluid img-lg"
                        />
                      </div>
                    </div>
                    <?php }?>
        </div>
                 <!-- Side Widget -->
                 <div class="card my-4">
          <h5 class="card-header">Berita Populer</h5>
          <div class="card-body">
          <?php while ($berita = $list_populer -> fetch_assoc()){ ?>
          <div class="d-flex border-bottom-blue pt-3 pb-4 align-items-center justify-content-between">
              <div class="pr-3">
                  <a href="detail.php?p=<?php echo $berita['id_berita'];?>"><h5><?php echo $berita['judul'];?></h5></a>
                      </div>
                      <div class="rotate-img">
                        <img
                          src="assets/images/<?php echo $berita['gambar'];?>"
                          alt="thumb"
                          class="img-fluid img-lg"
                        />
                      </div>
                    </div>
                    <?php }?>
                    </div>
      </div>
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container -->
