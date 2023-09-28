<?php
include 'header.php';
include 'adminbody.php';
?>

<br>
<br>
<br>
        <!---Tampilan beranda -->
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <h2 class="page">Welcome, <i><?php echo $_SESSION['nama']?></i></h2>
            </div>
            </div>
            <br>
            <br>
            <div class="row">
              <div class="col big-icon">
                <a href="berita.php" style="text-decoration: none;">
                <script src="https://cdn.lordicon.com/libs/mssddfmo/lord-icon-2.1.0.js"></script>
                  <lord-icon
                      src="https://cdn.lordicon.com/nocovwne.json"
                      trigger="loop-on-hover"
                      delay="1000"
                      colors="primary:#121331,secondary:#8930e8"
                      style="width:100px;height:100px">
                  </lord-icon>
                  <br>
                  <h4>News</h4>
                </a>
              </div>
              <div class="col big-icon">
                <a href="kategori.php" style="text-decoration: none;">
                <script src="https://cdn.lordicon.com/libs/mssddfmo/lord-icon-2.1.0.js"></script>
                  <lord-icon
                      src="https://cdn.lordicon.com/jvucoldz.json"
                      trigger="loop-on-hover"
                      delay="2000"
                      colors="primary:#121331,secondary:#30e8bd"
                      style="width:100px;height:100px">
                  </lord-icon>
                  <br>
                  <h4>Categories</h4>
                </a>
              </div>
              <div class="col big-icon">
                <a href="moderasikomentar.php" style="text-decoration: none;">
                <script src="https://cdn.lordicon.com/libs/mssddfmo/lord-icon-2.1.0.js"></script>
                  <lord-icon
                      src="https://cdn.lordicon.com/zpxybbhl.json"
                      trigger="loop-on-hover"
                      delay="1000"
                      colors="primary:#545454,secondary:#ee66aa"
                      style="width:100px;height:100px">
                  </lord-icon>
                  <br>
                  <h4>Comment Moderation</h4>
                </a>
              </div>
              <div class="col big-icon">
                <a href="crud.php" style="text-decoration: none;">
                <script src="https://cdn.lordicon.com/libs/mssddfmo/lord-icon-2.1.0.js"></script>
                  <lord-icon
                      src="https://cdn.lordicon.com/tyounuzx.json"
                      trigger="loop-on-hover"
                      delay="1000"
                      colors="primary:#121331,secondary:#eee966"
                      style="width:100px;height:100px">
                  </lord-icon>
                  <br>
                  <h4>User</h4>
                </a>
              </div>
              <div class="col big-icon">
                <a href="menu.php" style="text-decoration: none;">
                <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
                <lord-icon
                    src="https://cdn.lordicon.com/lbsajkny.json"
                    trigger="hover"
                    colors="primary:#4be1ec,secondary:#cb5eee"
                    style="width:100px;height:100px">
                </lord-icon>
                  <br>
                  <h4>Menu</h4>
                </a>
              </div>
            </div>
          </div>
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <!--footer-->
        <?php
        include 'footer.php';
        ?>