<?php
include 'header.php';
include 'body.php';
?>
<?php
	$limit = 10;
	$halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
	$halaman_awal = ($halaman>1) ? ($halaman * $limit) - $limit : 0;	

	$previous = $halaman - 1;
  $next = $halaman + 1;
  $no_hal = $halaman_awal + 1;

$sql = "SELECT
berita.id_berita,
berita.judul,
user.id_user,
berita.gambar,
berita.tgl_posting,
user.nama,
kategori.kategori
FROM
berita
INNER JOIN user ON berita.id_user = user.id_user
INNER JOIN kategori ON kategori.id_kategori = berita.id_kategori
ORDER BY berita.tgl_posting DESC
LIMIT ".$halaman_awal.",". $limit;
$qry = $koneksi->query($sql);

$sql_rec = "SELECT id_berita FROM berita";

$total_rec = $koneksi->query($sql_rec);

$total_rec_num = $total_rec->num_rows;

$total_halaman = ceil($total_rec_num/$limit);

?>
      <!--Masukkan berita-->
        <div class="container">
            <h2>News</h2>
            <hr>
            <div class="row" style="float: right; padding-right:10px">
                <button class="button" style="border-radius: 5px;"><a href="TambahBerita.php" style="text-decoration: none; color:white">
                <i class="fas fa-plus-circle"></i>&nbsp;Add News</a></button>
                </div>
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th width="30%">Title</th>
                            <th width="12%">Image</th>
                            <th width="15%">Category</th>
                            <th width="15%">Publish Date</th>
                            <th width="10%">Author</th>
                            <th width="25"></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while($news_list = $qry->fetch_assoc()){
                      ?>
                    <tr>
                    <td><strong><?php echo $news_list['judul'];?></strong></td>
                    <td>
                      <img src="../assets/images/<?php echo $news_list['gambar'];?>" height="75" width="125">
                    </td>
                    <td><?php echo $news_list['kategori'];?></td>
                    <td><?php echo $news_list['tgl_posting'];?></td>
                    <td>
                    <?php echo $news_list['nama'] ?>
                    </td>
                    <td>
                    <?php if ($news_list['id_user'] == $_SESSION['id_user'] or $_SESSION['level']=='admin') { ?>
                    <a class="btn  btn-primary"  href="../detail.php?p=<?php echo $news_list['id_berita'];?>">
												<i class="fa fa-eye"></i></a>
											<a href="edit-berita.php?id=<?=$news_list['id_berita']?>" class="btn btn-success">
												<i class="fa fa-edit"></i></a>
											<a  href="hapus-berita.php?id=<?=$news_list['id_berita']?>" class="btn btn-danger alert_notif">
												<i class="fa fa-trash"></i></a>
                      <?php } else { ?>
											<a class="btn btn-sm btn-primary" target="_blank" href="../detail.php?p=<?php echo $news_list['id_berita'];?>">
												<i class="fa fa-eye"></i></a>
											<?php } ?>

                      </td>
                    </tr>
                      <?php 
                         $no_hal++;
                      } 
                      ?>

                    </tbody>
                </table>
                <nav>
                  <ul class="pagination justify-content-center">
                  <?php if($halaman > 1){ ?>
                    <li class="page-item">
                      <a class="page-link" <?php echo "href='?halaman=$previous'";  ?>><b>Previous</b></a>
                   <?php }  else{ ?>
                    </li>
                      <li class="page-item disabled">
                    </li>
                   <?php } ?>
                    <?php 
                    for($x=1;$x<=$total_halaman;$x++){
                      ?> 
                      <li class="page-item"><a class="page-link" href="?halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
                      <?php
                    }
                    ?>
                    <?php if($halaman == $total_halaman) {?>				
                    <li class="page-item disabled">
                    <?php } else{?>
                    <li class="page-item">
                      <a  class="page-link" <?php echo "href='?halaman=$next'"; ?>><b>Next</b></a>
                    </li>
                    <?php } ?>
                  </ul>
                </nav>
            </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>

    <script>
    $('.alert_notif').on('click',function(e){
        e.preventDefault();
        const href=$(this).attr('href')

        Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: "Perubahan tidak dapat dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus!'
        }).then((result) => {
        if (result.value) {
             document.location.href = href;
        }
        })

    })
    </script>

                    <!--footer-->
<?php include ('footer.php'); ?>

 