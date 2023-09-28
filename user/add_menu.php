<?php
include 'header.php';
include 'body.php';

// Assuming you have already fetched the categories as $categories

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process form data
    $id_berita = $_POST['id_berita'];
    $menu_code = $_POST['menu_code'];
    $menu_name = $_POST['menu_name'];

    // Check if the id_berita is already assigned
    $check_sql = "SELECT * FROM menu WHERE id_berita = '$id_berita'";
    $check_result = $koneksi->query($check_sql);

    if ($check_result->num_rows == 0) {
        // id_berita is not assigned, so insert the data
        $insert_sql = "INSERT INTO menu (id_berita, menu_code, menu_name) VALUES ('$id_berita', '$menu_code', '$menu_name')";

        if ($koneksi->query($insert_sql) === TRUE) {
            // Insertion successful, you can redirect or show a success message here
            // Example: header("Location: success.php");
            // Make sure to exit to prevent further execution of the page
        } else {
            echo "Error: " . $insert_sql . "<br>" . $koneksi->error;
        }
    } else {
        // id_berita is already assigned, show an alert message
        $alertmsg = "ID Berita is already assigned to a menu item.";
        
    }
}

?>


<div class="container">
    <h3><i class="fas fa-file-medical"></i>&nbsp;Add Menu Item</h3>
    
    <hr>
    <?php if (!empty($alertmsg)): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $alertmsg; ?>
        </div>
    <?php endif; ?>
    <form method="POST">
        <div class="row">
        <div class="col-sm-8">
    <div class="form-group">
        <label>News</label>
        <select class="form-control" name="id_berita" required>
            <option value="">Select News</option>
            <?php
            $sql = "SELECT id_berita, judul FROM berita";
            $result = $koneksi->query($sql);

            if ($result->num_rows > 0) {
                while ($news = $result->fetch_assoc()) {
                    echo '<option value="' . $news['id_berita'] . '">' . $news['judul'] . '</option>';
                }
            } else {
                echo '<option value="" disabled>No news articles available</option>';
            }
            ?>
        </select>
    </div>
</div>

            <div class="col-sm-4">
                <div class="form-group">
                    <label>Menu Code</label>
                    <select class="form-control" name="menu_code" required>
                    <option value="">Select News</option>
                        <option value="0">Navbar menu</option>
                        <option value="1">Footer Article</option>
                        <option value="2">Both</option>
                    </select>
                </div>
            </div>
            <!-- Add the Menu Name input field here -->
            <div class="col-sm-8">
                <div class="form-group">
                    <label>Menu Name</label>
                    <input type="text" class="form-control" name="menu_name" placeholder="Menu Name" required>
                </div>
            </div>
            <div class="col-sm-12">
                <a href="menu.php" class="button" style="text-decoration: none;"><i class="far fa-hand-point-left"></i>&nbsp;Back</a>
                <button class="button1" type="submit" name="btn_add_menu">
                    <i class="fas fa-plus"></i>&nbsp;Add Menu Item
                </button>
            </div>
        </div>
    </form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>
<?php include 'footer.php' ?>
