<?php
// sidebar.php

// Start the session
session_start();

// Include file koneksi ke database
include "connection.php";
?>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="font-awesome/css/font-awesome.css" rel="stylesheet">

<!-- FooTable -->
<link href="css/plugins/footable/footable.core.css" rel="stylesheet">

<link href="css/animate.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">

<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <?php
                $default_profile_image = 'image/download.png'; // Path to the default profile image

                if (isset($_SESSION['email'])) {
                    $email = $_SESSION['email'];
                    $sql = "SELECT * FROM user WHERE email='$email'";
                    $query = $koneksi->query($sql);
                    $user = $query->fetch_assoc();
                    if ($user) {
                        $username = $user['username'];
                        $profile_image = !empty($user['foto']) ? $user['foto'] : $default_profile_image;
                    } else {
                        $username = 'Guest';
                        $profile_image = $default_profile_image;
                    }
                } else {
                    $username = 'Guest';
                    $profile_image = $default_profile_image;
                }

                // Check if the profile image file exists
                if (!file_exists($profile_image)) {
                    $profile_image = $default_profile_image; // Use the default image if the profile image does not exist
                }
                ?>
                <div class="text-center">

                
                <div class="dropdown profile-element">
                    <span>
                        <img alt="image" class="img-circle" src="<?php echo $profile_image; ?>" style="width:100px; height:100px; object-fit:cover; margin: 10px;"/> <!-- Display profile picture -->
                    </span>
                    <a data-toggle="dropdown" class="text-center" href="#">
                        <span class="clear">
                            <span class="block m-t-xs"> <strong class="font-bold"><?php echo htmlspecialchars($username); ?></strong> <!-- Display username -->
                            </span>
                        </span>
                    </a>
                    <?php if ($username == 'Guest') { ?>
                        <div class="m-t-xs">
                            <a href="login.php" class="btn btn-primary btn-sm">Login</a> <!-- Login button for guests -->
                        </div>
                    <?php } ?>
                </div>
                </div>
                
                <div class="logo-element">
                    IN+
                </div>
            </li>
            <li>
                <a href="home_page.php"><i class="fa fa-th-large"></i> <span class="nav-label">Home</span></a>
            </li>
            <li>
                <a href="login.php"><i class="fa fa-tags"></i> <span class="nav-label">Jual Barang</span></a>
            </li>
           
        </ul>
    </div>
</nav>
