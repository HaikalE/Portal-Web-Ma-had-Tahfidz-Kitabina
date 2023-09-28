<?php
include 'Configurasi/koneksi.php';

$sqlKat = 'SELECT
kategori.id_kategori,
kategori.kategori
FROM
kategori
INNER JOIN berita ON kategori.id_kategori = berita.id_kategori
GROUP BY
kategori.kategori
ORDER BY
kategori.id_kategori ASC
LIMIT 0, 6';
$qryKat = $koneksi->query($sqlKat) or die($koneksi->error);

$sqlBreaking = 'SELECT berita.id_berita, berita.judul, berita.tgl_posting FROM berita ORDER BY berita.tgl_posting DESC LIMIT 0, 5';
$qryBreaking = $koneksi->query($sqlBreaking);

$url = $_SERVER['REQUEST_URI'];
$explode_url = explode("/", $url);
?>

<!DOCTYPE html>
<html lang="zxx">
  <head>

    <!-- Required meta tags -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>NewsHub</title>
    <!-- plugin css for this page -->
    <link
      rel="stylesheet"
      href="./assets/vendors/mdi/css/materialdesignicons.min.css"
    />
    <link rel="stylesheet" href="assets/vendors/aos/dist/aos.css/aos.css" />

    <!-- End plugin css for this page -->
    <link rel="shortcut icon" href="assets/images/logo.png" style="width: 100px;" />

    <!-- inject:css -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- endinject -->
    <script src="https://unpkg.com/@popperjs/core@2"></script>
  </head>

  <header id="header">
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-light">
        <div class="navbar-top">
          <div class="d-flex justify-content-between align-items-center">
            <ul class="navbar-top-left-menu">
              <li class="nav-item"> <?php echo date('l, d F Y'); ?>
              </li>
              <li class="nav-item">
              </li>
              <li class="nav-item">
              </li>
              <li class="nav-item">
              </li>
              <li class="nav-item">
              </li>
            </ul>
            <ul class="navbar-top-right-menu">
            <form action="cari.php" method="POST">
              <li class="nav-item">
              <br>
              <br>
              <div class="input-group mb-1">
                <input type="text" placeholder="Search..." autocomplete="off" name="nt">
                <div class="input-group-append">
                  <button class="btn btn-outline-secondary" type="submit" name="submit">
                  <script src="https://cdn.lordicon.com/libs/mssddfmo/lord-icon-2.1.0.js"></script>
                    <lord-icon
                        src="https://cdn.lordicon.com/msoeawqm.json"
                        trigger="loop-on-hover"
                        delay="1000"
                        colors="primary:#0a2e5c,secondary:#e8e230"
                        style="width:20px;height:20px">
                    </lord-icon>
                  </button>
                </div>
              </div>
              </li>
              </form>
              <?php 
              session_start();
              if(isset($_SESSION['username'])):?>
                <?php if($_SESSION['level'] == "admin"):?>
                <li class="nav-item">
                <a href="user/admin.php" class="nav-link"><?php echo $_SESSION['nama'];?></a>
                </li>
                <li class="nav-item"><a href="user/logout.php" class="nav-link">Log Out</a>
                </li>
                <?php else: ?>
                <li class="nav-item">
                <a href="user/user.php" class="nav-link"><?php echo $_SESSION['nama'];?></a>
                <li class="nav-item">
                <a href="user/logout.php" class="nav-link">Log Out </a>
                </li>
                <?php endif; ?>
              <?php else:?>
              <li></li>
              <li class="nav-item" style="background-color:black; border-style:solid; border-radius:10px;">
                <a href="user/login.php" style="color: white;">&nbsp;&nbsp;Login
                <script src="https://cdn.lordicon.com/libs/mssddfmo/lord-icon-2.1.0.js"></script>
                  <lord-icon
                      src="https://cdn.lordicon.com/dxjqoygy.json"
                      trigger="loop-on-hover"
                      colors="primary:#e8e230,secondary:#e8e230"
                      style="width:35px;height:35px">
                  </lord-icon>
                  </a>
              </li>
              <?php endif;?>
            </ul>
          </div>
        </div>
        <div class="navbar-bottom">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <a class="navbar-brand" href="index.php">
                <img src="assets/images/logo.png" alt=""/>
              </a>
            </div>
            <div>
              <button
                class="navbar-toggler"
                type="button"
                data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation"
              >
                <span class="navbar-toggler-icon"></span>
              </button>
              <div
                class="navbar-collapse justify-content-center collapse"
                id="navbarSupportedContent"
              >
                <ul
                  class="navbar-nav d-lg-flex justify-content-between align-items-center"
                >
                
                  <?php
                // Assuming you have a database connection established in your "koneksi.php" file
                include 'Configurasi/koneksi.php';

                // Fetch menu items from the database
                $sqlMenu = 'SELECT * FROM menu';
                $qryMenu = $koneksi->query($sqlMenu);

                // Loop through the menu items and display them as list items
                while ($rowMenu = $qryMenu->fetch_assoc()) {
                    echo '<li class="nav-item"> <a class="nav-link" href="detail.php?p='.$rowMenu['id_berita'].'" style="background-color:lightskyblue;">' . 
                    htmlspecialchars($rowMenu['menu_name']) . 
                    '</a></li><li class="nav-item">&nbsp;</li>';
                }

                ?>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </nav>
    </div>
  </header>
  <script>
  // JavaScript to handle the select element
  const selectElement = document.getElementById("mySelect");
  selectElement.addEventListener("change", function () {
    if (selectElement.value === "tentang_yayasan") {
      // Do nothing or handle the case when "Please choose" is selected
    } else {
      selectElement.value ="tentang_yayasan"
    }
  });
  const selectElement1 = document.getElementById("mySelect1");
  selectElement1.addEventListener("change", function () {
    if (selectElement1.value === "sejarah") {
      // Do nothing or handle the case when "Please choose" is selected
    } else {
      selectElement1.value ="sejarah"
    }
  });
</script>
  