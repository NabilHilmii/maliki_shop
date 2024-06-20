<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_produk = $_POST['id_produk'];
    $status = $_POST['status'];

    $sql = "UPDATE product SET status = ? WHERE id_produk = ?";
    if ($stmt = $koneksi->prepare($sql)) {
        $stmt->bind_param("si", $status, $id_produk);
        if ($stmt->execute()) {
            header("Location: dashboard.php"); // Replace with your table page
            exit();
        } else {
            echo "Error executing statement: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $koneksi->error;
    }

    $koneksi->close();
}
?>
