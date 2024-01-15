<?php
session_start();
error_reporting(0);
// Cek apakah session cart ada atau tidak
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header("Location: index.php"); // Arahkan kembali ke halaman lain
    exit(); // Hentikan eksekusi skrip
}
?>

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
<style>
    .tf__cart_list button {
        width: 100%;
        text-align: center;
        padding: 10px 20px !important;
    }

    .tf__cart_list button::after,
    .tf__cart_list button::before {
        display: none;
    }

    .tf__cart_list h6 {
        border: none;
        color: var(--colorBlack);
        text-transform: capitalize;
        font-size: 18px;
        font-weight: 600;
        border-bottom: 1px solid #ff7c0845;
        padding-bottom: 5px;
    }

    .tf__cart_list p {
        text-transform: capitalize;
        margin-top: 15px;
        display: flex;
        justify-content: space-between;
        font-size: 15px;
        color: var(--colorBlack);
        font-weight: 500;
    }

    .tf__cart_list p span {
        font-size: 15px;
        color: var(--colorBlack);
        font-weight: 500;
    }

    .tf__cart_list .total {
        border-top: 1px solid #ff7c0845;
        padding-top: 10px;
        color: var(--colorBlack);
    }

    .tf__cart_list .total span {
        font-weight: 600;
        color: var(--colorBlack);
        font-size: 18px;
    }
</style>

<body>

    <!--=============================
        TOPBAR START
    ==============================-->
    <section class="tf__topbar">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-sm-6 col-md-8">
                    <ul class="tf__topbar_info d-flex flex-wrap d-none d-sm-flex">
                        <li><a href="mailto:example@gmail.com"><i class="fas fa-envelope"></i> examplemail@gmail.com</a>
                        </li>
                        <li class="d-none d-md-block"><a href="callto:123456789"><i class="fas fa-phone-alt"></i>
                                +62 81296986101</a></li>
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
                        <li><a href="cart_view.php">Cart</a></li>
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
                <div class="col-xl-8 col-lg-7">
                    <div class="tf__checkout_form">
                        <div class="tf__check_form">
                            <h5>Detail Order</h5>

                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Menu</th>
                                                <th scope="col">Jumlah</th>
                                                <th scope="col">Harga</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            include 'backend/koneksi.php';
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
                                                    <th scope="row"><?= $row['nama_menu']; ?></th>
                                                    <td><?= $qty; ?></td>
                                                    <td>Rp. <?= number_format($item_price) ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <form method="post" action="proses_order.php">
                                <input type="number" value="<?= $total_price; ?>" name="total_price" hidden>
                                <input type="number" value="<?= $qty_j; ?>" name="jumlah_order" hidden>
                                <div class="row mt_30">
                                    <div class="col-12">
                                        <h5>Pilih Pesanan</h5>
                                    </div>
                                    <div class="col-md-12 col-lg-12 col-xl-12">
                                        <div class="tf__check_single_form">
                                            <select class="form-select" id="tipe_pesanan" name="tipe_pesanan" required>
                                                <option selected disabled>Pilih Tipe Pesanan</option>
                                                <option value="1">Dine In</option>
                                                <option value="2">Pesan Online</option>
                                            </select>
                                            <br>
                                            <div id="div1" class="pesanan" style="display: none;">
                                                <div class="tf__check_single_form">
                                                    <input type="text" placeholder="Nama Pelanggan" name="nama_pelanggan" required>
                                                </div>
                                            </div>
                                            <div id="div2" class="pesanan" style="display: none;">
                                                <div class="tf__check_single_form">
                                                    <input type="text" placeholder="Nama Pelanggan" name="nama_pelanggan2" required>
                                                </div>
                                                <div class="tf__check_single_form">
                                                    <input type="number" placeholder="No Telp Pelanggan" name="notelp_pelanggan" required>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- <div class="col-12">
                                        <h5>Nama Pelanggan</h5>
                                    </div>
                                    <div class="col-md-12 col-lg-12 col-xl-12">
                                        <div class="tf__check_single_form">
                                            <input type="text" placeholder="Nama Pelanggan" name="nama_pelanggan" required>
                                        </div>
                                    </div> -->
                                </div>
                                <!-- <button type="submit" name="submit">Selesaikan Transaksi</button> -->
                                <!-- </form> -->
                                <!-- <button class="common_btn" name="submit" type="submit">checkout</button> -->

                                <!-- </form> -->


                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-5 wow">
                    <div id="sticky_sidebar" class="tf__cart_list">
                        <div class="tf__cart_list_footer_button_text">
                            <h6>Ringkasan Pesanan</h6>
                            <p>Total Jumlah Menu : <span><?= $qty_j; ?></span></p>
                            <p class="total"><span>total:</span><span>Rp. <?= number_format($total_price) ?></span></p>
                            <br><br>
                            <button class="common_btn" name="submit" type="submit">pesan</button>
                        </div>
                    </div>
                </div>
                </form>
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
                            <p class="info"><i class="fas fa-phone-alt"></i> +62 81296986101</p>
                            <p class="info"><i class="fas fa-envelope"></i> examplemail@gmail.com</p>
                            <p class="info"><i class="far fa-map-marker-alt"></i> Pd. Jagung Tim., Kec. Serpong Utara, Kota Tangerang Selatan, Banten</p>
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
                            <p>Copyright ©<b> RegFood</b> 2023. All Rights Reserved</p>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        document.getElementById("tipe_pesanan").addEventListener("change", function() {
            var selectedOption = this.value;
            var div1 = document.getElementById("div1");
            var div2 = document.getElementById("div2");

            if (selectedOption === "1") {
                div1.style.display = "block";
                div2.style.display = "none";
            } else if (selectedOption === "2") {
                div1.style.display = "none";
                div2.style.display = "block";
            } else {
                div1.style.display = "none";
                div2.style.display = "none";
            }
        });
    </script>
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