<?php
include('../Configurasi/koneksi.php');

if (!isset($_GET['id_menu'])) {
    header('location:menu_listing.php'); // Replace 'menu_listing.php' with the appropriate listing page
    exit;
}

$id_menu = (int)$_GET['id_menu'];

// Check if the menu item exists
$sql_check = "SELECT * FROM menu WHERE id_menu = $id_menu";
$result_check = $koneksi->query($sql_check);

if ($result_check->num_rows === 0) {
    header('location:menu.php'); // Redirect to the listing page if the menu item doesn't exist
    exit;
}

// Delete the menu item
$sql_delete = "DELETE FROM menu WHERE id_menu = $id_menu";
$result_delete = $koneksi->query($sql_delete);

if ($result_delete) {
    // Optionally, you can delete associated files here if needed.
    // Example: unlink('../path/to/associated/file');

    // Redirect back to the menu listing page after successful deletion
    header('location:menu.php'); // Replace 'menu_listing.php' with the appropriate listing page
    exit;
} else {
    echo $koneksi->error;
}
?>
