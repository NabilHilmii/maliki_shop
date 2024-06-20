<?php
session_start();
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ensure user is logged in
    if (!isset($_SESSION['username'])) {
        echo "You must be logged in to update your details.";
        exit();
    }

    // Get form data
    $username = $_SESSION['username']; // Use the username from the session
    $nomor = $_POST['nomor'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = 'seller';

    // Handle image upload
    $target_dir = "image/";
    $target_file = $target_dir . basename($_FILES["image_file"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $uploadOk = 1;

    // Check if image file is an actual image or fake image
    $check = getimagesize($_FILES["image_file"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["image_file"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "jpeg") {
        echo "Sorry, only JPG, JPEG files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["image_file"]["tmp_name"], $target_file)) {
            // Update database
            $sql = "UPDATE user SET nomor = ?, foto = ?, email = ?, password = ?, role = ? WHERE username = ?";
            if ($stmt = $koneksi->prepare($sql)) {
                $stmt->bind_param("ssssss", $nomor, $target_file, $email, $password, $role, $username);
                if ($stmt->execute()) {
                    echo "Update successful!";
                    header("location: login.php");
                    exit();
                } else {
                    echo "Error executing statement: " . $stmt->error;
                }
                $stmt->close();
            } else {
                echo "Error preparing statement: " . $koneksi->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    $koneksi->close();
}
?>
