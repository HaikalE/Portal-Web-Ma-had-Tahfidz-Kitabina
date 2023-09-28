<?php
// Include your database connection code here if not already included

include 'header.php';
include 'body.php';

// Assuming you have already fetched the categories as $categories

$alertmsg = ''; // Initialize the alert message variable
if (isset($_GET['id_menu'])) {
    $id_menu = $_GET['id_menu'];
    
    // Fetch menu_code and menu_name from the menu table based on id_menu
    $menu_query = "SELECT menu_code, menu_name FROM menu WHERE id_menu = '$id_menu'";
    $menu_result = $koneksi->query($menu_query);
    
    // Check if the query was successful
    if ($menu_result) {
        // Check if a menu item with the specified id_menu exists
        if ($menu_result->num_rows > 0) {
            // Fetch menu_code and menu_name
            $menu_data = $menu_result->fetch_assoc();
            $menu_code = $menu_data['menu_code'];
            $menu_name = $menu_data['menu_name'];
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Process form data
                $menu_code = $_POST['menu_code'];
                $menu_name = $_POST['menu_name']; // Sanitize input
                    // id_berita exists, so update the data
                    $update_sql = "UPDATE menu SET menu_code = '$menu_code', menu_name = '$menu_name' WHERE id_menu = '$id_menu'";
            
                    if ($koneksi->query($update_sql) === TRUE) {
                        // Update successful
                        $alertmsg = 
                        "<div class='alert alert-success' role='alert'>
                        Menu item updated successfully.
                    </div>";
                    } else {
                        $alertmsg ="<div class='alert alert-danger' role='alert'>Error: " . $update_sql . "<br>" . $koneksi->error."</div>";
                    }
            }
        } else {
            // No menu item found with the specified id_menu
            // You can handle this case as needed (e.g., display an error message)
        }
    } else {
        // Error executing the query
        // You can handle this case as needed (e.g., display an error message)
    }
}



// Fetch the available news articles for the dropdown
$sql = "SELECT id_berita, judul FROM berita";
$result = $koneksi->query($sql);

$id_berita = ''; // Initialize id_berita variable
$news_title = ''; // Initialize news_title variable

if ($result->num_rows > 0) {
    // Assuming you have a default selected news article (you can set it as per your requirement)
    $selected_news = $result->fetch_assoc();
    $id_berita = $selected_news['id_berita'];
    $news_title = $selected_news['judul'];
}

// Check if the id_menu parameter is provided in the URL



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Menu Item</title>
    <!-- Add your CSS links and other meta tags here -->
</head>
<body>

<!-- Rest of your HTML code -->

<div class="container">
    <h3><i class="fas fa-file-medical"></i>&nbsp;Add Menu Item</h3>
    
    <hr>
    <?php if (!empty($alertmsg)): ?>
            <?php echo $alertmsg; ?>
    <?php endif; ?>
    <form method="POST">
        <div class="row">
            <div class="col-sm-8">
                <div class="form-group">
                    <label>News</label>
                    <select class="form-control" name="id_berita" required disabled> <!-- Disable the select input -->
                        <option value="<?php echo $id_berita; ?>"><?php echo $news_title; ?></option> <!-- Display the selected title -->
                    </select>
                </div>
            </div>
            <!-- Modify the existing form fields -->
<div class="col-sm-4">
    <div class="form-group">
        <label>Menu Code</label>
        <select class="form-control" name="menu_code" required>
            <option value="">Select News</option>
            <option value="0" <?php if ($menu_code == '0') echo 'selected'; ?>>Navbar menu</option>
            <option value="1" <?php if ($menu_code == '1') echo 'selected'; ?>>Footer Article</option>
            <option value="2" <?php if ($menu_code == '2') echo 'selected'; ?>>Both</option>
        </select>
    </div>
</div>
<div class="col-sm-8">
    <div class="form-group">
        <label>Menu Name</label>
        <input type="text" class="form-control" name="menu_name" placeholder="Menu Name" required value="<?php echo $menu_name; ?>">
    </div>
</div>

            <div class="col-sm-12">
                <a href="menu.php" class="button" style="text-decoration: none;"><i class="far fa-hand-point-left"></i>&nbsp;Back</a>
                <button class="button1" type="submit" name="btn_add_menu">
                    <i class="fas fa-edit"></i>&nbsp;Update Item
                </button>
            </div>
        </div>
    </form>
</div>

<!-- Include your JavaScript and other scripts here -->
</body>
</html>
