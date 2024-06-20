<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Maliki Shop</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">
<div class="text-center">
    <h1 class="logo-name">MALIKI SHOP</h1>
    </div>
    <div class="middle-box text-center loginscreen   animated fadeInDown">
        
        <div>
            
            <h3>Register to Maliki Shop</h3>
            <p>Create account to see it in action.</p>
            <form class="m-t" action="aksi_register.php" method="POST" role="form" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="col-lg-15 control-label">Upload Image:</label>
                    <input type="file" class="form-control" name="image" required onchange="previewImage(this);">
                </div>
                <div class="form-group">
                    <img id="preview" src="#" alt="Book Cover Preview" style="max-width: 100%; height: auto; display: none;">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Username" name="username">
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="Email" name="email">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" name="password">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="WhatsApp (6281234567890)" name="nomor">
                </div>

                <button type="submit" class="btn btn-primary block full-width m-b">Register</button>

                <p class="text-muted text-center"><small>Already have an account?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="login.php">Login</a>
            </form>
            <p class="m-t"> <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small> </p>
        </div>
    </div>
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
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