<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LOGIN ADMIN | MAHHAD KOPI</title>
    <link rel="icon" type="image/png" href="../images/icon.png">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../admin/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="../admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../admin/dist/css/adminlte.min.css">

    <style>
        .card-primary.card-outline {
            border-top: 3px solid #6e4c43;
        }

        .btn-primary {
            color: #fff;
            background-color: #6e4c43;
            border-color: #6e4c43;
            box-shadow: none;
        }

        .btn-primary:hover {
            color: #fff;
            background-color: #484747;
            border-color: #484747;
        }
    </style>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <?php
        if (@($_GET['msg'] == 1)) {
        ?>
            <div class="alert alert-danger" role="alert">
                Username Atau Password Salah !
            </div>
        <?php
        } elseif (@($_GET['msg'] == 2)) {
        ?>
            <div class="alert alert-danger" role="alert">
                Akun Sudah Tidak Aktif , Silakan Hubungin Administator !
            </div>
        <?php
        } elseif (@($_GET['msg'] == 3)) {
        ?>
            <div class="alert alert-success" role="alert">
                Anda Telah Logout !
            </div>
        <?php } ?>
        <div class="card card-outline card-primary">

            <div class="card-header text-center">
                <img src="../images/footer-logo.jpg" class="img-fluid">
                <!-- <a href="index.php" class="h1"><b>MAHHAD</b>KOPI</a> -->
            </div>
            <div class="card-body">

                <!-- <p class="login-box-msg">Log in Admin</p> -->

                <form action="proses_login.php" method="post">
                    <div class="input-group mb-3">
                        <input type="text" name="username" class="form-control" placeholder="Username" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <!-- /.col -->
                        <div class="col-12">
                            <button type="submit" name="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="../kasir/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../kasir/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../kasir/dist/js/adminlte.min.js"></script>
</body>

</html>