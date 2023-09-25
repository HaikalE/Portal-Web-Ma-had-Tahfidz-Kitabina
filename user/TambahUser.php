<?php
require_once '../Configurasi/koneksi.php';
include 'header.php';
include 'body.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
    <div class="container">
          <h2><i>User Baru</i></h2>
          <hr>
          <form action="TambahAksi.php" method="POST" enctype="multipart/form-data">
              <div class="row">
                  <div class="col-sm-8">
                      <div class="form-group">
                      <label><b>Username</b></label>
                      <input type="text " class="form-control" id="usern" name="username">
                      </div>
                      <div class="col-sm-14">
                      <div class="form-group">
                      <label><b>Password</b></label>
                      <td > <input type="password" class="form-control"  id="pwd" name="password">
                      </div>
                      <div class="col-sm-15">
                      <div class="form-group">
                      <label><b>Email</b></label>
                      <input type="email" class="form-control"  id="email" name="email">
                      </div>
                      <div class="col-sm-15">
                      <div class="form-group">
                      <label><b>Nama Lengkap</b></label>
                      <input type="text " class="form-control"  id="name" name="nama">
                      </div>
                    </div>
                   </div>     
               </div>  
     </div>
                    <div class="col-sm-8">
                        <button type="submit" class="button1" style="text-decoration: none;"><i class="fa fa-plus-circle">&nbsp;Simpan</i></button>
                    </div>
                     </div>
                     <br><br><br><br><br><br>
            </form>
        </div>
     </div>

</body>
</html>

<?php include ('footer.php'); ?>