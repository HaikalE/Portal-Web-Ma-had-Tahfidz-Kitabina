<?php 
include 'header.php';
include 'body.php';
$id = $_GET['id_user'];
$data = mysqli_query($koneksi,"SELECT * FROM user where id_user='$id'");

while ($d = mysqli_fetch_array($data)){
 ?>
    
    <div class="container">
    <h3><i>Edit Data User</i></h3>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-3">
                <form method="POST" action="update_user.php">
                    <div class="form-group">
                        <label><b>Username</b></label>
                        <input type="hidden" name="id_user" value="<?php echo $d['id_user']; ?>">
                        <input type="text" class="form-control" name="username"  value="<?php echo $d['username'];?>">
                   </div>
                   <div class="form-group">
                        <label><b>Level</b></label>
                        <input type="hidden" name="id_user" value="<?php echo $d['id_user']; ?>">
                        <input type="text" class="form-control"  name="level"  value="<?php echo $d['level'];?>">
                   </div>
                   <div class="form-group">
                        <label><b>Email</b></label>
                        <input type="hidden" name="id_user" value="<?php echo $d['id_user']; ?>">
                        <input type="text" class="form-control" name="email"  value="<?php echo $d['email'];?>">
                   </div>
                   <div class="form-group">
                        <label><b>Nama Lengkap</b></label>
                        <input type="hidden" name="id_user" value="<?php echo $d['id_user']; ?>">
                        <input type="text" class="form-control" name="nama"  value="<?php echo $d['nama'];?>">
                   </div>
                   <div class="form-group">
                        <button type="button" class="btn btn-outline-info" name="button_kategori"><i class="fas fa-save">&nbsp;Simpan</i></button>
                    </div>
                </form>
                <?php
}
?>
            </div>
        </div>
    </div>
    
</body>
</html>



