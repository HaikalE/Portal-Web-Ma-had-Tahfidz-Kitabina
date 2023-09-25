<?php
include 'header.php';
include 'body.php';
?>

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
                <a href="berita.php" style="text-decoration: none;"><br><br>
                <script src="https://cdn.lordicon.com/libs/mssddfmo/lord-icon-2.1.0.js"></script>
                  <lord-icon
                      src="https://cdn.lordicon.com/nocovwne.json"
                      trigger="loop-on-hover"
                      delay="1000"
                      colors="primary:#121331,secondary:#8930e8"
                      style="width:200px;height:200px">
                  </lord-icon>
                  <h4>News</h4>
                </a>
              </div>
              <div class="col big-icon">
                <a href="../index.php" style="text-decoration: none;"><br><br>
                <script src="https://cdn.lordicon.com/libs/mssddfmo/lord-icon-2.1.0.js"></script>
                  <lord-icon
                      src="https://cdn.lordicon.com/qhgmphtg.json"
                      trigger="loop-on-hover"
                      colors="primary:#121331,secondary:#08a88a"
                      style="width:200px;height:200px">
                  </lord-icon>
                  <h4 style="position: bottom;">Visit Website</h4>
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