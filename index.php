<?php
   include('header.php');
   $limit = 5;
   if(isset($_GET['p']))
   {
       $noPage = $_GET['p'];
   }
   else $noPage = 1;
   
   $offset = ($noPage - 1) * $limit;
   
   $kategori = 'SELECT kategori, id_kategori FROM kategori ORDER BY
   kategori ASC
   LIMIT 0, 10';
   $data_kategori = $koneksi->query($kategori) or die($koneksi->error);
   
   $sqlIndex = "SELECT berita.id_berita, berita.judul, berita.gambar, berita.isi_berita, berita.tgl_posting, user.id_user, user.nama, kategori.id_kategori, kategori.kategori
   FROM
   user
   INNER JOIN berita ON user.id_user = berita.id_user
   INNER JOIN kategori ON kategori.id_kategori = berita.id_kategori
   ORDER BY
   berita.tgl_posting DESC
   LIMIT ".$koneksi->real_escape_string($offset).",". $limit;
   
   $sql_rec = "SELECT id_berita from berita";
   
   $total_rec = $koneksi->query($sql_rec);
   
   //Menghitung data yang diambil
   $total_rec_num = $total_rec->num_rows;
   $qryIndex = $koneksi->query($sqlIndex);
   
   //Total semua data
   $total_page = ceil($total_rec_num/$limit);
   
   //marquee text
   $sql = "SELECT id_berita,judul FROM berita ORDER BY id_berita LIMIT 10";
   $result = mysqli_query($koneksi, $sql);
   
   ?>
<body>
   <!-- partial -->
   <div class="flash-news-banner">
      <div class="container">
         <div class="d-lg-flex align-items-center justify-content-between">
            <h4 style="background-color:lightskyblue; color:white; text-align:center;">
               HEADLINE NEWS
            </h4>
            <marquee behavior="" direction="left">
               <?php 
                  if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_array($result)){
                      echo '<label><a href="detail.php?p='.$row['id_berita'].'"><h4>'.$row['judul'].' |&nbsp;</h4></a></label>';
                    }
                  }    
                  ?>
            </marquee>
            <div class="d-flex align-items-center">
               <br>
               <br>
            </div>
         </div>
      </div>
      <?php include 'news_slider.php';?>
   </div>
   </div>
   </div>
   <div class="container">
   <?php
// Assuming you have a database connection established as $koneksi

// SQL query to fetch data from the menu table and join it with the berita table
$sql = "SELECT menu.menu_name, berita.judul, berita.isi_berita,menu.menu_code
        FROM menu
        INNER JOIN berita ON menu.id_berita = berita.id_berita";
$result = $koneksi->query($sql);

// Check if there are any rows in the result
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $menuName = $row['menu_name'];
        $judul = $row['judul'];
        $isiBerita = $row['isi_berita'];
        $menu_code=$row['menu_code'];
        if ($menu_code=='1'||$menu_code=='2'){
            // Display the content inside the container
        echo '<div class="container">';
        echo '<h4>' . $judul . '</h4>';
        echo '<hr>';
        echo '<div>' . $isiBerita . '</div>';
        echo '</div>';
        }
    }
} else {
    // No data found in the menu table
    echo 'No menu items found.';
}
?>

    </div>
   
   <!-- main-panel ends -->
   <!-- container-scroller ends -->
   <!-- partial:partials/_footer.html -->
   <?php include 'footer.php';?>
   <!-- partial -->
   <!-- inject:js -->
   <script src="assets/vendors/js/vendor.bundle.base.js"></script>
   <!-- endinject -->
   <!-- plugin js for this page -->
   <script src="assets/vendors/aos/dist/aos.js/aos.js"></script>
   <!-- End plugin js for this page -->
   <!-- Custom js for this page-->
   <script src="./assets/js/demo.js"></script>
   <script src="./assets/js/jquery.easeScroll.js"></script>
   <!-- End custom js for this page-->
</body>
</html>