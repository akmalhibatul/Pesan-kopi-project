<!DOCTYPE html>
<html lang="en">



<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densityDpi=device-dpi" />
    <title>MAHAAD KOPI || COFFE SHOP</title>
    <link rel="icon" type="image/png" href="images/icon.png">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/slick.css">
    <link rel="stylesheet" href="css/nice-select.css">
    <link rel="stylesheet" href="css/venobox.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/jquery.exzoom.css">

    <link rel="stylesheet" href="css/spacing.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
</head>

<body>

    <!--=============================
        TOPBAR START
    ==============================-->
    <section class="tf__topbar">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-sm-6 col-md-8">
                    <ul class="tf__topbar_info d-flex flex-wrap d-none d-sm-flex">
                        <li><a href="mailto:example@gmail.com"><i class="fas fa-envelope"></i> mahadkopi@gmail.com</a>
                        </li>
                        <li class="d-none d-md-block"><a href="callto:123456789"><i class="fas fa-phone-alt"></i>+62 878-5595-2576</a>
                    </li>
                    </ul>
                </div>
                <div class="col-xl-6 col-sm-6 col-md-4">
                    <ul class="topbar_icon d-flex flex-wrap">
                        <li><a href="#"><i class="fab fa-facebook-f"></i></a> </li>
                        <li><a href="#"><i class="fab fa-twitter"></i></a> </li>
                        <li><a href="#"><i class="fab fa-instagram"></i></a> </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--=============================
        TOPBAR END
    ==============================-->


    <!--=============================
        MENU START
    ==============================-->
    <nav class="navbar navbar-expand-lg main_menu">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="images/logo-maahadkopi.png" alt="RegFood" class="img-fluid">
            </a>
            <ul class="menu_icon d-flex flex-wrap">
                <?php
                // Hitung jumlah item dalam keranjang
                $jumlah_item_keranjang = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
                ?>

                <li>
                    <a class="cart_icon" href="cart_view.php"><i class="fas fa-shopping-basket"></i>
                        <span><?php echo $jumlah_item_keranjang; ?></span></a>
                </li>

            </ul>
        </div>
    </nav>
    <!--=============================
        MENU END
    ==============================-->


    <!--=============================
        BREADCRUMB START
    ==============================-->
    <section class="tf__breadcrumb" style="background-color: #212121 ;">
        <div class="tf__breadcrumb_overlay">
            <div class="container">
                <div class="tf__breadcrumb_text">
                    <h1>checkout</h1>
                    <ul>
                        <li><a href="index.php">home</a></li>
                        <li><a href="#">checkout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--=============================
        BREADCRUMB END
    ==============================-->


    <!--============================
        CHECK OUT PAGE START
    ==============================-->
    <section class="tf__cart_view mt_100 xs_mt_70 mb_100 xs_mb_70">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="tf__checkout_form">
                        <div class="justify-content-center">
                            <style>
                                .img-shopping {
                                    width: 100px;
                                    height: 100px;
                                    margin: 0 auto;
                                    display: block;
                                }
                            </style>
                            <div class="img-shopping">
                                <img src="images/shopping-cart.png" class="img-fluid" alt="">
                            </div>
                        </div>
                        <h2 class="fw-bold text-center mx-3" style="color: #1A120B;">Order Selesai</h2>
                        <h4 class="fw-normal text-center mx-3" style="color: #6e4c43;">Terima Kasih, Pesanan Anda Kami Terima.</h4>
                        <h4 class="fw-normal text-center mx-3" style="color: #6e4c43;">Segera Lakukan Pembayaran Di Kasir Agar Pesanan Anda Dapat Kami Proses Dengan Cepat.</h4>
                        <hr>

                        <table class="table text-center mx-3">
                            <?php
                            include 'backend/koneksi.php';
                            include  'indo_format.php';
                            $id_order = $_GET['id_order'];
                            $query = mysqli_query($koneksi, "SELECT * FROM tb_order WHERE id_order = '$id_order'");
                            $d = mysqli_fetch_array($query);
                            ?>
                            <tbody>
                                <tr>
                                    <th scope="row">NO. ORDER #</th>
                                    <td>: <?= $d['no_order']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">TANGGAL ORDER</th>
                                    <td>: <?= format_hari_tanggal($d['tanggal_order']) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">TOTAL :</th>
                                    <td style="font-weight: bold;">: Rp. <?= number_format($d['total_order']) ?></td>
                                </tr>

                            </tbody>
                        </table>

                        <h4 class="fw-bold mx-3" style="color: #1A120B;">Order Detail</h4>
                        <table class="table mx-3">
                            <thead>
                                <tr>
                                    <th scope="col">Menu</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = mysqli_query($koneksi, "SELECT * FROM tb_order_detail INNER JOIN tb_menu ON tb_order_detail.id_menu = tb_menu.id_menu WHERE id_order = '$id_order'");
                                while ($data = mysqli_fetch_array($query)) {
                                ?>
                                    <tr>
                                        <th scope="row"><?= $data['nama_menu']; ?></th>
                                        <td><?= $data['jumlah_order_detail']; ?></td>
                                        <td>Rp. <?= number_format($data['harga_order_detail']) ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                        <h4 class="fw-bold mx-3" style="color: #1A120B;">Detail Pembeli</h4>
                        <hr>
                        <div class="form-group mx-3">
                            <label for="name">Nama Anda</label>
                            <input type="text" class="form-control" name="nama" value="<?= $d['nama_pelanggan']; ?>" required disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        CHECK OUT PAGE END
    ==============================-->


    <!--=============================
        FOOTER START
    ==============================-->
    <footer style="background-color: #3C2A21 ;">
        <div class="footer_overlay pt_100 xs_pt_70 pb_100 xs_pb_20">
            <div class="container wow">
                <div class="row justify-content-between">
                    <div class="col-xxl-4 col-lg-4 col-sm-9 col-md-7">
                        <div class="tf__footer_content">
                            <a class="footer_logo" href="index.php">
                                <img src="images/footer-logo.jpg" alt="RegFood" class="img-fluid w-100">
                            </a>
                            <span>Selamat datang di Mahhad Kopi, destinasi utama bagi pecinta kopi. Temukan ragam biji kopi pilihan dan nikmati pengalaman kopi yang luar biasa. Dari Espresso yang kuat hingga Cappuccino yang lembut, rasa dan aroma kami tak tertandingi. Selamat datang dalam dunia cita rasa yang menggugah di Mahhad Kopi!.</span>
                            <ul class="social_link d-flex flex-wrap">
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-lg-4 col-sm-9 col-md-7 order-lg-4">
                        <div class="tf__footer_content">
                            <h3>contact us</h3>
                            <p class="info"><i class="fas fa-phone-alt"></i> +62 878-5595-2576</p>
                            <p class="info"><i class="fas fa-envelope"></i> mahadkopi@gmail.com</p>
                            <p class="info"><i class="far fa-map-marker-alt"></i> Pd. Jagung Timur., Kec. Serpong Utara, Kota Tangerang Selatan, Banten</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tf__footer_bottom d-flex flex-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="tf__footer_bottom_text">
                            <p>Copyright ©<b> Maahad Kopi</b> 2023. All Rights Reserved</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--=============================
        FOOTER END
    ==============================-->




    <!--jquery library js-->
    <script src="js/jquery-3.6.0.min.js"></script>
    <!--bootstrap js-->
    <script src="js/bootstrap.bundle.min.js"></script>
    <!--font-awesome js-->
    <script src="js/Font-Awesome.js"></script>
    <!-- slick slider -->
    <script src="js/slick.min.js"></script>
    <!-- isotop js -->
    <script src="js/isotope.pkgd.min.js"></script>
    <!-- counter up js -->
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.countup.min.js"></script>
    <!-- nice select js -->
    <script src="js/jquery.nice-select.min.js"></script>
    <!-- venobox js -->
    <script src="js/venobox.min.js"></script>
    <!-- sticky sidebar js -->
    <script src="js/sticky_sidebar.js"></script>
    <!-- wow js -->
    <script src="js/wow.min.js"></script>
    <!-- ex zoom js -->
    <script src="js/jquery.exzoom.js"></script>

    <!--main/custom js-->
    <script src="js/main.js"></script>

</body>


<!-- Mirrored from html.themefax.com/regfood/check_out.php by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 10 Aug 2023 02:11:38 GMT -->

</html>