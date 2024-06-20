<?php
session_start();
include 'connection.php';
$id = $_SESSION['username'];
$sql = "SELECT * FROM user WHERE username = '$id'";
$user = $koneksi->query($sql);
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
        <?php include 'user_navbar.php'; ?>
        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                <?php include 'top_navbar.php'; ?>
            </div>

            <div class="wrapper wrapper-content">
                <div class="container">
                    <h1 class="my-4">Daftar Member</h1>
                    <form action="aksi_daftarmember.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="image_file">Upload Image:</label>
                            <input type="file" id="image_file" name="image_file" accept="image/jpeg" onchange="previewImage(this);">
                        </div>
                        <div class="form-group">
                            <img id="preview" src=""  style="max-width: 100%; height: auto;">
                        </div>
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?php echo $user['username']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="nomor">Nomor WhatsApp:</label>
                            <input type="text" class="form-control" id="nomor" name="nomor" value="<?php echo $user['nomor']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" value="<?php echo $user['password']; ?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Daftar Member</button>
                    </form>
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
