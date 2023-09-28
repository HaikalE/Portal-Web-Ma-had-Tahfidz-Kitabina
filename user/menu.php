<?php
include 'header.php';
include 'body.php';
?>

<?php
$limit = 10;
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$halaman_awal = ($halaman > 1) ? ($halaman * $limit) - $limit : 0;

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
    LIMIT " . $halaman_awal . "," . $limit;
$qry = $koneksi->query($sql);

$sql_rec = "SELECT id_berita FROM berita";
$total_rec = $koneksi->query($sql_rec);
$total_rec_num = $total_rec->num_rows;
$total_halaman = ceil($total_rec_num / $limit);

// New SQL query to fetch menu data
$sql_menu = "SELECT * FROM menu";
$qry_menu = $koneksi->query($sql_menu);

?>

<!-- Display the menu table -->
<!-- Display the menu table -->
<div class="container">
    <h2>Menu Table</h2>
    <hr>
    <button class="button" style="border-radius: 5px;"><a href="add_menu.php" style="text-decoration: none; color:white">
                <i class="fas fa-plus-circle"></i>&nbsp;Add Menu</a></button>
    <table class="table table-hover table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>News ID</th>
                <th>Menu Code</th>
                <th>Menu Name</th>
                <th>Title</th>
                <th>Image</th>
                <th>Category</th>
                <th>Publish Date</th>
                <th>Author</th>
                <th>Action</th> <!-- New columns for Update and Delete -->
            </tr>
        </thead>
        <tbody>
            <?php while ($menu_row = $qry_menu->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $menu_row['id_menu']; ?></td>
                    <td><?php echo $menu_row['id_berita']; ?></td>
                    <td>
                        <?php
                        // Determine the Menu Type based on menu_code
                        $menuCode = $menu_row['menu_code'];
                        $menuType = '';

                        if ($menuCode == 0) {
                            $menuType = 'Navbar Menu';
                        } elseif ($menuCode == 1) {
                            $menuType = 'Footer Article';
                        } elseif ($menuCode == 2) {
                            $menuType = 'Both';
                        }

                        echo $menuType;
                        ?>
                    </td>
                    <td><?php echo $menu_row['menu_name']; ?></td>
                    <?php
                    // Fetch news details for the current menu item
                    $newsId = $menu_row['id_berita'];
                    $newsQuery = "SELECT berita.judul, berita.gambar, kategori.kategori, berita.tgl_posting, user.nama 
                                  FROM berita
                                  INNER JOIN user ON berita.id_user = user.id_user
                                  INNER JOIN kategori ON kategori.id_kategori = berita.id_kategori
                                  WHERE berita.id_berita = $newsId";
                    $newsResult = $koneksi->query($newsQuery);
                    $newsData = $newsResult->fetch_assoc();
                    ?>
                    <td><?php echo $newsData['judul']; ?></td>
                    <td>
                  
    <img src="../assets/images/<?php echo $newsData['gambar']; ?>" alt="Image" height="75" width="125">
</td>

                    <td><?php echo $newsData['kategori']; ?></td>
                    <td><?php echo $newsData['tgl_posting']; ?></td>
                    <td><?php echo $newsData['nama']; ?></td>
                    <td>
                <!-- Update link with id_menu parameter -->
                <a href="update_menu.php?id_menu=<?php echo $menu_row['id_menu']; ?>" class="btn btn-primary">Update</a>
                <!-- Delete link with id_menu parameter -->
                <a href="delete_menu.php?id_menu=<?php echo $menu_row['id_menu']; ?>" class="btn btn-danger alert_notif">Delete</a>
            </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>

<script>
    $('.alert_notif').on('click', function(e) {
        e.preventDefault();
        const href = $(this).attr('href')

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

<!-- Display the menu table -->


<!--footer-->
<?php include('footer.php'); ?>
