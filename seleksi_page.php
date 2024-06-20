<?php
session_start();
include 'connection.php';

?>
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
        <?php include 'admin_navbar.php'; ?>
        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                <?php include 'top_navbar.php'; ?>
            </div>

            <div class="wrapper wrapper-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox">
                            <div class="ibox-content">

                                <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="15">
                                <thead>
    <tr>
        <th data-hide="phone">Username</th>
        <th data-hide="phone">Nama Produk</th>
        <th data-hide="phone">Harga</th>
        <th data-hide="phone">Deskripsi</th>
        <th data-hide="phone">Status</th>
        <th data-hide="phone">Action</th>
    </tr>
</thead>
<tbody>
    <?php
    $sql = "SELECT product.*, user.username FROM product
            JOIN user ON user.id_user = product.id_user";
    $result = $koneksi->query($sql);
    ?>
    <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['nama_produk']; ?></td>
            <td>Rp.<?php echo number_format($row['harga']); ?></td>
            <td><?php echo $row['deskripsi']; ?></td>
            <td>
                <?php
                $status = $row['status'];
                $labelClass = '';

                switch ($status) {
                    case 'terseleksi':
                        $labelClass = 'label-success'; // green
                        break;
                    case 'pending':
                        $labelClass = 'label-primary'; // blue
                        break;
                    case 'ditolak':
                        $labelClass = 'label-danger'; // red
                        break;
                    default:
                        $labelClass = 'label-default'; // default gray
                        break;
                }
                ?>
                <span class="label <?php echo $labelClass; ?>"><?php echo $status; ?></span>
            </td>
            <td>
                <form action="aksi_update_status.php" method="post" style="display:inline;">
                    <input type="hidden" name="id_produk" value="<?php echo $row['id_produk']; ?>">
                    <button type="submit" name="status" value="terseleksi" class="btn btn-success btn-sm">Lolos</button>
                </form>
                <form action="aksi_update_status.php" method="post" style="display:inline;">
                    <input type="hidden" name="id_produk" value="<?php echo $row['id_produk']; ?>">
                    <button type="submit" name="status" value="ditolak" class="btn btn-danger btn-sm">Tidak Lolos</button>
                </form>
            </td>
        </tr>
    <?php } ?>
</tbody>

                                </table>
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
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
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
    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    document.getElementById('preview').src = e.target.result;
                    document.getElementById('preview').style.display = 'block';
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>

</html>