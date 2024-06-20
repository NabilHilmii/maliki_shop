<?php
session_start();
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_user = $_POST['id_user'];
    $nama_produk = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];

    // Handle file upload
    $target_dir = "image/";
    $target_file = $target_dir . basename($_FILES["image_file"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["image_file"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size (5MB maximum)
    if ($_FILES["image_file"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        echo "Sorry, only JPG, JPEG, & PNG files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["image_file"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars(basename($_FILES["image_file"]["name"])) . " has been uploaded.";
            
            // Insert into database
            $sql = "INSERT 
            INTO product (id_user, nama_produk, harga, deskripsi, foto, status) VALUES ('$id_user', '$nama_produk', '$harga', '$deskripsi', '$target_file','pending')";
            
            if ($koneksi->query($sql) === TRUE) {
                echo "New record created successfully";
                header('Location: status_page.php'); // Redirect to a success page
                exit;
            } else {
                echo "Error: " . $sql . "<br>" . $koneksi->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>
