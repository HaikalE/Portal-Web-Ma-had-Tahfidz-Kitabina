<?php
include('header.php');
include ('user/konfirmasikomentar.php');

?>
<?php 
$id=$_GET['p'];?>
<?php 
$detail_sql = "SELECT 
berita.judul,
berita.gambar,
berita.isi_berita,
berita.tgl_posting,
berita.id_user,
berita.id_kategori,
berita.dilihat,
user.id_user,
user.nama,
kategori.id_kategori,
kategori.kategori
FROM 
berita 
INNER JOIN user ON berita.id_user = user.id_user
INNER JOIN kategori on berita.id_kategori = kategori.id_kategori 
WHERE id_berita = '$id'";

$detail_result = mysqli_query($koneksi, $detail_sql) or die("error");
if(mysqli_num_rows($detail_result) > 0){
  while ($detail = mysqli_fetch_assoc($detail_result)){
    $judul = $detail['judul'];
    $tgl_posting = $detail['tgl_posting'];
    $isi_berita = $detail['isi_berita'];
    $gambar = $detail['gambar'];
    $kategori = $detail['kategori'];
    $user = $detail['nama'];
    $stat = $detail['dilihat']+1;
    $sqlStat = 'UPDATE berita SET dilihat = "'.$stat.'" WHERE id_berita = "'.$id.'"';
    $qryStat = $koneksi->query($sqlStat) or die("Error menyimpan statistik: ".$koneksi->error);
  
  }
}

$komentar_sql = "SELECT * FROM komentar WHERE id_berita = '$id'";
$qry_komentar = mysqli_query($koneksi, $komentar_sql) or die("error");
?>
<body>
  <!-- Page Content -->
  <div class="content-wrapper">
    <div class="container">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
               <div class="col-lg-8">



        <!-- Title -->
        <h1 class="mt-4"><?php echo $judul;?></h1>

        <!-- Author -->
        <p class="lead">
          by
        <?php echo $user;?></a>
        </p>

        <hr>

        <!-- Date/Time -->
        <p>Posted on <?php echo $tgl_posting;?></p>

        <hr>

        <!-- Preview Image -->
        <img class="img-fluid rounded" src="assets/images/<?php echo $gambar;?>">

        <hr>

        <!-- Post Content -->
        <?php echo $isi_berita;?>
        <hr>

        <!-- Comments Form -->
        <div class="card my-4">
          <h5 class="card-header">Leave a Comment:</h5>
          <div class="card-body">
            <form action="detail.php?p=<?php echo $id;?>" method="POST">
                <br><input  class="form-control" autocomplete="off" type="text" name="nama" placeholder="Nama"><br>
                <textarea cols="81" rows="3" placeholder="Write your comment" name="komentar"></textarea>
              <button type="submit" name="submit" class="btn btn-primary">Submit</button>
              <h5 class="float-right text-success p-2"><?= $msg; ?></h5> 
            </form>
          </div>
        </div>
        <!-- Single Comment -->
        <?php while ($komentar = $qry_komentar -> fetch_assoc()){
          if($komentar['status_komentar'] == "1"){
            $nama = $komentar['nama'];
            $isi = $komentar['isi_komentar'];?>
        <div class="media mb-4">
          <img class="d-flex mr-3 rounded-circle" src="assets/images/people.svg" width="50px" height="50px" alt="">
          <div class="media-body">
            <h5 class="mt-0"><?php echo $nama;?></h5>
            <?php echo $isi;?>
          </div>
        </div>
        <?php }
      } ?>


      </div>

      <?php include 'sidebar.php'; ?>
      </div>
</div>
</div>
</div>
</div>
</div>
</div>

<?php include 'footer.php';