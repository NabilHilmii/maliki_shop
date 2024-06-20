<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Store Home Page</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>

    <div id="wrapper">
        <?php include 'guest_navbar.php'; // Sidebar for all users ?>
        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                <?php include 'top_navbar.php'; // Top navbar ?>

                <div class="wrapper">
                    
                    <div class="row">
                        <?php
                        // Include database connection
                        include 'connection.php';

                        // Fetch data from product table
                        $sql = "SELECT nama_produk, harga, foto,  deskripsi FROM product WHERE status='terseleksi'";
                        $result = $koneksi->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<div class="col-md-3">
                                    <div class="ibox">
                                        <div class="ibox-content product-box">
                                            <div class="product-imitation">
                                                <img src="' . $row["foto"] . '" alt="' . htmlspecialchars($row["nama_produk"]) . '" style="width:400px; height:400px; object-fit:cover;">
                                            </div>
                                            <div class="product-desc">
                                                <span class="product-price">Rp.' . htmlspecialchars($row["harga"]) . '</span>
                                               
                                                <a href="#" class="product-name">' . htmlspecialchars($row["nama_produk"]) . '</a>
                                                <div class="small m-t-xs">
                                                    <strong>Deskripsi: </strong>' . htmlspecialchars($row["deskripsi"]) . '<br>
                                                </div>
                                                <form action="login.php" method="POST" class="text-center">
                                                    <input type="hidden" name="product_id" value="' . htmlspecialchars($row['nama_produk']) . '">
                                                    <button type="submit" class="btn btn-primary btn-md">Buy Now</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                            }
                        } else {
                            echo "No books found.";
                        }
                        $koneksi->close();
                        ?>

                        <div class="footer">
                            <div class="pull-right">
                                10GB of <strong>250GB</strong> Free.
                            </div>
                            <div>
                                <strong>Copyright</strong> Example Company &copy; 2014-2017
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>
    <script src="js/plugins/iCheck/icheck.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".i-checks").iCheck({
                checkboxClass: "icheckbox_square-green",
                radioClass: "iradio_square-green",
            });
        });
    </script>
</body>

</html>
