<?php
session_start();
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_produk = $_POST['id_produk'];

    // Fetch the product to get the image path
    $sql = "SELECT foto FROM product WHERE id_produk = '$id_produk'";
    $result = $koneksi->query($sql);
    $row = $result->fetch_assoc();

    if ($row) {
        // Delete the image file
        $image_path = $row['image_path'];
        if (file_exists($image_path)) {
            unlink($image_path);
        }

        // Delete the product from the database
        $sql = "DELETE FROM product WHERE id_produk = '$id_produk'";
        if ($koneksi->query($sql) === TRUE) {
            echo "Product deleted successfully";
            header('Location: status_page.php'); // Redirect to a success page or back to the product list
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $koneksi->error;
        }
    } else {
        echo "Product not found.";
    }
} else {
    echo "Invalid request method.";
}
?>
