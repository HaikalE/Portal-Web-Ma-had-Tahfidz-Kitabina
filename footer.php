<?php
$kategori_list = 'SELECT
kategori.kategori,
Count(berita.id_berita) AS jumlah,
kategori.id_kategori
FROM
berita
INNER JOIN kategori ON berita.id_kategori = kategori.id_kategori
GROUP BY
kategori.kategori,
kategori.id_kategori';
$list_kategori = $koneksi->query($kategori_list) or die($koneksi->error);

$latest = 'SELECT
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
LIMIT 0, 3
';

$list_latest = $koneksi->query($latest) or die ($koneksi->error);
?>

<footer>
    <div class="footer-top">
      <div class="container">
        <div class="row">
          <div class="col-sm-5">
            <img src="assets/images/logo.png" class="footer-logo" alt="" style="width: 200px;" />
            <h5 class="font-weight-normal mt-4 mb-5">
            YAYASAN FADHILATUL QURAN &copy;2023
              </h5>
          </div>
          <div class="col-sm-4">
            <h3 class="font-weight-bold mb-3">RECENT POSTS</h3>
            <?php while ($lat = $list_latest -> fetch_assoc()){?>
            <div class="row">
              <div class="col-sm-12">
                <div class="footer-border-bottom pb-2">
                  <div class="row">
                    <div class="col-3">
                      <img
                        src="assets/images/<?php echo $lat['gambar'];?>"
                        alt="thumb"
                        class="img-fluid"
                      />
                    </div>
                    <div class="col-9">
                      <a href="detail.php?p=<?php echo $lat['id_berita'];?>" class="link4"><h5 class="font-weight-600">
                        <?php echo $lat['judul'];?></a>
                      </h5>
                    </div>
                  </div>
                </div>

              </div>
            </div>
            <?php } ?>
            </div>
          <div class="col-sm-3">
            <h3 class="font-weight-bold mb-3">CATEGORIES</h3>
            <?php while ($kategori = $list_kategori -> fetch_assoc()){?>
            <div class="footer-border-bottom pb-2">
              <div class="d-flex justify-content-between align-items-center">
                <a href="pages/halaman.php?p=<?php echo $kategori['id_kategori'];?>" class="link4"><h5 class="mb-0 font-weight-600"><?php echo $kategori['kategori'];?></h5>
            </a>
                <div class="count"><?php echo $kategori['jumlah'];?></div>
              </div>
            </div>
            <?php } ?>
      </div>
    </div>
    <div class="footer-bottom">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="d-sm-flex justify-content-between align-items-center">
              <div class="fs-14 font-weight-600 mx-auto">
                © Group 7. All rights reserved.
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>