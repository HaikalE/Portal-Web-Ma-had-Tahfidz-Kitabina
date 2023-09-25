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
   <h4>Video Perkenalan</h4>
   <hr>
   <div class="row">
        <div class="col-md-6 mx-auto">
            <!-- Your YouTube video iframe goes here -->
            <iframe width="560" height="315" src="https://www.youtube.com/embed/-aAPigDbuPs?si=2tWz8q-PgGYo-_Tz" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
        </div>
    </div>
   <h4>ALAMAT GOOGLE MAPS MA'HAD TAHFIDZ YATIM DHUAFA KITABINA</h4>
   <div class="row">
            <div class="col-md-6">
                <h2>Kitabina 1 Gaperta</h2>
                <p>
                    Ma'had Tahfidz Al-Qur'an KITABINA 1<br>
                    Jl. Gaperta Ujung Jl. Darma No.15A<br>
                    Kel. Tanjung Gusta<br>
                    Kec. Medan Helvetia<br>
                    Kota Medan<br>
                </p>
                <p>
                    Ustazdah Ayu Permadani: <a href="https://wa.me/+6281264605069">wa.me/+62812-6460-5069</a><br>
                    Admin 1 Kitabina: <a href="https://wa.me/+6281372137455">wa.me/+62813-7213-7455</a><br>
                </p>
                <a href="https://maps.app.goo.gl/kPcBqBY2eTNFVjyLA" target="_blank">Google Maps Link</a>
            </div>
            <div class="col-md-6">
                <h2>Kitabina 2 Tembung</h2>
                <p>
                    Ma'had Tahfidz Al-Qur'an KITABINA 2 Tembung<br>
                    Jl. Pusaka Ps. No.68, Bandar Klippa, Kec. Percut Sei Tuan<br>
                    Kabupaten Deli Serdang, Sumatera Utara 20371<br>
                </p>
                <p>
                    Ustazdah Maytri: <a href="https://wa.me/+6289502682080">wa.me/+62895-0268-2080</a><br>
                    Admin 1 Kitabina: <a href="https://wa.me/+6281372137455">wa.me/+62813-7213-7455</a><br>
                </p>
                <a href="https://maps.app.goo.gl/YBCHK5cVGcXPabwu8" target="_blank">Google Maps Link</a>
            </div>
            <!-- Repeat the above structure for other locations -->
            <div class="col-md-6">
                <h2>Kitabina 3 Stabat</h2>
                <p>
                    Jl. Proklamasi Kec. Kwala Bingai<br>
                    Kab. Langkat Sumatera Utara<br>
                </p>
                <p>
                    Ustazdah Bengi: <a href="https://wa.me/+6282362102353">wa.me/+62823-6210-2353</a><br>
                    Admin 1 Kitabina: <a href="https://wa.me/+6281372137455">wa.me/+62813-7213-7455</a><br>
                </p>
                <a href="https://maps.app.goo.gl/C6KCDzfVeN1WuM1u5" target="_blank">Google Maps Link</a>
            </div>
            <!-- Continue repeating the structure for other locations -->
        </div>
   <hr>
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