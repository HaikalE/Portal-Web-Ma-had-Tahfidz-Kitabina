<?php 
include 'header.php';
include 'adminbody.php';
?>
<?php 

$limit = 5;
$halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
$halaman_awal = ($halaman>1) ? ($halaman * $limit) - $limit : 0;	

$previous = $halaman - 1;
$next = $halaman + 1;
$no_hal = $halaman_awal + 1;

if(isset($_GET['p'])){
    $id = $_GET['p'];
    $status = '1';
    mysqli_query($koneksi, "UPDATE komentar SET status_komentar='$status' WHERE id_komentar='$id'");
}else if(isset ($_GET['hapus'])){
    $id = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM komentar where id_komentar='$id'");
}
?>
<div class="container">
<br>
<br>
            <h2>Comments</h2>
            <hr>
                <table class="table table-hover table-bordered">
                    <thead>
                  <tr style="text-align: center;"> 
                  <th>No</th>
                  <th>Name</th>
                  <th>Comment</th>
                  <th>Status</th>
							    <th></th>
                  </tr>
                    </thead>
                    <tbody>
                    <?php 
				include "../Configurasi/koneksi.php";
				$no = 1;
        $data = mysqli_query($koneksi,"select * from komentar");
        $total_rec_num = $data->num_rows;
        $total_halaman = ceil($total_rec_num/$limit);
  
				while($moderasi = mysqli_fetch_array($data)){
					?>
                    <tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo $moderasi['nama']; ?></td>
                		<td><?php echo $moderasi['isi_komentar']; ?></td>
                		<td><?php echo $moderasi['status_komentar']; ?></td>
						<td style="text-align: center;">
						      <a href="moderasikomentar.php?p=<?php echo $moderasi['id_komentar'];?>" class="btn btn-primary" name="ya"><i class="fa fa-check"></i></a>
                  <a href="moderasikomentar.php?hapus=<?php echo $moderasi['id_komentar'];?>" class="btn btn-danger alert_notif" name="hapus"><i class="fa fa-close"></i></a>
						</td>                      
                      <?php }  ?>

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
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>

    <script>
    $('.alert_notif').on('click',function(e){
        e.preventDefault();
        const href=$(this).attr('href')

        Swal.fire({
        title: 'Yakin ingin menghapus komentar ini?',
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

</html>
<br><br><br><br><br>
<?php include ('footer.php'); ?>