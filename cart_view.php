<?php
session_start();
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">



<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densityDpi=device-dpi" />
    <title>MAHAAD KOPI</title>
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
                        <li class="d-none d-md-block"><a href="callto:123456789"><i class="fas fa-phone-alt"></i> +62 878-5595-2576</a>
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
                    <h1>Pesanan</h1>
                    <ul>
                        <li><a href="index.php">home</a></li>
                        <li><a href="#">pesanan</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--=============================
        BREADCRUMB END
    ==============================-->


    <!--============================
        CART VIEW START
    ==============================-->
    <section class="tf__cart_view mt_100 xs_mt_70 mb_100 xs_mb_70">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 wow">
                    <div class="tf__cart_list">
                        <div class="table-responsive">
                            <table>
                                <tbody>
                                    <tr>
                                        <th class="tf__pro_img">
                                            gambar
                                        </th>

                                        <th class="tf__pro_name">
                                            keterangan
                                        </th>

                                        <th class="tf__pro_status">
                                            harga
                                        </th>

                                        <th class="tf__pro_select">
                                            jumlah
                                        </th>

                                        <th class="tf__pro_tk">
                                            total
                                        </th>

                                        <th class="tf__pro_icon">
                                            hapus
                                        </th>
                                    </tr>
                                    <?php
                                    include 'backend/koneksi.php';
                                    if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                                        $total_price = 0;
                                        $qty_j = 0;
                                        foreach ($_SESSION['cart'] as $cart_item) {
                                            $id_menu = $cart_item['id_menu'];
                                            $qty = $cart_item['qty'];
                                            $query = "SELECT * FROM tb_menu WHERE id_menu = $id_menu";
                                            $result = mysqli_query($koneksi, $query);
                                            $row = mysqli_fetch_assoc($result);
                                            $item_price = $row['harga'] * $qty;
                                            $total_price += $item_price;
                                            $qty_j += $qty;
                                    ?>
                                            <tr>
                                                <td class="tf__pro_img">
                                                    <img src="admin/img/menu/<?= $row['img_menu']; ?>" alt="product" class="img-fluid w-100">
                                                </td>

                                                <td class="tf__pro_name">
                                                    <a href="#"><?= $row['nama_menu']; ?></a>
                                                </td>

                                                <td class="tf__pro_status">
                                                    <h6>Rp. <?= number_format($row['harga']) ?></h6>
                                                </td>

                                                <td class="tf__pro_select">
                                                    <div class="quentity_btn">
                                                        <a href="update_cart.php?action=decrease&id_menu=<?php echo $id_menu; ?>" class="btn btn-danger"><i class="fal fa-minus"></i></a>
                                                        <!-- <button class="btn btn-danger"><i class="fal fa-minus"></i></button> -->
                                                        <input type="text" value="<?= $qty; ?>">
                                                        <a href="update_cart.php?action=increase&id_menu=<?php echo $id_menu; ?>" class="btn btn-success"><i class="fal fa-plus"></i></a>
                                                        <!-- <button class="btn btn-success"><i class="fal fa-plus"></i></button> -->
                                                    </div>
                                                </td>

                                                <td class="tf__pro_tk">
                                                    <h6>Rp. <?= number_format($item_price) ?></h6>
                                                </td>

                                                <td class="tf__pro_icon">
                                                    <a href="remove_item.php?id_menu=<?php echo $id_menu; ?>"><i class="far fa-times"></i></a>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo '<tr><td colspan="6" align="center">Belum ada pesanan</td></tr>';
                                    }

                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 wow">
                    <div class="tf__cart_list_footer_button mt_50">
                        <div class="row">
                            <div class="col-xl-12 col-md-12">
                                <div class="tf__cart_list_footer_button_text">
                                    <h6>total pesanan</h6>
                                    <p>Jumlah Menu : <span><?= $qty_j; ?></span></p>
                                    <p class="total"><span>total:</span> <span><?= number_format($total_price) ?></span></p>
                                    <?php
                                    if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {

                                    ?>
                                        <a class="common_btn" href="check_out.php">Pesan</a>
                                    <?php } else { ?>

                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        CART VIEW END
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
                            <span>Selamat datang di Maahad Kopi, destinasi utama bagi pecinta kopi. Temukan ragam biji kopi pilihan dan nikmati pengalaman kopi yang luar biasa. Dari Espresso yang kuat hingga Cappuccino yang lembut, rasa dan aroma kami tak tertandingi. Selamat datang dalam dunia cita rasa yang menggugah di Mahhad Kopi!.</span>
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


<!-- Mirrored from html.themefax.com/regfood/cart_view.php by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 10 Aug 2023 02:11:38 GMT -->

</html>