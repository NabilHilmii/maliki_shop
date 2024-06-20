<?php
session_start();
include 'connection.php';

$_SESSION['username'];
$role = $_SESSION['role'];

?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INSPINIA | E-commerce product detail</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/plugins/touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet">
    <link href="css/plugins/slick/slick.css" rel="stylesheet">
    <link href="css/plugins/slick/slick-theme.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body>
    <div id="wrapper">
    <?php
        if ($role == 'seller') {
            include 'seller_navbar.php'; // Navbar untuk admin
        } elseif($role == 'user') {
            include 'user_navbar.php'; // Navbar untuk user biasa
        }else{
            include 'admin_navbar.php';
        }
        ?>
        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                <?php include 'top_navbar.php'; ?>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <?php
                    $id = $_POST['id_produk'];
                    // Menggunakan prepared statement untuk keamanan
                    $stmt = $koneksi->prepare("SELECT product.id_produk, product.nama_produk, product.harga, product.foto, product.deskripsi,user.nomor FROM product 
                    JOIN user ON user.id_user = product.id_user
                    WHERE id_produk = ?");
                    $stmt->bind_param("i", $id);
                    $stmt->execute();
                    $result = $stmt->get_result()->fetch_assoc();
                    ?>

                    <div class="ibox product-detail">
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="product-images">
                                        <img src="<?= htmlspecialchars($result['foto']) ?>" alt="<?= htmlspecialchars($result['nama_produk']) ?>" style="width: 600px; height: 400px;">
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <h2 class="font-bold m-b-xs">
                                        <?= htmlspecialchars($result['nama_produk']) ?>
                                    </h2>
                                    <hr>
                                    <div>
                                        <h1 class="product-main-price"><?= htmlspecialchars($result['harga']) ?></h1>
                                    </div>
                                    <hr>
                                    <h4>Deskripsi</h4>
                                    <div class="large text-muted">
                                        <?= htmlspecialchars($result['deskripsi']) ?>
                                        <br />
                                    </div>
                                    <hr>
                                    <div>
                                        <a data-toggle="modal" class="btn btn-primary" href="https://wa.me/<?= htmlspecialchars($result['nomor']) ?>">Beli</a>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="pull-right">
            10GB of <strong>250GB</strong> Free.
        </div>
        <div>
            <strong>Copyright</strong> Example Company &copy; 2014-2017
        </div>
    </div>
    <!-- Mainly scripts -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
</body>

</html>
