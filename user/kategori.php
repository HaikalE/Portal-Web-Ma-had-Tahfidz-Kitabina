<?php
include 'header.php';
include 'body.php';
?>
<div class="container">
    <h1>Category</h1>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-3">
                <form method="POST" action="TambahKategori.php">
                    <label><b>Add Category</b></label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="kategori" id="kategori" placeholder="...." required>
                    <div class="pull-right ml-3">
                        <button type="submit" class="btn btn-outline-info" name="button_kategori"><i class="fas fa-plus-circle">&nbsp;Add</i>
                        </button>
                    </div>
                    </div>
                </form>
                <br>
            </div>
        </div>
    </div>
    <table class="table table-hover table-bordered">
        <thead>
            <tr style="text-align: center;">
                <th width="10%">ID</th>
                <th width="80%">Category</th>
                <th width="10%" style="text-align:center"></th>
            </tr>
        </thead>
        <tbody>

            <?php
            $no = 1;
            $data = mysqli_query($koneksi, "SELECT * FROM kategori");
            while($d= mysqli_fetch_array($data)){
                ?>

                <tr>
                    <td><?php echo $no++;?></td>
                    <td><?php echo $d['kategori'];?></td>
                <td>
                <a href="edit_kategori.php?id=<?php echo $d['id_kategori']; ?>" class="btn btn-info"><i class="fa fa-edit"></i></a>
                <a href="delete_kategori.php?id=<?php echo$d['id_kategori'];?>" class="btn btn-danger alert_notif"><i class="fa fa-remove"></i></a>
                </td>
                </tr>
                <?php
            }
                ?>
        </tbody>
    </table>
    </div>
    <br>
    <?php include 'footer.php';?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>

    <script>
    $('.alert_notif').on('click',function(e){
        e.preventDefault();
        const href=$(this).attr('href')

        Swal.fire({
        title: 'Yakin ingin menghapus kategori ini?',
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
</body>
</html>        