<?php
session_start();
include '../backend/koneksi.php';
// Include the file containing the function definition
include 'indo_format.php';


if (isset($_SESSION['id_user'])) {
    $id_user = $_SESSION['id_user'];
} else {
    header("Location: ../login/index.php");
    exit();
}

$query = "SELECT * FROM tb_user WHERE id_user = $id_user";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);

$nama_lengkap = $data['nama_lengkap'];
$username = $data['username'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MAAHAD KOPI | ADMIN</title>
    <link rel="icon" type="image/png" href="img/icon.png">


    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

    <style>
        [class*=sidebar-dark-] {
            background-color: #3C2A21;
        }

        .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active,
        .sidebar-light-primary .nav-sidebar>.nav-item>.nav-link.active {
            background-color: #6e4c43;
            color: #fff;
        }

        .card-primary.card-outline {
            border-top: 3px solid #6e4c43;
        }

        .card-primary.card-outline-tabs>.card-header a.active {
            border-top: 3px solid #6e4c43;
        }

        .card-warning:not(.card-outline)>.card-header {
            background-color: #E6B325;
        }

        a {
            color: #3C2A21;
            text-decoration: none;
            background-color: transparent;
        }

        a:hover {
            color: #3C2A21;
            text-decoration: none;
            background-color: transparent;
        }

        .dropdown-item:hover {
            background-color: #3C2A21;
            color: #fff;

        }

        .btn-primary {
            color: #fff;
            background-color: #3C2A21;
            border-color: #3C2A21;
            box-shadow: none;
        }

        .btn-primary:hover {
            color: #fff;
            background-color: #484747;
            border-color: #484747;
        }

        .btn-danger {
            color: #fff;
            background-color: #CD1818;
            border-color: #CD1818;
            box-shadow: none;
        }

        .btn-danger:hover {
            color: #fff;
            background-color: #CD1818;
            border-color: #CD1818;
        }

        .btn-warning {
            color: #fff;
            background-color: #E6B325;
            border-color: #E6B325;
            box-shadow: none;
        }

        .btn-warning:hover {
            color: #fff;
            background-color: #E6B325;
            border-color: #E6B325;
        }

        .btn-success {
            color: #fff;
            background-color: #224B0C;
            border-color: #224B0C;
            box-shadow: none;
        }

        .btn-success:hover {
            color: #fff;
            background-color: #224B0C;
            border-color: #224B0C;
        }

        .card-primary:not(.card-outline)>.card-header {
            background-color: #3C2A21;
        }

        .page-item.active .page-link {
            z-index: 3;
            color: #fff;
            background-color: #3C2A21;
            border-color: #3C2A21;
        }

        .page-link {
            position: relative;
            display: block;
            padding: 0.5rem 0.75rem;
            margin-left: -1px;
            line-height: 1.25;
            color: #3C2A21;
            background-color: #fff;
            border: 1px solid #dee2e6;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>

            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-user" style="font-weight: bold;"> <?= $nama_lengkap; ?></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <div class="dropdown-divider"></div>
                        <a href="profile.php" class="dropdown-item">
                            <i class="fas fa-user-circle mr-2"></i> Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="../login/logout.php" class="dropdown-item">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </a>
                    </div>
                </li>

            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index.php" class="brand-link">
                <!-- <img src="img/admin-logo.png" alt="AdminLTE Logo" class="brand-image  elevation-3" style="opacity: .8"> -->
                <center>
                    <img src="../images/footer-logo.jpg" class="img-fluid elevation-3" width="80%">
                </center>
                <!-- <span class="brand-text font-weight-light">MAAHAD KOPI</span> -->
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="img/admin.png" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="profile.php" class="d-block"><?= $nama_lengkap; ?></a>
                    </div>
                </div>